<?php 
namespace Home\Controller\Login;
use Think\Controller;
class LoginController extends Controller {

	public function login() {
        
        $noVerifyCode = 0;  //控制是否需要验证码，方便测试 1: 不用验证码，0：需要验证码

        $verify = A("Home/VerifyCode/VerifyCode");

		if( IS_AJAX ){
			$user = D("User");
			$formVerifyCode = $_POST['verifyCode'];

            // 验证码
			if( $noVerifyCode || $verify->check_verify( $formVerifyCode ) ){
                    // 验证码输入正确

				if( !$formUser = $user->token(false)->create() ){    //取消 token 令牌
                    // fail to auto_validate 

				    $loginMsg['loginStatus'] = 0;
				    $loginMsg['info'] = $user->getError();
				    $this->ajaxReturn($loginMsg,'json');
				    exit;
			    }


                // success to auto_validate
				$condition['username'] = $formUser['username'];
				$dbUser = $user->where($condition)->field('username, password, salt, id')->find();  
                
				if ( !$dbUser ) {
					//用户名不存在
					$loginMsg['loginStatus'] = 0;
				    $loginMsg['info'] = "用户名或密码错误！";
				    // $loginMsg['LastSql'] = $user->getLastSql();
				    $this->ajaxReturn( $loginMsg,'json' );
				    exit;
				}

				// 盐处理： md5 ( password.salt )
				$formUser['password'] = md5( $formUser['password'].$dbUser['salt'] );  //密码对比之前盐处理
				   
				if( $formUser['password'] == $dbUser['password'] ){
					// 用户名和密码都正确

					$dbUser['loginStatus'] = 1;
					$dbUser['info'] = "登陆成功！";
					$dbUser['isRememberMe'] = $_POST['isRememberMe'];

                    // 设置 session  thinkphp 设置单个 session expire 无效
                    session( 'username', $dbUser['username'] );
                    session( 'user_id', $dbUser['id'] );
                    session( 'loginStatus', 1 );

                    // 设置 cookie  expire 有效
                    if ( $_POST['isRememberMe'] == "on" ) {
                    	//if check RememberMe 
                        cookie( 'username', $dbUser['username'], 3600*12*15 );
                    }

					// 返回 ajax
                    $this->ajaxReturn( $dbUser, 'json' );
				}else {
					// password incorrect
                    $loginMsg = array(
                             'loginStatus' => 0,
                             'info'          => "用户名或密码错误！",
                             'sql'           =>  $user->getLastSql(),
                     );

					$this->ajaxReturn( $loginMsg, "json" );
				}

			}else{
                    // 验证码错误
				    $loginMsg = array(
                             'loginStatus' => 0,
                             'info'          => "验证码错误！",
                     );
				    $this->ajaxReturn( $loginMsg, "json" );

			}




		}
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
 				$user->salt = substr ( time(), -4, 4 );  //截取时间戳后四位作为 salt 
 				$user->password = md5( ($user->password).($user->salt) );  //密码加盐用md5加密

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
	}
     

}

?>