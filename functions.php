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
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0', 'all');
	wp_enqueue_script('fkb-scripts', get_template_directory_uri() . '/src/scripts.js', array('jquery'), '1.0', true);

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