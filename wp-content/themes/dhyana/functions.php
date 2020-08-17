<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'after_setup_theme', 'lalita_background_setup' );
/**
 * Overwrite parent theme background defaults and registers support for WordPress features.
 *
 */
function lalita_background_setup() {
	add_theme_support( "custom-background",
		array(
			'default-color' 		 => 'ffffff',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
			'default-position-x'     => 'left',
			'default-position-y'     => 'top',
			'default-size'           => 'auto',
			'default-attachment'     => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		)
	);
}

/**
 * Overwrite theme URL
 *
 */
function lalita_theme_uri_link() {
	return 'https://wpkoi.com/dhyana-wpkoi-wordpress-theme/';
}

/**
 * Overwrite parent theme's blog header function
 *
 */
add_action( 'lalita_after_header', 'lalita_blog_header_image', 11 );
function lalita_blog_header_image() {

	if ( ( is_front_page() && is_home() ) || ( is_home() ) ) { 
		$blog_header_image 			=  lalita_get_setting( 'blog_header_image' ); 
		$blog_header_title 			=  lalita_get_setting( 'blog_header_title' ); 
		$blog_header_text 			=  lalita_get_setting( 'blog_header_text' ); 
		$blog_header_button_text 	=  lalita_get_setting( 'blog_header_button_text' ); 
		$blog_header_button_url 	=  lalita_get_setting( 'blog_header_button_url' ); 
		if ( $blog_header_image != '' ) { ?>
		<div class="page-header-image grid-parent page-header-blog">
			<div class="page-header-blog-inner-img" style="background-image: url(<?php echo esc_url($blog_header_image); ?>);"></div>
            <div class="page-header-blog-content-h grid-container">
                <div class="page-header-blog-content">
                <?php if ( ( $blog_header_title != '' ) || ( $blog_header_text != '' ) ) { ?>
                    <div class="page-header-blog-text">
                        <?php if ( $blog_header_title != '' ) { ?>
                        <h2><?php echo wp_kses_post( $blog_header_title ); ?></h2>
                        <div class="clearfix"></div>
                        <?php } ?>
                        <?php if ( $blog_header_title != '' ) { ?>
                        <p><?php echo wp_kses_post( $blog_header_text ); ?></p>
                        <div class="clearfix"></div>
                        <?php } ?>
                    </div>
                    <div class="page-header-blog-button">
                        <?php if ( $blog_header_button_text != '' ) { ?>
                        <a class="read-more button" href="<?php echo esc_url( $blog_header_button_url ); ?>"><?php echo esc_html( $blog_header_button_text ); ?></a>
                        <?php } ?>
                    </div>
                <?php } ?>
                </div>
            </div>
		</div>
		<?php
		}
	}
}

if ( ! function_exists( 'dhyana_remove_parent_dynamic_css' ) ) {
	add_action( 'init', 'dhyana_remove_parent_dynamic_css' );
	/**
	 * The dynamic styles of the parent theme added inline to the parent stylesheet.
	 * For the customizer functions it is better to enqueue after the child theme stylesheet.
	 */
	function dhyana_remove_parent_dynamic_css() {
		remove_action( 'wp_enqueue_scripts', 'lalita_enqueue_dynamic_css', 50 );
	}
}

if ( ! function_exists( 'dhyana_enqueue_parent_dynamic_css' ) ) {
	add_action( 'wp_enqueue_scripts', 'dhyana_enqueue_parent_dynamic_css', 50 );
	/**
	 * Enqueue this CSS after the child stylesheet, not after the parent stylesheet.
	 *
	 */
	function dhyana_enqueue_parent_dynamic_css() {
		$css = lalita_base_css() . lalita_font_css() . lalita_advanced_css() . lalita_spacing_css() . lalita_no_cache_dynamic_css();

		// escaped secure before in parent theme
		wp_add_inline_style( 'lalita-child', $css );
	}
}

// Extra cutomizer functions
if ( ! function_exists( 'dhyana_customize_register' ) ) {
	add_action( 'customize_register', 'dhyana_customize_register' );
	function dhyana_customize_register( $wp_customize ) {
		
		// Add border under header
		$wp_customize->add_setting(
			'dhyana_settings[header_border_none]',
			array(
				'default' => false,
				'type' => 'option',
				'sanitize_callback' => 'dhyana_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'dhyana_settings[header_border_none]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Disable border under header', 'dhyana' ),
				'section' => 'lalita_layout_header',
				'priority' => 2
			)
		);
		
		// Add border next to logo
		$wp_customize->add_setting(
			'dhyana_settings[logo_border_none]',
			array(
				'default' => false,
				'type' => 'option',
				'sanitize_callback' => 'dhyana_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'dhyana_settings[logo_border_none]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Disable border next to logo', 'dhyana' ),
				'section' => 'lalita_layout_navigation',
				'priority' => 2
			)
		);
		
	}
}

if ( ! function_exists( 'dhyana_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox values.
	 *
	 */
	function dhyana_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
}

if ( ! function_exists( 'dhyana_body_classes' ) ) {
	add_filter( 'body_class', 'dhyana_body_classes' );
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 */
	function dhyana_body_classes( $classes ) {
		// Get Customizer settings
		$dhyana_settings = get_option( 'dhyana_settings' );
		
		// Return if cross image or colorized image function is not exist
		if ( ( ! isset( $dhyana_settings['logo_border_none'] ) ) && ( ! isset( $dhyana_settings['header_border_none'] ) ) ) {
			return $classes;
		}
		
		// Cross image function for blog header
		if ( $dhyana_settings['logo_border_none'] == true ) {
			$classes[] = 'dhyana-logo-border-none';
		}
		
		// Colorized blog images function
		if ( $dhyana_settings['header_border_none'] == true ) {
			$classes[] = 'dhyana-header-border-none';
		}
		
		return $classes;
	}
}