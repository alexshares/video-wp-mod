<?php
// ------------------------------------------------ 
// ---------- Options Framework Theme -------------
// ------------------------------------------------
 include( get_template_directory() . '/admin/index.php');

// ---------------------------------------------- 
// - Updates for Themes (Envato Market plugin.) -
// ---------------------------------------------- 
 include( get_template_directory() . '/functions/custom/github.php');

// ----------------------------------------------
// --------------- Load Scripts -----------------
// ----------------------------------------------
 include( get_template_directory() . '/functions/scripts.php');

// ---------------------------------------------- 
// --------------- Load Custom Widgets ----------
// ----------------------------------------------
 include( get_template_directory() . '/functions/widgets.php');
 include( get_template_directory() . '/functions/widgets/widget-tags.php');
 include( get_template_directory() . '/functions/widgets/widget-posts.php');
 include( get_template_directory() . '/functions/widgets/widget-top-posts.php');
 include( get_template_directory() . '/functions/widgets/widget-cat.php');
 include( get_template_directory() . '/functions/widgets/widget-review.php');
 include( get_template_directory() . '/functions/widgets/widget-review-rand.php');
 include( get_template_directory() . '/functions/widgets/widget-review-recent.php');
 include( get_template_directory() . '/functions/widgets/widget-banner.php');
 include( get_template_directory() . '/functions/widgets/widget-banner-text.php');
 include( get_template_directory() . '/functions/widgets/widget-posts-tags.php');
// --------------- Load Modules ------------------
 include( get_template_directory() . '/functions/widgets/home-module-1.php');
 include( get_template_directory() . '/functions/widgets/home-module-2.php');
 include( get_template_directory() . '/functions/widgets/home-module-3.php');
 include( get_template_directory() . '/functions/widgets/home-module-4.php');
 include( get_template_directory() . '/functions/widgets/home-module-5.php');

// ----------------------------------------------
// --------------- Load Custom ------------------
// ---------------------------------------------- 
 include( get_template_directory() . '/functions/custom/comments.php');
  
// ----------------------------------------------
// ------ Content width -------------------------
// ----------------------------------------------
if ( ! isset( $content_width ) ) $content_width = 830;

// ----------------------------------------------
// ------ Theme set up --------------------------
// ----------------------------------------------
add_action( 'after_setup_theme', 'video_wp_theme_setup' );
if ( !function_exists('video_wp_theme_setup') ) {

    function video_wp_theme_setup() {
    
        // Register navigation menu
        register_nav_menus(
            array(
                'video_wp-primary-menu' => esc_html__( 'Header Navigation', 'video_wp' ),
                'video_wp-secondary-menu' => esc_html__( 'Categories Navigation', 'video_wp' ),
                'video_wp-tertiary-menu' => esc_html__( 'Top / Footer Bar Navigation', 'video_wp' ),
            )
        );
        
        // Localization support
        load_theme_textdomain( 'video_wp', get_template_directory() . '/languages' );
        
        // Feed Links
        add_theme_support( 'automatic-feed-links' );
        
        // Title Tag
        add_theme_support( 'title-tag' );

        // Post thumbnails
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'video_wp-thumbnail-blog-small', 220, 145, true ); // Blog Small Header Top Articles
        add_image_size( 'video_wp-thumbnail-blog-articles', 321, 211, true ); // Blog Latest Articles
        add_image_size( 'video_wp-thumbnail-blog-featured', 667, 430, true ); // Blog thumbnails home featured posts
        add_image_size( 'video_wp-thumbnail-widget-small', 100, 60, true ); // Sidebar Widget thumbnails small
        add_image_size( 'video_wp-thumbnail-video-small', 205, 130, true ); // Blog video small
        add_image_size( 'video_wp-thumbnail-gallery-single', 180, 180, true ); // Gallery thumbnails
        add_image_size( 'video_wp-thumbnail-single-image', 830, '', true ); // Single thumbnails
    
    }
}


