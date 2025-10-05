-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 05, 2025 at 02:58 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_maintenance`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `action`, `module`, `description`, `ip_address`, `user_agent`, `created_at`) VALUES
(113, 1, 'assign', 'PIC Assets', 'Memberikan asset sjokdnsof ke pegawai Pandu Suryat', '10.62.8.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 09:52:45'),
(114, 1, 'release', 'PIC Assets', 'Melepaskan asset sjokdnsof dari pegawai Pandu Suryat', '10.62.8.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 09:52:55'),
(115, 1, 'assign', 'PIC Assets', 'Memberikan asset sjokdnsof ke pegawai Pandu Suryat', '10.62.8.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 09:53:03'),
(116, 1, 'delete', 'Asset', 'Menghapus asset: sjokdnsof', '10.62.8.248', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 09:53:29'),
(117, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS S330FA dari pegawai Kamil', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 10:00:38'),
(118, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS S330FA ke pegawai Kamil', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 10:01:07'),
(119, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS S330FA dari pegawai Kamil', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 10:09:49'),
(120, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS A416JAO dari pegawai Super Admin', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 10:09:56'),
(121, 1, 'create', 'Maintenance', 'Menambahkan maintenance untuk asset: LENOVO IP330 milik Indra (Kendala: hardisk rusak)', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-09 10:13:36'),
(122, 1, 'create', 'Asset', 'Menambahkan asset: HP 14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-10 03:11:10'),
(123, 1, 'update', 'Asset', 'Mengubah asset ID: 10', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-10 04:04:22'),
(124, 1, 'create', 'Asset', 'Menambahkan asset: ASUS', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-10 04:16:50'),
(125, 1, 'release', 'PIC Assets', 'Melepaskan asset LENOVO IP330 dari pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-10 06:41:06'),
(126, 1, 'create', 'Kategori', 'Menambahkan kategori: PRINTER', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-10 09:01:00'),
(127, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A416JAO ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-11 01:57:17'),
(128, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A416JAO ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-11 01:57:17'),
(129, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-14 04:41:26'),
(130, 1, 'create', 'Maintenance', 'Menambahkan maintenance untuk asset: ASUS milik Kamil (Kendala: Batterai rusak)', '172.10.48.222', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', '2025-09-14 05:02:35'),
(131, 1, 'create', 'Maintenance', 'Menambahkan maintenance untuk asset: ASUS A416JAO milik Super Admin (Kendala: Layar Backlight)', '10.130.202.242', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-09-14 05:11:41'),
(132, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Pandu Suryat', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-15 09:46:57'),
(133, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14 dari pegawai Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:22:52'),
(134, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:00'),
(135, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:02'),
(136, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:03'),
(137, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:05'),
(138, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:06'),
(139, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:07'),
(140, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:08'),
(141, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:23:09'),
(142, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS A409F dari pegawai SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:25:09'),
(143, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS dari pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:25:11'),
(144, 1, 'release', 'PIC Assets', 'Melepaskan asset LENOVO IP330 dari pegawai Pandu Suryat', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:25:13'),
(145, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14-S ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:29:14'),
(146, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:29:23'),
(147, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:29:25'),
(148, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14-S ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:30:11'),
(149, 1, 'assign', 'PIC Assets', 'Memberikan asset ACER SWIFT 5 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:30:22'),
(150, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:30:38'),
(151, 1, 'release', 'PIC Assets', 'Melepaskan asset ASUS dari pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:43:53'),
(152, 1, 'release', 'PIC Assets', 'Melepaskan asset ACER SWIFT 5 dari pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:43:55'),
(153, 1, 'release', 'PIC Assets', 'Melepaskan asset HP 14-S dari pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:43:56'),
(154, 1, 'release', 'PIC Assets', 'Melepas asset: 21 dari pegawai: 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 04:55:33'),
(155, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:16'),
(156, 1, 'release', 'PIC Assets', 'Melepas asset: 20 dari pegawai: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:20'),
(157, 1, 'release', 'PIC Assets', 'Melepas asset: 20 dari pegawai: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:22'),
(158, 1, 'release', 'PIC Assets', 'Melepas asset: 20 dari pegawai: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:24'),
(159, 1, 'release', 'PIC Assets', 'Melepas asset: 18 dari pegawai: 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:26'),
(160, 1, 'release', 'PIC Assets', 'Melepas asset: 22 dari pegawai: 6', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:27'),
(161, 1, 'release', 'PIC Assets', 'Melepas asset: 21 dari pegawai: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:29'),
(162, 1, 'release', 'PIC Assets', 'Melepas asset: 21 dari pegawai: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:39:30'),
(163, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 06:52:10'),
(164, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14-S ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:33:22'),
(165, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:36:51'),
(166, 1, 'assign', 'PIC Assets', 'Memberikan asset ACER SWIFT 5 ke pegawai Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:38:07'),
(167, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:39:27'),
(168, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:39:58'),
(169, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A409F ke pegawai LOPO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:40:22'),
(170, 1, 'assign', 'PIC Assets', 'Memberikan asset PRINTER CANON G2020 ke pegawai Super Admin', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:40:32'),
(171, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:47:27'),
(172, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:56:40'),
(173, 1, 'release', 'PIC Assets', 'Melepas asset: 23 dari pegawai: 7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:59:38'),
(174, 1, 'release', 'PIC Assets', 'Melepas asset: 24 dari pegawai: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 08:59:40'),
(175, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:03:03'),
(176, 1, 'release', 'PIC Assets', 'Melepas asset: 24 dari pegawai: 4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:03:11'),
(177, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:03:28'),
(178, 1, 'release', 'PIC Assets', 'Melepas asset: 23 dari pegawai: 5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:04:09'),
(179, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:22:35'),
(180, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-16 09:31:42'),
(181, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:23:32'),
(182, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:23:37'),
(183, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:23:41'),
(184, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:42:03'),
(185, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:42:07'),
(186, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 03:52:47'),
(187, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:08:30'),
(188, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:33:13'),
(189, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:33:50'),
(190, 1, 'release', 'PIC Assets', 'Melepas asset: LENOVO IP330 dari pegawai: Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:33:57'),
(191, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:47:18'),
(192, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 04:51:38'),
(193, NULL, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Pandu Suryat', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 08:34:49'),
(194, NULL, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: Pandu Suryat', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-17 08:35:22'),
(195, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-18 08:52:08'),
(196, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:29:15'),
(197, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:38:19'),
(198, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A409F ke pegawai Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:39:00'),
(199, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS A409F dari pegawai: Indra', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 02:39:52'),
(200, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A409F ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 03:01:14'),
(201, 1, 'assign', 'PIC Assets', 'Memberikan asset LENOVO IP330 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-22 03:01:26'),
(202, 1, 'create', 'Kategori', 'Menambahkan kategori: ASSET MATI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-25 22:19:32'),
(203, 1, 'create', 'Kategori', 'Menambahkan kategori: asset rusak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-25 22:19:59'),
(204, 1, 'delete', 'Kategori', 'Menghapus kategori: asset rusak', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-25 22:20:54'),
(205, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A416JAO ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:14:02'),
(206, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A416JAO ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:14:03'),
(207, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS A416JAO dari pegawai: SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:14:17'),
(208, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS A416JAO dari pegawai: SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:14:23'),
(209, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:14:38'),
(210, 1, 'release', 'PIC Assets', 'Melepas asset: HP 14 dari pegawai: Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:15:02'),
(211, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS A416JAO ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:15:24'),
(212, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:15:35'),
(213, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 10:53:26'),
(214, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai LOPO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 11:33:18'),
(215, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 13:35:17'),
(216, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 14:49:53'),
(217, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 14:50:04'),
(218, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai BAMBANG SETYO BUDI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 14:50:23'),
(219, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai NENGSIH INDRAYANI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 15:01:42'),
(220, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai IRFAN AR RIZAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 15:17:41'),
(221, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai MUHAMMAD REZA DEDATGRAF', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 15:31:10'),
(222, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai QIDAM RAFI ABIRAMA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 15:34:58'),
(223, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai BAMBANG SETYO BUDI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 15:50:09'),
(224, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai RIANSYAH', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 16:12:17'),
(225, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai BAMBANG SETYO BUDI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 16:19:36'),
(226, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai ABDUL MANAF', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 16:31:28'),
(227, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai ABDUL MAJID', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 16:47:04'),
(228, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai DEWANTORO SUKO WIJOYO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 16:54:09'),
(229, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai HANSPARTA NABABAN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 20:18:44'),
(230, 1, 'assign', 'PIC Assets', 'Memberikan asset HP 14 ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 21:19:36'),
(231, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: HANSPARTA NABABAN', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-29 22:25:55'),
(232, 1, 'create', 'Kategori', 'Menambahkan kategori: TEST', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-30 10:44:51'),
(233, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai SATRIO', '10.62.8.198', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-09-30 16:50:34'),
(234, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai ABDUL MANAF', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 10:16:47'),
(235, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai ELVIRA ENGITA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 10:17:56'),
(236, 1, 'release', 'PIC Assets', 'Melepas asset: HP dari pegawai: ABDUL MANAF', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 10:20:53'),
(237, 1, 'release', 'PIC Assets', 'Melepas asset: HP dari pegawai: ELVIRA ENGITA', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 10:21:17'),
(238, 1, 'release', 'PIC Assets', 'Melepas asset: HP dari pegawai: SATRIO', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-01 10:39:21'),
(239, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Kamil', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 11:44:18'),
(240, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 11:44:41'),
(241, 1, 'release', 'PIC Assets', 'Melepas asset: ASUS dari pegawai: Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 11:48:05'),
(242, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai Azizul', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 14:18:13'),
(243, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai SRI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 14:22:55'),
(244, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai DWI OKTA ERYANI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 15:08:54'),
(245, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai RUSAL', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', '2025-10-01 15:19:12'),
(246, 1, 'assign', 'PIC Assets', 'Memberikan asset ASUS ke pegawai RIZKY YANWAR ASHARI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-02 11:14:40'),
(247, 1, 'assign', 'PIC Assets', 'Memberikan asset HP ke pegawai RIEZA NOFIANTI', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', '2025-10-02 11:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int UNSIGNED NOT NULL,
  `entitas_id` int UNSIGNED DEFAULT NULL,
  `nama_item` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_asset` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_ga` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spesifikasi` text COLLATE utf8mb4_general_ci,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('tersedia','terpakai','maintenance','rusak') COLLATE utf8mb4_general_ci DEFAULT 'tersedia',
  `kategori_id` int UNSIGNED NOT NULL,
  `kondisi_id` int UNSIGNED NOT NULL,
  `lokasi_id` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `entitas_id`, `nama_item`, `kode_asset`, `kode_ga`, `spesifikasi`, `foto`, `status`, `kategori_id`, `kondisi_id`, `lokasi_id`, `created_at`, `updated_at`) VALUES
