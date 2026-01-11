-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2026 at 05:18 PM
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
-- Database: `ecoxp database`
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_id`) VALUES
(1, 1),
(2, 2),
(3, 18),
(4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int NOT NULL AUTO_INCREMENT,
  `participants_id` int NOT NULL,
  `events_id` int NOT NULL,
  `time_taken` datetime DEFAULT NULL,
  `event_attended` tinyint(1) NOT NULL,
  PRIMARY KEY (`attendance_id`),
  UNIQUE KEY `attendance_id` (`attendance_id`),
  KEY `participants_id` (`participants_id`),
  KEY `events_id` (`events_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `participants_id`, `events_id`, `time_taken`, `event_attended`) VALUES
(1, 1, 2, '2025-12-23 12:55:47', 0),
(2, 2, 2, '2025-12-23 13:57:08', 0),
(3, 3, 2, '2025-12-26 09:58:32', 0),
(4, 4, 2, '2025-12-26 10:58:53', 1),
(5, 5, 3, '2025-12-28 14:58:53', 1),
(6, 7, 2, NULL, 0),
(7, 7, 1, NULL, 0),
(8, 10, 5, NULL, 0),
(9, 11, 3, '2026-01-10 00:08:00', 1),
(11, 11, 5, NULL, 0);

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
(1, 'Carpool 1 time', 'Carpool with at least 2 people to complete the challenge (description includes T&C)', 1000, 'No. 11, Jalan Teknologi 5, Taman Teknologi Malaysia, Bukit Jalil 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur', 'Daily'),
(2, 'Bring Your Own Bottle', 'Use a reusable bottle instead of disposable plastic bottles for the day (description includes T&C)', 10022, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Daily'),
(3, 'Public Transport Commute', 'Commute to campus using public transport at least once during the week (description includes T&C)', 300, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Weekly'),
(4, 'No-Print Week', 'Avoid printing any documents for one full week to reduce paper usage (description includes T&C)', 500, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Weekly'),
(5, 'Green Lifestyle Month', 'Participate in eco-friendly activities throughout the month to promote sustainability (description includes T&C)', 1200, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'Seasonal'),
(6, 'Clean up After Eating', 'After eating in the canteen. Participants will have to take a photo and upload to the Log Action to submit their submission. The photo will have to be verified, and the photo must about the user taking their plates to the canteen dirty place section ', 100, 'APU Campus, Technology Park Malaysia, Bukit Jalil', 'Daily');

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
  PRIMARY KEY (`downtime_id`),
  UNIQUE KEY `downtime_id` (`downtime_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `downtime`
--

INSERT INTO `downtime` (`downtime_id`, `admin_id`, `start_time`, `end_time`) VALUES
(1, 1, '2025-12-21 07:01:39', '2025-12-22 15:01:40'),
(2, 1, '2025-12-24 15:02:47', '2025-12-26 15:02:47'),
(3, 3, '2025-12-03 15:02:47', '2025-12-05 15:02:47'),
(4, 2, '2026-01-01 15:03:14', '2026-01-03 15:03:14');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eco_news`
--

INSERT INTO `eco_news` (`eco_news_id`, `title`, `description`, `image_path`, `venue`, `organised_by`, `events_id`, `posted_by`) VALUES
(1, 'Beach Clean-up', 'Beach clean-up is an annual event where students clean up beaches along the coast of Klang', 'beach_cleanup.jpg', 'Kawasan Perindustrian Selat Klang Utara, 42000 Port Klang, Selangor', 'Petronas', 1, 3),
(17, 'Tree Planting Day', 'Students and staff join to plant trees around the campus to promote greenery and reduce carbon footprint', 'tree_planting.jpg', 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'APU Green Club', 3, 2),
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
  `points_rewarded` int NOT NULL,
  `venue` text NOT NULL,
  `organised_by` varchar(255) NOT NULL,
  `organizer_email` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `max_participants` int NOT NULL,
  PRIMARY KEY (`events_id`),
  UNIQUE KEY `events_id` (`events_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`events_id`, `event_name`, `description`, `points_rewarded`, `venue`, `organised_by`, `organizer_email`, `start_time`, `end_time`, `max_participants`) VALUES
(1, 'APU gotong-royong', 'A weekly event where students come together and make an effort to keep school premises clean', 500, 'No. 11, Jalan Teknologi 5, Taman Teknologi Malaysia, Bukit Jalil 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur.”', 'Petronas', 'contactmplus@petronas.com', '2025-12-23 10:00:00', '2025-12-23 16:30:00', 300),
(2, 'APU Blood Donation Drive', 'A campus-wide blood donation campaign in collaboration with hospitals to encourage students to donate blood', 800, 'APU Campus, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'National Blood Centre', 'info@pdn.gov.my', '2025-12-26 09:00:00', '2025-12-26 15:00:00', 200),
(3, 'APU Tech Awareness Workshop', 'An educational workshop aimed at increasing awareness of emerging technologies and digital safety among students', 300, 'APU Lecture Hall 5, Technology Park Malaysia, Bukit Jalil, Kuala Lumpur', 'APU IT Society', 'apuitsociety@apu.edu.my', '2025-12-28 14:00:00', '2025-12-28 17:30:00', 150),
(4, 'Dorm Cleaning Day', 'The day where participants can come and help to clean the campus dorms', 100, 'APU Campus', 'APU Dorm Community', 'APUDormCommunity@gmail.com', '2026-01-16 13:01:11', '2026-01-17 13:01:11', 50),
(5, 'Love Campaign', 'A Loving campaign to participants to a attended', 1000, 'APU Block A -05-01', 'APU Loving Community', 'APU@mail.com', '2026-01-28 17:24:45', '2026-01-28 20:24:45', 2),
(7, 'Computer Lab Clean Up', 'Events that allow participants to help clean up the computer labs in campus', 500, 'APU Campus', 'APU LAB', 'APULAB@gmail.com', '2026-01-22 22:00:00', '2026-01-23 22:00:00', 20);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event_manager`
--

INSERT INTO `event_manager` (`event_manager_id`, `user_id`) VALUES
(1, 12),
(2, 13),
(3, 14),
(4, 15),
(5, 21),
(6, 22),
(7, 23),
(8, 28);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participants_id`, `user_id`, `TP_no`) VALUES
(1, 7, 'TP00001'),
(2, 8, 'TP00002'),
(3, 9, 'TP00003'),
(4, 10, 'TP00004'),
(5, 11, 'TP00005'),
(6, 19, ''),
(7, 20, ''),
(10, 24, ''),
(11, 25, 'TP00006');

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
  `Challenge_notes` varchar(255) NOT NULL,
  `staff_id` int NOT NULL,
  PRIMARY KEY (`participants_challenges_id`),
  UNIQUE KEY `participants_challenges_id` (`participants_challenges_id`),
  KEY `participants_id` (`participants_id`),
  KEY `challenges_id` (`challenges_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participants_challenges`
--

INSERT INTO `participants_challenges` (`participants_challenges_id`, `participants_id`, `challenges_id`, `date_accomplished`, `verified_date`, `challenges_status`, `impact_type`, `image_path`, `impact_amount`, `Challenge_notes`, `staff_id`) VALUES
(1, 5, 2, '2025-12-05', '2025-12-06', 'approved', 'reduced water pollution', 'img_695b394b7bbe24.19717501.jpg', 5, '', 1),
(2, 2, 1, '2025-12-17', '2025-12-18', 'pending', 'reduced carbon emmision', 'img_695b394b7bbe24.19717501.jpg', 2, '', 3),
(3, 3, 4, '2025-12-17', '2025-12-19', 'rejected', 'recycling trash', 'img_695b394b7bbe24.19717501.jpg', 3, '', 6),
(4, 5, 3, '2025-12-24', '2025-12-31', 'approved', 'reduced carbon emmision', 'img_695b394b7bbe24.19717501.jpg', 6, '', 4),
(5, 4, 5, '2025-12-25', '2025-12-29', 'approved', 'reduced air pollution', 'img_695b394b7bbe24.19717501.jpg', 12, '', 1),
(6, 7, 2, '2026-01-04', '2026-01-04', 'approved', 'reduced pollution', 'img_695b394b7bbe24.19717501.jpg', 6, '', 4),
(7, 7, 6, '2026-01-04', '2026-01-04', 'rejected', 'reduced pollution', 'img_695b394b7bbe24.19717501.jpg', 90, '', 2),
(8, 7, 2, '2026-01-01', '2026-01-02', 'rejected', 'reduced pollution', 'img_695b394b7bbe24.19717501.jpg', 90, 'Null', 2),
(10, 7, 1, '2026-01-05', '2026-01-05', 'pending', 'Reduced Pollution', 'img_695b394b7bbe24.19717501.jpg', 190, 'null', 6),
(11, 7, 2, '2026-01-05', '2026-01-05', 'pending', 'Reduced Pollution', 'img_695b394b7bbe24.19717501.jpg', 190, 'NULL', 1),
(12, 7, 1, '2026-01-06', NULL, 'pending', NULL, 'img_695c988fa07a63.73827008.png', NULL, '', 3),
(13, 11, 2, '2026-01-11', '2026-01-11', 'pending', 'dad', 'daawd', 22, 'wdwa', 1),
(14, 11, 6, '2026-01-11', '2026-01-11', 'approved', '2222', 'dawdawa', 22, 'awdwa', 5),
(23, 11, 1, '2026-01-10', NULL, 'pending', NULL, 'challenge_submission_uploads/img_69628e343acfe2.38468076.png', NULL, 'awsedr', 4),
(24, 11, 1, '2026-01-10', NULL, 'pending', NULL, 'challenge_submission_uploads/img_69628f4067c6e7.26126978.png', NULL, '', 7),
(25, 11, 1, '2026-01-11', NULL, 'pending', NULL, 'challenge_submission_uploads/img_69628fb31ba893.26564989.png', NULL, '', 3),
(26, 11, 4, '2026-01-11', '2026-01-12', 'approved', NULL, 'img_6963bc23ad7661.51833310.png', NULL, 'sss', 2),
(27, 11, 5, '2026-01-11', '2026-01-11', 'rejected', 'awdwad', 'img_6963bca9cbd926.76407367.png', 222, 'aaaa', 6),
(28, 11, 1, '2026-01-12', NULL, 'pending', NULL, 'img_6963d1e5cae142.04882216.png', NULL, '', 5);

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
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`rewards_id`),
  UNIQUE KEY `rewards_id` (`rewards_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`rewards_id`, `reward_name`, `description`, `points_required`, `quantity`, `category`) VALUES
(1, 'Free Parking', 'Reward includes free parking for 3 days (description includes T&C)', 1500, 15, 'Vouchers'),
(2, 'Campus Cafeteria Voucher', 'RM10 voucher redeemable at the campus cafeteria (terms and conditions apply)', 800, 50, 'Vouchers'),
(3, 'APU Merchandise T-Shirt', 'Official APU merchandise T-shirt available in selected sizes (terms and conditions apply)', 1200, 30, 'Physical'),
(4, 'Printing Credits', 'Includes 100 pages of black-and-white printing credits usable within the campus (terms and conditions apply)', 500, 100, 'Vouchers'),
(5, 'Library Late Fee Waiver', 'Waiver of library late fees up to RM20 (terms and conditions apply)', 700, 40, 'Physical\r\n');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reward_redemption`
--

INSERT INTO `reward_redemption` (`reward_redemption_id`, `participants_id`, `rewards_id`, `date_redeemed`, `qr_used`, `qr_token`) VALUES
(1, 1, 1, '2025-12-03', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(2, 2, 2, '2025-12-10', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(3, 3, 3, '2025-12-24', 0, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(4, 4, 4, '2025-12-25', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(5, 5, 5, '2025-12-31', 1, 'eco_qr_8f3a2b1c9d4e5f6a7b8c9d0e1f2a3b4c'),
(6, 7, 1, '2026-01-05', 0, 'c470e14616b5f4df962c1636ef77c827'),
(7, 11, 4, '2026-01-11', 0, 'a3bab6f1e22cf53ccfa567c2d7003b03');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`) VALUES
(1, 3),
(2, 4),
(3, 5),
(4, 6),
(5, 16),
(6, 17),
(7, 26);

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
(1, '2025-12-21 14:40:24', 'User used feature challenge submission', 'User has uploaded 1 photo for challenge submission', 20),
(2, '2025-12-21 14:45:10', 'User logged in', 'User successfully logged into the system', 11),
(3, '2025-12-21 14:48:32', 'User joined event', 'User registered for the APU gotong-royong event', 20),
(4, '2025-12-21 14:52:05', 'User redeemed reward', 'User redeemed reward: Campus Cafeteria Voucher', 20),
(5, '2025-12-21 14:55:47', 'User completed challenge', 'User completed the Daily Carpool challenge', 11),
(6, '2025-12-21 15:01:18', 'User updated profile', 'User updated profile picture and personal details', 6),
(7, '2025-12-21 15:05:10', 'User logged in', 'User successfully logged into the system', 2),
(8, '2025-12-21 15:07:34', 'User viewed event', 'User viewed event details for APU gotong-royong', 9),
(9, '2025-12-21 15:09:02', 'User joined event', 'User registered for APU Blood Donation Drive', 9),
(10, '2025-12-21 15:11:28', 'User submitted challenge', 'User submitted evidence for Daily Carpool challenge', 9),
(11, '2025-12-21 15:13:55', 'User logged out', 'User logged out of the system', 9),
(12, '2025-12-21 15:16:10', 'User logged in', 'User successfully logged into the system', 10),
(13, '2025-12-21 15:18:42', 'User updated profile', 'User updated contact information', 6),
(14, '2025-12-21 15:21:06', 'User redeemed reward', 'User redeemed reward: Printing Credits', 3),
(15, '2025-12-21 15:23:39', 'User viewed eco news', 'User viewed news article: Beach Clean-up', 8),
(16, '2025-12-21 15:26:11', 'User completed challenge', 'User completed Bring Your Own Bottle challenge', 10),
(17, '2025-12-21 15:28:45', 'User logged out', 'User logged out of the system', 8),
(18, '2025-12-21 15:31:02', 'User logged in', 'User successfully logged into the system', 6),
(19, '2025-12-21 15:33:27', 'User joined event', 'User registered for APU Tech Awareness Workshop', 11),
(20, '2025-12-21 15:36:10', 'User submitted challenge', 'User uploaded 2 photos for Weekly Public Transport challenge', 8),
(21, '2025-12-21 15:38:58', 'User viewed reward', 'User viewed reward details: Free Parking', 3),
(22, '2025-12-21 15:41:20', 'User redeemed reward', 'User redeemed reward: Library Late Fee Waiver', 6),
(23, '2025-12-21 15:44:03', 'User viewed event', 'User viewed event details for Tree Planting Day', 4),
(24, '2025-12-21 15:46:35', 'User updated settings', 'User updated notification preferences', 2),
(25, '2025-12-21 15:49:12', 'User completed challenge', 'User completed Weekly No-Print challenge', 10),
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(18, 'Daniel Chong', 'daniel.chong@gmail.com', 'P!9xL@2M', 'images/profile.png', 'Deactivated'),
(19, 'vernice', 'vernice.heong@gmail.com', '$2y$10$JJTy7S4fnhUD/t74oEJkz.TqGVCHXa5wlZBfMyg/2kC/zVh.eIu8.', 'images/profile.png', 'Active'),
(20, 'Anne', 'Anne@yahoo.com', '$2y$10$9W0fGJM/8BtyADBZZDS47Oce0IgqQH8WUPYXqt4KO.I9XvsfyYsR.', 'images/profile.png', 'Active'),
(21, 'Albert', 'Albert@mail.com', '$2y$10$eW5x5O1nYj1kT3P2H4uJXeOQfT/ZxvVQ6zN1B6oQHxC0Vtq8M/1vK', 'NULL', 'active'),
(22, 'Ku Wei Jun', 'Ku@mail.com', '$2y$10$WCEgiFOJgx3nd9zWPt9C/.xxiGfOu.eYlxS1vUXo5Fza2fxgekOW6', 'images/profile.png', 'Active'),
(23, 'Hi', 'Hi@mail.com', '$2y$10$1qqmjhhCyZT9nI1WBjFb7etNCKO0dhNxgUL.Yu3hpCpEw7UTdtGo2', 'images/1767861274_roof open.jpg', 'Active'),
(24, 'Bye', 'Bye@mail.com', '$2y$10$mcLc9xaqpLYyteoCZIjlDuryWHJ.JrZTpkYUjPUskuPAj4WHIEiku', 'images/profile.png', 'Active'),
(25, 'participant', 'participant@mail.com', '$2y$10$8MGB6I137e.rvzausZKS3.Tw6u5qkb2ZtbDUfXGRW.rVQiu0PRPWS', 'images/1768149514_swords.png', 'Active'),
(26, 'staff', 'staff@mail.com', '$2y$10$UwmDlFezUDn.PV8A8bvRme6P0CERgruw//DFWN5T/x6CHHKnlyd1y', 'images/profile.png', 'Active'),
(27, 'admin', 'admin@mail.com', '$2y$10$Zrmw3xPeY/FF5QXedgQwVez9vtZpAFNhi7LQrrW8EDJdPxKQx7iBu', 'images/1768150367_erd rwdd.drawio.png', 'Active'),
(28, 'event manager', 'event_manager@mail.com', '$2y$10$SIlO/rhn5I6p1zyNxhI/IO2Jhi8kEWGr8PsSon9Fzc0psekAaWxiS', '../../images/1768150382_swords.png', 'Active');

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
  ADD CONSTRAINT `eco_news_ibfk_3` FOREIGN KEY (`posted_by`) REFERENCES `event_manager` (`event_manager_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
