-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2023 at 11:00 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_username` varchar(225) NOT NULL,
  `admin_password` varchar(225) NOT NULL,
  `admin_department` varchar(225) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_username`, `admin_password`, `admin_department`, `date_added`) VALUES
(1, 'Admin1', '$2y$10$aXQ07zuEEs3d4AVILk8QWOQj/b26/zHhQ0G32TuAWT.ym1QsplQ8C', 'Faculty', '19-02-2023'),
(2, 'Admin2', '$2y$10$MqYDwmu4lpwfqsn5wOFNS.Qyw/W7krPmOxMoUm7qWytJOxGtgeNTC', 'Computer Science', '19-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `courses_table`
--

CREATE TABLE `courses_table` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `course_code` varchar(225) NOT NULL,
  `course_title` varchar(225) NOT NULL,
  `credit_unit` varchar(225) NOT NULL,
  `level` varchar(225) NOT NULL,
  `semester` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `num_of_students` varchar(225) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses_table`
--

INSERT INTO `courses_table` (`course_id`, `course_code`, `course_title`, `credit_unit`, `level`, `semester`, `department`, `num_of_students`, `date_added`) VALUES
(1, 'CSC 201', 'Introduction to Computer Programming I', '3', '200', '1st', 'Computer Science', '200', '19-02-2023'),
(2, 'CSC 202', 'Introduction to Computer Programming II', '3', '200', '1st', 'Computer Science', '500', '19-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `department_offerings`
--

CREATE TABLE `department_offerings` (
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_offerings`
--

INSERT INTO `department_offerings` (`offer_id`, `course_id`, `department`, `date_added`) VALUES
(1, '1', 'Computer Science', '19-02-2023'),
(2, '1', 'Industrial Physics', '19-02-2023'),
(3, '1', 'Mathematics', '19-02-2023'),
(4, '1', 'Statistics', '19-02-2023'),
(5, '2', 'Computer Science', '19-02-2023'),
(6, '2', 'Geophysics', '19-02-2023'),
(7, '2', 'Industrial Chemistry', '19-02-2023'),
(8, '2', 'Mathematics', '19-02-2023'),
(9, '2', 'Statistics', '19-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `halls_table`
--

CREATE TABLE `halls_table` (
  `hall_id` bigint(20) UNSIGNED NOT NULL,
  `hall_name` varchar(225) NOT NULL,
  `hall_capacity` varchar(225) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halls_table`
--

INSERT INTO `halls_table` (`hall_id`, `hall_name`, `hall_capacity`, `date_added`) VALUES
(1, 'General Purpose Hall', '700', '19-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `invigilators`
--

CREATE TABLE `invigilators` (
  `invigilator_id` bigint(20) UNSIGNED NOT NULL,
  `invigilator_title` varchar(225) NOT NULL,
  `invigilator_name` varchar(225) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invigilators`
--

INSERT INTO `invigilators` (`invigilator_id`, `invigilator_title`, `invigilator_name`, `date_added`) VALUES
(1, 'Dr.', 'Eminence', '19-02-2023'),
(2, 'Prof.', 'Sire Eminence', '19-02-2023');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `timetable_id` bigint(20) UNSIGNED NOT NULL,
  `timetable_session` varchar(225) NOT NULL,
  `timetable_semester` varchar(225) NOT NULL,
  `timetable_list` longtext NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`);

--
-- Indexes for table `courses_table`
--
ALTER TABLE `courses_table`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indexes for table `department_offerings`
--
ALTER TABLE `department_offerings`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `halls_table`
--
ALTER TABLE `halls_table`
  ADD PRIMARY KEY (`hall_id`),
  ADD UNIQUE KEY `hall_name` (`hall_name`);

--
-- Indexes for table `invigilators`
--
ALTER TABLE `invigilators`
  ADD PRIMARY KEY (`invigilator_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`timetable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `courses_table`
--
ALTER TABLE `courses_table`
  MODIFY `course_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_offerings`
--
ALTER TABLE `department_offerings`
  MODIFY `offer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `halls_table`
--
ALTER TABLE `halls_table`
  MODIFY `hall_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invigilators`
--
ALTER TABLE `invigilators`
  MODIFY `invigilator_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `timetable_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
