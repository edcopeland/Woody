<?php
/*
Plugin Name: Woody Plugin
Description: A plugin to add features to the woody theme
Version: 1.0
Author: Ed Copeland
License: GPLv2
*/

add_action( 'init', 'create_activity_type' );

function create_activity_type() {
  register_post_type( 'activities',
          array(
              'labels' => array(
                  'name' => 'What We Do',
                  'singular_name' => 'Activity',
                  'add_new' => 'Add New',
                  'add_new_item' => 'Add New Activity',
                  'edit' => 'Edit',
                  'edit_item' => 'Edit Activity',
                  'new_item' => 'New Activity',
                  'view' => 'View',
                  'view_item' => 'View Activity',
                  'search_items' => 'Search Activities',
                  'not_found' => 'No Activities found',
                  'not_found_in_trash' => 'No Activities found in Trash',
                  'parent' => 'Parent Activity'
              ),

              'public' => true,
              'menu_position' => 6,
              'supports' => array( 'title', 'editor', 'thumbnail' ),
              'taxonomies' => array( '' ),
              'show_in_rest'      => true,
              'menu_icon' => "dashicons-admin-post",
              'has_archive' => true
          )
      );}


add_action( 'init', 'create_location_type' );

function create_location_type() {
  register_post_type( 'locations',
          array(
              'labels' => array(
                  'name' => 'Locations',
                  'singular_name' => 'Location',
                  'add_new' => 'Add New',
                  'add_new_item' => 'Add New Location',
                  'edit' => 'Edit',
                  'edit_item' => 'Edit Location',
                  'new_item' => 'New Location',
                  'view' => 'View',
                  'view_item' => 'View Location',
                  'search_items' => 'Search Locations',
                  'not_found' => 'No Locations found',
                  'not_found_in_trash' => 'No Locations found in Trash',
                  'parent' => 'Parent Location'
              ),

              'public' => true,
              'menu_position' => 7,
              'supports' => array( 'title', 'editor', 'thumbnail' ),
              'taxonomies' => array( '' ),
              'show_in_rest'      => true,
              'menu_icon' => "dashicons-admin-post",
              'has_archive' => true
          )
      );
}

add_action( 'init', 'create_activity_type_taxonomy', 0 );

      // an Activity Type taxonomy for categorising activities by type
function create_activity_type_taxonomy() {


  $labels = array(
    'name' => _x( 'Activity Type', 'taxonomy general name' ),
    'singular_name' => _x( 'Activity Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Activity Types' ),
    'all_items' => __( 'All Activity Types' ),
    'parent_item' => __( 'Parent Activity Type' ),
    'parent_item_colon' => __( 'Parent Activity Type:' ),
    'edit_item' => __( 'Edit Activity Type' ),
    'update_item' => __( 'Update Activity Type' ),
    'add_new_item' => __( 'Add New Activity Type' ),
    'new_item_name' => __( 'New Activity Type Name' ),
    'menu_name' => __( 'Activity Type' ),
  );


  register_taxonomy('activity_type',array('activities'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
		'show_in_rest'      => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'activity_type' ),
  ));

}

?>
