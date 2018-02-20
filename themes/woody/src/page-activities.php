<?php
/*
 Template Name: activities
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>
<?php get_header(); ?>
	<div id="content">
		<div id="inner-content" class="wrap cf">
			<div id="main" class="m-all t-all d-4of7 cf" role="main">
        <?php
        while (have_posts()) : the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'cf','activities-page') ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						<header class="article-header">
							<h1 class="page-title"><?php the_title(); ?></h1>
						</header>

						<section class="entry-content cf" itemprop="articleBody">
						<?php
							the_content();
						?>
						</section>
							<!--<footer class="article-footer">

						<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
							</footer> -->
						</article>


					<?php
				endwhile;?>

						<?php $cats = get_terms('activity_type');
						foreach ($cats as $cat){

							// Make a header for the cateogry
							echo "<div class='category-name'>";
							echo "<h2 >".$cat->name."</h2>";
							echo "</div>";
								$cat_id= $cat->term_id;
								$args=array(
									'posts_per_page' => -1,
									'post_type' => 'activities',
									'tax_query' => array(
			 						array(
									 'taxonomy' => 'activity_type',
									 'terms' => $cat_id,
								 ))
								);
							 $loop = new WP_Query( $args );
							  if (have_posts()) :
							  while ( $loop->have_posts() ) : $loop->the_post();?>
								<article  id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
									<div class="page-post">
										<header  id = "post-head" class="article-header">
											<h2  class="page-title">
												<a href="<?php echo get_permalink(); ?>"> <?php the_title(); ?>  </a>
											</h2>

	                  </header>

										<section id="section" class="entry-content cf" itemprop="articleBody">
											<?php
													if ( has_post_thumbnail() ) {
															the_post_thumbnail('bones-thumb-600',array( 'id' => 'all-posts-thumb'));
															 //the_post_thumbnail( 'bones-thumb-600' );
													}
													?>
	                    	<?php  the_excerpt(); ?>
	                     	<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>
	                    <a id="more-link" href="<?php echo get_permalink(); ?>"> More....</a>
										</section>
										<div class="clearfix"></div>
	                  <footer class="article-footer">

	                  </footer>

		              </div>
								</article>
						<?php

								endwhile;
								else : ?>
								<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
						                                                                          </header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
					          </section>
					          <footer class="article-footer">
											<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
					          </footer>
								</article>
								<?php
							endif;
						}
						wp_reset_postdata();
						?>


			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();
