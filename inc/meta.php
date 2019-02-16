<footer class="meta">
	<span style="color: #666; font-size: 18px; font-weight: bold;"><time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('F jS, Y') ?></time></span>
	<br />Posted in the <?php the_category(', ') ?> archive.
	<?php the_tags('Tagged: ', ', ', '<br />'); ?>
</footer>