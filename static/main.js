	$(function(){
		var pic1 = new Image(100,25); 
		pic1.src="ajax-loader.gif"; 
		
		
	    $("header form").submit(function(){

	    	var format 		= $('input[name=format]').val();
	    	var selector 	= $('input[name=selector]').val();
	    	var increase 	= $('input[name=increase]').val();
	    	var start 		= $('input[name=start]').val();
	    	var limit 		= $('input[name=limit]').val();
	    	
	    	

			if (!format || !selector) {
				alert("Please fill form fields");
				return false;
			} else if (format.indexOf("%d") == -1) {
				alert("Please use the %d placeholder for page number");
				return false;
			}

	    	$("#placeholder").text(" ").removeClass("loaded").addClass("loading").load("index.php #content", { 
		    	'format': format, 
		    	'selector': selector, 
		    	'increase': increase,
		    	'limit' : limit,
		    	'start' : start
		    	}, function() {
	    			$(this).removeClass("loading").addClass("loaded");
	        });

			
			return false;
	    });

	    $('fieldset legend').click(function() {
			$(this).parent().toggleClass('expanded');
		});

        if ($('#placeholder ol').size() > 0) {
			$('#placeholder').addClass('loaded');
		}
		
	 });