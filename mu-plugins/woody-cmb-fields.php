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
 $prefix = '_contact_options_';

 /**
  * Registers options page menu item and form.
  */
 $contact_options = new_cmb2_box( array(
   'id'           => 'contact_options_page',
   'title'        => esc_html__( 'Contact Details', $prefix ),
   'object_types' => array( 'options-page' ),
   'option_key'      => 'woody_contact_details', // The option key and admin menu page slug.
   //'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
   'parent_slug'     => 'options-general.php',
   'capability'      => 'manage_options',

 ) );


  $contact_options->add_field( array(
    'name'       => esc_html__( 'Company Name', $prefix ),
    'id'         => $prefix . 'company_name',
    'type'       => 'text',

  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'C/O', $prefix ),
    'id'         => $prefix . 'c_o',
    'type'       => 'text',

  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'Address', $prefix ),
    'id'         => $prefix . 'address',
    'type'       => 'text',
    'repeatable'      => true,
  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'Town/City', $prefix ),
    'id'         => $prefix . 'town',
    'type'       => 'text',

  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'County', $prefix ),
    'id'         => $prefix . 'county',
    'type'       => 'text',

  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'Postcode', $prefix ),
    'id'         => $prefix . 'postcode',
    'type'       => 'text',

  ) );

  $contact_options->add_field( array(
    'name'       => esc_html__( 'Telephone', $prefix ),
    'id'         => $prefix . 'tel',
    'type'       => 'text',

  ) );

 $contact_options->add_field( array(
   'name' => esc_html__( 'Twitter URL', $prefix ),
   'id'   => $prefix . 'url',
   'type' => 'text_url',

 ) );

 $contact_options->add_field( array(
   'name' => esc_html__( 'Email', $prefix ),
   'id'   => $prefix . 'email',
   'type' => 'text_email',
 ) );

}

add_action( 'cmb2_admin_init', 'woody_register_theme_activities_metabox' );
/**
* Hook in and register a metabox to handle a theme options page and adds a menu item.
*/

function contact_get_option( $key = '', $default = false ) {
	if ( function_exists( 'cmb2_get_option' ) ) {
		// Use cmb2_get_option as it passes through some key filters.
		return cmb2_get_option( 'woody_contact_details', $key, $default );
	}
	// Fallback to get_option if CMB2 is not loaded yet.
	$opts = get_option( 'woody_contact_details', $default );
	$val = $default;
	if ( 'all' == $key ) {
		$val = $opts;
	} elseif ( is_array( $opts ) && array_key_exists( $key, $opts ) && false !== $opts[ $key ] ) {
		$val = $opts[ $key ];
	}
	return $val;
}


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
    'name' => 'Start Date',
    'id'   => 'woody_post_start_date',
    'type' => 'text_date',
    'date_format' => 'M Y',
 ) );

  $woody_locations->add_field( array(
   'name' => 'End Date',
   'id'   => 'woody_post_end_date',
   'type' => 'text_date',
   'date_format' => 'M Y',
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
