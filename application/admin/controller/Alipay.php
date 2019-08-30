<?php
namespace app\admin\controller;

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/extend/alipay/pagepay/service/AlipayTradeService.php';
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/extend/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';


class Alipay extends Base{

	// public $config = array (
    //     //应用ID,您的APPID。
    //        'app_id' => "2016092100559401",

    //        //商户私钥
    //        'merchant_private_key' => "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCGGBdZtZIiKoy5SF9BDimD18kmF/sCHx/lOxjn7ZqZ9S4CW7P0QItswi1F1qGB39Wg+HD4tCSt0Mrxa6NDHOqlggit3/so/FOMhparZyhjiVva1n+H4yhjDp2pLybJzhCsGno0JCqDVTMe3jA3oVPArY59IqSWxzMCEdo0uEbu09rTQxg5oWDLRAgFIBCr1PxLgF2GMOc65EkJ18WFkyfBiQO03enJm+uQWQuukFxbWU6mcUAv2gkVpYfGszWQNKKnBMKdh2meOgtPbGFI/Ka81QmIIPMZjaWtY51vZnTChedy3jr/w7sIiOdVBtD9yAdUzUsWrmAED9co437N2rdXAgMBAAECggEANNNkz4iCK0eL7KogLGbB4BiwO3uS/QD59bpUU3n9P82g9Hjf6cdLperRHwQw2BMv+5wkFTYShQ8OBBGdXaEUp2MUvDrSnRDacS/MR3X6KUxBjXKXBxdsH6nwXmge5b1yP/qmTcg5n0d/PhfV8vRxJCS7T3zITkXnSFd0GPTHrOniMi6DgDrW7/pmO8HZrGpMKXvrvB8iI0MrNV9t9LxmTq9WF6U218n5XO7VET1ELiruBvxZvlpLVtfALP7fUO3YRreC3s3mXBkyv8L8+GKi7uWEy6ID17Z2FfD3OLL+c8KIdYKNyl+QSxY8rahZUbo4r9klN+wBa8jBvXGJ0zt7sQKBgQDNpw46VyIJsebHOxCzd4a509jxfdWmF6LBKGHPsSU6g+3n6ddLZw8IXGpbcqtGk2RhHKKPIVUBUo/imM9i3PHMeAkhrTg33sBLcnePM0WoRZxYld37HVDJaTG9n0jt63pwZEitRYsRLATmcVteVjnQaerUs3CnwdBkZFsYr10zHQKBgQCm7DlpRTagtEB+8EEBzM6uJw850d8rJB2XlOLwX+XvMXP0R5yi5YHKXYQs6Vq6pJEn0qSzr/HTsa6NjZCRouOOVG0bQQOviWuZ+eR+C/Y47rgmHfYbw2sl9HGFSYT0VwuAp6F6pARSlAH+MX8nwGiSKOsE2AjG9KquD4+k/vc2AwKBgBFL4550haBbHhXTmev+OY6Xir+E3dtCUaX9R3y4YXEyd2fx+vGUkWcanrdiRZWCAAdK6UEwhH2/++oLACZIfu27iskSUJAiY/n0fqnEni8w651nvWvJY2oNNunD49Ze38VkKdio6LFhCmh3UD/28JXe0qlhDjCN1IEdD6xb03LhAoGAA+zICM6k0zCJ17JEhQtQzM2EUSK7MaN+wqKwl2BZ4r7x8AuDBl2JKL38LqYqCPt3ok0UrFj1wbmK1i8+9/2xhhY8Hojv0j/T9OHoWoJjfsE2OUc5EzwMF+9gf/bTln85eQP4Cw8yPtLWHSkCyWd/zfgCVrHRuwPjw4YAJawNGgsCgYEAunRgC7lOTwJ5ELmBKUW36UiLUdO61s8KhfJhn8XWP9FDRP0mN0zsr9BG2NmrtMnu5+F/B4r6wYKJg9Y41A21g2sS3nUZ5V6udqd73rsRmVwsqKds2OMkHxosyVgVFGAz8uHTJQzhvKnHMqh1mTfBACigv5QV+1wVNonEpDPctZs=",

