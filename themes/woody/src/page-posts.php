<?php
/*
 Template Name: posts
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
        while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( array('cf','news-page') ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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

	<?php endwhile;?>
       <?php
		      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		      $mypost = array( 'post_type' => 'post','paged' => $paged,  'posts_per_page' => 10,'category__not_in' => 14);
		      $loop = new WP_Query( $mypost )
        ?>
  		<?php if (have_posts()) :
				while ( $loop->have_posts() ) : $loop->the_post();?>
							<article  id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="page-post">
									<header  id = "post-head" class="article-header">
										<h2  class="page-title">
											<a href="<?php echo get_permalink(); ?>"> <?php the_title(); ?>  </a>
										</h2>
										<p class="byline entry-meta vcard">
											<?php
											$end_date = get_post_meta( get_the_ID(), 'woody_post_end_date', true );
											if ($end_date) :
												printf( __( '', 'bonestheme' ).' %1$s - %2$s',
																 /* the time the post was published */
																 '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
																 '<time class="updated entry-time"  >' . $end_date . '</time>'

																			);
											else :
												printf( __( '', 'bonestheme' ).' %1$s ',
																/* the time the post was published */
																'<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>'

																			);
											endif;
											 ?>
										</p>

                  </header>

									<section id="section" class="entry-content cf" itemprop="articleBody">
										<?php
												if ( has_post_thumbnail() ) {
														the_post_thumbnail('bones-thumb-900',array( 'id' => 'all-posts-thumb'));
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
				endwhile; ?>
			<?php bones_page_navi('','',$loop); ?>

			<?php
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
			wp_reset_postdata();
 ?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer();
