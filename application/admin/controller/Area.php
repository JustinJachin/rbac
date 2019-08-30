<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\City;
use think\Db;
/**
 * 行政地域获取控制器
 * @author jachin <jachin@qq.com>
 */
class Area extends Base{

	public function index(){
		return view('index');

	}
	public function update(){
		$type=input('post.type');
		$year=date('Y')-1;
		$url='http://www.stats.gov.cn/tjsj/tjbz/tjyqhdmhcxhfdm/'.$year.'/';
		switch ($type) {
			case '1':
				$res=$this->updateProvincetr($url);
				break;
			case '2':
				$res=$this->updateCitytr($url);
				break;
			case '3':
				$res=$this->updateCountytr($url);
				break;
			case '4':
				$res=$this->upodateTowntr($url);
				break;
			default:
				# code...
				break;
		}
		return json($res);
	}
	public function upodateTowntr($url){
		$mapTowntr=['level'=>3,'status'=>1];
		$mapCountytr=['level'=>2,'status'=>1];
		$maptowntr=City::where($mapTowntr)->field('id,areaId,name')->select();
		$countytr=City::where($mapCountytr)->field('id,areaId,name')->select();
		$res=$this->formattedDataD($url,$countytr);
		$list=$this->returnArr($maptowntr,$res,3);
		$status=$this->insertTable($list);
		return $status;
	}
	public function updateCountytr($url){
		$mapCity=['level'=>1,'status'=>1];
		$mapCountytr=['level'=>2,'status'=>1];
		
		$citytr=City::where($mapCity)->field('id,areaId,name')->select();
		$countytr=City::where($mapCountytr)->field('id,areaId,name')->select();
		$res=$this->formattedDataW($url,$citytr);
		$list=$this->returnArr($countytr,$res,2);
		$status=$this->insertTable($list);
		return $status;
	}

