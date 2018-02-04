<?php
    // Options from admin panel
    global $smof_data;

    // Trending Slider
    if (empty($smof_data['to_trending_tag_footer'])) { $smof_data['to_trending_tag_footer'] = 'trending'; }
    if (empty($smof_data['to_trending_nr_footer'])) { $smof_data['to_trending_nr_footer'] = '10'; }
?> 

<!-- Begin Footer -->
<footer> 
    <div class="social-section">
        <!-- footer social icons. -->
        <?php if (!empty($smof_data['bottom_icons'])) { ?>
            <?php echo wp_kses_post(stripslashes($smof_data['bottom_icons'])); ?>
        <?php } ?>
    </div>



    <div class="footer-navigation">
        <div class="wrap">
            <!-- Trending Articles -->
            <div class="footer-copyright">
                <div class="copyright-btn"><?php if (!empty($smof_data['copyright_footer_year'])) { ?> <?php echo stripslashes($smof_data['copyright_footer_year']); ?> <?php } ?> </div>
                <?php if (!empty($smof_data['copyright_footer'])) { ?>
                    <?php echo stripslashes($smof_data['copyright_footer']); ?>
                <?php } ?> 
            </div>

            <!-- Footer Bar Navigation Menu -->
            <?php if ( has_nav_menu( 'video_wp-tertiary-menu' ) ) : // Check if there's a menu assigned to the 'Top / Footer Bar Navigation' location. ?>
            <nav class="toplist">
                <?php  wp_nav_menu( array( 'container' => false, 'items_wrap' => '<ul>%3$s</ul>', 'theme_location' =>  'video_wp-tertiary-menu', 'fallback_cb' => false ) ); ?>
            </nav><!-- end #myjquerymenu -->
            <?php endif; // End check for menu. ?>
        </div><!-- end .wrap -->
    </div><div class="clear"></div>
 

	<p id="back-top"><a href="#top"><span></span></a></p>
</footer><!-- end #footer -->
<div class="md-overlay"></div><!-- the overlay element for popup search -->

<!-- Menu & link arrows -->
<script type="text/javascript">var jquerycssmenu={fadesettings:{overduration:0,outduration:100},buildmenu:function(b,a){jQuery(document).ready(function(e){var c=e("#"+b+">ul");var d=c.find("ul").parent();d.each(function(g){var h=e(this);var f=e(this).find("ul:eq(0)");this._dimensions={w:this.offsetWidth,h:this.offsetHeight,subulw:f.outerWidth(),subulh:f.outerHeight()};this.istopheader=h.parents("ul").length==1?true:false;f.css({top:this.istopheader?this._dimensions.h+"px":0});h.children("a:eq(0)").css(this.istopheader?{paddingRight:a.down[2]}:{}).append('<img src="'+(this.istopheader?a.down[1]:a.right[1])+'" class="'+(this.istopheader?a.down[0]:a.right[0])+'" style="border:0;" />');h.hover(function(j){var i=e(this).children("ul:eq(0)");this._offsets={left:e(this).offset().left,top:e(this).offset().top};var k=this.istopheader?0:this._dimensions.w;k=(this._offsets.left+k+this._dimensions.subulw>e(window).width())?(this.istopheader?-this._dimensions.subulw+this._dimensions.w:-this._dimensions.w):k;i.css({left:k+"px"}).fadeIn(jquerycssmenu.fadesettings.overduration)},function(i){e(this).children("ul:eq(0)").fadeOut(jquerycssmenu.fadesettings.outduration)})});c.find("ul").css({display:"none",visibility:"visible"})})}};var arrowimages={down:['downarrowclass', '<?php echo get_template_directory_uri(); ?>/images/menu/arrow-down.png'], right:['rightarrowclass', '<?php echo get_template_directory_uri(); ?>/images/menu/arrow-right.png']}; jquerycssmenu.buildmenu("myjquerymenu", arrowimages); jquerycssmenu.buildmenu("myjquerymenu-cat", arrowimages);</script>

<!-- Footer Theme output -->
<?php wp_footer();?>
</body>
</html>