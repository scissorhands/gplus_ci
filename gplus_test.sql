CREATE TABLE IF NOT EXISTS `google_clients` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `token` varchar(1024) NOT NULL,
  `refresh_token` varchar(226) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;