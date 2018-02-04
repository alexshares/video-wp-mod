<style type="text/css"><?php
    // Options from admin panel
    global $smof_data;

    if (empty($smof_data['custom_css_style'])) { $smof_data['custom_css_style'] = ''; }
    if (empty($smof_data['entry_linkcolor'])) { $smof_data['entry_linkcolor'] = ''; }
    if (empty($smof_data['entry_linkbgcolor'])) { $smof_data['entry_linkbgcolor'] = ''; }
    if (empty($smof_data['main_color1'])) { $smof_data['main_color1'] = ''; }
    if (empty($smof_data['main_color2'])) { $smof_data['main_color2'] = ''; }
    if (empty($smof_data['main_color3'])) { $smof_data['main_color3'] = ''; }
    if (empty($smof_data['main_color_menu'])) { $smof_data['main_color_menu'] = ''; }
    if (empty($smof_data['main_color_menu_links'])) { $smof_data['main_color_menu_links'] = ''; }
    if (empty($smof_data['main_color_hoversocial'])) { $smof_data['main_color_hoversocial'] = ''; }
    if (empty($smof_data['main_color_current_link'])) { $smof_data['main_color_current_link'] = ''; }
    if (empty($smof_data['footer_bgcolor'])) { $smof_data['footer_bgcolor'] = ''; }
    if (empty($smof_data['shadow_1'])) { $smof_data['shadow_1'] = '3'; }
    if (empty($smof_data['shadow_2'])) { $smof_data['shadow_2'] = '10'; }
    if (empty($smof_data['to_small_sidebar'])) { $smof_data['to_small_sidebar'] = 'left'; }

if($smof_data['custom_css_style']) {
	echo stripslashes($smof_data['custom_css_style']); //Custom CSS 
}
if($smof_data['entry_linkcolor']) {// color link
    echo esc_html('.entry p a { color: '. $smof_data['entry_linkcolor'] .' !important;}');
}
if($smof_data['entry_linkbgcolor']) {// bg color link
    echo esc_html('.entry p a { background-color: '. $smof_data['entry_linkbgcolor'] .' !important;}');
}

if($smof_data['footer_bgcolor']) {// bg color footer
    echo esc_html('footer div.social-section { background-color: '. $smof_data['footer_bgcolor'] .' !important;}');
}

if($smof_data['main_color1']) {// 1st main color.
    echo esc_html('.trending-btn, .article-btn, .review-score, .review-box-nr, input.ap-form-submit-button, .single-category a, #tags-wrap, #commentform #sendemail, .copyright-btn, ul.modern-articles li.sticky { background-color: '. $smof_data['main_color1'] .' !important;}');
    echo esc_html('#mcTagMap .tagindex h4, #sc_mcTagMap .tagindex h4 { border-bottom: 5px solid '. $smof_data['main_color1'] .' !important;}');
    echo esc_html('#top-slider ul li .metadiv a, ul.modern-articles li .author-il div.link-author a, ul.modern-articles li .author-il div.time-article a, .entry-top div.link-author a, .entry-top div.time-article a, .entry-top div.views-article a, .entry-top div.views-article a span, ul.article_list li .author-il div.link-author a, ul.article_list li .author-il div.time-article a { border-bottom: 1px solid '. $smof_data['main_color1'] .' !important;}');
}
if($smof_data['main_color2']) {// 2nd main color.
    echo esc_html('.footer-copyright a, a:hover, div.tagcloud span, #mcTagMap .tagindex h4, #sc_mcTagMap .tagindex h4, ul.modern-articles li a:hover h2 { color: '. $smof_data['main_color2'] .' !important;}');
    echo esc_html('#small-sidebar, .artbtn-category, .wp-pagenavi a:hover, .wp-pagenavi span.current, .my-paginated-posts span, #featured-slider, #featured-slider2 .artbtn-category, #contactform .sendemail, .social-section, #back-top span { background-color: '. $smof_data['main_color2'] .' !important;}');
}
if($smof_data['main_color3']) {// 3rd main color.
    echo esc_html('.my-paginated-posts a:hover, .black-color, #content-top-slider, .wp-pagenavi a, .wp-pagenavi span, .my-paginated-posts p a, #related-wrap, .widget-title, .comments h3.comment-reply-title, form.wpcf7-form input.wpcf7-submit, footer { background-color: '. $smof_data['main_color3'] .' !important; }');
}


if($smof_data['main_color_menu']) {// background color
    echo esc_html('.main-menu { background-color: '. $smof_data['main_color_menu'] .' !important;}');
}
if($smof_data['main_color_menu_links']) {// color link
    echo esc_html('.main-menu a { color: '. $smof_data['main_color_menu_links'] .' !important;}');
}
if($smof_data['main_color_hoversocial']) {// color link
    echo esc_html('.top-social li a:hover { color: '. $smof_data['main_color_hoversocial'] .' !important;}');
} 
if($smof_data['main_color_current_link']) {// color link
    echo stripslashes('.jquerycssmenu ul li.current_page_item > a, .jquerycssmenu ul li.current-menu-ancestor > a, .jquerycssmenu ul li.current-menu-item > a, .jquerycssmenu ul li.current-menu-parent > a { color: '. $smof_data['main_color_current_link'] .' !important;}');
} 
if($smof_data['shadow_1'] || $smof_data['shadow_2'] ) {// shadows
    echo stripslashes('.jquerycssmenu ul li.current_page_item > a, .jquerycssmenu ul li.current-menu-ancestor > a, .jquerycssmenu ul li.current-menu-item > a, .jquerycssmenu ul li.current-menu-parent > a { -moz-box-shadow: 0 '. $smof_data['shadow_1'] .'px '. $smof_data['shadow_2'] .'px rgba(0,0,0,0.2) !important; -webkit-box-shadow: 0 '. $smof_data['shadow_1'] .'px '. $smof_data['shadow_2'] .'px rgba(0,0,0,0.2) !important; box-shadow: 0 '. $smof_data['shadow_1'] .'px '. $smof_data['shadow_2'] .'px rgba(0,0,0,0.2) !important;}');
} 

if($smof_data['to_small_sidebar']) {// sidebar left/right
    echo esc_html('#small-sidebar { float: '. $smof_data['to_small_sidebar'] .' !important;}');
}

?>
</style>
