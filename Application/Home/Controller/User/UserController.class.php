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
				exit;
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
			$pageInfo['totalPages'] = $page->totalPages;
			$pageInfo['nowPage'] = 1;
			// dump($pageInfo['totalPages']);
			// dump($pageInfo['nowPage']);
			$currentPage = I("get.p")? I("get.p") : 1;
			$firstRecordNum = ( $currentPage - 1 )*$maxRecordPage + 1;  //计算每一页第一个数据的序号
			$this->assign("firstRecordNum", $firstRecordNum);
			$this->assign("pageInfo", $pageInfo);
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

		if ( IS_AJAX ){
			if ( $isDelete === false ){
				$deleteMsg['status'] = 0;
				$deleteMsg['info'] = "删除失败";
				$this->ajaxReturn( $deleteMsg, "json");
				exit;
			}else {
				$deleteMsg['status'] = 1;
				$deleteMsg['info'] = "删除成功";
				$this->ajaxReturn( $deleteMsg, "json");
				exit;
			}
			exit;
		}
		if ( $isDelete === false ){
			$this->error("用户删除失败", U("Home/User/User/userList"), $pageRedirectWaitTime);
			exit;
		}else {
			$this->success("用户删除成功", U("Home/User/User/userList"), $pageRedirectWaitTime);
			exit;
		}

		


	}

	public function userSearch(){
         
		$pageRedirectWaitTime = 1;
		if ( session("username") != "admin"){
			$this->error("你未登陆或者没有权限进行该项操作", U("Home/Index/Index/index"), $pageRedirectWaitTime);
			exit;
		}

		$condition = array();
		$search_value = I("get.search_value");

		switch(I("get.search_condition")){
			case "id": 
				$condition['id'] = $search_value;
				break;
			case "username": 
				$condition['username'] = $search_value;
				break;
			case "email": 
				$condition['email'] = $search_value;
				break;
			case "status": 
				$condition['status'] = $search_value;
				break;
		}
		
		$user = M("user");
		$maxRecordPage = 12;
		$count = null;
		$page = null;  //
		$show = null;
		
        if ( !$search_value ){
        	// 若搜索框没有值，则不设置查询条件
        	$count = $user->count();
        	$page = new \Think\Page($count, $maxRecordPage);
        	
        	$show = $page->show();
        	$users = $user->field("id, username, address, phone, email, nickname, status, register_time")->limit($page->firstRow.",".$page->listRows)->select();
        }else {
        	$count = $user->where($condition)->count();
        	$page = new \Think\Page($count, $maxRecordPage);

        	$show = $page->show();
        	$users = $user->where($condition)->field("id, username, address, phone, email, nickname, status, register_time")->limit($page->firstRow.",".$page->listRows)->select();
        }
		
		// 将时间进行转换
		for( $i = 0; $i < count($users); $i++ ){
				$users[$i]['register_time'] = date('Y-m-d',$users[$i]['register_time']);
		}
		$msgCount = count($users);
		$users[$msgCount]['totalPages'] = (int)($page->totalPages);
		$users[$msgCount]['nowPage'] = (int)I("get.p")?(int)I("get.p"):1;
		$users[$msgCount]['maxRecordPage'] = (int)$maxRecordPage;

		if ( IS_AJAX ){
			$this->ajaxReturn($users,"json");
		}
	}

	public function addUserByExcel(){
		
		if ( session("username") != "admin"){
			$this->error("你未登陆或者没有权限进行该项操作", U("Home/Index/Index/index"), $pageRedirectWaitTime);
			exit;
		}

		$pageRedirectWaitTime = 3; 
		// $verifyCode = $_POST['video_verifyCode'];
		// $verify = A("Home/VerifyCode/VerifyCode");
		// if ( !$verify->check_verify( $verifyCode ) )
		// 	{
		// 		$this->error('验证码输入错误', U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
		// 		exit;
		// 	}

		

		// $video = M("video");

		// if ( !$video->autoCheckToken($_POST) ){
		// 	$this->error('请勿重复提交表单', U("Home/Video/Video/add") , $pageRedirectWaitTime);
		// 	exit;
		// }


		$config = array (
			'maxSize'  => 5*1024*1024,
			'rootPath' => "./Uploads/user/tmp/",
			'exts'     => "xls",
			'autoSub'  => false,
               // 'subName'  => array('date', 'Ymd'),
			'saveName' => 'uniqid',
		);
		$upload = new \Think\Upload( $config );   //实例化上传类

		$info = $upload->upload();
		if ( !$info ) {
			// echo $upload->getError();
			$this->error( $upload->getError(), U("Home/User/User/userList") , $pageRedirectWaitTime);
			exit;

		}else {
			
			$users->users_dir = $config['rootPath'].$info['users_file']['savepath'];
			$users->users_name = $info['users_file']['savename'];
			$usersImportFilePath = $users->users_dir.$users->users_name;

			// echo "上传成功, 文件信息如下：";
			// dump($info);
			// dump("wenjiandizhi: ");
			// dump($users->users_dir.$users->users_name);

			vendor("PHPExcel.PHPExcel");
			vendor("PHPExcel.PHPExcel.IOFactory");
			$objPHPExcel = new \PHPExcel();
			$objReader = \PHPExcel_IOFactory::createReader("Excel5");
			$objPHPExcel = $objReader->load($usersImportFilePath, $encode='utf-8');
			$usersData = $objPHPExcel->getActiveSheet()->toArray(null,false,false,true);

			$userTotalCount = count($usersData) - 1 ; //第一行不是数据

			vendor("AuthenticationWFST.AuthenticationWFST");

			$userDAO = M("user"); 

			$userFromExcelKey = $usersData[1];
			$userAddSuccess = null;
			for ( $i=2; $i <= ($userTotalCount+1); $i++){
				$userDataAttrNum = count( $usersData[$i] );
				$userDataValue = null;
				for( $j = 1; $j <= $userDataAttrNum; $j++ ){
					$attr = 64 + $j;
					$chrAttr = chr($attr);
					$userDataValue[] = $usersData[$i][$chrAttr];
				}

				$userDataKey = array(
					"username"
					,"password"
					,"address"
					,"phone"
					,"email"
					,"nickname"
					,"status"
				);

				$userDataCombine = array_combine( $userDataKey, $userDataValue);

				// 对密码进行处理， 获得处理后的password 和 salt
				$passwordInfo = \AuthenticationWFST::getPasswordAndSalt( $userDataCombine['password'] );

				$userDataCombine['password'] = $passwordInfo['password'];
				$userDataCombine['salt'] = $passwordInfo['salt'];
				$userDataCombine['register_time'] = time();


				if ( $userDAO->add($userDataCombine) ){
				// 数据库插入成功
					$userAddSuccess[] = $userDataCombine['username'];
				}
			}
			if (count($userAddSuccess) == $userTotalCount){
				$this->success("用户全部导入成功",U("Home/User/User/userList"), $pageRedirectWaitTime);
				exit;
			}else {
				dump("部分插入成功，插入成功的数据: ");
				dump($userAddSuccess);
			}
			exit;
		}
    }


    public function downloadTemplet(){
    	
    	$file = "./Uploads/user/templet/templet.xls";
	    if(is_file($file)){
	        $length = filesize($file);
	        $type = mime_content_type($file);
	        $showname =  ltrim(strrchr($file,'/'),'/');

	        header("Content-Description: File Transfer");
	        header('Content-type: ' . $type);
	        header('Content-Length:' . $length);
	          if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) { //for IE
	              header('Content-Disposition: attachment; filename="' . rawurlencode($showname) . '"');
	          } else {
	              header('Content-Disposition: attachment; filename="' . $showname . '"');
	          }

	        readfile($file);
	        
	        exit;
	      } else {
	      	
	        exit('文件已被删除！');

	      }
 	 }

}



 ?>