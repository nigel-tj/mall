<?php
$terms	 = get_terms( 'product_cat' );
if ( $terms ) {
	// Random order.
	shuffle( $terms );
	// Get first $max items.
	$terms	 = array_slice( $terms, 0, 2 );
	foreach ( $terms as $term ) {
		$random_term[] = $term->term_id;
	}
	if ( ! empty( $random_term[ 1 ] ) ) {
		echo do_shortcode( '
			[row]
			[col size="6"]
			[custom-category category="' . $random_term[ 0 ] . '"]
			[/col]
			[col size="6"]
			[custom-category category="' . $random_term[ 1 ] . '"]
			[/col]
			[/row]
		' );
	}
	?>
	<h2 style="text-align: center"><span style="color: #808080">SALE!</span></h2>
	<?php
	echo do_shortcode( '
		[divider type="two"]
		[sale_products orderby="rand" order="ASC" per_page="8" columns="4"]
	' );
} else {
	esc_html_e( 'No product categories found', 'kakina' );
}
?>
