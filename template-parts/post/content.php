<?php
/**
 * Post content, standard format
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since 3.0.0
 */

if ( is_singular( 'snippets' ) ) {
	echo sprintf( '<h3 class="snippet-subtitle">%1s</h3>', __( 'Video Snippet' ) );
} ?>
<article class="entry h-entry" id="post-<?php the_ID(); ?>" role="article" itemscope itemtype="https://schema.org/BlogPosting">

	<header class="entry-header">
		<?php
			if ( is_singular() ) {
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
		<p><small><?php comments_popup_link( __( 'Be the first to comment', 'mule-theme' ), __( '1 Comment', 'mule-theme' ), __( '% Comments', 'mule-theme' ), 'comments-link', '' ); ?></small></p>
	<?php endif; ?>

	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div><!-- entry-content -->

	<?php if ( is_singular() ) {
		the_post_navigation(
			[
				'next_text' => '<span class="screen-reader-text">' . __( 'Next post:', 'mule-theme' ) . '</span>' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="screen-reader-text">' . __( 'Previous post:', 'mule-theme' ) . '</span>' .
					'<span class="post-title">%title</span>',
			]
		);
	} ?>
</article>