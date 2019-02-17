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
				echo '<h1>' . __( 'Archive for ', 'mule-theme' ) . get_the_time( 'F jS, Y' ) . '</h1>';
			} elseif ( is_month() ) {
				echo '<h1>' . __( 'Archive for ', 'mule-theme' ); single_month_title( ' ', true ); echo '</h1>';
			} elseif ( is_year() ) {
				echo '<h1>' . __( 'Archive for ', 'mule-theme' ) . get_the_time('Y') . '</h1>';
			} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
				echo '<h1>' . __( 'Blog Archives', 'mule-theme' ) . '</h1>';
			} else {
				the_archive_title( '<h1>', '</h1>' );
			}
		?>
		</header>

		<?php if ( have_posts() ) {

			global $post;

			$post  = $posts[0];
			$intro = get_field( 'snippets_archive_intro', 'option' );

			if ( is_post_type_archive( 'snippets' ) ) { ?>
				<?php if ( is_paged() ) { ?>
				<nav class="nav-links">
					<span class="nav-previous" rel="prev"><?php previous_posts_link( __( 'Previous Page', 'mule-theme' ) ); ?></span>
					<span class="nav-next" rel="next"><?php next_posts_link( __( 'Next Page', 'mule-theme' ) ); ?></span>
				</nav>
				<?php } ?>
				<?php if ( $intro && ! is_paged() ) {
					echo sprintf(
						'<div class="snippets-archive-intro">%1s</div>',
						$intro
					);
				}

				echo '<ul class="video-grid">';
			} ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				if ( is_post_type_archive( 'snippets' ) ) {
					the_content();
				} else {
					get_template_part( 'template-parts/post/content' );
				}
			endwhile;

			if ( is_post_type_archive( 'snippets' ) ) { echo '</ul>'; }

		} else {
			get_template_part( 'template-parts/post/content', 'none' );
		} ?>
		<nav class="nav-links">
			<span class="nav-previous" rel="prev"><?php previous_posts_link( __( 'Previous Page', 'mule-theme' ) ); ?></span>
			<span class="nav-next" rel="next"><?php next_posts_link( __( 'Next Page', 'mule-theme' ) ); ?></span>
		</nav>
	</main>

</div><!-- site-content -->

<?php get_footer(); ?>