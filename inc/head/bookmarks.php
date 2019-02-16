<?php
/**
 * Bookmark icons
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<link rel="shortcut icon" href="<?php echo get_theme_file_uri( '/assets/images/favicon.png' ); ?>">
<!-- Apple bookmark icons -->
<link rel="apple-touch-icon" href="<?php echo get_theme_file_uri( '/assets/images/apple-touch-icon.png' ); ?>">
<!-- Microsoft bookmark icons -->
<meta name="msapplication-TileImage" content="<?php echo get_theme_file_uri( '/assets/images/icon144.png' ); ?>">