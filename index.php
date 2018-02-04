<?php get_header(); // add header  ?>
<?php
    // Options from admin panel
    global $smof_data;
    
    // Hide Date format
    $dateformathide = (isset($smof_data['dateformathide'])) ? $smof_data['dateformathide'] : '0'; 
    // Date format
    $dateformat = (isset($smof_data['dateformat'])) ? $smof_data['dateformat'] : 'M j, Y';
?>


<!-- Begin wrap middle -->
<div class="wrap-middle">


    <!-- Begin Main Wrap Content -->
    <div class="wrap-content">
        <div class="wrap-left-content">

            <!-- Begin Latest Articles Content -->
            <div class="articles-content">
                <?php if (is_category()) { ?> 
                    <div class="article-btn"><?php esc_html_e( 'All posts in:', 'video_wp' ); ?> <?php single_cat_title(''); ?></h3></div><br />
                    <div class="cat-info"><?php echo category_description(); ?></div>
                <?php } elseif (is_tag()) { ?>
                    <div class="article-btn"><?php esc_html_e( 'All posts tagged in:', 'video_wp' ); ?> <?php single_tag_title(''); ?></h3></div><br /> 
                    <div class="cat-info"><?php echo tag_description(); ?></div>
                <?php } elseif (is_search()) { ?>
                    <div class="article-btn"><?php printf( esc_html__( 'Search Results for: %s', 'video_wp' ), '' . get_search_query() . '' ); ?></h3></div>
                <?php } elseif (is_author()) { ?> 
                        <div class="article-btn"><?php esc_html_e( 'All posts by:', 'video_wp' ); ?> <?php the_author(); ?></h3></div>
                <?php } elseif (is_404()) { ?> 
                    <div class="article-btn"><?php esc_html_e('Error 404 - Not Found', 'video_wp'); ?> <br /> <?php esc_html_e('Sorry, but you are looking for something that isn\'t here.', 'video_wp'); ?></h3></div>
                <?php } ?>
                <div class="clear"></div>

                <ul class="modern-articles">
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

                            <div class="artbtn-category"><?php $category = get_the_category(); if ($category) 
                                { echo wp_kses_post('<a href="' . get_category_link( $category[0]->term_id ) . '" class="tiptipBlog" title="' . sprintf( esc_html__( "View all posts in %s", "video_wp" ), $category[0]->name ) . '" ' . '>' . $category[0]->name.'</a> ');}  ?>
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
                             </div>
                        </div><!-- end .content -->
                    </li>

                <?php endwhile; endif; ?>
                </ul>
                <!-- end .modern-articles -->


                <!-- Pagination -->
                <?php if(function_exists('wp_pagenavi')) { ?>
                    <?php wp_pagenavi(); ?>
                <?php } else { ?>
                <div class="defaultpag">
                    <div class="sright"><?php next_posts_link('' . esc_html__('Older Entries', 'video_wp') . ' &rsaquo;'); ?></div>
                    <div class="sleft"><?php previous_posts_link('&lsaquo; ' . esc_html__('Newer Entries', 'video_wp') . ''); ?></div>
                </div>
                <?php } ?>
                <!-- pagination -->

            </div><!-- end .articles-content -->
        </div><!-- end .wrap-left-content -->
    
     
            <!-- Begin Sidebar (right) -->
	   <!-- end #sidebar  (right) -->   
    </div><!-- end .wrap-content -->

        
<div class="clear"></div>
</div><!-- end .wrap-middle -->
<?php get_footer(); // add footer  ?>
