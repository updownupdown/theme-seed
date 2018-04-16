<footer id="footer">
	<div class="row">
		<div class="col span-12">

			<p id="footer-copy">&copy;<?php echo date('Y'); ?> Seed<?php if( is_front_page() ) echo '<span class="desktop-only">&nbsp;&nbsp;&nbsp;<span class="divider">|</span>&nbsp;&nbsp;&nbsp;</span><br class="mobile-only" /><a href="http://www.echosims.com" target="_blank">Website crafted by echosims</a>'; ?></p>

		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<?php
// Footer Scripts
$scripts_status = get_field('scripts_status', 'options');
if( $scripts_status == 'live' ){
	echo get_field('footer_scripts', 'options');
}
?>

</body>
</html>
