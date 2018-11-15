<article class="archive-article col-md-6" itemscope itemtype="http://schema.org/BlogPosting">
	<link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />
	<div <?php post_class(); ?>>                            
		<?php if ( has_post_thumbnail() ) : ?>                               
			<div class="featured-thumbnail" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
				<?php the_post_thumbnail( 'kakina-single', array( 'itemprop' => 'Url' ) ); ?>
				<?php 
				$sizes = get_post_thumbnail_id( $post->ID );
				$img = wp_get_attachment_image_src( $sizes, 'kakina-single' );
				$width = $img[1];
				$height = $img[2]; 
				?>
				<meta itemprop="width" content="<?php echo absint( $width ); ?> " />
				<meta itemprop="height" content="<?php echo absint( $height ); ?> " />
			</div>                                                                                 
		<?php endif; ?>
		<header>
			<h2 class="page-header" itemprop="headline">                                
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'kakina' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>                            
			</h2>
			<?php get_template_part( 'template-part', 'postmeta' ); ?>
		</header>  
		<div class="home-header text-center">                                                      
			<div class="entry-summary" itemprop="text">
				<?php $content = get_the_content(); echo wp_trim_words( strip_shortcodes( $content ), '40', $more	 = '...' ); ?> 
			</div><!-- .entry-summary -->                                                                                                                       
			<div class="clear"></div>                                  
			<p>                                      
				<a class="btn btn-primary btn-md outline" href="<?php the_permalink(); ?>" itemprop="interactionCount">
					<?php _e( 'Read more', 'kakina' ); ?> 
				</a>                                  
			</p>                            
		</div>                      
	</div>
	<div class="clear"></div>
</article>