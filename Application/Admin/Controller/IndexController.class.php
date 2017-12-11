<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	//后台管理首页
    public function index(){
        $this -> display();
    }
}