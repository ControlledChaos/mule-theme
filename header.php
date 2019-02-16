<?php
/**
 * Header template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head data-template-set="mule">
	<?php mule_remove_cf7(); mule_head(); ?>
</head>
	<?php mule_body(); ?>
	<?php mule_loader(); ?>
	<?php get_template_part( 'template-parts/navigation/nav', 'main' );	?>
<?php mule_header(); ?>