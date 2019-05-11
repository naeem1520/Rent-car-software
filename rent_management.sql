-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2019 at 07:59 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_information`
--

CREATE TABLE `booking_information` (
  `id` int(20) NOT NULL,
  `s_l` varchar(10) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `c_address` varchar(20) NOT NULL,
  `c_number` varchar(20) NOT NULL,
  `car_model` varchar(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `pick_address` varchar(30) NOT NULL,
  `end_address` varchar(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `driver_name` varchar(20) NOT NULL,
  `assign_car` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `car_track_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_information`
--

INSERT INTO `booking_information` (`id`, `s_l`, `c_name`, `c_address`, `c_number`, `car_model`, `day`, `pick_address`, `end_address`, `date`, `driver_name`, `assign_car`, `amount`, `car_track_no`) VALUES
(8, '107', 'Reftifffffffff', 'Uttara', '25555', '25s', '3', 'airport', 'auttara', '04/18/2019', 'Kalu', 'siyam', '200033', 'CAR-SQXOAM'),
(11, '110', 'Refti', 'Uttara', '25555', '25s', '3', 'airport', 'auttara', '04/20/2019', 'Kalu', 'x corolla', '200', 'CAR-D3R8GI'),
(14, '112', 'Refti', 'Uttara', '01717228114', '8569', '3', 'airport', 'auttara', '04/20/2019', 'Kalu', 'Apolo', '200033', 'CAR-J7YWHX');

-- --------------------------------------------------------

--
-- Table structure for table `car_information`
--

CREATE TABLE `car_information` (
  `id` int(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `model_number` varchar(30) NOT NULL,
  `registration_number` varchar(30) NOT NULL,
  `owner_address` varchar(20) NOT NULL,
  `car_color` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL,
  `image_link` varchar(20) NOT NULL,
  `car_track_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car_information`
--

INSERT INTO `car_information` (`id`, `name`, `owner_name`, `phone`, `model_number`, `registration_number`, `owner_address`, `car_color`, `price`, `image_link`, `car_track_no`) VALUES
(20, 'honda', 'refat', '01717228114', '2015', '12356', 'Sec-10,Uttara,Dhaka', 'Blue', '3000', 'uploads/1222.jpg', 'CAR-OND0QV'),
(21, 'x corolla', 'puspo', '0158964566', '2013', '85736', 'Board bazar', 'Blue', '3200', 'uploads/download.jpg', 'CAR-D3R8GI'),
(22, 'siyam', 'Siyam', '876876767676', '2013', '2564853965', 'Uttara', 'Blue', '2564', 'uploads/DSC_0391.jpg', 'CAR-SQXOAM'),
(23, 'Apolo', 'Siyam', '876876767676', '2015', '25648533', 'Uttara', 'Orange', '2500', 'uploads/DSC_0379.jpg', 'CAR-J7YWHX');

-- --------------------------------------------------------

--
-- Table structure for table `create_user`
--

CREATE TABLE `create_user` (
  `id` int(10) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` enum('general_manager','manager') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `create_user`
--

INSERT INTO `create_user` (`id`, `user_name`, `email`, `password`, `role`) VALUES
(1, 'Esita', 'eshita@gmail.com', '123456', 'general_manager'),
(2, 'eshita begum', 'eshita02@gmail.com', '123456', 'general_manager'),
(3, 'Puspo', 'puspo@gmail.com', '123456', 'manager'),
(5, 'lupa', 'lupa@gmail.com', '123', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `driver_information`
--

CREATE TABLE `driver_information` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `blood_group` varchar(10) NOT NULL,
  `address` varchar(20) NOT NULL,
  `permanent_address` varchar(20) NOT NULL,
  `assign_car` varchar(20) NOT NULL,
  `image_link` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_information`
--

INSERT INTO `driver_information` (`id`, `name`, `phone_number`, `nid`, `license_number`, `blood_group`, `address`, `permanent_address`, `assign_car`, `image_link`) VALUES
(12, 'siam', '01944561363', '1999256482549', '6548966', 'B+', 'konabari', 'uttara2', '', 'uploads/DSC_0410.jpg'),
(13, 'siyam', '2144', '854662', '2322', 'B9', 'gfhfggv ghvhjvhg', 'uttara2', '', 'uploads/1222.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(20) NOT NULL,
  `s_n` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `booking_number` varchar(20) NOT NULL,
  `name` varchar(15) NOT NULL,
  `c_name` varchar(20) NOT NULL,
  `oil_number` varchar(20) NOT NULL,
  `oil_amount` varchar(20) NOT NULL,
  `cng_number` varchar(20) NOT NULL,
  `cng_amount` varchar(20) NOT NULL,
  `toll_number` varchar(20) NOT NULL,
  `toll_amount` varchar(20) NOT NULL,
  `lunch` varchar(20) NOT NULL,
  `dinner` varchar(20) NOT NULL,
  `salary` varchar(20) NOT NULL,
  `Total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `s_n`, `date`, `booking_number`, `name`, `c_name`, `oil_number`, `oil_amount`, `cng_number`, `cng_amount`, `toll_number`, `toll_amount`, `lunch`, `dinner`, `salary`, `Total`) VALUES
(2, '102', '2019-04-11', '102', 'Kalu', 'toyota', '22222', '252', '3245', '256', '2548', '3333', '25', '36', '254', ''),
(3, '103', '2019-04-12', '103', 'mia', 'x corolla', '22222', '252', '3245', '256', '2548', '33335', '25', '36', '254', ''),
(4, '104', '2019-04-10', '104', 'Kalu', 'toyota', '22222', '252', '3245', '256', '2548', '3333', '25', '36', '254', ''),
(8, '106', '04/13/2019', '107', 'Kalu', 'siyam', '22222', '252', '3245', '256', '2548', '33335', '25', '36', '254', '34158'),
(9, '107', '04/18/2019', '107', 'Kalu', 'siyam', '22222', '252', '3245', '256', '2548', '3333', '333', '36', '254', '4464'),
(10, '108', '04/18/2019', '107', 'Kalu', 'siyam', '22222', '252', '3245', '256', '2548', '33335', '333', '3655', '2603', '40434'),
(11, '109', '04/20/2019', '112', 'Kalu', 'Apolo', '22222', '200', '3245', '300', '2548', '100', '20', '30', '200', '850');

-- --------------------------------------------------------

--
-- Table structure for table `regestration`
--

CREATE TABLE `regestration` (
  `id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regestration`
--

INSERT INTO `regestration` (`id`, `name`, `email`, `password`, `type`) VALUES
(6, 'eva', 'eva@gmail.com', '123456', 'general_manager'),
(8, 'Eshita', 'eshita@gmail.com', '123456', 'general_manager'),
(9, 'refat', 'refat@gmail.com', '123456', 'general_manager'),
(10, 'mabia', 'mabia@gmail.com', '123', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_information`
--
ALTER TABLE `booking_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_information`
--
ALTER TABLE `car_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_user`
--
ALTER TABLE `create_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_information`
--
ALTER TABLE `driver_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regestration`
--
ALTER TABLE `regestration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_information`
--
ALTER TABLE `booking_information`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `car_information`
--
ALTER TABLE `car_information`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `create_user`
--
ALTER TABLE `create_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `driver_information`
--
ALTER TABLE `driver_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `regestration`
--
ALTER TABLE `regestration`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
