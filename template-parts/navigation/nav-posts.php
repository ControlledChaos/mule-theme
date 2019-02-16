<?php
/**
 * Posts navigation template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */

if ( ! function_exists( 'mule_posts_nav' ) ) :

function mule_posts_nav() {
	if ( is_search() ) { ?>
<nav class="posts-nav">

	<span class="prev-page" rel="prev"><?php previous_posts_link( '<span>Previous Results</span>' ); ?></span>
	<span class="next-page" rel="next"><?php next_posts_link( '<span>More Results</span>' ); ?></span>

</nav>
<?php } else { ?>
<nav class="posts-nav">

	<span class="prev-posts" rel="prev"><?php previous_posts_link( '<span>Previous Page</span>' ); ?></span>
	<span class="next-posts" rel="next"><?php next_posts_link( '<span>Next Page</span>' ); ?></span>

</nav>
<?php }
} endif; // End mule_posts_nav

if ( ! function_exists( 'mule_numeric_posts_nav' ) ) :

function mule_numeric_posts_nav() {

	if ( is_singular() )
		return;

	global $wp_query;

	/* Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/*	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/*	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	if ( is_home() || in_category( 'news' ) ) {
		echo '<nav class="numeric-pagination"><label class="numeric-pagination-label" for="numeric-pagination-list">News Page:</label>
		<ul id="numeric-pagination-list">' . "\n";
	} else {
		echo '<nav class="numeric-pagination"><label class="numeric-pagination-label" for="numeric-pagination-list">Page:</label>
		<ul id="numeric-pagination-list">' . "\n";
	}

	/*	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li><span class="prev-page" rel="prev">%s</span></li>' . "\n", get_previous_posts_link( '<span class="screen-reader-text">Previous Page</span>' ) );

	/*	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>&hellip;</li>';
	}

	/*	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/*	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>&hellip;</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/*	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li><span class="next-page" rel="next">%s</span></li>' . "\n", get_next_posts_link( '<span class="screen-reader-text">Next Page</span>' ) );

	echo '</ul></nav>' . "\n";

} endif; // End mule_numeric_posts_nav


/*
 * Paged post navigation option
 */
if ( ! function_exists( 'mule_paged_nav' ) ) :
	function mule_paged_nav() {
		if ( 'number' == mule_sanitize_post_pagination( get_theme_mod( 'mule_post_pagination' ) ) ) {
			$paged_nav   = 'number';
			$link_before = 'Page ';
			$class       = 'paged-number';
		} else {
			$paged_nav   = 'next';
			$link_before = '';
			$class       = 'paged-next'; // Used for arrow icons in continue/back spans
		}

		$title        = get_the_title();
		$tooltip_next = ' title="Continue reading ' . $title . '"';
		$tooltip_prev = ' title="Previous page of ' . $title . '"';
		$next         = __( '<span class="paged-continue pf-tooltip"' . $tooltip_next . '>Continue Reading<span class="screen-reader-text"> ' . $title . '</span></span>', 'mule' );
		$prev         = __( '<span class="paged-back pf-tooltip"' . $tooltip_prev . '>Previous Page<span class="screen-reader-text"> of ' . $title . '</span></span>', 'mule' );

		wp_link_pages( array( 
			'before'           => '<p class="paginated-post-links ' . $class . '">', 'mule',
			'after'            => '</p>',
			'link_before'      => $link_before,
			'next_or_number'   => $paged_nav,
			'separator'        => ' | ',
			'nextpagelink'     => $next,
			'previouspagelink' => $prev
		) );
	}
endif; // End paged post navigation option

?>