<?php

/**
 * Tweeling Bakery functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Tweeling_Bakery
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tweeling_bakery_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Tweeling Bakery, use a find and replace
		* to change 'tweeling-bakery' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('tweeling-bakery', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'tweeling-bakery'),
			'footer' => esc_html__('Footer', 'tweeling-bakery')
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'tweeling_bakery_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// block editor styling
	add_editor_style();
	add_theme_support( 'editor-styles' );

	//Our custom image crop sizes
	add_image_size('product-image', 300, 270, true);
	add_image_size('banner-image', 1920, 550);
}
add_action('after_setup_theme', 'tweeling_bakery_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tweeling_bakery_content_width()
{
	$GLOBALS['content_width'] = apply_filters('tweeling_bakery_content_width', 640);
}
add_action('after_setup_theme', 'tweeling_bakery_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tweeling_bakery_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'tweeling-bakery'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'tweeling-bakery'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'tweeling_bakery_widgets_init');

/**
 * Enqueue scripts and styles.
 */





function tweeling_bakery_scripts()
{
	wp_enqueue_style(
		// google fonts
		'tweeling-bakery-googlefonts',
		'https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style('tweeling-bakery-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('tweeling-bakery-style', 'rtl', 'replace');

	wp_enqueue_script('tweeling-bakery-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('tweeling-jobs-form-custom-script', get_template_directory_uri() . '/js/handle-jobs-form.js', array(), _S_VERSION, true);

	//swiper scripts and styles
	wp_enqueue_script('tweeling-swiper-custom-script', get_template_directory_uri() . '/js/swiper.js', array('tweeling-swiper-script'), _S_VERSION, true);

	wp_enqueue_script('tweeling-swiper-script', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js");
	wp_enqueue_style('tweeling-swiper-style', "https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css");


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// need 2 js files for google map - file1
	wp_enqueue_script(
		'tweeling-googlemap1',
		'https://maps.googleapis.com/maps/api/js?key=AIzaSyCblAfth_J7LLvnaU22a2Vrj5yjrmX3K84',
	);
	// google map - file2
	wp_enqueue_script(
		'tweeling-googlemap2',
		get_template_directory_uri() . '/js/googlemap.js',
		array('jquery', 'tweeling-googlemap1'),
		_S_VERSION,
		true
	);
	//filtering by category
	wp_enqueue_script(
		'category-filter',
		get_template_directory_uri() . '/js/category-filter.js',
		array(),
		_S_VERSION,
		true
	);
	//scroll-top on footer
	wp_enqueue_script(
		'scroll-top',
		get_template_directory_uri() . '/js/scroll-top.js',
		array(),
		_S_VERSION,
		true
	);
	// Create a JS object to store the URL for the JS file to get custom icon for google map
    wp_localize_script(
        'tweeling-googlemap1', 
        'icon_marker',
        array( 'url' => get_template_directory_uri() .'/images/icon.png' )
    );
	
}
add_action('wp_enqueue_scripts', 'tweeling_bakery_scripts');

// google map 
function my_acf_init()
{
	acf_update_setting('google_api_key', 'AIzaSyCblAfth_J7LLvnaU22a2Vrj5yjrmX3K84');
}
add_action('acf/init', 'my_acf_init');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * admin page
 */
// require get_template_directory() . '/inc/admin.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}


/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

function gf_enqueue_required_files()
{
	GFCommon::log_debug(__METHOD__ . '(): running.');
	if (is_page('59')) { // Only for a page with ID 1.
		gravity_form_enqueue_scripts(1, true); // Form ID 5 with ajax enabled.
	}
	if (is_page('134')) { // Only for a page with ID 1.
		gravity_form_enqueue_scripts(2, false); // Form ID 5 with ajax enabled.
	}
}
add_action('get_header', 'gf_enqueue_required_files');

/**
 * Exclude products from a particular category on the shop page
 */
function custom_pre_get_posts_query($q)
{

	$tax_query = (array) $q->get('tax_query');

	$tax_query[] = array(
		'taxonomy' => 'product_cat',
		'field' => 'slug',
		'terms' => array('breads'), // Don't display products in the 'breads' category on the shop page.
		'operator' => 'NOT IN'
	);


	$q->set('tax_query', $tax_query);
}

add_action('woocommerce_product_query', 'custom_pre_get_posts_query');





//  Remove WordPress Dashboard Widgets - code borrowed from: https://wpbeaches.com/remove-wordpress-backend-dashboard-widgets/
// and woocommerce setup reminder from https://mainwp.com/how-to-hide-the-setup-dashboard-widget-in-woocommerce/

function tweel_remove_dashboard_widgets()
{

	remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress.com Blog
	remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); // Plugins
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Right Now
	remove_action('welcome_panel', 'wp_welcome_panel'); // Welcome Panel
	remove_action('try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Try Gutenberg
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // Quick Press widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); // Recent Drafts
	remove_meta_box('dashboard_secondary', 'dashboard', 'side'); // Other WordPress News
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Incoming Links
	remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal'); // Gravity Forms
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
	remove_meta_box('icl_dashboard_widget', 'dashboard', 'normal'); // Multi Language Plugin
	remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Activity
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); // Site Health
	remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal'); // Woocommerce Setup reminder
	remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' ); // Yoast
}
add_action('wp_dashboard_setup', 'tweel_remove_dashboard_widgets');


/**
 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom()
{
	return 'low';
}
add_filter('wpseo_metabox_prio', 'yoast_to_bottom');


// add a custom logo to the login screen - borrowed from https://codex.wordpress.org/Customizing_the_Login_Form
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/tb-logo-2.svg);
				height:200px;
				width:320px;
				background-size: 320px 200px;
				background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// Change the login admin page to have a link to the Tweeling page and text that says Tweeling Bakery - code borrowed from https://www.wpbeginner.com/plugins/how-to-create-custom-login-page-for-wordpress/
function tweeling_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'tweeling_login_logo_url' );

function tweeling_login_logo_url_title() {
  return 'Tweeling Bakery';
}
add_filter( 'login_headertitle', 'tweeling_login_logo_url_title' );


// Remove comments from admin bar borrowed from https://www.isitwp.com/remove-comments-link-from-admin-bar/
function remove_comments_from_admin_bar() {
	remove_menu_page( 'edit-comments.php' );
	}
	add_action( 'admin_menu', 'remove_comments_from_admin_bar' );

// Add styling for wp-admin page

	if ( ! function_exists( 'tw_login_style' ) ) :
		function tw_login_style() {
			wp_enqueue_style( 'tweel-login', get_template_directory_uri() . '/style.css' );
		}
		add_action( 'login_enqueue_scripts', 'tw_login_style' );
	endif;


	// Adding custom dashboard widget

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Updating Tweeling Bakery', 'custom_dashboard_help');
}

// Video Tutorial from Youtube code borrowed from https://wordpress.stackexchange.com/questions/46445/video-tutorials-in-dashboard
function custom_dashboard_help() {

	$tutorial_1 = tweeling_youtube_thumb_link(
        array(
            'id'=>'s-c_urzTWYQ', 
            'color'=>'#f49d32', 
            'title' => 'Video Tutorial', 
            'button' => 'Watch now'
        )
    );

	$html = <<<HTML
    <h4 style="text-align:center">Learn how to make changes to the Tweeling Bakery WordPress site here</h4>
    {$tutorial_1}
    
HTML;

    echo $html;

}

function tweeling_youtube_thumb_link($atts, $content = null) 
{
    $img   = "https://wwwpreview.bcit.ca/wp-content/uploads/2018/11/ms-icon.png";
    $yt    = "https://youtu.be/978UTPuTYtU";
    $color = ($atts['color'] && $atts['color'] != '') ? ';color:' . $atts['color'] : '';

    $html  = <<<HTML
        <div class="poptube" style="text-align:center;margin-bottom:40px">
        <h2 class="poptube" style="text-shadow:none;padding:0px{$color}">{$atts['title']}</h2>
        <a href="{$yt}" target="_blank"><img class="poptube" src="{$img}" style="margin-bottom:-19px"/></a><br />
        <a class="poptube button-secondary" href="{$yt}" target="_blank">{$atts['button']}</a></div>
HTML;

    return $html;
}

// Remove admin links from non-admin dashboard
function tweeling_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' ); // Remove Posts link
		remove_menu_page( 'edit.php?post_type=feedback' );  // Remove Feedback link
		remove_menu_page( 'admin.php?page=wpseo_workouts' );  // Remove Yoast SEO link
		remove_menu_page( 'tools.php' );  // Remove Tools link
	}
}
add_action( 'admin_menu', 'tweeling_remove_admin_links' );






