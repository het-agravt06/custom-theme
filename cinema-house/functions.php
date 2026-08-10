<?php
/**
 * Cinema House functions and definitions
 *
 * @package Cinema House
 */

if ( ! function_exists( 'cinema_house_setup' ) ) :
function cinema_house_setup() {
	
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

    load_theme_textdomain( 'cinema-house', get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
			
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	add_theme_support('woocommerce');

	// Enqueue editor styles.
	add_editor_style( array( 'assets/css/editor-style.css' ) );

	if (! defined('CINEMA_HOUSE_VERSION')) {
		// Replace the version number of the theme on each release.
		define('CINEMA_HOUSE_VERSION', wp_get_theme()->get('Version'));
	}

	require get_parent_theme_file_path( '/inc/dashboard/dashboard.php' );

	require get_parent_theme_file_path( '/inc/admin/theme-upsell.php' );

    require get_parent_theme_file_path( '/inc/customizer/customizer.php' );
	
}
endif; // cinema_house_setup
add_action( 'after_setup_theme', 'cinema_house_setup' );

function cinema_house_scripts() {
	wp_enqueue_style( 'cinema-house-basic-style', get_stylesheet_uri() );

    $cinema_house_enable_animations = get_option( 'cinema_house_enable_animations', true );

    if ( $cinema_house_enable_animations ) {
        //animation
		wp_enqueue_script( 'wow-js', get_theme_file_uri( '/assets/js/wow.js' ), array( 'jquery' ), true );

		wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );
    }

	//font-awesome
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.css', array(), '6.7.1' );

	//homepage slider
	wp_enqueue_style('cinema-house-swiper-bundle-css', get_template_directory_uri() . '/assets/css/swiper-bundle.css', array(), CINEMA_HOUSE_VERSION);

	wp_enqueue_script('cinema-house-swiper-bundle-js', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array('jquery'), CINEMA_HOUSE_VERSION, true);

	// script.js
	wp_enqueue_script('cinema-house-main-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), CINEMA_HOUSE_VERSION, true);
	
     wp_style_add_data( 'cinema-house-basic-style', 'rtl', 'replace' );
	
}
add_action( 'wp_enqueue_scripts', 'cinema_house_scripts' );

function cinema_house_enqueue_admin_script($hook) {
    // Enqueue admin JS for notices
    wp_enqueue_script('cinema-house-welcome-notice', get_template_directory_uri() . '/inc/dashboard/cinema-house-welcome-notice.js', array('jquery'), '', true);
    
    // Localize script to pass data to JavaScript
    wp_localize_script('cinema-house-welcome-notice', 'cinema_house_localize', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cinema_house_welcome_nonce'),
        'dismiss_nonce' => wp_create_nonce('cinema_house_welcome_nonce'), // Nonce for dismissal
        'redirect_url' => admin_url('themes.php?page=cinema-house-guide-page')
    ));
}
add_action('admin_enqueue_scripts', 'cinema_house_enqueue_admin_script');

function cinema_house_admin_theme_style() {
   wp_enqueue_style('cinema-house-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/dashboard.css');
   wp_enqueue_style('cinema-house-admin-upsell-style', esc_url(get_template_directory_uri()) . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'cinema_house_admin_theme_style');

// Block Patterns.
require get_template_directory() . '/block-patterns.php';
require get_template_directory() .'/inc/TGM/tgm.php';
require get_template_directory() . '/custom-setting.php';
require_once get_template_directory() . '/inc/dashboard/welcome-notice.php';

/**
 * Redirect to Pro upsell page after theme activation
 */
add_action('after_switch_theme', 'cinema_house_redirect_after_activation');
function cinema_house_redirect_after_activation() {
    if ( ! get_option( 'cinema_house_activation_redirect', false ) ) {
        update_option( 'cinema_house_activation_redirect', true );
        wp_safe_redirect( admin_url( 'themes.php?page=cinema-house-pro' ) );
        exit;
    }
}

add_action( 'admin_bar_menu', 'cinema_house_add_upgrade_button', 100 );

function cinema_house_add_upgrade_button( $cinema_house_wp_admin_bar ) {

    $cinema_house_theme_name = wp_get_theme()->get( 'Name' );

    $cinema_house_args = array(
        'id'    => 'cinema_house_upgrade',
        'title' => '<span style="color:#fff;font-weight:600;">
            🚀 Upgrade to ' . esc_html( $cinema_house_theme_name ) . ' Pro - 20% OFF 
            <span style="background:#ff5722;color:#fff;padding:2px 8px;border-radius:3px;margin-left:6px;">
                Buy Now
            </span>
        </span>',
        'href'  => esc_url( CINEMA_HOUSE_BUY_PRO ),
        'meta'  => array(
            'class'  => 'cinema-house-upgrade-btn',
            'title'  => 'Upgrade to Pro',
            'target' => '_blank'
        )
    );

    $cinema_house_wp_admin_bar->add_node( $cinema_house_args );
}