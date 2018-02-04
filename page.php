<?php 
/* 
Template Name: Template - Default with Sidebar
*/ 
?>
<?php get_header(); // add header ?>  

<?php
    // Options from admin panel
    global $smof_data;

    // Comments
    $to_comm_hide = (isset($smof_data['to_comm_hide'])) ? $smof_data['to_comm_hide'] : 'No';
?>

<!-- Begin Content -->
<div class="wrap-fullwidth">

    <div class="single-content">
        <article>
            <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">             

                  <div id="page-title-box">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                    <div class="page-share">
                        <?php $video_wp_facebooklink = 'https://www.facebook.com/sharer/sharer.php?u='; ?>
                        <a class="fbbutton" target="_blank" href="<?php echo esc_url($video_wp_facebooklink); ?><?php the_permalink(); ?>"><i class="fa fa-facebook-official"></i></a>
                        <?php $video_wp_twitterlink = 'https://twitter.com/home?status=Check%20out%20this%20article:%20'; ?>
                        <a class="twbutton" target="_blank" href="<?php echo esc_url($video_wp_twitterlink); ?><?php the_title(); ?>%20-%20<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                        <?php $articleimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); ?>
                        <?php $video_wp_pinlink = 'https://pinterest.com/pin/create/button/?url='; ?>
                        <a class="pinbutton" target="_blank" href="<?php echo esc_url($video_wp_pinlink); ?><?php the_permalink(); ?>&amp;media=<?php echo esc_html($articleimage); ?>&amp;description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
                        <?php $video_wp_googlelink = 'https://plus.google.com/share?url='; ?>
                        <a class="googlebutton" target="_blank" href="<?php echo esc_url($video_wp_googlelink); ?><?php the_permalink(); ?>"><i class="fa fa-google-plus-square"></i></a>
                        <?php $video_wp_emaillink = 'mailto:?subject='; ?>
                        <a class="emailbutton" target="_blank" href="<?php echo esc_url($video_wp_emaillink); ?><?php the_title(); ?>&amp;body=<?php the_permalink(); ?> <?php echo video_wp_excerpt(strip_tags(strip_shortcodes(get_the_excerpt())), 140); ?>"><i class="fa fa-envelope"></i></a>
                    </div><!-- end .page-share -->
                    <div class="clear"></div>
                  </div>

                  <div class="entry">
                    <?php the_content(''); // content ?>
                    <?php wp_link_pages(); // content pagination ?>
                    <div class="clear"></div><br />
                  </div><!-- end #entry -->
            </div><!-- end .post -->
            <?php endwhile; endif; ?>
        </article>


        <?php if ($to_comm_hide == 'No') : ?> 
            <?php // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) { ?>
                <!-- Comments -->
                <div id="comments" class="comments">
                    <div class="article-btn"><?php esc_html_e( 'Comments', 'video_wp' ); ?></div>
                    <div class="clear"></div>
                    <?php comments_template('', true); // comments ?>
                </div>
                <div class="clear"></div>
            <?php } ?> 
        <?php endif; ?>
            
    </div><!-- end .single-content -->

    <!-- Begin Sidebar (right) -->
    <?php  get_sidebar(); // add sidebar ?>
    <!-- end #sidebar  (right) -->    

    <div class="clear"></div>
</div><!-- end .wrap-fullwidth -->

<?php get_footer(); // add footer  ?>