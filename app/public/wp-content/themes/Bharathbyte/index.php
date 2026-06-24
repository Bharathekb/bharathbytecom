<?php
/**
 * Default template.
 *
 * @package Bharathbyte
 */

get_header();
?>

<section class="container-xxl px-4 px-lg-5 py-5">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mb-5' ); ?>>
				<h1 class="mb-3">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h1>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</article>
			<?php
		endwhile;

		the_posts_pagination();
	else :
		?>
		<p><?php esc_html_e( 'No posts found.', 'bharathbyte' ); ?></p>
		<?php
	endif;
	?>
</section>

<?php
get_footer();
