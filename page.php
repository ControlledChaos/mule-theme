<?php
/**
 * Page template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */
get_header(); ?>

<div class="site-content wrapper">

	<main class="main" role="main" itemscope itemprop="mainContentOfPage">

	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/page/content', 'page' );

		endwhile; endif; ?>

	</main><!-- main -->

</div><!-- site-content -->

<?php get_footer(); ?>
