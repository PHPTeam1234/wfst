<?php
namespace Home\Controller\Video;
use Think\Controller;
class VideoController extends Controller {
	public function video_add(){
		// C("TOKEN_ON", true);
		$this->display();
	}

	public function videoUpload() {
		$pageRedirectWaitTime = 1; 
		$verifyCode = $_POST['video_verifyCode'];

		$verify = A("Home/VerifyCode/VerifyCode");

		if ( !$verify->check_verify( $verifyCode ) )
			{
				$this->error('验证码输入错误', U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
				exit;
			}

		if ( !session('?username') ) {
			$this->error('用户未登陆', U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
			exit;
		};

		$video = M("video");

		// if ( !$video->autoCheckToken($_POST) ){
		// 	$this->error('请勿重复提交表单', U("Home/Video/Video/add") , $pageRedirectWaitTime);
		// 	exit;
		// }


		$config = array (
               'maxSize'  => 10*1024*1024,
               'rootPath' => "./Uploads/video/",
               'exts'     => "mp4",
               'autoSub'  => true,
               'subName'  => array('date', 'Ymd'),
               'saveName' => 'uniqid',
		);
		$upload = new \Think\Upload( $config );   //实例化上传类

		$info = $upload->upload();
		if ( !$info ) {
			// echo $upload->getError();
			$this->error( $upload->getError(), U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
			exit;

		}else {
			
			$video->video_title = I('post.video_title');
			$video->video_desc = I('post.video_desc');
			$video->user_id = session('user_id');
			$video->video_dir = $config['rootPath'].$info['video_file']['savepath'];
			$video->video_name = $info['video_file']['savename'];
			$video->video_create_time = time();
			$video->video_ext = $info['video_file']['ext'];
			$video->video_status = 1 ;  //暂时设置为 1
			$video->video_size = $info['video_file']['size'];
            

			if ( $video->add() ) {
				$this->success('上传成功', U("Home/Video/Video/myVideo_list") , $pageRedirectWaitTime);
			  	exit;
			}else {
				$this->error('上传失败', U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
				exit;
			}

		}
	}


	public function getVideoInfo() {
		if ( IS_AJAX ) {
			
			// 获取video_id
			$video_id = I("post.video_id");
			
			
			$loginMsg['loginStatus'] = session("?username");
			if ( $loginMsg['loginStatus'] ){
				$conditions['user_id'] = session('user_id');
				$conditions['video_id'] = $video_id;
				$video = M("video");
				$dbVideo = $video->where($conditions)->find();

				$loginMsg['username'] = session( "username" );
				$loginMsg['videoLocation'] = __ROOT__."/".substr( $dbVideo['video_dir'].$dbVideo['video_name'], 2 );

			}
			$this->ajaxReturn( $loginMsg, "json" );


		}
	}

	public function myVideo_list() {
		$pageRedirectWaitTime = 1;
		$video = M("video");
		if ( !session("?user_id")) {
			// 未登陆
			$this->error('未登陆', U("Home/Index/Index/index") , $pageRedirectWaitTime);
			exit;
		}

		$condition['user_id'] = session("user_id");
		$condition['video_status'] = 1;
		$count = $video->where($conditions)->count();
		$page = new \Think\Page($count, 12);  //每页数据12条
		$show = $page->show();
		$videos_list = $video->where($condition)->field("video_id, video_title")->order('video_create_time')->limit($page->firstRow.",".$page->listRows)->select();
		// dump($videos_list);
		$this->assign("videos_list", $videos_list);
		$this->assign("page", $show);
		$this->display();
	}

	public function myVideo(){
		$pageRedirectWaitTime = 1;
		if ( !session("?user_id")) {
			// 未登陆
			$this->error('未登陆', U("Home/Index/Index/index") , $pageRedirectWaitTime);
			exit;
		}

		$this->assign("video_title", I('get.video_title'));
		$this->assign("video_id", I('get.video_id'));
		// dump(I('get.video_title'));
		$this->display();


	}

}


?>