<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tweeling_Bakery
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<nav id="footer-navigation" class="footer-navigation">
			<?php 
			wp_nav_menu( array( 'theme_location' => 'footer') ); 
			?>
			
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Created by Hyeri Yoon, Joshua Borseth, Sarah Hancock, Yuko Kitahata' ));
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
