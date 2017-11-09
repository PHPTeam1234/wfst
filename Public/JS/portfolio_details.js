
$( document ).ready(function (){
    $(".video_container .video_container_l a.video_play").click( function(){
         
            // 获取登陆状态和视频信息
            $videoInfo = $.ajax( {
                url: $ajaxGetVideoInfo,
                dataType: "json",
                async: false,
                type: "POST",
            } ).responseJSON;
            
            console.log( $videoInfo);

            if ( $videoInfo.loginStatus ) {
                $(this).siblings("img").hide();
                $(this).siblings("video").show();
                $(this).siblings("video").attr("src",$videoInfo.videoLocation);
                $(this).siblings("video")[0].play();
                $(this).siblings("video").attr("controls", "true");
                $(this).siblings("span").remove();
                $(this).hide();
            }
            else {
                $(this).attr("data-toggle", "popover").attr("data-content","需要登陆才能播放视频");
                $(this).popover('show');
                // $(this).popover('hide');
               

                var id = setTimeout(
                    function () {
                        $(".video_container .video_container_l a.video_play").popover('hide'); //
                    }, 2000
                );

            }
            return false;
    });

});