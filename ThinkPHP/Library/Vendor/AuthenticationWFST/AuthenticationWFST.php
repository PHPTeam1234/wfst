<?php
class AuthenticationWFST {
	public static function getPasswordAndSalt( $pass ){
		$currentTime = time();
		// 截取后四位作为密码的盐
		$passInfo['salt'] = substr($currentTime, -4);
		// 暂时用 salt ,md5 加密
		$passInfo['password'] = md5( $pass.$passInfo['salt'] );
		return $passInfo;
	}

	public static function authByPassAndSalt($password, $salt, $dbPassword){
		$passwordProcessed = md5( $password.$salt );
		return  ( $passwordProcessed === $dbPassword ) ? true : false;
	}

	public static function authenticate($username,$password){
		$userDAO = M("user");
		$user['username'] = $username;
		$dbPasswordInfo = $userDAO->where($user)->field("password, salt")->find();
		if ( !$dbPasswordInfo ){
			return false;
		}else {
			return self::authByPassAndSalt($password, $dbPasswordInfo['salt'], $dbPasswordInfo['password']);
		}
		
	}
}


?>