-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 09:55 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empleave`
--

-- --------------------------------------------------------

--
-- Table structure for table `leavetable`
--

CREATE TABLE `leavetable` (
  `emp_id` varchar(50) NOT NULL,
  `casual` varchar(50) NOT NULL,
  `emergency` varchar(50) NOT NULL,
  `capplied` varchar(50) NOT NULL,
  `sapplied` varchar(50) NOT NULL,
  `requests` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wit_lv_config`
--

CREATE TABLE `wit_lv_config` (
  `mnthly_csl_lv` int(11) NOT NULL,
  `mnthly_sk_lv` int(11) NOT NULL,
  `fin_mth` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wit_lv_config`
--

INSERT INTO `wit_lv_config` (`mnthly_csl_lv`, `mnthly_sk_lv`, `fin_mth`) VALUES
(2, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `wit_lv_emp_mast`
--

CREATE TABLE `wit_lv_emp_mast` (
  `emp_id` int(200) NOT NULL,
  `emp_name` varchar(200) NOT NULL,
  `emp_eml` varchar(200) NOT NULL,
  `login_pwd` varchar(50) NOT NULL,
  `is_admin` char(1) NOT NULL DEFAULT 'N',
  `emp_desgn` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wit_lv_trn_dtls`
--

CREATE TABLE `wit_lv_trn_dtls` (
  `emp_id` int(11) NOT NULL,
  `lv_frm` datetime NOT NULL,
  `lv_to` datetime NOT NULL,
  `no_dys` int(11) NOT NULL,
  `rsn` varchar(200) DEFAULT NULL,
  `lv_stat` char(1) NOT NULL DEFAULT 'P',
  `apprd_by_emp_id` int(11) DEFAULT NULL,
  `apprd_dttm` datetime DEFAULT NULL,
  `crtd_dttm` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leavetable`
--
ALTER TABLE `leavetable`
  ADD UNIQUE KEY `emp_id` (`emp_id`);

--
-- Indexes for table `wit_lv_emp_mast`
--
ALTER TABLE `wit_lv_emp_mast`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_eml` (`emp_eml`),
  ADD UNIQUE KEY `emp_eml_2` (`emp_eml`);

--
-- Indexes for table `wit_lv_trn_dtls`
--
ALTER TABLE `wit_lv_trn_dtls`
  ADD PRIMARY KEY (`emp_id`,`lv_frm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wit_lv_emp_mast`
--
ALTER TABLE `wit_lv_emp_mast`
  MODIFY `emp_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18010;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
