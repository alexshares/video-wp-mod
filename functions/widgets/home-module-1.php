<?php
// ------------------------------------------------------
// ------ Slider- Featured Articles  --------------------
// ------ by AnThemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class video_wp_module1 extends WP_Widget {
     function video_wp_module1() {
      $widget_ops = array('description' => esc_html__('== M1 == Display Slider with Featured Articles by Tag.', 'video_wp'));
        parent::__construct(false, $name = '<i>'. esc_html__('Module 1: Slider - Featured Articles', 'video_wp') .'</i>',$widget_ops);  
    }



    function widget($args, $instance) {   
        extract( $args );
        $number = $instance['number'];
        $tag = $instance['tag'];
        ?>



<?php echo $before_widget; ?>


                <!-- Featured Slider Section -->
                <div id="featured-slider">
                  <?php  query_posts( array( 'post_type' => 'post', 'tag' => esc_attr($tag), 'posts_per_page' => esc_attr($number)) );  ?> 
                  <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
                    <div class="item">
                        <?php // Reviews
                        if(function_exists('taqyeem_get_score')) { ?><?php taqyeem_get_score(); ?><?php }  // Review Points ?>

                        <?php if ( has_post_thumbnail()) { ?>
                            <?php the_post_thumbnail('video_wp-thumbnail-blog-featured', array('title' => "")); ?> 

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

                        <?php } ?>
                        <div class="content">
                            <div class="artbtn-category"><?php $category = get_the_category(); if ($category) 
                                { echo wp_kses_post('<a href="' . get_category_link( $category[0]->term_id ) . '" class="tiptipBlog" title="' . sprintf( esc_html__( "View all posts in %s", "video_wp" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ');}  ?>
                            </div><!-- end .artbtn-category -->
                            <div class="artbtn-featured"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Featured', 'video_wp' ); ?></a> </div> 
                            <div class="clear"></div>                              
                            <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                        </div><!-- end .content -->
                    </div><!-- end .item -->
                  <?php endwhile; endif; wp_reset_query();  ?>
                </div><!-- end #featured-slider -->
                <div class="clear"></div>


<?php echo $after_widget; ?> 


<?php
    }
    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['tag'] = strip_tags($new_instance['tag']);
    $instance['number']    = is_numeric( $new_instance['number'] ) ? intval( $new_instance['number'] ) : 5;
    return $instance;
    }

  function form( $instance ) {
    $defaults  = array( 'tag' => 'featured', 'number' => 5 );
    $instance  = wp_parse_args( ( array ) $instance, $defaults );
    $tag     = $instance['tag'];
    $number    = $instance['number'];
?>


        <p>
          <label for="<?php echo $this->get_field_id('tag'); ?>"><?php esc_html_e( 'Tag:', 'video_wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" type="text" value="<?php if( isset($instance['tag']) ) echo esc_attr($instance['tag']); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of Posts:', 'video_wp' ); ?></label>      
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if( isset($instance['number']) ) echo esc_attr($instance['number']); ?>" />
        </p> 

<?php  } } 
add_action('widgets_init', create_function('', 'return register_widget("video_wp_module1");')); // register widget
?>