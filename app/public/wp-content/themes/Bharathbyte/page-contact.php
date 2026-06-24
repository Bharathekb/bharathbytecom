<?php
/**
 * Contact page template.
 *
 * @package Bharathbyte
 */

get_header();

$formspree_endpoint = apply_filters( 'bharathbyte_formspree_endpoint', 'https://formspree.io/f/your-form-id' );
?>

<section class="contact-page" aria-labelledby="contact-title">
	<div class="container-xxl px-4 px-lg-5">
		<div class="contact-page__grid">
			<div class="contact-page__intro">
				<p class="section-kicker"><?php esc_html_e( 'Contact', 'bharathbyte' ); ?></p>
				<h1 id="contact-title"><?php esc_html_e( 'Let us build the next conversation.', 'bharathbyte' ); ?></h1>
				<p><?php esc_html_e( 'Have a project idea, collaboration, question, or feedback for BharathByte? Send a note and I will get back to you soon.', 'bharathbyte' ); ?></p>
				<div class="contact-page__links">
					<a href="https://www.instagram.com/mr_bharath95/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Instagram', 'bharathbyte' ); ?></a>
					<a href="https://www.linkedin.com/in/bharathekboti" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'LinkedIn', 'bharathbyte' ); ?></a>
				</div>
			</div>

			<form class="contact-form" action="<?php echo esc_url( $formspree_endpoint ); ?>" method="POST">
				<div class="contact-form__row">
					<label for="contact-name"><?php esc_html_e( 'Name', 'bharathbyte' ); ?></label>
					<input id="contact-name" type="text" name="name" autocomplete="name" required>
				</div>
				<div class="contact-form__row">
					<label for="contact-email"><?php esc_html_e( 'Email', 'bharathbyte' ); ?></label>
					<input id="contact-email" type="email" name="email" autocomplete="email" required>
				</div>
				<div class="contact-form__row">
					<label for="contact-message"><?php esc_html_e( 'Message', 'bharathbyte' ); ?></label>
					<textarea id="contact-message" name="message" rows="6" required></textarea>
				</div>
				<input type="hidden" name="_subject" value="<?php esc_attr_e( 'New BharathByte contact message', 'bharathbyte' ); ?>">
				<button type="submit"><?php esc_html_e( 'Send message', 'bharathbyte' ); ?></button>
				<p class="contact-form__note"><?php esc_html_e( 'Powered by Formspree. Replace the placeholder endpoint with your Formspree form URL before going live.', 'bharathbyte' ); ?></p>
			</form>
		</div>
	</div>
</section>

<?php
get_footer();
