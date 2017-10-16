<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文峰视听门户网站</title>
	<link rel="stylesheet" type="text/css" href="/wfst/Public/Bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="/wfst/Public/BootStrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/BootStrap/js/bootStrap.min.js"></script>

	<style type="text/css">
		.carousel-inner-img{
			width: 100%;
		}
	</style>

</head>
<body style="background-color: gray;">

	<div class="container">

		<!-- 导航 -->
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <!-- 手机屏幕 -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">
		      	<img src="/wfst/Public/images/logo.png" width='50px'>
		      </a>
		    </div>
		      
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="">主页</a></li>
				<li><a href="<?php echo U('about');?>">关于我们</a></li>
				<li class="dropdown">
					<a href="" calss="dropdown-toggle" data-toggle="dropdown">
						<span>视频<span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="">视频教学</a></li>
						<li><a href="">视频聚焦</a></li>
						<li><a href="">视频对对碰</a></li>
						<li><a href="">视频原创</a></li>
						<li><a href="">视频门户网站</a></li>
					</ul>
				</li>
				<li class='dropdown'>
					<a href="" class='dropdown-toogle' data-toggle='dropdown'>
						<span>时尚生活馆<span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="">博文推荐</a></li>
						<li><a href="">时尚生活网址大全</a></li>
					</ul>
				
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" data-submenu="">
						<span>购物<span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="">购物门户网站</a></li>
						<li><a href="">购物贴士</a></li>
						<li><a href="">品牌入驻中</a></li>
						<li><a href="">海外购物</a></li>
						<li><a href="">购物推荐</a></li>
						<li><a href="">购物经验分享</a></li>
						<li class="dropdown-submenu" >
							<a href="">
								<span>构建中</span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="">构建中</a></li>
								<li><a href="">构建中</a></li>
								<li><a href="">构建中</a></li>
								<li><a href="">构建中</a></li>
								<li><a href="">构建中</a></li>
								
						</li>
					</ul>
				 </li>
				<li><a href="">在线互动</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		

		
		<!-- 轮播图  -->
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin: 0 auto; width: 59.5%">
		  <!-- 点 -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		    
		  </ol>

		  <!-- 翻页的页面 -->
		  <div class="carousel-inner" role="listbox">

		    <div class="item active">
		      <img class="carousel-inner-img" src="/wfst/Public/images/w-si.jpg">
		      <div class='carousel-caption'>
				<h2>文峰视听门户网站正式启动了</h2>
					<p>
						来本站体验学习、生活、购物之旅，发现生活，发现更多的创意，后续网络在线课堂也将会开启，本站同时也承接平面、视频、Y、网页设计、广告等业务，期待更多平台的入驻 
					</p>
			  </div>
		    </div>

		    <div class="item">
		      <img class="carousel-inner-img" src="/wfst/Public/images/w_ht.jpg">
		      <div class="carousel-caption">
				<h2>HTC One mini</h2>
					<p>
						继旗年初舰级产品新HTC One登陆国内市场之后，新HTC One家族新成员——HTC One mini 601e联通版（以下简称HTC One mini）也于日前在国内上市发售。HTC One mini延续了新HTC One的时尚外观设计，而且硬件配置不俗。
					</p>
				</div>
		    </div>

		    <div class="item">
				<img class="carousel-inner-img" src="/wfst/Public/images/w-ip.jpg">
				<div class='carousel-caption'>
					<h2>苹果iphone 5C</h2>
					<p>
						iPhone 5C是一款被媒体曝光的全新系列iPhone。iPhone5C采用聚碳酸酯塑料外壳，配备4英寸视网膜显示屏，搭载A6双核处理器内存，800万像素摄像头，机身比iPh5略厚，有白色、红色、绿色、蓝色和黄色五种配色可选。电信版iPhone5S和iPhone5C在中国市场首有白、红、蓝、绿、黄五色选择。
					</p>
				</div>
			</div>
		    
		  </div>

		  <!-- 按钮 -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
		</div>
		

		<!-- 欢迎语以及联系方式 -->

		<div class="container">
			<div class="row">
				
				<!-- 9:3 -->
				<div class="col-md-9">
					<div class="panel panel-info">
					<div class='panel-heading'>
						<b>欢迎来到文峰视听</b>
					</div>
					<div class='panel-body'>
						用创造演绎经典，用经典来诠释时尚，用时尚去追求完美，用完美期待永恒，创意，没有结束，只有开始……
					</div>
				</div>

				<!-- 9:3 -->
				<div class="col-md-3">444</div>
			</div>
		</div>






	</div> <!-- container -->



</body>
</html>