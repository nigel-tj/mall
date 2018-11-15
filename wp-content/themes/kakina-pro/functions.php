<?php
////////////////////////////////////////////////////////////////////
// Settig Theme-options
////////////////////////////////////////////////////////////////////
include_once( trailingslashit( get_template_directory() ) . 'lib/plugin-activation.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/theme-config.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/metaboxes.php' );
require_once( trailingslashit( get_template_directory() ) . 'lib/shortcodes.php' );
include_once( trailingslashit( get_template_directory() ) . 'lib/update-notifier.php' ); // theme update notifier
require_once( trailingslashit( get_template_directory() ) . 'lib/extras.php' ); // pro features
include_once( trailingslashit( get_template_directory() ) . 'lib/include-kirki.php' );

add_action( 'after_setup_theme', 'kakina_pro_setup' );

if ( !function_exists( 'kakina_pro_setup' ) ) :

	function kakina_pro_setup() {
		// Theme lang
		load_theme_textdomain( 'kakina', get_template_directory() . '/languages' );

		// Add Title Tag Support
		add_theme_support( 'title-tag' );

		// Register Menus
		register_nav_menus(
		array(
			'main_menu'		 => __( 'Main Menu', 'kakina' ),
			'footer_menu'	 => __( 'Footer Menu', 'kakina' ),
		)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'kakina-single', 688, 325, true );
		add_image_size( 'kakina-slider', 855, 450, true );
		add_image_size( 'kakina-category', 600, 600, true );
		add_image_size( 'kakina-widget', 60, 60, true );
		add_image_size( 'kakina-carousel', 267, 411, true );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'woocommerce' );
		if ( get_theme_mod( 'woo_gallery_zoom', 0 ) == 1 ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		if ( get_theme_mod( 'woo_gallery_lightbox', 1 ) == 1 ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
		if ( get_theme_mod( 'woo_gallery_slider', 0 ) == 1 ) {
			add_theme_support( 'wc-product-gallery-slider' );
		}
	}

endif;

////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
function kakina_pro_theme_stylesheets() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.4', 'all' );
	wp_enqueue_style( 'kakina-stylesheet', get_stylesheet_uri(), array(), '1.8.0', 'all' );
	// load Font Awesome css
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0' );
	wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '2.6.3' );
}

add_action( 'wp_enqueue_scripts', 'kakina_pro_theme_stylesheets' );

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
function kakina_pro_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ), '3.3.4', true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.6.3', true );
	wp_enqueue_script( 'kakina-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery', 'flexslider' ), '1.8.0', true );
	wp_localize_script( 'kakina-theme-js', 'objectL10n', array(
		'compare' => esc_html__( 'Compare Product', 'kakina' ),
	) );
	if ( get_theme_mod( 'menu-sticky', 0 ) != 0 && has_nav_menu( 'main_menu' ) ) {
		wp_enqueue_script( 'menu-sticky', get_template_directory_uri() . '/js/sticky-menu.js', array( 'jquery' ), '1', true );
	}
	wp_enqueue_script( 'kakina-store-countdown', get_template_directory_uri() . '/js/countdown.min.js', array( 'jquery' ), '1', true );
}

add_action( 'wp_enqueue_scripts', 'kakina_pro_theme_js' );

////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

