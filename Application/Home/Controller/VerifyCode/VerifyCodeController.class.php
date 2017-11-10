<?php 
namespace Home\Controller\VerifyCode;
use Think\Controller;
class VerifyCodeController extends Controller {

	static public function check_verify($code, $id = ""){
        $config = array(
             'reset' => false // 验证成功后是否重置，这里才是有效的。
        );
        $verify = new \Think\Verify( $config );
        return $verify->check( $code, $id ); 
    }

    public function verifyCode(){
    	$verify = new \Think\Verify();
    	$verify->fontSize = 15;
    	$verify->entry();
    }

    public function getVerifyCode(){
          
		if ( IS_AJAX ) {
			$formVerifyCode = $_POST['ajaxVerifyCodeSent'];
			$verifyMsg['verifyStatus'] = $this->check_verify( $formVerifyCode );
			$verifyMsg['verifyInfo'] = $verifyMsg['verifyStatus'] ? "验证码正确!" : "验证码错误!";
			$this->ajaxReturn( $verifyMsg, "json");
		}
	}


}




 ?>