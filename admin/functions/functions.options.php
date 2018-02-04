<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		$imgs_url = get_template_directory_uri().'/images/';
		$imgs_url_demo = get_template_directory_uri().'/demo';



// Set the Options Array
global $of_options;
$of_options = array();
 

 

/*-----------------------------------------------------------------------------------*/
/* Header Settings */
/*-----------------------------------------------------------------------------------*/

$of_options[] = array( 	"name" 		=> "Header Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-header.png"
				);


$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "",
						"id" 		=> "introduction_7",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Logo</h3>
						Upload a custom logo image for your site.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Custom Logo",
						"desc" 		=> "Upload a custom logo image for your site here. Size for height should be 75px or 150px for a better display, for retina screens. ",
						"id" 		=> "site_logo",
						"std" 		=> $imgs_url.'logo.png',
						"type" 		=> "upload");
					

$of_options[] = array( 	"name" 		=> "Top Navigation",
						"desc" 		=> "Display it, below or above the logo. By default is above (Up) the logo.",
						"id" 		=> "to_topnav_display",
						"std" 		=> "Up",
						"type" 		=> "select",
						"options" 	=> array(
										"Up",
										"Down"
									),
					);


$of_options[] = array( 	"name" 		=> "Header Social Icons.",
						"desc" 		=> "",
						"id" 		=> "introduction_social",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Social Icons.</h3>
						<strong>Social Icons</strong> - Header Social Icons.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Social Icons",
						"desc" 		=> "You can use HTML code.<br /> For more social icons go to <a href=\"http://fontawesome.io/icons/\" target=\"_blank\">fontawesome</a> and at the bottom you have Brand Icons!",
						"id" 		=> "top_icons",
						"std" 		=> "
<li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-instagram\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-pinterest\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-google-plus\"></i></a></li>
<li><a href=\"#\"><i class=\"fa fa-youtube\"></i></a></li>
",
						"type" 		=> "textarea");	



$of_options[] = array( 	"name" 		=> "Trending Articles",
						"desc" 		=> "",
						"id" 		=> "introduction_01",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Trending Articles Slider (Header).</h3>
						<strong>Trending</strong> - Change the tag or display more articles.",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> "Tag: Trending Articles",
						"desc" 		=> "Change the tag. Default is <strong>trending</strong>.",
						"id" 		=> "to_trending_tag",
						"std" 		=> "trending",
						"type" 		=> "text"); 

$of_options[] = array( 	"name" 		=> "Trending Articles",
						"desc" 		=> "How many Trending Articles you want to display.",
						"id" 		=> "to_trending_nr",
						"std" 		=> "5",
						"min"		=> "1",
						"max"		=> "20",						
						"type" 		=> "sliderui");



$of_options[] = array( 	"name" 		=> "Most Viewed Articles",
						"desc" 		=> "",
						"id" 		=> "introduction_02",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Most Viewed Articles Slider.</h3>
						<strong>Slider</strong> - Most Viewed Articles.",
						"icon" 		=> true,
						"type" 		=> "info");
 
$of_options[] = array( 	"name" 		=> "Most Viewed Articles - Slider",
						"desc" 		=> "How many Most Viewed Articles you want to display.",
						"id" 		=> "to_mostviewed_nr",
						"std" 		=> "16",
						"min"		=> "1",
						"max"		=> "50",						
						"type" 		=> "sliderui");

$of_options[] = array( 	"name" 		=> "All Pages: Most Viewed Articles - Slider",
						"desc" 		=> "Display Most Viewed Articles Slider? This is primary option, if you select NO, the slider will be completely disabled in all pages / articles.",
						"id" 		=> "to_mostviewed_display",
						"std" 		=> "Yes",
						"type" 		=> "select",
						"options" 	=> array(
										"Yes",
										"No"
									),
					);



