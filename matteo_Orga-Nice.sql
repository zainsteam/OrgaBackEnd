-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2019 at 01:32 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matteo_Orga-Nice`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `color` enum('0','1') NOT NULL DEFAULT '0',
  `priority` enum('0','1') NOT NULL DEFAULT '0',
  `sound_for_reminder` varchar(255) NOT NULL,
  `due_date` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `user_id`, `color`, `priority`, `sound_for_reminder`, `due_date`, `created_at`) VALUES
(1, 18, '0', '1', 'abc2.mp3', '0', '2019-04-16 09:40:41.277084'),
(2, 17, '1', '0', 'abc2.mp3', '0', '2019-04-16 09:44:13.932797');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `created_at`) VALUES
(3, 17, 'category3', '2019-04-10 14:42:19.879466'),
(4, 20, 'category4', '2019-04-10 14:42:31.223702'),
(7, 18, 'Work Out', '2019-05-02 14:38:25.407443'),
(19, 26, 'Great', '2019-07-28 22:08:03.508327'),
(23, 25, 'demo2', '2019-08-28 04:17:09.857296'),
(25, 25, 'feeee', '2019-08-28 04:21:24.134844'),
(38, 27, 'test', '2019-08-30 22:16:05.004993'),
(40, 37, 'My task', '2019-09-25 19:07:57.929448'),
(41, 46, 'Test', '2019-09-25 21:06:04.936573'),
(42, 45, 'Test', '2019-09-30 17:14:00.678778'),
(43, 39, 'Demo', '2019-09-30 17:16:05.740828'),
(44, 39, 'Test', '2019-09-30 17:16:47.183381'),
(45, 36, 'Cate', '2019-10-12 19:45:20.048543'),
(46, 47, 'Grocery', '2019-10-18 13:41:37.067799'),
(47, 24, 'Aaaa', '2019-10-28 21:28:18.557519'),
(48, 49, 'TEST', '2019-11-06 07:10:17.479958'),
(49, 50, 'gestures ', '2019-11-11 10:03:21.674863'),
(50, 50, 'Android ', '2019-11-11 10:03:36.802873'),
(51, 50, 'iPhone ', '2019-11-11 10:03:50.367980'),
(52, 51, 'Test', '2019-11-13 04:19:24.719493'),
(53, 52, 'Cat 1', '2019-11-13 07:10:56.015583'),
(54, 52, 'cat 2', '2019-11-13 07:11:13.562916'),
(56, 54, 'Test', '2019-12-02 11:07:23.741517'),
(68, 54, 'Testing ', '2019-12-05 12:35:41.008423'),
(69, 54, 'Methods ', '2019-12-05 12:35:58.975338'),
(70, 23, 'Fk you', '2019-12-11 18:38:05.086830'),
(71, 53, 'Test cat', '2019-12-13 07:03:25.023846'),
(72, 53, 'dsadsad', '2019-12-18 12:35:12.966244');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `duration` varchar(255) NOT NULL,
  `bring_with_you` varchar(255) NOT NULL,
  `reminders` varchar(255) NOT NULL,
  `minutes_before` varchar(255) NOT NULL,
  `repetition` varchar(255) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `event_name`, `start_date`, `duration`, `bring_with_you`, `reminders`, `minutes_before`, `repetition`, `created_at`) VALUES
(1, 18, 'annual function', '2019-04-15', '2 day', 'clothes', 'Don\'t forget to', '15 minutes', 'daily', '2019-04-15 13:50:51.095696'),
(2, 18, 'Daughter\'s birthday', '2019-04-18', '1 day', 'clothes & Gifts', 'Don\'t forget to buy swwet', '30 minutes', '1 day', '2019-04-15 14:00:41.705600'),
(3, 17, 'Wedding aniversary', '2019-04-22', '1 day', 'clothes & Gifts', 'Don\'t forget to buy sweet', '1 hour', '1 day', '2019-04-15 14:01:30.732445');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `otp_id` int(11) NOT NULL,
  `otp` int(255) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`otp_id`, `otp`, `email`, `created_at`) VALUES
(3, 579148594, 'sam12@gmail.com', '2019-09-19 21:53:45'),
(2, 264985881, 'sam12@gmail.com', '2019-09-19 21:51:56'),
(4, 1805200547, 'sam12@gmail.com', '2019-09-19 22:16:25'),
(5, 1464352497, 'sam@gmail.com', '2019-09-19 22:20:02'),
(6, 1031420557, 'sam@gmail.com', '2019-09-19 22:21:59'),
(7, 313786625, 'sam@gmail.com', '2019-09-19 22:27:01'),
(8, 1362850885, 'sam@gmail.com', '2019-09-19 22:30:26'),
(9, 613845997, 'sam@gmail.com', '2019-09-19 22:34:38'),
(10, 1234, 'rahul@gmail.com', '2019-09-19 22:48:54'),
(11, 1234, 'rahul@gmail.com', '2019-09-19 22:49:19'),
(12, 1234, 'adil@gmail.com', '2019-09-20 02:06:38'),
(13, 1234, 'adil@gmail.com', '2019-09-20 17:54:01'),
(14, 1234, 'adil@gmail.com', '2019-09-23 07:22:03'),
(15, 1234, 'sam@gmail.com', '2019-09-23 18:48:33'),
(16, 1234, 'sam@gmail.com', '2019-09-23 18:49:42'),
(17, 1234, 'sam@gmail.com', '2019-09-23 18:50:25'),
(18, 1234, 'sam@gmail.com', '2019-09-23 18:54:10'),
(19, 1234, 'sam@gmail.com', '2019-09-23 18:55:13'),
(20, 1234, 'sam@gmail.com', '2019-09-23 19:01:58'),
(21, 1234, 'sam@gmail.com', '2019-09-23 19:09:17'),
(22, 1234, 'sam@gmail.com', '2019-09-23 19:13:38'),
(23, 1234, 'sam@gmail.com', '2019-09-23 19:36:10'),
(24, 1234, 'sam@gmail.com', '2019-09-23 19:51:05'),
(25, 1234, 'sam@gmail.com', '2019-09-23 19:54:41'),
(26, 1234, 'sam@gmail.com', '2019-09-23 20:14:05'),
(27, 1234, 'sam@gmail.com', '2019-09-23 20:14:52'),
(28, 1234, 'sam@gmail.com', '2019-09-23 20:30:15'),
(29, 186297, 'sam@gmail.com', '2019-09-23 20:32:14'),
(30, 840663, 'sam@gmail.com', '2019-09-23 20:42:17'),
(31, 592455, 'sam@gmail.com', '2019-09-23 20:44:32'),
(32, 334902, 'sam@gmail.com', '2019-09-23 20:46:12'),
(33, 682911, 'sam@gmail.com', '2019-09-23 20:50:43'),
(34, 153946, 'sam@gmail.com', '2019-09-23 20:53:40'),
(35, 192010, 'raj@gmail.com', '2019-09-23 20:58:11'),
(36, 469331, 'sam@gmail.com', '2019-09-23 21:08:46'),
(37, 474622, 'sam@gmail.com', '2019-09-23 21:40:47'),
(38, 471157, 'sam@gmail.com', '2019-09-23 22:26:05'),
(39, 632020, 'sami@gmail.com', '2019-09-23 22:30:43'),
(40, 195831, 'test1@gmail.com', '2019-09-23 22:34:50'),
(41, 968717, 'sam@gmail.com', '2019-09-24 18:49:32'),
(42, 948802, 'sam@gmail.com', '2019-09-24 18:56:44'),
(43, 687515, 'sam@gmail.com', '2019-09-24 19:16:09'),
(44, 103829, 'rajabali4@gmail.com', '2019-09-24 19:28:22'),
(45, 780027, 'rajabali4@gmail.com', '2019-09-24 19:36:53'),
(46, 941108, 'rajabali4@gmail.com', '2019-09-24 19:37:26'),
(47, 670916, 'rajabali4@gmail.com', '2019-09-24 19:48:52'),
(48, 646952, 'farntech@gmail.com', '2019-09-24 20:04:54'),
(49, 121635, 'Falk@gmail.com', '2019-09-24 20:15:33'),
(50, 932350, 'sss1@g.com', '2019-09-24 20:25:00'),
(51, 729664, 'gg123@gmail.com', '2019-09-24 20:31:44'),
(52, 934524, 'dd1@gmail.com', '2019-09-24 20:41:36'),
(53, 176952, 'dd1@gmail.com', '2019-09-24 20:43:17'),
(54, 497526, 'dd1@gmail.com', '2019-09-24 20:45:43'),
(55, 142239, 'dd1@gmail.com', '2019-09-24 20:50:28'),
(56, 211995, 'rr@gg.com', '2019-09-24 20:58:01'),
(57, 757517, 'hhh@gmail.com', '2019-09-24 21:13:50'),
(58, 506108, 'Gkj@gg.com', '2019-09-24 21:21:49'),
(59, 357337, 'Gkj@gg.com', '2019-09-24 21:24:01'),
(60, 897314, 'Gkj@gg.com', '2019-09-24 21:27:55'),
(61, 936716, 'oo@gmail.com', '2019-09-24 21:28:44'),
(62, 389108, 'oo@gmail.com', '2019-09-24 21:29:55'),
(63, 830039, 'oo@gmail.com', '2019-09-24 21:39:32'),
(64, 884766, 'samiran1109@gmail.com', '2019-09-24 21:56:44'),
(65, 512506, 'farntech@gmail.com', '2019-09-25 04:30:05'),
(66, 968467, 'Adil@gmail.com', '2019-09-25 04:50:49'),
(67, 833514, 'Adil@gmail.com', '2019-09-25 06:44:22'),
(68, 575026, 'sam@gmail.com', '2019-09-30 19:21:44'),
(69, 225216, 'rajabali4@gmail.com', '2019-10-01 09:46:38'),
(70, 300966, 'sam@gmail.com', '2019-10-12 17:05:17'),
(71, 688375, 'rajabali4@gmail.com', '2019-10-12 19:01:47'),
(72, 671232, 'samiran1109@gmail.com', '2019-10-13 17:29:26'),
(73, 633954, 'Adil@gmail.com', '2019-10-13 18:58:22'),
(74, 941647, 'matteomakowiecki@gmail.com', '2019-10-13 21:34:08'),
(75, 637259, 'samiran1109@gmail.com', '2019-10-14 04:48:57'),
(76, 207965, 'samiran1109@gmail.com', '2019-10-14 04:51:06'),
(77, 743977, 'sam@gmail.com', '2019-10-14 04:51:53'),
(78, 934434, 'adil@gmail.com', '2019-10-14 07:01:05'),
(79, 795766, 'mjkgupta1@gmail.com', '2019-10-14 07:04:18'),
(80, 916441, 'rajabali4@gmail.com', '2019-10-16 04:14:57'),
(81, 965655, 'rajabali4@gmail.com', '2019-10-16 20:22:21'),
(82, 556132, 'farntech@gmail.com', '2019-10-17 18:53:34'),
(83, 992324, 'matteomakowiecki@gmail.com', '2019-10-18 15:49:07'),
(84, 204302, 'sam@gmail.com', '2019-10-21 16:39:36'),
(85, 602640, 'sam@gmail.com', '2019-10-21 17:33:55'),
(86, 278338, 'sam@gmail.com', '2019-10-21 17:41:04'),
(87, 923855, 'sam@gmail.com', '2019-10-21 17:58:47'),
(88, 716239, 'sam@gmail.com', '2019-10-21 19:08:10'),
(89, 828084, 'sam@gmail.com', '2019-10-21 20:00:06'),
(90, 879800, 'sam@gmail.com', '2019-10-21 20:01:04'),
(91, 337576, 'sam@gmail.com', '2019-10-23 18:54:50'),
(92, 142134, 'sam@gmail.com', '2019-10-23 19:15:09'),
(93, 504996, 'gg123@gmail.com', '2019-10-23 19:23:29'),
(94, 767900, 'sam@gmail.com', '2019-10-23 20:00:07'),
(95, 618978, 'sam@gmail.com', '2019-10-23 20:19:49'),
(96, 618591, 'sam@gmail.com', '2019-10-26 04:39:16'),
(97, 287468, 'sam@gmail.com', '2019-10-26 04:52:31'),
(98, 204141, 'sam@gmail.com', '2019-10-26 04:59:13'),
(99, 601659, 'sam@gmail.com', '2019-10-26 05:05:57'),
(100, 837982, 'sam@gmail.com', '2019-10-26 12:44:36'),
(101, 929266, 'sam@gmail.com', '2019-10-26 17:27:47'),
(102, 726982, 'matteomakowiecki@gmail.com', '2019-10-28 20:48:10'),
(103, 811007, 'Gtmmm2011@gmail.com', '2019-10-30 13:15:44'),
(104, 204658, 'gtmmm2011@gmail.com', '2019-10-31 13:38:15'),
(105, 943497, 'Gtmmm2011@gmail.com', '2019-10-31 15:13:46'),
(106, 495350, 'gtmmm2011@gmail.com', '2019-10-31 15:20:35'),
(107, 294868, 'gtmmm2011@gmail.com', '2019-11-04 16:36:50'),
(108, 757802, 'gurwinder.s@macrew.net', '2019-11-06 06:04:42'),
(109, 100162, 'gurwinder.s@macrew.net', '2019-11-06 06:08:50'),
(110, 322858, 'gurwinder.s@macrew.net', '2019-11-06 06:27:47'),
(111, 731556, 'gauravs@macrew.net', '2019-11-06 07:05:37'),
(112, 619961, 'gurwinder.s@macrew.net', '2019-11-06 07:06:58'),
(113, 891372, 'spavo@hotmail.it', '2019-11-06 07:07:12'),
(114, 493540, 'matteomakowiecki@gmail.com', '2019-11-06 07:07:57'),
(115, 542073, 'jp@yopmail.com', '2019-11-06 12:24:27'),
(116, 303261, 'jp@yopmail.com', '2019-11-11 10:00:58'),
(117, 552443, 'Pulpysoft@gmail.com', '2019-11-13 04:14:38'),
(118, 869037, 'abc@gmail.com', '2019-11-13 06:42:48'),
(119, 358288, 'testpkthakur@gmail.com', '2019-11-13 07:00:50'),
(120, 724835, 'test@mail.com', '2019-11-20 06:01:35'),
(121, 783287, 'touqeermobiles@gmail.com', '2019-11-20 06:03:08'),
(122, 294985, 'test@mail.com', '2019-12-02 06:45:01'),
(123, 246467, 'touqeermobiles@gmail.com', '2019-12-02 06:45:49'),
(124, 378913, 'touqeermobiles@gmail.com', '2019-12-02 09:43:07'),
(125, 158093, 'Rida13422@gmail.com', '2019-12-02 09:53:12'),
(126, 406978, 'Rida13422@gmail.com', '2019-12-02 09:53:23'),
(127, 774139, 'Rida13422@gmail.com', '2019-12-02 09:56:51'),
(128, 414445, 'Rida13422@gmail.com', '2019-12-02 09:59:58'),
(129, 245152, 'touqeermobiles@gmail.com', '2019-12-05 05:12:20'),
(130, 519858, 'touqeermobiles@gmail.com', '2019-12-05 07:01:31'),
(131, 998179, 'Rida13422@gmail.com', '2019-12-05 07:29:40'),
(132, 707768, 'touqeermobiles@gmail.com', '2019-12-05 11:41:13'),
(133, 985458, 'touqeermobiles@gmail.com', '2019-12-05 11:44:00'),
(134, 854661, 'touqeermobiles@gmail.com', '2019-12-05 11:47:28'),
(135, 610529, 'touqeermobiles@gmail.com', '2019-12-05 11:48:28'),
(136, 919153, 'touqeermobiles@gmail.com', '2019-12-05 11:57:58'),
(137, 362305, 'Rida13422@gmail.com', '2019-12-05 12:31:46'),
(138, 514783, 'touqeermobiles@gmail.com', '2019-12-05 12:50:40'),
(139, 769370, 'matteomakowiecki@gmail.com', '2019-12-05 22:17:36'),
(140, 192901, 'touqeermobiles@gmail.com', '2019-12-07 11:40:26'),
(141, 764949, 'Rida13422@gmail.com', '2019-12-09 11:58:11'),
(142, 661863, 'Abc@gmail.com', '2019-12-11 18:35:54'),
(143, 441365, 'Faiyazcool.alam@gmail.com', '2019-12-11 18:44:48'),
(144, 665981, 'Rida13422@gmail.com', '2019-12-11 18:50:39'),
(145, 485926, 'anas@live.com', '2019-12-11 21:00:39'),
(146, 411941, 'Rida13422@gmail.com', '2019-12-12 10:39:08'),
(147, 220149, 'mtayyab8124@gmail.com', '2019-12-12 10:55:33'),
(148, 635659, 'ali.qasim@amalacademy.org', '2019-12-12 10:58:32'),
(149, 564653, 'syed.ali.qasim3007@gmail.com', '2019-12-12 11:07:28'),
(150, 469572, 'Rida13422@gmail.com', '2019-12-12 11:29:43'),
(151, 462862, 'minuciit@gmail.com', '2019-12-12 17:44:51'),
(152, 794032, 'Rida13422@gmail.com', '2019-12-13 06:34:23'),
(153, 781020, 'touqeermobiles@gmail.com', '2019-12-13 06:53:20'),
(154, 611906, 'touqeermobiles@gmail.com', '2019-12-13 07:01:02'),
(155, 781349, 'Rida13422@gmail.com', '2019-12-13 07:44:20'),
(156, 751935, 'matteomakowiecki@gmail.com', '2019-12-13 09:23:13'),
(157, 487799, 'touqeermobiles@gmail.com', '2019-12-13 10:46:03'),
(158, 197779, 'Bhb@hh', '2019-12-13 10:47:37'),
(159, 772520, 'touqeermobiles@gmail.com', '2019-12-13 11:00:38'),
(160, 287260, 'touqeermobiles@gmail.com', '2019-12-13 11:04:04'),
(161, 688653, 'touqeermobiles@gmail.com', '2019-12-13 11:18:03'),
(162, 997046, 'Hj@b', '2019-12-13 11:27:22'),
(163, 700636, 'touqeermobiles@gmail.com', '2019-12-13 11:27:54'),
(164, 350118, 'touqeermobiles@gmail.com', '2019-12-13 14:17:06'),
(165, 525709, 'Rida13422@gmail.com', '2019-12-14 10:24:49'),
(166, 276311, 'Rida13422@gmail.com', '2019-12-14 10:29:22'),
(167, 596552, 'matteomakowiecki@gmail.com', '2019-12-16 07:48:22'),
(168, 607311, 'Rida13422@gmail.com', '2019-12-17 07:08:06'),
(169, 476774, 'Rida13422@gmail.com', '2019-12-17 07:09:05'),
(170, 633293, 'touqeermobiles@gmail.com', '2019-12-18 04:19:01'),
(171, 967778, 'Rida13422@gmail.com', '2019-12-18 06:27:38'),
(172, 685080, 'F158124@nu.edu.pk', '2019-12-18 06:41:15'),
(173, 604781, 'fyptwo@gmail.com', '2019-12-18 06:44:53'),
(174, 710715, 'fyptwo123@gmail.com', '2019-12-18 06:47:10'),
(175, 118401, 'Rida13422@gmail.com', '2019-12-18 10:07:00'),
(176, 633186, 'Ridaa.rida786@gmail.com', '2019-12-18 17:01:39'),
(177, 434499, 'Rida13422@gmail.com', '2019-12-18 17:05:46'),
(178, 299742, 'touqeermobiles@gmail.com', '2019-12-18 17:16:01'),
(179, 878210, 'Rida13422@gmail.com', '2019-12-18 17:52:30');

-- --------------------------------------------------------

--
-- Table structure for table `quicknotes`
--

CREATE TABLE `quicknotes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notes` longtext NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quicknotes`
--

