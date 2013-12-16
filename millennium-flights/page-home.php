<?php
	/**
		Template Name: Home
	**/
?>

<?php get_header(); ?>
		
			<?php if (have_posts()) : ?>
			
		<?php while (have_posts()) : the_post(); ?>
			
				
				<div class="impact group">
					<?php echo get_the_post_thumbnail(); ?>
					<h2><?php bloginfo('description'); ?></h2>
				</div>

				
				<div class="post group">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
		<?php endwhile; ?>
		
		<?php else : ?>
		
			<?php mf_print_not_found(); ?>

		<?php endif; ?>

<?php get_footer(); ?>