    //        //异步通知地址
    //        'notify_url' => "http://www.fcc.cn/index.php/admin/alipay/notify",
    //        // 'notify_url' => "http://www.fcc.cn/index.php/alipay/notify_url.php",

    //        //同步跳转
    //        // 'return_url' => "http://www.fcc.cn/index.php/alipay/return_url.php",
    //        'return_url' => "http://www.fcc.cn/index.php/admin/alipay/returnfy",

    //        //编码格式
    //        'charset' => "UTF-8",

    //        //签名方式
    //        'sign_type' => "RSA2",

    //        //支付宝网关
    //        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    //        'alipay_public_key' => 
    //        "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAybaiQBvlbn9y6+p6V/BC5LWW6KWvXLMEbzYp0WTKT6FIdAYqElj3W+X3ErWipM3Q8+MRg9T+A4Sce3DJmVaMnDUqPJUpMETnnMRMj67B9XJtlHUMNUw7qaA6d4ZWPsrPvqk1epL/OGTPCJVlIWAJ4kZGhy007Mg1olS37qWqoaN8XAfuVuffdcq2Qtxt5xHw0954hBn3oG1L7h+LuKh0JFMVfBNMKfiXl8/Jx74QFL35nTi82Tx5BMLxzVxb0tfIyLZrnT++2HBEoMyuf+FPggYyFk0xvgo6+quhDHF/DtMgBMnlKDmkhqGbmlNyye9olXdHc8zrtMHHEuo5bp/VAQIDAQAB",
    // );

   public function index(){

       //获取订单生成后传递过来的订单编号和金额
       $data=input('param.');
       //halt($data);


       //商户订单号，商户网站订单系统中唯一订单号，必填
       $out_trade_no = '123123201908122021';

       //订单名称，必填
       $subject = "服装";

       //付款金额，必填
       $total_amount = 10;

       //商品描述，可空
       $body = "111";

       //构造参数
       $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
       $payRequestBuilder->setBody($body);
       $payRequestBuilder->setSubject($subject);
       $payRequestBuilder->setTotalAmount($total_amount);
       $payRequestBuilder->setOutTradeNo($out_trade_no);
       $config=config('ALIPAY_CONFIG');
       
       $aop = new \AlipayTradeService($config);
       // var_dump($aop);exit;

       /**
        * pagePay 电脑网站支付请求
        * @param $builder 业务参数，使用buildmodel中的对象生成。
        * @param $return_url 同步跳转地址，公网可以访问
        * @param $notify_url 异步通知地址，公网可以访问
        * @return $response 支付宝返回的信息
        */
       $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
       var_dump($response);exit;

   }


   public function notify(){
       $config=config('ALIPAY_CONFIG');
       $arr=$_POST;
       $alipaySevice = new \AlipayTradeService($config);
       $alipaySevice->writeLog(var_export($_POST,true));
       $result = $alipaySevice->check($arr);

       /* 实际验证过程建议商户添加以下校验。
       1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
       2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
       3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
       4、验证app_id是否为该商户本身。
       */
       if($result) {//验证成功
           /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           //请在这里加上商户的业务逻辑程序代


           //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

           //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

           //商户订单号

           $out_trade_no = $_POST['out_trade_no'];

           //支付宝交易号

           $trade_no = $_POST['trade_no'];

           //交易状态
           $trade_status = $_POST['trade_status'];


           if($_POST['trade_status'] == 'TRADE_FINISHED') {

               //判断该笔订单是否在商户网站中已经做过处理
               //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
               //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
               //如果有做过处理，不执行商户的业务程序

               //注意：
               //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
           	echo 222;
           }
           else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
               //判断该笔订单是否在商户网站中已经做过处理
               //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
               //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
               //如果有做过处理，不执行商户的业务程序
               //注意：
               //付款完成后，支付宝系统发送该交易状态通知
           	echo 1111;
           }
           //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
           echo "success";    //请不要修改或删除
       }else {
           //验证失败
           echo "fail";

       }
   }

   public function returnfy(){
       $arr=$_GET;
       // var_dump($arr);exit;
        $config=config('ALIPAY_CONFIG');
       $alipaySevice = new \AlipayTradeService($config);
       $result = $alipaySevice->check($arr);

       /* 实际验证过程建议商户添加以下校验。
       1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
       2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
       3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
       4、验证app_id是否为该商户本身。
       */
       if($result) {//验证成功
           /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           //请在这里加上商户的业务逻辑程序代码

           //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
           //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

           //商户订单号
           $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

           //支付宝交易号
           $trade_no = htmlspecialchars($_GET['trade_no']);

           //将订单表中的支付状态更改为已支付，并将支付宝交易号写入数据表中
           // Db::table('sp_order')->where('sn',$out_trade_no)->update(['pay_status'=>1,'alipay'=>$trade_no]);

           $this->success('支付成功，跳转中...','index/index');

           //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

           /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       }
       else {
           //验证失败
           echo "验证失败";
       }
   }


	
