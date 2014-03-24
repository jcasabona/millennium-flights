<?php
function mf_gallery_style($css){
  return preg_replace("#<style type=\'text/css\'>(.*?)</style>#s", "", $css);
}

add_filter( 'gallery_style', 'mf_gallery_style');

function mf_remove_br_gallery($output) {
  return preg_replace('/<br style=(.*)>/mi','',$output);
}

add_filter( 'the_content', 'mf_remove_br_gallery', 11, 2);
