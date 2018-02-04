<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php
    // Options from admin panel
    global $smof_data;
    
    // Logo
    $site_logo = $smof_data['site_logo'];
    if (empty($site_logo)) { $site_logo = get_template_directory_uri().'/images/logo.png'; }

    // Trending Slider
    if (empty($smof_data['to_trending_tag'])) { $smof_data['to_trending_tag'] = 'trending'; }
    if (empty($smof_data['to_trending_nr'])) { $smof_data['to_trending_nr'] = '5'; }

    // Top Slider, Most viewed Articles
    if (empty($smof_data['to_mostviewed_nr'])) { $smof_data['to_mostviewed_nr'] = '16'; }
    $to_mostviewed_display = (isset($smof_data['to_mostviewed_display'])) ? $smof_data['to_mostviewed_display'] : 'Yes';
    
    // Top Navigation
    $to_topnav_display = (isset($smof_data['to_topnav_display'])) ? $smof_data['to_topnav_display'] : 'Up';

    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';    
?>
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<!-- Title -->
    <?php if ( ! function_exists( '_wp_render_title_tag' ) ) { function theme_slug_render_title() { ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php } add_action( 'wp_head', 'theme_slug_render_title' ); } // Backwards compatibility for older versions. ?> 

    <!-- Mobile Device Meta -->
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui' /> 
    
    <!-- The HTML5 Shim for older browsers (mostly older versions of IE). -->
	<!--[if IE]> <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script> <![endif]-->

	<!-- Rss / pingback -->
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php esc_url(bloginfo('rss2_url')); ?>" />
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>" />

    <!-- Custom style -->
    <?php echo get_template_part('custom-style'); ?>

    <!-- Theme output -->
    <?php wp_head(); ?> 

</head>
<body <?php body_class(); ?>>


<!-- Begin Header -->
<header>
    <?php if ($to_topnav_display == 'Up') : ?>
       	<?php echo do_shortcode('[stock_ticker]'); 	?>
   </div><div class="clear"></div>
    <?php endif; ?>

    <div class="main-menu">
         <div class="wrap">
            <!-- Logo -->    
            <a href="<?php echo esc_url(home_url( '/' )); ?>"><img class="logo" src="<?php echo esc_url(($site_logo)); ?>" alt="<?php bloginfo('sitename'); ?>" /></a>

            <!-- Navigation Menu -->
            <?php if ( has_nav_menu( 'video_wp-primary-menu' ) ) : // Check if there's a menu assigned to the 'Header Navigation' location. ?>
            <nav id="myjquerymenu" class="jquerycssmenu">
                <?php wp_nav_menu( array( 'container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' =>   'video_wp-primary-menu' ) ); ?>
            </nav><!-- end #myjquerymenu -->
            <?php endif; // End check for menu. ?>

            <ul class="top-social">
                <?php if (!empty($smof_data['top_icons'])) { ?>
                    <?php echo stripslashes($smof_data['top_icons']); ?>
                <?php } ?>  
                <li class="md-trigger search" data-modal="modal-7"><a href="#"><i class="fa fa-search"></i></a></li>
            </ul>
        </div><!-- end .wrap -->
     </div><!-- end .main-menu -->


    <?php if ($to_topnav_display == 'Down') : ?>
    <div class="top-navigation">
        <div class="wrap">
            <!-- Trending Articles -->
            <div class="trending-articles">
                <div class="trending-btn"><?php esc_html_e( 'Trending Now', 'video_wp' ); ?></div>
                <ul class="trend-slide">
                  <?php  query_posts( array( 'post_type' => 'post', 'tag' => esc_html($smof_data['to_trending_tag']), 'posts_per_page' => esc_html($smof_data['to_trending_nr']) ));  ?> 
                  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                     
                    <li><a href="<?php the_permalink(); ?>"><strong><?php if ( strlen(get_the_title()) > 54 ) { echo substr(get_the_title(), 0, 50)." ..."; } else { the_title(''); } ?></strong></a></li>
                  <?php endwhile; endif; wp_reset_query();  ?>
                </ul>
            </div>

            <!-- Top Bar Navigation Menu -->
            <?php if ( has_nav_menu( 'video_wp-tertiary-menu' ) ) : // Check if there's a menu assigned to the 'Top / Footer Bar Navigation' location. ?>
            <nav class="toplist">
                <?php  wp_nav_menu( array( 'container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' =>  'tertiary-menu', 'fallback_cb' => false ) ); ?>
            </nav><!-- end #myjquerymenu -->
            <?php endif; // End check for menu. ?>
        </div><!-- end .wrap -->
    </div><div class="clear"></div>
    <?php endif; ?>   
