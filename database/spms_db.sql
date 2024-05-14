-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 11:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = admin',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(15) DEFAULT 0,
  `dept` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`, `user_id`, `dept`) VALUES
(0, 'Admin', 'admin', 'admin@admin', 'a3175a452c7a8fea80c62a198a40f6c9', 1, 'no-image-available.png', '2024-04-12 16:29:47', 20221054, 1),
(1, 'Ankan', 'Das', 'ankan@admin', '1602185733f4b41f2013709b5ed04c68', 1, '1712750760_ankan.png', '2024-04-10 18:06:09', 20221057010, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `year` text NOT NULL,
  `semester` text NOT NULL,
  `sec` text NOT NULL,
  `dept` int(11) NOT NULL,
  `student_ids` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `year`, `semester`, `sec`, `dept`, `student_ids`) VALUES
(10, '2024', 'Spring', 'B', 1, '42,9,43,8,6'),
(11, '2023', 'Spring', 'A', 1, '62'),
(12, '2023', 'Fall', 'A', 2, NULL),
(13, '2024', 'Fall', 'A', 3, NULL),
(14, '2022', 'Spring', 'B', 1, NULL),
(15, '2022', 'Spring', 'D', 1, NULL),
(16, '2022', 'Fall', 'A', 1, NULL),
(17, '2019', 'Spring', 'A', 1, '90'),
(18, '2017', 'Spring', 'A', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_code` text NOT NULL,
  `course_title` varchar(255) NOT NULL,
  `course_credits` double NOT NULL,
  `dept` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_code`, `course_title`, `course_credits`, `dept`, `class_id`, `manager_id`, `type`) VALUES
(1, 'CSE-1101', 'Computer Basic and Programming', 3, 1, 14, 4, 1),
(2, 'CSE-1102', 'Computer Basics and Programming Laboratory', 2, 1, 14, 4, 2),
(3, 'Math-1131', 'Engineering Mathematics-I', 3, 1, 14, 0, 1),
(4, 'EEE-1221', 'Basic Electrical Circuit', 3, 2, 13, 0, 1),
(8, 'CSE-2101', 'Object Oriented Programing', 3, 1, 11, 2, 1),
(9, 'CSE-2202', 'Numerical Analysis Laboratory ', 1.5, 1, 0, 3, 2),
(10, 'CSE-3108', 'Internet Programming Laboratory', 0.75, 1, 10, 3, 2),
(11, 'CSE-2200', 'Software Engerning Lab- I', 1.75, 1, 12, 2, 1),
(13, ' CSE-3105', ' Theory of Computation', 3, 1, 10, 0, 1),
(14, 'HUM-3141', 'Engineering Echonmics and Accounting', 3, 2, 18, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam_marks`
--

