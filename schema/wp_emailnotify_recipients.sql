CREATE TABLE `wp_emailnotify_recipients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `real_name` varchar(254) NOT NULL DEFAULT '',
  `email` varchar(254) NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='List of email recipients for the EmailNotify plugin'