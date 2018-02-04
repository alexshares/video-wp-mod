<?php 
// Register widgetized areas
function theme_widgets_init() {


    register_sidebar( array (
		'name' => esc_html__( 'Default Sidebar (Right)', 'video_wp' ),
		'id' => 'sidebar',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div><div class="clear"></div><div class="line_widget_col"></div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div><div class="clear"></div>',
	) );


    register_sidebar( array (
		'name' => esc_html__( 'Home Modules (Middle)', 'video_wp' ),
		'description' => esc_html__('Use only the widgets that start with the name "Module".', 'video_wp'),
		'id' => 'homemodules',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Home Sidebar (Right)', 'video_wp' ),
		'id' => 'sidebarhome',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div><div class="clear"></div><div class="line_widget_col"></div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 1', 'video_wp' ),
		'id' => 'footer1',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 2', 'video_wp' ),
		'id' => 'footer2',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div><div class="clear"></div>',
	) );

    register_sidebar( array (
		'name' => esc_html__( 'Footer Sidebar 3', 'video_wp' ),
		'id' => 'footer3',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<div class="widget-title"><h3>',
		'after_title' => '</h3></div><div class="clear"></div>',
	) );

}

add_action( 'init', 'theme_widgets_init' );
?>