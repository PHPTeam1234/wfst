<?php if (!defined('THINK_PATH')) exit();?><!-- 顶部收藏 -->
<div class='top'>
	<div class='container c_top'>
		<div class='row'>
			<div class="col-md-4 col-md-offset-8">
				<div class="top_r">
					邮箱: 
					<a href="#">370134974.com</a> |&nbsp;■■■
					<a href=javascript:window.external.addFavorite('http:/www.wfstin.net','文峰视听')" >收藏本站</a>■■■
					<a href="#" onClick="this.style.behavio='url(#default#homepage)';this.setHomePage('http:/www.wfstin.com/')">设为主页</a>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 导航 -->
<div class="row">
	<div class="col-md-12">
		<!-- Logo&Banner -->
			<nav class="navbar navbar-inverse">
			  <div class="container">

			    <!-- 手机的缩小菜单 -->
			    <div class="navbar-header">
				    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
				     	<span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				    </button>
					
					<!-- Logo图片 -->
				    <a class="navbar-brand" href="#">
				    	<img src="/wfst/Public/images/logo.png">
				  	</a>
			    </div>

			    <div class="collapse navbar-collapse" id="navbar" >
				    <ul class="nav navbar-nav navbar-right">
				        <li class="active"><a href="<?php echo U('Home/Index/Index/index');?>">主页</a></li>
				        <li><a href="#">关于我们</a></li>
				        <li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">视频 <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="#">视频教学</a></li>
					          <li><a href="#">视频聚焦</a></li>
					          <li><a href="#">视频对对碰</a></li>
					          <li><a href="#">视频原创</a></li>
					          <li><a href="<?php echo U('Home/Index/Index/portfolio_details');?>">视频门户网站</a></li>
					        </ul>
				        </li>
				        <li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">时尚生活馆 <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					          <li><a href="#">博文推荐</a></li>
					          <li><a href="#">时尚生活网址大全</a></li>
					        </ul>
				        </li>
				        <li class="dropdown">
					        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">网购 <span class="caret"></span></a>
					        <ul class="dropdown-menu">
					            <li><a href="<?php echo U('Home/Index/Index/typography');?>">购物门户网站</a></li>
								<li><a href="<?php echo U('Home/Index/Index/fullwidth_columns');?>">购物贴士</a></li>
								<li><a href="<?php echo U('Home/Index/Index/buttons_tables');?>">品牌入驻中</a></li>
								<li><a href="<?php echo U('Home/Index/Index/list_blockquotes');?>">海外购物</a></li>
								<li><a href="<?php echo U('Home/Index/Index/images_dropcaps');?>">购物推荐</a></li>
								<li><a href="<?php echo U('Home/Index/Index/tabs_toggles');?>">购物经验分享</a></li>
					        </ul>
				        </li>
				        <!-- <li><a href="#">在线互动</a></li> -->
				        <!-- 用户 -->
				        <li class='dropdown' class="nav-user-block">
				        	<?php if(empty($_SESSION['username'])): if(empty($_COOKIE['username'])): ?><a href="javascript:void(0);" id="nav-user-block-dropToggle" data-toggle="modal"  data-target="#login_modal">
				        				<span id="nav_username">
				        					未登录
				        				</span>
				        			</a>
				        			<?php else: ?>
				        			<a href="" class='dropdown-toogle' data-toggle='dropdown' id="nav-user-block-dropToggle">
				        				<span id="nav_username">
				        					<?php echo (cookie('username')); ?> <span class="caret"></span>
				        				</span>
				        			</a><?php endif; ?>
				        		<?php else: ?>
				        		<a href="" class='dropdown-toogle' data-toggle='dropdown' id="nav-user-block-dropToggle">
				        			<span id="nav_username">
				        				<?php echo (session('username')); ?> <span class="caret"></span>
				        			</span>
				        		</a><?php endif; ?>
				        	<ul class="dropdown-menu">
				        		<li><a href="javascript:void(0);" id="logout_link">注销</a></li>
				        		<li><a href="<?php echo U('Home/Video/Video/video_add');?>">上传视频</a></li>
				        		<li><a href="<?php echo U('Home/Video/Video/myVideo_list');?>">我的视频</a></li>
				        		<li><a href="<?php echo U('Home/User/User/userInfo');?>">我的信息</a></li>
				        		<li><a href="<?php echo U('Home/User/User/userList');?>">用户管理</a></li>
				        		<li><a href="<?php echo U('Home/Shop/Shop/websPortal');?>">购物门户网站管理</a></li>
				        	</ul>
				        </li>




				    </ul>
				<div class="collapse navbar-collapse" id="mynavbar" >

			  </div><!-- /.container -->
			</nav>
	</div>
</div>

<!-- 登陆模态框 -->
<div class="modal fade login_modal" tabindex="-1" id="login_modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
				<h4 class="modal-title">请输入用户名和密码</h4>
			</div>
			<div class="modal-body">
				
				<form class="form-horizontal" id="loginForm">
					<div class="form-group">
						<label for="#input_username" class="col-md-3 control-label">用户名:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" id="input_username">
						</div>
					</div>
					<div class="form-group">
						<label for="#input_password" class="col-md-3 control-label">密码:</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" id="input_password">
						</div>
					</div>
					<div class="form-group" >
						<label for="" class="col-md-3 control-label">验证码图片</label>
						<div class="col-md-6">
							<img src="" onclick="this.src=this.src+'?'+Math.random()">
						</div>
					</div>
					<div class="form-group">

						<label for="#input_verifyCode" class="col-md-3 control-label">请输入验证码:</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="verifyCode" id="input_verifyCode">
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-offset-7">
							<a href="<?php echo U('Home/Login/Login/register');?>" style="margin-left: 20px">注册</a>
						</div>
					</div>

					<!-- 功能未完善 -->
					<!-- <div class="from-group">
						<div class="col-md-offset-3">
							<div class="checkbox">
								<label>
									<input type="checkbox" style="margin-top: 1px" name="isRememberMe"> 记住密码
								</label>
							</div>
						</div>
					</div> -->
					<dir class="form-group">
						<div class="alert" id="login_message"></div>
					</dir>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" id="login_btn">登陆</button>
				<button type="button" class="btn" data-dismiss="modal">取消</button>
				
			</div>
		</div>
	</div>
</div>
				

<!-- 右下角回到顶部，暂时放在这里 -->
<div class='col-md-1'>
	<div class='scroll-top'>
		<span class='glyphicon glyphicon-menu-up'></span>
	</div>
</div>