-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2024 at 12:02 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u115696107_gigcafedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int(10) UNSIGNED NOT NULL,
  `bannable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bannable_id` bigint(20) UNSIGNED NOT NULL,
  `created_by_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `fulfilled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `menu_id`, `order_id`, `quantity`, `fulfilled`) VALUES
(71, 123, 28, 61, 1, 1),
(72, 122, 34, 62, 1, 1),
(86, 193, 29, 74, 1, 1),
(87, 131, 3, 75, 2, 1),
(88, 140, 25, 76, 1, 1),
(89, 134, 3, 77, 3, 1),
(90, 134, 34, 77, 1, 1),
(91, 132, 32, 78, 1, 1),
(92, 165, 26, 79, 1, 1),
(93, 164, 34, 80, 1, 1),
(94, 164, 16, 80, 1, 1),
(95, 162, 34, 81, 1, 1),
(96, 162, 17, 81, 1, 1),
(97, 130, 23, 82, 1, 1),
(101, 106, 3, 84, 1, 0),
(102, 106, 4, 84, 1, 0),
(103, 106, 24, NULL, 1, 0),
(104, 106, 6, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `catering_options`
--

CREATE TABLE `catering_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catering_options`
--

INSERT INTO `catering_options` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(35, 'Full Catering', '(for all-inclusive packages)', '1726911000-sbmWkGJakKZ4E1y0BH6s9NyrOnkSttHUGJ3zlwzM.jpg', '2024-08-29 22:02:19', '2024-11-17 06:51:32'),
(36, 'Service-Only Catering', '(for services without food)', '1726911010-3ku9Q4PFAt80d4EJE4g94OBEvwaAFomO8Xe4d10P.jpg', '2024-08-29 22:25:57', '2024-09-21 09:30:10'),
(37, 'Equipment Rental', '(for renting catering equipment)', '1726911019-3ku9Q4PFAt80d4EJE4g94OBEvwaAFomO8Xe4d10P.jpg', '2024-08-29 22:26:26', '2024-09-21 09:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('2621a836-680f-45b3-8726-9d2ba3165337', 2, 46, '2024-04-14 21:36:49', '2024-04-14 21:36:49'),
('77990670-cb07-4efe-978e-70823ef110c9', 1, 2, '2024-04-11 23:04:05', '2024-04-11 23:04:05'),
('ac72cd2a-0ec2-411c-885a-5e58aff3e6c1', 2, 1, '2024-04-11 23:06:19', '2024-04-11 23:06:19'),
('ceb5d7b3-c654-42fc-83a2-f4c29b58a82e', 46, 2, '2024-04-14 19:58:26', '2024-04-14 19:58:26'),
('f30a8cf1-f783-49d1-a9ea-b0abcf416567', 106, 1, '2024-11-15 14:56:32', '2024-11-15 14:56:32');

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('05a8284a-fe5b-4908-b302-a93af2c8fa8a', 1, 2, 'pre punta kana dito', NULL, 1, '2024-05-12 20:02:19', '2024-05-12 20:02:46'),
('0922fd0c-3ad2-415e-915b-ee0eb5881aeb', 106, 106, 'hi', NULL, 0, '2024-11-12 11:16:14', '2024-11-12 11:16:14'),
('0c7a7872-d37d-46c2-94c3-e311b702b214', 106, 1, '😀😀😀😃😀😀', NULL, 1, '2024-11-15 14:57:38', '2024-11-15 14:58:27'),
('0fdfce4d-40a2-4f11-8b6d-d3f4098c64ca', 1, 113, '', '{\"new_name\":\"3db50c6f-c42a-4bb1-aec3-d4b96d06ed46.jpg\",\"old_name\":\"457722109_1589971678264907_8194792341793973106_n.jpg\"}', 1, '2024-09-19 10:46:53', '2024-09-19 10:46:57'),
('10f9a00f-fa58-4764-83fd-7c7de8f874e9', 1, 46, 'QWDSQWDQWD', NULL, 1, '2024-05-14 00:48:43', '2024-05-14 00:48:44'),
('1bad8952-2081-46e7-ab47-d55d31a421ad', 1, 46, '123', NULL, 1, '2024-05-12 20:12:43', '2024-05-12 20:13:05'),
('214691bc-46d9-4160-af0a-f70b067106fa', 1, 46, 'djdjkdjawbdhkwaDHWQDKU', NULL, 1, '2024-05-14 00:48:24', '2024-05-14 00:48:30'),
('31a41af5-8082-4122-8fc4-5486de8bcc4e', 1, 1, 'hi', NULL, 1, '2024-04-11 23:04:44', '2024-04-11 23:04:54'),
('3cfbcd1f-8ef7-4349-8401-4ba1c49812ac', 106, 2, 'dd', NULL, 0, '2024-05-22 23:49:24', '2024-05-22 23:49:24'),
('3eeb11b4-675e-4384-9944-252596c11d70', 1, 46, '🐱', NULL, 1, '2024-05-14 00:49:24', '2024-05-14 00:49:26'),
('400d17df-ab1c-448a-b674-8314fddc5918', 1, 46, 'AHDAHDVJA', NULL, 1, '2024-05-15 21:47:47', '2024-05-15 21:47:47'),
('41fd8fb3-81bd-4f99-846b-d5055b8b9334', 106, 1, 'jaja', NULL, 1, '2024-11-15 14:57:49', '2024-11-15 14:58:27'),
('65b26d3a-80fe-43d1-bb80-9c5912920924', 106, 1, 'hi', NULL, 1, '2024-11-15 14:56:44', '2024-11-15 14:58:27'),
('69d9d7e4-959b-4166-badc-adfebef8bf86', 1, 93, 'wqhdwqhdqlkd', NULL, 1, '2024-05-14 22:27:30', '2024-05-14 22:28:03'),
('84d777e1-abec-48df-a445-62368214b48a', 46, 1, '', '{\"new_name\":\"8ef70c62-3a41-4672-b857-6fdd1a7e98f9.jpg\",\"old_name\":\"561124.jpg\"}', 1, '2024-05-14 00:51:16', '2024-05-14 22:26:35'),
('87199833-6e8f-4c9d-892a-f309ab5e3c71', 106, 1, 'hsh', NULL, 1, '2024-11-15 14:57:52', '2024-11-15 14:58:27'),
('8e486f6e-2599-40aa-b64d-89086ad0a292', 113, 1, 'ano po available na service', NULL, 1, '2024-09-19 10:44:41', '2024-09-19 10:44:46'),
('8eb320c8-313e-43f5-bfa4-5aad51ef31d1', 93, 1, 'dwldjoqwdjk', NULL, 1, '2024-05-14 22:28:49', '2024-05-14 22:28:50'),
('af05ee48-a0b7-4f50-8846-17f3d0026f53', 1, 46, '', '{\"new_name\":\"f435239a-9e20-41a0-89f8-9c1981db9cf5.jpg\",\"old_name\":\"17947.jpg\"}', 1, '2024-05-14 00:50:10', '2024-05-14 00:51:04'),
('b13caedc-2d44-4a7a-bac8-e685355a6791', 46, 1, 'DWDQWDJWVDHWVEJHD', NULL, 1, '2024-05-14 00:48:36', '2024-05-14 00:48:36'),
('b3e96175-6f35-4b08-aac7-9d30e2e68e6b', 1, 46, '🥰😙😙😊', NULL, 1, '2024-05-15 21:46:53', '2024-05-15 21:47:18'),
('c58541d8-4778-4674-bc8a-88dfaa724c1c', 1, 93, 'awkjdwakdhawih🤗', NULL, 1, '2024-05-14 22:28:25', '2024-05-14 22:28:26'),
('c67acf07-f985-42a6-9796-cbc76b15554c', 1, 113, 'Birthday Service', NULL, 1, '2024-09-19 10:45:06', '2024-09-19 10:45:06'),
('ca584f6a-5db5-437e-a4fc-efdc1c91e571', 46, 1, '', '{\"new_name\":\"f487a583-87fd-409e-b91a-0270e707ad6c.jpg\",\"old_name\":\"7314.jpg\"}', 1, '2024-05-14 00:49:37', '2024-05-14 00:49:38'),
('d02fd51b-66a3-48d0-895f-f3bdb44941b6', 1, 93, '', '{\"new_name\":\"bc6cee98-6d5b-4121-902b-6282c0e29388.jpg\",\"old_name\":\"436859018_391315340545971_5221176735793842929_n.jpg\"}', 1, '2024-05-14 22:28:39', '2024-05-14 22:28:40'),
('e6b7c958-cf63-4c5d-9951-9323d4e62524', 113, 1, 'ok po', NULL, 1, '2024-09-19 10:45:18', '2024-09-19 10:45:19'),
('fb0022f7-f59e-47e2-b524-f018f074b725', 46, 1, 'DWQDWFRGFEFERFREF', NULL, 1, '2024-05-14 00:48:55', '2024-05-14 00:48:57'),
('fc3f8359-0ea6-465c-85ed-d41768c0800b', 1, 46, '😝', NULL, 1, '2024-05-14 00:49:06', '2024-05-14 00:49:08');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `discountCode` varchar(255) DEFAULT NULL,
  `percentage` smallint(6) DEFAULT NULL,
  `minSpend` decimal(6,2) DEFAULT NULL,
  `cap` decimal(5,2) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `created_at`, `updated_at`, `discountCode`, `percentage`, `minSpend`, `cap`, `startDate`, `endDate`, `description`) VALUES
(1, '2024-05-12 20:11:58', '2024-05-21 21:53:25', '123', 10, 100.00, 200.00, '2024-05-22', '2024-05-23', 'hgfasdhjkasdkhiuh');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `image`, `category`, `created_at`, `updated_at`) VALUES
(21, '1727052885-357394071_704934344981587_1185844847418096726_n.jpg', 'Wedding', '2024-09-23 00:54:45', '2024-09-23 00:54:45'),
(22, '1727052897-357053703_704934694981552_5964147288024948815_n.jpg', 'Wedding', '2024-09-23 00:54:57', '2024-09-23 00:54:57'),
(23, '1727052904-357098911_704934234981598_6771800479847694702_n.jpg', 'Wedding', '2024-09-23 00:55:04', '2024-09-23 00:55:04'),
(24, '1727052950-356903132_704934771648211_4003512476753198090_n.jpg', 'Wedding', '2024-09-23 00:55:50', '2024-09-23 00:55:50'),
(25, '1727052974-363364649_720515156756839_4727046200366334208_n.jpg', 'Wedding', '2024-09-23 00:56:14', '2024-09-23 00:56:14'),
(26, '1727052993-gigcafe img 1.jpg', 'Wedding', '2024-09-23 00:56:33', '2024-09-23 00:56:33'),
(27, '1727053007-361937836_720515133423508_1198440029461658844_n.jpg', 'Wedding', '2024-09-23 00:56:47', '2024-09-23 00:56:47'),
(28, '1727053019-363407411_720515063423515_6689138959316250702_n.jpg', 'Wedding', '2024-09-23 00:56:59', '2024-09-23 00:56:59'),
(29, '1727053040-358363271_709105627897792_2492824984535400552_n.jpg', 'Wedding', '2024-09-23 00:57:20', '2024-09-23 00:57:20'),
(30, '1727053054-358436141_709105787897776_2627070418775903986_n.jpg', 'Wedding', '2024-09-23 00:57:34', '2024-09-23 00:57:34'),
(31, '1727053064-358055953_709105707897784_6368303035146171783_n.jpg', 'Wedding', '2024-09-23 00:57:44', '2024-09-23 00:57:44'),
(32, '1727053071-358067062_709105824564439_6559889952019422459_n.jpg', 'Wedding', '2024-09-23 00:57:51', '2024-09-23 00:57:51'),
(33, '1732436917-312799705_532576362217387_4764854529116356145_n.jpg', 'Wedding', '2024-11-24 08:28:37', '2024-11-24 08:28:37'),
(34, '1732436950-403932154_789083826566638_8432917250017208506_n.jpg', 'Birthday', '2024-11-24 08:29:10', '2024-11-24 08:29:10'),
(35, '1732436959-403903726_789072836567737_5945735276340297582_n.jpg', 'Birthday', '2024-11-24 08:29:19', '2024-11-24 08:29:19'),
(36, '1732436969-403866643_789083923233295_5888338896837523320_n.jpg', 'Birthday', '2024-11-24 08:29:29', '2024-11-24 08:29:29'),
(37, '1732436979-403805253_789083879899966_173381482083896195_n.jpg', 'Birthday', '2024-11-24 08:29:39', '2024-11-24 08:29:39'),
(38, '1732436991-378025899_747923487349339_7666268012207040636_n.jpg', 'Birthday', '2024-11-24 08:29:51', '2024-11-24 08:29:51'),
(39, '1732436999-378001405_747923657349322_8789543656089238050_n.jpg', 'Birthday', '2024-11-24 08:29:59', '2024-11-24 08:29:59'),
(40, '1732437014-378000415_747923580682663_7384863331596176574_n.jpg', 'Birthday', '2024-11-24 08:30:14', '2024-11-24 08:30:14'),
(41, '1732437022-376037168_747923987349289_8127724918751726890_n.jpg', 'Birthday', '2024-11-24 08:30:22', '2024-11-24 08:30:22'),
(42, '1732437030-375908974_747923867349301_8493155606808601403_n.jpg', 'Birthday', '2024-11-24 08:30:30', '2024-11-24 08:30:30');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `initial_stock` int(11) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `name`, `price`, `quantity`, `initial_stock`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Chafing Dish (Roll Top)', 150.00, 50, 92, 'Available', NULL, NULL),
(12, 'Choping Dish (Ordinary Round)', 100.00, 50, 92, 'Available', NULL, NULL),
(13, 'Glass', 10.00, 264, 700, 'Available', NULL, NULL),
(14, 'Spoon', 4.00, 22, 700, 'Available', NULL, NULL),
(15, 'Pork', 4.00, 832, 700, 'Available', NULL, NULL),
(16, 'Plate', 10.00, 882, 700, 'Available', NULL, NULL),
(17, 'Serving Spoon', 10.00, 748, 600, 'Available', NULL, NULL),
(18, 'Coffee Maker', 500.00, 10, 10, 'Available', NULL, NULL),
(19, 'Tables w/cloth', 100.00, 200, 100, 'Available', NULL, NULL),
(20, 'Round Chairs w/cover', 20.00, 800, 700, 'Available', NULL, NULL),
(21, 'Food Light', 150.00, 8, 8, 'Available', NULL, NULL),
(22, 'Cloth for Skirting (Per Yard)', 15.00, 500, 200, 'Available', NULL, NULL),
(23, 'Juice Dispenser', 150.00, 30, 30, 'Available', NULL, NULL),
(24, 'Cooler', 150.00, 55, 55, 'Available', NULL, NULL),
(25, 'Couch (Small)', 1500.00, 10, 10, 'Available', NULL, NULL),
(26, 'Couch (Big)', 2500.00, 10, 10, 'Available', NULL, NULL),
(27, 'Show Plate', 20.00, 882, 700, 'Available', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_reservation`
--

CREATE TABLE `inventory_reservation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'undefined',
  `estCost` decimal(6,2) DEFAULT 0.00,
  `allergic` int(11) DEFAULT 0,
  `vegetarian` int(11) DEFAULT 0,
  `vegan` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `price`, `image`, `size`, `type`, `estCost`, `allergic`, `vegetarian`, `vegan`) VALUES
