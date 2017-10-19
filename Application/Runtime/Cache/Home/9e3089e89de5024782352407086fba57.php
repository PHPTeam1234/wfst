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

	<header>
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
		      	<img src="/wfst/Public/images/logo.png" width="25%">
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
				</li>



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
							</ul>
						</li>
					</ul>

				</li>

				<li><a href="">在线互动</a></li>

		      </ul>

		    </div><!-- /.navbar-collapse -->

		  </div><!-- /.container-fluid -->
		</nav>
	</header>

		<!-- 轮播图  -->

		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
          <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item">
            <img class="carousel-inner-img" src="/wfst/Public/images/w-si.jpg" alt="专注金融领域招商引资，">
            <div class="carousel-caption">
              ...
            </div>
          </div>
          <div class="item active">
            <img class="carousel-inner-img" src="/wfst/Public/images/w_ht.jpg" alt="汇集金融领域精英，提供专业融资服务">
            <div class="carousel-caption">
              ...
            </div>
          </div>
          <div class="item">
            <img class="carousel-inner-img" src="/wfst/Public/images/w-ip.jpg" alt="区域代理，盛大招募">
            <div class="carousel-caption">
              ...
            </div>
          </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="http://www.ysemm.cn/#carousel-example-generic" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="http://www.ysemm.cn/#carousel-example-generic" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
		

		<!-- 欢迎语以及联系方式 -->

        <div class="container">
            <div class="row aboutus-list">
              <div class="col-lg-9 col-xs-9 animate-box fadeInUp animated-fast" data-animate-effect="fadeInUp">
                <span class="aboutus-service"></span>
                <h3>咨询服务周到</h3>
              </div>
              <div class="col-lg-3 col-xs-2 animate-box fadeInUp animated-fast" data-animate-effect="fadeInUp">
                <span class="aboutus-technology"></span>
                <p>融资技术专业</p>
              </div>
            </div>
        </div>

</body>
</html>