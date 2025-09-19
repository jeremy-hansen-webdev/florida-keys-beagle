<?php
function fkb_scripts(){
    wp_enqueue_style('fkb-style', get_stylesheet_uri(), array(), 1.0, 'all');
	wp_enqueue_style('our-story', get_template_directory_uri() . '/inc/our-story.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('fkb-index', get_template_directory_uri() . '/inc/index.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('single-post', get_template_directory_uri() . '/inc/single-post.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('shop', get_template_directory_uri() . '/inc/shop.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('product', get_template_directory_uri() . '/inc/product.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('single-product', get_template_directory_uri() . '/inc/single-product.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('cart', get_template_directory_uri() . '/inc/cart.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('billing', get_template_directory_uri() . '/inc/billing.css', array('fkb-style'), '1.0', 'all');
	wp_enqueue_style('received', get_template_directory_uri() . '/inc/received.css', array ('fkb-style'), '1.0', 'all');
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0', 'all');
	
	wp_enqueue_script('fkb-scripts', get_template_directory_uri() . '/src/scripts.js', array('jquery'), '1.0', true);
	// Localize script to provide AJAX URL
	wp_localize_script('fkb-scripts', 'myAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php')
	));

}

add_action('wp_enqueue_scripts', 'fkb_scripts');

// woocommerce setup


function fkb_config(){

    register_nav_menus(
        array(
            'fkb_main_menu'     => 'Florida Keys Beagle Main Menu',
            'fkb_footer_menu'   => 'Florida Keys Beagle Footer Menu'
        )
    );

		add_theme_support( 'woocommerce', array(
			'thumbnail_image_width'  => 1300,
			// 'thumbnail_image_height' => 768,
			'single_image_width'	=> 2000,
			'gallary_thumbnail_width' => 150,
			'product_grid' 			=> array(
	            'default_rows'    => 10,
	            'min_rows'        => 1,
	            'max_rows'        => 10,
	            'default_columns' => 5,
	            'min_columns'     => 1,
	            'max_columns'     => 5,
			)
		) );
		// add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );


		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 600;
		}				
}

add_action( 'after_setup_theme', 'fkb_config', 0 );

if( class_exists( 'WooCommerce' ) ){
	require_once get_template_directory() . '/inc/wc-modifications.php';
}

add_filter( 'woocommerce_output_related_products_args', function( $args ) {
    $args['posts_per_page'] = 6; // Change 6 to your desired number
    return $args;
});

// Adds ajax add to cart request for product pages

function add_to_cart_button_clicked(){
	$my_data= $_POST['ajax_data'];
	$product_id = intval($my_data['product_id']);
	$quantity = intval($my_data['quantity']);
	$attributes = array(
		'attribute_colors' => $my_data['variation_data']['attribute_colors'],
		'attribute_sizes' => $my_data['variation_data']['attribute_sizes']
	);

	$variation_id = get_variation_id_by_attributes($product_id, $attributes);

	$added_to_cart = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $attributes );

	if($added_to_cart){
		get_cart_count();
	} else{
	}
}
add_action('wp_ajax_custom_add_to_cart', 'add_to_cart_button_clicked');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'add_to_cart_button_clicked');

function set_size_optios_available_clicked(){
	
}

add_action('wp_ajax_custom_add_to_cart', 'set_size_optios_available_clicked');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'set_size_optios_available_clicked');
// gets the variation id
function get_variation_id_by_attributes( $product_id, $variation_data ) {
	$product = wc_get_product( $product_id );
	if ( ! $product || $product->get_type() !== 'variable' ) {
		return 0;
	}
	foreach ( $product->get_available_variations() as $variation ) {
		$found = true;
		foreach ( $variation_data as $attr => $value ) {
			if (
				!isset($variation['attributes'][$attr]) ||
				!is_string($variation['attributes'][$attr]) ||
				!is_string($value) ||
				strtolower($variation['attributes'][$attr]) !== strtolower($value)
			) {
				$found = false;
				break;
			}
		}
		if ( $found ) {
			return $variation['variation_id'];
		}
	}
	return 0;
}

function get_variations_by_product_id($product_id) {
    $product = wc_get_product($product_id);
    $variations = [];

    if ($product && $product->is_type('variable')) {
        foreach ($product->get_available_variations() as $variation) {
            $variations[] = [
                'id'    => $variation['variation_id'],
                'size'  => isset($variation['attributes']['attribute_sizes']) ? $variation['attributes']['attribute_sizes'] : '',
                'color' => isset($variation['attributes']['attribute_colors']) ? $variation['attributes']['attribute_colors'] : '',
            ];
        }
    }

    return $variations;
	}

// Refreshes Cart
function get_cart_count() {
    wp_send_json_success(WC()->cart->get_cart_contents_count());
}
add_action('wp_ajax_get_cart_count', 'get_cart_count');
add_action('wp_ajax_nopriv_get_cart_count', 'get_cart_count');

/**
 * Remove the default editor for a specific post type.
 * This should be placed in your functions.php file or a custom plugin.
 */
function my_remove_editor_support() {
    // Replace 'post' with the slug of your custom post type.
    // Examples: 'page', 'product', or 'showcase-items'
    $post_type_to_remove = 'showcase-items';

    // Check if the current screen is the one we want to target.
    // The conditional check is important to prevent unexpected behavior.
    if (in_array($post_type_to_remove, array('post', 'page', 'showcase-items'))) {
        remove_post_type_support($post_type_to_remove, 'editor');
    }
}
add_action('admin_init', 'my_remove_editor_support');
