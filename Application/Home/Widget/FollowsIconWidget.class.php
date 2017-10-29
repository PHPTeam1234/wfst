<?php
namespace Home\Widget;
use Think\Controller;
class FollowsIconWidget extends Controller {
	public function icon(){
		$this->display('FollowsIcon:icon');
	}
}
?>