(78, 1, 'LENOVO IP330', 'INK-00708', 'GA-0567', 'AMD A9 9425, 4GB, 1TB, 14\", DOS', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(79, 1, 'LENOVO IP330', 'INK-00717', 'GA-0569', 'AMD A9 9425, 4GB, 1TB, 14\", DOS', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(80, 1, 'LENOVO IP330', 'INK-00724', 'GA-0570', 'AMD A9 9425, 4GB, 1TB, 14\", DOS', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(81, 1, 'ASUS A409F', 'INK-00734', 'GA-0572', 'INTEL I7 8565U, 8GB, 1TB, 14\", NVIDIA MX230, Win 10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(82, 1, 'ASUS S330FA', 'INK-00733', 'GA-0571', 'INTEL I5 8265U, 4GB, 256GB SSD, 13\", Win 10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(83, 1, 'LENOVO IP330', 'INK-00553', 'GA-0573', 'Intel Celeron N4000, 4GB, 500GB,14\", Win10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(84, 1, 'LENOVO IP330', 'INK-00554', 'GA-0574', 'Intel Celeron N4000, 4GB, 500GB,14\", Win10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(85, 1, 'LENOVO THINKPAD', 'INK-00555', 'GA-0575', 'Intel I3 3rd Gen, 4GB, HDD, 14\" (second)', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(86, 1, 'HP 14-S', 'INK-00862', 'GA-0576', 'Intel I3 10110U, 8GB, 256 GB SSD, 14\", Win 10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(87, 1, 'ASUS A416JAO', 'INK-00863', 'GA-0577', 'Intel I5 1035G1, 4GB, 256 GB SSD, 14\", Win 10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(88, 1, 'ACER SWIFT 5', 'INK-00890', 'GA-0579', 'Intel I3 10110U, 4GB, 256 GB SSD, 14\", Win 10', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(89, 1, 'HP', 'INK-00885', 'GA-0578', 'INTEL I3, 4GB, 15.6\", SSD', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(90, 1, 'HP 14', 'INK-00948', 'GA-0580', 'INTEL I3 N305, 8GB, 14\" SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(91, 1, 'HP 14', 'INK-00949', 'GA-0581', 'INTEL I3 N305, 8GB, 14\" SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(92, 1, 'HP 14', 'INK-00950', 'GA-0582', 'INTEL I3 N305, 8GB, 14\" SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(93, 1, 'HP 14', 'INK-00951', 'GA-0583', 'INTEL I3 N305, 8GB, 14\" SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(94, 1, 'ASUS', 'INK-00955', 'GA-0604', 'INTEL I3 11, 8GB, 15.6\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(95, 1, 'ASUS', 'INK-00956', 'GA-0605', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(96, 1, 'ASUS', 'INK-00957', 'GA-0606', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(97, 1, 'ASUS', 'INK-00958', 'GA-0607', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(98, 1, 'ASUS', 'INK-00959', 'GA-0608', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(99, 1, 'ASUS', 'INK-00960', 'GA-0609', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(100, 1, 'ASUS', 'INK-00961', 'GA-0610', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(101, 1, 'ASUS', 'INK-00962', 'GA-0611', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(102, 1, 'ASUS', 'INK-00963', 'GA-0612', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(103, 1, 'ASUS', 'INK-00964', 'GA-0613', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(104, 1, 'ASUS', 'INK-00965', 'GA-0614', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(105, 1, 'ASUS', 'INK-00966', 'GA-0615', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(106, 1, 'ASUS', 'INK-00967', 'GA-0616', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(107, 1, 'ASUS', 'INK-00968', 'GA-0617', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(108, 1, 'ASUS', 'INK-00969', 'GA-0618', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(109, 1, 'ASUS', 'INK-00970', 'GA-0619', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(110, 1, 'ASUS', 'INK-00971', 'GA-0620', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(111, 1, 'ASUS', 'INK-00972', 'GA-0621', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'maintenance', 1, 1, NULL, NULL, NULL),
(112, 1, 'ASUS', 'INK-00973', 'GA-0622', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(113, 1, 'HP', 'INK-01032', 'GA-0704', 'INTEL I5 11, 8GB, 14\", SSD 512GB', NULL, 'maintenance', 1, 1, NULL, NULL, NULL),
(114, 1, 'ACER', '', 'GA-0706', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(115, 1, 'HP', 'INK-01044', 'GA-0707', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(116, 1, 'HP', 'INK-01045', 'GA-0708', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(117, 1, 'HP', 'INK-01046', 'GA-0709', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(118, 1, 'HP', 'INK-01047', 'GA-0710', 'INTEL I3 11, 8GB, 14\", SSD 512GB', NULL, 'tersedia', 1, 1, NULL, NULL, NULL),
(119, 1, 'HP', 'INK-01051', 'GA-0721', 'INTEL I3 12, 8GB, 14\", SSD 512GB', NULL, 'maintenance', 1, 1, NULL, NULL, NULL),
(120, 1, 'HP', 'INK-01052', 'GA-0722', 'INTEL I3 12, 8GB, 14\", SSD 512GB', NULL, 'terpakai', 1, 1, NULL, NULL, NULL),
(121, 1, 'HP', 'INK-01062', 'GA-0726', 'INTEL I3 12, 8GB, 14\", SSD 512GB', NULL, 'maintenance', 1, 1, NULL, NULL, NULL),
(122, 1, 'ASUS', 'INK-01084', 'GA-0786', 'AMD RYZEN 3 GEN7', NULL, 'maintenance', 1, 1, NULL, NULL, NULL),
(123, 1, 'ASUS', 'INK-01078', 'GA-0780', 'INTEL I3 13, 8GB+8GB, 512GB, 14\"', NULL, 'terpakai', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asset_lokasi`
--

CREATE TABLE `asset_lokasi` (
  `id` int UNSIGNED NOT NULL,
  `asset_id` int UNSIGNED NOT NULL,
  `lokasi_id` int UNSIGNED NOT NULL,
  `assigned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `released_at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id` int UNSIGNED NOT NULL,
  `pic_asset_id` int UNSIGNED NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipe` enum('penyerahan','pengembalian') NOT NULL DEFAULT 'penyerahan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita_acara`
--

INSERT INTO `berita_acara` (`id`, `pic_asset_id`, `filename`, `created_at`, `tipe`) VALUES
(70, 108, 'berita_acara_108_1759293858.docx', '2025-10-01 04:44:18', 'penyerahan'),
(71, 109, 'berita_acara_109_1759293881.docx', '2025-10-01 04:44:41', 'penyerahan'),
(72, 109, 'berita_acara_pengembalian_109_1759294085.docx', '2025-10-01 04:48:05', 'penyerahan'),
(73, 110, 'berita_acara_110_1759303093.docx', '2025-10-01 07:18:13', 'penyerahan'),
(74, 111, 'berita_acara_111_1759303375.docx', '2025-10-01 07:22:55', 'penyerahan'),
(75, 112, 'berita_acara_112_1759306134.docx', '2025-10-01 08:08:54', 'penyerahan'),
(76, 113, 'berita_acara_113_1759306752.docx', '2025-10-01 08:19:12', 'penyerahan'),
(77, 114, 'berita_acara_114_1759378480.docx', '2025-10-02 04:14:40', 'penyerahan'),
(78, 115, 'berita_acara_115_1759379316.docx', '2025-10-02 04:28:36', 'penyerahan');

-- --------------------------------------------------------

--
-- Table structure for table `entitas`
--

CREATE TABLE `entitas` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `entitas`
--

INSERT INTO `entitas` (`id`, `kode`, `nama`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'MF', 'Mazta Farma', 'Entitas pusat', '2025-09-09 15:01:54', '2025-09-09 15:01:54'),
(2, 'MDI', 'Mazta Distribusi Indonesia', 'Cabang Jakarta', '2025-09-09 15:01:54', '2025-09-09 15:01:54'),
(3, 'KUN', 'Kreasi Untuk Negeri', 'HO', '2025-09-09 15:01:54', '2025-09-09 15:01:54'),
(4, 'MIK', 'Mazta Industri Kosmetik', 'Tenjo', '2025-09-09 15:01:54', '2025-09-09 15:01:54');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int UNSIGNED NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, 'LAPTOP', NULL, NULL),
(2, 'KOMPUTER', NULL, NULL),
(3, 'MONITOR', NULL, NULL),
(4, 'SEPEDA', NULL, NULL),
(5, 'MEJA', NULL, NULL),
(6, 'PROYEKTOR', NULL, NULL),
(7, 'KURSI', NULL, NULL),
(10, 'PRINTER', NULL, NULL),
(11, 'ASSET MATI', NULL, NULL),
(13, 'TEST', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` int UNSIGNED NOT NULL,
  `no_plat` varchar(20) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `status_kendaraan` enum('mazta','cop','rental') NOT NULL,
  `kunci_cadangan` enum('ada','tidak ada') DEFAULT 'tidak ada',
  `bpkb` enum('ada','tidak ada') DEFAULT 'tidak ada',
  `nomor_rangka` varchar(100) DEFAULT NULL,
  `nomor_mesin` varchar(100) DEFAULT NULL,
  `tahun_pembelian` year DEFAULT NULL,
  `stnk_jatuh_tempo` date DEFAULT NULL,
  `stnk_lima_tahunan` date DEFAULT NULL,
  `stnk_perpanjangan_berikutnya` date DEFAULT NULL,
  `nominal_bayar` decimal(15,2) DEFAULT NULL,
  `no_polis_asuransi` varchar(100) DEFAULT NULL,
  `asuransi_jatuh_tempo` date DEFAULT NULL,
  `asuransi_perpanjangan_berikutnya` date DEFAULT NULL,
  `nominal_perbayaran_asuransi` decimal(15,2) DEFAULT NULL,
  `entitas_id` int UNSIGNED DEFAULT NULL,
  `lokasi_id` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `no_plat`, `merk`, `status_kendaraan`, `kunci_cadangan`, `bpkb`, `nomor_rangka`, `nomor_mesin`, `tahun_pembelian`, `stnk_jatuh_tempo`, `stnk_lima_tahunan`, `stnk_perpanjangan_berikutnya`, `nominal_bayar`, `no_polis_asuransi`, `asuransi_jatuh_tempo`, `asuransi_perpanjangan_berikutnya`, `nominal_perbayaran_asuransi`, `entitas_id`, `lokasi_id`, `created_at`, `updated_at`) VALUES
(1, 'B 2801 BYS', 'XPANDER', 'mazta', 'ada', 'tidak ada', 'MK2NCWHARKJ000668', '4A91GM0336', 2019, '2026-03-12', '2029-03-12', '2026-01-15', '3881000.00', '00402230400001-003337', '2025-01-10', '2026-01-10', '4987178.00', 1, 5, '2025-09-15 04:30:11', '2025-09-15 04:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int UNSIGNED NOT NULL,
  `kondisi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`) VALUES
(1, 'Baik'),
(2, 'Tidak Baik'),
(3, 'Pemeriksaan IT'),
(4, 'Rusak');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int UNSIGNED NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `lokasi`) VALUES
(1, 'Lantai 2 Mazta Farma'),
(3, 'CABANG BALI'),
(4, 'HO MIK'),
(5, 'HO MDI'),
(6, 'HO MAZTA FARMA'),
(7, 'CABANG BANDUNG');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int UNSIGNED NOT NULL,
  `asset_id` int UNSIGNED NOT NULL,
  `pic_id` int UNSIGNED NOT NULL,
  `kendala` text,
  `status` enum('pending','in_progress','done') DEFAULT 'pending',
  `created_by` int UNSIGNED NOT NULL,
  `assigned_to` int UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` enum('low','medium','high') DEFAULT 'low',
  `due_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `asset_id`, `pic_id`, `kendala`, `status`, `created_by`, `assigned_to`, `created_at`, `updated_at`, `priority`, `due_date`) VALUES
(29, 122, 108, 'RUSAK BJIR', 'in_progress', 1, 4, '2025-10-01 11:56:09', '2025-10-01 13:48:35', 'low', NULL),
(30, 121, 110, 'BATERE', 'pending', 1, 4, '2025-10-01 14:18:42', '2025-10-01 14:18:42', 'low', NULL),
(31, 113, 112, 'RUSAK BJIRR\r\n', 'in_progress', 1, 4, '2025-10-01 15:09:29', '2025-10-02 09:33:41', 'low', NULL),
(32, 120, 113, 'LOKOKOKO', 'done', 1, 4, '2025-10-01 15:19:49', '2025-10-01 21:14:57', 'high', '2025-10-03 15:19:49'),
(33, 111, 114, 'LEMOT BETUL', 'in_progress', 1, 4, '2025-10-02 11:15:28', '2025-10-02 17:05:25', 'high', '2025-10-04 11:15:28'),
(34, 119, 115, 'ucack', 'pending', 1, 4, '2025-10-02 11:29:05', '2025-10-02 11:29:05', 'high', '2025-10-04 11:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_message`
--

CREATE TABLE `maintenance_message` (
  `id` int UNSIGNED NOT NULL,
  `maintenance_id` int UNSIGNED NOT NULL,
  `sender_id` int UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_progress`
--

CREATE TABLE `maintenance_progress` (
  `id` int UNSIGNED NOT NULL,
  `maintenance_id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT 'in_progress',
  `sender_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `maintenance_progress`
--

INSERT INTO `maintenance_progress` (`id`, `maintenance_id`, `user_id`, `deskripsi`, `foto`, `created_at`, `status`, `sender_id`) VALUES
(40, 31, 4, 'oKAY SUDAH DI TERIMA', NULL, '2025-10-01 08:09:49', 'in_progress', NULL),
(41, 32, 4, 'sudah di terima', NULL, '2025-10-01 08:48:31', 'in_progress', NULL),
(42, 32, 4, 'EH INI KENAPA YA', '1759310847_a1f83d82f96c0e91aa96.jpg', '2025-10-01 09:27:27', 'in_progress', NULL),
(43, 32, 4, 'DONE YAA', '1759327950_93e37e54a3e15b339199.jpg', '2025-10-01 14:12:30', 'in_progress', NULL),
(44, 32, 4, 'DONEYAAA', '1759328097_13d8504489d9bad0ff52.jpg', '2025-10-01 14:14:57', 'done', NULL),
(45, 31, 4, 'SEDANG DI PERBAIKIN ', NULL, '2025-10-02 02:33:41', 'in_progress', NULL),
(46, 33, 4, 'Oke sudah di terima', NULL, '2025-10-02 04:25:27', 'in_progress', NULL),
(47, 33, 4, 'EHHHHH', NULL, '2025-10-02 04:27:33', 'in_progress', NULL),
(48, 33, 4, 'TEST', NULL, '2025-10-02 09:20:07', 'in_progress', NULL),
(49, 33, 4, 'test2', NULL, '2025-10-02 09:51:07', 'in_progress', NULL),
(50, 33, 4, 'test2', NULL, '2025-10-02 09:54:31', 'in_progress', NULL),
(51, 33, 4, 'Test', NULL, '2025-10-02 10:05:25', 'in_progress', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int UNSIGNED NOT NULL,
  `maintenance_id` int UNSIGNED NOT NULL,
  `sender_id` int UNSIGNED NOT NULL,
  `sender_nama` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-08-20-073045', 'App\\Database\\Migrations\\CreatePegawaiTable', 'default', 'App', 1755675208, 1),
(2, '2025-08-20-073142', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1755675208, 1),
(3, '2025-08-20-084342', 'App\\Database\\Migrations\\CreateKategoriTable', 'default', 'App', 1755679472, 2),
(4, '2025-08-20-090103', 'App\\Database\\Migrations\\CreateKondisiTable', 'default', 'App', 1755680532, 3),
(6, '2025-08-20-090307', 'App\\Database\\Migrations\\CreateKondisiTable', 'default', 'App', 1755682095, 4),
(7, '2025-08-20-092312', 'App\\Database\\Migrations\\CreateItemsTable', 'default', 'App', 1755682095, 4),
(10, '2025-08-20-092849', 'App\\Database\\Migrations\\CreateItemsTable', 'default', 'App', 1756263331, 5),
(11, '2025-08-27-025227', 'App\\Database\\Migrations\\CreateActivitiesTable', 'default', 'App', 1756263331, 5),
(12, '2025-08-27-032108', 'App\\Database\\Migrations\\AddSpesifikasiStatusToAssets', 'default', 'App', 1756264903, 6),
(13, '2025-08-28-043240', 'App\\Database\\Migrations\\CreateMaintenanceTable', 'default', 'App', 1756355580, 7),
(14, '2025-09-01-040453', 'App\\Database\\Migrations\\CreateLokasiTable', 'default', 'App', 1756699690, 8),
(15, '2025-09-01-040453', 'App\\Database\\Migrations\\CreateAssetLokasiTable', 'default', 'App', 1756700853, 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `role`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'Anda mendapat tugas maintenance baru: #14', 0, '2025-09-29 06:35:44', NULL),
(2, 1, NULL, 'Progress tiket #13 telah diperbarui oleh teknisi.', 0, '2025-09-29 06:42:26', NULL),
(3, 1, NULL, 'Progress tiket #14 telah diperbarui oleh teknisi.', 0, '2025-09-29 07:40:03', NULL),
(4, 1, NULL, 'Progress tiket #14 telah diperbarui oleh teknisi.', 0, '2025-09-29 07:43:52', NULL),
(5, 1, NULL, 'Progress tiket #14 telah diperbarui oleh teknisi.', 0, '2025-09-29 07:44:37', NULL),
(6, 4, NULL, 'Anda mendapat tugas maintenance baru: #15', 0, '2025-09-29 07:50:56', NULL),
(7, 1, NULL, 'Progress tiket #15 telah diperbarui oleh teknisi.', 0, '2025-09-29 07:51:47', NULL),
(8, 1, NULL, 'Progress tiket #15 telah diperbarui oleh teknisi.', 0, '2025-09-29 07:52:53', NULL),
(9, 4, NULL, 'Anda mendapat tugas maintenance baru: #16', 0, '2025-09-29 08:02:04', NULL),
(10, 1, NULL, 'Progress tiket #16 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:02:39', NULL),
(11, 1, NULL, 'Progress tiket #16 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:03:12', NULL),
(12, 4, NULL, 'Anda mendapat tugas maintenance baru: #17', 0, '2025-09-29 08:18:21', NULL),
(13, 1, NULL, 'Progress tiket #17 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:18:57', NULL),
(14, 1, NULL, 'Progress tiket #17 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:20:07', NULL),
(15, 4, NULL, 'Anda mendapat tugas maintenance baru: #18', 0, '2025-09-29 08:31:43', NULL),
(16, 1, NULL, 'Progress tiket #18 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:32:15', NULL),
(17, 1, NULL, 'Progress tiket #18 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:33:33', NULL),
(18, 1, NULL, 'Progress tiket #18 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:33:54', NULL),
(19, 4, NULL, 'Anda mendapat tugas maintenance baru: #19', 0, '2025-09-29 08:35:53', NULL),
(20, 1, NULL, 'Progress tiket #19 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:36:16', NULL),
(21, 1, NULL, 'Progress tiket #19 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:36:36', NULL),
(22, 4, NULL, 'Anda mendapat tugas maintenance baru: #20', 0, '2025-09-29 08:51:36', NULL),
(23, 1, NULL, 'Progress tiket #20 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:52:23', NULL),
(24, 1, NULL, 'Progress tiket #20 telah diperbarui oleh teknisi.', 0, '2025-09-29 08:52:49', NULL),
(25, 4, NULL, 'Anda mendapat tugas maintenance baru: #21', 0, '2025-09-29 09:13:23', NULL),
(26, 1, NULL, 'Progress tiket #21 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:13:40', NULL),
(27, 1, NULL, 'Progress tiket #21 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:15:21', NULL),
(28, 4, NULL, 'Anda mendapat tugas maintenance baru: #22', 0, '2025-09-29 09:20:10', NULL),
(29, 1, NULL, 'Progress tiket #22 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:20:41', NULL),
(30, 1, NULL, 'Progress tiket #22 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:21:03', NULL),
(31, 4, NULL, 'Anda mendapat tugas maintenance baru: #23', 0, '2025-09-29 09:31:51', NULL),
(32, 1, NULL, 'Progress tiket #23 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:33:01', NULL),
(33, 1, NULL, 'Progress tiket #23 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:33:20', NULL),
(34, 4, NULL, 'Anda mendapat tugas maintenance baru: #24', 0, '2025-09-29 09:48:04', NULL),
(35, 1, NULL, 'Progress tiket #24 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:48:17', NULL),
(36, 1, NULL, 'Progress tiket #24 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:48:37', NULL),
(37, 4, NULL, 'Anda mendapat tugas maintenance baru: #25', 0, '2025-09-29 09:54:31', NULL),
(38, 1, NULL, 'Progress tiket #25 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:55:04', NULL),
(39, 1, NULL, 'Progress tiket #25 telah diperbarui oleh teknisi.', 0, '2025-09-29 09:55:40', NULL),
(40, 4, NULL, 'Anda mendapat tugas maintenance baru: #26', 0, '2025-09-29 13:37:24', NULL),
(41, 1, NULL, 'Progress tiket #26 telah diperbarui oleh teknisi.', 0, '2025-09-29 13:46:31', NULL),
(42, 1, NULL, 'Progress tiket #26 telah diperbarui oleh teknisi.', 0, '2025-09-29 14:00:08', NULL),
(43, 1, NULL, 'Progress tiket #26 telah diperbarui oleh teknisi.', 0, '2025-09-29 14:02:17', NULL),
(44, 4, NULL, 'Anda mendapat tugas maintenance baru: #27', 0, '2025-09-29 14:27:29', NULL),
(45, 1, NULL, 'Progress tiket #27 telah diperbarui oleh teknisi.', 0, '2025-09-29 14:28:00', NULL),
(46, 1, NULL, 'Progress tiket #27 telah diperbarui oleh teknisi.', 0, '2025-09-29 15:15:17', NULL),
(47, 4, NULL, 'Anda mendapat tugas maintenance baru: #28', 0, '2025-09-30 09:42:05', NULL),
(48, 1, NULL, 'Progress tiket #28 telah diperbarui oleh teknisi.', 0, '2025-09-30 09:43:03', NULL),
(49, 1, NULL, 'Progress tiket #28 telah diperbarui oleh teknisi.', 0, '2025-09-30 09:44:39', NULL),
(50, 4, NULL, 'Anda mendapat tugas maintenance baru: #29', 0, '2025-10-01 04:56:09', NULL),
(51, 4, NULL, 'Anda mendapat tugas maintenance baru: #30', 0, '2025-10-01 07:18:42', NULL),
(52, 4, NULL, 'Anda mendapat tugas maintenance baru: #31', 0, '2025-10-01 08:09:29', NULL),
(53, 1, NULL, 'Progress tiket #31 telah diperbarui oleh teknisi.', 0, '2025-10-01 08:09:49', NULL),
(54, 4, NULL, 'Anda mendapat tugas maintenance baru: #32', 0, '2025-10-01 08:19:49', NULL),
(55, 1, NULL, 'Progress tiket #32 telah diperbarui oleh teknisi.', 0, '2025-10-01 08:48:31', NULL),
(56, 1, NULL, 'Progress tiket #32 telah diperbarui oleh teknisi.', 0, '2025-10-01 09:27:27', NULL),
(57, 1, NULL, 'Progress tiket #32 telah diperbarui oleh teknisi.', 0, '2025-10-01 14:12:30', NULL),
(58, 1, NULL, 'Progress tiket #32 telah diperbarui oleh teknisi.', 0, '2025-10-01 14:14:58', NULL),
(59, 1, NULL, 'Progress tiket #31 telah diperbarui oleh teknisi.', 0, '2025-10-02 02:33:41', NULL),
(60, 4, NULL, 'Anda mendapat tugas maintenance baru: #33', 0, '2025-10-02 04:15:28', '2025-10-02 04:15:28'),
(61, 1, NULL, 'Progress tiket #33 telah diperbarui oleh teknisi.', 0, '2025-10-02 04:25:27', '2025-10-02 04:25:27'),
(62, 1, NULL, 'Progress tiket #33 telah diperbarui oleh teknisi.', 0, '2025-10-02 04:27:33', '2025-10-02 04:27:33'),
(63, 4, NULL, 'Anda mendapat tugas maintenance baru: #34', 0, '2025-10-02 04:29:05', '2025-10-02 04:29:05'),
(64, 1, NULL, 'Progress tiket #33 telah diperbarui oleh teknisi.', 0, '2025-10-02 09:20:07', '2025-10-02 09:20:07'),
(65, 1, 'admin', 'Progress tiket #33 telah diperbarui oleh teknisi.', 0, '2025-10-02 09:54:31', '2025-10-02 09:54:31'),
(66, 1, 'admin', 'Progress tiket #33 telah diperbarui oleh teknisi.', 0, '2025-10-02 10:05:25', '2025-10-02 10:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int UNSIGNED NOT NULL,
  `entitas_id` int UNSIGNED DEFAULT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `department` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `divisi` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `entitas_id`, `nama`, `email`, `jabatan`, `department`, `divisi`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', NULL, 'IT Manager', 'IT', 'Infrastructure', '2025-08-20 07:35:21', '2025-09-09 15:12:50'),
(3, 1, 'Pandu Suryat', NULL, 'IT INFRASTRUCTURE LEAD', 'IT', 'Infrastructure', '2025-08-20 01:11:31', '2025-09-09 15:12:50'),
(4, 1, 'Indra', 'indra.it@maztafarma.co.id\r\n', 'IT SUPPORT', 'IT', 'INFRASTRUCTURE', '2025-08-20 01:38:13', '2025-10-03 06:52:17'),
(5, 1, 'Kamil', NULL, 'IT MOBILE DEVELOPER', 'IT', 'DEVELOPER', '2025-08-20 01:38:13', '2025-09-09 15:12:50'),
(6, 1, 'SATRIO', NULL, 'IT DATA ENGINEER', 'IT', 'DEVELOPER', '2025-08-20 01:38:13', '2025-09-09 15:12:50'),
(7, 1, 'SRI', NULL, 'IT ADMIN', 'IT', 'INFRASTRUCTURE', '2025-08-20 01:38:13', '2025-09-09 15:12:50'),
(10, 1, 'RUSAL', NULL, 'IT PE', 'IT', 'INFRA', '2025-09-09 15:40:52', '2025-09-09 15:40:52'),
(11, 2, 'LOPO', NULL, 'LEGAL ', 'LEGAL', 'LEGAL', '2025-09-09 15:41:39', '2025-09-09 15:41:39'),
(12, 4, 'Azizul', NULL, 'RND', 'MIK TEAM', 'RND', '2025-09-10 06:15:12', '2025-09-10 06:15:12'),
(14, 2, 'ABDUL MANAF', NULL, 'ADM & MESSENGER', 'OPERATION (OPS)', 'OPERATION CABANG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(15, 2, 'DWI OKTA ERYANI', NULL, 'ADM & MESSENGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(16, 2, 'NENGSIH INDRAYANI', NULL, 'ADM & MESSENGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(17, 2, 'BAMBANG SETYO BUDI', NULL, 'ADM & MESSENGER ', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(18, 2, 'BUDI HERMAWAN', NULL, 'ADM & MESSENGER ', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(19, 2, 'HERDYANTO', NULL, 'ADM & MESSENGER ', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(20, 2, 'IRFAN AR RIZAL', NULL, 'ADM & MESSENGER ', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(21, 2, 'QIDAM RAFI ABIRAMA', NULL, 'ADMIN GUDANG', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(22, 2, 'DEWANTORO SUKO WIJOYO', NULL, 'ADMIN MESSENGER COLLECTOR', 'OPERATION (OPS)', 'OPERATION CABANG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(23, 2, 'MUHAMMAD KEVIEN SETIAWAN', NULL, 'ADMIN MESSENGER COLLECTOR', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(24, 2, 'YAHYA GHAFARA GINTING', NULL, 'ADMIN MESSENGER COLLECTOR', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(25, 2, 'RIEZA NOFIANTI', NULL, 'ADMIN PENJUALAN', 'SALES & MARKETING ', 'SALES PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(26, 2, 'FIRDA USWATUL ULIYAH', NULL, 'APOTEKER PJ PBF', 'REGULATORY  ', 'REGULATORY ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(27, 2, 'RIZKY YANWAR ASHARI', NULL, 'APOTEKER PJ PBF PUSAT', 'REGULATORY  ', 'REGULATORY ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(28, 2, 'ANDI SUSILO', NULL, 'AREA SALES MANAGER ', 'SALES & MARKETING ', 'SALES PUSAT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(29, 2, 'DIDIK SUBOWO', NULL, 'AREA SALES MANAGER ', 'SALES & MARKETING ', 'ACCOUNTING ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(30, 2, 'MUHAMMAD REZA DEDATGRAF', NULL, 'AREA SALES MANAGER ', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(31, 2, 'NOVAL RACHMAT ZULPATAH BUAMONA', NULL, 'AREA SALES MANAGER ', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(32, 2, 'DINNI SETYAWATI', NULL, 'ASISTEN MANAGER AR ', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(33, 2, 'FAISAL HIDAYAT', NULL, 'BRANCH MANAGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(34, 2, 'PUTERA ANDIKA', NULL, 'BRANCH MANAGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(35, 2, 'VIKA YANISTARINA HAPSARI', NULL, 'BRANCH MANAGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(36, 2, 'ELISIA', NULL, 'BUSINESS DEVELOPMENT', 'BUSSINES DEVELOPMENT ', 'BD PRODUCT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(37, 2, 'ACHVIS FARINDO SETIAWAN', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(38, 2, 'ARI IRAWAN', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(39, 1, 'ICHSAN WAHYUDIN', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(40, 1, 'MOHAMMAD FAISAL', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(41, 1, 'MUHAMMAD ALWI', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(42, 1, 'RESA SANJAYA', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(43, 1, 'RIANSYAH', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(44, 1, 'ZULKIFLI', NULL, 'COLLECTOR', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(45, 1, 'GALIH SAMSI LANTIORO', NULL, 'HEAD OF DISTRIBUTION & WAREHOUSE ', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(46, 1, 'GIANI GINTING', NULL, 'HEAD OF PURCHASING ', 'PURCHASING ', 'PURCHASING ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(47, 1, 'MUHAMMAD RENDY', NULL, 'KOORDINATOR ADMIN NASIONAL', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(48, 1, 'ALFURKON', NULL, 'KOORDINATOR DISTRIBUSI', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(49, 1, 'SYIFA USRIANI', NULL, 'KOORDINATOR FAKTURIS ', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AP', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(50, 1, 'IIN ERLINA', NULL, 'KOORDINATOR MARKETING', 'SALES & MARKETING ', 'MARKETING ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(51, 1, 'MUHAMMAD HARUN', NULL, 'MESSENGER', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(52, 1, 'SANDHY KRISTIAN PUTRA', NULL, 'MESSENGER', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(53, 1, 'HANSPARTA NABABAN', NULL, 'REGIONAL AREA MANAGER ', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(54, 1, 'GILBERTUS YOMAR DWI P.K', NULL, 'SALES MANAGER ', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(55, 1, 'ADE HIKMAT TEGUH IRAWAN', NULL, 'SALES PRODUCT OTC', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(56, 1, 'AHMAD DANI WIJAYA', NULL, 'SALES PRODUCT OTC', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(57, 1, 'SITI HASANAH', NULL, 'SALES PRODUCT OTC', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(58, 1, 'SULAIMAN', NULL, 'SALES PRODUCT OTC', 'SALES & MARKETING ', 'SALES PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(59, 1, 'WIDYA NINGRUM', NULL, 'SPV HRGA', 'HRGA', 'HRD', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(60, 1, 'ANDARISKA VIRICA SUMUAL', NULL, 'SPV SALES', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(61, 1, 'DESI APRIANITA', NULL, 'SPV SALES', 'SALES & MARKETING ', 'SALES CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(62, 1, 'SALAPUDIN', NULL, 'SPV SALES', 'SALES & MARKETING ', 'SALES PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(63, 1, 'DANNIS YANIARI PRAVITASARI', NULL, 'SPV WAREHOUSE', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(64, 1, 'RAGISTA WAHYU HAQIQI', NULL, 'SPV WAREHOUSE', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(65, 1, 'RYAN SEPLIANSYAH', NULL, 'SPV WAREHOUSE', 'OPERATION (OPS)', 'OPERATION CABANG ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(66, 1, 'RINI ARIYANI', NULL, 'STAFF ACCOUNTING & TAX ', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'ACCOUNTING ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(67, 1, 'HERLINA LISTIANTI', NULL, 'STAFF AR NON OTC', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(68, 1, 'RIRI TRISNA ALAWIYAH', NULL, 'STAFF AR NON OTC', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(69, 1, 'ANNITA WULANDARI', NULL, 'STAFF AR OTC', 'FINANCE, ACCOUNTING  & TAX (FAT)', 'FINANCE AR ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(70, 1, 'ABDUL MAJID', NULL, 'STAFF MESSENGER', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(71, 1, 'ABDUL RASID', NULL, 'STAFF MESSENGER', 'OPERATION (OPS)', 'OPERATION PUSAT ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(72, 1, 'RIZKY DION MAHESA PUTRA', NULL, 'STAFF PROJECT MANAGEMENT', 'PROJECT MANAGEMENT', 'PROJECT MANAGEMENT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(73, 1, 'RIZKA APRILIANINGSIH', NULL, 'STAFF PURCHASING ', 'PURCHASING ', 'PURCHASING ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(74, 1, 'ABD RAHMAN HM', NULL, 'PS PARAMOUNT', 'SALES & MARKETING', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(75, 1, 'ABD. MUHIS', NULL, 'AM ULTIMATE', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(76, 1, 'ABRAMSYAH ALI REZA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(77, 1, 'ACHMAD SYUKRI', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(78, 1, 'ADITYA ZULKARNAIN', NULL, 'SCIENTIFIC MANAGER', 'SCIENTIFIC', 'SCIENTIFIC', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(79, 1, 'AFRIZAL BAYU SATRIO', NULL, 'IT DATABASE ENGINEER', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(80, 1, 'AGUS DWI CAHYONO SH', NULL, 'LEGAL MANAGER', 'LEGAL', 'LEGAL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(81, 1, 'AGUS MULIADI', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO BALI NUSRA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(82, 1, 'AGUS SUNARTO', NULL, 'DM PARAMOUNT', 'SALES & MARKETING', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(83, 1, 'AHMAD SUYANDI', NULL, 'KAM PNC ', 'SALES & MARKETING', 'SALES PINNACLES', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(84, 1, 'ALDI OKTAVIANDI', NULL, 'GENERAL AFFAIR STAFF', 'HRGA', 'GA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(85, 1, 'ALEK IRUN SETIARUN', NULL, 'BCO JABAR', 'BUSINESS CORPORATE', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(86, 1, 'ALZAHRA SALSABILA', NULL, 'MAZTA ACADEMY STAFF', 'MAZTA ACADEMY', 'MAZTA ACADEMY', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(87, 1, 'ANA MARDIA', NULL, 'DM COMBO', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(88, 1, 'ANDES TIARA KUSUMA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(89, 1, 'ANDI JEN G PUTRA', NULL, 'DM SUPREME', 'SALES & MARKETING', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(90, 1, 'ANDREW BASKORO', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(91, 1, 'ANNISA RAHMA DAMAYANTI', NULL, 'HR GENERALIST', 'HRGA', 'HRD', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(92, 1, 'ARIEF SETIAWAN', NULL, 'RSM COMBO', 'SALES & MARKETING', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(93, 1, 'ARIL GEOVANNI SAEMANI', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(94, 1, 'ARYANTO WIBOWO', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(95, 1, 'ASTRIA RAPRANA', NULL, 'AM SUPREME', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(96, 1, 'AZI WAHYUDIN', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(97, 1, 'BELLA OVILIA', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(98, 1, 'BRAWIJAYA MAULANA', NULL, 'MAZTA ACADEMY MANAGER', 'MAZTA ACADEMY', 'MAZTA ACADEMY', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(99, 1, 'BUNGA FITRIANI', NULL, 'DM COMBO', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(100, 1, 'CAHAYA PURNAMA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(101, 1, 'CALISATUZZAKATTA', NULL, 'DM ULTIMATE', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(102, 1, 'DEDE IRAWAN', NULL, 'DM SUPREME', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(103, 1, 'DEDY PUTRA PASARIBU', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO KALIMANTAN', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(104, 1, 'DEVINTA AGNES HAPSARI', NULL, 'PS SUPREME', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(105, 1, 'DHEA SISWANTI', NULL, 'FINANCE STAFF', 'FINANCE, ACCOUNTING & TAX', 'FINANCE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(106, 1, 'DIAN PUJI SUSANTI ASWALESTARI', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO KALIMANTAN', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(107, 1, 'DICKY ARIE TARIGAN, SKM', NULL, 'DM PARAMOUNT', 'SALES & MARKETING', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(108, 1, 'DJUMAILAH KAMADJAJA', NULL, 'RSM COMBO', 'SALES & MARKETING', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(109, 1, 'ELFI YANTI', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(110, 1, 'ELVIRA ENGITA', NULL, 'REGULATORY OFFICER (KOSMETIK)', 'BUSINESS & DEVELOPMENT', 'REGULATORY', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(111, 1, 'ERIK MULYADI', NULL, 'DM COMBO', 'SALES & MARKETING', 'SUB BCO SUMBARI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(112, 1, 'ERIK SANTOSO', NULL, 'OFFICE BOY', 'HRGA', 'GA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(113, 1, 'ESA FIRMANSYAH', NULL, 'DM COMBO', 'SALES & MARKETING ', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(114, 1, 'FADILAH ROCHMAWATI', NULL, 'FINANCE STAFF', 'FINANCE, ACCOUNTING & TAX', 'FINANCE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(115, 1, 'FADILLA RAHMA FAUZIAH', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(116, 1, 'FAHRIZAL', NULL, 'IT FULL STACK DEVELOPER', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(117, 1, 'FARHAN FAHREZZY', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(118, 1, 'FAWZY PRADITIA ZUNANDA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(119, 1, 'FELLA ARUM SEPTYVITA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(120, 1, 'FILDZAH NAZIHAH AUFARINA, S.Sos', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(121, 1, 'FITRIA SETIANINGRUM', NULL, 'MAZTA ACADEMY STAFF', 'MAZTA ACADEMY', 'MAZTA ACADEMY', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(122, 1, 'FRANSISCO HASIBUAN', NULL, 'PROJECT COORDINATOR', 'PROJECT MANAGEMENT', 'PROJECT MANAGEMENT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(123, 1, 'GERALDUS YOMAREKA PUTRAKA', NULL, 'BCO SULAWESI', 'BUSINESS CORPORATE', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(124, 1, 'GLORIA FEBRINA MAHARANI .I., SE', NULL, 'DM PARAMOUNT', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(125, 1, 'HARDY', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(126, 1, 'HARIS GALIH WARDANA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(127, 1, 'HENDRY KURNIAWAN', NULL, 'SUB BCO BALI NUSRA', 'BUSINESS CORPORATE', 'SUB BCO BALI NUSRA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(128, 1, 'HENGKY', NULL, 'PURCHASING & WAREHOUSE MANAGER', 'PROCUREMENT', '-', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(129, 1, 'IKHSANUL KAMIL', NULL, 'BUDGETING & FINANCIAL ANALYST SUPERVISOR', 'FINANCE, ACCOUNTING & TAX', 'BUDGETING & FINANCE ANALYST', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(130, 1, 'INDRA SALIM', NULL, 'PS SUPREME', 'SALES & MARKETING', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(131, 1, 'INDRA TIRTA ANGGARA', NULL, 'IT SUPPORT', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(132, 1, 'INES STOYANOVA SIMANJUNTAK', NULL, 'SECRETARY & MARKETING PRODUCT SUPERVISOR', 'SALES & MARKETING', 'MARKETING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(133, 1, 'ISMAIL. AMD', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(134, 1, 'ISMARIA HANDRIANI', NULL, 'GSMM', 'GENERAL SALES MARKETING', 'GENERAL SALES MARKETING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(135, 1, 'IVAN NABILA', NULL, 'PS SUPREME', 'SALES & MARKETING ', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(136, 1, 'JOHANNES TOHONAN SINAGA', NULL, 'PS COMBO', 'SALES & MARKETING ', 'SUB BCO SUMBARI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(137, 1, 'JUNIANTO', NULL, 'FINANCE, ACCOUNTING & TAX ASST. MANAGER', 'FINANCE, ACCOUNTING & TAX', 'FINANCE, ACCOUNTING & TAX', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(138, 1, 'KEVIN JULIO LOW', NULL, 'IT QA', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(139, 1, 'KURNIA PUTRI HANDAYANI', NULL, 'ASSISTANT MANAGER PI', 'PROCUREMENT', 'PURCHASING & IMPORT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(140, 1, 'KURNIAWAN', NULL, 'BCO SUMUT ACEH', 'BUSINESS CORPORATE', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(141, 1, 'KUSNADI SOETARDJO', NULL, 'BCO JATENG', 'BUSINESS CORPORATE', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(142, 1, 'LILY INDRAYANTI.RD', NULL, 'FINANCE, ACCOUNTING & TAX MANAGER', 'FINANCE, ACCOUNTING & TAX', 'FINANCE, ACCOUNTING & TAX', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(143, 1, 'LINGGA KURNIA PUTRA', NULL, 'AUDIT COORDINATOR', 'QUALITY ASSURANCE', 'AUDIT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(144, 1, 'M. ALI AKBAR', NULL, 'DRIVER OPERASIONAL', 'HRGA', 'GA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(145, 1, 'M. IQBAL GAFFAR', NULL, 'BCO DKI 2', 'BUSINESS CORPORATE', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(146, 1, 'MARTINUS DENNY TERSIANTO', NULL, 'BCO JATIM', 'BUSINESS CORPORATE', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(147, 1, 'MAULIDIA KARTIKA PUTRI RAHMAH', NULL, 'BD STAFF', 'BUSINESS & DEVELOPMENT', 'BD PRODUCT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(148, 1, 'MELINDA RUYATUL AULIA', NULL, 'MARKETING SUPPORT COORDINATOR', 'SALES & MARKETING', 'MARKETING SUPPORT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(149, 1, 'MIKAEL RIDZKY EKARISTI.L', NULL, 'HEAD OF IT', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(150, 1, 'MOCHTAR AZNI MARLANI', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(151, 1, 'MUHAMMAD ICHSAN KAMIL', NULL, 'IT MOBILE DEVELOPER', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(152, 1, 'MUHAMMAD SEPTIAN HADI ASMARAN', NULL, 'RSM COMBO', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(153, 1, 'MUHAMMAD TAUFAN', NULL, 'IT ENGINEER', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(154, 1, 'MUHAMMAD YANU FERDIANTO', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(155, 1, 'NADIA SAFITRI', NULL, 'SECRETARY & MARKETING SUPPORT SPV', 'SALES & MARKETING', 'MARKETING SUPPORT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(156, 1, 'NANDA APRILIA', NULL, 'INTERNAL AUDIT STAFF', 'QUALITY ASSURANCE', 'AUDIT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(157, 1, 'NUR ABDUL HAQ', NULL, 'SUB BCO SUMBARI', 'BUSINESS CORPORATE', 'SUB BCO SUMBARI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(158, 1, 'NUR WAHID', NULL, 'WAREHOUSE COORDINATOR', 'PROCUREMENT', 'WAREHOUSE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(159, 1, 'OTIK STEVANI', NULL, 'FINANCE COORDINATOR', 'FINANCE, ACCOUNTING & TAX', 'FINANCE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(160, 1, 'PANDU SURYATMOKO P', NULL, 'IT INFRASTRUCTURE LEAD', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(161, 1, 'PENDI GUNAWAN THANG', NULL, 'SUB BCO SUMBAGSEL', 'BUSINESS CORPORATE', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(162, 1, 'PRAMONO', NULL, 'DRIVER', 'HRGA', 'GA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(163, 1, 'PRISDA HUTAMI PUTRI', NULL, 'IMPORT STAFF', 'PROCUREMENT', 'PURCHASING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(164, 1, 'PUAH RAJA GUKGUK', NULL, 'GROUP PRODUCT MANAGER (CARETAKER)', 'SALES & MARKETING', 'MARKETING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(165, 1, 'PUTU ARIS APRILIANA', NULL, 'DM COMBO', 'SALES & MARKETING', 'SUB BCO BALI NUSRA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(166, 1, 'R DRAJAT HEPPY RADITYO', NULL, 'PS PARAMOUNT', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(167, 1, 'REFA AQMAR AULIA', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(168, 1, 'REMBULAN SEKAR EXAZIERAYANDA', NULL, 'RSM COMBO', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(169, 1, 'RIALDI AGUSTIAN', NULL, 'BCO DKI 1', 'BUSINESS CORPORATE', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(170, 1, 'RIDWAN ADRIADI', NULL, 'PS COMBO', 'SALES & MARKETING ', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(171, 1, 'RINA MAWARNI', NULL, 'FINANCE ANALYST COORDINATOR', 'FINANCE, ACCOUNTING & TAX', 'BUDGETING & FINANCE ANALYST', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(172, 1, 'RINALDI NASUTION', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(173, 1, 'RINI RUSTIYAWATI', NULL, 'SUB BCO KALIMANTAN', 'BUSINESS CORPORATE', 'SUB BCO KALIMANTAN', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(174, 1, 'RIYAN TINA', NULL, 'PS SUPREME', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(175, 1, 'ROBBY GUMILAR MAULANA', NULL, 'MRDC SUPERVISOR', 'QUALITY ASSURANCE', 'MRDC', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(176, 1, 'RUSDI T', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO SULAWESI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(177, 1, 'SAFNA ANBIYA HILARTI ', NULL, 'ACCOUNTING SUPERVISOR', 'FINANCE, ACCOUNTING & TAX', 'ACCOUNTING & TAX', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(178, 1, 'SALMA ABIDAH FAIZAH', NULL, 'INTERNAL AUDIT STAFF', 'QUALITY ASSURANCE', 'AUDIT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(179, 1, 'SALMA ZAYTUNIL ADHA', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO SUMBARI', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(180, 1, 'SAPHIRA EKA APRILIA', NULL, 'LEGAL STAFF', 'LEGAL', 'LEGAL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(181, 1, 'SEIKA REKA KURNIASIH', NULL, 'PS ULTIMATE', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(182, 1, 'SHANTI PUSPITASARI', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(183, 1, 'SILVIA NURY ANGGRAINI', NULL, 'PS COMBO', 'SALES & MARKETI', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(184, 1, 'SISKA MARDIANTI', NULL, 'PS COMBO', 'SALES & MARKETING', 'SUB BCO SUMBAGSEL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(185, 1, 'SITI AISYAH E', NULL, 'DM ULTIMATE', 'SALES & MARKETING', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(186, 1, 'SRI HARYANI', NULL, 'IT ADMIN', 'IT', 'IT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(187, 1, 'STEVANUS', NULL, 'BD PRODUCT & RO SUPERVISOR ', 'BUSINESS & DEVELOPMENT', 'BD PRODUCT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(188, 1, 'TINI SYAMSUDDIN', NULL, 'REGULATORY OFFICER', 'BUSINESS & DEVELOPMENT', 'REGULATORY ', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(189, 1, 'TITIE LIANTINI', NULL, 'DM ULTIMATE', 'SALES & MARKETING', 'BCO JATIM', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(190, 1, 'TITO AJI SANTOSO', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(191, 1, 'TITO ILVA VERIANTO', NULL, 'PS COMBO', 'SALES & MARKETING ', 'BCO JABAR', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(192, 1, 'TOMI ALEXANDER SIMARMATA', NULL, 'PS COMBO', 'SALES & MARKETING', 'BCO SUMUT ACEH', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(193, 1, 'TRI HANDOKO', NULL, 'DM COMBO', 'SALES & MARKETING', 'BCO DKI 2', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(194, 1, 'VICA ALMIA', NULL, 'DM PARAMOUNT', 'SALES & MARKETING', 'BCO JATENG', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(195, 1, 'WAHYU PURNOMO', NULL, 'RSM COMBO', 'SALES & MARKETING', 'BCO DKI 1', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(196, 1, 'WAHYU PUTRI WIDIASTUTI', NULL, 'TALENT ACQUISITION STAFF', 'HRGA', 'HRD', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(197, 1, 'WAHYU R HIDAYAH', NULL, 'DM COMBO', 'SALES & MARKETING', 'SUB BCO BALI NUSRA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(198, 1, 'WILLIAM ANGELO KURNIAWAN', NULL, 'AUDIT COORDINATOR', 'QUALITY ASSURANCE', 'AUDIT', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(199, 1, 'YUNITA RAHAYU', NULL, 'SECRETARY', 'SECRETARY', 'SECRETARY', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(200, 3, 'ANDRE NUR PRIAMBADA', NULL, 'SOCIAL MEDIA SPECIALIST', 'CREATIVE', 'CREATIVE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(201, 3, 'MUHAMMAD THAMRIN NOVAN MUBARAK', NULL, 'VIDEOGRAPHER & EDITOR', 'PRODUCTION', 'PRODUCTION', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(202, 3, 'GILANG PERMANA', NULL, 'SOCIAL MEDIA SPECIALIST', 'MARKETING', 'MARKETING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(203, 3, 'MUHAMMAD KHALID AL FARIZI', NULL, 'DESIGN GRAPHIS', 'CREATIVE', 'CREATIVE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(204, 3, 'DANU BAHARUDDIN', NULL, 'HEAD OF PRODUCTION', 'PRODUCTION', 'PRODUCTION', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(205, 3, 'BIMO SATRIO MUKTI', NULL, 'HEAD CREATIVE & DIGITAL MARKETING', 'CREATIVE', 'CREATIVE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(206, 3, 'ALIF MAULANA ALFATHAN', NULL, 'CREATIVE & PRODUCTION LEAD', 'CREATIVE', 'CREATIVE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(207, 3, 'RIA SATRIANA BUDI', NULL, 'PEMIMPIN REDAKSI', 'MEDIA', 'MEDIA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(208, 4, 'LIONG, FRANSISCA LIUNATA', NULL, 'GRAPHIC DESIGN', 'RND', 'RND', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(209, 4, 'FEDRI TJANDRA', NULL, 'PRODUCTION ASSISTANT MANAGER', 'PRODUCTION & WAREHOUSE', 'PRODUCTION & WAREHOUSE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(210, 4, 'MOCH. AGUN MUTTAQIN', NULL, 'R & D HEAD ', 'OPERASIONAL', 'OPERASIONAL', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(211, 4, 'RAHAYU PURWANINGSIH', NULL, 'MARKETING', 'MARKETING', 'MARKETING', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(212, 4, 'DOYO SETIYO', NULL, 'CHIEF OF SECURITY', 'HRGA', 'HRGA', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(213, 4, 'RIZKY AZIZUL HAKIM', NULL, 'QA / QC STAFF', 'QA & QC', 'QA & QC', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(214, 4, 'AJIS SAPUTRA', NULL, 'OPERATOR PRODUKSI & OB', 'PRODUCTION & WAREHOUSE', 'PRODUCTION & WAREHOUSE', '2025-09-29 05:02:26', '2025-09-29 05:02:26'),
(215, 4, 'NAVIDAH RAKHMA', NULL, 'R&D STAFF', 'OPERASIONAL', 'OPERASIONAL', '2025-09-29 05:02:26', '2025-09-29 05:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `pic_assets`
--

CREATE TABLE `pic_assets` (
  `id` int UNSIGNED NOT NULL,
  `pegawai_id` int UNSIGNED NOT NULL,
  `asset_id` int UNSIGNED NOT NULL,
  `assigned_at` datetime NOT NULL,
  `released_at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT 'tersedia',
  `berita_acara` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pic_assets`
--

INSERT INTO `pic_assets` (`id`, `pegawai_id`, `asset_id`, `assigned_at`, `released_at`, `status`, `berita_acara`) VALUES
(108, 5, 122, '2025-10-01 11:44:18', NULL, 'maintenance', NULL),
(109, 12, 123, '2025-10-01 11:44:41', '2025-10-01 11:48:05', 'tersedia', NULL),
(110, 12, 121, '2025-10-01 14:18:12', NULL, 'maintenance', NULL),
(111, 7, 123, '2025-10-01 14:22:55', NULL, 'tersedia', NULL),
(112, 15, 113, '2025-10-01 15:08:54', NULL, 'maintenance', NULL),
(113, 10, 120, '2025-10-01 15:19:11', NULL, 'terpakai', NULL),
(114, 27, 111, '2025-10-02 11:14:40', NULL, 'maintenance', NULL),
(115, 25, 119, '2025-10-02 11:28:36', NULL, 'maintenance', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `pegawai_id` int UNSIGNED DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('superadmin','teknisi') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'superadmin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `pegawai_id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '$2y$10$bUuSbyzco4Ey/40hU4zzfe0BgVYpTWxIl6ZR4iBZPwZ3B4zrKk7Ui', 'superadmin', '2025-08-20 07:35:21', '2025-08-20 07:35:21'),
(4, 4, 'indra', '$2y$10$cveZgskPoVrtyXbzTFjQN.oQqA9zrDiZOazOMjFe/sdos8Fk16WLy', 'teknisi', '2025-09-17 21:31:22', '2025-09-30 03:40:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_asset` (`kode_asset`),
  ADD UNIQUE KEY `kode_ga` (`kode_ga`),
  ADD KEY `assets_kategori_id_foreign` (`kategori_id`),
  ADD KEY `assets_kondisi_id_foreign` (`kondisi_id`),
  ADD KEY `fk_assets_lokasi` (`lokasi_id`),
  ADD KEY `fk_assets_entitas` (`entitas_id`);

--
-- Indexes for table `asset_lokasi`
--
ALTER TABLE `asset_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asset` (`asset_id`),
  ADD KEY `fk_lokasi` (`lokasi_id`);

--
-- Indexes for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pic_asset_id` (`pic_asset_id`);

--
-- Indexes for table `entitas`
--
ALTER TABLE `entitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kendaraan_entitas` (`entitas_id`),
  ADD KEY `fk_kendaraan_lokasi` (`lokasi_id`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asset_id` (`asset_id`),
  ADD KEY `pic_id` (`pic_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `maintenance_message`
--
ALTER TABLE `maintenance_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_id` (`maintenance_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `maintenance_progress`
--
ALTER TABLE `maintenance_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_id` (`maintenance_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_messages_maintenance` (`maintenance_id`);

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
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pegawai_entitas` (`entitas_id`);

--
-- Indexes for table `pic_assets`
--
ALTER TABLE `pic_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pic_pegawai_rel` (`pegawai_id`),
  ADD KEY `fk_pic_asset_rel` (`asset_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `fk_users_pegawai_rel` (`pegawai_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `asset_lokasi`
--
ALTER TABLE `asset_lokasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `berita_acara`
--
ALTER TABLE `berita_acara`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `entitas`
--
ALTER TABLE `entitas`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `maintenance_message`
--
ALTER TABLE `maintenance_message`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `maintenance_progress`
--
ALTER TABLE `maintenance_progress`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `pic_assets`
--
ALTER TABLE `pic_assets`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assets_kondisi_id_foreign` FOREIGN KEY (`kondisi_id`) REFERENCES `kondisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assets_entitas` FOREIGN KEY (`entitas_id`) REFERENCES `entitas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_assets_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `asset_lokasi`
--
ALTER TABLE `asset_lokasi`
  ADD CONSTRAINT `fk_asset` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD CONSTRAINT `berita_acara_ibfk_1` FOREIGN KEY (`pic_asset_id`) REFERENCES `pic_assets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `fk_kendaraan_entitas` FOREIGN KEY (`entitas_id`) REFERENCES `entitas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kendaraan_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `lokasi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`pic_id`) REFERENCES `pic_assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_ibfk_4` FOREIGN KEY (`assigned_to`) REFERENCES `pegawai` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_message`
--
ALTER TABLE `maintenance_message`
  ADD CONSTRAINT `maintenance_message_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_message_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance_progress`
--
ALTER TABLE `maintenance_progress`
  ADD CONSTRAINT `maintenance_progress_ibfk_1` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_maintenance` FOREIGN KEY (`maintenance_id`) REFERENCES `maintenance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_entitas` FOREIGN KEY (`entitas_id`) REFERENCES `entitas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pic_assets`
--
ALTER TABLE `pic_assets`
  ADD CONSTRAINT `fk_pic_asset_rel` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pic_pegawai_rel` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_pegawai` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_pegawai_new` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_pegawai_rel` FOREIGN KEY (`pegawai_id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
