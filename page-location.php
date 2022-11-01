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

		endwhile; // End of the loop.
		?>


		<?php
		// call map template part

		get_template_part( 'template-parts/content', 'location' );

		// location CPT 
		$args = array(
					'post_type'      => 'tweel-location',
					'posts_per_page' => -1
				);
				
		$query = new WP_Query( $args );
		if ( $query -> have_posts() ){
			while ( $query -> have_posts() ) {
				$query -> the_post();

				echo '<article>';
				echo '<h2>'. get_the_title() .'</h2>';

				the_content();

				// Output ACF fields
				if ( function_exists( 'get_field' ) ) {

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
					if ( get_field( 'hours' ) ) {
						the_field( 'hours' ); 
					}	
					
					$image = get_field('shop_image');
					?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php
								
					// ACF upcoming new location fields
					if ( get_field( 'new_location_heading' ) ) {
						echo '<h2>'. get_field( 'new_location_heading' ) .'</h2>';
					}
					if ( get_field( 'new_location' ) ) {
						the_field( 'new_location' );
					}
							
				};
				echo '</article>';					
			}
			wp_reset_postdata();
		}
						?> 

</main><!-- #main -->

<?php
get_footer();
