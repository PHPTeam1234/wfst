$(function (){

	//后台管理导航菜单
	var menu = $("#menu").val();
	$(".list-group .active").nextAll().hide();
	if(menu != ""){
		$(".list-group ."+menu).nextAll().show();
	}
	$(".list-group .active").click(function (){
		$(this).nextAll().toggle();
		$(".list-group .active").not($(this)).nextAll().hide();
	});

	$("a[name='deletebtn']").click(function (){
		var url = $(this).attr("href");
		var id = $(this).attr("accesskey");
		var data = {"id":id,"date":new Date()};
		var line = $(this).parent().parent();
		$.post(url,data,function (data){
			if(data == 1){
				//删除成功
				line.remove();
			}else{
				//删除失败
				alert("服务器繁忙！请重试！");
			}
		});
		return false;
	});

	

});

/**
	购物网站编辑器
*/
var editor;
KindEditor.ready(function(K) {
	editor = K.create('textarea[name="web_desc"]', {
		resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		items : [
			'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
			'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
			'insertunorderedlist', '|', 'emoticons', 'image', 'link']
	});
});