require_once(trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php');

////////////////////////////////////////////////////////////////////
// Register Widgets
////////////////////////////////////////////////////////////////////

require_once(trailingslashit( get_template_directory() ) . 'lib/widgets.php');

////////////////////////////////////////////////////////////////////
// Register Widgets
////////////////////////////////////////////////////////////////////

add_action( 'widgets_init', 'kakina_pro_widgets_init' );

function kakina_pro_widgets_init() {
	register_sidebar(
	array(
		'name'			 => __( 'Homepage Sidebar', 'kakina' ),
		'id'			 => 'kakina-home-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Right Sidebar', 'kakina' ),
		'id'			 => 'kakina-right-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_sidebar(
	array(
		'name'			 => __( 'Left Sidebar', 'kakina' ),
		'id'			 => 'kakina-left-sidebar',
		'before_widget'	 => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	 => '</aside>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );
	register_sidebar(
	array(
		'name'			 => __( 'Footer Section', 'kakina' ),
		'id'			 => 'kakina-footer-area',
		'description'	 => __( 'Content Footer Section', 'kakina' ),
		'before_widget'	 => '<div id="%1$s" class="widget %2$s col-md-' . absint( get_theme_mod( 'footer-sidebar-size', 3 ) ) . '">',
		'after_widget'	 => '</div>',
		'before_title'	 => '<h3 class="widget-title">',
		'after_title'	 => '</h3>',
	) );

	register_widget( 'kakina_pro_posts_widget' );
	register_widget( 'Bootstrap_Collapse_Menu' );
}

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'kakina_pro_main_content_width_hook', 'kakina_pro_main_content_width_columns' );

function kakina_pro_main_content_width_columns() {

	$columns = '12';

	if ( get_theme_mod( 'rigth-sidebar-check', 1 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'right-sidebar-size', 3 ) );
	}

	if ( get_theme_mod( 'left-sidebar-check', 0 ) != 0 ) {
		$columns = $columns - absint( get_theme_mod( 'left-sidebar-size', 3 ) );
	}
	echo $columns;
}

function kakina_pro_main_content_width() {
	do_action( 'kakina_pro_main_content_width_hook' );
}

////////////////////////////////////////////////////////////////////
// Theme Info page
////////////////////////////////////////////////////////////////////

if ( is_admin() && !is_child_theme() ) {
	require_once( trailingslashit( get_template_directory() ) . 'lib/welcome/welcome-screen.php' );
}

////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

function kakina_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kakina_pro_content_width', 1170 );
}
add_action( 'after_setup_theme', 'kakina_pro_content_width', 0 );

////////////////////////////////////////////////////////////////////
// Schema.org microdata
////////////////////////////////////////////////////////////////////
function kakina_pro_tag_schema() {
	$schema = 'http://schema.org/';

	// Is single post

	if ( is_single() ) {
		$type = 'WebPage';
	}
	// Is author page
	elseif ( is_author() ) {
		$type = 'ProfilePage';
	}

	// Is search results page
	elseif ( is_search() ) {
		$type = 'SearchResultsPage';
	} else {
		$type = 'WebPage';
	}

	echo 'itemscope itemtype="' . $schema . $type . '"';
}

if ( !function_exists( 'kakina_pro_breadcrumb' ) ) :

