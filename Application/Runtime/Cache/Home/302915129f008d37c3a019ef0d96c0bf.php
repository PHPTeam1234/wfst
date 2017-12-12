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
    <!-- 自身css -->
    <link rel="stylesheet" type="text/css" href="/wfst/Public/css/shop/webPortalList.css">
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

</head>
<body>
	 <header>
	 	<?php echo W("Navigation/nav1");?>
	 </header>
    
	 <div class="container">

	 	  <div class="panel panel-webPortalList">
	 	  	<div class="panel-headding">
	 	  		<h4>购物门户网站页面管理</h4>
	 	  		<a class="btn btn-success" href="<?php echo U('Home/Shop/Shop/webPortalAdd');?>">增加购物门户网站信息</a>
	 	  	</div>
	 	  	<table class="table">
	 	  		<tr>
	 	  			<!-- <th>序号</th> -->
	 	  			<th>门户网站id</th>
	 	  			<th>门户网站名称</th>
	 	  			<th>门户网站描述</th>
	 	  			<th>门户网站地址</th>
	 	  			<th>门户网站显示排名</th>
	 	  			<th>修改时间</th>
	 	  		</tr>
	 	  		<?php if(is_array($websPortal)): $i = 0; $__LIST__ = $websPortal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$web): $mod = ($i % 2 );++$i;?><tr class="table-data-row">
	 	  				<!-- <td><?php echo ($firstRecordNum++); ?></td> -->
	 	  				<td name="web_id"><?php echo ($web["web_id"]); ?></td>
	 	  				<td name="web_name"><?php echo ($web["web_name"]); ?></td>
	 	  				<td name="web_address"><?php echo ($web["web_address"]); ?></td>
	 	  				<td name="web_desc" value="<?php echo ($web["web_desc"]); ?>"><?php echo (mb_substr($web["web_desc"],0,40,'utf-8')); ?>...</td>
	 	  				<td name="show_rank"><?php echo ($web["show_rank"]); ?></td>
	 	  				<td><?php echo (date("Y-m-d",$web["edit_time"])); ?></td>
	 	  				<td>
	 	  					<div class="btn-group">
	 	  						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	 	  							操作<span class="caret"></span>
	 	  						</button>
	 	  						<ul class="dropdown-menu">
	 	  							<li><a href="<?php echo U('Home/Shop/Shop/webPortalInfo', array('web_id'=>$web['web_id']));?>" name="webPortalUpdate">修改门户网站信息</a></li>
	 	  							<li><a href="<?php echo U('Home/Shop/Shop/webPortalDelete', array('web_id'=>$web['web_id']));?>" name="webPortalDelete">删除</a></li>
	 	  						</ul>
	 	  					</div>
	 	  				</td>
	 	  			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	 	  	</table>
	 	  	
	 	  </div>
	 </div>

	 <footer>
	 	<?php echo W("Footer/footer");?>
	 </footer>

</body>

<script>

	
$(document).ready(function(){

	$(".panel-webPortalList table .table-data-row a[name='webPortalDelete']").click(function(){
		$web_name = $(this).parents(".table-data-row").find("td[name='web_name']").text();
		$isConfirm = confirm("是否确定删除购物门户网站：" + $web_name + "?");
		if ( !$isConfirm ){
			// 若为 false, 收起下拉菜单
			$(this).parents(".table-data-row").find(".dropdown-toggle").dropdown('toggle');
		}
		return $isConfirm ? true : false;

	});
	

});
</script>
	
</html>