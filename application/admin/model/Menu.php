<?php


namespace app\admin\model;


use think\Model;
use think\Session;

class Menu extends Model
{
  public function getMenu(){
    $data=['parentId'=>0,'status'=>1];
    $result=Menu::where($data)->select();
    return $result;
  }
}