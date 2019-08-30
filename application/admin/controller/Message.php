<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use Qcloud\Sms\SmsMultiSender;
use Qcloud\Sms\SmsSenderUtil;
use Qcloud\Sms\SmsSingleSender;
use think\Request;

/**
 * 短信控制器
 * @author jachin <jachin@qq.com>
 */

class Message extends Base{
	/**
     * @description  获取短信页面
     * @author jachin  2019-08-26
     */
	public function index(){
		return view('index');
	}

	/**
     * @description  发送短信
     * @return string json格式数据
     * @author jachin  2019-08-27
     */
	public function getData(){

		$telephone=input('post.telephone');
		$appId=config('MESSAGE_APPID');
		$appKey=config('MESSAGE_APPKEY');
		$templateId = config('MESSAGE_YEMPLATEID');  // NOTE: 这里的模板 ID`7839`只是示例，真实的模板 ID 需要在短信控制台中申请
		$smsSign = config('MESSAGE_SIGN'); 
		$params =[$this->getTelCode($telephone)];

		try{
			if(empty($telephone)||empty($params)){
				$res=[
					'msg'=>'请输入手机号',
					'status'=>0,
				];
				return json($res);
			}
			$ssender = new SmsSingleSender($appId, $appKey);
			
			$result = $ssender->sendWithParam("86", $telephone, $templateId,$params, $smsSign, "", "");
			$dataRes=json_decode($result,true);
			
			if($dataRes['result']==0){
				$res=[
					'msg'=>'短信已发送',
					'status'=>1,
					'tel'=>$telephone,
				];
				
			}else{
				$res=[
					'msg'=>'发送失败',
					'status'=>0,
				];
			}
			return json($res);
		}catch(\Exception $e){
			$res=[
					'msg'=>'系统错误',
					'status'=>0,
				];
			return json($res);
		}
	}

	/**
     * @description  获取短信验证码，并存入redis中
     * @param  int $telephone 手机号
     * @return string 验证码
     * @author jachin  2019-08-27
     */
	public function getTelCode($telephone){
		$redis=connectRedis();
		$timeOut=7200;
		$params=strval(rand(100000,999999));
		$redis->set($telephone,$params);
		$redis->settimeout($telephone, $timeOut);
		return $params;
	}
	/**
     * @description  验证验证码和手机号
     * @param  int $telephone 手机号 
     * @param  string $telCode 验证码
     * @return bool 返回bool值 
     * @author jachin  2019-08-27
     */
	public function checkTelCode($telephone,$telCode){
		$redis=connectRedis();
		$res=$redis->get($telephone);
		if(empty($res)){
			return false;
		}
		if($res===$telCode){
			return true;
		}else{
			return false;
		}
	}
	/**
     * @description  验证验证码和手机号
     * @param  int $telephone 手机号 
     * @param  string $telCode 验证码
     * @return string 返回json格式
     * @author jachin  2019-08-27
     */
	public function checkPhoneAndCode(){
		// $telephone=$request->param();
		$telephone=input('post.telephone');
		$telCode=input('post.telCode');
		
		$res=$this->checkTelCode($telephone,$telCode);
		if($res){
			$status=[
				'status'=>1,
				'msg'=>'验证成功',
			];
		}else{
			$status=[
				'status'=>0,
				'msg'=>'验证失败',
			];
		}
		return json($status);
	}
}