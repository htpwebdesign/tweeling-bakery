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

				if( get_field( 'product_banner_image' )) {
						echo wp_get_attachment_image( get_field( 'product_banner_image' ), 'medium' );
						$image = get_field('product_banner_image');
						?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php
				}
				if( get_field( 'opening_product_text' )) {
						echo '<p>';	
						the_field( 'opening_product_text' );
						echo '</p>';
				}
			}

			// output cagegory names
			$terms = get_terms( 'product_cat' );
			if( $terms && ! is_wp_error($terms) ) {
				foreach($terms as $term){
					echo '<button className="'.$term->name.'">'. $term -> name .'</button>';
				}
			}

			//Products
			$current_cat_id = $wp_query->get_queried_object()->term_id;
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => -1,
			);

			$products = new WP_Query( $args );
					echo '<section className="section-products">';
			while ( $products->have_posts() ) : 
							$products->the_post();
				echo '<li><div class="product__preview"><img src="' . get_the_post_thumbnail_url() . '"></div><span>' . get_the_title() . '</span></li>';
			endwhile;
					echo '</section>';

			wp_reset_postdata();

		endwhile;
		?>

	</main><!-- #main -->

<?php
get_footer();
