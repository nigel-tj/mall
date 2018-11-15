<?php

/****************************************************************************************/

/**
 * Highlighted Posts widget
 */
class kakina_pro_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_posts', 'description' => __( 'Display latest posts or posts of specific category.', 'kakina') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'kakina Posts', 'kakina' ),$widget_ops);
   }

   function form( $instance ) {
      $tw_defaults['title'] = '';
      $tw_defaults['number'] = 4;
      $tw_defaults['type'] = 'latest';
      $tw_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tw_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'kakina' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'kakina' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p>
        <input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'kakina' );?><br />
        <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'kakina' );?><br />
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'kakina' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
      }
      else {
         $get_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
      }
      echo $before_widget;
      ?>
      <?php
         if ( !empty( $title ) ) { echo '<h3 class="mag-title" >'. esc_html( $title ) .'</h3>'; } ?>
         
      <div class="widget_post_area">

         <?php global $post; while( $get_posts->have_posts() ):$get_posts->the_post();?>
            <div class="single-article single-alt">
               <article> 
                <div <?php post_class(); ?>>                            
                    <div class="single-article-inner">
                      <?php if ( has_post_thumbnail() ) { ?>
                        <div class="single-meta-date">
                    			<div class="day"><?php the_time('d')?></div>
                    			<div class="month"><?php the_time('M')?></div>
                  			</div>
                  			<div class="single-thumbnail"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('kakina-widget') ?></a></div>
                  			<?php } ?>
                        <div class="page-header"><a href="<?php the_permalink()?>"><?php the_title()?></a></div>                                                      
                      </div>                     
                </div>
                </article>
            </div>
         <?php
         endwhile;
         // Reset Post Data
         wp_reset_query();
         ?>
      </div>
      <?php echo $after_widget;
      }
}


class Bootstrap_Collapse_Menu extends WP_Widget {

	/*--------------------------------------------------*/
	/* Constructor
	/*--------------------------------------------------*/

	/**
	 * Specifies the classname and description, instantiates the widget,
	 * loads localization files, and includes necessary stylesheets and JavaScript.
	 */
	public function __construct() {

		parent::__construct(
			'kakina-collapse-menu',
			__( 'kakina Menu Widget', 'kakina' ),
			array(
				'classname'		=>	'kakina-collapse-menu',
				'description'	=>	__( 'Add a WordPress custom menu in any widget area.', 'kakina' )
			)
		);


	} // end constructor

	/*--------------------------------------------------*/
	/* Widget API Functions
	/*--------------------------------------------------*/

	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array	args		The array of form elements
	 * @param	array	instance	The current instance of the widget
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		// TODO:	Here is where you manipulate your widget's values based on their input fields

		$args = array(
    'menu'    			=> $instance['menu'],
    'depth'             => 3,
    'container'         => false,
    'menu_class'        => 'widget-menu',
    'fallback_cb'       => '',
    'items_wrap'        => '<div id="%1$s" class="widget-menu">%3$s</div>',
    'walker'            => new wp_bootstrap_navwalker()
    );
    
    wp_nav_menu( $args );
    
		echo $after_widget;

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	array	new_instance	The new instance of values to be generated via the update.
	 * @param	array	old_instance	The previous instance of values before the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['menu']  = strip_tags( $new_instance['menu'] );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array	instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {
  $tw_defaults['menu'] = '';
  $instance = wp_parse_args( (array) $instance, $tw_defaults );
  $menu  = strip_tags( $instance['menu'] );
  $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

?>			

<p>
	<label for="<?php echo $this->get_field_id( 'menu' ); ?>"><?php _e( 'Choose menu', 'kakina' ); ?>: 
		<select id="<?php echo $this->get_field_id( 'menu' ); ?>" name="<?php echo $this->get_field_name( 'menu' ); ?>">

			<?php foreach( $menus as $custom_menu ): ?>

				<option value="<?php echo $custom_menu->term_id; ?>" <?php if( $menu == $custom_menu->term_id ): ?>selected="selected"<?php endif; ?>><?php echo $custom_menu->name; ?></option>

			<?php endforeach; ?>

		</select>
	</label>
</p>
<?php
	} // end form

} // end class
/****************************************************************************************/
?>