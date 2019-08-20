<?php


use think\facade\Request;
/**  
 * 获取客户端浏览器信息
* @return string 浏览器信息
* @author jachin  2019-08-16
*/  
function get_broswer()
{
	$sys =Request::server('HTTP_USER_AGENT');
	$arr=[
		'Firefox'=>array("Firefox","/Firefox\/([^;)]+)+/i"),
		'Maxthon'=>array("傲游","/Maxthon\/([\d\.]+)/"),
		'MSIE'   =>array("IE","/MSIE\s+([^;)]+)+/i"),
		'OPR'    =>array("Opera","/OPR\/([\d\.]+)/"),
		'Edge'   =>array("Edge","/Edge\/([\d\.]+)/"),
		'Chrome' =>array("Chrome","/Chrome\/([\d\.]+)/"),
		'rv:'    =>array("IE","/rv:([\d\.]+)/"),
	];
	$exp[0] = "未知浏览器";
	foreach ($arr as $key => $value) {
		if(stripos($sys, $key) > 0){
			preg_match($value['1'], $sys, $version);  
			$exp[0] = $value[0];  
        	$exp[1] = $version[1]; 
        	break;
		}
	}
	if($exp[0]=='未知浏览器'){
		$exp[1]='';
	}
	 return $exp[0].' '.$exp[1];  
}

/**  
* 获取客户端操作系统信息,包括win10 
* @return string 系统信息
* @author jachin  2019-08-16
*/  
function get_os(){  
	$agent =Request::server('HTTP_USER_AGENT');
   	$os='未知操作系统';
 	$arr=[
 		'Linux'=>'/linux/i',
 		'Unix' =>'/unix/i',
 		'PowerPC'=>'/PowerPC/i',
 		'AIX'  =>'/AIX/i',
 		'HPUX' =>'/HPUX/i',
 		'NetBSD'=>'/NetBSD/i',
 		'BSD'=>'/BSD/i',
 		'OSF1'=>'/OSF1/i',
 		'IRIX'=>'/IRIX/i',
 		'FreeBSD'=>'/FreeBSD/i',
 		'teleport'=>'/teleport/i',
 		'flashget'=>'/flashget/i',
 		'webzip'=>'/webzip/i',
 		'offline'=>'/offline/i',
 		'Windows ME'=>'/win 9x/i',
 		'SunOS'=>'/sun/i',
 		'IBM OS/2'=>'/ibm/i',
 		'Macintosh'=>'/Mac/i',

 		'/win/i',//关联$arrty
 	];
	$arrty=[
	 		'Windows 98'=>'/98/i',
	 		'Windows Vista'=>'/nt 6.0/i',
	 		'Windows 7'=>'/nt 6.1/i',
	 		'Windows 8'=>'/nt 6.2/i',
	 		'Windows 10'=>'/nt 10.0/i',
	 		'Windows XP'=>'/nt 5.1/i',
	 		'Windows 2000'=>'/nt 5/i',
	 		'Windows NT'=>'/nt/i',
	 		'Windows 32'=>'/32/i',
	];
 	foreach ($arr as $key => $value) {
 		if($value=='/win/i'){
 			if(strpos($agent, '95')){
 				 $os = 'Windows 95';
 				 break;
 			}else{
 				foreach ($arrty as $k => $v) {
 					if(preg_match($v, $agent)){
 						$os=$k;
 						break;
 					}
 				}
 			}
 		}else if($value=='/win 9x/i'){
 			if(strpos($agent, '4.90')){
 				$os=$key;
 				break;
 			}
 		}else if($value=='/sun/i'){
 			if(preg_match('/os/i', $agent)){
 				$os=$key;
 				break;
 			}
 		}else if($value=='/ibm/i'){
 			if(preg_match('/os/i', $agent)){
 				$os=$key;
 				break;
 			}
 		}else if($value=='/Mac/i'){
 			if(preg_match('/PC/i', $agent)){
 				$os=$key;
 				break;
 			}
 		}else{
 			if(preg_match($value, $agent)){
 				$os=$key;
 				break;
 			}
 		}
 	}

    return $os;    
}
/**
 * @description  获取IP地址
 * @return string IP地址
 * @author jachin  2019-08-16
 */
function get_IP(){
    static $realIP;
    if(isset($_SERVER)){
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $realIP=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else if(isset($_SERVER['HTTP_CLIENT_IP'])){
            $realIP=$_SERVER['HTTP_CLIENT_IP'];
        }else{
            $realIP=$_SERVER['REMOTE_ADDR'];
        }
    }else{
        if(getenv('HTTP_X_FORWARDED_FOR')){
            $realIP=getenv('HTTP_X_FORWARDED_FOR');
        }else if(getenv('HTTP_CLIENT_IP')){
            $realIP=getenv('HTTP_CLIENT_IP');
        }else{
            $realIP=getenv('REMOTE_ADDR');
        }
    }
    return $realIP;
}
/**
 * @description  获取IP地址
 * @param $actionName 传入行为名  
 * @param $admin_id	  传入用户id
 * @param $remark     传入备注
 * @return string IP地址
 * @author jachin  2019-08-16
 */
