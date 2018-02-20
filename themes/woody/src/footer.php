			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="inner-footer wrap cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>

					<!-- <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p> -->
      <div class="footer-contacts">
				<ul>
						<li><?php echo contact_get_option( '_contact_options_company_name'); ?></li>
						<li><?php echo  contact_get_option( '_contact_options_c_o');?></li>

						<?php $address_array = contact_get_option( '_contact_options_address');?>

						<?php foreach ($address_array as &$value) { ?>
						<li><?php echo $value ?></li>
						<?php } ?>

						<li><?php echo contact_get_option( '_contact_options_town');?></li>
						<li><?php echo contact_get_option( '_contact_options_county'); ?></li>
						<li><?php echo contact_get_option( '_contact_options_postcode'); ?></li>
						<li><?php echo contact_get_option( '_contact_options_tel'); ?></li>
						<li><?php echo contact_get_option( '_contact_options_url'); ?></li>
						<li><?php echo contact_get_option( '_contact_options_email'); ?></li>
				</ul>
      </div>

				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
