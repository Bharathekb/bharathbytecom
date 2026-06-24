<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" sizes="512x512" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Favicon.png' ); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/Favicon.png' ); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php wp_head(); ?>
    	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-BG716YKGS5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-BG716YKGS5');
</script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="page-loader is-active" aria-live="polite" aria-hidden="false">
	<div class="page-loader__box">
		<span class="page-loader__spinner" aria-hidden="true"></span>
		<span class="page-loader__text"><?php esc_html_e( 'Loading', 'bharathbyte' ); ?><span class="page-loader__dots" aria-hidden="true"></span></span>
	</div>
</div>
<script>
	(function () {
		function hideBharathbyteLoader() {
			var loader = document.querySelector('.page-loader');

			if (!loader) {
				return;
			}

			loader.classList.remove('is-active');
			loader.setAttribute('aria-hidden', 'true');
		}

		window.bharathbyteHideLoader = hideBharathbyteLoader;
		window.setTimeout(hideBharathbyteLoader, 2500);
	})();
</script>

<header class="site-header navbar navbar-expand-md fixed-top py-0">
	<div class="container-xxl px-4 px-lg-5 site-header__inner">
		<a class="navbar-brand brand me-0" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Bharathbyte home', 'bharathbyte' ); ?>">
			<img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/BharathByte-logo.png' ); ?>" width="200" height="40" alt="<?php esc_attr_e( 'Bharathbyte', 'bharathbyte' ); ?>">
		</a>

		<nav id="primaryNavbar" class="primary-nav collapse navbar-collapse justify-content-md-center order-3 order-md-2" aria-label="<?php esc_attr_e( 'Primary navigation', 'bharathbyte' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				$primary_menu = wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-nav__menu navbar-nav align-items-md-center justify-content-md-center gap-md-4 gap-lg-5 list-unstyled m-0 p-0',
						'fallback_cb'    => false,
						'depth'          => 1,
						'echo'           => false,
					)
				);

				$extra_items  = '<li class="menu-item"><a class="nav-link primary-nav__link" href="http://mitrama.in/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Mitrama', 'bharathbyte' ) . '</a></li>';
				$extra_items .= '<li class="menu-item"><a class="nav-link primary-nav__link" href="' . esc_url( home_url( '/contact/' ) ) . '">' . esc_html__( 'Contact', 'bharathbyte' ) . '</a></li>';

				echo str_replace( '</ul>', $extra_items . '</ul>', $primary_menu ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				?>
				<ul class="primary-nav__menu navbar-nav align-items-md-center justify-content-md-center gap-md-4 gap-lg-5 list-unstyled m-0 p-0">
					<li class="menu-item"><a class="nav-link primary-nav__link primary-nav__link--active" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'bharathbyte' ); ?></a></li>
					<li class="menu-item"><a class="nav-link primary-nav__link" href="<?php echo esc_url( home_url( '/category/' ) ); ?>"><?php esc_html_e( 'Categories', 'bharathbyte' ); ?></a></li>
					<li class="menu-item"><a class="nav-link primary-nav__link" href="#about"><?php esc_html_e( 'About', 'bharathbyte' ); ?></a></li>
					<li class="menu-item"><a class="nav-link primary-nav__link" href="http://mitrama.in/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Mitrama', 'bharathbyte' ); ?></a></li>
					<li class="menu-item"><a class="nav-link primary-nav__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'bharathbyte' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</nav>

		<div class="header-actions d-flex align-items-center justify-content-end gap-2 order-2 order-md-3">
			<form class="header-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="header-search-field"><?php esc_html_e( 'Search for:', 'bharathbyte' ); ?></label>
				<input
					id="header-search-field"
					class="header-search__field"
					type="search"
					name="s"
					value="<?php echo esc_attr( get_search_query() ); ?>"
					placeholder="<?php esc_attr_e( 'Search stories', 'bharathbyte' ); ?>"
					autocomplete="off"
				>
				<button class="search-button btn p-0 d-inline-grid" type="submit" aria-label="<?php esc_attr_e( 'Search', 'bharathbyte' ); ?>" aria-expanded="false">
					<svg aria-hidden="true" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="11" cy="11" r="7"></circle>
						<path d="m20 20-4.2-4.2"></path>
					</svg>
				</button>
			</form>

			<button class="navbar-toggler site-menu-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbar" aria-controls="primaryNavbar" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'bharathbyte' ); ?>">
				<span class="site-menu-toggle__box" aria-hidden="true">
					<span class="site-menu-toggle__line"></span>
					<span class="site-menu-toggle__line"></span>
					<span class="site-menu-toggle__line"></span>
				</span>
			</button>
		</div>
	</div>
</header>

<main class="site-main">
