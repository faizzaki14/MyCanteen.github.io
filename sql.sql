-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_canteen
DROP DATABASE IF EXISTS `my_canteen`;
CREATE DATABASE IF NOT EXISTS `my_canteen` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `my_canteen`;

-- Dumping structure for table my_canteen.cafetaria
DROP TABLE IF EXISTS `cafetaria`;
CREATE TABLE IF NOT EXISTS `cafetaria` (
  `id_cafet` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cafet` varchar(50) NOT NULL,
  `cafet_desc` varchar(455) DEFAULT NULL,
  `cafet_img` varchar(500) DEFAULT NULL,
  `id_owner` int(11) NOT NULL,
  PRIMARY KEY (`id_cafet`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.cafetaria: ~1 rows (approximately)
/*!40000 ALTER TABLE `cafetaria` DISABLE KEYS */;
INSERT INTO `cafetaria` (`id_cafet`, `nama_cafet`, `cafet_desc`, `cafet_img`, `id_owner`) VALUES
	(1, 'Sop Pak Agus', 'Tempatnya sop termantul :)', NULL, 3),
	(2, 'oblivion', 'yhbyvb', NULL, 5),
	(3, 'Warung Hitam Baja', 'Tempatnya makan jingkung', 'd41d8cd98f00b204e9800998ecf8427e1642148744.jpg', 4);
/*!40000 ALTER TABLE `cafetaria` ENABLE KEYS */;

-- Dumping structure for table my_canteen.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `desc_menu` varchar(200) DEFAULT NULL,
  `img_menu` varchar(500) DEFAULT NULL,
  `price_menu` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id_canteen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.menu: ~2 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id_menu`, `nama_menu`, `desc_menu`, `img_menu`, `price_menu`, `type`, `id_canteen`) VALUES
	(1, 'Es Jeruk', 'deecekgsxs', 'd41d8cd98f00b204e9800998ecf8427e1642148285.jpg', '2500', 'drinks', 3),
	(3, 'Ayam Bakar', 'Dgn Madu', 'd41d8cd98f00b204e9800998ecf8427e1641881073.gif', '17000', 'food', 3),
	(4, 'milkshake', 'coklat', 'd41d8cd98f00b204e9800998ecf8427e1642136922.gif', '15000', 'drinks', 3),
	(5, 'tgb rftgnb rt', 'rtgfnrfgtn brtg', 'd41d8cd98f00b204e9800998ecf8427e1642140138.gif', '3465', 'food', 3),
	(6, 'Ice Tea', 'Teh dengan sensasi dingin & manis', 'd41d8cd98f00b204e9800998ecf8427e1642143969.gif', '3500', 'drinks', 5),
	(7, 'Ayam Hitam', 'Hitamnya ayam', 'd41d8cd98f00b204e9800998ecf8427e1642144995.png', '25000', 'food', 5),
	(8, 'Ayam Goren Dukn', 'Ayam lngsng dri Dukun', 'd41d8cd98f00b204e9800998ecf8427e1642147075.png', '50000', 'food', 3),
	(9, 'Es Manca', 'Mancu pancen oye', 'd41d8cd98f00b204e9800998ecf8427e1642147228.gif', '120000', 'drinks', 3),
	(10, 'Bebek Sunteriahhhhh', 'Bebek Berguriah', 'd41d8cd98f00b204e9800998ecf8427e1642152300.gif', '16000', 'food', 4),
	(11, 'Bebek Dukun', 'Langsung di mbah mijan ', 'd41d8cd98f00b204e9800998ecf8427e1642152379.gif', '5000000', 'food', 4);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table my_canteen.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `role` varchar(15) NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `phone`, `role`, `img`) VALUES
	(1, 'jackie@test.com', 'qwerty', 'jackie@gmail.com', 'Jack Jillinhal', '085794763124', 'user', NULL),
	(2, 'god_of_thunder', 'asgard', 'thor@gmail.com', 'Thor Odinson', '55512345', 'user', NULL),
	(3, 'fajar', 'asdfg', 'fajar@gmail.com', 'Ahmad Fajar', '0567546345', 'own', NULL),
	(4, 'thunder', 'olympus', 'thunder@gmail.com', 'Zeus', '4435467567868', 'own', NULL),
	(5, 'order', 'daedra', 'order@gmail.com', 'Jyggalag', '56476586789', 'own', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
