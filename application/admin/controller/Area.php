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
		$mapCountytr=['level'=>2,'status'=>1];
		$countPage=ceil((City::where($mapCountytr)->count())/200);
		for($i=1;$i<=$countPage;$i++){
			$arr[]=$i;
		}
		$map=['level'=>0,'status'=>1];
		$pro=City::where($map)->field('name,areaId')->select();
		$this->assign('page',$arr);
		$this->assign('pro',$pro);
		return view('index');

	}
	public function getCity(){
		$pid=input('post.pid');
		$type=input('post.type');
		 switch ($type){
            case '1':
                $opt='<option>--请选择市区--</option>';
                break;
            case '2':
                $opt='<option>--请选择区县--</option>';
                break;
            case '3':
                $opt='<option>--请选择乡镇--</option>';
                break;
        }
		$map=['pid'=>$pid,'status'=>1];
		$list=City::where($map)->field('name,areaId')->select();
		foreach ($list as $key => $value) {
			$opt .= "<option value='{$value['areaId']}'>{$value['name']}</option>";
		}
		return json($opt);
	}
	
	public function update(){
		$type=input('post.type');
		$page=input('post.page');
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
				$res=$this->upodateTowntr($url,$page);
				break;
			default:
				$res=['msg'=>'系统错误','status'=>0];
                break;
		}
		return json($res);
	}
	public function upodateTowntr($url,$page){
		$status=['status'=>0,'msg'=>'爬取网站数据失败，请稍后再尝试'];
		$page=intval($page);
		$mapCountytr=['level'=>2,'status'=>1];
		$countytr=City::where($mapCountytr)->field('id,areaId,name')->page($page,200)->select();
		foreach ($countytr as $key => $value) {
			$list[]=$value['areaId'];
		}
		$mapTowntr=[['level','=',3],['status','=',1],['pid', 'in', $list]];
		
		$towntr=City::where($mapTowntr)->field('id,areaId,name')->select();
		$res=$this->formattedDataD($url,$countytr,'towntr');

		if(empty($res)){
			return $status;
		}
		$list=$this->returnArr($towntr,$res,3);
		if(empty($list)){
			return $status;
		}
		$status=$this->insertTable($list);
		return $status;
	}
	public function updateCountytr($url){
		$status=['status'=>0,'msg'=>'爬取网站数据失败，请稍后再尝试'];
		$mapCity=['level'=>1,'status'=>1];
		$mapCountytr=['level'=>2,'status'=>1];
		
		$citytr=City::where($mapCity)->field('id,areaId,name')->select();
		$countytr=City::where($mapCountytr)->field('id,areaId,name')->select();
		$res=$this->formattedDataD($url,$citytr,'countytr');
		if(empty($res)){
			return $status;
		}
		$list=$this->returnArr($countytr,$res,2);
		if(empty($list)){
			return $status;
		}
		$status=$this->insertTable($list);
		return $status;
	}

	public function updateCitytr($url){
		$status=['status'=>0,'msg'=>'爬取网站数据失败，请稍后再尝试'];
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
			if(empty($res)||empty($res[0])){
				return $status;
			}
			$res=$res[0];
			$lists=array_merge($lists,$res);
		}
		$list=$this->returnArr($citytr,$lists,1);
		if(empty($list)){
			
			return $status;
		}
		$status=$this->insertTable($list);
		return $status;
	}
	public function updateProvincetr($url){
		$status=['status'=>0,'msg'=>'爬取网站数据失败，请稍后再尝试'];
		$urls=$url.'index.html';
		
		$res=$this->formattedData($urls,'provincetr','/\d{2}|[\x7f-\xff]+/');

		if(empty($res)||empty($res[0])){
			return $status;
		}
		$res=$res[0];
		$map=['level'=>0,'status'=>1];
		
		$provincetr=City::where($map)->field('id,areaId,name')->select();
		$arrs=$this->returnArr($provincetr,$res,0);
		if(empty($arrs)){
			$status=['status'=>1,'msg'=>'已经是最新版的了'];
			return $status;
		}
		$status=$this->insertTable($arrs);
		return $status;
	}
	public function returnArr($cityInSQL,$res,$level){
		$arrs=array();
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
		
		if(!isset($count)){
			return ;
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
					}
					$city=array_diff($city, $arrdiff);
					unset($citys[$code]);
				}else{
					$arrs[]=[
						'id'=>$value['id'],
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
		$num=100;
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
	public function formattedDataD($url,$arr,$type){
		header("Content-Type: text/html;charset=UTF-8");
		// 超时设置
		ini_set('max_execution_time', '0');
		$mh=curl_multi_init();
		$lists=array();
		foreach ($arr as $key => $value) {
			if($type=='towntr'){
				$code=substr($value['areaId'],0,6);
				$urls=$url.substr($code,0,2).'/'.substr($code,2,2).'/'.$code.'.html';
				
			}else{
				$code=substr($value['areaId'],0,4);
				$urls=$url.substr($code,0,2).'/'.$code.'.html';
			}
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
				continue;
			}
			do{
				$mrc=curl_multi_exec($mh, $active);
			}while ($mrc==CURLM_CALL_MULTI_PERFORM);
		}
		$list=array();
		foreach ($lists as $key => $value) {
			$data=curl_multi_getcontent($value);
			
			$data=mb_convert_encoding($data, 'UTF-8','GBK');
			$offset=@mb_strpos($data, "$type",2000,'GBK');
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
		$code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($code===200){
			$data = mb_convert_encoding($data,'UTF-8','GBK');
			//裁头
			$offset = mb_strpos($data, "$name",2000,'GBK');

			$data = mb_substr($data, $offset,NULL,'GBK');
			// 裁尾	
			$offset = mb_strpos($data, '</TABLE>', 200,'GBK');
			$data=mb_substr($data, 0,$offset,'GBK');
			preg_match_all($exp,$data, $res);
			return $res;
		}else{
			return ;
		}
	}
}