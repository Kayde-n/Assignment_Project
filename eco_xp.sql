-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 03, 2026 at 01:27 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 18);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `participants_id`, `events_id`, `time_taken`, `event_attended`) VALUES
(1, 1, 2, '2025-12-23 12:55:47', 1),
(2, 2, 2, '2025-12-23 13:57:08', 0),
(3, 3, 2, '2025-12-26 09:58:32', 1),
(4, 4, 2, '2025-12-26 10:58:53', 1),
(5, 5, 3, '2025-12-28 14:58:53', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`badges_id`, `badge_name`, `badge_description`, `badges_pic`) VALUES
(1, 'Recycling Hero', 'Badge is obtained by recycling more than 100 items', '/badges/Recycling_Hero.png'),
(2, 'Eco Commuter', 'Badge is obtained by using eco-friendly transport (walking, cycling, or carpooling) for 10 trips', '/badges/Eco_Commuter.png'),
(3, 'Energy Saver', 'Badge is obtained by reducing electricity consumption on campus for a month', '/badges/Energy_Saver.png'),
(4, 'Water Warrior', 'Badge is obtained by participating in water conservation activities and challenges', '/badges/Water_Warrior.png'),
(5, 'Community Helper', 'Badge is obtained by volunteering for at least 5 campus community events', '/badges/Community_Helper.png');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`challenges_id`, `challenge_name`, `description`, `points_reward`, `venue`, `challenge_type`) VALUES
(1, 'Carpool 1 time', 'Carpool with at least 2 people to complete the challenge (description includes T&C)', 150, 'No. 11, Jalan Teknologi 5, Taman Teknologi Malaysia, Bukit Jalil 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', 'Daily'),
(2, 'Bring Your Own Bottle', 'Use a reusable bottle instead of disposable plastic bottles for the day (description includes T&C)', 100, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Daily'),
(3, 'Public Transport Commute', 'Commute to campus using public transport at least once during the week (description includes T&C)', 300, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Weekly'),
(4, 'No-Print Week', 'Avoid printing any documents for one full week to reduce paper usage (description includes T&C)', 500, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Weekly'),
(5, 'Green Lifestyle Month', 'Participate in eco-friendly activities throughout the month to promote sustainability (description includes T&C)', 1200, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Seasonal');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `downtime`
--

INSERT INTO `downtime` (`downtime_id`, `admin_id`, `start_time`, `end_time`, `Push_notif`) VALUES
(1, 1, '2025-12-21 07:01:39', '2025-12-22 15:01:40', 1),
(2, 1, '2025-12-24 15:02:47', '2025-12-26 15:02:47', 0),
(3, 3, '2025-12-03 15:02:47', '2025-12-05 15:02:47', 1),
(4, 2, '2026-01-01 15:03:14', '2026-01-03 15:03:14', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eco_news`
--

INSERT INTO `eco_news` (`eco_news_id`, `title`, `description`, `image_path`, `venue`, `organised_by`, `events_id`, `posted_by`) VALUES
(1, 'Beach Clean-up', 'Beach clean-up is an annual event where students clean up beaches along the coast of Klang', 'beach_cleanup.jpg', 'Kawasan Perindustrian Selat Klang Utara, 42000 Port Klang, Selangor', 'Petronas', 1, 3),
(17, 'Tree Planting Day', 'Students and staff join to plant trees around the campus to promote greenery and reduce carbon footprint', 'tree_planting.jpg', 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'APU Green Club', 1, 2),
(20, 'Campus Recycling Drive', 'A week-long initiative to encourage students to bring recyclable materials to designated collection points', 'recycling_event.jpg', 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'APU Sustainability Committee', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `event_name`, `description`, `points_rewarded`, `venue`, `organised_by`, `organizer_email`, `start_time`, `end_time`, `max_participants`) VALUES
(1, 'APU gotong-royong', 'A weekly event where students come together and make an effort to keep school premises clean', '500', 'No. 11, Jalan Teknologi 5, Taman Teknologi Malaysia, Bukit Jalil 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur.”', 'Petronas', 'contactmplus@petronas.com', '2025-12-23 10:00:00', '2025-12-23 16:30:00', 300),
(2, 'APU Blood Donation Drive', 'A campus-wide blood donation campaign in collaboration with hospitals to encourage students to donate blood', '800', 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'National Blood Centre', 'info@pdn.gov.my', '2025-12-26 09:00:00', '2025-12-26 15:00:00', 200),
(3, 'APU Tech Awareness Workshop', 'An educational workshop aimed at increasing awareness of emerging technologies and digital safety among students', '300', 'APU Lecture Hall 5, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'APU IT Society', 'apuitsociety@apu.edu.my', '2025-12-28 14:00:00', '2025-12-28 17:30:00', 150);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events_resources`
--

INSERT INTO `events_resources` (`event_resources_id`, `events_id`, `resources_id`, `date_assigned`, `venue`, `quantity_assigned`) VALUES
(1, 2, 3, '2025-12-26', 'APU Campus, Technology Park Malaysia, Bukit Jalil', 120),
(2, 2, 1, '2025-12-23', 'No. 11, Jalan Teknologi 5, Taman Teknologi Malaysia, Bukit Jalil 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur.', 35),
(3, 3, 2, '2025-12-28', 'APU Lecture Hall 5, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_management`
--

INSERT INTO `event_management` (`event_management_id`, `event_manager_id`, `events_id`, `assigned_date`, `event_roles_id`) VALUES
(1, 1, 1, '2025-12-22', 2),
(2, 2, 2, '2025-12-24', 4),
(3, 3, 3, '2025-12-26', 2),
(4, 4, 1, '2025-12-21', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_manager`
--

INSERT INTO `event_manager` (`event_manager_id`, `user_id`) VALUES
(1, 12),
(2, 13),
(3, 14),
(4, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_roles`
--

INSERT INTO `event_roles` (`event_roles_id`, `role_name`, `description`) VALUES
(1, 'Financial Manager', 'Oversees the finance aspect of the event'),
(2, 'Event Coordinator', 'Responsible for overall planning, coordination, and execution of the event'),
(3, 'Logistics Manager', 'Manages venue setup, equipment, and logistical arrangements for the event'),
(4, 'Volunteer Coordinator', 'Recruits, assigns, and manages volunteers during the event'),
(5, 'Marketing & Publicity Lead', 'Handles promotion, marketing materials, and public communications for the event'),
(6, 'Safety Officer', 'Ensures safety procedures are followed and manages risk during the event'),
(7, 'Registration Officer', 'Manages participant registration, attendance, and check-in processes');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participants_id`, `user_id`, `TP_no`) VALUES
(1, 7, 'TP00001'),
(2, 8, 'TP00002'),
(3, 9, 'TP00003'),
(4, 10, 'TP00004'),
(5, 11, 'TP00005');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants_badges`
--

INSERT INTO `participants_badges` (`participant_badges_id`, `participants_id`, `badges_id`, `date_obtained`) VALUES
(1, 1, 1, '2025-12-22'),
(2, 2, 2, '2025-12-24'),
(3, 3, 3, '2025-12-25'),
(4, 4, 5, '2025-12-17'),
(5, 5, 4, '2025-12-05');

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
  `verified_date` date DEFAULT NULL,
  `challenges_status` varchar(50) NOT NULL,
  `impact_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `impact_amount` int DEFAULT NULL,
  `staff_id` int NOT NULL,
  PRIMARY KEY (`participants_challenges_id`),
  UNIQUE KEY `participants_challenges_id` (`participants_challenges_id`),
  KEY `participants_id` (`participants_id`),
  KEY `challenges_id` (`challenges_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants_challenges`
--

INSERT INTO `participants_challenges` (`participants_challenges_id`, `participants_id`, `challenges_id`, `date_accomplished`, `verified_date`, `challenges_status`, `impact_type`, `image_path`, `impact_amount`, `staff_id`) VALUES
(1, 5, 2, '2025-12-05', '2025-12-06', 'approved', 'reduced water pollution', NULL, 5, 1),
(2, 2, 1, '2025-12-17', '2025-12-18', 'pending', 'reduced carbon emmision', NULL, 2, 3),
(3, 3, 4, '2025-12-17', '2025-12-19', 'rejected', 'recycling trash', NULL, 3, 6),
(4, 5, 3, '2025-12-24', '2025-12-31', 'approved', 'reduced carbon emmision', NULL, 6, 4),
(5, 4, 5, '2025-12-25', '2025-12-29', 'approved', 'reduced air pollution', NULL, 12, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resources_id`, `resource_name`, `description`, `quantity_available`) VALUES
(1, 'Sets of 10 Chairs', 'The resource consists of a set of 10 chairs, when allocated 10 chairs will be distributed, the set amount is fixed', 10),
(2, 'Projector', 'A portable projector used for presentations and workshops, allocated per unit', 5),
(3, 'Foldable Tables', 'Foldable tables suitable for events and exhibitions, allocated per table', 20),
(4, 'PA System', 'A public address system including speakers and microphone, allocated as one complete set', 3),
(5, 'Event Canopy Tent', 'A large canopy tent used for outdoor events, allocated per tent', 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`rewards_id`, `reward_name`, `description`, `points_required`, `quantity`) VALUES
(1, 'Free Parking', 'Reward includes free parking for 3 days (description includes T&C)', 1500, 15),
(2, 'Campus Cafeteria Voucher', 'RM10 voucher redeemable at the campus cafeteria (terms and conditions apply)', 800, 50),
(3, 'APU Merchandise T-Shirt', 'Official APU merchandise T-shirt available in selected sizes (terms and conditions apply)', 1200, 30),
(4, 'Printing Credits', 'Includes 100 pages of black-and-white printing credits usable within the campus (terms and conditions apply)', 500, 100),
(5, 'Library Late Fee Waiver', 'Waiver of library late fees up to RM20 (terms and conditions apply)', 700, 40);

-- --------------------------------------------------------

--
-- Table structure for table `reward_redemption`
--

DROP TABLE IF EXISTS `reward_redemption`;
CREATE TABLE IF NOT EXISTS `reward_redemption` (
  `reward_redemption_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `rewards_id` int NOT NULL,
  `date_redeemed` date NOT NULL,
  `qr_used` tinyint(1) NOT NULL,
  `qr_token` varchar(255) NOT NULL,
  PRIMARY KEY (`reward_redemption_id`),
  UNIQUE KEY `reward_redemption_id` (`reward_redemption_id`),
  KEY `participants_id` (`participants_id`),
  KEY `rewards_id` (`rewards_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reward_redemption`
--

INSERT INTO `reward_redemption` (`reward_redemption_id`, `participants_id`, `rewards_id`, `date_redeemed`, `qr_used`, `qr_token`) VALUES
(1, 1, 1, '2025-12-03', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(2, 2, 2, '2025-12-10', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(3, 3, 3, '2025-12-24', 0, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(4, 4, 4, '2025-12-25', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(5, 5, 5, '2025-12-31', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`) VALUES
(1, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 16),
(6, 17);

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`system_log_id`, `timestamp`, `action_performed`, `description`, `user_id`) VALUES
(1, '2025-12-21 14:40:24', 'User used feature challenge submission', 'User has uploaded 1 photo for challenge submission', 2),
(2, '2025-12-21 14:45:10', 'User logged in', 'User successfully logged into the system', 1),
(3, '2025-12-21 14:48:32', 'User joined event', 'User registered for the APU gotong-royong event', 3),
(4, '2025-12-21 14:52:05', 'User redeemed reward', 'User redeemed reward: Campus Cafeteria Voucher', 4),
(5, '2025-12-21 14:55:47', 'User completed challenge', 'User completed the Daily Carpool challenge', 5),
(6, '2025-12-21 15:01:18', 'User updated profile', 'User updated profile picture and personal details', 6),
(7, '2025-12-21 15:05:10', 'User logged in', 'User successfully logged into the system', 2),
(8, '2025-12-21 15:07:34', 'User viewed event', 'User viewed event details for APU gotong-royong', 3),
(9, '2025-12-21 15:09:02', 'User joined event', 'User registered for APU Blood Donation Drive', 1),
(10, '2025-12-21 15:11:28', 'User submitted challenge', 'User submitted evidence for Daily Carpool challenge', 4),
(11, '2025-12-21 15:13:55', 'User logged out', 'User logged out of the system', 2),
(12, '2025-12-21 15:16:10', 'User logged in', 'User successfully logged into the system', 5),
(13, '2025-12-21 15:18:42', 'User updated profile', 'User updated contact information', 6),
(14, '2025-12-21 15:21:06', 'User redeemed reward', 'User redeemed reward: Printing Credits', 3),
(15, '2025-12-21 15:23:39', 'User viewed eco news', 'User viewed news article: Beach Clean-up', 1),
(16, '2025-12-21 15:26:11', 'User completed challenge', 'User completed Bring Your Own Bottle challenge', 4),
(17, '2025-12-21 15:28:45', 'User logged out', 'User logged out of the system', 5),
(18, '2025-12-21 15:31:02', 'User logged in', 'User successfully logged into the system', 6),
(19, '2025-12-21 15:33:27', 'User joined event', 'User registered for APU Tech Awareness Workshop', 2),
(20, '2025-12-21 15:36:10', 'User submitted challenge', 'User uploaded 2 photos for Weekly Public Transport challenge', 1),
(21, '2025-12-21 15:38:58', 'User viewed reward', 'User viewed reward details: Free Parking', 3),
(22, '2025-12-21 15:41:20', 'User redeemed reward', 'User redeemed reward: Library Late Fee Waiver', 6),
(23, '2025-12-21 15:44:03', 'User viewed event', 'User viewed event details for Tree Planting Day', 4),
(24, '2025-12-21 15:46:35', 'User updated settings', 'User updated notification preferences', 2),
(25, '2025-12-21 15:49:12', 'User completed challenge', 'User completed Weekly No-Print challenge', 5),
(26, '2025-12-21 15:52:40', 'User logged out', 'User logged out of the system', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_full_name`, `email`, `hash_password`, `profile_picture_path`, `account_status`) VALUES
(1, 'Ivan Chia', 'ivan@yahoo.com', '$2b$10$', 'images/profile.png', 'Active'),
(2, 'Vince Heong', 'vince@gmail.com', '234gft', 'images/profile.png', 'Active'),
(3, 'Zong ze', 'Zong@gmail.com', '3dg($%g', 'images/profile.png', 'Active'),
(4, 'Daniel Wong', 'daniel.wong@gmail.com', 'a9F#2kL!', 'images/profile.png', 'Active'),
(5, 'Aisyah Rahman', 'aisyah.rahman@gmail.com', 'Qw8$Lm2@', 'images/profile.png', 'Deactivated'),
(6, 'Jason Lim', 'jason.lim@gmail.com', 'Zx7!P0$r', 'images/profile.png', 'Active'),
(7, 'Nur Syafiqah Ali', 'syafiqah.ali@gmail.com', 'M2@#x9Kq', 'images/profile.png', 'Deactivated'),
(8, 'Amir Hakim', 'amir.hakim@gmail.com', 'P@9xLm21', 'images/profile.png', 'Active'),
(9, 'Siti Nur Aina', 'siti.aina@gmail.com', 'Qw!7Kp$2', 'images/profile.png', 'Deactivated'),
(10, 'Bryan Tan', 'bryan.tan@gmail.com', 'L9#xP2@A', 'images/profile.png', 'Active'),
(11, 'Farah Nabila', 'farah.nabila@gmail.com', 'Z@8P!k2L', 'images/profile.png', 'Active'),
(12, 'Kelvin Chong', 'kelvin.chong@gmail.com', 'X2$P@9Lm', 'images/profile.png', 'Deactivated'),
(13, 'Aiman Syazwan', 'aiman.syazwan@gmail.com', 'M!9L@x2P', 'images/profile.png', 'Active'),
(14, 'Adam Firdaus', 'adam.firdaus@gmail.com', 'A9!xP@2L', 'images/profile.png', 'Active'),
(15, 'Sofia Amirah', 'sofia.amirah@gmail.com', 'Q2@Lx!9P', 'images/profile.png', 'Deactivated'),
(16, 'Ryan Tan', 'ryan.tan@gmail.com', 'Zx9@P!2L', 'images/profile.png', 'Active'),
(17, 'Nur Izzati', 'nur.izzati@gmail.com', 'M@9x!P2L', 'images/profile.png', 'Active'),
(18, 'Daniel Chong', 'daniel.chong@gmail.com', 'P!9xL@2M', 'images/profile.png', 'Deactivated');

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
