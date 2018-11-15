<?php
/**
 * TWP shortcode generator template
 * 
 */  

return array(
    // TWP shortcodes
    array(
        'name' => 'main_section',
        'title' => __( 'Standard', 'twp-shortcodes' ),
        'desc' => __( 'Standard shortcodes.', 'twp-shortcodes' ),
        'shortcodes' => array(
            array(
                'tag' => 'col',
                'title' => __( 'Columns', 'twp-shortcodes' ),
                'desc' => __( 'Print a column', 'twp-shortcodes' ),
                'content' => 'richedit',
                'icon' => 'fa-columns', // Font-awesome can be used
                'selftag' => false,
                'atts' => array(
                    'size' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '9',
                                'label' => '3/4',
                            ),
                            array(
                                'val' => '8',
                                'label' => '2/3',
                            ),
                            array(
                                'val' => '3',
                                'label' => '1/4',
                            ),
                            array(
                                'val' => '4',
                                'label' => '1/3',
                            ),
                            array(
                                'val' => '6',
                                'label' => '1/2',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'row',
                'title' => __( 'Row', 'twp-shortcodes' ),
                'desc' => __( 'Add row for columns', 'twp-shortcodes' ),
                'icon' => 'fa-th-large', // Font-awesome can be used
                'selftag' => false,
            ),
            array(
                'tag' => 'tooltip',
                'title' => __( 'Tooltips', 'twp-shortcodes' ),
                'desc' => __( 'Print a tooltip', 'twp-shortcodes' ),
                'content' => 'richedit',
                'icon' => 'fa-question', // Font-awesome can be used
                'selftag' => false,
                'atts' => array(
                    'size' => array(
                        'title' => __( 'Placement', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'top',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'top',
                                'label' => __( 'Top', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'left',
                                'label' => __( 'Left', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'right',
                                'label' => __( 'Right', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'bottom',
                                'label' => __( 'Bottom', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '',
                    ),
                ),
            ),
            array(
                'tag' => 'icon',
                'title' => __( 'Icons', 'twp-shortcodes' ),
                'desc' => __( 'Print a icon', 'twp-shortcodes' ),
                'icon' => 'fa-check-square-o', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'name' => array(
                            'title' => __( 'Icon', 'twp-shortcodes' ),
                            'desc' => __( 'Select icon', 'twp-shortcodes' ),
                            'type' => 'icon',
                     ),
                     'additional' => array(
                        'title' => __( 'Size', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '',
                                'label' => __( 'Icon', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'fa-2x',
                                'label' => __( '2x', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'fa-3x',
                                'label' => __( '3x', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'fa-4x',
                                'label' => __( '4x', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'fa-5x',
                                'label' => __( '5x', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'divider',
                'title' => __( 'Divider', 'twp-shortcodes' ),
                'desc' => __( 'Print a divider', 'twp-shortcodes' ),
                'icon' => 'fa-minus', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                     'type' => array(
                        'title' => __( 'Divider type', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'one',
                                'label' => __( 'Line #1', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'two',
                                'label' => __( 'Line #2', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'dashed',
                                'label' => __( 'Dashed', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'double',
                                'label' => __( 'Double', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'headings',
                'title' => __( 'Title with line', 'twp-shortcodes' ),
                'desc' => __( 'Show a title centered with line', 'twp-shortcodes' ),
                'icon' => 'fa-header', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                     'title' => array(
                        'title' => __( 'Title', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => false,
                      ),
                     'size' => array(
                        'title' => __( 'Title size', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'h1',
                                'label' => 'H1',
                            ),
                            array(
                                'val' => 'h2',
                                'label' => 'H2',
                            ),
                            array(
                                'val' => 'h3',
                                'label' => 'H3',
                            ),
                            array(
                                'val' => 'h4',
                                'label' => 'H4',
                            ),
                            array(
                                'val' => 'h5',
                                'label' => 'H5',
                            ),
                            array(
                                'val' => 'h6',
                                'label' => 'H6',
                            ),
                        ),
                    ),
                    'type' => array(
                        'title' => __( 'Line style', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'solid',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'solid',
                                'label' => __( 'Solid', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'dotted',
                                'label' => __( 'Dotted', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'dashed',
                                'label' => __( 'Dashed', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'double',
                                'label' => __( 'Double', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'progress-bar',
                'title' => __( 'Progress Bar', 'twp-shortcodes' ),
                'desc' => __( 'Print a progress bar', 'twp-shortcodes' ),
                'icon' => 'fa-bars', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                     'type' => array(
                        'title' => __( 'Type', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'default',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'default',
                                'label' => __( 'Default', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'primary',
                                'label' => __( 'Primary', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'success',
                                'label' => __( 'Success', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'info',
                                'label' => __( 'Info', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'warning',
                                'label' => __( 'Warning', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'danger',
                                'label' => __( 'Danger', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'value' => array(
                        'title' => __( 'slider field', 'twp-shortcodes' ),
                        'desc' => '',
                        'type' => 'slider',
                        'default' => 50,
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'label' => array(
                        'title' => __( 'Label', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'true',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'false',
                                'label' => __( 'No', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'true',
                                'label' => __( 'Yes', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'label',
                'title' => __( 'Labels', 'twp-shortcodes' ),
                'desc' => __( 'Print a label', 'twp-shortcodes' ),
                'icon' => 'fa-check-circle', // Font-awesome can be used
                'content' => 'richedit',
                'selftag' => false,
                'atts' => array(
                     'type' => array(
                        'title' => __( 'Type', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'default',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'default',
                                'label' => __( 'Default', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'primary',
                                'label' => __( 'Primary', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'success',
                                'label' => __( 'Success', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'info',
                                'label' => __( 'Info', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'warning',
                                'label' => __( 'Warning', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'danger',
                                'label' => __( 'Danger', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'alert',
                'title' => __( 'Alerts', 'twp-shortcodes' ),
                'desc' => __( 'Print an alert box', 'twp-shortcodes' ),
                'icon' => 'fa-exclamation', // Font-awesome can be used
                'content' => 'richedit',
                'selftag' => false,
                'atts' => array(
                     'type' => array(
                        'title' => __( 'Type', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'info',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'primary',
                                'label' => __( 'Primary', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'success',
                                'label' => __( 'Success', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'info',
                                'label' => __( 'Info', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'warning',
                                'label' => __( 'Warning', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'danger',
                                'label' => __( 'Danger', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'button',
                'title' => __( 'Buttons', 'twp-shortcodes' ),
                'desc' => __( 'Show a simple custom button, with icon', 'twp-shortcodes' ),
                'icon' => 'fa-camera-retro', // Font-awesome can be used
                'content' => 'richedit',
                'selftag' => false,
                'atts' => array(
                     'type' => array(
                        'title' => __( 'Type', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'outline',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'outline',
                                'label' => __( 'Default', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'primary',
                                'label' => __( 'Primary', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'success',
                                'label' => __( 'Success', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'info',
                                'label' => __( 'Info', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'warning',
                                'label' => __( 'Warning', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'danger',
                                'label' => __( 'Danger', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'link',
                                'label' => __( 'Link', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'size' => array(
                        'title' => __( 'Size', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'sm',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'lg',
                                'label' => __( 'Large', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'sm',
                                'label' => __( 'Medium', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'xs',
                                'label' => __( 'Small', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'url' => array(
                        'title' => __( 'Button URL', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '#',
                    ),
                    'icon' => array(
                            'title' => __( 'Icon', 'twp-shortcodes' ),
                            'desc' => __( 'Select icon', 'twp-shortcodes' ),
                            'type' => 'icon',
                     ),
                ),
            ),
            array(
                'tag' => 'media',
                'title' => __( 'Media', 'twp-shortcodes' ),
                'desc' => __( 'Print a media with title and description', 'twp-shortcodes' ),
                'icon' => 'fa-file-image-o', // Font-awesome can be used
                'content' => 'richedit',
                'selftag' => false,
                'atts' => array(
                     'img' => array(
                            'title' => __( 'Image', 'twp-shortcodes' ),
                            'desc' => __( 'Upload image', 'twp-shortcodes' ),
                            'type' => 'upload',
                     ),
                     'align' => array(
                        'title' => __( 'Image aling', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'pull-left',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'pull-left',
                                'label' => __( 'Left', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'pull-right',
                                'label' => __( 'Right', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'text-center',
                                'label' => __( 'Center all', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '',
                    ),
                    'url' => array(
                        'title' => __( 'URL', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '#',
                    ),
                ),
            ),
            array(
                'tag' => 'image',
                'title' => __( 'Image with effects', 'twp-shortcodes' ),
                'desc' => __( 'Print an image with title and hower effect', 'twp-shortcodes' ),
                'icon' => 'fa-file-image-o', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                     'img' => array(
                            'title' => __( 'Image', 'twp-shortcodes' ),
                            'desc' => __( 'Upload image', 'twp-shortcodes' ),
                            'type' => 'upload',
                     ),
                     'animation' => array(
                        'title' => __( 'Image hover effect', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'zoomin',
                                'label' => __( 'Zoom in', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'zoomout',
                                'label' => __( 'Zoom out', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'flash',
                                'label' => __( 'Flash', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'title' => array(
                        'title' => __( 'Title', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '',
                    ),
                    'url' => array(
                        'title' => __( 'Image URL', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => '#',
                    ),
                    'size' => array(
                        'title' => __( 'Title size', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => 'h1',
                                'label' => 'H1',
                            ),
                            array(
                                'val' => 'h2',
                                'label' => 'H2',
                            ),
                            array(
                                'val' => 'h3',
                                'label' => 'H3',
                            ),
                            array(
                                'val' => 'h4',
                                'label' => 'H4',
                            ),
                            array(
                                'val' => 'h5',
                                'label' => 'H5',
                            ),
                            array(
                                'val' => 'h6',
                                'label' => 'H6',
                            ),
                        ),
                    ),
                    'color' => array(
                        'title' => __( 'Title color', 'twp-shortcodes' ),
                        'type' => 'color',
                        'desc' => '',
                        'default' => '#fff',
                    ),
                ),
            ),
            array(
                'tag' => 'clear',
                'title' => __( 'Clear', 'twp-shortcodes' ),
                'desc' => __( 'Clear the float', 'twp-shortcodes' ),
                'icon' => 'fa-exchange', // Font-awesome can be used
                'selftag' => true,
            ),
        ),
    ),
    array(
        'name' => 'blog_section',
        'title' => __( 'Sections', 'twp-shortcodes' ),
        'desc' => __( 'Sections shortcodes.', 'twp-shortcodes' ),
        'shortcodes' => array(
            array(
                'tag' => 'recent-posts',
                'title' => __( 'Recent posts', 'twp-shortcodes' ),
                'desc' => __( 'Print a blog posts', 'twp-shortcodes' ),
                'icon' => 'fa-th', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category ID', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for all.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' => return_terms_for_tsg_template()
                    ),
                    'posts' => array(
                        'title' => __( 'Number of posts', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'excerpt' => array(
                        'title' => __( 'Excerpt length', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '3',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'posts-inline',
                'title' => __( 'Recent posts inline', 'twp-shortcodes' ),
                'desc' => __( 'Print a blog posts', 'twp-shortcodes' ),
                'icon' => 'fa-align-justify', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category ID', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for all.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' => return_terms_for_tsg_template()
                    ),
                    'posts' => array(
                        'title' => __( 'Number of posts', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 4,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'excerpt' => array(
                        'title' => __( 'Excerpt length', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 25,
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                ),
            ),
            array(
                'tag' => 'posts-carousel', // The actual tag of the shortcode
                'title' => __( 'Posts carousel', 'twp-shortcodes' ),
                'desc' => __( 'Print a carousel with posts.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-ellipsis-h', // Font-awesome can be used
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select category to show.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' =>  return_terms_for_tsg_template()
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of posts', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '3',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                    'excerpt' => array(
                        'title' => __( 'Excerpt length', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 25,
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ),
                ),
            ),
            array(
                'tag' => 'contact-form-7',
                'title' => __( 'Contact Form 7', 'twp-shortcodes' ),
                'desc' => __( 'Print a contact form.', 'twp-shortcodes' ),
                'icon' => 'fa-pencil-square-o', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'title' => array(
                        'title' => __( 'Form', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select your form.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' => ts_return_cf7_array_for_scg()
                    ),
                ),
            ),
            array(
                'tag' => 'wysija_form',
                'title' => __( 'MailPoet Newsletters', 'twp-shortcodes' ),
                'desc' => __( 'Print a MailPoet Newsletter subscribe form.', 'twp-shortcodes' ),
                'icon' => 'fa-envelope-o', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'id' => array(
                        'title' => __( 'Form', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select your form.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' => twp_get_mailpoet_form()
                    ),
                ),
            ),            
        ),
    ),
    array(
        'name' => 'woocommerce_section',
        'title' => __( 'Shop', 'twp-shortcodes' ),
        'desc' => __( 'WooCommerce shortcodes.', 'twp-shortcodes' ),
        'shortcodes' => array(
            array(
                'tag' => 'product-carousel', // The actual tag of the shortcode
                'title' => __( 'Products carousel', 'twp-shortcodes' ),
                'desc' => __( 'Print carousel with products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for all.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' =>  twp_get_product_cats()
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'date',
                        'vals' => array(
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'ID',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'none',
                                'label' => __( 'None', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '3',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'custom-products-carousel', // The actual tag of the shortcode
                'title' => __( 'Custom products carousel', 'twp-shortcodes' ),
                'desc' => __( 'Print carousel with products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'ids' => array(
                        'title' => __( 'Products', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more products.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' =>  return_posts_for_tsg_template( 'product' )
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'date',
                        'vals' => array(
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'ID',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'none',
                                'label' => __( 'None', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '3',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'product-slider', // The actual tag of the shortcode
                'title' => __( 'Products slider', 'twp-shortcodes' ),
                'desc' => __( 'Print slider with products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select slider category.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' =>  twp_get_product_cats()
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ),
                ),
            ),
            array(
                'tag' => 'category-carousel', // The actual tag of the shortcode
                'title' => __( 'Category carousel', 'twp-shortcodes' ),
                'desc' => __( 'Print carousel with product categories', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-folder-open', // Font-awesome can be used
                'atts' => array(
                    'include' => array(
                        'title' => __( 'Include category', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for all.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' =>  twp_get_product_cats()
                    ),
                    'exclude' => array(
                        'title' => __( 'Exclude category', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for none.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' =>  twp_get_product_cats()
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'name',
                        'vals' => array(
                            array(
                                'val' => 'name',
                                'label' => __( 'Name', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'Id', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'slug',
                                'label' => __( 'Slug', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'count',
                                'label' => __( 'Count', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'none',
                                'label' => __( 'None', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '3',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                    'parent' => array(
                        'title' => __( 'Parent ID', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for none.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' => twp_get_product_cats()
                    ),
                    'hide_empty' => array(
                        'title' => __( 'Hide empty', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '1',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => 'Yes',
                            ),
                            array(
                                'val' => '0',
                                'label' => 'No',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'custom-category', // The actual tag of the shortcode
                'title' => __( 'Custom category', 'twp-shortcodes' ),
                'desc' => __( 'Show category with 2 products', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select a category.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' =>  twp_get_product_cats()
                    ),
                    'button_text' => array(
                        'title' => __( 'Button text', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => 'Shop Now &raquo;',
                    ),
                    'cat_excerpt' => array(
                        'title' => __( 'Category excerpt length', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 200,
                        'min' => 10,
                        'max' => 400,
                        'step' => 10,
                    ),
                ),
            ),
            array(
                'tag' => 'custom-category-carousel', // The actual tag of the shortcode
                'title' => __( 'Custom category carousel', 'twp-shortcodes' ),
                'desc' => __( 'Show category image with products carousel', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'category' => array(
                        'title' => __( 'Category', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => __( 'Select a category.', 'twp-shortcodes' ),
                        'default' => '',
                        'vals' =>  twp_get_product_cats()
                    ),
                    'button_text' => array(
                        'title' => __( 'Button text', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => 'Shop Now &raquo;',
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 6,
                        'min' => 1,
                        'max' => 30,
                        'step' => 1,
                    ),
                ),
            ),
            // Default WooCommerce shortcodes
            array(
                'tag' => 'add_to_cart',
                'title' => __( 'Product Price/cart button', 'twp-shortcodes' ),
                'desc' => __( 'Print a price and cart button.', 'twp-shortcodes' ),
                'icon' => 'fa-mouse-pointer', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'id' => array(
                        'title' => __( 'Product', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => return_posts_for_tsg_template( 'product' )
                    ),
                    'show_price' => array(
                        'title' => __( 'Show Price', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => 'true',
                        'desc' => __( 'You can style the button/price.', 'twp-shortcodes' ),
                        'vals' => array(
                            array(
                                'val' => 'true',
                                'label' => __( 'Yes', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'false',
                                'label' => __( 'No', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'style' => array(
                        'title' => __( 'Inline Style', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => false,
                    ),
                ),
            ),
            array(
                'tag' => 'product',
                'title' => __( 'Single product', 'twp-shortcodes' ),
                'desc' => __( 'Print a single product', 'twp-shortcodes' ),
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'selftag' => false,
                'atts' => array(
                    'id' => array(
                        'title' => __( 'Product', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => false,
                        'desc' => '',
                        'vals' => return_posts_for_tsg_template( 'product' )
                    ),
                ),
            ),
            array(
                'tag' => 'products',
                'title' => __( 'Multiple products', 'twp-shortcodes' ),
                'desc' => __( 'Print a multiple products', 'twp-shortcodes' ),
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'selftag' => true,
                'atts' => array(
                    'ids' => array(
                        'title' => __( 'Products', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'default' => false,
                        'desc' => '',
                        'vals' => return_posts_for_tsg_template( 'product' )
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'none',
                                'label' => __( 'None', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'product_categories', // The actual tag of the shortcode
                'title' => __( 'Product categories', 'twp-shortcodes' ),
                'desc' => __( 'Print a categories of products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-folder-open', // Font-awesome can be used
                'atts' => array(
                    'ids' => array(
                        'title' => __( 'Include category', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for all.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' =>  twp_get_product_cats()
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'name',
                        'vals' => array(
                            array(
                                'val' => 'name',
                                'label' => __( 'Name', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'Id', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'slug',
                                'label' => __( 'Slug', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'count',
                                'label' => __( 'Count', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'none',
                                'label' => __( 'None', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'number' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => false,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                    'parent' => array(
                        'title' => __( 'Parent ID', 'twp-shortcodes' ),
                        'type' => 'multiselect',
                        'desc' => __( 'Select one or more categories. Leave blank for none.', 'twp-shortcodes' ),
                        'default' => false,
                        'vals' => twp_get_product_cats()
                    ),
                ),
            ),
            array(
                'tag' => 'product_attribute', // The actual tag of the shortcode
                'title' => __( 'Products by attributes', 'twp-shortcodes' ),
                'desc' => __( 'Print a products selected by attributes.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'attribute' => array(
                        'title' => __( 'Attribute slug', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => '',
                        'default' => false,
                    ),
                    'filter' => array(
                        'title' => __( 'Terms slug', 'twp-shortcodes' ),
                        'type' => 'input',
                        'desc' => __( 'Separate values with comma', 'twp-shortcodes' ),
                        'default' => false,
                    ),
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => false,
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'recent_products', // The actual tag of the shortcode
                'title' => __( 'Recent Products', 'twp-shortcodes' ),
                'desc' => __( 'Print a recent products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'featured_products', // The actual tag of the shortcode
                'title' => __( 'Featured Products', 'twp-shortcodes' ),
                'desc' => __( 'Print a featured products.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'sale_products', // The actual tag of the shortcode
                'title' => __( 'Sale Products', 'twp-shortcodes' ),
                'desc' => __( 'Print a products in sale.', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'best_selling_products', // The actual tag of the shortcode
                'title' => __( 'Best selling products', 'twp-shortcodes' ),
                'desc' => __( 'Print a best selling products', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            array(
                'tag' => 'top_rated_products', // The actual tag of the shortcode
                'title' => __( 'Top rated products', 'twp-shortcodes' ),
                'desc' => __( 'Print a best selling products', 'twp-shortcodes' ),
                'selftag' => true, // if the shortcode should not contain any content
//                'icon' => 'path/to/icon',
                'icon' => 'fa-shopping-cart', // Font-awesome can be used
                'atts' => array(
                    'orderby' => array(
                        'title' => __( 'Order by', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'title',
                        'vals' => array(
                            array(
                                'val' => 'title',
                                'label' => __( 'Title', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'date',
                                'label' => __( 'Date', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'rand',
                                'label' => __( 'Random', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'id',
                                'label' => __( 'ID', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'menu_order',
                                'label' => __( 'Menu Order', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'order' => array(
                        'title' => __( 'Order', 'twp-shortcodes' ),
                        'type' => 'select',
                        'desc' => '',
                        'default' => 'ASC',
                        'vals' => array(
                            array(
                                'val' => 'ASC',
                                'label' => __( 'ASC', 'twp-shortcodes' ),
                            ),
                            array(
                                'val' => 'DESC',
                                'label' => __( 'DESC', 'twp-shortcodes' ),
                            ),
                        ),
                    ),
                    'per_page' => array(
                        'title' => __( 'Number of Items', 'twp-shortcodes' ),
                        'type' => 'slider',
                        'desc' => '',
                        'default' => 12,
                        'min' => 1,
                        'max' => 60,
                        'step' => 1,
                    ),
                    'columns' => array(
                        'title' => __( 'Columns', 'twp-shortcodes' ),
                        'type' => 'select',
                        'default' => '4',
                        'desc' => '',
                        'vals' => array(
                            array(
                                'val' => '1',
                                'label' => '1',
                            ),
                            array(
                                'val' => '2',
                                'label' => '2',
                            ),
                            array(
                                'val' => '3',
                                'label' => '3',
                            ),
                            array(
                                'val' => '4',
                                'label' => '4',
                            ),
                            array(
                                'val' => '5',
                                'label' => '5',
                            ),
                            array(
                                'val' => '6',
                                'label' => '6',
                            ),
                        ),
                    ),
                ),
            ),
            
            
        ),
    ),
);