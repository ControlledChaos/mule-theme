<?php

/**

 * @package    WordPressrpt option

 *

 * @package WordPress

 * @subpackage Poker_Face

 * @since 3.0.0

 */

?>



<article class="hentry" role="article" id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php

			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

			pokerface_post_meta();

		?>

	</header>

	

	<div class="entry-summary">

	<?php

		if ( '' !== get_the_post_thumbnail() ) : ?>

		<div class="post-thumbnail">

			<?php pokerface_post_thumbnail(); ?>

		</div><!-- post-thumbnail -->

	<?php endif;

		the_excerpt();

	?>

	</div><!-- entry-summary -->



</article>