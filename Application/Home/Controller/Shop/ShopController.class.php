<?php 
namespace Home\Controller\Shop;
use Think\Controller;
class ShopController extends Controller{

	public function websPortal(){

		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}

		$shopPortalDAO = M("shop_portal");
		$websPortal = $shopPortalDAO->order('show_rank')->select();
		// dump($websPortal);

		$this->assign("websPortal",$websPortal);
		$this->display();
	}

	public function webPortalAdd(){

		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}
		$this->display();

	}

	public function webPortalInsert(){
		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}

		$webPortalInfo['web_name'] = I("post.web_name");
		$webPortalInfo['web_desc'] = I("post.web_desc");
		$webPortalInfo['web_address'] = I("post.web_address");
		$webPortalInfo['show_rank'] = I("post.show_rank");
		$webPortalInfo['edit_time'] = time();

		$webPortalDAO = M("shop_portal");
		$isSaveSuccess = $webPortalDAO->add( $webPortalInfo );
		if ( $isSaveSuccess ){
			$this->success("添加成功", U("Home/Shop/Shop/websPortal"));
		}else{
			$this->error("添加失败", U("Home/Shop/Shop/websPortal"));
		}

	}

	public function webPortalDelete(){
		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}

		$webPortalInfo['web_id'] = I("get.web_id");
		$webPortalDAO = M("shop_portal");
		$isDeleteSuccess = $webPortalDAO->where($webPortalInfo)->delete();
		// dump($isDeleteSuccess);
		if ( $isDeleteSuccess ){
			$this->success("删除成功", U("Home/Shop/Shop/websPortal"));
		}else{
			$this->error("删除失败", U("Home/Shop/Shop/websPortal"));
		}


	}

	public function webPortalInfo(){

		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}


		$shopPortalDAO = M("shop_portal");
		$condition['web_id'] = I("get.web_id");
		$webPortalInfo = $shopPortalDAO->where($condition)->find();
		$webPortalInfo['web_desc'] = htmlspecialchars_decode($webPortalInfo['web_desc']);
		$this->assign("webPortalInfo",$webPortalInfo);
		$this->display();

	}

	public function webPortalInfoUpdate(){

		if(session("username") != "admin1"){
			$this->error("未登陆或者没有权限", U("Home/Index/Index/index"));
			exit;
		}
		$shopPortalDAO = M("shop_portal");
		$web_id = I("post.web_id");
		$webPortalInfo['web_desc'] = I("post.web_desc");
		$webPortalInfo['show_rank'] = I("post.show_rank");
		$webPortalInfo['web_address'] = I("post.web_address");
		$webPortalInfo['edit_time'] = time();

		$isSaveSuccess = $shopPortalDAO->where("web_id=".$web_id)->save($webPortalInfo);
		if ( $isSaveSuccess === false ){
			$this->error("更新失败", U("Home/Shop/Shop/websPortal"));
			exit;
		}else {
			$this->success("更新成功", U("Home/Shop/Shop/websPortal"));
		}

	}


 }

 ?>
