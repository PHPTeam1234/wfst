<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>购物门户网站</title>
	<link rel="stylesheet" type="text/css" href="/wfst/Public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/wfst/Public/bootstrap/css/bootstrap-submenu.min.css">
	<!-- 公共css文件 -->
	<!-- <link rel="stylesheet" type="text/css" href="/wfst/Public/css/base.css"> -->
	<link rel="stylesheet" type="text/css" href="/wfst/Public/css/index1/index1.css">
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/wfst/Public/bootstrap/js/bootstrap-submenu.min.js"></script>
	<!-- scroll-top & submenu -->
	<script type="text/javascript" src="/wfst/Public/js/base.js"></script>
</head>
<style>
.panel-bgcolor{
	background-color: #33383a;
}
</style>

<body>
	<nav>
		<?php echo W('Navigation/nav1');?>
	</nav>

	<div class='row top_head_label'>
		<div class="container">
			<div class='col-md-12 '>
				<h3>购物门户网站</h3>
			</div>
		</div>
	</div>

	<main class='main'>
		<div class='container'>
			<div class='row'>
  				<div class='col-md-2'>
					<!-- 文峰视听门户网站经营理念 -->
					<h4 class="nav-left-list-title">点击进入网站</h4>
					<ul class='nav-left-list'>
						<?php if(is_array($websPortal)): $i = 0; $__LIST__ = $websPortal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["web_address"]); ?>"><?php echo ($vo["web_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>


				<div class='col-md-10'>

					<?php if(is_array($websPortal)): $i = 0; $__LIST__ = $websPortal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class='panel panel-bgcolor'>
						<div class='panel-heading'>
							<h3><?php echo ($vo["web_name"]); ?></h3>
						</div>
						<div class='panel-body shop_webportal_desc'>
							<?php echo ($vo["web_desc"]); ?>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>

						
					</div>
				</div>
			</div>
			
		</div>
	</main>

    <footer>
    	<?php echo W('Footer/footer');?>
    </footer>

</body>
<script>
</script>
</html>