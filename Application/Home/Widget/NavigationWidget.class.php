<?php 
namespace Home\Widget;
use Think\Controller;
class NavigationWidget extends Controller{
     //展示导航条
     public function nav(){
     	$this->display('Navigation:nav');
     }

     public function nav1(){
     	$this->display('Navigation:nav1');
     }
 }
 ?>
