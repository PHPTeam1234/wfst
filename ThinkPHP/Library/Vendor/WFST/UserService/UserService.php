<?php
class UserService {
	public static function getUserInfoByUsername( $username ){
		$userDAO = M('user');
		$condition['username'] = $username;
		$dbUser = $userDAO->where($condition)->field('username, password, salt, id')->find(); 
		return $dbUser;
	}


}


?>