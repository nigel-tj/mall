<?php

/**
 *
 * Metaboxes
 *
 */
require_once( trailingslashit( get_template_directory() ) . '/lib/cmb2-fontawesome-picker.php' ); // enable font awesome icons select

add_action( 'cmb2_admin_init', 'kakina_pro_homepage_template_metaboxes' );

function kakina_pro_homepage_template_metaboxes() {

	if ( class_exists( 'WooCommerce' ) ) {
		$prefix = 'kakina';


		/**
		 * Repeatable Field Groups
		 */
		$cmb_group		 = new_cmb2_box( array(
			'id'			 => $prefix . '_home_settings',
			'title'			 => __( 'Slider Settings', 'kakina' ),
			'object_types'	 => array( 'page', ),
			'show_on'		 => array( 'key' => 'page-template', 'value' => array( 'template-home.php', 'template-home-sidebar.php' ) ),
			'context'		 => 'normal',
			'priority'		 => 'high',
			'show_names'	 => true,
		) );
		$cmb_group->add_field( array(
			'name'		 => __( 'Slider', 'kakina' ),
			'desc'		 => __( 'Enable or disable slider', 'kakina' ),
			'id'		 => $prefix . '_slider_on',
			'default'	 => 'off',
			'type'		 => 'radio_inline',
			'options'	 => array(
				'on'	 => __( 'On', 'kakina' ),
				'off'	 => __( 'Off', 'kakina' ),
			),
		) );
		// $group_field_id is the field id string, so in this case: $prefix . 'demo'
		$group_field_id	 = $cmb_group->add_field( array(
			'id'			 => $prefix . '_home_slider',
			'type'			 => 'group',
			'description'	 => __( 'Generate slider', 'kakina' ),
			'options'		 => array(
				'group_title'	 => __( 'Slide {#}', 'kakina' ), // {#} gets replaced by row number
				'add_button'	 => __( 'Add another slide', 'kakina' ),
				'remove_button'	 => __( 'Remove slide', 'kakina' ),
				'sortable'		 => true,
				'closed'		 => true,
			),
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'			 => __( 'Image', 'kakina' ),
			'id'			 => $prefix . '_image',
			'type'			 => 'file',
			'preview_size'	 => array( 100, 100 ), // Default: array( 50, 50 )
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Slider Title', 'kakina' ),
			'id'	 => $prefix . '_title',
			'type'	 => 'text',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Slider Description', 'kakina' ),
			'id'	 => $prefix . '_desc',
			'type'	 => 'textarea_code',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Button Text', 'kakina' ),
			'id'	 => $prefix . '_button_text',
			'type'	 => 'text',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Button URL', 'kakina' ),
			'id'	 => $prefix . '_url',
			'type'	 => 'text_url',
		) );

		/**
		 * Repeatable Field Groups for services
		 */
		$cmb_group_services	 = new_cmb2_box( array(
			'id'			 => $prefix . '_services',
			'title'			 => __( 'Services', 'kakina' ),
			'object_types'	 => array( 'page', ),
			'show_on'		 => array( 'key' => 'page-template', 'value' => array( 'template-home.php', 'template-home-sidebar.php', 'template-home-banners.php' ) ),
			'context'		 => 'normal',
			'priority'		 => 'high',
			'show_names'	 => true,
		) );
		$cmb_group_services->add_field( array(
			'name'		 => __( 'Services', 'kakina' ),
			'desc'		 => __( 'Enable or disable services', 'kakina' ),
			'id'		 => $prefix . '_services_on',
			'default'	 => 'off',
			'type'		 => 'radio_inline',
			'options'	 => array(
				'on'	 => __( 'On', 'kakina' ),
				'off'	 => __( 'Off', 'kakina' ),
			),
		) );
		$cmb_group_services->add_field( array(
			'name'		 => __( 'Columns in row', 'kakina' ),
			'desc'		 => __( 'Define number of columns in row.', 'kakina' ),
			'id'		 => $prefix . '_services_columns',
			'default'	 => '12',
			'type'		 => 'radio_inline',
			'options'	 => array(
				'12' => __( '1', 'kakina' ),
				'6'	 => __( '2', 'kakina' ),
				'4'	 => __( '3', 'kakina' ),
				'3'	 => __( '4', 'kakina' ),
			),
		) );
		$kakina_pro_services = $cmb_group_services->add_field( array(
			'id'			 => $prefix . '_home_services',
			'type'			 => 'group',
			'description'	 => __( 'Generate services', 'kakina' ),
			'options'		 => array(
				'group_title'	 => __( 'Service {#}', 'kakina' ), // {#} gets replaced by row number
				'add_button'	 => __( 'Add another service', 'kakina' ),
				'remove_button'	 => __( 'Remove service', 'kakina' ),
				'sortable'		 => true,
				'closed'		 => true,
			),
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'			 => __( 'Service background image', 'kakina' ),
			'id'			 => $prefix . '_image_services',
			'type'			 => 'file',
			'preview_size'	 => array( 100, 100 ), // Default: array( 50, 50 )
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'	 => __( 'Service Icon', 'kakina' ),
			'id'	 => $prefix . '_services_icon',
			'type'	 => 'fontawesome_icon', // This field type
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'	 => __( 'Service Title', 'kakina' ),
			'id'	 => $prefix . '_title_services',
			'type'	 => 'text',
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'	 => __( 'Service Description', 'kakina' ),
			'id'	 => $prefix . '_desc_services',
			'type'	 => 'textarea_code',
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'	 => __( 'URL', 'kakina' ),
			'id'	 => $prefix . '_url_services',
			'type'	 => 'text_url',
		) );
		$cmb_group_services->add_group_field( $kakina_pro_services, array(
			'name'		 => __( 'Text Color', 'kakina' ),
			'id'		 => $prefix . '_services_color',
			'type'		 => 'colorpicker',
			'default'	 => '#ffffff',
		) );

		/**
		 * Repeatable Field Groups for banners
		 */
		$cmb_group_banners	 = new_cmb2_box( array(
			'id'			 => $prefix . '_banners',
			'title'			 => __( 'Banners', 'kakina' ),
			'object_types'	 => array( 'page', ),
			'show_on'		 => array( 'key' => 'page-template', 'value' => array( 'template-home-banners.php' ) ),
			'context'		 => 'normal',
			'priority'		 => 'high',
			'show_names'	 => true,
		) );
		$cmb_group_banners->add_field( array(
			'name'		 => __( 'Banners', 'kakina' ),
			'desc'		 => __( 'Enable or disable banners', 'kakina' ),
			'id'		 => $prefix . '_banners_on',
			'default'	 => 'off',
			'type'		 => 'radio_inline',
			'options'	 => array(
				'on'	 => __( 'On', 'kakina' ),
				'off'	 => __( 'Off', 'kakina' ),
			),
		) );
		// $group_field_id is the field id string, so in this case: $prefix . 'demo'
		$banners_id			 = $cmb_group_banners->add_field( array(
			'id'			 => $prefix . '_home_banners',
			'type'			 => 'group',
			'description'	 => __( 'Generate Banners. First image dimensions: 570x450px, second and third image dimensions: 285x225px. Only first 3 images are displayed.', 'kakina' ),
			'options'		 => array(
				'group_title'	 => __( 'Banner {#}', 'kakina' ), // {#} gets replaced by row number
				'add_button'	 => __( 'Add another banner', 'kakina' ),
				'remove_button'	 => __( 'Remove banner', 'kakina' ),
				'sortable'		 => true,
				'closed'		 => true,
			),
		) );
		$cmb_group_banners->add_group_field( $banners_id, array(
			'name'			 => __( 'Image', 'kakina' ),
			'id'			 => $prefix . '_image_banners',
			'type'			 => 'file',
			'preview_size'	 => array( 100, 100 ), // Default: array( 50, 50 )
		) );
		$cmb_group_banners->add_group_field( $banners_id, array(
			'name'	 => __( 'URL', 'kakina' ),
			'id'	 => $prefix . '_url_banners',
			'type'	 => 'text_url',
		) );

		/**
		 * Repeatable Field Groups for custom tabs
		 */
		$cmb_group		 = new_cmb2_box( array(
			'id'			 => $prefix . '_tabs',
			'title'			 => __( 'Tabs', 'kakina' ),
			'object_types'	 => array( 'product', ),
			'context'		 => 'normal',
			'priority'		 => 'high',
			'show_names'	 => true,
			'closed'		 => true,
		) );
		$group_field_id	 = $cmb_group->add_field( array(
			'id'		 => $prefix . '_custom_tabs',
			'type'		 => 'group',
			'options'	 => array(
				'group_title'	 => __( 'Tab {#}', 'kakina' ), // {#} gets replaced by row number
				'add_button'	 => __( 'Add Another Tab', 'kakina' ),
				'remove_button'	 => __( 'Remove Tab', 'kakina' ),
				'sortable'		 => true,
			),
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Tab Title', 'kakina' ),
			'id'	 => $prefix . '_title',
			'type'	 => 'text',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Tab Content', 'kakina' ),
			'id'	 => $prefix . '_desc',
			'type'	 => 'textarea',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'		 => __( 'Tab Priority', 'kakina' ),
			'desc'		 => __( 'Define tab priority (0 = highest priortiy)', 'kakina' ),
			'id'		 => $prefix . '_priority',
			'default'	 => 21,
			'type'		 => 'text_small',
			'attributes' => array(
				'type'		 => 'number',
				'required'	 => 'required',
			),
		) );

		/**
		 * Repeatable Field Groups for custom boxes
		 */
		$cmb_group		 = new_cmb2_box( array(
			'id'			 => $prefix . '_boxes',
			'title'			 => __( 'Help boxes', 'kakina' ),
			'object_types'	 => array( 'product', ),
			'context'		 => 'normal',
			'priority'		 => 'high',
			'show_names'	 => true,
			'closed'		 => true,
		) );
		$group_field_id	 = $cmb_group->add_field( array(
			'id'		 => $prefix . '_custom_boxes',
			'type'		 => 'group',
			'options'	 => array(
				'group_title'	 => __( 'Box {#}', 'kakina' ), // {#} gets replaced by row number
				'add_button'	 => __( 'Add Another Box', 'kakina' ),
				'remove_button'	 => __( 'Remove box', 'kakina' ),
				'sortable'		 => true,
			),
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Box Icon', 'kakina' ),
			'id'	 => $prefix . '_boxes_icon',
			'type'	 => 'fontawesome_icon',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Box Title', 'kakina' ),
			'id'	 => $prefix . '_boxes_title',
			'type'	 => 'text',
		) );
		$cmb_group->add_group_field( $group_field_id, array(
			'name'	 => __( 'Box Content', 'kakina' ),
			'id'	 => $prefix . '_boxes_desc',
			'type'	 => 'textarea',
		) );
	}
}

