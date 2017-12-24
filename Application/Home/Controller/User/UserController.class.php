<?php 
namespace Home\Controller\User;
use Think\Controller;
class UserController extends Controller {

	public function index(){

	}


	/**		用户信息查询		
	*@return 1.Browser 非ajax请求：,$this->assign(user等信息)$this->success(error) 页面跳转
			 2.Browser ajax请求: 返回 json 信息：{ '用户信息': "", 'queryStatus':" 0 | 1", 'info': "失败|成功"}
			 3.移动端请求: 返回 json 信息：{ '用户信息': "", 'queryStatus':" 0 | 1", 'info': "失败|成功"}
    *@date 2017-12-24
	*/
	public function userInfo(){
		$queryPlatform = "";
		$errorMsg = "";
		$isQuerySuccess = false;
		$dbUser;
		$userDAO = M("user");
		$user_id;
		$queryPlatform;

		if ( session("?user_id") ){
			// 用户已登录
			$user_id = I("get.user_id")?I("get.user_id"):session("user_id");
			$queryPlatform = I("get.queryPlatform");

			if ( ( $user_id != session('user_id') ) && (session('username') != "admin") ){
				// 无权或者未登陆
				$isQuerySuccess = false;
				$errorMsg = "无权查看用户信息或者未登录";
			}else {
				// 
				vendor("WFST.UserService.UserService");
	        	$dbUser = \UserService::getUserInfoById( $user_id );
	        	if ( $dbUser ) {
	        		$isQuerySuccess = true;
	        	}else {
	        		$isQuerySuccess = false;
	        		$errorMsg = "数据库查询失败或该用户不存在";
	        	}
			}
		}else {
			// 用户未登陆
			$isQuerySuccess = false;
	        $errorMsg = "用户未登陆无法查询信息";
		}

		if ( ($queryPlatform == "browser") && (!IS_AJAX) ){
			if( $isQuerySuccess == true ){
				$this->assign( 'user', $dbUser );
				$this->display();
				exit;
			}else {
				$this->error( $errorMsg , U("Home/Index/Index/index"));
				exit;
			}
		} else {
			if ( $isQuerySuccess == true ){
				$dbUser['queryStatus'] = 1;
				$dbUser['info'] = "查询成功";
				$this->ajaxReturn( $dbUser, 'json' );
				exit;
			}else {
				$errorJson['queryStatus'] = 0;
				$errorJson['info'] = $errorMsg;
				$this->ajaxReturn( $errorJson, 'json' );
				exit;
			}
			
		}
	}


