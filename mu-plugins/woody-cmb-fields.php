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
function woody_register_theme_options_metabox() {
 $prefix = '_woody_';

 /**
  * Registers options page menu item and form.
  */
 $cmb_options = new_cmb2_box( array(
   'id'           => 'woody_theme_options_page',
   'title'        => esc_html__( 'Woody Contact Details', 'cmb2' ),
   'object_types' => array( 'options-page' ),
   'option_key'      => 'woody_contact_details', // The option key and admin menu page slug.
   'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.

 ) );


  $cmb_options->add_field( array(
    'name'       => esc_html__( 'Company Name', 'cmb2' ),
    'id'         => $prefix . 'company_name',
    'type'       => 'text',

  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'C/O', 'cmb2' ),
    'id'         => $prefix . 'c_o',
    'type'       => 'text',

  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'Address', 'cmb2' ),
    'id'         => $prefix . 'address',
    'type'       => 'text',
    'repeatable'      => true,
  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'Town/City', 'cmb2' ),
    'id'         => $prefix . 'town',
    'type'       => 'text',

  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'County', 'cmb2' ),
    'id'         => $prefix . 'county',
    'type'       => 'text',

  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'Postcode', 'cmb2' ),
    'id'         => $prefix . 'postcode',
    'type'       => 'text',

  ) );

  $cmb_options->add_field( array(
    'name'       => esc_html__( 'Telephone', 'cmb2' ),
    'id'         => $prefix . 'Tel',
    'type'       => 'text',

  ) );

 $cmb_options->add_field( array(
   'name' => esc_html__( 'Twitter URL', 'cmb2' ),
   'id'   => $prefix . 'url',
   'type' => 'text_url',

 ) );

 $cmb_options->add_field( array(
   'name' => esc_html__( 'Email', 'cmb2' ),
   'id'   => $prefix . 'email',
   'type' => 'text_email',
 ) );

}


add_action( 'cmb2_admin_init', 'woody_register_theme_activities_metabox' );
/**
* Hook in and register a metabox to handle a theme options page and adds a menu item.
*/
function woody_register_theme_activities_metabox() {
   $prefix = '_activities_';

   /**
    * Registers options page menu item and form.
    */
   $woody_activities = new_cmb2_box( array(
     'id'           => 'woody_theme_activities_metabox',
     'title'        => esc_html__( 'Woody Contact Details', 'cmb2' ),
     'object_types' => array( 'activities' ),
     'option_key'      => 'woody_activities_details', // The option key and admin menu page slug.
     //'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.

   ) );



    $woody_activities->add_field( array(
  	'name'           => 'Activity Type Select',
  	'desc'           => 'Select the category in which to show this activity ',
  	'id'             => 'taxonomy_select',
  	'taxonomy'       => 'activity_type', //Enter Taxonomy Slug
  	'type'           => 'taxonomy_select',
  	'remove_default' => 'true' // Removes the default metabox provided by WP core. Pending release as of Aug-10-16
  ) );
}
