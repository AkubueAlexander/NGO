-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 26, 2025 at 02:03 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healingheart`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(35) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

DROP TABLE IF EXISTS `donation`;
CREATE TABLE IF NOT EXISTS `donation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` decimal(11,2) NOT NULL,
  `fullName` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `donationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`id`, `amount`, `fullName`, `email`, `phone`, `donationDate`) VALUES
(2, 500.00, 'Mr Alexino', 'akubuealexander@gmail.com', '09065151126', '2025-08-26 08:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` text NOT NULL,
  `banner` varchar(65) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'upcoming',
  `startDate` timestamp NOT NULL,
  `endDate` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `banner`, `status`, `startDate`, `endDate`) VALUES
(5, 'Widows Empowerment Workshop', '                           A full-day training session focused on building entrepreneurial and vocational skills for widows. Participants will learn practical business strategies, financial management, and how to access small-scale funding opportunities to start or grow their businesses. ', 'banner/banner_68ad813fb90059.40977582.jpg', 'Upcoming', '2025-08-26 23:00:00', '2025-08-27 23:00:00'),
(6, 'Healing Hearts Counseling Session', '                            A group counseling and therapy program designed to provide emotional and psychological support for widows. Led by professional counselors, the session creates a safe space for sharing, healing, and overcoming grief.', 'banner/banner_68ad81918420d7.78718007.jpg', 'Completed', '2025-08-29 23:00:00', '2025-08-30 23:00:00'),
(7, 'Community Awareness Walk', '                            An outreach event to raise awareness about the challenges widows face in society. Participants will walk through designated routes carrying banners, sharing information, and engaging with the public to promote inclusion and support for widows.', 'banner/banner_68ad81e66169e4.26309452.jpg', 'Upcoming', '2025-08-31 23:00:00', '2025-09-01 23:00:00'),
(8, 'Widows Health & Wellness Day', '                            A free health screening and wellness program where widows receive medical check-ups, fitness tips, and nutritional guidance. The event will also feature talks from healthcare professionals on mental and physical well-being.', 'banner/banner_68ad822ac97d76.82873788.jpg', 'Completed', '2025-08-22 23:00:00', '2025-08-16 23:00:00'),
(9, 'Back-to-School Support Drive', '                            A community initiative that provides widows with educational materials, uniforms, and scholarships for their children. The program ensures that children of widows are not denied quality education due to financial hardship.', 'banner/banner_68ad8278d4c989.85302895.jpg', 'Completed', '2025-08-12 23:00:00', '2025-08-14 23:00:00'),
(10, 'Widows Legal Rights Seminar', '                            A knowledge-sharing session led by legal experts to educate widows about their rights regarding inheritance, property ownership, and protection against discrimination. Practical guidance will also be offered for accessing legal aid services.', 'banner/banner_68ad82c739f0f7.88424522.jpg', 'Upcoming', '2025-09-30 23:00:00', '2025-10-01 23:00:00'),
(11, 'End-of-Year Widows Celebration & Networking D', '                            An annual gathering that celebrates widows’ resilience, achievements, and contributions to society. The event offers a chance for widows to network, share success stories, and enjoy a day filled with music, food, and encouragement.', 'banner/banner_68ad8312602e70.56037176.jpg', 'Completed', '2025-08-09 23:00:00', '2025-08-10 23:00:00'),
(12, 'Widows Skills Acquisition Bootcamp', '                            A week-long intensive training where widows are equipped with hands-on skills in areas such as tailoring, catering, ICT, and handicrafts. The bootcamp is designed to boost self-reliance and create sustainable income opportunities.', 'banner/banner_68ad8348d581e7.65917204.jpg', 'Upcoming', '2025-08-27 23:00:00', '2025-08-28 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `eventmedia`
--

DROP TABLE IF EXISTS `eventmedia`;
CREATE TABLE IF NOT EXISTS `eventmedia` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eventId` int NOT NULL,
  `filepath` varchar(500) DEFAULT NULL,
  `mediaType` varchar(15) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`eventId`),
  KEY `eventId` (`eventId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventmedia`
--

INSERT INTO `eventmedia` (`id`, `eventId`, `filepath`, `mediaType`, `uploadDate`) VALUES
(17, 6, 'uploads/event_6/68ad9cf6728f8_banner-two.jpg', 'image', '2025-08-26 11:39:34'),
(18, 6, 'uploads/event_6/68ad9cf6748d4_banner.jpg', 'image', '2025-08-26 11:39:34'),
(19, 6, 'uploads/event_6/68ad9cf675fae_banner-three.jpg', 'image', '2025-08-26 11:39:34'),
(20, 6, 'uploads/event_6/68ad9e55031a7_185947-876963225_small.mp4', 'video', '2025-08-26 11:45:25'),
(21, 6, 'uploads/event_6/68ad9e55045ea_65562-515098354_small.mp4', 'video', '2025-08-26 11:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(35) NOT NULL,
  `fullName` varchar(45) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `messageDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `email`, `fullName`, `subject`, `message`, `messageDate`) VALUES
(2, 'tokyo@gmail.com', 'Mr Alexino', 'Testing Resting', 'lorem ipsum', '2025-08-21 15:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

DROP TABLE IF EXISTS `volunteer`;
CREATE TABLE IF NOT EXISTS `volunteer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullName` varchar(35) NOT NULL,
  `areaOfInterest` varchar(35) NOT NULL,
  `message` text NOT NULL,
  `volunteerDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`id`, `fullName`, `areaOfInterest`, `message`, `volunteerDate`, `email`) VALUES
(1, 'Mr Alexino', 'Event Support', 'lorem ipsum', '2025-08-22 08:00:55', 'akubuealexander@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eventmedia`
--
ALTER TABLE `eventmedia`
  ADD CONSTRAINT `eventmedia_ibfk_1` FOREIGN KEY (`eventId`) REFERENCES `event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
