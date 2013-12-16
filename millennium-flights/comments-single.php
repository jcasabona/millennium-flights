<?php get_header(); ?>

<div class="entry">
	<h2>Comments for <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<div class="commentsection">
		<ol class="commentlist">
		<?php
			wp_list_comments('reverse_top_level=false', get_comments('post_id='.$post->ID));
			comment_form();
			?>
		</ol>
	</div>
</div>

<?php get_footer(); ?>