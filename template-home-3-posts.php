<?php 
/* 
Template Name: Template - Home 3 Posts
*/ 
?>
<?php get_header(); // add header  ?>
<?php
    // Options from admin panel
    global $smof_data;

    // Hide Date format
    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';
     // Latest Articles
    $to_home_latestarticles = (isset($smof_data['to_home_latestarticles'])) ? $smof_data['to_home_latestarticles'] : 'Yes';   
?>


<!-- Begin wrap middle -->
<div class="wrap-middle">
    <!-- Small sidebar LEft -->
    <div id="small-sidebar">
        <div class="wrap-categories">
        <?php if ( has_nav_menu( 'video_wp-secondary-menu' ) ) { ?>
        <?php wp_nav_menu(
            array(
                'theme_location'     => 'video_wp-secondary-menu',
                'container'          => 'nav',
                'menu_class'         => 'menu-left',
                'echo'               => true,
                'fallback_cb'        => 'false'
                ));
        ?>
        <?php } else { ?><ul class="menu-left"><li><a href="#"><?php esc_html_e( 'Add Categories Here', 'video_wp' ); ?></a></li></ul><?php } ?>
        </div>
        
        <div id="home-share">
            <?php $video_wp_facebooklink = 'https://www.facebook.com/sharer/sharer.php?u='; ?>
            <a class="fbbutton" target="_blank" href="<?php echo esc_url($video_wp_facebooklink); ?><?php the_permalink(); ?>"><i class="fa fa-facebook-official"></i> <span><?php esc_html_e( 'Share', 'video_wp' ); ?></span></a>
            <?php $video_wp_twitterlink = 'https://twitter.com/home?status=Check%20out%20this%20article:%20'; ?>
            <a class="twbutton" target="_blank" href="<?php echo esc_url($video_wp_twitterlink); ?><?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i> <span><?php esc_html_e( 'Tweet', 'video_wp' ); ?></span></a>
            <?php $articleimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
            <?php $video_wp_pinlink = 'https://pinterest.com/pin/create/button/?url='; ?>
            <a class="pinbutton" target="_blank" href="<?php echo esc_url($video_wp_pinlink); ?><?php the_permalink(); ?>&amp;media=<?php echo esc_html($articleimage); ?>&amp;description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i> <span><?php esc_html_e( 'Pinit', 'video_wp' ); ?></span></a>
            <?php $video_wp_googlelink = 'https://plus.google.com/share?url='; ?>
            <a class="googlebutton" target="_blank" href="<?php echo esc_url($video_wp_googlelink); ?><?php the_permalink(); ?>"><i class="fa fa-google-plus-square"></i> <span><?php esc_html_e( 'Google+', 'video_wp' ); ?></span></a>
            <?php $video_wp_emaillink = 'mailto:?subject='; ?>
            <a class="emailbutton" target="_blank" href="<?php echo esc_url($video_wp_emaillink); ?><?php the_title(); ?>&amp;body=<?php the_permalink(); ?> <?php echo video_wp_excerpt(strip_tags(strip_shortcodes(get_the_excerpt())), 140); ?>"><i class="fa fa-envelope"></i> <span><?php esc_html_e( 'Email', 'video_wp' ); ?></span></a>
        </div><!-- end #home-share -->
    </div><!-- end #small-sidebar -->



    <!-- Begin Main Wrap Content -->
    <div class="wrap-content">
        <div class="wrap-left-content">

            <!-- Begin Latest Articles Content -->
            <div class="articles-content">

                <!-- Home Modules (Widgets) -->
                <?php if ( ! dynamic_sidebar( 'homemodules' ) ) : endif; ?> 
                <!-- End. Home Modules -->

            <?php if ($to_home_latestarticles == 'Yes') { ?>
                <div class="article-btn"><?php esc_html_e( 'Latest Articles', 'video_wp' ); ?></div>
                <div class="clear"></div>

                <ul class="video-articles">
                <?php
                    if ( get_query_var('paged') )  {  $paged = get_query_var('paged'); 
                    } elseif ( get_query_var('page') ) { $paged = get_query_var('page');
                    } else { $paged = 1;  }
                    query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );
                    if (have_posts()) : while (have_posts()) : the_post();
                ?>

          <li>
            <?php // Reviews
            if(function_exists('taqyeem_get_score')) { ?><?php taqyeem_get_score(); ?><?php }  // Review Points ?>

            <?php if ( has_post_thumbnail()) { ?>
            <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail('video_wp-thumbnail-video-small'); ?></a>

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
            <?php } ?><div class="clear"></div> 
            
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          </li>

                <?php endwhile; endif; ?>
                </ul>
                <!-- end .modern-articles -->


                <!-- Pagination -->
                <div class="clear"></div>
                <?php if(function_exists('wp_pagenavi')) { ?>
                    <?php wp_pagenavi(); ?>
                <?php } else { ?>
                <div class="defaultpag">
                    <div class="sright"><?php next_posts_link('' . esc_html__('Older Entries', 'video_wp') . ' &rsaquo;'); ?></div>
                    <div class="sleft"><?php previous_posts_link('&lsaquo; ' . esc_html__('Newer Entries', 'video_wp') . ''); ?></div>
                </div>
                <?php } ?>
                <!-- pagination -->

                <?php wp_reset_query(); ?>

            <?php } // latest Articles ?>
            </div><!-- end .articles-content -->
        </div><!-- end .wrap-left-content -->
    
     
        <!-- Begin Sidebar (right) -->    
        <?php get_template_part('sidebar2'); ?>
        <!-- end #sidebar (right) --> 
    </div><!-- end .wrap-content -->

        
<div class="clear"></div>
</div><!-- end .wrap-middle -->
<?php get_footer(); // add footer  ?>