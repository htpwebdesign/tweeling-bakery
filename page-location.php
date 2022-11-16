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
			
			// call map template part
			get_template_part( 'template-parts/content', 'location' );
	
			// location CPT 
			$args = array(
						'post_type'      => 'tweel-location',
						'posts_per_page' => -1
					);
					
			$query = new WP_Query( $args );
			if ( $query -> have_posts() ){

			echo '<div class="location-details-wrapper">';

					while ( $query -> have_posts() ) {
						$query -> the_post();
		
						echo '<article>';
						// Output city name
						echo '<h2>'. get_the_title() .'</h2>';
		
						the_content();
		
						// Output ACF fields
						if ( function_exists( 'get_field' ) ) {
							// shop image
							if ( get_field( 'shop_image' ) ) {
								echo wp_get_attachment_image( get_field( 'shop_image' ), 'large' );
							}
							echo '<div>';
							// ACF Shop details
							if ( get_field( 'address' ) ) {
								the_field( 'address' ); 
							}
							if ( get_field( 'phone' ) ) {
								echo '<p>'. get_field( 'phone' ) .'</p>'; 
							}
							if ( get_field( 'email' ) ) {
								echo '<p>'. get_field( 'email' ) .'</p>'; 
							}
								// field label 'Hours'
								$label = get_field_object( 'hours' );
								if ( $label['label'] ) {
								echo '<div>';	
									echo '<h3>'. $label['label'] .'</h3>';
								}

								if ( get_field( 'hours' ) ) {
									the_field( 'hours' ); 
								}
								echo '</div>';

							echo '</div>';	
						};
						echo '</article>';					
					}
					wp_reset_postdata();
				}
			echo '</div>';
						
			// ACF upcoming new location fields
			if ( function_exists( 'get_field' ) ) {
				echo '<article class="new-location">';					
				if ( get_field( 'new_location_heading' ) ) {
					echo '<h2>'. get_field( 'new_location_heading' ) .'</h2>';
				}

				if ( get_field( 'new_location' ) ) {
					echo '<p>'. get_field( 'new_location' ) .'</p>';
				}
				echo '</article>';					
			}
		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_footer();
