CREATE TABLE `wp_emailnotify_emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('sent','queued','disabled') DEFAULT 'disabled',
  `subject` varchar(254) NOT NULL DEFAULT '',
  `title` varchar(254) NOT NULL DEFAULT '',
  `email` mediumtext,
  `post_url` varchar(254) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Queue of messages to be picked up by a cron task and delivered'