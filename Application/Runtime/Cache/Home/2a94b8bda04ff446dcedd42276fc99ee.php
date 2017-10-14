<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="/wfst/Public/Bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/wfst/Public/Bootstrap/css/bootstrap-submenu.min.css">
	<script type="text/javascript" src="/wfst/Public/BootStrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/BootStrap/js/bootStrap.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/Bootstrap/js/bootstrap-submenu.min.js"></script>
</head>
<style>
			.top{
			cursor:pointer;
			width:30px;
			height:30px;
			background:#000;
			border-radius:5px;
			color:#fff;
			line-height:30px;
			text-align:center;
			font-size:20px;
			position:fixed;
			right:30px;
			bottom:20px;
		}

		.top:hover{
			opacity:0.7;
		}

        .copyright{
        	font-size:13px;
        	text-align:center;
        	color:#555;
        	margin-top:15px;
        	margin-bottom:15px;
        }

        body{
        	padding-top:50px;
        	position:relative;
        }

</style>
<body>
	<div class='header bg-success'>
		<div class='container'>
			<div class='row'>
				<div class="col-md-4 col-md-offset-8">
					邮箱: <a href="#">370134974.com</a> |&nbsp; ■■■<a href="javascript:window.external.addFavorite('http://www.wfstin.net','文峰视听')">收藏本站</a>■■■<a href="#" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.wfstin.com/')">设为主页</a>
				</div>
			</div>

			<div class='row'>
				<div class='col-md-12'>
					<nav class="navbar navbar-inverse navbar-fixed-top">
						<div class='container'>
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">
									<img src="/wfst/Public/images/logo.png">
								</a>
							</div>

							<div class="collapse navbar-collapse" id="mynavbar" >
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
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>

