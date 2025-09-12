<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<html <?php language_attributes(); ?>>
    <head>
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div id="page" class="site">
            <header>

                <div class="main-menu-container">
                    <div class="main-menu">
                        <a href="<?php echo home_url('/our-story'); ?>"><section class="nav-details">About Us</section></a>
                        <a href="<?php echo home_url('/beagle-tales'); ?>"><section class="nav-details">Beagle Tales</section></a>
                        <a href="<?php echo home_url('/shop'); ?>"><section id='shop' class="nav-details">Shop</section></a>
                        <a href="<?php echo home_url('/shop-all'); ?>"><section id='shop-all' class="nav-details">Shop All</section></a>
                    </div>
                    <div class="logo">
                        <a href="<?php echo home_url('/home'); ?>">
                            <img src="../../wp-content/uploads/2025/08/Beagle-Icon-copy-1.svg" alt="">
                        </a>
                    </div>
                    <div class="main-menu-customer">
                        <a href="<?php echo home_url('/cart'); ?>"><section id="account" class="nav-details-account"><img src="../../wp-content/uploads/2025/08/mdi_account.svg" alt="Account"></section></a>
                        
                        <div class="account-container">
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php  echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"><section id="log-in" class="nav-details-account">My Account</section></a>
                                <div class="account-dropdown">
                                    <a href="<?php echo esc_url(wp_logout_url(get_permalink(get_option('woocommerce_myaccount_page_id')))); ?>"><section class="nav-details-account">Log Out</section></a>
                                </div>
                            </div>
                        <?php else : ?>
                            <a href="<?php  echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"><section id="log-in" class="nav-details-account">Log In</section></a>
                        <?php endif; ?>
            
                        
                        <a href="<?php echo home_url('/cart'); ?>"><section id="cart" class="nav-details-account"><img src="../../wp-content/uploads/2025/08/material-symbols_shopping-cart-outline-sharp-1.svg" alt="Cart"><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></section></a>
                        <div class="hamburger-menu"><img class="hamburger-icon" src="../../wp-content/uploads/2025/08/ci_hamburger-lg.svg" alt="Menu"></div>
                    </div>

                    <div class="mobile-menu-container" style="display: none;">
                        <div class="main-menu-mobile">
                        <a href="<?php echo home_url('/our-story'); ?>"><section class="nav-details-mobile">About Us</section></a>
                        <a href="<?php echo home_url('/beagle-tales'); ?>"><section class="nav-details-mobile">Beagle Tales</section></a>
                        <a href="<?php echo home_url('/shop'); ?>"><section id='shop' class="nav-details-mobile">Shop</section></a>
                        <a href="<?php echo home_url('/shop-all'); ?>"><section id='shop-all' class="nav-details-mobile">Shop All</section></a>
                        <?php if ( is_user_logged_in() ) : ?>
                            <a href="<?php  echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"><section id="log-in-mobile" class="nav-details-mobile">My Account</section></a>
                        <?php else : ?>
                            <a href="<?php  echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) ?>"><section id="log-in-mobile" class="nav-details-mobile">Log In</section></a>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>
                
            </header>