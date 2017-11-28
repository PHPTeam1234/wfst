$( document ).ready( function() {
        $formValidate = $( ".passwordChangeForm" ).validate( {
        	rules: {
        		oldPassword: {
        			required: true,
        		},
        		newPassword: {
        			required: true,
        			minlength: 5,
        		},
        		newPasswordConfirm: {
        			required: true,
        			equalTo: "#userInfo_newPassword",
        			minlength: 5,
        		}
				},
				messages: {
					oldPassword: {
						required: "请输入原始密码",
						email: "请输入正确的邮箱地址格式"
					},
					newPassword: {
						required: "请输入新密码",
						minlength: "新密码长度 >= 5",
					},
					newPasswordConfirm: {
						required: "请输入确认密码密码",
						equalTo: "确认密码必须和新密一致",
						minlength: "确认密码密码长度 >= 5",
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
