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

			if (function_exists('get_field')){

				//Featured Product Section
				?>
				<section className="home-featured">
				<?php
				if( get_field( 'featured_products_heading' )){
						echo '<h2>';	
						the_field( 'featured_products_heading' );
						echo '</h2>';
				}

				$featured_works = get_field('featured_products_selection');
				if ($featured_works) :
						foreach($featured_works as $post) :
								setup_postdata($post); 
								?>
								<article class="front-portfolio">
										<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail('medium'); ?>
										</a>
								</article>
								<?php 
						endforeach;
						wp_reset_postdata();
				endif;
			

				?>
				</section>

				<section className="home-order">
				<?php
				if( get_field( 'order_online_photo' )){
					echo wp_get_attachment_image( get_field( 'order_online_photo' ), 'medium' );
					$image = get_field('order_online_photo');
					?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php
			}
				?>
				</section>

				<section className="home-location">
				<?php
				if( get_field( 'location_heading' )){
					echo '<h2>';	
					the_field( 'location_heading' );
					echo '</h2>';
				}
				if( get_field( 'location_intro_text' )){
					echo '<p>';	
					the_field( 'location_intro_text' );
					echo '</p>';
				}
				?>
				</section>
				<?php
				
			}

		

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
