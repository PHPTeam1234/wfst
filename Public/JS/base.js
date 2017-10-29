$(document).ready(function(){

	//右下角回到顶部按钮
	$(window).scroll(function(){
		$('.scroll-top').show();
		if($(window).scrollTop()<100){
			$('.scroll-top').hide();
		}
	});

	$('.scroll-top').click(function(){
		$(window).scrollTop(0);

	});

	
	$(function () {
		// bootstrap 3 没有submenu, 以下导入 submenu
		$('[data-submenu]').submenupicker();

		// 导入 bootstrap 中的 tooltip
		$('[data-toggle="tooltip"]').tooltip();
	});

	



});