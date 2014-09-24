<?php
define( 'TEMPPATH', get_bloginfo('stylesheet_directory'));
define( 'IMAGES', TEMPPATH. "/images");

require_once('wurfl/Client/Client.php');

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}


register_sidebar( array (
	'name' => __( 'Sidebar', 'main-sidebar' ),
	'id' => 'primary-widget-area',
	'description' => __( 'The primary widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

register_sidebar( array (
	'name' => __( 'Sidebar2', 'secondary-sidebar' ),
	'id' => 'secondar-widget-area',
	'description' => __( 'The seconardy widget area', 'wpbp' ),
	'before_widget' => '<div class="widget">',
	'after_widget' => "</div>",
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

require_once('Select_Nav_Walker.php');


function jlc_get_attachements($pid){
	$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $pid ); 
	$attachments = get_posts( $args );
	if ($attachments) {
		foreach ( $attachments as $post ) {
			setup_postdata($post);
			the_attachment_link($post->ID, false, false, true);
		}
	}
}

function jlc_page_url() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function mf_print_post_nav(){
?>
		<div class="navigation group">
			<div class="alignleft"><?php next_posts_link('&laquo; Next') ?></div>
			<div class="alignright"><?php previous_posts_link('Previous &raquo;') ?></div>
		</div>
<?php

}

function mf_print_not_found(){
?>
		<h3 class="center">No posts found. Try a different search?</h3>
		<?php get_search_form(); ?>
<?php
}


function mf_comments_page_link(){
	echo '<a href="'. get_permalink() . 'comments/">'. get_comments_number() .' Comments</a>'; 
	}

function mf_is_mobile_device(){
	try{
		$config = new WurflCloud_Client_Config(); 
		$config->api_key = '673289:CNry9beZIoP38Kn2z1WRQcAU6Fqd0TwS';  
		$client = new WurflCloud_Client_Client($config); 
		$client->detectDevice(); 
		
		return $client->getDeviceCapability('is_wireless_device');
	}catch (Exception $e){
		return wp_is_mobile();
	}
}

define( 'ISMOBILE', mf_is_mobile_device());


function mf_scripts() {
	wp_enqueue_style( 'googlewebfonts', 'http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' );
	wp_enqueue_script( 'responsivenav', TEMPPATH.'/js/responsive-nav.min.js', array());
	
	echo '<!--[if lt IE 9]>';
	echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
	echo '<script src="'. TEMPPATH .'/js/respond.min.js"></script>';
	echo '<![endif]-->';

}

add_action( 'wp_enqueue_scripts', 'mf_scripts' );


function mf_responsive_nav(){
	echo '<script>
				var navigation = responsiveNav("#top-menu");
		</script>';
}

add_action('wp_footer', 'mf_responsive_nav');

function mf_ajax_comments(){
	if(is_single()){
		echo '<script type="text/javascript" charset="utf-8">
						jQuery(document).ready(function(){
							jQuery(\'#commentNav a\').live(\'click\', function(e){
							  e.preventDefault();
							  var link = jQuery(this).attr(\'href\');
							  jQuery(\'#commentsection\').html(\'Loading...\');
							  jQuery(\'#commentsection\').load(link+\' #commentsection\');
							  
							  });
	  
						  });
					</script>';
	}

}

add_action('wp_head', 'mf_ajax_comments');

function mf_get_featured_image($html, $aid=false){
    $sizes= array('thumbnail', 'medium', 'large', 'full'); 
    
	$img= '<span data-picture data-alt="'.get_the_title().'">';
	$ct= 0;
	$aid= (!$aid) ? get_post_thumbnail_id() : $aid;

	foreach($sizes as $size){
		$url= wp_get_attachment_image_src($aid, $size);
		
		$width= ($ct < sizeof($sizes)-1) ? ($url[1]*0.66) : ($width/0.66)+25;
		
		$img.= '
			<span data-src="'. $url[0] .'"';
		$img.= ($ct > 0) ? ' data-media="(min-width: '. $width .'px)"></span>' :'></span>';
		
		$ct++;
	}
	$url= wp_get_attachment_image_src( $aid, $sizes[1]);
    $img.=  '<noscript>
            	<img src="'.$url[0] .'" alt="'.get_the_title().'">
			</noscript>
		</span>';
	return $img;
}

add_filter( 'post_thumbnail_html', 'mf_get_featured_image');

function mf_responsive_image($atts, $content=null){ 
	extract( shortcode_atts( array(
		'src' => false
	), $atts ) );
			
	if(!$src){
		return '';
	}else{
		$aid= mf_get_attachment_id_from_src($src);
		$img= mf_get_featured_image('', $aid);
	}
	
	return $img;
	
}

add_shortcode('mf_image', 'mf_responsive_image');

function mf_get_attachment_id_from_src($url) {
  global $wpdb;
  $prefix = $wpdb->prefix;
  $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $url ));
    return $attachment[0];
}

function mf_replace_post_images($content){
	global $post;
	
	preg_match('#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', $content, $matches);
	foreach($matches as $match){
		print $match;
		preg_replace( $match, mf_get_featured_image(mf_get_attachment_id_from_src ($match)), $content );
	}
	 return $content;
}

//add_filter('the_content', 'mf_replace_post_images');


function mf_tag_cloud($args=''){
	$tags = get_tags($args);
	$html = '<ul class="wp-tag-cloud">';
foreach ( $tags as $tag ) {
	$tag_link = get_tag_link( $tag->term_id );
	
	 
	$progress= $tag->count*2;
		
	$html .= "<li><a href='{$tag_link}' title='{$tag->count} posts' class='{$tag->slug}'>{$tag->name}</a>";
	$html .= "<progress max='100' value='{$progress}'>Count: {$tag->count}</progress></li>";
}
$html .= '</ul>';
echo $html;
}

?>
