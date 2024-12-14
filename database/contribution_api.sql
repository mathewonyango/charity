-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 12:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contribution_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('illuminate:queue:restart', 'i:1732478117;', 2047838117);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contributions`
--

CREATE TABLE `contributions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `goal_amount` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `organizer_name` varchar(255) NOT NULL,
  `organizer_contact` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `open` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contributions`
--

INSERT INTO `contributions` (`id`, `title`, `category`, `goal_amount`, `description`, `duration`, `organizer_name`, `organizer_contact`, `image`, `status`, `created_at`, `updated_at`, `user_id`, `open`) VALUES
(1, 'Building a mosque', 'Charity', 100000.00, 'This  will help build  the mosque in Isiolo', 40, 'Mathews', '0702622569', NULL, 'approved', '2024-11-20 20:25:18', '2024-11-23 07:57:47', 2, 1),
(2, 'Helping chidrens home', 'Charity', 10000.00, 'This will help the children home to buy food', 20, 'Abdi', '0709990009', NULL, 'approved', '2024-11-20 20:27:30', '2024-11-20 20:33:40', 2, 1),
(3, 'Raising Education Fees for Ahmed', 'Education Charity', 100000.00, 'This will help Ahmed raise funds for his education', 90, 'Abdi(Ahmed \'Brother)', '07088988484', NULL, 'approved', '2024-11-20 20:29:50', '2024-11-20 20:33:31', 2, 1),
(4, 'Raising Education Fees for Ahmed(edited)', 'Education Charity', 100000.00, 'This will help Ahmed raise funds for his education', 90, 'Abdi(Ahmed \'Brother) edited', 'mathewsagumbah@gmail.com', NULL, 'active', '2024-11-20 20:31:56', '2024-11-21 14:50:12', 2, 1),
(5, 'Annual Fundraising Gala', 'Charity', 100000.00, 'A charity gala to raise funds for local community development', 30, 'Mathews', '0702622569', NULL, 'approved', '2024-11-22 19:53:05', '2024-11-23 07:58:06', 2, 1),
(6, 'Contribution Title', 'Health', 1000.00, 'This is a very long description that can go on and on, including details about the contribution and its impact. You can add as much text as you want.', 20, 'John Doe', '123456789', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...', 'approved', '2024-11-22 20:16:15', '2024-11-22 21:48:03', 2, 1),
(7, 'Doing it for God', 'Health', 1000.00, 'This is a very long description that can go on and on, including details about the contribution and its impact. You can add as much text as you want.', 20, 'John Doe', '123456789', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...', 'approved', '2024-11-22 20:20:03', '2024-12-11 07:02:28', 2, 1),
(8, 'Doing it for God', 'Health', 1000.00, 'This is a very long description that can go on and on, including details about the contribution and its impact. You can add as much text as you want.', 20, 'John Doe', '123456789', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...', 'Ongoing', '2024-11-23 07:40:55', '2024-11-23 07:40:55', 2, 1),
(9, 'Abdi Wedding', 'Wedding', 100000.00, 'This is a very long description that can go on and on, including details about the contribution and its impact. You can add as much text as you want.', 20, 'John Doe', '123456789', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...', 'Ongoing', '2024-12-10 18:35:41', '2024-12-10 18:35:41', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `time` varchar(255) NOT NULL DEFAULT '00:00:00',
  `venue` varchar(255) NOT NULL,
  `map_link` varchar(255) DEFAULT NULL,
  `banner_image` longtext DEFAULT NULL,
  `organizer_name` varchar(255) NOT NULL DEFAULT 'Unknown Organizer',
  `status` varchar(255) NOT NULL DEFAULT 'Ongoing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `creator_id` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `organizer_contact_info` varchar(255) DEFAULT NULL,
  `event_coordinators` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`event_coordinators`)),
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `registration_deadline` date DEFAULT NULL,
  `event_capacity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `category`, `type`, `start_date`, `end_date`, `time`, `venue`, `map_link`, `banner_image`, `organizer_name`, `status`, `created_at`, `updated_at`, `creator_id`, `user_id`, `organizer_contact_info`, `event_coordinators`, `ticket_price`, `registration_deadline`, `event_capacity`) VALUES
