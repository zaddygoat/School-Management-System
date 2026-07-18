-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2026 at 04:32 PM
-- Server version: 8.0.46
-- PHP Version: 8.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `title` text COLLATE utf8mb4_general_ci NOT NULL,
  `section` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `add_date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `title`, `section`, `add_date`) VALUES
(4, 'FY B.s.c IT', '10', '2026-07-09 18:30:00'),
(5, 'SY BSC-IT', '10', '2026-07-10 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `category` text COLLATE utf8mb4_general_ci NOT NULL,
  `duration` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `category`, `duration`, `date`, `image`) VALUES
(11, 'PHP', 'Programming', '50 Hours', '2026-07-06 00:00:00', 'php.png'),
(12, 'HTML', 'Programming', '6 hours', '2026-07-06 00:00:00', 'html.png'),
(13, 'Css', 'Programming', ' 223 hours', '2026-07-06 00:00:00', 'css.png'),
(14, 'JS', 'Programming', '223 Hours', '2026-07-06 00:00:00', 'js.png'),
(15, 'Node Js', 'Programming', ' 223 hours', '2026-07-06 00:00:00', 'nodejs.png'),
(17, 'Java', 'Programming', ' 223 hours', '2026-07-06 00:00:00', 'java.png');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int NOT NULL,
  `std_id` int NOT NULL,
  `receipt_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registration_fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `std_id`, `receipt_number`, `registration_fee`) VALUES
(1, 32, '1', 5000.00),
(2, 33, '2', 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `metadata`
--

CREATE TABLE `metadata` (
  `id` int NOT NULL,
  `item_id` int NOT NULL,
  `meta_key` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_management_system`
--

CREATE TABLE `school_management_system` (
  `id` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_management_system`
--

INSERT INTO `school_management_system` (`id`, `type`, `email`, `password`, `name`) VALUES
(5, 'admin', 'zaid@gmail.com', '12345678', 'Zaid'),
(8, 'teacher', 'zaidahmed45786@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Zaid Ansari'),
(9, 'teacher', 'dextermorgan@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Dexter Morgan'),
(25, 'student', 'finlawgahmed45786@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Zaid Ahmed Ansari'),
(31, 'student', 'patrickjane@gmail.com', '12345678', 'Patrick Jane'),
(32, 'student', 'redjohn@gmail.com', '12', 'Lisbon'),
(33, 'student', 'sarayeager@gmail.com', '25f9e794323b453885f5181f1b624d0b', 'Sarah Jaegar');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int NOT NULL,
  `title` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `title`) VALUES
(10, 'Section A'),
(11, 'Section B ');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `father_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `father_mobile` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mother_mobile` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `college_name` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `school_college` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_marks` int DEFAULT NULL,
  `obtain_marks` int DEFAULT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `admission_in` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stream` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `payment_method` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `student_id`, `dob`, `mobile`, `address`, `father_name`, `father_mobile`, `mother_name`, `mother_mobile`, `qualification`, `college_name`, `school_college`, `status`, `total_marks`, `obtain_marks`, `percentage`, `admission_in`, `stream`, `date_of_join`, `payment_method`) VALUES
(1, 25, '2006-04-28', '9142945786', 'Bandra', 'MatiUr Rehman Ansari', 'xxxxxxxxxx', 'Zeba Ansari', 'xxxxxxxxxx', 'H.S.c', 'Rizvi', 'College', 'Pass', 600, 455, 75.83, 'FY B.Sc IT', 'Science', '2026-07-14', 'offline'),
(3, 31, '2006-04-28', 'XXXXXXXXXX', 'CA', 'Jane', 'XXXXXXXXXX', 'Jennifer', 'XXXXXXXXXX', 'H.S.c', '-', 'School', 'Pass', 400, 300, 75.00, 'Degree', 'Science', '2026-07-15', 'offline'),
(4, 32, '2006-05-24', '9142945786', 'sadad', 'fsaxx', 'xxxxxxx', 'xaaddad', 'XXXXXXXXXXXXXX', '2010210', '4344', 'School', 'Pass', 300, 234, 78.00, 'afafa', 'Science', '2002-07-15', 'offline'),
(5, 33, '2008-04-28', '305657890', 'Japan', 'James Doakes', '29292', 'Jessie Doakes', '39393', 'n nsnf', 'Rizvi', 'School', 'Pass', 3000, 2678, 89.27, 'H.Sc', 'Commerce', '2005-04-28', '');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `date`, `class_id`) VALUES
(4, 'Python Programming', '2026-07-11 20:57:32', 4),
(5, 'Object Orieneted Programming', '2026-07-11 20:58:34', 4),
(6, 'Linux Server Administration', '2026-07-11 20:59:03', 4),
(7, 'Advanced Java', '2026-07-12 21:20:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `section_id` int NOT NULL,
  `day` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `time_slot` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `class_id`, `section_id`, `day`, `time_slot`, `subject`) VALUES
