<?php
/**
 * Title meta
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'mule_title_meta' ) ) :

	function mule_title_meta() {
		if ( is_front_page() ) {
			$title = __( 'Mule | Living on the Outside', 'mule' );
		} elseif ( is_home() ) {
			$title = __( 'Mule Documentary: News', 'mule' );
		} else {
			$title = __( 'Mule Documentary: ', 'mule' ) . get_the_title();
		}
		echo $title;
	}

endif; ?>