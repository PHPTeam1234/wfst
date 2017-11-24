<?php 
namespace Home\Controller\User;
use Think\Controller;
class UserController extends Controller {

	public function index(){

	}

	public function userInfo(){
		$pageRedirectWaitTime = 1;
		$userDAO = M("user");
		if ( !session("?user_id") ) {
			$this->error("未登录", U("Home/Index/Index/index"), 1);
		}
		$user_id = I("get.user_id")?I("get.user_id"):session("user_id");
		if ( $user_id == session("user_id") || session("username") == "admin"){
			$dbUser = $userDAO->where("id=".$user_id)->field('id, username, address, phone, email, nickname, register_time')->find();
			$this->assign('user', $dbUser);
			$this->display();
		}else {
			$this->error("你没有权限查看该用户的信息", U("Home/Index/Index/index"), $pageRedirectWaitTime);
		}
		
	}

	public function userUpdate(){
		$pageRedirectWaitTime = 1;
		$userDAO = M("user");
		if ( !session("?user_id") ) {
			$this->error("未登录", U("Home/Index/Index/index"), $pageRedirectWaitTime);
			exit;
		}
		
		// $user['id'] = I("post.id");
		$user['phone'] = I("post.phone")?I("post.phone"):null;
		$user['address'] = I("post.address");
		$user['email'] = I("post.email");
		$user['nickname'] = I("post.nickname");


		if ( session("user_id") == I("post.id") || session("username") == "admin"){
			// 自己修改信息或者管理员修改信息
			$isSave = $userDAO->where( "id=".I("post.id") )->save($user);
			if ( $isSave === false){
				// 更新失败
				$this->error("数据库更新用户信息失败", U("Home/Index/Index/index"), $pageRedirectWaitTime);
			}
			// dump($userDAO->getLastSql());
			$this->success("个人信息修改成功", U("Home/Index/Index/index"), $pageRedirectWaitTime);
		}else{
			$this->error("你没有权限修改该用户的信息", U("Home/Index/Index/index"), $pageRedirectWaitTime);
		}

	}

	public function userList(){
		$pageRedirectWaitTime = 1;
		$maxRecordPage = 12;
		if ( session("?user_id") && session("username") == "admin" ){
			$user = M("user");
			$count = $user->count();
			$page = new \Think\Page($count, $maxRecordPage);  //
			$show = $page->show();
			$users = $user->field("id, username, address, phone, email, nickname, status, register_time")->order('register_time')->limit($page->firstRow.",".$page->listRows)->select();
			// dump($videos_list);
			$this->assign("users", $users);
			$this->assign("page", $show);
			$currentPage = I("get.p")? I("get.p") : 1;
			$firstRecordNum = ( $currentPage - 1 )*$maxRecordPage + 1;  //计算每一页第一个数据的序号
			$this->assign("firstRecordNum", $firstRecordNum);
			// dump($show);
			$this->display();
		}else {
			$this->error("你未登陆或者没有权限进行该项操作", U("Home/Index/Index/index"), $pageRedirectWaitTime);
		}
	}

	public function userDelete(){
		$pageRedirectWaitTime = 1;
		if ( session("username") != "admin"){
			$this->error("你未登陆或者没有权限进行该项操作", U("Home/Index/Index/index"), $pageRedirectWaitTime);
			exit;
		}

		$userDAO = M("user");
		$user['id'] = I("get.user_id");
		$isDelete = $userDAO->where("id=".$user['id'])->delete();
		if ( $isDelete === false ){
			$this->error("用户删除失败", U("Home/User/User/userList"), $pageRedirectWaitTime);
		}else {
			$this->success("用户删除成功", U("Home/User/User/userList"), $pageRedirectWaitTime);
		}

		


	}

}



 ?>