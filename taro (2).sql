-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2020 at 01:31 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taro`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ack` datetime DEFAULT NULL,
  `first_sent` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `title`, `controller`, `item`, `user_id`, `link`, `type`, `ack`, `first_sent`, `active`, `created`, `modified`) VALUES
(156, 'You have been invited to finish the course Heavy Equipment Training', 'Courses', 34, 18, 'courses/accept-invitation/34', 'CourseEnrolledUser', '2020-01-20 18:55:14', NULL, 1, '2020-01-20 11:57:35', '2020-01-20 18:55:14'),
(157, 'You have been invited to finish the course Heavy Equipment Training', 'Courses', 35, 21, 'courses/accept-invitation/35', 'CourseEnrolledUser', '2020-01-20 11:58:01', NULL, 1, '2020-01-20 11:57:35', '2020-01-20 11:58:01'),
(158, 'Jane Doe submitted the exam \"Theory\"', 'UserTests', 38, 20, '/user-tests/check/38', 'UserTest', '2020-01-20 12:00:07', NULL, 1, '2020-01-20 11:59:54', '2020-01-20 12:00:07'),
(159, 'You passed an exam', 'UserTests', 38, 21, '/user-tests/view/38', 'UserTest', '2020-01-20 12:12:26', NULL, 1, '2020-01-20 12:00:53', '2020-01-20 12:12:26'),
(160, 'You have been invited to finish the course Sample Course', 'Courses', 36, 22, 'courses/accept-invitation/36', 'CourseEnrolledUser', '2020-01-23 13:31:31', NULL, 1, '2020-01-23 13:23:56', '2020-01-23 13:31:31'),
(161, 'John Doe submitted the exam \"Theory\"', 'UserTests', 40, 20, '/user-tests/check/40', 'UserTest', '2020-02-11 16:30:54', NULL, 1, '2020-02-11 16:29:39', '2020-02-11 16:30:54'),
(162, 'You passed an exam', 'UserTests', 40, 18, '/user-tests/view/40', 'UserTest', '2020-03-03 16:12:10', NULL, 1, '2020-02-11 16:31:37', '2020-03-03 16:12:10'),
(163, 'You have been invited to finish the course Monteverde', 'Courses', 37, 18, 'courses/accept-invitation/37', 'CourseEnrolledUser', '2020-03-03 16:11:52', NULL, 1, '2020-03-03 16:10:20', '2020-03-03 16:11:52'),
(164, 'You have been invited to finish the course test 5', 'Courses', 38, 18, 'courses/accept-invitation/38', 'CourseEnrolledUser', '2020-03-03 16:12:04', NULL, 1, '2020-03-03 16:10:39', '2020-03-03 16:12:04'),
(165, 'You have been invited to finish the course Test Course', 'Courses', 39, 18, 'courses/accept-invitation/39', 'CourseEnrolledUser', '2020-03-03 16:13:57', NULL, 1, '2020-03-03 16:13:32', '2020-03-03 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_domains`
--

CREATE TABLE `allowed_domains` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allowed_domains`
--

INSERT INTO `allowed_domains` (`id`, `name`, `domain`, `created`, `modified`) VALUES
(1, 'Google', 'gmail.com', NULL, NULL),
(2, 'Yahoo', 'yahoo.com', '2020-01-13 12:11:00', '2020-01-13 12:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `certification_type_id` int(11) NOT NULL,
  `issuer` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issued` date DEFAULT NULL,
  `expires` date DEFAULT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_date` datetime DEFAULT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filesize` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(6) NOT NULL DEFAULT '2',
  `status_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `user_id`, `certification_type_id`, `issuer`, `issued`, `expires`, `validated_by`, `validated_date`, `valid`, `file_name`, `file_url`, `mime_type`, `filesize`, `extension`, `notes`, `active`, `status`, `status_date`, `created`, `modified`) VALUES
(1, 1, 1, 'test', '2019-10-11', '2020-10-11', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 2, '2019-10-11 15:30:50', '2019-10-11 15:30:50', '2019-10-11 15:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `certification_classes`
--

CREATE TABLE `certification_classes` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_hand` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certification_types`
--

CREATE TABLE `certification_types` (
  `id` int(11) NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certification_class_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certification_types`
--

INSERT INTO `certification_types` (`id`, `category`, `type`, `name`, `certification_class_id`, `description`, `active`, `created`, `modified`) VALUES
(1, 'test', 'testtype', 'Monteverde', NULL, '', 1, '2019-10-11 15:30:00', '2019-10-11 15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE `client_types` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` int(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `data` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `code`, `description`, `active`, `created`, `modified`) VALUES
(9, 'Sample Course', 'SMC111', '<p>This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;This is a sample course.&nbsp;</p>', 1, NULL, NULL),
(10, 'Another Sample Course', 'ASC111', '<p>This is a sample course.&nbsp;This is a sample course. This is a sample course. This is a sample course. This is a sample course.</p>', 1, NULL, NULL),
(11, 'Heavy Equipment Training', 'RIMPO320F', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eleifend bibendum ante, fringi', 1, NULL, NULL),
(12, 'Monteverde', '2343242', '<p>test</p>', 1, NULL, NULL),
(13, 'Test Course', 'test code', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">This document outlines Cross-Origin Read Blocking (CORB), an algorithm by which dubious cross-origin resource loads may be identified and blocked by web browsers before they reach the web page. CORB reduces the risk of leaking sensitive data by keeping it further from cross-origin web pages. In most browsers, it keeps such data out of untrusted script execution contexts. In browsers with&nbsp;</span><a href=\"https://www.chromium.org/Home/chromium-security/site-isolation\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; text-decoration-line: none; color: rgb(119, 89, 174); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">Site Isolation</a><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">, it can keep such data out of untrusted renderer processes entirely, helping even against side channel attacks.</span></p>\r\n', 1, NULL, NULL),
(14, 'test 5', '23232', '<p>test</p>\r\n', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled_attachments`
--

CREATE TABLE `course_enrolled_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_enrolled_test_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `url_name` varchar(255) DEFAULT NULL,
  `url_type` varchar(255) DEFAULT NULL,
  `url_size` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled_modules`
--

CREATE TABLE `course_enrolled_modules` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_enrolled_user_id` int(10) UNSIGNED NOT NULL,
  `course_module_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_complete` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_enrolled_modules`
--

INSERT INTO `course_enrolled_modules` (`id`, `course_enrolled_user_id`, `course_module_id`, `status`, `date_complete`, `created`, `modified`) VALUES
(54, 28, 20, 'invited', NULL, '2020-01-07 18:32:42', '2020-01-07 18:32:42'),
(55, 29, 20, 'invited', NULL, '2020-01-07 18:32:42', '2020-01-07 18:32:42'),
(58, 31, 20, 'accepted', NULL, '2020-01-07 18:35:13', '2020-01-07 18:35:13'),
(59, 30, 20, 'accepted', NULL, '2020-01-07 18:37:31', '2020-01-07 18:37:31'),
(62, 33, 22, 'accepted', NULL, '2020-01-08 16:33:52', '2020-01-08 16:33:52'),
(63, 32, 22, 'accepted', NULL, '2020-01-08 16:34:09', '2020-01-08 16:34:09'),
(66, 35, 22, 'accepted', NULL, '2020-01-20 11:58:01', '2020-01-20 11:58:01'),
(67, 34, 22, 'accepted', NULL, '2020-01-20 18:55:14', '2020-01-20 18:55:14'),
(69, 36, 20, 'accepted', NULL, '2020-01-23 13:31:31', '2020-01-23 13:31:31'),
(72, 37, 23, 'accepted', NULL, '2020-03-03 16:11:53', '2020-03-03 16:11:53'),
(73, 38, 25, 'accepted', NULL, '2020-03-03 16:12:04', '2020-03-03 16:12:04'),
(75, 39, 24, 'accepted', NULL, '2020-03-03 16:13:57', '2020-03-03 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled_tests`
--

CREATE TABLE `course_enrolled_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_test_id` int(11) UNSIGNED DEFAULT NULL,
  `course_enrolled_user_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `test` text,
  `status` varchar(50) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_enrolled_users`
--

CREATE TABLE `course_enrolled_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_complete` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_enrolled_users`
--

INSERT INTO `course_enrolled_users` (`id`, `user_id`, `course_id`, `date_start`, `date_complete`, `status`, `active`, `created`, `modified`) VALUES
(34, 18, 11, NULL, NULL, 'accepted', 1, '2020-01-20 11:57:35', '2020-01-20 18:55:14'),
(35, 21, 11, NULL, NULL, 'accepted', 1, '2020-01-20 11:57:35', '2020-01-20 11:58:01'),
(36, 22, 9, NULL, NULL, 'accepted', 1, '2020-01-23 13:23:55', '2020-01-23 13:31:31'),
(37, 18, 12, NULL, NULL, 'accepted', 1, '2020-03-03 16:10:20', '2020-03-03 16:11:52'),
(38, 18, 14, NULL, NULL, 'accepted', 1, '2020-03-03 16:10:38', '2020-03-03 16:12:04'),
(39, 18, 13, NULL, NULL, 'accepted', 1, '2020-03-03 16:13:32', '2020-03-03 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `course_machine_types`
--

CREATE TABLE `course_machine_types` (
  `id` int(11) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_machine_types`
--

INSERT INTO `course_machine_types` (`id`, `description`, `icon`, `active`, `created`, `modified`) VALUES
(1, 'sample1', NULL, 1, NULL, NULL),
(2, 'sample2', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_modules`
--

CREATE TABLE `course_modules` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `resources_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_modules`
--

INSERT INTO `course_modules` (`id`, `course_id`, `resources_id`, `name`, `code`, `description`, `active`, `created`, `modified`) VALUES
(20, 9, 2, 'Sample Module', 'SM111', '<p>This is a sample module</p>', 1, NULL, NULL),
(21, 10, 2, 'Another Sample Module', 'ASM111', '<p>This is a sample module.&nbsp;This is a sample module.&nbsp;This is a sample module.&nbsp;This is a sample module.&nbsp;This is a sample module.&nbsp;This is a sample module.&nbsp;This is a sample module.&nbsp;</p>', 1, NULL, NULL),
(22, 11, 2, 'Core Knowledge', 'CK111', '<p style=\"margin: 0px 0px 15px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eleifend bibendum ante, fringi', 1, NULL, NULL),
(23, 12, 2, 'Monteverde', '23232', '<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">This document outlines Cross-Origin Read Blocking (CORB), an algorithm by which dubious cross-origin resource loads may be identified and blocked by web browsers before they reach the web page. CORB reduces the risk of leaking sensitive data by keeping it further from cross-origin web pages. In most browsers, it keeps such data out of untrusted script execution contexts. In browsers with&nbsp;</span><a href=\"https://www.chromium.org/Home/chromium-security/site-isolation\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; text-decoration-line: none; color: rgb(119, 89, 174); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">Site Isolation</a><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">, it can keep such data out of untrusted renderer processes entirely, helping even against side channel attacks.</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">This document outlines Cross-Origin Read Blocking (CORB), an algorithm by which dubious cross-origin resource loads may be identified and blocked by web browsers before they reach the web page. CORB reduces the risk of leaking sensitive data by keeping it further from cross-origin web pages. In most browsers, it keeps such data out of untrusted script execution contexts. In browsers with&nbsp;</span><a href=\"https://www.chromium.org/Home/chromium-security/site-isolation\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; text-decoration-line: none; color: rgb(119, 89, 174); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">Site Isolation</a><span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px;\">, it can keep such data out of untrusted renderer processes entirely, helping even against side channel attacks.</span></p>\r\n', 1, NULL, NULL),
(24, 13, 2, 'test name', 'test code', '<p>Lorem ipsum dolor sit amet, mei mutat dolore assentior ex, malis simul vim cu, sint nulla blandit ad pri. Eu mea nonumy possim, ea case decore mnesarchum eum, vis elitr civibus temporibus ei. Erant nemore qui ea, sea cu unum error timeam. Duo ut vide tantas malorum. Ad sit veniam ridens voluptatum, ex vel doming quodsi, meliore adipiscing has ea.</p>\r\n\r\n<p>Epicuri reformidans his in. Et volutpat referrentur quo, vim iisque nostrum torquatos ut. Tritani legimus laoreet mel at, utroque luptatum et eum. Sit affert primis ei, duo id fuisset antiopam, velit iudico scripserit in sit. Pri novum inciderint scribentur ea.</p>\r\n', 1, NULL, NULL),
(25, 14, 2, 'Test Course', 'test', '<p>test</p>\r\n', 1, NULL, NULL),
(26, 14, 2, 'module add', 'test 6', '<p>testing&nbsp;</p>\r\n', 1, NULL, NULL),
(27, 9, 2, 'Monteverde', '69725', '<p>test</p>\r\n', 1, NULL, NULL),
(28, 13, 2, 'test name module', 'te4342', '<p>test&nbsp;</p>\r\n', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_module_machine_types`
--

CREATE TABLE `course_module_machine_types` (
  `id` int(11) NOT NULL,
  `course_module_id` int(11) NOT NULL,
  `course_machine_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course_questions`
--

CREATE TABLE `course_questions` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_test_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `course_question_type_id` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `position` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_questions`
--

INSERT INTO `course_questions` (`id`, `course_test_id`, `title`, `question`, `course_question_type_id`, `img`, `position`, `active`, `created`, `modified`) VALUES
(2, 6, 'Test Question', 'What is the correct answer?', 1, '', 1, 1, '2019-10-11 17:42:41', '2019-11-14 19:22:06'),
(3, 6, 'testtesttest', 'What is this?', 1, '', 3, 1, '2019-10-11 17:57:15', '2019-11-13 16:32:18'),
(4, 6, 'Test Question 3', 'This is a question', 1, '', 4, 1, '2019-10-11 17:57:15', '2019-10-11 17:57:15'),
(23, 6, 'Test Question', 'lwhat is this', 1, '', 2, 1, '2019-10-29 13:01:05', '2019-12-16 15:18:01'),
(30, 6, 'Written answer', 'write an answer', 2, '', 5, 1, '2019-12-20 18:35:24', '2019-12-20 18:35:24'),
(31, 13, 'Sample Question 1', 'What is the correct answer?', 1, '', 1, 1, '2019-12-23 10:14:42', '2020-03-02 17:59:02'),
(32, 13, 'Sample Question 2', 'This is another sample question', 2, '', 2, 1, '2019-12-23 10:16:33', '2020-01-23 13:33:26'),
(33, 14, 'Question', 'List four (4) Excavator components: ', 2, '', 1, 1, '2020-01-08 16:24:28', '2020-01-08 16:24:28'),
(34, 14, 'Question', 'How do you inform a truck to stop when loading it? ', 2, '', 2, 1, '2020-01-08 16:24:48', '2020-01-08 16:24:48'),
(35, 14, 'Question', 'What are three (3) examples of work done by an excavator? ', 2, '', 3, 1, '2020-01-08 16:25:16', '2020-01-08 16:25:16'),
(36, 14, 'Question', 'Where can three (3) examples of sites excavators can be used? ', 2, '', 4, 1, '2020-01-08 16:25:40', '2020-01-08 16:25:40'),
(37, 14, 'Question', 'List three (3) things that you should think about when selecting equipment and attachments: ', 2, '', 5, 1, '2020-01-08 16:28:01', '2020-01-08 16:28:01'),
(38, 14, 'Question', 'List three (3) examples of attachments you could use on an excavator: ', 2, '', 6, 1, '2020-01-08 16:28:24', '2020-01-08 16:28:24'),
(39, 14, 'Question', 'How do you ensure attachment is secure? ', 2, '', 7, 1, '2020-01-08 16:28:46', '2020-01-08 16:28:46'),
(40, 14, 'Question', 'When do you check to see an attachment is secure? ', 2, '', 8, 1, '2020-01-08 16:29:38', '2020-01-08 16:29:38'),
(41, 14, 'Question', 'Before operating an excavator, list three (3) things you need to consider before starting work: ', 2, '', 9, 1, '2020-01-08 16:30:34', '2020-01-08 16:30:34'),
(42, 14, 'Question', 'Where do you look to find the limitations of an excavator? ', 2, '', 10, 1, '2020-01-08 16:30:50', '2020-01-08 16:30:50'),
(43, 14, 'Question', 'All operators need to be kept within limits and capabilities of the machine and equipment you are working. True or false? ', 2, '', 11, 1, '2020-01-08 16:31:04', '2020-01-08 16:31:04'),
(44, 14, 'Question', 'You need authorization before you are able to load/unload an excavator from float or trailer. True or False? ', 2, '', 12, 1, '2020-01-08 16:31:26', '2020-01-08 16:31:26'),
(45, 14, 'Question', 'How do you isolate the excavator before carrying out pre-start and maintenance? ', 2, '', 13, 1, '2020-01-08 16:31:45', '2020-01-08 16:31:45'),
(46, 14, 'Question', 'What document needs to be read and understood before operating the excavator? ', 2, '', 14, 1, '2020-01-08 16:31:59', '2020-01-08 16:31:59'),
(47, 15, 'test', 'test', 1, '', 1, 1, '2020-02-11 15:20:22', '2020-02-11 15:20:22'),
(48, 17, 'test', 'test', 1, '', 1, 1, '2020-03-02 17:57:13', '2020-03-02 17:57:44'),
(49, 18, 'Test Question', 'test', 1, '', 1, 1, '2020-03-02 21:19:28', '2020-03-03 18:28:27'),
(50, 19, 'test', 'test tetest', 1, '', 1, 1, '2020-03-02 21:24:27', '2020-03-03 11:34:22'),
(51, 18, 'test 2 title', 'test 2 title', 1, '', 2, 1, '2020-03-03 15:50:43', '2020-03-03 15:51:00'),
(52, 22, 'Test Question practical', 'Test Question practical task', 1, '', 1, 1, '2020-03-03 16:02:47', '2020-03-03 16:02:47'),
(53, 13, 'Test Question', 'eteetea', 1, '', 3, 1, '2020-03-03 17:41:45', '2020-03-03 17:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `course_question_answers`
--

CREATE TABLE `course_question_answers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `course_question_id` int(11) NOT NULL,
  `course_question_choice_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_question_answers`
--

INSERT INTO `course_question_answers` (`id`, `user_id`, `course_question_id`, `course_question_choice_id`, `created`, `modified`) VALUES
(2, '', 3, 2, '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(11, '', 4, 10, '2019-10-15 18:36:07', '2019-10-15 18:36:07'),
(16, '', 2, 1, '2019-11-06 16:09:05', '2019-11-06 16:09:05'),
(17, '', 23, 23, '2019-11-06 18:23:57', '2019-11-06 18:23:57'),
(18, '', 29, 27, '2019-12-10 20:03:00', '2019-12-10 20:03:00'),
(20, '', 48, 37, '2020-03-02 17:57:25', '2020-03-02 17:57:25'),
(21, '', 31, 31, '2020-03-02 17:59:02', '2020-03-02 17:59:02'),
(25, '', 50, 41, '2020-03-02 21:24:45', '2020-03-02 21:24:45'),
(26, '', 51, 43, '2020-03-03 15:51:00', '2020-03-03 15:51:00'),
(27, '', 53, 49, '2020-03-03 17:46:51', '2020-03-03 17:46:51'),
(28, '', 49, 39, '2020-03-03 18:28:27', '2020-03-03 18:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `course_question_choices`
--

CREATE TABLE `course_question_choices` (
  `id` int(11) NOT NULL,
  `course_question_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_question_choices`
--

INSERT INTO `course_question_choices` (`id`, `course_question_id`, `value`, `created`, `modified`) VALUES
(1, 2, 'Correct Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(2, 3, 'This is the Correct Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(3, 2, 'Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(4, 2, 'Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(5, 2, 'Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(6, 3, 'This is a Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(7, 3, 'This is a Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(8, 3, 'This is a Wrong Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(9, 2, 'Another Wrong Anwer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(10, 4, 'This is the Correct Answer', '2019-10-15 02:27:30', '2019-10-15 02:27:30'),
(22, 23, 'aaa', '2019-10-29 13:01:05', '2019-10-29 13:01:05'),
(23, 23, 'bbbbb', '2019-10-29 13:01:05', '2019-10-29 13:01:05'),
(27, 29, 'test', '2019-12-10 20:02:46', '2019-12-10 20:02:46'),
(28, 29, 'test', '2019-12-10 20:02:46', '2019-12-10 20:02:46'),
(29, 31, 'This is the correct answer', '2019-12-23 10:14:42', '2019-12-23 10:14:42'),
(30, 31, 'This is a wrong answer', '2019-12-23 10:14:42', '2019-12-23 10:14:42'),
(31, 31, 'This is another wrong answer', '2019-12-23 10:14:42', '2019-12-23 10:14:42'),
(32, 47, 'test', '2020-02-11 15:20:22', '2020-02-11 15:20:22'),
(33, 47, 'test', '2020-02-11 15:20:22', '2020-02-11 15:20:22'),
(34, 47, 'test', '2020-02-11 15:20:22', '2020-02-11 15:20:22'),
(35, 47, 'test', '2020-02-11 15:20:22', '2020-02-11 15:20:22'),
(36, 48, 'test', '2020-03-02 17:57:13', '2020-03-02 17:57:13'),
(37, 48, 'test2', '2020-03-02 17:57:13', '2020-03-02 17:57:13'),
(38, 49, 'test', '2020-03-02 21:19:28', '2020-03-02 21:19:28'),
(39, 49, 'test', '2020-03-02 21:19:28', '2020-03-02 21:19:28'),
(40, 49, 'test', '2020-03-02 21:19:28', '2020-03-02 21:19:28'),
(41, 50, 'test test test ', '2020-03-02 21:24:27', '2020-03-02 21:24:27'),
(42, 51, 'test1', '2020-03-03 15:50:43', '2020-03-03 15:50:43'),
(43, 51, 'test2', '2020-03-03 15:50:43', '2020-03-03 15:50:43'),
(44, 51, 'test3', '2020-03-03 15:50:43', '2020-03-03 15:50:43'),
(45, 52, 'task 1', '2020-03-03 16:02:47', '2020-03-03 16:02:47'),
(46, 52, 'task 2', '2020-03-03 16:02:47', '2020-03-03 16:02:47'),
(47, 52, 'task 3', '2020-03-03 16:02:47', '2020-03-03 16:02:47'),
(48, 53, 'test 1', '2020-03-03 17:41:45', '2020-03-03 17:41:45'),
(49, 53, 'test 2', '2020-03-03 17:41:45', '2020-03-03 17:41:45'),
(50, 53, 'test 3', '2020-03-03 17:41:45', '2020-03-03 17:41:45');

-- --------------------------------------------------------

--
-- Table structure for table `course_question_types`
--

CREATE TABLE `course_question_types` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_question_types`
--

INSERT INTO `course_question_types` (`id`, `value`, `created`, `modified`) VALUES
(1, 'Multiple Choice', NULL, NULL),
(2, 'Written Answer', NULL, NULL),
(3, 'Drag and Drop', NULL, NULL),
(4, 'Draw Over Images', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_tests`
--

CREATE TABLE `course_tests` (
  `id` int(11) UNSIGNED NOT NULL,
  `course_module_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `course_test_type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_tests`
--

INSERT INTO `course_tests` (`id`, `course_module_id`, `active`, `created`, `modified`, `course_test_type_id`, `name`) VALUES
(13, 20, 1, NULL, NULL, 1, 'Sample Test'),
(14, 22, 1, NULL, NULL, 1, 'Theory'),
(15, 22, 1, NULL, NULL, 2, 'Practical Test'),
(16, 22, 1, NULL, NULL, 1, ''),
(17, 23, 1, NULL, NULL, 1, 'test'),
(18, 24, 1, NULL, NULL, 1, 'Monteverde'),
(19, 25, 1, NULL, NULL, 1, 'test'),
(20, 24, 1, NULL, NULL, 1, 'test name'),
(21, 24, 1, NULL, NULL, 1, 'test name 3'),
(22, 24, 1, NULL, NULL, 2, 'test practical');

-- --------------------------------------------------------

--
-- Table structure for table `course_test_types`
--

CREATE TABLE `course_test_types` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_test_types`
--

INSERT INTO `course_test_types` (`id`, `value`, `created`, `modified`) VALUES
(1, 'Theory', '2019-10-16 09:14:10', '2019-10-16 09:14:10'),
(2, 'Practical', '2019-10-16 09:14:10', '2019-10-16 09:14:10'),
(3, 'Evidence', '2019-10-16 09:14:10', '2019-10-16 09:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `dashboards`
--

CREATE TABLE `dashboards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboards`
--

INSERT INTO `dashboards` (`id`, `user_id`, `name`, `order`, `created`, `modified`) VALUES
(1, 1, 'Home', 1, '2019-10-10 15:55:50', '2019-10-10 15:55:50'),
(2, 20, 'Home', 1, '2019-11-18 16:32:10', '2019-11-18 16:32:10'),
(3, 20, 'Monteverde', 2, '2019-12-10 13:33:25', '2019-12-10 13:33:25'),
(4, 1, 'test', 2, '2020-03-04 17:30:37', '2020-03-04 17:30:37'),
(5, 1, 'test', 3, '2020-03-04 17:31:11', '2020-03-04 17:31:11'),
(6, 1, 'test', 4, '2020-03-04 17:32:12', '2020-03-04 17:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_items`
--

CREATE TABLE `dashboard_items` (
  `id` int(11) NOT NULL,
  `dashboard_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT '1',
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filter_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filter_value` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dashboard_items`
--

INSERT INTO `dashboard_items` (`id`, `dashboard_id`, `name`, `order`, `title`, `filter_type`, `filter_value`, `created`, `modified`) VALUES
(1, 1, 'new_users', 5, NULL, NULL, NULL, '2019-10-11 15:27:11', '2020-03-03 18:06:47'),
(2, 1, 'equipment_service', 4, NULL, NULL, NULL, '2019-10-11 15:27:25', '2019-11-12 15:13:56'),
(3, 1, 'certifications', 1, NULL, NULL, NULL, '2019-10-11 15:27:29', '2019-11-21 13:05:18'),
(4, 1, 'registers_inprogress', 2, NULL, NULL, NULL, '2019-10-11 15:27:31', '2019-11-12 15:16:21'),
(5, 1, 'registers_stats', 3, NULL, NULL, NULL, '2019-10-11 15:27:33', '2019-11-21 13:05:29'),
(6, 3, 'new_users', 1, NULL, NULL, NULL, '2019-12-10 13:33:45', '2019-12-10 13:34:03'),
(7, 3, 'certifications', 2, NULL, NULL, NULL, '2019-12-10 13:33:54', '2019-12-10 13:33:54'),
(8, 5, 'registers_stats', 1, NULL, NULL, NULL, '2020-03-04 17:31:13', '2020-03-04 17:31:13'),
(9, 5, 'registers_stats', 2, NULL, NULL, NULL, '2020-03-04 17:31:21', '2020-03-04 17:31:21'),
(10, 6, 'registers_stats', 1, NULL, NULL, NULL, '2020-03-04 17:32:17', '2020-03-04 17:32:17'),
(11, 6, 'registers_inprogress', 2, NULL, NULL, NULL, '2020-03-04 17:32:19', '2020-03-04 17:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `dt` date NOT NULL,
  `y` int(6) DEFAULT NULL,
  `q` int(4) DEFAULT NULL,
  `m` int(4) DEFAULT NULL,
  `d` int(4) DEFAULT NULL,
  `dw` int(4) DEFAULT NULL,
  `month_name` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_name` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `w` int(4) DEFAULT NULL,
  `is_weekday` binary(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2019-10-10', 2019, 4, 10, 10, 5, 'October', 'Thursday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-11', 2019, 4, 10, 11, 6, 'October', 'Friday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-12', 2019, 4, 10, 12, 7, 'October', 'Saturday', 40, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-13', 2019, 4, 10, 13, 1, 'October', 'Sunday', 41, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-14', 2019, 4, 10, 14, 2, 'October', 'Monday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-15', 2019, 4, 10, 15, 3, 'October', 'Tuesday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-16', 2019, 4, 10, 16, 4, 'October', 'Wednesday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-17', 2019, 4, 10, 17, 5, 'October', 'Thursday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-18', 2019, 4, 10, 18, 6, 'October', 'Friday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-19', 2019, 4, 10, 19, 7, 'October', 'Saturday', 41, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-20', 2019, 4, 10, 20, 1, 'October', 'Sunday', 42, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-21', 2019, 4, 10, 21, 2, 'October', 'Monday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-22', 2019, 4, 10, 22, 3, 'October', 'Tuesday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-23', 2019, 4, 10, 23, 4, 'October', 'Wednesday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-24', 2019, 4, 10, 24, 5, 'October', 'Thursday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-25', 2019, 4, 10, 25, 6, 'October', 'Friday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-26', 2019, 4, 10, 26, 7, 'October', 'Saturday', 42, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-27', 2019, 4, 10, 27, 1, 'October', 'Sunday', 43, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-28', 2019, 4, 10, 28, 2, 'October', 'Monday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-29', 2019, 4, 10, 29, 3, 'October', 'Tuesday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-30', 2019, 4, 10, 30, 4, 'October', 'Wednesday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-10-31', 2019, 4, 10, 31, 5, 'October', 'Thursday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-01', 2019, 4, 11, 1, 6, 'November', 'Friday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-02', 2019, 4, 11, 2, 7, 'November', 'Saturday', 43, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-03', 2019, 4, 11, 3, 1, 'November', 'Sunday', 44, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-04', 2019, 4, 11, 4, 2, 'November', 'Monday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-05', 2019, 4, 11, 5, 3, 'November', 'Tuesday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-06', 2019, 4, 11, 6, 4, 'November', 'Wednesday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-07', 2019, 4, 11, 7, 5, 'November', 'Thursday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-08', 2019, 4, 11, 8, 6, 'November', 'Friday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-09', 2019, 4, 11, 9, 7, 'November', 'Saturday', 44, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-10', 2019, 4, 11, 10, 1, 'November', 'Sunday', 45, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-11', 2019, 4, 11, 11, 2, 'November', 'Monday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-12', 2019, 4, 11, 12, 3, 'November', 'Tuesday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-13', 2019, 4, 11, 13, 4, 'November', 'Wednesday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-14', 2019, 4, 11, 14, 5, 'November', 'Thursday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-15', 2019, 4, 11, 15, 6, 'November', 'Friday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-16', 2019, 4, 11, 16, 7, 'November', 'Saturday', 45, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-17', 2019, 4, 11, 17, 1, 'November', 'Sunday', 46, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-18', 2019, 4, 11, 18, 2, 'November', 'Monday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-19', 2019, 4, 11, 19, 3, 'November', 'Tuesday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-20', 2019, 4, 11, 20, 4, 'November', 'Wednesday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-21', 2019, 4, 11, 21, 5, 'November', 'Thursday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-22', 2019, 4, 11, 22, 6, 'November', 'Friday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-23', 2019, 4, 11, 23, 7, 'November', 'Saturday', 46, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-24', 2019, 4, 11, 24, 1, 'November', 'Sunday', 47, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-25', 2019, 4, 11, 25, 2, 'November', 'Monday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-26', 2019, 4, 11, 26, 3, 'November', 'Tuesday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-27', 2019, 4, 11, 27, 4, 'November', 'Wednesday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-28', 2019, 4, 11, 28, 5, 'November', 'Thursday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-29', 2019, 4, 11, 29, 6, 'November', 'Friday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-11-30', 2019, 4, 11, 30, 7, 'November', 'Saturday', 47, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-01', 2019, 4, 12, 1, 1, 'December', 'Sunday', 48, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-02', 2019, 4, 12, 2, 2, 'December', 'Monday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-03', 2019, 4, 12, 3, 3, 'December', 'Tuesday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-04', 2019, 4, 12, 4, 4, 'December', 'Wednesday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-05', 2019, 4, 12, 5, 5, 'December', 'Thursday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-06', 2019, 4, 12, 6, 6, 'December', 'Friday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-07', 2019, 4, 12, 7, 7, 'December', 'Saturday', 48, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-08', 2019, 4, 12, 8, 1, 'December', 'Sunday', 49, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-09', 2019, 4, 12, 9, 2, 'December', 'Monday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-10', 2019, 4, 12, 10, 3, 'December', 'Tuesday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-11', 2019, 4, 12, 11, 4, 'December', 'Wednesday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-12', 2019, 4, 12, 12, 5, 'December', 'Thursday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-13', 2019, 4, 12, 13, 6, 'December', 'Friday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-14', 2019, 4, 12, 14, 7, 'December', 'Saturday', 49, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-15', 2019, 4, 12, 15, 1, 'December', 'Sunday', 50, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-16', 2019, 4, 12, 16, 2, 'December', 'Monday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-17', 2019, 4, 12, 17, 3, 'December', 'Tuesday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-18', 2019, 4, 12, 18, 4, 'December', 'Wednesday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-19', 2019, 4, 12, 19, 5, 'December', 'Thursday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-20', 2019, 4, 12, 20, 6, 'December', 'Friday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-21', 2019, 4, 12, 21, 7, 'December', 'Saturday', 50, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-22', 2019, 4, 12, 22, 1, 'December', 'Sunday', 51, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-23', 2019, 4, 12, 23, 2, 'December', 'Monday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-24', 2019, 4, 12, 24, 3, 'December', 'Tuesday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-25', 2019, 4, 12, 25, 4, 'December', 'Wednesday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-26', 2019, 4, 12, 26, 5, 'December', 'Thursday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-27', 2019, 4, 12, 27, 6, 'December', 'Friday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-28', 2019, 4, 12, 28, 7, 'December', 'Saturday', 51, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-29', 2019, 4, 12, 29, 1, 'December', 'Sunday', 52, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-30', 2019, 4, 12, 30, 2, 'December', 'Monday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2019-12-31', 2019, 4, 12, 31, 3, 'December', 'Tuesday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-01', 2020, 1, 1, 1, 4, 'January', 'Wednesday', 0, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-02', 2020, 1, 1, 2, 5, 'January', 'Thursday', 0, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-03', 2020, 1, 1, 3, 6, 'January', 'Friday', 0, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2020-01-04', 2020, 1, 1, 4, 7, 'January', 'Saturday', 0, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-05', 2020, 1, 1, 5, 1, 'January', 'Sunday', 1, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-06', 2020, 1, 1, 6, 2, 'January', 'Monday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-07', 2020, 1, 1, 7, 3, 'January', 'Tuesday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-08', 2020, 1, 1, 8, 4, 'January', 'Wednesday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-09', 2020, 1, 1, 9, 5, 'January', 'Thursday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-10', 2020, 1, 1, 10, 6, 'January', 'Friday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-11', 2020, 1, 1, 11, 7, 'January', 'Saturday', 1, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-12', 2020, 1, 1, 12, 1, 'January', 'Sunday', 2, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-13', 2020, 1, 1, 13, 2, 'January', 'Monday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-14', 2020, 1, 1, 14, 3, 'January', 'Tuesday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-15', 2020, 1, 1, 15, 4, 'January', 'Wednesday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-16', 2020, 1, 1, 16, 5, 'January', 'Thursday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-17', 2020, 1, 1, 17, 6, 'January', 'Friday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-18', 2020, 1, 1, 18, 7, 'January', 'Saturday', 2, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-19', 2020, 1, 1, 19, 1, 'January', 'Sunday', 3, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-20', 2020, 1, 1, 20, 2, 'January', 'Monday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-21', 2020, 1, 1, 21, 3, 'January', 'Tuesday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-22', 2020, 1, 1, 22, 4, 'January', 'Wednesday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-23', 2020, 1, 1, 23, 5, 'January', 'Thursday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-24', 2020, 1, 1, 24, 6, 'January', 'Friday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-25', 2020, 1, 1, 25, 7, 'January', 'Saturday', 3, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-26', 2020, 1, 1, 26, 1, 'January', 'Sunday', 4, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-27', 2020, 1, 1, 27, 2, 'January', 'Monday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-28', 2020, 1, 1, 28, 3, 'January', 'Tuesday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-29', 2020, 1, 1, 29, 4, 'January', 'Wednesday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-30', 2020, 1, 1, 30, 5, 'January', 'Thursday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-01-31', 2020, 1, 1, 31, 6, 'January', 'Friday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-01', 2020, 1, 2, 1, 7, 'February', 'Saturday', 4, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-02', 2020, 1, 2, 2, 1, 'February', 'Sunday', 5, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-03', 2020, 1, 2, 3, 2, 'February', 'Monday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-04', 2020, 1, 2, 4, 3, 'February', 'Tuesday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-05', 2020, 1, 2, 5, 4, 'February', 'Wednesday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-06', 2020, 1, 2, 6, 5, 'February', 'Thursday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-07', 2020, 1, 2, 7, 6, 'February', 'Friday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-08', 2020, 1, 2, 8, 7, 'February', 'Saturday', 5, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-09', 2020, 1, 2, 9, 1, 'February', 'Sunday', 6, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-10', 2020, 1, 2, 10, 2, 'February', 'Monday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-11', 2020, 1, 2, 11, 3, 'February', 'Tuesday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-12', 2020, 1, 2, 12, 4, 'February', 'Wednesday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-13', 2020, 1, 2, 13, 5, 'February', 'Thursday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-14', 2020, 1, 2, 14, 6, 'February', 'Friday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-15', 2020, 1, 2, 15, 7, 'February', 'Saturday', 6, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-16', 2020, 1, 2, 16, 1, 'February', 'Sunday', 7, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-17', 2020, 1, 2, 17, 2, 'February', 'Monday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-18', 2020, 1, 2, 18, 3, 'February', 'Tuesday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-19', 2020, 1, 2, 19, 4, 'February', 'Wednesday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-20', 2020, 1, 2, 20, 5, 'February', 'Thursday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-21', 2020, 1, 2, 21, 6, 'February', 'Friday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-22', 2020, 1, 2, 22, 7, 'February', 'Saturday', 7, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-23', 2020, 1, 2, 23, 1, 'February', 'Sunday', 8, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-24', 2020, 1, 2, 24, 2, 'February', 'Monday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-25', 2020, 1, 2, 25, 3, 'February', 'Tuesday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-26', 2020, 1, 2, 26, 4, 'February', 'Wednesday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-27', 2020, 1, 2, 27, 5, 'February', 'Thursday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-28', 2020, 1, 2, 28, 6, 'February', 'Friday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-02-29', 2020, 1, 2, 29, 7, 'February', 'Saturday', 8, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-01', 2020, 1, 3, 1, 1, 'March', 'Sunday', 9, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-02', 2020, 1, 3, 2, 2, 'March', 'Monday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-03', 2020, 1, 3, 3, 3, 'March', 'Tuesday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-04', 2020, 1, 3, 4, 4, 'March', 'Wednesday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-05', 2020, 1, 3, 5, 5, 'March', 'Thursday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-06', 2020, 1, 3, 6, 6, 'March', 'Friday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-07', 2020, 1, 3, 7, 7, 'March', 'Saturday', 9, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-08', 2020, 1, 3, 8, 1, 'March', 'Sunday', 10, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-09', 2020, 1, 3, 9, 2, 'March', 'Monday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-10', 2020, 1, 3, 10, 3, 'March', 'Tuesday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-11', 2020, 1, 3, 11, 4, 'March', 'Wednesday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-12', 2020, 1, 3, 12, 5, 'March', 'Thursday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-13', 2020, 1, 3, 13, 6, 'March', 'Friday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-14', 2020, 1, 3, 14, 7, 'March', 'Saturday', 10, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-15', 2020, 1, 3, 15, 1, 'March', 'Sunday', 11, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-16', 2020, 1, 3, 16, 2, 'March', 'Monday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-17', 2020, 1, 3, 17, 3, 'March', 'Tuesday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-18', 2020, 1, 3, 18, 4, 'March', 'Wednesday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-19', 2020, 1, 3, 19, 5, 'March', 'Thursday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-20', 2020, 1, 3, 20, 6, 'March', 'Friday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-21', 2020, 1, 3, 21, 7, 'March', 'Saturday', 11, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-22', 2020, 1, 3, 22, 1, 'March', 'Sunday', 12, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-23', 2020, 1, 3, 23, 2, 'March', 'Monday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-24', 2020, 1, 3, 24, 3, 'March', 'Tuesday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-25', 2020, 1, 3, 25, 4, 'March', 'Wednesday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-26', 2020, 1, 3, 26, 5, 'March', 'Thursday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-27', 2020, 1, 3, 27, 6, 'March', 'Friday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-28', 2020, 1, 3, 28, 7, 'March', 'Saturday', 12, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-29', 2020, 1, 3, 29, 1, 'March', 'Sunday', 13, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-03-30', 2020, 1, 3, 30, 2, 'March', 'Monday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2020-03-31', 2020, 1, 3, 31, 3, 'March', 'Tuesday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-01', 2020, 2, 4, 1, 4, 'April', 'Wednesday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-02', 2020, 2, 4, 2, 5, 'April', 'Thursday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-03', 2020, 2, 4, 3, 6, 'April', 'Friday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-04', 2020, 2, 4, 4, 7, 'April', 'Saturday', 13, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-05', 2020, 2, 4, 5, 1, 'April', 'Sunday', 14, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-06', 2020, 2, 4, 6, 2, 'April', 'Monday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-07', 2020, 2, 4, 7, 3, 'April', 'Tuesday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-08', 2020, 2, 4, 8, 4, 'April', 'Wednesday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-09', 2020, 2, 4, 9, 5, 'April', 'Thursday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-10', 2020, 2, 4, 10, 6, 'April', 'Friday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-11', 2020, 2, 4, 11, 7, 'April', 'Saturday', 14, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-12', 2020, 2, 4, 12, 1, 'April', 'Sunday', 15, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-13', 2020, 2, 4, 13, 2, 'April', 'Monday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-14', 2020, 2, 4, 14, 3, 'April', 'Tuesday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-15', 2020, 2, 4, 15, 4, 'April', 'Wednesday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-16', 2020, 2, 4, 16, 5, 'April', 'Thursday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-17', 2020, 2, 4, 17, 6, 'April', 'Friday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-18', 2020, 2, 4, 18, 7, 'April', 'Saturday', 15, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-19', 2020, 2, 4, 19, 1, 'April', 'Sunday', 16, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-20', 2020, 2, 4, 20, 2, 'April', 'Monday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-21', 2020, 2, 4, 21, 3, 'April', 'Tuesday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-22', 2020, 2, 4, 22, 4, 'April', 'Wednesday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-23', 2020, 2, 4, 23, 5, 'April', 'Thursday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-24', 2020, 2, 4, 24, 6, 'April', 'Friday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-25', 2020, 2, 4, 25, 7, 'April', 'Saturday', 16, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-26', 2020, 2, 4, 26, 1, 'April', 'Sunday', 17, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-27', 2020, 2, 4, 27, 2, 'April', 'Monday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-28', 2020, 2, 4, 28, 3, 'April', 'Tuesday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-29', 2020, 2, 4, 29, 4, 'April', 'Wednesday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-04-30', 2020, 2, 4, 30, 5, 'April', 'Thursday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-01', 2020, 2, 5, 1, 6, 'May', 'Friday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-02', 2020, 2, 5, 2, 7, 'May', 'Saturday', 17, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-03', 2020, 2, 5, 3, 1, 'May', 'Sunday', 18, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-04', 2020, 2, 5, 4, 2, 'May', 'Monday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-05', 2020, 2, 5, 5, 3, 'May', 'Tuesday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-06', 2020, 2, 5, 6, 4, 'May', 'Wednesday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-07', 2020, 2, 5, 7, 5, 'May', 'Thursday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-08', 2020, 2, 5, 8, 6, 'May', 'Friday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-09', 2020, 2, 5, 9, 7, 'May', 'Saturday', 18, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-10', 2020, 2, 5, 10, 1, 'May', 'Sunday', 19, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-11', 2020, 2, 5, 11, 2, 'May', 'Monday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-12', 2020, 2, 5, 12, 3, 'May', 'Tuesday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-13', 2020, 2, 5, 13, 4, 'May', 'Wednesday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-14', 2020, 2, 5, 14, 5, 'May', 'Thursday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-15', 2020, 2, 5, 15, 6, 'May', 'Friday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-16', 2020, 2, 5, 16, 7, 'May', 'Saturday', 19, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-17', 2020, 2, 5, 17, 1, 'May', 'Sunday', 20, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-18', 2020, 2, 5, 18, 2, 'May', 'Monday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-19', 2020, 2, 5, 19, 3, 'May', 'Tuesday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-20', 2020, 2, 5, 20, 4, 'May', 'Wednesday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-21', 2020, 2, 5, 21, 5, 'May', 'Thursday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-22', 2020, 2, 5, 22, 6, 'May', 'Friday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-23', 2020, 2, 5, 23, 7, 'May', 'Saturday', 20, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-24', 2020, 2, 5, 24, 1, 'May', 'Sunday', 21, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-25', 2020, 2, 5, 25, 2, 'May', 'Monday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-26', 2020, 2, 5, 26, 3, 'May', 'Tuesday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-27', 2020, 2, 5, 27, 4, 'May', 'Wednesday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-28', 2020, 2, 5, 28, 5, 'May', 'Thursday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-29', 2020, 2, 5, 29, 6, 'May', 'Friday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-30', 2020, 2, 5, 30, 7, 'May', 'Saturday', 21, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-05-31', 2020, 2, 5, 31, 1, 'May', 'Sunday', 22, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-01', 2020, 2, 6, 1, 2, 'June', 'Monday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-02', 2020, 2, 6, 2, 3, 'June', 'Tuesday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-03', 2020, 2, 6, 3, 4, 'June', 'Wednesday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-04', 2020, 2, 6, 4, 5, 'June', 'Thursday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-05', 2020, 2, 6, 5, 6, 'June', 'Friday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-06', 2020, 2, 6, 6, 7, 'June', 'Saturday', 22, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-07', 2020, 2, 6, 7, 1, 'June', 'Sunday', 23, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-08', 2020, 2, 6, 8, 2, 'June', 'Monday', 23, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-09', 2020, 2, 6, 9, 3, 'June', 'Tuesday', 23, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-10', 2020, 2, 6, 10, 4, 'June', 'Wednesday', 23, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-11', 2020, 2, 6, 11, 5, 'June', 'Thursday', 23, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-12', 2020, 2, 6, 12, 6, 'June', 'Friday', 23, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-13', 2020, 2, 6, 13, 7, 'June', 'Saturday', 23, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-14', 2020, 2, 6, 14, 1, 'June', 'Sunday', 24, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-15', 2020, 2, 6, 15, 2, 'June', 'Monday', 24, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-16', 2020, 2, 6, 16, 3, 'June', 'Tuesday', 24, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-17', 2020, 2, 6, 17, 4, 'June', 'Wednesday', 24, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-18', 2020, 2, 6, 18, 5, 'June', 'Thursday', 24, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-19', 2020, 2, 6, 19, 6, 'June', 'Friday', 24, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-20', 2020, 2, 6, 20, 7, 'June', 'Saturday', 24, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-21', 2020, 2, 6, 21, 1, 'June', 'Sunday', 25, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-22', 2020, 2, 6, 22, 2, 'June', 'Monday', 25, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-23', 2020, 2, 6, 23, 3, 'June', 'Tuesday', 25, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-24', 2020, 2, 6, 24, 4, 'June', 'Wednesday', 25, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-25', 2020, 2, 6, 25, 5, 'June', 'Thursday', 25, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2020-06-26', 2020, 2, 6, 26, 6, 'June', 'Friday', 25, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-27', 2020, 2, 6, 27, 7, 'June', 'Saturday', 25, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-28', 2020, 2, 6, 28, 1, 'June', 'Sunday', 26, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-29', 2020, 2, 6, 29, 2, 'June', 'Monday', 26, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-06-30', 2020, 2, 6, 30, 3, 'June', 'Tuesday', 26, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-01', 2020, 3, 7, 1, 4, 'July', 'Wednesday', 26, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-02', 2020, 3, 7, 2, 5, 'July', 'Thursday', 26, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-03', 2020, 3, 7, 3, 6, 'July', 'Friday', 26, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-04', 2020, 3, 7, 4, 7, 'July', 'Saturday', 26, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-05', 2020, 3, 7, 5, 1, 'July', 'Sunday', 27, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-06', 2020, 3, 7, 6, 2, 'July', 'Monday', 27, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-07', 2020, 3, 7, 7, 3, 'July', 'Tuesday', 27, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-08', 2020, 3, 7, 8, 4, 'July', 'Wednesday', 27, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-09', 2020, 3, 7, 9, 5, 'July', 'Thursday', 27, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-10', 2020, 3, 7, 10, 6, 'July', 'Friday', 27, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-11', 2020, 3, 7, 11, 7, 'July', 'Saturday', 27, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-12', 2020, 3, 7, 12, 1, 'July', 'Sunday', 28, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-13', 2020, 3, 7, 13, 2, 'July', 'Monday', 28, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-14', 2020, 3, 7, 14, 3, 'July', 'Tuesday', 28, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-15', 2020, 3, 7, 15, 4, 'July', 'Wednesday', 28, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-16', 2020, 3, 7, 16, 5, 'July', 'Thursday', 28, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-17', 2020, 3, 7, 17, 6, 'July', 'Friday', 28, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-18', 2020, 3, 7, 18, 7, 'July', 'Saturday', 28, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-19', 2020, 3, 7, 19, 1, 'July', 'Sunday', 29, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-20', 2020, 3, 7, 20, 2, 'July', 'Monday', 29, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-21', 2020, 3, 7, 21, 3, 'July', 'Tuesday', 29, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-22', 2020, 3, 7, 22, 4, 'July', 'Wednesday', 29, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-23', 2020, 3, 7, 23, 5, 'July', 'Thursday', 29, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-24', 2020, 3, 7, 24, 6, 'July', 'Friday', 29, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-25', 2020, 3, 7, 25, 7, 'July', 'Saturday', 29, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-26', 2020, 3, 7, 26, 1, 'July', 'Sunday', 30, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-27', 2020, 3, 7, 27, 2, 'July', 'Monday', 30, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-28', 2020, 3, 7, 28, 3, 'July', 'Tuesday', 30, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-29', 2020, 3, 7, 29, 4, 'July', 'Wednesday', 30, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-30', 2020, 3, 7, 30, 5, 'July', 'Thursday', 30, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-07-31', 2020, 3, 7, 31, 6, 'July', 'Friday', 30, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-01', 2020, 3, 8, 1, 7, 'August', 'Saturday', 30, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-02', 2020, 3, 8, 2, 1, 'August', 'Sunday', 31, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-03', 2020, 3, 8, 3, 2, 'August', 'Monday', 31, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-04', 2020, 3, 8, 4, 3, 'August', 'Tuesday', 31, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-05', 2020, 3, 8, 5, 4, 'August', 'Wednesday', 31, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-06', 2020, 3, 8, 6, 5, 'August', 'Thursday', 31, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-07', 2020, 3, 8, 7, 6, 'August', 'Friday', 31, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-08', 2020, 3, 8, 8, 7, 'August', 'Saturday', 31, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-09', 2020, 3, 8, 9, 1, 'August', 'Sunday', 32, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-10', 2020, 3, 8, 10, 2, 'August', 'Monday', 32, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-11', 2020, 3, 8, 11, 3, 'August', 'Tuesday', 32, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-12', 2020, 3, 8, 12, 4, 'August', 'Wednesday', 32, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-13', 2020, 3, 8, 13, 5, 'August', 'Thursday', 32, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-14', 2020, 3, 8, 14, 6, 'August', 'Friday', 32, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-15', 2020, 3, 8, 15, 7, 'August', 'Saturday', 32, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-16', 2020, 3, 8, 16, 1, 'August', 'Sunday', 33, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-17', 2020, 3, 8, 17, 2, 'August', 'Monday', 33, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-18', 2020, 3, 8, 18, 3, 'August', 'Tuesday', 33, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-19', 2020, 3, 8, 19, 4, 'August', 'Wednesday', 33, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-20', 2020, 3, 8, 20, 5, 'August', 'Thursday', 33, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-21', 2020, 3, 8, 21, 6, 'August', 'Friday', 33, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-22', 2020, 3, 8, 22, 7, 'August', 'Saturday', 33, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-23', 2020, 3, 8, 23, 1, 'August', 'Sunday', 34, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-24', 2020, 3, 8, 24, 2, 'August', 'Monday', 34, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-25', 2020, 3, 8, 25, 3, 'August', 'Tuesday', 34, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-26', 2020, 3, 8, 26, 4, 'August', 'Wednesday', 34, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-27', 2020, 3, 8, 27, 5, 'August', 'Thursday', 34, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-28', 2020, 3, 8, 28, 6, 'August', 'Friday', 34, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-29', 2020, 3, 8, 29, 7, 'August', 'Saturday', 34, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-30', 2020, 3, 8, 30, 1, 'August', 'Sunday', 35, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-08-31', 2020, 3, 8, 31, 2, 'August', 'Monday', 35, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-01', 2020, 3, 9, 1, 3, 'September', 'Tuesday', 35, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-02', 2020, 3, 9, 2, 4, 'September', 'Wednesday', 35, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-03', 2020, 3, 9, 3, 5, 'September', 'Thursday', 35, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-04', 2020, 3, 9, 4, 6, 'September', 'Friday', 35, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-05', 2020, 3, 9, 5, 7, 'September', 'Saturday', 35, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-06', 2020, 3, 9, 6, 1, 'September', 'Sunday', 36, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-07', 2020, 3, 9, 7, 2, 'September', 'Monday', 36, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-08', 2020, 3, 9, 8, 3, 'September', 'Tuesday', 36, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-09', 2020, 3, 9, 9, 4, 'September', 'Wednesday', 36, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-10', 2020, 3, 9, 10, 5, 'September', 'Thursday', 36, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-11', 2020, 3, 9, 11, 6, 'September', 'Friday', 36, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-12', 2020, 3, 9, 12, 7, 'September', 'Saturday', 36, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-13', 2020, 3, 9, 13, 1, 'September', 'Sunday', 37, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-14', 2020, 3, 9, 14, 2, 'September', 'Monday', 37, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-15', 2020, 3, 9, 15, 3, 'September', 'Tuesday', 37, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-16', 2020, 3, 9, 16, 4, 'September', 'Wednesday', 37, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-17', 2020, 3, 9, 17, 5, 'September', 'Thursday', 37, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-18', 2020, 3, 9, 18, 6, 'September', 'Friday', 37, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-19', 2020, 3, 9, 19, 7, 'September', 'Saturday', 37, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-20', 2020, 3, 9, 20, 1, 'September', 'Sunday', 38, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2020-09-21', 2020, 3, 9, 21, 2, 'September', 'Monday', 38, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-22', 2020, 3, 9, 22, 3, 'September', 'Tuesday', 38, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-23', 2020, 3, 9, 23, 4, 'September', 'Wednesday', 38, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-24', 2020, 3, 9, 24, 5, 'September', 'Thursday', 38, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-25', 2020, 3, 9, 25, 6, 'September', 'Friday', 38, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-26', 2020, 3, 9, 26, 7, 'September', 'Saturday', 38, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-27', 2020, 3, 9, 27, 1, 'September', 'Sunday', 39, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-28', 2020, 3, 9, 28, 2, 'September', 'Monday', 39, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-29', 2020, 3, 9, 29, 3, 'September', 'Tuesday', 39, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-09-30', 2020, 3, 9, 30, 4, 'September', 'Wednesday', 39, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-01', 2020, 4, 10, 1, 5, 'October', 'Thursday', 39, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-02', 2020, 4, 10, 2, 6, 'October', 'Friday', 39, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-03', 2020, 4, 10, 3, 7, 'October', 'Saturday', 39, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-04', 2020, 4, 10, 4, 1, 'October', 'Sunday', 40, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-05', 2020, 4, 10, 5, 2, 'October', 'Monday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-06', 2020, 4, 10, 6, 3, 'October', 'Tuesday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-07', 2020, 4, 10, 7, 4, 'October', 'Wednesday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-08', 2020, 4, 10, 8, 5, 'October', 'Thursday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-09', 2020, 4, 10, 9, 6, 'October', 'Friday', 40, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-10', 2020, 4, 10, 10, 7, 'October', 'Saturday', 40, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-11', 2020, 4, 10, 11, 1, 'October', 'Sunday', 41, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-12', 2020, 4, 10, 12, 2, 'October', 'Monday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-13', 2020, 4, 10, 13, 3, 'October', 'Tuesday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-14', 2020, 4, 10, 14, 4, 'October', 'Wednesday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-15', 2020, 4, 10, 15, 5, 'October', 'Thursday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-16', 2020, 4, 10, 16, 6, 'October', 'Friday', 41, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-17', 2020, 4, 10, 17, 7, 'October', 'Saturday', 41, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-18', 2020, 4, 10, 18, 1, 'October', 'Sunday', 42, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-19', 2020, 4, 10, 19, 2, 'October', 'Monday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-20', 2020, 4, 10, 20, 3, 'October', 'Tuesday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-21', 2020, 4, 10, 21, 4, 'October', 'Wednesday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-22', 2020, 4, 10, 22, 5, 'October', 'Thursday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-23', 2020, 4, 10, 23, 6, 'October', 'Friday', 42, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-24', 2020, 4, 10, 24, 7, 'October', 'Saturday', 42, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-25', 2020, 4, 10, 25, 1, 'October', 'Sunday', 43, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-26', 2020, 4, 10, 26, 2, 'October', 'Monday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-27', 2020, 4, 10, 27, 3, 'October', 'Tuesday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-28', 2020, 4, 10, 28, 4, 'October', 'Wednesday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-29', 2020, 4, 10, 29, 5, 'October', 'Thursday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-30', 2020, 4, 10, 30, 6, 'October', 'Friday', 43, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-10-31', 2020, 4, 10, 31, 7, 'October', 'Saturday', 43, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-01', 2020, 4, 11, 1, 1, 'November', 'Sunday', 44, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-02', 2020, 4, 11, 2, 2, 'November', 'Monday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-03', 2020, 4, 11, 3, 3, 'November', 'Tuesday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-04', 2020, 4, 11, 4, 4, 'November', 'Wednesday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-05', 2020, 4, 11, 5, 5, 'November', 'Thursday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-06', 2020, 4, 11, 6, 6, 'November', 'Friday', 44, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-07', 2020, 4, 11, 7, 7, 'November', 'Saturday', 44, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-08', 2020, 4, 11, 8, 1, 'November', 'Sunday', 45, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-09', 2020, 4, 11, 9, 2, 'November', 'Monday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-10', 2020, 4, 11, 10, 3, 'November', 'Tuesday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-11', 2020, 4, 11, 11, 4, 'November', 'Wednesday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-12', 2020, 4, 11, 12, 5, 'November', 'Thursday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-13', 2020, 4, 11, 13, 6, 'November', 'Friday', 45, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-14', 2020, 4, 11, 14, 7, 'November', 'Saturday', 45, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-15', 2020, 4, 11, 15, 1, 'November', 'Sunday', 46, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-16', 2020, 4, 11, 16, 2, 'November', 'Monday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-17', 2020, 4, 11, 17, 3, 'November', 'Tuesday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-18', 2020, 4, 11, 18, 4, 'November', 'Wednesday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-19', 2020, 4, 11, 19, 5, 'November', 'Thursday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-20', 2020, 4, 11, 20, 6, 'November', 'Friday', 46, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-21', 2020, 4, 11, 21, 7, 'November', 'Saturday', 46, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-22', 2020, 4, 11, 22, 1, 'November', 'Sunday', 47, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-23', 2020, 4, 11, 23, 2, 'November', 'Monday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-24', 2020, 4, 11, 24, 3, 'November', 'Tuesday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-25', 2020, 4, 11, 25, 4, 'November', 'Wednesday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-26', 2020, 4, 11, 26, 5, 'November', 'Thursday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-27', 2020, 4, 11, 27, 6, 'November', 'Friday', 47, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-28', 2020, 4, 11, 28, 7, 'November', 'Saturday', 47, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-29', 2020, 4, 11, 29, 1, 'November', 'Sunday', 48, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-11-30', 2020, 4, 11, 30, 2, 'November', 'Monday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-01', 2020, 4, 12, 1, 3, 'December', 'Tuesday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-02', 2020, 4, 12, 2, 4, 'December', 'Wednesday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-03', 2020, 4, 12, 3, 5, 'December', 'Thursday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-04', 2020, 4, 12, 4, 6, 'December', 'Friday', 48, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-05', 2020, 4, 12, 5, 7, 'December', 'Saturday', 48, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-06', 2020, 4, 12, 6, 1, 'December', 'Sunday', 49, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-07', 2020, 4, 12, 7, 2, 'December', 'Monday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-08', 2020, 4, 12, 8, 3, 'December', 'Tuesday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-09', 2020, 4, 12, 9, 4, 'December', 'Wednesday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-10', 2020, 4, 12, 10, 5, 'December', 'Thursday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-11', 2020, 4, 12, 11, 6, 'December', 'Friday', 49, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-12', 2020, 4, 12, 12, 7, 'December', 'Saturday', 49, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-13', 2020, 4, 12, 13, 1, 'December', 'Sunday', 50, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-14', 2020, 4, 12, 14, 2, 'December', 'Monday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-15', 2020, 4, 12, 15, 3, 'December', 'Tuesday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2020-12-16', 2020, 4, 12, 16, 4, 'December', 'Wednesday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-17', 2020, 4, 12, 17, 5, 'December', 'Thursday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-18', 2020, 4, 12, 18, 6, 'December', 'Friday', 50, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-19', 2020, 4, 12, 19, 7, 'December', 'Saturday', 50, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-20', 2020, 4, 12, 20, 1, 'December', 'Sunday', 51, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-21', 2020, 4, 12, 21, 2, 'December', 'Monday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-22', 2020, 4, 12, 22, 3, 'December', 'Tuesday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-23', 2020, 4, 12, 23, 4, 'December', 'Wednesday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-24', 2020, 4, 12, 24, 5, 'December', 'Thursday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-25', 2020, 4, 12, 25, 6, 'December', 'Friday', 51, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-26', 2020, 4, 12, 26, 7, 'December', 'Saturday', 51, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-27', 2020, 4, 12, 27, 1, 'December', 'Sunday', 52, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-28', 2020, 4, 12, 28, 2, 'December', 'Monday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-29', 2020, 4, 12, 29, 3, 'December', 'Tuesday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-30', 2020, 4, 12, 30, 4, 'December', 'Wednesday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2020-12-31', 2020, 4, 12, 31, 5, 'December', 'Thursday', 52, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-01', 2021, 1, 1, 1, 6, 'January', 'Friday', 0, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-02', 2021, 1, 1, 2, 7, 'January', 'Saturday', 0, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-03', 2021, 1, 1, 3, 1, 'January', 'Sunday', 1, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-04', 2021, 1, 1, 4, 2, 'January', 'Monday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-05', 2021, 1, 1, 5, 3, 'January', 'Tuesday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-06', 2021, 1, 1, 6, 4, 'January', 'Wednesday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-07', 2021, 1, 1, 7, 5, 'January', 'Thursday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-08', 2021, 1, 1, 8, 6, 'January', 'Friday', 1, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-09', 2021, 1, 1, 9, 7, 'January', 'Saturday', 1, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-10', 2021, 1, 1, 10, 1, 'January', 'Sunday', 2, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-11', 2021, 1, 1, 11, 2, 'January', 'Monday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-12', 2021, 1, 1, 12, 3, 'January', 'Tuesday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-13', 2021, 1, 1, 13, 4, 'January', 'Wednesday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-14', 2021, 1, 1, 14, 5, 'January', 'Thursday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-15', 2021, 1, 1, 15, 6, 'January', 'Friday', 2, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-16', 2021, 1, 1, 16, 7, 'January', 'Saturday', 2, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-17', 2021, 1, 1, 17, 1, 'January', 'Sunday', 3, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-18', 2021, 1, 1, 18, 2, 'January', 'Monday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-19', 2021, 1, 1, 19, 3, 'January', 'Tuesday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-20', 2021, 1, 1, 20, 4, 'January', 'Wednesday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-21', 2021, 1, 1, 21, 5, 'January', 'Thursday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-22', 2021, 1, 1, 22, 6, 'January', 'Friday', 3, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-23', 2021, 1, 1, 23, 7, 'January', 'Saturday', 3, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-24', 2021, 1, 1, 24, 1, 'January', 'Sunday', 4, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-25', 2021, 1, 1, 25, 2, 'January', 'Monday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-26', 2021, 1, 1, 26, 3, 'January', 'Tuesday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-27', 2021, 1, 1, 27, 4, 'January', 'Wednesday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-28', 2021, 1, 1, 28, 5, 'January', 'Thursday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-29', 2021, 1, 1, 29, 6, 'January', 'Friday', 4, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-30', 2021, 1, 1, 30, 7, 'January', 'Saturday', 4, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-01-31', 2021, 1, 1, 31, 1, 'January', 'Sunday', 5, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-01', 2021, 1, 2, 1, 2, 'February', 'Monday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-02', 2021, 1, 2, 2, 3, 'February', 'Tuesday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-03', 2021, 1, 2, 3, 4, 'February', 'Wednesday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-04', 2021, 1, 2, 4, 5, 'February', 'Thursday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-05', 2021, 1, 2, 5, 6, 'February', 'Friday', 5, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-06', 2021, 1, 2, 6, 7, 'February', 'Saturday', 5, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-07', 2021, 1, 2, 7, 1, 'February', 'Sunday', 6, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-08', 2021, 1, 2, 8, 2, 'February', 'Monday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-09', 2021, 1, 2, 9, 3, 'February', 'Tuesday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-10', 2021, 1, 2, 10, 4, 'February', 'Wednesday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-11', 2021, 1, 2, 11, 5, 'February', 'Thursday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-12', 2021, 1, 2, 12, 6, 'February', 'Friday', 6, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-13', 2021, 1, 2, 13, 7, 'February', 'Saturday', 6, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-14', 2021, 1, 2, 14, 1, 'February', 'Sunday', 7, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-15', 2021, 1, 2, 15, 2, 'February', 'Monday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-16', 2021, 1, 2, 16, 3, 'February', 'Tuesday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-17', 2021, 1, 2, 17, 4, 'February', 'Wednesday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-18', 2021, 1, 2, 18, 5, 'February', 'Thursday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-19', 2021, 1, 2, 19, 6, 'February', 'Friday', 7, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-20', 2021, 1, 2, 20, 7, 'February', 'Saturday', 7, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-21', 2021, 1, 2, 21, 1, 'February', 'Sunday', 8, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-22', 2021, 1, 2, 22, 2, 'February', 'Monday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-23', 2021, 1, 2, 23, 3, 'February', 'Tuesday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-24', 2021, 1, 2, 24, 4, 'February', 'Wednesday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-25', 2021, 1, 2, 25, 5, 'February', 'Thursday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-26', 2021, 1, 2, 26, 6, 'February', 'Friday', 8, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-27', 2021, 1, 2, 27, 7, 'February', 'Saturday', 8, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-02-28', 2021, 1, 2, 28, 1, 'February', 'Sunday', 9, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-01', 2021, 1, 3, 1, 2, 'March', 'Monday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-02', 2021, 1, 3, 2, 3, 'March', 'Tuesday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-03', 2021, 1, 3, 3, 4, 'March', 'Wednesday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-04', 2021, 1, 3, 4, 5, 'March', 'Thursday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-05', 2021, 1, 3, 5, 6, 'March', 'Friday', 9, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-06', 2021, 1, 3, 6, 7, 'March', 'Saturday', 9, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-07', 2021, 1, 3, 7, 1, 'March', 'Sunday', 10, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-08', 2021, 1, 3, 8, 2, 'March', 'Monday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-09', 2021, 1, 3, 9, 3, 'March', 'Tuesday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-10', 2021, 1, 3, 10, 4, 'March', 'Wednesday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-11', 2021, 1, 3, 11, 5, 'March', 'Thursday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-12', 2021, 1, 3, 12, 6, 'March', 'Friday', 10, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);
INSERT INTO `dates` (`dt`, `y`, `q`, `m`, `d`, `dw`, `month_name`, `day_name`, `w`, `is_weekday`) VALUES
('2021-03-13', 2021, 1, 3, 13, 7, 'March', 'Saturday', 10, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-14', 2021, 1, 3, 14, 1, 'March', 'Sunday', 11, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-15', 2021, 1, 3, 15, 2, 'March', 'Monday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-16', 2021, 1, 3, 16, 3, 'March', 'Tuesday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-17', 2021, 1, 3, 17, 4, 'March', 'Wednesday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-18', 2021, 1, 3, 18, 5, 'March', 'Thursday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-19', 2021, 1, 3, 19, 6, 'March', 'Friday', 11, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-20', 2021, 1, 3, 20, 7, 'March', 'Saturday', 11, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-21', 2021, 1, 3, 21, 1, 'March', 'Sunday', 12, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-22', 2021, 1, 3, 22, 2, 'March', 'Monday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-23', 2021, 1, 3, 23, 3, 'March', 'Tuesday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-24', 2021, 1, 3, 24, 4, 'March', 'Wednesday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-25', 2021, 1, 3, 25, 5, 'March', 'Thursday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-26', 2021, 1, 3, 26, 6, 'March', 'Friday', 12, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-27', 2021, 1, 3, 27, 7, 'March', 'Saturday', 12, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-28', 2021, 1, 3, 28, 1, 'March', 'Sunday', 13, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-29', 2021, 1, 3, 29, 2, 'March', 'Monday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-30', 2021, 1, 3, 30, 3, 'March', 'Tuesday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-03-31', 2021, 1, 3, 31, 4, 'March', 'Wednesday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-01', 2021, 2, 4, 1, 5, 'April', 'Thursday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-02', 2021, 2, 4, 2, 6, 'April', 'Friday', 13, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-03', 2021, 2, 4, 3, 7, 'April', 'Saturday', 13, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-04', 2021, 2, 4, 4, 1, 'April', 'Sunday', 14, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-05', 2021, 2, 4, 5, 2, 'April', 'Monday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-06', 2021, 2, 4, 6, 3, 'April', 'Tuesday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-07', 2021, 2, 4, 7, 4, 'April', 'Wednesday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-08', 2021, 2, 4, 8, 5, 'April', 'Thursday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-09', 2021, 2, 4, 9, 6, 'April', 'Friday', 14, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-10', 2021, 2, 4, 10, 7, 'April', 'Saturday', 14, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-11', 2021, 2, 4, 11, 1, 'April', 'Sunday', 15, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-12', 2021, 2, 4, 12, 2, 'April', 'Monday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-13', 2021, 2, 4, 13, 3, 'April', 'Tuesday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-14', 2021, 2, 4, 14, 4, 'April', 'Wednesday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-15', 2021, 2, 4, 15, 5, 'April', 'Thursday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-16', 2021, 2, 4, 16, 6, 'April', 'Friday', 15, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-17', 2021, 2, 4, 17, 7, 'April', 'Saturday', 15, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-18', 2021, 2, 4, 18, 1, 'April', 'Sunday', 16, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-19', 2021, 2, 4, 19, 2, 'April', 'Monday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-20', 2021, 2, 4, 20, 3, 'April', 'Tuesday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-21', 2021, 2, 4, 21, 4, 'April', 'Wednesday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-22', 2021, 2, 4, 22, 5, 'April', 'Thursday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-23', 2021, 2, 4, 23, 6, 'April', 'Friday', 16, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-24', 2021, 2, 4, 24, 7, 'April', 'Saturday', 16, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-25', 2021, 2, 4, 25, 1, 'April', 'Sunday', 17, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-26', 2021, 2, 4, 26, 2, 'April', 'Monday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-27', 2021, 2, 4, 27, 3, 'April', 'Tuesday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-28', 2021, 2, 4, 28, 4, 'April', 'Wednesday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-29', 2021, 2, 4, 29, 5, 'April', 'Thursday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-04-30', 2021, 2, 4, 30, 6, 'April', 'Friday', 17, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-01', 2021, 2, 5, 1, 7, 'May', 'Saturday', 17, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-02', 2021, 2, 5, 2, 1, 'May', 'Sunday', 18, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-03', 2021, 2, 5, 3, 2, 'May', 'Monday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-04', 2021, 2, 5, 4, 3, 'May', 'Tuesday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-05', 2021, 2, 5, 5, 4, 'May', 'Wednesday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-06', 2021, 2, 5, 6, 5, 'May', 'Thursday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-07', 2021, 2, 5, 7, 6, 'May', 'Friday', 18, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-08', 2021, 2, 5, 8, 7, 'May', 'Saturday', 18, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-09', 2021, 2, 5, 9, 1, 'May', 'Sunday', 19, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-10', 2021, 2, 5, 10, 2, 'May', 'Monday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-11', 2021, 2, 5, 11, 3, 'May', 'Tuesday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-12', 2021, 2, 5, 12, 4, 'May', 'Wednesday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-13', 2021, 2, 5, 13, 5, 'May', 'Thursday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-14', 2021, 2, 5, 14, 6, 'May', 'Friday', 19, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-15', 2021, 2, 5, 15, 7, 'May', 'Saturday', 19, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-16', 2021, 2, 5, 16, 1, 'May', 'Sunday', 20, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-17', 2021, 2, 5, 17, 2, 'May', 'Monday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-18', 2021, 2, 5, 18, 3, 'May', 'Tuesday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-19', 2021, 2, 5, 19, 4, 'May', 'Wednesday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-20', 2021, 2, 5, 20, 5, 'May', 'Thursday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-21', 2021, 2, 5, 21, 6, 'May', 'Friday', 20, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-22', 2021, 2, 5, 22, 7, 'May', 'Saturday', 20, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-23', 2021, 2, 5, 23, 1, 'May', 'Sunday', 21, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-24', 2021, 2, 5, 24, 2, 'May', 'Monday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-25', 2021, 2, 5, 25, 3, 'May', 'Tuesday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-26', 2021, 2, 5, 26, 4, 'May', 'Wednesday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-27', 2021, 2, 5, 27, 5, 'May', 'Thursday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-28', 2021, 2, 5, 28, 6, 'May', 'Friday', 21, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-29', 2021, 2, 5, 29, 7, 'May', 'Saturday', 21, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-30', 2021, 2, 5, 30, 1, 'May', 'Sunday', 22, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-05-31', 2021, 2, 5, 31, 2, 'May', 'Monday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-01', 2021, 2, 6, 1, 3, 'June', 'Tuesday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-02', 2021, 2, 6, 2, 4, 'June', 'Wednesday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-03', 2021, 2, 6, 3, 5, 'June', 'Thursday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-04', 2021, 2, 6, 4, 6, 'June', 'Friday', 22, 0x310000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-05', 2021, 2, 6, 5, 7, 'June', 'Saturday', 22, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
('2021-06-06', 2021, 2, 6, 6, 1, 'June', 'Sunday', 23, 0x300000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `email`, `active`, `created`, `modified`) VALUES
(1, 'Part A- Core Knowledge', 'Heavy  Equipment  Training ', NULL, 1, '2019-10-11 15:32:31', '2019-10-11 15:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `departments_leaders`
--

CREATE TABLE `departments_leaders` (
  `department_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments_leaders`
--

INSERT INTO `departments_leaders` (`department_id`, `user_id`) VALUES
(1, 2),
(1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `departments_users`
--

CREATE TABLE `departments_users` (
  `id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments_users`
--

INSERT INTO `departments_users` (`id`, `department_id`, `user_id`) VALUES
(1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(10) NOT NULL,
  `facility_id` int(10) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment_type_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `picture_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `make` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `purchased` date DEFAULT NULL,
  `type_data` text COLLATE utf8mb4_unicode_ci,
  `issued_to` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  `cost_centre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depreciated_over_years` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_service` date DEFAULT NULL,
  `next_service` date DEFAULT NULL,
  `next_alert` date DEFAULT NULL,
  `usage_hours` int(10) UNSIGNED DEFAULT NULL,
  `usage_km` int(10) UNSIGNED DEFAULT NULL,
  `for_hire` tinyint(1) NOT NULL DEFAULT '0',
  `hire_rate` decimal(10,2) DEFAULT NULL,
  `qty` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '4',
  `alert_status` int(11) NOT NULL DEFAULT '4',
  `status_date` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `facility_id`, `title`, `equipment_type_id`, `department_id`, `picture_url`, `asset`, `make`, `model`, `serial`, `part_number`, `notes`, `purchased`, `type_data`, `issued_to`, `location`, `cost`, `cost_centre`, `depreciated_over_years`, `user_id`, `last_service`, `next_service`, `next_alert`, `usage_hours`, `usage_km`, `for_hire`, `hire_rate`, `qty`, `description`, `options`, `active`, `status`, `alert_status`, `status_date`, `created`, `modified`) VALUES
(1, NULL, 'testTitle', 1, NULL, '', '', '', '', '', '', '', NULL, NULL, '', '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, NULL, NULL, 0, 0, 0, '2019-10-11 19:08:38', '2019-10-11 16:06:29', '2019-10-11 19:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_indexes`
--

CREATE TABLE `equipment_indexes` (
  `id` int(11) NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_links`
--

CREATE TABLE `equipment_links` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `related_equipment` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_logs`
--

CREATE TABLE `equipment_logs` (
  `id` int(10) NOT NULL,
  `equipment_id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `alert_date` date DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  `file_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ext` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_reservations`
--

CREATE TABLE `equipment_reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `equipment_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `table` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tableid` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `qty` int(11) NOT NULL DEFAULT '1',
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `all_day` tinyint(1) NOT NULL DEFAULT '1',
  `approved` tinyint(1) DEFAULT NULL,
  `returned` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_types`
--

CREATE TABLE `equipment_types` (
  `id` int(10) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8mb4_unicode_ci,
  `serviceable` tinyint(1) NOT NULL DEFAULT '0',
  `track_usage` tinyint(1) NOT NULL DEFAULT '0',
  `user_equipment` tinyint(1) NOT NULL DEFAULT '0',
  `hourly_booking` tinyint(1) NOT NULL DEFAULT '0',
  `auto_approval` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment_types`
--

INSERT INTO `equipment_types` (`id`, `title`, `category`, `icon`, `image`, `data`, `serviceable`, `track_usage`, `user_equipment`, `hourly_booking`, `auto_approval`, `active`, `created`, `modified`) VALUES
(1, 'test', 'eqcategory', NULL, NULL, '', 0, 0, 0, 0, 0, 1, '2019-10-11 16:04:16', '2019-10-11 16:04:16');

-- --------------------------------------------------------

--
-- Table structure for table `evidence`
--

CREATE TABLE `evidence` (
  `id` int(11) NOT NULL,
  `user_test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_test_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `photo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `evidence`
--

INSERT INTO `evidence` (`id`, `user_test_id`, `user_id`, `course_test_id`, `answer_id`, `photo_url`) VALUES
(1, 41, 18, 15, 32, 'http://dev.taro.training/upload/users/1/65191b8944400d0b481ecb4b2a8835289a0c814e2fb8.jpg'),
(2, 40, 1, 0, 265, 'http://dev.taro.training/upload/users/1/65191b8944400d0b481ecb4b2a8835289a0c814e2fb8.jpg'),
(3, 40, 18, 0, 277, ''),
(4, 40, 18, 0, 251, '');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abv` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `bookings_email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bookings_max_ppl` int(11) DEFAULT NULL,
  `bookings_calendar` text COLLATE utf8mb4_unicode_ci,
  `users_email` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled_areas` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `title`, `abv`, `description`, `notes`, `bookings_email`, `bookings_max_ppl`, `bookings_calendar`, `users_email`, `enabled_areas`, `active`, `created`, `modified`) VALUES
(1, 'test', 'test', 'test', 'test', 'test', NULL, NULL, 'test', '', 1, '2020-01-23 15:28:30', '2020-01-23 16:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `facilities_users`
--

CREATE TABLE `facilities_users` (
  `id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE `flags` (
  `id` int(10) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flags_users`
--

CREATE TABLE `flags_users` (
  `id` int(10) NOT NULL,
  `flag_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_templates`
--

CREATE TABLE `form_templates` (
  `id` int(10) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revision` int(10) NOT NULL DEFAULT '1',
  `form` text COLLATE utf8mb4_unicode_ci,
  `validation` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_templates`
--

INSERT INTO `form_templates` (`id`, `title`, `revision`, `form`, `validation`, `active`, `created`, `modified`) VALUES
(1, 'testtesttest', 2, '<p>testedit</p>\r\n', NULL, 1, '2019-10-11 15:32:59', '2019-10-11 15:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `style` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `style`, `created`, `modified`) VALUES
(1, 'Admin', NULL, '2013-10-21 18:24:20', '2013-10-21 18:24:20'),
(2, 'Officer / Manager', NULL, '2013-10-21 18:24:24', '2014-05-09 21:05:37'),
(3, 'Read Only', NULL, '2013-10-21 18:24:31', '2014-05-09 21:06:09'),
(4, 'Staff', NULL, '2013-11-03 19:47:58', '2014-05-09 21:06:27'),
(5, 'User / Operator', NULL, '2014-03-17 13:30:02', '2014-05-09 21:06:44'),
(6, 'Student', NULL, '2014-04-01 13:02:13', '2014-05-09 21:07:25'),
(7, 'Limited', NULL, '2014-04-09 15:25:44', '2014-05-09 21:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` int(10) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `lft` int(10) NOT NULL,
  `rght` int(10) NOT NULL,
  `controller` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `title` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `expires` date DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `facility_id`, `title`, `notes`, `expires`, `active`, `created`, `modified`) VALUES
(1, 1, NULL, 'testtesttest', '<p>tests</p>', NULL, 1, '2019-10-11 15:21:08', '2019-10-11 15:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20170731224017, 'Initial', '2019-10-10 07:22:16', '2019-10-10 07:22:32', 0),
(20170921030947, 'Update20170921', '2019-10-10 07:22:32', '2019-10-10 07:22:33', 0),
(20170927014746, 'Update20170927', '2019-10-10 07:22:33', '2019-10-10 07:22:33', 0),
(20170928040707, 'Update20170928', '2019-10-10 07:22:33', '2019-10-10 07:22:34', 0),
(20171005004529, 'Update20171005', '2019-10-10 07:22:34', '2019-10-10 07:22:34', 0),
(20171006031603, 'Update20171006', '2019-10-10 07:22:34', '2019-10-10 07:22:35', 0),
(20171011005432, 'Update20171011', '2019-10-10 07:22:35', '2019-10-10 07:22:36', 0),
(20171013050658, 'Update20171013', '2019-10-10 07:22:37', '2019-10-10 07:22:38', 0),
(20171124010658, 'Update20171124', '2019-10-10 07:22:38', '2019-10-10 07:22:39', 0),
(20171212010658, 'Update20171212', '2019-10-10 07:22:39', '2019-10-10 07:22:40', 0),
(20171213204909, 'Update20171214', '2019-10-10 07:22:40', '2019-10-10 07:22:40', 0),
(20171213212512, 'Update201712142', '2019-10-10 07:22:40', '2019-10-10 07:22:41', 0),
(20171227225258, 'Update20171228', '2019-10-10 07:22:41', '2019-10-10 07:22:43', 0),
(20180111035638, 'Update20180111', '2019-10-10 07:22:43', '2019-10-10 07:22:45', 0),
(20180112072442, 'Update20180112', '2019-10-10 07:22:45', '2019-10-10 07:22:45', 0),
(20180114224730, 'Update20180115', '2019-10-10 07:22:45', '2019-10-10 07:22:46', 0),
(20180205230536, 'Update20180206', '2019-10-10 07:22:46', '2019-10-10 07:22:46', 0),
(20180219001221, 'Update20180219', '2019-10-10 07:22:46', '2019-10-10 07:22:48', 0),
(20180228000810, 'Update20180228', '2019-10-10 07:22:48', '2019-10-10 07:22:52', 0),
(20180228003722, 'Update20180228b', '2019-10-10 07:22:52', '2019-10-10 07:22:55', 0),
(20180717031033, 'Update20180717', '2019-10-10 07:22:55', '2019-10-10 07:22:55', 0),
(20190508010521, 'Registers', '2019-10-10 07:22:56', '2019-10-10 07:22:58', 0),
(20190509230725, 'UpdateConfig', '2019-10-10 07:22:58', '2019-10-10 07:22:58', 0),
(20190509231400, 'UpdateConfigB', '2019-10-10 07:22:58', '2019-10-10 07:22:59', 0),
(20190605010551, 'TripCategories', '2019-10-10 07:22:59', '2019-10-10 07:23:02', 0),
(20190625051514, 'Tips', '2019-10-10 07:23:02', '2019-10-10 07:23:03', 0),
(20190715044842, 'Equipment', '2019-10-10 07:23:03', '2019-10-10 07:23:03', 0),
(20190912053636, 'Toro', '2019-10-10 07:23:03', '2019-10-10 07:23:09', 0),
(20190918053112, 'Torohash', '2019-10-10 07:23:09', '2019-10-10 07:23:10', 0),
(20190919030814, 'Createdatabase', '2019-10-10 07:23:10', '2019-10-10 07:23:13', 0),
(20190930042831, 'Courses', '2019-10-10 07:23:13', '2019-10-10 07:23:17', 0),
(20191010040959, 'CoursesUpdate', '2019-10-10 07:23:17', '2019-10-10 07:23:23', 0),
(20191015013231, 'TestsUpdate', '2019-10-15 04:42:53', '2019-10-15 04:42:57', 0),
(20191015024948, 'QuestionsUpdate', '2019-10-15 04:51:53', '2019-10-15 04:51:54', 0),
(20191016072013, 'UpdateTables', '2019-10-16 09:25:46', '2019-10-16 09:25:47', 0),
(20191017072132, 'CourseQuestionsTable', '2019-10-24 04:55:27', '2019-10-24 04:55:28', 0),
(20191024023613, 'QuestionsTableUpdate', '2019-10-24 04:55:28', '2019-10-24 04:55:28', 0),
(20191209060639, 'CreateUserTestsCredentials', '2019-12-09 08:25:29', '2019-12-09 08:25:30', 0),
(20191209062703, 'AlterUserTestsCredentials', '2019-12-09 08:27:48', '2019-12-09 08:27:48', 0),
(20191217055929, 'AlterAnswerIdFromUserAnswers', '2019-12-17 08:18:20', '2019-12-17 08:18:21', 0),
(20191224014942, 'AlterUserAnswers', '2019-12-24 04:05:53', '2019-12-24 04:05:53', 0),
(20200110024622, 'CreateDomainTable', '2020-01-13 03:36:56', '2020-01-13 03:36:57', 0),
(20200113014005, 'AlterAllowedDomains', '2020-01-13 03:40:35', '2020-01-13 03:40:37', 0),
(20200212065517, 'MyCustomMigration', '2020-02-12 09:06:27', '2020-02-12 09:06:27', 0),
(20200212065542, 'Evidence', '2020-02-12 09:09:22', '2020-02-12 09:09:23', 0),
(20200212075250, 'Evidence', '2020-02-12 09:53:12', '2020-02-12 09:53:13', 0),
(20200213064953, 'Evidence', '2020-02-13 08:50:49', '2020-02-13 08:50:49', 0),
(20200214024420, 'EvidenceTable', '2020-02-14 04:45:21', '2020-02-14 04:45:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `queued_jobs`
--

CREATE TABLE `queued_jobs` (
  `id` int(11) NOT NULL,
  `job_type` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci,
  `job_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `notbefore` datetime DEFAULT NULL,
  `fetched` datetime DEFAULT NULL,
  `progress` float DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `completed` datetime DEFAULT NULL,
  `failed` int(11) NOT NULL DEFAULT '0',
  `failure_message` text COLLATE utf8mb4_unicode_ci,
  `workerkey` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` int(3) NOT NULL DEFAULT '5'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE `registers` (
  `id` int(11) NOT NULL,
  `register_template_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `register_class_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `cert_status` int(6) NOT NULL DEFAULT '4',
  `cert_status_date` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `registers`
--

INSERT INTO `registers` (`id`, `register_template_id`, `user_id`, `register_class_id`, `department_id`, `status`, `notes`, `active`, `cert_status`, `cert_status_date`, `created`, `modified`) VALUES
(1, 1, 1, NULL, 1, 'In Progress', NULL, 1, 4, NULL, '2020-03-03 16:30:43', '2020-03-03 18:02:48'),
(2, 1, 21, 1, 1, 'Registered', '<p><b>Rejected Reason: </b><br/>test</p>', 1, 4, NULL, '2020-03-03 16:31:48', '2020-03-03 18:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `register_admins`
--

CREATE TABLE `register_admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `register_template_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_admins`
--

INSERT INTO `register_admins` (`id`, `register_template_id`, `department_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `register_checklists`
--

CREATE TABLE `register_checklists` (
  `id` int(11) NOT NULL,
  `register_id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_checklists`
--

INSERT INTO `register_checklists` (`id`, `register_id`, `title`, `date`, `status`, `comments`, `created`, `modified`) VALUES
(1, 1, 'test checklist', NULL, 'To be done', NULL, '2020-03-03 16:30:43', '2020-03-03 16:30:43'),
(2, 2, 'test checklist', NULL, 'To be done', NULL, '2020-03-03 16:31:48', '2020-03-03 16:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `register_classes`
--

CREATE TABLE `register_classes` (
  `id` int(10) NOT NULL,
  `register_template_id` int(10) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_hand` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_classes`
--

INSERT INTO `register_classes` (`id`, `register_template_id`, `title`, `short_hand`, `description`, `icon`, `active`, `created`, `modified`) VALUES
(1, 1, 'test title', 'sts', 'test description', '/upload/icons/55765ddcbcc9761d34fec9d8e68fb229307c31662b94.png', 1, '2020-03-03 16:30:18', '2020-03-03 16:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `register_forms`
--

CREATE TABLE `register_forms` (
  `id` int(10) NOT NULL,
  `user_id` int(50) NOT NULL,
  `register_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ext` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `validated_date` datetime DEFAULT NULL,
  `valid` tinyint(1) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_templates`
--

CREATE TABLE `register_templates` (
  `id` int(10) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `form_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `required_forms` text COLLATE utf8mb4_unicode_ci,
  `checklists` text COLLATE utf8mb4_unicode_ci,
  `required_certifications` text COLLATE utf8mb4_unicode_ci,
  `optional_certifications` text COLLATE utf8mb4_unicode_ci,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(10) DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_templates`
--

INSERT INTO `register_templates` (`id`, `name`, `about`, `form_type`, `required_forms`, `checklists`, `required_certifications`, `optional_certifications`, `active`, `order`, `created`, `modified`) VALUES
(1, 'Sample Test', '<p>test notes </p>', NULL, 'testtesttest', 'test checklist', 'testtype', 'testtype', 1, 1, '2020-03-03 16:29:11', '2020-03-03 16:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(10) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `home` tinyint(1) DEFAULT '0',
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_ext` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_size` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `user_id`, `description`, `facility_id`, `group_id`, `home`, `type`, `doc`, `doc_ext`, `doc_type`, `doc_size`, `notes`, `link`, `parent_id`, `lft`, `rght`, `active`, `created`, `modified`) VALUES
(1, 'sample', 1, 'asd', NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '0000-00-00 00:00:00', '2019-10-11 13:08:19'),
(2, 'Heavy  Equipment  Training ', 1, 'Heavy  Equipment  Training ', NULL, NULL, 0, 'Note', NULL, NULL, NULL, NULL, '<p>321</p>', NULL, NULL, 1, 2, 1, '2019-10-11 13:07:58', '2019-10-14 17:22:30'),
(3, 'Test Question', 1, 'Heavy  Equipment  Training ', NULL, NULL, 0, 'Document', '/upload/resources/7358564cf468f14196da150e0a76f7a385944aaab20d.png', 'png', 'image/png', '208589', NULL, NULL, NULL, 3, 4, 1, '2020-03-04 13:20:29', '2020-03-04 13:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `resources_tags`
--

CREATE TABLE `resources_tags` (
  `resource_id` int(11) NOT NULL,
  `resource_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resources_tags`
--

INSERT INTO `resources_tags` (`resource_id`, `resource_category_id`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resource_categories`
--

CREATE TABLE `resource_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resource_categories`
--

INSERT INTO `resource_categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, '1', NULL, '2019-10-11 13:07:24', '2019-10-11 13:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `scopes`
--

CREATE TABLE `scopes` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_logs`
--

CREATE TABLE `service_logs` (
  `id` int(10) NOT NULL,
  `equipment_id` int(10) NOT NULL,
  `serviced` date NOT NULL,
  `serviced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `next_service` date DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filesize` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abn` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_number` int(11) DEFAULT NULL,
  `enabled_areas` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_domain_csv` text COLLATE utf8mb4_unicode_ci,
  `email_disabled` int(1) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `short`, `url`, `abn`, `contact_email`, `postal_address`, `billing_email`, `client_number`, `enabled_areas`, `logo`, `favicon`, `auth_domain_csv`, `email_disabled`, `status`, `expires`, `created`, `modified`) VALUES
(1, 'Taro Training', NULL, 'dev.taro.training', NULL, 'anthony.monteverde35@gmail.com', NULL, NULL, NULL, 'Registers,People,Trips', NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-10 15:25:09', '2019-10-10 15:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`id`, `user_id`, `type`, `token`, `password`, `expires`, `created`, `modified`) VALUES
(1, 1, 'email_verify', 'bfb92e4a2d6e21530f731943dc88ec8db1abfa21', '$2y$10$M6rqspZI6ugzwCALR0/fieflTqlCKiLsZYSU1RzrTYMN6YwBZnp92', NULL, '2019-09-17 17:36:15', '2019-09-17 17:36:15'),
(2, 1, 'email_verify', 'b8367034a2707e6fcf3fa451b1c4462456fffd93', '$2y$10$iltJbTCjesEkQ88rembx5eHNdyvi4w9zPiiiQEVfLv.rdvzAU0e4q', NULL, '2019-09-17 18:37:17', '2019-09-17 18:37:17'),
(3, 2, 'email_verify', 'a17adfef45672c329fa970b18ba31acb76635a4c', '$2y$10$CWX./v291sI8JOuvVQEJ5OEgKhp4MeVDnnTWlMkqci/3i0OW3s3vq', NULL, '2019-09-18 10:34:23', '2019-09-18 10:34:23'),
(4, 3, 'email_verify', '428fab3d9c7be77c378e8356516d45d6034f8835', '$2y$10$gA87QAABjnczJlv6y8QDu.5gjgUwt4N0Zp3sbp1MZ0GJBA96BjuMe', NULL, '2019-09-18 11:13:35', '2019-09-18 11:13:35'),
(5, 3, 'email_verify', '9afc05715e0fd4ff9364b920c6f7b47ba514b841', '$2y$10$C4/rqivEGPf7o28EarPriuQ9BVDIpgqjuI77MNlzIlFK3iRlVUwza', NULL, '2019-09-18 11:13:48', '2019-09-18 11:13:48'),
(6, 3, 'email_verify', '4f92f0f278e0698bd64eaf15d4245f16863f632a', '$2y$10$5q36y2VapWBBaYkIcVe//O93iJsg9DdoGWMsNuW54uzpJiktzeGaC', NULL, '2019-09-18 12:06:05', '2019-09-18 12:06:05'),
(7, 3, 'email_verify', '66f4b1a7f4e75b10fc86cd08a393f63704be6eaf', '$2y$10$/xv7uVvTNWhDFmKD9YgW6ee9DSph.P43ZTqNcvD0ZuQ4kUA9u1l/a', NULL, '2019-09-18 12:13:03', '2019-09-18 12:13:03'),
(8, 3, 'email_verify', 'a2bb9d7bf214aaa483b921494bf47c3e37d5e934', '$2y$10$qa1Xy1tzEmbOotlU/stI4Opn552xDbeWtEsjQ1fcnXkD3mRiGfnAO', NULL, '2019-09-18 12:15:11', '2019-09-18 12:15:11'),
(9, 3, 'email_verify', '6cc178203eb4d689e4559e323ac82a49dfeeb3d5', '$2y$10$lBUVnCwf5QcQHXxWNDOXcO5xFDuOXuvkB23QU9yRLk3yPRnkhvZe.', NULL, '2019-09-18 12:48:52', '2019-09-18 12:48:52'),
(10, 3, 'email_verify', 'da3077751e447d73810bd1b039301159d7b27566', '$2y$10$BnKwwML.DSmSGQh07sRTROg/nDyPJYonYKECQNuh5qphrocx3LbiC', NULL, '2019-09-18 12:52:51', '2019-09-18 12:52:51'),
(11, 3, 'email_verify', '33f9828b395f04a5ef2060ee5243fd6c8d9a94e3', '$2y$10$ytpep3ezNOQZyLGZwOxgme3cCJw3fM9ofaeOeXFwBjmEEAFkmYrwO', NULL, '2019-09-18 12:59:15', '2019-09-18 12:59:15'),
(12, 3, 'email_verify', '126bf39efe64fd4ea1d3dcfbeea7daedbc594a93', '$2y$10$34Vxo9tjtR/oJaMOMAavM.ot7GvS5Q/ExM7oy6VYgl.NjeWyT22di', NULL, '2019-09-18 13:00:08', '2019-09-18 13:00:08'),
(13, 3, 'email_verify', 'bd40a3ac9dc4339a79f9c5cdb876a5246ac8027d', '$2y$10$XVwwtTNl2mZFp0k8CSWjleByjjpPp0TKLlhvpXOBMZK5XQZxpicNW', NULL, '2019-09-18 13:01:47', '2019-09-18 13:01:47'),
(14, 3, 'email_verify', '05e1ca2d80f182afff6e7adb4d818927efdcc0a5', '$2y$10$D0ojQE413y2iz53QA12VUORCGZXhJIr4IaLS5srCXcocdc4Gf9eKm', NULL, '2019-09-18 13:35:11', '2019-09-18 13:35:11'),
(15, 3, 'email_verify', 'f30a86d857a9eb909e14b0eb7e6fc9c94b7258ce', '$2y$10$ftcGsY87wCd8DcT4vwzGT.kK9nPb5paRyQ9IDwiENtBMN8OXBz4B2', NULL, '2019-09-18 13:35:12', '2019-09-18 13:35:12'),
(16, 3, 'email_verify', '8f14686f8e9edd162932519cef8c23e34410bfb4', '$2y$10$Wbbs2BsxsUB/k5dCTMXw6uF6nWYKWFC2RzZm2y4xVzJCNIsDS8d3K', NULL, '2019-09-18 13:36:12', '2019-09-18 13:36:12'),
(17, 3, 'email_verify', 'f24bc5f2efc7ed47a922834ec6ca1af6329fbc47', '$2y$10$4fjvpz8/s4fPy0PTG45C7.uFRU0xAy6qnX.SZbku13TKfekSPJ7V.', NULL, '2019-09-18 13:36:22', '2019-09-18 13:36:22'),
(18, 3, 'email_verify', 'd9808db9b037a7e2f7215b1a48a788c7b5735979', '$2y$10$shWLOY/njIUHrMlqg2vUQeleDWzofiu3nfcnEsHj4Z0F9R57Qxjs.', NULL, '2019-09-18 13:36:47', '2019-09-18 13:36:47'),
(19, 3, 'email_verify', 'a2ad8774746fbd521234e5a17ea32920441d37d7', '$2y$10$sdxDpq.LBl4TUcw4XDAdk.x/BZWGnMOOzJzobxLdveTTmqWJdFFeq', NULL, '2019-09-18 13:36:57', '2019-09-18 13:36:57'),
(20, 3, 'email_verify', '56836a86a71e8c9999749de7a1810769722615f5', '$2y$10$F2EQcGxRewYBj5ZEqwDteeE833XvnqHYFqDdJcQtNQsUMkcJT0oMy', NULL, '2019-09-18 13:37:04', '2019-09-18 13:37:04'),
(21, 3, 'email_verify', 'c936a25f79d046cd0b41230807fbc61de1447093', '$2y$10$g53WHzr6Z/iKqvk4DnPvtenvBXxJlr3IqOGSSbI7rOKm.vudZa.MK', NULL, '2019-09-18 13:37:48', '2019-09-18 13:37:48'),
(22, 3, 'email_verify', '1323100da9abcf272588a2d5714b6366badb692b', '$2y$10$XJLz7MQU61CwuKx37XDazewMKqI45siPuwSAHTfKKUkpw6fdfu5oa', NULL, '2019-09-18 13:38:02', '2019-09-18 13:38:02'),
(23, 3, 'email_verify', '8db439fa8b2a8ce304dc16c1f3aae929c155f343', '$2y$10$/Wv.Gar1Lv5tNVhEzumyUu1fRJ0DK3dzv9Q8XXi7Kb8V0h.YOQk1q', NULL, '2019-09-18 13:40:08', '2019-09-18 13:40:08'),
(24, 3, 'email_verify', 'a5b788c198b8a29b1185440c246d0ba40a3821ba', '$2y$10$dp603b5O8xN9G8QcdPfr8OVCgU0xi6nSBv/oVpVT5UuTPXtS1Zd76', NULL, '2019-09-18 13:44:37', '2019-09-18 13:44:37'),
(25, 3, 'email_verify', '98006df45d58913937d3119f53d272ebe7433448', '$2y$10$5MdvTazEdCu07fWlM897SOMszawtEbooBQ3O67eYqEdemVIddzH2e', NULL, '2019-09-18 13:49:49', '2019-09-18 13:49:49'),
(26, 3, 'email_verify', '0e51212692fb0b577217f0408d7c1cafc3ad857c', '$2y$10$4GmF5gBo.mQpN6FxdqnBC.HrQ1CQjwjivCa99fFP5YOGDGc9RCpwW', NULL, '2019-09-18 13:49:56', '2019-09-18 13:49:56'),
(27, 3, 'email_verify', 'e1fa6f1e79e3018507d1eb6f3fca28d5e987a88a', '$2y$10$czJksKrJsjZ7uf0MAwO.4emuOZQhX1c9/CsHC3Q/8mJ.g.8NmppFq', NULL, '2019-09-18 13:50:32', '2019-09-18 13:50:32'),
(28, 3, 'email_verify', 'df085edbe13475fdc159efb09fa539e420048ecd', '$2y$10$s8OaunlAUCtbpFlsGs3zX.AeomG.E0FTnKxC8uUwM9gSSx6pkYowO', NULL, '2019-09-18 16:06:56', '2019-09-18 16:06:56'),
(29, 4, 'email_verify', '96a8e2b2877d506f6b14503e432d1f6883337705', '$2y$10$VwI/2JDpXSYpvnOOo7MMOuOyB3qS2Yeq/dT08ajEJ9zx2NSK7XRXS', NULL, '2019-09-19 11:08:27', '2019-09-19 11:08:27'),
(30, 1, 'email_verify', 'cd1863c93f5590cbc91af1de84fd4e47f66639a9', '$2y$10$EuujucjXx6eeMC4ymDDJp.yySzIe3f6bF2nSrjhETBpTiG0mhe6zO', NULL, '2019-09-24 16:12:56', '2019-09-24 16:12:56'),
(31, 1, 'email_verify', '9f7a1c058d50ee36a3e8c28dac74db316f366226', '$2y$10$UvwBpP0deSb60S9pmuoDveyry/XXwlO/CLqWJ5G2gycEvMGhH3KmO', NULL, '2019-09-24 16:13:42', '2019-09-24 16:13:42'),
(32, 1, 'email_verify', '6077d980ad07811556639b1d8128c802abe012c9', '$2y$10$43zGEuvVYhUHUkkJBhL7FudHoOSUyme.OPOorfJJN0O8UB/ygKT4O', NULL, '2019-09-24 16:25:36', '2019-09-24 16:25:36'),
(33, 1, 'email_verify', '0ca0901077f5d83c07a7d6739ba3b505d010965b', '$2y$10$smN/Jy9j/2PjkIKBHdE8iefA/6BZn1fxqwzzLuYCG4ED2kGJ7z3kq', NULL, '2019-09-24 16:26:33', '2019-09-24 16:26:33'),
(34, 1, 'email_verify', 'b663e2bd355495de56c9c45827bed2741930eba9', '$2y$10$gHGL.Ml3ioZd32ool8oOS.k0iXMfI8hPZO0PkLe.oa/nNd54z487.', NULL, '2019-09-24 16:30:37', '2019-09-24 16:30:37'),
(35, 1, 'email_verify', 'ce725ca75ff8781473ba3a64aa3390a9b5c1b3d3', '$2y$10$pN8njtnTU5eSPBW.4Cxj..6RrpvVQ45moWrHXKIy.W/MqZSqsJUvS', NULL, '2019-09-24 16:46:15', '2019-09-24 16:46:15'),
(36, 1, 'email_verify', 'b63c139f2478b48288a5d69c0032336531241f0b', '$2y$10$gy6WklqC0i9MUpcC8DOnJ.YHxwIhhy3jyexYygv9gh7ud4iNAuNW2', NULL, '2019-09-24 16:47:46', '2019-09-24 16:47:46'),
(37, 1, 'email_verify', 'c66c28e7ba14bbcd7f1b09637fd9e5f3b5eb8b5a', '$2y$10$ViG4thBN3bGUnAiPkDKXceE6eOUTnNKRqBlkS5YcesvFq5InuC4Ke', NULL, '2019-09-24 16:51:39', '2019-09-24 16:51:39'),
(38, 1, 'email_verify', '2257785e96de8c0d8df7a173697772708bd24fd8', '$2y$10$GUXv6/TVC8K080i8xIwetOQ6vUwM2nEX7HSQWoKLPqgKxIX8r7yEO', NULL, '2019-09-24 16:57:49', '2019-09-24 16:57:49'),
(39, 1, 'email_verify', 'c702d2a9ff7875799bcb4d129de6a5a61f8e6129', '$2y$10$VYLYkLRx8PgjJR0i6jcQH.YkeTlbIxSZPa1Wn6tgp1PwAQtkJEO1G', NULL, '2019-09-24 16:58:43', '2019-09-24 16:58:43'),
(40, 1, 'email_verify', '787581396f62b26f8bee09e6f6b58360d9bcf66a', '$2y$10$BUO0df9.EiyU.MA30GYtC.Q9UqaF4FCH2lsNHU5yrhcXiWIRTmzbe', NULL, '2019-09-24 17:02:39', '2019-09-24 17:02:39'),
(41, 1, 'email_verify', '8c4e5d6e46e7d98a94d6cf1a86711f95586ffbfb', '$2y$10$f/n1a1XR/SxCRJhiFRk3eeCDrU1XkzA.ETHnlv1hiqmawyF9xlrva', NULL, '2019-09-24 17:03:00', '2019-09-24 17:03:00'),
(42, 1, 'email_verify', '22b626ebe075e0b19142864b7b7159110a313053', '$2y$10$qdLuxIrfu/LTMKaSBJ1Kr.XT/VYCafPgKi0fXIDO7MozJZZqQQQHO', NULL, '2019-09-24 17:03:27', '2019-09-24 17:03:27'),
(43, 1, 'email_verify', '93a1eae047365b0f5962c3dd21eeeff227ac4d7c', '$2y$10$NunsO.evNrRIkrAK9qxIx.yyuTLb2SByAJoO4Gd1AiB50UUsZWSA.', NULL, '2019-09-24 17:03:57', '2019-09-24 17:03:57'),
(44, 1, 'email_verify', '6cf9f3cd271f0076fa069494628f81d04b09f8c9', '$2y$10$taIjCBCtCccEqUUIUutUzeXOS7iSTVm4RCL31TU7u9HV0HweeG8My', NULL, '2019-09-24 17:10:31', '2019-09-24 17:10:31'),
(45, 1, 'email_verify', '28febe7b1c60ada7ae44c6065621857ab5f874b3', '$2y$10$TGv9Igi7O0F3LR45CLD9juFPWxO7aHagHhVTPQm1b91nQ4ee8PILW', NULL, '2019-09-24 17:11:53', '2019-09-24 17:11:53'),
(46, 1, 'email_verify', '776a0ea15e3e77e48bcfbffbf22c8609ae659f72', '$2y$10$6MylDkZ2xCja/86KF6KXM.uBkeBf43MBwnYTQMFEmyW604GXELtMW', NULL, '2019-09-24 17:14:23', '2019-09-24 17:14:23'),
(47, 1, 'email_verify', '2626ebbe70df5825531529f3f522bd98338ac1ad', '$2y$10$OTsMMq8Zd.nLmH6N9QTKXeYRWvaEEJyAgU5YLnLZeAM8J4wuKU0/2', NULL, '2019-09-24 17:15:19', '2019-09-24 17:15:19'),
(48, 1, 'email_verify', 'db859c598173fe83da40ac3f02d84ba04374017b', '$2y$10$xKukVFZjuoX1HTFkDA5qzuleiX76ac.psxXEDJHVKOD8REDgKIfea', NULL, '2019-09-24 17:16:42', '2019-09-24 17:16:42'),
(49, 1, 'email_verify', 'e4067b4cd9bfb72d4e73990643744a3efe46b929', '$2y$10$jgTL8dbSuk8Srp2cGEjPN.CEMT7JDKNUHIpz4ktQioBN4XR5YArja', NULL, '2019-09-24 17:25:11', '2019-09-24 17:25:11'),
(50, 1, 'email_verify', '64c126114d38883162bf75f166e5d7dc66d3260d', '$2y$10$89v9Jlmnh7GBPW/i7ENBnuS7Tyh.j4hdEW9ZRaODxS9M9QmkPtLuS', NULL, '2019-09-24 17:27:09', '2019-09-24 17:27:09'),
(51, 1, 'email_verify', '77c07911200e03176d5cec3732ee26d511dd3072', '$2y$10$nx8fD44fA8jJ6CUZViOJ2O3xyKmm1Z/QZIo7MQYAbH2sP.YQ/fBq2', NULL, '2019-09-24 17:30:10', '2019-09-24 17:30:10'),
(52, 1, 'email_verify', 'b67bd861597915f544735fd74514879b9c418db2', '$2y$10$uqN.LQe//rJyjd2U1tTiLett0WkGqXnLMQEsoZg.R6H396Zj5FRcS', NULL, '2019-09-24 17:35:56', '2019-09-24 17:35:56'),
(53, 1, 'email_verify', 'da3d153cdff4b1a251063b7833e6b385ad3cc460', '$2y$10$PJYCt4JOXzPzCyt4Wn65Yeurh4r3TVn/HD2mQX1Ln9wWgsZJM5GBK', NULL, '2019-09-24 17:36:48', '2019-09-24 17:36:48'),
(54, 1, 'email_verify', '3240b74628c0415ad521310bb52ecab9df293294', '$2y$10$KcoXsOf8j2XyxAw1Lpy9Y.Pm11/Ykf4wUJB41trP2JqNZhnxTjjgy', NULL, '2019-09-24 17:37:48', '2019-09-24 17:37:48'),
(55, 1, 'email_verify', 'b9a61640d6dac4535d4f0b201322066c339a1427', '$2y$10$weSAIQwDzGJCj2KaTi42XepYrY00TvPQPJOnCYx1JlHwe6QG/b19e', NULL, '2019-09-24 17:38:41', '2019-09-24 17:38:41'),
(56, 1, 'email_verify', '8caecc928ad5b06058bee6e7c2355c42693af60c', '$2y$10$YGDaCXkKpRnRnJXP1Jx7A.KSgupyOETsKUJBx5UUX01sDlETmZC4i', NULL, '2019-09-24 17:39:32', '2019-09-24 17:39:32'),
(57, 1, 'email_verify', '3037a53f1dee70b581c30adc01a4b158c47d4acc', '$2y$10$58aMv4KJ7jR3TS7G4KO.heFnpoz6By6.eUiD1vm/tNFjo8.SyMDRu', NULL, '2019-09-24 17:40:20', '2019-09-24 17:40:20'),
(58, 1, 'email_verify', 'd27eace84add70a0e808cd76516bf2ba79e0f861', '$2y$10$X8VJIdC459Z5Ml3l6FSAteO3Ro3zysOSz8aQz73UBR38YcZ7VzrFW', NULL, '2019-09-24 17:41:15', '2019-09-24 17:41:15'),
(59, 1, 'email_verify', '5efb192ef85db5703962f79e74d93ea312543101', '$2y$10$/yVN75vJeLAjcb90bXUBUu/anlMPp6K5Zxjid7OMtvUcYWM6zSwte', NULL, '2019-09-24 18:08:13', '2019-09-24 18:08:13'),
(60, 1, 'email_verify', 'dc8109fa210d2b0450a1cb76fcca6db707f57a96', '$2y$10$lp9s0bexFZ4vJD.Mipkn5ubzgpIbuJnWjpw3mPCLfnFJ7D0Mlf2tS', NULL, '2019-09-24 18:09:52', '2019-09-24 18:09:52'),
(61, 5, 'email_verify', 'bd1772d8d4a6bf9efd8b5041538427533238f5ff', '$2y$10$O947Qy.gRHhXAqmWsWvjPOmeSqKONJlTsoOEzwSXZf13HnBHRwk4.', NULL, '2019-09-24 18:16:01', '2019-09-24 18:16:01'),
(62, 6, 'email_verify', '26bc38aa07d68165a9d2d492a01bf087040f3112', '$2y$10$5rcuw45O/jKj5MWX9KOY6eEXj0nYpODo5DGvoSSyxu0uTq26dyJ1e', NULL, '2019-09-24 18:30:30', '2019-09-24 18:30:30'),
(63, 6, 'email_verify', 'a5d61660ef93db2f3c84fa642dd31b67518415a2', '$2y$10$Nwsw3INTl737HqdjCM61mu1cEFhK7tHuxtFs5UqhVIWgYRKCgeix2', NULL, '2019-09-24 18:32:05', '2019-09-24 18:32:05'),
(64, 7, 'email_verify', 'fc3d0fbc1a5638fd69934b9a278f826d3ee5edb6', '$2y$10$MWeCU05DH6Jx9tU5xw98gulw.POOJQ1v84cCr9eVQiXmesMgF0Wo2', NULL, '2019-09-24 18:37:32', '2019-09-24 18:37:32'),
(65, 8, 'email_verify', 'c159a62a30163ac1d0023d5a8ea5e858ec4b6e18', '$2y$10$OY/6jyVKlfhyHv9DfqPmye56mqTpfaPJ5vwN71TzcpKpXv8XArgOC', NULL, '2019-09-24 18:42:59', '2019-09-24 18:42:59'),
(66, 9, 'email_verify', 'c16c52727de4debe48929fdedfcfa2732c123ea4', '$2y$10$eL63oCNXQu.LlddB2A2YV.37GTxQAJOyYopIt971PxQTq78jfnhWi', NULL, '2019-09-24 18:44:32', '2019-09-24 18:44:32'),
(67, 9, 'email_verify', '8884b8ef9794303df94b216673534fe12564068b', '$2y$10$s6zokcwm67oCuDNhSMAxVuFMHXdcv3kQEydr.S9AVhwMSpeoFjaKG', NULL, '2019-09-24 18:45:19', '2019-09-24 18:45:19'),
(68, 9, 'email_verify', '00546ae865f0b6fe2251f0cf500734a7fedf4744', '$2y$10$lxAEqAoy7eATf7rPPSn7butqMe30Z98LUK6VdKuExdVwUGe2l6ssi', NULL, '2019-09-24 18:45:21', '2019-09-24 18:45:21'),
(69, 12, 'email_verify', '9e7e35db51d04f17e322a4409e5b3bb27bc19d18', '$2y$10$AEKAPr1CPgj.his/R2eFL.Az.5p5eB6jwO13ylzdVMwY26V97ERUi', NULL, '2019-09-24 18:48:00', '2019-09-24 18:48:00'),
(70, 12, 'email_verify', 'ccae1cc70df84c27ca9228bcc9fa6bd0e6d19c3c', '$2y$10$6YRHJTlOo9gT6oz40XNPd.aCwlvrPR44KgiSN0qGB5JgGXBb45Hoq', NULL, '2019-09-24 18:48:27', '2019-09-24 18:48:27'),
(71, 13, 'email_verify', 'e6a339c3359e1b026a3bcbfe8c0bd7d4e4c47840', '$2y$10$CI/9H5J5qzqhZhzfHJRPouF3na7OD3glEzLW9MXV1uTOw52dDX2vK', NULL, '2019-09-24 18:49:34', '2019-09-24 18:49:34'),
(72, 14, 'email_verify', '2dab17a9523a2a17bbd5fb4cbf8cb4eaca38a280', '$2y$10$XEaUUkbM6CEEoxx6DroBP.a.WhIuFo.cUgRSFSXTTTbgURN0xEwyu', NULL, '2019-09-24 18:52:55', '2019-09-24 18:52:55'),
(73, 14, 'email_verify', '22ff7932bc2010053afa6d84be857376665e3eb6', '$2y$10$OV/0yHkX9kRp2FOjCaZBIuhT6tRCF7upf1TZ3rg.wdXdZZhFwA3dK', NULL, '2019-09-24 18:53:57', '2019-09-24 18:53:57'),
(74, 14, 'email_verify', 'd77de60f60bf9e4a4ed6e90b35dba01f88e8e155', '$2y$10$ubPLuaAQY7CH1eBFWYoFIuc4olApJrCiLNv0znJbCObFt.whfeZxi', NULL, '2019-09-24 18:54:05', '2019-09-24 18:54:05'),
(75, 14, 'email_verify', 'fabfe5fa8c756dc7215930d0ff98d9cf9d32c58f', '$2y$10$3Djk/B2xz0VAqyHxDfAELOMRcdlhcfYHSRe5sK92iS6vPRwABFHqC', NULL, '2019-09-24 18:54:52', '2019-09-24 18:54:52'),
(76, 14, 'email_verify', '8d52b216e168bb8b8bc350063143cabd9fa6f750', '$2y$10$txLN3Tgk62.gHniCVJFDMOc/pc2C6kZ8J.EN.y3VWK2AHjjund9WK', NULL, '2019-09-24 18:54:59', '2019-09-24 18:54:59'),
(77, 14, 'email_verify', 'd79b3b8e05e250b2ec10f780205f70d54acd5ff1', '$2y$10$mVsQ7WekABy5ULQVboGwDuqLge3uUiNUNAAz3AYqPBEBsEnlPuBA.', NULL, '2019-09-24 18:55:03', '2019-09-24 18:55:03'),
(78, 14, 'email_verify', '2ddc9465c2c277929f8b8d77f759d36c692eb36a', '$2y$10$kTu/22F0/18mQHxJAmS5n..vA6btyQyA6vSX7oDJv2bsic/nR.TQC', NULL, '2019-09-24 18:55:17', '2019-09-24 18:55:17'),
(79, 14, 'email_verify', '8c4e9d90954ee2b73fc1cfd54db39debcbcf8483', '$2y$10$JBZWxirkdL/5jBQhjMyHm.Z0JCBwFdvAk7m6xzLB1gWzPOqIsf5v6', NULL, '2019-09-24 18:55:29', '2019-09-24 18:55:29'),
(80, 14, 'email_verify', '36fbb33caaab85ed62bf6795849b23caf0bf3929', '$2y$10$By/DxnbvYwI0MgFlxD0H9.qR7fcjuI2OBi1oUTqeKEcM/6Tc7XzPS', NULL, '2019-09-24 18:55:45', '2019-09-24 18:55:45'),
(81, 15, 'email_verify', '88dda0c862a087c60017e8f6aa9715ce7ff55f86', '$2y$10$AY2npk.4rLCZp4dyaP9w8O2t.FwkorDRuxmrv895.HUJN3u9ehjk2', NULL, '2019-09-24 18:56:09', '2019-09-24 18:56:09'),
(82, 15, 'email_verify', '6eb8394452b4b4c6455478115dd3f865c3948e51', '$2y$10$ymkzymFPPksdtz20TVDxKODOS5ptD6AvvcVlNZvcIpZ7BqQjKW5PS', NULL, '2019-09-24 18:56:11', '2019-09-24 18:56:11'),
(83, 16, 'email_verify', '6802d656e35e56bc5ceb731859dcad489541ea3f', '$2y$10$XYS8CCeOjtwT7gfVsjNFZ.p/W5ocoqvLW.jbmxBljPPsVx.PaS4Iy', NULL, '2019-09-24 18:56:33', '2019-09-24 18:56:33'),
(84, 16, 'email_verify', '6eb00e5e8b3097de25ea48c30bf7c06985971e87', '$2y$10$Ei3xnKyWBbDBeznTBRhlhODS96E2BiNaDUAQi0f/C8UuMsmT1eJqK', NULL, '2019-09-24 18:57:36', '2019-09-24 18:57:36'),
(85, 16, 'email_verify', '6babfa3be4cf9ead3ff3136a702b60b52d7d9f73', '$2y$10$l.L6WRMQDaXcO4Jm/cI3UONA.4SjC22Awo96CaSsu3vQST1EBWrz2', NULL, '2019-09-24 18:57:36', '2019-09-24 18:57:36'),
(86, 16, 'email_verify', '9248f8129be36b263686243c18eb99889dd6d460', '$2y$10$E.wea2aYCD4rB96zykv3OON07xY4o9eQCFV5SSL9ut/qD2Ip1C3G6', NULL, '2019-09-25 10:29:12', '2019-09-25 10:29:12'),
(87, 16, 'email_verify', '2f800d87aeb2bf0d24a477284e79e05a5c8ef1ee', '$2y$10$CjZ1OP7kLJIDAfWJ6oGRyuH129q2MEQ6GieXRzcsEIK4DTWDzebCS', NULL, '2019-09-25 10:31:21', '2019-09-25 10:31:21'),
(88, 16, 'email_verify', 'a1c5627448802bca7f463b0b6fc0b52dd92c83ad', '$2y$10$YodPDYg8KiixvU9jnL375eCZXPcxNs2NtAkBefDlLxRvBLhypyq0q', NULL, '2019-09-25 10:34:05', '2019-09-25 10:34:05'),
(89, 16, 'email_verify', '89cafa26cb0c3ed6e8da1a475707a9fd18047329', '$2y$10$gBC6CLPb5V9VfMqv4D.WBeJ/YQioXfp.e8spOXHXIL9nQ.o67ao2O', NULL, '2019-09-25 10:34:18', '2019-09-25 10:34:18'),
(90, 17, 'email_verify', 'c6f6c217d205c76864767194850785cb66b3342b', '$2y$10$K2UyceIgGAFCsleun7ZsHOJsux7OPWdb4PjWY2JMZ5lSEyROqz2Ri', NULL, '2019-09-25 10:35:14', '2019-09-25 10:35:14'),
(91, 16, 'email_verify', '85ed21a3e912b8f352679471c71508a6a9dcf243', '$2y$10$QsSWf8/3smpFGU/DOOcAZuz5yvRE.zoK3nvQSGwD4UVS9FmWwjSp6', NULL, '2019-09-25 10:37:11', '2019-09-25 10:37:11'),
(92, 16, 'email_verify', '5e89ea0d3013b6647fc18052d3df424fe1db8b38', '$2y$10$Z.X0VHVWKU4ZJRle0qEgaed9sRoV6oXHOBaTkF09MX.0TBf8vckIO', NULL, '2019-09-25 10:37:34', '2019-09-25 10:37:34'),
(93, 16, 'email_verify', 'aea694968f2c1864208e0687166d954023a5d52a', '$2y$10$StjIwUI0hEsp.kQkI2c.x.LGJNk9ipFoA3nakPLP4eQzVYewa7QLi', NULL, '2019-09-25 10:51:25', '2019-09-25 10:51:25'),
(94, 16, 'email_verify', 'f3e0b7e68a4b7411ee97abbcf5ecbec54d55ba36', '$2y$10$N6VO6AURu0MdXm0m1Abc4uXtzrcErfBhTkOWTbkXP24.raiLZBs/y', NULL, '2019-09-25 10:56:48', '2019-09-25 10:56:48'),
(95, 16, 'email_verify', '55a58cf05c1149de5aa03d3a0d6eecfa5ae0e5e1', '$2y$10$4WfU3uAvlOiV.NL0S4cRbOhUXaLMrrfpTk1Yse0yTaKrC2j0fAF/y', NULL, '2019-09-25 10:56:51', '2019-09-25 10:56:51'),
(96, 16, 'email_verify', 'a9b75b5ea16cd418e9839d89106a3b9a97ab9aaa', '$2y$10$beIKs4cEPtsQRZvd8MPFuuCnl6LufYPPt21GkSQ1rCrc92iWem6eq', NULL, '2019-09-25 10:56:54', '2019-09-25 10:56:54'),
(97, 16, 'email_verify', 'e8437da708d4f738e68627b76bd53ab1ce85f104', '$2y$10$S88Hl/4r3TrBc0KwzHr5J.Dllr157IbO5Dy1Yc62f/J054g1LZ9j.', NULL, '2019-09-25 10:56:59', '2019-09-25 10:56:59'),
(98, 16, 'email_verify', '9bcc6093e08a7dbe709ac3f3fccc71d8b3d70eac', '$2y$10$ovo7nBjubNoxyqi0sPeOEOqcRUsnTqCDjptG5BTeh8fJ43O9x49Ay', NULL, '2019-09-25 10:57:07', '2019-09-25 10:57:07'),
(99, 16, 'email_verify', '026e94fc610c16c2ec969cca21a4b2bdd42cef10', '$2y$10$XbmIv6ODp7iS9g8MNTqRP.v0CaumoQeMGCutGThIIZUrwSF8QNtyu', NULL, '2019-09-25 10:57:14', '2019-09-25 10:57:14'),
(100, 16, 'email_verify', '52056f8cdc9f9bceab53f761bf7ade22e8079a27', '$2y$10$oA7rjX081ZKB4q.eyXTmROUX1n8dzVsNMDYKtoHp./2pXEN240FvG', NULL, '2019-09-25 10:57:55', '2019-09-25 10:57:55'),
(101, 16, 'email_verify', '06a21752d1540d2255feb6ea687b307fff58f1a9', '$2y$10$UggUfeQPB3BDb2vtMH4/NOweYFc9TZCo0n3Kw5SRw.GQVlOUT9lhq', NULL, '2019-09-25 10:58:26', '2019-09-25 10:58:26'),
(102, 16, 'email_verify', 'a532061cd1a7ae29436a5d905a0ea95f161dc499', '$2y$10$pyPTRS7CbM0noA3JecOy7OdG3wD9B0PbwO1HUIdaegRIJGWf42bBu', NULL, '2019-09-25 11:00:50', '2019-09-25 11:00:50'),
(103, 16, 'email_verify', 'b5a28df837507d6898a7c7b3719e071895df0976', '$2y$10$D5qK.dKcFp97wbAt5qyBvul7G0E17sXX5wc5eNPzsFdk3To4VuF2S', NULL, '2019-09-25 11:01:23', '2019-09-25 11:01:23'),
(104, 16, 'email_verify', '73f209a5356e2139e3e66db7cf47120c785b7d25', '$2y$10$x8zl6sVw/sDSjOAmL9RzoucbQSKcaHcK6knin16DEibp2Z4Tr0TjO', NULL, '2019-09-25 11:01:36', '2019-09-25 11:01:36'),
(105, 16, 'email_verify', '98ab465a20d426b7338033d1ede3deb159af5a4f', '$2y$10$0lY/6n6idNw8JjRq9h6tzO1ZxlxflASL10/.XnL2rbJM0nkHzeOPu', NULL, '2019-09-25 12:03:45', '2019-09-25 12:03:45'),
(106, 16, 'email_verify', '06c04c919ff32eea951c1255e904812e59c9a3b0', '$2y$10$i9ZxBbcJ6aJA2PkPwl853eR9bPO19JQXAcTf3oJVDFQ8Y334hGRiO', NULL, '2019-09-25 12:03:48', '2019-09-25 12:03:48'),
(107, 16, 'email_verify', '7b3e6fbc0fbb0b6aba40c79f9d18d57ff3f9719f', '$2y$10$9FgS3LS/619vwstMkqiNa.j7WHcKYvztPtBUz/qfH9cuM5oI1LR7i', NULL, '2019-09-25 12:30:19', '2019-09-25 12:30:19'),
(108, 16, 'email_verify', '2f08098980f3ddfd87efddda486c091ca6451ba8', '$2y$10$YvT3lAocpVokGsizTgCRPOE5aPRw0/KrPbXgumh9P5S.DFpb.63rW', NULL, '2019-09-25 12:42:36', '2019-09-25 12:42:36'),
(109, 16, 'email_verify', 'a5c9f900eb098e8b28f220bc546af097a6c6f31a', '$2y$10$s0Z5qxH2/4o2C3LwluV2pOqpUWEPvxzsvXhSFD.t3r9OvCpf1Bnia', NULL, '2019-09-25 12:43:19', '2019-09-25 12:43:19'),
(110, 16, 'email_verify', 'a4fc40c5c061248393940c730ed4790b5e8f7793', '$2y$10$afj//AlA9tidZ.TFgh53Y.9KQt09pNUym5tpNJ9kN40L/d2jw0LNq', NULL, '2019-09-25 13:11:36', '2019-09-25 13:11:36'),
(111, 16, 'email_verify', '110d2d3c9af04f2cd71736be62d4009a9e0bd1b6', '$2y$10$H7o40.nfAN.xNthhc1Thou86r9Sg9/sAQSAILOY9gkmJ4QvEq.yim', NULL, '2019-09-25 13:11:37', '2019-09-25 13:11:37'),
(112, 16, 'email_verify', '3b7db964159c887743a0b3a4f68de2266b39928a', '$2y$10$BwVGH79SrOrfgWYaDz4Vp.KsdKZ3B0BR3fRRLFs8zdDE08WCMCV3y', NULL, '2019-09-25 13:21:26', '2019-09-25 13:21:26'),
(113, 16, 'email_verify', '5464872bb158c34622c81107046f0b6ef46c12e8', '$2y$10$twg9qmi6PJ55dzBnOXV2Uu7c7moCUNbmkzfCSf3KnNXT5r75dbC8K', NULL, '2019-09-25 13:21:32', '2019-09-25 13:21:32'),
(114, 16, 'email_verify', '67cb72a8312d745b9d872df615f34fb889220361', '$2y$10$mAW7Km32R5kqi/7/9dyWJ.qsWueikTjB.7kpTDJIjsGXgxhgDeDJO', NULL, '2019-09-25 13:22:17', '2019-09-25 13:22:17'),
(115, 16, 'email_verify', 'dd8654f39d0aebfac7fdafd6706097c7941fb297', '$2y$10$r4w5Z9CN.6LK3lWyn0Pw8.Xifdhgs7F6F7MYSAYfTvqzvOff7e8fe', NULL, '2019-09-25 13:22:19', '2019-09-25 13:22:19'),
(116, 16, 'email_verify', '4e9953c55339d00aca294ce59d85eed3139bc5cf', '$2y$10$W8w445El24mUNZnGNmFuie/reaSyttQUAVgREDnwRemNv/3jRoDjS', NULL, '2019-09-25 13:22:21', '2019-09-25 13:22:21'),
(117, 16, 'email_verify', '5a2a0dace61368ffe20499756497c480d29cf236', '$2y$10$TJ6obIc1MBh3AyhvCc12v.Pj2kulwWt7G3md8qYdcI.F3MahwCuBu', NULL, '2019-09-25 13:23:50', '2019-09-25 13:23:50'),
(118, 16, 'email_verify', 'e3bcebd906b335ba4df52d1c6c7bd7bf3ac9c9a2', '$2y$10$73nnEuuKc/exPXSR3DMxW.3PP9A3JdHKie8uvO21fIGW2S0JHImNS', NULL, '2019-09-25 13:24:30', '2019-09-25 13:24:30'),
(119, 16, 'email_verify', '3c24d6c5c11f81002eea4611b1ae6c8d190e7135', '$2y$10$1TKN8znJKolPY1kTC.RYUeo4uaKpwwRFQoL7j8EsQgbVASlsws5x6', NULL, '2019-09-25 13:24:32', '2019-09-25 13:24:32'),
(120, 16, 'email_verify', '823d08a63bf7f94039536ee4817d521956663a91', '$2y$10$WAyXgs.Ss4ujffEGi9pU7uP9kc0/pNpvN9Fi9eK5ZpJj7jIzizWSS', NULL, '2019-09-25 13:24:36', '2019-09-25 13:24:36'),
(121, 16, 'email_verify', 'a13ccc8c4b939e06f89423fb0e89785ae8274570', '$2y$10$rzf110qsTOzfQAMYvcZSbOWrKKbUGjEhspZed5v7WrZmVotLnB7XG', NULL, '2019-09-25 13:25:42', '2019-09-25 13:25:42'),
(122, 16, 'email_verify', '5c75611985bff337e298f84e75501f74b3f0d8c9', '$2y$10$BJuI2tjCR5ZH/MWQsJdF5O.4ki0BNbaPBeyGqmK9p6T8nhIVUIk/W', NULL, '2019-09-25 13:26:07', '2019-09-25 13:26:07'),
(123, 16, 'email_verify', '4d7febe9548f81ef4e847730c962a1934a386027', '$2y$10$Weza1JAFMZwqmL5rdEdgtOfVzwoDiEjwg0DnueW/0MM9uMYn/SEVO', NULL, '2019-09-25 13:26:27', '2019-09-25 13:26:27'),
(124, 16, 'email_verify', '45e9db8703a649b80e0b9d0c19384ec641700ee9', '$2y$10$pywuC35PGU4m7FTzw0tckuKyMekx3FDw1V5OM574KgvUWV6CO7ayC', NULL, '2019-09-25 13:26:50', '2019-09-25 13:26:50'),
(125, 16, 'email_verify', 'bcf36685cecc09164f041c921b22a63def3d9a80', '$2y$10$jKNknKwQLMFPnfhqnLLYxOhOJRxKmDL/h/Iotv32URzFfILnV4spm', NULL, '2019-09-25 13:26:56', '2019-09-25 13:26:56'),
(126, 16, 'email_verify', '05141d33137250a657d026a21c603417828f347f', '$2y$10$UeeIlkxqyuI53LIZWgiHpOedNYdOt80wLERV4gUvP6mdIREH.Ebk.', NULL, '2019-09-25 13:30:14', '2019-09-25 13:30:14'),
(127, 16, 'email_verify', '56569ec9bcf59f54f5bcb7f61c1c1ff147cd5578', '$2y$10$puxJ2ee6vRDW04H606uoAeu2P/xSWPn8DOzw4kP5nkUd1.PyjoVBy', NULL, '2019-09-25 13:30:16', '2019-09-25 13:30:16'),
(128, 16, 'email_verify', '86fb8c8b5d8e793c2a68e3d96781f80c36e55da6', '$2y$10$pMaVyp23Pyg3LZdGKUME1uZngIe0SU3SWGlPUWxAbh6cJkCu0Ijva', NULL, '2019-09-25 13:30:20', '2019-09-25 13:30:20'),
(129, 16, 'email_verify', '1d3d809f5950f76a3a64aca52a290a9d6f7b4ecb', '$2y$10$qS6/9DYI/MkyxK3Avitwt.ZjNW7XuHbbdPYPz9UkNYj/F1H5/G1lq', NULL, '2019-09-25 13:37:08', '2019-09-25 13:37:08'),
(130, 16, 'email_verify', '5f74f1bc4ca9dff58e1a533ab5e4ca7f64ee42fe', '$2y$10$k0fxIFMu1Wfbpas8rnUTpuDo/VG5qZ.n0btJJaFLqsEPXBytdMLHm', NULL, '2019-09-25 13:39:03', '2019-09-25 13:39:03'),
(131, 17, 'email_verify', 'bb77031f173df87b49ad0c92ebdbfbcc8c000857', '$2y$10$oZTGsz.5iq0lWEQcTy.ddO1YhRAT6I3XaB7O6E2STXYHZgFi1fYtO', NULL, '2019-09-25 15:39:06', '2019-09-25 15:39:06'),
(132, 17, 'email_verify', 'c86fe9df4b673ee6a54ec02a29a74d770499f895', '$2y$10$jJkGj46jlw2Mv/KJ0pG93uhW959MQhXa3ot2mwZ.lpdrhsL5bDL6m', NULL, '2019-09-25 15:49:09', '2019-09-25 15:49:09'),
(133, 17, 'email_verify', 'd743f47b9102e3d43c058709278b81fd9c2f3f8d', '$2y$10$6nyrpYkLJAqgg3YP8dFFQ.oD8cPQhdw26uz1WP/cuwnybk9NZ6Dhm', NULL, '2019-09-25 15:50:12', '2019-09-25 15:50:12'),
(134, 17, 'email_verify', '1c49510642a0202ab42da875eed8fd6d6ea1815c', '$2y$10$A1dEkIYytR54FLx3GvOKW.QYspEUIAowK0xzj2kzVePy7VSXlS0wu', NULL, '2019-09-25 15:56:57', '2019-09-25 15:56:57'),
(135, 16, 'email_verify', 'c0e16acf2324e7e48e67735b240c7b5cd4c335a4', '$2y$10$6qBdamMuC5kb6WREzrVANeVXe4ZziymtX/pv1xuxT5mDmsJ.6/GJy', NULL, '2019-09-25 16:09:29', '2019-09-25 16:09:29'),
(136, 16, 'email_verify', '2a1e63cafb905ded7459bb96bf80b6332d3b17fd', '$2y$10$rZ.k3jvMGhbcMnofwXS8KOVsl9z1YYnw.XV/jUIvbDPO.VVy/ecRq', NULL, '2019-09-25 16:10:09', '2019-09-25 16:10:09'),
(137, 16, 'email_verify', '29c4d976e7e3e205c01c0effb46a8b3ee762761a', '$2y$10$SDeQnc0mbiJRsliUjvXdsucqZg1oHh36FkgQgS5zf4X5mtolvkEEa', NULL, '2019-09-25 16:17:02', '2019-09-25 16:17:02'),
(138, 16, 'email_verify', '32194dcb8b4c5eec7ac69278ebc206e03ffdd646', '$2y$10$fteqTslYJeCrIVVnSdZeGemhygZ2x.J95VFqrXl8vqzo6AqwJF/5m', NULL, '2019-09-25 16:17:59', '2019-09-25 16:17:59'),
(139, 16, 'email_verify', '56dd0d1836d4a896dc06256c873c3b955b9ab369', '$2y$10$RuLS6BuZEAMpXsK2z0Pz5u.zpVIz3Dyvs6On8EijEYH5xSuB9y6Oi', NULL, '2019-09-25 16:18:11', '2019-09-25 16:18:11'),
(140, 16, 'email_verify', 'c8f2ae9c6096c996984d5799c036318716ecc182', '$2y$10$eZRPb6TkCPyqhsBOy4r1PeJxNb/SOOK.dmiKbSnHxPQlHJlGMDGcu', NULL, '2019-09-25 16:24:50', '2019-09-25 16:24:50'),
(141, 16, 'email_verify', 'db5d9a1ca506e0e14a9934e8051e6c794ae5be53', '$2y$10$6aJ2JJa3SlwiaTbeH/stueUNxnH1Gh.uurVxngAsYbN4i2i3O4UIm', NULL, '2019-09-25 16:27:52', '2019-09-25 16:27:52'),
(142, 16, 'email_verify', '20ff9d1e1ad08c57809f7b1f15d49821d9ef8161', '$2y$10$RTe.LIDsONHT//dXjbgBIui28IW2cfryRQ11h1sth6odfzT9mSbVe', NULL, '2019-09-25 16:29:00', '2019-09-25 16:29:00'),
(143, 16, 'email_verify', '6c6a55dc09683d4047e950909574069a4a57a9ad', '$2y$10$U27JInvaVnKzj6NsuyCxQekq.DN1iGPzuY7GZg1DiqZZ8vc0uEOWy', NULL, '2019-09-25 16:29:38', '2019-09-25 16:29:38'),
(144, 16, 'email_verify', '6ce1b341b6a8fa7065992f2c5d2d643eee0210ee', '$2y$10$sjHicq4gq5T3Er/eZwuPi.kTH/YBjXlYfzwqhTS7YcZMBDwiQ9GhS', NULL, '2019-09-25 16:34:42', '2019-09-25 16:34:42'),
(145, 16, 'email_verify', '5abff06b1c2e95746c0f24ac095e5f449c6f5b05', '$2y$10$RsFONuJvFw86Asm5e2EwMO9hQ/uG9.tvepLFmiLwCUQCoGymmTGO6', NULL, '2019-09-25 16:45:37', '2019-09-25 16:45:37'),
(146, 16, 'email_verify', '5cddeee41d0a89a56ddf80eb894d39aa1790e067', '$2y$10$ZqtyGYGnnPSm8KL3YsuVSuNU.yGL2pAhaSvvZpLMDdO0AP/q3EllK', NULL, '2019-09-25 16:54:20', '2019-09-25 16:54:20'),
(147, 16, 'email_verify', '22a89bf1c0b06cc02f23263bf5f487ec9b9a5316', '$2y$10$ZdqtxPfxhl8iUiH22OS6BeywAyjFdWUIkoZN/FzjSSp1IStgRiHpS', NULL, '2019-09-25 16:54:52', '2019-09-25 16:54:52'),
(148, 16, 'email_verify', 'f086b278bc26d0796f7aaa36b8facf6d17e3d5c2', '$2y$10$ObgXtmXFvaUjnKtRBlQX7Om57KEnDGxG4k0htDEOcoFeAa2cpQmay', NULL, '2019-09-25 17:05:23', '2019-09-25 17:05:23'),
(149, 16, 'email_verify', 'c59d89e2e880252f710ccc0996e10f5e059fc6c3', '$2y$10$/NYezfMo9mAGDKeMVDBqAeTEFAJed1nkulZdlrqyv1JeJyxxZ8Lum', NULL, '2019-09-25 17:05:34', '2019-09-25 17:05:34'),
(150, 16, 'email_verify', 'f2bb8b4fbb477b6e0bdfde66afbfd63e49262004', '$2y$10$2fm5WLciPgt5pNdXIy/kfekYCZP9GgHJ6ImWWOIB5E2znpGrq5ZcS', NULL, '2019-09-25 17:06:09', '2019-09-25 17:06:09'),
(151, 16, 'email_verify', 'fdf2ca5e55c0c368d725fb4bb033e2e6055fb012', '$2y$10$TuqHoeQSdziGVEK01zybqObThjQI7jHRaBkB1V/zDWeinnf9CsNN6', NULL, '2019-09-25 17:08:49', '2019-09-25 17:08:49'),
(152, 16, 'email_verify', 'eb7407a047b2c995c10b323d9350134b55d632e1', '$2y$10$DmmCgIhx26WTjxjwpieqk.ANH9ak2963/KP62HAt5Z88V6mkH44hi', NULL, '2019-09-25 17:12:00', '2019-09-25 17:12:00'),
(153, 16, 'email_verify', '38cd0e95d21e9cbc6ac00d05a6f225bc6eaa0418', '$2y$10$bDaok/q8aYyU0Lh/q2HaOOvVjmLzho//6X8zwNm6atUrIfnS7ohb2', NULL, '2019-09-25 17:13:49', '2019-09-25 17:13:49'),
(154, 16, 'email_verify', '20633c5373f369400f96d5554c51116bcc861ff4', '$2y$10$DcfPsBHOSlFevY6MW8x8Te.FQ/tTpTfxGjP1paQ9Qsr.lU0PtwTyW', NULL, '2019-09-25 17:14:39', '2019-09-25 17:14:39'),
(155, 16, 'email_verify', 'a82af0e2a5ec84d05c0ca96462c6df30fca32e62', '$2y$10$rE2DDs4PH4.t9GXHBQRphurtE6pVZr6Sw9YUxDTEUGwE1qXAoj5Pe', NULL, '2019-09-25 17:15:11', '2019-09-25 17:15:11'),
(156, 16, 'email_verify', 'c54478416a351f7302b1cad07f38827b937fbc14', '$2y$10$Ag2dXeJzqyeM7ecsbR1p/uuctroORsfGyvZYtd57nm1DJNfK8Dm0G', NULL, '2019-09-25 17:15:16', '2019-09-25 17:15:16'),
(157, 16, 'email_verify', 'a95be68f2969970266559b30c7cef7832761b559', '$2y$10$MvxTYGKZq.sPGOSh4aDHLOYlJo3i6nh7yOs1s0mlC6HMpkqalarYC', NULL, '2019-09-25 17:15:58', '2019-09-25 17:15:58'),
(158, 16, 'email_verify', '0052f87d433f1c0516d6016f0fa41762b20bb26a', '$2y$10$BMlmJzNPMqcmk1njBeCIHeCBOxE.RbFBiFldN2BfYkBBzFFfKdSq2', NULL, '2019-09-25 17:19:38', '2019-09-25 17:19:38'),
(159, 16, 'email_verify', 'b75a6c9de1aa5c76cefaf79b7141600760201ea6', '$2y$10$DL0KQq2KRpMKgUVsak.jPu1XAIQuaOOjSMfIOcWPHkbzSKSlhhYOm', NULL, '2019-09-25 17:35:14', '2019-09-25 17:35:14'),
(160, 16, 'email_verify', 'f60146f03437cdab5d42a351821026fd4f21b679', '$2y$10$gb3WUOruAqBlivvEUSODsO01VCunWb0ZU7G7DU85h.4RgatKbVXdq', NULL, '2019-09-25 18:13:34', '2019-09-25 18:13:34'),
(161, 16, 'email_verify', '9b5ff533de9011161fa7abcc754c73268dcffa3c', '$2y$10$WgDRo/kzm9.6y1c7U4DtSu4Y1G5QXpu/y7/1C9dQ3uHEH0ueMDguW', NULL, '2019-09-25 18:13:34', '2019-09-25 18:13:34'),
(162, 16, 'email_verify', '30e76aa363aa76dc41c119b11a5d7c00b734c1b7', '$2y$10$v8MYuwSi4ildqhJ4b/fqteRBe4h3kjLPTPtGTVTUST5FykFQU0YSy', NULL, '2019-09-25 18:53:19', '2019-09-25 18:53:19'),
(163, 16, 'email_verify', 'f50eb7a66e069a941d9af3cb40c293849a3edd16', '$2y$10$JRt.WeujqbYUiQMduuODceZixmw1AWaIzyNL7bJfVT1/PVGmO9G92', NULL, '2019-09-25 18:53:41', '2019-09-25 18:53:41'),
(164, 16, 'email_verify', '2f15e7bc70e35682938ca8498b92c41f08d10b91', '$2y$10$U/IL5GJwnvAnrEIF9UScA.Tf7lnI5y/W0SppaZM/TVJ.J.NeBXXk6', NULL, '2019-09-25 18:55:40', '2019-09-25 18:55:40'),
(165, 16, 'email_verify', '9cbc323b6efa25bfd9a2db8a7e855cb5c71542c3', '$2y$10$.K5IiWXTpPKD2ZeQflQoNuNjZkSHGhGNp7qsXztpbN.X3dvGo.XMa', NULL, '2019-09-25 18:55:50', '2019-09-25 18:55:50'),
(166, 16, 'email_verify', '7f1753f25179c185acf60aba9c6df280e60a630a', '$2y$10$crQ8w6c72L83CFL/SYKfoOWtwExeUOM2q8hVR5RViUmn0eV0.lzeG', NULL, '2019-09-25 18:58:37', '2019-09-25 18:58:37'),
(167, 16, 'email_verify', 'ed8c586a338448e608222aabee25d270c570f7f2', '$2y$10$RB3wtshyi4j5x6TOJOz93uCP.PRyK3aY87fBcmUlfB3vBKq6XAAEe', NULL, '2019-09-25 18:59:29', '2019-09-25 18:59:29'),
(168, 1, 'email_verify', '654a578a5c3fa33710cfc5611449fe5e2de4ad89', '$2y$10$4bCeYYMoo90ueLYlEI0qFeYWiWVsOTZxej4kUtvyQptBXyk4ixqOm', NULL, '2019-09-26 18:11:59', '2019-09-26 18:11:59'),
(169, 1, 'email_verify', '08eb882bba4c5fb6e6293466316fa8f7a57b1483', '$2y$10$3WZS1.LzfgFQGSHlJ0L/zekzneXavS5cTbswWNu51NOo/kTPUO846', NULL, '2019-09-26 18:35:53', '2019-09-26 18:35:53'),
(170, 1, 'email_verify', '370b1dab65e9867238771a370b86d2e4aafbd9e2', '$2y$10$k4L5bniu83xNf4hYcQFtIeuMrojqneMQwDeTkx8oJY7fkbCmp8VZu', NULL, '2019-09-26 18:39:35', '2019-09-26 18:39:35'),
(171, 1, 'email_verify', '8c939aca4e282f7fd276177d1ea4036c8d9f79b1', '$2y$10$dhV7A3BqThWC.mKdD6vioutGA0Uzi6KcxhPn462PK9Rvh4Ow613wG', NULL, '2019-09-26 18:49:20', '2019-09-26 18:49:20'),
(172, 1, 'email_verify', 'c0ff8eb6937d4a084bf30e89a43fe70ecdcc2195', '$2y$10$592Cyw0NCrVBUQZ0Ib8oteIlOpEh72eGO3njJZpu/ym9U7yuMOLba', NULL, '2019-09-26 18:52:00', '2019-09-26 18:52:00'),
(173, 1, 'email_verify', '6332a2593906c4e9964955805ceb76b0b2b3a988', '$2y$10$4SVtWRjrEjEf6r4x3vpOCuNRVCWoCAHR4YBgv/GRwmTtXY4.mXN0a', NULL, '2019-09-26 18:58:08', '2019-09-26 18:58:08'),
(174, 1, 'email_verify', '03b1680c092abb402c7c5416bfdabb15784d49f6', '$2y$10$FAS2/ugZAR1lXzcsEmzSgudyscI3kD.0IkSnemPod6XJLFoEfysEy', NULL, '2019-09-27 10:32:18', '2019-09-27 10:32:18'),
(175, 1, 'email_verify', 'e6cd40788732d5019ae671134b0c9101a30a913b', '$2y$10$dMWQwEFnICRa5EqBZT0GGuCQbIO76cubHGmjN84AjPgDu/.SB6XyG', NULL, '2019-09-27 10:32:18', '2019-09-27 10:32:18'),
(176, 1, 'email_verify', 'fb0437a5b84ebbf22c86e2dc9c91e557acf128d8', '$2y$10$DgHC4LTJWt5fUgMijyxdiO1BAKCe6OEXBMQv48SX/Pp9BDVtBvCeG', NULL, '2019-09-27 10:32:50', '2019-09-27 10:32:50'),
(177, 16, 'email_verify', 'ce01255017a542125d9b07a70652b7bba42227c0', '$2y$10$fy2TLQuInj4weYyirE329.bYZyFLD9/eFZZOkC1Ifx/XINpRuxMt6', NULL, '2019-09-27 10:42:57', '2019-09-27 10:42:57'),
(250, 16, 'email_verify', '569572f8cf2b6139b9e246cebe245f00d167879a', '$2y$10$fvVFJNNNTht2k/H16B6QfegeUKSkuk80xsYAJpGCp5la5vTBWawiK', NULL, '2019-10-01 11:54:11', '2019-10-01 11:54:11'),
(251, 17, 'email_verify', 'b3b19e62c4d528676f3341bc94b5c50e0fd47f1f', '$2y$10$In/78nx/NU8XOrRwpBp57.EhHYKwTTFUnuVof2umptXSTmLayHsPW', NULL, '2019-10-01 11:56:30', '2019-10-01 11:56:30'),
(252, 17, 'email_verify', 'd9111d3726d0a249dde2156dcd0e9d73df44c334', '$2y$10$g8UPTVp3EDslQg67l7eJ.Or2Oo3Q.5PiYzg3QlZIj7cATNKgMqjMO', NULL, '2019-10-01 11:57:07', '2019-10-01 11:57:07'),
(254, 18, 'email_verify', 'a932a0df64d03ba5622f98899defa5ba25840dc3', '$2y$10$KORj104OvPy5oIRPEvSP9euvNH7qOOkgIkk1AgewvbfOyxp86RMXy', NULL, '2019-10-08 11:29:45', '2019-10-08 11:29:45'),
(258, 17, 'email_verify', '3f07e56a1eee02d8e66f3913f774101bd9f0398c', '$2y$10$GunTneivQieGVncjTs90j.a2nWmD2yAso3DCVJ4WDpxPeNMWj/sQm', NULL, '2019-10-17 10:32:41', '2019-10-17 10:32:41'),
(261, 19, 'email_verify', '6a7bc8ab225d3aa8bd8773bef832230619bbff9e', '$2y$10$wJElHfTHhg7DrnR.4v.4g.1RNXNHY6mpfQ5DZFaNzwknbrflnxQJ.', NULL, '2019-11-15 11:23:24', '2019-11-15 11:23:24'),
(262, 22, 'email_verify', '2bd8a97881308c6cf5fbb200c05f3d5fb8e21881', '$2y$10$0VWSWxNJhQjJri0gi93HPuO0yRQHIZQrLCiZDl7Nt/.zmuDM3cy66', NULL, '2020-01-13 11:08:42', '2020-01-13 11:08:42'),
(263, 22, 'email_verify', '3e174f3b3847e23cc42af6640bdfd43641baee25', '$2y$10$X3B4LFDPrUm427yTzq/ZFuh7uY6F5UEyCUUQcn5yf6p45x..lQDei', NULL, '2020-01-13 12:56:02', '2020-01-13 12:56:02'),
(264, 23, 'email_verify', '30f2e5ccdaec7043c773cfba82d3d24fd80685a7', '$2y$10$KEr1UNWLxxclysAz1DLmgOuUBqDhKncE6g0wPZ3vK7CHo6ne7cIkK', NULL, '2020-01-14 13:55:13', '2020-01-14 13:55:13'),
(265, 24, 'email_verify', 'be9e9a845dd4df0f49617de7afc1cf727589c2ce', '$2y$10$KwAiK9eBuNUSz.aw6pctZum84V5vWuZHtSrxZ.cPIMqIxC82IzESi', NULL, '2020-01-14 19:15:50', '2020-01-14 19:15:50'),
(266, 25, 'email_verify', '1f4ab4718aa99bce36760c99ca6f8599a0eea3e0', '$2y$10$pVQmjhXs2/eJLb3yLJun7e4PwBiFgD3Z3qr1rD7Yo.PArbBUQOsOC', NULL, '2020-01-14 19:16:56', '2020-01-14 19:16:56'),
(267, 26, 'email_verify', '7d8175c001c41f92daedd7cc963acc05cb8830ca', '$2y$10$WCNkETFF2zDFPQj4PxvEkuek1G6pH978phJRbt4NfJ8R68tpFVR5e', NULL, '2020-01-14 19:18:53', '2020-01-14 19:18:53'),
(268, 27, 'email_verify', '890cbb89391451b812f285c712a66606a04581f9', '$2y$10$5IvyWjAjpptjPsMYr5bc8uqq7QpPVE8Qh2xk9ePnL8znRlaeHk9ly', NULL, '2020-01-15 15:25:56', '2020-01-15 15:25:56'),
(269, 28, 'email_verify', 'ca2ea09e54f554f136f46dfecb34639059b9ce9f', '$2y$10$eLaYJ3GFOwlrHjGpNY9sX.wIlsgbYAy8zGvvsPJCMQlQYd96uW5dm', NULL, '2020-01-15 15:26:35', '2020-01-15 15:26:35'),
(270, 29, 'email_verify', '0a19bfddec3b7f2e5d9e011ef5c713adbdd63d36', '$2y$10$QrDc2HjCd/f4SZIE3Mg.KuYGkJHfZTMgyeLEpiinb50Re1XYxR7iO', NULL, '2020-01-15 16:28:01', '2020-01-15 16:28:01'),
(271, 30, 'email_verify', 'a4a10d7c797e7493678f39f5f9bc7080c9a1369d', '$2y$10$lkhsl8OPOIi1wZnywoMegeDCRJog0REfwEVEsbfRbP2FTjZJiJO1W', NULL, '2020-01-15 16:31:06', '2020-01-15 16:31:06'),
(272, 31, 'email_verify', '0bc9f8e1ba6dc2590ba46284de7f9417beca80e9', '$2y$10$vly7cLRXL38egC.kHbPwMehaLJilQfyTnov7UgyYNcd/iwgHXmGzK', NULL, '2020-01-15 16:34:07', '2020-01-15 16:34:07'),
(273, 32, 'new_password', '2f37481b99315cdbced29c9ded933cc569fc744b', '$2y$10$rJpmg3MWDq30QOQ7ri9Ww.hMnQwazMNLjkA6wa0NxFWYScBQ1b5Fq', NULL, '2020-01-15 16:37:46', '2020-01-15 16:37:46'),
(274, 33, 'new_password', 'b637049709eac47f48cb8b7b761d84b6984640a1', '$2y$10$akZN1kfnPMqPdNdQ61zLC.TNQ57hTUPxmYHKO0TQY6ovgK1FdZd7q', NULL, '2020-01-15 16:46:27', '2020-01-15 16:46:27'),
(275, 34, 'new_password', '5c815f69ab7ae1633100987c3b805760e7f2f230', '$2y$10$1ANE4Nbd1v8.SKXmLQV52.pAGv3hUy5HCVEiHKn3bBRvLTpMqay1m', NULL, '2020-01-15 16:47:49', '2020-01-15 16:47:49'),
(276, 35, 'new_password', 'aafb9f6dea21f07a3da923d936d92941a5e869fa', '$2y$10$bJMFhT.NJCRvrWzJw82b5OORboSKiPQBHMW.SwB2MI1OcHrK/7L0a', NULL, '2020-01-15 16:58:51', '2020-01-15 16:58:51'),
(277, 36, 'new_password', '352cedf8960eecdad2ee5cea8dcfe88adfed76b5', '$2y$10$d56PFyOuO.ffmpYtn8l5zu7AC82u/nUHyta9oaO7S5cM0CIML9B86', NULL, '2020-01-15 17:01:38', '2020-01-15 17:01:38'),
(278, 37, 'new_password', 'e24f9d88f0f38af263e4d16921bd670d983ff02e', '$2y$10$Pe6bEA6nGInT/8pyNCqEaeYUUT7zzLAOY7p0iWPVLTTqaD05S3NEK', NULL, '2020-01-15 17:04:46', '2020-01-15 17:04:46'),
(279, 38, 'new_password', 'f8b0bc8487d6a3a381ec1b9360168d48761e67c0', '$2y$10$GH6IrUhAcLik9z70/wXOvOxqL9mRUia6K764hqq8YTUCNhRy6wZ0K', NULL, '2020-01-15 17:08:17', '2020-01-15 17:08:17'),
(280, 39, 'new_password', 'd6ba933a6b18a805176d12240a927fdc98b33436', '$2y$10$PP3j6.CDoaL1wkouhWoU7ex5Fj8CGtzwU2VHvrzsIBXTRlGc248MC', NULL, '2020-01-15 17:09:45', '2020-01-15 17:09:45'),
(281, 40, 'new_password', 'b9b24e858e3912a0a4da276dec1c8c83fec1ccc2', '$2y$10$oFX1V5AN6B7/L0ri3JrRsu0Luch2x0ZYZu3CI3JbPeOXV2nLmkhUy', NULL, '2020-01-15 17:13:41', '2020-01-15 17:13:41'),
(282, 41, 'email_verify', '85c2cc453d3fd8947e67390e2ed85e81372f2f22', '$2y$10$GURKdNdb1o.y.lveUq085eXy5b7pM6Z6DNmu9sFcam2tBjOWTKqvW', NULL, '2020-01-16 11:03:57', '2020-01-16 11:03:57'),
(283, 42, 'email_verify', '8df2c2ea80ec650af754d29d993d9a26d3c7ef44', '$2y$10$IXVgoFQlHXkIMTCtjvdgtOLgVmSpTlwk7fxrHTjcSxeV/dP8zKISi', NULL, '2020-01-16 11:12:27', '2020-01-16 11:12:27'),
(284, 43, 'email_verify', '2f2974b8be71198e2d891c6c78e57d4ea9778932', '$2y$10$ffVbzaIJH1Ahomr8PiqTf.GvbocQkKeS5.3lMzu/zP9ATew6iAThS', NULL, '2020-01-16 11:13:16', '2020-01-16 11:13:16'),
(285, 44, 'email_verify', '11941db2c57b18fdd477473137f50da590404c6a', '$2y$10$QFEX3XT/S5rNGOOfDhn8Qu//E/AoamcF/KOgilITdsdRHxshWyxXK', NULL, '2020-01-16 11:17:21', '2020-01-16 11:17:21'),
(286, 45, 'email_verify', '0ecac368ea53913d350cbde38828caf9c4797ca4', '$2y$10$S1K3shxFJcooBfo.fYbwF.1yUBvsFGiNcIRQn3r0njoN6PuCh7s/S', NULL, '2020-01-16 11:18:56', '2020-01-16 11:18:56'),
(287, 46, 'email_verify', '3596db3cfbfc3ed081a50b10fc0beae80c2acf91', '$2y$10$j853I5vv/1fRxSLqsJg1QOAIUARRerV2iKLVRGWwBivhZbEOAbSEW', NULL, '2020-01-16 11:54:38', '2020-01-16 11:54:38'),
(288, 22, 'new_password', '773fa6bf2c5337ab674073a5ec160457307c294c', '$2y$10$VDFyk3mTMYQFh/i26PBLn.UhRuoFRhhO2uf3X9mBKlzZ4pcj6aMgq', NULL, '2020-01-16 18:00:33', '2020-01-16 18:00:33'),
(289, 23, 'email_verify', 'b276ca8b34ec665d279274ba2ecec12bf4b13b7e', '$2y$10$BmnBg7DOD1PI1GvZGgqRvOi1VuMyuRQ9JXjBS/YfcgyFn31zjS1e.', NULL, '2020-01-16 18:02:11', '2020-01-16 18:02:11'),
(290, 24, 'email_verify', '9387d59a549eb4d97cc78d0b59f2ce4ed179221e', '$2y$10$iWcTOV6sVJVC64mtVrw.OeHUCF2rqEGWsLlOILaLVHkbYHUkQePbO', NULL, '2020-01-16 19:17:48', '2020-01-16 19:17:48'),
(291, 25, 'new_password', '786d593b149364b374ac8a267009a9f77a3d0413', '$2y$10$Z9dY8MgixbxNmBfJvGLaeO.o7/dnJZx/y8COlD10UE9GaOEwej.K2', NULL, '2020-01-16 19:23:10', '2020-01-16 19:23:10'),
(292, 26, 'new_password', '9e566509183340538d4fa9100369b0a0099bc5ec', '$2y$10$NG5R9itcTBT840cNz4t7a.bpeudlz8G5C3WGDA3Ruhrqq8NYW9NOG', NULL, '2020-01-16 19:24:06', '2020-01-16 19:24:06'),
(293, 22, 'email_verify', 'c9c4af926cb79faefadbeaee1c2ddab7c87850e2', '$2y$10$pHEBtdQqUi/NvTNjE4PJzeXoMq6MfLZzjphoATZZSr3M.5nrrb1/K', NULL, '2020-01-23 12:07:54', '2020-01-23 12:07:54'),
(294, 23, 'email_verify', 'ea426cd49292b297084dabc4f066ba673c74b274', '$2y$10$PP.vPZ4LL5tTmRtl5MxGAuqJqvQ3.R1qHSZIwb2UM9of54xFJXY/K', NULL, '2020-03-03 18:06:26', '2020-03-03 18:06:26'),
(295, 24, 'email_verify', 'e1844a294eaf26bcd5d887b2e552a5bba47e362d', '$2y$10$bGxiXwEY3eDQZvFLciSzuOCLHtgzN63m7kIlt.4oEvEA1hf4/DmEa', NULL, '2020-03-03 18:33:31', '2020-03-03 18:33:31'),
(296, 24, 'email_verify', '170c646df410f3966245b8c7209d868a1e292c50', '$2y$10$3vKV1cs5yC4MuU7XSJBJ2O7hW1r2bzWtuAX2TrbdE4u7U4cqh.ocm', NULL, '2020-03-03 18:36:27', '2020-03-03 18:36:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `given_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_department` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilities_access` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_only` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `send_alerts` tinyint(1) NOT NULL DEFAULT '1',
  `account_verified` tinyint(1) NOT NULL DEFAULT '0',
  `complete` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `facility_id`, `user_type_id`, `given_name`, `surname`, `name`, `email`, `dob`, `phone`, `mobile`, `emergency_contact_name`, `emergency_contact_number`, `position`, `company_department`, `address`, `company_name`, `company_contact`, `company_address`, `supervisor`, `supervisor_email`, `supervisor_phone`, `username`, `account_type`, `password`, `provider`, `key`, `profile_url`, `hash`, `facilities_access`, `admin_only`, `active`, `disabled`, `send_alerts`, `account_verified`, `complete`, `created`, `modified`) VALUES
(1, 1, NULL, 1, 'Admin', 'Admin', 'Admin Admin', 'admin@gmail.com', NULL, '9956419655', '9956419655', 'Anthony Monteverde', '+639956419655', '', NULL, '', '', '', '', '', '', '', 'admin111', 'External', '$2y$10$u5wMSz9Q4pmVzo6hAoY8her2IV6azzConHN.Zk8v7sPmPZQgZkZFe', 'local', NULL, 'upload/users/1/65191b8944400d0b481ecb4b2a8835289a0c814e2fb8.jpg', '', NULL, 1, 1, 0, 1, 1, 1, '2019-09-17 17:36:15', '2019-12-06 12:57:30'),
(18, 6, 1, 6, 'John', 'Doe', 'John Doe', 'john@gmail.com', '2019-12-09', '123456789', '123456789', 'Anthony Monteverde', '12312', 'student', 'test', '#20 20th Street, West Bajac Bajac', 'dummy company', '123aaabb4', '#20 20th Street, West Bajac Bajac', 'anthony', 'anthony.monteverde35@gmail.com', '09956419655', 'john_doe', 'External', '$2y$10$uKSbSyVziMsYfgeTXkdjc.G8NRs65UoPl0d04Z1UPjk647po6Gkfq', 'local', NULL, 'upload/users/18/713758ab5ecf0d2cfba7febda8d8f4037127879e68d9.jpg', '', NULL, 0, 1, 0, 1, 1, 1, '2019-10-08 11:29:45', '2019-12-09 13:13:23'),
(20, 2, NULL, 1, 'Anthony', 'Monteverde', 'Test Trainer', 'anthony.monteverde35@gmail.com', '2019-12-09', '9956419655', '9956419655', 'Anthony Monteverde', '+639956419655', '', NULL, '', '', '', '', '', '', '', 'trainer', 'External', '$2y$10$yIPBQ/Cpy9UqOrC1cmo1JumfMp3ybcu5glLF35nWPdoT78qfW.cKC', 'local', NULL, 'upload/users/20/4935c850e50642207f9688dbeb831a376a55f54c7a74.jpg', '', NULL, 0, 1, 0, 1, 1, 1, '2019-09-17 17:36:15', '2019-12-09 19:21:19'),
(21, 6, 1, 6, 'Jane', 'Doe', 'Jane Doe', 'jane@gmail.com', '2019-01-01', '123456789', '123456789', 'Anthony Monteverde', '12312', 'student', 'test', '#20 20th Street, West Bajac Bajac', 'dummy company', '1', '#20 20th Street, West Bajac Bajac', 'anthony', 'anthony.monteverde35@gmail.com', '09956419655', 'jane_doe', 'External', '$2y$10$uKSbSyVziMsYfgeTXkdjc.G8NRs65UoPl0d04Z1UPjk647po6Gkfq', 'local', NULL, 'upload/users/21/79853f7b601c733067ebe1d70dbea796f3d43ac60d4f.jpg', '', NULL, 0, 1, 0, 1, 1, 1, '2019-10-08 11:29:45', '2019-12-09 13:16:21'),
(22, 6, NULL, 6, 'test', 'test', 'test test', 'test@gmail.com', '2020-01-24', '09956419655', '09956419655', 'Anthony Monteverde', '+639956419655', 'student', NULL, '#20 20th Street, West Bajac Bajac', 'dummy company', 'Anthony Monteverde', '#20 20th Street, West Bajac Bajac', 'test', 'anthony.monteverde35@gmail.com', '09956419655', 'test', 'External', '$2y$10$fEPCS41lLXHZY9Ieexyri.hBkGfLBEO0/4baTjWWam9.kG9tQqcCq', 'local', NULL, NULL, '', NULL, 0, 1, 0, 1, 1, 0, '2020-01-23 12:07:54', '2020-01-23 12:07:54'),
(23, 6, NULL, 6, 'test 2', 'test 2', 'test 2 test 2', 'testtesting2111@gmail.com', '2020-03-03', '092323232', '092323232', 'test 2', '092323232', 'test 2', NULL, '#20 20th Street, West Bajac Bajac', 'dummy company', 'test 2', '#20 20th Street, West Bajac Bajac', 'test 2', 'test2@gmail.com', '09956419655', 'test2', 'External', '$2y$10$PfsdTcj2ztOQKOl./ngoVuz/MP66FFUhi40.s8yczEVVuAPP49ZqK', 'local', NULL, NULL, '', NULL, 0, 1, 0, 1, 1, 1, '2020-03-03 18:06:25', '2020-03-03 18:06:25'),
(24, 6, NULL, 6, 'test3', 'test3', 'test3 test3', 'yohan123nazarene@gmail.com', '2020-03-03', '0909090121', '0909090121', 'test3', '0909090121', '0909090121', NULL, '#20 20th Street, West Bajac Bajac', 'test3', '0909090121', '#20 20th Street, West Bajac Bajac', 'test3', 'yohan123nazarene@gmail.com', '09153107151', 'test3', 'External', '$2y$10$sk3rFbQ3vp03bPJowNySQO/NU0El.86JRFCB4J3hFH85UAQJ1jiSu', 'local', NULL, NULL, '', NULL, 0, 1, 0, 1, 0, 0, '2020-03-03 18:33:31', '2020-03-03 18:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `user_test_id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(11) DEFAULT '0',
  `result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_test_id`, `user_id`, `question_id`, `answer_id`, `result`, `answer_content`) VALUES
(251, 38, '21', 33, 0, 'unchecked', 'adwa'),
(252, 38, '21', 34, 0, 'correct', 'b'),
(253, 38, '21', 35, 0, 'wrong', 'c'),
(254, 38, '21', 36, 0, 'correct', 'd'),
(255, 38, '21', 37, 0, 'wrong', 'e'),
(256, 38, '21', 38, 0, 'correct', 'g'),
(257, 38, '21', 39, 0, 'correct', 'h'),
(258, 38, '21', 40, 0, 'correct', 'i'),
(259, 38, '21', 41, 0, 'unchecked', 'jdwadaw'),
(260, 38, '21', 42, 0, 'correct', 'k'),
(261, 38, '21', 43, 0, 'correct', 'l'),
(262, 38, '21', 44, 0, 'correct', 'm'),
(263, 38, '21', 45, 0, 'correct', 'n'),
(264, 38, '21', 46, 0, 'correct', 'o'),
(265, 40, '18', 33, 0, 'correct', 'dwadawdwadwdwadwadawdawdwadawdwadaw'),
(266, 40, '18', 34, 0, 'correct', 'dwadwadawdwad'),
(272, 40, '18', 35, 0, 'correct', 'dawd'),
(273, 40, '18', 36, 0, 'correct', 'dwadwa'),
(274, 40, '18', 37, 0, 'correct', 'dwadwadwadaw'),
(275, 40, '18', 38, 0, 'wrong', 'dawdaw'),
(276, 40, '18', 39, 0, 'correct', 'dwadaw'),
(277, 40, '18', 40, 0, 'correct', 'dwadaw'),
(278, 40, '18', 43, 0, 'correct', 'dwadawdwadwda'),
(279, 40, '18', 44, 0, 'correct', 'dwadawdwa'),
(280, 40, '18', 45, 0, 'correct', 'dwadwdwa'),
(281, 40, '18', 46, 0, 'wrong', 'dwadawdwa'),
(286, 42, '21', 47, 35, 'correct', 'test'),
(287, 42, '21', 47, 34, 'correct', 'test'),
(288, 42, '21', 47, 33, 'correct', 'test'),
(289, 42, '21', 47, 32, 'correct', 'test'),
(290, 40, '18', 42, 0, 'correct', 'dwadawdaw'),
(291, 40, '18', 41, 0, 'correct', 'dwadawdaw'),
(342, 41, '18', 47, 35, 'correct', 'test'),
(343, 41, '18', 47, 34, 'correct', 'test'),
(344, 41, '18', 47, 33, 'correct', 'test'),
(345, 41, '18', 47, 32, 'correct', 'test'),
(346, 43, '18', 52, 47, 'correct', 'test'),
(347, 43, '18', 52, 46, 'correct', 'test'),
(348, 43, '18', 52, 45, 'correct', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `user_cost_centers`
--

CREATE TABLE `user_cost_centers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_dashboards`
--

CREATE TABLE `user_dashboards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_docs`
--

CREATE TABLE `user_docs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filesize` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_notes`
--

CREATE TABLE `user_notes` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `internal` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_notes`
--

INSERT INTO `user_notes` (`id`, `created_by`, `user_id`, `type`, `notes`, `internal`, `active`, `created`, `modified`) VALUES
(1, 18, 18, 'Note', 'hheez', 1, 0, '2019-11-14 15:59:14', '2019-11-14 15:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_statuses`
--

CREATE TABLE `user_statuses` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(6) NOT NULL,
  `status_date` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tests`
--

CREATE TABLE `user_tests` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tests`
--

INSERT INTO `user_tests` (`id`, `user_id`, `status`, `answer`, `course_test_id`) VALUES
(38, 21, 'expired', NULL, 14),
(39, 22, 'expired', NULL, 13),
(40, 18, 'passed', NULL, 14),
(41, 18, 'passed', NULL, 15),
(42, 21, 'passed', NULL, 15),
(43, 18, 'passed', NULL, 22);

-- --------------------------------------------------------

--
-- Table structure for table `user_test_credentials`
--

CREATE TABLE `user_test_credentials` (
  `id` int(11) NOT NULL,
  `user_test_id` int(11) NOT NULL,
  `login_id` varchar(255) NOT NULL,
  `login_pin` varchar(255) NOT NULL,
  `date_opened` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_test_credentials`
--

INSERT INTO `user_test_credentials` (`id`, `user_test_id`, `login_id`, `login_pin`, `date_opened`) VALUES
(36, 38, '1421', '327796', '2020-02-11 16:29:30'),
(37, 39, '1322', '064909', '2020-01-23 14:20:01'),
(38, 40, '1418', '160474', '2020-02-11 13:10:24'),
(39, 42, '1521', '986512', '2020-02-11 15:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `title`, `active`, `created`, `modified`) VALUES
(1, 'Admin', 1, NULL, NULL),
(2, 'Trainer', 1, '2019-09-18 11:28:57', '2019-09-18 11:28:57'),
(3, 'Read Only', 1, '2019-09-18 11:29:04', '2019-09-18 11:29:04'),
(4, 'Staff', 1, '2019-09-18 11:29:10', '2019-09-18 11:29:10'),
(5, 'User / Operator', 1, '2019-09-18 11:29:16', '2019-09-18 11:29:16'),
(6, 'Student', 1, '2019-09-18 11:29:20', '2019-09-18 11:29:20'),
(7, 'Limited', 1, '2019-09-18 11:29:25', '2019-09-18 11:29:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item` (`item`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `active` (`active`),
  ADD KEY `controller` (`controller`(191));

--
-- Indexes for table `allowed_domains`
--
ALTER TABLE `allowed_domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `domain` (`domain`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `certification_type_id` (`certification_type_id`),
  ADD KEY `expires` (`expires`),
  ADD KEY `valid` (`valid`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `certification_classes`
--
ALTER TABLE `certification_classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `certification_types`
--
ALTER TABLE `certification_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `active` (`active`),
  ADD KEY `certification_class_id` (`certification_class_id`);

--
-- Indexes for table `client_types`
--
ALTER TABLE `client_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `facility_id` (`facility_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `course_enrolled_attachments`
--
ALTER TABLE `course_enrolled_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`),
  ADD KEY `course_enrolled_test_id` (`course_enrolled_test_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_enrolled_modules`
--
ALTER TABLE `course_enrolled_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_enrolled_user_id` (`course_enrolled_user_id`),
  ADD KEY `course_module_id` (`course_module_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `course_enrolled_tests`
--
ALTER TABLE `course_enrolled_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_test_id` (`course_test_id`),
  ADD KEY `course_enrolled_user_id` (`course_enrolled_user_id`),
  ADD KEY `active` (`active`),
  ADD KEY `status` (`status`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_enrolled_users`
--
ALTER TABLE `course_enrolled_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `status` (`status`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `course_machine_types`
--
ALTER TABLE `course_machine_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `course_modules`
--
ALTER TABLE `course_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resources_id` (`resources_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `course_module_machine_types`
--
ALTER TABLE `course_module_machine_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_module_id` (`course_module_id`,`course_machine_type_id`);

--
-- Indexes for table `course_questions`
--
ALTER TABLE `course_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`),
  ADD KEY `position` (`position`),
  ADD KEY `course_test_id` (`course_test_id`);

--
-- Indexes for table `course_question_answers`
--
ALTER TABLE `course_question_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_question_id` (`course_question_id`,`course_question_choice_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `course_question_choices`
--
ALTER TABLE `course_question_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_question_id` (`course_question_id`,`value`);

--
-- Indexes for table `course_question_types`
--
ALTER TABLE `course_question_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`value`);

--
-- Indexes for table `course_tests`
--
ALTER TABLE `course_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_module_id` (`course_module_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `course_test_types`
--
ALTER TABLE `course_test_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`value`);

--
-- Indexes for table `dashboards`
--
ALTER TABLE `dashboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `dashboard_items`
--
ALTER TABLE `dashboard_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `dashboard_id` (`dashboard_id`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`dt`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `departments_leaders`
--
ALTER TABLE `departments_leaders`
  ADD PRIMARY KEY (`department_id`,`user_id`);

--
-- Indexes for table `departments_users`
--
ALTER TABLE `departments_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `next_service` (`next_service`),
  ADD KEY `equipment_type_id` (`equipment_type_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `active` (`active`),
  ADD KEY `next_alert` (`next_alert`),
  ADD KEY `title` (`title`(191));

--
-- Indexes for table `equipment_indexes`
--
ALTER TABLE `equipment_indexes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `title` (`title`),
  ADD KEY `value` (`value`(191));

--
-- Indexes for table `equipment_links`
--
ALTER TABLE `equipment_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `related_equipment` (`related_equipment`);

--
-- Indexes for table `equipment_logs`
--
ALTER TABLE `equipment_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `table` (`table`),
  ADD KEY `tableid` (`tableid`),
  ADD KEY `start` (`start`),
  ADD KEY `approved` (`approved`),
  ADD KEY `returned` (`returned`);

--
-- Indexes for table `equipment_types`
--
ALTER TABLE `equipment_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `evidence`
--
ALTER TABLE `evidence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `facilities_users`
--
ALTER TABLE `facilities_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `flags_users`
--
ALTER TABLE `flags_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flag_id` (`flag_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `form_templates`
--
ALTER TABLE `form_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `revision` (`revision`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action` (`action`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `lft` (`lft`),
  ADD KEY `rght` (`rght`),
  ADD KEY `active` (`active`),
  ADD KEY `controller` (`controller`(191));

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `title` (`title`(191));

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registers`
--
ALTER TABLE `registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `register_class_id` (`register_class_id`),
  ADD KEY `register_template_id` (`register_template_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `register_admins`
--
ALTER TABLE `register_admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `register_template_id` (`register_template_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `register_checklists`
--
ALTER TABLE `register_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `register_id` (`register_id`);

--
-- Indexes for table `register_classes`
--
ALTER TABLE `register_classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `register_template_id` (`register_template_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `register_forms`
--
ALTER TABLE `register_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `title` (`title`),
  ADD KEY `register_id` (`register_id`);

--
-- Indexes for table `register_templates`
--
ALTER TABLE `register_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `active` (`active`),
  ADD KEY `order` (`order`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `title` (`title`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `description` (`description`(191));

--
-- Indexes for table `resources_tags`
--
ALTER TABLE `resources_tags`
  ADD PRIMARY KEY (`resource_id`,`resource_category_id`);

--
-- Indexes for table `resource_categories`
--
ALTER TABLE `resource_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `scopes`
--
ALTER TABLE `scopes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `service_logs`
--
ALTER TABLE `service_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_id` (`equipment_id`),
  ADD KEY `serviced` (`serviced`),
  ADD KEY `next_service` (`next_service`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `token` (`token`(191)),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(191)),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `facility_id` (`facility_id`),
  ADD KEY `active` (`active`),
  ADD KEY `disabled` (`disabled`),
  ADD KEY `send_alerts` (`send_alerts`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `complete` (`complete`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_id` (`user_id`(191)),
  ADD KEY `user_test_id` (`user_test_id`,`answer_id`);

--
-- Indexes for table `user_cost_centers`
--
ALTER TABLE `user_cost_centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `active` (`active`);

--
-- Indexes for table `user_dashboards`
--
ALTER TABLE `user_dashboards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_docs`
--
ALTER TABLE `user_docs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_statuses`
--
ALTER TABLE `user_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`type`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `user_tests`
--
ALTER TABLE `user_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_test_id` (`course_test_id`);

--
-- Indexes for table `user_test_credentials`
--
ALTER TABLE `user_test_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`),
  ADD KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `allowed_domains`
--
ALTER TABLE `allowed_domains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certification_classes`
--
ALTER TABLE `certification_classes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certification_types`
--
ALTER TABLE `certification_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `client_types`
--
ALTER TABLE `client_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `course_enrolled_attachments`
--
ALTER TABLE `course_enrolled_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_enrolled_modules`
--
ALTER TABLE `course_enrolled_modules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `course_enrolled_tests`
--
ALTER TABLE `course_enrolled_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_enrolled_users`
--
ALTER TABLE `course_enrolled_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `course_machine_types`
--
ALTER TABLE `course_machine_types`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_modules`
--
ALTER TABLE `course_modules`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_module_machine_types`
--
ALTER TABLE `course_module_machine_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_questions`
--
ALTER TABLE `course_questions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `course_question_answers`
--
ALTER TABLE `course_question_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `course_question_choices`
--
ALTER TABLE `course_question_choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `course_question_types`
--
ALTER TABLE `course_question_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_tests`
--
ALTER TABLE `course_tests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `course_test_types`
--
ALTER TABLE `course_test_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dashboards`
--
ALTER TABLE `dashboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dashboard_items`
--
ALTER TABLE `dashboard_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments_users`
--
ALTER TABLE `departments_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipment_indexes`
--
ALTER TABLE `equipment_indexes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_links`
--
ALTER TABLE `equipment_links`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_logs`
--
ALTER TABLE `equipment_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_reservations`
--
ALTER TABLE `equipment_reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipment_types`
--
ALTER TABLE `equipment_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evidence`
--
ALTER TABLE `evidence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities_users`
--
ALTER TABLE `facilities_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flags_users`
--
ALTER TABLE `flags_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `form_templates`
--
ALTER TABLE `form_templates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `queued_jobs`
--
ALTER TABLE `queued_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registers`
--
ALTER TABLE `registers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register_admins`
--
ALTER TABLE `register_admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register_checklists`
--
ALTER TABLE `register_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `register_classes`
--
ALTER TABLE `register_classes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `register_forms`
--
ALTER TABLE `register_forms`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_templates`
--
ALTER TABLE `register_templates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resource_categories`
--
ALTER TABLE `resource_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `scopes`
--
ALTER TABLE `scopes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_logs`
--
ALTER TABLE `service_logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `user_cost_centers`
--
ALTER TABLE `user_cost_centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_dashboards`
--
ALTER TABLE `user_dashboards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_docs`
--
ALTER TABLE `user_docs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_notes`
--
ALTER TABLE `user_notes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_statuses`
--
ALTER TABLE `user_statuses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tests`
--
ALTER TABLE `user_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_test_credentials`
--
ALTER TABLE `user_test_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
