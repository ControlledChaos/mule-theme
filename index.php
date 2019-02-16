<?php
/**
 * Blog index template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */
get_header(); ?>

<div class="site-content wrapper">

	<main class="main" role="main" itemscope itemprop="mainContentOfPage">

		<header class="blog-title">
			<h1><?php _e( 'Mule News', 'mule' ); ?></h1>
		</header>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/post/content' ); ?>

		<?php endwhile;
		
			mule_numeric_posts_nav();

		else : 
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

	</main>

</div><!-- site-content -->

<?php get_footer(); ?>
