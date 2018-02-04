<?php
// ----------------------------------------------
// ------------ JavaScrips Files ----------------
// ----------------------------------------------


if( !function_exists( 'video_wp_enqueue_scripts' ) ) {
    function video_wp_enqueue_scripts() {

		// Register css files
        wp_register_style( 'video_wp-style', get_stylesheet_uri(), '', '2.1');
		wp_register_style( 'video_wp-default', get_template_directory_uri() . '/css/colors/default.css', TRUE);
		wp_register_style( 'video_wp-responsive', get_template_directory_uri() . '/css/responsive.css', '', '1.7');
        wp_register_style( 'video_wp-fancyboxcss', get_template_directory_uri() . '/fancybox/jquery.fancybox-1.3.4.css', TRUE);       
        wp_register_style( 'video_wp-font-awesome', get_template_directory_uri() . '/css/font-awesome-4.7.0/css/font-awesome.min.css', TRUE);
        wp_register_style( 'video_wp-owl-carousel-css', get_template_directory_uri() . '/owl-carousel/owl.carousel.css', TRUE);

		// Register scripts
		wp_register_script( 'video_wp-customjs', get_template_directory_uri() . '/js/custom.js', 'jquery', '', TRUE);
        wp_register_script( 'video_wp-validatecontact', get_template_directory_uri() . '/js/jquery.validate.min.js', 'jquery', '', TRUE);
        wp_register_script( 'video_wp-mainfiles',  get_template_directory_uri() . '/js/jquery.main.js', 'jquery', '', TRUE);
        wp_register_script( 'video_wp-fancyboxjs', get_template_directory_uri() . '/fancybox/jquery.fancybox-1.3.4.pack.js', 'jquery', '', TRUE);
        wp_register_script( 'video_wp-owl-carouseljs', get_template_directory_uri() . '/owl-carousel/owl.carousel.min.js', 'jquery', '', TRUE);

        // Display js files in Header via wp_head();
        wp_enqueue_style('video_wp-style');
        wp_enqueue_style('video_wp-default');
        wp_enqueue_style('video_wp-owl-carousel-css');
        wp_enqueue_style('video_wp-responsive');
        wp_enqueue_style('video_wp-font-awesome');
        wp_enqueue_script('jquery');

        // Load Comments & .js files.
        if( is_single() ) {
            wp_enqueue_style('video_wp-fancyboxcss');
            wp_enqueue_script('comment-reply');
            wp_enqueue_script('video_wp-fancyboxjs');
         }

        // Load js validate in contact and job page.
        if( is_page_template( 'template-contact.php' ) ) { 
            wp_enqueue_script('video_wp-validatecontact');
         }

        // Load js for masonry style with infinite scroll.
        if( ! is_singular() || is_single() || is_page() || is_page_template( 'template-home.php') ) { 
            wp_enqueue_script('video_wp-owl-carouseljs');
            wp_enqueue_script('video_wp-mainfiles');
         }
 
        // Display js and css files in Footer via wp_footer();
        wp_enqueue_script('video_wp-customjs');


// ----------------------------------------------
// Register Fonts: https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
// ----------------------------------------------
        function video_wp_fonts_url() {
            $font_url = '';
            
            /*
            Translators: If there are characters in your language that are not supported
            by chosen font(s), translate this to 'off'. Do not translate into your own language.
             */
            if ( 'off' !== _x( 'on', 'Google font: on or off', 'video_wp' ) ) {
                $font_url = add_query_arg( 'family', urlencode( 'Droid+Sans:400,700' ), "//fonts.googleapis.com/css" );
            }
            return $font_url;
        }
        /*
        Enqueue styles.
        */
        wp_enqueue_style( 'video_wp-fonts', video_wp_fonts_url(), array(), '1.0.0' );
  



    }
    add_action('wp_enqueue_scripts', 'video_wp_enqueue_scripts');
}
?>