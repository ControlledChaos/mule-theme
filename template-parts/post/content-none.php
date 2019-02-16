<?php
/**
 * Post content, none
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */
?>

<section class="no-content" role="region">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'mule' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mule' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<p><?php _e( 'No content available at this time. Maybe try searching&hellip;', 'mule' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- page-content -->
</section><!-- no-content -->
