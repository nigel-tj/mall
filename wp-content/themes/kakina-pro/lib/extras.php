<?php
/**
 *
 * Extra functions
 *
 */
add_filter( 'woocommerce_product_tabs', 'kakina_pro_woo_extra_tabs' );

function kakina_pro_woo_extra_tabs( $tabs ) {
	global $post;
	$custom_tabs = get_post_meta( get_the_ID(), 'kakina_custom_tabs', true );
	$i			 = 0;
	if ( !empty( $custom_tabs ) ) {
				foreach ( $custom_tabs as $tab ) {
			if ( isset( $tab[ 'kakina_title' ])) {
				$priority = $tab[ 'kakina_priority' ];
				if ( $priority == '' ) {
					$priority = ( 21 + $i );
				};
				$tabs[ 'custom_tab_' . $i ] = array(
					'title'		 => esc_attr( $tab[ 'kakina_title' ] ),
					'priority'	 => absint( $priority ),
					'callback'	 => 'kakina_pro_add_custom_panel_content',
					'custom_tab' => $tab[ 'kakina_desc' ]
				);
				$i++;
			}
		}
	}
	return $tabs;
}

function kakina_pro_add_custom_panel_content( $key, $tab ) {
	echo apply_filters( 'the_content', $tab[ 'custom_tab' ] );
}

function kakina_pro_custom_box_field() {
	$entries = get_post_meta( get_the_ID(), 'kakina_custom_boxes', true );
	if ( !empty( $entries ) ) {
		foreach ( (array) $entries as $key => $entry ) {
			if ( isset( $entry[ 'kakina_boxes_title' ] ) && !empty( $entry[ 'kakina_boxes_title' ] ) && isset( $entry[ 'kakina_boxes_desc' ] ) && !empty( $entry[ 'kakina_boxes_desc' ] ) ) {
				?>    
			<div class="custom-box" data-toggle="popover" title='<?php echo esc_attr( $entry[ 'kakina_boxes_title' ] ) ?>' data-content='<?php echo wp_kses_post( $entry[ 'kakina_boxes_desc' ] ) ?>'>                              
					<?php if ( isset( $entry[ 'kakina_boxes_icon' ] ) && !empty( $entry[ 'kakina_boxes_icon' ] ) ) { ?>
						<i class="fa <?php echo esc_attr( $entry[ 'kakina_boxes_icon' ] ) ?>"></i>
					<?php } ?>
					<?php echo esc_html( $entry[ 'kakina_boxes_title' ] ) ?>                           
				</div>
				<?php
			}
		}
	}
}

add_action( 'woocommerce_after_add_to_cart_button', 'kakina_pro_custom_box_field', 9 );

////////////////////////////////////////////////////////////////////
// Google Analytics Tracking Code
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'kakina_pro_google' ) ) {

	function kakina_pro_google() {

		if ( get_theme_mod( 'google-analytics', '' ) == '' ) {
			return false;
		}

		echo stripslashes( get_theme_mod( 'google-analytics' ) );
	}

}

add_action( 'wp_footer', 'kakina_pro_google' );

////////////////////////////////////////////////////////////////////
// Custom CSS
////////////////////////////////////////////////////////////////////
if ( !function_exists( 'kakina_pro_custom_css' ) ) {

	function kakina_pro_custom_css() {

		$kakina_pro_custom_css = get_theme_mod( 'custom-css', '' );
		if ( !empty( $kakina_pro_custom_css ) ) {
			echo '<!-- ' . get_bloginfo( 'name' ) . ' Custom Styles -->';
			?><style type="text/css"><?php echo $kakina_pro_custom_css; ?></style><?php
		}
	}

}
add_action( 'wp_head', 'kakina_pro_custom_css' );

////////////////////////////////////////////////////////////////////
// Offer price
////////////////////////////////////////////////////////////////////
if ( class_exists( 'WooCommerce' ) && get_theme_mod( 'woo_sale_deal', 1 ) == 1 ) {
	add_filter( 'woocommerce_get_price_html', 'kakina_pro_custom_price_html', 100, 2 );

	function kakina_pro_custom_price_html( $price, $product ) {
		global $post;
		$sales_price_to		 = get_post_meta( $post->ID, '_sale_price_dates_to', true );
		$sales_price_from	 = get_post_meta( $post->ID, '_sale_price_dates_from', true );
		$todaysDate			 = strtotime( date( 'Y-m-d' ) );
		if ( is_single() && $sales_price_to != "" && $sales_price_from <= $todaysDate ) {
			$sales_price_date_to = date( "j M y", $sales_price_to );
			$sale_offer			 = '<br/ >' . esc_html__( 'Offer till ', 'kakina' ) . $sales_price_date_to;
			return $price . $sale_offer;
		} else {
			return apply_filters( 'woocommerce_get_price', $price );
		}
	}

	add_filter( 'woocommerce_after_shop_loop_item', 'kakina_pro_custom_price_archive', 20 );

	function kakina_pro_custom_price_archive() {
		global $post;
		$sales_price_to		 = get_post_meta( $post->ID, '_sale_price_dates_to', true );
		$sales_price_from	 = get_post_meta( $post->ID, '_sale_price_dates_from', true );
		$todaysDate			 = strtotime( date( 'Y-m-d' ) );
		if ( $sales_price_to != "" && $sales_price_from <= $todaysDate ) {
			$sales_price_date_to = date( 'M j Y', $sales_price_to );
			$counter			 = '<div class="twp-countdown" countdown data-date="' . $sales_price_date_to . '">';
			$counter .= '<span data-days>0</span>' . esc_html__( 'days', 'kakina' ) . '';
			$counter .= '<span data-hours>0</span>' . esc_html__( 'hours', 'kakina' ) . '';
			$counter .= '<span data-minutes>0</span>' . esc_html__( 'minutes', 'kakina' ) . '';
			$counter .= '<span data-seconds>0</span>' . esc_html__( 'seconds', 'kakina' ) . '';
			$counter .= '</div>';
			echo $counter;
		}
	}

}

////////////////////////////////////////////////////////////////////
// Shortcodes empyt paragraph fix
////////////////////////////////////////////////////////////////////
function kakina_pro_shortcode_empty_paragraph_fix( $content ) {
	$array = array(
		'<p>['		 => '[',
		']</p>'		 => ']',
		']<br />'	 => ']'
	);

	$content = strtr( $content, $array );
	return $content;
}

add_filter( 'the_content', 'kakina_pro_shortcode_empty_paragraph_fix' );


