<?
/*
Plugin Name: Screencast Video Embedder
Plugin URI: http://wordpress.org/extend/plugins/screencast-video-embedder
Description: Allows users of Screencast.com to easily embed their video/images by the use of a WordPress shortcode.
Version: 0.4.4
Author: TechSmith Corporation
Author URI: http://techsmith.com
License: GPL2 
*/


/*******************************************************************************
*
*   This program is free software; you can redistribute it and/or modify
*   it under the terms of the GNU General Public License as published by
*   the Free Software Foundation; either version 2 of the License, or
*   (at your option) any later version.

*   This program is distributed in the hope that it will be useful,
*   but WITHOUT ANY WARRANTY; without even the implied warranty of
*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*   GNU General Public License for more details.

*   You should have received a copy of the GNU General Public License
*   along with this program; if not, write to the Free Software
*   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

function screencast_handler($attributes)
{
include_once('simple_html_dom.php');

	extract(shortcode_atts(array(
		'url' => '',
		'height' => '',
		'width' => '',
	), $attributes));

$embed = '';

// if it looks like a Screencast.com tinyurl, get the embed code for the file
if ( preg_match('/screencast.com\/t\//', $url) > 0 ) {
   $html = file_get_html($url);

   if ( $height > 0 ) {
      $html->find('object#scPlayer',0)->height = $height;
   }

   if ( $width > 0 ) {
      $html->find('object#scPlayer',0)->width = $width;
   }

   $embed = $html->find('div#mediaDisplayArea', 0)->innertext;

}

return ($embed);

}

add_shortcode('screencast', 'screencast_handler');

add_filter( 'contextual_help', 'custom_post_help', 10, 2 );	

function custom_post_help($help, $screen)
{
	global $post_type; //required in 3.0 to differentiate posts from pages and other content types
	
	if ( $screen = 'post' && $post_type == 'post' ) 
	{
		$help .= '
			<p><strong>Screencast Video Embedder</strong> - You can use this to display your video in a post or on a page.<p>
			<p><strong>Example:</strong> [screencast url="http://screencast.com/tinyurl" width="400" height="300"]<p>
		';
	}
	
	return $help;
}


function screencast_addbuttons() {
   // Don't bother doing this stuff if the current user lacks permissions
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
 
   // Add only in Rich Editor mode
   if ( get_user_option('rich_editing') == 'true') {
     add_filter("mce_external_plugins", "add_screencast_tinymce_plugin");
     add_filter('mce_buttons', 'register_screencast_button');
   }
}
 
function register_screencast_button($buttons) {
   array_push($buttons, "separator", "screencast");
   return $buttons;
}
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_screencast_tinymce_plugin($plugin_array) {
	$url = trim(get_bloginfo('url'), "/");
	$url.= "/wp-content/plugins/screencastcom-video-embedder/tinymce/editor_plugin.js";
	$plugin_array["screencast"] = $url;
    return $plugin_array;
}
 
function embeddedvideo_script() {
	echo "<script type='text/javascript' src='".get_option('siteurl')."/wp-content/plugins/screencastcom-video-embedder/tinymce/embedded-video.js'></script>\n";
}

if ( function_exists('add_action') ) {

	// init process for button control
	add_action('init', 'screencast_addbuttons');
	add_action('admin_print_scripts', 'embeddedvideo_script');

}

// Lists SC.com Blog Posts
function list_sccom_blog_posts() {
	echo '<div class="rss-widget">';
	
	wp_widget_rss_output(array(
		'url' => 'http://feeds.feedburner.com/screencast/ZohE',
		'title' => 'Latest News from Screencast.com',
		'items' => 5,
		'show_summary' => 1,
		'show_author' => 0,
		'show_date' => 1
	));
	
	echo '</div>';
}

// Hook into wp_dashboard_setup and add our widget
add_action('wp_dashboard_setup', 'shaken_rss_widget');
  
// Create the function that adds the widget
function shaken_rss_widget(){
  // Add our RSS widget
  wp_add_dashboard_widget( 'shaken-rss', 'Screencast.com Blog', 'list_sccom_blog_posts');
}

?>
