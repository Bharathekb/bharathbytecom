<?php
/**
 * Single post template.
 *
 * @package Bharathbyte
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		$post_id      = get_the_ID();
		$categories   = get_the_category();
		$primary_cat  = ! empty( $categories ) ? $categories[0] : null;
		$content_raw  = apply_filters( 'the_content', get_the_content() );
		$toc_items    = array();
		$heading_seen = array();

		$content = preg_replace_callback(
			'/<h2([^>]*)>(.*?)<\/h2>/i',
			function ( $matches ) use ( &$toc_items, &$heading_seen ) {
				$attrs = $matches[1];
				$title = wp_strip_all_tags( $matches[2] );
				$slug  = sanitize_title( $title );

				if ( isset( $heading_seen[ $slug ] ) ) {
					$heading_seen[ $slug ]++;
					$slug .= '-' . $heading_seen[ $slug ];
				} else {
					$heading_seen[ $slug ] = 1;
				}

				if ( preg_match( '/\sid=(["\'])(.*?)\1/i', $attrs, $id_match ) ) {
					$slug = $id_match[2];
				} else {
					$attrs .= ' id="' . esc_attr( $slug ) . '"';
				}

				$toc_items[] = array(
					'id'    => $slug,
					'title' => $title,
				);

				return '<h2' . $attrs . '>' . $matches[2] . '</h2>';
			},
			$content_raw
		);

		$word_count   = str_word_count( wp_strip_all_tags( get_the_content() ) );
		$reading_time = max( 1, (int) ceil( $word_count / 220 ) );
		?>

		<article <?php post_class( 'article-detail' ); ?>>
			<header class="container-xxl px-4 px-lg-5 article-hero">
				<div class="article-hero__inner">
					<?php if ( $primary_cat ) : ?>
						<a class="article-hero__category" href="<?php echo esc_url( get_category_link( $primary_cat ) ); ?>">
							<?php echo esc_html( $primary_cat->name ); ?>
						</a>
					<?php endif; ?>

					<h1><?php the_title(); ?></h1>

					<div class="article-meta d-flex align-items-center flex-wrap">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', get_the_author(), array( 'class' => 'article-meta__avatar' ) ); ?>
						<span class="article-meta__author"><?php the_author(); ?></span>
						<span aria-hidden="true">&middot;</span>
						<span><?php esc_html_e( 'Published', 'bharathbyte' ); ?> <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
						<span aria-hidden="true">&middot;</span>
						<span>
							<?php
							printf(
								/* translators: %d: estimated reading time in minutes. */
								esc_html__( '%d min read', 'bharathbyte' ),
								(int) $reading_time
							);
							?>
						</span>
					</div>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="article-featured-image">
					<?php the_post_thumbnail( 'full' ); ?>
				</figure>
			<?php endif; ?>

			<div class="container-xxl px-4 px-lg-5 article-body-wrap">
				<div class="row g-5 justify-content-center">
					<div class="col-12 col-lg-8">
						<div class="article-content">
							<?php echo wp_kses_post( $content ); ?>
						</div>
					</div>

					<aside class="col-12 col-lg-3 article-sidebar">
						<?php if ( ! empty( $toc_items ) ) : ?>
							<div class="article-toc">
								<h2><?php esc_html_e( 'Table of Contents', 'bharathbyte' ); ?></h2>
								<nav aria-label="<?php esc_attr_e( 'Article table of contents', 'bharathbyte' ); ?>">
									<?php foreach ( $toc_items as $toc_item ) : ?>
										<a href="#<?php echo esc_attr( $toc_item['id'] ); ?>">
											<?php echo esc_html( $toc_item['title'] ); ?>
										</a>
									<?php endforeach; ?>
								</nav>
							</div>
						<?php endif; ?>
					</aside>
				</div>
			</div>
		</article>

		<?php
		$related_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'post__not_in'        => array( $post_id ),
			'ignore_sticky_posts' => true,
		);

		if ( $primary_cat ) {
			$related_args['cat'] = $primary_cat->term_id;
		}

		$related_posts = new WP_Query( $related_args );

		if ( $related_posts->have_posts() ) :
			?>
			<section class="related-articles" aria-labelledby="related-articles-title">
				<div class="container-xxl px-4 px-lg-5">
					<div class="d-flex align-items-end justify-content-between related-articles__header">
						<div>
							<h2 id="related-articles-title"><?php esc_html_e( 'Related Articles', 'bharathbyte' ); ?></h2>
							<p><?php esc_html_e( 'Expand your perspective with these curated reads.', 'bharathbyte' ); ?></p>
						</div>
						<a class="archive-link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/' ) ); ?>">
							<?php esc_html_e( 'View All Library', 'bharathbyte' ); ?>
						</a>
					</div>

					<div class="row g-4">
						<?php
						while ( $related_posts->have_posts() ) :
							$related_posts->the_post();
							$related_cats = get_the_category();
							?>
							<div class="col-12 col-md-6 col-lg-4">
								<article <?php post_class( 'story-card h-100' ); ?>>
									<a class="story-card__image" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'medium_large' );
										}
										?>
									</a>
									<div class="story-card__body">
										<?php if ( ! empty( $related_cats ) ) : ?>
											<a class="story-card__tag" href="<?php echo esc_url( get_category_link( $related_cats[0] ) ); ?>">
												<?php echo esc_html( $related_cats[0]->name ); ?>
											</a>
										<?php endif; ?>
										<h3>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
										<div class="story-card__date">
											<?php echo esc_html( get_the_date() ); ?>
										</div>
										<div class="story-card__excerpt">
											<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '...' ) ); ?></p>
										</div>
										<div class="story-card__footer">
											<span class="story-card__author"><?php the_author(); ?></span>
											<a class="story-card__action" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
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
				</div>
			</section>
			<?php
		endif;
	endwhile;
endif;

get_footer();
