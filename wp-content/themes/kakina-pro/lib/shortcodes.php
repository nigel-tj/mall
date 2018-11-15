<?php
/*
  |----------------------------------------------------------
  | Sample output
  |----------------------------------------------------------
 */
add_shortcode( 'sample', 'twp_pro_sample_shortcode' );

function twp_pro_sample_shortcode( $atts, $content = null ) {
	return '<samp>' . $content . '</samp>';
}

add_shortcode( 'sample-demo', 'twp_pro_sample_demo_shortcode' );

function twp_pro_sample_demo_shortcode( $atts ) {
	return '<samp>[sample]Hello World[/sample]</samp>';
}

/*
  |----------------------------------------------------------
  | Clear
  |----------------------------------------------------------
 */
add_shortcode( 'clear', 'twp_pro_clear_shortcode' );

function twp_pro_clear_shortcode( $atts, $content = null ) {
	return '<div class="clear"></div>';
}

/*
  |----------------------------------------------------------
  | User input
  |----------------------------------------------------------
 */
add_shortcode( 'kbd', 'twp_pro_kbd_shortcode' );

function twp_pro_kbd_shortcode( $atts, $content = null ) {
	return '<kbd>' . $content . '</kbd>';
}

/*
  |----------------------------------------------------------
  | Abbreviations
  |----------------------------------------------------------
 */
add_shortcode( 'abbr', 'twp_pro_abbr_shortcode' );

function twp_pro_abbr_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => '',
	), $atts, 'abbr' ) );

	return '<abbr title="' . $title . '">' . do_shortcode( $content ) . '</abbr>';
}

/*
  |----------------------------------------------------------
  | Alignment
  |----------------------------------------------------------
 */
add_shortcode( 'align', 'twp_pro_align_shortcode' );

function twp_pro_align_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'dir' => '',
	), $atts, 'align' ) );

	return '<div class="text-' . $dir . '">' . do_shortcode( $content ) . '</div>';
}

/*
  |----------------------------------------------------------
  | Tooltips
  |----------------------------------------------------------
 */
add_shortcode( 'tooltip', 'twp_pro_tooltip_shortcode' );

function twp_pro_tooltip_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title'		 => '',
		'placement'	 => 'top'
	), $atts, 'tooltip' ) );

	return '<span class="twp-tooltip" data-toggle="tooltip" data-placement="' . $placement . '" title="' . $title . '">' . do_shortcode( $content ) . '</span>';
}

/*
  |----------------------------------------------------------
  | Media object
  |----------------------------------------------------------
 */
add_shortcode( 'media', 'twp_pro_media_shortcode' );

function twp_pro_media_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'img'	 => '',
		'title'	 => '',
		'align'	 => 'pull-left',
		'url'	 => '#',
	), $atts, 'media' ) );
	if ( $align == 'text-center' ) {
		return '<div class="' . $align . '"><a href="' . $url . '"><img class="' . $align . '" src="' . $img . '"></a>' . ($title != '' ? '<h3>' . $title . '</h3>' : '') . do_shortcode( $content ) . '</div>';
	} else {
		return '<div class="media"><a class="' . $align . '" href="' . $url . '"><img class="media-object" src="' . $img . '"></a><div class="media-body">' . ($title != '' ? '<h4 class="media-heading">' . $title . '</h4>' : '') . do_shortcode( $content ) . '</div></div>';
	}
}

/*
  |----------------------------------------------------------
  | Image hover
  |----------------------------------------------------------
 */
add_shortcode( 'image', 'twp_pro_image_shortcode' );

function twp_pro_image_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'img'		 => '',
		'title'		 => '',
		'animation'	 => 'pull-left',
		'url'		 => '#',
		'size'		 => 'h2',
		'color'		 => '#fff',
	), $atts, 'image' ) );

	return '<div class="twp-image ' . $animation . '"><a href="' . esc_url( $url ) . '"><img src="' . esc_url( $img ) . '" class="img-thumbnail" alt="' . esc_attr( $title ) . '">' . ($title != '' ? '<' . $size . ' class="img-heading" style="color: ' . $color . '">' . esc_attr( $title ) . '</' . $size . '>' : '') . '</a></div>';
}

