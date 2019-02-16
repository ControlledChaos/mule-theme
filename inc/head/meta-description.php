<?php
/**
 * Description meta
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'mule_description_meta' ) ) :

	function mule_description_meta() {
		_e( 'A Documentary by John McDonald', 'mule' );
	}

endif; ?>