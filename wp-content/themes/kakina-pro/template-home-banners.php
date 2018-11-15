<?php
/**
 *
 * Template name: Homepage with banners
 * The template for displaying homepage.
 *
 * @package kakina
 */
get_header();
?>

<?php get_template_part( 'template-part', 'head' ); ?>

<!-- start content container -->
<div class="row rsrc-content"> 
	<?php
	global $post;
	$sidebar	 = get_post_meta( $post->ID, 'kakina_sidebar_position', true );
	$section_on	 = get_post_meta( get_the_ID(), 'kakina_banners_on', true );
	$services_on = get_post_meta( get_the_ID(), 'kakina_services_on', true );
	if ( $sidebar == 'left' ) {
		$columns = (12 - get_theme_mod( 'left-sidebar-size', 3 ));
	} elseif ( $sidebar == 'right' ) {
		$columns = (12 - get_theme_mod( 'right-sidebar-size', 3 ));
	} else {
		$columns = '12';
	}
	?>        
	<?php if ( $section_on == 'on' && class_exists( 'WooCommerce' ) ) { ?>
		<?php get_template_part( 'template-part', 'home-banners' ); ?>
	<?php } ?>
	<?php if ( $services_on == 'on' && class_exists( 'WooCommerce' ) ) { ?>
		<?php get_template_part( 'template-part', 'home-services' ); ?>
	<?php } ?> 
	<?php if ( $sidebar == 'left' ) get_sidebar( 'home' ); ?>   
	<div class="col-md-<?php echo $columns; ?> rsrc-main">        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                           
			<div <?php post_class( 'rsrc-post-content' ); ?>>                                                      
				<div class="entry-content">                           
					<?php the_content(); ?>                            
				</div>                                                       
			</div>        
			<?php endwhile; ?>        
		<?php else: ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</div>
	<?php //get the right sidebar ?>    
	<?php if ( $sidebar == 'right' ) get_sidebar( 'home-right' ); ?>  
</div>
<!-- end content container -->
<?php get_footer(); ?>