<?php

/**
 * Kirki Advanced Customizer
 *
 * @package kakina
 */
// Early exit if Kirki is not installed
if ( !class_exists( 'Kirki' ) ) {
	return;
}
/* Register Kirki config */
Kirki::add_config( 'kakina_pro_settings', array(
	'capability'	 => 'edit_theme_options',
	'option_type'	 => 'theme_mod',
) );

// Load language for the theme options
load_theme_textdomain( 'kakina', get_template_directory() . '/languages' );

/**
 * Add sections
 */
if ( class_exists( 'WooCommerce' ) && get_option( 'show_on_front' ) != 'page' ) {
	Kirki::add_section( 'kakina_woo_demo_section', array(
		'title'		 => __( 'WooCommerce Homepage Demo', 'kakina' ),
		'priority'	 => 10,
	) );
}
Kirki::add_section( 'sidebar_section', array(
	'title'			 => __( 'Sidebars', 'kakina' ),
	'priority'		 => 10,
	'description'	 => __( 'Sidebar layouts.', 'kakina' ),
) );

Kirki::add_section( 'layout_section', array(
	'title'			 => __( 'Main styling', 'kakina' ),
	'priority'		 => 10,
	'description'	 => __( 'Define theme layout', 'kakina' ),
) );

Kirki::add_section( 'top_bar_section', array(
	'title'			 => __( 'Top Bar', 'kakina' ),
	'priority'		 => 10,
	'description'	 => __( 'Top bar text', 'kakina' ),
) );

Kirki::add_section( 'search_bar_section', array(
	'title'			 => __( 'Search Bar & Social', 'kakina' ),
	'priority'		 => 10,
	'description'	 => __( 'Search and social icons', 'kakina' ),
) );

Kirki::add_section( 'site_bg_section', array(
	'title'		 => __( 'Site Background', 'kakina' ),
	'priority'	 => 10,
) );

Kirki::add_section( 'colors_section', array(
	'title'		 => __( 'Colors', 'kakina' ),
	'priority'	 => 10,
) );

if ( class_exists( 'WooCommerce' ) ) {
	Kirki::add_section( 'woo_section', array(
		'title'		 => __( 'WooCommerce', 'kakina' ),
		'priority'	 => 10,
	) );
}

