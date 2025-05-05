-- --------------------------------------------------------
-- Strežnik:                     127.0.0.1
-- Verzija strežnika:            10.4.32-MariaDB - mariadb.org binary distribution
-- Operacijski sistem strežnika: Win64
-- HeidiSQL Različica:           12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for test1
CREATE DATABASE IF NOT EXISTS `test1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `test1`;

-- Dumping structure for tabela test1.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test1.cart: ~5 rows (približno)
INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
	(1, 3, 3, 2, '2025-02-12 13:06:25'),
	(2, 3, 2, 3, '2025-02-12 13:06:31'),
	(3, 3, 6, 1, '2025-02-12 13:23:51'),
	(4, 3, 4, 1, '2025-03-09 18:33:16'),
	(5, 3, 22, 1, '2025-03-30 18:30:42');

-- Dumping structure for tabela test1.motorji
CREATE TABLE IF NOT EXISTS `motorji` (
  `Id_Motorja` int(11) NOT NULL AUTO_INCREMENT,
  `Ime_Motorja` varchar(30) NOT NULL,
  `Opis_Motorja` varchar(1000) DEFAULT NULL,
  `Cena_Motorja` decimal(19,2) NOT NULL,
  `Slika_Motorja` blob DEFAULT NULL,
  PRIMARY KEY (`Id_Motorja`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table test1.motorji: 50 rows
/*!40000 ALTER TABLE `motorji` DISABLE KEYS */;
INSERT INTO `motorji` (`Id_Motorja`, `Ime_Motorja`, `Opis_Motorja`, `Cena_Motorja`, `Slika_Motorja`) VALUES
	(1, 'Motor Kawasaki Model 1', 'Zmogljiv motor z 1101cc, primeren za mestno in terensko vožnjo.', 4219.52, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(2, 'Motor Ducati Model 2', 'Zmogljiv motor z 918cc, primeren za mestno in terensko vožnjo.', 3405.91, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(3, 'Motor Kawasaki Model 3', 'Zmogljiv motor z 755cc, primeren za mestno in terensko vožnjo.', 14103.10, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(4, 'Motor Ducati Model 4', 'Zmogljiv motor z 750cc, primeren za mestno in terensko vožnjo.', 12655.46, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(5, 'Motor Kawasaki Model 5', 'Zmogljiv motor z 1015cc, primeren za mestno in terensko vožnjo.', 12532.96, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(6, 'Motor Ducati Model 6', 'Zmogljiv motor z 1167cc, primeren za mestno in terensko vožnjo.', 6464.51, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(7, 'Motor Ducati Model 7', 'Zmogljiv motor z 217cc, primeren za mestno in terensko vožnjo.', 12530.48, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(8, 'Motor Suzuki Model 8', 'Zmogljiv motor z 512cc, primeren za mestno in terensko vožnjo.', 11225.21, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(9, 'Motor Ducati Model 9', 'Zmogljiv motor z 155cc, primeren za mestno in terensko vožnjo.', 12752.23, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(10, 'Motor Yamaha Model 10', 'Zmogljiv motor z 233cc, primeren za mestno in terensko vožnjo.', 14789.25, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(11, 'Motor Yamaha Model 11', 'Zmogljiv motor z 577cc, primeren za mestno in terensko vožnjo.', 10678.26, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(12, 'Motor Yamaha Model 12', 'Zmogljiv motor z 1176cc, primeren za mestno in terensko vožnjo.', 7374.50, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(13, 'Motor Yamaha Model 13', 'Zmogljiv motor z 313cc, primeren za mestno in terensko vožnjo.', 8568.65, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(14, 'Motor Ducati Model 14', 'Zmogljiv motor z 882cc, primeren za mestno in terensko vožnjo.', 5666.11, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(15, 'Motor Honda Model 15', 'Zmogljiv motor z 1158cc, primeren za mestno in terensko vožnjo.', 4015.15, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(16, 'Motor Ducati Model 16', 'Zmogljiv motor z 861cc, primeren za mestno in terensko vožnjo.', 4150.28, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(17, 'Motor Ducati Model 17', 'Zmogljiv motor z 289cc, primeren za mestno in terensko vožnjo.', 12903.99, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(18, 'Motor Ducati Model 18', 'Zmogljiv motor z 798cc, primeren za mestno in terensko vožnjo.', 11136.80, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(19, 'Motor Ducati Model 19', 'Zmogljiv motor z 1039cc, primeren za mestno in terensko vožnjo.', 2004.74, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(20, 'Motor Suzuki Model 20', 'Zmogljiv motor z 631cc, primeren za mestno in terensko vožnjo.', 8129.32, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(21, 'Motor Ducati Model 21', 'Zmogljiv motor z 1079cc, primeren za mestno in terensko vožnjo.', 11577.77, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(22, 'Motor Honda Model 22', 'Zmogljiv motor z 610cc, primeren za mestno in terensko vožnjo.', 13754.84, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(23, 'Motor Honda Model 23', 'Zmogljiv motor z 441cc, primeren za mestno in terensko vožnjo.', 11327.54, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(24, 'Motor Yamaha Model 24', 'Zmogljiv motor z 770cc, primeren za mestno in terensko vožnjo.', 13333.65, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(25, 'Motor Kawasaki Model 25', 'Zmogljiv motor z 564cc, primeren za mestno in terensko vožnjo.', 5116.76, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(26, 'Motor Ducati Model 26', 'Zmogljiv motor z 625cc, primeren za mestno in terensko vožnjo.', 12183.22, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(27, 'Motor Ducati Model 27', 'Zmogljiv motor z 454cc, primeren za mestno in terensko vožnjo.', 12226.95, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(28, 'Motor Honda Model 28', 'Zmogljiv motor z 218cc, primeren za mestno in terensko vožnjo.', 7295.61, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(29, 'Motor Kawasaki Model 29', 'Zmogljiv motor z 134cc, primeren za mestno in terensko vožnjo.', 4958.83, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(30, 'Motor Kawasaki Model 30', 'Zmogljiv motor z 255cc, primeren za mestno in terensko vožnjo.', 10516.01, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(31, 'Motor Yamaha Model 31', 'Zmogljiv motor z 957cc, primeren za mestno in terensko vožnjo.', 2724.01, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(32, 'Motor Honda Model 32', 'Zmogljiv motor z 571cc, primeren za mestno in terensko vožnjo.', 12421.16, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(33, 'Motor Kawasaki Model 33', 'Zmogljiv motor z 350cc, primeren za mestno in terensko vožnjo.', 14683.48, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(34, 'Motor Suzuki Model 34', 'Zmogljiv motor z 739cc, primeren za mestno in terensko vožnjo.', 7428.50, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(35, 'Motor Ducati Model 35', 'Zmogljiv motor z 112cc, primeren za mestno in terensko vožnjo.', 9381.33, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(36, 'Motor Honda Model 36', 'Zmogljiv motor z 1106cc, primeren za mestno in terensko vožnjo.', 10971.19, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(37, 'Motor Honda Model 37', 'Zmogljiv motor z 693cc, primeren za mestno in terensko vožnjo.', 6632.78, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(38, 'Motor Yamaha Model 38', 'Zmogljiv motor z 396cc, primeren za mestno in terensko vožnjo.', 1922.38, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(39, 'Motor Kawasaki Model 39', 'Zmogljiv motor z 576cc, primeren za mestno in terensko vožnjo.', 12001.35, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(40, 'Motor Honda Model 40', 'Zmogljiv motor z 355cc, primeren za mestno in terensko vožnjo.', 11904.91, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(41, 'Motor Honda Model 41', 'Zmogljiv motor z 935cc, primeren za mestno in terensko vožnjo.', 9216.53, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(42, 'Motor Suzuki Model 42', 'Zmogljiv motor z 285cc, primeren za mestno in terensko vožnjo.', 9778.06, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(43, 'Motor Honda Model 43', 'Zmogljiv motor z 349cc, primeren za mestno in terensko vožnjo.', 6188.23, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(44, 'Motor Suzuki Model 44', 'Zmogljiv motor z 279cc, primeren za mestno in terensko vožnjo.', 12240.77, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(45, 'Motor Honda Model 45', 'Zmogljiv motor z 782cc, primeren za mestno in terensko vožnjo.', 10745.93, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(46, 'Motor Honda Model 46', 'Zmogljiv motor z 564cc, primeren za mestno in terensko vožnjo.', 13156.23, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(47, 'Motor Honda Model 47', 'Zmogljiv motor z 668cc, primeren za mestno in terensko vožnjo.', 12570.90, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(48, 'Motor Honda Model 48', 'Zmogljiv motor z 236cc, primeren za mestno in terensko vožnjo.', 10890.82, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(49, 'Motor Honda Model 49', 'Zmogljiv motor z 814cc, primeren za mestno in terensko vožnjo.', 11209.03, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067),
	(50, 'Motor Suzuki Model 50', 'Zmogljiv motor z 340cc, primeren za mestno in terensko vožnjo.', 2053.84, _binary 0x736c696b652f4d6f746f726a692f4d6f746f722e6a7067);
/*!40000 ALTER TABLE `motorji` ENABLE KEYS */;

-- Dumping structure for tabela test1.narocila
CREATE TABLE IF NOT EXISTS `narocila` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `order_data` text NOT NULL,
  `shipping_address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table test1.narocila: ~2 rows (približno)
