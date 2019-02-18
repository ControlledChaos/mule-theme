<?php
/**
 * Head template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      3.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'mule_head' ) ) :

function mule_head() {

?>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if IE ]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->

<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open() ) {
	printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
} ?>
<link rel="prev" href="<?php echo previous_posts(); ?>">
<link rel="next" href="<?php echo next_posts(); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1"/>

<?php wp_head(); ?>

<?php include get_parent_theme_file_path( '/inc/head/bookmarks.php' ); ?>

<?php } endif; ?>