<?php
/**
 * A utility to check for new pending messages and batch deliver.
 *
 * This script is part of EmailNotify plugin for WordPress.
 *
 * Usage: run via cron eg every x mins
 *
 * @author      Marty Anstey (rhondle@users.noreply.github.com)
 * @copyright   (C) Copyright 2015-2016 Marty Anstey
 * @license     GNU LGPLv3 (www.gnu.org/licenses/lgpl-3.0.txt)
 *
 * Requires:	PHPMailer (https://github.com/PHPMailer/PHPMailer)
 */

date_default_timezone_set('Etc/UTC');
require('phpmailer/PHPMailerAutoload.php');

define('sender_email',	'noreply@example.com');
define('sender_name',	'Your Name');
define('msg_subject',	'Email Subject Here');

/** MySQL Setttings **/
define('mysql_host',	'localhost');
define('mysql_user',	'user');
define('mysql_pass',	'password');
define('mysql_db',		'db');
define('tbl_queue',		'wp_emailnotify_emails');					// table used to store a list of pending messages to be delivered
define('tbl_recipients','wp_emailnotify_recipients');				// table that stores the list of email recipients

/** SMTP Settings **/
define('smtp_user',		'example@example.com');
define('smtp_pass',		'password');
define('smtp_host',		'localhost');
define('smtp_port',		587);

require('message.php');

$db = mysqli_connect(mysql_host, mysql_user, mysql_pass, mysql_db);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$result = $db->query("SELECT `id`,`subject`,`title`,`post_url` FROM `".tbl_queue."` WHERE `status`='queued' ORDER BY `created` ASC LIMIT 1") or die('sql error');
if ($result->num_rows>0) {
        list($id,$subj,$title,$post_url) = $result->fetch_array();
        $result->free();
        $db->query("UPDATE `".tbl_queue."` SET `status`='sent' WHERE `id`=".$id);
        $result = $db->query("SELECT * FROM `".tbl_recipients."` WHERE `active`=1");
        if ($result->num_rows) {
                while ($row = $result->fetch_assoc()) {
                
                        $msg = str_replace(
                        	array(
                        		'%%NAME%%',
                        		'%%TITLE%%',
                        		'%%POST_URL%%'
                        	),
                        	array(
                        		$row['real_name'],
                        		$title,
                        		$post_url
                        	),
                        		$message);							// $message is set in message.php
                        		
                        send_email(sender_email, sender_name, msg_subject, $msg, $row['email'], $row['real_name'], TRUE);
                }
        }
        $result->free();
}

function send_email($email,$name,$subject,$msg,$to,$toname,$batch=FALSE) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;										// 0 = off (for production use) 1 = client messages 2 = client and server messages
        $mail->Host = smtp_host;
        $mail->Port = smtp_port;
        if ($batch==TRUE)
        	$mail->SMTPKeepAlive = true;
        $mail->SMTPOptions = array (
            'ssl' => array(											// only needed if your SMTP server requires TLS
                'verify_peer'  => true,
                'verify_peer_name' => false,
                'verify_depth' => 4,
                'allow_self_signed' => true,
                'cafile' => '/etc/ssl/cacert.pem'					// if needed: set the path and filename of the CA cert
            )
        );
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = smtp_user;
        $mail->Password = smtp_pass;
        $mail->setFrom($email, $name);
        $mail->addAddress($to, $toname);
        $mail->Subject = $subject;
        $mail->msgHTML($msg);
        return $mail->send();
}
