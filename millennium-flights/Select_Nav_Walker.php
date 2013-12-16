<?php
class Select_Nav_Walker extends Walker_Nav_Menu {
	
    // don't output children opening tag (`<ul>`)
    public function start_lvl(&$output, $depth){}

    // don't output children closing tag    
    public function end_lvl(&$output, $depth){}

    public function start_el(&$output, $item, $depth, $args){

      // add spacing to the title based on the current depth
      $item->title = esc_attr($item->title);

      // call the prototype and replace the <li> tag
      // from the generated markup...
      parent::start_el(&$output, $item, $depth, $args);
      $output .= '	<option value="'. $item->url .'">'. $item->title;
    }

    // replace closing </li> with the closing option tag
    public function end_el(&$output, $item, $depth){
      $output .= "</option>\n";
    }
}
?>