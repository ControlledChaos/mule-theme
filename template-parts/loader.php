<?php
if ( ! function_exists( 'mule_loader' ) ) :
	function mule_loader() {
		if ( is_front_page() ) {
			$loading = __( 'Loading Mule', 'mule' );
		} elseif ( is_home() ) {
			$loading =  __( 'Loading Mule News', 'mule' );
		} elseif ( is_singular( 'snippets' ) ) {
			$loading =  __( 'Loading Video Snippet', 'mule' );
		} elseif ( is_single() ) {
			$loading =  __( 'Loading News Post', 'mule' );
		} elseif ( is_category() ) {
			$loading =  __( 'Loading News Category', 'mule' );
		} elseif ( is_tag() ) {
			$loading =  __( 'Loading News Tag', 'mule' );
		} elseif ( is_author() ) {
			$loading =  __( 'Loading News Author', 'mule' );
		} elseif ( is_page() ) {
			$loading =  __( 'Loading Page', 'mule' );
		} else {
			$loading =  __( 'Loading', 'mule' );
		}
	?>
		<div class="page-loader">
			<div class="loading"></div>
			<p><?php echo $loading; ?></p>
		</div>
	<?php }
endif; ?>