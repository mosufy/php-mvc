--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`itemID` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` char(100) NOT NULL,
  `slug` char(255) NOT NULL,
  `timestamp_created` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `zIndex` int(11) NOT NULL DEFAULT '0' COMMENT 'sort order',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=active; 0=inactive',
  PRIMARY KEY (`itemID`),
  UNIQUE KEY `itemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;