/*
  |----------------------------------------------------------
  | Progress bars
  |----------------------------------------------------------
 */
add_shortcode( 'progress-bar', 'twp_pro_progress_bar_shortcode' );

function twp_pro_progress_bar_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'value'	 => 50,
		'label'	 => 'true',
		'type'	 => ''
	), $atts, 'progress-bar' ) );

	if ( $value == 0 || $value < 10 ) {
		$width = 'min-width: 20px;';
	} else {
		$width = 'width: ' . $value . '%;';
	}

	return '<div class="progress">
        <div class="progress-bar ' . ($type != '' ? 'progress-bar-' . $type : '') . '" role="progressbar" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax=100" style="' . $width . '">
            ' . (($label == 'true') ? $value . '%' : '<span class="sr-only">' . $value . '%</span>') . '
        </div>
    </div>';
}

/*
  |----------------------------------------------------------
  | Well
  |----------------------------------------------------------
 */
add_shortcode( 'well', 'twp_pro_well_shortcode' );

function twp_pro_well_shortcode( $atts, $content = null ) {
	return '<div class="well">' . do_shortcode( $content ) . '</div>';
}

/*
  |----------------------------------------------------------
  | Divider
  |----------------------------------------------------------
 */
add_shortcode( 'divider', 'twp_pro_divider_shortcode' );

function twp_pro_divider_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'one'
	), $atts, 'divider' ) );

	return '<div class="divider di-' . $type . '"></div>';
}

/*
  |----------------------------------------------------------
  | Heading
  |----------------------------------------------------------
 */
add_shortcode( 'headings', 'twp_pro_headings_shortcode' );

function twp_pro_headings_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size'	 => 'h2',
		'title'	 => '',
		'type'	 => ''
	), $atts, 'headings' ) );

	return '<' . $size . ' class="divider-title ti-' . $type . '">' . esc_html( $title ) . '</' . $size . '>';
}

/*
  |----------------------------------------------------------
  | Labels & Badgets
  |----------------------------------------------------------
 */
add_shortcode( 'label', 'twp_pro_label_shortcode' );

function twp_pro_label_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'default'
	), $atts, 'label' ) );

	return '<span class="label label-' . $type . '">' . $content . '</span>';
}

add_shortcode( 'badge', 'twp_pro_badge_shortcode' );

function twp_pro_badge_shortcode( $atts, $content = null ) {
	return '<span class="badge">' . $content . '</span>';
}

/*
  |----------------------------------------------------------
  | Alerts
  |----------------------------------------------------------
 */
add_shortcode( 'alert', 'twp_pro_alert_shortcode' );

function twp_pro_alert_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'info'
	), $atts, 'alert' ) );

	return '<div class="alert alert-' . $type . '">' . do_shortcode( $content ) . '</div>';
}

/*
  |----------------------------------------------------------
  | Icons
  |----------------------------------------------------------
 */
add_shortcode( 'icon', 'twp_pro_icon_shortcode' );

function twp_pro_icon_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'family'	 => 'fa', // fa, octicon, glyphicon
		'name'		 => 'question-circle',
		'additional' => ''
	), $atts, 'icon' ) );

	switch ( $family ) {

		case 'fa':
			return '<i class="fa ' . esc_attr( $name ) . ' ' . esc_attr( $additional ) . '"></i>';

		case 'octicon':
			return '<span class="octicon octicon-' . esc_attr( $name ) . ' ' . esc_attr( $additional ) . '"></span>';

		case 'glyphicon':
			return '<span class="glyphicon glyphicon-' . esc_attr( $name ) . ' ' . esc_attr( $additional ) . '"></span>';

		default:
			return '<i class="fa fa-question-circle"></i>';
	}
}

/*
  |----------------------------------------------------------
  | Buttons
  |----------------------------------------------------------
 */
add_shortcode( 'button', 'twp_pro_button_shortcode' );

