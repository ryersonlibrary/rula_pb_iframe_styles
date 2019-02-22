<?php
/**
 * Add a custom options page.
 */
function rula_pb_iframe_add_options_page() {
  add_options_page(
    __( 'iframe Styles Settings', 'rula_pb_iframe' ),
    __( 'iframe Styles Settings', 'rula_pb_iframe' ),
    'manage_options',
    'rula_pb_iframe',
    'rula_pb_iframe_render_options_page_callback'
  );
}
add_action( 'admin_menu', 'rula_pb_iframe_add_options_page' );

/**
 * Callback function to render custom options page.
 */
function rula_pb_iframe_render_options_page_callback() {
  ?>
    <form method="POST" action="options.php">
      <?php 
      settings_fields( 'rula_pb_iframe' );
      do_settings_sections( 'rula_pb_iframe' );
      submit_button(); 
      ?>
    </form>
  <?php
}

/**
 * Register and initialize settings for the plugin.
 */
function rula_pb_iframe_settings_init() {
  $settings_section = 'rula_pb_iframe-main';
  $settings_page = 'rula_pb_iframe';

  add_settings_section(
    $settings_section,
    'Settings for iframe styles plugin',
    'rula_pb_iframe_settings_section_main_callback',
    $settings_page
  );

  add_settings_field(
    'rula_pb_iframe-watermark',
    'Watermark',
    'rula_pb_iframe_watermark_callback',
    $settings_page,
    $settings_section,
    array( 'label_for' => 'rula_pb_iframe-watermark' )
  );

  $watermark_setting_args = array(
    'type' => 'string',
    'default' => '',
    'description' => ''
  );
  register_setting($settings_page, 'rula_pb_iframe-watermark', $watermark_setting_args);
}
add_action( 'admin_init', 'rula_pb_iframe_settings_init' );

/**
 * Callback function to render settings section html
 */
function rula_pb_iframe_settings_section_main_callback() {
  echo '';
}

/**
 * Callback functions to render settings
 */
function rula_pb_iframe_watermark_callback( $args ) {
  $setting_id = 'rula_pb_iframe-watermark';
  $setting_value = esc_attr( get_option( 'rula_pb_iframe-watermark' ) );
  echo <<<setting_html
  <div id="rula_pb_iframe-watermark_preview" style="background-image: url('{$setting_value}');"></div>
  <input type="button" value="Select watermark" id="rula_pb_iframe-select_watermark_button">
  <input type="hidden" id="{$setting_id}" name="{$setting_id}" value="{$setting_value}" />
  <p class="description">{$args[0]}</p>
setting_html;
}