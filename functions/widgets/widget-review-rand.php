<?php
// ------------------------------------------------------
// ------ Random Reviews  ---------------------------------
// ------ by Anthemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class video_wp_randreviews extends WP_Widget {
    function video_wp_randreviews() {
      $widget_ops = array('description' => esc_html__('Your site\'s Random Reviews.', 'video_wp'));
      parent::__construct(false, $name = ''. esc_html__('Custom: Random Reviews', 'video_wp') .'',$widget_ops); 
    }


    function widget($args, $instance) {   
    extract( $args );
    $number = $instance['number'];
    $title = $instance['title'];
?>



<?php echo $before_widget; ?>
<?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?>

<?php
    // Options from admin panel
    global $smof_data;

    // Hide Date format
    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';
?>

<ul class="article_list">
<?php $anposts = new WP_Query(array('meta_key' => 'taq_review_score', 'ignore_sticky_posts' => 1, 'orderby' => 'rand', 'order' => 'DESC', 'posts_per_page' => esc_attr($number) )); // number to display more / less ?>
<?php while ( $anposts->have_posts() ) : $anposts->the_post(); ?>

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
 
<?php endwhile; wp_reset_postdata(); ?>
</ul>


<?php echo $after_widget; ?> 


<?php
    }
    function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = strip_tags($new_instance['number']);
    return $instance;
    }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance );
?>


        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e( 'Title:', 'video_wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php if( isset($instance['title']) ) echo esc_attr($instance['title']); ?>" />
        </p>

         <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of Posts:', 'video_wp' ); ?></label>      
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php if( isset($instance['number']) ) echo esc_attr($instance['number']); ?>" />
         </p> 

<?php  } } 
add_action('widgets_init', create_function('', 'return register_widget("video_wp_randreviews");')); // register widget
?>