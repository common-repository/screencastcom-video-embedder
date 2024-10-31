<?php

if (!defined('ABSPATH')) include_once('./../../../wp-blog-header.php');
require_once(ABSPATH . '/wp-admin/admin.php');

if (isset($_POST['action'])) {
// 
// $mimes = is_array($mimes) ? $mimes : apply_filters('upload_mimes', array (
// 		'avi' => 'video/avi',
// 		'mov|qt' => 'video/quicktime',
// 		'mpeg|mpg|mpe' => 'video/mpeg',
// 		'asf|asx|wax|wmv|wmx' => 'video/asf',
// 		'swf' => 'application/x-shockwave-flash',
// 		'flv' => 'video/x-flv'
// 	));
// 
// $overrides = array('action'=>'save','mimes'=>$mimes);
// 
// $file = wp_handle_upload($_FILES['video'], $overrides);
// 
// if ( !isset($file['error']) ) {
// 
// 	$url = $file['url'];
// 	$type = $file['type'];
// 	$file = $file['file'];
// 	$filename = basename($file);
// 
// 	// Construct the attachment array
// 	$attachment = array(
// 		'post_title' => $_POST['videotitle'] ? $_POST['videotitle'] : $filename,
// 		'post_content' => $_POST['descr'],
// 		'post_status' => 'attachment',
// 		'post_parent' => $_GET['post'],
// 		'post_mime_type' => $type,
// 		'guid' => $url
// 		);
// 
// 	// Save the data
// 	$id = wp_insert_attachment($attachment, $file, $post);
// 
// 	if ( preg_match('!^image/!', $attachment['post_mime_type']) ) {
// 		// Generate the attachment's postmeta.
// 		$imagesize = getimagesize($file);
// 		$imagedata['width'] = $imagesize['0'];
// 		$imagedata['height'] = $imagesize['1'];
// 		list($uwidth, $uheight) = get_udims($imagedata['width'], $imagedata['height']);
// 		$imagedata['hwstring_small'] = "height='$uheight' width='$uwidth'";
// 		$imagedata['file'] = $file;
// 
// 		add_post_meta($id, '_wp_attachment_metadata', $imagedata);
// 
// 		if ( $imagedata['width'] * $imagedata['height'] < 3 * 1024 * 1024 ) {
// 			if ( $imagedata['width'] > 128 && $imagedata['width'] >= $imagedata['height'] * 4 / 3 )
// 				$thumb = wp_create_thumbnail($file, 128);
// 			elseif ( $imagedata['height'] > 96 )
// 				$thumb = wp_create_thumbnail($file, 96);
// 
// 			if ( @file_exists($thumb) ) {
// 				$newdata = $imagedata;
// 				$newdata['thumb'] = basename($thumb);
// 				update_post_meta($id, '_wp_attachment_metadata', $newdata, $imagedata);
// 			} else {
// 				$error = $thumb;
// 			}
// 		}
// 	} else {
// 		add_post_meta($id, '_wp_attachment_metadata', array());
// 	}
// 
// 	$_GET['tab'] = 'select';
//   }
// 
// }
// 
// if (! current_user_can('edit_others_posts') )
// 	$and_user = "AND post_author = " . $user_ID;
// $and_type = "AND (post_mime_type = 'video/avi' OR post_mime_type = 'video/quicktime' OR post_mime_type = 'video/mpeg' OR post_mime_type = 'video/asf' OR post_mime_type = 'video/x-flv' OR post_mime_type = 'application/x-shockwave-flash')";
// if ( 3664 <= $wp_db_version )
//   $attachments = $wpdb->get_results("SELECT post_title, guid FROM $wpdb->posts WHERE post_type = 'attachment' $and_type $and_user ORDER BY post_date_gmt DESC LIMIT 0, 10", ARRAY_A);
// else
//   $attachments = $wpdb->get_results("SELECT post_title, guid FROM $wpdb->posts WHERE post_status = 'attachment' $and_type $and_user ORDER BY post_date_gmt DESC LIMIT 0, 10", ARRAY_A);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="embedded-video.js"></script>
	<base target="_self" />
	<style type="text/css">
		#embeddedvideo .panel_wrapper, #embeddedvideo div.current {
			height: 165px;
			padding-top: 5px;
		}
		#portal_insert, #portal_cancel, #select_insert, #select_cancel, #upload_insert, #upload_cancel, #remote_insert, #remote_cancel {
					font: 13px Verdana, Arial, Helvetica, sans-serif;
					height: auto;
					width: auto;
					background-color: transparent;
					background-image: url(../../../../../wp-admin/images/fade-butt.png);
					background-repeat: repeat;
					border: 3px double;
					border-right-color: rgb(153, 153, 153);
					border-bottom-color: rgb(153, 153, 153);
					border-left-color: rgb(204, 204, 204);
					border-top-color: rgb(204, 204, 204);
					color: rgb(51, 51, 51);
					padding: 0.25em 0.75em;
		}
		#portal_insert:active, #portal_cancel:active, #select_insert:active, #select_cancel:active, #upload_insert:active, #upload_cancel:active, #remote_insert:active, #remote_cancel:active {
					background: #f4f4f4;
					border-left-color: #999;
					border-top-color: #999;
		}
	</style>
	<title><?php echo _e('Embed Video','embeddedvideo'); ?></title>
</head>

<body id="embeddedvideo" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none">

<div class="panel_wrapper">

  <div id="portal_panel" class="current">
    <form name="portal_form" action="#">
        <table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td nowrap="nowrap" style="text-align:right;"><?php echo _e('Insert video ID:','embeddedvideo'); ?></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="vid" type="text" id="portal_vid" value="" style="width: 200px" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td nowrap="nowrap"></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="nolink" type="checkbox" id="portal_nolink" onClick="disable_enable(this, this.form.linktext);" /></td>
                  <td><?php echo _e('Show video without link','embeddedvideo'); ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td nowrap="nowrap" style="text-align:right;"><?php echo _e('Link text:','embeddedvideo'); ?></td>
            <td>
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><input name="linktext" type="text" id="portal_linktext" value="<?php echo $_GET['linktext']; ?>" style="width: 200px" /></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td>
	    <input type="submit" id="portal_insert" name="insert" value="<?php echo _e('Insert','embeddedvideo'); ?>" onclick="ev_checkData(this.form);" />
            </td>
            <td align="right"><input type="button" id="portal_cancel" name="cancel" value="<?php echo _e('Cancel','embeddedvideo'); ?>" onclick="tinyMCEPopup.close();" /></td>
          </tr>
        </table>
      <input type="hidden" name="tab" value="portal" />
    </form>
  </div>
</div>
</body>
</html>
