<?php
/**
 * Page content
 *
 * @package    WordPress
 * @subpackage Mule_Theme
 * @since      Mule 1.0.0.0
 */

?>
<article class="entry h-entry" id="post-<?php the_ID(); ?>" role="article">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	
	<div class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
	</div><!-- entry-content -->

</article>