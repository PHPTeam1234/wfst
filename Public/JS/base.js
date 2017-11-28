$(document).ready(function(){

	//右下角回到顶部按钮
	$(window).scroll(function(){
		$('.scroll-top').show();
		if($(window).scrollTop()<100){
			$('.scroll-top').hide();
		}
	});

	$('.scroll-top').click(function(){
       
        $('body,html').animate({ scrollTop: 0 }, 500);

	});

    


     


     

	
	$(function(){
		// bootstrap 3 没有submenu, 以下导入 submenu
		$('[data-submenu]').submenupicker();

		// 导入 bootstrap 中的 tooltip
		$('[data-toggle="tooltip"]').tooltip();


	});

	//ajax 登陆
    $('#login_btn').click(function(){
    	       //由于js 中不能使用U方法， 故 $ajaxLoginUrl 变量在 footer.html 中定义 


             $.post($ajaxLoginUrl, $("#loginForm").serialize(), function($data){
                // console.log($data.requestStatus);
                // alert($data.info);
                if($data.loginStatus == 1){
                	//登陆成功
                	// console.log($data.requestStatus);
                	// console.log($data.info);
                	console.log(1);
                	console.log($data);

                	
                    // 修改导航栏样式
                	$("#nav_username").html($data.username + "<span class='caret'/>");

                	$("#nav-user-block-dropToggle").addClass('dropdown-toogle');
                	$("#nav-user-block-dropToggle").attr('data-toggle','dropdown');
                	$("#nav-user-block-dropToggle").attr('data-target','');
                	$("#nav-user-block-dropToggle").attr("href","#")


                    $("#footer-register-link").hide(); //注册按钮消失
                	// 模态框消失
                	$('#login_modal').modal('hide');

                }
                else {
                	//登陆失败

                	$("#input_password").val(null);
                	$("#input_verifyCode").val(null);
                	$("#login_message").html($data.info);
                    console.log($data);
                }
        

             }, "json");  //使用json格式
             
		    
	});
	
	// ajax 注销
	$('#logout_link').click(function(){

		   $.post($ajaxLogoutUrl, function($data){
              
                 if ( $data.logoutStatus == 1 )
                 {
                 	// 注销成功
                    
                     console.log($data);
                    // 修改导航栏样式
                	$("#nav_username").html("未登录");

                	$("#nav-user-block-dropToggle").removeClass('dropdown-toogle');
                	$("#nav-user-block-dropToggle").attr('data-toggle','modal');
                	$("#nav-user-block-dropToggle").attr('data-target','#login_modal');
                	$("#nav-user-block-dropToggle").attr("href","javascript:void(0);")

                    $("#footer-register-link").show();  //注册按钮显示

                    window.location.href=$data.redirect_location;  //退出后返回主页
                 }else {
                      // 注销失败

                 }

		   }, "json");

	});


	// ajax 用户注册
	$("#register_btn").click(function(){
		$.post( $ajaxRegisterUrl , $("#registerForm").serialize(), function($data){
                 if($data.registerStatus == 1){
                 	// 注册成功
                 	$('#register_password').val(null);
                   $('#register_modal').modal('hide');

                 }else {
                 	// 注册失败
                 	$('#register_password').val(null);
                    $("#register_message").html($data.info);
                 }
	      }, "json");
	
	});

     // 每次打开包含验证码的模态框就刷新验证码
	$(".login_modal").on( 'show.bs.modal',function(e){
         
         $newVerifyCode = $verifyCodeUrl + "?" + Math.random();
         $(this).find("img").attr("src", $newVerifyCode);
        
         // 
         $("#input_password").val(null);
         $("#input_verifyCode").val(null);
         $("#login_message").html(null);
	});
	
	



});