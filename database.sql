-- ==============================================================
-- ICS 2102: Web Development Mini Project - HIT Hoopers
-- Database Schema: hit_hoopers
-- MySQL / MariaDB Dump for XAMPP phpMyAdmin Import
-- ==============================================================

CREATE DATABASE IF NOT EXISTS `hit_hoopers` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hit_hoopers`;

-- --------------------------------------------------------
-- Table structure for table `members`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL DEFAULT 'General Member',
  `membership_type` varchar(50) NOT NULL DEFAULT 'Player',
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Seed data for table `members`
-- --------------------------------------------------------

INSERT INTO `members` (`full_name`, `email`, `student_id`, `position`, `membership_type`, `message`, `created_at`) VALUES
('Tadiwa Moyo', 'tmoyo@hit.ac.zw', 'H230101A', 'Point Guard', 'Competitive Player', 'Excited for the upcoming inter-varsity games!', '2026-09-15 10:30:00'),
('Chipo Ndlovu', 'cndlovu@hit.ac.zw', 'H230205B', 'Shooting Guard', 'Competitive Player', 'Looking forward to weekend training sessions.', '2026-09-18 14:15:00'),
('Kudzai Marume', 'kmarume@hit.ac.zw', 'H240312C', 'Center', 'Social / Fitness', 'Want to stay active and learn basketball fundamentals.', '2026-09-22 09:00:00'),
('Takunda Dube', 'tdube@hit.ac.zw', 'H230489D', 'Small Forward', 'Competitive Player', 'Dedicated forward ready to help our defense.', '2026-09-25 16:40:00');
