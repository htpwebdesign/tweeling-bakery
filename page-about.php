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

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

				
			
		
		if ( function_exists ( 'get_field' ) ) {
			if ( get_field( 'story' ) ) {
				echo '<h2>'. get_field( 'story' ) .'</h2>';
			}

			if ( get_field( 'story_contents' ) ) {
				echo '<p>'.the_field( 'story_contents' ).'</p>';
			}

			if ( get_field( 'story_image' ) ) {
				echo wp_get_attachment_image( get_field( 'story_image' ), 'medium' );
			}

			if ( get_field( 'career' ) ) {
				echo '<h2>'. get_field( 'career' ) .'</h2>';
			}

			if ( get_field( 'career_text' ) ) {
				echo '<p>'.the_field( 'career_text' ).'</p>';
			}

			if ( get_field( 'careers_image' ) ) {
				echo wp_get_attachment_image( get_field( 'careers_image' ), 'medium' );
			}
		}  

	
	endwhile; // End of the loop.
	?>
		

	</main><!-- #main -->

<?php
get_footer();
