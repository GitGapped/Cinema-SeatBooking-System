-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 04:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `bookdate` date NOT NULL,
  `showid` int(11) NOT NULL,
  `seatr` int(11) NOT NULL,
  `seatc` int(11) NOT NULL,
  `bookcheck` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `bookdate`, `showid`, `seatr`, `seatc`, `bookcheck`) VALUES
(1, 'user1', '2024-01-23', 1, 0, 0, 1),
(2, 'user1', '2024-01-23', 1, 1, 0, 1),
(6, 'dule', '2024-01-22', 7, 0, 0, 1),
(7, 'dule', '2024-01-22', 7, 1, 0, 1),
(8, 'dule', '2024-01-21', 1, 0, 0, 0),
(76, 'dule', '2024-01-23', 1, 0, 1, 0),
(77, 'dule', '2024-01-24', 4, 0, 0, 1),
(78, 'dule', '2024-01-24', 4, 1, 0, 1),
(79, 'dule', '2024-01-24', 2, 0, 0, 1),
(89, 'dule', '2024-02-01', 3, 0, 0, 1),
(144, 'dule', '2024-01-31', 7, 0, 3, 1),
(145, 'dule', '2024-01-31', 4, 0, 3, 1),
(146, 'dule', '2024-02-02', 9, 0, 0, 1),
(147, 'dule', '2024-02-02', 9, 1, 0, 1),
(148, 'dule', '2024-01-31', 3, 3, 4, 1),
(159, 'dule', '2024-01-30', 3, 3, 4, 1),
(160, 'dule', '2024-01-31', 3, 5, 4, 1),
(161, 'dule', '2024-01-31', 3, 6, 4, 1),
(162, 'dule', '2024-01-31', 3, 4, 3, 1),
(163, 'dule', '2024-01-31', 3, 5, 3, 1),
(164, 'dule', '2024-01-31', 17, 5, 4, 1),
(169, 'dule', '2024-01-30', 3, 4, 4, 1),
(170, 'dule', '2024-02-01', 4, 4, 4, 0),
(171, 'dule', '2024-02-01', 4, 5, 4, 0),
(172, 'dule', '2024-01-30', 4, 3, 3, 0),
(173, 'dule', '2024-01-30', 4, 4, 3, 0),
(174, 'dule', '2024-02-09', 4, 1, 2, 0),
(175, 'dule', '2024-02-09', 4, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_title` varchar(200) NOT NULL,
  `movie_image` varchar(200) NOT NULL,
  `movie_director` varchar(200) NOT NULL,
  `movie_plot` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_title`, `movie_image`, `movie_director`, `movie_plot`) VALUES
(2, 'BLACKWIDOW', 'blackwidow.jpg', 'none', 'blah blah blah'),
(4, 'BARBIE', 'Barbie.jpg', 'BARBIEKEN', 'BARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKEN'),
(5, 'OPPENHEIMER', 'Oppenheimer.jpg', 'MURPHY', 'BARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKENBARBIEKEN'),
(7, 'Napoleon', 'napoleon1.jpg', 'Napoleon Director', 'hes a director plotting'),
(8, 'Godfather', 'Godfather2.jpg', 'director', 'qwhheqhwehqweh'),
(9, 'JOHNNY BRAVO', 'johnny bravo.jpg', 'johnnybravo also', 'johnnybravo alsojohnnybravo alsojohnnybravo alsojohnnybravo alsojohnnybravo alsojohnnybravo also'),
(28, 'Parasite', 'Parasite.jpg', 'Bong Joonho', 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `cinemaname` varchar(100) NOT NULL,
  `datelimit` date DEFAULT NULL,
  `seatsr` int(11) DEFAULT NULL,
  `seatsc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`cinemaname`, `datelimit`, `seatsr`, `seatsc`) VALUES
('village', '2024-02-10', 8, 8);

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `showid` int(11) NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`showid`, `start`, `end`, `movie_id`) VALUES
(1, '17:00:00', '19:00:00', 1),
(2, '19:00:00', '21:00:00', 2),
(3, '13:00:00', '14:00:00', 4),
(4, '21:00:00', '23:00:00', 2),
(7, '12:00:00', '15:00:00', 7),
(8, '11:00:00', '13:00:00', 1),
(11, '21:21:00', '21:12:00', 22),
(12, '22:22:00', '11:11:00', 23),
(14, '13:00:00', '16:00:00', 8),
(15, '16:00:00', '18:00:00', 5),
(16, '19:00:00', '21:00:00', 9),
(17, '20:00:00', '22:00:00', 9),
(22, '18:00:00', '20:00:00', 28);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `type`) VALUES
(23, 'dule', '$2y$10$LCigA5R3WF3VwA/sLSZdyOQkk8GoRnifh3uiPDJkze/rh9tHAmNJ.', 1),
(24, 'admin', '$2y$10$h6mP5yJ6m5R2JJx2dH1LmOywWhaUl9drDnaAQ5SS9EnGM9BJTFt8e', 0),
(31, 'dule2', '$2y$10$TukQxjUVvCy244dcH6gNWe9woEVc/hUWKVvUx1S2wQ5dMvs8BJmQC', 1),
(40, 'dule3', '$2y$10$3POFGFrZ62NDeG8tQytTLebCeO/SDT397AC3hgjCwwR8oPn6jcmrW', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`cinemaname`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`showid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `showid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
