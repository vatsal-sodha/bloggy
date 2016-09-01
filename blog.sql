-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2016 at 06:06 PM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogger_info`
--

CREATE TABLE `blogger_info` (
  `blogger_id` int(11) NOT NULL,
  `blogger_firstname` varchar(20) NOT NULL,
  `blogger_username` varchar(255) NOT NULL,
  `blogger_password` varchar(255) NOT NULL,
  `blogger_creation_date` date NOT NULL,
  `blogger_is_active` tinyint(1) NOT NULL,
  `blogger_updated_Date` date DEFAULT NULL,
  `blogger_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogger_info`
--

INSERT INTO `blogger_info` (`blogger_id`, `blogger_firstname`, `blogger_username`, `blogger_password`, `blogger_creation_date`, `blogger_is_active`, `blogger_updated_Date`, `blogger_end_date`) VALUES
(4, 'Vatsal', 'vatsalsodha150297@gmail.com', 'vatsalsodha', '2016-07-26', 1, NULL, NULL),
(6, 'Sodha', 'vincent', 'vatsal', '2016-08-07', 1, NULL, NULL),
(7, 'Jaydeep', 'jayda', 'vatsal', '2016-08-12', 1, NULL, NULL),
(8, 'vinee', 'vineet', 'jha', '2016-08-23', 0, NULL, NULL),
(9, 'Vatsal', 'vatsal', 'vatsal', '2016-08-24', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_detail`
--

CREATE TABLE `blog_detail` (
  `blog_Detail_id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `blog_detail_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_detail`
--

INSERT INTO `blog_detail` (`blog_Detail_id`, `blog_id`, `blog_detail_image`) VALUES
(22, 34, 'images/mistake.jpg'),
(23, 34, 'images/mistake.jpg'),
(24, 34, 'images/mistake.jpg'),
(25, 35, 'images/mistake.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_master`
--

CREATE TABLE `blog_master` (
  `blog_id` int(11) NOT NULL,
  `blogger_id` int(11) NOT NULL,
  `blog_title` varchar(100) NOT NULL,
  `blog_desc` varchar(10000) NOT NULL,
  `blog_category` varchar(100) NOT NULL,
  `blog_author` varchar(50) NOT NULL,
  `blog_is_active` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  `updated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_master`
--

INSERT INTO `blog_master` (`blog_id`, `blogger_id`, `blog_title`, `blog_desc`, `blog_category`, `blog_author`, `blog_is_active`, `creation_date`, `updated_date`) VALUES
(34, 9, 'Vatsal', '              We are committing many mistakes unknowingly, but they prove to be very destructive in future. Even if we have knowledge about that mistakes, we will commit it, because itâ€™s basic human nature. So whatâ€™s the solution for these mistakes? The solution is, we need to change our view towards that mistakes(more on that later). Many such mistakes are:\r\n\r\nWe do compare!\r\nYes! We compare our success, wealth, marks, and the list is very long. What it brings in our mind is Negativity , and even sometimes hinders us from the happiness of our own achievements.\r\nWhat we need to do is, we need to compare the amount of time, effort given by that person in achieving particular success. Then ask yourself, did I invested same amount of time on that field ? Sometimes what happens is we were comparing ourselves with one who had achieved success in the field, which is of not our interest even! Itâ€™s like an engineer comparing his success with a doctor !', 'Philosophy', 'vatsal', 1, '2016-08-24', '2016-08-24'),
(35, 6, 'Incomplete Tasks!', '      We do compare!\r\nYes! We compare our success, wealth, marks, and the list is very long. What it brings in our mind is Negativity , and even sometimes hinders us from the happiness of our own achievements.\r\nWhat we need to do is, we need to compare the amount of time, effort given by that person in achieving particular success. Then ask yourself, did I invested same amount of time on that field ? Sometimes what happens is we were comparing ourselves with one who had achieved success in the field, which is of not our interest even! Itâ€™s like an engineer comparing his success with a doctor !', 'Philosophy', 'vincent', 1, '2016-08-24', '2016-08-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogger_info`
--
ALTER TABLE `blogger_info`
  ADD PRIMARY KEY (`blogger_id`);

--
-- Indexes for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD PRIMARY KEY (`blog_Detail_id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `blog_master`
--
ALTER TABLE `blog_master`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blogger_id` (`blogger_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogger_info`
--
ALTER TABLE `blogger_info`
  MODIFY `blogger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `blog_detail`
--
ALTER TABLE `blog_detail`
  MODIFY `blog_Detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `blog_master`
--
ALTER TABLE `blog_master`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_detail`
--
ALTER TABLE `blog_detail`
  ADD CONSTRAINT `blog_detail_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog_master` (`blog_id`);

--
-- Constraints for table `blog_master`
--
ALTER TABLE `blog_master`
  ADD CONSTRAINT `blog_master_ibfk_1` FOREIGN KEY (`blogger_id`) REFERENCES `blogger_info` (`blogger_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
