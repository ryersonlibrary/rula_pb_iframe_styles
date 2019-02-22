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

/*
 * Inserts the script to hide the unwanted elements at the end of the <head>  * tag.
 */
function rula_pb_iframe_print_script() {
  $hide_classes = implode(',', array(
    '.a11y-toolbar',
    '.header',
    '.footer--reading',
    '.block-reading-meta',
    '.nav-reading',
    '.part-title'
  ));

  echo <<<script
  <script type="text/javascript">
    jQuery( document ).ready( function() {
      if ( window.self != window.top ) {
        jQuery("{$hide_classes}").hide();
      }
    })
  </script>
script;

}
add_action( 'wp_head', 'rula_pb_iframe_print_script');
