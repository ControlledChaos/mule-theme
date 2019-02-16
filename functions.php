<?php
/**
 * Mule functions
 *
 * @package WordPress
 * @subpackage Mule
 * @since 3.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Poker Face theme setup
 */
if ( ! function_exists( 'mule_setup' ) ) :

	function mule_setup() {

		load_theme_textdomain( 'mule', get_theme_file_uri( '/inc/languages' ) );

		// Theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		) );
		add_theme_support( 'post-formats', array (
			'aside',
			'gscreenery',
			'video',
			'image',
			'audio',
			'link',
			'quote',
			'status',
			'chat'
		) );
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Content width
		if ( ! isset( $content_width ) ) {
			$content_width = '1280';
		}
		add_theme_support( 'post-thumbnails' );
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

		// Theme menus
		register_nav_menus(
			array(
			'main'       => __( 'Main Menu', 'mule' ),
			'main-front' => __( 'Front Page Menu', 'mule' ),
			'footer'     => __( 'Footer Menu', 'mule' ),
			'social'     => __( 'Social Menu', 'mule' )
			)
		);

		// Stylesheets for the content editor
		$font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
    	add_editor_style( $font_url );
		add_editor_style( '/assets/css/editor-style.min.css', array(), '', 'all' );

		// Disable Jetpack OG tags
		add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );

	}
endif; // End theme setup
add_action( 'after_setup_theme', 'mule_setup' );


/**
 * Inserting images
 */
function mule_default_image_link() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ( $image_set !== 'file' ) {
		update_option( 'image_default_link_type', 'file' );
	}
}
add_action( 'admin_init', 'mule_default_image_link', 10 );

function mule_default_gallery_link( $settings ) {
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
}
add_filter( 'media_view_settings', 'mule_default_gallery_link', 10 );

function mule_image_insert( $size_names ) {
	global $_wp_additional_image_sizes;
	
	$size_names = array(
		'thumbnail'  => __( 'Thumbnail', 'mule' ),
		'medium'     => __( 'Medium', 'mule' ),
		'large'      => __( 'Large', 'mule' ),
		'full-width' => __( 'Full Width', 'mule' ),
		'full'       => __( 'Full', 'mule' )
	);
	return $size_names;
};
add_filter( 'image_size_names_choose', 'mule_image_insert' );


/**
 * Clean up the <head>
 */
function mule_remove_head_links() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_site_icon', 99 );
}
add_action( 'init', 'mule_remove_head_links' );


/**
 * Theme scripts
 */

function mule_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'mule_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'mule_remove_wp_ver_css_js', 9999 );

// TinyMCE editor scripts
function mule_mce_external_plugins( $plugin_array ) {
	$plugin_array['typekit'] = get_theme_file_uri( '/assets/js/typekit-editor.js' );
	return $plugin_array;
}
add_filter( 'mce_external_plugins', 'mule_mce_external_plugins' );

