$.validator.setDefaults( {
	submitHandler: function ( form ) {
				// alert( "submitted!" );
				// $('#registerForm').submit(); 这样写会出现死循环
				form.submit();
			}
		} );



$( document ).ready( function() {
        // 添加验证码方法
        $.validator.addMethod( "verifyCode", function( value, element ) {
    	// 如验证码长度修改时，此处也需要修改
    	if ( value.length == 5 ) {

    		$isVerifyCodeCorrect = $.ajax( {
    			url: $ajaxGetVerifyCode,
    			data:  "ajaxVerifyCodeSent=" + value,
    			type: "POST",
              	async: false,  //使用同步方式
              	dataType: "json",
              	// complete: function($data){ console.log($data); }
              }).responseJSON;
    		console.log($isVerifyCodeCorrect.verifyStatus);
    		 // verifyStatue : true 验证码正确， false 验证码错误
    		 return $isVerifyCodeCorrect.verifyStatus;
    		}

          // 长度不等直接 false
          return false;
      });



        $formValidate = $( "#registerForm" ).validate( {
        	rules: {
        		username: {
        			required: true,
        			minlength: 2
        		},
        		password: {
        			required: true,
        			minlength: 5
        		},
        		confirmPassword: {
        			required: true,
        			minlength: 5,
        			equalTo: "#register_password"
        		},
        		email: {
        			required: true,
        			email: true
        		},
					// agree1: "required"
				verifyCode: {
					required: true,
					verifyCode: true
				}
				},
				messages: {
					username: {
						required: "请输入用户名",
						minlength: jQuery.validator.format("用户名至少包含{0}个字符"),
					},
					password: {
						required: "请输入密码",
						minlength: jQuery.validator.format("你的密码至少包含{0}个字符"),
					},
					confirmPassword: {
						required: "请输入确认密码",
						equalTo: "确认密码和密码必须相同",
						minlength: jQuery.validator.format("你的确认密码至少包含{0}个字符"),
					},
					email: {
						required: "请输入邮箱地址",
						email: "请输入正确的邮箱地址格式"
					},
					verifyCode: {
						required: "请输入验证码",
						verifyCode: "验证码错误！"
					}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-md-3" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-md-3" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-md-3" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );

    });
