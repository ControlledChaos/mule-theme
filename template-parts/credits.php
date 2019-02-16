<?php
if ( ! function_exists( 'mule_credits' ) ) :
	function mule_credits() { ?>
		<p class="site-credits-link"><a data-fancybox data-src="#site-credits" href="javascript:;"><?php _e( 'Photo & Website Credits', 'mule' ); ?></a></p>
		<div id="site-credits" class="site-credits" style="display: none;">
			<h3><?php _e( 'Photo & Website Credits', 'mule' ); ?></h3>
			<h4><?php _e( 'Photos:', 'mule' ); ?></h4>
			<p><?php _e( '<span class="site-credits-name">JC Dill:</span> Photo of "Mule" riding lead animal, used in the Support section of the front page and on the Support page.', 'mule' ); ?></p>
			<p><?php _e( '<span class="site-credits-name">JC Dill:</span> Headshot photo of "Mule", used in the header image and on the Links page.', 'mule' ); ?></p>
			<p><?php _e( '<span class="site-credits-name">Kent Porter, The Press Democrat (Sonoma, CA):</span> Photo of "Mule" leading the pack string, used on the Press page.', 'mule' ); ?></p>
			<p><?php _e( '<span class="site-credits-name">John McDonald:</span> All other photos used on the site.', 'mule' ); ?></p>
			<h4><?php _e( 'Website:', 'mule' ); ?></h4>
			<p><?php _e( 'Designed, developed and donated by Greg Sweet | ', 'mule' ); ?><a href="http://ccdzine.com/" target="_blank"><?php _e( '<span class="site-credits-name">Controlled Chaos Design</span>', 'mule' ); ?></a></p>
		</div>
	<?php }
endif;
?>