<?php
/*
Plugin Name: Unique Comment Notify
Plugin URI: http://wiki.bfworks.com/index.php/Unique_Comment_Notify
Version: 1.0
Description: Unique Comment Notify appends the comment author's name to the subject of the notification message sent to the blogger. This prevents Gmail and other threading e-mail clients from grouping all notification e-mails for a post into one conversation.
Author: Belmin Fernandez
Author URI: http://bfworks.com
*/

/*  Copyright 2008  Belmin Fernandez  (email : contact at bfworks dot com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Create the UCN filter
function ucn_filter($subject, $comment_id) {
	global $wpdb;

	$comment = $wpdb->get_row("SELECT comment_author FROM $wpdb->comments WHERE comment_ID='{$comment_id}' LIMIT 1");

	// Return subject with author name
	return sprintf('%1$s by %2$s', $subject, $comment->comment_author);
}

// Add filters to WP
add_filter('comment_moderation_subject', 'ucn_filter', 10, 2);
add_filter('comment_notification_subject', 'ucn_filter', 10, 2);
?>
