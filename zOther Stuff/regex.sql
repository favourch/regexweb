-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2017 at 04:45 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `regex`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `cid` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `creditHours` varchar(255) NOT NULL,
  `level` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL,
  `lid` int(11) DEFAULT NULL,
  `did` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `code`, `creditHours`, `level`, `name`, `semester`, `lid`, `did`, `created_at`, `updated_at`) VALUES
(3, 'SOGE1573', '3', '100', 'Studies in African Development', 1, 5, 1, '2017-01-18 15:12:42', '2017-01-18 14:12:42'),
(4, 'SIIS1553', '3', '100', 'Principles of Programming Using C#', 1, 4, 1, '2017-01-18 15:12:18', '2017-01-18 14:12:18'),
(5, NULL, '3', '100', ' SOED1533 Communication Skills I', 1, 5, 1, '2017-01-18 13:10:09', '2017-01-18 12:10:09'),
(6, NULL, '3', '100', ' LAFR1513 French Language I', 1, NULL, 1, '2017-01-18 15:02:02', '2017-01-18 12:10:09'),
(7, NULL, '3', '200', ' SICS1533 Foundation of Computer Science', 1, NULL, 0, '2017-01-10 12:32:43', '2017-01-10 11:00:03'),
(8, NULL, '2', '200', ' SIIS1513 Introductory Statistics', 1, NULL, 0, '2017-01-10 12:32:43', '2017-01-10 11:00:03'),
(12, NULL, '3', '200', ' SIIS2573 Application Programming with C# I', 1, 5, 1, '2017-01-18 13:43:34', '2017-01-18 12:43:34'),
(13, NULL, '3', '200', ' SIIS2513  Internet Programming I', 2, NULL, 0, '2017-01-10 12:32:43', '2017-01-10 11:00:03'),
(14, NULL, '3', '300', ' SIIS2533 Networking Fundamentals', 2, NULL, 0, '2017-01-10 12:33:26', '2017-01-10 11:00:03'),
(15, NULL, '3', '300', ' SIIS2553 Database Systems I', 2, NULL, 0, '2017-01-10 12:33:30', '2017-01-10 11:00:03'),
(16, NULL, '3', '300', ' SICS2583 Operating Systems', 2, NULL, 0, '2017-01-10 12:33:33', '2017-01-10 11:00:03'),
(17, NULL, '3', '300', ' SOMA1533 Introduction to Management', 2, NULL, 0, '2017-01-10 12:33:36', '2017-01-10 11:00:03'),
(21, NULL, '3', '400', ' SICS3513 Human Computer Interactions', 2, 5, 1, '2017-01-18 13:10:23', '2017-01-18 12:10:23'),
(22, NULL, '1', '40', 'SIIS3711 Legal & Ethical Issues in IS', 2, NULL, 0, '2017-01-10 12:34:10', '2017-01-10 11:00:03'),
(23, NULL, '3', '400', ' SIIS3533 Telecom Systems', 2, NULL, 0, '2017-01-10 12:33:51', '2017-01-10 11:00:03'),
(24, NULL, '3', '400', ' SIIS3553 Network Administration', 3, NULL, 0, '2017-01-10 12:33:48', '2017-01-10 11:00:04'),
(25, NULL, '3', 'PRE', ' SIIS3513 Strategic Disposition to Info Mgt.', 3, NULL, 0, '2017-01-10 12:33:55', '2017-01-10 11:00:04'),
(26, NULL, '3', 'PRE', ' SIEN3043 Geographical Information System I', 0, NULL, 0, '2017-01-10 12:33:58', '2017-01-10 11:00:04'),
(27, NULL, '16', 'PRE', ' ', 3, NULL, 0, '2017-01-10 12:34:01', '2017-01-10 11:00:04'),
(28, 'SOGE 1221', '3', '100', 'Introduction To C#', 1, NULL, 0, '2017-01-14 19:30:10', '2017-01-14 19:30:10'),
(29, 'SOGE 7100', '3', 'PRE', 'Studies In African Development', 1, 4, 1, '2017-01-18 13:10:19', '2017-01-18 12:10:19'),
(30, 'vb321', '2', '200', 'Introduction to Visual Baisc .NET', 1, NULL, 0, '2017-01-15 19:17:02', '2017-01-15 19:17:02'),
(31, 'STAt123', '1', '300', 'Applied Statistics', 1, NULL, 0, '2017-01-15 19:17:02', '2017-01-15 19:17:02'),
(33, 'SIIS1223', '2', '400', 'Computer Security', 2, NULL, 1, '2017-01-18 14:17:50', '2017-01-18 14:17:50'),
(34, 'vb321', '2', '200', 'Introduction to Visual Baisc .NET', 1, NULL, 1, '2017-01-18 14:19:37', '2017-01-18 14:19:37'),
(35, 'STAt123', '1', '300', 'Applied Statistics', 1, NULL, 1, '2017-01-18 14:19:37', '2017-01-18 14:19:37');

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE IF NOT EXISTS `depts` (
  `did` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depts`
--

INSERT INTO `depts` (`did`, `name`, `fid`) VALUES
(1, 'INFORMATICS', 1),
(2, 'ENGINEERING', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `name`) VALUES
(1, 'SIET'),
(2, 'SBL');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `lid` int(11) NOT NULL,
  `staffid` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` enum('Lecturer','Admin','Supervisor','HOD','Dean') DEFAULT NULL,
  `resultsUploaded` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `did` int(11) NOT NULL,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lid`, `staffid`, `name`, `qualification`, `phone`, `email`, `role`, `resultsUploaded`, `password`, `remember_token`, `did`, `lastLogin`, `created_at`, `updated_at`) VALUES
(4, '02110113', 'Toby Okeke', 'Phd', '02911221323', 'toby.okeke@gmail.com', 'Lecturer', 8, '$2y$10$Nn8namzmLXuQPhp0yU3XLOZ412RVDtyGnvDSpne3RiTJMr6KuxmJK', '9rLoeoLbWMC2Lo7sxd3V3L6VmDkogkuA1J09hNnyocZMOeSHBbS9UgmxuwTI', 1, '2017-01-18 10:07:12', '2017-01-18 11:07:12', '2017-01-18 10:07:12'),
(5, '02260113', 'benjamin asare  danquah', 'phd', '0269527587', 'ben@gmail.com', 'Lecturer', 0, '$2y$10$6kC3LzsonuSF/NYYJSNZb.b5xaxJCyZqgxWSU9Qi/su2NgAfIdTbm', NULL, 1, NULL, '2017-01-18 10:59:17', '2017-01-18 10:59:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('toby.okeke@gmail.com', '30d3b12066d6615be3895b446934ee69f35291154211b2926ed3d0584dba39b4', '2017-01-10 12:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `progid` int(11) NOT NULL,
  `progname` varchar(255) NOT NULL,
  `did` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`progid`, `progname`, `did`, `created_at`, `updated_at`) VALUES
(3, 'ISS', 1, '2017-01-10 10:54:57', '0000-00-00 00:00:00'),
(4, 'Computer Science', 1, '2017-01-10 10:54:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `cmid` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `studentid` varchar(255) DEFAULT NULL,
  `fromLecturer` tinyint(1) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`cmid`, `content`, `studentid`, `fromLecturer`, `cid`) VALUES
(1, 'Good day sir!', '02110113', 0, 3),
(2, 'yes, how may i help?', '02110113', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `resid` int(11) NOT NULL,
  `attendance` int(11) DEFAULT NULL,
  `midsem` int(11) DEFAULT NULL,
  `ca` int(11) DEFAULT NULL,
  `examscore` int(11) DEFAULT NULL,
  `totalgrade` int(11) DEFAULT NULL,
  `lecturerName` varchar(255) DEFAULT NULL,
  `batchNumber` int(11) NOT NULL,
  `semesterCode` varchar(255) NOT NULL,
  `isHodApproved` tinyint(1) NOT NULL DEFAULT '0',
  `isDeanApproved` tinyint(1) NOT NULL DEFAULT '0',
  `isStudentNotified` tinyint(1) NOT NULL DEFAULT '0',
  `cid` int(10) unsigned NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`resid`, `attendance`, `midsem`, `ca`, `examscore`, `totalgrade`, `lecturerName`, `batchNumber`, `semesterCode`, `isHodApproved`, `isDeanApproved`, `isStudentNotified`, `cid`, `sid`, `created_at`, `updated_at`) VALUES
(15, 8, 28, 36, 52, 88, 'Toby Okeke', 0, '201702', 0, 0, 0, 3, 1, '2017-01-17 15:38:36', '2017-01-17 15:38:36'),
(16, 9, 26, 35, 48, 83, 'Toby Okeke', 0, '201702', 0, 0, 0, 3, 2, '2017-01-17 15:38:36', '2017-01-17 15:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `setid` int(11) NOT NULL,
  `semesterCode` varchar(255) NOT NULL,
  `academicYear` varchar(255) NOT NULL,
  `semesterNumber` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setid`, `semesterCode`, `academicYear`, `semesterNumber`, `created_at`, `updated_at`) VALUES