// Front end scripts
function mule_theme_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'html5',             get_theme_file_uri( '/assets/js/html5.min.js' ), array(), '', true );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'prefix',            get_theme_file_uri( '/assets/js/prefixfree.min.js' ), array( 'jquery' ), false, false );
	wp_enqueue_script( 'typekit',          'https://use.typekit.net/fmg8rqq.js', array(), false, true );
	wp_add_inline_script( 'typekit',       'try{Typekit.load({ async: false });}catch(e){}' );
	wp_enqueue_script( 'theme-functions',   get_theme_file_uri( '/assets/js/jquery.theme-functions.min.js' ), array( 'jquery' ), false, true );
	wp_enqueue_script( 'nav-bar',           get_theme_file_uri( '/assets/js/jquery.navbar.min.js' ), array( 'jquery' ), false, true );
	wp_enqueue_script( 'fitvids',           get_theme_file_uri( '/assets/js/jquery.fitvids.min.js' ), array( 'jquery' ), false, true );
	wp_add_inline_script( 'fitvids', '
		jQuery(document).ready(function(){
			jQuery( ".mule-trailer, .entry" ).fitVids();
		});
	' );
	wp_enqueue_script( 'fancybox',           get_theme_file_uri( '/assets/js/jquery.fancybox.min.js' ), array( 'jquery' ), false, true );
	wp_enqueue_script( 'tooltip',            get_theme_file_uri( '/assets/js/jquery.tooltipster.bundle.min.js' ), array( 'jquery' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'mule_theme_scripts' );

// Admin scripts
function mule_admin_scripts() {
	wp_enqueue_script( 'typekit',    'https://use.typekit.net/fmg8rqq.js', array(), null, true );
	wp_add_inline_script( 'typekit', 'try{Typekit.load({ async: false });}catch(e){}' );
	wp_enqueue_script( 'excerpts',    get_theme_file_uri( '/assets/js/jquery.excerpts.js', array( 'jquery' ), '', true ) );
}
add_action( 'admin_enqueue_scripts', 'mule_admin_scripts' );

// Disable emojis
function mule_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'mule_disable_emojis' );

/**
 * Theme styles
 */
function mule_head_styles() {
	$style          = file_get_contents( get_stylesheet_uri() );
	$fontawesome    = file_get_contents( get_theme_file_uri( '/assets/css/font-awesome.min.css' ) );
	$fancybox       = file_get_contents( get_theme_file_uri( '/assets/css/fancybox.min.css' ) );
	$tooltips       = file_get_contents( get_theme_file_uri( '/assets/css/tooltipster.bundle.min.css' ) );
	$theme_tooltips = file_get_contents( get_theme_file_uri( '/assets/css/theme-tooltipster.min.css' ) );
	$css     = $style . $fontawesome . $fancybox . $tooltips . $theme_tooltips;
	echo '<style>' . $css . '</style>';
}
add_action( 'wp_head','mule_head_styles' );

function mule_theme_styles() {
	//wp_enqueue_style( 'reset',          get_theme_file_uri( '/assets/css/reset.css' ), array(), '', 'screen' );
	//wp_enqueue_style( 'style',          get_stylesheet_uri() );
    //wp_enqueue_style( 'queries',        get_theme_file_uri( '/queries.min.css' ), array( 'style' ), '', 'screen' );
    wp_enqueue_style( 'open-sans',      'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i', array(), '', 'screen' );
	//wp_enqueue_style( 'fontawesome',    get_theme_file_uri( '/assets/css/font-awesome.min.css' ), array( 'style' ), '', 'screen' );
	//wp_enqueue_style( 'fancybox',       get_theme_file_uri( '/assets/css/fancybox.min.css' ), array(), '', 'screen' );
	//wp_enqueue_style( 'tooltips',       get_theme_file_uri( '/assets/css/tooltipster.bundle.min.css' ), array(), '', 'screen' );
	//wp_enqueue_style( 'theme-tooltips', get_theme_file_uri( '/assets/css/theme-tooltipster.min.css', array( 'tooltips' ), '', 'screen' ) );
	//wp_enqueue_style( 'comments',       get_theme_file_uri( '/assets/css/comments.min.css' ), array(), '', 'screen' );
	//wp_enqueue_style( 'theme-icons',    get_theme_file_uri( '/assets/css/theme-icons.min.css', array(), '', 'screen' ) );
	//wp_enqueue_style( 'other',          get_theme_file_uri( '/assets/css/other.min.css' ), array(), '', 'screen' );
}
add_action( 'wp_enqueue_scripts', 'mule_theme_styles' );

if ( ! function_exists( 'mule_remove_cf7' ) ) :
	function mule_remove_cf7() {
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) :
			global $post;

			if ( is_a( $post, 'WP_Post' ) && ! has_shortcode( $post->post_content, 'contact-form-7' ) ) {
				add_filter( 'wpcf7_load_js', '__return_false' );
				add_filter( 'wpcf7_load_css', '__return_false' );
			}
		endif;
	}
endif;

/**
 * Add data attributes for Fancybox
 */

// Gallery images
function mule_fancybox_gallery_attribute( $content, $id ) {
	// Restore title attribute
	$title = get_the_title( $id );
	return str_replace('<a', '<a data-type="image" data-fancybox="gallery" title="' . esc_attr( $title ) . '" ', $content);
}
add_filter( 'wp_get_attachment_link', 'mule_fancybox_gallery_attribute', 10, 4 );

// Single images
function mule_fancybox_image_attribute( $content ) {
       global $post;

       $pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replace = '<a$1href=$2$3.$4$5 data-type="image" data-fancybox="image">';
       $content = preg_replace( $pattern, $replace, $content );

       return $content;
}
add_filter( 'the_content', 'mule_fancybox_image_attribute' );

// Add excerpts to pages for use in meta data
function mule_page_excerpts() {	
	add_post_type_support( 'page', 'excerpt' );	
}
add_action( 'init', 'mule_page_excerpts' );

// Add "read more" to ellipse in excerpt
function mule_replace_excerpt( $content ) {	
   return str_replace( '[&hellip;]',
		'&hellip; <a class="read-more" href="'. get_permalink() .'">Read more</a>',
		$content
   );
}
add_filter( 'the_excerpt', 'mule_replace_excerpt' );

// Add page break button to visual editor
function mule_add_page_break_button( $buttons, $id ){	
    if ( $id !== 'content' )    
	return $buttons;
	
    array_splice( $buttons, 13, 0, 'wp_page' );	
    return $buttons;
}
add_filter( 'mce_buttons', 'mule_add_page_break_button', 1, 2 );


/*
 * Change screen incidents of Post to News
 */
