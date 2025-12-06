-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2025 at 02:55 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eco_xp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_id` (`admin_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `events_id` int NOT NULL,
  `time_taken` datetime NOT NULL,
  `event_attended` tinyint(1) NOT NULL,
  PRIMARY KEY (`attendance_id`),
  UNIQUE KEY `attendance_id` (`attendance_id`),
  KEY `participants_id` (`participants_id`),
  KEY `events_id` (`events_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
CREATE TABLE IF NOT EXISTS `badges` (
  `badges_id` int NOT NULL AUTO_INCREMENT,
  `badge_name` varchar(50) NOT NULL,
  `badge_description` text NOT NULL,
  `badges_pic` varchar(255) NOT NULL,
  PRIMARY KEY (`badges_id`),
  UNIQUE KEY `badges_id` (`badges_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

DROP TABLE IF EXISTS `challenges`;
CREATE TABLE IF NOT EXISTS `challenges` (
  `challenges_id` int NOT NULL AUTO_INCREMENT,
  `challenge_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `points_reward` int NOT NULL,
  `venue` varchar(255) NOT NULL,
  `challenge_type` varchar(50) NOT NULL,
  PRIMARY KEY (`challenges_id`),
  UNIQUE KEY `challenges_id` (`challenges_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `downtime`
--

DROP TABLE IF EXISTS `downtime`;
CREATE TABLE IF NOT EXISTS `downtime` (
  `downtime_id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `Push_notif` tinyint(1) NOT NULL,
  PRIMARY KEY (`downtime_id`),
  UNIQUE KEY `downtime_id` (`downtime_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eco_news`
--

DROP TABLE IF EXISTS `eco_news`;
CREATE TABLE IF NOT EXISTS `eco_news` (
  `eco_news_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `venue` text NOT NULL,
  `organised_by` varchar(255) NOT NULL,
  `events_id` int NOT NULL,
  `posted_by` int NOT NULL,
  PRIMARY KEY (`eco_news_id`),
  UNIQUE KEY `eco_news_id` (`eco_news_id`),
  KEY `events_id` (`events_id`),
  KEY `posted_by` (`posted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `events_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `points_rewarded` text NOT NULL,
  `venue` text NOT NULL,
  `organised_by` varchar(255) NOT NULL,
  `organizer_email` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `max_participants` int NOT NULL,
  PRIMARY KEY (`events_id`),
  UNIQUE KEY `events_id` (`events_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_resources`
--

DROP TABLE IF EXISTS `events_resources`;
CREATE TABLE IF NOT EXISTS `events_resources` (
  `event_resources_id` int NOT NULL AUTO_INCREMENT,
  `events_id` int NOT NULL,
  `resources_id` int NOT NULL,
  `date_assigned` date NOT NULL,
  `venue` text NOT NULL,
  `quantity_assigned` int NOT NULL,
  PRIMARY KEY (`event_resources_id`),
  UNIQUE KEY `event_resources_id` (`event_resources_id`),
  KEY `events_id` (`events_id`),
  KEY `resources_id` (`resources_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_management`
--

DROP TABLE IF EXISTS `event_management`;
CREATE TABLE IF NOT EXISTS `event_management` (
  `event_management_id` int NOT NULL AUTO_INCREMENT,
  `event_manager_id` int NOT NULL,
  `events_id` int NOT NULL,
  `assigned_date` date NOT NULL,
  `event_roles_id` int NOT NULL,
  PRIMARY KEY (`event_management_id`),
  UNIQUE KEY `event_management_id` (`event_management_id`),
  KEY `event_manager_id` (`event_manager_id`),
  KEY `events_id` (`events_id`),
  KEY `event_roles_id` (`event_roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_manager`
--

DROP TABLE IF EXISTS `event_manager`;
CREATE TABLE IF NOT EXISTS `event_manager` (
  `event_manager_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`event_manager_id`),
  UNIQUE KEY `event_manager_id` (`event_manager_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_roles`
--

DROP TABLE IF EXISTS `event_roles`;
CREATE TABLE IF NOT EXISTS `event_roles` (
  `event_roles_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`event_roles_id`),
  UNIQUE KEY `event_roles_id` (`event_roles_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `participants_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `TP_no` varchar(7) NOT NULL,
  PRIMARY KEY (`participants_id`),
  UNIQUE KEY `participant_id` (`participants_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_badges`
--

DROP TABLE IF EXISTS `participants_badges`;
CREATE TABLE IF NOT EXISTS `participants_badges` (
  `participant_badges_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `badges_id` int NOT NULL,
  `date_obtained` date NOT NULL,
  PRIMARY KEY (`participant_badges_id`),
  UNIQUE KEY `participant_badges_id` (`participant_badges_id`),
  KEY `participants_id` (`participants_id`),
  KEY `badges_id` (`badges_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants_challenges`
--

DROP TABLE IF EXISTS `participants_challenges`;
CREATE TABLE IF NOT EXISTS `participants_challenges` (
  `participants_challenges_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `challenges_id` int NOT NULL,
  `date_accomplished` date NOT NULL,
  `verified_date` date NOT NULL,
  `challenges_status` varchar(50) NOT NULL,
  `impact_type` varchar(50) NOT NULL,
  `impact_amount` int NOT NULL,
  `staff_id` int NOT NULL,
  PRIMARY KEY (`participants_challenges_id`),
  UNIQUE KEY `participants_challenges_id` (`participants_challenges_id`),
  KEY `participants_id` (`participants_id`),
  KEY `challenges_id` (`challenges_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `resources_id` int NOT NULL AUTO_INCREMENT,
  `resource_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `quantity_available` int NOT NULL,
  UNIQUE KEY `resources_id` (`resources_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

DROP TABLE IF EXISTS `rewards`;
CREATE TABLE IF NOT EXISTS `rewards` (
  `rewards_id` int NOT NULL AUTO_INCREMENT,
  `reward_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `points_required` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`rewards_id`),
  UNIQUE KEY `rewards_id` (`rewards_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reward_redemption`
--

DROP TABLE IF EXISTS `reward_redemption`;
CREATE TABLE IF NOT EXISTS `reward_redemption` (
  `reward_redemption_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `rewards_id` int NOT NULL,
  `date_redeemed` int NOT NULL,
  `qr_used` tinyint(1) NOT NULL,
  `qr_token` varchar(255) NOT NULL,
  PRIMARY KEY (`reward_redemption_id`),
  UNIQUE KEY `reward_redemption_id` (`reward_redemption_id`),
  KEY `participants_id` (`participants_id`),
  KEY `rewards_id` (`rewards_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`staff_id`),
  UNIQUE KEY `staff_id` (`staff_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

DROP TABLE IF EXISTS `system_log`;
CREATE TABLE IF NOT EXISTS `system_log` (
  `system_log_id` int NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `action_performed` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`system_log_id`),
  UNIQUE KEY `system_log_id` (`system_log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hash_password` varchar(255) NOT NULL,
  `profile_picture_path` varchar(255) NOT NULL,
  `account_status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`participants_id`) REFERENCES `participants` (`participants_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `downtime`
--
ALTER TABLE `downtime`
  ADD CONSTRAINT `downtime_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `eco_news`
--
ALTER TABLE `eco_news`
  ADD CONSTRAINT `eco_news_ibfk_1` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `eco_news_ibfk_2` FOREIGN KEY (`posted_by`) REFERENCES `staff` (`staff_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `eco_news_ibfk_3` FOREIGN KEY (`posted_by`) REFERENCES `event_manager` (`event_manager_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `events_resources`
--
ALTER TABLE `events_resources`
  ADD CONSTRAINT `events_resources_ibfk_1` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `events_resources_ibfk_2` FOREIGN KEY (`resources_id`) REFERENCES `resources` (`resources_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `event_management`
--
ALTER TABLE `event_management`
  ADD CONSTRAINT `event_management_ibfk_1` FOREIGN KEY (`event_manager_id`) REFERENCES `event_manager` (`event_manager_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `event_management_ibfk_2` FOREIGN KEY (`events_id`) REFERENCES `events` (`events_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `event_management_ibfk_3` FOREIGN KEY (`event_roles_id`) REFERENCES `event_roles` (`event_roles_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `event_manager`
--
ALTER TABLE `event_manager`
  ADD CONSTRAINT `event_manager_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `participants_badges`
--
ALTER TABLE `participants_badges`
  ADD CONSTRAINT `participants_badges_ibfk_1` FOREIGN KEY (`participants_id`) REFERENCES `participants` (`participants_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `participants_badges_ibfk_2` FOREIGN KEY (`badges_id`) REFERENCES `badges` (`badges_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `participants_challenges`
--
ALTER TABLE `participants_challenges`
  ADD CONSTRAINT `participants_challenges_ibfk_1` FOREIGN KEY (`participants_id`) REFERENCES `participants` (`participants_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `participants_challenges_ibfk_2` FOREIGN KEY (`challenges_id`) REFERENCES `challenges` (`challenges_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `participants_challenges_ibfk_3` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reward_redemption`
--
ALTER TABLE `reward_redemption`
  ADD CONSTRAINT `reward_redemption_ibfk_1` FOREIGN KEY (`participants_id`) REFERENCES `participants` (`participants_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reward_redemption_ibfk_2` FOREIGN KEY (`rewards_id`) REFERENCES `rewards` (`rewards_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `system_log`
--
ALTER TABLE `system_log`
  ADD CONSTRAINT `system_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
