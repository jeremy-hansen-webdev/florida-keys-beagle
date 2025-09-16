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
	echo '<div class="color-swatch-container">';
	foreach ($color_options as $index => $color) {
		echo '<div class="color-swatch" id="'. ($wp_query->current_post) . '" title="' . esc_attr($color) . '"></div>';
	}
	echo '</div>';

	// sets size options
	$size_options = $attributes['sizes']->get_options();
	if (count($size_options) > 0) {
		echo '<div class="size-options-container">';
		foreach ($size_options as $size) {
			echo '<span class="size-option" id="' . esc_attr($size) . '">' . esc_html($size) . '</span>';
		}
		echo '</div>';
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
	if ( $product->is_type( 'variable' ) ) {
		$available_variations = $product->get_available_variations();
		echo '<form class="add-to-cart-variants" method="post" action="' . esc_url( get_permalink( $product->get_id() ) ) . '">';
		// Color selector
		if ( !empty($color_options) ) {
			echo '<select name="attribute_colors" class="variant-select variant-color">';
			echo '<option value="">Choose a color</option>';
			foreach ( $color_options as $color ) {
				echo '<option value="' . esc_attr($color) . '">' . esc_html($color) . '</option>';
			}
			echo '</select>';
		}
		// Size selector
		if ( !empty($size_options) ) {
			echo '<select name="attribute_sizes" class="variant-select variant-size">';
			echo '<option value="">Choose a size</option>';
			foreach ( $size_options as $size ) {
				echo '<option value="' . esc_attr($size) . '">' . esc_html($size) . '</option>';
			}
			echo '</select>';
		}
		echo '<input type="hidden" name="add-to-cart" value="' . esc_attr( $product->get_id() ) . '" />';
		echo '<button type="submit" class="button add-to-cart-button">Add to cart</button>';
		echo '</form>';
	} else {
		woocommerce_template_loop_add_to_cart();
	}

