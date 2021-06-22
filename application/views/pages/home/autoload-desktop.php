<!-- Desktop Script -->
<script type="text/javascript">

	//INITIAL VARIABLE
	var limit = 1;
	var start = 1;
	var loadCounter = 1;
	var action = 'inactive';

	$(document).ready(function () {

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

			var tech = getUrlParameter('id');

			$.ajax({
	        	url:"<?php echo base_url('ContentLoad/autoloadHome'); ?>",
	        	method:"POST",
				data:{limit:limit, start:start, id:tech, counter: loadCounter},
	        	cache: false,
	        	success:function(data) {
					if(data == '') {
						$('#loader-icon').html('<h3>No More Result Found</h3>');
			            	action = 'active';
			          	} else {
			            	$('#product-main-list').append(data);
			            	action = 'inactive';
			          	}
	        	}
	      	})
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

	});

	//LOAD THE DATA MANUALLY
	function manualLoad() {

	//REMOVE THE CLICKED BUTTON FIRST
	$('.load-more-content').remove();
	$('#loader-icon').append(`
			<div class="col-12 col-md-12 col-lg-12 col-xl-12">
					<div class="d-flex justify-content-center">
						<div class="lds-roller pt-4 pb-5">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
					</div>
				</div>`);

	//GET THE URL IF ID IS SELECTED
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

	var tech = getUrlParameter('id');

	$.ajax({
		url:"<?php echo base_url('ContentLoad/autoloadHome'); ?>",
		method:"POST",
		data: { limit:limit, start:start, id:tech, counter: loadCounter },
		cache: false,
		success:function(data) {
			if(data == '') {
				$('#loader-icon').html('<h3>No More Result Found</h3>');
				action = 'active';
			} else {
				$('#product-main-list').append(data);
				action = 'inactive';
			}
		}
	});
	}
	
</script>