// ------------------------------------------------ 
// ---- Add  rel attributes to embedded images ----
// ------------------------------------------------ 
function insert_rel_video_wp($content) {
    $pattern = '/<a(.*?)href="(.*?).(bmp|gif|jpeg|jpg|png)"(.*?)>/i';
    $replacement = '<a$1href="$2.$3" class=\'wp-img-bg-off\' rel=\'mygallery\'$4>';
    $content = preg_replace( $pattern, $replacement, $content );
    return $content;
}
add_filter( 'the_content', 'insert_rel_video_wp' );

// ---- Add  rel attributes to gallery images ----
add_filter('wp_get_attachment_link', 'add_gallery_id_rel_video_wp');
function add_gallery_id_rel_video_wp($link) {
    global $post;
    return str_replace('<a href', '<a rel="mygallery" class="wp-img-bg-off" href', $link);
}


// ------------------------------------------------ 
// --- Pagination class/style for entry articles --
// ------------------------------------------------ 
function custom_nextpage_links_video_wp($defaults) {
$args = array(
'before' => '<div class="my-paginated-posts"><p>' . '<span>',
'after' => '</span></p></div>',
);
$r = wp_parse_args($args, $defaults);
return $r;
}
add_filter('wp_link_pages_args','custom_nextpage_links_video_wp');


// ------------------------------------------------ 
// ------------ Nr of Topics for Tags -------------
// ------------------------------------------------  
add_filter ( 'wp_tag_cloud', 'tag_cloud_count_video_wp' );
function tag_cloud_count_video_wp( $return ) {
return preg_replace('#(<a[^>]+\')(\d+)( topics?\'[^>]*>)([^<]*)<#imsU','$1$2$3$4 <span>($2)</span><',$return);
}

// -- Pagination fix for custom loops on pages for 4.4.1 */
add_filter('redirect_canonical','video_wp_redirect_canonical');
function video_wp_redirect_canonical($redirect_url) {if (is_paged() && is_singular()) $redirect_url = false; return $redirect_url; }

// ------------------------------------------------ 
// --------------- Posts Time Ago -----------------
// ------------------------------------------------  
function time_ago_video_wp( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
    return human_time_diff($d('U'), current_time('timestamp')) . " ";
}


// ----------------------------------------------
// ---------- excerpt length adjust -------------
// ----------------------------------------------
function video_wp_excerpt($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    
    return $sub . (($len < strlen($str)) ? ' ..' : '');
}



// ------------------------------------------------ 
// ------------ Number of post views --------------
// ------------------------------------------------

 // function to display number of posts.
function getPostViews_video_wp($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return '0 <span>' . esc_html__('View', 'video_wp') . '</span>';
    }
    return $count.' <span>' . esc_html__('Views', 'video_wp') . '</span>';
}

// function to count views.
function setPostViews_video_wp($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// ------------------------------------------------ 
// --- One Click Demo Import (Plugin) -------------
// ------------------------------------------------ 
function kickcube_wp_plugin_intro_text( $kickcube_wp_default_text ) {
    $kickcube_wp_default_text =  /* https://wordpress.org/plugins/one-click-demo-import/faq/ the inline style is added for the demo import plugin, that is displayed via Dashboard > Appearance. */ '<div class="ocdi__intro-text" style="width:355px;">'. esc_html__( 'Please click "Import Demo Data" button only once and wait, it can take a couple of minutes.', 'video_wp' ) .'</div>';?><br /><img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" width="400" hieght="300" alt="img" /><?php
    return $kickcube_wp_default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'kickcube_wp_plugin_intro_text' );

function kickcube_wp_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Main Demo', 'anthemes' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . '/functions/demo/video-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . '/functions/demo/video-widgets.wie',
        ) 
    );
}
add_filter( 'pt-ocdi/import_files', 'kickcube_wp_import_files' );


