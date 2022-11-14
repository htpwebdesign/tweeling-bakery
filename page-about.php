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
		<div class="about-wrapper">

		<?php
		while ( have_posts() ) :
			the_post();

			the_title( '<h1 class="entry-title">', '</h1>' );
		?>

		<section class="about-story-wrapper">
		
		<?php
		if ( function_exists ( 'get_field' ) ) {

			if ( get_field( 'story_image' ) ) {
				echo wp_get_attachment_image( get_field( 'story_image' ), 'medium' );
			}

			if ( get_field( 'story' ) ) {
				echo '<h2>'. get_field( 'story' ) .'</h2>';
			}
			
			if ( get_field( 'story_contents' ) ) {
				the_field( 'story_contents' );
			}
			?>
		
		</section>

		<section class="about-career-wrapper">
			<div class="about-title-picture">
		<?php

			if ( get_field( 'careers_image' ) ) {
				echo wp_get_attachment_image( get_field( 'careers_image' ), 'medium' );
}

			if ( get_field( 'career' ) ) {
				echo '<h2>'. get_field( 'career' ) .'</h2>';
			}
			?>
			</div>

			<?php

			if ( get_field( 'career_text' ) ) {
				the_field( 'career_text' );
			}

			
		}  
		?>
		<a class="about-positions" href="<?php echo the_permalink('134') ?>">Positions Available</a>
		</section>

		<?php

	
	endwhile; // End of the loop.
	?>
		
		</div>
	</main><!-- #main -->

<?php
get_footer();
