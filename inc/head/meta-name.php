<?php
/**
 * Site name meta
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'mule_name_meta' ) ) :

	function mule_name_meta() {
		_e( 'Mule | Living on the Outside', 'mule' );
	}

endif; ?>