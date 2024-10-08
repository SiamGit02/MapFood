-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2024 at 05:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railmap`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `complaint_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`id`, `restaurant_id`, `complaint_text`, `created_at`) VALUES
(1, 1, 'ss', '2024-09-30 16:22:26'),
(2, 1, 'nice', '2024-09-30 16:22:31'),
(3, 1, 'This is very nice reataurant ', '2024-09-30 16:46:22'),
(4, 1, 'good', '2024-10-01 06:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `get_in_touch`
--

CREATE TABLE `get_in_touch` (
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `item_name` varchar(60) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `restaurant` int(11) DEFAULT NULL,
  `price` float(6,2) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `item_name`, `description`, `restaurant`, `price`, `rating`) VALUES
(1, 'Fried Chicken', 'Chicken which is fried', 4, 80.00, '1'),
(2, 'Chicken Pizza ', 'Chicken toppings on pizza', 5, 330.00, '1'),
(3, 'Beef Pizza', 'Beef toppings on pizza', 5, 450.00, '1'),
(4, 'Cold Coffee', 'Special for a hot weather', 1, 80.00, '1'),
(5, 'Classic Margherita Pizza', 'A timeless favorite, our Margherita pizza features a thin, crispy crust topped with fresh tomato sau', 5, 450.00, '1'),
(6, 'Savory Spinach and Artichoke Dip', 'Dive into a creamy blend of spinach, artichokes, and melted cheese served with warm, toasted baguett', 1, 200.00, '1'),
(7, 'Grilled Chicken Caesar Salad', 'Grilled chicken breast atop a bed of crisp romaine lettuce, tossed with Caesar dressing, Parmesan ch', 17, 120.00, '1'),
(8, 'Mouthwatering BBQ Pulled Beef Sandwich', 'Tender pulled beefslow-cooked to perfection, smothered in smoky barbecue sauce, and served on a fres', 6, 150.00, '1'),
(9, 'Vegetable Stir-Fry with Tofu', 'A delightful medley of fresh, seasonal vegetables and tofu stir-fried in a savory ginger and garlic ', 26, 300.00, '1'),
(10, 'Seafood Paella', 'Immerse your taste buds in the flavors of the Mediterranean with our hearty paella featuring saffron', 30, 250.00, '1'),
(11, 'Gourmet Angus Burger', 'Sink your teeth into a juicy Angus beef patty topped with melted cheddar cheese, caramelized onions,', 7, 250.00, '1'),
(12, 'Homestyle Lasagna', 'Layers of pasta, rich meat sauce, creamy béchamel, and a blend of mozzarella and Parmesan cheeses, b', 10, 280.00, '1'),
(13, 'Fresh Fruit Sorbet', 'A refreshing and guilt-free dessert option, our sorbet is a colorful blend of seasonal fruits, churn', 9, 80.00, '1'),
(14, 'Decadent Chocolate Lava Cake', 'For chocolate lovers, indulge in a warm, molten chocolate cake served with a scoop of vanilla ice cr', 32, 120.00, '1'),
(15, 'Lemon Herb Grilled Salmon', 'Savor the delicate flavors of perfectly grilled salmon fillet marinated in zesty lemon and fresh her', 25, 300.00, '1'),
(16, 'Vegan Thai Red Curry', 'A flavorful and aromatic Thai curry featuring tofu and a variety of vegetables simmered in a spicy r', 18, 230.00, '1'),
(17, 'Crispy Calamari Rings', 'Delight in the crispy goodness of tender calamari rings, lightly breaded and fried to perfection, se', 12, 90.00, '1'),
(18, 'Mediterranean Mezze Platter', 'A delightful assortment of Mediterranean flavors, including hummus, tzatziki, tabbouleh, falafel, an', 24, 150.00, '1'),
(19, 'Tender Beef Short Ribs', 'Slow-cooked to fork-tender perfection, our beef short ribs are braised in a red wine reduction and s', 27, 400.00, '1'),
(20, 'Vegetarian Enchiladas', 'A fiesta of flavors with corn tortillas rolled around a filling of black beans, roasted vegetables, ', 14, 100.00, '1'),
(21, 'Japanese Ramen Bowl', 'Dive into a steaming bowl of ramen with a savory broth, tender slices of pork belly, soft-boiled egg', 29, 200.00, '1'),
(22, 'Crispy Brussels Sprouts Salad', 'Roasted Brussels sprouts tossed with crispy bacon, candied pecans, dried cranberries, and a maple vi', 11, 180.00, '1'),
(23, 'Grilled Portobello Mushroom Burger', 'A satisfying meatless option featuring a marinated and grilled portobello mushroom cap topped with S', 13, 360.00, '1'),
(24, 'Authentic Chicken Tikka Masala', 'Succulent pieces of marinated chicken simmered in a creamy tomato and spice-infused sauce, served wi', 8, 190.00, '1'),
(25, 'Churro Ice Cream Sundae', 'Indulge your sweet tooth with crispy churros dusted in cinnamon sugar, served with a scoop of vanill', 28, 100.00, '1'),
(26, 'Hawaiian Poke Bowl', 'A taste of the tropics with fresh cubes of tuna or salmon, avocado, cucumber, edamame, and seaweed s', 24, 150.00, '1'),
(27, 'Italian Sausage and Peppers', 'Sautéed Italian sausage with colorful bell peppers and onions, served in a rustic tomato sauce and a', 21, 160.00, '1'),
(28, 'Homemade Apple Pie', 'End your meal on a comforting note with a slice of warm, flaky apple pie, served with a scoop of van', 17, 350.00, '1'),
(29, 'Bengali Biryani', 'A fragrant and flavorful rice dish cooked with tender pieces of marinated chicken, mutton, or shrimp, mixed with aromatic spices, saffron, and garnished with fried onions and boiled eggs. Served with ', 15, 250.00, '1'),
(30, 'Hilsha Fish Curry', 'A Bangladeshi delicacy featuring succulent pieces of Hilsha fish simmered in a rich and spicy mustard sauce, served with steamed rice or paratha.', 15, 100.00, '1'),
(31, 'Chingri Malai Curry', 'Jumbo prawns cooked in a creamy coconut milk gravy, infused with green chilies, mustard seeds, and aromatic spices, creating a harmonious blend of flavors.\r\n', 16, 100.00, '1'),
(32, 'Fuchka (Pani Puri)', 'Crispy hollow spheres stuffed with a mixture of spicy tamarind water, mashed potatoes, chickpeas, and a hint of green chili for that perfect combination of sweet, spicy, and tangy.', 2, 150.00, '1'),
(33, 'Kacchi Biryani', 'A traditional Bangladeshi rice dish made with marinated mutton, aromatic spices, and uncooked rice, slow-cooked to perfection, creating layers of flavor and tenderness.', 22, 250.00, '1'),
(34, 'Mutton Bhuna', 'Succulent pieces of mutton slow-cooked with a blend of spices, tomatoes, and caramelized onions, resulting in a rich and hearty curry.', 22, 280.00, '1'),
(35, 'Luchi with Alu Dom', 'Soft, deep-fried Bengali bread (luchi) served with a flavorful and spicy potato curry (alu dom) that\'s sure to tantalize your taste buds.', 23, 50.00, '1'),
(36, 'Bhorta Platter', 'A variety of mashed and spiced vegetables, including eggplant (baingan bhorta), potatoes (aloo bhorta), and lentils (dal bhorta), served with rice and clarified butter (ghee).', 23, 100.00, '1'),
(37, 'Sondesh', 'A popular Bengali dessert made from fresh paneer (chhena), sweetened with sugar and flavored with cardamom, saffron, and pistachios, crafted into delightful bite-sized treats.', 24, 30.00, '1'),
(38, 'Bengali Mishti Doi', 'Creamy and sweet yogurt infused with caramelized sugar, served in earthen pots (matka) for an authentic and delectable dessert experience.', 31, 50.00, '1'),
(39, 'Pitha', 'A selection of traditional Bangladeshi rice cakes, both sweet and savory, made from rice flour and often filled with ingredients like jaggery, coconut, or molasses.', 25, 50.00, '1'),
(40, 'Kheer', 'A comforting rice pudding delicately flavored with cardamom, topped with slivers of almonds and pistachios, a sweet ending to your meal.', 24, 100.00, '1'),
(60, 'Bitiyani', 'Kacchi Khadok', 50, 500.00, '1'),
(300, 'Bitiyani', 'Kacchi Khadok', 50, 500.00, '1');

-- --------------------------------------------------------

--
-- Table structure for table `rankings`
--

CREATE TABLE `rankings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meal_rate` float NOT NULL,
  `rank` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `restaurant_id`, `user_id`, `rating`) VALUES
