
$( document ).ready( function() {

        $formValidate = $( "#videoAddForm" ).validate( {
        	rules: {
        		video_title: {
        			required: true
        		},
        		video_desc: {
        			required: true
        		},
        		video_verifyCode: {
        			required: true,
        			verifyCode: true
        		},
        		video_file: {
        			required: true,
        			extension: 'mp4'
        		}
        		
				},
				messages: {
					video_title: {
						required: "请输入视频标题",
					},
					video_desc: {
						required: "请输入视频描述",
					},
					video_verifyCode: {
						required: "请输入确认密码",
						verifyCode: "请输入正确的验证",
					},

					video_file: {
						required: "请选择视频文件",
						extension: "上传的视频文件必须为: {0}"
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
