-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 02:02 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `url shortener`
--

-- --------------------------------------------------------

--
-- Table structure for table `api data`
--

CREATE TABLE `api data` (
  `id` int(11) NOT NULL,
  `short_url` varchar(50) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api data`
--

INSERT INTO `api data` (`id`, `short_url`, `time`, `location`) VALUES
(16, 'name', '2021-08-25 17:07:41', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `shorten_url`
--

CREATE TABLE `shorten_url` (
  `id` int(11) NOT NULL,
  `url` varchar(1000) NOT NULL,
  `short_code` varchar(200) NOT NULL,
  `hits` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shorten_url`
--

INSERT INTO `shorten_url` (`id`, `url`, `short_code`, `hits`, `time`) VALUES
(6, 'https://www.flipkart.com/beauty-and-grooming/makeup/pr?sid=g9b,ffi&offer=nb:mp:0701964117&hpid=6KvbcAqivWyo6wiGXhvZyap7_Hsxr70nj65vMAAFKlc=&fm=neo/merchandising&iid=M_23cfcf6b-ee2c-4a28-bde6-e59a7b91ebd6_3.EG3ZCIZK7GZF&ssid=5klb65i3ls0000001629864245426&otracker=hp_omu_Deals+of+the+Day_5_3.dealCard.OMU_EG3ZCIZK7GZF_3&otracker1=hp_omu_SECTIONED_manualRanking_neo/merchandising_Deals+of+the+Day_NA_dealCard_cc_5_NA_view-all_3&cid=EG3ZCIZK7GZF', 'name', 1, '2021-08-25 17:06:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api data`
--
ALTER TABLE `api data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shorten_url`
--
ALTER TABLE `shorten_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api data`
--
ALTER TABLE `api data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `shorten_url`
--
ALTER TABLE `shorten_url`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