(61, 4, 10, 'Monday', '9:00 - 10:00', 'Python Programming'),
(62, 4, 10, 'Monday', '10:00 - 11:00', 'Object Oriented Programming'),
(63, 4, 10, 'Monday', '11:00 - 12:00', 'Advanced Java'),
(64, 4, 10, 'Monday', '1:00 - 2:00', 'Practical - Advanced Java'),
(65, 4, 10, 'Monday', '2:00 - 3:00', 'Practical - Advanced Java'),
(66, 4, 10, 'Tuesday', '9:00 - 10:00', 'Advanced Java'),
(67, 4, 10, 'Tuesday', '10:00 - 11:00', 'Python Programming'),
(68, 4, 10, 'Tuesday', '11:00 - 12:00', 'Applied Mathematics'),
(69, 4, 10, 'Tuesday', '1:00 - 2:00', 'Practical - Object Oriented Programming'),
(70, 4, 10, 'Tuesday', '2:00 - 3:00', 'Practical - Object Oriented Programming'),
(71, 4, 10, 'Wednesday', '9:00 - 10:00', 'Object Oriented Programming'),
(72, 4, 10, 'Wednesday', '10:00 - 11:00', 'Fundamentals Of Database'),
(73, 4, 10, 'Wednesday', '11:00 - 12:00', 'Linux Server Administration'),
(74, 4, 10, 'Wednesday', '1:00 - 2:00', 'Practical - Android Programming'),
(75, 4, 10, 'Wednesday', '2:00 - 3:00', 'Practical - Android Programming'),
(76, 4, 10, 'Thursday', '9:00 - 10:00', 'Linux Server Administration'),
(77, 4, 10, 'Thursday', '10:00 - 11:00', 'Advanced Java'),
(78, 4, 10, 'Thursday', '11:00 - 12:00', 'Object Oriented Programming'),
(79, 4, 10, 'Thursday', '1:00 - 2:00', 'Practical - Python Programming'),
(80, 4, 10, 'Thursday', '2:00 - 3:00', 'Practical - Python Programming'),
(81, 4, 10, 'Friday', '9:00 - 10:00', 'Fundamentals Of Database'),
(82, 4, 10, 'Friday', '10:00 - 11:00', 'Python Programming'),
(83, 4, 10, 'Friday', '11:00 - 12:00', 'Applied Mathematics'),
(84, 4, 10, 'Friday', '1:00 - 2:00', 'Pratical - Linux Server Administration'),
(85, 4, 10, 'Friday', '2:00 - 3:00', 'Pratical - Linux Server Administration'),
(86, 4, 10, 'Saturday', '9:00 - 10:00', 'Object Oriented Programming'),
(87, 4, 10, 'Saturday', '10:00 - 11:00', 'Advanced Java'),
(88, 4, 10, 'Saturday', '11:00 - 12:00', 'Applied Mathematics'),
(89, 4, 10, 'Saturday', '1:00 - 2:00', 'Linux Server Administration'),
(90, 4, 10, 'Saturday', '2:00 - 3:00', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `school_management_system`
--
ALTER TABLE `school_management_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_slot` (`class_id`,`section_id`,`day`,`time_slot`),
  ADD KEY `section_id` (`section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_management_system`
--
ALTER TABLE `school_management_system`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `school_management_system` (`id`);

--
-- Constraints for table `student_details`
--
ALTER TABLE `student_details`
  ADD CONSTRAINT `student_details_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `school_management_system` (`id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
