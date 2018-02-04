<?php 
/* 
Template Name: Template - Contact
*/ 
?>

<?php
    // Options from admin panel
    global $smof_data;

    if (empty($smof_data['contact_email'])) { $smof_data['contact_email'] = ''; }
    if (empty($smof_data['contact_confirmation'])) { $smof_data['contact_confirmation'] = 'Thanks, your email was sent successfully.'; }
?>

<?php
if(isset($_POST['submitted'])) {
  if(trim($_POST['contactName']) === '') {
    $nameError = 'Please enter your name.';
    $hasError = true;
  } else {
    $name = trim($_POST['contactName']);
  }

  if(trim($_POST['emaill']) === '')  {
    $emailError = 'Please enter your email address.';
    $hasError = true;
  } else if (preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/", trim($_POST['emaill']))) {
    $emailError = 'You entered an invalid email address.';
    $hasError = true;
  } else {
    $emaill = trim($_POST['emaill']);
  }


  if(trim($_POST['subject']) === '') {
    $subjectError = 'Please enter your subject.';
    $hasError = true;
  } else {
    $subject = trim($_POST['subject']);
  }


  if(trim($_POST['comments']) === '') {
    $commentError = 'Please enter a message.';
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
    } else {
      $comments = trim($_POST['comments']);
    }
  }
 
  if(!isset($hasError)) {
    $emailTo = $smof_data['contact_email'];
    if (!isset($emailTo) || ($emailTo == '') ){
    $emailTo = get_option('admin_email');

    }
    $body = "Name: $name \nEmail: $emaill \nSubject: $subject \n\nMessage: $comments";
    $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emaill;

    mail($emailTo, $subject, $body, $headers);
    $emailSent = true;
  }

} ?>

<?php get_header(); // add header  ?>

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
                          <div class="clear"></div>


                           <?php if(isset($emailSent) && $emailSent == true) { ?>
                           <div class="boxsucces"> <p><?php echo wp_kses_post($smof_data['contact_confirmation']); ?></p> </div>
                           <?php } else { ?>

                           <div class="error">
                              <?php if(isset($hasError) || isset($captchaError)) { ?>
                              <div class="boxerror">
                                <span><?php esc_html_e('Sorry, an error occured.', 'video_wp'); ?></span>
                              </div>
                              <?php } ?>
                           </div>


                            <script type="text/javascript">jQuery(document).ready(function() { if (jQuery().validate) { jQuery("#contactform").validate(); } }); // jQuery(document).</script>
                            <form id="contactform" method="post" action="<?php the_permalink(); ?>">
                            <fieldset id="contactform">                                      

                             <div class="one_half_c">
                                 <label for="contactName"><?php esc_html_e('Name:', 'video_wp'); ?><span>*</span></label>
                                 <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo esc_attr($_POST['contactName']);?>" class="required requiredField contactName"  />
                             </div>
                                                         
                             <div class="one_half_last_c">
                                 <label for="emaill"><?php esc_html_e('Email:', 'video_wp'); ?><span>*</span></label>
                                 <input type="text" name="emaill" id="emaill" value="<?php if(isset($_POST['emaill']))  echo esc_attr($_POST['emaill']);?>" class="required requiredField email" />
                             </div>

                             <div class="one_full_c">
                                 <label for="subject"><?php esc_html_e('Subject:', 'video_wp'); ?><span>*</span></label>
                                 <input type="text" name="subject" id="subject" value="<?php if(isset($_POST['subject'])) echo esc_attr($_POST['subject']);?>" class="required requiredField subject" />
                             </div>   

                             <div class="one_full_c">
                                 <label for="comments"><?php esc_html_e('Message:', 'video_wp'); ?><span>*</span> </label>
                                 <textarea name="comments" id="contactmessage" rows="" cols=""><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo wp_kses_post(stripslashes($_POST['comments'])); } else { echo wp_kses_post($_POST['comments']); } } ?></textarea>
                             </div>

                                <input type="submit" name="submit" class="sendemail" value="<?php esc_html_e('Submit Message', 'video_wp'); ?>"  /> <span>*</span><?php esc_html_e('All Fields are mandatory!', 'video_wp'); ?>
                                <input type="hidden" name="submitted" id="submitted" value="true" /> 
                            </fieldset>
                            </form>
                          <?php } ?><br />

                        </div><!-- end #entry -->
            </div><!-- end .post -->
            <?php endwhile; endif; ?>
        </article>
    </div><!-- end .single-content -->

    <!-- Begin Sidebar (right) -->
    <?php  get_sidebar(); // add sidebar ?>
    <!-- end #sidebar  (right) -->    

    <div class="clear"></div>
</div><!-- end .wrap-fullwidth -->

<?php get_footer(); // add footer  ?>