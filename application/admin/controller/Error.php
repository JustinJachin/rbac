<?php
// +----------------------------------------------------------------------
// | Author: jachin <jachin@qq.com> <https://github.com/JustinJachin/rbac>
// +----------------------------------------------------------------------


namespace app\admin\controller;
use app\admin\controller\Base;
/**
 * 
 */
class Error extends Base
{
	
	public function geterror(){
        return $this->fetch('error/404.html');
    }
}