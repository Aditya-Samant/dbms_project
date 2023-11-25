-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 02:51 PM
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
-- Database: `trial`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE `enrolled` (
  `uid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`uid`, `taskid`) VALUES
(3, 1),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `date`, `location`) VALUES
(1, 'dasfagrare', 'fvsdsdvdgvggvdvdfdrgdg', '2023-11-08', 'Bicholim'),
(2, 'ssss', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quaerat perferendis sit ducimus tempore! Fugit dicta facere ratione, incidunt deserunt dignissimos! Dolorem ea eum, impedit dignissimos fugiat voluptatibus itaque odio!\r\n', '2023-11-01', 'srfgsg'),
(3, 'somting', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quaerat perferendis sit ducimus tempore! Fugit dicta facere ratione, incidunt deserunt dignissi', '2014-11-25', 'Panjim'),
(4, 'iaan', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quaerat perferendis sit ducimus tempore! Fugit dicta facere ratione, incidunt deserunt dignissiLorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quaerat perferendis sit ducimus tempore! Fugit dicta facere ratione, incidunt deserunt dignissi', '2023-11-06', 'Ponda'),
(5, 'latest', 'lorem latest', '2023-11-25', 'Pune');

-- --------------------------------------------------------

--
-- Table structure for table `todo`
--

CREATE TABLE `todo` (
  `uid` int(11) DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `task_name` text DEFAULT NULL,
  `task_desc` text DEFAULT NULL,
  `task_date` date DEFAULT NULL,
  `task_category` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `todo`
--

INSERT INTO `todo` (`uid`, `task_id`, `task_name`, `task_desc`, `task_date`, `task_category`) VALUES
(3, 45, 'adi samant', 'dfrxhcgjhjll', '2023-11-08', 'sadasd'),
(3, 48, 'harshada', ' consectetur adipisicing elit. Pariatur inventore voluptates dolorem, ex architecto porro omnis? Nisi, tempora similique ducimus praesentium possimus aliquid odio eos illum, illo eveniet provident? Nulla!\r\n', '2023-11-03', 'sads'),
(3, 49, 'ddgserg', 'sdfhsrthdyjgfbr', '2023-11-10', 'werre');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `srno` int(11) NOT NULL,
  `first` text NOT NULL,
  `last` text NOT NULL,
  `password` varchar(20) NOT NULL,
  `retypepassword` varchar(20) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `age` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`srno`, `first`, `last`, `password`, `retypepassword`, `phoneno`, `email`, `address`, `age`) VALUES
(2, 'sama', 'sndkj', 'VV', 'VV', '1111111111', 'something@cc.com', 'sdmnbajehfblijfnli', 19),
(3, 'a', 'b', 'xx', 'xx', '2222222222', 'a@a.com', 'hno 512', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD PRIMARY KEY (`uid`,`taskid`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `srno` (`srno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `todo`
--
ALTER TABLE `todo`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`srno`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`taskid`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `todo`
--
ALTER TABLE `todo`
  ADD CONSTRAINT `todo_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`srno`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