function twp_pro_button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'url'	 => '#',
		'type'	 => 'default',
		'size'	 => '',
		'icon'	 => ''
	), $atts, 'button' ) );
	if ( $icon ) {
		return '<a href="' . esc_url( $url ) . '" class="btn btn-' . esc_attr( $type ) . ' ' . (($size != '') ? 'btn-' . esc_attr( $size ) : '') . '"><i class="fa ' . esc_attr( $icon ) . '"></i>' . esc_html( $content ) . '</a>';
	} else {
		return '<a href="' . esc_url( $url ) . '" class="btn btn-' . esc_attr( $type ) . ' ' . (($size != '') ? 'btn-' . esc_attr( $size ) : '') . '">' . esc_html( $content ) . '</a>';
	}
}

/*
  |----------------------------------------------------------
  | Grid
  |----------------------------------------------------------
 */
add_shortcode( 'row', 'twp_pro_row_shortcode' );

function twp_pro_row_shortcode( $atts, $content = null ) {
	return '<div class="row">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'col', 'twp_pro_col_shortcode' );

function twp_pro_col_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'size' => 12
	), $atts, 'col' ) );

	if ( $size < 1 ) {
		$size = 1;
	} elseif ( $size > 12 ) {
		$size = 12;
	}

	return '<div class="col-md-' . $size . '">' . do_shortcode( $content ) . '</div>';
}

/*
  |----------------------------------------------------------
  | Recent Posts
  |----------------------------------------------------------
 */
add_shortcode( 'recent-posts', 'twp_pro_recent_posts_shortcode' );

function twp_pro_recent_posts_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'category'	 => '',
		'posts'		 => '6',
		'columns'	 => '3',
		'excerpt'	 => '20',
	), $atts, 'recent-posts' ) );
	if ( $columns > 6 ) {
		$columns = 6;
	}
	$size			 = 12 / $columns;
	global $post;
	$return_string	 = '<div class="row">';
	$the_query		 = new WP_Query( array( 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => absint( $posts ), 'cat' => $category ) );
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$return_string .= '<div class="single-article col-md-' . $size . ' text-center"><div class="single-article-inner">';
			if ( has_post_thumbnail() ) {
				$return_string .= '<a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'kakina-single' ) . '</a>';
				$return_string .= '<div class="single-meta-date">';
				$return_string .= '<div class="day">' . get_the_time( 'd' ) . '</div>';
				$return_string .= '<div class="month">' . get_the_time( 'M' ) . '</div>';
				$return_string .= '</div>';
			}
			$return_string .= '<h2 class="page-header" itemprop="headline"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			$return_string .= '<div class="entry-summary" itemprop="text">';
			if ( $excerpt > 0 ) {
				$return_string .= wp_trim_words( strip_shortcodes( get_the_content() ), $excerpt, $more = '&hellip;' );
			}
			$return_string .= '</div>';
			$return_string .= '<a class="btn btn-primary btn-md outline" href="' . get_the_permalink() . '" itemprop="interactionCount">' . esc_html__( 'Read more', 'kakina' ) . '</a>';
			$return_string .= '<div class="meta-bottom author-link text-center" itemprop="author">' . get_the_author_posts_link() . '</div>';
			$return_string .= '</div></div>';

		endwhile;
	endif;
	$return_string .= '</div>';
	$return_string .= '<div class="clear"></div>';
	return $return_string;
	wp_reset_postdata();
}

/*
  |----------------------------------------------------------
  | Recent Posts inline
  |----------------------------------------------------------
 */
add_shortcode( 'posts-inline', 'twp_pro_posts_inline_shortcode' );

function twp_pro_posts_inline_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'category'	 => '',
		'posts'		 => '4',
		'excerpt'	 => '25',
	), $atts, 'posts-inline' ) );
	global $post;
	$return_string	 = '<div class="posts-inline">';
	$the_query		 = new WP_Query( array( 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => absint( $posts ), 'cat' => $category ) );
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
			$return_string .= '<div class="single-article single-alt"><div class="single-article-inner">';
			if ( has_post_thumbnail() ) {
				$return_string .= '<div class="single-meta-date">';
				$return_string .= '<div class="day">' . get_the_time( 'd' ) . '</div>';
				$return_string .= '<div class="month">' . get_the_time( 'M' ) . '</div>';
				$return_string .= '</div>';
				$return_string .= '<div class="single-thumbnail"><a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, array( 70, 70 ) ) . '</a></div>';
			}
			$return_string .= '<h2 class="page-header" itemprop="headline"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			$return_string .= '<div class="entry-summary" itemprop="text">';
			if ( $excerpt > 0 ) {
				$return_string .= wp_trim_words( strip_shortcodes( get_the_content() ), $excerpt, $more = '...' );
			}
			$return_string .= '</div>';
			$return_string .= '</div></div>';

		endwhile;
	endif;
	$return_string .= '</div>';
	$return_string .= '<div class="clear"></div>';
	return $return_string;
	wp_reset_postdata();
}

