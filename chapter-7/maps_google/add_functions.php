<?php
add_shortcode('mf_gmap', 'mf_google_maps'); 

function mf_google_maps($atts, $content=null){
    //Argumente aus dem Shortcode extrahieren
    extract(shortcode_atts(array('address' => '132 Hawthorne Street San Francisco, CA 94107', 'width' => 800, 'height' => 600), $atts));		
    $map= '<div class="mf-responsive-map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps?q='.$address.'&output=embed"></iframe>';
    if($content != null){
      $map.= '<br/>'.$content;
    }
    $map.= "</div>";
		
    return $map;
}
