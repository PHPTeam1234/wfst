( function() {

	$.validator.setDefaults( {
        submitHandler: function ( form ) {
                // $('#registerForm').submit(); 这样写会出现死循环
                form.submit();
            }
        } );

	// Older "accept" file extension method. Old docs: http://docs.jquery.com/Plugins/Validation/Methods/accept
    $.validator.addMethod( "extension", function( value, element, param ) {
    	param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
    	return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    }, $.validator.format( "Please enter a value with a valid extension." ) );


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
    

}() );
