<script type="text/javascript">
	
	//INITIAL VARIABLE
	var limit = 1;
	var start = 1;
	var loadCounter = 1;
	var action = 'inactive';

	function load_data(limit, start) {

		var getUrlParameter = function getUrlParameter(sParam) {
			var sPageURL = window.location.search.substring(1);
	        var sURLVariables = sPageURL.split('&');
	        var sParameterName;
	        var i;

	    	for (i = 0; i < sURLVariables.length; i++) {
	        	sParameterName = sURLVariables[i].split('=');
	        		if (sParameterName[0] === sParam) {
	            		return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
	        		}
	    		}
			};

		var query = getUrlParameter('query');

		$.ajax({
			url:"<?php echo base_url('ContentLoad/autoloadSearch'); ?>",
			method:"POST",
			data:{limit:limit, start:start, query:query, counter: loadCounter},
			cache: false,
			success:function(data) {
				if(data == '') {
					$('#loader-icon').html("<div class='col-12'><h3 class='mt-2 ml-2'>No Result Found for '"+query+"'</h3></div>");
					action = 'active';
				} else {
					$('#product-main-list').append(data);
					action = 'inactive';
				}
			}
		});
	}

	if(action == 'inactive') {
		action = 'active';
		load_data(limit, start);
	}

	$(window).scroll(function() {

		//ONLY RUN IF THE COUNTER IS LESS THAN 4
		if(loadCounter < 4) {
			if($(window).scrollTop() + $(window).height() > $("#product-main-list").height() && action == 'inactive') {
				action = 'active';
				start = start + limit;
				loadCounter++;
				setTimeout(function() {
					load_data(limit, start);
				}, 1000);
			}
		} else if(loadCounter == 4) {
				//REMOVE THE PREVIOUS PLACEHOLDER
				$('#loader-icon').remove();
		}
	});

</script>