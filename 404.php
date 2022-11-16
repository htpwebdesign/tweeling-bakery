<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Tweeling_Bakery
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				
				
				<h1 class="page-title"><?php esc_html_e( 'Sorry - we "donut" have a page for you here!', 'tweeling-bakery' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
			<img class="404" src="https://tweelingbakery.bcitwebdeveloper.ca/wp-content/uploads/2022/11/404.png" alt="404 image error">
				<p><?php esc_html_e( 'Would you like to try again from our home page?', 'tweeling-bakery' ); ?></p>
				<button><a href="/tweeling">Home</a></button>

					<?php
					// get_search_form();

					// the_widget( 'WP_Widget_Recent_Posts' );
					?>

					
					<!-- .widget -->


			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
