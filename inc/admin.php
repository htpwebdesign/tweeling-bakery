<?php
// add a custom logo to the login screen - borrowed from https://codex.wordpress.org/Customizing_the_Login_Form
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
				background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/tb-logo.svg);
				height:200px;
				width:320px;
				background-size: 320px 200px;
				background-repeat: no-repeat;
        	/* padding-bottom: 30px; */
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

