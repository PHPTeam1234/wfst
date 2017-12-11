<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
	//后台管理登录
    public function index(){
        $this -> display();
    }

    public function login(){
    	$this -> success('登录成功!',U('Index/index'));
    }
}