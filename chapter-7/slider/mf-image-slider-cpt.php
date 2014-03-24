<?php
define('MFS_CPT_NAME', "Slider Images");
define('MFS_CPT_SINGLE', "Slider Image");
define('MFS_CPT_TYPE', "slider-image");
add_theme_support('post-thumbnails', array('slider-image'));  
  
function mfs_register() {  
    $args = array(  
        'label' => __(MFS_CPT_NAME),  
        'singular_label' => __(MFS_CPT_SINGLE),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
  
    register_post_type(MFS_CPT_TYPE , $args );  
}  


add_action('init', 'mfs_register');

?>