(5, 'Ramadan Fundraising Dinner', 'A charity dinner to support underprivileged families during Ramadan.', 'Fundraising Dinner', 'In-person', '2024-12-01', '2024-12-01', '18:00:00', 'Nairobi Islamic Centre, Kenyatta Avenue, Nairobi', 'https://goo.gl/maps/examplelink', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAoAAAAHgCAYAAACykd/mAAA...', 'Kenyan Muslim Charity Foundation', 'Ongoing', '2024-11-22 19:04:41', '2024-11-22 19:04:41', 0, 3, NULL, NULL, NULL, NULL, NULL),
(6, 'Ramadan Fundraising Dinner', 'A charity dinner to support underprivileged families during Ramadan.', 'Fundraising Dinner', 'In-person', '2024-12-01', '2024-12-01', '18:00:00', 'Nairobi Islamic Centre, Kenyatta Avenue, Nairobi', 'https://goo.gl/maps/examplelink', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAoAAAAHgCAYAAACykd/mAAA...', 'Kenyan Muslim Charity Foundation', 'Ongoing', '2024-11-23 06:22:57', '2024-11-23 06:22:57', 0, 3, NULL, NULL, NULL, NULL, NULL),
(7, 'Tech Conference 2024', 'A comprehensive conference on the latest tech trends.', 'Technology', 'In-Person', '2024-12-10', '2024-12-12', '10:00 AM', 'TechSpace Auditorium, Nairobi', 'https://maps.google.com/?q=TechSpace+Auditorium', 'https://example.com/banner.jpg', 'TechSpace Team', 'Ongoing', '2024-11-23 08:38:07', '2024-11-23 08:38:07', 0, 3, '\"techspace@tech.com, +254712345678\"', '\"[\\\"John Doe\\\",\\\"Jane Smith\\\",\\\"Alice Johnson\\\"]\"', 5000.00, '2024-12-05', 500),
(8, 'Tech Conference 2024', 'A comprehensive conference on the latest tech trends.', 'Technology', 'In-Person', '2024-12-10', '2024-12-12', '10:00 AM', 'TechSpace Auditorium, Nairobi', 'https://maps.google.com/?q=TechSpace+Auditorium', 'https://example.com/banner.jpg', 'TechSpace Team', 'Ongoing', '2024-11-23 10:04:32', '2024-11-23 10:04:32', 0, 3, '\"techspace@tech.com, +254712345678\"', '\"[\\\"John Doe\\\",\\\"Jane Smith\\\",\\\"Alice Johnson\\\"]\"', 5000.00, '2024-12-05', 500),
(9, 'Tech Conference 2024', 'A comprehensive conference on the latest tech trends.', 'Technology', 'In-Person', '2024-12-10', '2024-12-12', '10:00 AM', 'TechSpace Auditorium, Nairobi', 'https://maps.google.com/?q=TechSpace+Auditorium', 'https://example.com/banner.jpg', 'TechSpace Team', 'Ongoing', '2024-11-24 15:41:43', '2024-11-24 15:41:43', 0, 3, '\"techspace@tech.com, +254712345678\"', '\"[\\\"John Doe\\\",\\\"Jane Smith\\\",\\\"Alice Johnson\\\"]\"', 5000.00, '2024-12-05', 500),
(10, 'Tech Conference 2024', 'A comprehensive conference on the latest tech trends.', 'Technology', 'In-Person', '2024-12-10', '2024-12-12', '10:00 AM', 'TechSpace Auditorium, Nairobi', 'https://maps.google.com/?q=TechSpace+Auditorium', 'https://example.com/banner.jpg', 'TechSpace Team', 'Ongoing', '2024-11-24 15:58:47', '2024-11-24 15:58:47', 0, 3, '\"techspace@tech.com, +254712345678\"', '\"[\\\"John Doe\\\",\\\"Jane Smith\\\",\\\"Alice Johnson\\\"]\"', 5000.00, '2024-12-05', 500);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_18_201654_create_contributions_table', 1),
(5, '2024_11_18_201655_create_events_table', 1),
(6, '2024_11_19_072537_add_role_to_users_table', 2),
(7, '2024_11_19_075217_create_otps_table', 2),
(8, '2024_11_19_084208_add_image_to_contributions_table', 2),
(9, '2024_11_19_084857_add_user_id_to_contributions_table', 2),
(10, '2024_11_19_205239_add_status_to_users_table', 2),
(11, '2024_11_20_093916_add_open_to_contributions_table', 2),
(12, '2024_11_21_103908_create_paystack_table', 3),
(13, '2024_11_22_185739_add_missing_fields_to_events_table', 3),
(14, '2024_11_22_203310_add_foreign_keys_to_paystack_table', 4),
(15, '2024_11_22_210443_add_user_id_to_paystack_table', 5),
(16, '2024_11_23_083348_add_event_details_to_events_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `otp` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `user_id`, `otp`, `expires_at`, `validated`, `created_at`, `updated_at`) VALUES
(1, 2, '669597', '2024-11-20 22:16:09', 1, '2024-11-20 22:14:44', '2024-11-20 22:16:09'),
(2, 2, '656748', '2024-11-21 18:53:38', 1, '2024-11-21 18:52:20', '2024-11-21 18:53:38'),
(3, 7, '120516', '2024-11-21 19:01:47', 0, '2024-11-21 18:56:47', '2024-11-21 18:56:47'),
(4, 2, '647493', '2024-11-22 13:52:21', 0, '2024-11-22 13:47:22', '2024-11-22 13:47:22'),
(5, 7, '186738', '2024-11-22 18:19:37', 1, '2024-11-22 18:17:49', '2024-11-22 18:19:37'),
(6, 9, '539668', '2024-11-23 05:18:05', 0, '2024-11-23 05:13:05', '2024-11-23 05:13:05'),
(7, 9, '416290', '2024-11-23 05:28:55', 0, '2024-11-23 05:23:55', '2024-11-23 05:23:55'),
(8, 7, '764641', '2024-11-23 05:37:02', 0, '2024-11-23 05:32:02', '2024-11-23 05:32:02'),
(9, 7, '917164', '2024-11-23 05:46:28', 0, '2024-11-23 05:41:28', '2024-11-23 05:41:28'),
(10, 9, '685234', '2024-11-23 05:52:11', 0, '2024-11-23 05:47:11', '2024-11-23 05:47:11'),
(11, 7, '782767', '2024-11-23 05:54:36', 1, '2024-11-23 05:54:12', '2024-11-23 05:54:36'),
(12, 7, '911540', '2024-11-23 06:04:04', 0, '2024-11-23 05:59:04', '2024-11-23 05:59:04'),
(13, 7, '498477', '2024-11-23 06:04:35', 1, '2024-11-23 06:04:15', '2024-11-23 06:04:35'),
(14, 7, '852294', '2024-11-23 06:16:51', 1, '2024-11-23 06:14:35', '2024-11-23 06:16:51'),
(15, 9, '244383', '2024-11-23 06:19:21', 1, '2024-11-23 06:18:26', '2024-11-23 06:19:21'),
(16, 7, '214933', '2024-11-23 06:18:46', 1, '2024-11-23 06:18:33', '2024-11-23 06:18:46'),
(17, 7, '553574', '2024-11-23 06:28:54', 0, '2024-11-23 06:23:54', '2024-11-23 06:23:54'),
(18, 9, '555121', '2024-11-23 06:52:11', 1, '2024-11-23 06:51:47', '2024-11-23 06:52:11'),
(19, 9, '502029', '2024-11-23 07:30:17', 1, '2024-11-23 07:29:21', '2024-11-23 07:30:17'),
(20, 9, '878625', '2024-11-23 07:38:48', 1, '2024-11-23 07:38:22', '2024-11-23 07:38:48'),
(21, 9, '766125', '2024-11-23 07:48:20', 1, '2024-11-23 07:47:47', '2024-11-23 07:48:20'),
(22, 9, '559971', '2024-11-23 08:46:48', 1, '2024-11-23 08:46:23', '2024-11-23 08:46:48'),
(23, 9, '292828', '2024-11-23 09:57:22', 1, '2024-11-23 09:56:58', '2024-11-23 09:57:22'),
(24, 9, '487045', '2024-11-24 07:42:10', 1, '2024-11-24 07:41:26', '2024-11-24 07:42:10'),
(25, 9, '863081', '2024-11-24 14:22:07', 1, '2024-11-24 14:21:10', '2024-11-24 14:22:07'),
(26, 9, '372070', '2024-12-09 07:19:38', 1, '2024-12-09 07:19:03', '2024-12-09 07:19:38'),
(27, 9, '767107', '2024-12-09 08:28:00', 1, '2024-12-09 08:27:27', '2024-12-09 08:28:00'),
(28, 9, '135558', '2024-12-09 09:44:49', 1, '2024-12-09 09:43:34', '2024-12-09 09:44:49'),
(29, 9, '629396', '2024-12-10 07:31:35', 1, '2024-12-10 07:30:57', '2024-12-10 07:31:35'),
(30, 9, '455253', '2024-12-10 08:04:16', 1, '2024-12-10 08:03:42', '2024-12-10 08:04:16'),
(31, 9, '177767', '2024-12-10 08:38:24', 1, '2024-12-10 08:38:01', '2024-12-10 08:38:24'),
(32, 9, '913231', '2024-12-10 10:36:25', 1, '2024-12-10 10:35:42', '2024-12-10 10:36:25'),
(33, 9, '504954', '2024-12-10 18:20:37', 1, '2024-12-10 18:20:04', '2024-12-10 18:20:37'),
(34, 9, '954250', '2024-12-11 07:30:18', 1, '2024-12-11 07:29:41', '2024-12-11 07:30:18'),
(35, 9, '456965', '2024-12-11 07:39:40', 1, '2024-12-11 07:39:09', '2024-12-11 07:39:40'),
(36, 9, '180802', '2024-12-11 07:44:57', 1, '2024-12-11 07:44:34', '2024-12-11 07:44:57'),
(37, 9, '870239', '2024-12-11 07:50:10', 1, '2024-12-11 07:49:42', '2024-12-11 07:50:10'),
(38, 9, '284916', '2024-12-11 07:53:14', 1, '2024-12-11 07:52:48', '2024-12-11 07:53:14'),
(39, 9, '242264', '2024-12-11 07:55:59', 1, '2024-12-11 07:55:39', '2024-12-11 07:55:59'),
(40, 9, '176849', '2024-12-11 08:04:36', 1, '2024-12-11 08:03:53', '2024-12-11 08:04:36'),
(41, 9, '887879', '2024-12-11 08:07:29', 1, '2024-12-11 08:07:01', '2024-12-11 08:07:29'),
(42, 9, '622705', '2024-12-11 08:11:09', 1, '2024-12-11 08:10:45', '2024-12-11 08:11:09'),
(43, 9, '386748', '2024-12-11 08:47:15', 1, '2024-12-11 08:46:54', '2024-12-11 08:47:15'),
(44, 9, '942303', '2024-12-11 08:49:00', 1, '2024-12-11 08:48:36', '2024-12-11 08:49:00'),
(45, 9, '340998', '2024-12-11 08:53:07', 1, '2024-12-11 08:52:46', '2024-12-11 08:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paystack`
--

CREATE TABLE `paystack` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `metadata` text DEFAULT NULL,
  `contribution_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paystack`
--

INSERT INTO `paystack` (`id`, `user_id`, `email`, `order_id`, `amount`, `quantity`, `currency`, `reference`, `metadata`, `contribution_id`, `event_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'mathewsagumbah@gmail.com.com', '5', 1500, 1, 'USD', 'SQEHJJJHJKE', '\"{\\\"notes\\\": \\\"VIP ticket\\\"}\"', NULL, 5, 'pending', '2024-11-22 21:30:38', '2024-11-22 21:30:38'),
(2, 3, 'mathewsagumbah@gmail.com', '2', 5000, 1, 'USD', 'GHHEHHEHEHEHEKL', '\"{\\\"purpose\\\": \\\"Fundraiser donation\\\"}\"', 2, NULL, 'pending', '2024-11-22 21:37:49', '2024-11-22 21:37:49'),
(3, 3, 'mathewsagumbah@gmail.com.com', '5', 1500, 1, 'USD', 'SQEHJJJHJKED', '\"{\\\"notes\\\": \\\"VIP ticket\\\"}\"', NULL, 5, 'pending', '2024-11-23 06:25:19', '2024-11-23 06:25:19'),
(4, 3, 'mathewsagumbah@gmail.com', '2', 5000, 1, 'USD', 'GHHEHHEHEHEHKL', '\"{\\\"purpose\\\": \\\"Fundraiser donation\\\"}\"', 2, NULL, 'pending', '2024-11-23 06:28:47', '2024-11-23 06:28:47'),
(5, 3, 'mathewsagumbah@gmail.com', '2', 5000, 1, 'USD', 'GHHEHHEHEHEHKJL', '\"{\\\"purpose\\\": \\\"Fundraiser donation\\\"}\"', 2, NULL, 'pending', '2024-11-23 06:35:08', '2024-11-23 06:35:08'),
(6, 3, 'mathewsagumbah@gmail.com.com', '5', 1500, 1, 'USD', 'SQEHJJJHJKEDG', '\"{\\\"notes\\\": \\\"VIP ticket\\\"}\"', NULL, 5, 'pending', '2024-11-23 06:40:32', '2024-11-23 06:40:32'),
(7, 3, 'mathewsagumbah@gmail.com', '2', 5000, 1, 'USD', 'GHHEHHEHEHEHEK', '\"{\\\"purpose\\\": \\\"Fundraiser donation\\\"}\"', 2, NULL, 'pending', '2024-12-10 20:33:29', '2024-12-10 20:33:29'),
(8, 3, 'mathewsagumbah@gmail.com.com', '5', 1500, 1, 'USD', 'SQEHJJJHJK', '\"{\\\"notes\\\": \\\"VIP ticket\\\"}\"', NULL, 5, 'pending', '2024-12-10 20:33:48', '2024-12-10 20:33:48');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6aaa74H48sIjeeeLN3sPtfYoqD78jdwTsLiYHFqq', NULL, '105.27.239.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibEg1RVl1ODFiTmpLb0dXOTRQWVlqTDBJR1BldEhEQVVEbXZacDM2diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly81MS4yMC4xNDQuMTc4OjUwMDAvY29uc29sZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734168047),
('j1qapO3ShllNZgELEwwSkGUDKGp9gBNbuE7PtVj6', NULL, '64.62.197.235', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.85 Safari/537.36 OPR/80.0.4170.72', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT2VETjQ4VU82akdTVWxIQVVPMUtIaDZiaHA0cTRuSmZhMkM5bGQzeCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNToiaHR0cDovLzUxLjIwLjE0NC4xNzg6NTAwMCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vNTEuMjAuMTQ0LjE3ODo1MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734172119),
('MI8bAPZWCHZpB87F3bgQCjfeMfSy9ZwAow4Q8EjC', NULL, '64.62.197.235', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.85 Safari/537.36 OPR/80.0.4170.72', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmFVU3RER3RNNVlTQWFYVWRPV0E0SE5WMmJhUkxJejFFU2JmaUxJRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly81MS4yMC4xNDQuMTc4OjUwMDAvbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1734172122),
('pL5aAt497Qb4JsNeIUJVpHSMAVW3TtdgorNVwKml', NULL, '64.62.197.230', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:124.0) Gecko/20100101 Firefox/124.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUnJJaXl4N1ExcjU3TnhOSWpUVFExekRKUHROM2dLVkIzbjE3NkZiZiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNToiaHR0cDovLzUxLjIwLjE0NC4xNzg6NTAwMCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI1OiJodHRwOi8vNTEuMjAuMTQ0LjE3ODo1MDAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734172117);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_number`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(2, '0700000000', 'mathewsagumbah@gmail.com', '$2y$12$kO8H.tdVrNs8G4S163ctkOfqvJ.V.kWII7FyHgnRkG2QWKT0fNBI.', 'admin', 'active', '2024-11-19 07:30:36', '2024-11-22 18:30:22'),
(3, '070000000', 'mathewsagumbahT@gmail.com', '$2y$12$J5fHMKm/HIh7t0l6SRF.duHl/UVOeH353wKEwddeIut7vJKaMWX52', 'admin', 'active', '2024-11-19 09:29:11', '2024-11-20 19:12:20'),
(4, '07234567890', 'onmathews@student.maseno.ac.ke', '$2y$12$meQ5W4PXFRHPr0ON/Pvty.Exv7Pp66i/MmX5pchLJdyHaR/eA3Nyu', 'admin', 'inactive', '2024-11-19 21:42:38', '2024-11-20 21:24:41'),
(5, '07000000', 'mathewsagumbahTest@gmail.com', '$2y$12$1lQCBXy/ZVhijldTYBbXd.SCIsJP18t5RWl1wYMoNSeZnLqTMSv6y', 'user', 'active', '2024-11-20 22:06:41', '2024-11-20 22:06:41'),
(6, '0700000', 'mathewsagumbahTT@gmail.com', '$2y$12$cCmj9/vtmBTYUcn.8h/5YeMXHrxvsUQpo0Ko86QZhdm4cvyScrYgW', 'moderator', 'active', '2024-11-20 22:08:42', '2024-11-23 20:39:50'),
(7, '0716457890', 'karenagumbah@gmail.com', '$2y$12$rwZVIp/0MbyRkiB9dY55f./Gmug2BHloigS2Nr3omCqmPd2I0YcC2', 'user', 'active', '2024-11-21 18:55:14', '2024-11-21 18:55:14'),
(8, '0716457834', 'karenagumbahtwo@gmail.com', '$2y$12$FRQE8PZ1OyKYoyHdYK7S9ux36TAzjy9fZR5pJ184W0lYNC.Fg/2qm', 'user', 'active', '2024-11-22 18:13:08', '2024-11-22 18:13:08'),
(9, '0757568616', '27870abdirahmanabdidict19s@gmail.com', '$2y$12$r5Huuzf8i16Vr4vdDaWf9ep0mAMoPO0EON3mYur/flgWossu2h35a', 'admin', 'active', '2024-11-23 05:03:46', '2024-11-23 20:39:01'),
(10, '0747568616', '27870abdirahmanabdidict@gmail.com', '$2y$12$l2H8dK658gfbaiRpc1PoPenul6ybIwYiX.gaIHzjOMIr47PQ55WcC', 'user', 'active', '2024-11-23 05:05:52', '2024-11-23 05:05:52'),
(11, '0716564088', 'abdikoricha@gmail.com', '$2y$12$VFoWW5u/ijDJIS5xSHMbh.XRhWJ8jF9bVoFTSRVGcKzjfP.gKVlEW', 'user', 'active', '2024-11-24 07:10:31', '2024-11-24 07:10:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `contributions`
--
ALTER TABLE `contributions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contributions_user_id_foreign` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paystack`
--
ALTER TABLE `paystack`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paystack_contribution_id_foreign` (`contribution_id`),
  ADD KEY `paystack_event_id_foreign` (`event_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contributions`
--
ALTER TABLE `contributions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `paystack`
--
ALTER TABLE `paystack`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributions`
--
ALTER TABLE `contributions`
  ADD CONSTRAINT `contributions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paystack`
--
ALTER TABLE `paystack`
  ADD CONSTRAINT `paystack_contribution_id_foreign` FOREIGN KEY (`contribution_id`) REFERENCES `contributions` (`id`),
  ADD CONSTRAINT `paystack_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
