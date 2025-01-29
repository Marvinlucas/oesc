-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 06:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) NOT NULL,
  `option_id` int(10) NOT NULL,
  `examinee_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `date_taken` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `option_id`, `examinee_id`, `exam_id`, `date_taken`) VALUES
(3, 3, 6, 30, '2022-11-21 22:40:21.540801'),
(4, 6, 6, 30, '2022-11-21 22:40:21.543412'),
(5, 12, 6, 30, '2022-11-21 22:40:21.545148'),
(6, 18, 6, 30, '2022-11-21 22:40:21.546892'),
(7, 35, 6, 30, '2022-11-21 22:40:21.548883'),
(12, 45, 8, 33, '2022-11-24 01:17:30.257798'),
(13, 50, 8, 33, '2022-11-24 01:17:30.279333'),
(14, 54, 8, 33, '2022-11-24 01:17:30.281564'),
(15, 60, 8, 33, '2022-11-24 01:17:30.283911'),
(16, 63, 8, 33, '2022-11-24 01:17:30.286321'),
(17, 45, 9, 33, '2022-11-24 01:48:14.575498'),
(18, 50, 9, 33, '2022-11-24 01:48:14.577999'),
(19, 54, 9, 33, '2022-11-24 01:48:14.580071'),
(20, 60, 9, 33, '2022-11-24 01:48:14.582125'),
(21, 63, 9, 33, '2022-11-24 01:48:14.585354'),
(22, 45, 10, 33, '2022-11-24 01:49:14.596961'),
(23, 50, 10, 33, '2022-11-24 01:49:14.599440'),
(24, 54, 10, 33, '2022-11-24 01:49:14.601571'),
(25, 60, 10, 33, '2022-11-24 01:49:14.603344'),
(26, 63, 10, 33, '2022-11-24 01:49:14.604967'),
(27, 0, 11, 33, '2022-11-24 05:34:24.670967'),
(28, 0, 11, 33, '2022-11-24 05:34:24.675487'),
(29, 0, 11, 33, '2022-11-24 05:34:24.678773'),
(30, 0, 11, 33, '2022-11-24 05:34:24.681917'),
(32, 45, 12, 33, '2022-11-24 06:22:43.159244'),
(33, 50, 12, 33, '2022-11-24 06:22:43.162258'),
(34, 54, 12, 33, '2022-11-24 06:22:43.164422'),
(35, 60, 12, 33, '2022-11-24 06:22:43.166579'),
(36, 63, 12, 33, '2022-11-24 06:22:43.169724'),
(37, 45, 13, 33, '2022-11-24 06:29:24.104894'),
(38, 50, 13, 33, '2022-11-24 06:29:24.108794'),
(39, 0, 13, 33, '2022-11-24 06:29:24.111719'),
(40, 60, 13, 33, '2022-11-24 06:29:24.114474'),
(41, 0, 13, 33, '2022-11-24 06:29:24.117808'),
(42, 45, 14, 34, '2022-11-24 06:32:11.121060'),
(43, 0, 14, 34, '2022-11-24 06:32:11.124065'),
(44, 0, 14, 34, '2022-11-24 06:32:11.127227');

-- --------------------------------------------------------

--
-- Table structure for table `examinees`
--

CREATE TABLE `examinees` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `date_created` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `examinees`
--

INSERT INTO `examinees` (`id`, `name`, `date_created`) VALUES
(12, 'marvs', '2022-11-24 05:43:51.027635'),
(13, 'a', '2022-11-24 06:25:39.857221'),
(14, 'a', '2022-11-24 06:31:58.750108'),
(15, 'a', '2022-11-24 13:03:49.983608');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `course` varchar(50) NOT NULL,
  `points` int(10) NOT NULL,
  `no_questions` int(10) NOT NULL,
  `examiner` int(10) NOT NULL,
  `time_limit` int(6) NOT NULL COMMENT 'minutes',
  `schedule` datetime(6) NOT NULL,
  `link` varchar(50) NOT NULL,
  `date_created` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `title`, `description`, `course`, `points`, `no_questions`, `examiner`, `time_limit`, `schedule`, `link`, `date_created`) VALUES
(33, 'Test A', 'This is an open book examination; there are 11 pages.', 'BSCE', 1, 5, 11, 5, '2022-11-24 01:14:00.000000', 'u4oMuBeP', '2022-11-24 01:15:16.153894'),
(34, ' Test B', ' Please lang galingan niyo', ' BSCE', 1, 3, 11, 2, '2022-11-24 06:31:00.000000', '5e9uHkwI', '2022-11-24 06:31:33.017151');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

CREATE TABLE `exam_question` (
  `id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_question`
--

INSERT INTO `exam_question` (`id`, `exam_id`, `question_id`) VALUES
(4, 7, 2),
(14, 33, 19),
(15, 33, 20),
(16, 33, 21),
(17, 33, 22),
(18, 33, 23),
(19, 34, 19),
(20, 34, 20),
(21, 34, 21);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) NOT NULL,
  `option_text` varchar(150) NOT NULL,
  `is_answer` tinyint(1) NOT NULL,
  `question_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_text`, `is_answer`, `question_id`) VALUES
(19, 'sda', 0, 6),
(20, 'sdads', 1, 6),
(45, 'A.  Military engineering ', 1, 19),
(46, 'B.  Environmental engineering', 0, 19),
(47, 'C.  Earthquake engineering', 0, 19),
(48, 'D.  Coastal engineering', 0, 19),
(49, 'A.  Appian Way', 0, 20),
(50, 'B.  Egyptian pyramids ', 1, 20),
(51, 'C.  Irrigation in Rome', 0, 20),
(52, 'D.  Qanat', 0, 20),
(53, 'A.  Side', 0, 21),
(54, 'B.  Header', 1, 21),
(55, 'C.  Stretcher', 0, 21),
(56, 'D.  Front', 0, 21),
(57, 'A.  Less than 0.15%', 0, 22),
(58, 'B.  2% – 4%', 0, 22),
(59, 'C.  0.08%', 0, 22),
(60, 'D.  0.002% – 2.1% ', 1, 22),
(61, 'A.  General Chang', 0, 23),
(62, 'B.  General Feng', 0, 23),
(63, 'C.  General Meng', 1, 23),
(64, 'D.  General Chung', 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) NOT NULL,
  `question_text` varchar(100) NOT NULL,
  `date_created` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `date_created`) VALUES
(19, 'All of these except one work in close collaboration with civil engineering.', '2022-11-24 01:03:46.291930'),
(20, 'Which of these buildings is the oldest work of civil engineers?', '2022-11-24 01:04:45.618087'),
(21, 'The 9 cm x 9 cm side of a brick, as seen in the wall face, is generally known as', '2022-11-24 01:06:07.750052'),
(22, 'The carbon content of steel is:', '2022-11-24 01:07:39.246272'),
(23, 'Who coordinated the construction of the Great Wall of China?', '2022-11-24 01:11:17.371764');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = admin, 2 = faculty',
  `course` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `date_updated` date NOT NULL,
  `date_created` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `type`, `course`, `username`, `password`, `status`, `date_updated`, `date_created`) VALUES
(1, 'admin', 1, '', 'admin', 'admin', 1, '2022-11-05', '2022-11-21 00:33:42.789654'),
(11, 'Angelo', 2, 'BSCE', 'angelo', 'angelo', 1, '2022-11-24', '2022-11-24 00:59:51.960327');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `examinees`
--
ALTER TABLE `examinees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `examinees`
--
ALTER TABLE `examinees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
