<?php
if ( ! function_exists( 'mule_loader' ) ) :
	function mule_loader() {
		if ( is_front_page() ) {
			$loading = __( 'Loading Mule', 'mule-theme' );
		} elseif ( is_home() ) {
			$loading =  __( 'Loading Mule News', 'mule-theme' );
		} elseif ( is_singular( 'snippets' ) ) {
			$loading =  __( 'Loading Video Snippet', 'mule-theme' );
		} elseif ( is_single() ) {
			$loading =  __( 'Loading News Post', 'mule-theme' );
		} elseif ( is_category() ) {
			$loading =  __( 'Loading News Category', 'mule-theme' );
		} elseif ( is_tag() ) {
			$loading =  __( 'Loading News Tag', 'mule-theme' );
		} elseif ( is_author() ) {
			$loading =  __( 'Loading News Author', 'mule-theme' );
		} elseif ( is_page() ) {
			$loading =  __( 'Loading Page', 'mule-theme' );
		} else {
			$loading =  __( 'Loading', 'mule-theme' );
		}
	?>
		<div class="page-loader">
			<div class="loading"></div>
			<p><?php echo $loading; ?></p>
		</div>
	<?php }
endif; ?>