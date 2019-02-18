<?php
/**
 * Main navigation template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      3.0.0
 */

// Restrict direct access
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<nav class="nav nav-scroll" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
	<div class="wrapper">
		<p id="menu-toggle" class="menu-toggle"><a><span class="screen-reader-text">Menu</span></a></p>
		<?php
		if ( is_front_page() ) {
		wp_nav_menu(
			array( 
				'theme_location'  => 'main-front',
				'container_id'    => 'main-menu',
				'container_class' => 'main-menu',
				'menu_id'         => 'main-menu-list',
				'menu_class'      => 'main-menu-list',
				'fallback_cb'     => false
			)
		);
	} else {
		wp_nav_menu(
			array( 
				'theme_location'  => 'main',
				'container_id'    => 'main-menu',
				'container_class' => 'main-menu',
				'menu_id'         => 'main-menu-list',
				'menu_class'      => 'main-menu-list',
				'fallback_cb'     => false
			)
		);
	}
		?>
	</div>
</nav>