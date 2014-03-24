<?php
/*
Plugin Name: Millennium Flüge – Produktseite
Plugin URI: http://millenniumflights.com
Description: Ein einfaches Plugin, das in WordPress unter Verwendung von Cus-tom Post Types Produkte erzeugt und anzeigt!
Author: Joe Casabona
Version: 1.0
Author URI: http://www.casabona.org
*/

/*Set-up*/
define('MFP_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('MFP_NAME', "Millenium Flüge - Produkte");

/*Dateien einbinden*/
require_once('mf-products-cpt.php');


function mfp_get_products(){
	$products= '<div class="mf-catalog">';

	$args= "post_type=products";
	$catalog= new WP_Query($args);
	
	
	 while($catalog->have_posts()) : $catalog->the_post();
		$img= mfp_get_image();
		$price= mfp_get_the_price($post->ID);
        print_r($post);
		$products.='<div class="mf-product">'.$img.'
				<p><strong>'. get_the_title() .'</strong>: '. get_the_excerpt() .'</p>
				<p class="price">'. $price .'</p>
		</div>';
			
	endwhile;
	
	wp_reset_postdata();


	$products.= '</div>';
	
	return $products;
}
/**Shortcode**/
function mfp_shortcode($atts, $content=null){

$products= mfp_get_products();

return $products;

}

add_shortcode('mf_products', 'mfp_shortcode');

/**Template-Tag**/
function mfp_products_tag(){

	print mfp_get_products();
}

add_action("admin_init", "mfp_meta_box");   
 
function mfp_meta_box(){  
    add_meta_box("mf-products", "Product Price", "mfp_meta_options", "products", "side", "low");  
}  
   
function mfp_meta_options(){  
        global $post;  
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
        $custom = get_post_custom($post->ID);  
        $mfp_price = $custom["mfp_price"][0];  
?>  
    <label>Price:</label><input name="mfp_price" value="<?php echo $mfp_price; ?>" />  
<?php  
    }
add_action('save_post', 'mfp_save_custom_data'); 
   
function mfp_save_custom_data(){  
    global $post;  
     
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){ 
        return $post_id;
    }else{
        update_post_meta($post->ID, "mfp_price", $_POST["mfp_price"]); 
    } 
}
function mfp_get_the_price($pid){
	$custom = get_post_custom($pid);  
        return $custom["mfp_price"][0];  
}

//fm korrigiert - >mfp_get_images - ursprünglich muss natürlich mfp_get_image() sein
function mfp_get_image($pid=NULL, $size='thumbnail'){
	$url= wp_get_attachment_image_src( get_post_thumbnail_id($pid), $size);
	return '<img src="'.$url[0] .'" alt="'. esc_attr(get_the_title($pid)) .'" />';
}


