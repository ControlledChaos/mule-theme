<?php
/**
 * Mule Theme functions.
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @author     Greg Sweet <greg@ccdzine.com>
 * @copyright  Copyright (c) 2017 - 2018, Greg Sweet
 * @link       https://github.com/ControlledChaos/mule-theme
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      3.0.0
 */

namespace Mule_Theme;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Mule Theme functions class.
 *
 * @since  3.0.0
 * @access public
 */
final class Functions {

	/**
	 * Return the instance of the class.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Theme dependencies.
			$instance->dependencies();

			// Remove CF7 scripts.
			$instance->remove_cf7_scripts();

			// Add srcset attributes to ACF images.
			// $instance->responsive_images();

		}

		return $instance;
	}

	/**
	 * Constructor magic method.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void The constructor is empty.
	 */
	public function __construct() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Controlled Chaos theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Remove unpopular meta tags.
		add_action( 'init', [ $this, 'head_cleanup' ] );

		// TinyMCE editor scripts for Adobe Fonts/TypeKit.
		add_filter( 'mce_external_plugins', [ $this, 'mce_external_plugins' ] );

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Admin scripts.
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		// Add data attributes for Fancybox.
		add_filter( 'wp_get_attachment_link', [ $this, 'fancybox_gallery_attribute' ], 10, 4 );
		add_filter( 'the_content', [ $this, 'fancybox_image_attribute' ] );

		// Responsive image helper function.
		add_filter( 'max_srcset_image_width', [ $this, 'max_srcset_image_width' ], 10 , 2 );

		// Default image link.
		add_action( 'admin_init', [ $this, 'default_image_link' ], 10 );

		// Default gallery image link.
		add_filter( 'media_view_settings', [ $this, 'default_gallery_link' ], 10 );

		// Choose image sizes.
		add_filter( 'image_size_names_choose', [ $this, 'image_insert' ] );

		// Modify the archive title.
		add_filter( 'get_the_archive_title', [ $this, 'archive_title' ] );

	}

	/**
	 * Replace 'no-js' class with 'js' in the <html> element when JavaScript is detected.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {

		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

	}

	/**
	 * Theme setup.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		/**
		 * Load domain for translation.
		 *
		 * @since 3.0.0
		 */
		load_theme_textdomain( 'mule-theme', get_theme_file_uri( '/inc/languages' ) );

		/**
		 * Add theme support.
		 *
		 * @since 3.0.0
		 */

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

		// Register post formats.
		add_theme_support( 'post-formats', [
			'aside',
			'gscreenery',
			'video',
			'image',
			'audio',
			'link',
			'quote',
			'status',
			'chat'
		 ] );

		 // Customizer widget refresh support.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add image sizes.
		 *
		 * Three sizes per aspect ratio so that WordPress
		 * will use srcset for responsive images.
		 *
		 * @since 3.0.0
		 */
		update_option( 'thumbnail_size_w', 180 );
		update_option( 'thumbnail_size_h', 180 );
		update_option( 'thumbnail_crop', 1 ); // hard crop on sizes in media sttings
		update_option( 'medium_size_w', 320 );
		update_option( 'medium_size_h', 240 );
		update_option( 'medium_crop', 1 );
		update_option( 'large_size_w', 960 );
		update_option( 'large_size_h', 720 );
		update_option( 'large_crop', 1 );

		add_image_size( 'header-large', 2048, 1379, true );
		add_image_size( 'header-med', 1024, 690, true );
		add_image_size( 'header-small', 640, 431, true );
		add_image_size( 'tagline-large', 2048, 714, true );
		add_image_size( 'tagline-med', 1024, 357, true );
		add_image_size( 'tagline-small', 640, 223, true );
		add_image_size( 'full-width', 1280, 549, true );

		/**
		 * Set content width.
		 *
		 * @since 3.0.0
		 */

		if ( ! isset( $content_width ) ) {
			$content_width = 1280;
		}

		/**
		 * Register theme menus.
		 *
		 * @since  3.0.0
		 */
		register_nav_menus(
			[
				'main'       => __( 'Main Menu', 'mule-theme' ),
				'main-front' => __( 'Front Page Menu', 'mule-theme' ),
				'snippets'   => __( 'Snippets Menu', 'mule-theme' ),
				'footer'     => __( 'Footer Menu', 'mule-theme' ),
				'social'     => __( 'Social Menu', 'mule-theme' )
			]
		);
