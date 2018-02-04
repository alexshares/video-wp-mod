<?php get_header(); // add header ?>  
<?php
    // Options from admin panel
    global $smof_data;

    // Related Articles by Tags and Tags
    $to_related_art_hide = (isset($smof_data['to_related_art_hide'])) ? $smof_data['to_related_art_hide'] : 'No';

    // Comments
    $to_comm_hide = (isset($smof_data['to_comm_hide'])) ? $smof_data['to_comm_hide'] : 'No';

    // Social Share Icons
    $socialshare_hide = (isset($smof_data['socialshare_hide'])) ? $smof_data['socialshare_hide'] : 'No';

    // Hide Date format
    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';
?>

 
<!-- Begin Content -->
<div class="wrap-fullwidth">

    <div class="single-content">
        <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
        <div class="entry-top">
            <div class="single-category"> 
                <?php the_category(' '); ?>
            </div><!-- end .single-category -->
            <div class="clear"></div>  
            <h1 class="article-title entry-title"><?php the_title(); ?></h1>
            <div class="link-author"><span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span></div> <i class="fa fa-times"></i>
            <div class="time-article updated">
                <?php if ($dateformathide == '0') { ?>
                    <a href="<?php the_permalink(); ?>"><?php echo time_ago_video_wp(); ?> <?php esc_html_e('ago', 'video_wp'); ?></a>
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>"><?php the_time(''. $smof_data["dateformat"] .''); ?></a>
                <?php } ?>
            </div>
            <i class="fa fa-times"></i>
            <div class="views-article"><a href="<?php the_permalink(); ?>"><?php echo getPostViews_video_wp(get_the_ID()); ?></a></div>
            <div class="clear"></div>
        </div><div class="clear"></div>
        <?php endwhile; endif; ?>


        <article>
            <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
            <?php setPostViews_video_wp(get_the_ID()); ?>
            <div <?php post_class('post') ?> id="post-<?php the_ID(); ?>">

            <div class="media-single-content">
            <?php if ( function_exists( 'rwmb_meta' ) ) {  
            // If Meta Box plugin is activate ?>
                <?php
                $youtubecode = rwmb_meta('video_wp_youtube', true );
                $vimeocode = rwmb_meta('video_wp_vimeo', true );
                $image = rwmb_meta('video_wp_slider', true );
                $hideimg = rwmb_meta('video_wp_hideimg', true );
                ?> 

                <?php if(!empty($image)) { ?>
                    <!-- #### Single Gallery #### -->
                    <div class="single-gallery">
                        <?php
                        $images = rwmb_meta( 'video_wp_slider', 'type=image&size=video_wp-thumbnail-gallery-single' );
                        foreach($images as $key =>$image)
                         { echo wp_kses_post("<a href='{$image['full_url']}' rel='mygallery'><img src='{$image['url']}'  alt='{$image['alt']}'  /></a>");
                        } ?>
                    </div><!-- end .single-gallery -->
                    <div class="clear"></div> 
                <?php } ?>

                <?php if(!empty($youtubecode)) { ?>
                    <!-- #### Youtube video #### -->
                    <?php $video_wp_youtubeembed = '//www.youtube.com/embed/'; ?>
                    <iframe class="single_iframe" width="100%" height="420" src="<?php echo esc_url($video_wp_youtubeembed); ?><?php echo esc_html($youtubecode); ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe>
                <?php } ?>

                <?php if(!empty($vimeocode)) { ?>
                    <!-- #### Vimeo video #### -->
                    <?php $video_wp_vimeoembed = '//player.vimeo.com/video/'; ?>
                    <iframe class="single_iframe" width="100%" height="420" src="<?php echo esc_url($video_wp_vimeoembed); ?><?php echo esc_html($vimeocode); ?>?portrait=0" frameborder="0" allowFullScreen></iframe>
                <?php } ?>

                <?php if(!empty($image) || !empty($youtubecode) || !empty($vimeocode)) { ?>
                <?php } elseif ( has_post_thumbnail()) { ?>
                    <?php if(!empty($hideimg)) { } else { ?>
                     <?php the_post_thumbnail('video_wp-thumbnail-single-image'); ?>
                    <?php } // disable featured image ?>
                <?php } ?>
 
            <?php } else { 
            // Meta Box Plugin ?>
                <?php the_post_thumbnail('video_wp-thumbnail-single-image'); ?>
            <?php } ?> 
            </div><!-- end .media-single-content -->

            <?php if ($socialshare_hide == 'No') { ?>
            <div id="single-share">
                <?php $video_wp_facebooklink = 'https://www.facebook.com/sharer/sharer.php?u='; ?>
                <a class="fbbutton" target="_blank" href="<?php echo esc_url($video_wp_facebooklink); ?><?php the_permalink(); ?>"><i class="fa fa-facebook-official"></i> <span><?php esc_html_e( 'Share', 'video_wp' ); ?></span></a>
                <?php $video_wp_twitterlink = 'https://twitter.com/home?status=Check%20out%20this%20article:%20'; ?>
                <a class="twbutton" target="_blank" href="<?php echo esc_url($video_wp_twitterlink); ?><?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i> <span><?php esc_html_e( 'Tweet', 'video_wp' ); ?></span></a>
                <?php $articleimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
                <?php $video_wp_pinlink = 'https://pinterest.com/pin/create/button/?url='; ?>
                <a class="pinbutton" target="_blank" href="<?php echo esc_url($video_wp_pinlink); ?><?php the_permalink(); ?>&amp;media=<?php echo esc_html($articleimage); ?>&amp;description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i> <span><?php esc_html_e( 'Pin it', 'video_wp' ); ?></span></a>
                <?php $video_wp_googlelink = 'https://plus.google.com/share?url='; ?>
                <a class="googlebutton" target="_blank" href="<?php echo esc_url($video_wp_googlelink); ?><?php the_permalink(); ?>"><i class="fa fa-google-plus-square"></i> <span><?php esc_html_e( 'Google+', 'video_wp' ); ?></span></a>
                <?php $video_wp_emaillink = 'mailto:?subject='; ?>
                <a class="emailbutton" target="_blank" href="<?php echo esc_url($video_wp_emaillink); ?><?php the_title(); ?>&amp;body=<?php the_permalink(); ?> <?php echo video_wp_excerpt(strip_tags(strip_shortcodes(get_the_excerpt())), 140); ?>"><i class="fa fa-envelope"></i> <span><?php esc_html_e( 'Email', 'video_wp' ); ?></span></a>
                <a class="whatsappbutton" target="_blank" href="whatsapp://send?text=<?php the_permalink(); ?>" data-action="share/whatsapp/share"><i class="fa fa-whatsapp" aria-hidden="true"></i> <span><?php esc_html_e( 'WhatsApp', 'video_wp' ); ?></span></a>            
            </div><!-- end #single-share -->
            <?php } ?>
            <div class="clear"></div>


                <div class="entry">
                        <!-- excerpt -->
                        <?php if ( !empty( $post->post_excerpt ) ) : ?> <div class="entry-excerpt"><h3> <?php echo the_excerpt(); ?> </h3></div> <?php else : false; endif;  ?> 

                        <!-- entry content -->
                        <?php the_content(''); // content ?>
                        <?php wp_link_pages(); // content pagination ?>
                        <div class="clear"></div>
                </div><!-- end .entry -->
                <div class="clear"></div> 
            </div><!-- end #post -->
            <?php endwhile; endif; ?>
        </article><!-- end article -->
   

    <?php if ($to_related_art_hide == 'No') : ?>    
        <!-- Related Articles by Tags -->
        <?php $tags = get_the_tags(); 
        if ($tags) { ?>        
        <div id="related-wrap">
         <div class="article-btn"><?php esc_html_e( 'Related Articles by Tags', 'video_wp' ); ?></div><div class="clear"></div>
          <ul class="video-articles">
                                    <?php  
                                        $orig_post = $post;  
                                        global $post;  
                                        $tags = wp_get_post_tags($post->ID);  
                                        if ($tags) {  
                                        $tag_ids = array();  
                                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
                                        $args=array(  
                                        'tag__in' => $tag_ids,  
                                        'post__not_in' => array($post->ID),  
                                        'posts_per_page'=>6, // Number of related posts to display.  
                                        'ignore_sticky_posts'=>1  
                                        );  
                                        $my_query = new wp_query( $args ); 
                                        $num=1; 
                                        while( $my_query->have_posts() ) {  
                                        $my_query->the_post();
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

          <?php } } $post = $orig_post; wp_reset_postdata();?>
          </ul><div class="clear"></div>
        </div><!-- end #related-wrap -->


        <!-- Tags Articles -->
        <div id="tags-wrap">
                <div class="tags-btns"><?php the_tags('', ''); // tags ?></div>
        <div class="clear"></div>
        </div><!-- end #tags-wrap -->
        <?php } else { ?>
            <div class="line_bottom_related"></div>
        <?php } ?>
    <?php endif; ?>     


    <?php if ($to_comm_hide == 'No') : ?>
        <!-- Comments -->
        <div id="comments" class="comments">
            <div class="article-btn"><?php esc_html_e( 'Comments', 'video_wp' ); ?></div>
            <div class="clear"></div>
            <?php comments_template('', true); // comments ?>
        </div>
        <div class="clear"></div>
    <?php endif; ?> 
     
    </div><!-- end .single-content -->


    <!-- Begin Sidebar (right) -->
    <?php  get_sidebar(); // add sidebar ?>
    <!-- end #sidebar  (right) -->    


    <div class="clear"></div>
</div><!-- end .wrap-fullwidth  -->
<?php get_footer(); // add footer  ?>