function MULE_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'MULE News';
    $submenu['edit.php'][5][0] = 'MULE News';
    $submenu['edit.php'][10][0] = 'Add News';
    $submenu['edit.php'][16][0] = 'News Tags';
    echo '';
}
function MULE_change_post_object() {
    global $wp_post_types;
    $labels = $wp_post_types['post']->labels;
    $labels->name = 'MULE News';
    $labels->singular_name = 'News';
    $labels->add_new = 'Add News';
    $labels->add_new_item = 'Add News';
    $labels->edit_item = 'Edit News Post';
    $labels->new_item = 'News';
    $labels->view_item = 'View News Post';
    $labels->search_items = 'Search news posts';
    $labels->not_found = 'No news posts found';
    $labels->not_found_in_trash = 'No news posts found in Trash';
    $labels->screen_items = 'screen News';
    $labels->menu_name = 'MULE News';
    $labels->name_admin_bar = 'News  Post';
}
 
add_action( 'admin_menu', 'MULE_change_post_label' );
add_action( 'init', 'MULE_change_post_object' );

// Change the pin icon to a megaphone
function MULE_add_news_icon() {
  global $menu;
  foreach ( $menu as $key => $val ) {
    if ( __( 'MULE News') == $val[0] ) {
      $menu[$key][6] = 'dashicons-megaphone';
    }
  }
}
add_action( 'admin_menu', 'MULE_add_news_icon' );

// Change post messages
function MULE_news_messages( $messages ) {
  global $post, $post_ID;

  $messages['post'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __( 'News Updated. <a href="%s">View News Post</a>' ), esc_url( get_permalink( $post_ID ) ) ),
    2 => __( 'Custom field updated.' ),
    3 => __( 'Custom field deleted.' ),
    4 => __( 'News updated.' ),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __( 'News post restored to revision from %s' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __( 'News published. <a href="%s">View News Post</a>' ), esc_url( get_permalink($post_ID) ) ),
    7 => __( 'News saved.' ),
    8 => sprintf( __( 'News submitted. <a target="_blank" href="%s">Preview News Post</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
    9 => sprintf( __( 'News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview News Post</a>' ),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __( 'News draft updated. <a target="_blank" href="%s">Preview News Post</a>' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
  );
  return $messages;
}
add_filter('post_updated_messages', 'MULE_news_messages');


/*
 * Move menu items
 */
function mule_move_menu_items() {

    global $submenu, $menu;
	
    if ( isset( $submenu['themes.php'] ) ) {

        foreach ( $submenu['themes.php'] as $key => $item ) {
            if ( $item[2] === 'nav-menus.php' ) {
                unset($submenu['themes.php'][$key] );
            }
			if ( $item[2] === 'widgets.php' ) {
                unset( $submenu['themes.php'][$key] );
            }
        }
    }
    $user = wp_get_current_user();
    if ( in_array( 'editor', $user->roles ) ) {
        unset( $menu[60] );
    }
    add_menu_page( __( 'Menus' ), __( 'Menus' ), 'delete_others_pages', 'nav-menus.php', '', 'dashicons-list-view', 61 );
	//add_menu_page( __( 'Widgets' ), __( 'Widgets' ), 'delete_others_pages', 'widgets.php', '', 'dashicons-welcome-widgets-menus', 62 );
}
add_action( 'admin_menu', 'mule_move_menu_items' );

function mule_menu_parent_file( $parent_file ){
    global $current_screen;

    if ( $current_screen->base == 'nav-menus' ) {
        $parent_file = 'nav-menus.php';
    }
	if ( $current_screen->base == 'widgets' ) {
        $parent_file = 'widgets.php';
    }
    return $parent_file;
}
add_filter( 'parent_file', 'mule_menu_parent_file' );

function mule_has_cap( $caps, $cap, $args, $user ) {
    $url = $_SERVER['REQUEST_URI'];

    if ( strpos( $url, 'nav-menus.php' ) !== false && in_array( 'edit_theme_options', $cap ) && in_array( 'editor', $user->roles ) ) {
        $caps['edit_theme_options'] = true;
    }
	if ( strpos( $url, 'widgets.php' ) !== false && in_array( 'edit_theme_options', $cap ) && in_array( 'editor', $user->roles ) ) {
        $caps['edit_theme_options'] = true;
    }
    return $caps;
}
add_filter( 'user_has_cap', 'mule_has_cap', 20, 4 );


/**
 * Responsive Image Helper Functions
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute 
 */

function mule_max_srcset_image_width() {
	return 2048;
}
add_filter( 'max_srcset_image_width', 'mule_max_srcset_image_width', 10 , 2 );

function mule_responsive_images( $image_id, $image_size, $max_width ) {
	// Check if the image ID is not blank
	if ( $image_id != '' && class_exists( 'acf' ) ) {
		// Set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );
		// Set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );
		// Generate the markup for the responsive image
		echo 'src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . ') 100vw, ' . $max_width . '"';
	}
}

/**
 * Template functions & admin functions
 */
require get_parent_theme_file_path( '/inc/head/mule-head.php' );
require get_parent_theme_file_path( '/template-parts/loader.php' );
require get_parent_theme_file_path( '/template-parts/header/header-parts.php' );
require get_parent_theme_file_path( '/template-parts/navigation/nav-parts.php' );
require get_parent_theme_file_path( '/template-parts/template-tags.php' );
require get_parent_theme_file_path( '/template-parts/credits.php' );

?>