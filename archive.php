<?php
/**
 * Archive template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */
get_header(); ?>

<div class="site-content wrapper">

	<main class="main" role="main" itemscope itemprop="mainContentOfPage">

		<header class="archive-title">
	 	<?php
			if ( is_day() ) {
				echo '<h1>' . __( 'Archive for ', 'mule' ) . get_the_time( 'F jS, Y' ) . '</h1>';
			} elseif ( is_month() ) {
				echo '<h1>' . __( 'Archive for ', 'mule' ); single_month_title( ' ', true ); echo '</h1>';
			} elseif ( is_year() ) {
				echo '<h1>' . __( 'Archive for ', 'mule' ) . get_the_time('Y') . '</h1>';
			} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
				echo '<h1>' . __( 'Blog Archives', 'mule' ) . '</h1>';
			} else {
				the_archive_title( '<h1>', '</h1>' );
			}
		?>
		</header>

		<?php if ( have_posts() ) : 
		global $post;
	 	$post = $posts[0]; ?>
	 	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/post/content' ); ?>

		<?php endwhile;
		
			mule_numeric_posts_nav();

		else : 
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>
		
	</main>

</div><!-- site-content -->

<?php get_footer(); ?>