<?php
// =================================== //
// ========= THEME FUNCTIONS ========= //
// =================================== //


// Add menus capability
function register_my_menus(){
  register_nav_menus(
    array(
      'main-menu' => 'Main Menu',
    )
  );
}
add_action( 'init', 'register_my_menus' );


// Add thumbnail support for posts
add_theme_support( 'post-thumbnails', array( 'post' ) );


// Custom Image Sizes
if (function_exists('add_image_size')) {
	add_image_size('panel_bg', 1400, 600, true); // required for flexible content!
	add_image_size('panel_bg_mobile', 768, 800, true); // required for flexible content!
}


// Custom login logo (274 x ~80)
/*
function my_login_logo() {
	echo '<style type="text/css">body.login div#login h1 a {background-image: url(\'' . get_bloginfo( 'template_directory' ) . '/images/login-logo.png\');width:320px;height:80px;background-size:contain;margin-bottom:30px}</style>';
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );
*/


// Disable Menus and Meta Boxes
if (is_admin()) :

	function seed_remove_menus(){

		// Disable "Posts"
		//remove_menu_page('edit.php');

		// Disable "Comments"
		remove_menu_page('edit-comments.php');

		// Disable "Customize"
		global $submenu;
		unset($submenu['themes.php'][6]);

		// Hide "Tools" from non-admins
		if ( ! current_user_can('manage_options') ){
			global $menu;
			unset($menu[75]);
		}

		// Disable meta boxes in posts
		remove_meta_box('postcustom', 'post', 'normal');
		remove_meta_box('slugdiv', 'post', 'normal');
		remove_meta_box('commentsdiv', 'post', 'normal');
		remove_meta_box('trackbacksdiv', 'post', 'normal');
		remove_meta_box('commentstatusdiv', 'post', 'normal');
		//remove_meta_box('postexcerpt', 'post', 'normal');
		//remove_meta_box('authordiv', 'post', 'normal');

	}

	add_action( 'admin_menu', 'seed_remove_menus' );

endif;


// Add ACF Options pages
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Theme Options');
}


// ACF Google Maps API Key
function my_acf_init() {
	global $google_api_key;
	acf_update_setting('google_api_key', $google_api_key);
}
add_action('acf/init', 'my_acf_init');
?>
