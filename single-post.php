<?php
get_header();
?>

    <section class="single-post">
        <?php 
        if( have_posts() ):
            while( have_posts() ): the_post();
                ?>
                    <article class='single-section-post'>
                        <?php if (has_post_thumbnail()) : ?>
                            <img class='single-image-post' src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <div class="single-content-container">
                            <h3 class='single-title-post'><?php the_title(); ?></h3>
                            <p class='single-content-post1'><?php the_content(); ?></p>
                            <a href="<?php echo get_post_type_archive_link('post'); ?>">&larr; Beagle Tails</a>
                        </div>
                    </article>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
                <p>Nothing to display.</p>
            <?php
        endif;
        ?>
    </section>

<?php get_footer();?>