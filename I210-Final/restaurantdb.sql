-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 12, 2023 at 08:42 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurantdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Cursed'),
(2, 'Very Cursed'),
(3, 'Very Very Cursed'),
(4, 'Very Very Very Cursed'),
(5, 'Cursed The Sequel');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_added` date DEFAULT NULL,
  `item_name` varchar(250) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `date_added`, `item_name`, `item_price`, `description`, `image`) VALUES
(10, 1, '2023-03-15', 'Pickled Nutella', '4.20', 'Introducing Pickled Nutella, a unique and flavorful twist on the classic hazelnut spread. Made with premium quality ingredients, our pickled Nutella offers a perfect blend of tangy and sweet flavors that will tantalize your taste buds. Enjoy it as a spread on toast, as a dip for fruits or vegetables, or as a topping for your favorite desserts.', ''),
(11, 2, '2023-03-08', 'Anti-Sandwich', '6.99', 'Introducing Anti-Sandwich, the revolutionary meal option that breaks the monotony of traditional sandwiches. Our product offers a deconstructed version of your favorite sandwiches, giving you the freedom to mix and match flavors and textures as you desire. With fresh, high-quality ingredients and endless possibilities, Anti-Sandwich is the perfect choice for those looking to add some excitement to their lunch routine.', 'anti_sandwich.jpg'),
(12, 3, '2023-03-01', 'Pepto Bismol Hotdog', '3.50', 'Pepto Bismol Hotdog, the perfect meal for those who love a little spice in their life...and their stomachs! Our secret recipe features a juicy hotdog topped with a generous serving of fiery hot sauce, guaranteed to give you heartburn and indigestion in record time. But no worries, just take a swig of our special Pepto Bismol sauce, and you\'ll be back to your normal self in no time! Warning: May cause laughter, confusion, and questionable life choices.', 'pepto_bismol_hotdog.jpeg'),
(13, 4, '2023-03-13', 'Flaming Hot Cheeto Crusted Turkey', '69.69', 'Our juicy turkey is coated with a fiery blend of crushed Flaming Hot Cheetos, giving it a unique and addictive flavor that will leave your taste buds tingling. It\'s the perfect dish to spice up your Thanksgiving dinner or any special occasion. Warning: May cause spontaneous dance parties and uncontrollable cravings for more.', 'cheeto_crusted_turkey.jpeg'),
(14, 5, '2023-03-14', 'Snickles', '2.49', 'Satisfy your sweet and salty cravings with Snickles, the ultimate snack for indecisive taste buds. Our delicious treat features a combination of crunchy, salty pretzels and chewy, gooey Snickers bars, all coated in rich chocolate. It\'s the perfect snack to indulge in when you can\'t decide between a candy bar or a bag of pretzels. Warning: May cause intense snacking sessions and unexpected cravings.', 'snickles.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `items` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `items`) VALUES
(1, 1, ''),
(2, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(11) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `user_email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `first_name`, `last_name`, `birthdate`, `user_email`, `password`, `role`) VALUES
(5, 'johndoe123', 'John', 'Doe', '1990-01-01', 'johndoe123@gmail.com', 'ewfettdferfsdf', 0),
(6, 'sarahsmith', 'Sarah', 'Smith', '1986-09-09', 'sarahsmith69@gmail.com', 'sdfsdfdgtgfdgf', 0),
(7, 'peterparker', 'Peter', 'Parker', '1990-09-08', 'imnotspiderman@gmail.com', 'cvfbfgfgcvfd', 0),
(8, 'greengoblin', 'Norman', 'Osborn', '1970-05-21', 'greengoblin@spiderman.com', 'password', 0),
(9, 'therockj', 'Dwayne', 'Johnson', '1975-10-04', 'therockisawesome@wwe.com', 'dsdsfdfdfd', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
