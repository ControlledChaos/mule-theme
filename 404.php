<?php
/**
 * 404 error template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */
get_header(); ?>

<div class="site-content wrapper">

	<main class="main" role="main">

		<h2 class="page-title"><?php _e( 'Oops!', 'mule' ); ?></h2>
		
		<p>We couldn't find what you are looking for. Try looking on our <a href="<?php echo home_url(); ?>/">home page</a> or perhaps searching for a term...</p>
		
		<?php get_search_form(); ?>
		
	</main><!-- main -->

</div><!-- site-content -->

<?php get_footer(); ?>