CREATE TABLE `exam_marks` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `exam_title` varchar(100) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_marks`
--

INSERT INTO `exam_marks` (`id`, `student_id`, `project_id`, `exam_title`, `marks`) VALUES
(112, 8, 8, 'lab_1', 1),
(113, 6, 8, 'lab_1', 1),
(114, 44, 8, 'lab_1', 1),
(115, 42, 8, 'lab_1', 1),
(116, 58, 8, 'lab_1', 1),
(117, 9, 8, 'lab_1', 1),
(118, 43, 8, 'lab_1', 1),
(119, 7, 8, 'lab_1', 1),
(120, 15, 8, 'lab_1', 1),
(121, 8, 9, 'mid', 15),
(122, 6, 9, 'mid', 17),
(123, 9, 9, 'mid', 18),
(124, 8, 8, 'lab_3', 4),
(125, 6, 8, 'lab_3', 1),
(126, 44, 8, 'lab_3', 5),
(127, 42, 8, 'lab_3', 4),
(128, 58, 8, 'lab_3', 2),
(129, 9, 8, 'lab_3', 3),
(130, 43, 8, 'lab_3', 6),
(131, 7, 8, 'lab_3', 5),
(132, 15, 8, 'lab_3', 4),
(133, 8, 9, 'ct_4', 5),
(134, 6, 9, 'ct_4', 5),
(135, 9, 9, 'ct_4', 6),
(136, 8, 10, 'ct_1', 5),
(137, 6, 10, 'ct_1', 4),
(138, 42, 10, 'ct_1', 12),
(139, 9, 10, 'ct_1', 4),
(140, 85, 10, 'ct_1', 5),
(141, 43, 10, 'ct_1', 6),
(142, 15, 10, 'ct_1', 8),
(143, 8, 10, 'ct_2', 9),
(144, 6, 10, 'ct_2', 8),
(145, 42, 10, 'ct_2', 4),
(146, 9, 10, 'ct_2', 5),
(147, 85, 10, 'ct_2', 6),
(148, 43, 10, 'ct_2', 7),
(149, 15, 10, 'ct_2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `avatar` text NOT NULL,
  `dept` text NOT NULL,
  `designation` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT 2,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `firstname`, `lastname`, `user_id`, `avatar`, `dept`, `designation`, `email`, `password`, `type`, `datecreated`) VALUES
(2, 'M.', 'Raihan', 10004, '1712946420_M. Raihan.jpg', '1', '2', 'mri@ins', '893a779cc30555392a1097f01cc57376', 2, '2024-04-12 18:28:08'),
(3, 'A. K. Z Rasel', 'Rahman', 10012, '1712862600_A. K. Z Rasel Rahman.jpg', '1', '4', 'arr@ins', '3431fd2bbc2f29308ef515bce75d713b', 2, '2024-04-11 19:10:40'),
(4, 'Md. Shymon', 'Islam', 10009, '1712946300_Md. Shymon Islam.jpg', '1', '4', 'msi@ins', '70e8c4946fea8e67f59fbe5e82bc17fd', 2, '2024-04-12 18:25:43'),
(5, 'Sagar', 'Kundu', 20014, '1712947140_Sagar Kundu.jpg', '3', '4', 'sku@ins', 'f91909b1ebf048b9693a4c449bdf42dc', 2, '2024-04-12 18:39:58'),
(6, 'Tajul', 'Islam', 10003, '', '1', '2', 'tji@ins', 'e2c0a3937094a86f3e34debc80d98d56', 2, '2024-04-20 16:07:08'),
(7, 'Md. Mahedi', 'Hasan', 1005, '1714189440_Md. Mahedi Hasan.jpg', '1', '3', 'mah@ins', 'b3d1e799bb45dba5bd8d3f4b508be590', 2, '2024-04-27 03:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `student_id` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `exam_title` text NOT NULL,
  `mark` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `student_id`, `project_id`, `exam_title`, `mark`) VALUES
(21, '8', 8, '', 45),
(22, '6', 8, '', 55),
(23, '44', 8, '', 60),
(24, '42', 8, '', 65),
(25, '58', 8, '', 70),
(26, '14', 8, '', 65),
(27, '9', 8, '', 80),
(28, '43', 8, '', 85),
(29, '7', 8, '', 90),
(30, '15', 8, '', 95),
(31, '8', 9, '', 6),
(32, '6', 9, '', 6),
(33, '9', 9, '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL,
  `user_ids` longtext NOT NULL,
  `course_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `user_ids`, `course_ids`, `date_created`) VALUES
