<?php 
$terms	 = get_terms( 'product_cat' );
if ( $terms ) {
	// Random order.
	shuffle( $terms );
	// Get first $max items.
	$terms	 = array_slice( $terms, 0, 1 );
	foreach ( $terms as $term ) {
		$random_term[] = $term->term_id;
	}
	echo do_shortcode( '
		[headings title="NEW ARRIVALS" size="h2" type="double"][/headings]
		[product-carousel per_page="8" columns="4"]
		[row]
		[col size="3"][image img="' . get_template_directory_uri() . '/template-parts/demo-img/left-banner.jpg" animation="zoomin" ][/col]
		[col size="6"][image img="' . get_template_directory_uri() . '/template-parts/demo-img/top-banner.jpg" animation="zoomout" ][image img="' . get_template_directory_uri() . '/template-parts/demo-img/bottom-banner.jpg" animation="zoomout" title="NEW STUFF" size="h2" color="#000"][/col]
		[col size="3"][image img="' . get_template_directory_uri() . '/template-parts/demo-img/banner-right.jpg" animation="flash"][/col]
		[/row]
	' ); ?>
	<h2 style="text-align: center;">BEST SELLING</h2>
	<?php echo do_shortcode( '
		[divider type="two"]
		[best_selling_products orderby="name" order="ASC" per_page="4" columns="4"]
		[row]
		[col size="6"]
		[headings title="FEATURED CATEGORY" size="h3" type="double"][/headings]
		[custom-category category="' . $random_term[ 0 ] . '"]
		[/col]
		[col size="6"]
		[headings title="BLOG" size="h3" type="double"][/headings]
		[posts-carousel columns="2" excerpt="20"]
		[/col]
		[/row]
	' ); 
} else {
	esc_html_e( 'No product categories found', 'kakina' );
}	
?>