/*-----------------------------------------------------------------------------------*/
/* Blog Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> "Blog Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-money.png"
				);

 
$of_options[] = array( 	"name" 		=> "Small Sidebar ( Categories + Social Icons ).",
						"desc" 		=> "",
						"id" 		=> "introduction_12",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Small Sidebar</h3>
						<strong>Small Sidebar</strong> - Small Sidebar ( Categories + Social Icons ). Is displayed by default to the left in the homepage. Choose the direction where you want to display it: Left or Right ",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> "Small Sidebar",
						"desc" 		=> "Choose the direction where you want to display it: Left or Right. By default is above <strong>Left</strong>.",
						"id" 		=> "to_small_sidebar",
						"std" 		=> "left",
						"type" 		=> "select",
						"options" 	=> array(
										"left",
										"right"
									),
					); 


$of_options[] = array( 	"name" 		=> "Comments",
						"desc" 		=> "",
						"id" 		=> "introduction_13",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Comments</h3>
						<strong>Comments</strong> - Display or Hide the Comments.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Comments",
						"desc" 		=> "Display or Hide the Comments. Hide Comments?",
						"id" 		=> "to_comm_hide",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);



$of_options[] = array( 	"name" 		=> "Social Share Icons",
						"desc" 		=> "",
						"id" 		=> "introduction_13",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Social Share Icons</h3>
						Display or Hide the Social share icons from article page.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Social Share Icons",
						"desc" 		=> "Display or Hide Social Share Icons from article page. Hide Icons?",
						"id" 		=> "socialshare_hide",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);




$of_options[] = array( 	"name" 		=> "Homepage: Latest Articles",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Homepage: Latest Articles</h3>
						<strong>Homepage:</strong> - Latest Articles. Display or Latest Articles.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Latest Articles",
						"desc" 		=> "Latest Articles. Display Latest Articles? ",
						"id" 		=> "to_home_latestarticles",
						"std" 		=> "Yes",
						"type" 		=> "select",
						"options" 	=> array(
										"Yes",
										"No"
									),
					);


$of_options[] = array( 	"name" 		=> "Related Articles by Tags",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Related Articles by Tags and Tags</h3>
						<strong>Related Articles</strong> - Related Articles by Tags and Tags. Display or Hide them.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Related Articles and Tags",
						"desc" 		=> "Display or Hide the Related Articles and Tags. Hide them?",
						"id" 		=> "to_related_art_hide",
						"std" 		=> "No",
						"type" 		=> "select",
						"options" 	=> array(
										"No",
										"Yes"
									),
					);


$of_options[] = array( 	"name" 		=> "Date Format",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Date Format</h3>
						<strong>Date Format</strong> - change date format.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Date Format",
						"desc" 		=> "Formatting Date and Time, more info <a href=\"https://codex.wordpress.org/Formatting_Date_and_Time\">here</a>",
						"id" 		=> "dateformat",
						"std" 		=> "M j, Y",
						"type" 		=> "text"); 

$of_options[] = array( 	"name" 		=> "Hide Date Format: 14 hours ago",
						"desc" 		=> "Check the box to hide the date format, example: 14 hours ago ",
						"id" 		=> "dateformathide",
						"std" 		=> 0,
						"type" 		=> "checkbox");
 

/*-----------------------------------------------------------------------------------*/
/* Style Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> "Style Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-paint.png");


$of_options[] = array( 	"name" 		=> "Style",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Style Settings.</h3>
						The style options control the main color styling of the site. <br />To change all colors of the site, open <strong>Theme folder / css / colors / default.css</strong> file.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Main Color (yellow)",
						"desc" 		=> "Use the color picker to change the main color of the site to match your brand color.",
						"id" 		=> "main_color1",
						"std" 		=> "#ffd800",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Main Color (red)",
						"desc" 		=> "Use the color picker to change the main color of the site to match your brand color.",
						"id" 		=> "main_color2",
						"std" 		=> "#fd0005",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Main Color (black)",
						"desc" 		=> "Use the color picker to change the main color of the site to match your brand color.",
						"id" 		=> "main_color3",
						"std" 		=> "#000000",
						"type" 		=> "color"
				);




$of_options[] = array( 	"name" 		=> "Style",
						"desc" 		=> "",
						"id" 		=> "introduction_11",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Style Settings.</h3>
						The style options control the main color styling of the site. <br />To change all colors of the site, open <strong>Theme folder / css / colors / default.css</strong> file.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Header Background Color (Red)",
						"desc" 		=> "Use the color picker to change the Background color of the Header Menu to match your brand color.",
						"id" 		=> "main_color_menu",
						"std" 		=> "#fd0005",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Header Links (white)",
						"desc" 		=> "Use the color picker to change the links color of the header to match your brand color.",
						"id" 		=> "main_color_menu_links",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "Header current menu color link (black)",
						"desc" 		=> "Use the color picker to change the current color link of the header to match your brand color.",
						"id" 		=> "main_color_current_link",
						"std" 		=> "#000000",
						"type" 		=> "color"
				);

$of_options[] = array( 	"name" 		=> "1. Shadow current menu link",
						"desc" 		=> "Add more or less <strong>pixels</strong> to increase or decrease the shadow. Default 3.",
						"id" 		=> "shadow_1",
						"std" 		=> "3",
						"min"		=> "1",
						"max"		=> "20",						
						"type" 		=> "sliderui");

$of_options[] = array( 	"name" 		=> "2. Shadow current menu link",
						"desc" 		=> "Add more or less <strong>pixels</strong> to increase or decrease the shadow. Default 10",
						"id" 		=> "shadow_2",
						"std" 		=> "10",
						"min"		=> "1",
						"max"		=> "20",						
						"type" 		=> "sliderui");

$of_options[] = array( 	"name" 		=> "Social Icons Hover (white)",
						"desc" 		=> "Use the color picker to change the hover color of the social icons to match your brand color.",
						"id" 		=> "main_color_hoversocial",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);




$of_options[] = array( 	"name" 		=> "Style",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Style Settings.</h3>
						The style options control the main color styling of the site. <br />To change all colors of the site, open <strong>Theme folder / css / colors / default.css</strong> file.",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> "Footer Social Section = Background Color",
						"desc" 		=> "Use the color picker to change the Background Color.",
						"id" 		=> "footer_bgcolor",
						"std" 		=> "#fd0005",
						"type" 		=> "color"
				);







$of_options[] = array( 	"name" 		=> "Style",
						"desc" 		=> "",
						"id" 		=> "introduction_14",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Style Settings.</h3>
						The style options control the main color styling of the site. <br />To change all colors of the site, open <strong>Theme folder / css / colors / default.css</strong> file.",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> "Entry Link Background Color",
						"desc" 		=> "Use the color picker to change the entry link background color on article or default / full width pages.",
						"id" 		=> "entry_linkbgcolor",
						"std" 		=> "#fd0005",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> "Entry Link Color",
						"desc" 		=> "Use the color picker to change the entry link color on article or default / full width pages.",
						"id" 		=> "entry_linkcolor",
						"std" 		=> "#FFFFFF",
						"type" 		=> "color"
				);


$of_options[] = array( 	"name" 		=> "Custom CSS.",
						"desc" 		=> "",
						"id" 		=> "introduction_customcss",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom CSS.</h3>
						Enter your custom CSS code. It will be included in the head section of the page.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Custom CSS",
						"desc" 		=> "Enter your custom CSS code. It will be included in the head section of the page.",
						"id" 		=> "custom_css_style",
						"std" 		=> "",
						"type" 		=> "textarea");



/*-----------------------------------------------------------------------------------*/
/* Contact Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> "Contact Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-info.png");

$of_options[] = array( 	"name" 		=> "Email address.",
						"desc" 		=> "",
						"id" 		=> "introduction_7",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Email address.</h3>
						<strong>Contact form</strong> - add your email address.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Contact Form Email",
						"desc" 		=> "Enter the email address where you'd like to receive emails from the Contact form, or leave this field blank to use admin email.",
						"id" 		=> "contact_email",
						"std" 		=> "",
						"type" 		=> "text"); 

$of_options[] = array( 	"name" 		=> "Confirmation message",
						"desc" 		=> "",
						"id" 		=> "introduction_8",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Confirmation message</h3>
						<strong>Confirmation message</strong> - add your message.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Confirmation message",
						"desc" 		=> "Add a confirmation message.",
						"id" 		=> "contact_confirmation",
						"std" 		=> "Thanks, your email was sent successfully.",
						"type" 		=> "textarea");	




/*-----------------------------------------------------------------------------------*/
/* Footer Settings */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-settings.png");


