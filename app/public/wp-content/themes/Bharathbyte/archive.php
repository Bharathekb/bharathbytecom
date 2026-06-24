<?php
/**
 * Archive template.
 *
 * @package Bharathbyte
 */

get_header();

$archive_title       = is_category() ? single_cat_title( '', false ) : get_the_archive_title();
$archive_description = get_the_archive_description();
$archive_categories  = get_categories(
	array(
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true,
	)
);
?>

<section class="archive-hero" aria-labelledby="archive-title">
	<div class="container-xxl px-4 px-lg-5">
		<p class="section-kicker"><?php esc_html_e( 'Archive', 'bharathbyte' ); ?></p>
		<h1 id="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
		<?php if ( $archive_description ) : ?>
			<div class="archive-hero__description">
				<?php echo wp_kses_post( wpautop( $archive_description ) ); ?>
			</div>
		<?php else : ?>
			<p class="archive-hero__description"><?php esc_html_e( 'Explore focused stories, notes, and lessons from BharathByte.', 'bharathbyte' ); ?></p>
		<?php endif; ?>
	</div>
</section>

<?php if ( ! empty( $archive_categories ) ) : ?>
	<section class="container-xxl px-4 px-lg-5 archive-filter" aria-label="<?php esc_attr_e( 'Browse categories', 'bharathbyte' ); ?>">
		<div class="category-filter__inner d-flex align-items-center flex-wrap">
			<a class="category-chip" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'All', 'bharathbyte' ); ?></a>
			<?php foreach ( $archive_categories as $archive_category ) : ?>
				<a class="category-chip<?php echo is_category( $archive_category->term_id ) ? ' category-chip--active' : ''; ?>" href="<?php echo esc_url( get_category_link( $archive_category ) ); ?>">
					<?php echo esc_html( $archive_category->name ); ?>
				</a>
			<?php endforeach; ?>
		</div>
	</section>
<?php endif; ?>

<section class="container-xxl px-4 px-lg-5 archive-posts" aria-label="<?php esc_attr_e( 'Archive posts', 'bharathbyte' ); ?>">
	<?php if ( have_posts() ) : ?>
		<div class="row g-4">
			<?php
			while ( have_posts() ) :
				the_post();
				$post_categories = get_the_category();
				?>
				<div class="col-12 col-md-6 col-lg-4">
					<article <?php post_class( 'story-card h-100' ); ?>>
						<a href="<?php the_permalink(); ?>" class="story-card__image" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'bharathbyte' ), get_the_title() ) ); ?>">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'medium_large' );
							} else {
								?>
								<span class="story-card__placeholder"><?php esc_html_e( 'BharathByte', 'bharathbyte' ); ?></span>
								<?php
							}
							?>
						</a>
						<div class="story-card__body">
							<?php if ( ! empty( $post_categories ) ) : ?>
								<a class="story-card__tag" href="<?php echo esc_url( get_category_link( $post_categories[0] ) ); ?>">
									<?php echo esc_html( $post_categories[0]->name ); ?>
								</a>
							<?php endif; ?>
							<h2>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
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
			<?php endwhile; ?>
		</div>

		<div class="archive-pagination">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<div class="archive-empty">
			<h2><?php esc_html_e( 'No posts found', 'bharathbyte' ); ?></h2>
			<p><?php esc_html_e( 'Try another category or search for a different topic.', 'bharathbyte' ); ?></p>
		</div>
	<?php endif; ?>
</section>

<?php
get_footer();
