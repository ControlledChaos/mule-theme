<?php
/**
 * Site branding
 *
 * @package    WordPress
 * @subpackage Poker_Face
 * @since 3.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

function mule_header() {

	$header_img  = get_field( 'intro_image' );
	$header_size = 'header-large';
	$header_src     = wp_get_attachment_image_src( $header_img, $header_size );
	$header_srcset  = wp_get_attachment_image_srcset( $header_img, $header_size );
	$tagline     = get_field( 'mule_tagline' );
	$tagline_img  = get_field( 'mule_tagline_image' );
	$tagline_size = 'tagline-large';
	$tagline_src     = wp_get_attachment_image_src( $tagline_img, $tagline_size );
	$tagline_srcset  = wp_get_attachment_image_srcset( $tagline_img, $tagline_size );
?>
<header class="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
<?php if ( is_front_page() ) : ?>
	<div class="intro-image front">
		<img class="intro-image" src="<?php echo esc_url( $header_src[0] ); ?>" srcset="<?php echo esc_attr( $header_srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 1024px) 1024px, 2048px" />
	</div>
	<div class="intro-title front">
		<div class="wrapper">
			<h1 class="site-title" itemprop="name"><?php bloginfo( 'name' ); ?></h1>
			<?php if ( ! empty( get_bloginfo( 'description' ) )) { ?><p class="site-description" itemprop="description"><?php bloginfo( 'description', 'display' ); ?></p><?php } ?>
		</div>
	</div>
	<?php if ( $tagline ) : ?>
	<div class="tagline">
		<img class="intro-image" src="<?php echo esc_url( $tagline_src[0] ); ?>" srcset="<?php echo esc_attr( $tagline_srcset ); ?>" sizes="(max-width: 640px) 640px, (max-width: 1024px) 1024px, 2048px" />
		<div class="wrapper">
			<p><?php echo $tagline; ?></p>
		</div>
	</div>
	<?php endif; // End tagline ?>
<?php else : ?>
	<div class="intro-title">
		<div class="wrapper">
			<p class="site-title" itemprop="name"><?php bloginfo( 'name' ); ?></p>
			<?php if ( ! empty( get_bloginfo( 'description' ) )) { ?><p class="site-description" itemprop="description"><?php bloginfo( 'description', 'display' ); ?></p><?php } ?>
		</div>
	</div>
<?php endif; ?>
</header>
<?php } ?>