<?php
/**
 *
 * Template name: FullWidth page
 * The template for displaying fullwidth page.
 *
 * @package kakina
 */
get_header();
?>

<?php get_template_part( 'template-part', 'head' ); ?>

<!-- start content container -->
<div class="row rsrc-content">      
	<article class="col-md-12 rsrc-main" itemscope itemtype="http://schema.org/BlogPosting">        
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>         
				<?php kakina_pro_breadcrumb(); ?>         
				<?php if ( has_post_thumbnail() ) : ?>                                
					<div class="single-thumbnail"><?php the_post_thumbnail( 'kakina-single', array( 'itemprop' => 'image' ) ); ?></div>                                     
					<div class="clear">
					</div>                            
				<?php endif; ?>          
				<div <?php post_class( 'rsrc-post-content' ); ?>>                            
					<header>                              
						<h1 class="entry-title page-header" itemprop="headline">
							<?php the_title(); ?>
						</h1>                                                        
					</header>                            
					<div class="entry-content" itemprop="articleBody">                              
						<?php the_content(); ?>                            
					</div>                               
					<?php wp_link_pages(); ?>                                                                                  
					<?php comments_template(); ?>                         
				</div>        
			<?php endwhile; ?>        
		<?php else: ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article>    
</div>
<!-- end content container -->
<?php get_footer(); ?>
