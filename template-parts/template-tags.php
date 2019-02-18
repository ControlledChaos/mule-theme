<?php
/**
 * Template tags
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      3.0.0
 */

if ( ! function_exists( 'mule_body' ) ) :

	function mule_body() {
		// Get plugin path to check for bbPress & BuddyPress
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		// Change page slugs and template names as needed
		if ( is_page( 'about' ) || is_page( 'about-us' ) || is_page_template( 'page-about.php' ) || is_page_template( 'about.php' ) ) {
			$itemtype = 'AboutPage';
		} elseif ( is_page( 'contact' ) || is_page( 'contact-us' ) || is_page_template( 'page-contact.php' ) || is_page_template( 'contact.php' ) ) {
			$itemtype = 'ContactPage';
		} elseif ( is_page( 'faq' ) || is_page( 'faqs' ) || is_page_template( 'page-faq.php' ) || is_page_template( 'faq.php' ) ) {
			$itemtype = 'QAPage';
		} elseif ( is_page( 'cart' ) || is_page( 'shopping-cart' ) || is_page( 'checkout' ) || is_page_template( 'cart.php' ) || is_page_template( 'checkout.php' ) ) {
			$itemtype = 'CheckoutPage';
		} elseif ( is_front_page() || is_page() ) {
			$itemtype = 'WebPage';
		} elseif ( has_post_format( 'gallery' ) || is_singular( 'pf_portfolio' ) || is_singular( 'portfolio' ) ) {
			$itemtype = 'CollectionPage';
		} elseif ( is_author() || is_plugin_active( 'buddypress/bp-loader.php' ) && bp_is_home() || is_plugin_active( 'bbpress/bbpress.php' ) && bbp_is_user_home() ) {
			$itemtype = 'ProfilePage';
		} elseif ( is_search() ) {
			$itemtype = 'SearchResultsPage';
		} else {
			$itemtype = 'Blog';
		}
		
		echo '<body class="' . join( ' ', get_body_class() ) . '" itemscope="itemscope" itemtype="http://schema.org/' . $itemtype . '">';
	}

endif; // End mule_body

if ( ! function_exists( 'mule_site_title' ) ) :

	function mule_site_title() {
		if ( is_front_page() ) : ?>
			<h1 class="site-title" itemprop="name"><?php esc_attr( bloginfo( 'name' ) ); ?></h1>
		<?php else : ?>
			<p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_attr( bloginfo( 'name' ) ); ?></a></p>
		<?php endif;
	}

endif; // End mule_site_title

if ( ! function_exists( 'mule_post_meta' ) ) :
	
	function mule_post_meta() {

		if ( is_category() ) { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span>
			<?php the_tags( '<br /><span class="post-tags">Tagged: ', ', ', '</span>' ); ?></p>
			
		</footer>

		<?php } elseif ( is_tag() || is_tax() ) { ?>

		<footer class="post-meta" role="contentinfo">

			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span>
			<br /><span class="post-category"><?php _e( 'Posted in: ', 'mule-theme' ); ?><?php the_category( ', ' ) ?></p>
			
		</footer>

		<?php } elseif ( is_search() ) { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="byline">By <span class="vcard author"><span class="fn"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span></span></p>
			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span>
			<br /><span class="post-category"><?php _e( 'Posted in: ', 'mule-theme' ); ?><?php the_category( ', ' ) ?></span>
			<?php the_tags( '<br /><span class="post-tags">Tagged: ', ', ', '</span>' ); ?></p>
			
		</footer>

		<?php } elseif ( is_day() || is_month() || is_year() ) { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="byline">By <span class="vcard author"><span class="fn"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span></span></p>
			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span>
			<br /><span class="post-category"><?php _e( 'Posted in: ', 'mule-theme' ); ?><?php the_category( ', ' ) ?></span>
			<?php the_tags( '<br /><span class="post-tags">Tagged: ', ', ', '</span>' ); ?></p>
			
		</footer>

		<?php } elseif ( is_author() ) { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span>
			<br /><span class="post-category"><?php _e( 'Posted in: ', 'mule-theme' ); ?><?php the_category( ', ' ) ?></span>
			<?php the_tags( '<br /><span class="post-tags">Tagged: ', ', ', '</span>' ); ?></p>
			
		</footer>

		<?php } elseif ( is_home() ) { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="post-data"><span class="post-time"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_modified_date( 'F jS, Y' ) ?></time></span></p>
			
		</footer>

		<?php } else { ?>

		<footer class="post-meta" role="contentinfo">
			
			<p class="byline"><?php _e( 'By ', 'mule-theme' ); ?><span class="vcard author"><span class="fn"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span></span> | <span class="post-category"><?php the_category( ', ' ) ?></span></p>
			<p class="post-data"><span class="post-time"><a href="<?php echo get_month_link( get_post_time( 'Y' ), get_post_time( 'm' ) );  ?>" rel="bookmark"><time datetime="<?php echo date( DATE_W3C ); ?>"><?php the_time( 'F jS, Y' ) ?></time></a></span>
			<?php the_tags( '<br /><span class="post-tags">Tagged: ', ', ', '</span>' ); ?></p>
			
		</footer>

		<?php }

	}

endif; // End mule_post_meta

?>