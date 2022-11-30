-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2022 at 10:08 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `from_user` int(8) NOT NULL,
  `to_user` int(8) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `message`, `created_at`) VALUES
(1, 13, 12, 'hi helo yyoyo', '2022-11-29 08:12:21'),
(2, 13, 12, 'bleeehhhhh', '2022-11-29 08:12:53'),
(3, 13, 14, 'tester', '2022-11-29 08:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(20) NOT NULL,
  `message_id` int(10) NOT NULL,
  `user_id` int(8) NOT NULL,
  `reply` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` blob DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `hubby` varchar(240) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `image`, `gender`, `birthdate`, `age`, `hubby`, `created_at`, `last_login`) VALUES
(1, 'test', 'test@test.test', 'test', NULL, NULL, '2022-11-09 13:34:02', NULL, NULL, '2022-11-27 22:24:15', '2022-11-27 22:24:15'),
(2, 'test1', 'test1@test.test', 'test1', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 22:26:21', '2022-11-27 22:26:21'),
(3, 'test2', 'test2@test.test', 'c70752e55e9fef60f21b6ec95ce8347dfd8f5386', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 22:30:17', '2022-11-27 22:30:17'),
(4, 'test3', 'test3@test.test', 'e79d539febefd6f32b2fcce628eb9bc928ae1c53', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 22:32:28', '2022-11-27 22:32:28'),
(5, 'test4@gmail.com', 'test4@gmail.com', '348e4d10dd4ca875d3f0be6b57c1ca5008eda719', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 23:02:22', '2022-11-27 23:02:22'),
(6, 'fd', 'fds@fd.hgf', '94f0425c0273d50e2d053453f711aa507ade3d0a', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 23:34:21', '2022-11-27 23:34:21'),
(7, 'test5', 'test5@gmail.com', 'test5', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 23:36:48', '2022-11-28 07:15:24'),
(8, 'test6', 'test6@test.test', 'a797ac7af1329f981dacdfa4441b3ae7f9be0afe', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-27 23:44:42', '2022-11-27 23:44:42'),
(9, 'test7', 'test7@test.test', '$2a$10$77LJXWm2EqSJraVrz7XohOpr4aS7gGox7cyuPAwZ5.f1nbmtGBrP2', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-28 07:53:50', '2022-11-28 08:00:58'),
(10, 'test8@test.test', 'test8@test.test', '$2a$10$cqTQT9ZrWwHTrKGbNcAO8.axzWf7kyLgdkoq3d6Rz4y7PJvzsj5CG', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-28 07:55:00', '2022-11-28 07:55:00'),
(11, 'test9', 'test9@gmail.com', '04ab8d4fd1d50f85cabeb2c0f8039f9725ef8656', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-28 07:55:51', '2022-11-28 08:16:35'),
(12, 'test10', 'test10@test.bnm', '$2a$10$XpB.hbjB1Cz.alIPBSY/1.C40JC2MXMLFFZV0dwMPthZ3g6Vv9nWq', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-28 08:21:09', '2022-11-28 08:23:31'),
(13, 'test113', 'test11@test.test', '$2a$10$6EuLPom1aa3ex65fJ5GOtunzNwCUmpj.wqGX4oioqTgiLqvwA0eoa', 0x3230323231313239313530323038313536302d31312e6a706567, 'Male', '2011-06-15 00:00:00', 22, 'dsgdfg fdgfd gfhg. gdfgfdgf4', '2022-11-28 08:23:58', '2022-11-28 08:24:25'),
(14, 'gdfg', 'test51@gmail.com', '$2a$10$6ufFT4bguqyaRpCYfDc5zeN3fjkMeZu2IpIfedOvGDUkw98F3sRsK', 0x6176617461722d6e6f2d7069632e706e67, NULL, NULL, NULL, NULL, '2022-11-28 09:07:17', '2022-11-28 09:07:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
