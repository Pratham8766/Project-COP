-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 31, 2021 at 10:33 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16934540_cmcop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(7) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `middle name` varchar(100) NOT NULL,
  `last name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile number` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first name`, `middle name`, `last name`, `dob`, `email`, `mobile number`, `address`, `password`) VALUES
(1234, 'akshat', 'A.', 'uike', '1989-02-04', 'someone@gmail.com', 9999999999, '124, nagpur', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` text DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `downloads` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `name`, `title`, `subject`, `body`, `size`, `time`, `due_date`, `downloads`) VALUES
(1, 'course regitration.pdf', 'dqdqd', 'CM201E', '', 77959, '2021-06-09 11:22:50', '0000-00-00', 0x30),
(2, 'exam form.pdf', 'dqdqd', 'CM403E', '', 167005, '2021-06-09 11:23:40', '0000-00-00', 0x32),
(3, NULL, 'Submmit Practicals ASAP', 'CM505E', '', NULL, '2021-07-02 16:11:57', '2021-07-06', NULL),
(4, 'unit3.pdf', 'Assignment 3', 'CM505E', 'Submit it before the due date to avoid marks deduction.', 937795, '2021-07-02 17:53:18', '2021-07-14', 0x30),
(5, NULL, 'DETENTION LIST FOR CM505E', 'cm505e', '9999999, 1813045, 1813062, 1813003,                     ', NULL, '2021-07-03 04:38:00', NULL, NULL),
(6, 'Project COP for Mini Project.pdf', 'Assignment 3', 'CM406E', 'Submit ASAP.', 91270, '2021-07-03 04:44:53', '2021-07-08', 0x31),
(7, 'unit1.pdf', 'Assignment 3', 'CM505E', 'submit before 4/7/21', 907726, '2021-07-03 05:13:16', '2021-07-04', 0x30);

-- --------------------------------------------------------

--
-- Table structure for table `cancelled_classes`
--