////////////////////////////////////////////////////////////////////
// Breadcrumbs
////////////////////////////////////////////////////////////////////
	function kakina_pro_breadcrumb() {
		global $post, $wp_query;

		// schema link

		$schema_link = 'http://data-vocabulary.org/Breadcrumb';
		$home		 = esc_html__( 'Home', 'kakina' );
		$delimiter	 = ' &raquo; ';
		$homeLink	 = home_url();
		if ( is_home() || is_front_page() ) {

			// no need for breadcrumbs in homepage
		} else {
			echo '<div id="breadcrumbs" >';
			echo '<div class="breadcrumbs-inner text-right">';

			// main breadcrumbs lead to homepage

			echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $homeLink ) . '">' . '<i class="fa fa-home"></i><span itemprop="title">' . $home . '</span>' . '</a></span>' . $delimiter . ' ';

			// if blog page exists

			if ( 'page' == get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '">' . '<span itemprop="title">' . esc_html__( 'Blog', 'kakina' ) . '</span></a></span>' . $delimiter . ' ';
			}

			if ( is_category() ) {
				$thisCat = get_category( get_query_var( 'cat' ), false );
				if ( $thisCat->parent != 0 ) {
					$category_link = get_category_link( $thisCat->parent );
					echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . get_cat_name( $thisCat->parent ) . '</span>' . '</a></span>' . $delimiter . ' ';
				}

				$category_id	 = get_cat_ID( single_cat_title( '', false ) );
				$category_link	 = get_category_link( $category_id );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $category_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type	 = get_post_type_object( get_post_type() );
					$link		 = get_post_type_archive_link( get_post_type() );
					if ( $link ) {
						printf( '<span><a href="%s">%s</a></span>', esc_url( $link ), $post_type->labels->name );
						echo ' ' . $delimiter . ' ';
					}
					echo get_the_title();
				} else {
					$category = get_the_category();
					if ( $category ) {
						foreach ( $category as $cat ) {
							echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . '<span itemprop="title">' . $cat->name . '</span>' . '</a></span>' . $delimiter . ' ';
						}
					}

					echo get_the_title();
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() && !is_search() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $post_type->labels->singular_name;
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $parent ) ) . '">' . '<span itemprop="title">' . $parent->post_title . '</span>' . '</a></span>';
				echo ' ' . $delimiter . ' ' . get_the_title();
			} elseif ( is_page() && !$post->post_parent ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . get_the_title() . '</span>' . '</a></span>';
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id	 = $post->post_parent;
				$breadcrumbs = array();
				while ( $parent_id ) {
					$page			 = get_post( $parent_id );
					$breadcrumbs[]	 = '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink( $page->ID ) ) . '">' . '<span itemprop="title">' . get_the_title( $page->ID ) . '</span>' . '</a></span>';
					$parent_id		 = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				for ( $i = 0; $i < count( $breadcrumbs ); $i++ ) {
					echo $breadcrumbs[ $i ];
					if ( $i != count( $breadcrumbs ) - 1 )
						echo ' ' . $delimiter . ' ';
				}

				echo $delimiter . '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_permalink() ) . '">' . '<span itemprop="title">' . the_title_attribute( 'echo=0' ) . '</span>' . '</a></span>';
			}
			elseif ( is_tag() ) {
				$tag_id = get_term_by( 'name', single_cat_title( '', false ), 'post_tag' );
				if ( $tag_id ) {
					$tag_link = get_tag_link( $tag_id->term_id );
				}

				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( $tag_link ) . '">' . '<span itemprop="title">' . single_cat_title( '', false ) . '</span>' . '</a></span>';
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata( $author );
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_author_posts_url( $userdata->ID ) ) . '">' . '<span itemprop="title">' . $userdata->display_name . '</span>' . '</a></span>';
			} elseif ( is_404() ) {
				echo esc_html__( 'Error 404', 'kakina' );
			} elseif ( is_search() ) {
				echo esc_html__( 'Search results for', 'kakina' ) . ' ' . get_search_query();
			} elseif ( is_day() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'd' ) . '</span>' . '</a></span>';
			} elseif ( is_month() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>' . $delimiter . ' ';
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'F' ) . '</span>' . '</a></span>';
			} elseif ( is_year() ) {
				echo '<span itemscope itemtype="' . esc_url( $schema_link ) . '"><a itemprop="url" href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . '<span itemprop="title">' . get_the_time( 'Y' ) . '</span>' . '</a></span>';
			}

			if ( get_query_var( 'paged' ) ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ' (';
				echo esc_html__( 'Page', 'kakina' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
					echo ')';
			}

			echo '</div></div>';
		}
	}

endif;

////////////////////////////////////////////////////////////////////
// Social links
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'kakina_pro_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function kakina_pro_social_links() {
		$twp_social_links	 = array(
			'twp_social_facebook'	 => 'facebook',
			'twp_social_twitter'	 => 'twitter',
			'twp_social_google'		 => 'google-plus',
			'twp_social_instagram'	 => 'instagram',
			'twp_social_pin'		 => 'pinterest',
			'twp_social_youtube'	 => 'youtube',
			'twp_social_reddit'		 => 'reddit',
			'twp_social_linkedin'	 => 'linkedin',
			'twp_social_skype'		 => 'skype',
			'twp_social_vimeo'		 => 'vimeo',
			'twp_social_flickr'		 => 'flickr',
			'twp_social_dribble'	 => 'dribbble',
			'twp_social_envelope-o'	 => 'envelope-o',
			'twp_social_rss'		 => 'rss',
		);
		?>
		<div class="social-links">
			<ul>
				<?php
				$i					 = 0;
				$twp_links_output	 = '';
				foreach ( $twp_social_links as $key => $value ) {
					$link = get_theme_mod( $key, '' );
					if ( !empty( $link ) ) {

						$twp_links_output .=
						'<li><a href="' . esc_url( $link ) . '" target="_blank"><i class="fa fa-' . strtolower( $value ) . '"></i></a></li>';
					}
					$i++;
				}
				echo $twp_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;

