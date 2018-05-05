-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 05, 2018 at 04:37 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`, `active`, `user_id`) VALUES
(1, 'Course test 1', 'Course test 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sodales sapien non posuere blandit. Mauris et mauris in nibh condimentum pellentesque et at leo. Sed tristique, magna sagittis semper commodo, quam lorem euismod tellus, ac mattis neque leo sit amet velit. Sed consectetur varius varius. Duis justo quam, lacinia vel suscipit vitae, commodo sed lorem. Etiam eu turpis at lectus feugiat sagittis. Pellentesque auctor et nisi ac congue. Mauris malesuada pretium sem ac tincidunt. Suspendisse ornare orci vel sapien rutrum blandit. Mauris sed mattis eros. Fusce vitae enim blandit est porta viverra.', '2018-04-19', '2018-04-30', '2018-04-20 06:50:58', '2018-05-05 11:12:30', 1, 1),
(2, 'Course test 2', 'Course test 2 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sodales sapien non posuere blandit. Mauris et mauris in nibh condimentum pellentesque et at leo. Sed tristique, magna sagittis semper commodo, quam lorem euismod tellus, ac mattis neque leo sit amet velit. Sed consectetur varius varius. Duis justo quam, lacinia vel suscipit vitae, commodo sed lorem. Etiam eu turpis at lectus feugiat sagittis. Pellentesque auctor et nisi ac congue. Mauris malesuada pretium sem ac tincidunt. Suspendisse ornare orci vel sapien rutrum blandit. Mauris sed mattis eros. Fusce vitae enim blandit est porta viverra.\r\n\r\nDonec a eros vel est viverra vehicula faucibus at erat. Pellentesque pretium vel nisi vitae vestibulum. Etiam sapien sapien, pellentesque vitae lectus at, tempor fringilla urna. Aenean nibh lorem, venenatis a justo in, interdum varius sapien. Vestibulum dignissim eros turpis, at scelerisque elit semper sed. In in pulvinar diam. Aliquam gravida interdum urna quis malesuada. Donec tristique nisi gravida odio porttitor ullamcorper. Praesent elit ex, venenatis vel congue sit amet, sagittis ac metus.', '2018-04-19', '2018-04-30', '2018-04-20 06:50:58', '2018-05-05 11:12:47', 1, 1),
(3, 'Course test 3', 'Course test 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sodales sapien non posuere blandit. Mauris et mauris in nibh condimentum pellentesque et at leo. Sed tristique, magna sagittis semper commodo, quam lorem euismod tellus, ac mattis neque leo sit amet velit. Sed consectetur varius varius. Duis justo quam, lacinia vel suscipit vitae, commodo sed lorem. Etiam eu turpis at lectus feugiat sagittis. Pellentesque auctor et nisi ac congue. Mauris malesuada pretium sem ac tincidunt. Suspendisse ornare orci vel sapien rutrum blandit. Mauris sed mattis eros. Fusce vitae enim blandit est porta viverra.', '2018-04-19', '2018-04-30', '2018-04-20 06:50:58', '2018-05-05 11:13:12', 1, 1),
(4, 'Course test 4', 'Course test 4 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sodales sapien non posuere blandit. Mauris et mauris in nibh condimentum pellentesque et at leo. Sed tristique, magna sagittis semper commodo, quam lorem euismod tellus, ac mattis neque leo sit amet velit. Sed consectetur varius varius. Duis justo quam, lacinia vel suscipit vitae, commodo sed lorem. Etiam eu turpis at lectus feugiat sagittis. Pellentesque auctor et nisi ac congue. Mauris malesuada pretium sem ac tincidunt. Suspendisse ornare orci vel sapien rutrum blandit. Mauris sed mattis eros. Fusce vitae enim blandit est porta viverra.', '2018-04-19', '2018-04-30', '2018-04-20 06:50:58', '2018-05-05 11:13:32', 1, 1),
(5, 'Course test 5', 'Course test 5 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin accumsan ut risus vehicula molestie. Nam scelerisque, lacus eu convallis congue, enim elit finibus diam, vitae rhoncus erat nunc iaculis nisi. Praesent sit amet convallis lorem, et ultrices velit. Aenean nec sapien id metus auctor luctus non eu ligula. Quisque sodales, velit sit amet venenatis mollis, dolor ex posuere dui, vestibulum blandit magna eros eu nisl. Curabitur viverra urna justo, ac iaculis tortor tempus sed. Mauris justo elit, mattis eget faucibus ac, luctus vehicula ipsum. Pellentesque ultricies a augue vitae sagittis. Pellentesque et sapien ex. Sed accumsan felis leo, ut faucibus leo fermentum eget. Donec diam enim, blandit nec pulvinar ac, gravida in purus. Donec tempor gravida lectus, eget finibus sapien posuere quis. Proin et congue risus. Vivamus ac eros mi. Pellentesque mattis magna eu tellus elementum, sed viverra magna blandit.\r\n                                                                    ', '2018-05-05', '2018-05-05', '2018-05-05 11:14:49', '2018-05-05 11:14:49', 1, 1),
(6, 'Course test 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque porttitor dapibus magna, a cursus risus elementum sit amet. Sed ultrices vitae odio at luctus. Nullam non pulvinar purus, sit amet placerat nibh. Vivamus quis molestie lorem. Sed ac commodo velit. Proin in urna purus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi in quam sit amet felis finibus eleifend ut a turpis. Integer rhoncus nec metus a sodales. Nullam a turpis vel dolor tincidunt efficitur ultrices ut nulla. Integer consectetur sagittis lacinia. Duis eget varius sapien, et ornare purus. Cras varius nibh neque, in posuere velit auctor nec.', '2018-05-05', '2018-05-31', '2018-05-05 11:34:06', '2018-05-05 11:34:06', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(5) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `course_id`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, '2018-04-20 07:16:00', '2018-05-05 13:28:37'),
(2, 1, 2, 1, 0, '2018-04-20 07:16:00', '2018-05-05 13:26:21'),
(3, 2, 2, 3, 1, '2018-04-20 07:16:00', '2018-05-05 13:27:51'),
(4, 4, 4, 4, 1, '2018-04-26 18:21:27', '2018-04-26 18:21:27'),
(5, 1, 5, 3, 0, '2018-05-05 11:19:03', '2018-05-05 11:19:03'),
(6, 1, 3, 3, 0, '2018-05-05 11:51:01', '2018-05-05 12:00:53'),
(7, 1, 4, 3, 1, '2018-05-05 12:57:27', '2018-05-05 12:57:27'),
(9, 2, 4, 3, 1, '2018-05-05 13:27:57', '2018-05-05 13:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(5) NOT NULL,
  `email` varchar(40) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `email`, `name`, `phone`, `password`, `created_at`, `updated_at`, `active`, `user_id`) VALUES
(1, 'test1@ts.ts', 'test one student', '0505556677', '$2y$10$S7.v0IVAKy9Mah3gdSBpae1GXciYyFInx8VHIP9ocYI5/q9ieGKbOv', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1),
(2, 'test2@ts.ts', 'Test Two Student', '0505556677', '$2y$10$S7.v0IVAKy9Mah3gdSBpae1GXciYyFInx8VHIP9ocYI5/q9ieGKbOv', '2018-04-20 06:50:57', '2018-05-04 19:43:42', 1, 1),
(3, 'test3@ts.ts', 'Test Three Student', '0505556677', '$2y$10$S7.v0IVAKy9Mah3gdSBpae1GXciYyFInx8VHIP9ocYI5/q9ieGKbOv', '2018-04-20 06:50:57', '2018-05-04 20:23:14', 1, 1),
(4, 'test4@ts.ts', 'test four student', '0505556677', '$2y$10$S7.v0IVAKy9Mah3gdSBpae1GXciYyFInx8VHIP9ocYI5/q9ieGKbOv', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1),
(5, 'test5@ts.ts', 'test five student', '0505556677', '$2y$10$S7.v0IVAKy9Mah3gdSBpae1GXciYyFInx8VHIP9ocYI5/q9ieGKbOv', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`, `password`, `role`, `created_at`, `updated_at`, `active`, `user_id`) VALUES
(1, 'test1@ts.ts', 'test one user', '0505556677', '$2y$10$S3kmPagpefmXGCU1AZzYLudlFD/vrqfFrIAIVJ97/feq9v8RlEz1C', '1', '2018-04-20 06:50:57', '2018-05-05 12:28:28', 1, 1),
(2, 'test2@ts.ts', 'test two user', '0505556677', '$2y$10$S3kmPagpefmXGCU1AZzYLudlFD/vrqfFrIAIVJ97/feq9v8RlEz1C', '2', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1),
(3, 'test3@ts.ts', 'test three user', '0505556677', '$2y$10$S3kmPagpefmXGCU1AZzYLudlFD/vrqfFrIAIVJ97/feq9v8RlEz1C', '3', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1),
(4, 'test4@ts.ts', 'test four user', '0505556677', '$2y$10$S3kmPagpefmXGCU1AZzYLudlFD/vrqfFrIAIVJ97/feq9v8RlEz1C', '1', '2018-04-20 06:50:57', '2018-04-20 06:50:57', 1, 1),
(5, 'test5@ts.ts', 'test five user', '0505556677', '$2y$10$S3kmPagpefmXGCU1AZzYLudlFD/vrqfFrIAIVJ97/feq9v8RlEz1C', '1', '2018-04-20 06:50:57', '2018-05-05 11:54:24', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_active` (`active`),
  ADD KEY `c_active` (`active`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `student_active` (`active`),
  ADD KEY `s_active` (`active`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
