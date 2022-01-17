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
CREATE DATABASE IF NOT EXISTS `my_canteen` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `my_canteen`;

-- Dumping structure for table my_canteen.cafetaria
CREATE TABLE IF NOT EXISTS `cafetaria` (
  `id_cafet` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cafet` varchar(50) NOT NULL,
  `cafet_desc` varchar(455) DEFAULT NULL,
  `cafet_img` varchar(500) DEFAULT NULL,
  `id_owner` int(11) NOT NULL,
  PRIMARY KEY (`id_cafet`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.cafetaria: ~3 rows (approximately)
/*!40000 ALTER TABLE `cafetaria` DISABLE KEYS */;
INSERT INTO `cafetaria` (`id_cafet`, `nama_cafet`, `cafet_desc`, `cafet_img`, `id_owner`) VALUES
	(1, 'Black Canteen Bull', 'Tempatnya makan jingkung bungglung', 'd41d8cd98f00b204e9800998ecf8427e1642170251.gif', 3),
	(2, 'oblivion', 'yhbyvb', NULL, 5),
	(3, 'Warung Hitam Baja', 'Tempatnya makan jingkung', 'd41d8cd98f00b204e9800998ecf8427e1642148744.jpg', 4);
/*!40000 ALTER TABLE `cafetaria` ENABLE KEYS */;

-- Dumping structure for table my_canteen.checkout
CREATE TABLE IF NOT EXISTS `checkout` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_menu` int(100) DEFAULT NULL,
  `id_user` int(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='row status: view and finished. If finished, to table transaction';

-- Dumping data for table my_canteen.checkout: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkout` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkout` ENABLE KEYS */;

-- Dumping structure for table my_canteen.favorite
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_menu` int(100) NOT NULL,
  `id_user` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.favorite: ~4 rows (approximately)
/*!40000 ALTER TABLE `favorite` DISABLE KEYS */;
INSERT INTO `favorite` (`id`, `id_menu`, `id_user`) VALUES
	(1, 1, 2),
	(3, 3, 2),
	(4, 5, 2),
	(5, 9, 2),
	(7, 4, 2);
/*!40000 ALTER TABLE `favorite` ENABLE KEYS */;

-- Dumping structure for table my_canteen.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) NOT NULL,
  `desc_menu` varchar(200) DEFAULT NULL,
  `img_menu` varchar(500) DEFAULT NULL,
  `price_menu` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id_canteen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.menu: ~9 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id_menu`, `nama_menu`, `desc_menu`, `img_menu`, `price_menu`, `type`, `id_canteen`) VALUES
	(1, 'Es Jeruk', 'deeeeefffffff', 'd41d8cd98f00b204e9800998ecf8427e1642167676.jpg', '2500', 'drinks', 3),
	(3, 'Ayam Bakar', 'Dgn Madu', 'd41d8cd98f00b204e9800998ecf8427e1641881073.gif', '17000', 'food', 3),
	(4, 'milkshake', 'coklat', 'd41d8cd98f00b204e9800998ecf8427e1642136922.gif', '15000', 'drinks', 3),
	(5, 'Hiu', 'rtgfnrfgtn brtg', 'd41d8cd98f00b204e9800998ecf8427e1642170305.jpg', '3465', 'food', 3),
	(6, 'Ice Tea', 'Teh dengan sensasi dingin & manis', 'd41d8cd98f00b204e9800998ecf8427e1642143969.gif', '3500', 'drinks', 5),
	(8, 'Ayam Goreng Dukun', 'Ayam hitam dari Dukun jumbang', 'd41d8cd98f00b204e9800998ecf8427e1642169687.png', '50000', 'food', 3),
	(9, 'Es Manca', 'Mancu pancen oye', 'd41d8cd98f00b204e9800998ecf8427e1642147228.gif', '120000', 'drinks', 3),
	(10, 'Bebek Sunteriahhhhh', 'Bebek Berguriah', 'd41d8cd98f00b204e9800998ecf8427e1642152300.gif', '16000', 'food', 4);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table my_canteen.transaction
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `total` int(100) NOT NULL DEFAULT '0',
  `id_user` int(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.transaction: ~0 rows (approximately)
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;

-- Dumping structure for table my_canteen.transaction_log
CREATE TABLE IF NOT EXISTS `transaction_log` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(100) NOT NULL DEFAULT '0',
  `total` varchar(100) NOT NULL DEFAULT '0',
  `finished_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table my_canteen.transaction_log: ~2 rows (approximately)
/*!40000 ALTER TABLE `transaction_log` DISABLE KEYS */;
INSERT INTO `transaction_log` (`id`, `id_user`, `total`, `finished_at`) VALUES
	(1, 2, '19500', '2022-01-15 20:17:24'),
	(2, 2, '18465', '2022-01-15 20:25:37');
/*!40000 ALTER TABLE `transaction_log` ENABLE KEYS */;

-- Dumping structure for table my_canteen.users
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
	(3, 'fajar', 'asdfg', 'fajar@gmail.com', 'Ahmad Fajar', '0567546345', 'own', 'd41d8cd98f00b204e9800998ecf8427e1642171541.jpg'),
	(4, 'thunder', 'olympus', 'thunder@gmail.com', 'Zeus', '4435467567868', 'own', NULL),
	(5, 'order', 'daedra', 'order@gmail.com', 'Jyggalag', '56476586789', 'own', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