// 	public function index(){
// 	   header("Content-type:text/html;charset=utf-8");
//        // $data = input('post.');
//        $config = array(
//            //应用ID,您的APPID。
//            'app_id' => "2016092900619970",

//            //商户私钥
//            'merchant_private_key' => "MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCFj6sXDQaGwzjJHxuB+iQvx1MwBbhUXnOV7j1vMq7vXVs1p+Xf9Be+y+bvGhNj2UAtJvHT5PXOvhP5m4uG5KYZ85eaUkbTaKn844eodAIuopYZse2vkgB1GGYovXzVWIulQsWoGJdDF8IjWAcICIU5OusFymP/4HFily50Bn+9m1sFfMC4KMdpvNxslgPt4yByv0w8IdEO5O4Wfol4iVXhDgGJATi0surCFy0DUX8sdyC0a5YYFiDzq5mi0ZYFDXOPK2HnjLrnRsp3OZNevhD5JowNdo3R6Me0+KdjA8lhwDs9Rb8tJ495XT1rVqdpp8TW7rWOGcye5zm4T3h3tpIPAgMBAAECggEAAthQmKkaXnyCFSaoe1hMtQfV6cv1ZTat15+/h0LZHxgp/TaaWu7kIphNTwKLLzFNgKi3tf/GjKTX4BVEH5d3Qk5CCHOANrigBlcCaMAv27Zy5BE6Muc1Q0lFw9BlfFXqg5ashywe7Lrw07foTm+ABvwOTY1GHAk34RW/U5Ff3zYMFXO+Rh2XzzBcU7xPiNK78R4FHl9NSS3BwVUXbVczZ1vs42IMIuW4Caopwp+NL6kolwbLVIPw0yQTc5QaH5eIkg3FlUevTDRKnOg2MkTnc7f4ufhyWwgGDbquGW7+ca0AyptBlOAKmgMx9ZjOPU4hntfUgQpNYy8s6dRSn+ZAwQKBgQC7YtGMgPFaQx53tRUZf7XlOp+kk73GFnBUoAobLwS4dVHzDXyRnO4QGmpEtsbBGP2cyWsXIuHGd4cFNHk3O03mLElEwixEMD4ZeihpbtM5Iqjjjf8BZ5ExLAlQskYz4SzTUYEy+YKJXBJaGxIZMubdjVH50u6PjEd3V1RBaQxCaQKBgQC2d2wrzljQxEuYC73un6PsBp4lBLzcq5xnwATLu3dGZUGDPV0hawzvToPvfXKSNYU0qdTJK553/ouIBkRAxQsTVIRKEJsKLHkjMtRyGeSoxzFKQCszwTH6tM/UGirmzPa2esvZMp0NErGWJfMqEUaaFrupO8Eqdke37NuXG7UxtwKBgF9EWzLqr0nri8biamq/UhPLnTRH5Jib+docT2cInYbGJrbCKY3CUgof091Ba4Tqlq2qfWaS1mRXim6sAeCBpxYZd9qcOXMlb7z2LSuFK6AFrgWawIXPSLLOJ6I+MJDZrzd0XZIz5hi9lZr33livV05WNdIkWiLi98aFwJFMve3ZAoGAZxNjegOhTJ33Djdj3g80rLq4T7Uzc31GZ52jl+uY352HurnJiH1O20kBYyL8u/eb/joKSHJpnOOgswDHQceOECdoa+ahjse8ztOCC8rwzx9nishhH2V99GB8HxeBMMyMel04FsRuz9nFlEpv6U3FEnrRHDLzVidnMFGPYvd2DlUCgYABD3BFF8MryRM/N/H5Xlhfmvv+oe2Nq5ZkVF47dwSiPP1iEPGvoAHTJdK00kSrfRuwqEnsE47V0h9v8oGBmrFcelbVMpK13fWDFvt/2Vs2N/aZQpJ8JCLJo1w5NpMBvGVCGGqF5IgfUJVcwAls9iTM1JeU1FYbc+23oh+NIX339A==",