function get_log($actionName,$admin_id,$remark=''){
	$action_id=model('Action')->where('actionName',$actionName)->field('id')->find();
	// var_dump($action_id);exit;
	$model=Request::module();
	$data=[
		'action_id'=>$action_id['id'],
		'admin_id' =>$admin_id,
		'IP'       =>get_IP(),
		'browser'  =>get_broswer(),
		'os'	   =>get_os(),
		'remark'   =>$remark,
		'create_time'=>time(),
		'model'    =>$model,
	];
	$res=model('Log')->insert($data);
	return $res;
}
// function get_broswer($glue = null)
// {
	
// 	 return $exp[0].' '.$exp[1];  
//     if (stripos($sys, "Firefox") > 0) {  
//         preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);  
//         $exp[0] = "Firefox";  
//         $exp[1] = $b[1];  	//获取火狐浏览器的版本号  
//     } elseif (stripos($sys, "Maxthon") > 0) {  
//         preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);  
//         $exp[0] = "傲游";  
//         $exp[1] = $aoyou[1];  
//     } elseif (stripos($sys, "MSIE") > 0) {  
//         preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);  
//         $exp[0] = "IE";  
//         $exp[1] = $ie[1];  //获取IE的版本号  
//     } elseif (stripos($sys, "OPR") > 0) {  
//         preg_match("/OPR\/([\d\.]+)/", $sys, $opera);  
//         $exp[0] = "Opera";  
//         $exp[1] = $opera[1];    
//     } elseif(stripos($sys, "Edge") > 0) {  
//         //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配  
//         preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);  
//         $exp[0] = "Edge";  
//         $exp[1] = $Edge[1];  
//     } elseif (stripos($sys, "Chrome") > 0) {  
//         preg_match("/Chrome\/([\d\.]+)/", $sys, $google);  
//         $exp[0] = "Chrome";  
//         $exp[1] = $google[1];  //获取google chrome的版本号  
//     } elseif(stripos($sys,'rv:')>0 && stripos($sys,'Gecko')>0){  
//         preg_match("/rv:([\d\.]+)/", $sys, $IE);  
//         $exp[0] = "IE";  
//         $exp[1] = $IE[1];  
//     }else {  
//         $exp[0] = "未知浏览器";  
//         $exp[1] = "";   
//     }  
//     return $exp[0].' '.$exp[1];  
   

// }



// function get_os(){  
// 	$agent =Request::server('HTTP_USER_AGENT');
//    	$os='未知操作系统';
 	
 	
    // if (preg_match('/win/i', $agent) && strpos($agent, '95'))  
    // {  
    //   $os = 'Windows 95';  
    // }  
    // else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90'))  
    // {  
    //   $os = 'Windows ME';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent))  
    // {  
    //   $os = 'Windows 98';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent))  
    // {  
    //   $os = 'Windows Vista';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent))  
    // {  
    //   $os = 'Windows 7';  
    // }  
    //   else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent))  
    // {  
    //   $os = 'Windows 8';  
    // }else if(preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent))  
    // {  
    //   $os = 'Windows 10';#添加win10判断  
    // }else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent))  
    // {  
    //   $os = 'Windows XP';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent))  
    // {  
    //   $os = 'Windows 2000';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent))  
    // {  
    //   $os = 'Windows NT';  
    // }  
    // else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent))  
    // {  
    //   $os = 'Windows 32';  
    // }  
    // else if (preg_match('/linux/i', $agent))  
    // {  
    //   $os = 'Linux';  
    // }  
    // else if (preg_match('/unix/i', $agent))  
    // {  
    //   $os = 'Unix';  
    // }  
    // else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent))  
    // {  
    //   $os = 'SunOS';  
    // }  
    // else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent))  
    // {  
    //   $os = 'IBM OS/2';  
    // }  
    // else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent))  
    // {  
    //   $os = 'Macintosh';  
    // }  
    // else if (preg_match('/PowerPC/i', $agent))  
    // {  
    //   $os = 'PowerPC';  
    // }  
    // else if (preg_match('/AIX/i', $agent))  
    // {  
    //   $os = 'AIX';  
    // }  
    // else if (preg_match('/HPUX/i', $agent))  
    // {  
    //   $os = 'HPUX';  
    // }  
    // else if (preg_match('/NetBSD/i', $agent))  
    // {  
    //   $os = 'NetBSD';  
    // }  
    // else if (preg_match('/BSD/i', $agent))  
    // {  
    //   $os = 'BSD';  
    // }  
    // else if (preg_match('/OSF1/i', $agent))  
    // {  
    //   $os = 'OSF1';  
    // }  
    // else if (preg_match('/IRIX/i', $agent))  
    // {  
    //   $os = 'IRIX';  
    // }  
    // else if (preg_match('/FreeBSD/i', $agent))  
    // {  
    //   $os = 'FreeBSD';  
    // }  
    // else if (preg_match('/teleport/i', $agent))  
    // {  
    //   $os = 'teleport';  
    // }  
    // else if (preg_match('/flashget/i', $agent))  
    // {  
    //   $os = 'flashget';  
    // }  
    // else if (preg_match('/webzip/i', $agent))  
    // {  
    //   $os = 'webzip';  
    // }  
    // else if (preg_match('/offline/i', $agent))  
    // {  
    //   $os = 'offline';  
    // }  
    // else  
    // {  
    //   $os = '未知操作系统';  
    // }  
    // return $os;    
// }