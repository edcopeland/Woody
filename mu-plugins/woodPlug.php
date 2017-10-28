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
  register_post_type( 'activites',
          array(
              'labels' => array(
                  'name' => 'Activities',
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
              'menu_position' => 15,
              'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
              'taxonomies' => array( '' ),
              'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
              'has_archive' => true
          )
      );}



?>
