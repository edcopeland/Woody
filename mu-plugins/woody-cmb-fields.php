<?php

// Include CMB2 globally for this site.


  if ( file_exists( WPMU_PLUGIN_DIR . '/cmb2/init.php' ) ) {
  	require_once WPMU_PLUGIN_DIR . '/cmb2/init.php';
  } elseif ( file_exists( WPMU_PLUGIN_DIR . '/CMB2/init.php' ) ) {
  	require_once WPMU_PLUGIN_DIR . '/CMB2/init.php';
  }


  add_action( 'cmb2_admin_init', 'woody_register_theme_options_metabox' );
  /**
   * Hook in and register a metabox to handle a theme options page and adds a menu item.
   */
