-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 09:40 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adashe`
--
CREATE DATABASE IF NOT EXISTS `adashe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `adashe`;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE IF NOT EXISTS `agents` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `agent_name` varchar(35) NOT NULL,
  `contact_address` text NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`sno`, `agent_name`, `contact_address`, `phone_no`, `email`, `password`) VALUES
(1, 'Longji J Panse ', 'FLC, Jos', '09166312527', 'longjipanse@gmail.com', 'a'),
(2, 'Innocent Mangut', 'Light MFB Jos', '123', 'innocentmangut@gmail.com', 'a'),
(3, 'John Snow', 'Light MFB Jos', '09166312527', 'ljpanse@me.com', 'a'),
(7, 'John Doe', 'FLC Jos', '07057239848', 'johndoe@hotmail.com', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `rcc_id` varchar(9) NOT NULL,
  `lcc_name` text NOT NULL,
  `group_name` text NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`sno`, `rcc_id`, `lcc_name`, `group_name`) VALUES
(1, '1', 'COCIN LCC WILDLIFE PARK, JOS', 'Seed for Growth'),
(2, '1', 'LCC Wildlife Park', 'Youth for Christ');

-- --------------------------------------------------------

--
-- Stand-in structure for view `groups_view`
--
CREATE TABLE IF NOT EXISTS `groups_view` (
`sno` int(11)
,`group_name` text
,`lcc_name` text
,`rcc_id` varchar(9)
,`rcc_name` varchar(35)
,`agent_id` int(11)
,`agent_name` varchar(35)
,`agent_email` varchar(45)
);
-- --------------------------------------------------------

--
-- Table structure for table `group_position`
--

CREATE TABLE IF NOT EXISTS `group_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `group_position`
--

INSERT INTO `group_position` (`id`, `position`) VALUES
(1, 'Chairman'),
(2, 'Record Keeper'),
(3, 'Box Keeper'),
(4, 'Member'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `interest_payments`
--

CREATE TABLE IF NOT EXISTS `interest_payments` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(9) NOT NULL,
  `loan_id` varchar(9) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `trx_date` date NOT NULL,
  `month` varchar(12) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE IF NOT EXISTS `loans` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(9) NOT NULL,
  `loan_id` varchar(9) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `trx_date` date NOT NULL,
  PRIMARY KEY (`sno`),
  UNIQUE KEY `loan_id` (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE IF NOT EXISTS `loan_repayments` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(9) NOT NULL,
  `loan_id` varchar(9) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `trx_date` date NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(9) NOT NULL,
  `member_name` varchar(65) NOT NULL,
  `contact_address` text NOT NULL,
  `phone_no` varchar(13) NOT NULL,
  `email` varchar(45) NOT NULL,
  `role_in_group` int(1) NOT NULL,
  `password` varchar(56) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`sno`, `group_id`, `member_name`, `contact_address`, `phone_no`, `email`, `role_in_group`, `password`) VALUES
(1, '1', 'John Doe', 'Flc Jos', '1234567', 'me@you.com', 2, 'a'),
(2, '2', 'Rebecca Dung', '11th avenue Federal Lowcost Jos', '1234567', 'me@you1.com', 4, ''),
(3, '1', 'Longji Toomtom', 'FLC', '01', 'longjipanse@gmail.com', 5, 'abc'),
(4, '2', 'Chinplang Dawus', 'FLC Jos', '01', 'chinplang@gmail.com', 2, 'abc'),
(5, '2', 'Jessica Gombin', 'FLC Jos', '01', 'jessica@gmail.com', 1, ''),
(6, '2', 'Nanrin Nzing', 'FLC', '01', 'nanzing@gmail.com', 3, ''),
(7, '2', 'Young Man', 'FLC', '01', 'young@gmail.com', 4, ''),
(8, '2', 'Nanbol Lar', 'FLC', '01', 'nanbol@gmail.com', 4, ''),
(9, '1', 'Tongak Tongak', 'FLC', '01', 'tongak@gmail.com', 1, ''),
(10, '1', 'Yohana Musa', 'FLC', '01', 'yohanna@gmail.com', 3, 'a');

-- --------------------------------------------------------

--
-- Stand-in structure for view `member_view`
--
CREATE TABLE IF NOT EXISTS `member_view` (
`sno` int(11)
,`member_name` varchar(65)
,`contact_address` text
,`phone_no` varchar(13)
,`email` varchar(45)
,`password` varchar(56)
,`role_in_group` int(1)
,`position` varchar(25)
,`group_id` varchar(9)
,`group_name` text
,`lcc_name` text
,`rcc_id` varchar(9)
,`rcc_name` varchar(35)
,`agent_id` int(11)
,`agent_name` varchar(35)
);
-- --------------------------------------------------------

--
-- Table structure for table `rccs`
--

CREATE TABLE IF NOT EXISTS `rccs` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `rcc_name` varchar(35) NOT NULL,
  `rcc_location` text NOT NULL,
  `agent_id` int(11) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rccs`
