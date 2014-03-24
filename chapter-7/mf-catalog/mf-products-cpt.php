<?php
define('MFP_CPT_NAME', "Produkte");
define('MFP_CPT_SINGLE', "Produkt");
define('MFP_CPT_TYPE', "products");
add_theme_support('post-thumbnails', array('products'));  
  
function mfp_register() {  
    $args = array(  
        'label' => __(MFP_CPT_NAME),  
        'singular_label' => __(MFP_CPT_SINGLE),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
  
    register_post_type(MFP_CPT_TYPE , $args ); 
register_taxonomy("product-category", array("products"), array("hierarchical" => true, "label" => "Produkt-Kategorien", "singular_label" => "Produktkategorie", "rewrite" => true));

}  


add_action('init', 'mfp_register');
