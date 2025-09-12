<?php 
/*
Template Name: Home Page
*/
get_header(); ?>

<section class="hero-section">
    <div class="tag">
        <div class="tag-line">
            <h4 class="tag-line-text">Gear  That Makes You Grin</h4>
        </div>
    </div>
    <div class="title">
        <h1 class="title-line">Island Life</h1>
        <h1 id="beagle-style" class="title-line">Beagle Style</h1>
    </div>
    <div class="shop-all">
        <a class="shop-all-button" href="<?php echo esc_url( home_url( '/shop' ) ); ?>" ><h4 class="shop-all-text">Shop All</h4></a>
    </div>
</section>
<section class="testimonials">
    <?php
    $testimonials = new WP_Query(array(
        'post_type' => 'testimonials',
        'posts_per_page' => -1
    ));
    ?>
    <?php
    $counter = 0;
    if ( $testimonials->have_posts() ) {
        while ( $testimonials->have_posts() ) {
            $counter++;
            $testimonials->the_post(); ?>
            <div id="testimonial-<?php echo $counter; ?>" class="testimonials-review">
                <p><?php the_content(); ?></p>
                <div class="reviewers">
                    <div class="person">
                        <img src="<?php the_field('person_image'); ?>" alt="">
                        <h4 class="reviewer-person-name"><?php the_field('person_name'); ?></h4>
                    </div>
                    <div class="pet">
                        <img src="<?php the_field('pet_image'); ?>" alt="">
                        <h4 class="reviewer-pet-name"><?php the_field('pet_name'); ?></h4>
                    </div>
                </div>
            </div>
        <?php
        }
    }
    ?>

</section>
<section class="shopping">
    <h2 class='home-product-title'>Women's Clothing</h2>

    <div class="carousel-container">
        
            <button class="carousel-control-prev" type="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="prev"><img src="../../wp-content/uploads/2025/08/left-arrow.svg" alt=""></span>
            </button>
        <div class="carousel">
            <?php echo do_shortcode('[products category="womens-clothing" limit="12" columns="1"]') ?>
        </div>
            <button class="carousel-control-next" type="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><img src="../../wp-content/uploads/2025/08/right-arrow.svg" alt=""></span>
            </button>
    </div>
        <h2 class='home-product-title'>Unesex's Clothing</h2>
        <div class="carousel-container">
        
            <button class="carousel-control-prev" type="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="prev"><img src="../../wp-content/uploads/2025/08/left-arrow.svg" alt=""></span>
            </button>
        <div class="carousel">
            <?php echo do_shortcode('[products category="unisex" limit="12" columns="1"]') ?>
        </div>
            <button class="carousel-control-next" type="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><img src="../../wp-content/uploads/2025/08/right-arrow.svg" alt=""></span>
            </button>
    </div>
        <h2 class='home-product-title'>Men's Clothing</h2>
        <div class="carousel-container">
        
            <button class="carousel-control-prev" type="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="prev"><img src="../../wp-content/uploads/2025/08/left-arrow.svg" alt=""></span>
            </button>
        <div class="carousel">
            <?php echo do_shortcode('[products category="mens-clothing" limit="12" columns="1"]') ?>
        </div>
            <button class="carousel-control-next" type="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><img src="../../wp-content/uploads/2025/08/right-arrow.svg" alt=""></span>
            </button>
    </div>
</section>
<div class="donation-section">
    <video autoplay muted loop class="donation-bg-video">
    <source src="../..//wp-content/uploads/2025/08/donation-video.mp4" type="video/mp4">
    </video>
    <div class="donation-overlay">
        <div class="title1-background">
            <h2 class="donation-title">Help Preserve Our Coral Reefs With Every Purchase</h2>
        </div>
        <div class="title2-background">
            <p class="donation-tagline">5% Donation From Every Purchase</p>
        </div>
    </div>
  </div>
<?php get_footer(); ?>