add_action( 'cmb2_admin_init', 'kakina_pro_homepage_sidebar_template_metaboxes' );

function kakina_pro_homepage_sidebar_template_metaboxes() {

	if ( class_exists( 'WooCommerce' ) ) {
		$prefix = 'kakina';


		$cmb = new_cmb2_box( array(
			'id'			 => 'homepage_metabox_sidebar',
			'title'			 => __( 'Sidebars', 'kakina' ),
			'object_types'	 => array( 'page', ), // Post type 
			'show_on'		 => array( 'key' => 'page-template', 'value' => array( 'template-home-banners.php', 'template-home-sidebar.php' ) ),
			'context'		 => 'side',
			'priority'		 => 'high',
			'show_names'	 => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
		) );
		$cmb->add_field( array(
			'name'		 => __( 'Sidebar position', 'kakina' ),
			'id'		 => $prefix . '_sidebar_position',
			'default'	 => 'left',
			'type'		 => 'select',
			'options'	 => array(
				'none'	 => __( 'None', 'kakina' ),
				'left'	 => __( 'Left', 'kakina' ),
				'right'	 => __( 'Right', 'kakina' ),
			),
		) );
	}
}

function kakina_pro_get_cats() {
	/* GET LIST OF CATEGORIES */
	$args		 = array(
		'taxonomy'	 => 'product_cat',
		'orderby'	 => 'name',
		'show_count' => 1,
	);
	$layercats	 = get_categories( $args );
	$newList	 = array();
	foreach ( $layercats as $category ) {
		$newList[ $category->term_id ] = $category->cat_name;
	}
	return $newList;
}
