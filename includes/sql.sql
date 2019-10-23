-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2019 at 06:25 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dudi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mashuv`
--

CREATE TABLE `mashuv` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `family` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` text NOT NULL,
  `preson` text NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mashuv`
--

INSERT INTO `mashuv` (`id`, `name`, `family`, `phone`, `email`, `preson`, `date`, `text`) VALUES
(1, 'כל', '', '', '', '', '2022-03-02', ''),
(2, 'כל', '', '', '', '', '2022-03-02', ''),
(3, 'כל', '', '', '', '', '2022-03-02', ''),
(4, '', '', '', '', '', '2018-03-03', ''),
(5, '', '', '', '', '', '2016-03-03', 'sdf'),
(6, 'גל', 'טיבט', '0508935199', 'galtibet@gmail.com', '', '2021-02-02', 'sadf'),
(7, 'gal', 'טיבט', '0508935199', 'galtibet@gmail.com', '', '2015-09-26', 'sdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mashuv`
--
ALTER TABLE `mashuv`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mashuv`
--
ALTER TABLE `mashuv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