// ------------------------------------------------ 
// ------------ Meta Box --------------------------
// ------------------------------------------------
$prefix = 'video_wp_';
global $meta_boxes;
$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
    'id' => 'standard',
    'title' => esc_html__( 'Article Page Options', 'video_wp' ),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,

    // Youtube
    'fields' => array(
        // TEXT
        array(
            // Field name - Will be used as label
            'name'  => esc_html__( 'Video Youtube', 'video_wp' ),
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}youtube",
            // Field description (optional)
            'desc'  => esc_html__( 'Add Youtube code ex: HIrMIeN5ttE', 'video_wp' ),
            'type'  => 'text',
            // Default value (optional)
            'std'   => esc_html__( '', 'video_wp' ),
            // CLONES: Add to make the field cloneable (i.e. have multiple value)
            'clone' => false,
        ),
 

    // Vimeo
        // TEXT
        array(
            // Field name - Will be used as label
            'name'  => esc_html__( 'Video Vimeo', 'video_wp' ),
            // Field ID, i.e. the meta key
            'id'    => "{$prefix}vimeo",
            // Field description (optional)
            'desc'  => esc_html__( 'Add Vimeo code ex: 7449107', 'video_wp' ),
            'type'  => 'text',
            // Default value (optional)
            'std'   => esc_html__( '', 'video_wp' ),
            // CLONES: Add to make the field cloneable (i.e. have multiple value)
            'clone' => false,
        ),

    // Gallery
        // IMAGE UPLOAD
        array(
            'name' => esc_html__( 'Gallery', 'video_wp' ),
            'id'   => "{$prefix}slider",
            // Field description (optional)
            'desc'  => esc_html__( 'Image with any size!', 'video_wp' ),            
            'type' => 'image_advanced',
        ),

    // Hide Featured Image
        // CheckBox
        array(
            'name' => esc_html__( 'Featured Image', 'video_wp' ),
            'id'   => "{$prefix}hideimg",
            'desc'  => esc_html__( 'Hide Featured Image on single page for this article', 'video_wp' ),
            'type' => 'checkbox',
        ),


    ),

);



/**
 * Register meta boxes
 *
 * @return void
 */
function video_wp_register_meta_boxes()
{
    // Make sure there's no errors when the plugin is deactivated or during upgrade
    if ( !class_exists( 'RW_Meta_Box' ) )
        return;

    global $meta_boxes;
    foreach ( $meta_boxes as $meta_box )
    {
        new RW_Meta_Box( $meta_box );
    }
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'video_wp_register_meta_boxes' );


// ------------------------------------------------ 
// ---------- TGM_Plugin_Activation -------------
// ------------------------------------------------ 
 include( get_template_directory() . '/functions/custom/class-tgm-plugin-activation.php');
 add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

    $plugins = array(
        array(
            'name'                  => 'Shortcodes', // The plugin name
            'slug'                  => 'anthemes-shortcodes', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/anthemes-shortcodes.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

        array(
            'name'                  => 'Reviews', // The plugin name
            'slug'                  => 'anthemes-reviews', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/anthemes-reviews.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),


        array(
            'name'                  => esc_html__( 'One Click Demo Import', 'video_wp' ),
            'slug'                  => 'one-click-demo-import',
            'required'              => false,
            'version'               => '',
        ),

        array(
            'name'                  => 'Meta Box',
            'slug'                  => 'meta-box',
            'required'              => true,
            'version'               => '',
        ),

        array(
            'name'                  => 'Responsive Menu',
            'slug'                  => 'responsive-menu',
            'required'              => false,
            'version'               => '',
        ),


        array(
            'name'                  => 'WP Facebook Open Graph protocol',
            'slug'                  => 'wp-facebook-open-graph-protocol',
            'required'              => false,
            'version'               => '',
        ),

        
        array(
            'name'                  => 'AccessPress Anonymous Post',
            'slug'                  => 'accesspress-anonymous-post',
            'required'              => false,
            'version'               => '',
        ),

 
        array(
            'name'                  => 'Daves WordPress Live Search',
            'slug'                  => 'daves-wordpress-live-search',
            'required'              => false,
            'version'               => '',
        ),


        array(
            'name'                  => 'WP-PageNavi',
            'slug'                  => 'wp-pagenavi',
            'required'              => false,
            'version'               => '',
        ),

    );



    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'tgmpa';
    $config = array(
        'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
        'parent_url_slug'   => 'themes.php',                // Default parent URL slug
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required Plugins', 'video_wp' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'video_wp' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'video_wp' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'video_wp' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'video_wp' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'video_wp' ),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'video_wp' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}

?>