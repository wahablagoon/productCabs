-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 14, 2017 at 09:49 AM
-- Server version: 5.6.35-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `i3693211_wp1`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `api_name` varchar(500) NOT NULL,
  `code` varchar(500) NOT NULL,
  `value` varchar(500) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `car_category`
--

CREATE TABLE IF NOT EXISTS `car_category` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `price_km` varchar(100) NOT NULL,
  `price_minute` varchar(100) NOT NULL,
  `max_size` varchar(100) NOT NULL,
  `price_fare` varchar(100) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `marker` varchar(500) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `car_category`
--

INSERT INTO `car_category` (`id`, `category_name`, `price_km`, `price_minute`, `max_size`, `price_fare`, `logo`, `marker`, `created`, `created_by`, `modified`, `modified_by`) VALUES
(1, 'SEDAN', '10', '5', '3', '2', 'fa', 'kfa', '', '', '', ''),
(2, 'SUV', '10', '01', '10', '2', 'dasdas', 'das', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE IF NOT EXISTS `email_settings` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `mail_mode` varchar(50) NOT NULL COMMENT '(HTML / TEXT)',
  `mail_type` varchar(100) NOT NULL COMMENT '(PHP / Domail SMTP /Google SMTP)',
  `rider_email_verification` int(4) NOT NULL,
  `driver_email_verification` int(4) NOT NULL,
  `smtp_port` varchar(100) NOT NULL,
  `smtp_username` varchar(100) NOT NULL,
  `smtp_password` varchar(100) NOT NULL,
  `incoming_mail_server` varchar(300) NOT NULL,
  `outgoing_mail_server` varchar(300) NOT NULL,
  `mail_username` varchar(100) NOT NULL,
  `mail_password` varchar(100) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `join_us_on`
--

CREATE TABLE IF NOT EXISTS `join_us_on` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `link` varchar(500) NOT NULL,
  `status` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `role` int(4) NOT NULL COMMENT '(1 => user / 2=>provider / 3=>admin)',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) DEFAULT NULL,
  `profile` varchar(500) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `wallet` varchar(100) NOT NULL,
  `phone_verify` int(4) DEFAULT NULL,
  `email_verify` int(4) DEFAULT NULL,
  `created` varchar(30) DEFAULT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `modified` varchar(30) DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `city` varchar(300) NOT NULL,
  `countrycode` varchar(50) NOT NULL,
  `facebook_id` varchar(500) DEFAULT NULL,
  `google_id` varchar(500) DEFAULT NULL,
  `license` varchar(500) DEFAULT NULL,
  `insurance` varchar(500) DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `online_status` int(11) DEFAULT NULL,
  `proof_status` varchar(500) DEFAULT NULL,
  `lat` varchar(500) DEFAULT NULL,
  `long` varchar(500) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `verifycode` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `role`, `firstname`, `lastname`, `email`, `password`, `profile`, `phone`, `wallet`, `phone_verify`, `email_verify`, `created`, `created_by`, `modified`, `modified_by`, `city`, `countrycode`, `facebook_id`, `google_id`, `license`, `insurance`, `category`, `status`, `online_status`, `proof_status`, `lat`, `long`, `location`, `verifycode`) VALUES