/*
  |----------------------------------------------------------
  | Check if WooComemrce exists - WooCommerce functions
  |----------------------------------------------------------
 */
if ( class_exists( 'WooCommerce' ) ) {
	/*
	  |----------------------------------------------------------
	  | Recent Posts Carousel
	  |----------------------------------------------------------
	 */
	add_shortcode( 'posts-carousel', 'twp_pro_posts_carousel_shortcode' );

	function twp_pro_posts_carousel_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'category'	 => '',
			'posts'		 => '6',
			'columns'	 => '3',
			'excerpt'	 => '25',
		), $atts, 'posts-carousel' ) );
		if ( $columns > 6 ) {
			$columns = 6;
		}
		$size			 = 12 / $columns;
		$id				 = mt_rand( 1, 9999 );
		global $post;
		$return_string	 = '<div id="carousel-' . $id . '" class="flexslider row recent-carousel carousel-row loading-hide" data-columns="' . $columns . '" data-container="' . $id . '"><ul class="products">';
		$the_query		 = new WP_Query( array( 'orderby' => 'date', 'order' => 'DESC', 'posts_per_page' => $posts, 'cat' => $category ) );
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$return_string .= '<li class="single-article-carousel col-md-' . $size . ' text-center"><div class="single-article-inner">';
				if ( has_post_thumbnail() ) {
					$return_string .= '<a href="' . get_the_permalink() . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, 'kakina-single' ) . '</a>';
					$return_string .= '<div class="single-meta-date">';
					$return_string .= '<div class="day">' . get_the_time( 'd' ) . '</div>';
					$return_string .= '<div class="month">' . get_the_time( 'M' ) . '</div>';
					$return_string .= '</div>';
				}
				$return_string .= '<h2 class="page-header" itemprop="headline"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				$return_string .= '<div class="entry-summary" itemprop="text">';
				if ( $excerpt > 0 ) {
					$return_string .= wp_trim_words( strip_shortcodes( get_the_content() ), $excerpt, $more = '...' );
				}
				$return_string .= '</div>';
				$return_string .= '<a class="btn btn-primary btn-md outline" href="' . get_the_permalink() . '" itemprop="interactionCount">' . esc_html__( 'Read more', 'kakina' ) . '</a>';
				$return_string .= '<div class="meta-bottom author-link text-center" itemprop="author">' . get_the_author_posts_link() . '</div>';
				$return_string .= '</div></li>';

			endwhile;
		endif;
		$return_string .= '</ul></div>';
		return $return_string;
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | WooCommerce product carousel
	  |----------------------------------------------------------
	 */
	add_shortcode( 'product-carousel', 'twp_pro_product_carousel_shortcode' );

	function twp_pro_product_carousel_shortcode( $atts, $content = null ) {
		global $woocommerce_loop;
		extract( shortcode_atts( array(
			'category'	 => '',
			'order'		 => 'ASC', // ASC* / DESC
			'orderby'	 => 'date', // date* / title / ID / rand
			'tax'		 => 'product_cat',
			'per_page'	 => '6',
			'columns'	 => '3',
		), $atts, 'product-carousel' ) );
		if ( empty( $category ) ) {
			$terms		 = get_terms( 'product_cat', array( 'hide_empty' => '', 'fields' => 'ids' ) );
			$category	 = implode( ',', $terms );
		}
		$category = explode( ',', $category );
		if ( empty( $category ) ) {
			return '';
		}
		$id			 = mt_rand( 1, 9999 );
		ob_start();
		// setup query
		$args		 = array(
			'post_type'				 => 'product',
			'post_status'			 => 'publish',
			'ignore_sticky_posts'	 => 1,
			'posts_per_page'		 => $per_page,
			'order'					 => $order,
			'orderby'				 => $orderby,
			'tax_query'				 => array(
				array(
					'taxonomy'	 => $tax,
					'field'		 => 'id',
					'terms'		 => $category,
				)
			),
			'meta_query'			 => array(
				array(
					'key'		 => '_visibility',
					'value'		 => array( 'catalog', 'visible' ),
					'compare'	 => 'IN'
				),
			)
		);
		// query database
		$products	 = new WP_Query( $args );
		if ( $products->have_posts() ) :
			?>
			<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>


				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
		endif;


		return '<div id="carousel-' . $id . '" class="flexslider woocommerce carousel-row loading-hide" data-columns="' . $columns . '" data-container="' . $id . '">' . ob_get_clean() . '</div>';
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | WooCommerce custom products carousel
	  |----------------------------------------------------------
	 */
	add_shortcode( 'custom-products-carousel', 'twp_pro_custom_products_carousel_shortcode' );

	function twp_pro_custom_products_carousel_shortcode( $atts, $content = null ) {
		global $woocommerce_loop;
		extract( shortcode_atts( array(
			'ids'		 => '',
			'order'		 => 'ASC', // ASC* / DESC
			'orderby'	 => 'date', // date* / title / ID / rand / none
			'columns'	 => '3',
		), $atts, 'custom-products-carousel' ) );

		$ids = explode( ',', $ids );
		if ( empty( $ids ) ) {
			return;
		}
		$id			 = mt_rand( 1, 9999 );
		ob_start();
		// setup query
		$args		 = array(
			'post_type'				 => 'product',
			'post_status'			 => 'publish',
			'ignore_sticky_posts'	 => 1,
			'posts_per_page'		 => 30,
			'order'					 => $order,
			'orderby'				 => $orderby,
			'post__in'				 => $ids,
		);
		// query database
		$products	 = new WP_Query( $args );
		if ( $products->have_posts() ) :
			?>
			<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>


				<?php woocommerce_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
		endif;


		return '<div id="carousel-' . $id . '" class="flexslider woocommerce carousel-row loading-hide" data-columns="' . $columns . '" data-container="' . $id . '">' . ob_get_clean() . '</div>';
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | WooCommerce category carousel
	  |----------------------------------------------------------
	 */
	add_shortcode( 'category-carousel', 'twp_pro_category_carousel_shortcode' );

	function twp_pro_category_carousel_shortcode( $atts, $content = null ) {
		global $woocommerce_loop;
		extract( shortcode_atts( array(
			'orderby'		 => 'name', // id / count / name* / slug / term_group / none
			'order'			 => 'ASC', // ASC* / DESC
			'hide_empty'	 => 1, // 1* / 0
			'include'		 => '',
			'columns'		 => '3',
			'exclude'		 => '', // An array of term ids to exclude. Also accepts a string of comma-separated ids
			'exclude_tree'	 => '', // An array of parent term ids to exclude 
			'per_page'		 => '', // The maximum number of terms to return. Default is to return them all.
			'slug'			 => '', // Returns terms whose "slug" matches this value. Default is empty string.
			'parent'		 => '', // Get direct children of this term (only terms whose explicit parent is this value). If 0 is passed, only top-level terms are returned. Default is an empty string.
			'child_of'		 => 0, // Get all descendents of this term. (as many levels as are available) 
			'childless'		 => false, // Returns terms that have no children if taxonomy is hierarchical, all terms if taxonomy is not hierarchical  	
		), $atts, 'category-carousel' ) );
		$id			 = mt_rand( 1, 9999 );
		ob_start();
		$terms_args	 = array(
			'orderby'		 => $orderby,
			'order'			 => $order,
			'hide_empty'	 => $hide_empty,
			'include'		 => $include,
			'exclude'		 => $exclude,
			'exclude_tree'	 => $exclude_tree,
			'number'		 => $per_page,
			'slug'			 => $slug,
			'parent'		 => $parent,
			'child_of'		 => $child_of,
			'childless'		 => $childless,
		);
		$terms		 = get_terms( 'product_cat', $terms_args );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			echo '<ul class="products">';
			foreach ( $terms as $term ) {
				$term_id	 = $term->term_id; // Term ID
				$term_slug	 = $term->slug; // Term slug
				$term_name	 = $term->name; // Term name
				$term_desc	 = $term->description; // Term description
				$term_count	 = $term->count; // Term count
				$term_link	 = get_term_link( $term->slug, $term->taxonomy ); // Term link
				$thumb_id	 = get_term_meta( $term_id, 'thumbnail_id', true );
				$term_img	 = wp_get_attachment_image( $thumb_id, 'kakina-category' );
				// Start the template for each term
				echo '<li id="term-' . $term_slug . '" class="product-category product term-' . $term_id . '">';
				echo '<a href="' . esc_url( $term_link ) . '" title="' . $term_name . '">';
				if ( $term_img )
					echo $term_img;
				else
					echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="600px" height="600px" />';
				echo '<h3 class="term-title">' . $term_name . '</h3>';
				echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">' . $term_count . __( ' Products', 'kakina' ) . '</mark>', $term );
				echo '</a>';
				echo '</li>';
			} // END: foreach ($terms as $term)
			echo '</ul>';
		}// END: if $terms


		return '<div id="carousel-' . $id . '" class="flexslider woocommerce carousel-row loading-hide" data-columns="' . $columns . '" data-container="' . $id . '">' . ob_get_clean() . '</div>';
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | Category products
	  |----------------------------------------------------------
	 */
	add_shortcode( 'custom-category', 'twp_pro_custom_category_shortcode' );

	function twp_pro_custom_category_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'category'		 => '',
			'cat_excerpt'	 => '200',
			'button_text'	 => 'Shop Now &raquo;',
		), $atts, 'custom-category' ) );
		$term = get_term_by( 'id', $category, 'product_cat' );
		if ( empty( $term ) ) { //check if category exists
			return;
		}
		$term_name		 = $term->name;
		$term_id		 = $term->term_id;
		$term_slug		 = $term->slug;
		$desc			 = $term->description;
		$category_link	 = get_term_link( $term );
		$thumb_id		 = get_term_meta( $term_id, 'thumbnail_id', true );
		$term_img		 = wp_get_attachment_image( $thumb_id, 'kakina-category' );
		global $post;
		ob_start();
		?>
		<div class="cat-grid-cat col-sm-8">
			<div class="cat-grid-img img-thumbnail">
				<?php
				if ( $term_img )
					echo $term_img;
				else
					echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="740px" height="740px" />';
				?>
			</div>
			<div class="cat-grid-heading">
				<h2>
					<?php echo esc_html( $term_name ); ?>
				</h2>
				<p>
					<?php if ( $desc ) echo substr( $desc, 0, $cat_excerpt ), '&hellip;'; ?>
				</p>
			</div>
		</div>
		<div class="top-grid-products col-sm-4">
			<ul class="products list-unstyled">
				<?php
				$args			 = array( 'post_type' => 'product', 'posts_per_page' => 2, 'product_cat' => $term_slug );
				$loop			 = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
					global $product;
					?>
					<li class="product-cats img-thumbnail">    
						<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php the_title_attribute(); ?>">
							<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
							<div class="top-grid-img">  
								<?php
								if ( has_post_thumbnail( $loop->post->ID ) )
									echo get_the_post_thumbnail( $loop->post->ID, 'kakina-category' );
								else
									echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="350px" height="350px" />';
								?>
							</div>
							<div class="top-grid-heading">
								<h2><?php the_title(); ?></h2>
								<span class="price"><?php echo $product->get_price_html(); ?></span>
							</div>                    
						</a>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul><!--/.products-->
			<div class="cat-meta"> 
				<div class="cat-count">
					<?php echo $term->count . ' items' ?>
				</div>
				<a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
			</div> 
		</div>    
		<div class="clear"></div>
		<?php
		return '<div class="custom-category row">' . ob_get_clean() . '</div>';
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | Product slider
	  |----------------------------------------------------------
	 */
	add_shortcode( 'product-slider', 'twp_pro_product_slider_shortcode' );

	function twp_pro_product_slider_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'category'	 => '',
			'per_page'	 => '6',
			'tax'		 => 'product_cat',
		), $atts, 'product-slider' ) );
		global $post;
		if ( empty( $category ) ) {
			$terms		 = get_terms( 'product_cat', array( 'hide_empty' => '', 'fields' => 'ids' ) );
			$category	 = implode( ',', $terms );
		}
		$category = explode( ',', $category );
		if ( empty( $category ) ) {
			return;
		}
		ob_start();
		$id		 = mt_rand( 1, 9999 );

		$args	 = array(
			'post_type'		 => 'product',
			'posts_per_page' => $per_page,
			'tax_query'		 => array(
				array(
					'taxonomy'	 => $tax,
					'field'		 => 'id',
					'terms'		 => $category,
				)
			),
			'meta_query'	 => array(
				array(
					'key'		 => '_visibility',
					'value'		 => array( 'catalog', 'visible' ),
					'compare'	 => 'IN'
				),
			)
		);
		$loop	 = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			global $product;
			?>
			<li>
				<div class="slider-products list-unstyled">
					<div class="slider-img col-sm-4">    
						<a href="<?php echo the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<div class="slider-grid-img">
								<?php woocommerce_show_product_sale_flash( $post, $product ); ?>
								<?php
								if ( has_post_thumbnail() )
									echo the_post_thumbnail( 'kakina-category' );
								else
									echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="350px" height="350px" />';
								?>
							</div>                   
						</a>
					</div>
					<div class="slider-product-heading col-sm-8">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<span class="price"><?php echo $product->get_price_html(); ?></span>
							<?php echo $product->get_rating_html(); ?>
						<div class="product-excerpt">
							<?php
							$content = get_the_content();
							echo wp_trim_words( strip_shortcodes( $content ), '20', $more	 = '...' );
							?>
						</div>                                     
						<?php echo do_shortcode( '[add_to_cart id=' . $loop->post->ID . ']' ) ?>                              
					</div></div>
			</li><!--/.products-->    
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>

		<?php
		return '<div id="single-slider-' . $id . '" class="flexslider product-slider loading-hide" data-container="' . $id . '"><ul class="slides">' . ob_get_clean() . '</ul> </div>';
		wp_reset_postdata();
	}

	/*
	  |----------------------------------------------------------
	  | Category products carousel
	  |----------------------------------------------------------
	 */
	add_shortcode( 'custom-category-carousel', 'twp_pro_custom_category_carousel_shortcode' );

	function twp_pro_custom_category_carousel_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'category'		 => '',
			'per_page'		 => '6',
			'button_text'	 => 'Shop Now &raquo;',
		), $atts, 'custom-category-carousel' ) );
		$term			 = get_term_by( 'id', $category, 'product_cat' );
		if ( empty( $term ) ) { //check if category exists
			return;
		}
		$term_name		 = $term->name;
		$term_id		 = $term->term_id;
		$term_slug		 = $term->slug;
		$category_link	 = get_term_link( $term );
		$thumb_id		 = get_term_meta( $term_id, 'thumbnail_id', true );
		$term_img		 = wp_get_attachment_image( $thumb_id, 'kakina-carousel' );
		global $post;
		$id				 = mt_rand( 9999, 99999 );
		ob_start();
		?>
		<div class="custom-carousel-cat woocommerce col-sm-3 col-xs-6">
			<div class="img-thumbnail img-custom-cat">
				<?php
				if ( $term_img )
					echo $term_img;
				else
					echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="260px" height="332px" />';
				?>
				<div class="custom-carousel-heading">
					<h2>
						<?php echo esc_attr( $term_name ); ?>
					</h2>
					<a class="button" href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
				</div>
			</div>

		</div>
		<div id="carousel-<?php echo $id; ?>" class="flexslider woocommerce carousel-row loading-hide col-sm-9 col-xs-6" data-columns="3" data-container="<?php echo $id; ?>">
			<?php
			$args			 = array( 'post_type' => 'product', 'posts_per_page' => $per_page, 'product_cat' => $term_slug );
			$loop			 = new WP_Query( $args );
			if ( $loop->have_posts() ) :
				?>
				<?php woocommerce_product_loop_start(); ?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop.   ?>

			<?php woocommerce_product_loop_end(); ?>

		<?php
		endif;
		wp_reset_postdata();
		?>

		</div>    
		<?php
		return '<div class="custom-category-carousel">' . ob_get_clean() . '</div><div class="clear"></div>';
		wp_reset_postdata();
	}
}