	/**		用户信息更新		
	*@return 1.Browser 非ajax请求：,$this->assign(user等信息)$this->success(error) 页面跳转
			 2.Browser ajax请求: 返回 json 信息：{  'queryStatus':" 0 | 1", 'info': "失败|成功"}
			 3.移动端请求: 返回 json 信息：{  'queryStatus':" 0 | 1", 'info': "失败|成功"}
    *@date 2017-12-24
	*/
	public function userUpdate(){

		$updatePlatform = "";
		$errorMsg = "";
		$isUpdateSuccess = false;
		$user;
		$user_id;
		$updatePlatform;
		$userServiceUpdateRst;

		$updatePlatform = I("get.updatePlatform");

		if ( session("?user_id") ){
			// 用户已登录

			if ( $updatePlatform == "mobileClient" ){
				// 移动端
				$userJson = file_get_contents("php://input");
				$formUser = (array)json_decode( $userJson );

				$user_id = htmlspecialchars( $formUser['user_id'] ) ? htmlspecialchars( $formUser['user_id'] ) : session("user_id");

				$user['user_id'] = $user_id;
				$user['phone'] = htmlspecialchars( $formUser['phone'] );
				$user['email'] = htmlspecialchars( $formUser['email'] );
				$user['nickname'] = htmlspecialchars( $formUser['nickname'] );
				$user['address'] = htmlspecialchars( $formUser['address'] );

			}else {
				// browser端
				$user_id = I("post.user_id")?I("post.user_id"):session("user_id");
				$user['user_id'] = $user_id;
				$user['phone'] = I("post.phone")?I("post.phone"):null;
				$user['address'] = I("post.address");
				$user['email'] = I("post.email");
				$user['nickname'] = I("post.nickname");
			}

			if ( ( $user_id != session('user_id') ) && (session('username') != "admin") ){
				// 无权或者未登陆
				$isUpdateSuccess = false;
				$errorMsg = "无权修改用户信息或者未登录";
			}else {
				// 
				vendor("WFST.UserService.UserService");
	        	$userServiceUpdateRst = \UserService::updateUserInfo( $user );
	        	if ( $userServiceUpdateRst ) {
	        		$isUpdateSuccess = true;
	        	}else {
	        		$isUpdateSuccess = false;
	        		$errorMsg = "数据库修改失败或该用户不存在";
	        	}
			}
		}else {
			// 用户未登陆
			$isUpdateSuccess = false;
	        $errorMsg = "用户未登陆无法修改信息";
		}

		if ( ($updatePlatform == "browser") && (!IS_AJAX) ){
			if( $isUpdateSuccess == true ){
				// 信息修改成功
				$this->success( "个人信息修改成功", U("Home/Index/Index/index") );
				exit;
			}else {
				// 信息修改失败
				$this->error( $errorMsg , U("Home/Index/Index/index"));
				exit;
			}
		} else {
			if ( $isUpdateSuccess == true ){
				// 信息修改成功( $updatePlatform == "mobileClient")
				$updateRst['updateStatus'] = 1;
				$updateRst['info'] = "修改成功！";
				$this->ajaxReturn( $updateRst, 'json' );
				exit;
			}else {
				// 信息修改失败( $updatePlatform == "mobileClient")
				$updateRst['updateStatus'] = 0;
				$updateRst['info'] = $errorMsg;
				$this->ajaxReturn( $updateRst, 'json' );
				exit;
			}
			
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
			$users = $user->field("user_id, username, address, phone, email, nickname, status, register_time")->order('register_time')->limit($page->firstRow.",".$page->listRows)->select();
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
		$user['user_id'] = I("get.user_id");
		$isDelete = $userDAO->where("user_id=".$user['user_id'])->delete();

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
			case "user_id": 
				$condition['user_id'] = $search_value;
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

		
        if ( (!isset($search_value)) || $search_value == "" ){
        	// 若搜索框没有值，则不设置查询条件
        	$count = $user->count();
        	$page = new \Think\Page($count, $maxRecordPage);
        	
        	$show = $page->show();
        	$users = $user->field("user_id, username, address, phone, email, nickname, status, register_time")->limit($page->firstRow.",".$page->listRows)->select();
        }else {
        	if ( (I("get.search_condition") == "user_id") && (!is_numeric( $search_value )) ){
        		// 由于user_id 字段在数据库中类型为 int, 故当用户查询条件: id = 非数字 时, 直接设置 查询条件不成立
        		$condition = "0=1";
        	}
        	$count = $user->where($condition)->count();
        	$page = new \Think\Page($count, $maxRecordPage);

        	$show = $page->show();
        	$users = $user->where($condition)->field("user_id, username, address, phone, email, nickname, status, register_time")->limit($page->firstRow.",".$page->listRows)->select();
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

    public function userPassword(){
    	
		if ( !session("?user_id") ){
			$this->error("未登陆",U("Home/Index/Index/index"), 3);
			exit;
		}
		
		$this->display();
    }

    public function changePassByAdmin(){

    	$pageRedirectWaitTime = 1;
    	if ( session("username") != "admin" ){
    		
    		if ( IS_AJAX ){
    			$passwordChangeMsg['status'] = 0;
    			$passwordChangeMsg['info'] = "未登陆或者无权修改密码";
    			$this->ajaxReturn( $passwordChangeMsg, "json" );
    			exit;
    		}
    		$this->error("未登陆或者无权修改密码",U("Home/Index/Index/index"), $pageRedirectWaitTime);
    		exit;
    	}

    	$newPassword = I("post.newPassword");
    	$formUserID = I("post.user_id");
    	vendor("AuthenticationWFST.AuthenticationWFST");
		$newPasswordInfo = \AuthenticationWFST::getPasswordAndSalt( $newPassword );
		$userDAO = M("user");
		$isSaveSuccess = $userDAO->where("user_id=".$formUserID)->save( $newPasswordInfo );
		if ( $isSaveSuccess === false ){
			// 密码修改失败
			if ( IS_AJAX ){
    			$passwordChangeMsg['status'] = 0;
    			$passwordChangeMsg['info'] = "修改密码失败";
    			$this->ajaxReturn( $passwordChangeMsg, "json" );
    			exit;
    		}
			$this->error($userDAO->getError(), U("Home/User/User/userInfo"), $pageRedirectWaitTime);
			exit;
		}else {
			// 密码修改成功
			if ( IS_AJAX ){
    			$passwordChangeMsg['status'] = 1;
    			$passwordChangeMsg['info'] = "修改密码成功";
    			$this->ajaxReturn( $passwordChangeMsg, "json" );
    			exit;
    		}
			$this->success("密码修改成功",U("Home/User/User/userInfo"), $pageRedirectWaitTime);
			exit;
		}


    }

    public function changePassBySelf(){
    	
    	$pageRedirectWaitTime = 1;
    	if ( !session("?user_id") ){
    		$this->error("未登陆",U("Home/Index/Index/index"), $pageRedirectWaitTime);
    	}

    	if ( !( I("post.oldPassword") && I("post.newPassword") && I("post.newPasswordConfirm") ) ){
    		$this->error("密码信息输入不完整",U("Home/User/User/userPassword"), $pageRedirectWaitTime);
    	}


    	vendor("AuthenticationWFST.AuthenticationWFST");
    	
    	$oldPassword = I("post.oldPassword");
    	$isOldPassCorrect = \AuthenticationWFST::authenticate( session("username"), $oldPassword );
		if ( !$isOldPassCorrect ){
			$this->error("原密码不正确", U("Home/User/User/userPassword"), $pageRedirectWaitTime);
			exit;
		}

    	if( I("post.newPassword") != I("post.newPasswordConfirm") ){
    		$this->error("确认密码与新密码必须一致", U("Home/User/User/userPassword"), $pageRedirectWaitTime);
    		exit;
    	}
    	$formUserID = session("user_id");
    	$newPassword = I("post.newPassword");
		$newPasswordInfo = \AuthenticationWFST::getPasswordAndSalt( $newPassword );
		$userDAO = M("user");
		$isSaveSuccess = $userDAO->where("user_id=".$formUserID)->save( $newPasswordInfo );
		if ( $isSaveSuccess === false ){
			// 密码修改失败
			$this->error($userDAO->getError(), U("Home/User/User/userInfo"), $pageRedirectWaitTime);
			exit;
		}else {
			// 密码修改成功
			$this->success("密码修改成功",U("Home/User/User/userInfo"), $pageRedirectWaitTime);
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