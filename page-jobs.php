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

		get_template_part('template-parts/content', 'page');

		if (function_exists('get_field')) {
			if (get_field('careers_opening_blurb')) {
				echo "<p>";
				the_field('careers_opening_blurb');
				echo "</p>";
			}
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop. end
	?>

	<section>

		<?php
		$args = array(
			'post_type'      => 'tweel-career',
			'posts_per_page' => -1,
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
		?>
				<article>
					<h2><?php echo the_title(); ?></h2>
					<?php
					$term = (get_the_terms(get_the_ID(), 'tweel-career-locations'));
					if ($term) {
						echo "<p>" . $term[0]->name . "</p>";
					}
					if (function_exists('get_field')) {
						if (get_field('job_description')) {
							echo "<p>";
							the_field('job_description');
							echo "</p>";
						}
						if (get_field('pay')) {
							echo "<p>";
							the_field('pay');
							echo " dollars per hour</p>";
						}
					}
					?>
				</article><?php
						}
						wp_reset_postdata();
					}
							?>

	</section>


</main><!-- #main -->

<?php
get_sidebar();
get_footer();
