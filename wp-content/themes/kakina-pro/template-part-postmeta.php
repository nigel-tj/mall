<p class="post-meta">
	<span class="fa fa-clock-o"></span><time class="posted-on published" datetime="<?php the_time( 'Y-m-d' ); ?>" itemprop="datePublished"><?php the_time( get_option( 'date_format' ) ); ?></time>
	<span class="fa fa-user"></span><span class="author-link" itemprop="author"><?php the_author_posts_link(); ?></span>
	<span class="fa fa-comment"></span><span class="comments-meta"><?php comments_popup_link( __( '0', 'kakina' ), __( '1', 'kakina' ), __( '%', 'kakina' ), 'comments-link', __( 'Off', 'kakina' ) ); ?></span>
	<span class="fa fa-folder-open"></span>
	<?php
	$categories	 = get_the_category();
	$separator	 = ', ';
	$output		 = '';
	if ( $categories ) {
		foreach ( $categories as $category ) {
			echo '<span class="cat-meta" itemprop="articleSection"><a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s', 'kakina' ), $category->name ) ) . '">' . $category->cat_name . '</a>' . $separator . '</span>';
		}
	}
	?>
	<?php edit_post_link( __( 'Edit', 'kakina' ), '<span class="fa fa-pencil-square"></span>', '' ); ?>
	<meta content="<?php the_modified_date('Y-m-d'); ?>" itemprop="dateModified"/>
	<?php kakina_pro_entry_publisher(); ?>
</p>