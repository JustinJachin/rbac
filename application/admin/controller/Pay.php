<?php
namespace app\admin\controller;
use app\admin\controller\Base;
/**
 * 
 */
class Pay extends Base
{
	/* 首先在服务器端调用微信【统一下单】接口，返回prepay_id和sign签名等信息给前端，前端调用微信支付接口 */
    private function Pay($total_fee,$openid,$order_id){
        if(empty($total_fee)){
            echo json_encode(array('state'=>0,'Msg'=>'金额有误'));exit;
        }
        if(empty($openid)){
            echo json_encode(array('state'=>0,'Msg'=>'登录失效，请重新登录(openid参数有误)'));exit;
        }
        if(empty($order_id)){
            echo json_encode(array('state'=>0,'Msg'=>'自定义订单有误'));exit;
        }
        $appid =        '小程序appid';//如果是公众号 就是公众号的appid;小程序就是小程序的appid
        $body =         '自己填';
        $mch_id =       '商户账号';
        $KEY = '你申请微信支付的key';
        $nonce_str =    randomkeys(32);//随机字符串
        $notify_url =   'https://m.******.com/index.php/Home/Xiaoxxf/xiao_notify_url';  //支付完成回调地址url,不能带参数
        $out_trade_no = $order_id;//商户订单号
        $spbill_create_ip = $_SERVER['SERVER_ADDR'];
        $trade_type = 'JSAPI';//交易类型 默认JSAPI
    
        //这里是按照顺序的 因为下面的签名是按照(字典序)顺序 排序错误 肯定出错
        $post['appid'] = $appid;
        $post['body'] = $body;
        $post['mch_id'] = $mch_id;
        $post['nonce_str'] = $nonce_str;//随机字符串
        $post['notify_url'] = $notify_url;
        $post['openid'] = $openid;
        $post['out_trade_no'] = $out_trade_no;
        $post['spbill_create_ip'] = $spbill_create_ip;//服务器终端的ip
        $post['total_fee'] = intval($total_fee);        //总金额 最低为一分钱 必须是整数
        $post['trade_type'] = $trade_type;
        $sign = $this->MakeSign($post,$KEY);              //签名
        $this->sign = $sign;
    
        $post_xml = '<xml>
               <appid>'.$appid.'</appid>
               <body>'.$body.'</body>
               <mch_id>'.$mch_id.'</mch_id>
               <nonce_str>'.$nonce_str.'</nonce_str>
               <notify_url>'.$notify_url.'</notify_url>
               <openid>'.$openid.'</openid>
               <out_trade_no>'.$out_trade_no.'</out_trade_no>
               <spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>
               <total_fee>'.$total_fee.'</total_fee>
               <trade_type>'.$trade_type.'</trade_type>
               <sign>'.$sign.'</sign>
            </xml> ';
    
        //统一下单接口prepay_id
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $xml = $this->http_request($url,$post_xml);     //POST方式请求http
        $array = $this->xml2array($xml);               //将【统一下单】api返回xml数据转换成数组，全要大写
        if($array['RETURN_CODE'] == 'SUCCESS' && $array['RESULT_CODE'] == 'SUCCESS'){
            $time = time();
            $tmp='';                            //临时数组用于签名
            $tmp['appId'] = $appid;
            $tmp['nonceStr'] = $nonce_str;
            $tmp['package'] = 'prepay_id='.$array['PREPAY_ID'];
            $tmp['signType'] = 'MD5';
            $tmp['timeStamp'] = "$time";
    
            $data['state'] = 1;
            $data['timeStamp'] = "$time";           //时间戳
            $data['nonceStr'] = $nonce_str;         //随机字符串
            $data['signType'] = 'MD5';              //签名算法，暂支持 MD5
            $data['package'] = 'prepay_id='.$array['PREPAY_ID'];   //统一下单接口返回的 prepay_id 参数值，提交格式如：prepay_id=*
            $data['paySign'] = $this->MakeSign($tmp,$KEY);       //签名,具体签名方案参见微信公众号支付帮助文档;
            $data['out_trade_no'] = $out_trade_no;
    
        }else{
            $data['state'] = 0;
            $data['text'] = "错误";
            $data['RETURN_CODE'] = $array['RETURN_CODE'];
            $data['RETURN_MSG'] = $array['RETURN_MSG'];
        }
        echo json_encode($data);
    }
    