<main class='main bg-success'>
	<div class='container' >
		<!-- 幻灯片 -->
		<div class='row'>
			<div style="margin:0 auto; width:97%">
				<!-- <div class='col-md-11 col-md-offset-1'> -->
					<div id='mycarousel' class='carousel slide' data-ride='carousel'>
						<!-- 图片 -->
						<div class='carousel-inner'>
							<div class="item active">
								<img src="/wfst/Public/images/w-si.jpg">
								<div class='carousel-caption'>
									<h2>文峰视听门户网站正式启动了</h2>>
									<p>来本站体验学习、生活、购物之旅，发现生活，发现更多的创意，后续网络在线课堂也将会开启，本站同时也承接平面、视频、创意DIY、网页设计、广告等业务，期待更多平台的入驻 </p>
								</div>
							</div>
							<div class="item">
								<img src="/wfst/Public/images/w_ht.jpg">
								<div class='carousel-caption'>
									<h2>HTC One mini</h2>>
									<p>继旗年初舰级产品新HTC One登陆国内市场之后，新HTC One家族新成员——HTC One mini 601e联通版（以下简称HTC One mini）也于日前在国内上市发售。HTC One mini延续了新HTC One的时尚外观设计，而且硬件配置不俗。</p>
								</div>
							</div>
							<div class="item">
								<img src="/wfst/Public/images/w-ip.jpg">
								<div class='carousel-caption'>
									<h2>苹果iphone 5C</h2>>
									<p>iPhone 5C是一款被媒体曝光的全新系列iPhone。iPhone5C采用聚碳酸酯塑料外壳，配备4英寸视网膜显示屏，搭载A6双核处理器，1GB内存，800万像素摄像头，机身比iPhone 5略厚，有白色、红色、绿色、蓝色和黄色五种配色可选。电信版iPhone5S和iPhone5C在中国市场首有白、红、蓝、绿、黄五色选择。</p>
								</div>
							</div>
						</div>
						<!-- 下方原点 -->
						<ol class='carousel-indicators'>
							<li data-target='#mycarousel' data-slide-to='0' class='active'></li>
							<li data-target='#mycarousel' data-slide-to='1'></li>
							<li data-target='#mycarousel' data-slide-to='2'></li>
						</ol>
						<!-- 左右 -->
						<a href="#mycarousel" class='left carousel-control' data-slide='prev'>
							<span class='glyphicon glyphicon-chevron-left'></span>
						</a>
						<a href="#mycarousel" class='right carousel-control' data-slide='next'>
							<span class='glyphicon glyphicon-chevron-right'></span>
						</a>
					</div>
				</div>
			<!-- </div> -->
		</div>

		<!-- 欢迎来到文峰视听  -->
		<div class="row" style='margin-top:20px;'>
			<div class="col-md-8">
				<div class="panel panel-info">
					<div class='panel-heading'>
						<b>欢迎来到文峰视听</b>
					</div>
					<div class='panel-body'>用创造演绎经典，用经典来诠释时尚，用时尚去追求完美，用完美期待永恒，创意，没有结束，只有开始……
					</div>

				</div>
			</div>
			<div class="col-md-4">
				<div class='panel panel-info'>
					<div class='panel-heading'><b>请关注我们</b>
					</div>

					<p>请点击下方的图标</p>
					<div class='row' >
						<div class='col-xs-1' >
							<a href="#"><img src="/wfst/Public/images/qqicon.png"></a>
						</div>
						<div class='col-xs-1'>
							<a href="#"><img src="/wfst/Public/images/txwbicon.png"></a>
						</div>
						<div class='col-xs-1'>
							<a href="#"><img src="/wfst/Public/images/xlwbicon.png"></a>
						</div>
						<div class='col-xs-1'>
							<a href="#"><img src="/wfst/Public/images/f_icon.png"></a>
						</div>
						<div class='col-xs-1'>
							<a href="#"><img src="/wfst/Public/images/ykicon.png"></a>
						</div>
						<div class='col-xs-1'>
							<a href="#"><img src="/wfst/Public/images/tdicon.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>


         <!-- 最新消息 -->
        <div class='row'>
        	<div class='col-md-12'>
        		<h3><center><span class='label label-primary'>最新消息</span></center></h3>
        	</div>
        </div>
        <div class='row'>
        	<div class='col-md-3'>
        		<div class='thumbnail'>
        			<img src="/wfst/Public/images/tmb.jpg">
        			<div class='caption'>
        				<a href="">天猫双十一购物狂欢节活动筹备</a>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='thumbnail'>
        			<img src="/wfst/Public/images/lssjb.jpg">
        			<div class='caption'>
        				<a href="">低碳、绿色、节能</a>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='thumbnail'>
        			<img src="/wfst/Public/images/ktzx520.jpg">
        			<div class='caption'>
        				<a href="">文峰视听在线课堂</a>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='thumbnail'>
        			<img src="/wfst/Public/images/lyqb.jpg">
        			<div class='caption'>
        				<a href="">连衣裙+小西装 优雅又大方</a>
        			</div>
        		</div>
        	</div>
        </div>

        <!--时尚生活推荐  -->
        <div class='row'>
        	<div class='col-md-12'>
        		<h3><center><span class='label label-primary'>时尚生活推荐</span></center></h3>
        	</div>
        </div>
        <div class='row'>	
        	<div class='col-md-3'>
        		<div class='panel panel-info'>
        			<div class='panel-heading'>东南亚最值得去的八大美丽海滩</div>
        			<div class='panel-body'>
        				<p>马尔代夫双鱼岛（olhuveli）<br>
        					&nbsp; 泰国巴东海滩（PatongBeach）<br>
        					菲律宾长滩岛（Boracay）<br>
        					泰国 克雷登（Ko Kradan）<br>
        					泰国 查汶海滩<br>
        					印度尼西亚 金巴兰海滩<br>
        					印度尼西亚库塔海滩（Kuta）<br>
        					印度尼西亚 沙努尔海滩（Sanur ）<br>
        					<br>
        				</p>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='panel panel-info'>
        			<div class='panel-heading'>名媛衣橱 五种潮流色彩的演绎</div>
        			<div class='panel-body'>
        				<p>沉静雅致的深蓝色在2013秋冬绝对是热门的潮流色彩，明星超模们早已经开始纷纷选择深蓝色的各种服装来彰显她们秋日的时髦主张。Miranda Kerr 的露肩长裙、Angelababy 的Masha Ma 礼服、Amanda Seyfried 的雪纺透视装……全部以深蓝色为首选，学习她们是怎样将深蓝色演绎出不同风貌的吧。
        				</p>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='panel panel-info'>
        			<div class='panel-heading'>盘点最受男人宠爱的10类女人</div>
        			<div class='panel-body'>
        				<p>世上的女人千千万万种，男人的口味也是各不相同。但是总有那么几种女性，无论在什么地方，都是男人们趋之若鹜的对象。她可能是可爱青春的，也可能是性感魅惑的，可能是温柔体贴的，也可能是放荡不羁的。总之，她让男人不自禁地想要去宠爱，深深地为她痴狂。</p>
        			</div>
        		</div>
        	</div>

        	<div class='col-md-3'>
        		<div class='panel panel-info'>
        			<div class='panel-heading'>四款浪漫设计 卧室床头柔情蜜意</div>
        			<div class='panel-body'>
        				<p>.淡绿花卉点缀床头长物志家居欧式绿色细颈敞口刻棱玻璃花瓶 营造自然舒适卧室<br>
        					浅紫饰品搭配床头 体验浪漫柔情卧室<br>
        					品信西班牙卫士小号金色卧室台灯<br>
        					朱朱家园绿色系卡通韩国明星窗帘ST768<br>
        					典荘（DanBon)8515紫色带锁首饰盒<br>
        				</p>
        			</div>
        		</div>
        	</div>
        </div>
        
        <!-- <div class="clearfix visible-xs-block"></div> -->


        <!-- 公告栏和最新微博信息 -->
        <div class='row'>
        	<div class='col-md-6'>
        		<h3><center><span class='label label-primary'>公告栏</span></center></h3>
        		<div class='alert alert-warning alert-dismissible'>
        			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        				<span aril-hidden='true'>&times;</span>
        			</button>
        			<p>欢迎大家来到文峰视听，网站正在建设中，后续会有更多好的资源分享给大家，想与我们平台合作的可以与我们联系，敬候您的佳音~</p>
        		</div>

        	</div>

        	<div class='col-md-6'>
        		<h3><center><span class='label label-primary'>最近微博信息</span></center></h3>
        		<!-- <div class='row'>
        			<div class='col-xs-1'>
        				<a href="#">
        					<img src="/wfst/Public/images/xlwbicon.png" class='thumbnail'>
        				</a>
        			</div>
        		</div> -->
        		<div class='panel panel-warning'>
        			<div class='media'>
        				<div class='media-left'>
        					<a href="">
        						<img src="/wfst/Public/images/xlwbicon.png">
        					</a>
        				</div>
        				<div class='media-body'>
        					<p>载入微博，了解更多微博动态</p>
        				</div>
        			</div>
        		</div>
        		<!-- <div class='panel panel-primary'>
        			<p>载入微博，了解更多微博动态</p>
        		</div> -->
        	</div>
        </div>


		<div class='col-md-1'>
			<div class='top'>
                <span class='glyphicon glyphicon-menu-up'></span>
			</div>
		</div>
		
	</div>
