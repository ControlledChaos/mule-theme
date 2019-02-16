<?php
/**
 * Post content, standard format
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since Poker Face 1.0.0
 */
?>

<article class="entry h-entry" id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="https://schema.org/BlogPosting">

	<header class="entry-header">
		<?php
			if ( is_singular( 'snippets' ) ) {
				echo sprintf( '<h3>%1s</h3>', __( 'Video Snippet:' ) );
				the_title( '<h1 class="entry-title">', '</h1>' );
			} elseif ( is_singular() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			if ( 'post' === get_post_type() ) {
				mule_post_meta();
			}
		?>
	</header>

	<?php if ( is_home() ) : ?>
		<p><small><?php comments_popup_link( __( 'Be the first to comment', 'mule' ), __( '1 Comment', 'mule' ), __( '% Comments', 'mule' ), 'comments-link', '' ); ?></small></p>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div><!-- entry-content -->

</article>