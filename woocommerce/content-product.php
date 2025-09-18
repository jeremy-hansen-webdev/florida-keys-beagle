<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item' );
	
	/**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	// do_action( 'woocommerce_before_shop_loop_item_title' );




	$attributes = $product->get_attributes();

	// Showcase Image



	$image_url = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' );
	echo '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '">';
	echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( $product->get_name() ) . '" class="product-gallery-thumbnail" />';
	echo '</a>';

	// sets color swatches
	$color_options = $attributes['colors']->get_options();
	$count_colors = count($color_options);
	$variation_options = get_variations_by_product_id($product->get_id());
	
	echo '<div class="color-swatch-container">';
	foreach ($color_options as $index => $color) {
		echo '<div class="color-swatch" id="'. ($wp_query->current_post) . '" title="' . esc_attr($color) . '"></div>';
	}
	echo '</div>';

	// sets size options
	// $size_options = $attributes['sizes']->get_options();


	$size_count = 0;
	$var_count = 0;
	$sizes = ['XS', 'S', 'M', 'L', 'XL', '2XL'];
	
foreach ($color_options as $color) {
	$size_count = 0;
	$variation = $variation_options[$var_count];
	$variation_size = $variation['size'];
	while ($size_count < count($sizes)) {
		// You need to define $variation and $sizes properly; here is a placeholder logic
		$size = $sizes[$size_count];
		
		echo '<div class="size-options-container">';
		// create a function that sees if $size is in $variation_options.
		if (is_size_available($size, $color, $variation_options)) {
			echo '<span class="size-option size-color-' . esc_attr($color) . '" title="' . esc_attr($variation['id']) . '" id="' . esc_attr($variation['size']) . '">' . esc_html($variation['size']) . '</span>';
		} else {
			echo '<span class="size-option size-color-' . esc_attr($color) . '" title="none" id="' . esc_attr($sizes[$size_count]) . '">' . esc_html($sizes[$size_count]) . '</span>';
		}
		echo '</div>';

		$size_count++;
	}
	$var_count++;
}

function is_size_available($size, $color, $variation_options ){
	foreach ($variation_options as $key => $variation) {
		if ($variation['size'] == $size && $variation['color'] == $color) {
			return true;
		}
	}
	return false;
}
	
	$attachment_ids = $product->get_gallery_image_ids();
	$count_images = count($attachment_ids);
	$count_rows = ceil($count_images / $count_colors);
	$image_order = $count_rows - 1;
	if ( ! empty( $attachment_ids ) ) {
		echo '<div class="woocommerce-product-gallery-thumbnails">';

		echo '
				<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta( $attachment_ids[0], '_wp_attachment_image_alt', true ) ) . '" class="product-gallery-thumbnail" />';

		
		foreach ( $attachment_ids as $idx => $attachment_id) {
			
			if ( $image_order == $idx) {
				$image_url = wp_get_attachment_image_url( $attachment_id, 'woocommerce_thumbnail' );
				echo 
				'
				<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) . '" class="product-gallery-thumbnail" />';

				$image_order = $image_order + $count_rows;
				
			}
			
		}
		echo '</div>';
	}

		/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	// Add to Cart Button with color and size variants

	echo '
	<div class="add-to-cart-color"></div>
	<div class="add-to-cart-size"></div>

	<input class="product-id-text" value="' . esc_attr( $product->get_id() ) . '">
	<button class="ajax-add-to-cart">Add to Cart</button>
	';





	do_action( 'woocommerce_after_shop_loop_item' );
