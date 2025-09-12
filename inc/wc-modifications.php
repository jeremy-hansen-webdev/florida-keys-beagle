
<?php

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_product_data', 60 );
remove_action( 'woocommerce_before_single_product_summary', 'category_title', 5 );


add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 5);
add_action('woocommerce_blocks_cart_enqueue_data', 'fkb_progress_bar', 5);
add_action('woocommerce_blocks_checkout_enqueue_data', 'fkb_progress_bar', 5);

// Progress Bar for Cart and Checkout pages
function fkb_progress_bar(){
    echo
"    <div class='progress_bar_container'>
 
            <a href='" . wc_get_cart_url() . "'>
                <div class='progress_bar_active'></div>
                <p>Review Order</p>
            </a>

        <div>
            <a href='" . wc_get_checkout_url() . "'>
                <div class='progress_bar'></div>
                <p>Payment</p>
            </a>
        </div>
        <div>
            <div class='progress_bar'></div>
            <p>Conformation</p>
        </div>
    </div>
    <div class='progress_border'></div>
    
    ";
}


add_filter('woocommerce_proceed_to_checkout', function($button_html) {
    return str_replace('Proceed to checkout', 'Checkout', $button_html);
});


// Change Related Products title
add_filter( 'woocommerce_product_related_products_heading', function( $heading ) {
    return 'You May Also Like';
});

function single_product_container_start(){
    echo "<div class='top-single-product-container'>";
}

function single_product_container_end(){
    echo "</div>";
}
add_action('woocommerce_before_single_product_summary', 'single_product_container_start', 12);
add_action('woocommerce_after_single_product_summary', 'single_product_container_end', 15);

function fkb_wc_modify(){
    /**
     * Functions.php
     *
     * @package  Theme_Customisations
     * @author   WooThemes
     * @since    1.0.0
     */

    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly.
    }

    /**
     * functions.php
     * Add PHP snippets here
     */

    // remove content on shop page
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
    remove_action('woocommerce_before_shop_loop', 'wc_setup_loop', 10);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    remove_action('pre_get_posts', 'WC_Query->pre_get_posts', 10);
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);

    // Shop All Page
    


        // retrieve categories on top
        function showcase_items(){
            $showcase_items = new WP_Query(array(
                'post_type' => 'product_category',
                'meta_key' => 'order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'posts_per_page' => -1
            ));
            ?>
            <h2 class="shop-category-title">Shop Category</h2>
            <div class="showcase-item-categories">
                
            <?php
            while ($showcase_items->have_posts()) {
                $showcase_items->the_post();?>
                    <a class="showcase-item-content" href="<?php echo home_url()."/product-category/".get_field('category_url'); ?>">
                        <?php the_content(); ?>
                        <h3><?php the_title(); ?></h3>
                        <button>Shop</button>
                    </a>
                
            <?php }
            ?>
            </div>
            <?php

            wp_reset_postdata();
    }

        if(is_shop()){

        add_action('woocommerce_before_main_content', 'showcase_items', 10);
        }

    if(is_product_category()){
        add_action('woocommerce_after_shop_loop', 'showcase_items', 10);
    }

 
// Single Product Page
    if (is_product()) {
// Removed tabs
        add_filter( 'woocommerce_product_tabs', 'custom_remove_additional_info_tab', 98 );
        function custom_remove_additional_info_tab( $tabs ) {
            unset( $tabs['additional_information'] );
            return $tabs;
        }

        add_filter( 'woocommerce_product_tabs', 'custom_remove_reviews_tab', 98 );
        function custom_remove_reviews_tab( $tabs ) {
            unset( $tabs['reviews'] );
            return $tabs;
        }

        add_filter( 'woocommerce_product_tabs', 'custom_remove_description_tab', 98 );
        function custom_remove_description_tab( $tabs ) {
            unset( $tabs['description'] );
            return $tabs;
        }

        // Removed meta description
        remove_action('woocommerce_product_meta_end', 'WC_Brands->show_brand', 10);

    add_filter('woocommerce_get_image_size_single', function($size) {
    return array(
        'width'  => 1536,
        'height' => 1536,
        'crop'   => 1,
    );

    add_filter('woocommerce_get_image_size_thumbnail', function($size) {
    return array(
        'width'  => 1536,
        'height' => 1536,
        'crop'   => 1,
    );
});

    
});

// Added title display
        function category_title() {
            $terms_category = get_the_terms( get_the_ID(), 'product_cat' );
            if ( $terms_category && ! is_wp_error( $terms_category ) ) {
                $category_names = wp_list_pluck( $terms_category, 'name' );
                ?><div class="single-product-container">
                <h2 class="category-title"><?php echo esc_html( implode( ', ', $category_names ) ); ?></h2>
            <?php
            }
        }

        add_action('woocommerce_before_single_product_summary', 'category_title', 5);

        function product_description() {
            global $product;
            $product_id = $product->get_id();
            $product_title = $product->get_name();
            $product_price = $product->get_price();
            $product_description = $product->get_description();
            $product_short_description = $product->get_short_description();
            $product_sku = $product->get_sku();
            $product_permalink = get_permalink( $product_id );
            $product_attributes = $product->get_attributes();
            ?>
                <ul>
                    <?php foreach ( $product_attributes as $attribute ) : ?>
                        <li><?php echo wc_attribute_label( $attribute->get_name() ); ?>: <?php echo implode( ', ', $attribute->get_options() ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <h4>Description & Features</h4>
                <p class='single-product-description'><?php echo $product_description ?></p>
                <p><?php echo $product_short_description ?></p>
            <?php
        }

        add_action('woocommerce_single_product_summary', 'product_description', 20);

    }

}

add_action('wp', 'fkb_wc_modify');