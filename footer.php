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
			<button id="scroll-top" class="scroll-top">
				<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm5.247 15l-5.247-6.44-5.263 6.44-.737-.678 6-7.322 6 7.335-.753.665z"/></svg>
				<span class="screen-reader-text">Scroll To Top</span>
			</button>
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
