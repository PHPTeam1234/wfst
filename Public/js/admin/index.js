$(function (){
	var menu = $("#menu").val();
	$(".list-group .active").nextAll().hide();
	if(menu != ""){
		$(".list-group ."+menu).nextAll().show();
	}
	$(".list-group .active").click(function (){
		$(this).nextAll().toggle();
		$(".list-group .active").not($(this)).nextAll().hide();
	});
});