CREATE TABLE `monitoredsite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `dateCreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `monitorLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitoredSiteId` int(11) NOT NULL,
  `httpResponseCode` varchar(255) NOT NULL,
  `dateCreated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,  
  PRIMARY KEY (`id`),
  CONSTRAINT fk_monitored_sites FOREIGN KEY (monitoredSiteId)
  REFERENCES monitoredsite(id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

