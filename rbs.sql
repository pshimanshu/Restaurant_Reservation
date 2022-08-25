-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 08:11 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotelId` int(12) NOT NULL,
  `hotelName` varchar(255) NOT NULL,
  `hotelDesc` text NOT NULL,
  `hotelPrice` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotelId`, `HotelName`, `hotelDesc`, `hotelPrice`) VALUES
(1, 'Taj Hotel', 'The Taj Mahal Palace is a heritage, five-star, luxury hotel in the Colaba area of Mumbai, Maharashtra, India, situated next to the Gateway of India.', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `bookingitems`
--

CREATE TABLE `bookingitems` (
  `id` int(21) NOT NULL,
  `bookingId` int(21) NOT NULL,
  `itemId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `bookingId` int(21) NOT NULL,
  `slotId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `bookingStatus` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0=Booking Placed.\r\n1=Booking Confirmed.\r\n2=Event Completed.\r\n3=Booking Denied.\r\n4=Booking Cancelled.',
  `bookingDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `items` (
  `itemId` int(12) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `itemPrice` int(12) NOT NULL,
  `itemDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemId`, `itemName`, `itemPrice`, `itemDesc`) VALUES
(1,'Hyderabadi Biriyani',199,'The world-famous Hyderabadi Biriyani! This yummy meaty main course with the right amount of spices and flavour is every non-vegetarian\'s paradise.'),
(2,'Haleem',99,'This stew consists of lentils and meat along with pounded wheat and made into a thick paste'),
(3,'Phirni',79,'Easy on the stomach, this flavour infused dessert is the one to gorge on after a heavy and delicious meal.'),
(4,'Boti Kebab',125,'Small pieces of meat, marinated and cooked rapidly under intense heat, basted with butter or ghee. You will never forget the taste after you eat it'),
(5,'Qubani Ka Meetha',60,'Is made using dried apricots and usually topped with almonds. It can be eaten with ice-cream or can even be garnished with malai (thick cream)'),
(6,'Mirchi Ka Salan',60,'This gravy dish has coconut, peanuts and sesame seeds as a base and green chillis as the main ingredient.'),
(7,'Chicken 65',120,'This spicy deep fried starter garnished with coriander leaves, and onion is the best way to start your 3-course meal.'),
(8,'Pesarattu Dosa',100,'It is sided with ginger chutney, and this combination makes your taste buds go wild.'),
(9,'Lukhmi',135,'It is filled with spice infused minces lamb meat which is tangy and covered with an outer crispy layer and is a must try for any non-vegetarian.'),
(10,'Double ka Meetha',79,'This bread pudding dessert is made of bread slices soaked in saffron and cardamom infused milk.');

-- --------------------------------------------------------

--
-- Table structure for table `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact` bigint(21) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact`, `address`) VALUES
(1, 'Restaurant Booking', 'cprakash@iitk.ac.in', 2515469442, 'F608, HALL-13, IIT Kanpur.'),
(2, 'Restaurant Booking', 'indrasr@iitk.ac.in', 789852123, 'B203, HALL-13, IIT Kanpur.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 1111111111, '1', "admin"),
(2, 'indra', 'prakash', 'indra@gmail.com', 1234567890, '0', "cs315");


-- --------------------------------------------------------

--
-- Table structure for table `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotelId`);
ALTER TABLE `hotels` ADD FULLTEXT KEY `hotelName` (`hotelName`,`hotelDesc`);

--
-- Indexes for table `bookingitems`
--
ALTER TABLE `bookingitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingId`);

--
-- Indexes for table `item`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemId`);
ALTER TABLE `items` ADD FULLTEXT KEY `itemName` (`itemName`,`itemDesc`);

--
-- Indexes for table `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotelId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bookingitems`
--
ALTER TABLE `bookingitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingId` int(21) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


CREATE TABLE `slots` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `userid` int(11) NOT NULL,
 `date` date NOT NULL,
 `email` varchar(255) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `slots` ADD `timeslot` VARCHAR(255) NOT NULL AFTER `email`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