(1, 1, 'praveen', 'ak', 'ak@blt.com', 'f447df8362a4d0d9f5142f563595684b', NULL, '9344558795', '0', 1, NULL, '1499708158', 'user', NULL, NULL, 'madurai', '91', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '8364'),
(2, 1, 'praveen1', 'ak2', 'ak1@blt.com', 'bigbang', 'profile.png', '7200400899', '0', NULL, NULL, '1499708158', 'user', '1499785536', 'user', 'Madurai', '91', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '913434', '7065', NULL, ''),
(3, 2, 'praveen1', 'ak2', 'ak19@blt.com', 'bigbang', 'profile.png', '7207400899', '0', NULL, NULL, '1499754644', 'user', '1499785964', 'user', 'Madurai', '91', NULL, NULL, 'license.png', 'insurance.png', 'SEDAN', 1, 1, 'Pending', NULL, NULL, NULL, ''),
(4, 1, 'Thiru', 'STR', 'msg2thirumalai@gmail.com', 'thirumalai', NULL, '9677772323', '0', NULL, NULL, '1499922269', 'user', NULL, NULL, 'madurai', '91', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE IF NOT EXISTS `payment_history` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `member_id` int(4) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `payment_id` varchar(500) NOT NULL,
  `trip_id` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

CREATE TABLE IF NOT EXISTS `payment_settings` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `payment_id` int(4) NOT NULL,
  `payment_code` varchar(100) NOT NULL,
  `payment_code_value` varchar(500) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paymode`
--

CREATE TABLE IF NOT EXISTS `paymode` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(100) NOT NULL,
  `status` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `peak_hour_pricing`
--

CREATE TABLE IF NOT EXISTS `peak_hour_pricing` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(30) NOT NULL,
  `end_time` varchar(30) NOT NULL,
  `days` varchar(50) NOT NULL,
  `percentage` varchar(30) NOT NULL,
  `status` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `phone_settings`
--

CREATE TABLE IF NOT EXISTS `phone_settings` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nexmo_key` varchar(100) NOT NULL,
  `nexmo_secret` varchar(100) NOT NULL,
  `nexmo_number` varchar(100) NOT NULL,
  `rider_phone_verification` int(4) NOT NULL,
  `driver_phone_verification` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promocode`
--

CREATE TABLE IF NOT EXISTS `promocode` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `expire_in` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `status` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `provider_documentation`
--

CREATE TABLE IF NOT EXISTS `provider_documentation` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `provider_id` int(4) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `service_number` varchar(100) NOT NULL,
  `service_model` varchar(100) NOT NULL,
  `provider_status` int(4) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pickup` varchar(500) DEFAULT NULL,
  `destination` varchar(500) DEFAULT NULL,
  `payment_mode` varchar(500) DEFAULT NULL,
  `rider_id` int(11) DEFAULT NULL,
  `category` varchar(500) DEFAULT NULL,
  `pickup_address` varchar(500) DEFAULT NULL,
  `drop_address` varchar(500) DEFAULT NULL,
  `request_type` varchar(500) DEFAULT NULL,
  `trip_id` varchar(110) DEFAULT '0',
  `ride_type` varchar(500) DEFAULT NULL,
  `request_status` varchar(500) DEFAULT NULL,
  `driver_id` varchar(110) DEFAULT NULL,
  `eta` varchar(500) DEFAULT NULL,
  `driver_location` varchar(500) DEFAULT NULL,
  `driver_category` varchar(500) DEFAULT NULL,
  `created` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `c_id` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `pickup`, `destination`, `payment_mode`, `rider_id`, `category`, `pickup_address`, `drop_address`, `request_type`, `trip_id`, `ride_type`, `request_status`, `driver_id`, `eta`, `driver_location`, `driver_category`, `created`, `status`, `c_id`) VALUES
(1, '{"lat":"32.5","long":"74.3"}', '{"lat":"23.6","long":"23.6"}', 'stripe', 1, 'SUV', 'mdurai', 'chennai', 'normal', '', 'normal', '1', '3', '', '{"driver_location":{"lat":null,"long":null}}', '', '1500046690', 'Success', '');

-- --------------------------------------------------------

--
-- Table structure for table `site_language`
--

CREATE TABLE IF NOT EXISTS `site_language` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `language` varchar(100) NOT NULL,
  `status` int(4) NOT NULL,
  `active` int(4) NOT NULL COMMENT '1 for active and 0 for inactive',
  `created` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified` varchar(100) NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(500) NOT NULL,
  `site_slogen` varchar(500) NOT NULL,
  `site_logo` varchar(500) NOT NULL,
  `site_icon` varchar(500) NOT NULL,
  `site_status` int(4) NOT NULL,
  `site_copyright` varchar(500) NOT NULL,
  `site_playstore_link` varchar(300) NOT NULL,
  `site_appstore_link` varchar(300) NOT NULL,
  `site_currency` varchar(20) NOT NULL,
  `site_theme_color` varchar(20) NOT NULL,
  `site_google_analytics_code` varchar(1000) NOT NULL,
  `site_company_address` varchar(200) NOT NULL,
  `site_company_phone` varchar(30) NOT NULL,
  `created` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE IF NOT EXISTS `trip` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `trip_type` int(4) NOT NULL COMMENT 'now or ride later',
  `rider_id` int(4) NOT NULL,
  `driver_id` int(4) NOT NULL,
  `date_time` varchar(30) NOT NULL,
  `pickup` varchar(500) NOT NULL,
  `pickup_lat` varchar(500) NOT NULL,
  `pickup_long` varchar(500) NOT NULL,
  `destination` varchar(500) NOT NULL,
  `destination_lat` varchar(500) NOT NULL,
  `destination_long` varchar(500) NOT NULL,
  `trip_status` varchar(100) NOT NULL,
  `distance` varchar(100) NOT NULL,
  `basic_amount` varchar(100) NOT NULL,
  `tax_amount` varchar(100) NOT NULL,
  `service_amount` varchar(100) NOT NULL,
  `tollfee_amount` varchar(100) NOT NULL,
  `waiting_amount` varchar(100) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `paymode` varchar(100) NOT NULL,
  `created` varchar(30) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `modified` varchar(30) NOT NULL,
  `modified_by` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rider_id` (`rider_id`),
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `trip_ibfk_1` FOREIGN KEY (`rider_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `trip_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `member` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
