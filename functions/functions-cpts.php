<?php
// ============================= //
// ===== CUSTOM POST TYPES ===== //
// ============================= //

/*
add_action( 'init', 'create_custom_post_types' );
function create_custom_post_types() {

	// SINGULARCPT
	$SINGULARCPT_args = array(
		'labels' => array(
			'name' => 'SINGULARCPTs',
			'singular_name' => 'SINGULARCPT',
			'add_new' => 'Add New SINGULARCPT',
			'add_new_item' => 'Add New SINGULARCPT',
			'edit_item' => 'Edit SINGULARCPT',
			'new_item' => 'New SINGULARCPT',
			'view_item' => 'View SINGULARCPT',
			'search_items' => 'Search SINGULARCPTs',
			'not_found' => 'No SINGULARCPTs found',
			'not_found_in_trash' => 'No SINGULARCPTs found in Trash'
		),
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_bloginfo('template_url').'/images/cpt-SINGULARCPT.png',
		'supports' => array(
			'title',
			'revisions',
		),
		// 'menu_position' => 20,
	);

	register_post_type( 'SINGULARCPT', $SINGULARCPT_args);
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
?>
