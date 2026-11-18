<?php
/**
 * WooCommerce compatibility. Only loaded when WooCommerce is active.
 *
 * @link https://woocommerce.com/
 *
 * @package Boyo
 */

/**
 * Declares WooCommerce support and the product gallery features.
 */
function boyo_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'boyo_woocommerce_setup' );

/**
 * Registers the Shop Sidebar widget area.
 */
function boyo_woocommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop Sidebar', 'boyo' ),
			'id'            => 'boyo-shop-sidebar',
			'description'   => esc_html__( 'Appears left of the products on the shop page and product category and tag pages, and above them on small screens. Leave empty for a full width shop.', 'boyo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'boyo_woocommerce_widgets_init' );

/**
 * Whether the current page shows the Shop Sidebar.
 *
 * @return bool
 */
function boyo_woocommerce_has_sidebar() {
	return ( is_shop() || is_product_taxonomy() ) && get_theme_mod( 'boyo_woocommerce_sidebar', true ) && is_active_sidebar( 'boyo-shop-sidebar' );
}

/**
 * Loads the WooCommerce styles, registered by Boyo_CSS_Loader, after WooCommerce's own.
 */
function boyo_woocommerce_styles() {
	wp_enqueue_style( 'boyo-woocommerce' );
}
add_action( 'wp_enqueue_scripts', 'boyo_woocommerce_styles', 20 );

if ( ! function_exists( 'boyo_woocommerce_cart_link' ) ) :

	/**
	 * Displays the header cart link with the number of items in the cart.
	 */
	function boyo_woocommerce_cart_link() {
		if ( ! WC()->cart ) {
			return;
		}

		$count = WC()->cart->get_cart_contents_count();
		?>
		<a class="boyo-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><svg aria-hidden="true" focusable="false" width="24" height="24" viewBox="0 0 24 24"><path d="M1.5 3h3.2l2.6 11.5h11.2l2.4-8.5H6.2"></path><circle cx="9" cy="19.5" r="1.6"></circle><circle cx="17" cy="19.5" r="1.6"></circle></svg>
		<?php if ( $count > 0 ) : ?>
			<span class="boyo-cart-count" aria-hidden="true"><?php echo esc_html( number_format_i18n( $count ) ); ?></span>
		<?php endif; ?>
		<span class="screen-reader-text">
		<?php
		/* translators: %s: number of items in the cart. */
		echo esc_html( sprintf( _n( 'Cart, %s item', 'Cart, %s items', $count, 'boyo' ), number_format_i18n( $count ) ) );
		?>
		</span></a>
		<?php
	}

endif;
add_action( 'boyo_navigation_buttons', 'boyo_woocommerce_cart_link' );

/**
 * Refreshes the header cart link after products are added to the cart with AJAX.
 *
 * @param array $fragments HTML fragments keyed by selector.
 * @return array
 */
function boyo_woocommerce_cart_link_fragment( $fragments ) {
	if ( ! WC()->cart ) {
		return $fragments;
	}

	ob_start();
	boyo_woocommerce_cart_link();
	$fragments['a.boyo-cart-link'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'boyo_woocommerce_cart_link_fragment' );

/**
 * Hides the shop page title when turned off in the Customizer.
 *
 * @param bool $show Whether to show the title.
 * @return bool
 */
function boyo_woocommerce_show_page_title( $show ) {
	return $show && get_theme_mod( 'boyo_woocommerce_show_page_title', true );
}
add_filter( 'woocommerce_show_page_title', 'boyo_woocommerce_show_page_title' );

/**
 * Adds the WooCommerce (Theme) Customizer section.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boyo_woocommerce_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'boyo_woocommerce',
		array(
			'title'       => esc_html__( 'WooCommerce (Theme)', 'boyo' ),
			'priority'    => 1030,
			'description' => esc_html__( 'Shop layout options from the Boyo theme.', 'boyo' ),
		)
	);

	$wp_customize->add_setting(
		'boyo_woocommerce_sidebar',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'boyo_woocommerce_sidebar',
		array(
			'label'       => esc_html__( 'Show the Shop Sidebar', 'boyo' ),
			'description' => esc_html__( 'Shows the Shop Sidebar widget area on the shop page and product category and tag pages, when it has widgets.', 'boyo' ),
			'section'     => 'boyo_woocommerce',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'boyo_woocommerce_show_page_title',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
		)
	);

	$wp_customize->add_control(
		'boyo_woocommerce_show_page_title',
		array(
			'label'       => esc_html__( 'Show the shop page title', 'boyo' ),
			'description' => esc_html__( 'Shows the title above the products on the shop page and product category and tag pages.', 'boyo' ),
			'section'     => 'boyo_woocommerce',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'boyo_woocommerce_customize_register' );
