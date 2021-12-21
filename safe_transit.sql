-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2021 at 06:06 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.26

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
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `pickup_district` int(11) DEFAULT NULL,
  `destination_district` int(11) DEFAULT NULL,
  `state` tinyint(7) NOT NULL DEFAULT '0',
  `booked_conductor_no` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_no`, `service_no`, `start_date`, `end_date`, `pickup_district`, `destination_district`, `state`, `booked_conductor_no`) VALUES
(1, 1, '2021-12-17', '2021-12-19', 2, 3, 0, 0),
(2, 1, '2021-11-24', '2021-11-30', 1, 1, 1, 1),
(3, 0, '2021-11-25', '2021-11-26', 12, 17, 0, 0),
(4, 0, '2021-11-26', '2021-11-30', 11, 20, 0, 0);

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
(7, 'Conductor', 'Conductor 05', 'Address 67', '0112243355', 'NC-1112', 1, 'conductor05@email.com', 0);

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
(1, 'Executive', 'Executive 00', 'address 03', '0112131334', 0, 'executive00@email.com', 2),
(2, 'Executive', 'Executive 01', 'address 08', '0111555555', 1, 'executive01@email.com', 0),
(3, 'Executive', 'Executive 02', 'address 08', '0111165615', 2, 'executive02@email.com', 2),
(4, 'Executive', 'Executive 03', 'address 16', '0115555555', 3, 'executive03@email.com', 0),
(5, 'Executive', 'Executive 04', 'address_16', '0112233344', 4, 'executive04@email.com', 0);

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
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pass`
--

INSERT INTO `pass` (`pass_no`, `passenger_no`, `service_no`, `start_date`, `end_date`, `state`, `bus_route`, `reason`) VALUES
(3, 3, 0, '2021-11-24', '2021-11-26', 3, '138', 'Reason 01'),
(4, 1, 2, '2021-11-25', '2021-11-30', 1, '154', 'Reason 04');

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
  `state` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_no`, `first_name`, `last_name`, `address`, `telephone`, `service_no`, `staff_id`, `email`, `state`) VALUES
(1, 'Passenger test', 'Passenger 01', 'address_01', '0112233456', 0, '0', 'passenger01@email.com', 0),
(2, 'Passenger', 'Passenger 02', 'address 06', '2131321321', 1, 'id_00111', 'passenger02@email.com', 1),
(3, 'Passenger', 'Passenger 03', 'address 07', '012312312', 0, 'id_00045', 'passenger03@email.com', 2),
(13, 'Passenger', 'Passenger 04', 'address_02', '0112333444', 0, 'id_00432', 'passenger01@email.com', 2),
(14, 'Passenger', 'Passenger 05', 'address_05', '0112264544', 0, '0', 'passenger05@email.com', 0),
(15, 'Passenger', 'Passenger 06', 'address_16', '01115555545', 0, '0', 'passenger06@email.com', 0),
(16, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(17, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(18, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(19, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(20, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(21, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(22, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0),
(24, 'Nimesh', 'Ariyarathna', 'address 06', '0766946998', 0, '0', 'nimeshariyarathna@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_no` int(11) NOT NULL,
  `id` varchar(63) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `state` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_no`, `id`, `name`, `state`) VALUES
(0, '12347', 'Service_00', 2),
(1, '1234', 'Service_01', 0),
(2, '1235', 'Service_02', 2),
(3, '1236', 'Service_03', 0),
(4, '7789', 'Service_04', 0);

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
(1, '00001', 0, 1, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(2, '11111', 1, 1, '$2y$10$P4cAldUkBB5Snd8YBjQCWe4qhl3kpPlufr64M1YtZIkQJbecdwReq'),
(3, '22221', 2, 1, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(4, '44444', 4, NULL, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(5, '33333', 3, NULL, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(6, '00002', 0, 2, '$2y$10$.f.4MwYpe2liGsjeVxKxUOJx8m0uwqk0Z8a./7.SyvvyRwNDVQd2O'),
(12, '22222', 2, 2, '$2y$10$fpVgPBZJIPyARxI3cOclCu2//wp3EGqiDdL6K/1dNrgZefgEFlJmu'),
(13, '22223', 2, 3, '$2y$10$0aXxYAcL64RYNEkLVXG0Y.mS9d/8HhuUpUqMEfpVFzDCxek8OTAxi'),
(14, '00003', 0, 3, '$2y$10$qikoT17Bo2kU/ElAsjvfiuRG3/CrNI.14ktugXA6VmzW2312a0FVG'),
(15, '22224', 2, 4, '$2y$10$FSCaietGlTu0uebPP8uzf.mKCccfbWFWlJdKc1DwAS7pkvlrpMBaq'),
(16, '11112', 1, 3, '$2y$10$TGL2xlNFZvZjbTH5m4Awuucc37gcG6rXe/8EYptGLA/TFtQ9IZpqO'),
(17, '11112', 1, 4, '$2y$10$NffzaIhdhz.vtBSkdOcrseoAWcuxOpmk.wcopEJoP3ZxJxkpQl7gy'),
(18, '11113', 1, 5, '$2y$10$n47x2N.dOG.tcumdo0xyHOqABqCzaOAl3QBNtXq0.DGFw.dbrwAzO'),
(19, '11114', 1, 6, '$2y$10$RtyqAEBTClf6gLEKcLHQp.7ZXxgG0FMSxQxgAo05Z2/Fil.ZrzQHq'),
(20, '11115', 1, 7, '$2y$10$oQv.3l/X8d/MmCw/F3TlguHG6fbh3EixNXFIj/ZXJgqe7U3u2kbt.'),
(21, '00004', 0, 13, '$2y$10$rMjmUs9qkxLR9.K1B7C8/e9Kt9fR4zXxu8eC7jR1i8HE2htdvCZL.'),
(22, '00005', 0, 14, '$2y$10$DIL7xwr9pYYDxuZd5x3Y8uzA4hN6tcNfdt9pVdwSHIFbpHuW8cI9q'),
(23, '00006', 0, 15, '$2y$10$pRaILrn8yk0qUJ1bR.Iiuu1RqfANJn7VrOK5O2yLZ035eiXy5VSpK'),
(24, '22225', 2, 5, '$2y$10$JI1pheRGyl0FioFBt9gVKeSfRkVnpP1dKUY7OgoGpsp2NdbiKQctO');

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
-- Indexes for table `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`pass_no`),
  ADD KEY `pass_ibfk_1` (`passenger_no`),
  ADD KEY `pass_ibfk_2` (`service_no`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_no`),
  ADD KEY `first_name` (`first_name`) USING BTREE,
  ADD KEY `passenger_ibfk_1` (`service_no`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_no`);

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
  MODIFY `booking_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `conductor`
--
ALTER TABLE `conductor`
  MODIFY `conductor_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `executive`
--
ALTER TABLE `executive`
  MODIFY `executive_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pass`
--
ALTER TABLE `pass`
  MODIFY `pass_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `passenger_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
-- Constraints for table `executive`
--
ALTER TABLE `executive`
  ADD CONSTRAINT `executive_ibfk_1` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pass`
--
ALTER TABLE `pass`
  ADD CONSTRAINT `pass_ibfk_1` FOREIGN KEY (`passenger_no`) REFERENCES `passenger` (`passenger_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pass_ibfk_2` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`service_no`) REFERENCES `service` (`service_no`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
