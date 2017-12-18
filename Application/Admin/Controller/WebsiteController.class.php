<?php
namespace Admin\Controller;
use Think\Controller;
class WebsiteController extends Controller {
	
    //购物网站管理
    public function shopMgr(){
        $user = M("shop_portal");
        $count = $user -> count();
        $page = new \Think\Page($count,10);//设置每一页有多少条记录
        //设置分页类的bootstrap样式
        $page -> setConfig('prev','上一页');
        $page -> setConfig('next','下一页');
        $page -> setConfig('theme', '<li><a>共 %TOTAL_ROW% 条记录</a></li> <li>%UP_PAGE%</li> <li>%LINK_PAGE%</li>  <li>%DOWN_PAGE%</li>');
        $show = $page -> show();
        $list = $user -> order('web_id') -> limit($page->firstRow.','.$page->listRows) -> select();
        //输出
        $this -> shopList = $list;
        $this -> page = $show;
        $this -> display();
    }

    //购物网站编辑
    public function edit(){
        $id = $_GET['id'];
        $rows = null;
        if($id != null){
            $website = M('shop_portal');
            $rows = $website -> where("web_id=".$id) -> find();
        }
        $this -> website = $rows;
        $this -> display();
    }

    //购物网站编辑保存
    public function save(){
        $website = M('shop_portal');
        $website -> create();
        if($website -> save()){
            $this -> success("更新成功",U('shopMgr'));
        }else{
            $this -> error("更新失败，请检查输入的配置");
        }
    }
}