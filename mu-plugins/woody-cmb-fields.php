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
   'title'        => esc_html__( 'Contact Details', 'cmb2' ),
   'object_types' => array( 'options-page' ),
   'option_key'      => 'woody_contact_details', // The option key and admin menu page slug.
   //'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
   'parent_slug'     => 'options-general.php',
   'capability'      => 'manage_options',

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
     'title'        => esc_html__( ' ', 'cmb2' ),
     'object_types' => array( 'activities' ),
     'option_key'      => 'woody_activities_details', // The option key and admin menu page slug.
     //'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.

   ) );



    $woody_activities->add_field( array(
  	'name'           => 'Activity Type Select',
  	'desc'           => 'Select the category in which to show this activity. Selecting None will remove this activity from view',
  	'id'             => 'taxonomy_select',
  	'taxonomy'       => 'activity_type', //Enter Taxonomy Slug
  	'type'           => 'taxonomy_select',
  	'remove_default' => 'true' // Removes the default metabox provided by WP core. Pending release as of Aug-10-16
  ) );
}




/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function cmb2_get_post_options( $query_args ) {

	$args = wp_parse_args( $query_args, array(
		'post_type'   => 'post',
		'numberposts' => 10,
	) );

	$posts = get_posts( $args );

	$post_options = array();
	if ( $posts ) {
		foreach ( $posts as $post ) {
          $post_options[ $post->ID ] = $post->post_title;
		}
	}

	return $post_options;
}

/**
 * Gets all locations and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_location_post_options() {
	return cmb2_get_post_options( array( 'post_type' => 'locations', 'numberposts' => -1 ) );
}

/**
 * Gets all locations and displays them as options
 * @return array An array of options that matches the CMB2 options array
 */
function cmb2_get_activity_post_options() {
	return cmb2_get_post_options( array( 'post_type' => 'activities', 'numberposts' => -1 ) );
}


add_action( 'cmb2_admin_init', 'woody_register_post_metabox' );
/**
* Hook in and register a metabox to handle a theme options page and adds a menu item.
*/
function woody_register_post_metabox() {
  $prefix = '_locations_';

   /**
    * Registers options page menu item and form.
    */
   $woody_locations = new_cmb2_box( array(
     'id'           => 'woody_theme_locations_metabox',
     'title'        => esc_html__( ' ', 'cmb2' ),
     'object_types' => array( 'post' ),
     'option_key'      => 'woody_location_details', // The option key and admin menu page slug.
     //'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.

   ) );

  $woody_locations->add_field( array(
   	'name' => 'Archive',
   	'desc' => 'Check to move Post to Archive',
   	'id'   => $prefix .'archive_checkbox',
   	'type' => 'checkbox',
 ) );

  $woody_locations->add_field( array(
    'name' => 'Start Date',
    'id'   => 'woody_post_start_date',
    'type' => 'text_date',
    // 'timezone_meta_key' => 'wiki_test_timezone',
    // 'date_format' => 'l jS \of F Y',
 ) );

  $woody_locations->add_field( array(
   'name' => 'End Date',
   'id'   => 'woody_post_end_date',
   'type' => 'text_date',
   // 'timezone_meta_key' => 'wiki_test_timezone',
   // 'date_format' => 'l jS \of F Y',
 ) );

  $woody_locations->add_field( array(
  	'name'       => __( 'Select Related Locations', 'cmb2' ),
  	'desc'       => __( 'Relate this Post to Locations', 'cmb2' ),
  	'id'         => $prefix . 'post_multicheckbox',
  	'type'       => 'multicheck',
  	'options_cb' => 'cmb2_get_location_post_options',
) );

  $woody_locations->add_field( array(
    'name'       => __( 'Select Related Activities', 'cmb2' ),
    'desc'       => __( 'Relate this Post to Activities', 'cmb2' ),
    'id'         => $prefix . 'activity_multicheckbox',
    'type'       => 'multicheck',
    'options_cb' => 'cmb2_get_activity_post_options',
  ) );

}
