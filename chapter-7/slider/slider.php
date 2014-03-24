<?php
/*
Plugin Name: Responsive Image Slider
Plugin URI: http://millenniumflights.com
Description: Ein einfaches Plugin, das den FlexSlider (http://flex.madebymufffin.com/) in WordPress integriert und dabei auf Custom Post Types setzt!
Author: Joe Casabona
Version: 1.0
Author URI: http://www.casabona.org
*/

/*Set-up*/
define('MFS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('MFS_NAME', "Responsive Image Slider");

/*Dateien einbinden */
require_once('mf-image-slider-cpt.php');

function mfs_enqueue_scripts(){
wp_enqueue_script('mf-image-slider', MFS_PATH.'jquery.flexslider-min.js', array('jquery'));
wp_enqueue_style('mf-image-slider-css', MFS_PATH.'flexslider.css');
}

add_action('wp_enqueue_scripts', 'mfs_enqueue_scripts');

function mfs_script(){

print '<script type="text/javascript" charset="utf-8">
  		jQuery(window).load(function() {
    			jQuery(".flexslider").flexslider();
  		});
</script>';

}

add_action('wp_head', 'mfs_script');

function mfs_get_slider(){
	$slider= '<div class="flexslider">
	  <ul class="slides">';

	$args= "post_type=slider-image";
	$slides= new WP_Query($args);
	
	
	 while($slides->have_posts()) : $slides->the_post();
		$img= get_the_post_thumbnail( $post->ID, 'large' );
		
		$slider.='<li>'.$img.'
				<p class="flex-caption"><strong>'. get_the_title() .'</strong><br/>'. get_the_content() .'</p>
		</li>';
			
	endwhile;
	
	wp_reset_postdata();
	$slider.= '</ul>
	</div>';
	
	return $slider;
}
/**Shortcode**/
function mfs_shortcode($atts, $content=null){

$slider= mfs_get_slider();

return $slider;

}

add_shortcode('mf_slider', 'mfs_shortcode');

/**Template-Tag**/
function mfs_slider_tag(){

	print mfs_get_slider();
}


