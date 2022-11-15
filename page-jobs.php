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

	<div class="jobs-wrapper">
	<?php
	while (have_posts()) :
		the_post();
		the_title( '<h1 class="entry-title">', '</h1>' );
		echo get_the_post_thumbnail();
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
					<div class="title-apply">
						<h2><?php echo the_title(); ?></h2>
						<button class="button-apply-top">Apply now</button>
					</div>
					<?php
					$term = (get_the_terms(get_the_ID(), 'tweel-career-locations'));
					if ($term) {
						echo "<section class='job-section'>";
						echo "<article>";
						echo "<p>Job location: " . $term[0]->name . "</p>";
					}
					if (function_exists('get_field')) {
						if (get_field('job_description')) {
							echo "<p>Job Description: ";
							the_field('job_description');
							echo "</p>";
						}
						if (get_field('wages-salary')) {
							echo "<p>Pay $";
							the_field('wages-salary');
							echo " per year</p>";
						}
						if (get_field('wages-hourly')) {
							echo "<p>Pay: $";
							the_field('wages-hourly');
							echo " per hour</p>";
						}
						
						echo "<button class='button-apply-bottom'>Apply now</button>";
						echo "</article>";
						echo "</section>";
					}
						
						}
						echo "<section id='job-form'>";
						gravity_form( 2, false, false, false, '', false );
						wp_reset_postdata();
						echo "</section>";
					}
							?>

	</section>

	</div>
</main><!-- #main -->

<?php
get_footer();