//            //异步通知地址
//            'notify_url' => "http://www.fcc.cn/index.php/admin/alipay/notify",
//            // 'notify_url' => "http://www.fcc.cn/index.php/alipay/notify_url.php",

//            //同步跳转
//            // 'return_url' => "http://www.fcc.cn/index.php/alipay/return_url.php",
//            'return_url' => "http://www.fcc.cn/index.php/admin/alipay/returnfy",

//            //编码格式
//            'charset' => "UTF-8",

//            //签名方式
//            'sign_type' => "RSA2",

//            //支付宝网关
//            'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

//            //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
//            'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmbMQ2s4A7qHT4M6nKk9ca2cuALrfHzhIREJ4R97kgVtOjgQZZTeLNqbRWmK3lvOzlBoQGT9lmcsfggCYLm1LKH1/VLlErQ247nbreBhYvofh58CF5ltv6b5yXxtVACs2RMqpLMPYFNFzs4CBoOZN21jVygWh3D23ZHvH7exrapTRMC3/PdXH6VKxPQ7znNGyDQhT85EqDkNXupcw7GDK10naiMqi7EBWSxtzU7eh+7miZqW+bPqSTO1Z3lfnIUN3a7PVD4jJQM9eTxpnGRz5PFi+hkrzfaX581ALoqnfGRaAq8xho/UyZWJ4F9AiiAFvcUhU0Tz1ITXnW39NivVeOQIDAQAB",
//        );
//        if (true) {
//            include_once VENDOR_PATH . '/alipay/config.php';
//            include_once VENDOR_PATH . '/alipay/pagepay/service/AlipayTradeService.php';
//            include_once VENDOR_PATH . '/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
//            //商户订单号，商户网站订单系统中唯一订单号，必填
//            // $out_trade_no = trim($_POST['WIDout_trade_no']);

//            // //订单名称，必填
//            // $subject = trim($_POST['WIDsubject']);

//            // //付款金额，必填
//            // $total_amount = trim($_POST['WIDtotal_amount']);

//            // //商品描述，可空
//            // $body = trim($_POST['WIDbody']);

//             $out_trade_no = '1231231213120190823';

//            //订单名称，必填
//            $subject = '购物';

//            //付款金额，必填
//            $total_amount = 100;

//            //商品描述，可空
//            $body = 'enen';
//            //构造参数
//            $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
//            $payRequestBuilder->setBody($body);
//            $payRequestBuilder->setSubject($subject);
//            $payRequestBuilder->setTotalAmount($total_amount);
//            $payRequestBuilder->setOutTradeNo($out_trade_no);

//            $aop = new \AlipayTradeService($config);

//            /**
//             * pagePay 电脑网站支付请求
//             * @param $builder 业务参数，使用buildmodel中的对象生成。
//             * @param $return_url 同步跳转地址，公网可以访问
//             * @param $notify_url 异步通知地址，公网可以访问
//             * @return $response 支付宝返回的信息
//             */
//            $response = $aop->pagePay($payRequestBuilder, $config['return_url'], $config['notify_url']);

//            //输出表单
// //            var_dump($response);
//        }
//    }

//    public function notify()
//    {
//        $post = input();
//        if ($post['trade_status'] == "TRADE_SUCCESS") {
//            // Db::name('order')->where('out_trade_no',$post['out_trade_no'])->update(array('pay_status'=>'success'));
//            //操作数据库 修改状态
//            echo "SUCCESS";
//        }else{
//        	echo 'error';
//        }
//        //写在文本里看一下参数
// //        $data = json_encode($post);
// //
// //        fopen("testfile.txt", $data);

//    }
//    /**
//     * 同步方法
//     * @return [type] [description]
//     */
//    public function returnfy()
//    {
//        $post = input();
//        //同步跳转地址
//        var_dump($post);
//    }

}