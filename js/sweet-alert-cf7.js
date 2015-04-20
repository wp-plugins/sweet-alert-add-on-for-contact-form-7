jQuery(function($) {
	$(".wpcf7-submit").click(function(event) {
		var messageOutput = $(this).closest("form").children(".wpcf7-response-output");
		$(document).ajaxComplete(function() {
			var message = $(messageOutput).html();
			var validMessage = function(){
				swal({
					type: "success",
					title: "",
					text: message,
					timer: 2500,
					showConfirmButton: false
				});
			};
			var errorMessage = function(){
				swal({
					type: "warning",
					title: "",
					text: message,
					timer: 3500,
					showConfirmButton: false
				});
			};
			setSwal = $(".wpcf7-response-output").hasClass("wpcf7-validation-errors") ? "alert" : "success";
			if ( setSwal === "alert" ) { errorMessage() };
			if ( setSwal === "success" ) { validMessage() };
		});
	});
});