-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2022 at 05:17 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `safe_transit`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_no` int(11) NOT NULL,
  `service_no` int(11) DEFAULT NULL,
  `reason` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `pickup_district` int(11) DEFAULT NULL,
  `pickup_location` varchar(127) NOT NULL,
  `destination_district` int(11) DEFAULT NULL,
  `destination_location` varchar(127) NOT NULL,
  `passenger_count` int(127) NOT NULL DEFAULT '0',
  `state` tinyint(7) NOT NULL DEFAULT '0',
  `booked_conductor_no` int(11) DEFAULT NULL,
  `flag` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_no`, `service_no`, `reason`, `start_date`, `end_date`, `start_time`, `end_time`, `pickup_district`, `pickup_location`, `destination_district`, `destination_location`, `passenger_count`, `state`, `booked_conductor_no`, `flag`) VALUES
(1, 1, 'reason 01', '2021-12-17', '2021-12-19', '08:00:00', '09:00:00', 2, '', 3, '', 15, 0, 0, 0),
(2, 1, 'reason 02', '2021-11-24', '2021-11-30', '10:00:00', '12:00:00', 1, '', 1, '', 34, 3, 1, 0),
(3, 0, 'reason 03', '2021-11-25', '2021-11-26', '15:00:00', '18:00:00', 12, '', 17, '', 22, 1, 7, 0),
(4, 0, 'reason 04', '2021-11-26', '2021-11-30', '18:00:00', '20:00:00', 11, 'Colombo', 20, 'Molpe', 20, 1, 6, 0),
(5, 0, 'Reason 05', '2022-01-03', '2022-01-07', '08:00:00', '17:00:00', 2, 'Gampaha location', 1, 'Colombo location', 22, 1, 1, 0),
(6, 0, 'Reason 06', '2022-01-17', '2022-01-21', '08:00:00', '17:00:00', 3, 'Kaluthara location', 1, 'Colombo location', 19, 0, NULL, 0),
(10, 0, 'Reason 07', '2022-01-24', '2022-01-28', '08:00:00', '17:00:00', 5, 'Matara location', 1, 'Colombo location', 18, 0, NULL, 0),
(11, 0, 'Reason 11', '2022-02-07', '2022-02-11', '09:00:00', '20:00:00', 16, 'Matale location', 9, 'Badulla location', 10, 3, NULL, 0),
(12, 0, 'Reason 12', '2022-01-18', '2022-01-21', '08:19:00', '17:20:00', 16, 'Matale location', 1, 'Colombo location', 10, 0, NULL, 0),
(13, 0, 'Reason 13', '2022-01-12', '2022-01-21', '13:55:00', '16:55:00', 1, 'Colombo', 8, 'Piliyandala', 27, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `conductor`
--

CREATE TABLE `conductor` (
  `conductor_no` int(11) NOT NULL,
  `first_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `address` text,
  `telephone` varchar(31) DEFAULT NULL,
  `vehicle_no` varchar(15) DEFAULT NULL,
  `district_no` int(11) DEFAULT NULL,
  `email` varchar(63) NOT NULL,
  `state` tinyint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conductor`
--

INSERT INTO `conductor` (`conductor_no`, `first_name`, `last_name`, `address`, `telephone`, `vehicle_no`, `district_no`, `email`, `state`) VALUES
(1, 'Conductor', 'Conductor 01', 'address_02', '0777223355', 'AB-1234', 1, 'conductor01@email.com', 0),
(4, 'Conductor', 'Conductor 02', 'Address 44', '0112244455', 'NC-6542', 7, 'conductor02@email.com', 0),
(5, 'Conductor', 'Conductor 03', 'Address 51', '0112245566', 'NC-6505', 24, 'conductor03@email.com', 0),
(6, 'Conductor', 'Conductor 04', 'Address 64', '0112245577', 'NC-6587', 1, 'conductor04@email.com', 0),
(7, 'Conductor', 'Conductor 05', 'Address 67', '0112243355', 'NC-1112', 1, 'conductor05@email.com', 0),
(10, 'Conductor', 'Conductor 07', 'address_77', '0114567778', 'NC-7267', 2, 'conductor07@email.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conductor_leave`
--

CREATE TABLE `conductor_leave` (
  `leave_no` int(11) NOT NULL,
  `conductor_no` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conductor_leave`
--

INSERT INTO `conductor_leave` (`leave_no`, `conductor_no`, `date`) VALUES
(1, 1, '2021-11-27'),
(2, 1, '2022-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_no` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_no`, `name`) VALUES
(1, 'Colombo'),
(2, 'Gampaha'),
(3, 'Kaluthara'),
(4, 'Galle'),
(5, 'Matara'),
(6, 'Hambantota'),
(7, 'Ampara'),
(8, 'Anuradhapura'),
(9, 'Badulla'),
(10, 'Batticaloa'),
(11, 'Jaffna'),
(12, 'Kandy'),
(13, 'Kegalle'),
(14, 'Kurunegala'),
(15, 'Mannar'),
(16, 'Matale'),
(17, 'Monaragala'),
(18, 'Mullaitivu'),
(19, 'Nuwara Eliya'),
(20, 'Polonnaruwa'),
(21, 'Puttalam'),
(22, 'Ratnapura'),
(23, 'Trincomalee'),
(24, 'Vavuniya'),
(25, 'Hambantota');

-- --------------------------------------------------------

--
-- Table structure for table `executive`
--

CREATE TABLE `executive` (
  `executive_no` int(11) NOT NULL,
  `first_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `address` text,
  `telephone` varchar(31) DEFAULT NULL,
  `service_no` int(11) DEFAULT NULL,
  `email` varchar(31) NOT NULL,
  `state` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `executive`
--

INSERT INTO `executive` (`executive_no`, `first_name`, `last_name`, `address`, `telephone`, `service_no`, `email`, `state`) VALUES
(1, 'Executive', 'Executive 00', 'address 03', '0112131334', 0, 'executive00@email.com', 0),
(2, 'Executive', 'Executive 01', 'address 08', '0111555555', 1, 'executive01@email.com', 0),
(3, 'Executive', 'Executive 02', 'address 08', '0111165615', 2, 'executive02@email.com', 2),
(4, 'Executive', 'Executive 03', 'address 16', '0115555555', 3, 'executive03@email.com', 0),
(5, 'Executive', 'Executive 04', 'address_16', '0112233344', 4, 'executive04@email.com', 0),
(6, 'Executive', 'Executive 05', 'address 09', '0115555555', 5, 'executive05@email.com', 0),
(7, 'Executive', 'Executive 06', 'Address 6767', '0116667788', 10, 'executive06@email.com', 0),
(8, 'Agent', '47', '293/E/1, 2ND LANE, MANDAVILLA ROAD, KESBAWA, PILIYANDALA', '+94778665718', 11, 'achira828@gmail.com', 0),
(9, 'Achira', 'Dias', '293/E/1, 2ND LANE, MANDAVILLA ROAD, KESBAWA, PILIYANDALA', '+94778665718', 12, 'achira828@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_no` int(11) NOT NULL,
  `fname` text NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_no`, `fname`, `name`) VALUES
(12, '20220104084916_test.PNG', 'test.PNG'),
(13, '20220104091741_MA1023-19S2-FinalExam-Group2.pdf', 'MA1023-19S2-FinalExam-Group2.pdf'),
(14, '20220104093015_test.pdf', 'test.pdf'),
(15, '20220104093045_print.png', 'print_2.png'),
(16, '20220104093225_test.pdf', 'test_2.pdf'),
(17, '20220104093620_test.pdf', 'test_3.pdf'),
(18, '20220104094058_test.pdf', 'test_4.pdf'),
(19, '20220104095324_Mora.ico', 'Mora.ico'),
(20, '20220104101136_test.PNG', 'test_2.PNG'),
(21, '20220104101542_test.pdf', 'test_5.pdf'),
(22, '20220104121206_IMG_20211110_0009.pdf', 'IMG_20211110_0009.pdf'),
(23, '20220104134539_test.pdf', 'test_6.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notification_config_data`
--

CREATE TABLE `notification_config_data` (
  `row_id` int(11) NOT NULL,
  `email_emailAddress` varchar(30) NOT NULL,
  `email_password` varchar(40) NOT NULL,
  `email_port` int(11) NOT NULL,
  `sms_ApiKey` varchar(1000) NOT NULL,
  `sms_DeviceId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification_config_data`
--

INSERT INTO `notification_config_data` (`row_id`, `email_emailAddress`, `email_password`, `email_port`, `sms_ApiKey`, `sms_DeviceId`) VALUES
(1, 'safetansit@gmail.com', 'geniousnimesh', 587, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTY0MTA1NDcyMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjkyMjIyLCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.Mip0jiKnQrI3_9xcrF1cQmZuZugTv_jgyMh33om8S8Y', '126786');

-- --------------------------------------------------------

--
-- Table structure for table `pass`
--

CREATE TABLE `pass` (
  `pass_no` int(11) NOT NULL,
  `passenger_no` int(11) DEFAULT NULL,
  `service_no` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `state` tinyint(5) DEFAULT NULL,
  `bus_route` varchar(31) NOT NULL,
  `reason` text NOT NULL,
  `file_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pass`
--

INSERT INTO `pass` (`pass_no`, `passenger_no`, `service_no`, `start_date`, `end_date`, `state`, `bus_route`, `reason`, `file_no`) VALUES
(4, 1, 0, '2021-11-25', '2021-11-30', 2, '154', 'Reason 04', 0),
(6, 1, 0, '2022-01-30', '2022-01-31', 1, '111', 'Reason 3', 14),
(7, 1, 0, '2022-01-30', '2022-01-31', 0, '138', 'Reason 3', 9);

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_no` int(11) NOT NULL,
  `first_name` varchar(63) DEFAULT NULL,
  `last_name` varchar(63) DEFAULT NULL,
  `address` varchar(127) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `service_no` int(11) DEFAULT NULL,
  `staff_id` varchar(11) NOT NULL,
  `email` varchar(31) NOT NULL,
  `state` tinyint(2) NOT NULL DEFAULT '0',
  `file_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_no`, `first_name`, `last_name`, `address`, `telephone`, `service_no`, `staff_id`, `email`, `state`, `file_no`) VALUES
(1, 'Passenger', 'Passenger01', 'address 03', '0112131334', 0, 'id_00001', 'passenger00@email.com', 1, 23),
(2, 'Passenger', 'Passenger 02', 'address 06', '2131321321', 1, 'id_00111', 'passenger02@email.com', 1, 12),
(13, 'Passenger', 'Passenger 04', 'address_02', '0112333444', 0, 'id_00055', 'passenger01@email.com', 1, 21),
(14, 'Passenger', 'Passenger 05', 'address_05', '0112264544', 0, '0', 'passenger05@email.com', 0, 21),
(15, 'Passenger', 'Passenger 06', 'address_16', '01115555545', 0, '0', 'passenger06@email.com', 0, 20);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_no` int(11) NOT NULL,
  `id` varchar(63) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state` tinyint(3) DEFAULT NULL,
  `file_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_no`, `id`, `name`, `state`, `file_no`) VALUES
(0, '12347', 'Service_00', 1, 14),
(1, '1234', 'Service_01', 0, 0),
(2, '1235', 'Service_02', 2, 12),
(3, '1236', 'Service_03', 0, NULL),
(4, '7789', 'Service_04', 0, NULL),
(5, '12341', 'Service_05', 0, NULL),
(10, '66557', 'Service_06', 0, NULL),
(11, '5678J', 'Control', 0, NULL),
(12, 'controlddd', 'Lolcorp', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_no` int(11) NOT NULL,
  `user_id` varchar(63) DEFAULT NULL,
  `account_type` tinyint(7) DEFAULT NULL,
  `account_no` int(11) DEFAULT NULL,
  `password` varchar(127) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_id`, `account_type`, `account_no`, `password`) VALUES
(1, '00001', 0, 1, '$2y$10$37EvLvkiz63zBdMu.UIJBePzUILCOZesvYEVoA3g6HPntZWJYywmS'),
(2, '11111', 1, 1, '$2y$10$P4cAldUkBB5Snd8YBjQCWe4qhl3kpPlufr64M1YtZIkQJbecdwReq'),
(3, '22221', 2, 1, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(4, '44444', 4, NULL, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(5, '33333', 3, NULL, '$2y$10$gm8Zj/Cs21LLO0MCTn4gaOJdcptx0Ww.M41.dLigsSBhQj1vWrkDa'),
(6, '00002', 0, 2, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(12, '22222', 2, 2, '$2y$10$fpVgPBZJIPyARxI3cOclCu2//wp3EGqiDdL6K/1dNrgZefgEFlJmu'),
(13, '22223', 2, 3, '$2y$10$0aXxYAcL64RYNEkLVXG0Y.mS9d/8HhuUpUqMEfpVFzDCxek8OTAxi'),
(15, '22224', 2, 4, '$2y$10$FSCaietGlTu0uebPP8uzf.mKCccfbWFWlJdKc1DwAS7pkvlrpMBaq'),
(17, '11112', 1, 4, '$2y$10$NffzaIhdhz.vtBSkdOcrseoAWcuxOpmk.wcopEJoP3ZxJxkpQl7gy'),
(18, '11113', 1, 5, '$2y$10$n47x2N.dOG.tcumdo0xyHOqABqCzaOAl3QBNtXq0.DGFw.dbrwAzO'),
(19, '11114', 1, 6, '$2y$10$RtyqAEBTClf6gLEKcLHQp.7ZXxgG0FMSxQxgAo05Z2/Fil.ZrzQHq'),
(20, '11115', 1, 7, '$2y$10$oQv.3l/X8d/MmCw/F3TlguHG6fbh3EixNXFIj/ZXJgqe7U3u2kbt.'),
(21, '00004', 0, 13, '$2y$10$rMjmUs9qkxLR9.K1B7C8/e9Kt9fR4zXxu8eC7jR1i8HE2htdvCZL.'),
(22, '00005', 0, 14, '$2y$10$DIL7xwr9pYYDxuZd5x3Y8uzA4hN6tcNfdt9pVdwSHIFbpHuW8cI9q'),
(23, '00006', 0, 15, '$2y$10$pRaILrn8yk0qUJ1bR.Iiuu1RqfANJn7VrOK5O2yLZ035eiXy5VSpK'),
(24, '22225', 2, 5, '$2y$10$JI1pheRGyl0FioFBt9gVKeSfRkVnpP1dKUY7OgoGpsp2NdbiKQctO'),
(27, '22226', 2, 6, '$2y$10$cZ6sI1gCV1h3phrqX.HIZu6lTJ1MKpOi1eOC1mavipdb.CKs.lZOu'),
(28, '22227', 2, 7, '$2y$10$0Uh0Lb1C8SFPOQRuXc6.EeRmgOFTelaKrKY8FN637Ul9xQYPHJSmm'),
(30, '11118', 1, 10, '$2y$10$kdEvCM4IeqYHCobLMFIpmOcAj0gzNbh/NpijutteHQcKAgU7Y8KmW'),
(31, '6789V', 2, 8, '$2y$10$ph2OaCuFb/KPYt/ecDZmKuYmPufT3Xc64GB29A/qOQx1xU/jTRyUC'),
(32, '123456789', 2, 9, '$2y$10$M/JhaNhHEp.LFmjOTKgB8e8wGNIiZdIDaYd.GtVnPQK0UdxjjYfyW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_no`),
  ADD KEY `service_no` (`service_no`),
  ADD KEY `pickup_district` (`pickup_district`),
  ADD KEY `destination_district` (`destination_district`);

--
-- Indexes for table `conductor`
--
ALTER TABLE `conductor`
  ADD PRIMARY KEY (`conductor_no`),
  ADD KEY `first_name` (`first_name`) USING BTREE,
  ADD KEY `district_no` (`district_no`);

--
-- Indexes for table `conductor_leave`
--
ALTER TABLE `conductor_leave`
  ADD PRIMARY KEY (`leave_no`),
  ADD KEY `conductor_no` (`conductor_no`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_no`);

--
-- Indexes for table `executive`
--
ALTER TABLE `executive`
  ADD PRIMARY KEY (`executive_no`),
  ADD KEY `first_name` (`first_name`) USING BTREE,
  ADD KEY `service_no` (`service_no`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_no`);

--
-- Indexes for table `notification_config_data`
--
ALTER TABLE `notification_config_data`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`pass_no`),
  ADD KEY `pass_ibfk_1` (`passenger_no`),
  ADD KEY `pass_ibfk_2` (`service_no`),
  ADD KEY `file_no` (`file_no`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_no`),
  ADD KEY `first_name` (`first_name`) USING BTREE,
  ADD KEY `passenger_ibfk_1` (`service_no`),
  ADD KEY `file_no` (`file_no`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_no`),
  ADD KEY `file_no` (`file_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `conductor`
--
ALTER TABLE `conductor`
  MODIFY `conductor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conductor_leave`
--
ALTER TABLE `conductor_leave`
  MODIFY `leave_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `executive`
--
ALTER TABLE `executive`
  MODIFY `executive_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notification_config_data`
--
ALTER TABLE `notification_config_data`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pass`
--
ALTER TABLE `pass`
  MODIFY `pass_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`pickup_district`) REFERENCES `district` (`district_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`destination_district`) REFERENCES `district` (`district_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conductor`
--
ALTER TABLE `conductor`
  ADD CONSTRAINT `conductor_ibfk_1` FOREIGN KEY (`district_no`) REFERENCES `district` (`district_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `conductor_leave`
--
ALTER TABLE `conductor_leave`
  ADD CONSTRAINT `conductor_leave_ibfk_1` FOREIGN KEY (`conductor_no`) REFERENCES `conductor` (`conductor_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `executive`
--
ALTER TABLE `executive`
  ADD CONSTRAINT `executive_ibfk_1` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `passenger_ibfk_2` FOREIGN KEY (`file_no`) REFERENCES `files` (`file_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
