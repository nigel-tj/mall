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
		[custom-category category="' . $random_term[ 0 ] . '"]
		[row]
		[col size="6"]
		[image img="' . get_template_directory_uri() . '/template-parts/demo-img/banner2.jpg" animation="flash" url="#" size="h1"]
		[/col]
		[col size="6"]
		[image img="' . get_template_directory_uri() . '/template-parts/demo-img/banner1.jpg" animation="flash" url="#" size="h1"]
		[/col]
		[/row]
		[recent_products orderby="name" order="ASC" per_page="4" columns="4"]
		[headings title="FROM OUR BLOG" size="h3" type="dotted"][/headings]
		[posts-carousel columns="3" excerpt="25"]
	' );
} else {
	esc_html_e( 'No product categories found', 'kakina' );
}
?>
