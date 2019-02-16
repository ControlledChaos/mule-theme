<?php
/**
 * Head template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! function_exists( 'mule_head' ) ) :

function mule_head() {

	get_template_part( '/inc/head/meta', 'url' );
	get_template_part( '/inc/head/meta', 'name' );
	get_template_part( '/inc/head/meta', 'title' );
	get_template_part( '/inc/head/meta', 'description' );

?>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<!--[if IE ]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<meta name="title" content="<?php mule_title_meta(); ?>">
<meta name="description" content="<?php mule_description_meta(); ?>" />
<?php if ( is_search() ) { echo '<meta name="robots" content="noindex,nofollow" />'; } ?>

<!-- Open Graph meta -->
<meta property="og:url" content="<?php echo get_the_permalink(); ?>" />
<meta property="og:site_name" content="<?php mule_name_meta(); ?>" />
<meta property="og:title" content="<?php mule_title_meta(); ?>" />
<meta property="og:description" content="<?php mule_description_meta(); ?>" />
<meta property="og:image" content="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Sharing Image', array(600, 315), true, '' ); echo $src[0]; ?>" />

<!-- Twitter Card meta data -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="<?php mule_name_meta(); ?>" />
<meta name="twitter:title" content="<?php mule_title_meta(); ?>">
<meta name="twitter:description" content="<?php mule_description_meta(); ?>" />
<meta name="twitter:url" content="<?php echo get_the_permalink(); ?>" />
<meta name="twitter:image:src" content="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'Sharing Image', array(600, 315), true, '' ); echo $src[0]; ?>" />

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