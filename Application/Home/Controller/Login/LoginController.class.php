<?php 
namespace Home\Controller\Login;
use Think\Controller;
class LoginController extends Controller {


	/**				
	*@return 1.Browser 非ajax请求：,$this->assign(username等信息)$this->success(error) 页面跳转
			 2.Browser ajax请求: 返回 json 信息：{ 'username': "", 'loginStatus':"", 'info': ""}
			 3.移动端请求: 返回 json 信息：{ 'username': "", 'loginStatus':"", 'info': ""}
    *@date 2017-12-18
	*/
	public function login() {

        $noVerifyCode = 0;  //控制是否需要验证码，方便测试 1: 不用验证码，0：需要验证码
        $verify = A("Home/VerifyCode/VerifyCode");
        $user = D("User");
        $formVerifyCode = $_POST['verifyCode'];
        $loginPlatform = I('get.loginPlatform');
        if ( $loginPlatform == "browser" ){
        	if( !$formUser = $user->token(false)->create() ){    //取消 token 令牌
	            // fail to auto_validate 
	        	$loginMsg['loginStatus'] = 0;
	        	$loginMsg['info'] = $user->getError();
	        	$this->ajaxReturn($loginMsg,'json');
	        	exit;
        	}
        }

        if ( $loginPlatform == "mobileClient" ){
        	// 对用 json对象传输的数据进行处理(移动客户端默认json传输)
        	$userJson = file_get_contents("php://input");
        	$formUser = (array)json_decode($userJson) ;
        	$formUser['username'] = htmlspecialchars( $formUser['username'] );
        	$formUser['password'] = htmlspecialchars( $formUser['password'] );
        }
        

        if ( $loginPlatform == "browser" ){
        	// 浏览器登陆方式
        	if ( !$verify->check_verify( $formVerifyCode ) ){
        		// 验证码错误
        		if ( IS_AJAX ){
        			$loginMsg['loginStatus'] = 0;
				    $loginMsg['info'] = "验证码错误！";
				    $this->ajaxReturn($loginMsg,'json');
				    exit;
        		}else {
        			$this->error("验证码错误，请重新登陆!", U("Home/Index/Index/index"));
        			exit;
        		}
        	}else {
        		// 验证码正确
        	}

        }else if ( $loginPlatform == "mobileClient" ){
        	//移动客户端登陆方式
        }else {
        	// 其他登陆方式
        }

        vendor("WFST.UserService.UserService");
        $dbUser = \UserService::getUserInfoByUsername( $formUser['username'] );

        if ( !$dbUser ) {
			//用户名不存在
			if ( $loginPlatform == "browser" ){
				// browser
				if ( !IS_AJAX ){
					// 非ajax
					$this->error("用户名或密码错误！", U("Home/Index/Index/index") );
					exit;
				}
			}
			// browser Ajax请求 和 mobileClient情况使用 $this->ajaxReturn
			$loginMsg['loginStatus'] = 0;
		    $loginMsg['info'] = "用户名或密码错误！";
		    // $loginMsg['LastSql'] = $user->getLastSql();
		    $this->ajaxReturn( $loginMsg,'json' );
		    exit;
		}

		vendor("AuthenticationWFST.AuthenticationWFST");
		$isPasswordRight = \AuthenticationWFST::authByPassAndSalt( $formUser['password'], $dbUser['salt'], $dbUser['password']);

		if ( !$isPasswordRight ) {
			//密码不正确
			if ( $loginPlatform == "browser" ){
				// browser
				if ( !IS_AJAX ){
					// 非ajax
					$this->error("用户名或密码错误！", U("Home/Index/Index/index") );
					exit;
				}
			}
			// browser Ajax请求 和 mobileClient情况使用 $this->ajaxReturn
			$loginMsg['loginStatus'] = 0;
		    $loginMsg['info'] = "用户名或密码错误！";
		    // $loginMsg['LastSql'] = $user->getLastSql();
		    $this->ajaxReturn( $loginMsg,'json' );
		    exit;
		}

		$loginMsg['loginStatus'] = 1;
		$loginMsg['username'] = $dbUser['username'];
		$loginMsg['user_id'] = $dbUser['user_id'];
		$loginMsg['info'] = "登陆成功！";
		$loginMsg['isRememberMe'] = $_POST['isRememberMe'];

        // 设置 session  thinkphp 设置单个 session expire 无效
        session( 'username', $dbUser['username'] );
        session( 'user_id', $dbUser['user_id'] );
        session( 'loginStatus', 1 );

        // 设置 cookie  expire 有效
        if ( $_POST['isRememberMe'] == "on" ) {
        	//if check RememberMe 
            cookie( 'username', $dbUser['username'], 3600*12*15 );
        }

        if ( $loginPlatform == "browser"){
        	if ( !IS_AJAX ){
        		// browser  非ajax请求使用页面跳转
        		$this->assign('username', $dbUser['username'] );
        		$this->assign('user_id', $dbUser['user_id'] );
        		$this->assign('info', '登陆成功！' );
        		$this->assign('loginStatus', 1 );
        		$this->success("登陆成功！", U('Home/Index/Index/index') );
        		exit;
        	}
        }
		// browser Ajax请求 和 mobileClient情况使用 $this->ajaxReturn
        $this->ajaxReturn( $loginMsg, 'json' );
        exit;
	}

