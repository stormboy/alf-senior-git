
    $(window).ready(function() {

		swapValue = [];
		$("#search-wrap input.text, form input.text").each(function(i){
		   swapValue[i] = $(this).val();
		   $(this).focus(function(){
			  if ($(this).val() == swapValue[i]) {
				 $(this).val("");
			  }
			  $(this).addClass("focus");
		   }).blur(function(){
			  if ($.trim($(this).val()) == "") {
				 $(this).val(swapValue[i]);
			 $(this).removeClass("focus");
			  }
		   });
		});

		$("select").selectBox();

    });

	$(window).load(function() {

	});