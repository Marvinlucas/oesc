-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 03:45 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
(7, 35, 6, 30, '2022-11-21 22:40:21.548883');

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
(1, 'sample', '2022-11-21 00:32:11.619728'),
(2, 'Floki', '2022-11-21 00:32:11.619728'),
(3, 'olygf', '2022-11-21 00:32:11.619728'),
(4, 'wael', '2022-11-21 00:32:11.619728'),
(5, 'Ben', '2022-11-21 00:32:11.619728'),
(6, 'User', '2022-11-21 22:39:20.225561');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
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
(1, 'General', 'Random', 'BS IT', 1, 15, 3, 1, '2022-11-18 10:35:00.000000', '8783dOJd', '2022-11-21 00:31:37.848825'),
(30, 'New Exam', 'Sample Exam', 'BS IT', 1, 5, 3, 1, '2022-11-20 22:34:00.000000', 'lVpWiRDk', '2022-11-21 22:35:45.719242'),
(31, '', '', '', 0, 0, 0, 0, '0000-00-00 00:00:00.000000', 'WdcKcWvb', '2022-11-22 17:35:54.884379');

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
(1, 1, 1),
(2, 1, 2),
(3, 7, 1),
(4, 7, 2),
(5, 30, 1),
(6, 30, 2),
(8, 30, 5);

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
(1, 'aabba', 0, 1),
(2, 'baba', 1, 1),
(3, 'ka', 0, 1),
(4, 'da', 0, 1),
(9, 'apple', 0, 3),
(10, 'banana', 0, 3),
(11, 'cucumber', 0, 3),
(12, 'dog', 1, 3),
(15, 'mroon 5', 0, 5),
(16, 'voltes 5', 0, 5),
(17, 'hi 5', 0, 5),
(18, '555', 1, 5),
(19, 'sda', 0, 6),
(20, 'sdads', 1, 6),
(31, '1', 0, 14),
(32, '2', 0, 14),
(33, '3', 0, 14),
(34, '4', 0, 14),
(35, '5', 1, 14);

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
(1, 'New ', '2022-11-07 07:25:30.256817'),
(3, 'question3', '2022-11-21 07:25:30.256817'),
(5, 'Question 5', '2022-02-09 07:25:30.256817'),
(14, 'Question 5', '2022-11-21 22:35:02.505188');

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
(2, 'fgd', 0, 'fds', 'dfssdf', 'sdfsdf', 1, '0000-00-00', '2022-11-21 00:33:42.789654'),
(3, 'Jane Foster', 2, 'BS CS', 'jane', 'jane', 1, '2022-11-07', '2022-11-21 00:33:42.789654'),
(6, 'Jan Wary', 2, 'BS CS', 'jan', 'jan', 1, '2022-11-21', '2022-04-07 06:54:50.892424'),
(7, 'Feb Wary', 2, 'BS IT', 'feb', 'feb', 1, '2022-11-21', '2022-09-01 06:55:42.371376'),
(8, 'New examiners', 2, 'BS CS', 'news', 'new', 1, '2022-11-21', '2022-11-21 22:41:34.978205');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `examinees`
--
ALTER TABLE `examinees`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
