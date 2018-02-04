<?php
// ------------------------------------------------------
// ------ Posts by Categories  --------------------------
// ------ by Anthemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class video_wp_module2 extends WP_Widget {
     function video_wp_module2() {
      $widget_ops = array('description' => esc_html__('== M2 == Display 3 Articles by category in one row.', 'video_wp'));
        parent::__construct(false, $name = '<i>'. esc_html__('Module 2: Articles by Categories', 'video_wp') .'</i>',$widget_ops);  
    }



    function widget($args, $instance) {   
        extract( $args );
        $number = $instance['number'];
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

    <div class="full_col_home" style="margin-bottom: 5px;">
    <div class="article-btn"><?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?></div><a class="more-cats" href="<?php echo esc_url( $category_link ); ?>"><?php esc_html_e( 'more', 'video_wp' ); ?> <i class="fa fa-caret-right" aria-hidden="true"></i></a><div class="clear"></div>
      <ul class="video-articles">
      <?php query_posts( array( 'post_type' => 'post',  'ignore_sticky_posts' => 1, 'cat' => esc_attr($category), 'posts_per_page' => esc_attr($number)) ); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 

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

      <?php endwhile; endif; wp_reset_query(); ?>
      </ul>
    <div class="clear"></div>
    </div><!-- end .full_col_home -->
    <div class="clear"></div>
    <div class="line_bottom_col" style="margin-top: 20px;"></div>


<?php echo $after_widget; ?> 


<?php
    }
    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number']    = is_numeric( $new_instance['number'] ) ? intval( $new_instance['number'] ) : 6;
    $instance['category']  = wp_strip_all_tags( $new_instance['category'] );
    return $instance;
    }

  function form( $instance ) {
    $defaults  = array( 'title' => '', 'category' => '', 'number' => 6 );
    $instance  = wp_parse_args( ( array ) $instance, $defaults );
    $title     = $instance['title'];
    $category  = $instance['category'];
    $number    = $instance['number'];
?>


        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'video_wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo esc_attr($instance['title']); ?>" />
        </p>

        <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of Posts:', 'video_wp' ); ?></label>      
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if( isset($instance['number']) ) echo esc_attr($instance['number']); ?>" />
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
add_action('widgets_init', create_function('', 'return register_widget("video_wp_module2");')); // register widget
?>