
DROP TABLE IF EXISTS `dlc`;

CREATE TABLE IF NOT EXISTS `dlc` (
  `idD` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `dlc_name` varchar(100) NOT NULL,
  `release_date` date NOT NULL,
  `price` decimal(5.2) NOT NULL,
  `description` text NOT NULL
);


INSERT INTO `dlc` (`idD`, `dlc_name`, `release_date`, `price`, `description`) VALUES
(1, 'After Dark', '2015-09-24', 14.99, 'Ajoute un cycle jour-nuit, de nouveaux bâtiments et des options de loisirs.'),
(2, 'Snowfall', '2016-02-18', 12.c99, 'Ajoute des conditions météorologiques, de nouveaux transports publics et des infrastructures hivernales.'),
(3, 'Natural Disasters', '2016-11-29', 14.99, 'Introduit des catastrophes naturelles, des scénarios et un centre de gestion des catastrophes.'),
(4, 'Mass Transit', '2017-05-18', 12.99, 'Étend les options de transport en commun, ajoute de nouveaux scénarios et de nouvelles politiques.');
