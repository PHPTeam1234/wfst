<?php 
namespace Home\Controller\Login;
use Think\Controller;
class LoginController extends Controller {

	public function login(){

            // 测试
        	// echo "666";
   //          $formUser = D("User");
			// $formUser->create();
			// // // $formUser->verifyCode = $_POST['verifyCode'];

   //              $sqlWhere = "username='".$formUser->username."' AND password='".$formUser->password."'";
			// 	// $dbUser = $formUser->where('id=1')->getField('username, id');
			// 	$dbUser = $formUser->where('id=1')->field('username,id')->find();

			// 	$dbUser['requestStatus'] = 1;
			// 	$dbUser['info'] = "登陆成功！";

			// 	var_dump($dbUser);

			// 	echo $dbUser['username'];
 

                


		if( IS_AJAX ){
			$formUser = D("User");
			

			// success to auto_validate
			$formVerifyCode = $_POST['verifyCode'];



			if( $this->check_verify($formVerifyCode) ){
                    // 验证码输入正确

				if(!$formUser->token(false)->create()){    //取消 token 令牌
                 // fail to auto_validate 

				$loginMsg['loginStatus'] = 0;
				$loginMsg['info'] = $formUser->getError();
				$this->ajaxReturn($loginMsg,'json');
				exit;
			   }
               
               // success to auto_validate

				$condition['username'] = $formUser->username;
				$condition['password'] = $formUser->password;
				$dbUser = $formUser->where($condition)->field('username, id')->find();

				

				if( $dbUser ){
					// 用户名和密码都正确

                     
					$dbUser['loginStatus'] = 1;
					$dbUser['info'] = "登陆成功！";
					$dbUser['isRememberMe'] = $_POST['isRememberMe'];

                    // $dbUser['beforeCreatePass'] = $_POST['password'];
                    // $dbUser['afterCreatePass'] = $condition['password'];
					// $dbUser['sql'] = $formUser->getLastSql();

					// var_dump($dbUser);


                    // 设置 session  thinkphp 设置单个 session expire 无效
                    session('username',$dbUser['username']);
                    session('user_id',$dbUser['id']);
                    // session('user.username','admin');
                    session('loginStatus',1);


                    // 设置 cookie  expire 有效
                    if ( $_POST['isRememberMe'] == "on" ) {
                    	//if check RememberMe 
                        cookie('username', $dbUser['username'], 3600*12*15 );
                    }

					// 返回 ajax
                    $this->ajaxReturn($dbUser,'json');
				}else {
                    $failLogin = array(
                             'loginStatus' => 0,
                             'info'          => "用户名或密码错误！",
                             'sql'           =>  $formUser->getLastSql(),
                     );

                   
					$this->ajaxReturn($failLogin,"json");
				}

			}else{
                    // 验证码错误

				    $failLogin = array(
                             'loginStatus' => 0,
                             'info'          => "验证码错误！",
                     );
				    $this->ajaxReturn($failLogin,"json");

			}




		}
	}

	public function logout() {
		if( IS_AJAX ){

			session('user.username', null);
        	session('user.id', null);
        	session(null);
        	$_SESSION=array();
        	setcookie('PHPSESSID','',time()-1000,'/');
        	setcookie('username','',time()-1000,'/');
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
		if( IS_AJAX ){
			$formUser = D("User");
			$formUser->create();
			$formVerifyCode = $_POST['verifyCode'];

			if ( $this->check_verify($formVerifyCode) ){
                   // 验证码正确
				  //保存数据
				if ( $formUser->add() ) {
                       // 插入成功
					$registerMsg = array(
						'registerStatus' => 1,
						'info'           => "注册成功！",
					);

					$this->ajaxReturn($registerMsg, "json");

				}else {
				  	 // 插入失败
					$registerMsg = array(
						'registerStatus' => 0,
						'info'           => "注册失败！",
					);

					$this->ajaxReturn($registerMsg, "json");
				}


			}else {
                  // 验证码错误
				$registerMsg = array(
					'registerStatus' => 0,
					'info'           => "验证码输入错误！",
				);

				$this->ajaxReturn($registerMsg, "json");
			}


		}


        


		// 非ajax 
        // 跳转到信息输入页面
        C('TOKEN_ON','true');  //仅对注册页面打开令牌
		$this->display();
	}

	public function registerInsert(){


		    $pageRedirectWaitTime = 1;

            //get verfiy code from form
			$formVerifyCode = $_POST['verifyCode'];
			if ( $this->check_verify($formVerifyCode)){
				 // verifyCode correct

				$formUser = D("User");
				if( $formUser->create() ){
                    // success to auto_validate

					if ( $formUser->add() ) {
                       // 插入成功

						$this->success('注册成功',U("Home/Index/Index/index"), $pageRedirectWaitTime);


					}else {
				  	 // 插入失败
						$this->error('注册失败',U('register'), $pageRedirectWaitTime);

					}

				}else {
				 	 // fail to auto_validate
					$errorMsg = $formUser->getError();
					$this->error($errorMsg, U('register'),$pageRedirectWaitTime );

				}


			}else {
				// verifyCode incorrect
				$this->error('验证码输入错误',U('register'), $pageRedirectWaitTime);
			}
	}


       

        public function check_verify($code, $id = ""){
        	$config = array(
                           'reset' => false // 验证成功后是否重置，这里才是有效的。
                        );
        	$verify = new \Think\Verify($config);
            return $verify->check($code, $id); 
        }


        public function test(){
        	 // 测试用

        	// session(array('name' => 'user.username','expire' => 10));
        	// session('user.username','jimmy');

        	// session(null);

        	cookie('username',null);

        }

        public function test2(){
        	 // 测试用
              // var_dump(session());
        	var_dump(cookie());

        }

}

?>