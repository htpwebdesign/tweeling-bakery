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

				if( get_field( 'product_banner_image' )){
						echo wp_get_attachment_image( get_field( 'product_banner_image' ), 'medium' );
						$image = get_field('product_banner_image');
						?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php
				}
				if( get_field( 'opening_product_text' )){
						echo '<p>';	
						the_field( 'opening_product_text' );
						echo '</p>';
				}
			}

		// Inner Navigation
		$args = array(
			'post_type'             => 'product',
			'post_status'           => 'publish',
			'ignore_sticky_posts'   => 1,
			'posts_per_page'        => '12',
			'tax_query'             => array(
        array(
            'taxonomy'  => 'product_cat',
            'field'     => 'term_id',
            'terms'     => array('40'),
            'operator'  => 'IN',
        )
   		)
		);
		$query = new WP_Query($args);
			if( $query -> have_posts() ){
				?>
				<article>
				<nav class="inner-nav">
				<?php
				while ( $query -> have_posts() ){
					$query -> the_post();
					$id = get_the_ID();
					?>

							<a href="#<?php echo $id; ?>"><?php the_title(); ?></a>
						
				<?php		
				}
				wp_reset_postdata();
				?>
					</nav>
					</article>
					
				<?php
			}
		endwhile; // End of the loop.
		?>
		<?php
		
		//Products
		$current_cat_id = $wp_query->get_queried_object()->term_id;
       $args = array(
         'taxonomy'       => 'product_cat',
         'post_type'      => 'product',
         'post_status'    => 'publish',
         'posts_per_page' => -1,
         'tax_query'      => array(
             'taxonomy'   => 'product_cat',
             'field'      => 'term_id',
             'terms'      => $current_cat_id,
             'operator'   => 'IN'
         )
       );

			

       $products = new WP_Query( $args );
       while ( $products->have_posts() ) : 
					$products->the_post();
          echo '<li><div class="product__preview"><img src="' . get_the_post_thumbnail_url() . '"></div><span>' . get_the_title() . '</span></a></li>';
       endwhile;

       wp_reset_query();
			 ?>

	</main><!-- #main -->

<?php
get_footer();
