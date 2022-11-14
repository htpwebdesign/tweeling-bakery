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
	while (have_posts()) :
		the_post();
		the_title( '<h1 class="entry-title">', '</h1>' );
		
		// Hero image
		if (function_exists('get_field')) {
			echo "<div class='feature-image home-hero'>";

			if ( get_field('home_featured_image') ) {
				echo wp_get_attachment_image( get_field( 'home_featured_image' ), 'full' );
			}
			if ( get_field('marketing_copy') ) {
				echo '<p class="marketing-copy">'. get_field('marketing_copy') .'</p>';
			}
			echo "</div>";
			}
		?>

			<!-- Featured Products Section -->
			<section class="featured-products">
			<?php
		if (function_exists('get_field')) {
				if (get_field('featured_products_heading')) {
					echo '<h2>';
					the_field('featured_products_heading');
					echo '</h2>';
				}
			?>
				<div class="swiper mySwiper">
					<div class="swiper-wrapper">
						<?php
						$featured_works = get_field('featured_products_selection');
						if ($featured_works) :
							foreach ($featured_works as $post) :
								setup_postdata($post);
						?>
								<article class="swiper-slide">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('medium'); ?>
									</a>
								</article>
						<?php
							endforeach;
							wp_reset_postdata();
						endif;
						?>
					</div>
					<div class="swiper-pagination"></div>
				</div>

				<p class="products-link"><a href="<?php echo the_permalink('128'); ?>">See All Products</a></p>


			</section>

			<!-- Order Online Section -->
			<section class="home-order">
				<?php
				if (get_field('order_online_photo')) {
					echo '<div class="feature-image home-order-image">';
					echo wp_get_attachment_image(get_field('order_online_photo'), 'medium');
					$image = get_field('order_online_photo');
				?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<p class="online-link"><a class="order-link" href="<?php echo the_permalink('13'); ?>">Order Online</a></p>
					</div>
				<?php
				}
				?>
			</section>

			<?php
		}
	endwhile; // End of the loop.
	?>

			<!-- Slider styling -->
			<style>
				/* lets rewrite this later in sass */
				.swiper-slide img {
					width: 300px;
					height: 300px;
					object-fit: cover;
				}

				.swiper {
					width: 80%
				}
			</style>

			<!-- ACF Google Map Section -->
			<section class="home-location">
				<?php
				echo '<div class="location-text-container">';
					if (get_field('location_heading')) {
						echo '<h2>';
						the_field('location_heading');
						echo '</h2>';
					}
					if (get_field('location_intro_text')) {
						echo '<p>';
						the_field('location_intro_text');
						echo '</p>';
					}
				?>
				</div>
				
				<?php
				// Google Map template
				get_template_part('template-parts/content', 'location');
				?>
			</section>

</main><!-- #main -->

<?php
get_footer();
