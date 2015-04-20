<?php
/*
Plugin Name: Sweet Alert add-on for CF7
Description: Add Sweet Alert script in Contact Form 7 submission process.
Version: 0.2
Author: Antoine Derrien
Author URI: http://clublive.fr
*/

function load_swal_cf7_wp_admin_style() {
        wp_register_style( 'swal_cf7_wp_admin_css', plugin_dir_url( __FILE__ ) . '/css/admin.css', false, '1.0.0' );
        wp_enqueue_style( 'swal_cf7_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_swal_cf7_wp_admin_style' );


// Call swal_cf7_duration_menu function to load plugin menu in dashboard
add_action( 'admin_menu', 'swal_cf7_duration_menu' );

// Create WordPress admin menu
if( !function_exists("swal_cf7_duration_menu") )
{
function swal_cf7_duration_menu(){

  $page_title = 'SweetAlert for CF7';
  $menu_title = 'SwAl CF7';
  $capability = 'manage_options';
  $menu_slug  = 'swal-cf7-info';
  $function   = 'swal_cf7_settings_page';
  $icon_url   = 'dashicons-testimonial';
  $position   = 30;

  add_menu_page( $page_title,
                 $menu_title,
                 $capability,
                 $menu_slug,
                 $function,
                 $icon_url,
                 $position );

  // Call update_swal_cf7_duration function to update database
  add_action( 'admin_init', 'update_swal_cf7_duration' );

}
}

// Create function to register plugin settings in the database
if( !function_exists("update_swal_cf7_duration") )
{
function update_swal_cf7_duration() {
  register_setting( 'swal-cf7-info-settings', 'swal_cf7_duration_success' );
  register_setting( 'swal-cf7-info-settings', 'swal_cf7_duration_error' );
  register_setting( 'swal-cf7-info-settings', 'swal_cf7_title_success' );
  register_setting( 'swal-cf7-info-settings', 'swal_cf7_title_error' );
}
}

// Create WordPress plugin page
if( !function_exists("swal_cf7_settings_page") )
{
function swal_cf7_settings_page(){
?>
<div class="swal-cf7__container">
  <h2>SweetAlert for CF7 | Settings</h2>
  <form method="post" action="options.php">
    <?php settings_fields( 'swal-cf7-info-settings' ); ?>
    <?php do_settings_sections( 'swal-cf7-info-settings' ); ?>
	  <h4>Success Alert</h4>
      <p>Timer (default is 3000) <input type="text" name="swal_cf7_duration_success" value="<?php echo get_option('swal_cf7_duration_success'); ?>"/> ms</p>
	  <p>Title (default none) : <input type="text" name="swal_cf7_title_success" value="<?php echo get_option('swal_cf7_title_success'); ?>"/></p>
	  <hr />
	  <h4>Success Alert</h4>
      <p>Timer (default is 3000) <input type="text" name="swal_cf7_duration_error" value="<?php echo get_option('swal_cf7_duration_error'); ?>"/> ms</p>
	  <p>Title (default none) : <input type="text" name="swal_cf7_title_error" value="<?php echo get_option('swal_cf7_title_error'); ?>"/></p>
  <?php submit_button(); ?>
  </form>
  <sidebar>
	<p>This plugin adds the <a href="http://tristanedwards.me/sweetalert" target="_blank">Sweet Alert</a> script into Contact Form 7 wordpress plugin submission process.</p>
	<p>This plugin requires the <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> plugin to work.</p>
	<p>Just activate it to replace CF7 default submission output by a Sweet Alert pop up. The add-on will display the Contact Form 7 messages in the pop up.</p>
	<p>You also can customize duration and title of success/error alert.</p>
	<a class="button button-primary" href="https://wordpress.org/support/view/plugin-reviews/sweet-alert-add-on-for-contact-form-7" target="_blank">Rate this plugin</a>
  </sidebar>
  <header>
	<a href="http://clublive.fr/demo" target="_blank">Demo page</a> &bull; <a href="https://wordpress.org/support/plugin/sweet-alert-add-on-for-contact-form-7" target="_blank">Support</a> &bull; <a href="http://antoine.clublive.fr" target="_blank">Author</a>
  </header>
</div>
<?php
}
}

require 'includes/functions.php'; /* customs scripts */

?>
