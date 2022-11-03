<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tweeling_Bakery
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if ( function_exists ( 'get_field' ) ) {
				
				if ( get_field( 'opening_catering_text' ) ) {
					echo '<p>';
					the_field( 'opening_catering_text' );
					echo '</p>';
				}
			}  

			gravity_form( 1, false, false, true, '', false );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
