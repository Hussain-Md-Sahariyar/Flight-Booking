-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 01:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airlinesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@biman.com', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `booking_oneway`
--

CREATE TABLE `booking_oneway` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date DEFAULT curdate(),
  `issue_before` datetime DEFAULT (current_timestamp() + interval 5 hour),
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `passport_expiry_date` date DEFAULT NULL,
  `flight_no` varchar(20) DEFAULT NULL,
  `flying_from` varchar(50) DEFAULT NULL,
  `flying_to` varchar(50) DEFAULT NULL,
  `departure_city_code` varchar(10) DEFAULT NULL,
  `arrival_city_code` varchar(10) DEFAULT NULL,
  `departure_terminal` varchar(10) DEFAULT NULL,
  `arrival_terminal` varchar(10) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` varchar(100) DEFAULT NULL,
  `arrival_time` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `baggage_type` varchar(20) DEFAULT NULL,
  `check_in_baggage` varchar(20) DEFAULT NULL,
  `frequent_flyer_airline` varchar(50) DEFAULT NULL,
  `frequent_flyer_no` varchar(20) DEFAULT NULL,
  `base_fare` int(10) DEFAULT NULL,
  `taxes` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` int(20) DEFAULT NULL,
  `booking_reference` char(6) NOT NULL,
  `fare_basis` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_oneway`
--

INSERT INTO `booking_oneway` (`booking_id`, `booking_date`, `issue_before`, `title`, `first_name`, `last_name`, `date_of_birth`, `passport_no`, `passport_expiry_date`, `flight_no`, `flying_from`, `flying_to`, `departure_city_code`, `arrival_city_code`, `departure_terminal`, `arrival_terminal`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `class`, `baggage_type`, `check_in_baggage`, `frequent_flyer_airline`, `frequent_flyer_no`, `base_fare`, `taxes`, `price`, `country`, `email`, `contact`, `booking_reference`, `fare_basis`) VALUES
(297354, '2025-03-22', '2025-03-23 04:20:07', 'Mr', 'Samir', 'Nicholson', '2013-03-14', 'EK2917258', '2025-09-24', 'BG 305', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '2', 'A', '2025-03-23', '2025-03-24', '12:15', '06:45', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 66503, 55329, 135268, 'Bangladesh', 'mail@mail.com', 35123451, 'T53UPG', '4ZEQ36'),
(297355, '2025-04-06', '2025-04-06 19:51:59', 'Mr', 'ddd', 'd', '2012-12-11', 'aef4trt', '2025-10-21', 'BG 236', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-07', '2025-04-08', '15:00', '10:30', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 39059, 33366, 72425, 'Bangladesh', 'asdscddsdsd@mail.com', 45435, '6K17RU', 'PNU3QX'),
(297356, '2025-04-06', '2025-04-06 20:18:15', 'Mr', 'abdul', 'karim', '2013-04-02', 'sdfh7eru', '2025-10-29', 'BG 236', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-07', '2025-04-08', '15:00', '10:30', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 39059, 33366, 72425, 'Bangladesh', 'farhad@mail.com', 251210, 'REJBKS', 'TFMG6D'),
(297357, '2025-04-15', '2025-04-15 20:37:15', 'Mr', 'Abdullah', 'Hamid', '2013-04-01', 'asmysdgfhdvc', '2025-10-31', 'BG 662', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-15', '2025-04-16', '23:10', '07:15', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 76211, 16120, 92331, 'Bangladesh', 'abdul1@gmail.com', 1000000000, 'JE7PCJ', 'D1SGTD'),
(297358, '2025-04-15', '2025-04-15 20:54:16', 'Mr', 'HOSSAIN', 'ALI', '2013-04-08', 'FG5485584', '2025-10-29', 'BG 662', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-15', '2025-04-16', '23:10', '07:15', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 76211, 16120, 92331, 'Bangladesh', 'ali1@gmail.com', 1000000000, 'SBYN3A', 'U52JBN');

--
-- Triggers `booking_oneway`
--
DELIMITER $$
CREATE TRIGGER `generate_booking_reference` BEFORE INSERT ON `booking_oneway` FOR EACH ROW BEGIN
    DECLARE rand_code CHAR(6);
    
    -- Generate the 6-digit alphanumeric code using allowed characters (no 'O', 'I', 'L')
    SET rand_code = CONCAT(
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1)
    );
    
    -- Set the generated code in the new row
    SET NEW.booking_reference = rand_code;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_fare_basis` BEFORE INSERT ON `booking_oneway` FOR EACH ROW BEGIN
    DECLARE rand_code CHAR(6);
    
    -- Generate the 6-digit alphanumeric code using allowed characters (no 'O', 'I', 'L')
    SET rand_code = CONCAT(
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1),
        SUBSTRING('ABCDEFGHJKMNPQRSTUVWXYZ1234567890', FLOOR(1 + (RAND() * 30)), 1)
    );
    
    -- Set the generated code in the new row
    SET NEW.fare_basis = rand_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `flights_oneway`
