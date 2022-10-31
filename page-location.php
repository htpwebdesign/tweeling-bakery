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

		<!-- trying to loop through location CPT, no success -->
		<?php
		$args = array(
					'post_type'      => 'tweel-location',
					'posts_per_page' => -1
				);
				
		$query = new WP_Query( $args );
		if ( $query -> have_posts() ){
			while ( $query -> have_posts() ) {
				$query -> the_post();
				the_content();

			}
			wp_reset_postdata();
		}
						// Output ACF fields
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'map' ) ) {
								the_field( 'map' );
							}

							// ACF repeater
							if ( have_rows( 'shops' ) ) {
								
								get_sub_field_object('address');
								get_sub_field_object('phone');
								get_sub_field_object('email');
								get_sub_field_object('hours');
								get_sub_field_object('shop_image');
								
								while ( have_rows( 'shops' ) ) {
									the_row();
								
									echo '<p>'. get_sub_field('address') .'</p>';
									echo '<p>'. get_sub_field('phone') .'</p>';
									echo '<p>'. get_sub_field('email') .'</p>';
									echo '<p>'. get_sub_field('hours') .'</p>';
									echo wp_get_attachment_image( get_sub_field('shop_image'), 'medium');
									$image = get_sub_field('shop_image');
									?>
									<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />;
									<?php
								}
							}

							// upcoming new location fields
							if ( get_field( 'new_location_heading' ) ) {
								echo '<h2>'. get_field( 'new_location_heading' ) .'</h2>';
								the_field( 'new_location_heading' );
							}
							if ( get_field( 'new_location' ) ) {
								the_field( 'new_location' );
							}

						};				
		?> 

	</main><!-- #main -->

<?php
get_footer();
