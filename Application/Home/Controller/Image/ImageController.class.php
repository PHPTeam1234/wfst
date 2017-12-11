<?php 
namespace Home\Controller\Image;
use Think\Controller;
class ImageController extends Controller{

	public function shopWebPortalImgUpload(){

		if ( !session("?user_id")){
			alert("未登陆");
		}

		$config = array(
			'maxSize' => 10*1024*1024,
			'rootPath' => "./Uploads/image/",
			'exts'    => array('jpg', 'png', 'jpeg'),
			'autoSub' =>true,
			'subName' => array('date','Ymd'),
			'saveName' => 'uniqid',
		);

		$upload = new \Think\Upload( $config );
		$info = $upload->upload();
		if ( !$info ) {
			echo $this->alert( $upload->getError() );
		}

		// dump( $info );
		// exit;

		$imageDAO = M('shop_portal_image');

		$imageDAO->image_title = "";
		$imageDAO->image_desc = "";
		$imageDAO->user_id = session('user_id');
		$imageDAO->image_dir = $config['rootPath'].$info['imgFile']['savepath'];
		$imageDAO->image_name = $info['imgFile']['savename'];
		$imageDAO->image_create_time = time();
		$imageDAO->image_ext = $info['imgFile']['ext'];
		$imageDAO->image_size = $info['imgFile']['size'];

		$image_url = __ROOT__.substr($config['rootPath'].$info['imgFile']['savepath'].$info['imgFile']['savename'], 1);

		if ( !$imageDAO->add() ){
			echo $this->alert("数据库存储图片信息失败");
		}

		

		vendor("JSON.Services_JSON");
		header('Content-type: text/html; charset=UTF-8');
		$json = new \Services_JSON();
		echo $json->encode(array('error' => 0, 'url' => $image_url));
		exit;

	}

	public function alert($msg) {
		header('Content-type: text/html; charset=UTF-8');
		vendor("JSON.Services_JSON");
		$json = new \Services_JSON();
		echo $json->encode(array('error' => 1, 'message' => $msg));
		exit;
	}
}



 ?>