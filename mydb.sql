-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 09:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int NOT NULL,
  `nama` varchar(25) NOT NULL,
  `nomor` varchar(25) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `nama`, `nomor`, `pekerjaan`, `email`) VALUES
(1, 'Muhammad Asad', '081284113960', 'Mechanic Engineer', 'asad@email.com'),
(2, 'Ahmad Ramdhani', '089764532876', 'Information Technology Support', 'dhaan@email.com'),
(3, 'Yuta Nakamura', '085892851903', 'Mechanic Supervisor', 'yuta@email.com'),
(7, 'Asad', '081284113960', 'IT Technical Support', 'muhammadasaddun@gmail.com'),
(8, 'Ahmad Ramdhania', '08121243687', 'Production Supervisor', 'admina@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `asset_id` varchar(20) NOT NULL,
  `value` varchar(10) NOT NULL,
  `version` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`asset_id`, `value`, `version`) VALUES
('1000000', '001', '4.1.1'),
('1000002', '003', '4.1.1'),
('1000003', '004', '4.1.1'),
('1000004', '005', '4.1.1'),
('1000015', '017', '4.1.1'),
('1000016', '018', '4.1.1'),
('1000017', '019', '4.1.1'),
('1000018', '020', '4.1.1'),
('1000040', '042', '4.1.1'),
('1000041', '043', '4.1.1'),
('1000042', '044', '4.1.1'),
('1000043', '045', NULL),
('1000044', '046', '4.1.1'),
('1000045', '047', '4.1.1'),
('1000046', '048', '4.1.1'),
('1000047', '049', '4.1.1'),
('1000048', '050', '4.1.1'),
('1000049', '051', '4.1.1'),
('1000050', '052', '4.1.1'),
('1000051', '053', '4.1.1'),
('1000052', '054', '4.1.1'),
('1000053', '055', '4.1.1'),
('1000054', '056', '4.1.1'),
('1000055', '057', '4.1.1'),
('1000056', '058', '4.1.1'),
('1000065', '070', '4.1.1'),
('1000066', '061', NULL),
('1000067', '062', '4.1.1'),
('1000068', '063', '4.1.1'),
('1000070', '068', '4.1.1'),
('1000071', '069', '4.1.1'),
('1000072', '071', '4.1.1'),
('1000073', '072', '4.1.1'),
('1000074', '076', '4.1.1'),
('1000075', '077', '4.1.1'),
('1000076', '078', '4.1.1'),
('1000077', '079', '4.1.1'),
('1000079', '080', '4.1.1'),
('1000080', '081', '4.1.1'),
('1000081', '082', '4.1.1'),
('1000082', '083', '4.1.1'),
('1000083', '084', '4.1.1'),
('1000101', '085', '4.1.1'),
('1000102', '086', '4.1.1'),
('1000105', '087', '4.1.1'),
('1000106', '088', '4.1.1'),
('1000107', '089', '4.1.1'),
('1000108', '090', '4.1.1'),
('1000109', '091', '4.1.1'),
('1000110', '092', '4.1.1'),
('1000111', '093', '4.1.1'),
('1000112', '094', '4.1.1'),
('1000115', '095', '4.1.1'),
('1000116', '096', '4.1.1'),
('1000120', '101', '4.1.1'),
('1000121', '102', '4.1.1'),
('1000122', '098', '4.1.1'),
('1000123', '099', '4.1.1'),
('1000124', '100', '4.1.1'),
('1000125', '097', '4.1.1'),
('1000126', '103', '4.1.1'),
('1000127', '104', '4.1.1'),
('1000128', '105', NULL),
('1000129', '106', '4.1.1'),
('1000130', '107', '4.1.1'),
('1000131', '108', '4.1.1'),
('1000132', '109', '4.1.1'),
('1000133', '110', '4.1.1'),
('1000134', '111', '4.1.1'),
('1000135', '112', '4.1.1'),
('1000136', '114', NULL),
('1000137', '115', '4.1.1'),
('1000138', '116', '4.1.1'),
('1000139', '117', '4.1.1');

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `asset_id` varchar(20) NOT NULL,
  `waktu_mulai` timestamp NOT NULL,
  `status` tinyint NOT NULL,
  `user_id` int DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`id`, `deskripsi`, `asset_id`, `waktu_mulai`, `status`, `user_id`, `waktu_selesai`) VALUES
