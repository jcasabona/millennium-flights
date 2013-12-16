<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div class="post group">

<h2>Search</h2>
<?php get_search_form(); ?>

<div class="date-archives">
	<h2>Archives</h2>
	<ul class="compact-archives">
		<?php compact_archive('block'); ?>
	</ul>
</div>


<div class="tag-archives">
	<h2>Tag Cloud</h2>
	<div class="tags">
		<?php 
			
			if(ISMOBILE){
				$args= "orderby=count&order=DESC&number=30";
				mf_tag_cloud($args);
			}else{
				wp_tag_cloud('smallest=0.9&largest=2.2&unit=em'); 
			}
		?> 
	</div>
</div>

</div>


<?php get_footer(); ?>
