<?php

class Activity_Widget extends WP_Widget
{
	function __construct() {
		parent::__construct(
			'activity_widget', // Base ID
			'Activity Widget', // Name
			array('description' => __( 'Displays activities under activity type'))
		);
	}

  function widget($args, $instance) { //output
    extract( $args );

    // these are the widget options
    $title = apply_filters('widget_title', $instance['title']);
    $number_of_posts = $instance['number_of_posts'];

    echo $before_widget;
    // Check if title is set
    if ( $title ) {
      echo $before_title . $title . $after_title;
    }

    $this->get_custom_posts($number_of_posts);
		echo $after_widget;
	}

  function update($new_instance, $old_instance) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number_of_posts'] = strip_tags($new_instance['number_of_posts']);

		return $instance;
	}



  function form($instance) {
	if( $instance) {
		$title = esc_attr($instance['title']);
		$number_of_posts = esc_attr($instance['number_of_posts']);

	} else {
		$title = '';
		$number_of_posts = '';

	}
	?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'custom_post&_tax_widget'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of Listings:', 'custom_post&_tax_widget'); ?></label>
		<select id="<?php echo $this->get_field_id('number_of_posts'); ?>"  name="<?php echo $this->get_field_name('number_of_posts'); ?>">
			<?php $x = -1; ?>
			<option <?php echo $x == $number_of_posts ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
			<?php for($x=1;$x<=10;$x++): ?>
			<option <?php echo $x == $number_of_posts ? 'selected="selected"' : '';?> value="<?php echo $x;?>"><?php echo $x; ?></option>
			<?php endfor;?>
		</select>
		</p>

	<?php
	}


	function get_custom_posts($number_of_posts) {
		$cats = get_terms(array('taxonomy' => 'activity_type','hide_empty' => false));  //+++ selected taxonomy variable

		foreach ($cats as $cat){

			$category_link = get_category_link( $cat->term_id );?>
		<ul>
			<li> <a href="<?php echo esc_url( $category_link ); ?>" title="Category Name"><?php echo $cat->name?></a></li>
	<?php $cat_id= $cat->term_id;
				$args=array(
					'posts_per_page' => $number_of_posts,
					'post_type' => 'activities', //+++   selected post var
					'tax_query' => array(
					array(
					 'taxonomy' => 'activity_type',
					 'terms' => $cat_id,
				 ))
				);
			 $loop = new WP_Query( $args );
				if (have_posts()){
				while ( $loop->have_posts() ) : $loop->the_post();?>
						<ul>
							<li>
								<a href="<?php echo get_permalink(); ?>"> <?php the_title(); ?>  </a>
							</li>
						</ul>
		<?php

				endwhile;
			}//endif have posts
			echo "</ul>";
		}//endfor
	}

} //end class Activity_Widget


add_action('widgets_init','register_activity_widget');
function register_activity_widget(){
	register_widget('Activity_Widget');
}

?>
