<?php
// ------------------------------------------------------
// ------ Posts by Categories  --------------------------
// ------ by Anthemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class video_wp_module3 extends WP_Widget {
     function video_wp_module3() {
      $widget_ops = array('description' => esc_html__('== M3 == Display 1+4 articles with small thumbnails.', 'video_wp'));
        parent::__construct(false, $name = '<i>'. esc_html__('Module 3: Articles by Categories', 'video_wp') .'</i>',$widget_ops);  
    }



    function widget($args, $instance) {   
        extract( $args );
        $title = $instance['title'];
        $category = $instance['category'];
        ?>

<?php
    // Get the ID of a given category
    $category_id = $category;

    // Get the URL of this category
    $category_link = get_category_link( $category_id );
?>


<?php echo $before_widget; ?>

<?php
    // Options from admin panel
    global $smof_data;

    // Hide Date format
    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';
?>
                <div class="full_col_home">
                    <div class="article-btn black-color"><?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?></div><a class="more-cats" href="<?php echo esc_url( $category_link ); ?>"><?php esc_html_e( 'more', 'video_wp' ); ?> <i class="fa fa-caret-right" aria-hidden="true"></i></a><div class="clear"></div>
                    <div class="one_half_home">
                        <ul class="modern-articles">
                        <?php query_posts( array( 'post_type' => 'post',  'ignore_sticky_posts' => 1, 'cat' => esc_attr($category), 'posts_per_page' => 1 )); ?>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
                            <li>
                                <?php // Reviews
                                if(function_exists('taqyeem_get_score')) { ?><?php taqyeem_get_score(); ?><?php }  // Review Points ?>

                                <?php if ( has_post_thumbnail()) { ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('video_wp-thumbnail-blog-articles', array('title' => "")); ?></a>
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
                                <a href="<?php the_permalink(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/images/no-photo-321.png" alt="article image" /></a>         
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
                                <?php } ?><div class="clear"></div> 

                                    <div class="artbtn-category"><?php $categoryname = get_the_category(); if ($categoryname) 
                                        { echo wp_kses_post('<a href="' . get_category_link( $categoryname[0]->term_id ) . '" class="tiptipBlog" title="' . sprintf( esc_html__( "View all posts in %s", "video_wp" ), $categoryname[0]->name ) . '" ' . '>' . $categoryname[0]->name.'</a> ');}  ?>
                                    </div><!-- end .artbtn-category -->

                                <div class="content-list">
                                     <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                     <div class="clear"></div>
                                     <!-- Author avatar and link -->
                                     <div class="author-il">
                                         <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 16 ); ?></a>
                                         <div class="link-author"><?php the_author_posts_link(); ?></div> <i class="fa fa-times"></i>
                                         <div class="time-article">
                                          <?php if ($dateformathide == '0') { ?>
                                          <a href="<?php the_permalink(); ?>"><?php echo time_ago_video_wp(); ?> <?php esc_html_e('ago', 'video_wp'); ?></a>
                                          <?php } else { ?>
                                          <a href="<?php the_permalink(); ?>"><?php the_time(''. $smof_data["dateformat"] .''); ?></a>
                                          <?php } ?>
                                         </div>
                                         <div class="clear"></div>
                                         <p><?php echo video_wp_excerpt(strip_tags(strip_shortcodes(get_the_excerpt())), 140); ?></p>
                                     </div>
                                </div><!-- end .content -->
                            </li>
                        <?php endwhile; endif; wp_reset_query(); ?>
                        </ul>
                    </div>

                    <div class="one_half_home_last">
                        <ul class="article_list">
                        <?php query_posts( array( 'post_type' => 'post', 'offset' => 1, 'ignore_sticky_posts' => 1, 'cat' => esc_attr($category), 'posts_per_page' => 4 )); ?>
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

                          <li>
                            <?php // Reviews
                            if(function_exists('taqyeem_get_score')) { ?><?php taqyeem_get_score(); ?><?php }  // Review Points ?>                            
                            
                            <?php if ( has_post_thumbnail()) { ?>
                              <a href="<?php the_permalink(); ?>"> <?php echo the_post_thumbnail('video_wp-thumbnail-widget-small'); ?></a>
                            <?php } else { ?> 
                              <a href="<?php the_permalink(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/images/no-photo-100.png" alt="article image" /></a>         
                            <?php } ?>

                             <!-- Author avatar and link -->
                             <div class="author-il">
                                 <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                 <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 16 ); ?></a>
                                 <div class="link-author"><?php the_author_posts_link(); ?></div> <i class="fa fa-times"></i>
                                 <div class="time-article">
                                          <?php if ($dateformathide == '0') { ?>
                                          <a href="<?php the_permalink(); ?>"><?php echo time_ago_video_wp(); ?> <?php esc_html_e('ago', 'video_wp'); ?></a>
                                          <?php } else { ?>
                                          <a href="<?php the_permalink(); ?>"><?php the_time(''. $smof_data["dateformat"] .''); ?></a>
                                          <?php } ?>
                                 </div>
                                 <div class="clear"></div>
                             </div>
                          </li>

                        <?php endwhile; endif; wp_reset_query(); ?>
                        </ul><!-- end .mv_list_small -->
                    </div><div class="clear"></div>
                </div><!-- end .full_col_home -->
                <div class="line_bottom_col"></div>


<?php echo $after_widget; ?> 


<?php
    }
    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['category']  = wp_strip_all_tags( $new_instance['category'] );
    return $instance;
    }

  function form( $instance ) {
    $defaults  = array( 'title' => '', 'category' => '');
    $instance  = wp_parse_args( ( array ) $instance, $defaults );
    $title     = $instance['title'];
    $category  = $instance['category'];
?>


        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'video_wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo esc_attr($instance['title']); ?>" />
        </p>
      
        <p>
          <label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e( 'Category:', 'video_wp' ); ?></label>      
            <?php
            wp_dropdown_categories( array(

              'show_count' => 1,
              'orderby'    => 'title',
              'hide_empty' => false,
              'name'       => $this->get_field_name( 'category' ),
              'id'         => 'rpjc_widget_cat_recent_posts_category',
              'class'      => 'widefat',
              'selected'   => $category

            ) );
            ?>
        </p> 

<?php  } } 
add_action('widgets_init', create_function('', 'return register_widget("video_wp_module3");')); // register widget
?>