(1, '201702', '2016/2017', 2, '2017-01-11 14:53:35', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `sid` int(11) NOT NULL,
  `studentid` varchar(50) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `othernames` varchar(255) NOT NULL,
  `society` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','','') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `level` varchar(3) NOT NULL,
  `session` varchar(255) NOT NULL,
  `progid` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isDefaultPassword` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `studentid`, `surname`, `othernames`, `society`, `email`, `gender`, `nationality`, `level`, `session`, `progid`, `phone`, `password`, `isDefaultPassword`, `created_at`, `updated_at`) VALUES
(1, '02110113', 'Toby Okeke', '', 'Stott', 'toby.okeke@regent.edu.gh', 'Male', '', '', '', 3, '0230955038', 'Tobyokeke1', 1, '2017-01-10 10:56:48', '0000-00-00 00:00:00'),
(2, '02260113', 'benjamin asare', '', 'ubuntu', 'benjamin.asare@gmail.com', 'Male', '', '', '', 3, '0241234987', '1234567', 1, '2017-01-10 11:00:17', '0000-00-00 00:00:00'),
(13, '02232223', 'St Patrick', 'James', 'Stott', 'james@stpatrick.com', 'Male', 'American', '100', 'MORNING', 3, '0980909090', 'SCYFIA', 1, '2017-01-14 11:21:07', '2017-01-14 11:21:07'),
(16, '02201102', 'Oluwola', 'James', 'Ubuntu', 'oluwola@regent.com', 'Male', 'Nigerian', '300', 'MORNING', 3, '0244422282', '7L2hIU', 1, '2017-01-14 12:04:33', '2017-01-14 12:04:33'),
(17, '02202233', 'Ben', 'Asante', 'Stott', 'ben@asante.com', 'Female', 'Ghanaian', '100', 'EVENING', 4, '0882323', 'kZo6xa', 1, '2017-01-14 12:04:33', '2017-01-14 12:04:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `lid` (`lid`);

--
-- Indexes for table `depts`
--
ALTER TABLE `depts`
  ADD PRIMARY KEY (`did`),
  ADD KEY `fid` (`fid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`progid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`cmid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`resid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `progid` (`progid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `depts`
--
ALTER TABLE `depts`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `progid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `cmid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `resid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `lecturers` (`lid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `depts`
--
ALTER TABLE `depts`
  ADD CONSTRAINT `depts_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `faculty` (`fid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`did`) REFERENCES `depts` (`did`);

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `students` (`sid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`progid`) REFERENCES `programs` (`progid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
