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

// Include our custom settings page for the plugin
require_once plugin_dir_path( __FILE__ ).'/inc/rula-pb-iframe-styles-settings.php';

/**
 * Enqueues scripts necessary to use media JavaScript APIs.
 */
function rula_pb_iframe_enqueue_media_scripts() {
  wp_enqueue_media();
  wp_register_script( 'rula-pb-iframe-media-uploader-js', plugin_dir_url( __FILE__ ).'/inc/js/media-uploader.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'rula-pb-iframe-media-uploader-js' );
  wp_register_style( 'rula-pb-iframe-style', plugin_dir_url( __FILE__ ).'/inc/css/style.css', array(), '1.0.0' );
  wp_enqueue_style( 'rula-pb-iframe-style' );
}
add_action( 'admin_enqueue_scripts', 'rula_pb_iframe_enqueue_media_scripts' );

/**
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
