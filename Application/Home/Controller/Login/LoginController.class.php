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


		if(IS_AJAX){
			$formUser = D("User");
			$formUser->create();
			$formUser->verifyCode = $_POST['verifyCode'];



			if( $this->check_verify($formUser->verifyCode) ){
                    // 验证码输入正确
				$sqlWhere = "username='".$formUser->username."' AND password='".$formUser->password."'";
				$dbUser = $formUser->where($sqlWhere)->field('username, id')->find();

				if($dbUser){
					// 用户名和密码都正确
                     // var_dump($dbUser);
					// json_encode($dbUser);
					$dbUser['loginStatus'] = 1;
					$dbUser['info'] = "登陆成功！";
					// var_dump($dbUser);

					// echo "66666666";

                    // 设置 session
                    session('user.username',$dbUser['username']);
                    session('user.user_id',$dbUser['id']);
                    // session('user.username','admin');
                    session('user.loginStatus',1);

					// 返回 ajax
                    $this->ajaxReturn($dbUser,'json');
				}else {
                    $failLogin = array(
                             'loginStatus' => 0,
                             'info'          => "用户名或密码错误！",
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
		if(IS_AJAX){

			session('user.username', null);
        	session('user.id', null);
        	session(null);
        	$_SESSION=array();
        	setcookie('PHPSESSID','',time()-1,'/');
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
		if(IS_AJAX){
			$formUser = D("User");
			$formUser->create();
			$formUser->verifyCode = $_POST['verifyCode'];

			if ( $this->check_verify($formUser->verifyCode)){
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



        	session('user.username', null);

        	$this->display();


        }

}

?>