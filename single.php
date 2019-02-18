<?php
/**
 * Post template
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since 3.0.0
 */
get_header(); ?>

<div class="site-content wrapper">

	<main class="main" role="main" itemscope itemprop="mainContentOfPage">

	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/post/content' );

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

		endwhile; endif; ?>

	</main><!-- main -->

</div><!-- site-content -->

<?php get_footer(); ?>