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
               'maxSize'  => 1000*1024*1024,
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
				$this->success('上传成功', U("Home/Video/Video/myVideoList/platform/browser") , $pageRedirectWaitTime);
			  	exit;
			}else {
				$this->error('上传失败', U("Home/Video/Video/video_add") , $pageRedirectWaitTime);
				exit;
			}

		}
	}


	public function getVideoInfo() {

		$isQuerySuccess = false;
		$errorMsg;
		$platform = I('get.platform');
		$videoInfo;
		$video_id = I("get.video_id");

		if ( !session('?user_id') ) {
			$isQuerySuccess = false;
			$errorMsg = "未登陆，请先登陆！";
		}else {
			vendor("WFST.VideoService.VideoService");
			$condition['user_id'] = session("user_id");
			$condition['video_status'] = 1;
			$condition['video_id'] = $video_id;
       		
			$videoQueryRst = \VideoService::getOneVideoInfo( $condition );
			if ( $videoQueryRst['queryStatus'] ){
				// 数据库查询成功
				$videosListData = $videoQueryRst['data'];
				$isQuerySuccess = true;

			}else {
				// 数据库查询失败
				$isQuerySuccess = false;
				$errorMsg = "数据库查询过程失败！";
			}
		}

		if ( $platform == "browser" && ( !IS_AJAX ))  {
			// 使用页面跳转返回的情况
			if ( $isQuerySuccess ){
				//  browser平台 非 ajax 查询成功
				dump( $videosListData );
				exit;

			}else {
				// browser平台 非 ajax 查询失败
				$this->error( $errorMsg, U('Home/Index/Index/index') );
				exit;
			}
		} else {
			// 使用 json 返回的情况
			$videoJsonRst;
			if ( $isQuerySuccess ){
				//    查询成功
				$videoJsonRst = array(
					'queryStatus' => 1,
					'info' => '查询成功',
					'data' => $videosListData,
					// 以下用于browser 端
					'loginStatus' => session("?username"),
					'videoLocation' => __ROOT__."/".substr( $videosListData['video_dir'].$videosListData['video_name'], 2 ), 
					'username' => session( "username" )
				);
				
				
			}else {
				// 
				$videoJsonRst = array(
					'queryStatus' => 0,
					'info' => $errorMsg,
					// 以下用于browser 端
					'loginStatus' => session("?username"),
					'username' => session( "username" )
				);
				
			}
			$this->ajaxReturn( $videoJsonRst, 'json');
			exit;
		}

		// if ( IS_AJAX ) {
		// 	// 获取video_id
		// 	$video_id = I("post.video_id");
		// 	$loginMsg['loginStatus'] = session("?username");
		// 	if ( $loginMsg['loginStatus'] ){
		// 		$conditions['user_id'] = session('user_id');
		// 		$conditions['video_id'] = $video_id;
		// 		$video = M("video");
		// 		$dbVideo = $video->where($conditions)->find();
		// 		$loginMsg['username'] = session( "username" );
		// 		$loginMsg['videoLocation'] = __ROOT__."/".substr( $dbVideo['video_dir'].$dbVideo['video_name'], 2 );
		// 	}
		// 	$this->ajaxReturn( $loginMsg, "json" );
		// }

	}

	public function myVideoList() {

		$maxRecordPerPage = 12;
		$isQuerySuccess = false;
		$errorMsg;
		$platform = I('get.platform');
		$videosListData;

		if ( !session('?user_id') ) {
			$isQuerySuccess = false;
			$errorMsg = "未登陆，请先登陆！";
		}else {
			vendor("WFST.VideoService.VideoService");
			$condition['user_id'] = session("user_id");
			$condition['video_status'] = 1;
       		$videoCount = \VideoService::getVideoCount( $condition );
       		$page = new \Think\Page( $videoCount, $maxRecordPerPage );  //每页数据12条
			$show = $page->show();
			$videoQueryRst = \VideoService::getVideosListWithLimit( $condition, $page->firstRow, $page->listRows );
			if ( $videoQueryRst['queryStatus'] ){
				// 数据库查询成功
				$videosListData = $videoQueryRst['data'];
				$isQuerySuccess = true;

			}else {
				// 数据库查询失败
				$isQuerySuccess = false;
				$errorMsg = "数据库查询过程失败！";
			}
		}

		if ( $platform == "browser" && ( !IS_AJAX ))  {
			// 使用页面跳转返回的情况
			if ( $isQuerySuccess ){
				//  browser平台 非 ajax 查询成功
				$this->assign('videos_list', $videosListData);
				$this->assign('page', $show);
				$this->display();
				exit;

			}else {
				// browser平台 非 ajax 查询失败
				$this->error( $errorMsg, U('Home/Index/Index/index') );
				exit;
			}
		} else {
			// 使用 json 返回的情况
			$videoJsonRst;
			if ( $isQuerySuccess ){
				//   查询成功
				$videoJsonRst = array(
					'queryStatus' => 1,
					'info' => '查询成功',
					'data' => $videosListData,
				);
			}else {
				//  查询失败
				$videoJsonRst = array(
					'queryStatus' => 0,
					'info' => $errorMsg,
				);
			}
			$this->ajaxReturn( $videoJsonRst, 'json');
			exit;
		}




		// $pageRedirectWaitTime = 1;
		// $video = M("video");
		// if ( !session("?user_id")) {
		// 	// 未登陆
		// 	$this->error('未登陆', U("Home/Index/Index/index") , $pageRedirectWaitTime);
		// 	exit;
		// }

		// $condition['user_id'] = session("user_id");
		// $condition['video_status'] = 1;
		// $count = $video->where($conditions)->count();
		// $page = new \Think\Page($count, 12);  //每页数据12条
		// $show = $page->show();
		// $videos_list = $video->where($condition)->field("video_id, video_title")->order('video_create_time')->limit($page->firstRow.",".$page->listRows)->select();
		// // dump($videos_list);
		// $this->assign("videos_list", $videos_list);
		// $this->assign("page", $show);
		// $this->display();
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

	public function videoDelete(){
		$pageRedirectWaitTime = 1;

		
			if (!session("?user_id")) {
				$videoDeleteMsg['status'] = "0";
				$videoDeleteMsg['info'] = "未登陆，无法进行删除操作";
				if ( IS_AJAX ) {
					$this->ajaxReturn( $videoDeleteMsg, "json");
					exit;
				}else {
					$this->error('未登陆，无法进行删除操作', U("Home/Index/Index/index") , $pageRedirectWaitTime);
					exit;
				}
				
			}
			$video = M("video");
			$conditions['video_id'] = I("get.video_id");
			
			// $conditions['video_id'] = $_POST['video_id'];
			$dbVideo = $video->where( $conditions )->field("user_id, video_id, video_dir, video_name")->find();
			if ( $dbVideo ){
				// 数据库中视频记录存在
				if ( session('user_id') == $dbVideo['user_id'] || session('user_id') == 'admin'){
					// 删除操作是自己本人或者管理员

					// $videoDeleteMsg['video_path'] = __ROOT__."/".substr( $dbVideo['video_dir'].$dbVideo['video_name'], 2 );
					$videoDeleteMsg['video_path'] = $dbVideo['video_dir'].$dbVideo['video_name'];

					if ( file_exists( $videoDeleteMsg['video_path'] ) ){
						// 服务器中视频文件存在
						$isDelete = $video->where("video_id=".$conditions['video_id'])->delete();
						if ( $isDelete ){
							// 数据库删除视频记录成功
							
							if ( !unlink( $videoDeleteMsg['video_path'] ) ){
								// 服务器文件删除失败
								if ( IS_AJAX ) {
								$videoDeleteMsg['status'] = "0";
								$videoDeleteMsg['info'] = "服务器文件视频删除失败！";
								$this->ajaxReturn( $videoDeleteMsg, "json");
								exit;
								}else {
									$this->error('服务器文件视频删除失败！', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
									exit;
								}
							}

						}else {
							// 数据库视频记录删除失败
							if ( IS_AJAX ) {
								$videoDeleteMsg['status'] = "0";
								$videoDeleteMsg['info'] = "数据库视频记录删除失败！";
								$this->ajaxReturn( $videoDeleteMsg, "json");
								exit;
							}else {
								$this->error('数据库视频记录删除失败！', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
								exit;
							}
						}
						
					}else {
						// 服务器中视频文件不存在，删除数据库中对应记录
						$isDelete = $video->where("video_id=".$conditions['video_id'])->delete();
						if ( !$isDelete ) {
							// 数据库视频记录删除失败
							if ( IS_AJAX ) {
								$videoDeleteMsg['status'] = "0";
								$videoDeleteMsg['info'] = "服务器中视频文件不存在时，数据库视频记录删除失败！";
								$this->ajaxReturn( $videoDeleteMsg, "json");
								exit;
							}else {
								$this->error('服务器中视频文件不存在时，数据库视频记录删除失败！', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
								exit;
							}
						}

					}
					

					// 删除操作
					$videoDeleteMsg['status'] = "1";
					$videoDeleteMsg['info'] = "删除成功！";
					$videoDeleteMsg['video_id'] = $conditions['video_id'];
					$videoDeleteMsg['sql'] = $video->getLastSql();
					
					if ( IS_AJAX ){
						$this->ajaxReturn( $videoDeleteMsg, "json");
					}else {
						// dump($videoDeleteMsg['video_path']);
						$this->success('删除成功！', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
						exit;
					}
					

				}else {
					// 非本人或admin 删除操作
					$videoDeleteMsg['status'] = "0";
					$videoDeleteMsg['info'] = "您没有权限删除该视频！";
					if ( IS_AJAX ) {
						$this->ajaxReturn( $videoDeleteMsg, "json");
						exit;
					}else {
						$this->error('您没有权限删除该视频！', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
						exit;
					}
					
				}

			}else {
 				// 数据库中视频记录不存在
 				$videoDeleteMsg['status'] = "1";
				$videoDeleteMsg['info'] = "该视频已删除，无需重复删除";
				$videoDeleteMsg['video_id'] = $conditions['video_id'];
				// $videoDeleteMsg['sql'] = $video->getLastSql();
				if ( IS_AJAX ) {
					$this->ajaxReturn( $videoDeleteMsg, "json");
				}else {
					$this->error('该视频已删除，无需重复删除', U("Home/Video/Video/myVideoList") , $pageRedirectWaitTime);
					exit;
				}
				
			}

		
	}

}


?>