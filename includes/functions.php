<?php

function clublive_scripts_method() {
	wp_enqueue_script(
		'sweet-alert-script',
		plugin_dir_url( __FILE__ ) . '../lib/sweet-alert/js/sweet-alert.min.js'
	);
	wp_enqueue_style(
		'sweet-alert-styles',
		plugin_dir_url( __FILE__ ) . '../lib/sweet-alert/css/sweet-alert.css'
	);
	wp_enqueue_style(
		'alter-cf7',
		plugin_dir_url( __FILE__ ) . '../css/alter-cf7.css'
	);
}
add_action('wp_enqueue_scripts', 'clublive_scripts_method');


function swall_cf7_scripts() {
$title_success = get_option('swal_cf7_title_success');
$duration_success = get_option('swal_cf7_duration_success');
$title_error = get_option('swal_cf7_title_error');
$duration_error = get_option('swal_cf7_duration_error');
?>
<script type="text/javascript">
jQuery(function($) {
	$(".wpcf7-submit").click(function(event) {
		var messageOutput = $(this).closest("form").children(".wpcf7-response-output");
		$(document).ajaxComplete(function() {
			var message = $(messageOutput).html();
			var validMessage = function(){
				swal({
					type: "success",
					title: "<?php echo $title_success; ?>",
					text: message,
					timer: <?php if(empty($duration_success)) { echo '3000'; } else { echo $duration_success; } ?>,
					showConfirmButton: false
				});
			};
			var errorMessage = function(){
				swal({
					type: "warning",
					title: "<?php echo $title_error; ?>",
					text: message,
					timer: <?php if(empty($duration_error)) { echo '3000'; } else { echo $duration_error; } ?>,
					showConfirmButton: false
				});
			};
			setSwal = $(".wpcf7-response-output").hasClass("wpcf7-validation-errors") ? "alert" : "success";
			if ( setSwal === "alert" ) { errorMessage() };
			if ( setSwal === "success" ) { validMessage() };
		});
	});
});
</script>
<?php
}
add_action( 'wp_footer', 'swall_cf7_scripts' );

?>