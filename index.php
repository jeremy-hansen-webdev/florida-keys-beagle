<?php
get_header();

$argsFeaturedPost = array(
	'post_type' => 'post',
	'posts_per_page' => 1,
	'orderby' => 'date',
	'order' => 'DESC'
);

$featuredPost = new WP_Query($argsFeaturedPost);
?>
	<section class="featured-post">
		<?php 
		if ($featuredPost->have_posts()) {
			while ($featuredPost->have_posts()) {
				$featuredPost->the_post();
				?>
				<div class="featured-container">
					<div class="featured-top-section">
						<h2><?php the_title(); ?></h2>
						<div>
							<?php the_excerpt(); ?>
							<p><a class="learn-more" href="<?php the_permalink(); ?>">Learn More &rarr;</a></p>
						</div>
										
					</div>
					<?php if (has_post_thumbnail()) : ?>
						<img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>">
					<?php endif; ?>
				</div> <!-- Close featured-container -->

				<?php
			} 
			wp_reset_postdata();
		}
		?>
	</section>
	<h2 class="list-title">More Trending Articles</h2>
	<section class="list-posts">
					<?php 
			// If there are any posts
			if( have_posts() ):
				// Load posts loop
				$skip_first = true;
				while( have_posts() ): the_post();
					// Skip the first post (already displayed as featured)
					if ($skip_first) {
						$skip_first = false;
						continue;
					}
					?>
					<article class='section-post'>
						<a href="<?php the_permalink() ?>">
							<?php if (has_post_thumbnail()) : ?>
								<img class='image-post' src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title_attribute(); ?>">
							<?php endif; ?>
							<div class="content-container">
								<h4 class='title-post'><?php the_title(); ?></h4>
								<p class='title-content'><?php the_content(); ?></p>
							</div>
							<p class="learn-more"><a href="<?php the_permalink(); ?>">Learn More &rarr;</a></p>
						</a>
					</article>
						
					<?php
				endwhile;
			else:
					?>
			<p>Nothing to display.</p>
		<?php endif; ?>
		</section>
<?php get_footer(); ?>