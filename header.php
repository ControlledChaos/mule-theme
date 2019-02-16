<?php
/**
 * Header template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0
 */

namespace Mule_Theme;

// Access methods of the functions file.
use Mule_Theme\Functions;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php Functions::remove_cf7_scripts(); mule_head(); ?>
</head>
	<?php mule_body(); ?>
	<?php mule_loader(); ?>
	<?php get_template_part( 'template-parts/navigation/nav', 'main' );	?>
<?php mule_header(); ?>