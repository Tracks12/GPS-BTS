SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATA IF NOT EXISTS `sigGPS`;
USE `sigGPS`;

CREATE TABLE IF NOT EXISTS `position` (
  `id` int(32) NOT NULL,
  `datehe` bigint(11) NOT NULL COMMENT '[timestamp]',
  `latitude` float NOT NULL COMMENT '[deg, min, s]',
  `longitude` float NOT NULL COMMENT '[deg, min, s]',
  `latOrient` varchar(16) NOT NULL COMMENT '[1, 2]',
  `longOrient` varchar(16) NOT NULL COMMENT '[1, 2]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[id, time, [deg, min, sec], [deg, min, sec], [N, S], [E, O]]';

INSERT INTO `position` (`id`, `datehe`, `latitude`, `longitude`, `latOrient`, `longOrient`) VALUES
	(1, 1552470439, 43.58, 1.42, '1', '1'),
	(2, 1552470558, 43.58, 1.42, '1', '1'),
	(3, 1552470569, 43.58, 1.42, '1', '1'),
	(4, 1552472430, 43.5805, 1.4258, '1', '1'),
	(5, 1552472437, 43.5805, 1.4258, '1', '1'),
	(6, 1552472445, 43.5805, 1.4258, '1', '1'),
	(7, 1553683677, 43.5805, 1.4258, '1', '1'),
	(8, 1553683687, 43.5805, 1.4258, '1', '1'),
	(9, 1553683704, 43.5805, 1.4258, '1', '1'),
	(10, 1553683708, 43.5805, 1.4258, '1', '1'),
	(11, 1553683718, 43.5805, 1.4258, '1', '1'),
	(12, 1553683903, 43.5805, 1.4258, '1', '1'),
	(13, 1553683913, 43.5805, 1.4258, '1', '1'),
	(14, 1553683920, 43.5805, 1.4, '1', '1'),
	(15, 1553683926, 43.5805, 1.4258, '1', '1'),
	(16, 1553683939, 43.5805, 1.4258, '1', '1'),
	(17, 1553683946, 43.5805, 1.4258, '1', '1'),
	(18, 1553683956, 43.5805, 1.4258, '1', '1'),
	(19, 1553683967, 43.5805, 1.4258, '1', '1'),
	(20, 1553683980, 43.5805, 1.4258, '1', '1'),
	(21, 1553683990, 43.5805, 1.4258, '1', '1'),
	(22, 1553684054, 43.5805, 1.4258, '1', '1'),
	(23, 1553684101, 43.5805, 1.4258, '1', '1');

CREATE TABLE IF NOT EXISTS `usr` (
  `user` varchar(11) NOT NULL COMMENT '[value]',
  `pass` varchar(255) NOT NULL COMMENT '[md5(value)]',
  `host` varchar(16) NOT NULL COMMENT '[x.x.x.x]',
  `port` int(255) NOT NULL COMMENT '[x]',
  `time` varchar(32) NOT NULL COMMENT '[dd/mm/yyyy, hh:mm:ss]',
  `priv` varchar(16) NOT NULL DEFAULT 'utilisateur' COMMENT '[value]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usr` (`user`, `pass`, `host`, `port`, `time`, `priv`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'marche pas', 8800, '29/03/2019 10:51:40', 'administrator');

ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usr`
  ADD PRIMARY KEY (`user`);

ALTER TABLE `position`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;
