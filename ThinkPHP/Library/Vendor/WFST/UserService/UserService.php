<?php
class UserService {
	public static function getUserInfoByUsername( $username ){
		$userDAO = M('user');
		$condition['username'] = $username;
		$dbUser = $userDAO->where($condition)->field('username, password, salt, user_id')->find(); 
		return $dbUser;
	}

	public static function getUserInfoById( $user_id ){
		$userDAO = M('user');
		$dbUser = $userDAO->where("user_id=".$user_id)->field('user_id, username, address, phone, email, nickname, register_time')->find(); 
		return $dbUser;
	}

	public static function updateUserInfo( $user ){
		$userDAO = M('user');
		$isUpdateSuccessfully = $userDAO->where("user_id=".$user['user_id'])->save( $user ); 
		// return true;
		return $isUpdateSuccessfully;
	}


}


?>