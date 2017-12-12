<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>文峰视听门户网站</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/wfst/Public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/wfst/Public/bootstrap/css/bootstrap-submenu.min.css">
    <!-- 公共css -->
    <!-- <link rel="stylesheet" type="text/css" href="/wfst/Public/CSS/base.css"> -->
    <!-- 自身css -->
    <link rel="stylesheet" type="text/css" href="/wfst/Public/css/index1/index1.css">
    <link rel="stylesheet" type="text/css" href="/wfst/Public/css/shop/webPortalInfo.css">
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/bootstrap-submenu.min.js"></script>
    <!-- scroll-top & submenu -->
    <script type="text/javascript" src="/wfst/Public/js/base.js"></script>
    <!--表单验证  -->
    <script type="text/javascript" src="/wfst/Public/js/validate/jquery.validate.js"></script>
    <!-- 自定义验证方法 -->
    <script type="text/javascript" src="/wfst/Public/js/validate/additional.js"></script>
    <!-- 自身js -->
    <!-- <script type="text/javascript" src="/wfst/Public/js/user/userInfo.js"></script> -->
    <script type="text/javascript" src="/wfst/Public/js/shop/webPortalInfo.js"></script>

    <!-- 在线编辑器 -->
    <!-- <link rel="stylesheet" type="text/css" href="/wfst/Public/ueditor/themes/default/css/additions.css">
    <script type="text/javascript" src="/wfst/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/wfst/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/wfst/Public/ueditor/lang/zh-cn/zh-cn.js"></script> -->

    <!-- kindeditor -->
    <link rel="stylesheet" type="text/css" href="/wfst/Public/kindeditor/themes/default/default.css">
    <link rel="stylesheet" type="text/css" href="/wfst/Public/kindeditor/themes/simple/simple.css">
    <script type="text/javascript" src="/wfst/Public/kindeditor/kindeditor-all.js"></script>
    <script type="text/javascript" src="/wfst/Public/kindeditor/lang/zh-CN.js"></script>
    




</head>
<body>
	 <header>
	 	<?php echo W("Navigation/nav1");?>
	 </header>
    
	 <div class="container">

	 	  <div class="panel panel-webPortalInfo">
	 	  	<div class="panel-headding">
	 	  		<h4>购物门户网站信息</h4>
	 	  	</div>
	 	  	<div class="panel-body">
	 	  		<form action="<?php echo U('Home/Shop/Shop/webPortalInfoUpdate');?>" class="form-horizontal webPortalInfoForm" id="webPortalInfoForm" method="post">
	 	  			

	 	  			<div class="form-group" style="display:none">
	 	  				<label for="#web_id" class="col-md-1 col-sm-2  control-label">web_id</label>
	 	  				<div class="col-md-3 col-sm-5 ">
	 	  					<input type="text" class="form-control" name="web_id" id="web_id" value="<?php echo ($webPortalInfo['web_id']); ?>" readonly>
	 	  				</div>
	 	  			</div>

	 	  			<div class="form-group">
	 	  				<label for="#web_name" class="col-md-1 col-sm-2  control-label">网站名称:</label>
	 	  				<div class="col-md-3 col-sm-5 ">
	 	  					<input type="text" class="form-control" name="web_name" id="web_name" value="<?php echo ($webPortalInfo['web_name']); ?>" readonly>
	 	  				</div>
	 	  			</div>
	 	  			
	 	  			
	 	  			<div class="form-group">
	 	  				<label for="#web_address" class="col-md-1 col-sm-2 control-label">网站地址:</label>
	 	  				<div class="col-md-3 col-sm-5">
	 	  					<input type="text" class="form-control" name="web_address" id="web_address" value="<?php echo ($webPortalInfo['web_address']); ?>">
	 	  				</div>
	 	  			</div>

	 	  			<div class="form-group">
	 	  				<label for="#show_rank" class="col-md-1 col-sm-2 control-label">显示排名:</label>
	 	  				<div class="col-md-3 col-sm-5">
	 	  					<input type="text" class="form-control" name="show_rank" id="show_rank" value="<?php echo ($webPortalInfo['show_rank']); ?>">
	 	  				</div>
	 	  			</div>

	 	  			
	 	  			<div class="form-group">
	 	  				<label for="#web_desc" class="col-md-1 col-sm-2 control-label">网站描述:</label>
	 	  				<div class="col-md-12 col-sm-12">
	 	  					<!-- <input type="text" style="display: none" class="form-control" name="web_desc1" id="web_desc" value="<?php echo ($webPortalInfo['web_desc']); ?>"> -->
	 	  					<!-- <script id="editor" type="text/plain" name="web_desc" style="width:100%;height:100%;"></script> -->
	 	  					<textarea id="editor_id" name="web_desc" style="width:700px;height:300px;"><?php echo ($webPortalInfo['web_desc']); ?></textarea>
	 	  				</div>
	 	  			</div>

	 	  			
                    <button type="submit" class="btn btn-default col-md-offset-1 col-sm-offset-2">确定</button>&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo U('Home/Index/Index/index');?>" class="btn ">取消</a>

	 	  		</form>
	 	  	</div>
	 	  </div>
	 </div>

	 <footer>
	 	<?php echo W("Footer/footer");?>
	 </footer>
</body>

<script>
	$(document).ready(function(){
		// var ue = UE.getEditor('editor');

		var editor;
        KindEditor.ready(function(K) {
                editor = K.create('#editor_id',{
                	themeType : 'simple',
                	formatUploadUrl: false,
                	uploadJson: "<?php echo U('Home/Image/Image/shopWebPortalImgUpload', array('webProtalName'=>$webPortalInfo['web_name'], 'webProtalId'=>$webPortalInfo['web_id'] ));?>",
                	afterBlur: function(){ this.sync(); } //富文本失去焦点后将内容同步到 textarea
                });
        });
	});
 	
</script>

</html>