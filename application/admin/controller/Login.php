<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------

namespace app\admin\controller;


use think\captcha\Captcha;
use think\Controller;
use app\admin\validate\LoginValidate;
use think\Request;
use app\admin\model\Admin as AdminModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
/**
 * 后台登录控制器
 * @author jachin <jachin@qq.com>
 */
class Login extends Controller
{
    /**
     * @description  后台首页
     * @author jachin  2019-07-29
     */
    public function index(){
       
        $captcha=new Captcha();
        if(request()->isPost()){
            $data=input('post.');
            // if(!$captcha->check($data['code'])){
            //     return $this->error('验证码错误，正在跳转......','','',2);
            // }
            $admin=new AdminModel;
            $res=$admin->check($data['email'],$data['password']);
            switch($res['status']){
                case 0:
                    $this->redirect($res['msg']);

                    break;
                case 1:
                    
                case 2:
                   
                case 3:
                    
                case 4:
                    $this->error($res['msg'],'','',2);
                    break;
                case 5:
                    $this->success($res['msg'],'index/index');
                    // $this->error($res['msg'],'','',2);
                    break;
                default :$this->error('系统问题，请联系管理员','','',2);
            }
            
        }
        //return view('login');//与$this->fetch()方法相同
        return $this->fetch('login');
    }

    /**
     * @description  验证码
     * @author jachin  2019-07-29
     */
    public function  verify(){
        ob_clean();
        $captcha = new Captcha();
        return $captcha->entry();
    }

    /**
     * @description  退出登录
     * @author jachin  2019-07-29
     */
    public function logout(){
        //获取ip地址
        $ip=get_IP();
        $admin=new AdminModel;
        //将ip地址写入数据库
        $admin->updateLogin($ip);

        $redis=connectRedis();
        $cacheName=config('REDIS_NAME').session('uid');

        $redis->delete($cacheName);

        //清空session
        session(null);
        
        $this->redirect('login/index');
    }

    public function forget(){
        if(request()->isPost()){
            $email=input('post.email');
            $map=[
                ['email','=',$email],
            ];
            $res=AdminModel::where($map)->find();

            if(!$res){
                $status=['status'=>0,'msg'=>'该邮箱尚未注册，请联系管理员进行注册！'];
                return json($status);
            }
            if($res['status']!='正常'){
                $status=['status'=>0,'msg'=>'该账号已被禁用或删除，请联系管理员'];
                return json($status);
            }
            $url=config('RESETURL');
            $code=getCode($email);
            $content='尊敬的'.$email.'，您好！<br/>
            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp您收到这封电子邮件是因为您 (也可能是某人冒充您的名义) 申请了一个找回密码的请求。</p>
            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 假如这不是您本人所申请, 或者您曾持续收到这类的信件骚扰, 请您尽快联络管理员。</p>
            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp六位验证码是: '.$code.',该验证码十分钟有效时间。重置的网址是：'.$url.'</p>';
            $res=$this->sendMail($email,$content);

            // var_dump($res);exit;
            if($res===true){
                $status=['status'=>1,'msg'=>'邮件已发送，请根据邮件来重置密码！'];
            }else{
                $status=['status'=>0,'msg'=>'邮件已发送失败，请检查邮箱号'];
            }
            return json($status);
        }else{
          return view();  
        }
        
    }
    public function reset(){
        if(request()->isPost()){
            $data=input('post.');
            var_dump($data);exit;
        }else{
          return view();  
        }
    }
    public function sendMail($to,$content){

        //实例化PHPMailer核心类
        //$mail = new PHPMailer(false);     
        $mail = new PHPMailer(true);     
        //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        // $mail->SMTPDebug = 1;
        //使用smtp鉴权方式发送邮件
        $mail->isSMTP();

        //smtp需要鉴权 这个必须是true
        $mail->SMTPAuth=true;
        //链接163域名邮箱的服务器地址
        $mail->Host = 'smtp.163.com';
        //设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = 'tls';
        //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
        $mail->Port = 25;

        //设置smtp的helo消息头 这个可有可无 内容任意
        //$mail->Helo = 'Hello mail.163.com Server';
        //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
        //$mail->Hostname = 'localhost';
        // //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
        $mail->CharSet = 'UTF-8';
        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = 'jachin';
        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username ='jachinfang@163.com';
        //smtp登录的密码 使用生成的授权码 你的最新的授权码
        $mail->Password = '1994fcc1123';
        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From = 'jachinfang@163.com';
        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);

        //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
        $mail->addAddress($to);
        //添加多个收件人 则多次调用方法即可
        // $mail->addAddress('xxx@qq.com','lsgo在线通知');
        //添加该邮件的主题
        $mail->Subject = '后台管理系统邮件------找回密码';
        //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
        $mail->Body = $content;

        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        // $mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

        $status = $mail->send();
        //简单的判断与提示信息
        if($status) {
            return true;
        }else{
            return false;
        }
    }
   
}