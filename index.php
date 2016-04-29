<?php
/**
Plugin Name: EmailNotify
Plugin URI: https://github.com/rhondle/WP_EmailNotify
Description: Sends an email to a predefined list of recipients whenever a new post is published.
Version: 1.0
Author: Marty Anstey
Author URI: https://marty.anstey.ca/
License: LGPLv3
*/

function emailnotify_queue_email($post) {
	global $wpdb;
	$tbl = $wpdb->prefix.'emailnotify_emails';						// this is the table that holds the message queue
	if ($post->post_status!='publish') return;						// skip if not directly a published post
	$wpdb->insert($tbl,
			array(
				'subject'=>'',
				'title'=>$post->post_title,
				'status'=>'queued',
				'post_url'=>$post->guid,
				'created'=>current_time('mysql')
			)
	);
}

add_action('future_to_publish', 'emailnotify_queue_email');
add_action('draft_to_publish', 'emailnotify_queue_email');