(8, 'IP Lab - B', '																														internet programing lab section two															', 2, '2024-04-01', '2024-05-30', 3, '42,9,43,8,6,15,58,7,44', '10', '2024-04-12 15:21:46'),
(9, 'NWU WhiteHats', 'it is a icpc team', 1, '2024-04-01', '2024-04-30', 2, '9,8,6', '8', '2024-04-14 16:42:55'),
(10, 'Software Engineering LAB', '												Demo Team										', 5, '2024-05-01', '2024-06-01', 3, '42,9,43,8,85,6,15', '11', '2024-05-14 01:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = admin, 2 = instractor,3 = student',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `s_id` bigint(12) DEFAULT NULL,
  `dept` int(11) NOT NULL DEFAULT 0 COMMENT '1 = CSE , 2= EEE, 3 = CE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`, `s_id`, `dept`) VALUES
(6, 'Pranto', 'Mallick', 'pranto@std', '90f5d52346a1764d8d1840e55403e9aa', 3, '1709578860_1709578861902.jpg', '2024-03-05 01:01:52', 20221047010, 1),
(7, 'Shuvo', 'Saha', 'shuvo@student', 'd1adbdafb0b0c0982d6355890e13256e', 3, '1709578920_1709578861880.jpg', '2024-03-05 01:02:37', 20221076010, 1),
(8, 'Faria Afrin', 'Labonno', 'labonno@student', 'a0b54ee33e8f726d90e0862e1f9edfd6', 3, '1709579160_labonno.PNG', '2024-03-05 01:06:59', 20221045010, 1),
(9, 'Ankan', 'Das', 'ankan@std', '1602185733f4b41f2013709b5ed04c68', 3, '1709579940_1708858570905.jpg', '2024-03-05 01:19:36', 20221057010, 0),
(15, 'Puza', 'Roy', 'puza@student', 'd0b1262176ff8079b39aecbaa355d74e', 3, '1709675460_1709578861891.jpg', '2024-03-06 03:51:33', 20221077010, 1),
(42, 'Amrin Islam', 'Ripa', 'ripa@std', 'f780b8f6884095ddd5bc9d12ab9b3ff5', 3, '1710009300_1710009076612.jpg', '2024-03-10 00:35:40', 20221050010, 1),
(43, 'Dalia Mim', 'Luna', 'mim@student', 'c73c27960985cb7846e8c85705569bc4', 3, '1710009900_1710009076604.jpg', '2024-03-10 00:45:05', 20221070010, 1),
(44, 'Tanzil Pervez', 'Fardin', 'fardin@student', '57cc584fd2816dba4b49de987f4f3417', 3, '1710009960_1710009076596.png', '2024-03-10 00:46:59', 20221049010, 1),
(58, 'Rakib', 'Md', 'rakib@student', '00af255798aa9121928ba75bf719af27', 3, '1712704260_nwu.png', '2024-04-10 05:11:11', 20221052010, 1),
(62, 'Suchona', 'Voumika', 'suchona@std', '3cf29152efb0dc445f62eb779573fc5c', 3, 'no-image-available.png', '2024-04-15 15:15:57', 20221055010, 1),
(63, 'Touhidul', 'Sojib', 'sojib@std', '658555d83fb4f174097435aacbe45169', 3, '1713182220_1712945040_IMG_3455.jpg', '2024-04-15 17:57:19', 20221053010, 1),
(85, 'Hasibul Hasan', 'Santo', 'santo@std', '4e8439a115131b5503ae3aac9a00e812', 3, 'no-image-available.png', '2024-04-16 00:38:19', 20221068010, 1),
(86, 'Mohsina', 'Yasmin', 'mohsina@std', 'ce59f017dd7c9df57251c250b1ff4020', 3, 'no-image-available.png', '2024-04-16 01:14:21', 20221075010, 1),
(89, 'Md Rashedul', 'Islam', 'rashedul@std', '50cca6bdd3b2a70665983e71522e3c2b', 3, 'no-image-available.png', '2024-04-20 22:07:48', 20221061010, 1),
(90, 'MD. Mehedee', 'Hasan', 'mehedee@std', 'af691c3be23108129caccff1d1af6c4b', 3, 'no-image-available.png', '2024-04-27 09:39:55', 20221048010, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Student Progress Management System', 'info@sample.comm', '+8801745009934', 'sonadanga,khulna', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `t_marks` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `description`, `status`, `t_marks`, `date_created`) VALUES
(9, 8, 'login page should be added ', '				every one have to add login system in their project			', 3, 5, '2024-04-20 22:18:32'),
(10, 10, 'Sign Up page should be added in font page', '				dome description			', 3, 10, '2024-05-14 02:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `s_id` bigint(11) DEFAULT NULL,
  `dept` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`, `s_id`, `dept`) VALUES
(9, 'Ankan', 'Das', 'ankan@admin', '1602185733f4b41f2013709b5ed04c68', 1, '1709579940_1708858570905.jpg', '2024-03-05 01:19:36', 20221057010, 0),
(50, 'Anaa', ' uom', 'milacib567@newcu', 'c78c80ca5bd4515b42911f215fa05b49', 3, 'no-image-available.png', '2024-03-29 23:43:39', 202145104010, 0),
(55, 'Ankadnd', 'dwd', 'ad25wp@admin', '359dcfc56bad4d26a2e56a4d441e5e45', 1, 'no-image-available.png', '2024-03-30 00:03:53', 20221093251, 0),
(56, 'Ankadnd', 'dwd', 'awp@admin', 'b162dc157b9756f72a5bf0b46f862e97', 3, 'no-image-available.png', '2024-03-30 00:25:15', 20228093251, 0),
(58, 'Rakib', 'Md', 'rakib@student', '00af255798aa9121928ba75bf719af27', 3, '1712704260_nwu.png', '2024-04-10 05:11:11', 20221052010, 1),
(59, 'yogab ', ' uom', 'rel3@v.com', 'e62e3a286f8c3edd4c54621aa6ff8a17', 3, '1712742360_info.png', '2024-04-10 15:46:10', 2022100010, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `status` int(10) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_productivity`
--

INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `status`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
(10, 8, 9, 'Login page&amp;nbsp; created .', 2, '2024-05-13', '00:22:00', '04:22:00', 6, 4, '2024-05-14 00:22:51'),
(11, 8, 9, 'DONE', 3, '2024-05-14', '00:24:00', '02:24:00', 1, 2, '2024-05-14 00:24:12'),
(14, 8, 9, 'INSTRATOR Test', 2, '2024-11-01', '01:36:00', '00:37:00', 3, -0.983333, '2024-05-14 00:36:33'),
(15, 10, 10, 'Signup page added successfully ..', 3, '2024-05-14', '02:02:00', '03:02:00', 6, 1, '2024-05-14 02:03:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s_id` (`user_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`) USING HASH;

--
-- Indexes for table `exam_marks`
--
ALTER TABLE `exam_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_ids` (`user_ids`) USING HASH;

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `exam_marks`
--
ALTER TABLE `exam_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
