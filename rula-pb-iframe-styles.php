<?php
/*
 * Plugin Name: Pressbooks - iframe styles
 * Plugin URI: https://github.com/ryersonlibrary/rula_pb_iframe_styles
 * Author: Ryerson University Library & Archives
 * Author URI: https://github.com/ryersonlibrary
 * Description: Hides the header and footer when Pressbooks is loaded within an iframe.
 * GitHub Plugin URI: https://github.com/ryersonlibrary/rula_pb_iframe_styles
 * Version: 0.0.2
 */
function rula_pb_print_iframe_script() {
  $html = '';
  $html .= '<script type="text/javascript">';
    $html .= 'jQuery( document ).ready( function() {';
      $html .= 'if ( window.self != window.top ) {';
        $html .= 'jQuery(".a11y-toolbar, .header, .footer--reading, .block-reading-meta, .nav-reading, .part-title").hide();';
      $html .= '}';
    $html .= '})';
  $html .= '</script>';
  echo $html;
}
add_action( 'wp_head', 'rula_pb_print_iframe_script');
