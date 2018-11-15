<?php
global $post;
$slider_on		 = get_post_meta( get_the_ID(), 'kakina_slider_on', true );
$banners_on		 = get_post_meta( get_the_ID(), 'kakina_banners_on', true );
$repeater_value	 = get_theme_mod( 'repeater_slider', array(
	array(
		'kakina_image_id'	 => get_template_directory_uri() . '/img/demo/slider1.jpg',
		'kakina_url'		 => '#',
	),
	array(
		'kakina_image_id'	 => get_template_directory_uri() . '/img/demo/slider2.jpg',
		'kakina_url'		 => '#',
	), ) );
if ( $slider_on == 'on' && get_theme_mod( 'shop-by-cat-menu', '' ) != '' || is_front_page() && get_theme_mod( 'demo_front_page', 1 ) == 1 && get_option( 'show_on_front' ) != 'page' && $repeater_value ) {
	$collapsed	 = 'true';
	$in			 = 'opened mobile-display in';
} else {
	$collapsed	 = 'false';
	$in			 = 'closed';
}
?>
<div class="header-line-search row">
	<div class="header-categories col-md-3">
		<div id="accordion" role="tablist" aria-multiselectable="true">
			<div role="tab" id="headingOne">
				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="<?php echo $collapsed; ?>" aria-controls="collapseOne">
					<h4 class="panel-title">
						<?php if ( get_theme_mod( 'kakina_pro_shop_by_text', 'Shop by category' ) != '' ) {
							echo get_theme_mod( 'kakina_pro_shop_by_text', 'Shop by category' );
						} ?>
					</h4>
				</a>
			</div>
			<div id="collapseOne" class="panel-collapse collapse <?php echo $in; ?> col-md-3" role="tabpanel" aria-labelledby="headingOne"> 
				<?php
				$args = array(
					'menu'			 => get_theme_mod( 'shop-by-cat-menu' ),
					'depth'			 => 3,
					'container'		 => false,
					'menu_class'	 => 'widget-menu',
					'fallback_cb'	 => '',
					'items_wrap'	 => '<ul id="%1$s" class="widget-menu cat-menu list-unstyled">%3$s</ul>',
					'walker'		 => new wp_bootstrap_navwalker()
				);
				wp_nav_menu( $args );
				?>
				<div class="slider-menu-more">  
					<a id="menu-more" href="#"><i class="fa fa-plus"></i><?php echo esc_attr( get_theme_mod( 'shop-by-cat-text', 'More Categories' ) ) ?></a>
					<a id="menu-less" href="#"><i class="fa fa-minus"></i><?php echo esc_attr( __( 'Close Menu', 'kakina' ) ); ?></a>
				</div> 
			</div>
		</div>
	</div>
	<?php
	if ( get_theme_mod( 'kakina_socials', 0 ) == 1 ) {
		$row = '5';
	} else {
		$row = '9';
	}
	?>
    <div class="header-search-form col-md-<?php echo $row; ?>">
		<?php if ( function_exists( 'yith_ajax_search_constructor' ) ) { ?> 
			<?php echo do_shortcode( '[yith_woocommerce_ajax_search]' ); ?>
		<?php } else { ?>
			<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<select class="col-xs-4" name="product_cat">
					<option value=""><?php echo esc_attr( __( 'All', 'kakina' ) ); ?></option> 
					<?php
					$categories = get_categories( 'taxonomy=product_cat' );
					foreach ( $categories as $category ) {
						$option = '<option value="' . $category->category_nicename . '">';
						$option .= $category->cat_name;
						$option .= ' (' . $category->category_count . ')';
						$option .= '</option>';
						echo $option;
					}
					?>
				</select>
				<input type="hidden" name="post_type" value="product" />
				<input class="col-xs-8" name="s" type="text" placeholder="<?php _e( 'Search for products', 'kakina' ); ?>"/>
				<button type="submit"><?php _e( 'Go', 'kakina' ); ?></button>
			</form>
		<?php } ?>
    </div>
	<?php if ( get_theme_mod( 'kakina_socials', 0 ) == 1 ) : ?>
		<div class="social-section col-md-4">
			<span class="social-section-title hidden-md">
			<?php
			if ( get_theme_mod( 'kakina_socials_text', 'Follow Us' ) != '' ) {
				echo get_theme_mod( 'kakina_socials_text', 'Follow Us' );
			}
			?>
			</span>
			<?php kakina_pro_social_links(); ?>              
		</div>
	<?php endif; ?> 
</div>