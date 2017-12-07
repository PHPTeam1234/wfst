$(document).ready(function(){
	$formValidate = $( ".webPortalInfoForm" ).validate( {
        	rules: {
        		web_name: {
        			required: true,
        		},
        		web_desc: {
        			required: true,
        		},
        		web_address: {
        			required: true,
        			url: true,
        		},
        		show_rank: {
        			required: true,
        		}
				
				},
				messages: {
					
					web_name: {
						required: "请输入网站名称",
					},
					web_desc: {
						required: "请输入网站描述",
					},
					web_address: {
						required: "请输入网站地址",
						url: "请输入正确的网站格式 (必须为 http://example.com  或者 https://example.com)"
					},
					show_rank: {
						required: "请输入网站排名",
					},
					
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
 

