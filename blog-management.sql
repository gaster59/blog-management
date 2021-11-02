-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.72-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for blog-management
DROP DATABASE IF EXISTS `blog-management`;
CREATE DATABASE IF NOT EXISTS `blog-management` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `blog-management`;

-- Dumping structure for table blog-management.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) DEFAULT NULL,
  `title` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_category_parent` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.category: 41 rows
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `parent_id`, `title`, `meta_title`, `slug`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, NULL, 'Thịt, cá, hải sản', NULL, 'thit-ca-hai-san', '<p>Thịt, c&aacute;, hải sản</p>', '2021-10-17 08:10:47', '2021-10-27 09:29:08', NULL),
	(2, NULL, 'Rau, củ, trái cây', NULL, 'Rau, cu, trai cay', '<p>Rau, củ, tr&aacute;i c&acirc;y</p>', '2021-10-17 09:20:59', '2021-10-27 09:29:10', NULL),
	(3, NULL, 'Đồ uống các loại', NULL, 'Do uong cac loai', '<p>Đồ uống c&aacute;c loại</p>', '2021-10-17 09:22:02', '2021-10-17 09:22:02', NULL),
	(4, NULL, 'Sữa uống các loại', NULL, 'Sua uong cac loai', '<p>Sữa uống c&aacute;c loại</p>', '2021-10-17 09:22:20', '2021-10-17 09:22:20', NULL),
	(5, NULL, 'Bánh kẹo các loại', NULL, 'Banh keo cac loai', '<p>B&aacute;nh kẹo c&aacute;c loại</p>', '2021-10-17 09:22:34', '2021-10-17 09:22:34', NULL),
	(6, NULL, 'Mì, cháo, phở, bún', NULL, 'Mi, chao, pho, bun', '<p>M&igrave;, ch&aacute;o, phở, b&uacute;n</p>', '2021-10-17 09:22:53', '2021-10-17 09:22:53', NULL),
	(7, NULL, 'Dầu ăn gia vị', NULL, 'Dau an gia vi', '<p>Dầu ăn gia vị</p>', '2021-10-17 09:23:25', '2021-10-17 09:23:25', NULL),
	(8, NULL, 'Gạo bột đồ khô', NULL, 'Gao bot do kho', '<p>Gạo bột đồ kh&ocirc;</p>', '2021-10-17 09:23:37', '2021-10-17 09:23:37', NULL),
	(9, NULL, 'Đồ mát đông lạnh', NULL, 'Do mat dong lanh', '<p>Đồ m&aacute;t đ&ocirc;ng lạnh</p>', '2021-10-17 09:23:54', '2021-10-17 09:23:54', NULL),
	(10, NULL, 'Tả đồ cho bé', NULL, 'Ta do cho be', '<p>Tả đồ cho b&eacute;</p>', '2021-10-17 09:24:13', '2021-10-17 09:24:13', NULL),
	(11, NULL, 'Chăm sóc cá nhân', NULL, 'Cham soc ca nhan', '<p>Chăm s&oacute;c c&aacute; nh&acirc;n</p>', '2021-10-17 09:24:26', '2021-10-17 09:24:26', NULL),
	(12, NULL, 'Vệ sinh cá nhân', NULL, 'Ve sinh ca nhan', '<p>Vệ sinh c&aacute; nh&acirc;n</p>', '2021-10-17 09:24:48', '2021-10-17 09:24:48', NULL),
	(13, NULL, 'Đồ dùng gia đình', NULL, 'Do dung gia dinh', '<p>Đồ d&ugrave;ng gia đ&igrave;nh</p>', '2021-10-17 09:24:59', '2021-10-17 09:24:59', NULL),
	(14, 1, 'Thịt heo các loại', NULL, 'Thit heo cac loai', '<p>Thịt heo c&aacute;c loại</p>', '2021-10-17 09:42:25', '2021-10-27 09:24:43', NULL),
	(15, 1, 'Thịt gà các loại', NULL, 'Thit ga cac loai', '<p>Thịt g&agrave; c&aacute;c loại</p>', '2021-10-17 11:57:02', '2021-10-27 09:24:45', NULL),
	(16, 1, 'Thịt bò các loại', NULL, 'Thit bo cac loai', '<p>Thịt b&ograve; c&aacute;c loại</p>', '2021-10-17 11:57:23', '2021-10-27 09:24:46', NULL),
	(17, 1, 'Trứng gà vịt cút', NULL, 'Trung ga vit cut', '<p>Trứng g&agrave; vịt c&uacute;t</p>', '2021-10-17 11:57:40', '2021-10-27 09:24:47', NULL),
	(18, 1, 'Cá biển nước ngọt', NULL, 'Ca bien nuoc ngot', '<p>C&aacute; biển nước ngọt</p>', '2021-10-17 11:58:02', '2021-10-27 09:24:48', NULL),
	(19, 1, 'Hải sản các loại', NULL, 'Hai san cac loai', '<p>Hải sản c&aacute;c loại</p>', '2021-10-17 11:58:18', '2021-10-27 09:24:49', NULL),
	(20, 1, 'Thực phẩm sơ chế', NULL, 'Thuc pham so che', '<p>Thực phẩm sơ chế</p>', '2021-10-17 11:58:31', '2021-10-27 09:24:49', NULL),
	(21, 1, 'Thực phẩm đông lạnh', NULL, 'Thuc pham dong lanh', '<p>Thực phẩm đ&ocirc;ng lạnh</p>', '2021-10-17 11:58:44', '2021-10-17 11:58:44', NULL),
	(22, 2, 'Rau xanh các loại', NULL, 'Rau xanh cac loai', '<p>Rau xanh c&aacute;c loại</p>', '2021-10-17 12:06:22', '2021-10-17 12:06:22', NULL),
	(23, 2, 'Củ quả các loại', NULL, 'Cu qua cac loai', '<p>Củ quả c&aacute;c loại</p>', '2021-10-17 12:06:39', '2021-10-17 12:06:39', NULL),
	(24, 2, 'Nấm tươi các loại', NULL, 'Nam tuoi cac loai', '<p>Nấm tươi c&aacute;c loại</p>', '2021-10-17 12:06:57', '2021-10-17 12:06:57', NULL),
	(25, 3, 'Nước ngọt, nước trà', NULL, 'Nuoc ngot, nuoc tra', '<p>Nước ngọt, nước tr&agrave;</p>', '2021-10-17 12:07:25', '2021-10-17 12:07:25', NULL),
	(26, 3, 'Cà phê trà các loại', NULL, 'Ca phe tra cac loai', '<p>C&agrave; ph&ecirc; tr&agrave; c&aacute;c loại</p>', '2021-10-17 12:07:43', '2021-10-19 13:11:24', NULL),
	(27, 3, 'Nước uống tăng lực', NULL, 'Nuoc uong tang luc', '<p>Nước uống tăng lực</p>', '2021-10-17 12:08:02', '2021-10-17 12:08:02', NULL),
	(28, 3, 'Nước uống trái cây', NULL, 'Nuoc uong trai cay', '<p>Nước uống tr&aacute;i c&acirc;y</p>', '2021-10-17 12:08:22', '2021-10-17 12:08:22', NULL),
	(29, 3, 'Bia, nước có cồn', NULL, 'Bia, nuoc co con', '<p>Bia, nước c&oacute; cồn</p>', '2021-10-17 12:08:37', '2021-10-17 12:08:37', NULL),
	(30, 3, 'Nước suối, nước khoáng', NULL, 'Nuoc suoi, nuoc khoang', '<p>Nước suối, nước kho&aacute;ng</p>', '2021-10-17 12:08:55', '2021-10-17 12:08:55', NULL),
	(31, 3, 'Trà sữa đóng chai', NULL, 'Tra sua dong chai', '<p>Tr&agrave; sữa đ&oacute;ng chai</p>', '2021-10-17 12:09:06', '2021-10-19 12:57:59', NULL),
	(32, 3, 'Nước yến, cốt gà', NULL, 'Nuoc yen, cot ga', '<p>Nước yến, cốt g&agrave;</p>', '2021-10-17 12:09:22', '2021-10-17 12:09:22', NULL),
	(33, 3, 'Mật ong bột nghệ', NULL, 'Mat ong bot nghe', '<p>Mật ong bột nghệ</p>', '2021-10-17 12:09:39', '2021-10-17 12:09:39', NULL),
	(34, 3, 'Rượu ngon các loại', NULL, 'Ruou ngon cac loai', '<p>Rượu ngon c&aacute;c loại</p>', '2021-10-17 12:09:53', '2021-10-17 12:09:53', NULL),
	(35, 4, 'Sữa tươi các loại', NULL, 'Sua tuoi cac loai', '<p>Sữa tươi c&aacute;c loại</p>', '2021-10-17 12:28:31', '2021-10-17 12:28:31', NULL),
	(36, 4, 'Sữa hạt, sữa đậu', NULL, 'Sua hat, sua dau', '<p>Sữa hạt, sữa đậu</p>', '2021-10-17 12:28:47', '2021-10-17 12:28:47', NULL),
	(37, 4, 'Sữa đặc các loại', NULL, 'Sua dac cac loai', '<p>Sữa đặc c&aacute;c loại</p>', '2021-10-17 12:29:01', '2021-10-17 12:29:01', NULL),
	(38, 4, 'Sữa chua uống liền', NULL, 'Sua chua uong lien', '<p>Sữa chua uống liền</p>', '2021-10-17 12:29:15', '2021-10-17 12:29:15', NULL),
	(39, 4, 'Thức uống lúa mạch', NULL, 'Thuc uong lua mach', '<p>Thức uống l&uacute;a mạch</p>', '2021-10-17 12:29:31', '2021-10-17 12:29:31', NULL),
	(40, 4, 'Ngũ cốc, ca cao', NULL, 'Ngu coc, ca cao', '<p>Ngũ cốc, ca cao</p>', '2021-10-17 12:29:44', '2021-10-17 12:29:44', NULL),
	(41, 4, 'Sữa bột các loại', NULL, 'Sua bot cac loai', '<p>Sữa bột c&aacute;c loại</p>', '2021-10-17 12:29:59', '2021-10-17 12:32:32', NULL);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table blog-management.failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.failed_jobs: 0 rows
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table blog-management.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.migrations: 4 rows
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table blog-management.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.password_resets: 0 rows
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table blog-management.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.personal_access_tokens: 3 rows
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 2, 'blog-management', '7a53897042bb57ec33f8c53396c0af7e5a6c3a3f57e6a6a703e614fbacd8c430', '["*"]', NULL, '2021-10-16 14:39:13', '2021-10-16 14:39:13'),
	(2, 'App\\Models\\User', 2, 'blog-management', 'd89c231e7199904af0d62140514108e5adb88133ee36a1f46871478d25b14f39', '["*"]', NULL, '2021-10-16 14:39:32', '2021-10-16 14:39:32'),
	(3, 'App\\Models\\User', 2, 'blog-management', 'f2c9ad1e06405c19fd0ac7d6d9980d497d7fe4bb0e58e90cf85ba4b55a883018', '["*"]', NULL, '2021-10-16 14:43:15', '2021-10-16 14:43:15');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table blog-management.post
DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `author_id` bigint(20) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) DEFAULT NULL,
  `title` varchar(75) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `summary` tinytext COLLATE utf8_unicode_ci,
  `avatar` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_slug` (`slug`),
  KEY `idx_post_user` (`author_id`),
  KEY `idx_post_parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.post: ~2 rows (approximately)
DELETE FROM `post`;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `author_id`, `parent_id`, `title`, `meta_title`, `slug`, `summary`, `avatar`, `published`, `created_at`, `updated_at`, `published_at`, `content`, `deleted_at`) VALUES
	(50, 2, NULL, 'tyrtyt', NULL, 'tyrtyt', '<p>yrtyrty</p>', 'post_1635748986.jpg', 0, '2021-11-01 06:43:06', '2021-11-01 06:43:06', NULL, '<p>rtyrtyrt</p>', NULL),
	(51, 2, NULL, 'lklklkss11', NULL, 'lklklkss11', '<p>lklklk</p>', 'post_1635755161.jpg', 0, '2021-11-01 07:37:58', '2021-11-01 10:14:09', NULL, '<p>lklklkl</p>', '2021-11-01 10:14:09');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table blog-management.post_category
DROP TABLE IF EXISTS `post_category`;
CREATE TABLE IF NOT EXISTS `post_category` (
  `post_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`post_id`,`category_id`),
  KEY `idx_pc_category` (`category_id`),
  KEY `idx_pc_post` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.post_category: 3 rows
