<?php get_header(); ?>
		<div class="entry">
			<?php if (have_posts()) : ?>
			
		<?php while (have_posts()) : the_post(); ?>
			
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

				
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				

				<p class="postmetadata">					
						Posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?> | Category <?php the_category(', ') ?> | <?php the_tags( 'Tags: ', ', ', '|'); ?> | <?php mf_comments_page_link(); ?>
						<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							<a href="#respond">Comment</a> 

						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							Comments are currently closed  

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							<a href="#respond">Comment</a>  

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.  

						<?php } edit_post_link('Edit this entry','','.'); ?>
				</p>
				
				<div id="commentsection">
					<?php comments_template(); ?>
				</div>
	
	<div class="navigation group">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
				
			</div>

		<?php endwhile; ?>
		
		<?php else : ?>
		
			<?php mf_print_not_found(); ?>

		<?php endif; ?>
				</div>
				<?php get_sidebar(); ?>

<?php get_footer(); ?>