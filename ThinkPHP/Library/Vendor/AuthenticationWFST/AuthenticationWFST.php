<?php
class AuthenticationWFST {
	public static function getPasswordAndSalt($pass){
		$currentTime = time();
		// 截取后四位作为密码的盐
		$passInfo['salt'] = substr($currentTime, -4);
		// 暂时用 salt ,md5 加密
		$passInfo['password'] = md5( $pass.$passInfo['salt'] );
		return $passInfo;
	}
}


?>