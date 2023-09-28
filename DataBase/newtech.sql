-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for eshop
CREATE DATABASE IF NOT EXISTS `newtech` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `newtech`;

-- Dumping structure for table eshop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.admin: ~0 rows (approximately)
INSERT INTO `admin` (`email`, `fname`, `lname`, `verification_code`) VALUES
	('praveenlakshan05@gmail.com', 'Praveen', 'Lakshan', '65152ed5ce2ad');

-- Dumping structure for table eshop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_category1_idx` (`category_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.brand: ~10 rows (approximately)
INSERT INTO `brand` (`id`, `name`, `category_id`) VALUES
	(1, 'Samsung', 1),
	(2, 'Apple', 1),
	(3, 'Huawei', 1),
	(4, 'Vivo', 1),
	(5, 'Sony', 1),
	(6, 'Oppo', 1),
	(7, 'Dell', 2),
	(8, 'MSI', 2),
	(9, 'ASUS', 2),
	(10, 'Accer', 2);

-- Dumping structure for table eshop.brand_has_model
CREATE TABLE IF NOT EXISTS `brand_has_model` (
  `brand_id` int NOT NULL,
  `model_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_brand_has_model_model1_idx` (`model_id`),
  KEY `fk_brand_has_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_brand_has_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_brand_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.brand_has_model: ~8 rows (approximately)
INSERT INTO `brand_has_model` (`brand_id`, `model_id`, `id`) VALUES
	(2, 1, 1),
	(2, 3, 2),
	(1, 2, 3),
	(3, 4, 4),
	(5, 7, 5),
	(4, 6, 6),
	(6, 5, 7),
	(8, 8, 8),
	(9, 9, 9),
	(10, 10, 10),
	(7, 11, 11),
	(2, 12, 12);

-- Dumping structure for table eshop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.cart: ~2 rows (approximately)
INSERT INTO `cart` (`id`, `qty`, `product_id`, `user_email`) VALUES
	(11, 1, 3, 'praveenlakshan021@gmail.com');

-- Dumping structure for table eshop.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.category: ~10 rows (approximately)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Cell Phones And Accessories'),
	(2, 'Laptops And Accessories'),
	(3, 'Tablets'),
	(4, 'Computer, Office Security'),
	(5, 'Camera And Photo');

-- Dumping structure for table eshop.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.chat: ~15 rows (approximately)
INSERT INTO `chat` (`id`, `content`, `date_time`, `status`, `from`, `to`) VALUES
	(1, 'Did You Get The Package', '2022-11-02 11:14:48', 1, 'praveenlakshan021@gmail.com', 'techlucky@gmail.com'),
	(2, 'Not Yet', '2022-11-02 11:15:22', 1, 'techlucky@gmail.com', 'praveenlakshan021@gmail.com'),
	(3, 'Can I Know The Order Number ', '2022-11-03 08:13:57', 1, 'praveenlakshan021@gmail.com', 'techlucky@gmail.com'),
	(4, 'Ok I Will Send It', '2022-11-03 08:14:26', 1, 'techlucky@gmail.com', 'praveenlakshan021@gmail.com'),
	(5, 'ok', '2022-11-04 07:10:54', 0, 'praveenlakshan021@gmail.com', 'techlucky@gmail.com'),
	(6, 'Hello User', '2022-11-12 21:21:00', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(7, 'Hello Admin', '2022-11-12 21:21:21', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(8, 'Hello Admin', '2022-11-12 21:22:45', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(9, 'Hello User', '2022-11-12 21:25:20', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(10, 'Hello Admin', '2022-11-12 21:25:35', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(11, 'Hello User', '2022-11-12 21:57:09', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(12, 'Hello Admin', '2022-11-12 21:57:21', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(14, 'Hello Admin', '2022-11-12 21:59:20', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(15, '', '2022-11-12 22:01:13', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(16, '', '2022-11-12 22:01:35', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com'),
	(17, 'Hello Admin', '2023-09-28 10:42:53', 0, 'praveenlakshan021@gmail.com', 'praveenlakshan05@gmail.com');

-- Dumping structure for table eshop.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.city: ~7 rows (approximately)
INSERT INTO `city` (`id`, `name`, `district_id`) VALUES
	(1, 'Udugampola', 1),
	(2, 'Gampaha', 1),
	(3, 'Negombo', 1),
	(4, 'Colombo', 2),
	(5, 'Maharagama', 2),
	(6, 'Nugegoda', 2),
	(7, 'Kaluthara', 3);

-- Dumping structure for table eshop.colour
CREATE TABLE IF NOT EXISTS `colour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.colour: ~6 rows (approximately)
INSERT INTO `colour` (`id`, `name`) VALUES
	(1, 'Black'),
	(2, 'Red'),
	(3, 'Rose Gold'),
	(4, 'Pacific Blue'),
	(5, 'Silver'),
	(6, 'White');

-- Dumping structure for table eshop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.condition: ~2 rows (approximately)
INSERT INTO `condition` (`id`, `name`) VALUES
	(1, 'Brand New'),
	(2, 'Used');

-- Dumping structure for table eshop.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.district: ~8 rows (approximately)
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Gampaha', 1),
	(2, 'Colombo', 1),
	(3, 'Kaluthara', 1),
	(4, 'Anuradhapura', 5),
	(5, 'Polonnaruwa', 5),
	(6, 'Kandy', 6),
	(7, 'Nuwara Eliya', 6),
	(8, 'Matale', 6);

-- Dumping structure for table eshop.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.feedback: ~0 rows (approximately)
INSERT INTO `feedback` (`id`, `type`, `feedback`, `date`, `product_id`, `user_email`) VALUES
	(1, 1, 'Best Product In Brand New Condition And Well Packaged', '2022-11-05 12:04:31', 2, 'praveenlakshan021@gmail.com');

-- Dumping structure for table eshop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table eshop.images
CREATE TABLE IF NOT EXISTS `images` (
  `code` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.images: ~9 rows (approximately)
INSERT INTO `images` (`code`, `product_id`) VALUES
	('resource/mobile_images/iphone14_pro_max.jpg', 1),
	('resource/mobile_images/iphone12.jpg', 2),
	('resource/mobile_images/samsung_s22_ultra.jpg', 3),
	('resource/mobile_images/huawei_p20.png', 4),
	('resource/mobile_images/xperia_10.jpg', 5),
	('resource/mobile_images/vivo_y20.svg', 6),
	('resource/mobile_images/oppo_a95.png', 7),
	('resource//mobile_images//iPhone12ProMax.jpeg', 9),
	('resource//laptop_images//msi_raider.jpeg', 10),
	('resource//laptop_images//asus_zenbook.jpeg', 11),
	('resource//laptop_images//acer_aspire.jpg', 12),
	('resource//laptop_images//dell5310.jpg', 13);

-- Dumping structure for table eshop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.invoice: ~3 rows (approximately)
INSERT INTO `invoice` (`id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(1, '01', '2022-11-04 12:55:03', 35000, 1, 1, 2, 'praveenlakshan021@gmail.com'),
	(2, '6364c1d14a5e9', '2022-11-04 13:11:58', 35750, 1, 2, 2, 'praveenlakshan021@gmail.com'),
	(3, '636a73708de2e', '2022-11-08 20:50:14', 49750, 1, 4, 1, 'praveenlakshan021@gmail.com');

-- Dumping structure for table eshop.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_model_brand1_idx` (`brand_id`),
  CONSTRAINT `fk_model_brand1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.model: ~8 rows (approximately)
INSERT INTO `model` (`id`, `name`, `brand_id`) VALUES
	(1, 'iPhone 14 Pro Max', 2),
	(2, 'S22 Ultra', 1),
	(3, 'iPhone 12', 2),
	(4, 'P20', 3),
	(5, 'A95', 6),
	(6, 'Y20', 4),
	(7, 'Xperia 10', 5),
	(8, 'Raider', 8),
	(9, 'Asus Zenbook', 9),
	(10, 'Acer Aspire', 10),
	(11, 'Dell 5310', 7),
	(12, 'iPhone8', 2);

-- Dumping structure for table eshop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `brand_has_model_id` int NOT NULL,
  `colour_id` int DEFAULT NULL,
  `price` double NOT NULL,
  `qtyl` int NOT NULL,
  `description` text,
  `title` varchar(120) NOT NULL,
  `condition_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_id`),
  KEY `fk_product_brand_has_model1_idx` (`brand_has_model_id`),
  KEY `fk_product_colour1_idx` (`colour_id`),
  KEY `fk_product_condition1_idx` (`condition_id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_brand_has_model1` FOREIGN KEY (`brand_has_model_id`) REFERENCES `brand_has_model` (`id`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_colour1` FOREIGN KEY (`colour_id`) REFERENCES `colour` (`id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_id`) REFERENCES `condition` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.product: ~9 rows (approximately)
INSERT INTO `product` (`id`, `category_id`, `brand_has_model_id`, `colour_id`, `price`, `qtyl`, `description`, `title`, `condition_id`, `status_id`, `user_email`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES
	(1, 1, 1, 3, 49000, 19, 'iPhone 14 Pro Max', 'iPhone 14 Pro Max', 1, 2, 'praveenlakshan021@gmail.com', '2022-10-15 15:59:41', 500, 750),
	(2, 1, 2, 2, 35000, 9, 'iPhone 12', 'iPhone 12', 1, 2, 'praveenlakshan021@gmail.com', '2022-10-15 16:00:43', 500, 750),
	(3, 1, 3, 1, 39000, 14, 'Samsung Galaxy S22 Ultra', 'Galaxy S22 Ultra', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-15 16:00:56', 500, 750),
	(4, 1, 4, 6, 22000, 8, 'Huawei P20', 'Huawei P20', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-15 16:01:42', 500, 750),
	(5, 1, 5, 6, 18000, 12, 'Sony Xperia10', 'Sony Xperia 10', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-15 16:01:42', 500, 750),
	(6, 1, 6, 3, 10000, 15, 'Vivo Y20', 'Vivo Y20', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-15 16:01:43', 500, 750),
	(7, 1, 7, 1, 15000, 4, 'Oppo A95', 'Oppo A95', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-15 16:01:44', 500, 750),
	(9, 1, 2, 4, 38000, 10, 'iPhone 12 Pro Max', 'iPhone 12 Pro Max', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-14 10:22:50', 500, 750),
	(10, 2, 8, 1, 90000, 10, 'MSI Raider', 'MSI Raider', 1, 1, 'praveenlakshan021@gmail.com', '2022-10-17 06:11:27', 500, 1000),
	(11, 2, 9, 1, 150000, 20, 'Asus Zenbook', 'Asus Zenbook', 1, 1, 'praveenlakshan021@gmail.com', '2023-09-28 11:47:37', 500, 1000),
	(12, 2, 10, 5, 70000, 4, 'Acer Aspire', 'Acer Aspire', 1, 1, 'praveenlakshan021@gmail.com', '2023-09-28 11:49:19', 500, 1000),
	(13, 2, 11, 1, 80000, 12, 'Dell 5310', 'Dell 5310', 1, 1, 'praveenlakshan021@gmail.com', '2023-09-28 11:51:00', 500, 1000);

-- Dumping structure for table eshop.profile_image
CREATE TABLE IF NOT EXISTS `profile_image` (
  `path` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.profile_image: ~0 rows (approximately)
INSERT INTO `profile_image` (`path`, `user_email`) VALUES
	('resource/profile _img/pic1.png', 'praveenlakshan021@gmail.com'),
	('resource/profile _img/pic2.png', 'praveenlakshan05@gmail.com');

-- Dumping structure for table eshop.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.province: ~9 rows (approximately)
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Western'),
	(2, 'Southern'),
	(3, 'Nothern'),
	(4, 'Eastern'),
	(5, 'North Central'),
	(6, 'Central'),
	(7, 'Uva'),
	(8, 'Sabaragamuwa'),
	(9, 'North Western');

-- Dumping structure for table eshop.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.recent: ~20 rows (approximately)
INSERT INTO `recent` (`id`, `product_id`, `user_email`) VALUES
	(1, 10, 'praveenlakshan021@gmail.com'),
	(2, 1, 'praveenlakshan021@gmail.com'),
	(3, 6, 'praveenlakshan021@gmail.com'),
	(4, 6, 'praveenlakshan021@gmail.com'),
	(5, 6, 'praveenlakshan021@gmail.com'),
	(6, 6, 'praveenlakshan021@gmail.com'),
	(7, 6, 'praveenlakshan021@gmail.com'),
	(8, 4, 'praveenlakshan021@gmail.com'),
	(9, 3, 'praveenlakshan021@gmail.com'),
	(10, 4, 'praveenlakshan021@gmail.com'),
	(11, 4, 'praveenlakshan021@gmail.com'),
	(12, 4, 'praveenlakshan021@gmail.com'),
	(13, 4, 'praveenlakshan021@gmail.com'),
	(14, 4, 'praveenlakshan021@gmail.com'),
	(15, 6, 'praveenlakshan021@gmail.com'),
	(16, 6, 'praveenlakshan021@gmail.com'),
	(17, 3, 'praveenlakshan021@gmail.com'),
	(18, 3, 'praveenlakshan021@gmail.com'),
	(19, 6, 'praveenlakshan021@gmail.com'),
	(20, 3, 'praveenlakshan021@gmail.com'),
	(21, 6, 'praveenlakshan021@gmail.com'),
	(22, 7, 'praveenlakshan021@gmail.com'),
	(23, 4, 'praveenlakshan021@gmail.com'),
	(24, 12, 'praveenlakshan021@gmail.com');

-- Dumping structure for table eshop.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.status: ~2 rows (approximately)
INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'Active'),
	(2, 'Inactive');

-- Dumping structure for table eshop.user
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(30) DEFAULT NULL,
  `status` int NOT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.user: ~4 rows (approximately)
INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `mobile`, `joined_date`, `verification_code`, `status`, `gender_id`) VALUES
	('praveenlakshan021@gmail.com', 'Praveen', 'Lakshan', '1234567', '0764015938', '2022-10-02 10:12:25', '6358d77bd9aa6', 0, 1),
	('praveenlakshan05@gmail.com', 'Praveen', 'Lakshan', 'japl12345', '0779616048', '2022-09-29 11:13:29', '633a54110305f', 0, 1),
	('praveenlakshan20@gmail.com', 'Praveen', 'Lakshan', '123456789', '0779616045', '2022-10-30 07:41:23', NULL, 0, 1),
	('techlucky@gmail.com', 'Tech', 'Lucky', '123456789', '0701721980', '2022-10-08 10:32:05', NULL, 0, 1);

-- Dumping structure for table eshop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_id` int NOT NULL,
  `id` int NOT NULL,
  `line1` text NOT NULL,
  `line2` text NOT NULL,
  `post_code` varchar(5) NOT NULL,
  KEY `fk_user_has_address_user1_idx` (`user_email`),
  KEY `fk_user_has_address_city1_idx` (`city_id`),
  CONSTRAINT `fk_user_has_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_address_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.user_has_address: ~0 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_id`, `id`, `line1`, `line2`, `post_code`) VALUES
	('praveenlakshan021@gmail.com', 1, 1, '149/26 Nelum Pedesa Seeduwa Road,', 'Udugampola', '11030');

-- Dumping structure for table eshop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_user1_idx` (`user_email`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table eshop.watchlist: ~2 rows (approximately)
INSERT INTO `watchlist` (`id`, `product_id`, `user_email`) VALUES
	(10, 3, 'praveenlakshan021@gmail.com'),
	(12, 7, 'praveenlakshan05@gmail.com'),
	(13, 13, 'praveenlakshan021@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
