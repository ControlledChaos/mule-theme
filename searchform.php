<?php
/**
 * Search form template
 *
 * @package WordPress
 * @subpackage Mule
 * @since Mule 1.0.0
 */
?>

<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label for="s" class="screen-reader-text">Search for:</label>
	<input type="search" class="s" id="s" name="s" value="" placeholder="🔎 Search this site&hellip;" />
	<input type="submit" value="Submit" class="search-submit" id="search-submit" />

</form>