</header><!-- end #header -->


<?php if ($to_mostviewed_display == 'Yes') : ?>
<!-- Top Slider Section -->
<div id="content-top-slider">
<div id="top-slider">
  <ul>
    <?php $headertopplm = new WP_Query(array( 'ignore_sticky_posts' => 1, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'posts_per_page' => esc_html($smof_data['to_mostviewed_nr']) )); // number to display more / less ?>
    <?php while ($headertopplm->have_posts()) : $headertopplm->the_post(); ?> 
 
      <li>
        <?php // Reviews
        if(function_exists('taqyeem_get_score')) { ?><?php taqyeem_get_score(); ?><?php }  // Review Points ?>

        <?php if ( has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail('video_wp-thumbnail-blog-small'); ?></a>
            <div class="artbtn-category"><?php $category = get_the_category(); if ($category) 
                { echo wp_kses_post('<a href="' . get_category_link( $category[0]->term_id ) . '" class="tiptipBlog" title="' . sprintf( esc_html__( "View all posts in %s", "video_wp" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ');}  ?>
            </div><!-- end .artbtn-category --> 

                    <?php if ( function_exists( 'rwmb_meta' ) ) { 
                    // If Meta Box plugin is activate ?>    
                        <?php
                         $youtubecode = rwmb_meta('video_wp_youtube', true );
                         $vimeocode = rwmb_meta('video_wp_vimeo', true );
                        ?>
                        <?php if(!empty($youtubecode) || !empty($vimeocode)) { ?>
                        <a href="<?php the_permalink(); ?>"><div class="media-icon"></div></a>  
                        <?php } ?>
                    <?php } // Meta Box Plugin ?>

          <?php } else { ?> 
            <a href="<?php the_permalink(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/images/no-photo.png" alt="article image" /></a>
            <div class="artbtn-category"><?php $category = get_the_category(); if ($category) 
                { echo wp_kses_post('<a href="' . get_category_link( $category[0]->term_id ) . '" class="tiptipBlog" title="' . sprintf( esc_html__( "View all posts in %s", "video_wp" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ');}  ?>
            </div><!-- end .artbtn-category -->           
          <?php } ?><div class="clear"></div> 


          <div class="metadiv">
            <?php if ($dateformathide == '0') { ?>
                <a href="<?php the_permalink(); ?>"><?php echo time_ago_video_wp(); ?> <?php esc_html_e('ago', 'video_wp'); ?></a>
            <?php } else { ?>
                <a href="<?php the_permalink(); ?>"><?php the_time(''. $smof_data["dateformat"] .''); ?></a>
            <?php } ?>
            <i class="fa fa-times"></i>
            <a href="<?php the_permalink(); ?>"><?php echo getPostViews_video_wp(get_the_ID()); ?></a> 
          </div>
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
       </li>

    <?php endwhile; wp_reset_query(); ?>
  </ul>
</div><!-- end #top-slider -->
</div><!-- end #content-top-slider -->
<div class="clear"></div>
<?php endif; ?>


<div class="md-modal md-effect-7" id="modal-7">
    <div class="md-content">
      <div>
        <!-- search form get_search_form(); -->
        <?php get_search_form(); ?>
        <div class="clear"></div>
        <button class="md-close"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- end .md-content -->
</div><!-- end .md-modal -->