(1, 1, 1, '4'),
(2, 10, 1, '4'),
(3, 1, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `location`, `contact`) VALUES
(1, 'Caps & Hotbite', 'Cumilla', '+8801234567890'),
(2, 'Takeout 2.0', 'Cumilla', '+8801234567801'),
(4, 'Tasty Treat', 'Bramhanbaria', '+8801234567890'),
(5, 'Pizza Hut', 'Bramhanbaria', '+8801234567890'),
(6, 'Kebabdine', 'Cumilla', '+8801234567890'),
(7, 'Redroof inn', 'Cumilla', '+8801234567801'),
(8, 'Ruchi Bilash', 'Cumilla', '+8801234567801'),
(9, 'Elite Palace', 'Cumilla', '+8801234567801'),
(10, 'Makers 2.0', 'Cumilla', '+8801234567801'),
(11, 'ABfood', 'Cumilla', '+8801234567801'),
(12, 'Silver Spoon', 'Cumilla', '+8801234567801'),
(13, 'Uni Cafe', 'Bramhanbaria', '+8801234567890'),
(14, 'Smritichinese and Thai', 'Bramhanbaria', '+8801234567890'),
(15, 'Be Mezban', 'Bramhanbaria', '+8801234567890'),
(16, 'The Food Palace', 'Bramhanbaria', '+8801234567801'),
(17, 'Hungry', 'Bramhanbaria', '+8801234567801'),
(18, 'Spicy Restaurant', 'Kasba', '+8801234567890'),
(19, 'Handi Biriyani House', 'Kasba', '+8801234567801'),
(20, 'Tasty Bites', 'Kasba', '+8801234567890'),
(21, 'Swarma Bites', 'Kasba', '+8801234567801'),
(22, 'Hazi Biriyani', 'Kasba', '+8801234567801'),
(23, 'Cafe Catering', 'Laksham', '+8801234567890'),
(24, 'Hazi Khaja Garden', 'Laksham', '+8801234567801'),
(25, 'Allahr Dan', 'Laksham', '+8801234567801'),
(26, 'Agomon Food Park', 'Laksham', '+8801234567801'),
(27, 'Outback Steak House', 'Feni', '+8801234567890'),
(28, 'Crownest Restaurant', 'Feni', '+8801234567801'),
(29, 'Skylounge Restaurant', 'Feni', '+8801234567801'),
(30, 'Grand Taste', 'Feni', '+8801234567801'),
(31, 'Sonar Bangla Restaurant', 'Feni', '+8801234567801'),
(32, 'Food Valley', 'Feni', '+8801234567801'),
(33, 'Jam Jam Restaurant', 'Feni', '+8801234567801'),
(50, 'Kacchi Bhai', 'Mirpur', '01234689979'),
(60, 'Sultans Dine', 'Mirpur', '872635895'),
(61, 'Star Kabab', 'Mirpur', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `contact`, `password`, `isadmin`) VALUES
(1, 'abc', 'def', 'abc@gmail.com', '', '1234', 0),
(2, 'Sami', 'Nayeem', 'sami@gmail.com', '', '$2y$10$.E0hFpMx6oLd2MhW4DML5uebOKb4btmDK1R..Wesv/8Xn4GpYx3eC', 0),
(4, 'Fardin', 'Bhuiyan', 'fardin@gmail.com', '', '$2y$10$1CywMTZadmgFP3csGT0kieSNSjcjJrEpD5fQAnBqudRjyVY1jAH0u', 0),
(5, 'Humaira', 'Tabassum', 'humaira@gmail.com', '+8801234567890', '$2y$10$eGRD2.pRobIFfMojHNrTU.IRFZJxjkxuOV5hLQcX20cSa5DpM4lve', 0),
(6, 'Rahim', 'Ahmed', 'rahim@gmail.com', '+8801234567890', '$2y$10$zrOYh6vtc49TIOSdo/LbXOfVbyK7WasVTV3StRy1dgcA5Ls6a.vgS', 0),
(7, 'Tashrif Rashid', 'Sourav', 's@w', '01760060543', '$2y$10$whq88xEhGeMTL0rUQg2eb.cqDJ3Lmo947OiFmsD0pJ7tBL/3r0Dxe', 0),
(8, 'a', 'a', 'a@a', '12', '$2y$10$4OHgQAqcCUyJQBydlsFjROFi6trg30ijsUtTTMQKJpzVozMUFDavm', 0),
(9, 'b', 'b', 'b@b', '8', '$2y$10$FxTl4jbEsi3.mF37XXB72eXODOKS2azJKJqRNNPXYEazdKKay.SYi', 0),
(10, 't', 'r', 't@t', '12', '$2y$10$UsODZVTpM9ah/xwaO2UmAOFUBqV5VYf8m0EwNO2nV.mdC6Giasjzq', 0),
(11, 'y', 'y', 'y@y', '5', '$2y$10$UE8iVEUeHn3fZpbyDYSFV.13Rb5CZv3eOYUBmJFRACR2ahuPv1lb2', 0),
(12, 'g', 'g', 'g@g', '7', '$2y$10$Lt9Oikw0uNomLWicR9i8pOfbnD7R/w6O6icGzEnHR.rqnrttjkNNu', 0),
(14, 'siam', 'rahman', 's@r', '9', '$2y$10$CVsmH6t/cwlRLAUVfGpnv.7DcMDFGXeAgu5YoGNiydn/XErYB3rOS', 0),
(15, 'abc', 'abc', 'a@b', '123', '$2y$10$gRxZhaSfMXm9AxTtWpixs.lFfg36e1lRJMx2R9hFjF5DxnokC5MEy', 1),
(16, 'Tashrif Rashid', 'Sourav', 'a@k', '123', '$2y$10$5SAoIYuILBUonInbyHFK9uF9Kt6TyhRc78ist3U4p9gPOci9luXFG', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_restaurant` (`restaurant_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`restaurant`);

--
-- Indexes for table `rankings`
--
ALTER TABLE `rankings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `rankings`
--
ALTER TABLE `rankings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_restaurant` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk` FOREIGN KEY (`restaurant`) REFERENCES `restaurants` (`id`);

--
-- Constraints for table `rankings`
--
ALTER TABLE `rankings`
  ADD CONSTRAINT `rankings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
