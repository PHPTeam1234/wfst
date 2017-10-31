    $(document).ready(function(){


       $(".collapse-panel-a").each(function(index,element){
            var collapseId = $(this).attr('href');
            // alert(collapseId);
            var collapseStatus = $(collapseId).attr('class');
            // alert(collapseStatus);
            if (collapseStatus == 'panel-collapse collapse in'){
                
                 $(this).addClass("active");
            }

       });
 

         
		$(".collapse-panel-a").click(function(){
			var position = $(this).find('span').css('background-position');
			if (position == "0px 0px"){
			    var parentID = $(this).attr('data-parent');
			    $(this).addClass("active");
			    $(parentID).find('a').not($(this)).removeClass("active");

			}else{
				$(this).removeClass("active");
			}

		});

		
});