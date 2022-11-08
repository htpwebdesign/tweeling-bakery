<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

if ( function_exists( 'get_field' ) ) {
    echo '<article>';
    // output ACF field on page ID =13 (order online)
    if ( get_field( 'order_online_featured_image', 13 ) ) {
        echo wp_get_attachment_image( get_field( 'order_online_featured_image', 13 ), 'large' );
    }
    echo '</article>';					
}

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<header class="woocommerce-products-header">
    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php
    /**
     * Hook: woocommerce_archive_description.
     *
     * @hooked woocommerce_taxonomy_archive_description - 10
     * @hooked woocommerce_product_archive_description - 10
     */
    do_action('woocommerce_archive_description');
    ?>
</header>
<?php

/**
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_output_all_notices - 10
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
 */
// sort by price etc..
// do_action('woocommerce_before_shop_loop');


$terms = get_terms(
    array(
        'taxonomy' => 'product_cat',
    )
);
if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        // Add your WP_Query() code here
        // Use $term->slug in your tax_query
        // Use $term->name to organize the posts
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $term->slug,
                ),
            ),
        );

        $query = new WP_Query($args);
?>
        <section>
            <h2><?php echo $term->name  ?></h2>
            <?php
            while ($query->have_posts()) {
                $query->the_post();
            ?>
                <article>
                    <a href="<?php the_permalink(); ?>"><?php echo the_title()   ?></a>
                    <?php the_post_thumbnail();
                    $product = wc_get_product(get_the_ID());
                    echo $product->get_price_html();

                    global $product;

                    echo apply_filters(
                        'woocommerce_loop_add_to_cart_link',
                        sprintf(
                            '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
                            esc_url($product->add_to_cart_url()),
                            esc_attr($product->get_id()),
                            esc_attr($product->get_sku()),
                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                            esc_attr($product->get_type()),
                            esc_html($product->add_to_cart_text())
                        ),
                        $product
                    );
                    ?>

                </article>
            <?php
                wp_reset_postdata();
            }
            ?>
        </section>
<?php
    }
};

?>
<style>
    /* refactor to sass later */
    /* img {
        width: 100px;
        height: 100px;
    } */
</style>
<?php
wc_get_template_part('content', 'product');


/**
 * Hook: woocommerce_after_shop_loop.
 *
 * @hooked woocommerce_pagination - 10
 */
do_action('woocommerce_after_shop_loop');
/**
 * Hook: woocommerce_no_products_found.
 *
 * @hooked wc_no_products_found - 10
 */
do_action('woocommerce_no_products_found');

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');