(1, 'tes problem pertama', '1000000', '2025-02-06 06:47:44', 1, 1, NULL),
(3, 'xaasdsd', '1000018', '2025-02-07 06:23:06', 1, 1, NULL),
(4, 'ada masalah ni bos', '1000042', '2025-02-07 06:36:47', 1, 1, NULL),
(5, 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusamus culpa pariatur, sint sunt non mollitia ducimus veritatis exercitationem. Nesciunt ipsum eum dignissimos eos aspernatur consectetur omnis dolor praesentium voluptate natus.', '1000121', '2025-02-07 07:54:59', 1, 1, NULL),
(6, 'nondonoansdlacnas', '1000045', '2025-02-07 08:03:02', 1, 3, NULL),
(10, 'dassdada', '1000015', '2025-02-07 08:34:32', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `problems_action_log`
--

CREATE TABLE `problems_action_log` (
  `id` int NOT NULL,
  `deskripsi` text NOT NULL,
  `problem_id` int NOT NULL,
  `user_id` int NOT NULL,
  `waktu_catat` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL,
  `nomor_tiket` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subjek` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `queued_at` timestamp NULL DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `nomor_tiket`, `subjek`, `deskripsi`, `status`, `user_id`, `created_at`, `queued_at`, `tindakan`) VALUES
(1, 'TWK202501080001', 'Testing Ticket', 'deskripsi atau detail tentang ticket', 5, 1, '2025-01-08 09:11:53', '2025-01-16 06:58:11', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia fuga aliquam atque, odio labore praesentium? Eum inventore eos quam sint voluptatum totam quasi architecto omnis nostrum? Eaque ullam quibusdam cumque?'),
(2, 'TWK202501090001', 'Test dari Admin', 'test detail dari ticket yang dibuat oleh admin', 5, 2, '2025-01-09 13:12:11', '2025-01-15 02:03:49', 'sudah selesai'),
(3, 'TWK202501100001', 'Test dari Asad', 'deskripsi tes ticket asad nambah dari form', 6, 1, '2025-01-10 08:53:00', '2025-01-15 02:03:34', 'selesai'),
(4, 'TWK202501140001', 'Test nomor tiket', 'Tes tiket untuk menguji nomor tiket', 5, 1, '2025-01-14 06:26:25', '2025-01-15 02:01:52', 'selesaii'),
(5, 'TWK202501140002', 'Test nomor tiket 2', 'tiket nomor 2 untuk mengetes nomor tiket', 5, 1, '2025-01-14 06:36:48', '2025-01-15 02:03:38', 'selesai dengan tenang'),
(6, 'TWK202501140003', 'Test nomor tiket3', 'test nomor tiket 3-1', 5, 1, '2025-01-14 06:45:56', '2025-01-16 06:50:32', 'seleesai'),
(11, 'TWK202501220001', 'TEESSST TIKET CANCEL', 'TES DOANG BANG BAKAL DICANCEL KOK', 6, 1, '2025-01-22 09:45:18', '2025-01-22 09:45:21', 'selesais'),
(12, 'TWK202502100001', 'Tiket 10/02', 'tes tiket di tanggal 10/02', 5, 1, '2025-02-10 08:28:07', '2025-02-10 08:28:10', 'Documentation and examples for showing pagination to indicate a series of related content exists across multiple pages.');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int NOT NULL,
  `title` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `todolist`
--

INSERT INTO `todolist` (`id`, `title`, `deskripsi`, `status`) VALUES
(1, 'Makan', 'Lapeer baang kalo engga makan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `token` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(65) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'asad', 'Muhammad Asad', 'asad@email.com', '$2y$10$KMfaXxo7rfrETZCBJlETVumvdCup7T5M35PpQ6kJHZCM3i2jvKN8.', 2, '2025-01-02 07:41:54'),
(2, 'admin', 'Admin', 'admin@email.com', '$2y$10$NpCq38KnJVSAFv.ULagyaeBBHZlxoZEWNOei9Rss5YRPIpuvnK2ky', 2, '2025-01-08 09:13:05'),
(3, 'guest', 'Guest', 'guest@email.com', '$2y$10$D3Rr/ZFpUIu3Aj/qITk6Xu40e81WuSZr66dzuHk2JW1r0WDOifdTW', 1, '2025-01-20 01:24:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`asset_id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `asset_id` (`asset_id`) USING BTREE;

--
-- Indexes for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_id` (`problem_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
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
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `problems`
--
ALTER TABLE `problems`
  ADD CONSTRAINT `problems_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `problems_ibfk_2` FOREIGN KEY (`asset_id`) REFERENCES `mesin` (`asset_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `problems_action_log`
--
ALTER TABLE `problems_action_log`
  ADD CONSTRAINT `problems_action_log_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problems` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `problems_action_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
