</main>

<footer class="site-footer" id="about">
	<div class="container-xxl px-4 px-lg-5 py-5">
		<div class="row gy-5 justify-content-between">
			<section class="col-12 col-lg-5 site-footer__brand" aria-labelledby="footer-brand">
				<a class="site-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Bharathbyte home', 'bharathbyte' ); ?>">
					<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/BharathByte-logo.png' ); ?>" width="200" height="40" alt="<?php esc_attr_e( 'Bharathbyte', 'bharathbyte' ); ?>">
				</a>
				<h2 id="footer-brand" class="screen-reader-text"><?php esc_html_e( 'Bharathbyte', 'bharathbyte' ); ?></h2>
				<p>
					<?php esc_html_e( 'A journal dedicated to the intersection of modern aesthetics and deep culture, exploring the silent nuances of a digital world.', 'bharathbyte' ); ?>
				</p>
			</section>

			<nav class="col-6 col-sm-4 col-lg-auto footer-nav d-flex flex-column align-items-start" aria-label="<?php esc_attr_e( 'Footer navigation', 'bharathbyte' ); ?>">
				<h3><?php esc_html_e( 'Navigation', 'bharathbyte' ); ?></h3>
				<?php
				if ( has_nav_menu( 'footer' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'footer-nav__menu d-flex flex-column align-items-start list-unstyled m-0 p-0',
							'fallback_cb'    => false,
							'depth'          => 1,
						)
					);
				} else {
					?>
					<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'bharathbyte' ); ?></a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'bharathbyte' ); ?></a>
					<?php
				}
				?>
			</nav>

			<nav class="col-6 col-sm-4 col-lg-auto footer-nav d-flex flex-column align-items-start" aria-label="<?php esc_attr_e( 'Social links', 'bharathbyte' ); ?>">
				<h3><?php esc_html_e( 'Follow', 'bharathbyte' ); ?></h3>
				<?php
				if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'social',
							'container'      => false,
							'menu_class'     => 'footer-nav__menu d-flex flex-column align-items-start list-unstyled m-0 p-0',
							'fallback_cb'    => false,
							'depth'          => 1,
						)
					);
				} else {
					?>
					<a href="#instagram"><?php esc_html_e( 'Instagram', 'bharathbyte' ); ?></a>
					<a href="#linkedin"><?php esc_html_e( 'LinkedIn', 'bharathbyte' ); ?></a>
					<?php
				}
				?>
			</nav>
		</div>
	</div>

	<div class="container-xxl px-4 px-lg-5 site-footer__bottom d-flex align-items-center justify-content-between">
		<p>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php esc_html_e( 'Bharathbyte', 'bharathbyte' ); ?>. <?php esc_html_e( 'All rights reserved. Designed for clarity.', 'bharathbyte' ); ?></p>
		<div class="footer-utility d-flex align-items-center" aria-label="<?php esc_attr_e( 'Footer utility links', 'bharathbyte' ); ?>">
			<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>" aria-label="<?php esc_attr_e( 'RSS feed', 'bharathbyte' ); ?>">
				<svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
					<path d="M4 11a9 9 0 0 1 9 9"></path>
					<path d="M4 4a16 16 0 0 1 16 16"></path>
					<circle cx="5" cy="19" r="1"></circle>
				</svg>
			</a>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Home', 'bharathbyte' ); ?>">
				<svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
					<circle cx="12" cy="12" r="10"></circle>
					<path d="M2 12h20"></path>
					<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
				</svg>
			</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