DELETE FROM `post_category`;
/*!40000 ALTER TABLE `post_category` DISABLE KEYS */;
INSERT INTO `post_category` (`post_id`, `category_id`) VALUES
	(50, 1),
	(51, 21),
	(52, 21);
/*!40000 ALTER TABLE `post_category` ENABLE KEYS */;

-- Dumping structure for table blog-management.post_comment
DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE IF NOT EXISTS `post_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_comment_post` (`post_id`),
  KEY `idx_comment_parent` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.post_comment: 0 rows
DELETE FROM `post_comment`;
/*!40000 ALTER TABLE `post_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_comment` ENABLE KEYS */;

-- Dumping structure for table blog-management.post_meta
DROP TABLE IF EXISTS `post_meta`;
CREATE TABLE IF NOT EXISTS `post_meta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_post_meta` (`post_id`,`key`),
  KEY `idx_meta_post` (`post_id`),
  CONSTRAINT `fk_meta_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.post_meta: ~0 rows (approximately)
DELETE FROM `post_meta`;
/*!40000 ALTER TABLE `post_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_meta` ENABLE KEYS */;

-- Dumping structure for table blog-management.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` smallint(6) NOT NULL COMMENT '1: admin, 2: normal user',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile` text COLLATE utf8_unicode_ci NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table blog-management.users: ~10 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `role`, `email`, `email_verified_at`, `password`, `mobile`, `profile`, `last_login`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Raymundo Sipes', 2, 'qdamore@yahoo.com', NULL, '$2y$10$tC9UPToJtRCHLBIfdbHxUuAt1rD0cgOynG07xoZapWN9V3BXjNCpy', '686-995-2372', 'Ab in vel quo cupiditate. Et quia eligendi cum et accusamus nobis voluptatem. Necessitatibus est aut tempore qui. Tempora hic expedita ut eos animi non velit.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(2, 'Xavier Zboncak I', 1, 'minerva14@von.com', NULL, '$2y$10$fCE8Nl0dpk.j95R0YKxm5ePsv0zTfcbxDIqyjO03Z5FZyqcWdk6s2', '673-156-8150', 'Ducimus qui eos non eius voluptatem. Quo quae nihil reiciendis eligendi magni molestiae.', '2021-11-01 05:47:12', '2a57873794ea4bee78934c694eb68ceddc861438f44569f365f45421c8e2b0df', '2021-10-16 12:51:44', '2021-11-01 05:47:12', NULL),
	(3, 'Daren Funk', 1, 'prohaska.itzel@greenholt.com', NULL, '$2y$10$.jCTWuUc9WKwSN3wA6Ms4OtanpQXLH4Hf7ye8tjPsTbSNPVWksa6.', '880-977-6814', 'Qui maxime ad corporis et ratione illo. Rerum nihil id eum laboriosam corrupti. Tenetur laudantium rerum ab aperiam in beatae. Quasi deleniti laudantium iusto laudantium.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(4, 'Damion Haag', 2, 'whills@yahoo.com', NULL, '$2y$10$s2/BBXL9moYY/xRWpOiZi.KnkLQIIO8xBvMIbji6WSY2hFzNUVHgm', '521-478-2969', 'Vero voluptas cupiditate sunt eveniet. Voluptas sed natus voluptas et numquam. Excepturi fugiat et voluptas est cumque adipisci nesciunt. Soluta placeat quo cumque sunt ut.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(5, 'Titus Leffler', 1, 'colton.halvorson@leannon.com', NULL, '$2y$10$yZXxyiVM.yQYXLFF/xwn7.4ypX0PXT..nykpMScBux/Lvh/Gv0sIC', '021-489-1811', 'Rerum ex non quaerat a fuga nihil. Ea vero eos sunt sit. Qui velit molestias omnis perferendis sequi. Sed non est et eum ipsam error.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(6, 'Yesenia Kiehn I', 2, 'bode.wilhelmine@rowe.com', NULL, '$2y$10$W3tYvRqIUfXaOyMjN9Y7huHzf8q.V6TUVFkHulbLPagHCKsWfAVgy', '303-137-9370', 'Ratione reiciendis ipsa cumque officiis fugiat. Sapiente rerum ipsam alias sunt laborum modi quasi.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(7, 'Scotty Conroy Jr.', 2, 'roberts.adolfo@yundt.com', NULL, '$2y$10$1MFd4YI/oK/F2zilgOD9HO751lMV.bQ.uHfrVgIKpsHftLQIkgzhq', '113-375-2391', 'Culpa asperiores corrupti ut rerum. Distinctio est eligendi necessitatibus quo corrupti rerum.', NULL, NULL, '2021-10-16 12:51:44', '2021-10-16 12:51:44', NULL),
	(8, 'Francesco Cummerata', 1, 'sienna.steuber@towne.com', NULL, '$2y$10$rTSYUFwdQj7.sPbqz2O8IOLrZglFzdVK53T/dNPG22OvciFWfUon2', '860-262-0065', 'Culpa magnam aut magnam et. Itaque et ut ut aut sint modi sunt. Quibusdam qui eaque dolorem quia.', NULL, NULL, '2021-10-16 12:51:45', '2021-10-16 12:51:45', NULL),
	(9, 'Brandt Goyette', 1, 'mdonnelly@cole.com', NULL, '$2y$10$YvJpsvmDSO984ndfsVochu6020BBfdxjHulsYsDI7yr7BA0r.uV6e', '668-888-4043', 'Beatae quis quos eos omnis quod. Itaque est libero ut officiis. Numquam totam reiciendis voluptatem quia.', NULL, NULL, '2021-10-16 12:51:45', '2021-10-16 12:51:45', NULL),
	(10, 'Rhea Mayert', 1, 'mcdermott.buck@yahoo.com', NULL, '$2y$10$pvTPfp4L6kO2RNSoNhS.TOvmiOLnfhwzRifCFn6H3XQQNBgdc5W/q', '793-736-9596', 'Deleniti id dolor qui dicta. Temporibus suscipit aut dolore quaerat. Voluptate incidunt doloribus labore id.', NULL, NULL, '2021-10-16 12:51:45', '2021-10-16 12:51:45', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