</main>

<footer class='main-footer bg-info'>
	<div class='container'>
		<!-- 分类，加入，与我们联系 -->
		<div clas='row'>
			<div class='col-md-3'>
				<img class='thumbnail' src="/wfst/Public/images/logo.png">
			</div>

			<div class='col-md-3'>
				<h3>分类</h3>
				<ul class="categories">
					<li><a href="#"> 教学区</a>（分类构建中）</li>
					<li><a href="#">视频区 </a>（分类构建中）</li>
					<li><a href="#">品牌馆</a>（分类构建中）</li>
					<li><a href="#"> 购物区</a>（分类构建中）</li>
					<li><a href="#"> DIY</a>（分类构建中）</li>
					<li><a href="#">媒体资源下载 </a>（分类构建中）</li>
					<li><a href="#">广告业务 </a>（分类构建中）</li>
				</ul>
			</div>

			<div class='col-md-3'>
				<h3>加入我们的业务通讯</h3>
				<p>为你提供相关的业务咨询服务</p>
				<p>欢迎您的来访</p>
				<div class='form-group'>
					<input type='text' class='form-control'>
				</div>
				<button type='submit' class='btn btn-primary'>现在加入</button>
			</div>

			<div class='col-md-3'>
				<h3>与我们联系</h3>
				<p>我们会第一时间为你服务</p>
				<div>
					<ul>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li>手机<span> :</span>18277393936</li>
						<li><span>QQ :</span>370134974|1532575484</li>
						<li><span>邮箱 :</span>370134974@qq.com</li>
						<li><span>地址 :</span>广西桂林</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

    <!-- copyright -->
	<div class='copyright'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-12'>
					<span>Copyright © 2013—文峰视听. All rights reserved.</span>
				</div>
			</div>
		</div>
	</div>
</footer>

</body>
<script>
$(window).scroll(function(){
		$('.top').show();
		if($(window).scrollTop()<100){
			$('.top').hide();
		}
});

$('.top').click(function(){
	$(window).scrollTop(0);

});

$(function () {
   $('[data-submenu]').submenupicker();
});
</script>
</html>