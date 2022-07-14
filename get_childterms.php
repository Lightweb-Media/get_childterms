<?php
/**
 * Plugin Name:     Get_childterms
 * Plugin URI:      https://lightweb-media.de
 * Description:     shortcode to return subterm by Post ID and taxonomy
 * Author:          Sebastian Weiß
 * Author URI:      https://lightweb-media.de
 * Text Domain:     get_childterms
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Get_childterms
 */

// Your code starts here.




function  get_childterms( $atts = [], $content = null, $tag = ''   ) {
    global $post;
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    
    $a = shortcode_atts( array(
            'ID' => $post->ID,
            'taxonomy' => 'category',
            
        ), $atts );
        $output = '<ul>';
        $term_array = wp_get_object_terms(  $a['ID'], $a['taxonomy'] );
        foreach ($term_array as $term){
        
            $children = get_term_children($term->term_id, $a['taxonomy']);
     
            if(!empty($children)){
               foreach ($children as $subterm_id){
                $output .='<li><a href="'.get_term_link($subterm_id,$a['taxonomy'] ).'">'.get_term( $subterm_id )->name.'</a></li>';
               }
            } 
        }
        $output .='</ul>';     
return $output;
      
    }

add_shortcode( 'get_childterms', 'get_childterms' );
    