    /**
     * 生成签名, $KEY就是支付key
     * @return 签名
     */
    public function MakeSign( $params,$KEY){
        //签名步骤一：按字典序排序数组参数
        ksort($params);
        $string = $this->ToUrlParams($params);  //参数进行拼接key=value&k=v
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$KEY;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
    /**
     * 将参数拼接为url: key=value&key=value
     * @param $params
     * @return string
     */
    public function ToUrlParams( $params ){
        $string = '';
        if( !empty($params) ){
            $array = array();
            foreach( $params as $key => $value ){
                $array[] = $key.'='.$value;
            }
            $string = implode("&",$array);
        }
        return $string;
    }
    /**
     * 调用接口， $data是数组参数
     * @return 签名
     */
    public function http_request($url,$data = null,$headers=array())
    {
        $curl = curl_init();
        if( count($headers) >= 1 ){
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    //获取xml里面数据，转换成array
    private function xml2array($xml){
        $p = xml_parser_create();
        xml_parse_into_struct($p, $xml, $vals, $index);
        xml_parser_free($p);
        $data = "";
        foreach ($index as $key=>$value) {
            if($key == 'xml' || $key == 'XML') continue;
            $tag = $vals[$value[0]]['tag'];
            $value = $vals[$value[0]]['value'];
            $data[$tag] = $value;
        }
        return $data;
    }
	/**
     * 将xml转为array
     * @param string $xml
     * return array
     */
    public function xml_to_array($xml){
        if(!$xml){
            return false;
        }
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }

	/* 微信支付完成，回调地址url方法  xiao_notify_url() */
    public function xiao_notify_url(){
        $post = post_data();    //接受POST数据XML个数/*
		function post_data(){    
			$receipt = $_REQUEST;    
			if($receipt==null){        
				$receipt = file_get_contents("php://input");        
				if($receipt == null){            
					$receipt = $GLOBALS['HTTP_RAW_POST_DATA'];       
				}    
			}    
			return $receipt;
		}

        $post_data = $this->xml_to_array($post);   //微信支付成功，返回回调地址url的数据：XML转数组Array
        $postSign = $post_data['sign'];
        unset($post_data['sign']);
        
        /* 微信官方提醒：
         *  商户系统对于支付结果通知的内容一定要做【签名验证】,
         *  并校验返回的【订单金额是否与商户侧的订单金额】一致，
         *  防止数据泄漏导致出现“假通知”，造成资金损失。
         */
        ksort($post_data);// 对数据进行排序
        $str = $this->ToUrlParams($post_data);//对数组数据拼接成key=value字符串
        $user_sign = strtoupper(md5($post_data));   //再次生成签名，与$postSign比较
        
        $where['crsNo'] = $post_data['out_trade_no'];
        $order_status = M('home_order','xxf_witkey_')->where($where)->find();
         
        if($post_data['return_code']=='SUCCESS'&&$postSign){
            /*
            * 首先判断，订单是否已经更新为ok，因为微信会总共发送8次回调确认
            * 其次，订单已经为ok的，直接返回SUCCESS
            * 最后，订单没有为ok的，更新状态为ok，返回SUCCESS
            */
            if($order_status['order_status']=='ok'){
                $this->return_success();
            }else{
                $updata['order_status'] = 'ok';
                if(M('home_order','xxf_witkey_')->where($where)->save($updata)){
                    $this->return_success();
                }
            }
        }else{
            echo '微信支付失败';
        }
    }
    
    /*
     * 给微信发送确认订单金额和签名正确，SUCCESS信息 -xzz0521
     */
    private function return_success(){
        $return['return_code'] = 'SUCCESS';
        $return['return_msg'] = 'OK';
        $xml_post = '<xml>
                    <return_code>'.$return['return_code'].'</return_code>
                    <return_msg>'.$return['return_msg'].'</return_msg>
                    </xml>';
        echo $xml_post;exit;
    }
}







	/*
	* 2020-04-26
	* xulu
	* 提交订单，生成订单
	*/

	public function order(){
		bcscale(2);
		$token=I('token','');
		$address_id=I('address_id',0);//所选地址id
		$product=json_decode(I('product',''),true);//商品id和数量
		$discount_id=I('discount_id',0);//优惠券id
		$freight=I('freight',0);//运费
		$remark=I('remark','');//备注
		$formcart=I('formcart',0);//是否来自购物车0否1是
		// $token=10;
		// $address_id=102;
		// $product=array('4'=>1,'3'=>1);
		// $discount_id=114101;
		if(empty($token)||empty($address_id)||empty($product)){
			$msg['code']=false;
			$msg['mes']='参数错误！';
			$this->ajaxReturn($msg);
		}
		$uid=explode('.',$token)[0];
		//验算商品价格
		$id='';
		foreach ($product as $key => $value) {
			if(empty($id)){
				$id=$key;
			}else{
				$id.=','.$key;
			}
		}
		$map['s.id']=array('in',"$id");
		$specs=M('product_specs');
		$list=$specs->alias('s')->join('__PRODUCT__ AS p ON s.product_id=p.id')->field('s.id,s.cid,s.product_id,p.main_images,p.title,p.description,s.inventory,s.sell_price')->where($map)->select();
		if(empty($list)){
			$msg['code']=false;
			$msg['mes']='获取商品信息出错！';
			$this->ajaxReturn($msg);
		}
		$total=0;
		foreach ($list as $key => $value) {
			$list[$key]['num']=$product[$value['id']];
			if($list[$key]['num']>$value['inventory']){
				$msg['code']=false;
				$msg['mes']=$value['title'].'库存不足';
				$this->ajaxReturn($msg);
			}
			$total=bcadd($total,bcmul($value['sell_price'],$list[$key]['num']));
		}
		//优惠
		if($discount_id){
			$map_r['r.id']=$discount_id;
			$map_r['r.uid']=$uid;
			$map_r['r.status']=2;
			$map_r['r.limit_time']=array('egt',date('Y-m-d H:i:s'));
			$map_r['c.full']=array('elt',$total);
			$map_r['c.status']=2;
			$dis=M('redeem')->alias('r')->join('__COUPON__ AS c ON r.coupon_code=c.coupon_code')->field('r.id,c.coupon_type,c.terrace,c.full,c.minus,c.range,c.cate_id,c.product_id')->where($map_r)->find();
			if(empty($dis['id'])){
				$msg['code']=false;
				$msg['mes']='当前商品不满足该优惠券使用条件';
				$this->ajaxReturn($msg);
			}
			if(in_array('1',explode(',',$dis['terrace']))){
				//可以在小程序使用
				$all=0;
				if($dis['range']=='0'){
					//指定
					if($dis['cate_id']){
						$cate_id=explode(',',$dis['cate_id']);
						if($dis['product_id']){
							//同时限制分类商品
							$product_id=explode(',',$dis['product_id']);
							foreach ($list as $k => $v) {
								if(in_array($v['cid'],$cate_id)&&in_array($v['product_id'],$product_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}else{
							//仅限制分类
							foreach ($list as $k => $v) {
								if(in_array($v['cid'],$cate_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}
					}else{
						if($dis['product_id']){
							//仅限制商品
							$product_id=explode(',',$dis['product_id']);
							foreach ($list as $k => $v) {
								if(in_array($v['product_id'],$product_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}else{
							//作废
							$all=0;
						}
					}
				}elseif($dis['range']=='1'){
					//排除
					if($dis['cate_id']){
						$cate_id=explode(',',$dis['cate_id']);
						if($dis['product_id']){
							//同时限制分类商品
							$product_id=explode(',',$dis['product_id']);
							foreach ($list as $k => $v) {
								if(in_array($v['cid'],$cate_id)&&in_array($v['product_id'],$product_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}else{
							//仅限制分类
							foreach ($list as $k => $v) {
								if(in_array($v['cid'],$cate_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}
					}else{
						if($dis['product_id']){
							//仅限制商品
							$product_id=explode(',',$dis['product_id']);
							foreach ($list as $k => $v) {
								if(in_array($v['product_id'],$product_id)){
									$all=bcadd(bcmul($v['sell_price'],$product[$v['id']]),$all);
								}
							}
						}else{
							//全部
							$all=0;
						}
					}
					$all=bcsub($total,$all);
				}else{
					//全部
					$all=$total;
				}
				if($dis['coupon_type']=='1'){
					//满减券
					if($all>=$dis['full']){
						$discount_id=$dis['id'];
						$discounts=$dis['minus'];
					}else{
						$msg['code']=false;
						$msg['mes']='总金额不满足优惠券使用条件';
						$this->ajaxReturn($msg);
					}
				}elseif($dis['coupon_type']=='2'){
					//满折券
					if($all>=$dis['full']){
						$minus=bcsub($all,bcdiv(bcmul($all,$dis['minus']),'10'));
						$discount_id=$dis['id'];
						$discounts=$minus;
					}else{
						$msg['code']=false;
						$msg['mes']='总金额不满足优惠券使用条件';
						$this->ajaxReturn($msg);
					}
				}else{
					$msg['code']=false;
					$msg['mes']='当前商品不满足该优惠券使用条件';
					$this->ajaxReturn($msg);
				}
			}else{
				$msg['code']=false;
				$msg['mes']='该优惠券不可在小程序中使用';
				$this->ajaxReturn($msg);
			}
		}else{
			$discount_id=0;
			$discounts=0;
		}
		$total=bcsub($total,$discounts);
		//运费
		$freight=0;
		$total=bcadd($total,$freight);
		//检查金额是否由于优惠小于0
		if($total<=0){
			$total=$original=0.01;
			$discounts=bcsub($discounts,'0.01');
		}
		//生成订单号
		$nowtime=time();
		$data['order_num']='YS'.$nowtime.mt_rand(1000,9999);
		$data['user_id']=$uid;
		$data['order_type']=1;//订单类型，先默认为普通订单
		$data['order_status']=1;//订单状态
		$data['address_id']=$address_id;
		$data['remark']=$remark;
		$data['discount_id']=$discount_id;//优惠券id
		$data['discounts']=$discounts;//优惠金额
		$data['freight']=$freight;//运费
		$data['total']=$total;//总金额
		$data['expiration_time']=date('Y-m-d H:i:s',$nowtime+30*60);//最晚付款时间
		$data['create_time']=$data['update_time']=date('Y-m-d H:i:s');
		M()->startTrans();//开启事务
		$rel=M('order')->add($data);
		if($rel){
			foreach ($list as $key => $value) {
				$dataList[]=array('oid'=>$rel,'pid'=>$value['id'],'sid'=>0,'num'=>$value['num'],'price'=>$value['sell_price'],'preferential_id'=>0,'preferential_price'=>0,'carriage'=>0,'create_time'=>date('Y-m-d H:i:s'));
			}
			$res=M('product_order')->addAll($dataList);
			if(!$res){
				$msg['code']=false;
				$msg['mes']='记录商品信息失败！';
				$this->ajaxReturn($msg);
			}
		}else{
			$msg['code']=false;
			$msg['mes']='创建订单失败！';
			$this->ajaxReturn($msg);
		}
		//发起请求，生成预支付交易单
		//先获取openid
		$map_u['id']=$uid;
		$map_u['status']=1;
		$rel_u=M('user')->field('id,openid')->where($map_u)->find();
		if(empty($rel_u['openid'])){
			$msg['code']=false;
			$msg['mes']='获取openid失败！';
			$this->ajaxReturn($msg);
		}
		$appid='wxf3984f491a226c3b';
		$mch_id='1582806371';
		$nonce_str=GetRandStr(30);
		$body='源膳-网上商城';
		$out_trade_no=$data['order_num'];//订单号
		$total_fee=intval(bcmul($total,'100'));//支付金额，单位 分
		$spbill_create_ip=get_client_ip();//ip
		$time_start=date('YmdHis',$nowtime);
		$time_expire=date('YmdHis',$nowtime+30*60);
		$notify_url='https://www.omeals.cn/home/order/wxpay.html';
		$trade_type='JSAPI';
		$openid=$rel_u['openid'];
		$key='2020yuanshan0305086800YS01102003';
		$stringSignTemp='appid='.$appid.'&body='.$body.'&mch_id='.$mch_id.'&nonce_str='.$nonce_str.'&notify_url='.$notify_url.'&openid='.$openid.'&out_trade_no='.$out_trade_no.'&spbill_create_ip='.$spbill_create_ip.'&time_expire='.$time_expire.'&time_start='.$time_start.'&total_fee='.$total_fee.'&trade_type='.$trade_type.'&key='.$key;
		$sign=strtoupper(md5($stringSignTemp));//签名
		$url='https://api.mch.weixin.qq.com/pay/unifiedorder';
		$post_xml='
		<xml>
		<appid>'.$appid.'</appid>
		<mch_id>'.$mch_id.'</mch_id>
		<nonce_str>'.$nonce_str.'</nonce_str>
		<body>'.$body.'</body>
		<out_trade_no>'.$out_trade_no.'</out_trade_no>
		<total_fee>'.$total_fee.'</total_fee>
		<spbill_create_ip>'.$spbill_create_ip.'</spbill_create_ip>
		<time_start>'.$time_start.'</time_start>
		<time_expire>'.$time_expire.'</time_expire>
		<notify_url>'.$notify_url.'</notify_url>
		<trade_type>'.$trade_type.'</trade_type>
		<openid>'.$openid.'</openid>
		<sign>'.$sign.'</sign>
		</xml>
		';
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
		curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
		curl_setopt($curl,CURLOPT_POST,1);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post_xml);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
		$output=curl_exec($curl);
		curl_close($curl);
		$array_output=xml2array($output);
		$dota2=array();
		if($array_output['RETURN_CODE']=='SUCCESS'&&$array_output['RESULT_CODE']=='SUCCESS'){
			M()->commit();
			//生成支付订单号订单号，插入订单表
			$dota['oid']=$rel;
			$dota['user_id']=$uid;
			$dota['pay_num']='YSWX'.$nowtime.mt_rand(1000,9999);
			$dota['prepay_id']=$array_output['PREPAY_ID'];
			$dota['pay_type']=1;//微信支付
			$dota['pay_money']=$total;
			$dota['create_time']=date('Y-m-d H:i:s');
			$dota['status']=0;//待付款
			$rel_pay=M('payment')->add($dota);
			if(!$rel_pay){
				$msg['code']=false;
				$msg['mes']='创建预支付交易单失败！';
				$this->ajaxReturn($msg);
			}
			//生成发起支付所需参数
			$dota2['timeStamp']="$nowtime";
			$dota2['nonceStr']=GetRandStr(30);
			$dota2['package']='prepay_id='.$array_output['PREPAY_ID'];
			$dota2['signType']='MD5';
			//生成新的签名
			$paySign = strtoupper(md5('appId='.$appid.'&nonceStr='.$dota2['nonceStr'].'&package='.$dota2['package'].'&signType=MD5&timeStamp='.$dota2['timeStamp'].'&key='.$key));
			$dota2['paySign']=$paySign;
		}else{
			M()->rollback();
			$msg['code']=false;
			$msg['mes']='通信标识：'.$array_output['RETURN_MSG'].'；交易标识：【错误代码：'.$array_output['ERR_CODE'].'，错误代码描述：'.$array_output['ERR_CODE_DES'].'】。';
			$this->ajaxReturn($msg);
		}
		//根据地址id获取地址信息
		$map_d['id']=$address_id;
		$map_d['uid']=$uid;
		$address=M('address')->field('id,name,mobile,province,city,county,area')->where($map_d)->find();
		if(empty($address['id'])){
			$msg['code']=false;
			$msg['mes']='获取地址信息失败！';
			$this->ajaxReturn($msg);
		}
		$address['province']=get_city_name($address['province']);
		$address['city']=get_city_name($address['city']);
		$address['county']=get_city_name($address['county']);
		if($formcart){
			//来自购物车，生成订单后删除购物车的商品
			$map_c['uid']=$uid;
			$map_c['specs_id']=array('in',"$id");
			M('product_car')->where($map_c)->delete();
		}
		$order['id']=$rel;
		$order['order_num']=$data['order_num'];
		$order['total']=$total;
		$order['expiration_time']=$data['expiration_time'];
		$order['address']=$address;
		$order['product']=$list;
		$order['pay']=$dota2;
		if($original){
			$order['original']='优惠金额已超过订单金额，现以强制转化为0.01元以便于完成支付';
		}
		$msg['code']=true;
		$msg['mes']=$order;
		$this->ajaxReturn($msg);
	}
	/*
	* 2020-04-28
	* xulu
	* 订单的回调页面
	*/

	public function wxpay(){
		//获取接口数据，如果$_REQUEST拿不到数据，则使用file_get_contents函数获取
	    $post = $_REQUEST;
	    if ($post == null) {
	        $post = file_get_contents("php://input");
	    }
	 
	    if ($post == null) {
	        $post = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
	    }
	 
	    if (empty($post) || $post == null || $post == '') {
	        //阻止微信接口反复回调接口
	        $str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';  
	        echo $str;
	        exit('Notify 非法回调');
	    }
	 
	    /*****************微信回调返回数据样例*******************
	     $post = '<xml>
	        <return_code><![CDATA[SUCCESS]]></return_code>
	        <return_msg><![CDATA[OK]]></return_msg>
	        <appid><![CDATA[wx2421b1c4370ec43b]]></appid>
	        <mch_id><![CDATA[10000100]]></mch_id>
	        <nonce_str><![CDATA[IITRi8Iabbblz1Jc]]></nonce_str>
	        <sign><![CDATA[7921E432F65EB8ED0CE9755F0E86D72F]]></sign>
	        <result_code><![CDATA[SUCCESS]]></result_code>
	        <prepay_id><![CDATA[wx201411101639507cbf6ffd8b0779950874]]></prepay_id>
	        <trade_type><![CDATA[APP]]></trade_type>
	        </xml>';
	     *************************微信回调返回*****************/
	 	
	    $xml = xmlToArray($post);
	    
	    $post_data = (array)$xml;
	    
	    /** 解析出来的数组
	        *Array
	        * (
	        * [appid] => wx1c870c0145984d30
	        * [bank_type] => CFT
	        * [cash_fee] => 100
	        * [fee_type] => CNY
	        * [is_subscribe] => N
	        * [mch_id] => 1297210301
	        * [nonce_str] => gkq1x5fxejqo5lz5eua50gg4c4la18vy
	        * [openid] => olSGW5BBvfep9UhlU40VFIQlcvZ0
	        * [out_trade_no] => fangchan_588796
	        * [result_code] => SUCCESS
	        * [return_code] => SUCCESS
	        * [sign] => F6890323B0A6A3765510D152D9420EAC
	        * [time_end] => 20180626170839
	        * [total_fee] => 100
	        * [trade_type] => JSAPI
	        * [transaction_id] => 4200000134201806265483331660
	        * )
	    **/
	    if($post_data['return_code'] == 'SUCCESS'){
	    	//订单号
		    $out_trade_no = isset($post_data['out_trade_no']) && !empty($post_data['out_trade_no']) ? $post_data['out_trade_no'] : 0;
		    //查询订单信息
		    $dota=date('Y-m-d H:i:s');
		    $map['order_num']=$out_trade_no;
		    $order=M('order');
		    $info=$order->field('id,user_id,order_status,total,discount_id,expiration_time')->where($map)->find();
		    if($info['order_status']=='1'){
		    	$map_p['oid']=$info['id'];
				$payment=M('payment');
		    	//订单还未处理，先验证签名与金额
		    	$key='2020yuanshan0305086800YS01102003';
		    	//接收到的签名
		        $post_sign = $post_data['sign'];
		        unset($post_data['sign']);
		        //重新生成签名
		        $newSign = MakeSign($post_data,$key);
		        if($post_sign == $newSign){
		        	if($post_data['result_code'] == 'SUCCESS'){
		        		if($post_data['total_fee'] == $info['total']*100){
		        			//修改订单相关信息并返回给微信，付款成功，核销优惠券
				        	$data['order_status']=2;
				        	$data['update_time']=$dota;
				        	M()->startTrans();//开启事务
				        	$rel_o=$order->where($map)->save($data);
				        	$dota2['status']=1;
				        	$dota2['transaction_id']=$post_data['transaction_id'];//保存微信方订单号
				        	$dota2['pay_time']=$dota;
				        	$dota2['update_time']=$dota;
				        	$rel_p=$payment->where($map_p)->save($dota2);
				        	if($info['discount_id']>0){
				        		$map_r['id']=$info['discount_id'];
					        	$dota3['status']=3;
					        	M('redeem')->where($map_r)->save($dota3);
				        	}
				        	//减少相应的库存
				        	$map_po['oid']=$info['id'];
				        	$list=M('product_order')->field('id,pid,num')->where($map_po)->select();
				        	$specs=M('product_specs');
				        	foreach ($list as $key => $value) {
				        		$map_s['id']=$value['pid'];
				        		$specs->where($map_s)->setDec('inventory',$value['num']);
				        	}
				        	//增加累计消费金额
				        	$map_u['id']=$info['user_id'];
				        	M('user')->where($map_u)->setInc('consumption',$info['total']);
				        	if($rel_o&&$rel_p){//暂缺添加自动收货时间
				        		M()->commit();
				        		$str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';  
				        		echo $str;
				        		exit('订单已付款成功');
				        	}else{
				        		M()->rollback();
				        		$str='<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[订单状态同步失败]]></return_msg></xml>';  
				        		echo $str;
				        		exit('订单状态同步失败');
				        	}
		        		}else{
		        			//订单金额不对，不作回应
		        			exit('订单金额不对');
		        		}
		        	}else{
		        		//付款失败
		        		//修改订单相关信息并返回给微信
		        		//判断订单是否超时，超时则取消订单，否则不改变
		        		if($dota>$info['expiration_time']){
		        			$data['order_status']=6;
			        		$data['update_time']=$dota;
			        		$rel_o=$order->where($map)->save($data);
			        		$dota2['status']=2;
			        		$dota2['update_time']=$dota;
			        		$rel_p=$payment->where($map_p)->save($dota2);
			        		if($rel_o&&$rel_p){
				        		$str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';  
				        		echo $str;
				        		exit('订单已成功取消');
				        	}else{
				        		$str='<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[订单状态同步失败]]></return_msg></xml>';  
				        		echo $str;
				        		exit('订单状态同步失败');
				        	}
		        		}else{
		        			$str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';  
				        	echo $str;
				        	exit('订单还未超时，等待用户重新发起支付');
		        		}
		        	}
		        }else{
		        	//签名不对，不作回应
		        	exit('签名不对');
		        }
		    }else{
		    	//订单不存在或订单状态已变更或订单超时已取消，返回成功但不修改数据库以阻止继续回调
		    	$str='<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';  
		        echo $str;
		        exit('订单不存在或订单已处理');
		    }
	    }else{
	    	exit($post_data['return_msg']);
	    } 
	}