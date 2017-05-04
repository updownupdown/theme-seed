<?php
// Google API Key
$google_api_key = 'AIzaSyDK7N9xRGx6pQctHZuchp6I9ME6ZVGxqeY';

// ============================== //
// ====== Styles & Scripts ====== //
// ============================== //
if(!is_admin()){ add_action('wp_enqueue_scripts', 'my_scripts_enqueue'); }
function my_scripts_enqueue(){

	// Main CSS styles, with auto versioning
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/build/css/styles.min.css', array(), filemtime( get_stylesheet_directory() . '/build/css/styles.min.css' ) );

	// Local server stylesheet
	if ( $_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1' ) {
		wp_enqueue_style('local', get_stylesheet_directory_uri() . '/build/css/local.min.css', array(), filemtime( get_stylesheet_directory() . '/build/css/local.min.css' ) );
	}

	// jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1', false);
	wp_enqueue_script('jquery');

	// jQuery UI
	wp_deregister_script('jquery-ui');
	wp_register_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1', true);
	wp_register_script('theme-jquery-ui', get_template_directory_uri() . '/build/js/theme-jquery-ui.min.js', array('jquery', 'jquery-ui'), '1.0', true);
	//wp_enqueue_script('jquery-ui');

	// Global
	wp_register_script('global', get_template_directory_uri() . '/build/js/global.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('global');

	// Flexslider
	wp_register_script('flexslider', get_template_directory_uri() . '/js/libs/jquery.flexslider-min.js', array('jquery'), '2.6.3', true);
	wp_register_script('theme-flexslider', get_template_directory_uri() . '/build/js/theme-flexslider.min.js', array('jquery', 'flexslider'), '1.0', true);
	//wp_enqueue_script('flexslider');

	// lightGallery
	wp_register_style('lightgallery-css', get_template_directory_uri() . '/js/libs/lightgallery/css/lightgallery-custom.css');
	wp_register_script('lightgallery-js', get_template_directory_uri() . '/js/libs/lightgallery/js/lightgallery-custom.js', array('jquery'), '1.0', true);
	wp_register_script('theme-lightgallery', get_template_directory_uri() . '/build/js/theme-lightgallery.min.js', array('jquery', 'lightgallery-js'), '1.0', true);
	// wp_enqueue_style('lightgallery-css');
	// wp_enqueue_script('lightgallery-js');

	// ACF Maps
	global $google_api_key;
	wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key, null, '1.0', true);
	wp_register_script('acf-maps', get_template_directory_uri() . '/build/js/acf-maps.min.js', array('googlemaps'), '1.0', true);
	//wp_enqueue_script('script-acf-maps');

	// SVG support for IE
	wp_register_script('svgxuse', get_template_directory_uri() . '/js/libs/svgxuse.min.js', null, '1.2.4', true);
	wp_enqueue_script('svgxuse');

}

// Gravity Forms
function enqueue_custom_gf_script(){
	wp_register_script('script-gforms-custom', get_template_directory_uri() . '/build/js/gravity-forms.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('script-gforms-custom');
}
add_action( 'gform_enqueue_scripts', 'enqueue_custom_gf_script', 10, 2 );


// ============================== //
// ===== CUSTOM IMAGE SIZES ===== //
// ============================== //

if (function_exists('add_image_size')) {
	add_image_size('panel_bg', 1400, 600, true); // required for flexible content!
	add_image_size('panel_bg_mobile', 768, 800, true); // required for flexible content!
}


// ============================= //
// ===== CUSTOM POST TYPES ===== //
// ============================= //

/*
add_action( 'init', 'create_custom_post_types' );
function create_custom_post_types() {

	// SINGULAR
	$SINGULAR_args = array(
		'labels' => array(
			'name' => 'SINGULARs',
			'singular_name' => 'SINGULAR',
			'add_new' => 'Add New SINGULAR',
			'add_new_item' => 'Add New SINGULAR',
			'edit_item' => 'Edit SINGULAR',
			'new_item' => 'New SINGULAR',
			'view_item' => 'View SINGULAR',
			'search_items' => 'Search SINGULARs',
			'not_found' => 'No SINGULARs found',
			'not_found_in_trash' => 'No SINGULARs found in Trash'
		),
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_bloginfo('template_url').'/images/cpt-SINGULAR.png',
		'supports' => array(
			'title',
			'revisions',
		),
		// 'menu_position' => 20,
	);

	register_post_type( 'SINGULAR', $SINGULAR_args);
}
*/


// ============================= //
// ===== CUSTOM TAXONOMIES ===== //
// ============================= //
/*
add_action( 'init', 'custom_taxonomies' );
function custom_taxonomies() {

	// Foo Category
	register_taxonomy(
		'foo_cat',
		'foo',
		array(
			'hierarchical' => true,
			'label' => 'foo Categories',
			'query_var' => true,
			'rewrite' => array('slug' => 'foo_cat')
		)
	);
}
*/


// ========================== //
// ===== CUSTOM COLUMNS ===== //
// ========================== //

// CPTNAME - Custom Columns
/*
add_filter( 'manage_edit-CPTNAME_columns', 'CPTNAME_edit_columns');
function CPTNAME_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => 'Title',
		"CPTNAME_text" => 'Text',
		"CPTNAME_cat" => 'Categories',
		"CPTNAME_image" => 'Image',
	);
	return $columns;
}

add_action( 'manage_CPTNAME_posts_custom_column', 'CPTNAME_columns');
function CPTNAME_columns($column){
	global $post;
	switch ($column) {
		case "CPTNAME_text":
			echo get_field('slide_text', $post->ID);
			break;
		case "CPTNAME_cat":
			$cat_list = '';
			$terms = get_the_terms( $post->ID, 'CATEGORY_SLUG' );
			if ( $terms && ! is_wp_error( $terms ) ) :
			    $cat_array = array();
			    foreach($terms as $term){ $cat_array[] = $term->name; }
			    $cat_list = join(', ', $cat_array);
			endif;
			echo $cat_list;
			break;
		case "CPTNAME_image":
			$img = get_field('slide_image', $post->ID);
			if($img) echo '<img src="' . $img['sizes']['thumbnail'] . '" style="max-height:60px;width:auto" />';
			break;
	}
}
*/



// ============================================== //
// ========== THEME SPECIFIC FUNCTIONS ========== //
// ============================================== //

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
  acf_add_options_page('Theme Settings');
}


// ACF Google Maps API Key
function my_acf_init() {
	global $google_api_key;
	acf_update_setting('google_api_key', $google_api_key);
}
add_action('acf/init', 'my_acf_init');


// =============================== //
// =========== INCLUDES ========== //
// =============================== //

// Core Functions
require_once(locate_template('functions/functions-core.php'));

// Tiny MCE
require_once(locate_template('functions/functions-tiny-mce.php'));

// Flexible Content
require_once(locate_template('functions/functions-flexible-content.php'));
?>
