<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
	
	//用户列表 分页
    public function index(){
    	$user = M("User");
        $count = $user -> count();
        $page = new \Think\Page($count,10);//设置每一页有多少条记录
        //设置分页类的bootstrap样式
        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $page -> setConfig('theme', '<li><a>共 %TOTAL_ROW% 条记录</a></li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li>  <li>%DOWN_PAGE%</li>');
        $show = $page -> show();
        $list = $user -> order('id') -> limit($page->firstRow.','.$page->listRows) -> select();
        //输出
        $this -> userList = $list;
        $this -> page = $show;
        $this -> display();
    }

    //用户编辑
    public function edit(){
        $user = M('User');
        $id = $_GET['id'];
        $row = $user -> where("id=".$id) -> find();
        $this -> user = $row;
    	$this -> display();
    }

    //删除ajax
    public function delete(){
        $id = $_POST['id'];
        $result = 0;
        if($id != null){
            $user = M('User');
            $result = $user -> delete($id);
        }
        return $this -> ajaxReturn($result, 'json');
    }


    //新增
    public function insert(){
        $user = M('User');
        $user -> create();
        $user -> register_time = date();
        $user -> salt = 0;
        if($user -> add()){
            $this -> success("添加成功",U('index',array('menu'=>'user')));
        }else{
            $this -> error("添加失败",U('add',array('menu'=>'user')));
        }
    }

    //更新
    public function update(){
        $user = M('User');
        $user -> create();
        if($user -> save()){
             $this -> success("更新成功",U('index',array('menu'=>'user')));
        }else{
            $this -> error("更新失败",U('index',array('menu'=>'user')));
        }
    }

    //新增界面
    public function add(){
        $this -> display();
    }

}