--

INSERT INTO `rccs` (`sno`, `rcc_name`, `rcc_location`, `agent_id`) VALUES
(1, 'Dadin Kowa', 'RCC Headquaters, Rantya Jos', 1),
(2, 'Gigiring', 'Gigiring, Hwolshe, Jos', 2),
(3, 'Abbatoir', 'Abbatoir', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rccs_view`
--
CREATE TABLE IF NOT EXISTS `rccs_view` (
`sno` int(11)
,`rcc_name` varchar(35)
,`rcc_location` text
,`agent_id` int(11)
,`agent_name` varchar(35)
,`agent_email` varchar(45)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `rcc_view`
--
CREATE TABLE IF NOT EXISTS `rcc_view` (
`sno` int(11)
,`rcc_name` varchar(35)
,`rcc_location` text
,`agent_id` int(11)
,`agent_name` varchar(35)
);
-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE IF NOT EXISTS `shares` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `welfare` double(11,2) NOT NULL,
  `member_id` varchar(9) NOT NULL,
  `trx_date` date NOT NULL,
  `no_of_shares` tinyint(4) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `shares`
--

INSERT INTO `shares` (`sno`, `welfare`, `member_id`, `trx_date`, `no_of_shares`) VALUES
(1, 200.00, '1', '2023-01-03', 5),
(2, 200.00, '3', '2023-01-03', 2),
(3, 200.00, '2', '2022-12-28', 5),
(4, 200.00, '4', '2022-12-28', 5),
(5, 200.00, '7', '2022-12-28', 2),
(6, 200.00, '6', '2022-12-28', 5),
(7, 200.00, '8', '2022-12-28', 4),
(8, 200.00, '2', '2023-01-04', 4),
(9, 200.00, '4', '2023-01-04', 4),
(10, 200.00, '5', '2023-01-04', 5),
(11, 200.00, '6', '2023-01-04', 4),
(12, 200.00, '7', '2023-01-04', 2),
(13, 200.00, '8', '2023-01-04', 4),
(14, 200.00, '1', '2023-01-17', 5),
(15, 200.00, '3', '2023-01-17', 4),
(16, 200.00, '9', '2023-01-17', 5),
(17, 200.00, '10', '2023-01-17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(40) NOT NULL,
  `othernames` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `othernames`, `username`, `email`, `phone`, `password`, `created_on`, `updated_on`) VALUES
(1, 'Mangut', 'Amos', 'Manguti', 'nimatmangs@gmail.com', '08098987676', 'mighty', NULL, NULL),
(2, 'Mangut', 'Amos', 'Manguti', 'nimatmangs@gmail.com', '08098987676', 'mighty', NULL, NULL),
(3, 'James', 'Akari', 'man', 'moses@gmail.com', '09098765432', '1234', '2022-04-22 21:24:30', NULL),
(4, 'James', 'Akari', 'man', 'moses@gmail.com', '09098765432', '1234', '2022-04-22 21:25:36', NULL),
(5, 'James', 'Akari', 'man', 'moses@gmail.com', '09098765432', '1234', '2022-04-22 21:27:33', NULL),
(6, 'James', 'Akari', 'man', 'moses@gmail.com', '09098765432', '1234', '2022-04-22 21:27:48', NULL),
(7, 'Linda', 'Samuel', 'man', 'samuel@gmail.com', '09098765432', '1234', '2022-04-22 22:00:33', NULL),
(8, 'Rinrit', 'Ngufwan', 'root', 'rin@gmail.com', '0900909888', '1234', '2022-04-23 08:05:23', NULL),
(9, 'Longji', 'Panse', 'ljpanse', 'ljp@ljp.com', '79879878', 'ljp', '2022-04-27 19:58:26', NULL),
(10, 'John', 'Dusu', 'ljpanse', 'ljp@johncena.com', '7987987800', '789', '2022-05-07 07:58:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_deposits`
--

CREATE TABLE IF NOT EXISTS `wallet_deposits` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(9) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `trx_date` date NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_withdrawals`
--

CREATE TABLE IF NOT EXISTS `wallet_withdrawals` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` varchar(9) NOT NULL,
  `amount` double(9,2) NOT NULL,
  `purpose` text NOT NULL,
  `trx_date` date NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `yearplan`
--

CREATE TABLE IF NOT EXISTS `yearplan` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `startweek` date NOT NULL,
  `welfarevalue` double NOT NULL,
  `sharevalue` double NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `yearplan`
--

INSERT INTO `yearplan` (`sno`, `group_id`, `startweek`, `welfarevalue`, `sharevalue`, `status`) VALUES
(1, 1, '2022-10-09', 200, 800, 'open'),
(2, 2, '2022-09-04', 200, 1000, 'open');

-- --------------------------------------------------------

--
-- Stand-in structure for view `yearplan_view`
--
CREATE TABLE IF NOT EXISTS `yearplan_view` (
`sno` int(11)
,`rcc_id` int(11)
,`rcc_name` varchar(35)
,`lcc_name` text
,`group_name` text
,`group_id` int(11)
,`startweek` date
,`welfarevalue` double
,`sharevalue` double
,`status` varchar(10)
);
-- --------------------------------------------------------

--
-- Structure for view `groups_view`
--
DROP TABLE IF EXISTS `groups_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `groups_view` AS select `groups`.`sno` AS `sno`,`groups`.`group_name` AS `group_name`,`groups`.`lcc_name` AS `lcc_name`,`groups`.`rcc_id` AS `rcc_id`,`rccs`.`rcc_name` AS `rcc_name`,`rccs`.`agent_id` AS `agent_id`,`agents`.`agent_name` AS `agent_name`,`agents`.`email` AS `agent_email` from ((`groups` left join `rccs` on((`groups`.`rcc_id` = `rccs`.`sno`))) left join `agents` on((`rccs`.`agent_id` = `agents`.`sno`)));

-- --------------------------------------------------------

--
-- Structure for view `member_view`
--
DROP TABLE IF EXISTS `member_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `member_view` AS select `members`.`sno` AS `sno`,`members`.`member_name` AS `member_name`,`members`.`contact_address` AS `contact_address`,`members`.`phone_no` AS `phone_no`,`members`.`email` AS `email`,`members`.`password` AS `password`,`members`.`role_in_group` AS `role_in_group`,`group_position`.`position` AS `position`,`members`.`group_id` AS `group_id`,`groups`.`group_name` AS `group_name`,`groups`.`lcc_name` AS `lcc_name`,`groups`.`rcc_id` AS `rcc_id`,`rccs`.`rcc_name` AS `rcc_name`,`rccs`.`agent_id` AS `agent_id`,`agents`.`agent_name` AS `agent_name` from ((((`members` left join `groups` on((`members`.`group_id` = `groups`.`sno`))) left join `rccs` on((`groups`.`rcc_id` = `rccs`.`sno`))) left join `agents` on((`rccs`.`agent_id` = `agents`.`sno`))) left join `group_position` on((`group_position`.`id` = `members`.`role_in_group`)));

-- --------------------------------------------------------

--
-- Structure for view `rccs_view`
--
DROP TABLE IF EXISTS `rccs_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rccs_view` AS select `rccs`.`sno` AS `sno`,`rccs`.`rcc_name` AS `rcc_name`,`rccs`.`rcc_location` AS `rcc_location`,`agents`.`sno` AS `agent_id`,`agents`.`agent_name` AS `agent_name`,`agents`.`email` AS `agent_email` from (`rccs` left join `agents` on((`rccs`.`agent_id` = `agents`.`sno`)));

-- --------------------------------------------------------

--
-- Structure for view `rcc_view`
--
DROP TABLE IF EXISTS `rcc_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rcc_view` AS select `rccs`.`sno` AS `sno`,`rccs`.`rcc_name` AS `rcc_name`,`rccs`.`rcc_location` AS `rcc_location`,`rccs`.`agent_id` AS `agent_id`,`agents`.`agent_name` AS `agent_name` from (`rccs` left join `agents` on((`agents`.`sno` = `rccs`.`agent_id`)));

-- --------------------------------------------------------

--
-- Structure for view `yearplan_view`
--
DROP TABLE IF EXISTS `yearplan_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `yearplan_view` AS select `yearplan`.`sno` AS `sno`,`rccs`.`sno` AS `rcc_id`,`rccs`.`rcc_name` AS `rcc_name`,`groups`.`lcc_name` AS `lcc_name`,`groups`.`group_name` AS `group_name`,`yearplan`.`group_id` AS `group_id`,`yearplan`.`startweek` AS `startweek`,`yearplan`.`welfarevalue` AS `welfarevalue`,`yearplan`.`sharevalue` AS `sharevalue`,`yearplan`.`status` AS `status` from ((`yearplan` left join `groups` on((`yearplan`.`group_id` = `groups`.`sno`))) left join `rccs` on((`groups`.`rcc_id` = `rccs`.`sno`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
