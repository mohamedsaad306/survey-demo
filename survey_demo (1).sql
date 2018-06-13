-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 05:43 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `survey_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`id` int(11) NOT NULL,
  `answerString` varchar(255) NOT NULL,
  `questionId` int(11) NOT NULL,
  `surveyId` int(11) NOT NULL,
  `answerCount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answerString`, `questionId`, `surveyId`, `answerCount`) VALUES
(1, 'very good', 5, 11, 5),
(2, 'good', 5, 11, 23),
(3, 'fair', 5, 11, 13),
(4, 'poor', 5, 11, 1),
(5, 'very poor', 5, 11, 6),
(6, 'very good', 6, 11, 5),
(7, 'good', 6, 11, 0),
(8, 'fair', 6, 11, 0),
(9, 'poor', 6, 11, 1),
(10, 'very poor', 6, 11, 1),
(11, 'very good', 7, 11, 5),
(12, 'good', 7, 11, 0),
(13, 'fair', 7, 11, 0),
(14, 'poor', 7, 11, 1),
(15, 'very poor', 7, 11, 1),
(16, 'very good', 8, 11, 6),
(17, 'good', 8, 11, 3),
(18, 'fair', 8, 11, 0),
(19, 'poor', 8, 11, 1),
(20, 'very poor', 8, 11, 1),
(21, 'very good', 9, 11, 5),
(22, 'good', 9, 11, 4),
(23, 'fair', 9, 11, 0),
(24, 'poor', 9, 11, 1),
(25, 'very poor', 9, 11, 1),
(26, 'very good', 10, 11, 5),
(27, 'good', 10, 11, 0),
(28, 'fair', 10, 11, 0),
(29, 'poor', 10, 11, 1),
(30, 'very poor', 10, 11, 1),
(31, 'very good', 11, 11, 5),
(32, 'good', 11, 11, 0),
(33, 'fair', 11, 11, 0),
(34, 'poor', 11, 11, 1),
(35, 'very poor', 11, 11, 1),
(36, 'very good', 12, 7, 0),
(37, 'good', 12, 7, 0),
(38, 'fair', 12, 7, 0),
(39, 'poor', 12, 7, 0),
(40, 'very poor', 12, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
`id` int(11) NOT NULL,
  `questionString` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`id` int(11) NOT NULL,
  `questionStringEN` varchar(255) CHARACTER SET utf8 NOT NULL,
  `questionStringAR` varchar(255) CHARACTER SET utf8 NOT NULL,
  `surveyId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `questionStringEN`, `questionStringAR`, `surveyId`) VALUES
(1, 'English  for s1 ', 'arabic for s1 ', 1),
(2, '2 English  for s1 ', ' 2  arabic for s1 ', 1),
(5, 'English string ', 'arabic String ', 11),
(6, 'English string  2 ', 'arabic String 2 ', 11),
(7, '1', '2', 11),
(8, '3', '4', 11),
(9, 'eng question test refresh 1', 'arabic question test refresh 1', 11),
(10, 'asd', 'ssssssss', 11),
(11, 'this was empty ', 'yea it was empty ', 11),
(12, 'Question 1 ', 'Question  1 Arabic ', 7);

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE IF NOT EXISTS `surveys` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `isPublished` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `description`, `isPublished`) VALUES
(7, 'this is a new survey from page ', '', 1),
(8, 'this is a new survey from page ', '', 1),
(9, 'this is a new survey from page  venom ', '', 1),
(10, 'this is a new survey from page  venom ', '', 1),
(11, 'VoiLA Survey Created ', '', 1),
(13, 'this is a new survey from page  (2)', '', 1),
(14, 'this is a new survey from page  (3)', '', 1),
(15, 'this is a new survey from page  (5)', '', 1),
(16, 'this is a new survey from page  (4)', '', 1),
(17, 'this is a new survey from page  (4)', '', 1),
(18, 'refresh test survey ', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usersanswers`
--

CREATE TABLE IF NOT EXISTS `usersanswers` (
`id` int(11) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `surveyId` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersanswers`
--

INSERT INTO `usersanswers` (`id`, `userId`, `surveyId`, `comment`) VALUES
(11, '2', 11, ''),
(12, '', 0, ''),
(13, '3', 11, ''),
(14, '4', 11, ''),
(15, '5', 11, 'this is the first comment'),
(16, '22', 11, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersanswers`
--
ALTER TABLE `usersanswers`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `usersanswers`
--
ALTER TABLE `usersanswers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