Kirki::add_section( 'code_section', array(
	'title'		 => __( 'Custom Codes', 'kakina' ),
	'priority'	 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'demo_front_page',
	'label'			 => __( 'Enable Demo Homepage?', 'kakina' ),
	'description'	 => sprintf( __( 'When the theme is first installed and WooCommerce plugin activated, the demo mode would be turned on. This will display some sample/example content to show you how the website can be possibly set up. When you are comfortable with the theme options, you should turn this off. You can create your own unique homepage - Check the %s page for more informations.', 'kakina' ), '<a href="' . admin_url( 'themes.php?page=kakina-welcome' ) . '"><strong>' . __( 'Theme info', 'kakina' ) . '</strong></a>' ),
	'section'		 => 'kakina_woo_demo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'radio-buttonset',
	'settings'			 => 'front_page_demo_style',
	'label'				 => esc_html__( 'Homepage Demo Styles', 'kakina' ),
	'description'		 => sprintf( __( 'The demo homepage is enabled. You can choose from some predefined layouts or make your own %s.', 'kakina' ), '<a href="' . admin_url( 'themes.php?page=kakina-welcome' ) . '"><strong>' . __( 'custom homepage template', 'kakina' ) . '</strong></a>' ),
	'section'			 => 'kakina_woo_demo_section',
	'default'			 => 'style-one',
	'priority'			 => 10,
	'choices'			 => array(
		'style-one'		 => __( 'Layout one', 'kakina' ),
		'style-two'		 => __( 'Layout two', 'kakina' ),
		'style-three'	 => __( 'Layout three', 'kakina' ),
		'style-four'	 => __( 'Layout four', 'kakina' ),
		'style-five'	 => __( 'Layout five', 'kakina' ),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'repeater',
	'label'		 => __( 'Slider', 'kakina' ),
	'section'	 => 'kakina_woo_demo_section',
	'priority'	 => 10,
	'settings'	 => 'repeater_slider',
	'default'	 => array(
		array(
			'kakina_image_id'	 => get_template_directory_uri() . '/img/demo/slider1.jpg',
			'kakina_url'	 => '#',
		),
		array(
			'kakina_image_id'	 => get_template_directory_uri() . '/img/demo/slider2.jpg',
			'kakina_url'	 => '#',
		),
	),
	'fields'	 => array(
		'kakina_image_id'	 => array(
			'type'		 => 'image',
			'label'		 => __( 'Image', 'kakina' ),
			'default'	 => '',
		),
		'kakina_url'	 => array(
			'type'		 => 'text',
			'label'		 => __( 'URL', 'kakina' ),
			'default'	 => '',
		),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'select',
	'settings'			 => 'front_page_demo_sidebars',
	'label'				 => esc_html__( 'Homepage Demo Sidebar Position', 'kakina' ),
	'section'			 => 'kakina_woo_demo_section',
	'default'			 => 'left',
	'priority'			 => 10,
	'choices'			 => array(
		'left'	 => __( 'Left', 'kakina' ),
		'right'	 => __( 'Right', 'kakina' ),
		'none'	 => __( 'None', 'kakina' ),
	),
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro_widgets',
	'label'				 => __( 'Homepage Widgets', 'kakina' ),
	'section'			 => 'kakina_woo_demo_section',
	'description'		 => esc_html__( 'You can set your own widgets. Go to Appearance - Widgets and drag and drop your widgets to "Homepage Sidebar" area.', 'kakina' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'custom',
	'settings'			 => 'demo_page_intro',
	'label'				 => __( 'Products', 'kakina' ),
	'section'			 => 'kakina_woo_demo_section',
	'description'		 => esc_html__( 'If you dont see any products or categories on your homepage, you dont have any products probably. Create some products and categories first.', 'kakina' ),
	'priority'			 => 10,
	'active_callback'	 => array(
		array(
			'setting'	 => 'demo_front_page',
			'operator'	 => '==',
			'value'		 => 1,
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'custom',
	'settings'		 => 'demo_dummy_content',
	'label'			 => __( 'Need Dummy Products?', 'kakina' ),
	'section'		 => 'kakina_woo_demo_section',
	'description'	 => sprintf( esc_html__( 'When the theme is first installed, you dont have any products probably. You can easily import dummy products with only few clicks. Check %s tutorial.', 'kakina' ), '<a href="' . esc_url( 'https://docs.woocommerce.com/document/importing-woocommerce-dummy-data/' ) . '" target="_blank"><strong>' . __( 'THIS', 'kakina' ) . '</strong></a>' ),
	'priority'		 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'rigth-sidebar-check',
	'label'			 => __( 'Right Sidebar', 'kakina' ),
	'description'	 => __( 'Enable the Right Sidebar', 'kakina' ),
	'section'		 => 'sidebar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'right-sidebar-size',
	'label'		 => __( 'Right Sidebar Size', 'kakina' ),
	'section'	 => 'sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'left-sidebar-check',
	'label'			 => __( 'Left Sidebar', 'kakina' ),
	'description'	 => __( 'Enable the Left Sidebar', 'kakina' ),
	'section'		 => 'sidebar_section',
	'default'		 => 0,
	'priority'		 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'left-sidebar-size',
	'label'		 => __( 'Left Sidebar Size', 'kakina' ),
	'section'	 => 'sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'1'	 => '1',
		'2'	 => '2',
		'3'	 => '3',
		'4'	 => '4',
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'footer-sidebar-size',
	'label'		 => __( 'Footer Widget Area Columns', 'kakina' ),
	'section'	 => 'sidebar_section',
	'default'	 => '3',
	'priority'	 => 10,
	'choices'	 => array(
		'12' => '1',
		'6'	 => '2',
		'4'	 => '3',
		'3'	 => '4',
	),
) );


Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'image',
	'settings'		 => 'header-logo',
	'label'			 => __( 'Logo', 'kakina' ),
	'description'	 => __( 'Upload your logo', 'kakina' ),
	'section'		 => 'layout_section',
	'default'		 => '',
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'menu-sticky',
	'label'			 => __( 'Sticky menu', 'kakina' ),
	'description'	 => __( 'Enable or disable sticky menu', 'kakina' ),
	'section'		 => 'layout_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'textarea',
	'settings'			 => 'footer-credits',
	'label'				 => __( 'Footer credits', 'kakina' ),
	'help'				 => __( 'You can add custom text or HTML code.', 'kakina' ),
	'section'			 => 'layout_section',
	'sanitize_callback'	 => 'wp_kses_post',
	'default'			 => '',
	'priority'			 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'textarea',
	'settings'			 => 'infobox-text-left',
	'label'				 => __( 'Top bar left', 'kakina' ),
	'description'		 => __( 'Top bar left text area', 'kakina' ),
	'help'				 => __( 'You can add custom text. Only text allowed!', 'kakina' ),
	'section'			 => 'top_bar_section',
	'sanitize_callback'	 => 'wp_kses_post',
	'default'			 => '',
	'priority'			 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'				 => 'textarea',
	'settings'			 => 'infobox-text-center',
	'label'				 => __( 'Top bar center', 'kakina' ),
	'description'		 => __( 'Top bar center text area', 'kakina' ),
	'help'				 => __( 'You can add custom text. Only text allowed!', 'kakina' ),
	'section'			 => 'top_bar_section',
	'sanitize_callback'	 => 'wp_kses_post',
	'default'			 => '',
	'priority'			 => 10,
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'search-bar-check',
	'label'			 => __( 'Search bar', 'kakina' ),
	'description'	 => __( 'Enable search bar with social icons', 'kakina' ),
	'section'		 => 'search_bar_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'text',
	'settings'		 => 'kakina_pro_shop_by_text',
	'label'			 => __( 'Shop by category', 'kakina' ),
	'description'	 => __( 'Shop by category title', 'kakina' ),
	'section'		 => 'search_bar_section',
	'default'		 => __( 'Shop by category', 'kakina' ),
	'priority'		 => 10,
	'required'		 => array(
		array(
			'setting'	 => 'search-bar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'select',
	'settings'	 => 'shop-by-cat-menu',
	'label'		 => __( 'Shop By Category Menu', 'kakina' ),
	'section'	 => 'search_bar_section',
	'priority'	 => 10,
	'choices'	 => kakina_pro_menu_list(),
	'required'	 => array(
		array(
			'setting'	 => 'search-bar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'text',
	'settings'	 => 'shop-by-cat-text',
	'label'		 => __( 'More Categories Text', 'kakina' ),
	'section'	 => 'search_bar_section',
	'priority'	 => 10,
	'default'	 => 'More Categories',
	'required'	 => array(
		array(
			'setting'	 => 'search-bar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'switch',
	'settings'		 => 'kakina_socials',
	'label'			 => __( 'Social Icons', 'kakina' ),
	'description'	 => __( 'Enable or Disable the social icons. Use max 6 icons.', 'kakina' ),
	'section'		 => 'search_bar_section',
	'default'		 => 0,
	'priority'		 => 10,
	'required'		 => array(
		array(
			'setting'	 => 'search-bar-check',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'text',
	'settings'		 => 'kakina_socials_text',
	'label'			 => __( 'Follow Us Text', 'kakina' ),
	'description'	 => __( 'Insert your text before social icons.', 'kakina' ),
	'help'			 => __( 'Leave blank to hide text.', 'kakina' ),
	'section'		 => 'search_bar_section',
	'default'		 => __( 'Follow Us', 'kakina' ),
	'priority'		 => 10,
	'required'		 => array(
		array(
			'setting'	 => 'kakina_socials',
			'operator'	 => '==',
			'value'		 => 1,
		),
	)
) );
$s_social_links = array(
	'twp_social_facebook'	 => __( 'Facebook', 'kakina' ),
	'twp_social_twitter'	 => __( 'Twitter', 'kakina' ),
	'twp_social_google'		 => __( 'Google-Plus', 'kakina' ),
	'twp_social_instagram'	 => __( 'Instagram', 'kakina' ),
	'twp_social_pin'		 => __( 'Pinterest', 'kakina' ),
	'twp_social_youtube'	 => __( 'YouTube', 'kakina' ),
	'twp_social_reddit'		 => __( 'Reddit', 'kakina' ),
	'twp_social_linkedin'	 => __( 'LinkedIn', 'kakina' ),
	'twp_social_skype'		 => __( 'Skype', 'kakina' ),
	'twp_social_vimeo'		 => __( 'Vimeo', 'kakina' ),
	'twp_social_flickr'		 => __( 'Flickr', 'kakina' ),
	'twp_social_dribble'	 => __( 'Dribbble', 'kakina' ),
	'twp_social_envelope-o'	 => __( 'Email', 'kakina' ),
	'twp_social_rss'		 => __( 'Rss', 'kakina' ),
);

foreach ( $s_social_links as $keys => $values ) {
	Kirki::add_field( 'kakina_pro_settings', array(
		'type'			 => 'text',
		'settings'		 => $keys,
		'label'			 => $values,
		'description'	 => sprintf( __( 'Insert your custom link to show the %s icon.', 'kakina' ), $values ),
		'help'			 => __( 'Leave blank to hide icon.', 'kakina' ),
		'section'		 => 'search_bar_section',
		'default'		 => '',
		'priority'		 => 10,
		'required'		 => array(
			array(
				'setting'	 => 'search-bar-check',
				'operator'	 => '==',
				'value'		 => 1,
			),
		)
	) );
}

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'custom',
	'settings'	 => 'main_color_title',
	'label'		 => __( 'Main colors', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '<div style="border-bottom: 1px solid #fff;"></div>',
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'main_site_color',
	'label'		 => __( 'Main color', 'kakina' ),
	'help'		 => __( 'Main site color (links, buttons, carts...)', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#00ADEF',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce .button:hover, .header-cart-inner .fa-shopping-cart:hover, .yith-wcwl-add-button a:hover, .yith-wcwl-add-to-wishlist a:hover, a.btn-primary.outline:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .product-slider .star-rating span:before, a, .top-wishlist a, .pagination > li > a, .pagination > li > span, .navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus, .woocommerce .star-rating span, .navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .top-wishlist .fa',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.woocommerce button.button.alt.disabled, li.woocommerce-MyAccount-navigation-link.is-active, .services-icon, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled[disabled], .slider-menu-more, .twp-countdown, .header-search-form input#yith-searchsubmit, input#yith-searchsubmit, .top-grid-products .onsale, .custom-category .onsale, .slider-grid-img .onsale, input.wpcf7-submit, .widget_wysija_cont .wysija-submit, .woocommerce #respond input#submit.added:after, .woocommerce a.button.added:after, .woocommerce button.button.added:after, .woocommerce input.button.added:after, .woocommerce .button.loading:after, .woocommerce a.button, .yith-wcwl-add-button a, .header-cart-inner .fa-shopping-cart, .yith-wcwl-add-to-wishlist a, a.btn-primary.outline, .header-search-form button, .single-meta-date, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-product-search input[type="submit"], .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .top-area .onsale, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce ul.products li.product .button, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus, #back-top span, .navigation.pagination, .comment-reply-link, .comment-respond #submit, #searchform #searchsubmit, #wp-calendar #prev a, #wp-calendar #next a',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '.woocommerce .button:after, .yith-wcwl-add-button a:after, .header-cart-inner .fa-shopping-cart:after, .yith-wcwl-add-to-wishlist a:after, a.btn-primary.outline:after, blockquote, .comment-reply-link, .comment-respond #submit, #searchform #searchsubmit, #wp-calendar #prev a, #wp-calendar #next a, .related-header',
			'property'	 => 'border-color',
		),
		array(
			'element'	 => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active',
			'property'	 => 'border-bottom-color',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'hover_site_color',
	'label'		 => __( 'Hover color', 'kakina' ),
	'help'		 => __( 'Hover color for links, buttons, carts...', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#1500ff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'a:hover',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.header-search-form input#yith-searchsubmit:hover, .nav > li > a:hover, .nav > li > a:focus, .woocommerce a.added_to_cart:hover, .woocommerce-product-search input[type="submit"]:hover, #searchform #searchsubmit:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, .comment-reply-link:hover, .comment-respond #submit:hover',
			'property'	 => 'background-color',
		),
		array(
			'element'	 => '#searchform #searchsubmit:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, .comment-reply-link:hover, .comment-respond #submit:hover',
			'property'	 => 'border-color',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'body_color',
	'label'		 => __( 'Body color', 'kakina' ),
	'help'		 => __( 'Background color for pages and posts.', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#fff',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.dropdown-menu, .rsrc-container, .rsrc-header, .panel, .site-header-cart, .header-categories #collapseOne, #site-navigation, #yith-quick-view-modal .yith-wcqv-main',
			'property'	 => 'background-color',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'footer_color',
	'label'		 => __( 'Footer widgets color', 'kakina' ),
	'help'		 => __( 'Background color for footer widgets.', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#F1F1F1',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '#content-footer-section',
			'property'	 => 'background-color',
		),
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'custom',
	'settings'	 => 'typo_title',
	'label'		 => __( 'Typography and font colors', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '<div style="border-bottom: 1px solid #fff;"></div>',
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'typography',
	'settings'	 => 'site_title_typography_font',
	'label'		 => __( 'Site title font', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => array(
		'font-family'	 => 'Open Sans',
		'subsets'        => array( 'latin-ext' ),
		'font-size'		 => '36px',
		'variant'		 => '700',
		'line-height'	 => '1.1',
		'letter-spacing' => '0',
	),
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element' => '.rsrc-header-text .site-title a',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_title',
	'label'		 => __( 'Site title color', 'kakina' ),
	'help'		 => __( 'Site title text color, if not defined logo.', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#222',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.rsrc-header-text .site-title a',
			'property'	 => 'color',
			'units'		 => ' !important',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'typography',
	'settings'	 => 'description_typography_font',
	'label'		 => __( 'Site description font', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => array(
		'font-family'	 => 'Open Sans',
		'subsets'        => array( 'latin-ext' ),
		'font-size'		 => '14px',
		'variant'		 => '300',
		'line-height'	 => '1.5',
		'letter-spacing' => '0',
	),
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element' => '.rsrc-header-text h3, .rsrc-header-text h2',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_site_desc',
	'label'		 => __( 'Site description color', 'kakina' ),
	'help'		 => __( 'Site description text color, if not defined logo.', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#5D5D5D',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.rsrc-header-text h3, .rsrc-header-text h2',
			'property'	 => 'color',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'typography',
	'settings'	 => 'content_typography_font',
	'label'		 => __( 'Site content font', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => array(
		'font-family'	 => 'Open Sans',
		'subsets'        => array( 'latin-ext' ),
		'font-size'		 => '14px',
		'variant'		 => '300',
		'line-height'	 => '1.8',
		'letter-spacing' => '0',
	),
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element' => 'body, .home-header .page-header a, .page-header, .header-cart a, .entry-summary, .navbar-inverse .navbar-nav > li > a, .widget h3, .woocommerce div.product .woocommerce-tabs ul.tabs li a',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'color_content_text',
	'label'		 => __( 'Site content font color', 'kakina' ),
	'help'		 => __( 'Select the general text color used in the theme.', 'kakina' ),
	'section'	 => 'colors_section',
	'default'	 => '#636363',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => '.amount-cart, .dropdown-menu > li > a, .single-article h2.page-header a, .single-article-carousel h2.page-header a, .archive-article header a, .widget-menu a, body, .single-article h2.page-header a, .home-header .page-header a, .page-header, .header-cart a, .entry-summary, .navbar-inverse .navbar-nav > li > a, .widget h3, .header-cart, .header-login, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .social-links i.fa, .woocommerce ul.products li.product h3, .woocommerce ul.products li.product h2.woocommerce-loop-product__title, .woocommerce ul.products li.product h2.woocommerce-loop-category__title, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, legend',
			'property'	 => 'color',
		),
		array(
			'element'	 => '.social-links i.fa',
			'property'	 => 'border-color',
		),
	),
) );

if ( function_exists( 'YITH_WCWL' ) ) {
	Kirki::add_field( 'kakina_pro_settings', array(
		'type'			 => 'toggle',
		'settings'		 => 'wishlist-top-icon',
		'label'			 => __( 'Header Wishlist icon', 'kakina' ),
		'description'	 => __( 'Enable or disable heart icon with counter in header', 'kakina' ),
		'section'		 => 'woo_section',
		'default'		 => 0,
		'priority'		 => 10,
	) );
}
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'my-account-check',
	'label'			 => __( 'My Account/Login link', 'kakina' ),
	'description'	 => __( 'Enable or disable header My Account/Login/Register link', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'cart-top-icon',
	'label'			 => __( 'Header Cart', 'kakina' ),
	'description'	 => __( 'Enable or disable header cart', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'woo-breadcrumbs',
	'label'			 => __( 'Breadcrumbs', 'kakina' ),
	'description'	 => __( 'Enable or disable breadcrumbs on WooCommerce pages', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'woo_second_img',
	'label'			 => __( 'WooCommerce Product Image Flipper', 'kakina' ),
	'description'	 => __( 'Adds a secondary image on product archives that is revealed on hover. Perfect for displaying front/back shots of clothing and other products.', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 0,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'toggle',
	'settings'	 => 'woo_gallery_zoom',
	'label'		 => esc_attr__( 'Gallery zoom', 'kakina' ),
	'section'	 => 'woo_section',
	'default'	 => 0,
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'toggle',
	'settings'	 => 'woo_gallery_lightbox',
	'label'		 => esc_attr__( 'Gallery lightbox', 'kakina' ),
	'section'	 => 'woo_section',
	'default'	 => 1,
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'toggle',
	'settings'	 => 'woo_gallery_slider',
	'label'		 => esc_attr__( 'Gallery slider', 'kakina' ),
	'section'	 => 'woo_section',
	'default'	 => 0,
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'radio-buttonset',
	'settings'		 => 'buttons-styling',
	'label'			 => __( 'Buttons Styling', 'kakina' ),
	'description'	 => __( 'Select the products button styling', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 'default',
	'priority'		 => 10,
	'choices'		 => array(
		'default'	 => __( 'Default', 'kakina' ),
		'boxed'		 => __( 'Boxed', 'kakina' ),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'radio-buttonset',
	'settings'	 => 'products-hover-effect',
	'label'		 => __( 'Products Hover Effect', 'kakina' ),
	'section'	 => 'woo_section',
	'default'	 => 'none',
	'priority'	 => 10,
	'choices'	 => array(
		'none'	 => __( 'None', 'kakina' ),
		'shadow' => __( 'Shadow', 'kakina' ),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'toggle',
	'settings'		 => 'woo_sale_deal',
	'label'			 => __( 'Sale offer countdown', 'kakina' ),
	'description'	 => __( 'Enable or disable countdown for sale offer - globally.', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 1,
	'priority'		 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_products',
	'label'			 => __( 'Number of products', 'kakina' ),
	'description'	 => __( 'Change number of products displayed per page in archive(shop) page.', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 24,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 60,
		'step'	 => 1
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'slider',
	'settings'		 => 'archive_number_columns',
	'label'			 => __( 'Number of products per row', 'kakina' ),
	'description'	 => __( 'Change the number of product columns per row in archive(shop) page.', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 4,
	'priority'		 => 10,
	'choices'		 => array(
		'min'	 => 2,
		'max'	 => 5,
		'step'	 => 1
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'			 => 'radio-buttonset',
	'settings'		 => 'product-meta-styling',
	'label'			 => __( 'Product Meta', 'kakina' ),
	'description'	 => __( 'Select the products meta (SKU, Category, Tags) styling', 'kakina' ),
	'section'		 => 'woo_section',
	'default'		 => 'inline',
	'priority'		 => 10,
	'choices'		 => array(
		'inline' => __( 'Inline', 'kakina' ),
		'block'	 => __( 'Block', 'kakina' ),
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'color',
	'settings'	 => 'background_site_color',
	'label'		 => __( 'Background Color', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => '#FFFFFF',
	'transport'	 => 'auto',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-color',
		),
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'image',
	'settings'	 => 'background_site_image',
	'label'		 => __( 'Background Image', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => '',
	'priority'	 => 10,
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-image',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'select',
	'settings'	 => 'background_site_repeat',
	'label'		 => __( 'Background Repeat', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => 'no-repeat',
	'priority'	 => 10,
	'choices'	 => array(
		'no-repeat'	 => __( 'No Repeat', 'kakina' ),
		'repeat'	 => __( 'Repeat All', 'kakina' ),
		'repeat-x'	 => __( 'Repeat Horizontally', 'kakina' ),
		'repeat-y'	 => __( 'Repeat Vertically', 'kakina' ),
		'inherit'	 => __( 'Inherit', 'kakina' ),
	),
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-repeat',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'select',
	'settings'	 => 'background_site_size',
	'label'		 => __( 'Background Size', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => 'cover',
	'priority'	 => 10,
	'choices'	 => array(
		'inherit'	 => __( 'Inherit', 'kakina' ),
		'cover'		 => __( 'Cover', 'kakina' ),
		'contain'	 => __( 'Contain', 'kakina' ),
	),
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-size',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'select',
	'settings'	 => 'background_site_attach',
	'label'		 => __( 'Background Attachement', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => 'fixed',
	'priority'	 => 10,
	'choices'	 => array(
		'inherit'	 => __( 'Inherit', 'kakina' ),
		'fixed'		 => __( 'Fixed', 'kakina' ),
		'scroll'	 => __( 'Scroll', 'kakina' ),
	),
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-attachment',
		),
	),
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'select',
	'settings'	 => 'background_site_position',
	'label'		 => __( 'Background Position', 'kakina' ),
	'section'	 => 'site_bg_section',
	'default'	 => 'center-top',
	'priority'	 => 10,
	'choices'	 => array(
		'left-top'		 => __( 'Left Top', 'kakina' ),
		'left-center'	 => __( 'Left Center', 'kakina' ),
		'left-bottom'	 => __( 'Left Bottom', 'kakina' ),
		'right-top'		 => __( 'Right Top', 'kakina' ),
		'right-center'	 => __( 'Right Center', 'kakina' ),
		'right-bottom'	 => __( 'Right Bottom', 'kakina' ),
		'center-top'	 => __( 'Center Top', 'kakina' ),
		'center-center'	 => __( 'Center Center', 'kakina' ),
		'center-bottom'	 => __( 'Center Bottom', 'kakina' ),
	),
	'output'	 => array(
		array(
			'element'	 => 'body',
			'property'	 => 'background-position',
		),
	),
) );

Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'code',
	'settings'	 => 'google-analytics',
	'label'		 => __( 'Tracking Code', 'kakina' ),
	'help'		 => __( 'Paste your Google Analytics (or other) tracking code here.', 'kakina' ),
	'section'	 => 'code_section',
	'choices'	 => array(
		'label'		 => __( 'Tracking Code', 'kakina' ),
		'language'	 => 'html',
		'theme'		 => 'monokai',
		'height'	 => 200,
	),
	'default'	 => '',
	'priority'	 => 10,
) );
Kirki::add_field( 'kakina_pro_settings', array(
	'type'		 => 'code',
	'settings'	 => 'custom-css',
	'label'		 => __( 'Custom CSS', 'kakina' ),
	'help'		 => __( 'Paste your custom css.', 'kakina' ),
	'section'	 => 'code_section',
	'default'	 => '',
	'priority'	 => 10,
	'choices'	 => array(
		'label'		 => __( 'CSS Code', 'kakina' ),
		'language'	 => 'css',
		'theme'		 => 'monokai',
		'height'	 => 250,
	),
) );

function kakina_pro_configuration() {

	$config[ 'logo_image' ]		 = get_template_directory_uri() . '/img/site-logo.png';
	$config[ 'color_back' ]		 = '#192429';
	$config[ 'color_accent' ]	 = '#008ec2';
	$config[ 'width' ]			 = '25%';

	return $config;
}

add_filter( 'kirki/config', 'kakina_pro_configuration' );

/**
 * Add custom CSS styles
 */
function kakina_pro_enqueue_header_css() {

	$columns = get_theme_mod( 'archive_number_columns', 4 );

	if ( $columns == '2' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 48.05%}}';
	} elseif ( $columns == '3' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 30.75%;}}';
	} elseif ( $columns == '5' ) {
		$css = '@media only screen and (min-width: 769px) {.archive .rsrc-content .woocommerce ul.products li.product{width: 16.95%;}}';
	} else {
		$css = '';
	}
	$button = get_theme_mod( 'buttons-styling', 'default' );
	if ( $button == 'boxed' ) {
		$button_css = '.woocommerce a.button.alt, .woocommerce button.button.alt, .yith-wcwl-add-to-wishlist a, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .services-icon, .woocommerce a.button, .yith-wcwl-add-button a, .header-cart-inner .fa-shopping-cart, .yith-wcwl-add-to-wishlist a, a.btn-primary.outline,  .header-cart i.fa-shopping-cart {border-radius: 0 !important;}';
	} else {
		$button_css = '';
	}
	$hover_effect = get_theme_mod( 'products-hover-effect', 'none' );
	if ( $hover_effect == 'shadow' ) {
		$hover_effect_css = '
		.woocommerce ul.products li.product:hover, .slider-products:hover, .custom-category .img-thumbnail:hover, .single-article-inner:hover {
			-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
			box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
		}
		';
	} else {
		$hover_effect_css = '';
	}
	$prod_meta = get_theme_mod( 'product-meta-styling', 'inline' );
	if ( $prod_meta == 'block' ) {
		$prod_css = '.woocommerce .product_meta .sku_wrapper, .woocommerce .product_meta .posted_in, .woocommerce .product_meta .tagged_as {
						display: block;
						font-weight: bold;
						padding-bottom: 5px;
						border-bottom: 1px solid #D3D3D3;
					}
					.woocommerce .product_meta .sku_wrapper .sku, .woocommerce .product_meta .posted_in a, .woocommerce .product_meta .tagged_as a {
						font-weight: normal;
						margin-left: 5px;
					}
					.woocommerce .product_meta {
						margin-top: 10px;
					}';
	} else {
		$prod_css = '';
	}

	$custom_css = "
		{$css}
		{$button_css}
		{$hover_effect_css}
		{$prod_css}
	";
	wp_add_inline_style( 'kirki-styles-kakina_pro_settings', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'kakina_pro_enqueue_header_css', 9999 );

function kakina_pro_menu_list() {
	$menus			 = array();
	$menus[ 0 ]		 = __( 'Select Menu', 'kakina' );
	$menus_select	 = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
	foreach ( $menus_select as $menu ) {
		$menus[ $menu->term_id ] = $menu->name;
	}
	return $menus;
}
