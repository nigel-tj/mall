<?php

echo do_shortcode( '
[headings title="BROWSE OUR CATEGORIES" size="h3" type="dashed"][/headings]
[category-carousel columns="3"]
[headings title="FEATURED ITEMS" size="h3"][/headings]
[featured_products orderby="name" order="ASC" per_page="4" columns="4"]
[row]
[col size="6"]
[headings title="SALE PRODUCTS" size="h4" type="double"][/headings]
[sale_products orderby="name" order="ASC" per_page="2" columns="2"]
[/col]
[col size="6"]
[headings title="BLOG" size="h4" type="double"][/headings]
[posts-inline posts="3" excerpt="7"]
[/col]
[/row]
' );
?>