--

CREATE TABLE `flights_oneway` (
  `flight_no` varchar(20) NOT NULL,
  `flying_from` varchar(100) NOT NULL,
  `flying_to` varchar(100) NOT NULL,
  `departure_city_code` varchar(100) DEFAULT NULL,
  `arrival_city_code` varchar(100) DEFAULT NULL,
  `departure_city` varchar(100) DEFAULT NULL,
  `arrival_city` varchar(100) DEFAULT NULL,
  `departure_airport` varchar(100) DEFAULT NULL,
  `arrival_airport` varchar(100) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` varchar(100) DEFAULT NULL,
  `arrival_time` varchar(100) DEFAULT NULL,
  `departure_terminal` varchar(10) DEFAULT NULL,
  `arrival_terminal` varchar(10) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `refundable` varchar(100) DEFAULT NULL,
  `aircraft` varchar(100) DEFAULT NULL,
  `available_seats` int(11) DEFAULT NULL,
  `baggage_type` varchar(50) DEFAULT NULL,
  `cabin_baggage` varchar(50) DEFAULT NULL,
  `check_in_baggage` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `base_fare` int(11) DEFAULT NULL,
  `taxes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights_oneway`
--

INSERT INTO `flights_oneway` (`flight_no`, `flying_from`, `flying_to`, `departure_city_code`, `arrival_city_code`, `departure_city`, `arrival_city`, `departure_airport`, `arrival_airport`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `departure_terminal`, `arrival_terminal`, `duration`, `class`, `refundable`, `aircraft`, `available_seats`, `baggage_type`, `cabin_baggage`, `check_in_baggage`, `price`, `base_fare`, `taxes`) VALUES
('BG 309', 'Dhaka', 'Toronto', 'DAC', 'YYZ', 'Bangladesh', 'Canada', 'Hazrat Shahjalal International Airport', 'Pearson International Airport', '2025-04-15', '2025-04-16', '23:25', '10:00', '2', '-', '21 hours 5 minutes', 'Economy', 'Refundable', 'Boeing 787-9', 4, 'Adult', '7 Kg(s)', '50 Kg(s)', 34095, 24425, 13343),
('BG 327', 'Dhaka', 'Abu Dhabi', 'DAC', 'AUH', 'Bangladesh', 'United Arab Emirates', 'Hazrat Shahjalal International Airport', 'Abu Dhabi International Airport', '2024-12-03', '2024-12-04', '21:10', '01:00', '2', 'A', '5 hours 50 minutes', 'Economy', 'Refundable', 'Boeing 737-800', 250, 'Adult', '7 Kg(s)', '30 Kg(s)', 34095, 24425, 9670),
('BG 395', 'Dhaka', 'Abu Dhabi', 'DAC', 'AUH', 'Bangladesh', 'United Arab Emirates', 'Hazrat Shahjalal International Airport', 'Abu Dhabi International Airport', '2024-12-03', '2024-12-04', '17:10', '03:50', '2', 'A', '5 hours 45 minutes', 'Economy', 'Refundable', 'Boeing 787-8', 250, 'Adult', '7 Kg(s)', '30 Kg(s)', 74010, 57639, 16371),
('BG 397', 'Dhaka', 'Abu Dhabi', 'DAC', 'AUH', 'Bangladesh', 'United Arab Emirates', 'Hazrat Shahjalal International Airport', 'Abu Dhabi International Airport', '2024-12-03', '2024-12-03', '12:00', '15:00', '2', 'A', '5 hours 50 minutes', 'Economy', 'Refundable', 'Boeing 737-800', 250, 'Adult', '7 Kg(s)', '30 Kg(s)', 97873, 79940, 17933),
('BG 447', 'Dhaka', 'Toronto', 'DAC', 'YYZ', 'Bangladesh', 'Canada', 'Hazrat Shahjalal International Airport', 'Pearson International Airport', '2025-04-15', '2025-04-16', '23:55', '13:55', '2', '1', '21 hours 5 minutes', 'Economy', 'Refundable', 'Boeing 787-9', 250, 'Adult', '7 Kg(s)', '50 Kg(s)', 135268, 78210, 57058),
('BG 662', 'Dhaka', 'Toronto', 'DAC', 'YYZ', 'Bangladesh', 'Canada', 'Hazrat Shahjalal International Airport', 'Pearson International Airport', '2025-04-15', '2025-04-16', '23:10', '07:15', '1', '3', '21 hours 5 minutes', 'Economy', 'Refundable', 'Boeing 737-800', 250, 'Adult', '7 Kg(s)', '50 Kg(s)', 92331, 76211, 16120),
('BG 721', 'Dhaka', 'Abu Dhabi', 'DAC', 'AUH', 'Bangladesh', 'United Arab Emirates', 'Hazrat Shahjalal International Airport', 'Abu Dhabi International Airport', '2024-12-02', '2024-12-03', '21:45', '01:25', '-', 'A', '7 hours 50 minutes', 'Economy', 'Refundable', 'Boeing 787-8', 250, 'Adult', '7 Kg(s)', '30 Kg(s)', 57883, 42999, 14884),
('BG982', 'Dhaka', 'Toronto', 'DAC', 'YYZ', 'Bangladesh', 'Canada', 'Hazrat Shahjalal International Airport', 'Pearson International Airport', '2025-04-16', '2025-04-17', '18:00', '13:00', '2', 'D', '13 hours 45 minutes', 'Economy', 'Refundable', 'Boeing 737-800', 400, 'Adult', '7 Kg(s)', '50 Kg(s)', 110000, 90000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `issue_oneway`
--

CREATE TABLE `issue_oneway` (
  `booking_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `eTicket` bigint(20) NOT NULL,
  `booking_reference` char(6) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `flight_no` varchar(20) DEFAULT NULL,
  `flying_from` varchar(50) DEFAULT NULL,
  `flying_to` varchar(50) DEFAULT NULL,
  `departure_city_code` varchar(10) DEFAULT NULL,
  `arrival_city_code` varchar(10) DEFAULT NULL,
  `departure_terminal` varchar(10) DEFAULT NULL,
  `arrival_terminal` varchar(10) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` varchar(100) DEFAULT NULL,
  `arrival_time` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `baggage_type` varchar(20) DEFAULT NULL,
  `check_in_baggage` varchar(20) DEFAULT NULL,
  `frequent_flyer_airline` varchar(50) DEFAULT NULL,
  `frequent_flyer_no` varchar(20) DEFAULT NULL,
  `fare_basis` char(6) DEFAULT NULL,
  `base_fare` int(10) DEFAULT NULL,
  `taxes` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_oneway`
--

INSERT INTO `issue_oneway` (`booking_id`, `issue_date`, `eTicket`, `booking_reference`, `title`, `first_name`, `last_name`, `date_of_birth`, `passport_no`, `flight_no`, `flying_from`, `flying_to`, `departure_city_code`, `arrival_city_code`, `departure_terminal`, `arrival_terminal`, `departure_date`, `arrival_date`, `departure_time`, `arrival_time`, `class`, `baggage_type`, `check_in_baggage`, `frequent_flyer_airline`, `frequent_flyer_no`, `fare_basis`, `base_fare`, `taxes`, `price`, `country`, `email`, `contact`) VALUES
(297357, '2025-04-15', 9975496501720, 'JE7PCJ', 'Mr', 'Abdullah', 'Hamid', '2013-04-01', 'asmysdgfhdvc', 'BG 662', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-15', '2025-04-16', '23:10', '07:15', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 'D1SGTD', 76211, 16120, 92331, 'Bangladesh', 'abdul1@gmail.com', 1000000000),
(297358, '2025-04-15', 9975496501721, 'SBYN3A', 'Mr', 'HOSSAIN', 'ALI', '2013-04-08', 'FG5485584', 'BG 662', 'Dhaka', 'Toronto', 'DAC', 'YYZ', '1', '3', '2025-04-15', '2025-04-16', '23:10', '07:15', 'Economy', 'Adult', '50 Kg(s)', NULL, NULL, 'U52JBN', 76211, 16120, 92331, 'Bangladesh', 'ali1@gmail.com', 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `booking_id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `phone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`booking_id`, `invoice`, `price`, `phone`) VALUES
(297357, 'D67fe28f92ada8', 92331.00, 1000000000),
(297358, 'D67fe2cdd9f9fa', 92331.00, 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `signupinfo`
--

CREATE TABLE `signupinfo` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postal_code` int(10) DEFAULT NULL,
  `country_code` int(10) DEFAULT NULL,
  `phone_number` int(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signupinfo`
--

INSERT INTO `signupinfo` (`id`, `first_name`, `last_name`, `address`, `city`, `country`, `postal_code`, `country_code`, `phone_number`, `email`, `password`, `profession`) VALUES
(40, 'DAUD', 'IBRAHIM', 'DOWNTOWN', 'DHAKA', 'BANGLADESH', 1200, 1, 2147483647, 'daud.ibrahim@gmail.com', '$2y$10$PwgadbZVeu6xThDgvWavc.lQAzXzhI6oXH6vbDMIGG0NsCESiXnb6', NULL),
(41, 'DAUD', 'IBRAHIM', 'New City Downtown', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'daud.ibrahim@yahoo.com', '$2y$10$n2w.vMaSGOE.j6uJaQ6jwun/YNRSq8soxxu2JZi.v00Tu2TGquuEC', NULL),
(42, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'daud@yahoo.com', '$2y$10$JiPrftmc4KSaq9KHKQ3/q.A6mN0rnBNEjIuylwk8L1k10vWW1AYT6', NULL),
(49, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'gmail@mail.com', '$2y$10$GLgb6pwkEJIQ8bvwX7Lvy.BotuFWKQi9zVDD.xm6sTeU48EIy/isu', NULL),
(51, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 't@mail.com', '$2y$10$jY1YpNVymDg9opjnixWYfeHC7rT47EMK8rGStiD2JrZLYsGXgAQuO', NULL),
(52, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'hamid@mail.com', '$2y$10$eUGEv7T4PQObTRylq2jX.emwT9rkv9hthbS1DmAQBHl17v4cNO4Uu', NULL),
(53, 'HASAN', 'IBRAHIM', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 2147483647, 'hasan@mail.com', '$2y$10$6j4Z75GZFAhml3YZ11UIZOcHT9sm/ojcT7ez5JelzXqaTKLCD3A4i', NULL),
(54, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 44, 429827365, 'faysal@mail.com', '$2y$10$cp.qro9aZUIPPu8mN6DRWuvOLIEnmTkXjXxsyG1mAbO0Q6IPjlidu', NULL),
(55, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'jifam@mail.com', '$2y$10$bzHwCJG/ILZIaeOkx5B5.eYoVdzxdPj8xiyPDQ6q1196W45pb4sOa', NULL),
(56, 'Abdul', 'Ahad', 'Bashundhara R/A', 'Dhaka', 'Bangladesh', 1220, 1, 0, 'abdul.ahad@gmail.com', '$2y$10$xixgcdTqALRogMgzsgnnqeWWuhchLBCiQQHU4l0oZPcAzbQFRUmQa', NULL),
(57, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 429827365, 'abdullah123@mail.com', '$2y$10$qocU2rhpZjje4DCWr.Zsl.cWMSAdVAUU11k2doQ1YDyQZfmtX8jMy', NULL),
(59, 'Abdullah', 'Farhad', 'Dhaka', 'Dhaka', 'Bangladesh', 1200, 1, 0, 'farhad@mail.com', '$2y$10$1aFWt/GlvtlfPaskK1NYrOY2iJp0mUbYk4fG1F2swgI8dMURST/32', NULL),
(60, 'AKBAR', 'ALI', 'DHAKA', 'DHAKA', 'BANGLADESH', 1200, 1, 0, 'ali@gmail.com', '$2y$10$g1IeZoVuw3d321b30yiW2.mWB0pfP4eV3MzVPgYgLjPjd6ppEJ3iy', NULL),
(61, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 0, 'hamid1@mail.com', '$2y$10$j2UCfeOHs877R30IfhZvie2fOkJRad58IM6K7dy5McBEa32sNql5u', NULL),
(62, 'ABDULLAH', 'HAMID', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 1200, 1, 2147483647, 'abdul1@gmail.com', '$2y$10$Q2gfpb89Z3.XWWWUrieFjO6OTnNC/vwsaxt93eX.QAYpQPJoRGq.i', NULL),
(63, 'ALI', 'UDDIN', 'BASHUNDHARA', 'DHAKA', 'BANGLADESH', 3566, 1, 2147483647, 'ali1@gmail.com', '$2y$10$tMjFG/rcdXzcg5iPbqkZPOMJbGRWNQTUNv0HgB17jw5AukZZ/ipdW', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `booking_oneway`
--
ALTER TABLE `booking_oneway`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `flights_oneway`
--
ALTER TABLE `flights_oneway`
  ADD PRIMARY KEY (`flight_no`,`flying_from`,`flying_to`,`departure_date`) USING BTREE;

--
-- Indexes for table `issue_oneway`
--
ALTER TABLE `issue_oneway`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `eTicket` (`eTicket`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `signupinfo`
--
ALTER TABLE `signupinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_oneway`
--
ALTER TABLE `booking_oneway`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297359;

--
-- AUTO_INCREMENT for table `issue_oneway`
--
ALTER TABLE `issue_oneway`
  MODIFY `eTicket` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9975496501722;

--
-- AUTO_INCREMENT for table `signupinfo`
--
ALTER TABLE `signupinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_oneway` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