$of_options[] = array( 	"name" 		=> "Trending Articles",
						"desc" 		=> "",
						"id" 		=> "introduction_10",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Trending Articles Slider (Footer).</h3>
						<strong>Trending</strong> - Change the tag or display more articles.",
						"icon" 		=> true,
						"type" 		=> "info");


$of_options[] = array( 	"name" 		=> "Tag: Trending Articles",
						"desc" 		=> "Change the tag. Default is <strong>trending</strong>.",
						"id" 		=> "to_trending_tag_footer",
						"std" 		=> "trending",
						"type" 		=> "text"); 

$of_options[] = array( 	"name" 		=> "Trending Articles",
						"desc" 		=> "How many Trending Articles you want to display.",
						"id" 		=> "to_trending_nr_footer",
						"std" 		=> "10",
						"min"		=> "1",
						"max"		=> "20",						
						"type" 		=> "sliderui");

$of_options[] = array( 	"name" 		=> "Advertisement",
						"desc" 		=> "",
						"id" 		=> "introduction_bannerhome",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Advertisement.</h3>
						<strong>Advertisement</strong> - on Footer.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "728x90 Footer",
						"desc" 		=> "The ads will be displayed in the Footer. Paste your HTML or JavaScript code here.",
						"id" 		=> "to_home728",
						"std" 		=> "<a href=\"#\"><img src=\"http://placehold.it/728x90/ffd800/FFF&amp;text=AD+BLOCK+728x90+>+Theme+Options+>+Advertisement\" width=\"728\" height=\"90\" alt=\"banner\" /></a>",
						"type" 		=> "textarea");	

