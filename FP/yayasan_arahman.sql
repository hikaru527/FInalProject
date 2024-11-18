-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2024 at 03:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yayasan_arahman`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_new_user` (IN `p_nama_lengkap` VARCHAR(100), IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255))   BEGIN
    DECLARE salt VARCHAR(100);
    DECLARE hashed_password VARCHAR(255);
    
    -- Generate random salt
    SET salt = UUID();
    
    -- Hash password dengan salt menggunakan SHA2 (dapat disesuaikan dengan algoritma yang lebih kuat)
    SET hashed_password = SHA2(CONCAT(p_password, salt), 512);
    
    -- Insert user baru
    INSERT INTO users (nama_lengkap, email, password_hash, password_salt)
    VALUES (p_nama_lengkap, p_email, hashed_password, salt);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verify_user_password` (IN `p_email` VARCHAR(100), IN `p_password` VARCHAR(255), OUT `is_valid` BOOLEAN)   BEGIN
    DECLARE stored_hash VARCHAR(255);
    DECLARE stored_salt VARCHAR(100);
    DECLARE calculated_hash VARCHAR(255);
    
    -- Ambil hash dan salt yang tersimpan
    SELECT password_hash, password_salt INTO stored_hash, stored_salt
    FROM users
    WHERE email = p_email;
    
    -- Hitung hash dari password input
    SET calculated_hash = SHA2(CONCAT(p_password, stored_salt), 512);
    
    -- Bandingkan hash
    SET is_valid = (stored_hash = calculated_hash);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `social_logins`
--

CREATE TABLE `social_logins` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `provider` enum('apple','google','facebook') NOT NULL,
  `provider_user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_salt` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_lengkap`, `email`, `password_hash`, `password_salt`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'hafidh', '32haj@gmail.com', '81c37fc77883162413af6a67985dc3ce99025a97b5e886b76a05a55709b44c608728c23b30a52832211a8a37235166b203d3daded05fdc36e6606c7acb630091', 'd121b219bc3f721a0d353a808182ccbf12c92a574587f4b2f5b9efa0e5a2686d', '2024-11-17 01:22:49', '2024-11-17 01:22:49', 1),
(2, 'ridha12', 'yaya@gmail.com', '64e34854d2a21ca6947315419208074d8299f12859e6769727501814d1494de2f71ac7a77ba41c1a3a29816e130523ee269fc1a58e1dbcf8868c890f0e5cb979', '0ca3e519878e5c6603f3da41dce691bee5f6592245c176f3a62174ff01c345be', '2024-11-17 02:09:40', '2024-11-17 02:09:40', 1),
(3, 'faras', 'faras123@gmail.com', 'ef7addf8b8be52f2e401bdbb6fd7c77983c6d5535e744b4d485d9ae2c2bd10e292b5294cb9e4e2f7b78737263eb8ee348c68156e08a7560fa3d2ac2b57780bb4', '18a363766316e6f8c59b1c238fa1994b4de321c11a7a836e77fef10eaf00cee5', '2024-11-17 19:07:15', '2024-11-17 19:07:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_agreements`
--

CREATE TABLE `user_agreements` (
  `id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `agreement_type` varchar(50) NOT NULL,
  `agreed_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_agreements`
--

INSERT INTO `user_agreements` (`id`, `user_id`, `agreement_type`, `agreed_at`) VALUES
(1, 1, 'terms', '2024-11-17 01:22:49'),
(2, 2, 'terms', '2024-11-17 02:09:40'),
(3, 3, 'terms', '2024-11-17 19:07:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_provider_account` (`provider`,`provider_user_id`),
  ADD KEY `idx_social_login_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `user_agreements`
--
ALTER TABLE `user_agreements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_agreements` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `social_logins`
--
ALTER TABLE `social_logins`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_agreements`
--
ALTER TABLE `user_agreements`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `social_logins`
--
ALTER TABLE `social_logins`
  ADD CONSTRAINT `social_logins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_agreements`
--
ALTER TABLE `user_agreements`
  ADD CONSTRAINT `user_agreements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