(3, 'Rice', '1 cup of rice per person.', 10.00, '1708520182-Rice.jpg', '1-2', 'Etc.', 10.00, 0, 0, 0),
(4, 'Honey Glazed Chicken Wings', 'Price is per container.', 500.00, '1708518018-Honey Glazed Chicken Wings.jpg', '>5', 'Snacks', 500.00, 0, 0, 0),
(5, 'Fried Chicken', 'Price is per container.', 420.00, '1708517529-Fried Chicken.jpg', '>5', 'Snacks', 420.00, 0, 0, 0),
(6, 'Chicken Cordon Bleu', 'Price is per container.', 500.00, '1708517931-Chicken Cordon Bleu.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(7, 'Chicken Ala Orange', 'Price is per container.', 500.00, '1708518108-Chicken Ala Orange.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(8, 'Sweet and Sour Fish Fillet', 'Price is per container.', 500.00, '1708518320-Sweet and Sour Fish Fillet.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(9, 'Mixed Vegetables with Tofu', 'Price is per container.', 500.00, '1708518644-Mixed Vegetables with Tofu.jpg', '>5', 'Etc.', 500.00, 0, 1, 0),
(10, 'Pork Menudo', 'Price per container.', 500.00, '1708518604-Pork Menudo.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(11, 'Pancit Bihon', 'Per bilao/container.', 500.00, '1708518975-Pancit Bihon.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(12, 'Beef with Vegetables', 'Price is per container.', 500.00, '1708519740-Beef with Vegetables.jpg', '>5', 'Etc.', 500.00, 0, 1, 0),
(13, 'Pork Caldereta', 'Price is per container.', 500.00, '1708519876-Pork Caldereta.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(14, 'Beef Caldereta', 'Price is per container.', 500.00, '1708520397-Beef Caldereta.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(15, 'Pork Afritada', 'Price is per container.', 500.00, '1708520680-Pork Afritada.jpg', '>5', 'Etc.', 500.00, 0, 0, 0),
(16, 'Cucumber Juice', 'Price is per glass.', 50.00, '1708521058-Cucumber Juice.jpg', '1-2', 'Fruit Tea', 50.00, 0, 0, 0),
(17, 'House Blend Ice Tea', 'Price is per glass.', 50.00, '1708521251-House Blend Ice Tea.jpg', '1-2', 'Fruit Tea', 50.00, 0, 0, 0),
(18, 'Carbonara with Toast Bread', 'Serving size is plate per person.', 89.00, '1708523903-Carbonara with Toast Bread.jpg', '1-2', 'Pasta', 89.00, 0, 0, 0),
(19, 'Spaghetti with Toast Bread', 'Serving size is plate per person.', 75.00, '1708523958-Spaghetti with Toast Bread.jpg', '1-2', 'Pasta', 75.00, 0, 0, 0),
(20, 'Strawberry Milk Tea', 'Small/16 oz per serving.', 70.00, '1708524293-Strawberry Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(21, 'Matcha Milk Tea', 'Small/16 oz per serving.', 70.00, '1708524841-Matcha Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(22, 'Chocolate Milk Tea', 'Small/16 oz per serving.', 70.00, '1708525251-Lychee Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(23, 'Dark Chocolate Milk Tea', 'Small/16 oz per serving.', 70.00, '1708525343-Dark Chocolate Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(24, 'Taro Milk Tea', 'Small/16 oz per serving.', 70.00, '1708525771-Taro Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(25, 'Red Velvet', 'Small/16 oz per serving.', 70.00, '1708525704-Red Velvet.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(26, 'Mango Milk Tea', 'Small/16 oz per serving.', 70.00, '1708525952-Mango Milk Tea.jpg', '1-2', 'Milk Tea', 70.00, 0, 0, 0),
(27, 'Dasilog', 'Serving size good for 1 person.', 75.00, '1708526456-Longsilog.jpg', '1-2', 'Silog', 75.00, 0, 0, 0),
(28, 'Sisigsilog', 'Serving size good for 1 person.', 75.00, '1708527058-Sisigsilog.jpg', '1-2', 'Silog', 75.00, 0, 0, 0),
(29, 'Loaded Cheesy Fries', 'Small Serving size.', 59.00, '1708527392-Loaded Cheesy Fries.jpg', '1-2', 'Snacks', 115.00, 0, 0, 0),
(30, 'Loaded Nachos', 'Small Serving size.', 59.00, '1708527566-Loaded Nachos.jpg', '1-2', 'Snacks', 59.00, 0, 0, 0),
(31, 'Classic Burger', 'SIngle beef burger.', 79.00, '1708527923-Classic Burger.jpg', '1-2', 'Burger', 79.00, 0, 0, 0),
(32, 'Burger Overload', 'Burger beef patty with cheese and dressing.', 149.00, '1708527986-Burger Overload.jpg', '1-2', 'Burger', 149.00, 0, 0, 0),
(33, 'Cheesy Beef Burger', 'Burger beef patty with cheese.', 119.00, '1708528143-Cheesy Beef Burger.jpg', '1-2', 'Burger', 119.00, 0, 0, 0),
(34, 'French Fries', 'Small Serving of Classic French Fries with cheese/salt seasoning.', 29.00, '1708528315-French Fries.jpg', '1-2', 'Snacks', 29.00, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_ratings`
--

CREATE TABLE `menu_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_ratings`
--

INSERT INTO `menu_ratings` (`id`, `menu_id`, `user_id`, `order_id`, `rating`, `created_at`, `updated_at`) VALUES
(9, 3, 106, 84, 1, '2024-12-07 04:31:47', '2024-12-07 04:31:47'),
(10, 4, 106, 84, 3, '2024-12-07 04:31:47', '2024-12-07 04:31:47');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `receiver` bigint(20) UNSIGNED NOT NULL,
  `is_seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `user_id`, `receiver`, `is_seen`, `created_at`, `updated_at`, `file`, `file_name`) VALUES
(1, 'Rerum et quam qui labore dolore rem aliquam.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(2, 'Sint minus molestias eaque.', 8, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(3, 'Qui explicabo recusandae iusto ea.', 11, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(4, 'Blanditiis consequatur qui delectus voluptatem et modi.', 2, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(5, 'Hic ex amet minima similique ut.', 5, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(6, 'Unde nisi numquam saepe deserunt laudantium consectetur.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(7, 'Aut et enim dolore quo.', 7, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(8, 'Atque odit quas et inventore in maiores.', 13, 14, 1, '2024-04-03 06:28:47', '2024-04-03 06:30:50', NULL, NULL),
(9, 'Unde molestiae error saepe incidunt quia.', 3, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(10, 'Fugiat nostrum et non omnis animi.', 8, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(11, 'Mollitia qui voluptatem velit corrupti aspernatur quo quia.', 6, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(12, 'Non minima delectus eos ut quis ipsam.', 9, 14, 0, '2024-04-03 06:28:47', '2024-04-03 06:28:47', NULL, NULL),
(13, 'sca', 1, 14, 1, '2024-04-03 06:29:47', '2024-04-03 06:31:04', NULL, NULL),
(14, 'saswqs', 14, 1, 0, '2024-04-03 06:30:54', '2024-04-03 06:30:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_19_093623_create_menus_table', 1),
(6, '2024_04_03_999999_add_active_status_to_users', 2),
(7, '2024_04_03_999999_add_avatar_to_users', 2),
(8, '2024_04_03_999999_add_dark_mode_to_users', 2),
(9, '2024_04_03_999999_add_messenger_color_to_users', 2),
(10, '2024_04_03_999999_create_chatify_favorites_table', 2),
(11, '2024_04_03_999999_create_chatify_messages_table', 2),
(12, '2017_03_04_000000_create_bans_table', 3),
(13, '2024_05_04_095105_create_payments_table', 4),
(14, '2014_10_12_200000_add_two_factor_columns_to_users_table', 5),
(15, '2024_04_15_144152_create_ratings_table', 5),
(16, '2024_05_06_114714_create_sessions_table', 5),
(17, '2024_05_22_135053_create_notifications_table', 6),
(18, '2024_05_22_135602_create_notifications_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('00287ff1-d501-4433-abd2-2c11ef3b3752', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Arkeen Edgardo Hilaire Chaneton\",\"email\":\"jhead@huntonak.com\"}', NULL, '2024-12-06 20:36:59', '2024-12-06 20:36:59'),
('0207e86a-380b-46ba-924d-5970f82c52ce', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Leonide Floate\",\"email\":\"carolyn.profaizer@heplerbroom.com\"}', NULL, '2024-12-03 20:49:02', '2024-12-03 20:49:02'),
('03cfb052-b4d5-4c4a-88d3-1e3d447f44ef', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Amelina Stapf\",\"email\":\"zenfonemaxacc@gmail.com\"}', NULL, '2024-12-04 18:07:36', '2024-12-04 18:07:36'),
('04c7c78f-7bb0-4c4a-a3af-c5713fa7212e', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 06:00:42', '2024-11-20 06:00:42'),
('05068a45-5acf-484e-811c-3d31789e79bc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jarmel Benassati\",\"email\":\"lreid@cflaw.ca\"}', NULL, '2024-11-26 20:31:34', '2024-11-26 20:31:34'),
('088a472c-0336-4fcf-9bc3-217f6e6ac3dc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Antonella Reichwald\",\"email\":\"jssc301@gmail.com\"}', NULL, '2024-12-04 21:16:37', '2024-12-04 21:16:37'),
('0a0d9742-6904-44f0-95f5-718d057ea095', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 164, '{\"order_id\":80,\"message\":\"Your order #80 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 05:02:56', '2024-11-27 05:02:56'),
('0ab531c0-8d77-46f0-9040-adb8fa074471', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Darrion Hartvich\",\"email\":\"sam_evans43@outlook.com\"}', NULL, '2024-12-05 02:05:03', '2024-12-05 02:05:03'),
('0c634f49-45a6-43e2-833a-bc17c68ba16e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kinzee Abril\",\"email\":\"donnett.homen@cohu.com\"}', NULL, '2024-12-06 22:54:33', '2024-12-06 22:54:33'),
('0cc1ba0f-50bf-40c1-b7d3-32eda909935e', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Glass\",\"message\":\"The supplies of Glass are running low. Only 30% remains (exactly 210 units left).\"}', NULL, '2024-11-20 05:17:31', '2024-11-20 05:17:31'),
('0e398354-e25c-4012-baf0-f0b407b16da1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Capucine Mcgeouch\",\"email\":\"rjshops@me.com\"}', NULL, '2024-11-30 07:34:53', '2024-11-30 07:34:53'),
('106b954a-6647-468d-af2c-5b2da6128e7d', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tippi Glasmann\",\"email\":\"charmaine.torruella@qsc.com\"}', NULL, '2024-12-06 22:33:59', '2024-12-06 22:33:59'),
('1338515c-298e-4747-a3bd-6a0614ec3ee0', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ralana Marcarian\",\"email\":\"mrobertson@aentpc.com\"}', NULL, '2024-11-26 21:26:09', '2024-11-26 21:26:09'),
('1402714e-bd57-4a77-9afa-5e709530ef48', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Bryasha Rensch\",\"email\":\"akmendez11@gmail.com\"}', NULL, '2024-12-03 13:35:15', '2024-12-03 13:35:15'),
('14b83074-4c20-4cfe-b5e1-762df7bf06dc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Reinholdt Andreyeva\",\"email\":\"rynikka.94@gmail.com\"}', NULL, '2024-12-08 14:17:26', '2024-12-08 14:17:26'),
('15824ab6-6d08-41fe-aed3-b9fde87fd5bb', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Androw Waldman\",\"email\":\"joeypercival@aol.com\"}', NULL, '2024-12-09 00:20:59', '2024-12-09 00:20:59'),
('16e74afd-d1f9-46e6-aa67-b1133bac9783', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Joesiyah Caceda\",\"email\":\"cvaughnf@charter.net\"}', NULL, '2024-12-04 00:47:27', '2024-12-04 00:47:27'),
('16fe64bf-b6d4-4470-a8ba-fcbb86fea32a', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 06:00:40', '2024-11-20 06:00:40'),
('17c843a3-ac4b-4028-8385-b9d00fac1ed8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Adarien Charco\",\"email\":\"melhiguera@comcast.net\"}', NULL, '2024-12-05 00:46:31', '2024-12-05 00:46:31'),
('17cee8a8-9d40-4eec-8b6b-70c9bc48f334', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 24 units left).\"}', NULL, '2024-11-20 08:54:21', '2024-11-20 08:54:21'),
('1927b416-a286-4d50-aac0-fd61fc7e0252', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lyalya Kuffer\",\"email\":\"klippenfuchs@unitybox.de\"}', NULL, '2024-11-28 10:05:31', '2024-11-28 10:05:31'),
('1a1d4059-df6d-469b-ae7c-657ab9433aec', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Hoss Gindler\",\"email\":\"daryl.eggers@sjsu.edu\"}', NULL, '2024-11-28 01:29:31', '2024-11-28 01:29:31'),
('1a1fe2c6-f6b9-4614-95c5-e7c64a806aed', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Wandalid Berlioz\",\"email\":\"ruby.kuriger@gmail.com\"}', NULL, '2024-12-04 22:46:14', '2024-12-04 22:46:14'),
('1b5618d4-f403-4f24-ab9b-ac75c86971fa', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 131, '{\"order_id\":75,\"message\":\"Your order #75 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 02:00:04', '2024-11-27 02:00:04'),
('1f2e9ad4-dfcf-4210-a43d-eef43debb64a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"hNLNjpbBpvmQwf\",\"email\":\"roaskieckhfer@yahoo.com\"}', NULL, '2024-11-13 05:26:02', '2024-11-13 05:26:02'),
('21718508-4eb5-4d91-b343-a0cc721f60ab', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jaqari Prucha\",\"email\":\"sandra.kemker@t-online.de\"}', NULL, '2024-12-03 09:27:06', '2024-12-03 09:27:06'),
('23ee61b1-0013-40a3-8f28-94af4f346dd8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Toma Sightler\",\"email\":\"rjshops@me.com\"}', NULL, '2024-11-25 06:06:36', '2024-11-25 06:06:36'),
('23f9ff09-03f7-4b06-93a2-384e61dbccdb', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Genivive Tiderman\",\"email\":\"steven.lambert@blacklane.com\"}', NULL, '2024-11-26 00:14:07', '2024-11-26 00:14:07'),
('255cf448-5f72-4958-9311-ae1303276a26', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Britnye Gargone\",\"email\":\"commander1701@gmx.de\"}', NULL, '2024-11-26 16:38:28', '2024-11-26 16:38:28'),
('25b1b540-fa84-48e0-acc0-5886473c4413', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 05:59:45', '2024-11-20 05:59:45'),
('2647d965-1513-4e1c-a607-3ac61ce0cd92', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Mckoy Dinwiddy\",\"email\":\"cbrunclik@liscr.com\"}', NULL, '2024-12-06 22:02:55', '2024-12-06 22:02:55'),
('2817c831-6f6b-4c02-89a7-7f167e1792ce', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Zavon Cobbs\",\"email\":\"julia.burnham@epandcompany.com\"}', NULL, '2024-11-27 19:24:14', '2024-11-27 19:24:14'),
('29ff0da0-d8c4-4008-94d8-31573f270f94', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jadah Revertera\",\"email\":\"gsmith2611@aol.com\"}', NULL, '2024-11-24 18:05:44', '2024-11-24 18:05:44'),
('2a6a05e4-7c31-4c88-9b8c-bd8b6caebd57', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tanzania Cancro\",\"email\":\"bwhittey@aentpc.com\"}', NULL, '2024-11-28 20:44:35', '2024-11-28 20:44:35'),
('2cabd7ec-60d1-4308-814a-b08aea515d70', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kymoni Kibato\",\"email\":\"fatusha82@gmail.com\"}', NULL, '2024-11-29 10:38:36', '2024-11-29 10:38:36'),
('2d4aff89-641b-418e-98ea-8bdccec57092', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tinica Pohlmeyer\",\"email\":\"weare3grays@gmail.com\"}', NULL, '2024-12-06 23:52:22', '2024-12-06 23:52:22'),
('2d4bc668-3cdb-41a2-9da3-98aeaf3ea921', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Andris Alvarez Ferrari\",\"email\":\"frieda-fred@gmx.de\"}', NULL, '2024-12-01 00:54:46', '2024-12-01 00:54:46'),
('2dafa544-0ac7-4732-b4d9-322abdea8da7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Zalifa Citil\",\"email\":\"abergmann@horizon-next.com\"}', NULL, '2024-12-06 21:31:43', '2024-12-06 21:31:43'),
('2e8be57e-81ff-4d3c-89d9-7dc3764b2a96', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Cira Beakley\",\"email\":\"hds2@bellsouth.net\"}', NULL, '2024-11-29 01:45:08', '2024-11-29 01:45:08'),
('2e9b1c05-3104-4adc-9f5d-14afc21861c1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Sherman Garrels\",\"email\":\"htsourides@aol.com\"}', NULL, '2024-11-29 16:57:59', '2024-11-29 16:57:59'),
('31621154-6172-4efd-a2b2-f503d782cf42', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) are running low. Only 22% remains (exactly 20 units left).\"}', NULL, '2024-11-27 03:51:50', '2024-11-27 03:51:50'),
('31a0c322-739a-453b-8600-4bcae667f225', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 05:59:39', '2024-11-20 05:59:39'),
('324cdf21-787e-43e3-ba53-837986e5cade', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Marti Herbstreuth\",\"email\":\"candace.orr@sourceadvisors.com\"}', NULL, '2024-12-03 21:10:55', '2024-12-03 21:10:55'),
('325cbf4d-781f-4623-af7e-91ff06034bcd', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Shamain Vesa\",\"email\":\"johnny.paiz@csun.edu\"}', NULL, '2024-11-29 14:30:29', '2024-11-29 14:30:29'),
('3283fea7-b0d7-4124-8d3a-30aa4aaf41bd', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) is out of stock.\"}', NULL, '2024-11-20 15:41:18', '2024-11-20 15:41:18'),
('32edd0ed-689c-4587-aefb-ca31257f1665', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Rochon Sakal\",\"email\":\"jedgemond@unither.com\"}', NULL, '2024-12-04 20:39:14', '2024-12-04 20:39:14'),
('34089bb9-4239-4261-b119-13d04d426bd2', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Takara Mirabel Miquele\",\"email\":\"kalidettore@ace-it.com\"}', NULL, '2024-11-26 23:31:19', '2024-11-26 23:31:19'),
('3439a053-60f8-4d79-bc0b-a6a29bc1c406', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tysheanna Rodriguezrios\",\"email\":\"kyle@nordicmountain.com\"}', NULL, '2024-11-27 13:54:55', '2024-11-27 13:54:55'),
('34b50c44-1004-4f71-8a70-46fa617ca1ce', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 1% remains (exactly 1 units left).\"}', NULL, '2024-11-20 15:41:07', '2024-11-20 15:41:07'),
('3520cf9b-66b4-4946-8788-41cef559033b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Chaylene Straite\",\"email\":\"54dtamaru78@gmail.com\"}', NULL, '2024-12-04 10:30:49', '2024-12-04 10:30:49'),
('36cf713c-c54f-4cc7-9f77-0f5501a3700f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Klimentij Salandro\",\"email\":\"jason+test@matmon.com\"}', NULL, '2024-12-06 14:09:06', '2024-12-06 14:09:06'),
('37cef962-d4ea-44ca-9738-4c57505319c7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Courtlan Harguinteguy\",\"email\":\"ursogiuseppe78@gmail.com\"}', NULL, '2024-12-01 09:14:49', '2024-12-01 09:14:49'),
('38c4fbc2-81f3-4de5-9ec6-68a1033f5f3b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"eOGeoXVmXVOUE\",\"email\":\"acb9w10wq@yahoo.com\"}', NULL, '2024-12-07 20:36:15', '2024-12-07 20:36:15'),
('39fe1e59-3345-436f-9856-6af73be72e8c', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 06:00:38', '2024-11-20 06:00:38'),
('3c953425-7896-45a0-90de-55ab1c62c1c8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Minga Stabile De Uicich\",\"email\":\"erblbalasbub@do-not-respond.me\"}', NULL, '2024-11-29 14:17:08', '2024-11-29 14:17:08'),
('3f357cab-e19c-4474-a6f2-13113a72d1dd', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Aileena Scrivens\",\"email\":\"shawynacampbell31@yahoo.com\"}', NULL, '2024-11-25 20:24:58', '2024-11-25 20:24:58'),
('40591d27-26b1-4b91-8a61-7a3fcf3f67db', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jean-Jacques Gbandi\",\"email\":\"mckenna.curry24@yahoo.com\"}', NULL, '2024-11-27 12:18:54', '2024-11-27 12:18:54'),
('41038369-efb7-472f-9a51-ab456038643c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Alaes Bouharrat\",\"email\":\"marielle@bonaireoceanfrontvillas.com\"}', NULL, '2024-12-01 04:56:48', '2024-12-01 04:56:48'),
('4195032a-db7f-4de2-b1eb-b3aab10990f5', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Twilight Majimbo\",\"email\":\"adz_galang13@yahoo.com\"}', NULL, '2024-11-23 01:30:28', '2024-11-23 01:30:28'),
('41e8f41e-7d50-4578-9cbd-fe339d0eb790', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Khiron Koksalan\",\"email\":\"n.kock@nurfuerspam.de\"}', NULL, '2024-11-26 18:18:14', '2024-11-26 18:18:14'),
('42337e92-82d1-4584-a4ff-01645d5313a8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Atyana Debarbieri\",\"email\":\"ericakavanagh21@yahoo.com\"}', NULL, '2024-12-01 16:42:20', '2024-12-01 16:42:20'),
('44e790b8-f7f1-499f-b09b-e0b65852cae8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Meredeth Rajotte\",\"email\":\"nzgiftworld2007@gmail.com\"}', NULL, '2024-11-28 15:12:02', '2024-11-28 15:12:02'),
('45085514-c1ae-43df-a681-3e212147cba8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Luevinia Ittinuar\",\"email\":\"joerg.heyne@gmx.net\"}', NULL, '2024-11-30 12:44:47', '2024-11-30 12:44:47'),
('45fa594a-5f37-463e-8a56-ac94f83eb5cc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Armand Samber\",\"email\":\"sundtaretrundt@outlook.com\"}', NULL, '2024-12-08 18:50:08', '2024-12-08 18:50:08'),
('46b4d8a2-dfca-4cb8-a7b0-60740f16ec40', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Derrious Trimm\",\"email\":\"wfurry24@gmail.com\"}', NULL, '2024-11-23 19:13:22', '2024-11-23 19:13:22'),
('487aa209-da99-41a9-a4e4-8dc98a790ea8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"WymEfppfM\",\"email\":\"wijiofvqwxph@yahoo.com\"}', NULL, '2024-11-10 00:22:11', '2024-11-10 00:22:11'),
('495ef76e-34bb-4091-96e8-bb0ec5e58a20', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Orionna Onesko\",\"email\":\"dylan.floody@gmail.com\"}', NULL, '2024-12-03 18:49:46', '2024-12-03 18:49:46'),
('49c57a42-533b-4261-848d-aa721759475c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Yohanna Akbaytogan\",\"email\":\"melissa.boudreau@praedicat.com\"}', NULL, '2024-11-28 00:48:16', '2024-11-28 00:48:16'),
('4a4cbbe9-3d45-4aa3-86ff-e5d6baa42e7a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kayshaun Holzel\",\"email\":\"daedalonious@hotmail.com\"}', NULL, '2024-11-25 15:24:02', '2024-11-25 15:24:02'),
('4bae2894-d902-490c-817e-0d3144365fd7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Treyana Barrigas\",\"email\":\"sanchez.gsanchez59@gmail.com\"}', NULL, '2024-11-29 22:37:50', '2024-11-29 22:37:50'),
('4df87ecc-15f0-4558-bcaa-8ba6ee5add12', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Eagle Beumer\",\"email\":\"shobdy@mpdinc.com\"}', NULL, '2024-12-06 17:09:03', '2024-12-06 17:09:03'),
('509957fc-e115-4d03-9d39-e188da04a179', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Charlesia Pardias\",\"email\":\"cgibson@rakalfas.com\"}', NULL, '2024-12-08 13:12:16', '2024-12-08 13:12:16'),
('517eb128-be3f-4ea9-9ca5-72cb0d604f0e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Baylaa Tuufuli\",\"email\":\"dipema.a010591@gmail.com\"}', NULL, '2024-12-01 15:21:51', '2024-12-01 15:21:51'),
('53c01183-0bf6-49be-acd1-7c344a7e3ba6', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lulamae Schnoebelen\",\"email\":\"pzavorskas@liscr.com\"}', NULL, '2024-12-07 00:33:38', '2024-12-07 00:33:38'),
('55262b98-da82-41df-87e0-6d79a27320b3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Chalina Kuba\",\"email\":\"j.fortenberry@twru.com\"}', NULL, '2024-11-28 15:49:44', '2024-11-28 15:49:44'),
('557b6c05-eade-484e-95f8-fb8126eec6e0', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Melton Leonforti\",\"email\":\"phillipsquentin26@gmail.com\"}', NULL, '2024-11-29 06:05:16', '2024-11-29 06:05:16'),
('55b8b44d-6d84-4500-b52e-a7474a73ee70', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Shristi Floristean\",\"email\":\"reiter.diedorf@arcor.de\"}', NULL, '2024-12-08 15:37:22', '2024-12-08 15:37:22'),
('56b98c05-3551-41c8-aa3b-ade38ad272d5', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 132, '{\"order_id\":78,\"message\":\"Your order #78 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 04:42:43', '2024-11-27 04:42:43'),
('5811ffbf-4dfc-4c48-a6d4-348d78c99f84', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon is out of stock.\"}', NULL, '2024-11-03 22:17:54', '2024-11-03 22:17:54'),
('588cc3ea-a47b-4c40-bc0b-9c418de020f7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Cloteal R Aschou-Nielsen\",\"email\":\"simmonsva08@gmail.com\"}', NULL, '2024-12-05 02:41:06', '2024-12-05 02:41:06'),
('591d8ab8-00ca-45d8-bbb8-bc69009bc304', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"HaYXnJDCoKLb\",\"email\":\"cheyannvyp48@gmail.com\"}', NULL, '2024-11-25 02:38:00', '2024-11-25 02:38:00'),
('5a787470-7d10-4f70-9863-0592c03cc224', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 24 units left).\"}', NULL, '2024-11-20 08:54:23', '2024-11-20 08:54:23'),
('5bf4579d-e1bc-4271-a895-47626f623a64', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Yalixa Libran\",\"email\":\"gfreeman@aentpc.com\"}', NULL, '2024-11-27 15:36:48', '2024-11-27 15:36:48'),
('5cd77dce-f6fe-4460-bbc5-b99e33b6191a', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 12% remains (exactly 82 units left).\"}', NULL, '2024-11-20 06:00:47', '2024-11-20 06:00:47'),
('5d93d0b8-d78f-41e3-a715-403eed46f22b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Reyan Ketti\",\"email\":\"mlstuart4@gmail.com\"}', NULL, '2024-11-27 17:38:40', '2024-11-27 17:38:40'),
('5e41a66b-006f-4f5e-b1b1-2237c6f4bde7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Hussien Edmondes\",\"email\":\"kpuri@jdfactors.com\"}', NULL, '2024-11-26 00:39:45', '2024-11-26 00:39:45'),
('5e53df03-4139-4d61-9e58-ff737915a5c5', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Argel\",\"email\":\"argel.sumulong@gmail.com\"}', NULL, '2024-11-04 01:57:16', '2024-11-04 01:57:16'),
('5e62124e-22a2-4f0b-ba11-aa5fb3f8e633', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Isabelly Bennetsen\",\"email\":\"bumer2535@aol.com\"}', NULL, '2024-11-29 20:37:11', '2024-11-29 20:37:11'),
('5f08795a-6689-4753-b3c2-346194f223ee', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Flarrie Mendez Zacarias\",\"email\":\"r.molina@albawheelsup.com\"}', NULL, '2024-12-05 19:13:08', '2024-12-05 19:13:08'),
('5f4833af-0d38-4da0-9070-3712ec30b84c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Adriene Hertneky\",\"email\":\"yaro.lustenberger@pilatus-aircraft.com\"}', NULL, '2024-12-05 14:20:28', '2024-12-05 14:20:28'),
('5fd433aa-baa0-4d68-aece-ab97b33698b1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kenso Birri\",\"email\":\"psingletary@optexamerica.com\"}', NULL, '2024-12-06 23:39:44', '2024-12-06 23:39:44'),
('60cde957-664c-4f4a-8966-6ad73638c78f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Berten Esselman\",\"email\":\"swold@aentpc.com\"}', NULL, '2024-11-26 20:59:39', '2024-11-26 20:59:39'),
('61385f52-726b-4d49-b8bc-0fdcc212f1de', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kevan Codarcea\",\"email\":\"cahb8084@gmail.com\"}', NULL, '2024-12-05 17:14:37', '2024-12-05 17:14:37'),
('6177be64-aa92-4614-8f6a-07b16b66087b', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 06:16:39', '2024-11-20 06:16:39'),
('63b619ef-e956-4256-bc1a-35f4e0d4086a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Sehaj Saha\",\"email\":\"aaj716@hotmail.com\"}', NULL, '2024-12-08 01:48:15', '2024-12-08 01:48:15'),
('647a48bf-eba7-4f8c-b471-fa7c48fe53ef', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 05:59:41', '2024-11-20 05:59:41'),
('64e27d9a-129a-462c-8829-fb39b7f94e0e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Crissey Torrescano\",\"email\":\"kbordoh@gmail.com\"}', NULL, '2024-11-29 19:05:43', '2024-11-29 19:05:43'),
('66bfe652-1c80-4915-b35a-40d59baa152a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Naya Hubauer\",\"email\":\"michael.bieg@yahoo.de\"}', NULL, '2024-11-26 01:08:21', '2024-11-26 01:08:21'),
('67140493-57e1-41dd-a650-f0e4b2699b45', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) is out of stock.\"}', NULL, '2024-11-20 15:41:16', '2024-11-20 15:41:16'),
('67655f38-e243-4340-97d5-5b9f7097ad3c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Seiji Granke\",\"email\":\"williamaclark1940@gmail.com\"}', NULL, '2024-11-27 07:59:37', '2024-11-27 07:59:37'),
('67cb0383-e03a-4c31-955b-0791da506f0c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Rakiesha Kitting\",\"email\":\"trento@gmail.com\"}', NULL, '2024-11-27 00:58:42', '2024-11-27 00:58:42'),
('68510c40-b158-43fc-b96a-532528814b45', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 165, '{\"order_id\":79,\"message\":\"Your order #79 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 04:51:18', '2024-11-27 04:51:18'),
('68cca238-665b-41eb-affe-0105a37ae74a', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Table Cloth\",\"message\":\"The supplies of Table Cloth is out of stock.\"}', NULL, '2024-11-03 12:18:34', '2024-11-03 12:18:34'),
('6985f872-12a2-4f5f-91f7-78accfaddd5c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ardine Ricchini\",\"email\":\"kevharsh@gmail.com\"}', NULL, '2024-12-05 21:35:57', '2024-12-05 21:35:57'),
('6ac8abed-b8d3-40b8-8715-cf76523c7137', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Illariya Chevannes\",\"email\":\"don@pacificaquagroup.com\"}', NULL, '2024-12-06 23:16:21', '2024-12-06 23:16:21'),
('6c79ea83-92e5-4fa7-b281-8c59041499d1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Dvejra Demoya\",\"email\":\"b.jacco@hotmail.com\"}', NULL, '2024-12-04 02:43:31', '2024-12-04 02:43:31'),
('6cefd0a8-3554-451a-a5a6-2a0ae2f0ff2f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jonalyn L. Fajilan\",\"email\":\"jlfajilan@themedicalcity.com\"}', NULL, '2024-11-04 02:24:00', '2024-11-04 02:24:00'),
('6d419b90-58fd-4a24-8acc-f53d6d5f626b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"iromynXsDGQw\",\"email\":\"wevywpaykxfdht@yahoo.com\"}', NULL, '2024-11-24 05:50:21', '2024-11-24 05:50:21'),
('6df5355e-be07-46ba-ba0d-83badc9a8aa6', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"IucsNXkyQSQFV\",\"email\":\"datkinsonin462@gmail.com\"}', NULL, '2024-11-09 06:36:10', '2024-11-09 06:36:10'),
('6f4236fc-4fe5-4081-a4ea-d24cd546b0a9', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Shakarra Zamichiei\",\"email\":\"info@urbanmalelounge.com\"}', NULL, '2024-11-25 11:52:34', '2024-11-25 11:52:34'),
('6fe92fca-de64-4437-8ec3-34c80281cb37', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Calia Snoro\",\"email\":\"aude.mergey@web.de\"}', NULL, '2024-11-29 02:31:30', '2024-11-29 02:31:30'),
('744a9643-1ba3-45b4-a8a1-ef3964623d68', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Anabeatriz Stuhler\",\"email\":\"pdenton405@gmail.com\"}', NULL, '2024-12-09 10:25:47', '2024-12-09 10:25:47'),
('786651a6-1790-4621-be64-1aeb5785fda2', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jassiah Zvara\",\"email\":\"kfahrner@aentpc.com\"}', NULL, '2024-11-26 22:33:23', '2024-11-26 22:33:23'),
('7ba20db2-b4ed-4d77-9ecf-30b5999b48a1', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 140, '{\"order_id\":76,\"message\":\"Your order #76 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 02:28:48', '2024-11-27 02:28:48'),
('7e08274a-c6a3-40cb-a9ed-d62f750acf8b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Aizlee Mccuiston\",\"email\":\"jjay@aentpc.com\"}', NULL, '2024-11-28 17:05:30', '2024-11-28 17:05:30'),
('835acd63-1120-4b71-8c7e-1df5026b6c2c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Trofim Danto\",\"email\":\"ketanavani@yahoo.com\"}', NULL, '2024-12-07 05:33:37', '2024-12-07 05:33:37'),
('859a734b-79be-4d29-aabb-80832bda3772', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 130, '{\"order_id\":82,\"message\":\"Your order #82 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 05:14:04', '2024-11-27 05:14:04'),
('86b547be-a148-4cd6-9678-04b2bafc11cc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Nevan Mehlbrech\",\"email\":\"samanthablevins18@gmail.com\"}', NULL, '2024-12-05 03:13:20', '2024-12-05 03:13:20'),
('873b0d03-065c-4aee-873f-5735b85c9435', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kenne Madagan\",\"email\":\"rchernicoff@gmail.com\"}', NULL, '2024-12-05 22:27:54', '2024-12-05 22:27:54'),
('87512393-145c-42a7-be2d-7840e11730ec', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Thos Gierszewski\",\"email\":\"darryl.tamash@gmail.com\"}', NULL, '2024-12-07 19:31:59', '2024-12-07 19:31:59'),
('88aca3cc-1eaf-4bdf-b819-5369ab3cb9d4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Failya Freisinger\",\"email\":\"paulcanimm@yahoo.com\"}', NULL, '2024-11-25 01:00:45', '2024-11-25 01:00:45'),
('893f5be7-85e8-4574-a3ef-1c96f2e1f8e7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Deontaye Boguski\",\"email\":\"adfontes.schreibbuero@gmx.de\"}', NULL, '2024-11-27 00:07:08', '2024-11-27 00:07:08'),
('898fe533-a5a7-47cf-a9b2-a9b6afb389da', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ellamarie Cutno\",\"email\":\"nayah.gilchrist@yahoo.com\"}', NULL, '2024-11-29 03:15:25', '2024-11-29 03:15:25'),
('8a2996cc-2fda-4d03-8248-18b9eb53b944', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ahmoni Lilburne\",\"email\":\"pmccrorie@rsui.com\"}', NULL, '2024-12-04 23:16:57', '2024-12-04 23:16:57'),
('8a3a5fe9-bf37-4a6d-9576-adf0ce191bc3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Obrain Stangner\",\"email\":\"gabster_721@hotmail.com\"}', NULL, '2024-12-06 19:00:47', '2024-12-06 19:00:47'),
('8a954600-d9cc-4dca-8445-0242f6c1625d', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Mccray Inkley\",\"email\":\"holly.lund@wisconsin.gov\"}', NULL, '2024-11-27 20:32:49', '2024-11-27 20:32:49'),
('8bb0ec81-fd10-4df9-8c3a-58bcbafdf1a7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Narvin Akgol\",\"email\":\"gregory.sorreaux@thales.be\"}', NULL, '2024-12-07 11:29:19', '2024-12-07 11:29:19'),
('8c90317c-0a90-4623-8f46-8e0af5b32590', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Corderious Bestilleiro\",\"email\":\"malcolm-douglas@gmx.de\"}', NULL, '2024-11-26 02:21:15', '2024-11-26 02:21:15'),
('8cb87fa4-9fe8-4241-ab05-2ca04fe0d5a3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Isobell Piquette\",\"email\":\"sabrina.kienreich@gmail.com\"}', NULL, '2024-12-07 21:48:06', '2024-12-07 21:48:06'),
('8d646eb7-23bb-4078-8fbe-501254f93aec', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Stann Cortezgarcia\",\"email\":\"233@nsv.com\"}', NULL, '2024-11-27 17:19:54', '2024-11-27 17:19:54'),
('8d7eb27a-1b4d-46d0-ad3c-d935172a23fb', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Marlando Gallatin\",\"email\":\"michael.kirlew.jr@gmail.com\"}', NULL, '2024-12-02 23:12:16', '2024-12-02 23:12:16'),
('8dfc474a-fe10-48a9-8b6f-d41c41ba79c0', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kaniylah Hryhoryeva\",\"email\":\"hemaidi.z@gmail.com\"}', NULL, '2024-11-28 08:26:03', '2024-11-28 08:26:03'),
('8e209625-2d58-456b-b82a-8828f22e6fc3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jauan Stensli\",\"email\":\"elisejureidini@hamlinandburton.com\"}', NULL, '2024-11-25 19:56:02', '2024-11-25 19:56:02'),
('8f293884-3c87-4de8-8e31-dc40c973cb7e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Doranne Niedernolte\",\"email\":\"cra@lynxequity.com\"}', NULL, '2024-11-26 23:47:36', '2024-11-26 23:47:36'),
('8f719865-756e-4112-881e-6b3b0390199e', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 193, '{\"order_id\":74,\"message\":\"Your order #74 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 01:47:44', '2024-11-27 01:47:44'),
('910d2a57-efdd-481e-89ce-8c8bd4fac42e', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Fork\",\"message\":\"The supplies of Fork is out of stock.\"}', NULL, '2024-11-03 22:18:02', '2024-11-03 22:18:02'),
('95da83b8-ccdd-4e33-8fe0-1c823c208021', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Emigdio Lochman\",\"email\":\"dwright@concordcoachlines.com\"}', NULL, '2024-11-26 19:46:45', '2024-11-26 19:46:45'),
('96c70d3d-fad9-499b-b911-c6999742fc0a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ikaia Radloff\",\"email\":\"kg2country@aol.com\"}', NULL, '2024-12-06 00:15:14', '2024-12-06 00:15:14'),
('99b0330a-8ec0-4cbf-80c5-87a0a9dab89a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Alaiya Redhorn\",\"email\":\"amandanoellenugent@gmail.com\"}', NULL, '2024-11-30 09:09:01', '2024-11-30 09:09:01'),
('9a481a27-198b-4c58-a4fa-fe25be020c5a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jasmane Juarez Data\",\"email\":\"janetgizziopeterkin@ace-it.com\"}', NULL, '2024-11-27 18:22:37', '2024-11-27 18:22:37'),
('9bf791a9-e71f-4cf3-9a03-02d857f0bbd4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Gevond Menchi\",\"email\":\"alloymisty22@gmail.com\"}', NULL, '2024-11-27 09:19:56', '2024-11-27 09:19:56'),
('9c1dff81-989a-4fba-ad0f-fe94fc3411c5', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Savir Desabysses\",\"email\":\"wbasker@gmail.com\"}', NULL, '2024-11-30 02:52:24', '2024-11-30 02:52:24'),
('a071efcc-dc3c-486e-8eb7-d80cd2731309', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Olli Hausladen\",\"email\":\"alytravers@ace-it.com\"}', NULL, '2024-11-26 18:57:46', '2024-11-26 18:57:46'),
('a17c607d-d978-429c-a8fd-73ac87283a3b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lashanay Barrientos Oliva\",\"email\":\"niurkarodriguez31@yahoo.com\"}', NULL, '2024-12-05 03:48:13', '2024-12-05 03:48:13'),
('a1a1ac5f-e617-4248-9ac0-39b73b13140d', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 24 units left).\"}', NULL, '2024-11-20 06:03:11', '2024-11-20 06:03:11'),
('a1a5f47a-f3cf-414b-b458-59c4bd66fc45', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Charese Estrada Vitantonio\",\"email\":\"info@charter.ch\"}', NULL, '2024-12-07 07:53:22', '2024-12-07 07:53:22'),
('a726f433-464e-4300-946a-94a5a233da80', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Adelynn Vazquez Fuentes\",\"email\":\"bamiller966@gmail.com\"}', NULL, '2024-11-27 23:35:21', '2024-11-27 23:35:21'),
('a846101a-6d14-4f31-8ac0-477caefc72dd', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 134, '{\"order_id\":77,\"message\":\"Your order #77 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 02:45:39', '2024-11-27 02:45:39'),
('a8a16737-22e2-4e4b-9293-be391139622d', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Saivon Treston\",\"email\":\"info@hotelvillagiovanna.com\"}', NULL, '2024-12-09 01:14:18', '2024-12-09 01:14:18'),
('aa33c768-8893-4214-8165-bf9e96841251', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lesheena Fortna\",\"email\":\"khaunton@alvarezandmarsal.com\"}', NULL, '2024-12-04 22:03:39', '2024-12-04 22:03:39'),
('aa8d6a17-3898-4388-8d54-4b24f12ae071', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 05:59:43', '2024-11-20 05:59:43'),
('aad9be78-095b-4082-b6c4-097dc47fae73', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Fremon Wlach\",\"email\":\"kendall.maltby@gmail.com\"}', NULL, '2024-12-02 10:30:35', '2024-12-02 10:30:35'),
('abdc2830-f5e7-43a7-ac3b-41c6600420bf', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Laurianne Pagnola\",\"email\":\"anechamlin@att.net\"}', NULL, '2024-11-24 03:29:20', '2024-11-24 03:29:20'),
('adaffaea-37fe-4d2d-ab03-a3da6c6a8edd', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 08:54:19', '2024-11-20 08:54:19'),
('ae41f582-ac7f-42df-bd6f-01fac9fa3b27', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) are running low. Only 22% remains (exactly 20 units left).\"}', NULL, '2024-11-27 03:51:53', '2024-11-27 03:51:53'),
('aec8731a-5e7f-461e-aa17-dd6af2464cdf', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Taquisa Boursaw\",\"email\":\"v.bejines@grupotyp.com.mx\"}', NULL, '2024-11-25 04:37:14', '2024-11-25 04:37:14'),
('af8d1b32-fdfd-4f00-a257-f41ee7da7774', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Leahnna Martinez Velasquez\",\"email\":\"vacances@solvoyages.ch\"}', NULL, '2024-12-07 12:53:58', '2024-12-07 12:53:58'),
('b1848fdc-dcc6-430e-995f-dd375016dd81', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Zeik Bielewicz\",\"email\":\"ksmilie@alvarezandmarsal.com\"}', NULL, '2024-12-04 22:17:29', '2024-12-04 22:17:29'),
('b18b6ccf-ef2d-4819-a14d-0b040c38c41c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Budd Akahoshi\",\"email\":\"lcole@gandhtowing.com\"}', NULL, '2024-12-05 20:57:37', '2024-12-05 20:57:37'),
('b40f5113-dab1-46dc-be4d-80f92d59224f', 'App\\Notifications\\OrderCompletedNotification', 'App\\Models\\User', 162, '{\"order_id\":81,\"message\":\"Your order #81 has been completed.\",\"order_status\":\"completed\"}', NULL, '2024-11-27 05:06:58', '2024-11-27 05:06:58'),
('b59b94af-566f-4bec-a2bc-ae242dd80199', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Feliscia Tulis\",\"email\":\"lmarti1961@gmail.com\"}', NULL, '2024-11-28 18:16:08', '2024-11-28 18:16:08'),
('b63f0c36-69d2-457e-8f56-a3f3b44360b3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Daneen Corijn\",\"email\":\"absolutgia@gmail.com\"}', NULL, '2024-11-25 19:07:21', '2024-11-25 19:07:21'),
('b6a96915-bf09-47d4-b9d0-357bee40e7ba', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Collen Wiedemeyer\",\"email\":\"jrossine@testanlaw.com\"}', NULL, '2024-11-25 23:12:05', '2024-11-25 23:12:05'),
('b6f4222d-ad8d-409a-95f5-a0a33d157adb', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lank Haliuc\",\"email\":\"fteutle@gmail.com\"}', NULL, '2024-11-27 02:43:11', '2024-11-27 02:43:11'),
('b77c43d0-21f3-434f-8535-b1aa5d0d9c39', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Khye Earth\",\"email\":\"vlacroix@blackdiamondnet.com\"}', NULL, '2024-12-06 19:15:52', '2024-12-06 19:15:52'),
('b9398833-111b-482d-b614-dcd0ff105e87', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kasin Tondini\",\"email\":\"info@seymoursolar.com\"}', NULL, '2024-11-27 19:03:28', '2024-11-27 19:03:28'),
('bb790d8c-3a28-4304-8393-e64fa16b7f84', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Johnnice Kreusch\",\"email\":\"marketing@euroeyes.de\"}', NULL, '2024-12-06 01:10:17', '2024-12-06 01:10:17'),
('bb927b36-6fc7-4b8b-8c77-d0685f5c2874', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jayleah Calderone\",\"email\":\"nashreen.karim@tottengroup.com\"}', NULL, '2024-11-26 21:12:04', '2024-11-26 21:12:04'),
('bc2acfa9-5f2d-4b54-913d-e4128bd0748c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Raseel Orejas\",\"email\":\"afalke@jamaicabearings.com\"}', NULL, '2024-12-05 17:54:10', '2024-12-05 17:54:10'),
('bc36fb40-b6b8-4a39-9fbc-992450209d28', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Deguan Korba\",\"email\":\"achoinski@huntonak.com\"}', NULL, '2024-12-06 21:11:02', '2024-12-06 21:11:02'),
('bce1aa66-a71d-488d-90b2-d2e87960018e', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 08:54:16', '2024-11-20 08:54:16'),
('bd09ebff-e040-415f-8f8e-1293c00e1211', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tityanna Sichem\",\"email\":\"cbeck001@outlook.com\"}', NULL, '2024-11-28 14:06:48', '2024-11-28 14:06:48'),
('bfb3fb3c-ac2c-49f7-b866-922d4cb77926', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Denette Versluis\",\"email\":\"corinnebetsch@sbcglobal.net\"}', NULL, '2024-11-26 07:32:49', '2024-11-26 07:32:49'),
('c158399f-c057-465b-8a5f-d945cddc1398', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Nicy Altinier\",\"email\":\"llynch@bellusacademy.edu\"}', NULL, '2024-11-26 08:34:54', '2024-11-26 08:34:54'),
('c189f37a-2429-4ec6-b6a7-3ab1a20c39f8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lurie Fedderly\",\"email\":\"amcknight@aentpc.com\"}', NULL, '2024-11-28 18:37:41', '2024-11-28 18:37:41'),
('c209a7ed-396a-4683-b893-e070796218a1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Marzie Mirowski\",\"email\":\"serro9@gmail.com\"}', NULL, '2024-11-24 17:03:51', '2024-11-24 17:03:51'),
('c23868b9-e2fb-4fba-80c0-d8d3f047e070', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Maria Charise Ebora\",\"email\":\"elizabethpajelago983@gmail.com\"}', NULL, '2024-11-27 01:32:07', '2024-11-27 01:32:07'),
('c5b4ffd4-8e28-4312-8768-7897ef177560', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Pearleen Nuck\",\"email\":\"nenuck@gmail.com\"}', NULL, '2024-11-26 15:27:30', '2024-11-26 15:27:30'),
('c65468e7-9624-4e1a-a714-bf0d2f94a2ae', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Sylester Chaikovskyi\",\"email\":\"devin.larmeu@schupan.com\"}', NULL, '2024-12-05 16:50:41', '2024-12-05 16:50:41'),
('c6b919f4-12e7-4486-a53f-19b3d4322f6e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"pLdxIYaPwO\",\"email\":\"alfordhvo1987@gmail.com\"}', NULL, '2024-11-28 18:47:29', '2024-11-28 18:47:29'),
('c6c5c5b6-00dc-4367-932d-07426d3c4519', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Sasha Schweitz\",\"email\":\"mrobertson@aentpc.com\"}', NULL, '2024-11-28 20:01:42', '2024-11-28 20:01:42'),
('c7ea939b-5077-45c4-904a-92e7d673114e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Titianna Treusdell\",\"email\":\"b_crews@bellsouth.net\"}', NULL, '2024-12-05 00:27:40', '2024-12-05 00:27:40'),
('c9ba81b9-b4fb-4614-bcef-6b7dce321990', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Gequan Yostar\",\"email\":\"tracysch999@hotmail.com\"}', NULL, '2024-11-28 05:12:36', '2024-11-28 05:12:36'),
('ca9cdb31-4132-43d1-9007-c0ccd8b59da8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Praskoviya Kintzer\",\"email\":\"rodyortez@yahoo.com\"}', NULL, '2024-12-05 01:32:00', '2024-12-05 01:32:00'),
('cab8f5e1-dbf3-4c9e-a5b4-80ae15c07ced', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Yamine Lorance\",\"email\":\"johnsbadwheel@gmail.com\"}', NULL, '2024-12-07 03:56:27', '2024-12-07 03:56:27'),
('cbcb2516-03b9-458b-9c1e-cd132b1fa20c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jahkhi Milkins\",\"email\":\"michael.elefante@hometeamvr.com\"}', NULL, '2024-12-05 16:14:39', '2024-12-05 16:14:39'),
('ce92b845-0fd2-429e-a2f1-62b18f48d8a6', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Amberia Adjou\",\"email\":\"f.schmidt99@gmx.net\"}', NULL, '2024-11-29 21:41:41', '2024-11-29 21:41:41'),
('cf356dee-38e6-4b67-bfc8-5fd2fe397f51', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Laylannie Stollar\",\"email\":\"ajecks@comcast.net\"}', NULL, '2024-12-02 02:29:56', '2024-12-02 02:29:56'),
('cf487f34-59ad-44ea-a53d-d64dec8f6ce4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Tiaona Noval\",\"email\":\"ompush2020@gmail.com\"}', NULL, '2024-11-23 07:14:43', '2024-11-23 07:14:43'),
('cfdce1e2-6dd6-46e7-8428-11da68b3f3dd', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Pamelia Donnellon\",\"email\":\"a96wong@gmail.com\"}', NULL, '2024-11-28 20:22:31', '2024-11-28 20:22:31'),
('d137de37-c407-43a7-bc64-fb58d3c0cd1f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Amissa Hatmaker\",\"email\":\"jvforward@gmail.com\"}', NULL, '2024-11-23 04:00:45', '2024-11-23 04:00:45'),
('d1a11176-c700-4ec2-a7cb-d4fd3e878ee1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Aalayiah Hausknecht\",\"email\":\"courtney.simmons@powerdistributors.com\"}', NULL, '2024-12-06 19:00:50', '2024-12-06 19:00:50'),
('d2da0146-b13d-481b-859d-a619468a2d03', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Vardell Yuska\",\"email\":\"jromo@tellworks.com\"}', NULL, '2024-12-06 20:11:54', '2024-12-06 20:11:54'),
('d32759b0-c409-47fb-a610-0c9d3d8f0739', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Arieus Ampuja\",\"email\":\"gcwhitford@cox.net\"}', NULL, '2024-11-27 03:31:05', '2024-11-27 03:31:05'),
('d4ec4f3c-d48c-4a77-84b1-bef8eb80466c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ailish Poehling\",\"email\":\"customerservice@blinkmarketing.com\"}', NULL, '2024-11-26 04:44:57', '2024-11-26 04:44:57'),
('d60bc6a0-626a-4687-ba0d-ae2346886f14', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Zaryha Juncal\",\"email\":\"soldman88@gmail.com\"}', NULL, '2024-12-02 15:13:34', '2024-12-02 15:13:34'),
('d7bb709a-a6b2-41b0-bdbe-b16844f3aef8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Rodger Santos Janap\",\"email\":\"cardo@gmail.com\"}', NULL, '2024-11-04 01:10:49', '2024-11-04 01:10:49'),
('d827e2d0-7706-492a-832e-77ee1cbd0ec0', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Queshon Gabrijelcic\",\"email\":\"konanjacob363@gmail.com\"}', NULL, '2024-12-01 12:52:38', '2024-12-01 12:52:38'),
('d8309875-a189-4c53-9e3d-dbffa104bb4b', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 12% remains (exactly 82 units left).\"}', NULL, '2024-11-20 06:00:49', '2024-11-20 06:00:49'),
('d934e0cd-7618-44aa-93ca-2dba441a3da1', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 23 units left).\"}', NULL, '2024-11-20 15:41:11', '2024-11-20 15:41:11'),
('dd00e762-f381-442a-979e-b5cfc4c4b074', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Philip Giauque\",\"email\":\"asminda1979@yahoo.com\"}', NULL, '2024-11-23 14:08:03', '2024-11-23 14:08:03'),
('dfc53482-96d4-47f0-a594-8696ba25a51d', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jannean Ataz\",\"email\":\"jlynnemobile88@gmail.com\"}', NULL, '2024-11-28 00:12:25', '2024-11-28 00:12:25'),
('dfe79e0a-45a3-4333-8d28-d79d6c161197', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Akeyra Lustemberg\",\"email\":\"katie.capka@spiceology.com\"}', NULL, '2024-11-25 03:31:46', '2024-11-25 03:31:46'),
('e1269c8c-9081-4612-99e2-6c26a242e58f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jesica Schlenk\",\"email\":\"karen.kelsch@pentegra.com\"}', NULL, '2024-11-26 17:54:36', '2024-11-26 17:54:36'),
('e13ce53b-24f0-410c-843d-a1af92b2c99c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Justinrobert Carubini\",\"email\":\"k.gleeson@twru.com\"}', NULL, '2024-11-28 19:20:52', '2024-11-28 19:20:52'),
('e25321de-9df9-4f4b-8cc8-94420d38a16e', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 22 units left).\"}', NULL, '2024-11-20 15:41:23', '2024-11-20 15:41:23'),
('e32fc14f-5882-434c-8016-6aef3d88a6b8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Asan Bonecutter\",\"email\":\"thorstenspringorum@arcor.de\"}', NULL, '2024-12-05 17:14:35', '2024-12-05 17:14:35');
INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('e433fae6-2a4b-4470-830f-4503b2aa04b7', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Theoren Gubitz\",\"email\":\"lomas-5@comcast.net\"}', NULL, '2024-12-03 19:44:04', '2024-12-03 19:44:04'),
('e44aaa6e-a7fb-4e07-8bd6-d5ca8fe0dc33', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Latroya Norbury\",\"email\":\"erinkbusch@yahoo.com\"}', NULL, '2024-12-03 05:54:35', '2024-12-03 05:54:35'),
('e45c0e83-18cf-415a-bf73-dd28414556ca', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ellanora Rafferty\",\"email\":\"veronica@twru.com\"}', NULL, '2024-11-28 21:30:08', '2024-11-28 21:30:08'),
('e4b8d487-e416-4e7d-be89-19a7fd948e1f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Vikash S Ady\",\"email\":\"tarleto1984@gmail.com\"}', NULL, '2024-11-26 13:41:16', '2024-11-26 13:41:16'),
('e51bfc62-b9cd-4dcd-97e1-9dfe13917069', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ziarra Weiter\",\"email\":\"sergiomalandrino43@gmail.com\"}', NULL, '2024-11-27 14:32:27', '2024-11-27 14:32:27'),
('e526b8ec-ed7b-4546-b064-4f7c85f22bf9', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Amylyn Maraver\",\"email\":\"jake@nestcommerce.co\"}', NULL, '2024-11-23 02:45:55', '2024-11-23 02:45:55'),
('e5aa8022-651a-4a20-902e-b034c546e8a0', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Chartez Raman\",\"email\":\"tengluo88@gmail.com\"}', NULL, '2024-12-06 19:31:19', '2024-12-06 19:31:19'),
('e5ed71cd-fdbf-40b0-b4b8-ad3bb77c07f4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lunna Monnich\",\"email\":\"crazyb1324@gmail.com\"}', NULL, '2024-11-27 22:26:17', '2024-11-27 22:26:17'),
('e7ba4513-895d-4bde-8a2b-bea7063fda12', 'App\\Notifications\\OutOfStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) is out of stock.\"}', NULL, '2024-11-20 06:16:41', '2024-11-20 06:16:41'),
('e7d026f1-0e2d-4429-afd6-8892bcd56754', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ardelia Brenken\",\"email\":\"info@truefittandhill.com.my\"}', NULL, '2024-11-22 22:16:47', '2024-11-22 22:16:47'),
('e7de7de4-cc63-4788-9244-cb988a2ac3f5', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Rodrianna Lagrow\",\"email\":\"robbroot3@gmail.com\"}', NULL, '2024-11-26 05:35:39', '2024-11-26 05:35:39'),
('e7fd2f09-b877-43b8-b1bc-4b8ba99360df', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Johnessa Vannieuwenhoven\",\"email\":\"parts.pick@rutherfordautobody.com\"}', NULL, '2024-11-23 05:30:23', '2024-11-23 05:30:23'),
('eb83dbe8-04b3-45cf-9ef7-f8ad97abf9b4', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Johnathyn Alidou\",\"email\":\"sarahwilliamsfuller@gmail.com\"}', NULL, '2024-12-08 22:11:16', '2024-12-08 22:11:16'),
('ebe00a99-c78c-420c-9ef9-9918edede5d8', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Lauria Kerlakian\",\"email\":\"f.schmidt99@gmx.net\"}', NULL, '2024-11-25 23:29:24', '2024-11-25 23:29:24'),
('ec025528-a4d8-4c8e-908d-cbd72f8d547b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Bnai Szenkman\",\"email\":\"gdetoma@jamaicabearings.com\"}', NULL, '2024-12-05 18:53:08', '2024-12-05 18:53:08'),
('f03ef316-38d5-4837-a43c-c70ed066f4ca', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Adonias Wike\",\"email\":\"ebgc@aol.com\"}', NULL, '2024-12-03 08:06:48', '2024-12-03 08:06:48'),
('f0fff7f2-b926-41e6-9442-a91187e964ee', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Chafing Dish (Roll Top)\",\"message\":\"The supplies of Chafing Dish (Roll Top) are running low. Only 19% remains (exactly 5 units left).\"}', NULL, '2024-11-20 05:13:00', '2024-11-20 05:13:00'),
('f1da6d16-84ad-4dad-84b8-a38af0ccaa6b', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Eleasah Derisse\",\"email\":\"pam0405@comcast.net\"}', NULL, '2024-11-22 18:22:40', '2024-11-22 18:22:40'),
('f25ad221-49db-4a27-bce3-24372ace1d36', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Saitgali Lalicata\",\"email\":\"shavongilroy@gmail.com\"}', NULL, '2024-11-29 22:08:57', '2024-11-29 22:08:57'),
('f271b5a9-2bcc-4082-a78d-88e7c60818ef', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 1% remains (exactly 1 units left).\"}', NULL, '2024-11-20 15:41:09', '2024-11-20 15:41:09'),
('f2ac7e0c-d48e-46d1-98d5-d63865b9243c', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Ambir Guess\",\"email\":\"jalysajc23@gmail.com\"}', NULL, '2024-12-04 16:14:22', '2024-12-04 16:14:22'),
('f2b9cec5-d82a-4632-b865-c94b67557cfd', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Nisreen Schrepel\",\"email\":\"joerossi@cox.net\"}', NULL, '2024-12-07 23:46:25', '2024-12-07 23:46:25'),
('f4061ca8-69a3-45c6-8e61-9eb09df496fc', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Kazaria Dall\'Ora\",\"email\":\"misterbigbaby@gmail.com\"}', NULL, '2024-11-24 02:23:20', '2024-11-24 02:23:20'),
('f51c9ab6-5c67-4a9b-932a-c58e9a5c3386', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 1, '{\"name\":\"Spoon\",\"message\":\"The supplies of Spoon are running low. Only 3% remains (exactly 22 units left).\"}', NULL, '2024-11-20 15:41:21', '2024-11-20 15:41:21'),
('f5329fe5-1c15-419d-bb0d-9cb8c1eeef29', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Eiad Gauna Donalisio\",\"email\":\"krisjoy66@comcast.net\"}', NULL, '2024-12-02 20:42:42', '2024-12-02 20:42:42'),
('f7f18c30-9a1a-4bed-9161-f397d795b4c3', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Phoenicia Parviainen\",\"email\":\"owen.c.davis@odfw.oregon.gov\"}', NULL, '2024-11-27 16:23:55', '2024-11-27 16:23:55'),
('f80fadef-93e7-4355-a89d-d6ee22bdc60f', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jacqeline Putze\",\"email\":\"ezalzijazeub@dont-reply.me\"}', NULL, '2024-11-22 17:36:01', '2024-11-22 17:36:01'),
('f810f35b-4050-4419-b5af-83043479aee9', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Raela Petrascu\",\"email\":\"stephenmaire@yahoo.com\"}', NULL, '2024-11-25 22:57:59', '2024-11-25 22:57:59'),
('fb1d71e8-a2f9-4c6e-af7a-5d41463a07f1', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Betteann Aejmelaeus\",\"email\":\"klock@aentpc.com\"}', NULL, '2024-11-28 16:40:25', '2024-11-28 16:40:25'),
('fbf3d46a-f571-4854-9c71-2d2a0e721c7e', 'App\\Notifications\\LowStockNotification', 'App\\Models\\User', 2, '{\"name\":\"Choping Dish (Ordinary Round)\",\"message\":\"The supplies of Choping Dish (Ordinary Round) are running low. Only 2% remains (exactly 2 units left).\"}', NULL, '2024-11-20 06:00:44', '2024-11-20 06:00:44'),
('fcb13c5c-182d-49ec-9ef6-b3acdadc561e', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Altouise Aibeo\",\"email\":\"olgad@wideband.net.au\"}', NULL, '2024-11-30 00:51:18', '2024-11-30 00:51:18'),
('fff24e0c-699b-4ad5-8683-bca555dd9c7a', 'App\\Notifications\\NewUserNotification', 'App\\Models\\User', 1, '{\"name\":\"Jeremai Norvel\",\"email\":\"piahormisch@yahoo.de\"}', NULL, '2024-11-26 16:04:30', '2024-11-26 16:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `dateTime` timestamp NULL DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `created_at`, `updated_at`, `dateTime`, `completed`, `type`) VALUES
(61, 123, '2024-10-02 11:47:00', '2024-10-02 11:49:00', '2024-10-02 11:44:00', 1, 'Dine-In'),
(62, 122, '2024-10-11 14:58:00', '2024-10-11 14:59:00', '2024-10-11 14:57:00', 1, 'Take-Out'),
(74, 193, '2024-09-29 00:46:00', '2024-09-29 00:47:00', '2024-09-29 00:41:00', 1, 'Dine-In'),
(75, 131, '2024-10-30 11:33:00', '2024-10-30 11:35:00', '2024-10-30 11:30:00', 1, 'Take-Out'),
(76, 140, '2024-11-04 12:25:47', '2024-11-04 12:27:47', '2024-11-04 12:24:47', 1, 'Take-Out'),
(77, 134, '2024-11-04 12:48:47', '2024-11-04 12:49:47', '2024-11-04 12:48:47', 1, 'Take-Out'),
(78, 132, '2024-11-07 16:05:00', '2024-11-07 16:06:00', '2024-11-07 16:03:00', 1, 'Take-Out'),
(79, 165, '2024-11-15 09:37:24', '2024-11-15 09:38:24', '2024-11-15 09:37:24', 1, 'Take-Out'),
(80, 164, '2024-11-19 11:13:24', '2024-11-19 11:14:24', '2024-11-19 11:13:24', 1, 'Dine-In'),
(81, 162, '2024-11-19 13:08:24', '2024-11-19 13:09:24', '2024-11-19 13:09:24', 1, 'Dine-In'),
(82, 130, '2024-11-19 13:45:24', '2024-11-19 13:46:24', '2024-11-19 13:45:24', 1, 'Take-Out'),
(84, 106, '2024-12-07 04:19:13', '2024-12-07 04:19:13', '2024-12-07 12:17:00', 0, 'Dine-In');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guest_number` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Available',
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `user_id`, `name`, `description`, `image`, `guest_number`, `status`, `price`, `created_at`, `updated_at`) VALUES
(28, NULL, 'Menu A', 'This Package includes Chicken Wings (Spicy/Honey Glazed), Mixed Vegetables with Tofu, Pork Menudo, Beef Caldereta, Creamy Gelatin, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', '1726917505-uL1c4GkpeQ9OCdvh7k8KtSx0WzMOiw36vDfcyPmU.jpg', 100, 'Available', 3599, '2024-02-20 21:33:40', '2024-09-21 11:18:25'),
(29, NULL, 'Menu B', 'This Package includes Fried Chicken, Pork Afritada, Fish Fillet (Sweet and Sour), Beef w/ vegetables, Leche Flan, House Blended Ice Tea, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', '1726917495-Ass6Dm9YnNdyBCbgTUxnQkGPOwzjVUOFqNHyqHxb.jpg', 100, 'Available', 1500, '2024-02-20 21:42:25', '2024-09-21 11:18:15'),
(30, NULL, 'Menu C', 'This Package includes Chicken Ala Orange, Pork Caldereta, Brasied Beef w/ Coffee Beans, Chopseuy, Buko Pandan, Soda, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', '1726917478-3Yqs5WVZdyWbLTjfnvxzYZ6Sx2mLAWwEGJVlw6XO.jpg', 100, 'Available', 1399, '2024-02-20 21:44:31', '2024-09-21 11:17:58'),
(31, NULL, 'Menu D', 'This Package includes Chicken Cordon Bleu, Pork Asado, Beef w/ Broccoli, Lumpiang Hubad, Mango Tapioca, Cucumber Juice, Rice and an inclusion of either Pancit Bihon/Spaghetti/Sotanghon.', '1726917429-E9Hp5m8J37DIxGOM2Ycgaq4FkbzA7qBcBTL5twMB.jpg', 100, 'Available', 1299, '2024-02-21 05:54:17', '2024-09-21 11:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('customer@gmail.com', '$2y$10$jCrl9UOxCDaD0E7LP4mMhODQfjagMS3AqN3iJmD6qpKPYumNkLb76', '2024-02-11 16:49:04'),
('gigcafe026@gmail.com', '$2y$10$p7pNx49eTcCmt2ohWMC3V.zAYLmKzhA6nYDJeoyeEL/9/YD9QoHsG', '2024-09-06 05:07:56'),
('squadquinx8@gmail.com', '$2y$10$BkuwT0Eqs5Yhd5caoEx4FOZg7LKh6LV4ZwUV8EPYU9B0jBR9IpK8a', '2024-09-06 05:10:33');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) NOT NULL,
  `service_rating` double NOT NULL,
  `package_rating` double DEFAULT NULL,
  `service_id` bigint(20) NOT NULL,
  `package_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `reserv_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `rated` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `service_rating`, `package_rating`, `service_id`, `package_id`, `user_id`, `reserv_id`, `comment`, `rated`, `created_at`, `updated_at`) VALUES
(62, 5, NULL, 29, NULL, 124, 185, NULL, 1, '2024-11-27 16:43:10', '2024-11-27 16:43:10'),
(63, 5, NULL, 29, NULL, 122, 184, NULL, 1, '2024-11-27 16:43:58', '2024-11-27 16:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `tel_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `venue_address` varchar(255) NOT NULL,
  `service_id` bigint(20) NOT NULL DEFAULT 1,
  `cateringoption_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `package_id` bigint(20) DEFAULT NULL,
  `inventory_supplies` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Not Paid',
  `payment_selection` varchar(255) DEFAULT NULL,
  `receipt_image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`receipt_image`)),
  `res_date` datetime NOT NULL,
  `guest_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'customer',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `supply_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`supply_details`)),
  `supply_total` decimal(10,2) DEFAULT NULL,
  `theme_type` varchar(50) DEFAULT NULL,
  `main_color` varchar(50) DEFAULT NULL,
  `sub_color` varchar(50) DEFAULT NULL,
  `custom_main_color` varchar(50) DEFAULT NULL,
  `custom_sub_color` varchar(50) DEFAULT NULL,
  `theme_comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `first_name`, `last_name`, `email`, `tel_number`, `venue_address`, `service_id`, `cateringoption_id`, `package_id`, `inventory_supplies`, `status`, `payment_status`, `payment_selection`, `receipt_image`, `res_date`, `guest_number`, `created_at`, `updated_at`, `user_id`, `role`, `deleted_at`, `supply_details`, `supply_total`, `theme_type`, `main_color`, `sub_color`, `custom_main_color`, `custom_sub_color`, `theme_comments`) VALUES
(183, 'Allen', 'Oliva', 'olivaallen128@gmail.com', '9951006868', 'Tawiran, Calapan City - Gaisano Capital Place', 29, 36, NULL, '', 'Fulfilled', 'Down Payment', NULL, '[]', '2024-08-17 10:00:00', 113, '2024-08-02 09:27:13', '2024-08-17 10:00:00', 123, 'customer', NULL, NULL, NULL, 'royal', '#4169E1', '#DC143C', NULL, NULL, NULL),
(184, 'Siola', 'Dapito', 'sioladapito@gmail.com', '9932526443', 'Calero, Calapan City - Tree of Life Hotel', 29, 35, NULL, '', 'Fulfilled', 'Full Payment', NULL, '[]', '2024-10-06 18:00:00', 150, '2024-09-25 13:49:11', '2024-10-06 18:00:00', 122, 'customer', NULL, NULL, NULL, 'floral', '#FF007F', '#98FF98', NULL, NULL, NULL),
(185, 'Aileen', 'Macalalad', 'macalaladaileen5@gmail.com', '9563773554', 'Masipit, Calapan City', 29, 35, NULL, '', 'Fulfilled', 'Down Payment', NULL, '[]', '2024-10-13 11:00:00', 50, '2024-10-05 03:50:56', '2024-10-13 11:00:00', 124, 'customer', NULL, NULL, NULL, 'neon', '#FF6EC7', '#FFFFFF', NULL, NULL, NULL),
(186, 'Clarisse', 'Toralba', 'clarissetoralba7@gmail.com', '9488214935', '', 29, 35, NULL, '', 'Fulfilled', 'Full Payment', NULL, '[]', '2024-10-27 10:00:00', 100, '2024-09-23 00:57:04', '2024-10-28 03:02:57', 115, 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 'Cess Ann', 'Salazar', 'salazarcessann@gmail.com', '9394671348', '', 29, 35, NULL, '', 'Pending', 'Full Payment', NULL, '[]', '2024-12-03 15:00:00', 20, '2024-09-23 00:57:53', '2024-10-06 23:47:43', 114, 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 'Millecent', 'Genteroy', 'genteroymillecent288@gmail.com', '9812519806', '', 29, 35, NULL, '', 'Fulfilled', 'Full Payment', NULL, '[]', '2024-10-28 18:22:00', 10, '2024-10-21 10:24:25', '2024-11-03 23:05:24', 126, 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(28, 'Wedding', 'Wedding Service', '1726910072-tWcSIyhYYy6Cjn52a532GNu8SPxJhWufRYYOA2a8.jpg', '2024-02-20 22:16:09', '2024-09-21 09:14:32'),
(29, 'Birthday', 'Birthday Service', '1726910084-Wy2g3q9SqWKoVPJzw0YTYtXxZaOkYQp1s2Ij8EBR.jpg', '2024-02-20 22:18:02', '2024-09-21 09:14:44');

-- --------------------------------------------------------

--
-- Table structure for table `service_group`
--

CREATE TABLE `service_group` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_group`
--

INSERT INTO `service_group` (`service_id`, `package_id`) VALUES
(29, 31),
(29, 30),
(29, 29),
(29, 28);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` bigint(11) UNSIGNED DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `final_amount` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `discount_id`, `final_amount`, `created_at`, `updated_at`) VALUES
(2, 61, 123, NULL, 75.00, '2024-10-02 11:44:00', '2024-10-02 11:44:00'),
(3, 62, 122, NULL, 29.00, '2024-10-11 14:57:00', '2024-10-11 14:57:00'),
(8, 74, 193, NULL, 59.00, '2024-09-29 00:41:00', '2024-11-27 01:47:30'),
(9, 75, 131, NULL, 20.00, '2024-10-30 11:33:00', '2024-10-30 11:33:00'),
(10, 76, 140, NULL, 70.00, '2024-11-04 12:29:47', '2024-11-04 12:29:47'),
(11, 77, 134, NULL, 59.00, '2024-11-04 12:48:47', '2024-11-04 12:49:47'),
(12, 78, 132, NULL, 149.00, '2024-11-07 16:05:00', '2024-11-07 16:06:00'),
(13, 79, 165, NULL, 70.00, '2024-11-15 09:37:24', '2024-11-15 09:38:24'),
(14, 80, 164, NULL, 79.00, '2024-11-19 11:13:24', '2024-11-19 11:14:24'),
(15, 81, 162, NULL, 79.00, '2024-11-19 13:08:24', '2024-11-19 13:09:24'),
(16, 82, 130, NULL, 70.00, '2024-11-19 13:45:24', '2024-11-19 13:46:24'),
(17, 84, 106, NULL, 540.60, '2024-12-07 04:19:31', '2024-12-07 04:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `status` int(11) NOT NULL DEFAULT 1,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status`, `active_status`, `avatar`, `dark_mode`, `messenger_color`, `mobile_number`) VALUES
(1, 'Admin', 'admin', 'gigcafe026@gmail.com', '2024-04-04 01:54:39', '$2y$10$qjDWzLBazVnUavU6BXNcwOUy9krJZ2Pw65WO.DeTrFofc9LMjb8Hq', 'iQTL8pERdkVNQCeurrTeBRhbodVLwUNeEnPEqxfRIDPZAC8fJlNbZa2Nynbl', '2024-02-09 01:55:19', '2024-11-15 15:07:03', 'admin', 1, 0, 'avatar.png', 0, '#ff2522', ''),
(2, 'Staff', 'Staff', 'squadquinx8@gmail.com', '2024-04-04 01:57:02', '$2y$10$XX.Tow31ysr6yAfAJXLdT.QUnfvg5455pHGVYI.WZwC/nfiK73vLC', 'om6YkrgVdrYcwWP6gDEBKK4zBkEyDx7B382I3qlNGabOz9xKxQBxvKChfZMA', '2024-02-09 02:00:05', '2024-11-02 14:31:42', 'kitchenStaff', 1, 0, 'avatar.png', 1, '#3F51B5', ''),
(106, 'King JayJay Pacheco', 'JayJay', 'pachecoking38@gmail.com', '2024-05-22 18:20:18', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', 'dhAk3lS8WUo4pQqHPdqQzVL7NT1XgNTOZiD5wTFWsb9uZtwqJmbLGEC9Uwej', '2024-05-22 17:37:07', '2024-11-15 14:58:52', 'customer', 1, 1, 'avatar.png', 1, NULL, '09451997276'),
(114, 'Salazar, Cess Ann V.', 'Cessy', 'salazarcessann@gmail.com', '2024-09-23 00:46:39', '$2y$10$GWzE7zCVTjdOGX8RthbDwOyJ9YBUKHSl0D2OHtPdIlKDaHkjCzslO', NULL, '2024-09-23 00:41:15', '2024-09-23 00:46:39', 'customer', 1, 0, 'avatar.png', 0, NULL, '09394671348'),
(115, 'Clasrisse', 'Clarisse', 'clarissetoralba7@gmail.com', '2024-09-23 00:55:49', '$2y$10$/ut3GzJxQhE4PkRluQlHQud3BverEEJzI1DHbBQMSWx39plhfhxBm', NULL, '2024-09-23 00:50:44', '2024-09-23 00:55:49', 'customer', 1, 0, 'avatar.png', 0, NULL, '09488214935'),
(116, 'Jonalyn L. Fajilan', 'jlfajilan', 'nalijaf08@gmail.com', '2024-09-23 01:13:24', '$2y$10$x.ZqWSObzRpGmECZpILGw.0sj97V2nKM1jXh39yUuPVUJubju9qpO', NULL, '2024-09-23 01:12:41', '2024-10-06 00:16:25', 'customer', 1, 0, 'avatar.png', 0, NULL, '09291676135'),
(122, 'Siola Dapito', 'Siola', 'sioladapito@gmail.com', '2024-10-06 13:43:22', '$2y$10$FvMMfUpZz3ZT2xe6VS3snubAfrGLspPicnGTJlpFtjtk6Nw8iD5Lm', NULL, '2024-10-06 13:39:48', '2024-10-06 13:43:22', 'customer', 1, 0, 'avatar.png', 0, NULL, '09932526443'),
(123, 'Allen Oliva', 'Allen', 'olivaallen128@gmail.com', '2024-10-06 14:21:44', '$2y$10$ClxtZwMw0mZ.NUwsf1KnnekXKk7CrkETZxYmy..X9qk8nWb1uReMa', NULL, '2024-10-06 14:17:12', '2024-10-06 14:21:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '099510068658'),
(124, 'Aileen Macalalad', 'Aileen', 'macalaladaileen5@gmail.com', '2024-10-06 14:48:37', '$2y$10$LUlOZQVbSP4EIjF43dVileqd4JWJCZIJE7RFbDxrXmYAlwDykbOX2', NULL, '2024-10-06 14:43:58', '2024-10-06 14:50:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '095637735542'),
(126, 'Millecent Genteroy', 'millecent', 'genteroymillecent288@gmail.com', '2024-10-21 10:23:13', '$2y$10$6f2SfbpREHrgvTo5GdHRS.n0A7RbLOPb2rxMA3yYBkMCEX0zeQq8y', NULL, '2024-10-21 10:22:26', '2024-10-21 10:23:13', 'customer', 1, 0, 'avatar.png', 0, NULL, '09812519806'),
(127, 'Jenny Rose', 'Jenny Rose Fajilan', 'landichojennyrose@gmail.com', '2024-10-22 11:58:50', '$2y$10$Bjx2vYJW.BBcUSHR4FcrYeIl8xManHotijmLKERLHEzC9QpgrZoNy', NULL, '2024-10-22 11:56:41', '2024-10-22 11:58:50', 'customer', 1, 0, 'avatar.png', 0, NULL, '09510068658'),
(128, 'Jhunz', 'Jhunz', 'pachecoking38+netssl@gmail.com', NULL, '$2y$10$SUTv.UvZA3tYklTqANcCmeogGYmEuqjt0i3aO5d3zX9heJz6XMVku', 'Q8M0XoskFpMwOzc0c231svvGOgLxgKNfM9U0uMoU2ywH0XlhfmTvxTNRHNJO', '2024-10-24 06:37:48', '2024-10-24 06:37:48', 'customer', 1, 0, 'avatar.png', 0, NULL, '09127504780'),
(130, 'Rey Francis Gomez', 'Francey', 'francesrey011@gmail.com', '2024-11-19 13:43:24', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-10-26 12:05:52', '2024-10-26 12:05:52', 'customer', 1, 0, 'avatar.png', 0, NULL, '0969455230'),
(131, 'Aldrin Peter S, Gina', 'Gina05', 'aldrinpetergina@gmail.com', '2024-10-21 10:23:13', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-10-27 09:41:13', '2024-10-27 09:41:13', 'customer', 1, 0, 'avatar.png', 0, NULL, '09053557243'),
(132, 'shara', 'SharaB', 'shara@gmail.com', '2024-11-07 10:13:13', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-10-27 11:05:04', '2024-10-27 11:05:04', 'customer', 1, 0, 'avatar.png', 0, NULL, '09949158523'),
(134, 'Rodger Santos Janap', 'Chief', 'cardo@gmail.com', '2024-11-04 12:43:47', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-11-04 01:10:46', '2024-11-04 01:10:46', 'customer', 1, 0, 'avatar.png', 0, NULL, '9096532514'),
(135, 'Argel', 'aesumulong', 'argel.sumulong@gmail.com', '2024-11-04 01:57:47', '$2y$10$7cx2Ngmpyzl6ONQPOcF1NeAv/QNnW5D.cyaZZmn48/dM0Yc2E2h2O', NULL, '2024-11-04 01:57:13', '2024-11-04 01:57:47', 'customer', 1, 0, 'avatar.png', 0, NULL, '9178835137'),
(136, 'Jonalyn L. Fajilan', 'jonarockxz', 'jlfajilan@themedicalcity.com', NULL, '$2y$10$OlKFu47wUHTN7/gEFQOMCuSt2zbD7xU60DY6bvbN7bCSGEpLY..2.', NULL, '2024-11-04 02:23:57', '2024-11-04 02:23:57', 'customer', 1, 0, 'avatar.png', 0, NULL, '9291676135'),
(140, 'Jacqeline De Guzman', 'Jacqeline Putze', 'ezalzijazeub@gmail.com', '2024-11-04 12:12:47', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-11-22 17:35:59', '2024-11-27 02:36:21', 'customer', 1, 0, 'avatar.png', 0, NULL, '9452311664'),
(141, 'Eleasah Derisse', 'Eleasah Derisse', 'pam0405@comcast.net', NULL, '$2y$10$Ogx55QoU.W81Odq8Y6ChUetLXEtBirQLBF84XLnkogDasVptkODbG', NULL, '2024-11-22 18:22:38', '2024-11-22 18:22:38', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302077794'),
(142, 'Ardelia Brenken', 'Ardelia Brenken', 'info@truefittandhill.com.my', NULL, '$2y$10$MLfwZCw4OhZvlHhpRsazI.NFhI6SwZ.X5Yan1bMS7CdVEc8woqY36', NULL, '2024-11-22 22:16:44', '2024-11-22 22:16:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16782962869'),
(154, 'Jadah Revertera', 'Jadah Revertera', 'gsmith2611@aol.com', NULL, '$2y$10$vkOrJJHBSfZHTjzrMBAYuudSMu1WFvcGZZj6qRR8GocmCcBL3QQ1m', NULL, '2024-11-24 18:05:42', '2024-11-24 18:05:42', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722636202'),
(162, 'Mark Daniel Lapito', 'Mark Daniel', 'macmacd@gmail.com', '2024-11-19 13:08:24', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-11-25 19:07:18', '2024-11-25 19:07:18', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302087431'),
(163, 'Jauan Stensli', 'Jauan Stensli', 'elisejureidini@hamlinandburton.com', NULL, '$2y$10$bNRW0qZKmE/NQnW4z/vjyOspId4MOZXCQmXsfgxuyUAOQ2NMGxcs.', NULL, '2024-11-25 19:55:59', '2024-11-25 19:55:59', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722739889'),
(164, 'Aileena Atienza', 'Aileena', 'aileena08@gmail.com', '2024-11-19 11:12:24', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-11-25 20:24:55', '2024-11-27 04:59:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '9662245376'),
(165, 'Raela Mae Santosidad', 'Raela', 'raelamae@gmail.com', '2024-11-15 09:36:24', '$2y$10$XI.iyw.ZzF/9KqrGKOWGuOHKePWErVpzXjHAbOvq9r0rsV3C7UaTy', NULL, '2024-11-25 22:57:56', '2024-11-27 04:55:03', 'customer', 1, 0, 'avatar.png', 0, NULL, '9834556334'),
(193, 'Maria Charise Ebora', 'MCharise', 'eboracharise983@gmail.com', '2024-09-29 00:41:00', '$2y$10$WGgS1oUfm.Q5uKI305HUGO2JkzxdJNCrnCEiYByLMm7IAO0o8CCxO', '800vbfI3XMsu2X9D5fcumda2wRw5lmKzdSxeuontocmRzb3NkDpyRimTzxEm', '2024-11-27 01:32:04', '2024-11-27 01:36:24', 'customer', 1, 0, 'avatar.png', 0, NULL, '9675626163'),
(194, 'Lank Haliuc', 'Lank Haliuc', 'fteutle@gmail.com', NULL, '$2y$10$syAuAgev9ctIsPiK1rvrFePD.sw8Daqv8rffnLL4gGIJrx9kv1FTq', NULL, '2024-11-27 02:43:08', '2024-11-27 02:43:08', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15155976124'),
(196, 'Seiji Granke', 'Seiji Granke', 'williamaclark1940@gmail.com', NULL, '$2y$10$NgOkV7/yLl29t3Xtm5glQewNwpM0UV2tij3smqnPljbciEixctZpK', NULL, '2024-11-27 07:59:35', '2024-11-27 07:59:35', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17814256122'),
(197, 'Gevond Menchi', 'Gevond Menchi', 'alloymisty22@gmail.com', NULL, '$2y$10$QJItKdmSPNIxH/M5q1.hLeJiMGMCo3N/MLKRTjCnKUAjH0ZXLCC6u', NULL, '2024-11-27 09:19:54', '2024-11-27 09:19:54', 'customer', 1, 0, 'avatar.png', 0, NULL, '+12702637367'),
(198, 'Jean-Jacques Gbandi', 'Jean-Jacques Gbandi', 'mckenna.curry24@yahoo.com', NULL, '$2y$10$I7RsHyEZWjUClmKCSZNPde3Nri06tiukFu.F4Di0aJH4aZm/aU3Nm', NULL, '2024-11-27 12:18:51', '2024-11-27 12:18:51', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306500399'),
(199, 'Tysheanna Rodriguezrios', 'Tysheanna Rodriguezrios', 'kyle@nordicmountain.com', NULL, '$2y$10$8.vx2d1pFaiGo15olQbi/.DBFMHcnZmqnTgdm3Nzv/h315x.32geC', NULL, '2024-11-27 13:54:53', '2024-11-27 13:54:53', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14586839381'),
(200, 'Ziarra Weiter', 'Ziarra Weiter', 'sergiomalandrino43@gmail.com', NULL, '$2y$10$.VOK8upGUGUdBA1PK97HhOGhJvVSznL.hmEP67E35P116WyGfoo9q', NULL, '2024-11-27 14:32:24', '2024-11-27 14:32:24', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14804204716'),
(201, 'Yalixa Libran', 'Yalixa Libran', 'gfreeman@aentpc.com', NULL, '$2y$10$3NlMBn987FA.xs6ZyAMJ4.tg5b1HktpqIBivRC2GrazKtgrnQ4XLi', NULL, '2024-11-27 15:36:46', '2024-11-27 15:36:46', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052963777'),
(202, 'Phoenicia Parviainen', 'Phoenicia Parviainen', 'owen.c.davis@odfw.oregon.gov', NULL, '$2y$10$QjRdNUiII8cUSL77nJHx4.MCGPKQv0iZ/PKV7W7RdxxcosxbIiYse', NULL, '2024-11-27 16:23:53', '2024-11-27 16:23:53', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052633587'),
(203, 'Stann Cortezgarcia', 'Stann Cortezgarcia', '233@nsv.com', NULL, '$2y$10$o/SXLvgZ3oozNcQzejfn0.bMtrnf.h5ETnWMf6kkAeGkWqYhJoBLy', NULL, '2024-11-27 17:19:50', '2024-11-27 17:19:50', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306730738'),
(204, 'Reyan Ketti', 'Reyan Ketti', 'mlstuart4@gmail.com', NULL, '$2y$10$eNDGlCAn26Bz9hpQQn2PQe9KkwvU9U6ygE6YjL8QaqH1ESsOMOoYu', NULL, '2024-11-27 17:38:37', '2024-11-27 17:38:37', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13032603904'),
(205, 'Jasmane Juarez Data', 'Jasmane Juarez Data', 'janetgizziopeterkin@ace-it.com', NULL, '$2y$10$kbH0uJupaRffVFjDVddKVuloff7Cjam3fVKf4LG2xUAYEjsXmNoba', NULL, '2024-11-27 18:22:34', '2024-11-27 18:22:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14148518096'),
(206, 'Kasin Tondini', 'Kasin Tondini', 'info@seymoursolar.com', NULL, '$2y$10$l68OlyRQuDiqIr7gSYglZum1HlKv6TeAfqdWYKDsCv45NAysNMre6', NULL, '2024-11-27 19:03:24', '2024-11-27 19:03:24', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13057515455'),
(207, 'Zavon Cobbs', 'Zavon Cobbs', 'julia.burnham@epandcompany.com', NULL, '$2y$10$4mq37F2g/RALLhcMTyGgOejWmEBniCQrMbptxwQL9aEs9ONKxSs/W', NULL, '2024-11-27 19:24:12', '2024-11-27 19:24:12', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13053438493'),
(208, 'Mccray Inkley', 'Mccray Inkley', 'holly.lund@wisconsin.gov', NULL, '$2y$10$eOUWXvuWSzcE8dDaxlPc.u3e4nzRTX..g2sNg/Xpj764SKW2i4wtm', NULL, '2024-11-27 20:32:47', '2024-11-27 20:32:47', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056449888'),
(209, 'Lunna Monnich', 'Lunna Monnich', 'crazyb1324@gmail.com', NULL, '$2y$10$xx8CwxcAivV5C/z4kRUHX.9rDpcd.bhfQDX1OcTheLjZ2jI3n7hTi', NULL, '2024-11-27 22:26:14', '2024-11-27 22:26:14', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13323900034'),
(210, 'Adelynn Vazquez Fuentes', 'Adelynn Vazquez Fuentes', 'bamiller966@gmail.com', NULL, '$2y$10$J384jY2LQBm/.YNs3p0y9eub1H/jmo6KVVIu..6mixfgfrD6DNvLe', NULL, '2024-11-27 23:35:18', '2024-11-27 23:35:18', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16269295781'),
(211, 'Jannean Ataz', 'Jannean Ataz', 'jlynnemobile88@gmail.com', NULL, '$2y$10$XmXOhRN0OkM4BeyKvSf6h.GIf0QFUt/ceam2Tf8.zdbMINO36f0V6', NULL, '2024-11-28 00:12:22', '2024-11-28 00:12:22', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306002570'),
(212, 'Yohanna Akbaytogan', 'Yohanna Akbaytogan', 'melissa.boudreau@praedicat.com', NULL, '$2y$10$pmoSbPc.Z37HdCEksZqgYuy2cnCvW.n1X056e7NCWXa//YYJBZfMy', NULL, '2024-11-28 00:48:13', '2024-11-28 00:48:13', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052021953'),
(213, 'Hoss Gindler', 'Hoss Gindler', 'daryl.eggers@sjsu.edu', NULL, '$2y$10$gkp.PI/xNkTdiXkkORZrhexzjoaMY/8jzQSNC.NcgJuxXp0sCQnEO', NULL, '2024-11-28 01:29:29', '2024-11-28 01:29:29', 'customer', 1, 0, 'avatar.png', 0, NULL, '+12603022939'),
(214, 'Gequan Yostar', 'Gequan Yostar', 'tracysch999@hotmail.com', NULL, '$2y$10$vKFus0Oqb/pQJVB/nQySM.pznRjpz2hwVj3x43NRg96Bd3XKPzBXy', NULL, '2024-11-28 05:12:32', '2024-11-28 05:12:32', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16469523995'),
(215, 'Kaniylah Hryhoryeva', 'Kaniylah Hryhoryeva', 'hemaidi.z@gmail.com', NULL, '$2y$10$UHFpFjkOc8Xjp/5MQ.o/V.rmSuIMgBfHVDArTpXE83FA/FIicoEBq', NULL, '2024-11-28 08:25:59', '2024-11-28 08:25:59', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13053120466'),
(216, 'Lyalya Kuffer', 'Lyalya Kuffer', 'klippenfuchs@unitybox.de', NULL, '$2y$10$HWs16R9pzKobv8NXtpqvBOco9aVv41bn0Bdvg.k3srihmXqRTmNja', NULL, '2024-11-28 10:05:28', '2024-11-28 10:05:28', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19834561359'),
(217, 'Tityanna Sichem', 'Tityanna Sichem', 'cbeck001@outlook.com', NULL, '$2y$10$Nz1nNTMrk6lpMFtzqobqG.5w1fnmhofMBrO6o2grmt4aEvZU5g62a', NULL, '2024-11-28 14:06:45', '2024-11-28 14:06:45', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306508505'),
(218, 'Meredeth Rajotte', 'Meredeth Rajotte', 'nzgiftworld2007@gmail.com', NULL, '$2y$10$WiLytKLnYh7vFCXLyn6isul/g8MaXmMvo5v040QYJXgSz7x3prDa6', NULL, '2024-11-28 15:11:59', '2024-11-28 15:11:59', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056443835'),
(219, 'Chalina Kuba', 'Chalina Kuba', 'j.fortenberry@twru.com', NULL, '$2y$10$ZxqVRv2qd4ZzYPw4p4Z6qeyINXYcpIQdoSFIzK1bGdrYkpUnrcyyy', NULL, '2024-11-28 15:49:41', '2024-11-28 15:49:41', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306465874'),
(220, 'Betteann Aejmelaeus', 'Betteann Aejmelaeus', 'klock@aentpc.com', NULL, '$2y$10$rBLIgBJdfWpIju.2nKobGukMTyZav1/aTqfRvX8TyDck4VjbrSXsa', NULL, '2024-11-28 16:40:22', '2024-11-28 16:40:22', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18172176327'),
(221, 'Aizlee Mccuiston', 'Aizlee Mccuiston', 'jjay@aentpc.com', NULL, '$2y$10$nwkBfTmIJ8Cc2cePNj0IxOlVIMkPmXnK0QUPNsSfLAoiKuU.yp1pK', NULL, '2024-11-28 17:05:27', '2024-11-28 17:05:27', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18726431670'),
(222, 'Feliscia Tulis', 'Feliscia Tulis', 'lmarti1961@gmail.com', NULL, '$2y$10$w9.AhKbvF9uLxbqj6djQ7.wCf.p/4GUXyGW/MhPMbgG2kjGkaSz7u', NULL, '2024-11-28 18:16:05', '2024-11-28 18:16:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052772856'),
(223, 'Lurie Fedderly', 'Lurie Fedderly', 'amcknight@aentpc.com', NULL, '$2y$10$A0BvFTv2cz0QaaIQ3lzrU.sBdk0br7RpIEAbrXw6R0Dj93zcwcBG.', NULL, '2024-11-28 18:37:39', '2024-11-28 18:37:39', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056304953'),
(224, 'pLdxIYaPwO', 'CxIqIihG', 'alfordhvo1987@gmail.com', NULL, '$2y$10$zroxESaUE7u4F.m1Fvt4f.8c203tk1pLicmbsqreoM9ekPP1N9Gvu', NULL, '2024-11-28 18:47:26', '2024-11-28 18:47:26', 'customer', 1, 0, 'avatar.png', 0, NULL, '9604045439'),
(225, 'Justinrobert Carubini', 'Justinrobert Carubini', 'k.gleeson@twru.com', NULL, '$2y$10$hvqUxjwI0N/fGdVmbZOBmespw7s02Ykua8oPn5HOCZ/FXAUO0x3yK', NULL, '2024-11-28 19:20:49', '2024-11-28 19:20:49', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306336040'),
(226, 'Sasha Schweitz', 'Sasha Schweitz', 'mrobertson@aentpc.com', NULL, '$2y$10$4p4dksphmIoEi7T0BSOu.O55Yy6r/vMiqZ6QPemL5iUOlrlIqotfu', NULL, '2024-11-28 20:01:40', '2024-11-28 20:01:40', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306475185'),
(227, 'Pamelia Donnellon', 'Pamelia Donnellon', 'a96wong@gmail.com', NULL, '$2y$10$7Ncr2XWQCx3Eca2bqUL6IOPWUHVuiDrMvtyqL6TqLsBnYYsbiL4CC', NULL, '2024-11-28 20:22:28', '2024-11-28 20:22:28', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17312531834'),
(228, 'Tanzania Cancro', 'Tanzania Cancro', 'bwhittey@aentpc.com', NULL, '$2y$10$w6XhOkeSZmlVxvOFclEhAesCnqjaJq1qfRErwdB7Y36A8gw9T75WK', NULL, '2024-11-28 20:44:33', '2024-11-28 20:44:33', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302039539'),
(229, 'Ellanora Rafferty', 'Ellanora Rafferty', 'veronica@twru.com', NULL, '$2y$10$UEnkY0zxNAPSiT6ddQgPMelEa/wtON1q6IdeikF9sjeO98uUNOpca', NULL, '2024-11-28 21:30:05', '2024-11-28 21:30:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18452830532'),
(230, 'Cira Beakley', 'Cira Beakley', 'hds2@bellsouth.net', NULL, '$2y$10$ucVgRzDuCoC3mFc14jbLBu4VyJwf1yY.F/Y1qpe96Z84rEcs3yctG', NULL, '2024-11-29 01:45:06', '2024-11-29 01:45:06', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13058128000'),
(231, 'Calia Snoro', 'Calia Snoro', 'aude.mergey@web.de', NULL, '$2y$10$qxGLph8BRtkPcz5q/MptA.fwQN0W02HVlXg0mIP0K4x2/HUci1kSW', NULL, '2024-11-29 02:31:27', '2024-11-29 02:31:27', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056107714'),
(232, 'Ellamarie Cutno', 'Ellamarie Cutno', 'nayah.gilchrist@yahoo.com', NULL, '$2y$10$H038gX.SYLv610hpS22GDOgYZ98KZHgYTP3Fvgv9f2zG1c2xD42kG', NULL, '2024-11-29 03:15:22', '2024-11-29 03:15:22', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722423373'),
(233, 'Melton Leonforti', 'Melton Leonforti', 'phillipsquentin26@gmail.com', NULL, '$2y$10$N2x7HhG0Tnwh0ue6YHGgm.sH6rx9IaFUN/PTdYio4UTZqT5ECqk9e', NULL, '2024-11-29 06:05:14', '2024-11-29 06:05:14', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306346419'),
(234, 'Kymoni Kibato', 'Kymoni Kibato', 'fatusha82@gmail.com', NULL, '$2y$10$QFK4ZPEIlGQ8hwHqS/OvNezhbrQR4ZIrME4PWCar6FEwXdfvR2Z42', NULL, '2024-11-29 10:38:33', '2024-11-29 10:38:33', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052053500'),
(235, 'Minga Stabile De Uicich', 'Minga Stabile De Uicich', 'erblbalasbub@do-not-respond.me', NULL, '$2y$10$sRtPty0gsnPSaJ48ywXPwOOXGw97WDH7uma.NmvmJ.8Gx7AGqqGBG', NULL, '2024-11-29 14:17:05', '2024-11-29 14:17:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056697501'),
(236, 'Shamain Vesa', 'Shamain Vesa', 'johnny.paiz@csun.edu', NULL, '$2y$10$SZWRrvYi3qJGR6OvpT7kpu67sC0KYpfsmTuUoGmaZf0k2VGZravqi', NULL, '2024-11-29 14:30:26', '2024-11-29 14:30:26', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18149082271'),
(237, 'Sherman Garrels', 'Sherman Garrels', 'htsourides@aol.com', NULL, '$2y$10$3xJixfdOJKmx5jXHk.5UIuwNSNlaXKeTgeP0ExjhmtTyNrJJfCNbq', NULL, '2024-11-29 16:57:55', '2024-11-29 16:57:55', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14724154363'),
(238, 'Crissey Torrescano', 'Crissey Torrescano', 'kbordoh@gmail.com', NULL, '$2y$10$ULeG/CRKAg6khBtZt1tGeuEPPtUMRtpTyc.d/RdTy9bmhwxNWLvrK', NULL, '2024-11-29 19:05:40', '2024-11-29 19:05:40', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13056229953'),
(239, 'Isabelly Bennetsen', 'Isabelly Bennetsen', 'bumer2535@aol.com', NULL, '$2y$10$V/BTop5XICebqYhqDyG0FO8aI4KGkbZWr6TDfPwDqcK7O1copNWm2', NULL, '2024-11-29 20:37:08', '2024-11-29 20:37:08', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306190713'),
(240, 'Amberia Adjou', 'Amberia Adjou', 'f.schmidt99@gmx.net', NULL, '$2y$10$jLkYGabPfYguvtv6r.l4wOeHGF9HR6pByEh5tgIwBmOU9QVOLXIRK', NULL, '2024-11-29 21:41:37', '2024-11-29 21:41:37', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052775628'),
(241, 'Saitgali Lalicata', 'Saitgali Lalicata', 'shavongilroy@gmail.com', NULL, '$2y$10$gaoD56FBzBiEPgwgOVFWrOmwJQQD6hZsv8h5KGrHf0rH7rUTq6uwO', NULL, '2024-11-29 22:08:54', '2024-11-29 22:08:54', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15574305048'),
(242, 'Treyana Barrigas', 'Treyana Barrigas', 'sanchez.gsanchez59@gmail.com', NULL, '$2y$10$a.EicgGDrBbQjRV3mFL8kuz4.iswUfH3Is4a9maN5zAz.TJG0z8J6', NULL, '2024-11-29 22:37:47', '2024-11-29 22:37:47', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19832465294'),
(243, 'Altouise Aibeo', 'Altouise Aibeo', 'olgad@wideband.net.au', NULL, '$2y$10$osb.Njjesfw3WZ67bsxMjebHHKxKEtArjHyTRtD53rN9VZaCf4FUy', NULL, '2024-11-30 00:51:15', '2024-11-30 00:51:15', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15748453697'),
(244, 'Savir Desabysses', 'Savir Desabysses', 'wbasker@gmail.com', NULL, '$2y$10$Oy7dmdix5kqR4pT9pOSDDem.1OTEk0VauP9E5K4S08VfucU/QkawC', NULL, '2024-11-30 02:52:22', '2024-11-30 02:52:22', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052351659'),
(245, 'Capucine Mcgeouch', 'Capucine Mcgeouch', 'rjshops@me.com', NULL, '$2y$10$OMWdY5dLq9iAGOvfXRLCU.AK5Opv5utcg99NFOwe/RQBONv2m71I2', NULL, '2024-11-30 07:34:51', '2024-11-30 07:34:51', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15055227924'),
(246, 'Alaiya Redhorn', 'Alaiya Redhorn', 'amandanoellenugent@gmail.com', NULL, '$2y$10$CRXbF2oBIsDksMFhEtBZFuDbBCZYe8i5ft.HIdMLejyXAorenJGWq', NULL, '2024-11-30 09:08:58', '2024-11-30 09:08:58', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14724445054'),
(247, 'Luevinia Ittinuar', 'Luevinia Ittinuar', 'joerg.heyne@gmx.net', NULL, '$2y$10$lTpT.y1Dea1XY7c/xyd7MeUHnK.1HJHgKaNznPSGcCPiKMUKYtgGG', NULL, '2024-11-30 12:44:44', '2024-11-30 12:44:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052162417'),
(248, 'Andris Alvarez Ferrari', 'Andris Alvarez Ferrari', 'frieda-fred@gmx.de', NULL, '$2y$10$78dia.KAqODH9CvoO6nK3eOKmAB7F5YGxoXjOyssMMhEnc9KmktYm', NULL, '2024-12-01 00:54:43', '2024-12-01 00:54:43', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722319708'),
(249, 'Alaes Bouharrat', 'Alaes Bouharrat', 'marielle@bonaireoceanfrontvillas.com', NULL, '$2y$10$Mq1SpIQm.BJagPv6X5Lb/eqZ0.r5YvXIPY0FhTphfF.5yXdYk5arq', NULL, '2024-12-01 04:56:45', '2024-12-01 04:56:45', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056184582'),
(250, 'Courtlan Harguinteguy', 'Courtlan Harguinteguy', 'ursogiuseppe78@gmail.com', NULL, '$2y$10$bYfiJsloDOsxUD6IrHrW3.G2I0DguIGGiPwY6UhgBIUq94j6zlIAm', NULL, '2024-12-01 09:14:47', '2024-12-01 09:14:47', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052032823'),
(251, 'Queshon Gabrijelcic', 'Queshon Gabrijelcic', 'konanjacob363@gmail.com', NULL, '$2y$10$UdgAhOWI24gxn7Ry.QxbWOYqUZrYcNozaUMe7D6sAKqhl5TfPat4u', NULL, '2024-12-01 12:52:36', '2024-12-01 12:52:36', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19383208936'),
(252, 'Baylaa Tuufuli', 'Baylaa Tuufuli', 'dipema.a010591@gmail.com', NULL, '$2y$10$bc8j2HSjRKCc65IZz0W79OcJgjM0J3WAFsDP50Lnap3V6ykGRkkaK', NULL, '2024-12-01 15:21:49', '2024-12-01 15:21:49', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15057120645'),
(253, 'Atyana Debarbieri', 'Atyana Debarbieri', 'ericakavanagh21@yahoo.com', NULL, '$2y$10$.FVfemE.DTIkIX0b7NT23uR0tISng76jrwrqmHszYZP.lHpFB3llG', NULL, '2024-12-01 16:42:17', '2024-12-01 16:42:17', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306096738'),
(254, 'Laylannie Stollar', 'Laylannie Stollar', 'ajecks@comcast.net', NULL, '$2y$10$XG9BzgN.Fht9IN4ilGHW2.ekku7gvRK24mPHk/LYLZ0gYiFBc592.', NULL, '2024-12-02 02:29:53', '2024-12-02 02:29:53', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16202398205'),
(255, 'Fremon Wlach', 'Fremon Wlach', 'kendall.maltby@gmail.com', NULL, '$2y$10$CNoWj1226RbECp6lBXes9eAwjlKzcbtq5rmO4imRU5R6CwYMj2JIe', NULL, '2024-12-02 10:30:32', '2024-12-02 10:30:32', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13078519098'),
(256, 'Zaryha Juncal', 'Zaryha Juncal', 'soldman88@gmail.com', NULL, '$2y$10$2Xqm1KP6X9OoRU3FjhTM6ehxi4VjD5CO9rJhXH5QAnbOzXbNsoBsm', NULL, '2024-12-02 15:13:32', '2024-12-02 15:13:32', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16679447343'),
(257, 'Eiad Gauna Donalisio', 'Eiad Gauna Donalisio', 'krisjoy66@comcast.net', NULL, '$2y$10$gbm7pahFiC5S6PB4o8qDNuAfdOcXOnsRO6d.Ng6ro1jlqspbUeE5m', NULL, '2024-12-02 20:42:39', '2024-12-02 20:42:39', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052022473'),
(258, 'Marlando Gallatin', 'Marlando Gallatin', 'michael.kirlew.jr@gmail.com', NULL, '$2y$10$.JWPGgidY3O1tVCF7Tk37OkO0vD1VFpBRR9JzGiv4p4wCtXExQwSS', NULL, '2024-12-02 23:12:12', '2024-12-02 23:12:12', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056460111'),
(259, 'Latroya Norbury', 'Latroya Norbury', 'erinkbusch@yahoo.com', NULL, '$2y$10$PRXOgBavCbQYf6OgW/CUAu2fKOTDq/PaKBFBm5EHtWFboRgDnWDq.', NULL, '2024-12-03 05:54:31', '2024-12-03 05:54:31', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15053708850'),
(260, 'Adonias Wike', 'Adonias Wike', 'ebgc@aol.com', NULL, '$2y$10$g98j2xoBWMH9IiJB.e1K7uchdzLk2/CjofPh8eDc69Tfjv57DmoPO', NULL, '2024-12-03 08:06:45', '2024-12-03 08:06:45', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722388665'),
(261, 'Jaqari Prucha', 'Jaqari Prucha', 'sandra.kemker@t-online.de', NULL, '$2y$10$.w./Tt8ppi0BhpuSRXtDEOrRcQeCRXvINaSCNsmmG1ilYGIoa2bLC', NULL, '2024-12-03 09:27:03', '2024-12-03 09:27:03', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19833816787'),
(262, 'Bryasha Rensch', 'Bryasha Rensch', 'akmendez11@gmail.com', NULL, '$2y$10$6uNw1cD2WhUxOx8JAi1CoucWVNKE8FROZExKG1miTkNseAVJzLBQ2', NULL, '2024-12-03 13:35:12', '2024-12-03 13:35:12', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056462005'),
(263, 'Orionna Onesko', 'Orionna Onesko', 'dylan.floody@gmail.com', NULL, '$2y$10$xTMupbPHzm88.TLiCso29.1Abw3Q.DeypiR9H5G3Q4aXIlylSPQWG', NULL, '2024-12-03 18:49:43', '2024-12-03 18:49:43', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18632268514'),
(264, 'Theoren Gubitz', 'Theoren Gubitz', 'lomas-5@comcast.net', NULL, '$2y$10$fnm82ow6xoPE8GmZ4TEbMe9N0vPx4kx2csdIu7Yr4fUAky6oLqzLa', NULL, '2024-12-03 19:44:02', '2024-12-03 19:44:02', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302368043'),
(265, 'Leonide Floate', 'Leonide Floate', 'carolyn.profaizer@heplerbroom.com', NULL, '$2y$10$bpyPIMpc8gN8HtbAsCgwF.cpmbF.T2McPQsZ/CeGpcy0zOFJN5O0.', NULL, '2024-12-03 20:48:59', '2024-12-03 20:48:59', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19319815297'),
(266, 'Marti Herbstreuth', 'Marti Herbstreuth', 'candace.orr@sourceadvisors.com', NULL, '$2y$10$OdtScj2NYYzcAMRgZmF23O2T/l0So2yoHcSEBIbyiWhIbyhBb3uNm', NULL, '2024-12-03 21:10:52', '2024-12-03 21:10:52', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18155962891'),
(267, 'Joesiyah Caceda', 'Joesiyah Caceda', 'cvaughnf@charter.net', NULL, '$2y$10$QjJAGHPj/wvbJr0vp/lT..j/3E0f3BWlQk2LQr3bfa/.R6pHJbLZK', NULL, '2024-12-04 00:47:25', '2024-12-04 00:47:25', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306218701'),
(268, 'Dvejra Demoya', 'Dvejra Demoya', 'b.jacco@hotmail.com', NULL, '$2y$10$pdywtZ8.FUI3ZRcRdfC47.fTgXn3hQQZdvB.ijWMYN5drUBkU8rqy', NULL, '2024-12-04 02:43:28', '2024-12-04 02:43:28', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19832557492'),
(269, 'Chaylene Straite', 'Chaylene Straite', '54dtamaru78@gmail.com', NULL, '$2y$10$tq4KMATOoKDd0Dq2kJDCBeMsFUeb1kIZnJ.8LVrVpGtIAUzLfaOSC', NULL, '2024-12-04 10:30:46', '2024-12-04 10:30:46', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14126886364'),
(270, 'Ambir Guess', 'Ambir Guess', 'jalysajc23@gmail.com', NULL, '$2y$10$5rKasdbG2XGqCKVZY3qd/.WjpqUvzFkOKPcRDYsa3Q3tR7xSajXpO', NULL, '2024-12-04 16:14:19', '2024-12-04 16:14:19', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19834443022'),
(271, 'Amelina Stapf', 'Amelina Stapf', 'zenfonemaxacc@gmail.com', NULL, '$2y$10$HHV01yNM0o1jsJ9p1IrSr.y2XnfN.6m7udwvLkr5eQqUG4Hbw5RBS', NULL, '2024-12-04 18:07:34', '2024-12-04 18:07:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056965837'),
(272, 'Rochon Sakal', 'Rochon Sakal', 'jedgemond@unither.com', NULL, '$2y$10$1dkuOr5dpbReAs9fN1eUp.WOXLfgaCPEusn/NnWmsGjqBQ3XQm.Su', NULL, '2024-12-04 20:39:11', '2024-12-04 20:39:11', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19068090563'),
(273, 'Antonella Reichwald', 'Antonella Reichwald', 'jssc301@gmail.com', NULL, '$2y$10$CRBLyzCLYvB6fJ7pNInMRuBFpo09yc3Bv6lGiSacB6mYa.rRivkSq', NULL, '2024-12-04 21:16:34', '2024-12-04 21:16:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052071985'),
(274, 'Lesheena Fortna', 'Lesheena Fortna', 'khaunton@alvarezandmarsal.com', NULL, '$2y$10$R1OQ5faTOtvt9x7rl4Kczul7Ddje8dCrLzG3ouBCg7Qm.Q95YvvUi', NULL, '2024-12-04 22:03:36', '2024-12-04 22:03:36', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302229501'),
(275, 'Zeik Bielewicz', 'Zeik Bielewicz', 'ksmilie@alvarezandmarsal.com', NULL, '$2y$10$9RoL9GryCKTj3rfx9BYHEubOOeZ4L8giJfStoAk6r6LfC6UnsC89q', NULL, '2024-12-04 22:17:25', '2024-12-04 22:17:25', 'customer', 1, 0, 'avatar.png', 0, NULL, '+12813976323'),
(276, 'Wandalid Berlioz', 'Wandalid Berlioz', 'ruby.kuriger@gmail.com', NULL, '$2y$10$qIBOiaxy5Ij1oTP5I2YXq.8hBDa.Zp8fkZUqNADGqtQsQGuEOqU2u', NULL, '2024-12-04 22:46:10', '2024-12-04 22:46:10', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19838474305'),
(277, 'Ahmoni Lilburne', 'Ahmoni Lilburne', 'pmccrorie@rsui.com', NULL, '$2y$10$3wjo/jE.TfUeOhEm2UWOQeylYYbwiT0230/bgp1HsQDlZ1CeoBxJK', NULL, '2024-12-04 23:16:55', '2024-12-04 23:16:55', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14847146480'),
(278, 'Titianna Treusdell', 'Titianna Treusdell', 'b_crews@bellsouth.net', NULL, '$2y$10$V5LuoVEiDHMGcwmOtFXLKupl8xhL2agYp5lfPuUZrwGyHVHqnbzUO', NULL, '2024-12-05 00:27:36', '2024-12-05 00:27:36', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13059802596'),
(279, 'Adarien Charco', 'Adarien Charco', 'melhiguera@comcast.net', NULL, '$2y$10$57WSRi2SJWSxxiPVxcACEeGT7q00MaZx5PaK3V1sv2Rp/LZekNPge', NULL, '2024-12-05 00:46:27', '2024-12-05 00:46:27', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19207901591'),
(280, 'Praskoviya Kintzer', 'Praskoviya Kintzer', 'rodyortez@yahoo.com', NULL, '$2y$10$3oHwQj5cBnpJBE9BCshSmOuFusZUYd5Ofl.VAwr0Uo3iwn9aiJSya', NULL, '2024-12-05 01:31:57', '2024-12-05 01:31:57', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14148256751'),
(281, 'Darrion Hartvich', 'Darrion Hartvich', 'sam_evans43@outlook.com', NULL, '$2y$10$.NYoEU5DmDtebOvBwUIlLe5n8vQf.O4X2kl4K6tc9QN70DoxYTtMe', NULL, '2024-12-05 02:05:00', '2024-12-05 02:05:00', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306553383'),
(282, 'Cloteal R Aschou-Nielsen', 'Cloteal R Aschou-Nielsen', 'simmonsva08@gmail.com', NULL, '$2y$10$Sa25GoBb8mZfUlDt6u8BOO2vhpBqrUzOi2L3P1lKdbyTg3ro40zNq', NULL, '2024-12-05 02:41:02', '2024-12-05 02:41:02', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13057932117'),
(283, 'Nevan Mehlbrech', 'Nevan Mehlbrech', 'samanthablevins18@gmail.com', NULL, '$2y$10$mdpeM94Jnt/4t7Zpj.Zn5OVqtLgS54E.zvrTgDeo2WMkZqpbYJGei', NULL, '2024-12-05 03:13:18', '2024-12-05 03:13:18', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17576684756'),
(284, 'Lashanay Barrientos Oliva', 'Lashanay Barrientos Oliva', 'niurkarodriguez31@yahoo.com', NULL, '$2y$10$9lMgTKjcekK1KrNvKpQ3fu7v4Ztg9WlZPRshvpa0Q9U7pQyQVqjuC', NULL, '2024-12-05 03:48:11', '2024-12-05 03:48:11', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17545965812'),
(285, 'Adriene Hertneky', 'Adriene Hertneky', 'yaro.lustenberger@pilatus-aircraft.com', NULL, '$2y$10$l4nxbqE26jjP9cfHzycMs.cEXC//LDBL5scvHxPk3mE/70fVPDL2G', NULL, '2024-12-05 14:20:25', '2024-12-05 14:20:25', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056913485'),
(286, 'Jahkhi Milkins', 'Jahkhi Milkins', 'michael.elefante@hometeamvr.com', NULL, '$2y$10$AKgs.mZwYkJ35pyP4NrQuupbrRvWEr2BPkffQkEuOrQmSTeSKn.aa', NULL, '2024-12-05 16:14:36', '2024-12-05 16:14:36', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302102351'),
(287, 'Sylester Chaikovskyi', 'Sylester Chaikovskyi', 'devin.larmeu@schupan.com', NULL, '$2y$10$TTXNepRk.igXEkK2o/9Lk.PCwuOfg8k6.4TeHW1PHmyi9JSuCWwo.', NULL, '2024-12-05 16:50:38', '2024-12-05 16:50:38', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056881335'),
(288, 'Asan Bonecutter', 'Asan Bonecutter', 'thorstenspringorum@arcor.de', NULL, '$2y$10$ADrbuEGo5pgXTNGp.NrW3.ZNmlmHnq7bgNoXC.MjodfcC9QM/xUtO', NULL, '2024-12-05 17:14:33', '2024-12-05 17:14:33', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18122772704'),
(289, 'Kevan Codarcea', 'Kevan Codarcea', 'cahb8084@gmail.com', NULL, '$2y$10$5.g096ZKm7h.wrJoT2FJx.F700pRgHhRbMeXM9y/.CNKxgba7b5A.', NULL, '2024-12-05 17:14:34', '2024-12-05 17:14:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18014291554'),
(290, 'Raseel Orejas', 'Raseel Orejas', 'afalke@jamaicabearings.com', NULL, '$2y$10$ArT6vTafto39R48xeMguh.xbzwTvxFZilE1NAFr9o4WdQ.50E.Roq', NULL, '2024-12-05 17:54:07', '2024-12-05 17:54:07', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302139441'),
(291, 'Bnai Szenkman', 'Bnai Szenkman', 'gdetoma@jamaicabearings.com', NULL, '$2y$10$7z62BMAk6FMKU1aGsp1CNOknMDTUx.aVIKtrK130dgk2tseeSCD56', NULL, '2024-12-05 18:53:05', '2024-12-05 18:53:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13059390634'),
(292, 'Flarrie Mendez Zacarias', 'Flarrie Mendez Zacarias', 'r.molina@albawheelsup.com', NULL, '$2y$10$pqCB6N9izxaZo/rn0j.EIu4TisPe3XLNH6vOFTj35PDzAFFC/9SPy', NULL, '2024-12-05 19:13:05', '2024-12-05 19:13:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056833755'),
(293, 'Budd Akahoshi', 'Budd Akahoshi', 'lcole@gandhtowing.com', NULL, '$2y$10$WX9MZvMXjUbWMu.P9fIaReznHgSaiW5oxc/IJMyDW9LKeM1HFChH.', NULL, '2024-12-05 20:57:34', '2024-12-05 20:57:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13056274774'),
(294, 'Ardine Ricchini', 'Ardine Ricchini', 'kevharsh@gmail.com', NULL, '$2y$10$qXAkLwqJr.v6ra2GIW3wJOs7CPMKYi.7AcFUu3yQGqtNEq32sJIxu', NULL, '2024-12-05 21:35:54', '2024-12-05 21:35:54', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056465914'),
(295, 'Kenne Madagan', 'Kenne Madagan', 'rchernicoff@gmail.com', NULL, '$2y$10$QV2DXf3Kg46pRtYLzPIZx.hMvjbwFX5hApSUVlF..I2vSlvpLQN6O', NULL, '2024-12-05 22:27:51', '2024-12-05 22:27:51', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16464440024'),
(296, 'Ikaia Radloff', 'Ikaia Radloff', 'kg2country@aol.com', NULL, '$2y$10$O1S7q/LoHaLH19r6yT0z.uKgMdpe368e1r8z6lMGR0OSNm1f1a2L.', NULL, '2024-12-06 00:15:10', '2024-12-06 00:15:10', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302312837'),
(297, 'Johnnice Kreusch', 'Johnnice Kreusch', 'marketing@euroeyes.de', NULL, '$2y$10$qk6FdJc8tobvVlHbXGocWOAePfeQG.KcKTuLk6RJ1W6ZmzdIb292.', NULL, '2024-12-06 01:10:15', '2024-12-06 01:10:15', 'customer', 1, 0, 'avatar.png', 0, NULL, '+18267326396'),
(298, 'Klimentij Salandro', 'Klimentij Salandro', 'jason+test@matmon.com', NULL, '$2y$10$g2WH8nqrsYwonavkeBo.aOWjPNtThuPOGgWErT3ESky2RZuV/XDNW', NULL, '2024-12-06 14:09:03', '2024-12-06 14:09:03', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306382300'),
(299, 'Eagle Beumer', 'Eagle Beumer', 'shobdy@mpdinc.com', NULL, '$2y$10$uYfYfbruvtGyyKoVSpE4.uhjtmwAQBMMhQKWh0sCyezPZ9xUffXRi', NULL, '2024-12-06 17:09:00', '2024-12-06 17:09:00', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15822769902'),
(300, 'Obrain Stangner', 'Obrain Stangner', 'gabster_721@hotmail.com', NULL, '$2y$10$veBtxuZFFqpwxTKEXFm4je0x.pxFMOfDrexmIZMFlgsU1sX4M03W6', NULL, '2024-12-06 19:00:44', '2024-12-06 19:00:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302083121'),
(301, 'Aalayiah Hausknecht', 'Aalayiah Hausknecht', 'courtney.simmons@powerdistributors.com', NULL, '$2y$10$1HvFb2A/kNFmHiGcd.iG7e1JW7pEWMByy9pgD3xIa952bZKdecseO', NULL, '2024-12-06 19:00:48', '2024-12-06 19:00:48', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056461198'),
(302, 'Khye Earth', 'Khye Earth', 'vlacroix@blackdiamondnet.com', NULL, '$2y$10$sMyCdnFYLUSAgdDTUP133uDVvZqItHS8l6Nr1HJtJHVeaqMq9VlWy', NULL, '2024-12-06 19:15:49', '2024-12-06 19:15:49', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16817983906'),
(303, 'Chartez Raman', 'Chartez Raman', 'tengluo88@gmail.com', NULL, '$2y$10$D0W4M.JyI0.xJvRpE0px9.wQ60nLKRnirLxjOCoBZde7ml.i0zLLG', NULL, '2024-12-06 19:31:15', '2024-12-06 19:31:15', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052934099'),
(304, 'Vardell Yuska', 'Vardell Yuska', 'jromo@tellworks.com', NULL, '$2y$10$wvaUlcoH0Crdf.MkcLPjMe0z.SoRMB6JHg3T7GB8y1ryae3fee9.K', NULL, '2024-12-06 20:11:51', '2024-12-06 20:11:51', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306430025'),
(305, 'Arkeen Edgardo Hilaire Chaneton', 'Arkeen Edgardo Hilaire Chaneton', 'jhead@huntonak.com', NULL, '$2y$10$IxjYzk8N.YLtsOPLGtm33OmpQ5r9drfxlISP2zSPnvFXYZN7hpjzu', NULL, '2024-12-06 20:36:57', '2024-12-06 20:36:57', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056482331'),
(306, 'Deguan Korba', 'Deguan Korba', 'achoinski@huntonak.com', NULL, '$2y$10$EJxa6LkHC34Ysdunskyqb.ZgZQJWd6AgOWdLvJxCt.q1qsg25Dke.', NULL, '2024-12-06 21:10:59', '2024-12-06 21:10:59', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13057511376'),
(307, 'Zalifa Citil', 'Zalifa Citil', 'abergmann@horizon-next.com', NULL, '$2y$10$bcFEzBxWnyW0H/6OwTbJVetKYiwtSib6dwI4JPAws7CAIrzsTWzyC', NULL, '2024-12-06 21:31:41', '2024-12-06 21:31:41', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13053558206'),
(308, 'Mckoy Dinwiddy', 'Mckoy Dinwiddy', 'cbrunclik@liscr.com', NULL, '$2y$10$G.Mnb.tls/SzEu.0239eUea66UNRYfkLVNdfA75w9m9zIQMjhNxXq', NULL, '2024-12-06 22:02:52', '2024-12-06 22:02:52', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306467682'),
(309, 'Tippi Glasmann', 'Tippi Glasmann', 'charmaine.torruella@qsc.com', NULL, '$2y$10$q69PQhx.aYUZBiw83cN7nuHEj6mDCmNHeuV8pJIFS.yvufPlFcccK', NULL, '2024-12-06 22:33:56', '2024-12-06 22:33:56', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15057046855'),
(310, 'Kinzee Abril', 'Kinzee Abril', 'donnett.homen@cohu.com', NULL, '$2y$10$MpLSHbWvxPhJRQ/hb0pFKOCj4qECJennCbBpuUDCtiWud0LCbKgE6', NULL, '2024-12-06 22:54:29', '2024-12-06 22:54:29', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056606199'),
(311, 'Illariya Chevannes', 'Illariya Chevannes', 'don@pacificaquagroup.com', NULL, '$2y$10$2L6mp5dqi8mV1swajb/tE.A4Ldc9sOlWFYPR2R0v8czOuV19kzXWe', NULL, '2024-12-06 23:16:17', '2024-12-06 23:16:17', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056097121'),
(312, 'Kenso Birri', 'Kenso Birri', 'psingletary@optexamerica.com', NULL, '$2y$10$Ez7hpFrXbTGg8pIkmbGwIuLwNh4Xq68H2VVjFk8StvYUlMFbaRzta', NULL, '2024-12-06 23:39:42', '2024-12-06 23:39:42', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302125499'),
(313, 'Tinica Pohlmeyer', 'Tinica Pohlmeyer', 'weare3grays@gmail.com', NULL, '$2y$10$YMrufTQ6lFBv7ctqiRTDceDGMkOO2.qDiSyaHWBMsTAfl.U9FrKqK', NULL, '2024-12-06 23:52:19', '2024-12-06 23:52:19', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13052060460'),
(314, 'Lulamae Schnoebelen', 'Lulamae Schnoebelen', 'pzavorskas@liscr.com', NULL, '$2y$10$dcHNEAoKwoMsUeS4f6NtbeYpxNrB5B7yvDYWC80vb0FVzSqZp90p6', NULL, '2024-12-07 00:33:35', '2024-12-07 00:33:35', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302326227'),
(315, 'Yamine Lorance', 'Yamine Lorance', 'johnsbadwheel@gmail.com', NULL, '$2y$10$PfQPMoB8ghYqAS48dAlxDuPJk2rwK803VP9NNf0isJT4Qw3XMoggO', NULL, '2024-12-07 03:56:24', '2024-12-07 03:56:24', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302046990'),
(316, 'Trofim Danto', 'Trofim Danto', 'ketanavani@yahoo.com', NULL, '$2y$10$HphilRAWISIp6IvNBmCvJu5Pgv3lnDGY0mfc9Rr7UG7eg5W6as5X.', NULL, '2024-12-07 05:33:34', '2024-12-07 05:33:34', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056465820'),
(317, 'Charese Estrada Vitantonio', 'Charese Estrada Vitantonio', 'info@charter.ch', NULL, '$2y$10$f2irfr9cOt3TFNwvt.WJ.uDmd8uwSVvCur4cMudycyCdakUMft17S', NULL, '2024-12-07 07:53:19', '2024-12-07 07:53:19', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14722788135'),
(318, 'Narvin Akgol', 'Narvin Akgol', 'gregory.sorreaux@thales.be', NULL, '$2y$10$tiKkRO3AnHC6tIYB5bNS0epmMSJkNLfgNh4exPwjxsKZmnV2qVQqK', NULL, '2024-12-07 11:29:16', '2024-12-07 11:29:16', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19832216976'),
(319, 'Leahnna Martinez Velasquez', 'Leahnna Martinez Velasquez', 'vacances@solvoyages.ch', NULL, '$2y$10$u68CQ6tXaNGNKIcX..kVSOenjfEYkaeJg3oBBLyvVScrnc4Wo.q4C', NULL, '2024-12-07 12:53:56', '2024-12-07 12:53:56', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13058235969'),
(320, 'Thos Gierszewski', 'Thos Gierszewski', 'darryl.tamash@gmail.com', NULL, '$2y$10$RzpxyZELedyxweibF.QRG.WCbo004GvRjYyp4uxhq8.MY7Sf4wxZi', NULL, '2024-12-07 19:31:56', '2024-12-07 19:31:56', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19837908348'),
(321, 'eOGeoXVmXVOUE', 'WraUhgidQYkburc', 'acb9w10wq@yahoo.com', NULL, '$2y$10$Tw0qDGLuzBEcuXv3.Ix43epCm1SBxs3CX4jiqFLseEdNHM6Q06u8.', NULL, '2024-12-07 20:36:12', '2024-12-07 20:36:12', 'customer', 1, 0, 'avatar.png', 0, NULL, '3582072785'),
(322, 'Isobell Piquette', 'Isobell Piquette', 'sabrina.kienreich@gmail.com', NULL, '$2y$10$EqxA/UN97Xbs7ehxBNbLM.7qwKZhXlRE7PXD.x0XQLYPlQ..vy/JK', NULL, '2024-12-07 21:48:03', '2024-12-07 21:48:03', 'customer', 1, 0, 'avatar.png', 0, NULL, '+12794814621'),
(323, 'Nisreen Schrepel', 'Nisreen Schrepel', 'joerossi@cox.net', NULL, '$2y$10$FoPH5MifXuGGGsXvUf/KMefCtYnH0S65U4xNHfgis51.WWfU9RVHW', NULL, '2024-12-07 23:46:21', '2024-12-07 23:46:21', 'customer', 1, 0, 'avatar.png', 0, NULL, '+15056151320'),
(324, 'Sehaj Saha', 'Sehaj Saha', 'aaj716@hotmail.com', NULL, '$2y$10$v9xWIABKabwkr65gW8X9F.TrcoW2CZYxsAe5nKT/mnatfcMATFjMu', NULL, '2024-12-08 01:48:12', '2024-12-08 01:48:12', 'customer', 1, 0, 'avatar.png', 0, NULL, '+13054606918'),
(325, 'Charlesia Pardias', 'Charlesia Pardias', 'cgibson@rakalfas.com', NULL, '$2y$10$rI0VWrZ04chFqiO7LpHowORXjciexSw7tArvnT3RpIpwcWRWwXGIa', NULL, '2024-12-08 13:12:13', '2024-12-08 13:12:13', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302437736'),
(326, 'Reinholdt Andreyeva', 'Reinholdt Andreyeva', 'rynikka.94@gmail.com', NULL, '$2y$10$FfCKcb.hx1EA.isnFv/uiuhk18ovZIeXWoyk9cTbDtp9dOTwkiFXm', NULL, '2024-12-08 14:17:23', '2024-12-08 14:17:23', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306623196'),
(327, 'Shristi Floristean', 'Shristi Floristean', 'reiter.diedorf@arcor.de', NULL, '$2y$10$bDqq3E61TFVIKjWfZlFZ7.TnDd4GBfce/kfVLhxPzC0ob/4007RLO', NULL, '2024-12-08 15:37:19', '2024-12-08 15:37:19', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17302446529'),
(328, 'Armand Samber', 'Armand Samber', 'sundtaretrundt@outlook.com', NULL, '$2y$10$3iUDrhsXb60xVcIxTITVXeCzOUHEdk2AcjR7F3FsppPl0QZKGcmOi', NULL, '2024-12-08 18:50:05', '2024-12-08 18:50:05', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17716662371'),
(329, 'Johnathyn Alidou', 'Johnathyn Alidou', 'sarahwilliamsfuller@gmail.com', NULL, '$2y$10$GIyKus4U7.e/d.9s.T7fXeTHhAM3M0L6KAXk.yuzF4c6duugB0Ouy', NULL, '2024-12-08 22:11:13', '2024-12-08 22:11:13', 'customer', 1, 0, 'avatar.png', 0, NULL, '+17306659156'),
(330, 'Androw Waldman', 'Androw Waldman', 'joeypercival@aol.com', NULL, '$2y$10$CPz8Kl/6f0952EL0WE0Hl.iZCroNnaxtZ54LSakRauifSwrmbeYbm', NULL, '2024-12-09 00:20:55', '2024-12-09 00:20:55', 'customer', 1, 0, 'avatar.png', 0, NULL, '+14724290037'),
(331, 'Saivon Treston', 'Saivon Treston', 'info@hotelvillagiovanna.com', NULL, '$2y$10$VDPxxzt7pqfkTZyVlJSGl.5z2gAcbQNPBl9oMubkxT970cKtewXvW', NULL, '2024-12-09 01:14:15', '2024-12-09 01:14:15', 'customer', 1, 0, 'avatar.png', 0, NULL, '+16152216027'),
(332, 'Anabeatriz Stuhler', 'Anabeatriz Stuhler', 'pdenton405@gmail.com', NULL, '$2y$10$TpGh6IvL6g9GbMd4BV7oZO6bbceBMrBmjJRPj5M4DSyUfWtpJ91DG', NULL, '2024-12-09 10:25:44', '2024-12-09 10:25:44', 'customer', 1, 0, 'avatar.png', 0, NULL, '+19838191349');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bans_bannable_type_bannable_id_index` (`bannable_type`,`bannable_id`),
  ADD KEY `bans_created_by_type_created_by_id_index` (`created_by_type`,`created_by_id`),
  ADD KEY `bans_expired_at_index` (`expired_at`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catering_options`
--
ALTER TABLE `catering_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_reservation_reservation_id` (`reservation_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_ratings`
--
ALTER TABLE `menu_ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_id` (`menu_id`,`user_id`,`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_receiver_foreign` (`receiver`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_group`
--
ALTER TABLE `service_group`
  ADD KEY `service_group_package_id_foreign` (`package_id`),
  ADD KEY `service_group_service_id_foreign` (`service_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `catering_options`
--
ALTER TABLE `catering_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `menu_ratings`
--
ALTER TABLE `menu_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_reservation`
--
ALTER TABLE `inventory_reservation`
  ADD CONSTRAINT `fk_inventory_reservation_reservation_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_ratings`
--
ALTER TABLE `menu_ratings`
  ADD CONSTRAINT `menu_ratings_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_ratings_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
