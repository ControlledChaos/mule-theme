<?php
/**
 * Social navigation template
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since Mulee 1.0.0
 */
?>

	<nav class="social-nav" role="menu" itemscope itemtype="http://schema.org/ItemList">
		<?php
		wp_nav_menu(
			array( 
				'theme_location'  => 'social',
				'container_id'    => 'social-menu',
				'container_class' => 'social-menu',
				'menu_id'         => 'social-menu-list',
				'menu_class'      => 'social-menu-list',
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => false
			)
		); ?>
	</nav>