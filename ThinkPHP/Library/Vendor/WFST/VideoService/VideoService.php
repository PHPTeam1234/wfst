<?php
class VideoService {
	public static function getVideoCount( $condition ){
		$videoDAO = M('video');
		$videoCount = $videoDAO->where($condition)->count(); 
		return $videoCount;
	}

	public static function getVideosListWithLimit( $condition, $first, $length ){
		$videoDAO = M('video');
		$videoList = $videoDAO->where($condition)->field("video_id, video_title")->order('video_create_time')->limit( $first.",".$length)->select();
		$queryRst = array(
			'queryStatus' => true,
			'data' => $videoList
		);
		return $queryRst;
	}

	public static function getOneVideoInfo( $condition ){
		$videoDAO = M('video');
		$videoInfo = $videoDAO->where( $condition )->field("video_dir, video_name, video_desc")->find();
		$queryRst = array(
			'queryStatus' => true,
			'data' => $videoInfo
		);
		return $queryRst;
	}



}


?>