	public function logout() {
		if( IS_AJAX ){
			session( 'username', null );
        	session( 'user_id', null );
        	session( null );
        	$_SESSION = array();
        	setcookie( 'PHPSESSID', '',time()-1000, '/' );
        	setcookie( 'username', '', time()-1000, '/' );
        	session_destroy();
        	$msg = array(
        		   'logoutStatus' => 1,
        		   'info'         => "退出成功！",
        		   'redirect_location' => U('Home/Index/Index/index'),
        	);

        	$this->ajaxReturn($msg, "json");

		}
	}

    // 用户注册
	public function register(){
		
		// 非ajax 
        // 跳转到信息输入页面
        C('TOKEN_ON','true');  //仅对注册页面打开令牌
		$this->display();
	}

	public function registerInsert(){

		$pageRedirectWaitTime = 1; //页面跳转等待时间

		$verify = A("Home/VerifyCode/VerifyCode");

        //get verfiy code from form
		$formVerifyCode = $_POST['verifyCode'];
		if ( $noVerifyCode || $verify->check_verify( $formVerifyCode ) ){
			// verifyCode correct
			$user = D("User");

			if( $user->create() ){
                // success to auto_validate
                // AuthenticationWFST 获得处理后的 密码 和 salt
                vendor("AuthenticationWFST.AuthenticationWFST");
                $passwordInfo = \AuthenticationWFST::getPasswordAndSalt( $user->password );
 				$user->salt = $passwordInfo['salt'];
 				$user->password = $passwordInfo['password'];  //密码加盐用md5加密

				if ( $user->add() ) {
                    // 插入成功
					$this->success( '注册成功', U("Home/Index/Index/index"), $pageRedirectWaitTime );
				}else {
				  	// 插入失败
					$this->error( '注册失败', U('register'), $pageRedirectWaitTime );
				}

			}else {
				// fail to auto_validate
				$errorMsg = $user->getError();
				$this->error( $errorMsg, U('register'), $pageRedirectWaitTime );
			}
		}else {
			// verifyCode incorrect
			$this->error( '验证码输入错误', U('register'), $pageRedirectWaitTime );
		}
	}



	
	public function test() {
		// test
		$file = "./Uploads/user/templet/templet.xls";
		// $file = "templet.xls";
		// $type = finfo::file($file);

		// new finfo(FILEINFO_MIME); 
		// $finfo = finfo_open(FILEINFO_MIME_TYPE); 
		// echo finfo_file($finfo, $file);
		// finfo_close($finfo);
		// dump($type);

		// dump(__ROOT__);

		// $userJson = file_get_contents("php://input");
  //       $formUser = (array)json_decode($userJson) ; 

  //       $loginMsg = array(
  //       	'loginStatus' => 666,
  //       	'username' => $formUser['username'],
  //       	'password' => $formUser['password']
  //       );

  //       $this->ajaxReturn( $loginMsg,'json' );

		dump(session("user_id"));

		$dizhi = "localhost/wfst/index.php/Home/Login/Login/test";




	}
     

}

?>