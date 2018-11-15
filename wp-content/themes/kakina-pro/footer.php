<?php if ( is_active_sidebar( 'kakina-footer-area' ) ) { ?>
	<div id="content-footer-section" class="row clearfix">
		<?php dynamic_sidebar( 'kakina-footer-area' ) ?>
	</div>
<?php } ?>    
<footer id="colophon" class="rsrc-footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
	<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
	    <div class="rsrc-footer-menu row" >
	        <nav id="footer-navigation" class="navbar navbar-inverse" role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">

				<div class="navbar-footer">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-2-collapse">
						<span class="sr-only"><?php _e( 'Toggle navigation', 'kakina' ); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<?php
				wp_nav_menu( array(
					'theme_location'	 => 'footer_menu',
					'depth'				 => 1,
					'container'			 => 'div',
					'container_class'	 => 'collapse navbar-collapse navbar-2-collapse',
					'menu_class'		 => 'nav navbar-nav menu-center',
					'fallback_cb'		 => 'wp_bootstrap_navwalker::fallback',
					'walker'			 => new wp_bootstrap_navwalker() )
				);
				?>
	        </nav>
	    </div>
	<?php endif; ?>
	
	<?php if ( get_theme_mod( 'footer-credits', '' ) != '' ) : ?>
		<div class="row rsrc-author-credits">
			<p class="text-center"><?php echo get_theme_mod( 'footer-credits' ); ?> </p>
		</div>
	<?php else : ?>
		<div class="row rsrc-author-credits">
			<p class="text-center"><?php printf( __( 'Copyright &copy; %1$s | kakina by %2$s', 'kakina' ), date( "Y" ), '<a href="' . esc_url( 'http://themes4wp.com' ) . '">Themes4WP</a>' ); ?></p>
		</div>
	<?php endif; ?>
</footer>
<div id="back-top">
	<a href="#top"><span></span></a>
</div>
</div>
<!-- end main container -->

<?php wp_footer(); ?>
</body>
</html>