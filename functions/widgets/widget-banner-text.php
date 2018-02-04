<?php
// ------------------------------------------------------
// ------ Widget Banner  -------------------------------
// ------ by Anthemes.net -------------------------------
//        http://themeforest.net/user/An-Themes/portfolio
//        http://themeforest.net/user/An-Themes/follow 
// ------------------------------------------------------

class video_wp_300px_text extends WP_Widget {
     function video_wp_300px_text() {
	    $widget_ops = array('description' => esc_html__('Advertisement Text.', 'video_wp'));
        parent::__construct(false, $name = ''. esc_html__('Custom: Advertisement 300px Text', 'video_wp') .'',$widget_ops); 
    }

   function widget($args, $instance) {  
		extract( $args );
		$title_tw = $instance['title_tw'];
		$btext = $instance['btext'];
    $bstyle = $instance['bstyle'];
?>		
 
<?php echo $before_widget; ?>	
<?php if ( $title_tw ) echo $before_title . esc_attr( $title_tw ) . $after_title; ?>

<div class="text-300" style="<?php echo stripslashes_deep($bstyle); ?>">
  <?php echo stripslashes_deep($btext); ?>
  <div class="clear"></div>
</div>

  <?php echo $after_widget; ?>
  
<?php
    }

     function update($new_instance, $old_instance) {				
			$instance = $old_instance;
			$instance['title_tw'] = strip_tags($new_instance['title_tw']);
			$instance['btext'] = stripslashes($new_instance['btext']);
      $instance['bstyle'] = stripslashes($new_instance['bstyle']);
     return $instance;
    }

 	function form( $instance ) {

  // Set up some default widget settings
  $defaults = array(
    'title_tw' => 'Advertisement Text',
    'btext' => stripslashes('<img src="http://placehold.it/250x60">
<h3>Up to 60% Off Shared Hosting Plans for<br /> <del>$9.95</del> $3.95</h3>
<a href="#" target="_blank" class="button black">Get Hosting</a>
<a href="#" target="_blank" class="button red">More Info</a>'),
    'bstyle' => stripslashes('border: 3px solid #000000; 
background-color: #FFF;
padding: 20px 0 40px 0;'),    
  );

		$instance = wp_parse_args( (array) $instance, $defaults );
?>

        <p>
          <label for="<?php echo $this->get_field_id('title_tw'); ?>"><?php esc_html_e( 'Title:', 'video_wp' ); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title_tw'); ?>" name="<?php echo $this->get_field_name('title_tw'); ?>" type="text" value="<?php if( isset($instance['title_tw']) ) echo esc_attr($instance['title_tw']); ?>" />
        </p>
        
        <p>
          <label for="<?php echo $this->get_field_id('btext'); ?>"><?php esc_html_e( 'Advertisement HTML:', 'video_wp' ); ?></label>      
          <textarea style="height:100px;" class="widefat" id="<?php echo $this->get_field_id('btext'); ?>" name="<?php echo $this->get_field_name('btext'); ?>" ><?php if( isset($instance['btext']) ) echo stripslashes($instance['btext']); ?></textarea>
        </p> 

        <p>
          <label for="<?php echo $this->get_field_id('bstyle'); ?>"><?php esc_html_e( 'Custom CSS Style:', 'video_wp' ); ?></label>      
          <textarea style="height:100px;" class="widefat" id="<?php echo $this->get_field_id('bstyle'); ?>" name="<?php echo $this->get_field_name('bstyle'); ?>" ><?php if( isset($instance['bstyle']) ) echo stripslashes($instance['bstyle']); ?></textarea>
        </p> 

<?php  } }
add_action('widgets_init', create_function('', 'return register_widget("video_wp_300px_text");')); // register widget
?>