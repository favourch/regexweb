-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2017 at 04:42 PM
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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cmid` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sid` int(11) NOT NULL,
  `fromLecturer` tinyint(1) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `depts`
--

CREATE TABLE IF NOT EXISTS `depts` (
  `did` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `depts`
--

INSERT INTO `depts` (`did`, `name`, `fid`) VALUES
(1, 'INFORMATICS', 1),
(2, 'ENGINEERING', 1),
(3, 'ACCOUNTING AND FINANCE', 2),
(4, 'MANAGEMENT STUDIES', 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `fid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `name`) VALUES
(1, 'SIET'),
(2, 'SBL'),
(3, 'FAS');

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
  `photo` varchar(1000) DEFAULT NULL,
  `role` enum('Lecturer','Admin','Supervisor','HOD','Dean') DEFAULT NULL,
  `resultsUploaded` int(11) NOT NULL DEFAULT '0',
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `did` int(11) NOT NULL,
  `lastLogin` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lid`, `staffid`, `name`, `qualification`, `phone`, `email`, `photo`, `role`, `resultsUploaded`, `password`, `remember_token`, `did`, `lastLogin`, `created_at`, `updated_at`) VALUES
(4, '02110113', 'Toby Okeke', 'Phd', '02911221323', 'toby.okeke@regent.edu.gh', 'http://localhost/projects/regex/public/uploads/profilePics/dirtsitelogo.png', 'HOD', 0, '$2a$04$.I3N2CHyjXGBO8JYMDGSCe2mjyfKwrHV.K5BincooDDh6i87ylaU2', 'B3amvw5S7pz5KZ2lTGp4fTsLRcYqQtIkNV22c6CJNt3cYtEhSl2ID4isYnqU', 1, '2017-03-31 13:40:37', '2017-03-31 14:40:37', '2017-03-31 13:40:37'),
(5, '02110114', 'Mr Sowah', 'Masters', '+233269527587', 'sowah@regent.edu.gh', NULL, 'Admin', 0, '$2a$04$.I3N2CHyjXGBO8JYMDGSCe2mjyfKwrHV.K5BincooDDh6i87ylaU2', NULL, 1, NULL, '2017-03-31 14:41:31', '2017-02-09 14:12:07'),
(6, '02110115', 'Dr Paul Obeng', 'PHD', '+233208151793', 'paul.obeng@regent.edu.gh', NULL, 'Dean', 0, '$2a$04$.I3N2CHyjXGBO8JYMDGSCe2mjyfKwrHV.K5BincooDDh6i87ylaU2', 'uSZTh3DKoUc52gwYlTWUozErIa8jCAdKIVR1pwLITzwIEraE8ygjI4aLldsD', 1, '2017-02-14 13:10:09', '2017-03-31 14:41:36', '2017-02-14 13:10:47'),
(7, '02110116', 'Dr Chris Quist', 'PHD', '+233243533599 ', 'samuel.quist@regent.edu.gh', 'http://localhost/projects/regex/public/uploads/profilePics/IMG_0070.JPG', 'HOD', 0, '$2a$04$.I3N2CHyjXGBO8JYMDGSCe2mjyfKwrHV.K5BincooDDh6i87ylaU2', 'l9Y5oz6waCyKDCQJaJgHh8XAg0XlrYbrYd8mzuzjxJlAtiMgShAGnoBUckrY', 1, '2017-03-16 11:26:25', '2017-03-31 14:41:38', '2017-03-16 13:51:19'),
(8, '02110117', 'Dilys Dickson', 'PHD', '+233244933392', 'dilys.dickson@regent.edu.gh', 'http://localhost/projects/regex/public/uploads/profilePics/IMG_0983.JPG', 'Lecturer', 0, '$2a$04$.I3N2CHyjXGBO8JYMDGSCe2mjyfKwrHV.K5BincooDDh6i87ylaU2', 'OhkBArOhUBXM7HNWfQSnmJNtYzaFKpS8csOmsqQWgXcAxsJMnKvUQh42mo6T', 1, '2017-03-17 09:05:42', '2017-03-31 14:41:43', '2017-03-17 09:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `mid` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`progid`, `progname`, `did`, `created_at`, `updated_at`) VALUES
(3, 'BSc. INFORMATION SYSTEMS SCIENCES', 1, '2017-01-10 10:54:57', '0000-00-00 00:00:00'),
(4, 'BSc. COMPUTER SCIENCE', 1, '2017-01-10 10:54:57', '0000-00-00 00:00:00'),
(5, 'Management with Econs', 3, '2017-02-13 18:54:32', '0000-00-00 00:00:00'),
(8, 'ACCOUNTING WITH INFORMATION SYSTEMS', 3, '2017-03-16 12:04:31', '0000-00-00 00:00:00'),
(9, 'BANKING AND FINANCE', 3, '2017-03-16 12:04:31', '0000-00-00 00:00:00'),
(10, 'BUSINESS ADMINISTRATION', 3, '2017-03-16 12:04:56', '0000-00-00 00:00:00'),
(11, 'MANAGEMENT WITH COMPUTING', 4, '2017-03-16 12:06:17', '0000-00-00 00:00:00'),
(12, 'ECONOMICS WITH COMPUTING', 4, '2017-03-16 12:06:17', '0000-00-00 00:00:00'),
(13, 'BEng. APPLIED ELECTRONICS AND SYSTEMS ENGINEERING', 2, '2017-03-16 12:14:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `resulthistory`
--

CREATE TABLE IF NOT EXISTS `resulthistory` (
  `rhid` int(11) NOT NULL,
  `studentid` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `staffID` varchar(255) NOT NULL,
  `lecturerName` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `courseLevel` varchar(10) NOT NULL,
  `courseSemester` varchar(255) NOT NULL,
  `attendance` int(11) NOT NULL,
  `midsem` int(11) NOT NULL,
  `ca` int(11) NOT NULL,
  `examscore` int(11) NOT NULL,
  `totalgrade` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `batchNumber` int(11) NOT NULL,
  `downloadUrl` varchar(1000) NOT NULL,
  `isHodApproved` enum('0','1','2') NOT NULL DEFAULT '0',
  `isDeanApproved` enum('0','1','2') NOT NULL DEFAULT '0',
  `isStudentNotified` tinyint(1) NOT NULL DEFAULT '0',
  `isEdited` tinyint(1) NOT NULL DEFAULT '0',
  `cid` int(10) unsigned NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `lid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `gender` enum('Male','Female') NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `level` varchar(3) NOT NULL,
  `session` varchar(255) NOT NULL,
  `progid` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `isDefaultPassword` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`cmid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `did` (`did`),
  ADD KEY `did_2` (`did`);

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
  ADD PRIMARY KEY (`lid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `sender` (`sender`),
  ADD KEY `reciever` (`reciever`);

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
-- Indexes for table `resulthistory`
--
ALTER TABLE `resulthistory`
  ADD PRIMARY KEY (`rhid`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`resid`),
  ADD KEY `cid` (`cid`),
  ADD KEY `results_ibfk_1` (`sid`),
  ADD KEY `lid` (`lid`),
  ADD KEY `cid_2` (`cid`),
  ADD KEY `lid_2` (`lid`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `studentid` (`studentid`),
  ADD KEY `progid` (`progid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `cmid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `depts`
--
ALTER TABLE `depts`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `progid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `resulthistory`
--
ALTER TABLE `resulthistory`
  MODIFY `rhid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `resid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`lid`) REFERENCES `lecturers` (`lid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`did`) REFERENCES `depts` (`did`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `depts`
--
ALTER TABLE `depts`
  ADD CONSTRAINT `depts_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `faculty` (`fid`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`did`) REFERENCES `depts` (`did`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `lecturers` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_3` FOREIGN KEY (`reciever`) REFERENCES `lecturers` (`lid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`did`) REFERENCES `depts` (`did`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`lid`) REFERENCES `lecturers` (`lid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`progid`) REFERENCES `programs` (`progid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
