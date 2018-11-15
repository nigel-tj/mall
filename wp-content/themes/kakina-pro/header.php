<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head itemscope itemtype="http://schema.org/WebSite">
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta itemprop="name" content="<?php bloginfo( 'name' ); ?>" />
		<meta itemprop="url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<?php wp_head(); ?>
	</head>
	<body id="blog" <?php body_class(); ?> <?php kakina_pro_tag_schema(); ?>>