////////////////////////////////////////////////////////////////////
// WooCommerce section
////////////////////////////////////////////////////////////////////
if ( class_exists( 'WooCommerce' ) ) {

////////////////////////////////////////////////////////////////////
// WooCommerce header cart
////////////////////////////////////////////////////////////////////
	if ( !function_exists( 'kakina_pro_cart_link' ) ) {

		function kakina_pro_cart_link() {
			?>	
			<a class="cart-contents text-right" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'kakina' ); ?>">
				<i class="fa fa-shopping-cart"><span class="count"><?php echo absint( WC()->cart->get_cart_contents_count() ); ?></span></i><div class="amount-title hidden-xs"><?php echo esc_html_e( 'Cart ', 'kakina' ); ?></div><div class="amount-cart hidden-xs"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div> 
			</a>
			<?php
		}

	}
	if ( !function_exists( 'kakina_pro_head_wishlist' ) ) {

		function kakina_pro_head_wishlist() {
			if ( function_exists( 'YITH_WCWL' ) ) {
				$wishlist_url = YITH_WCWL()->get_wishlist_url();
				?>
				<div class="top-wishlist text-right">
					<a href="<?php echo esc_url( $wishlist_url ); ?>" title="<?php esc_attr_e( 'Wishlist', 'kakina' ); ?>" data-toggle="tooltip">
						<div class="fa fa-heart"><div class="count"><span><?php echo absint( yith_wcwl_count_products() ); ?></span></div></div>
					</a>
				</div>
				<?php
			}
		}

	}
	add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'kakina_pro_head_wishlist' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'kakina_pro_head_wishlist' );

	if ( !function_exists( 'kakina_pro_header_cart' ) ) {

		function kakina_pro_header_cart() {
			?>
			<div class="header-cart text-right col-md-3 col-sm-6 col-md-push-6">
					<?php if ( get_theme_mod( 'cart-top-icon', 1 ) != 0 ) { ?>
					<div class="header-cart-inner">
				<?php kakina_pro_cart_link(); ?>
						<ul class="site-header-cart menu list-unstyled hidden-xs">
							<li>
								<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
							</li>
						</ul>
					</div>
				<?php } ?>
				<?php
				if ( get_theme_mod( 'wishlist-top-icon', 0 ) != 0 ) {
					kakina_pro_head_wishlist();
				}
				?>
			</div>
			<?php
		}

	}
	if ( !function_exists( 'kakina_pro_header_add_to_cart_fragment' ) ) {
		add_filter( 'woocommerce_add_to_cart_fragments', 'kakina_pro_header_add_to_cart_fragment' );

		function kakina_pro_header_add_to_cart_fragment( $fragments ) {
			ob_start();

			kakina_pro_cart_link();

			$fragments[ 'a.cart-contents' ] = ob_get_clean();

			return $fragments;
		}

	}
////////////////////////////////////////////////////////////////////
// Change number of products displayed per page
////////////////////////////////////////////////////////////////////  
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . absint( get_theme_mod( 'archive_number_products', 24 ) ) . ';' ), 20 );
////////////////////////////////////////////////////////////////////
// Change number of products per row
////////////////////////////////////////////////////////////////////
	add_filter( 'loop_shop_columns', 'kakina_pro_loop_columns' );
	if ( !function_exists( 'kakina_pro_loop_columns' ) ) {

		function kakina_pro_loop_columns() {
			return absint( get_theme_mod( 'archive_number_columns', 4 ) );
		}

	}

////////////////////////////////////////////////////////////////////
// Archive product wishlist button
////////////////////////////////////////////////////////////////////  
	function kakina_pro_wishlist_products() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			global $product;
			$url			 = add_query_arg( 'add_to_wishlist', $product->get_id() );
			$id				 = $product->get_id();
			$wishlist_url	 = YITH_WCWL()->get_wishlist_url();
			?>  
			<div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
				<div class="yith-wcwl-add-button show" style="display:block"> <a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php esc_attr_e( 'Add to Wishlist', 'kakina' ); ?>" class="add_to_wishlist"></a><img src="<?php echo get_template_directory_uri() . '/img/loading.gif'; ?>" class="ajax-loading" alt="loading" width="16" height="16"></div>
				<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <span class="feedback"><?php esc_html_e( 'Added!', 'kakina' ); ?></span> <a href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'View Wishlist', 'kakina' ); ?></a></div>
				<div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none"> <span class="feedback"><?php esc_html_e( 'The product is already in the wishlist!', 'kakina' ); ?></span> <a href="<?php echo esc_url( $wishlist_url ); ?>"><?php esc_html_e( 'Browse Wishlist', 'kakina' ); ?></a></div>
				<div class="clear"></div>
				<div class="yith-wcwl-wishlistaddresponse"></div>
			</div>
			<?php
		}
	}

	add_action( 'woocommerce_after_shop_loop_item', 'kakina_pro_wishlist_products', 20 );