INSERT INTO `narocila` (`id`, `username`, `order_data`, `shipping_address`, `payment_method`, `order_date`) VALUES
	(1, 'trampy', '{"pnevmatike_49":{"id":"49","table":"pnevmatike","name":"Pnevmatika Bridgestone 49","price":101.14,"img":"slike/Pnevmatike/guma.jpg","quantity":1},"pnevmatike_12":{"id":"12","table":"pnevmatike","name":"Pnevmatika Bridgestone 12","price":105.54,"img":"slike/Pnevmatike/guma.jpg","quantity":1}}', 'medvode', 'po povzetju', '2025-04-06 08:00:48'),
	(2, 'trampy', '{"motorji_4":{"id":"4","table":"motorji","name":"Motor Ducati Model 4","price":12655.46,"img":"","quantity":1}}', 'medvode', 'po povzetju', '2025-04-06 08:40:53');

-- Dumping structure for tabela test1.narocila_storitve
CREATE TABLE IF NOT EXISTS `narocila_storitve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `message` text DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test1.narocila_storitve: ~0 rows (približno)
INSERT INTO `narocila_storitve` (`id`, `name`, `email`, `phone`, `service`, `date`, `message`, `username`, `created_at`) VALUES
	(1, 'Nejc Trampuš', 'NEJC.TRAMPUS5@GMAIL.COM', '8767565', 'Popravilo motorja', '2025-05-02', 'sad', 'trampy', '2025-04-06 09:37:58');

-- Dumping structure for tabela test1.olja
CREATE TABLE IF NOT EXISTS `olja` (
  `Id_Olj` int(11) NOT NULL AUTO_INCREMENT,
  `Ime_Olja` varchar(30) NOT NULL,
  `Opis_Olja` varchar(1000) DEFAULT NULL,
  `Cena_Olja` decimal(19,2) NOT NULL,
  `Slika_Olja` blob DEFAULT NULL,
  PRIMARY KEY (`Id_Olj`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table test1.olja: 50 rows
/*!40000 ALTER TABLE `olja` DISABLE KEYS */;
INSERT INTO `olja` (`Id_Olj`, `Ime_Olja`, `Opis_Olja`, `Cena_Olja`, `Slika_Olja`) VALUES
	(1, 'Motorno olje X1', 'Visokokakovostno sintetično motorno olje za osebna vozila.', 24.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(2, 'Motorno olje TurboMax', 'Odlično za dizelske motorje z dolgo življenjsko dobo.', 29.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(3, 'Motorno olje EcoDrive', 'Energijsko učinkovito olje za sodobna vozila.', 22.50, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(4, 'Motorno olje PowerFlow', 'Zanesljiva zaščita pri visokih temperaturah.', 27.75, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(5, 'Motorno olje UltraGuard', 'Napredno motorno olje z dodatki proti obrabi.', 33.10, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(6, 'Motorno olje SynTech', 'Sintetično olje za maksimalno zmogljivost.', 35.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(7, 'Motorno olje DieselPro', 'Zasnovano za dizelske motorje težkih vozil.', 31.49, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(8, 'Motorno olje AutoLife', 'Podaljšuje življenjsko dobo motorja.', 26.25, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(9, 'Motorno olje SuperClean', 'Čisti motor med delovanjem in ščiti ventile.', 28.90, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(10, 'Motorno olje WinterShield', 'Idealno za hladne vremenske razmere.', 23.30, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(11, 'Motorno olje SummerRun', 'Optimizirano za poletne temperature.', 21.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(12, 'Motorno olje RapidStart', 'Omogoča hiter zagon motorja pri nizkih temperaturah.', 24.40, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(13, 'Motorno olje LongLife', 'Dolgotrajno delovanje brez pogostih menjav.', 34.25, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(14, 'Motorno olje MaxProtect', 'Zagotavlja visoko zaščito motorja.', 30.75, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(15, 'Motorno olje CleanMotion', 'Izboljšana formula za čistejše izgorevanje.', 27.00, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(16, 'Motorno olje EcoPlus', 'Ekološko prijazno in učinkovito.', 25.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(17, 'Motorno olje RacingLine', 'Za visoko zmogljiva športna vozila.', 39.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(18, 'Motorno olje TruckGuard', 'Posebej za tovornjake in komercialna vozila.', 32.50, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(19, 'Motorno olje SmoothDrive', 'Zmanjšuje trenje in izboljša delovanje motorja.', 29.60, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(20, 'Motorno olje QuickFlow', 'Za hitro razširjanje po motorju.', 23.80, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(21, 'Motorno olje ProPerformance', 'Profesionalna kakovost za vsakodnevno uporabo.', 26.90, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(22, 'Motorno olje FlexiOil', 'Univerzalna uporaba za različne tipe motorjev.', 28.10, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(23, 'Motorno olje ThermoGuard', 'Stabilno pri visokih temperaturah.', 30.40, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(24, 'Motorno olje AllSeason', 'Primerno za vse letne čase.', 27.30, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(25, 'Motorno olje NitroBoost', 'Poveča moč in odzivnost motorja.', 34.75, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(26, 'Motorno olje EnduroMax', 'Dolgotrajna zaščita za dolge poti.', 33.20, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(27, 'Motorno olje VeloTorque', 'Optimizirano za visok navor.', 31.00, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(28, 'Motorno olje CoolMotion', 'Zmanjšuje segrevanje motorja.', 24.15, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(29, 'Motorno olje JetStream', 'Visoka viskoznost za ekstremne pogoje.', 36.50, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(30, 'Motorno olje RedLine', 'Za športne in dirkalne avtomobile.', 37.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(31, 'Motorno olje GreenRun', 'Bio-osnova z visoko zaščito.', 29.10, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(32, 'Motorno olje SafeStart', 'Za starejše motorje z višjo obrabo.', 22.90, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(33, 'Motorno olje AeroDrive', 'Primeren za turbopolnilnike.', 31.75, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(34, 'Motorno olje SilentRun', 'Zmanjšuje hrup motorja.', 28.25, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(35, 'Motorno olje MaxCool', 'Ohranja motor hladen pri dolgi vožnji.', 30.90, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(36, 'Motorno olje TitanShield', 'Zanesljiva zaščita v vseh pogojih.', 32.45, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(37, 'Motorno olje HyperFlow', 'Izboljša kroženje olja in zmanjšuje obrabo.', 34.60, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(38, 'Motorno olje VulcanPower', 'Za težko mehanizacijo in stroje.', 35.30, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(39, 'Motorno olje GlideTech', 'Gladka vožnja in nižja poraba.', 27.70, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(40, 'Motorno olje CityDrive', 'Idealno za mestno vožnjo z veliko zagoni.', 25.50, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(41, 'Motorno olje SpeedMax', 'Za hitra vozila in agresivno vožnjo.', 36.10, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(42, 'Motorno olje EcoSave', 'Manjša poraba goriva z isto zmogljivostjo.', 26.60, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(43, 'Motorno olje XtremeDrive', 'Za ekstremne pogoje in visoke obremenitve.', 38.40, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(44, 'Motorno olje MotionPro', 'Zmanjšuje trenje in poveča moč.', 29.25, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(45, 'Motorno olje ArcticShield', 'Odporno na ekstremni mraz.', 33.90, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(46, 'Motorno olje FusionX', 'Nova tehnologija za dolgotrajno zaščito.', 35.60, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(47, 'Motorno olje CarbonClean', 'Zmanjšuje usedline in čiščenje motorja.', 30.10, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(48, 'Motorno olje XGuard', 'Izjemna zaščita pri dolgotrajni vožnji.', 31.30, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(49, 'Motorno olje TurboBoost', 'Za turbo motorje in visoke vrtljaje.', 34.85, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67),
	(50, 'Motorno olje DrivePro', 'Zasnovano za profesionalno uporabo.', 32.99, _binary 0x736c696b652f4f6c6a652f6d6f746f726e6f5f6f6c6a652e706e67);
/*!40000 ALTER TABLE `olja` ENABLE KEYS */;

-- Dumping structure for tabela test1.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `user_gmail` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test1.orders: ~2 rows (približno)
INSERT INTO `orders` (`id`, `username`, `user_gmail`, `name`, `email`, `phone`, `service`, `service_date`, `message`, `created_at`) VALUES
	(1, '1', 'example@gmail.com', 'Nejc Trampuš', 'NEJC.TRAMPUS5@GMAIL.COM', '432424249', 'menjava olja', '2025-02-06', 'dsa', '2025-02-01 13:05:33'),
	(2, '1', 'example@gmail.com', 'Nejc Trampuš', 'NEJC.TRAMPUS5@GMAIL.COM', '051703007', 'menjava olja', '2025-02-19', 'sda', '2025-02-01 18:14:46');

-- Dumping structure for tabela test1.ostalo
CREATE TABLE IF NOT EXISTS `ostalo` (
  `Id_Ostalo` int(11) NOT NULL AUTO_INCREMENT,
  `Ime_Ostalo` varchar(30) NOT NULL,
  `Opis_Ostalo` varchar(1000) DEFAULT NULL,
  `Cena_Ostalo` decimal(19,2) NOT NULL,
  `Slika_Ostalo` blob DEFAULT NULL,
  PRIMARY KEY (`Id_Ostalo`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table test1.ostalo: 50 rows
/*!40000 ALTER TABLE `ostalo` DISABLE KEYS */;
INSERT INTO `ostalo` (`Id_Ostalo`, `Ime_Ostalo`, `Opis_Ostalo`, `Cena_Ostalo`, `Slika_Ostalo`) VALUES
	(1, 'Mazivo za plin 1', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 1.', 14.65, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(2, 'Zaščitna folija 2', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 2.', 15.19, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(3, 'Set za čiščenje motorja 3', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 3.', 49.80, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(4, 'Komplet za nego motorja 4', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 4.', 10.95, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(5, 'Čistilo za aluminij 5', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 5.', 27.57, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(6, 'Čistilo za aluminij 6', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 6.', 43.05, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(7, 'Čistilne krpe 7', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 7.', 49.56, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(8, 'Set za čiščenje motorja 8', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 8.', 24.83, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(9, 'Zaščitna očala 9', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 9.', 37.14, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(10, 'Komplet za nego motorja 10', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 10.', 28.29, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(11, 'Pasta za krom 11', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 11.', 48.37, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(12, 'Razmaščevalec 12', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 12.', 22.24, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(13, 'Odeja za prekrivanje motorja 1', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 13.', 12.20, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(14, 'Razmaščevalec 14', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 14.', 27.48, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(15, 'Komplet za nego motorja 15', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 15.', 47.27, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(16, 'Zaščitna folija 16', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 16.', 38.42, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(17, 'Krtača za motor 17', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 17.', 20.30, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(18, 'Mazivo za plin 18', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 18.', 48.24, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(19, 'Gobica z mikrovlaknami 19', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 19.', 43.61, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(20, 'Čistilo za aluminij 20', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 20.', 47.83, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(21, 'Antikorozijski sprej 21', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 21.', 21.17, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(22, 'Čistilne krpe 22', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 22.', 10.65, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(23, 'Komplet za čiščenje vizirja 23', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 23.', 31.55, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(24, 'Mazivo za plin 24', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 24.', 18.58, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(25, 'Mazivo za verigo 25', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 25.', 9.96, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(26, 'Gobica z mikrovlaknami 26', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 26.', 42.24, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(27, 'Zaščitna očala 27', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 27.', 49.99, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(28, 'Vosek za motor 28', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 28.', 17.47, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(29, 'Čistilo za aluminij 29', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 29.', 33.13, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(30, 'Razpršilec za pranje 30', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 30.', 24.93, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(31, 'Gel za čiščenje motorja 31', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 31.', 9.01, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(32, 'Komplet za nego motorja 32', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 32.', 30.95, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(33, 'Mazivo za verigo 33', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 33.', 41.09, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(34, 'Antifog sprej 34', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 34.', 27.10, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(35, 'Zaščitna očala 35', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 35.', 40.46, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(36, 'Gel za čiščenje motorja 36', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 36.', 15.61, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(37, 'Vosek za motor 37', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 37.', 34.51, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(38, 'Antikorozijski sprej 38', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 38.', 21.82, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(39, 'Mazivo za plin 39', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 39.', 27.42, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(40, 'Sprej za zaščito kovine 40', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 40.', 36.79, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(41, 'Mazivo za vzmetenje 41', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 41.', 47.09, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(42, 'Čistilo za verigo 42', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 42.', 26.93, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(43, 'Čistilne krpe 43', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 43.', 26.06, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(44, 'Antifog sprej 44', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 44.', 5.34, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(45, 'Mazivo za plin 45', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 45.', 19.33, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(46, 'Odeja za prekrivanje motorja 4', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 46.', 40.39, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(47, 'Komplet za nego motorja 47', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 47.', 35.24, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(48, 'Set za čiščenje motorja 48', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 48.', 30.32, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(49, 'Čistilo za verigo 49', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 49.', 9.65, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67),
	(50, 'Razpršilec za pranje 50', 'Profesionalni pripomoček za nego in čiščenje motorjev. Artikel št. 50.', 26.19, _binary 0x736c696b652f4f7374616c6f2f6f7374616c6f2e706e67);
/*!40000 ALTER TABLE `ostalo` ENABLE KEYS */;

-- Dumping structure for tabela test1.pnevmatike
CREATE TABLE IF NOT EXISTS `pnevmatike` (
  `Id_Pnevmatike` int(11) NOT NULL AUTO_INCREMENT,
  `Ime_Pnevmatike` varchar(30) NOT NULL,
  `Opis_Pnevmatike` varchar(1000) DEFAULT NULL,
  `Cena_Pnevmatike` decimal(19,2) NOT NULL,
  `Slika_Pnevmatike` blob DEFAULT NULL,
  PRIMARY KEY (`Id_Pnevmatike`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table test1.pnevmatike: 50 rows
/*!40000 ALTER TABLE `pnevmatike` DISABLE KEYS */;
INSERT INTO `pnevmatike` (`Id_Pnevmatike`, `Ime_Pnevmatike`, `Opis_Pnevmatike`, `Cena_Pnevmatike`, `Slika_Pnevmatike`) VALUES
	(1, 'Pnevmatika Goodyear 1', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 114.82, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(2, 'Pnevmatika Continental 2', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 43.12, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(3, 'Pnevmatika Goodyear 3', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 108.97, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(4, 'Pnevmatika Continental 4', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 91.03, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(5, 'Pnevmatika Bridgestone 5', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 42.83, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(6, 'Pnevmatika Continental 6', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 49.14, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(7, 'Pnevmatika Michelin 7', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 78.69, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(8, 'Pnevmatika Continental 8', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 132.18, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(9, 'Pnevmatika Continental 9', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 99.50, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(10, 'Pnevmatika Continental 10', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 43.24, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(11, 'Pnevmatika Goodyear 11', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 49.25, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(12, 'Pnevmatika Bridgestone 12', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 105.54, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(13, 'Pnevmatika Bridgestone 13', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 90.00, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(14, 'Pnevmatika Continental 14', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 86.49, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(15, 'Pnevmatika Goodyear 15', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 85.05, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(16, 'Pnevmatika Goodyear 16', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 85.34, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(17, 'Pnevmatika Michelin 17', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 51.97, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(18, 'Pnevmatika Pirelli 18', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 127.87, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(19, 'Pnevmatika Goodyear 19', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 72.39, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(20, 'Pnevmatika Pirelli 20', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 59.59, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(21, 'Pnevmatika Continental 21', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 47.16, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(22, 'Pnevmatika Bridgestone 22', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 78.78, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(23, 'Pnevmatika Michelin 23', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 106.77, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(24, 'Pnevmatika Continental 24', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 43.65, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(25, 'Pnevmatika Michelin 25', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 102.43, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(26, 'Pnevmatika Bridgestone 26', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 131.48, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(27, 'Pnevmatika Bridgestone 27', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 106.83, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(28, 'Pnevmatika Goodyear 28', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 146.86, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(29, 'Pnevmatika Goodyear 29', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 83.88, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(30, 'Pnevmatika Pirelli 30', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 71.07, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(31, 'Pnevmatika Michelin 31', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 64.96, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(32, 'Pnevmatika Bridgestone 32', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 124.21, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(33, 'Pnevmatika Michelin 33', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 42.28, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(34, 'Pnevmatika Michelin 34', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 128.78, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(35, 'Pnevmatika Michelin 35', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 96.46, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(36, 'Pnevmatika Bridgestone 36', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 47.96, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(37, 'Pnevmatika Pirelli 37', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 99.66, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(38, 'Pnevmatika Continental 38', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 147.51, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(39, 'Pnevmatika Goodyear 39', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 80.53, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(40, 'Pnevmatika Bridgestone 40', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 121.59, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(41, 'Pnevmatika Continental 41', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 55.67, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(42, 'Pnevmatika Pirelli 42', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 72.86, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(43, 'Pnevmatika Bridgestone 43', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 84.71, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(44, 'Pnevmatika Goodyear 44', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 77.18, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(45, 'Pnevmatika Michelin 45', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 100.25, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(46, 'Pnevmatika Pirelli 46', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 99.38, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(47, 'Pnevmatika Michelin 47', 'Celosezonska pnevmatika velikosti 195/65 R15 z odličnim oprijemom.', 87.12, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(48, 'Pnevmatika Bridgestone 48', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 70.25, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(49, 'Pnevmatika Bridgestone 49', 'Celosezonska pnevmatika velikosti 205/55 R16 z odličnim oprijemom.', 101.14, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067),
	(50, 'Pnevmatika Bridgestone 50', 'Celosezonska pnevmatika velikosti 225/45 R17 z odličnim oprijemom.', 61.49, _binary 0x736c696b652f506e65766d6174696b652f67756d612e6a7067);
/*!40000 ALTER TABLE `pnevmatike` ENABLE KEYS */;

-- Dumping structure for tabela test1.services
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table test1.services: ~5 rows (približno)
INSERT INTO `services` (`id`, `name`, `description`, `image`) VALUES
	(1, 'Menjava olja', 'Profesionalna menjava motornega olja z visokokakovostnimi materiali.', 'slike/motorji/delavnica.jpg'),
	(2, 'Servis motorja', 'Celovit servis motorja, ki zagotavlja optimalno delovanje vašega motorja.', 'slike/motorji/delavnica.jpg'),
	(3, 'Popravilo motorja', 'Strokovno popravilo in diagnostika napak za vaš motor.', 'slike/motorji/delavnica.jpg'),
	(4, 'Optimizacija motorja', 'Povečajte zmogljivost vašega motorja z našimi rešitvami optimizacije.', 'slike/motorji/delavnica.jpg'),
	(5, 'Diagnostika motorja', 'Napredna diagnostika za odkrivanje vseh skritih težav motorja.', 'slike/motorji/delavnica.jpg');

-- Dumping structure for tabela test1.uporabniki
CREATE TABLE IF NOT EXISTS `uporabniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) NOT NULL,
  `priimek` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `geslo` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table test1.uporabniki: ~3 rows (približno)
INSERT INTO `uporabniki` (`id`, `ime`, `priimek`, `username`, `email`, `geslo`, `admin`) VALUES
	(1, 'Nejc', 'Florjanc', 'nejc', 'NEJC.TRAMPUS5@GMAIL.COM', '$2y$10$iZweSYBo26uiB7mfVXwwuOcDIXS6SVlDAfaVrVrP1f8TWD.1Im9lO', 0),
	(2, 'Jaka', 'Jaka', 'kren', 'NEJC.TRAMPUS05@GMAIL.COM', '$2y$10$jmjBnGbToDE45ee2kiIrCuHxWngR4571VKWyXFLbFdysd2rlEpDrK', 0),
	(3, 'Nejc', 'jaakss', 'trampy', 'alostari@gmail.com', '$2y$10$Ktf5ChqFj77TQOA84f3XDu5Xswr2gA5SdL9Ocv6QCw91WZasVw8Iy', 0),
	(4, 'Nejc', 'sda', 'sfsdfgsdfs', 'NEJC.TRAMPUS33@GMAIL.COM', '$2y$10$eExRfdgLWanf2AHQpPnXguU3bRMAdikyF11mWzfbKE4/f1XW1182u', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