$of_options[] = array( 	"name" 		=> "300x250 Footer",
						"desc" 		=> "The ads will be displayed in the Footer <strong>in smaller devices</strong>. Paste your HTML or JavaScript code here.",
						"id" 		=> "to_footer300",
						"std" 		=> "<a href=\"#\"><img src=\"http://placehold.it/300x250/ffd800/FFF&amp;text=AD+BLOCK+300x250+>+Theme+Options+>+Advertisement\" width=\"300\" height=\"250\" alt=\"banner\" /></a>",
						"type" 		=> "textarea");	

$of_options[] = array( 	"name" 		=> "Social Icons.",
						"desc" 		=> "",
						"id" 		=> "introduction_social",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Social Icons.</h3>
						<strong>Social Icons</strong> - for footer.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Social Icons",
						"desc" 		=> "You can use HTML code.<br /> For more social icons go to <a href=\"http://fontawesome.io/icons/\" target=\"_blank\">fontawesome</a> and at the bottom you have Brand Icons!",
						"id" 		=> "bottom_icons",
						"std" 		=> "<ul class=\"footer-social\">
<li><a href=\"#\"><i class=\"fa fa-twitter\"></i> <span>Twitter</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-facebook\"></i> <span>Facebook</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-google-plus\"></i> <span>Google+</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-youtube\"></i> <span>Youtube</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-vimeo-square\"></i> <span>Vimeo</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-pinterest\"></i> <span>Pinterest</span></a></li>
<li><a href=\"#\"><i class=\"fa fa-rss\"></i> <span>Rss</span></a></li>
</ul>",
						"type" 		=> "textarea");	

$of_options[] = array( 	"name" 		=> "Copyright",
						"desc" 		=> "",
						"id" 		=> "introduction_copy",
						"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Copyright.</h3>
						<strong>Copyright</strong> - Footer Copyright.",
						"icon" 		=> true,
						"type" 		=> "info");

$of_options[] = array( 	"name" 		=> "Copyright Year",
						"desc" 		=> "Change the Year.",
						"id" 		=> "copyright_footer_year",
						"std" 		=> "Copyright &copy; 2015",
						"type" 		=> "text"); 

$of_options[] = array( 	"name" 		=> "Copyright",
						"desc" 		=> "You can use HTML code.",
						"id" 		=> "copyright_footer",
						"std" 		=> "<strong>Proudly powered by <a href=\"#\">WordPress</a> | Design by <a href=\"http://themeforest.net/user/An-Themes/portfolio?ref=An-Themes\">An-Themes</a></strong>",
						"type" 		=> "textarea");	
 

/*-----------------------------------------------------------------------------------*/
/* Backup Options */
/*-----------------------------------------------------------------------------------*/
$of_options[] = array( 	"name" 		=> "Backup Options",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options",
						"id" 		=> "of_backup",
						"std" 		=> "",
						"type" 		=> "backup",
						"desc" 		=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data",
						"id" 		=> "of_transfer",
						"std" 		=> "",
						"type" 		=> "transfer",
						"desc" 		=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".',
				);




				
	}//End function: of_options()
}//End chack if function exists: of_options()
?>