////////////////////////////////////////////////////////////////////
// Secondary image hover function
////////////////////////////////////////////////////////////////////  
	if ( get_theme_mod( 'woo_second_img', 0 ) != 0 ) {
		add_action( 'woocommerce_before_shop_loop_item_title', 'kakina_pro_template_loop_second_product_thumbnail', 11 );
		add_filter( 'post_class', 'kakina_pro_product_has_gallery' );

		// Add kakina-has-gallery class to products that have a gallery
		function kakina_pro_product_has_gallery( $classes ) {
			global $product;
			$post_type = get_post_type( get_the_ID() );
			if ( !is_admin() ) {
				if ( $post_type == 'product' ) {
					if (function_exists('get_gallery_image_ids')) { // WC3 backward compatibility - will be removed in the future
						$attachment_ids = $product->get_gallery_image_ids();
					} else {
						$attachment_ids = $product->get_gallery_attachment_ids();	
					}
					if ( $attachment_ids ) {
						$classes[] = 'kakina-has-gallery';
					}
				}
			}
			return $classes;
		}

		// Display the second thumbnails
		function kakina_pro_template_loop_second_product_thumbnail() {
			global $product, $woocommerce;
			if (function_exists('get_gallery_image_ids')) { // WC3 backward compatibility - will be removed in the future
				$attachment_ids = $product->get_gallery_image_ids();
			} else {
				$attachment_ids = $product->get_gallery_attachment_ids();	
			}
			if ( $attachment_ids ) {
				$secondary_image_id	 = $attachment_ids[ '0' ];
				echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'secondary-image attachment-shop-catalog' ) );
			}
		}

	}
	function kakina_pro_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => ' &raquo; ',
				'wrap_before' => '<div id="breadcrumbs" ><div class="breadcrumbs-inner text-right">',
				'wrap_after'  => '</div></div>',
				'before'      => '',
				'after'       => '',
				'home'        => esc_html_x( 'Home', 'woocommerce breadcrumb', 'kakina' ),
			);
	}
	
	add_filter( 'woocommerce_breadcrumb_defaults', 'kakina_pro_woocommerce_breadcrumbs' );
}
////////////////////////////////////////////////////////////////////
// WooCommerce end
////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////
// Schema publisher function
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'kakina_pro_entry_publisher' ) ) {
	function kakina_pro_entry_publisher() {
		$image_id = attachment_url_to_postid( get_theme_mod( 'header-logo' ) );
		$img	 = wp_get_attachment_image_src( $image_id, 'full' );
		// Uncomment your choice below.
		$publisher = 'https://schema.org/Organization';
		//$publisher = 'https://schema.org/Person';
		$publisher_name =  get_bloginfo( 'name', 'display' );
		$logo = get_theme_mod( 'header-logo' ); 
		$logo_width = $img[ 1 ]; 
		$logo_height = $img[ 2 ]; 
		
		if ( ! isset( $publisher ) || ! isset( $logo ) || ! isset( $publisher_name ) ) {
			return;
		}
		printf( '<div itemprop="publisher" itemscope itemtype="%s">', esc_url( $publisher ) );
			echo '<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">';
				printf( '<meta itemprop="url" content="%s">', esc_url( $logo ) );
				printf( '<meta itemprop="width" content="%d">', esc_attr( $logo_width ) );
				printf( '<meta itemprop="height" content="%d">', esc_attr( $logo_height ) );
			echo '</div>';
			printf( '<meta itemprop="name" content="%s">', esc_attr( $publisher_name ) );
		echo '</div>';
	}
}