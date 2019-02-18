<?php
/**
 * Element functions
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

?>