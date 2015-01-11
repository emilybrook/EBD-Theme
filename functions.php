<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'EBD Theme' );
define( 'CHILD_THEME_URL', 'http://www.emilybrookdesign.com/' );
define( 'CHILD_THEME_VERSION', '1.0' );


//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/** Custom image sizes */
add_image_size( 'home-middle', 180, 180, TRUE );
add_image_size( 'home-right-featured', 250, 250, TRUE );

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'ebd_enqueue_scripts' );
function ebd_enqueue_scripts() {

	wp_enqueue_script( 'ebd-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
}

//* Enqueue Animate.CSS
add_action( 'wp_enqueue_scripts', 'sk_enqueue_scripts' );
function sk_enqueue_scripts() {
 
	wp_enqueue_style( 'animate', get_stylesheet_directory_uri() . '/css/animate.min.css' );
}


//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer'
) );

// -----------------------------------
// --  REMOVE SOME DEFAULT WIDGETS  --
// -----------------------------------
 
function pc_unregister_default_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('Twenty_Eleven_Ephemera_Widget');
    unregister_widget('Akismet_Widget');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Meta');   
    
}
 
add_action( 'widgets_init', 'pc_unregister_default_widgets', 11 );


// Home page widgets
genesis_register_sidebar( array(
	'id'			=> 'home-featured-left',
	'name'			=> __( 'Home Featured Left', 'ebd' ),
	'description'	=> __( 'This is the featured section left side.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-featured-right',
	'name'			=> __( 'Home Featured Right', 'ebd' ),
	'description'	=> __( 'This is the featured section right side.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-welcome',
	'name'			=> __( 'Home Welcome', 'ebd' ),
	'description'	=> __( 'This is the home bottom section.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-banner',
	'name'			=> __( 'Home Banner', 'ebd' ),
	'description'	=> __( 'This is the home banner section.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-1',
	'name'			=> __( 'Home Middle 1', 'ebd' ),
	'description'	=> __( 'This is the home middle left section.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-2',
	'name'			=> __( 'Home Middle 2', 'ebd' ),
	'description'	=> __( 'This is the home middle center section.', 'ebd' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-middle-3',
	'name'			=> __( 'Home Middle 3', 'ebd' ),
	'description'	=> __( 'This is the home middle right section.', 'ebd' ),
) );

//* Create a shortcode to display our custom Go to top link
add_shortcode('footer_custombacktotop', 'set_footer_custombacktotop');
function set_footer_custombacktotop($atts) {
    return '
        <a href="#" class="top">Return to top of page</a>
    ';
}

//* Add smooth scrolling for any link having the class of "top"
add_action('wp_footer', 'go_to_top');
function go_to_top() { ?>
    <script type="text/javascript">
        jQuery(function($) {
            $('a.top').click(function() {
                $('html, body').animate({scrollTop:0}, 'slow');
                return false;
            });
        });
    </script>
<?php }

//* Change the footer text
add_filter('genesis_footer_creds_text', 'sp_footer_creds_filter');
function sp_footer_creds_filter( $creds ) {
    $creds = '[footer_copyright] &middot; All Right Reserved &middot <a href="http://emilybrookdesign.com">Emily Brook Design</a> &middot; Built by <a href="http://www.emilybrookdesign.com">Emily Brook Reinholt</a> [footer_custombacktotop]';
    return $creds;
}

//* Link to Custom StyleSheet
function custom_style_sheet() {
wp_enqueue_style( 'custom-styling', get_stylesheet_directory_uri() . 'css/custom.css' );
}
add_action('wp_enqueue_scripts', 'custom_style_sheet');