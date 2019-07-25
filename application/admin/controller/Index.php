<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\facade\Request;
class Index extends Base
{
    public function index()
    {

        // echo trim(substr(Request::path(),strpos(Request::path(),'/')),'/');exit;
        $weather=$this->getUrl("https://www.tianqiapi.com/api/?version=v1");
        $weatherData=array();
        foreach($weather as $k=>$v){
            if($k=='city'){
                $city=$v;
            }
            if(is_array($v)){
                foreach($v as $key=>$val){
                    if($key===0){
                        $date=$val['date'];
                    }
                    $weatherData[$key]['week']=$val['week'];
                    $weatherData[$key]['wea']=$val['wea'];
                    $weatherData[$key]['wea_img']='wi-'.$val['wea_img'];
                    $weatherData[$key]['tem']=$val['tem'];
                    $weatherData[$key]['id']=$key;

                }
            }
        }

        $this->assign('vo',$weatherData);
        $this->assign('vodate',$date);
        $this->assign('title','后台首页');
        $this->assign('vocity',$city);
        return view('index');
    }

    // private function getIP(){
    //     static $realip;
    //     if(isset($_SERVER)){
    //         if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
    //             $realip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    //         }else if(isset($_SERVER['HTTP_CLIENT_IP'])){
    //             $realip=$_SERVER['HTTP_CLIENT_IP'];
    //         }else{
    //             $realip=$_SERVER['REMOTE_ADDR'];
    //         }
    //     }else{
    //         if(getenv('HTTP_X_FORWARDED_FOR')){
    //             $realip=getenv('HTTP_X_FORWARDED_FOR');
    //         }else if(getenv('HTTP_CLIENT_IP')){
    //             $realip=getenv('HTTP_CLIENT_IP');
    //         }else{
    //             $realip = getenv("REMOTE_ADDR");
    //         }
    //     }
    //     return $realip;
    // }
    private function getUrl($data){
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $city=file_get_contents($data, false, stream_context_create($arrContextOptions));
        return json_decode($city,true);
    }

}
