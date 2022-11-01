<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Tweeling_Bakery
 */

?>

<?php

$args = array(
	'post_type'      => 'tweel-location',
	'posts_per_page' => -1
);

$query = new WP_Query( $args );

if ( $query -> have_posts() ){
	echo '<div class="acf-map" data-zoom="16">';
	
	while ( $query -> have_posts() ) {
		$query -> the_post();
		
		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'map' ) ) {
				$location = get_field('map');
				?>
			<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
			<p><em><?php echo esc_html( $location['address'] ); ?></em></p>
			</div>
				<?php
			}
		}
	}
	echo '</div>';
}