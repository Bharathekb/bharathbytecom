<?php
/**
 * Front page template.
 *
 * @package Bharathbyte
 */

get_header();

$home_categories = get_categories(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
	)
);
?>

<section class="home-intro" aria-labelledby="home-intro-title">
	<div class="container-xxl px-4 px-lg-5">
		<div class="home-intro__image">
			<img
				src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/BharathByte-Hero-Banner.png' ); ?>"
				width="1920"
				height="740"
				alt="<?php esc_attr_e( 'BharathByte technology blog hero banner for UI, React, projects, and digital learning', 'bharathbyte' ); ?>"
				fetchpriority="high"
			>
		</div>

		<div class="home-search-wrap">
			<form class="home-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="home-search-field"><?php esc_html_e( 'Search for:', 'bharathbyte' ); ?></label>
				<input
					id="home-search-field"
					type="search"
					name="s"
					value="<?php echo esc_attr( get_search_query() ); ?>"
					placeholder="<?php esc_attr_e( 'Search articles, projects, and notes', 'bharathbyte' ); ?>"
					autocomplete="off"
				>
				<button type="submit">
					<?php esc_html_e( 'Search', 'bharathbyte' ); ?>
				</button>
			</form>
		</div>
	</div>
</section>

<section class="container-xxl px-4 px-lg-5 category-filter" id="categories" aria-label="<?php esc_attr_e( 'Post categories', 'bharathbyte' ); ?>">
	<div class="category-filter__inner d-flex align-items-center flex-wrap">
		<a class="category-chip category-chip--active" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php esc_html_e( 'All', 'bharathbyte' ); ?>
		</a>

		<?php foreach ( $home_categories as $home_category ) : ?>
			<a class="category-chip" href="<?php echo esc_url( get_category_link( $home_category ) ); ?>">
				<?php echo esc_html( $home_category->name ); ?>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<section class="container-xxl px-4 px-lg-5 pb-5 latest-posts" aria-labelledby="latest-posts-title">
	<div class="d-flex align-items-center justify-content-between mb-4">
		<h2 id="latest-posts-title"><?php esc_html_e( 'Latest Stories', 'bharathbyte' ); ?></h2>
		<a class="archive-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>">
			<?php esc_html_e( 'View All Archive', 'bharathbyte' ); ?>
		</a>
	</div>

	<?php
	$latest_posts = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 6,
			'ignore_sticky_posts' => true,
		)
	);

	if ( $latest_posts->have_posts() ) :
		?>
		<div class="row g-4">
			<?php
			while ( $latest_posts->have_posts() ) :
				$latest_posts->the_post();
				?>
				<div class="col-12 col-md-6 col-lg-4">
					<article <?php post_class( 'story-card h-100' ); ?>>
						<a href="<?php the_permalink(); ?>" class="story-card__image">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'medium_large' );
							}
							?>
						</a>
						<div class="story-card__body">
							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) :
								?>
								<a class="story-card__tag" href="<?php echo esc_url( get_category_link( $categories[0] ) ); ?>">
									<?php echo esc_html( $categories[0]->name ); ?>
								</a>
								<?php
							endif;
							?>
							<h3>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="story-card__date">
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
								</time>
							</div>
							<div class="story-card__excerpt">
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '...' ) ); ?></p>
							</div>
							<div class="story-card__footer">
								<span class="story-card__author"><?php the_author(); ?></span>
								<a class="story-card__action" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'bharathbyte' ), get_the_title() ) ); ?>">
									<span aria-hidden="true">&rarr;</span>
								</a>
							</div>
						</div>
					</article>
				</div>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</div>
		<?php
	else :
		?>
		<p><?php esc_html_e( 'No posts found yet.', 'bharathbyte' ); ?></p>
		<?php
	endif;
	?>
</section>

<?php
get_footer();
