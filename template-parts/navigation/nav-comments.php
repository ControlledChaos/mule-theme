<?php
/**
 * Comments navigation template
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since 3.0.0
 */

function mule_comments_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {	?>
	<nav class="comments-nav" role="navigation">
	<?php
		$title = get_the_title();
		if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'mule-theme' ) ) ) :
			printf ( '<span class="prev-comments pf-tooltip" rel="prev" title="Older comments on ' . $title . '">%s</span>', $prev_link );
		endif;

		if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'mule-theme' ) ) ) :
			printf ( '<span class="next-comments pf-tooltip" rel="next" title="Newer comments on ' . $title . '">%s</span>', $next_link );
		endif;
	?>
	</nav><!-- comments-nav -->
	<?php }
} ?>