	public function updateCitytr($url){
		$mapP=[
			'level'=>0,'status'=>1
		];
		$mapC=[
			'level'=>1,'status'=>1
		];
		$lists=array();
		$provincetr=City::where($mapP)->field('id,areaId,name')->select();
		$citytr=City::where($mapC)->field('id,areaId,name')->select();
		foreach ($provincetr as $key => $value) {
			$code=substr($value['areaId'],0,2);
			$urls=$url.$code.'.html';
			$res=$this->formattedData($urls,'citytr','/\d{12}|[\x7f-\xff]+/');
			$res=$res[0];
			$lists=array_merge($lists,$res);
		}
		$list=$this->returnArr($citytr,$lists,1);
		// var_dump($lists);exit;
		$status=$this->insertTable($list);
		return $status;
	}
	public function updateProvincetr($url){
		
		$urls=$url.'index.html';
		
		$res=$this->formattedData($urls,'provincetr','/\d{2}|[\x7f-\xff]+/');
		$res=$res[0];

		$map=['level'=>0,'status'=>1];
		
		$provincetr=City::where($map)->field('id,areaId,name')->select();
		$arrs=$this->returnArr($provincetr,$res,0);
		$status=$this->insertTable($arrs);
		return $status;
	}
	public function returnArr($cityInSQL,$res,$level){

		$city=array();
		$citys=array();
		foreach ($res as $key=>$value) {
			if($key%2==0){
				$city[]=$value;
				$cityCode=$value;
				$count=strlen($value);
			}else{
				$citys[$cityCode]=$value;
			}
		}

		if(count($cityInSQL)){
			foreach ($cityInSQL as $key => $value) {
				$code=substr($value['areaId'],0,$count);
				if(in_array($code,$city)){
					$arrdiff=array($code);
					if($citys[$code]!=$value['name']){
						$arrs[]=[
							'id'=>$value['id'],
							'name'=>$citys[$code],
							'year'=>date('Y')-1,
							'olderName'=>$value['name'],
							'remark'=>'名称变更'
						];
					}else{
						$arrs[]=['id'=>$value['id'],];
					}
					$city=array_diff($city, $arrdiff);
					unset($citys[$code]);
				}else{
					$arrs[]=[
						'id'=>$value['id'],
						'delete_time'=>time(),
						'status'=>0,
						'remark'=>'撤销'
					];
				}
			}
		}

		foreach ($citys as $key=>$value) {
			$pid=str_pad(substr($key,0,$level*2),12,'0',STR_PAD_RIGHT);
			$areaId=str_pad($key,12,'0',STR_PAD_RIGHT);
			$arrs[]=[
				'areaId'=>$areaId,
				'pid'=>$pid,
				'year'=>date('Y')-1,
				'level'=>$level,
				'name'=>$value
			];
		}

		return $arrs;
	}
	public function insertTable($arrs){
		
		$cityModel=new City();
		$num=10;
		$limit=ceil(count($arrs)/$num);
		for($i=1;$i<=$limit;$i++){
			$offset=($i-1)*$num;
			$data=array_slice($arrs, $offset,$num);
			$result=$cityModel->saveAll($data);
		}	
		if($result){
			$status=['status'=>1,'msg'=>'更新成功'];
		}else{
			$status=['status'=>0,'msg'=>'更新失败'];
		}
		return $status;
	}
	public function formattedDataD($url,$arr){
		header("Content-Type: text/html;charset=UTF-8");
		// 超时设置
		ini_set('max_execution_time', '0');
		$mh=curl_multi_init();
		$lists=array();
		foreach ($arr as $key => $value) {

			$code=substr($value['areaId'],0,6);
			$urls=$url.substr($code,0,2).'/'.substr($code,2,2).'/'.$code.'.html';
			
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$urls);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_TIMEOUT,10000);
			$lists[$key]=$ch;
			curl_multi_add_handle($mh, $ch);
			
		}
		$active=null;

		do{
			$mrc=curl_multi_exec($mh, $active);
		}while ($mrc==CURLM_CALL_MULTI_PERFORM);
		while($active && $mrc ==CURLM_OK){
			if(curl_multi_select($mh)==-1){
				usleep(1);
			}
			do{
				$mrc=curl_multi_exec($mh, $active);
			}while ($mrc==CURLM_CALL_MULTI_PERFORM);
		}
		$list=array();
		foreach ($lists as $key => $value) {
			$data=curl_multi_getcontent($value);
			
			$data=mb_convert_encoding($data, 'UTF-8','GBK');
			$offset=@mb_strpos($data, 'towntr',2000,'GBK');
			if(!$offset)
				continue;
			$data=mb_substr($data, $offset,NULL,'GBK');
			$offset=mb_strpos($data, '</TABLE>', 200,'GBK');
			$data=mb_substr($data, 0,$offset,'GBK');
			preg_match_all('/\d{12}|[\x7f-\xff]+/',$data, $res);
			$res=$res[0];
			$list=array_merge($list,$res);
			curl_multi_remove_handle($mh, $value);
		}
		curl_multi_close($mh);
		
		return $list;
	}
	public function formattedDataW($url,$arr){
		// var_dump($arr);exit;
		header("Content-Type: text/html;charset=UTF-8");
		// 超时设置
		ini_set('max_execution_time', '0');
		$mh=curl_multi_init();
		$lists=array();
		foreach ($arr as $key => $value) {

			$code=substr($value['areaId'],0,4);
			$urls=$url.substr($code,0,2).'/'.$code.'.html';
			
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$urls);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_HEADER, false);
			curl_setopt($ch,CURLOPT_TIMEOUT,10000);
			$lists[$key]=$ch;
			curl_multi_add_handle($mh, $ch);
			
		}
		$active=null;

		do{
			$mrc=curl_multi_exec($mh, $active);
		}while ($mrc==CURLM_CALL_MULTI_PERFORM);
		while($active && $mrc ==CURLM_OK){
			if(curl_multi_select($mh)==-1){
				usleep(1);
			}
			do{
				$mrc=curl_multi_exec($mh, $active);
			}while ($mrc==CURLM_CALL_MULTI_PERFORM);
		}
		$list=array();
		foreach ($lists as $key => $value) {
			$data=curl_multi_getcontent($value);
			
			$data=mb_convert_encoding($data, 'UTF-8','GBK');
			$offset=@mb_strpos($data, 'countytr',2000,'GBK');
			if(!$offset)
				continue;
			$data=mb_substr($data, $offset,NULL,'GBK');
			$offset=mb_strpos($data, '</TABLE>', 200,'GBK');
			$data=mb_substr($data, 0,$offset,'GBK');
			preg_match_all('/\d{12}|[\x7f-\xff]+/',$data, $res);
			$res=$res[0];
			$list=array_merge($list,$res);
			curl_multi_remove_handle($mh, $value);
		}
		curl_multi_close($mh);
		
		return $list;
	}

	public function formattedData($urls,$name,$exp){
		header("Content-Type: text/html;charset=UTF-8");
		// 超时设置
		ini_set('max_execution_time', '0');

		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $urls);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data=curl_exec($ch);
		curl_close($ch);
		$data = mb_convert_encoding($data,'UTF-8','GBK');
		//裁头
		$offset = mb_strpos($data, "$name",2000,'GBK');

		$data = mb_substr($data, $offset,NULL,'GBK');
		// 裁尾	
		$offset = mb_strpos($data, '</TABLE>', 200,'GBK');
		$data=mb_substr($data, 0,$offset,'GBK');
		preg_match_all($exp,$data, $res);
		return $res;
	}
}