/**
		 * Add stylesheets for the content editor.
		 *
		 * @since 3.0.0
		 */
		$font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
    	add_editor_style( $font_url );
		add_editor_style( '/assets/css/editor-style.min.css', [], '', 'all' );

		/**
		 * Disable Jetpack open graph. We have the open graph tags in the theme.
		 *
		 * @since 3.0.0
		 */
		if ( class_exists( 'Jetpack' ) ) {
			add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );
		}

	}

	/**
	 * Clean up meta tags from the <head>.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * TinyMCE editor scripts for Adobe Fonts/TypeKit
	 *
	 * @since  3.0.0
	 * @access public
	 * @return array
	 */
	public function mce_external_plugins( $plugin_array ) {

		$plugin_array['typekit'] = get_theme_file_uri( '/assets/js/typekit-editor.js' );

		return $plugin_array;

	}

	/**
	 * Frontend scripts.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'html5', get_parent_theme_file_uri( '/assets/js/html5.min.js' ), [], '', true );
		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'typekit', 'https://use.typekit.net/fmg8rqq.js', [], false, true );
		wp_add_inline_script( 'typekit', 'try{Typekit.load({ async: false });}catch(e){}' );
		wp_enqueue_script( 'theme-functions', get_parent_theme_file_uri( '/assets/js/jquery.theme-functions.min.js' ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'nav-bar', get_parent_theme_file_uri( '/assets/js/jquery.navbar.min.js' ), [ 'jquery' ], false, true );
		wp_enqueue_script( 'fitvids', get_parent_theme_file_uri( '/assets/js/jquery.fitvids.min.js' ), [ 'jquery' ], false, true );
		wp_add_inline_script( 'fitvids', '
			jQuery(document).ready(function(){
				jQuery( ".mule-trailer, .entry" ).fitVids();
			});
		' );

	}

	/**
	 * Admin scripts.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {

		wp_enqueue_script( 'typekit', 'https://use.typekit.net/fmg8rqq.js', [], null, true );
		wp_add_inline_script( 'typekit', 'try{Typekit.load({ async: false });}catch(e){}' );
		wp_enqueue_script( 'excerpts', get_parent_theme_file_uri( '/assets/js/jquery.excerpts.js', [ 'jquery' ], '', true ) );

	}

	/**
	 * Frontend styles.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		// Theme sylesheet.
		wp_enqueue_style( 'mule-style', get_parent_theme_file_uri( 'style.min.css' ), [], '', 'screen' );

		// Get Google fonts.
		wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', [], '', 'screen' );

	}

	/**
	 * Add data attributes for Fancybox galleries
	 *
	 * Modifies the gallery image links.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string $content Gets the link HTML.
	 * @param  integer $id Gets the post ID.
	 * @return string Returns the modified gallery image link.
	 */
	public function fancybox_gallery_attribute( $content, $id ) {

		// Restore title attribute.
		$title = get_the_title( $id );

		// Return the modified gallery image link.
		return str_replace( '<a', '<a data-type="image" data-fancybox="gallery" title="' . esc_attr( $title ) . '" ', $content );

	}

	/**
	 * Add data attributes for Fancybox images
	 *
	 * Modifies the single image links.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string $content Gets the link HTML.
	 * @global object $post Gets the post object.
	 * @return string Returns the modified image link.
	 */
	public function fancybox_image_attribute( $content ) {

		// Access global variables.
		global $post;

		// Look for links to image files.
		$pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";

		// The string for the modified link.
		$replace = '<a$1href=$2$3.$4$5 data-type="image" data-fancybox="image">';

		// Replace old HTML with new.
		$content = preg_replace( $pattern, $replace, $content );

		// Return the modified image link.
		return $content;

	}

	/**
	 * Responsive image helper function
	 *
	 * Sets the maximum image size.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string $image_id The id of the image (from ACF or similar).
	 * @param  string $image_size The size of the thumbnail image or custom image size.
	 * @param  string $max_width The max width this image will be shown to build the sizes attribute.
	 * @return integer Returns the number for width of the maximum size.
	 */
	public function max_srcset_image_width() {
		return 2048;
	}

	/**
	 * Add srcset attributes to ACF images
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  integer $image_id
	 * @param  integer $image_size
	 * @param  integer $max_width
	 * @return string Returns the srcset attribute.
	 */
	public function responsive_images( $image_id, $image_size, $max_width ) {

		// Check if the image ID is not blank.
		if ( $image_id != '' && class_exists( 'acf' ) ) {

			// Set the default src image size.
			$image_src = wp_get_attachment_image_url( $image_id, $image_size );

			// Set the srcset with various image sizes.
			$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

			// Generate the markup for the responsive image.
			echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';

		}

	}

	/**
	 * Default image link
	 *
	 * Makes image link to the full size file by default,
	 * as opposed to the attachment page or none.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function default_image_link() {

		$image_set = get_option( 'image_default_link_type' );

		if ( $image_set !== 'file' ) {
			update_option( 'image_default_link_type', 'file' );
		}

	}

	/**
	 * Default gallery image link
	 *
	 * Makes image link to the full size file by default,
	 * as opposed to the attachment page or none.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return string
	 */
	public function default_gallery_link( $settings ) {

		$settings['galleryDefaults']['link'] = 'file';

		return $settings;
	}

	/**
	 * Choose image sizes
	 *
	 * Sizes available when inserting media.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return array
	 */
	function image_insert( $size_names ) {

		global $_wp_additional_image_sizes;

		$size_names = [
			'thumbnail'  => __( 'Thumbnail', 'mule-theme' ),
			'medium'     => __( 'Medium', 'mule-theme' ),
			'large'      => __( 'Large', 'mule-theme' ),
			'full-width' => __( 'Full Width', 'mule-theme' ),
			'full'       => __( 'Full', 'mule-theme' )
		];

		return $size_names;

	}

	/**
	 * Modify the archive title
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function archive_title( $title ) {

		// If it's the snippets archive.
		if ( is_post_type_archive( 'snippets' ) ) {
			return __( 'Video Snippets', 'mule-theme' );

		// Remove any HTML, words, digits, and spaces before the title.
		} else {
			return preg_replace( '#^[\w\d\s]+:\s*#', '', strip_tags( $title ) );
		}

	}

	/**
	 * Remove Contact Form 7 scripts and styles.
	 *
	 * @since  3.0.0
	 * @access public
	 * @global object $post Gets the post object.
	 * @return void
	 */
	public static function remove_cf7_scripts() {

		// If CF7 is active.
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) :

			// Access global variables.
			global $post;

			// If a post has the CF7 shortcode.
			if ( is_a( $post, 'WP_Post' ) && ! has_shortcode( $post->post_content, 'contact-form-7' ) ) {
				add_filter( 'wpcf7_load_js', '__return_false' );
				add_filter( 'wpcf7_load_css', '__return_false' );
			}

		endif;

	}

	/**
	 * Theme dependencies.
	 *
	 * @since  3.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		require get_parent_theme_file_path( '/inc/head/mule-head.php' );
		require get_parent_theme_file_path( '/template-parts/loader.php' );
		require get_parent_theme_file_path( '/template-parts/header/header-parts.php' );
		require get_parent_theme_file_path( '/template-parts/navigation/nav-parts.php' );
		require get_parent_theme_file_path( '/template-parts/template-tags.php' );
		require get_parent_theme_file_path( '/template-parts/credits.php' );

	}

}

/**
 * Gets the instance of the Functions class.
 *
 * @since  3.0.0
 * @access public
 * @return object
 */
function mule_theme() {

	$mule_theme = Functions::get_instance();

	return $mule_theme;

}

// Run the Functions class.
mule_theme();