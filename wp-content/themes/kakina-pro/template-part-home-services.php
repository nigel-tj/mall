<div id="services" class="services-area row">       
    <ul class="services">
		<?php
		$entries = get_post_meta( get_the_ID(), 'kakina_home_services', true );
		$columns = get_post_meta( get_the_ID(), 'kakina_services_columns', true );
		$i		 = 1;
		foreach ( (array) $entries as $key => $entry ) {
			$img	 = $title	 = $desc	 = $icon	 = $url	 = '';
			if ( isset( $entry[ 'kakina_title_services' ] ) )
				$title	 = esc_html( $entry[ 'kakina_title_services' ] );
			if ( isset( $entry[ 'kakina_desc_services' ] ) )
				$desc	 = wpautop( $entry[ 'kakina_desc_services' ] );
			if ( isset( $entry[ 'kakina_services_icon' ] ) )
				$icon	 = esc_html( $entry[ 'kakina_services_icon' ] );
			if ( isset( $entry[ 'kakina_url_services' ] ) )
				$url	 = esc_url( $entry[ 'kakina_url_services' ] );
			if ( isset( $entry[ 'kakina_services_color' ] ) )
				$color	 = esc_url( $entry[ 'kakina_services_color' ] );
			if ( isset( $entry[ 'kakina_image_services' ] ) ) {
				$img = esc_url( $entry[ 'kakina_image_services' ] );
			}
			?>
			<li class="homepage-services-<?php echo $i; ?> col-md-<?php echo $columns; ?>" style="background-image: url(<?php echo $img; ?>); color: <?php echo $color; ?>;"> 
				<div class="services-caption">
					<?php if ( $icon != '' ) { ?>		
						<div class="services-icon "><i class="fa <?php echo $icon; ?>"></i></div>
					<?php } ?>
					<div class="services-content">
						<?php if ( $title != '' ) { ?>		
							<h2 class="services-title">
								<?php if ( $url != '' ) { ?> 
									<a href="<?php echo $url; ?>" style="color: <?php echo $color; ?>;"><?php echo $title; ?></a>
								<?php } else { ?>        
									<?php echo $title; ?>
								<?php } ?>     
							</h2>
						<?php } ?>	
						<?php if ( $desc != '' ) { ?> 
							<div class="services-description">
								<?php echo $desc; ?>       
							</div>
						<?php } ?> 
					</div>    
				</div>                         
			</li> 
			<?php $i++ ?>  
		<?php } ?> 
    </ul>  
</div>