INSERT INTO `quicknotes` (`id`, `user_id`, `notes`, `created_at`) VALUES
(3, 19, 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', '2019-04-10 10:26:29.063695'),
(4, 17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-04-10 10:27:00.908094'),
(69, 25, 'Still can\'t modify notes', '2019-09-25 18:36:23.831394'),
(70, 37, 'Nice day', '2019-09-26 04:16:08.175820'),
(79, 27, 'new2666 kkkk', '2019-10-11 21:04:09.882656'),
(80, 46, 'Hello', '2019-10-12 17:16:34.741633'),
(81, 36, 'Gg', '2019-10-15 07:10:16.644274'),
(83, 50, ' def\n\nfd gfd\n g', '2019-11-06 12:52:13.539887'),
(85, 51, 'Test', '2019-11-13 04:18:43.086264'),
(86, 51, 'Testtt stixjy', '2019-11-13 04:26:01.413077'),
(126, 54, 'Testing', '2019-12-05 12:39:10.215276'),
(128, 24, 'Note 1', '2019-12-13 09:30:22.474196');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `bring_with_you` varchar(255) NOT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `if_not_completed` varchar(255) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `due_date` datetime NOT NULL,
  `sub_tasks` longtext,
  `reminders` varchar(255) DEFAULT NULL,
  `minutes_before` varchar(255) DEFAULT NULL,
  `repetition` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `name`, `duration`, `bring_with_you`, `frequency`, `if_not_completed`, `priority`, `category`, `color`, `due_date`, `sub_tasks`, `reminders`, `minutes_before`, `repetition`, `created_at`, `type`, `status`) VALUES
(1, 18, 'Buy Books', '00:15', 'Money for buying', 'daily', 'move to next day', 'high', 'home', 'red', '0000-00-00 00:00:00', 'call durgesh for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(2, 18, 'Buy snack', '00:30', 'Money for buying', 'daily', 'move to next day', 'high', 'home', 'green', '2019-04-22 00:00:00', 'call durgesh for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(3, 17, 'Buy phone', '21 day', 'Money for buying', 'not daily', 'move to next day', 'high', 'Self', 'pink', '2019-04-25 00:00:00', 'call pintu for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(4, 18, 'Buy pant', '21 day', 'Money for buying', 'not daily', 'move to next day', 'high', 'Self', 'black', '2019-04-25 00:00:00', 'call pintu for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(5, 18, 'Buy pant', '21 day', 'Money for buying', 'not daily', 'move to next day', 'high', 'Self', 'black', '2019-04-25 00:00:00', 'call pintu for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(8, 18, 'Buy pant11', '21 day', 'Money for buying', 'not daily', 'move to next day', 'high', 'Self', 'black', '2019-04-25 00:00:00', 'call pintu for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(9, 18, 'Buy pant11wewewe', '21 day', 'Money for buying', 'not daily', 'move to next day', 'high', 'Self', 'black', '2019-04-25 00:00:00', 'call pintu for company', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(10, 18, 'xczcxc', 'xcxzczxc', 'xcxzczx', 'weekly', 'nxt_month', 'medium', 'office', 'black', '2019-05-20 00:00:00', NULL, '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(11, 18, 'tasksub', 'xzxzxz', 'ZXZXZ', 'weekly', 'nxt_week', 'medium', 'office', 'blue', '2019-05-16 00:00:00', NULL, '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(12, 18, 'dfdfs', 'dfdfs', 'dfdf', 'weekly', 'nxt_week', 'medium', 'Work Out', 'black', '2019-05-14 00:00:00', '[{\"value\":\"first sub task\"}]', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(13, 18, 'ghfhgfhfg', 'ghgfhfghgfhgf', 'hgfhfghfg', 'daily', 'nxt_week', 'medium', 'Work Out', 'black', '2019-05-15 00:00:00', '[]', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(14, 18, 'fdfsdf', 'dfdsf', 'dfdsfsd', 'weekly', 'nxt_week', 'medium', 'Work Out', 'blue', '2019-05-13 00:00:00', '[{\"value\":\"1st task\"},{\"value\":\"2nd tsk\"}]', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(15, 18, 'gffgfg', 'fgfgfgfg', 'gfgfgfgf', 'weekly', 'nxt_week', 'medium', 'office', 'blue', '2019-05-16 00:00:00', '[]', '', '', '', '2019-07-25 13:07:32.601059', 'task', 0),
(35, 25, 'demo', '2:20', 'hhhhhh', 'daily', 'nxt_week', 'medium', 'Demo', 'blue', '2019-07-26 06:25:00', '[]', NULL, NULL, NULL, '2019-08-06 22:12:17.505588', 'task', 1),
(36, 25, 'Event', '5:0', 'Demo', '', '', '', '', '', '2019-07-23 04:00:00', '\"\"', 'Demo', '15', 'nxt_day', '2019-07-28 21:01:00.524381', 'event', 0),
(40, 25, 'ddddd', '1:16', 'hhhhh', '', '', '', '', '', '2019-07-25 17:00:00', '\"\"', 'gggggg', '15', 'nxt_day', '2019-07-27 15:13:31.395019', 'event', 0),
(42, 25, 'Event5', '05:00', 'Mj', '', '', '', '', '', '2019-07-30 20:00:00', '\"\"', 'Ok', '15', 'nxt_day', '2019-07-26 20:38:13.819346', 'event', 0),
(45, 25, 'Reisekosten', '02:03', 'Laptop', 'unassigned', 'nxt_day', 'high', 'Test3', 'red', '2019-07-29 22:03:00', '[]', NULL, NULL, NULL, '2019-08-06 22:14:49.108074', 'task', 1),
(48, 25, 'From hp', '1:25', 'Nothing', 'weekly', 'delete', 'medium', 'Hahahaha', 'blue', '2019-07-31 06:55:00', '[{\"value\":\"Sub1\"},{\"value\":\"Sub2\"}]', NULL, NULL, NULL, '2019-08-14 17:22:34.242042', 'task', 1),
(49, 25, 'event', '21:38', 'demo', '', '', '', '', '', '2019-07-31 21:38:00', '\"\"', NULL, '15', 'nxt_day', '2019-07-31 21:38:47.448490', 'event', 0),
(50, 25, 'Eeeerrrrr', '2:15', 'Dddftt', '', '', '', '', '', '2019-08-01 12:55:00', '\"\"', NULL, '15', 'nxt_day', '2019-08-31 07:33:26.537579', 'event', 0),
(55, 25, 'My dy', '1:50', 'Mj', 'daily', 'nxt_day', 'medium', 'Test cat', 'blue', '2019-08-12 20:55:00', '[]', NULL, NULL, NULL, '2019-08-10 22:13:15.737064', 'task', 1),
(56, 25, 'Evnt', '2:0', 'Kk', '', '', '', '', '', '2019-08-08 10:43:00', '\"\"', NULL, '15', 'daily', '2019-08-10 22:21:13.945069', 'event', 0),
(57, 25, 'Tdaytask', '2:5', 'Kk', 'weekly', 'nxt_week', 'high', 'My category', 'black', '2019-08-16 07:10:00', '[]', NULL, NULL, NULL, '2019-09-01 18:21:22.438884', 'task', 1),
(58, 25, 'Prova', '00:30', 'Laptop', 'weekly', 'nxt_day', 'medium', 'Test cat', 'blue', '2019-12-14 17:26:00', '[]', NULL, NULL, NULL, '2019-08-14 17:26:50.719630', 'task', 0),
(59, 25, 'Prova', '00:30', 'Laptop', 'weekly', 'nxt_day', 'medium', 'Test cat', 'blue', '2019-12-14 17:26:00', '[]', NULL, NULL, NULL, '2019-09-25 06:46:33.195568', 'task', 1),
(61, 25, 'Eat food', '00:20', 'Money', '', '', '', '', '', '2019-08-17 23:32:00', '\"\"', NULL, '15', 'notrepeating', '2019-08-16 23:33:42.794527', 'event', 0),
(63, 27, 'task1', '03:26', 'demo', 'weekly', 'delete', 'medium', 'test', 'green', '2019-09-05 22:26:00', '[]', NULL, NULL, NULL, '2019-09-07 10:17:54.623933', 'task', 1),
(66, 27, 'hhhh', '22:32', 'hhhh', 'daily', 'nxt_week', 'high', 'test', 'blue', '2019-08-30 22:32:00', '[{\"value\":\"ta\"},{\"value\":\"ta2\"},{\"value\":\"t3\"}]', NULL, NULL, NULL, '2019-10-26 05:47:50.602988', 'task', 0),
(67, 27, 'jjjj', '22:33', 'kkkkkk', 'monthly', 'nxt_week', 'medium', 'test', 'red', '2019-08-30 22:34:00', '[]', NULL, NULL, NULL, '2019-08-30 22:34:19.876034', 'task', 0),
(69, 25, 'My eve task', '1:57', 'Mj', 'daily', 'nxt_day', 'medium', 'feeee', 'black', '2019-09-05 15:00:00', '[]', NULL, NULL, NULL, '2019-09-02 12:04:55.657927', 'task', 0),
(70, 25, 'My event', '0:50', 'Hk', '', '', '', '', '', '2019-09-06 10:00:00', '\"\"', NULL, '15', 'daily', '2019-09-07 11:58:25.210218', 'event', 0),
(71, 25, 'Prova', '2:5', 'Brain', 'unassigned', 'nxt_week', 'medium', 'feeee', 'blue', '2019-09-25 03:00:00', '[]', NULL, NULL, NULL, '2019-09-25 19:24:47.316266', 'task', 0),
(72, 25, 'Ritira giacca', '0:25', 'Ricevuta', 'unassigned', 'nxt_day', 'medium', 'demo2', 'blue', '2019-09-27 19:05:00', '[]', NULL, NULL, NULL, '2019-09-25 18:44:00.031559', 'task', 0),
(73, 25, 'Party', '03:00', 'Drinks', '', '', '', '', '', '2019-09-28 19:15:00', '\"\"', NULL, '15', 'weekly', '2019-09-25 18:51:35.422013', 'event', 0),
(76, 25, 'Today', '03:00', 'Nothing', 'weekly', 'nxt_week', 'medium', 'demo2', 'black', '2019-12-25 19:30:00', '[]', NULL, NULL, NULL, '2019-09-25 19:30:51.184341', 'task', 0),
(79, 39, 'Test11', '17:36', '', 'daily', 'nxt_month', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-09-30 17:36:40.519064', 'task', 0),
(80, 39, 'new1', '18:06', '', 'daily', 'nxt_day', 'medium', '', '', '2019-10-30 02:07:00', '[{\"value\":\"t1\"},{\"value\":\"t2\"}]', NULL, NULL, NULL, '2019-09-30 18:07:45.332426', 'task', 0),
(81, 27, 'unassign', '0:5', '', 'daily', 'nxt_month', 'high', '', '', '2019-10-28 02:35:00', '[]', NULL, NULL, NULL, '2019-10-26 13:09:32.373251', 'task', 0),
(82, 27, 'hhhhh', '19:39', '', 'daily', 'nxt_week', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-10-04 19:20:17.998070', 'task', 1),
(83, 46, 'Demo', '20:20', '', 'monthly', 'nxt_month', 'medium', 'Test', 'blue', '2019-10-18 22:27:00', '[{\"value\":\"Sa1\"}]', NULL, NULL, NULL, '2019-10-15 22:27:45.080987', 'task', 0),
(84, 27, 'Valigia', '0:30', '.', 'unassigned', 'delete', 'high', 'feeee', 'blue', '2019-10-02 14:25:00', '[]', NULL, NULL, NULL, '2019-10-12 04:48:40.260568', 'task', 0),
(86, 27, 'Demo', '5:1', '', 'daily', 'nxt_day', 'high', '', '', '2019-10-05 18:38:00', '[]', NULL, NULL, NULL, '2019-10-12 04:53:40.822982', 'task', 1),
(87, 27, 'Event', '19:23', 'demo', '', '', '', '', '', '2019-10-05 19:22:00', '\"\"', NULL, '15', 'weekly', '2019-10-04 19:23:18.260150', 'event', 0),
(88, 27, 'new task1', '05:03', 'gggg', 'daily', 'nxt_day', 'high', '', '', '2019-10-12 14:08:00', '[]', NULL, NULL, NULL, '2019-10-12 14:31:31.045533', 'task', 1),
(91, 36, 'Demo event', '1:15', 'Mj', '', '', '', '', '', '2019-10-14 18:30:00', '\"\"', NULL, '30', 'notrepeating', '2019-10-15 07:15:58.636770', 'event', 0),
(93, 25, 'Lavanderia', '1:10', 'Vestito', 'unassigned', 'nxt_day', 'medium', '', '', '2019-10-09 02:05:00', '[]', NULL, NULL, NULL, '2019-10-13 19:01:41.153799', 'task', 0),
(94, 24, 'Prova oggi', '0:5', '', 'unassigned', 'nxt_day', 'medium', '', 'blue', '2019-10-18 16:30:00', '[{\"value\":\"Aa\"},{\"value\":\"12\"},{\"value\":\"23\"}]', NULL, NULL, NULL, '2019-12-16 17:41:49.695205', 'task', 0),
(95, 24, 'Lavanderia', '0:5', 'Vestito', 'unassigned', 'nxt_day', 'medium', '', '', '2019-10-14 08:00:00', '[]', NULL, NULL, NULL, '2019-10-13 22:02:59.394505', 'task', 0),
(97, 27, 'demo', '04:34', 'dddddddddddd', 'daily', 'nxt_month', 'high', 'test', 'blue', '2019-10-15 20:04:00', '[]', NULL, NULL, NULL, '2019-10-15 18:41:33.454525', 'task', 1),
(98, 47, 'Get water', '1:5', 'Wallet', 'weekly', 'nxt_day', 'medium', '', 'blue', '2019-10-18 17:00:00', '[]', NULL, NULL, NULL, '2019-10-18 13:42:20.887281', 'task', 0),
(101, 46, 'Unassigned', '18:32', '', 'daily', 'nxt_day', 'high', 'Test', 'blue', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-10-16 18:33:40.152547', 'task', 0),
(102, 36, 'Demo wekk', '2:30', 'Lepi', 'weekly', 'nxt_week', 'medium', 'Cate', 'red', '2019-10-17 20:35:00', '[{\"value\":\"Sub week\"},{\"value\":\"Sub week 1\"}]', NULL, NULL, NULL, '2019-10-16 21:21:44.952940', 'task', 0),
(103, 36, 'Daily task', '01:21', 'Bottle', 'daily', 'nxt_day', 'high', 'Cate', 'green', '2019-10-20 18:30:00', '[{\"value\":\"Daily sub\"},{\"value\":\"Daily sub1\"}]', NULL, NULL, NULL, '2019-10-16 20:33:12.539302', 'task', 0),
(104, 36, 'Monthly task', '20:30', 'Ring', 'monthly', 'nxt_month', 'high', 'Cate', 'black', '2019-10-28 20:34:00', '[{\"value\":\"Monthly vsub1\"}]', NULL, NULL, NULL, '2019-10-16 20:35:15.359236', 'task', 0),
(105, 36, 'Once task', '01:25', 'Charger', 'unassigned', 'delete', 'low', 'Cate', 'red', '2019-10-28 10:00:00', '[{\"value\":\"Once sub1\"}]', NULL, NULL, NULL, '2019-10-16 20:37:44.450377', 'task', 0),
(108, 47, 'Drink', '0:15', 'Bottle', 'unassigned', 'delete', 'low', '', 'red', '2019-10-18 16:00:00', '[]', NULL, NULL, NULL, '2019-10-18 13:42:08.197705', 'task', 0),
(110, 47, 'Bsk my', '00:04', 'Nothing', '', '', '', '', '', '2019-10-18 17:14:00', '\"\"', NULL, '15', 'notrepeating', '2019-10-18 14:15:00.770218', 'event', 0),
(111, 37, 'My event', '02:30', 'Bottle', '', '', '', '', '', '2019-10-19 15:18:00', '\"\"', NULL, '15', 'daily', '2019-10-18 15:19:19.825467', 'event', 0),
(112, 27, 'hhhhh', '04:04', '', '', '', '', '', '', '2019-10-26 13:25:00', '\"\"', NULL, '15', 'daily', '2019-10-26 13:25:55.697561', 'event', 0),
(113, 46, 'Demo', '08:02', '', 'daily', 'nxt_day', 'high', 'Test', 'black', '2019-10-27 21:27:00', '[]', NULL, NULL, NULL, '2019-10-27 21:27:58.983084', 'task', 0),
(114, 46, 'Demo', '08:02', '', 'daily', 'nxt_day', 'high', 'Test', 'black', '2019-10-27 21:27:00', '[]', NULL, NULL, NULL, '2019-10-27 21:27:59.977442', 'task', 0),
(115, 37, 'My demo', '2:35', 'Lepi', 'weekly', 'nxt_week', 'medium', 'My task', 'blue', '2019-10-30 19:55:00', '[{\"value\":\"Demo sub\"},{\"value\":\"Demo sub\"}]', NULL, NULL, NULL, '2019-10-27 22:04:13.426571', 'task', 0),
(116, 24, 'Prova', '0:5', 'Nothing', 'weekly', 'delete', 'medium', '', '', '2019-10-28 06:00:00', '[]', NULL, NULL, NULL, '2019-10-28 21:17:15.809168', 'task', 1),
(117, 24, 'Cinema', '0:5', 'Ticket', '', '', '', '', '', '2019-10-29 19:15:00', '\"\"', NULL, '30', 'weekly', '2019-10-30 18:44:06.043544', 'event', 0),
(118, 48, 'Test', '0:45', '', 'daily', 'nxt_day', 'high', '', '', '2019-10-30 02:05:00', '[]', NULL, NULL, NULL, '2019-11-04 16:43:22.427135', 'task', 0),
(119, 48, 'Test', '0:5', '', 'unassigned', 'delete', 'high', '', '', '2019-11-04 00:00:00', '[{\"value\":\"st1\"},{\"value\":\"st2\"}]', NULL, NULL, NULL, '2019-11-04 16:58:35.187059', 'task', 0),
(121, 50, 'tgtg', '00:06', 'fdgfd', 'monthly', 'nxt_month', 'low', '', 'blue', '2019-11-06 12:36:00', '[{\"value\":\"ghgh\"},{\"value\":\"y7\"},{\"value\":\"6y6y\"}]', NULL, NULL, NULL, '2019-11-06 12:32:03.853360', 'task', 0),
(122, 50, '8uiuy', '04:09', 'ooooi', 'weekly', 'nxt_week', 'low', '', 'green', '2019-11-06 23:41:00', '[{\"value\":\"bn\"},{\"value\":\"nbn\"},{\"value\":\"bnb\"}]', NULL, NULL, NULL, '2019-11-06 12:36:04.789530', 'task', 1),
(123, 50, 'hg jh', '00:05', 'cv b', '', '', '', '', '', '2019-11-06 12:53:00', '\"\"', NULL, '30', 'notrepeating', '2019-11-06 12:53:52.921878', 'event', 0),
(124, 51, 'Tetst rasjb. D d d', '0:5', 'Yea', 'daily', 'nxt_day', 'high', 'Test', 'red', '2019-11-13 04:25:00', '[]', NULL, NULL, NULL, '2019-11-13 04:24:12.162649', 'task', 0),
(125, 51, 'Event ', '00:00', 'Baba', '', '', '', '', '', '2019-11-13 04:24:00', '\"\"', NULL, '15', 'daily', '2019-11-13 04:25:02.470523', 'event', 0),
(127, 52, 'Tsk2', '00:00', '', 'daily', 'nxt_day', 'medium', 'cat 2', '', '2019-11-13 07:11:00', '[]', NULL, NULL, NULL, '2019-11-13 07:12:05.447902', 'task', 0),
(128, 53, 'Tesr', '05:02', '', 'daily', 'nxt_week', 'high', '', 'black', '2019-11-20 06:07:00', '[]', NULL, NULL, NULL, '2019-11-20 06:08:11.414738', 'task', 1),
(131, 53, 'dsdasdsad333', '00:00', 'sadasd', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-02 06:50:09.314458', 'task', 0),
(132, 53, 'sadasdqwsqwq', '01:00', 'sdad', 'daily', 'nxt_day', 'high', 'sdsd', '', '2019-12-02 06:48:00', '[]', NULL, NULL, NULL, '2019-12-02 06:50:29.001939', 'task', 1),
(133, 54, 'Testing ', '05:00', 'No', 'daily', 'nxt_day', 'high', 'Test', 'black', '2019-12-05 11:27:00', '[]', NULL, NULL, NULL, '2019-12-02 11:09:34.265695', 'task', 0),
(134, 53, 'BNzn', '00:00', 'Hjs', 'daily', 'nxt_day', 'high', 'sdsd', 'blue', '2019-12-05 10:27:00', '[]', NULL, NULL, NULL, '2019-12-05 10:27:50.845239', 'task', 0),
(135, 53, 'Nznxn', '00:00', '', 'daily', 'nxt_day', 'high', 'sdsd', '', '2019-12-05 10:28:00', '[]', NULL, NULL, NULL, '2019-12-05 10:28:25.589578', 'task', 0),
(136, 53, 'dsadsa', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 10:29:36.606246', 'task', 0),
(137, 53, 'dsadsa', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 10:29:37.539705', 'task', 0),
(138, 53, 'dsada', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 10:32:25.111838', 'task', 0),
(139, 53, 'BhhH', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 10:32:56.422124', 'task', 0),
(140, 53, 'Today', '0:5', '', 'daily', 'nxt_day', 'high', 'sdsd', '', '2019-12-13 00:00:00', '[]', NULL, NULL, NULL, '2019-12-13 07:20:31.921147', 'task', 0),
(141, 53, 'asds', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 10:37:07.848278', 'task', 0),
(142, 53, 'fsdfsd', '00:00', 'sdf', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 11:59:08.772251', 'task', 0),
(143, 53, 'sdad', '0:5', 'asd', 'daily', 'nxt_day', 'high', '', '', '2019-12-13 00:00:00', '[]', NULL, NULL, NULL, '2019-12-13 07:20:20.935004', 'task', 0),
(144, 53, 'asds', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 12:06:25.194990', 'task', 0),
(145, 54, 'Test 123', '02:00', 'No', 'daily', 'nxt_day', 'high', 'Testing ', 'black', '2019-12-06 13:00:00', '[]', NULL, NULL, NULL, '2019-12-05 12:44:00.489554', 'task', 0),
(146, 24, 'Prova', '01:00', '', 'unassigned', 'delete', 'medium', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-05 22:19:57.181866', 'task', 0),
(147, 53, 'dsds', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-07 11:42:41.721247', 'task', 0),
(148, 53, 'dsdsd', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-09 12:51:22.087816', 'task', 0),
(149, 53, 'sadsad', '02:01', 'sdaasd', 'daily', 'nxt_day', 'high', '', '', '2019-12-09 12:51:00', '[]', NULL, NULL, NULL, '2019-12-13 07:10:05.332862', 'task', 1),
(150, 56, 'My task', '00:00', 'No one', 'daily', 'nxt_day', 'low', '', 'red', '2019-12-12 21:03:00', '[{\"value\":\"123456\"},{\"value\":\"654321\"}]', NULL, NULL, NULL, '2019-12-11 21:19:01.804045', 'task', 1),
(151, 56, 'My second ', '00:00', '', 'weekly', 'nxt_week', 'medium', '', 'blue', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-11 21:16:44.854265', 'task', 0),
(152, 59, 'Event', '02:03', 'Test', '', '', '', '', '', '2019-12-12 17:49:00', '\"\"', NULL, '15', 'daily', '2019-12-12 17:50:00.133761', 'event', 0),
(153, 59, 'Test', '00:00', 'Yes', 'daily', 'nxt_week', 'medium', '', 'blue', '2019-12-12 19:47:00', '[]', NULL, NULL, NULL, '2019-12-12 19:47:29.918420', 'task', 0),
(155, 53, 'Bhhhh', '00:00', '', 'daily', 'nxt_day', 'high', 'Test cat', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-13 07:08:38.826995', 'task', 1),
(156, 53, 'BnbV', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-13 07:21:03.909323', 'task', 0),
(157, 54, 'Android ', '1:30', 'No', 'daily', 'nxt_day', 'high', 'Methods ', 'blue', '2019-12-18 10:00:00', '[{\"value\":\"Notifications \"},{\"value\":\"Header \"},{\"value\":\"Footer\"},{\"value\":\"Icons\"},{\"value\":\"Nothing \"}]', NULL, NULL, NULL, '2019-12-17 07:34:21.262923', 'task', 0),
(158, 54, 'Party', '05:00', 'No', '', '', '', '', '', '2019-12-14 08:20:00', '\"\"', NULL, '15', 'weekly', '2019-12-13 08:00:32.025499', 'event', 0),
(159, 24, 'Sub tasks', '00:08', '', 'unassigned', 'delete', 'medium', '', '', '2019-12-13 23:56:00', '[{\"value\":\"St1\"},{\"value\":\"\"},{\"value\":\"\"},{\"value\":\"St4\"},{\"value\":\"\"}]', NULL, NULL, NULL, '2019-12-13 09:57:12.289418', 'task', 0),
(160, 24, 'Repetition', '4:50', '', 'weekly', 'nxt_day', 'medium', '', '', '2019-12-16 13:25:00', '[]', NULL, NULL, NULL, '2019-12-16 17:37:46.488316', 'task', 1),
(161, 53, 'vcvc', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-13 14:54:49.481949', 'task', 0),
(162, 53, 'add 1', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '2019-12-13 16:40:00', '[]', NULL, NULL, NULL, '2019-12-13 16:41:05.160738', 'task', 0),
(163, 53, 'sssss', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-14 06:04:38.749281', 'task', 0),
(164, 53, 'sub task', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '0000-00-00 00:00:00', '[{\"sub_task\":2,\"value\":\"sub 1\"},{\"sub_task\":3,\"value\":\"sub 2\"},{\"sub_task\":4,\"value\":\"sub 3\"},{\"sub_task\":5,\"value\":\"\"}]', NULL, NULL, NULL, '2019-12-14 06:15:55.745950', 'task', 0),
(165, 54, 'My test task', '02:09', 'Rida ', 'daily', 'nxt_day', 'high', 'Test', 'black', '2019-12-14 07:19:00', '[]', NULL, NULL, NULL, '2019-12-14 07:00:03.261772', 'task', 0),
(166, 53, 'duew', '00:00', '', 'daily', 'nxt_day', 'high', '', '', '2019-12-14 13:09:00', '[]', NULL, NULL, NULL, '2019-12-14 07:10:21.617052', 'task', 0),
(167, 53, 'weekl', '00:00', '', 'weekly', 'nxt_week', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-14 07:21:13.076521', 'task', 0),
(169, 53, 'mons', '00:00', '', 'monthly', 'nxt_month', 'high', '', '', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-14 07:55:10.598013', 'task', 0),
(170, 53, 'duww', '00:00', '', 'monthly', 'nxt_month', 'medium', '', '', '2019-12-14 12:55:00', '[]', NULL, NULL, NULL, '2019-12-14 07:56:04.645247', 'task', 0),
(171, 54, 'Games', '10:00', 'No', 'weekly', 'nxt_week', 'high', 'Testing ', 'black', '2019-12-17 10:00:00', '[]', NULL, NULL, NULL, '2019-12-17 07:38:56.566964', 'task', 0),
(172, 53, 'sadsadsad', '00:00', 'ad', 'daily', 'nxt_day', 'low', 'dsadsad', 'red', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-18 12:45:28.762591', 'task', 0),
(173, 53, 'sadasd', '00:00', '', 'monthly', 'nxt_week', 'medium', 'Test cat', 'black', '0000-00-00 00:00:00', '[]', NULL, NULL, NULL, '2019-12-18 12:55:29.079792', 'task', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` text NOT NULL,
  `dob` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `devicetoken` longtext NOT NULL,
  `profile_update_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country`, `dob`, `password`, `created_at`, `devicetoken`, `profile_update_status`) VALUES
(17, 'cvxvcxvx', 'ggfhfgh@xffgcfh.hhj', 'hjgh', '2000-07-01', 'a152e841783914146e4bcd4f39100686', '2019-04-03 10:08:03', '', 0),
(18, 'Faiyaz Alam', 'faiyazcool.alam@gmail.com', 'India', '1992-07-07', 'b427ebd39c845eb5417b7f7aaf1f9724', '2019-05-30 11:22:37', 'sam', 0),
(19, 'fgdfgf', 'sfsfs@vdgs.fdg', 'india', '2002-05-03', 'a152e841783914146e4bcd4f39100686', '2019-04-03 11:28:46', '', 0),
(20, 'ghgfh', 'ghghfg@fghfgh.io', 'vbcvbvb', '1997-01-07', 'a152e841783914146e4bcd4f39100686', '2019-04-03 11:34:25', '', 0),
(21, 'Ibrahim Khan', 'ibrahim@gmail.com', 'india', '2001-05-11', 'a152e841783914146e4bcd4f39100686', '2019-05-23 09:08:00', '', 0),
(22, 'Main alam', 'faiyazcool.alam@gmail.con', 'Indian', '1996-09-08', 'a152e841783914146e4bcd4f39100686', '2019-06-26 16:17:43', '', 0),
(23, 'hggjhdfjg', 'abc@gmail.com', 'india', '1999-02-02', '25d55ad283aa400af464c76d713c07ad', '2019-06-26 17:44:53', 'sam', 0),
(24, 'Matteo', 'matteomakowiecki@gmail.com', 'Italy', '1992-09-05', 'e32ae4e0d9158c00684ec73ce7803ab1', '2019-10-13 21:35:35', 'sam', 0),
(25, 'Adil khan', 'adil@gmail.com', 'India', '1998-09-13', 'a152e841783914146e4bcd4f39100686', '2019-09-18 22:12:21', '1234', 0),
(26, 'Dhoom', '1@1.com', 'Shoom', '1991-12-25', '96e79218965eb72c92a549dd5a330112', '2019-07-28 21:36:41', '', 0),
(27, 'samiran', 'sam@gmail.com', 'india', '1981-01-01', 'e10adc3949ba59abbe56e057f20f883e', '2019-10-21 17:34:07', 'sam', 1),
(28, 'samiran', 'sam1@gmail.com', 'india', '1989-01-01', 'e10adc3949ba59abbe56e057f20f883e', '2019-08-28 19:24:14', '', 0),
(29, 'samiran', 'sam2@gmail.com', 'india', '1989-01-01', 'e10adc3949ba59abbe56e057f20f883e', '2019-08-28 19:24:53', '', 0),
(30, 'demo', 'demo@g.com', 'INDIA', '1986-01-01', 'e10adc3949ba59abbe56e057f20f883e', '2019-08-28 19:26:29', '', 0),
(31, 'samiran', 'sam12@gmail.com', '', '', '', '2019-09-19 21:54:11', '', 0),
(32, 'Rahul', 'rahul@gmail.com', '', '', '', '2019-09-19 22:49:27', '1234', 0),
(33, 'Rahul ', 'raj@gmail.com', '', '', '', '2019-09-23 20:58:50', '', 0),
(34, 'Rohit', 'sami@gmail.com', '', '', '', '2019-09-23 22:31:04', '', 0),
(35, 'test ', 'test1@gmail.com', 'india', '2004-01-01', '', '2019-09-23 22:37:08', '', 1),
(36, 'Rajab Ali', 'rajabali4@gmail.com', 'India', '1978-01-01', '', '2019-09-24 19:41:41', '1234', 1),
(37, 'Farntech', 'farntech@gmail.com', 'India', '1985-01-01', '', '2019-10-23 01:55:17', '1234', 1),
(38, 'Falak', 'Falk@gmail.com', '', '', '', '2019-09-24 20:16:29', '', 0),
(39, 'sssss', 'sss1@g.com', '', '', '', '2019-09-24 20:26:00', '', 0),
(40, 'gggg', 'gg123@gmail.com', 'india', '2000-01-01', '', '2019-09-24 20:32:51', '', 1),
(41, 'Dddd', 'dd1@gmail.com', '', '', '', '2019-09-24 20:45:54', '1234', 0),
(42, 'rrrrr', 'rr@gg.com', 'Australia', '1976-01-01', '', '2019-09-24 21:13:07', '', 1),
(43, 'hhhh', 'hhh@gmail.com', 'india', '2005-01-01', '', '2019-09-24 21:14:54', '', 1),
(44, 'Hhhjjj', 'Gkj@gg.com', '', '', '', '2019-09-24 21:24:15', '1234', 0),
(45, 'oooo', 'oo@gmail.com', '', '', '', '2019-09-24 21:30:14', '1234', 0),
(46, 'Samiran', 'samiran1109@gmail.com', '', '', '', '2019-10-13 17:31:16', '1234', 0),
(47, 'Mjkg', 'mjkgupta1@gmail.com', '', '', '', '2019-10-14 12:21:01', '', 0),
(48, 'German', 'Gtmmm2011@gmail.com', '', '', '', '2019-10-30 13:17:05', 'sam', 0),
(49, 'Gurwinder ', 'gurwinder.s@macrew.net', '', '', '', '2019-11-06 06:28:02', 'sam', 0),
(50, 'jaspreet', 'jp@yopmail.com', 'Madascar', '2005-01-01', '', '2019-11-06 12:25:56', 'sam', 1),
(51, 'Pulpysoft', 'Pulpysoft@gmail.com', 'India', '1970-01-01', '', '2019-11-13 04:16:06', '', 1),
(52, 'Prateek', 'testpkthakur@gmail.com', '', '', '', '2019-11-13 07:02:41', '', 0),
(53, 'Ahmad ', 'touqeermobiles@gmail.com', '', '', '', '2019-11-20 06:04:26', 'sam', 0),
(54, 'Rida', 'Rida13422@gmail.com', '', '', '', '2019-12-02 09:54:50', 'sam', 0),
(56, 'Anas', 'anas@live.com', '', '', '', '2019-12-11 21:01:16', '', 0),
(57, 'Rida', 'mtayyab8124@gmail.com', '', '', '', '2019-12-12 10:56:53', '', 0),
(58, 'Rida', 'ali.qasim@amalacademy.org', '', '', '', '2019-12-12 11:00:03', '', 0),
(59, 'Test minhaj', 'minuciit@gmail.com', 'Pakistan', '1979-01-01', '', '2019-12-12 17:46:25', '', 1),
(60, 'Tayyab ', 'F158124@nu.edu.pk', '', '', '', '2019-12-18 06:42:47', '', 0),
(61, 'Tayyab ', 'fyptwo123@gmail.com', '', '', '', '2019-12-18 06:48:29', '', 0),
(62, 'Rida', 'Ridaa.rida786@gmail.com', '', '', '', '2019-12-18 17:04:36', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`otp_id`);

--
-- Indexes for table `quicknotes`
--
ALTER TABLE `quicknotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `quicknotes`
--
ALTER TABLE `quicknotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