CREATE TABLE `cancelled_classes` (
  `day` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `Timeslot` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cancelled_classes`
--

INSERT INTO `cancelled_classes` (`day`, `Timeslot`, `Course_id`, `date`) VALUES
('Wednesday', '12-13', 'CM415E', '2021-06-09'),
('Wednesday', '9-10', 'CM409E', '2021-06-09'),
('Friday', '9-10', 'CM301E', '2021-06-11'),
('Saturday', '9-10', 'CM411E', '2021-07-03'),
('Saturday', '12-13', 'CM503E', '2021-07-03'),
('Saturday', '10-11', 'CM505E', '2021-07-03'),
('Sunday', '16-17', 'CM505E', '2021-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(6) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `teacher_id` int(7) NOT NULL,
  `credits` int(2) NOT NULL,
  `semester` int(11) NOT NULL,
  `classes` int(11) DEFAULT 0,
  `lecture` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `teacher_id`, `credits`, `semester`, `classes`, `lecture`) VALUES
('AM301E', 'Engineering Mechanics', 5, 5, 2, 0, 11),
('CH202E', 'Applied Chemistry', 6, 5, 2, 0, 11),
('CM201E', 'Computer Fundamentals', 5, 2, 1, 0, 1),
('CM301E', 'Computer Workshop', 2, 2, 1, 0, 1),
('CM302E', 'Computer Network', 5, 5, 3, 0, 11),
('CM401E', 'Programming In C', 2, 5, 3, 0, 11),
('CM402E', 'Object Oriented Programming', 2, 5, 4, 0, 11),
('CM403E', 'Data Structure', 1, 5, 4, 0, 11),
('CM404E', 'Operating System', 5, 4, 5, 0, 11),
('CM405E', 'Computer Communication', 4, 3, 4, 2, 10),
('CM406E', 'Relational Database Management System', 1, 5, 3, 0, 11),
('CM407E', 'Microprocessor', 4, 4, 4, 0, 11),
('CM408E', 'Computer Security', 6, 3, 3, 0, 10),
('CM409E', 'Linux Administration', 1, 5, 6, 1, 11),
('CM410E', 'E-commerce', 3, 3, 6, 1, 10),
('CM411E', 'System Analysis & Design', 1, 5, 6, 3, 11),
('CM412E', 'Computer Hardware And Maintenance', 3, 2, 4, 0, 1),
('CM413E', 'Web Page Design', 3, 2, 3, 0, 1),
('CM414E', 'Software Project Management', 3, 2, 3, 0, 1),
('CM415E', 'Industrial Project', 4, 2, 6, 1, 1),
('CM503E', 'Database Administration', 1, 4, 5, 0, 11),
('CM505E', 'Web Programming', 1, 4, 6, 7, 11),
('EC308E', 'Principal Of Electronics', 6, 5, 3, 0, 11),
('EC310E', 'Digital Technique', 5, 4, 4, 0, 11),
('EE303E', 'Electrical Engineering', 5, 5, 2, 0, 11),
('EN101E', 'English', 5, 4, 1, 0, 11),
('EN102E', 'Communication Skills', 4, 4, 2, 0, 11),
('EV101E', 'Environmental Science', 3, 2, 1, 0, 10),
('FE504E', 'Hobby Electronics', 5, 2, 2, 0, 1),
('FS501E', 'Finishing School', 6, 2, 6, 2, 1),
('ID401E', 'Industrial Training', 4, 1, 5, 0, 1),
('IT402E', 'Java Programming', 2, 5, 5, 0, 11),
('IT406E', 'Software Engineering', 4, 5, 5, 0, 11),
('IT501E', 'Advance Java', 1, 5, 6, 14, 11),
('ME302E', 'Engineering Graphics', 5, 4, 4, 0, 11),
('MH201E', 'Engineering Mathematics', 6, 5, 1, 0, 10),
('MH203E', 'Applied Mathematics', 5, 5, 2, 0, 10),
('MN101E', 'Industrial Management', 6, 4, 5, 0, 10),
('PH201E', 'Engineering Physics', 5, 5, 1, 0, 11),
('RD101E', 'Rural Development', 6, 1, 2, 0, 1),
('SE401E', 'Seminar', 5, 1, 5, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses old`
--

CREATE TABLE `courses old` (
  `course_id` varchar(6) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `teacher_id` int(7) NOT NULL,
  `credits` int(2) NOT NULL,
  `semester` int(11) NOT NULL,
  `classes` int(11) DEFAULT 0,
  `lecture` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses old`
--

INSERT INTO `courses old` (`course_id`, `course_name`, `teacher_id`, `credits`, `semester`, `classes`, `lecture`) VALUES
('am301e', 'engineering mechanics', 5678, 5, 2, 0, 11),
('ch202e', 'applied chemistry', 5678, 5, 2, 0, 11),
('cm201e', 'computer fundamentals', 5678, 2, 1, 0, 1),
('cm301e', 'computer workshop', 5678, 2, 1, 0, 1),
('cm302e', 'computer network', 5678, 5, 3, 0, 11),
('cm401e', 'programming in c', 5678, 5, 3, 0, 11),
('cm402e', 'object oriented programming', 5678, 5, 4, 0, 11),
('cm403e', 'data structure', 5678, 5, 4, 0, 11),
('cm404e', 'operating system', 5678, 4, 5, 0, 11),
('cm405e', 'computer communication', 5678, 3, 4, 2, 10),
('cm406e', 'relational database management system', 5678, 5, 3, 0, 11),
('cm407e', 'microprocessor', 5678, 4, 4, 0, 11),
('cm408e', 'computer security', 5678, 3, 3, 0, 10),
('cm409e', 'linux administration', 1234, 5, 6, 0, 11),
('cm410e', 'e-commerce', 1234, 3, 6, 0, 10),
('cm411e', 'system analysis & design', 1234, 5, 6, 0, 11),
('cm412e', 'computer hardware and maintenance', 4567, 2, 4, 0, 1),
('cm413e', 'web page design', 5678, 2, 3, 0, 1),
('cm414e', 'software project management', 5678, 2, 3, 0, 1),
('cm415e', 'industrial project', 1234, 2, 6, 1, 1),
('cm503e', 'database administration', 5678, 4, 5, 0, 11),
('cm505e', 'web programming', 1234, 4, 6, 0, 11),
('ec308e', 'principal of electronics', 5678, 5, 3, 0, 11),
('ec310e', 'digital technique', 5678, 4, 4, 0, 11),
('ee303e', 'electrical engineering', 5678, 5, 2, 0, 11),
('en101e', 'english', 5678, 4, 1, 0, 0),
('en102e', 'communication skills', 5678, 4, 2, 0, 0),
('ev101e', 'environmental science', 5678, 2, 1, 0, 0),
('fe504e', 'hobby electronics', 5678, 2, 2, 0, 0),
('fs501e', 'finishing school', 5678, 2, 6, 0, 0),
('id401e', 'industrial training', 5678, 1, 5, 0, 0),
('it402e', 'java programming', 5678, 5, 5, 0, 0),
('it406e', 'software engineering', 5678, 5, 5, 0, 0),
('it501e', 'advance java', 5678, 5, 6, 2, 0),
('me302e', 'engineering graphics', 5678, 4, 4, 0, 0),
('mh201e', 'engineering mathematics', 5678, 5, 1, 0, 0),
('mh203e', 'applied mathematics', 5678, 5, 2, 0, 0),
('mn101e', 'industrial management', 5678, 4, 5, 0, 0),
('ph201e', 'engineering physics', 4567, 5, 1, 0, 0),
('rd101e', 'rural development', 5678, 1, 2, 0, 0),
('se401e', 'seminar', 5678, 1, 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `course_reg`
--

CREATE TABLE `course_reg` (
  `enroll` int(10) NOT NULL,
  `course1` varchar(6) DEFAULT NULL,
  `course2` varchar(6) DEFAULT NULL,
  `course3` varchar(6) DEFAULT NULL,
  `course4` varchar(6) DEFAULT NULL,
  `course5` varchar(6) CHARACTER SET utf8mb4 DEFAULT NULL,
  `course6` varchar(6) DEFAULT NULL,
  `course7` varchar(6) DEFAULT NULL,
  `course8` varchar(6) DEFAULT NULL,
  `course9` varchar(6) DEFAULT NULL,
  `course10` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_reg`
--

INSERT INTO `course_reg` (`enroll`, `course1`, `course2`, `course3`, `course4`, `course5`, `course6`, `course7`, `course8`, `course9`, `course10`) VALUES
(1813003, 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', NULL, NULL, NULL),
(1813014, 'PH201E', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1813021, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1813045, 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', NULL, NULL, NULL),
(1813048, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1813049, 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', NULL, NULL, NULL),
(1813050, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1813052, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1813062, 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', NULL, NULL, NULL),
(1913007, 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', NULL, NULL, NULL),
(1913013, 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', NULL, NULL, NULL),
(1913016, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1913030, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1913043, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9999999, 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `extra_classes`
--

CREATE TABLE `extra_classes` (
  `day` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `Timeslot` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `Course_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `extra_classes`
--

INSERT INTO `extra_classes` (`day`, `Timeslot`, `Course_id`, `date`) VALUES
('Wednesday', '12-13', 'CM411E', '2021-06-09'),
('Friday', '10-11', 'SE401E', '2021-06-11'),
('Friday', '11-12', 'SE401E', '2021-06-11'),
('Saturday', '9-10', 'CM505E', '2021-07-03'),
('Wednesday', '9-10', 'CM409E', '2021-11-24');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `course_id` varchar(6) CHARACTER SET utf8mb4 NOT NULL,
  `teacher_id` int(7) NOT NULL,
  `q1` int(1) NOT NULL,
  `q2` int(1) NOT NULL,
  `q3` int(1) NOT NULL,
  `q4` int(1) NOT NULL,
  `q5` int(1) NOT NULL,
  `q6` int(1) NOT NULL,
  `q7` int(1) NOT NULL,
  `q8` int(1) NOT NULL,
  `q9` int(1) NOT NULL,
  `suggestions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course_id` varchar(6) NOT NULL,
  `unit` int(2) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` blob NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `name`, `course_id`, `unit`, `size`, `downloads`, `upload_date`) VALUES
(4, 'UNIT V.pdf', 'CM403E', 1, 222943, 0x35, '2021-06-09'),
(5, 'Unit III.pdf', 'CM403E', 3, 366878, 0x32, '2021-06-09'),
(6, 'course regitration.pdf', 'CM403E', 2, 77959, 0x31, '2021-06-09'),
(7, 'Unit I Introduction to PHP.pdf', 'CM505E', 1, 979807, 0x32, '2021-07-02'),
(8, 'Unit II.pdf', 'CM505E', 2, 439875, 0x31, '2021-07-02'),
(9, 'Unit III.pdf', 'CM505E', 3, 429959, 0x30, '2021-07-02'),
(10, 'UNIT V.pdf', 'CM505E', 5, 222970, 0x30, '2021-07-02'),
(11, 'UNIT VI.pdf', 'CM505E', 6, 209593, 0x30, '2021-07-02'),
(12, 'UNIT VI.pdf', 'CM505E', 6, 209593, 0x30, '2021-07-02'),
(13, 'Web_php Curriculum.pdf', 'CM505E', 1, 430120, 0x31, '2021-07-03'),
(14, 'unit1.pdf', 'CM403E', 4, 907726, 0x31, '2021-07-03'),
(15, 'unit1.pdf', 'CM505E', 4, 907726, 0x31, '2021-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` blob NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `name`, `subject`, `body`, `size`, `downloads`, `time`) VALUES
(1, 'Linux.pdf', 'progress seminar', 'progress seminar on 20th may', 435715, 0x31, '2021-05-23 10:21:21'),
(9, 'FinishingSchool.pdf', 'Scholarship', 'Submit the form correctly', 67675, 0x32, '2021-06-01 09:50:01'),
(28, 'exam form.pdf', 'Exam form', 'Fill exam form before 14-06-21', 167005, 0x34, '2021-06-09 07:52:40'),
(29, 'NSIC-AI&ML workshop.pdf', 'NSIC-AI&MLWorkshop', '', 173947, 0x30, '2021-07-02 16:17:26'),
(30, 'unit1.pdf', 'Exam form', '', 907726, 0x30, '2021-07-03 04:42:05'),
(31, 'A LABORATORY MANUAL FOR PHP.pdf', 'Exam form', 'Submit it ASAP', 295041, 0x30, '2021-07-03 05:12:06');

-- --------------------------------------------------------

--
-- Table structure for table `pending_req`
--

CREATE TABLE `pending_req` (
  `enrollment` int(7) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `middle name` varchar(100) NOT NULL,
  `last name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile number` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `semester` int(11) NOT NULL,
  `req_status` int(11) NOT NULL DEFAULT 0,
  `req_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `sr` int(11) NOT NULL,
  `enrollment` int(7) NOT NULL,
  `course_name` varchar(6) NOT NULL,
  `Assignment_1` int(3) NOT NULL DEFAULT 0,
  `Assignment_2` int(3) NOT NULL DEFAULT 0,
  `Practical_1` int(3) NOT NULL DEFAULT 0,
  `Practical_2` int(3) NOT NULL DEFAULT 0,
  `Practical_3` int(3) NOT NULL DEFAULT 0,
  `PT_1` int(3) NOT NULL DEFAULT 0,
  `PT_2` int(3) NOT NULL DEFAULT 0,
  `Final_Theory` int(3) NOT NULL DEFAULT 0,
  `attendance` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`sr`, `enrollment`, `course_name`, `Assignment_1`, `Assignment_2`, `Practical_1`, `Practical_2`, `Practical_3`, `PT_1`, `PT_2`, `Final_Theory`, `attendance`) VALUES
(68, 9999999, 'CM409E', 9, 0, 0, 0, 0, 0, 0, 0, 1),
(69, 9999999, 'CM410E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(70, 9999999, 'CM411E', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(71, 9999999, 'CM415E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(72, 9999999, 'CM505E', 0, 0, 8, 8, 9, 0, 0, 0, 1),
(73, 9999999, 'FS501E', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(74, 9999999, 'IT501E', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(75, 1813045, 'CM409E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 1813045, 'CM410E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 1813045, 'CM411E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 1813045, 'CM415E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 1813045, 'CM505E', 0, 0, 4, 4, 6, 0, 0, 0, 2),
(80, 1813045, 'FS501E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(81, 1813045, 'IT501E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(82, 1913013, 'CM402E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(83, 1913013, 'CM403E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(84, 1913013, 'CM405E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 1913013, 'CM407E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 1913013, 'CM412E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(87, 1913013, 'EC310E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 1913013, 'ME302E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(89, 1813062, 'CM409E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(90, 1813062, 'CM410E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(91, 1813062, 'CM411E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(92, 1813062, 'CM415E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(93, 1813062, 'CM505E', 0, 0, 7, 4, 8, 0, 0, 0, 1),
(94, 1813062, 'FS501E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(95, 1813062, 'IT501E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(96, 1913007, 'CM402E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 1913007, 'CM403E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(98, 1913007, 'CM405E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(99, 1913007, 'CM407E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(100, 1913007, 'CM412E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(101, 1913007, 'EC310E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(102, 1913007, 'ME302E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(103, 1813014, 'PH201E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(111, 1813003, 'CM409E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(112, 1813003, 'CM410E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(113, 1813003, 'CM411E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(114, 1813003, 'CM415E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(115, 1813003, 'CM505E', 0, 0, 9, 9, 9, 0, 0, 0, 1),
(116, 1813003, 'FS501E', 0, 0, 0, 0, 0, 0, 0, 0, 0),
(117, 1813003, 'IT501E', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `enrollment` int(7) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `middle name` varchar(100) NOT NULL,
  `last name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile number` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `batch` text NOT NULL,
  `semester` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`enrollment`, `first name`, `middle name`, `last name`, `dob`, `email`, `mobile number`, `address`, `password`, `batch`, `semester`) VALUES
(1813003, 'aryan', 'MAHENDRA', 'VORA', '2002-08-11', '1813003@gmail.com', 987654321, 'Hno1109, near paras ghee bhandar, itwari bhaji mandi, nagpur 440002', 'pass123', 'a', 6),
(1813014, 'Anup', 'Ajay', 'Dudhane', '2002-02-09', 'anupdudhane23416@gmail.com', 7709435993, 'Nagpur', 'Anup14', 'A', 6),
(1813021, 'parimal', 'dhananjay', 'joshi', '2021-05-21', 'parimaljoshi@gmail', 987654321, 'mahal,nagpur', 'abc', 'b', 6),
(1813045, 'Parth ', 'Prashant', 'Upgade', '2002-12-15', 'upgadeparth@gmail.com', 7499754608, 'Pl. No. 69, kirti nagar, new nandanwan, Nagpur 09', 'parth@123', 'B', 6),
(1813048, 'pushkar', 'prasad', 'pophali', '2011-05-11', 'someone@gmail.com', 987654321, 'mahal,nagpur', 'pass123', 'c', 6),
(1813049, 'Pratham', 'Vinay', 'Gajbhiye', '2021-05-21', 'pratham@gmail.com', 9807654321, 'chandrapur', 'pratham', 'c', 6),
(1813050, 'Vishal', 'D', 'Rothe', '2002-12-14', 'vishal@gmail.com', 9562874130, 'Akola', 'abcd', 'c', 6),
(1813052, 'harsh', 'rajesh', 'singh', '2021-05-13', 'hrs@gmail.com', 987654321, 'Hno1109, near paras ghee bhandar, itwari bhaji mandi, nagpur 440002', 'hrs@123', 'c', 6),
(1813062, 'Yash', '', 'Wankhedkar', '2002-05-10', 'yashwankhedkar43@gmail.com', 9561295320, 'Plot no.6 jawaharmal Joshi layout 3rd bus stop gopal nagar nagpur', 'letmein', 'C', 6),
(1913007, 'Pranay', 'Shankarrao', 'Chavhan', '2001-04-08', 'chavhanpranay48@gmail.com', 7774860123, 'At post pophali', 'Pranay@7774860123', '', 4),
(1913013, 'Gunjan', 'Yadaorao', 'Galbale', '2003-11-29', 'gunjangalbale29@gmail.com', 9307838062, 'At. Deutwada Ta.Warud Dist.Amaravti', '1913013', 'A', 4),
(1913016, 'Shwetank ', 'Sanjay', 'Gopnarayan', '2003-06-10', 'kabgop02@gmail.com', 7420873164, 'Malkapur, Akola', 'Kabir02@', '2', 4),
(1913030, 'Tejaswini', 'Anil', 'Mankar', '2003-03-22', '1913030', 8080874089, 'Naik road, mahal, nagpur', 'tejaswini@2003', '', 4),
(1913043, 'Mrunali', 'Sunil', 'Rangankar', '2001-01-23', 'monarangankar23@gmail.com', 9850157529, 'Deshmukh Wadi,Wani Yavatmal', '1913043', 'I', 4),
(9999999, 'testacc', 'test', 'test', '2003-06-19', 'test@gmail.com', 9999999999, 'abc,nagpur', 'test123', 'a', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(7) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `middle name` varchar(100) NOT NULL,
  `last name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile number` bigint(10) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `first name`, `middle name`, `last name`, `dob`, `email`, `mobile number`, `address`, `password`) VALUES
(1, 'Akshat', 'A.', 'Uike', '2011-05-11', 'someone@gmail.com', 9999999999, 'Opposite NIT Garden, Shankar Nagar, Dharampeth, Nagpur', 'pass123'),
(2, 'sumit', 'A.', 'Khatri', '2002-11-02', 'sumit@gmail.com', 9999921211, 'Bhaktivihar Apartment, Shop No. 19, 20 & 21 Bhaktivihar Apartment Central Avenue Chhapru Nagar Chowk, Chapru Square, Queta Colony, Lakadganj, Nagpur, Maharashtra 440008', 'pass123'),
(3, 'Supriya', '', 'Mete', '2000-01-01', 'example@gmail.com', 9999999999, 'Unknown', 'pass123'),
(4, 'Arif', '', 'Rehman', '2000-01-01', 'example@gmail.com', 9999999999, 'unknown', 'pass123'),
(5, 'dhanashree', '', 'shirkey', '2000-01-01', 'example@gmail.com', 9999999999, 'unknown', 'pass123'),
(6, 'Chaitali', '', 'Chaudhari', '2000-01-01', 'example@gmail.com', 9999999999, 'unknown', 'pass123');

-- --------------------------------------------------------

--
-- Table structure for table `tt1`
--

CREATE TABLE `tt1` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt1`
--

INSERT INTO `tt1` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `tt2`
--

CREATE TABLE `tt2` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt2`
--

INSERT INTO `tt2` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `tt3`
--

CREATE TABLE `tt3` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt3`
--

INSERT INTO `tt3` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `tt4`
--

CREATE TABLE `tt4` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt4`
--

INSERT INTO `tt4` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Monday', 'B', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Monday', 'C', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Tuesday', 'A', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Tuesday', 'B', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Tuesday', 'C', 'CM402E', 'CM403E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM407E'),
('Wednesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'B', 'CM403E', 'CM407E', 'CM405E', 'CM412E', 'CM402E', 'EC310E', 'ME302E', 'CM405E', 'CM407E'),
('Wednesday', 'C', 'CM403E', 'CM407E', 'CM405E', 'CM412E', 'CM402E', 'EC310E', 'ME302E', 'CM405E', 'CM407E'),
('Thursday', 'A', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM412E'),
('Thursday', 'B', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM412E'),
('Thursday', 'C', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM403E', 'CM412E'),
('Friday', 'A', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM402E', 'CM407E'),
('Friday', 'B', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM402E', 'CM407E'),
('Friday', 'C', 'CM403E', 'CM402E', 'CM405E', 'CM407E', 'CM412E', 'EC310E', 'ME302E', 'CM402E', 'CM407E'),
('Saturday', 'A', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM403E', 'CM402E', 'ME302E', 'EC310E', 'CM412E'),
('Saturday', 'B', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM403E', 'CM402E', 'ME302E', 'EC310E', 'CM412E'),
('Saturday', 'C', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM403E', 'CM402E', 'ME302E', 'EC310E', 'CM412E'),
('Sunday', 'A', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM402E', 'CM407E', 'CM405E', 'CM402E', 'EC310E'),
('Sunday', 'B', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM402E', 'CM407E', 'CM405E', 'CM402E', 'EC310E'),
('Sunday', 'C', 'EC310E', 'ME302E', 'CM407E', 'CM405E', 'CM402E', 'CM407E', 'CM405E', 'CM402E', 'EC310E');

-- --------------------------------------------------------

--
-- Table structure for table `tt5`
--

CREATE TABLE `tt5` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt5`
--

INSERT INTO `tt5` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Monday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Tuesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Wednesday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Thursday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Friday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Saturday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'A', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'B', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL'),
('Sunday', 'C', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Table structure for table `tt6`
--

CREATE TABLE `tt6` (
  `day` varchar(9) NOT NULL,
  `batch` varchar(1) NOT NULL,
  `9-10` varchar(6) DEFAULT NULL,
  `10-11` varchar(6) DEFAULT NULL,
  `11-12` varchar(6) DEFAULT NULL,
  `12-13` varchar(6) DEFAULT 'RECCES',
  `13-14` varchar(6) DEFAULT NULL,
  `14-15` varchar(6) DEFAULT NULL,
  `15-16` varchar(6) DEFAULT NULL,
  `16-17` varchar(6) DEFAULT NULL,
  `17-18` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tt6`
--

INSERT INTO `tt6` (`day`, `batch`, `9-10`, `10-11`, `11-12`, `12-13`, `13-14`, `14-15`, `15-16`, `16-17`, `17-18`) VALUES
('Monday', 'A', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM410E'),
('Monday', 'B', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM410E'),
('Monday', 'C', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM410E'),
('Tuesday', 'A', 'CM410E', 'CM409E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM415E'),
('Tuesday', 'B', 'CM410E', 'CM409E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM415E'),
('Tuesday', 'C', 'CM410E', 'CM409E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM415E'),
('Wednesday', 'A', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM505E'),
('Wednesday', 'B', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM505E'),
('Wednesday', 'C', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM409E', 'CM505E'),
('Thursday', 'A', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM411E', 'IT501E'),
('Thursday', 'B', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM411E', 'IT501E'),
('Thursday', 'C', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM411E', 'IT501E'),
('Friday', 'A', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM411E', 'CM505E'),
('Friday', 'B', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM411E', 'CM505E'),
('Friday', 'C', 'CM409E', 'CM410E', 'CM411E', 'CM415E', 'CM505E', 'FS501E', 'IT501E', 'CM411E', 'CM505E'),
('Saturday', 'A', 'CM411E', 'CM505E', 'CM409E', 'CM410E', 'CM505E', 'FS501E', 'IT501E', 'CM505E', 'CM411E'),
('Saturday', 'B', 'CM411E', 'CM505E', 'CM409E', 'CM410E', 'CM505E', 'FS501E', 'IT501E', 'CM505E', 'CM411E'),
('Saturday', 'C', 'CM411E', 'CM505E', 'CM409E', 'CM410E', 'CM505E', 'FS501E', 'IT501E', 'CM505E', 'CM411E'),
('Sunday', 'A', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM505E', 'CM415E'),
('Sunday', 'B', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM505E', 'CM415E'),
('Sunday', 'C', 'IT501E', 'FS501E', 'CM505E', 'CM415E', 'CM411E', 'CM410E', 'CM409E', 'CM505E', 'CM415E');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courses_ibfk_1` (`teacher_id`);

--
-- Indexes for table `courses old`
--
ALTER TABLE `courses old`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courses_ibfk_1` (`teacher_id`);

--
-- Indexes for table `course_reg`
--
ALTER TABLE `course_reg`
  ADD PRIMARY KEY (`enroll`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_req`
--
ALTER TABLE `pending_req`
  ADD PRIMARY KEY (`enrollment`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`sr`),
  ADD KEY `course_name` (`course_name`),
  ADD KEY `enrollment` (`enrollment`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`enrollment`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tt1`
--
ALTER TABLE `tt1`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- Indexes for table `tt2`
--
ALTER TABLE `tt2`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- Indexes for table `tt3`
--
ALTER TABLE `tt3`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- Indexes for table `tt4`
--
ALTER TABLE `tt4`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- Indexes for table `tt5`
--
ALTER TABLE `tt5`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- Indexes for table `tt6`
--
ALTER TABLE `tt6`
  ADD KEY `timetable1_ibfk_1` (`9-10`),
  ADD KEY `timetable1_ibfk_2` (`10-11`),
  ADD KEY `timetable1_ibfk_3` (`11-12`),
  ADD KEY `timetable1_ibfk_4` (`13-14`),
  ADD KEY `timetable1_ibfk_5` (`15-16`),
  ADD KEY `timetable1_ibfk_6` (`16-17`),
  ADD KEY `timetable1_ibfk_8` (`14-15`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `sr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_reg`
--
ALTER TABLE `course_reg`
  ADD CONSTRAINT `course_reg_ibfk_1` FOREIGN KEY (`enroll`) REFERENCES `students` (`enrollment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses old` (`course_id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`course_name`) REFERENCES `courses old` (`course_id`),
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`enrollment`) REFERENCES `course_reg` (`enroll`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
