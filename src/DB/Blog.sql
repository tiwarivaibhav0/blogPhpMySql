-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-server
-- Generation Time: Jun 21, 2022 at 06:36 AM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int UNSIGNED NOT NULL,
  `post_id` int UNSIGNED DEFAULT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `comment` varchar(400) DEFAULT NULL,
  `replies` bit(1) DEFAULT NULL,
  `username` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `replies`, `username`) VALUES
(3, 1, 1, 'sujeet\'s comment2', b'0', 'tiwarivaibhav0'),
(6, 32, 1, 'tiwarivaibhav0 comment', b'0', 'tiwarivaibhav0'),
(9, 1, 1, 'fwfwf', b'0', 'tiwarivaibhav0'),
(13, 29, 1, 'hthth', b'0', 'tiwarivaibhav0'),
(14, 29, 1, 'y5yh', b'0', 'tiwarivaibhav0'),
(15, 29, 1, 'hhhh', b'0', 'tiwarivaibhav0'),
(16, 29, 1, 'yjyjyj', b'0', 'tiwarivaibhav0'),
(18, 38, 1, 'tiwarivaibhav0 comment', b'0', 'tiwarivaibhav0'),
(19, 5, 1, 'tiwarivaibhav0 comment', b'0', 'tiwarivaibhav0'),
(22, 29, 6, 'rtrtr', b'0', 'akashsoni');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `img_id` int NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`img_id`, `file`, `type`, `size`) VALUES
(1, '28April.png', 'image/png', '114341'),
(2, '28April.png', 'image/png', '114341'),
(3, 'as2.png', 'image/png', '58484'),
(4, 'as2 (2).png', 'image/png', '58484'),
(5, '15JUNE.png', 'image/png', '111576'),
(6, 'as2.png', 'image/png', '58484'),
(7, '16JUne.png', 'image/png', '110049'),
(8, '17June.png', 'image/png', '113041'),
(9, 'Screenshot at 2022-05-23 18-58-11.png', 'image/png', '105460');

-- --------------------------------------------------------

--
-- Table structure for table `Post`
--

CREATE TABLE `Post` (
  `post_id` int UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `details` text,
  `post_date` timestamp NULL DEFAULT NULL,
  `comments` int DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `status` enum('pending','approved','restricted') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Post`
--

INSERT INTO `Post` (`post_id`, `user_id`, `image`, `details`, `post_date`, `comments`, `username`, `title`, `status`) VALUES
(1, 1, 'about-img.png', 'Mountain ViewMountain ViewMountain View Mountain View Mountain ViewMountain ViewMountain View', '2022-06-15 14:47:12', 8, 'tiwarivaibhav0', 'Mountain View', 'approved'),
(2, 1, 'http://localhost:8080/images/about-img.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 1, 'tiwarivaibhav0', 'Most Awesome Blue Lake With Snow\r\nMountain', 'restricted'),
(3, 1, 'http://localhost:8080/images/about-img.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 0, 'tiwarivaibhav0', 'Most Awesome Blue Lake With Snow\r\nMountain', 'approved'),
(5, 1, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 1, 'tiwarivaibhav22', 'Most Awesome Blue Lake With Snow\r\nMountain', 'approved'),
(6, 1, 'http://localhost:8080/images/about-img.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 0, 'tiwarivaibhav0', 'Most Awesome Blue Lake With Snow\r\nMountain', 'pending'),
(7, 1, 'http://localhost:8080/images/about-img.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 0, 'tiwarivaibhav0', 'Most Awesome Blue Lake With Snow\r\nMountain', 'pending'),
(9, 1, 'http://localhost:8080/images/about-img.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2022-06-15 14:47:12', 2, 'tiwarivaibhav0', 'Most Awesome Blue Lake With Snow\r\nMountain', 'approved'),
(15, 1, NULL, '4444444444444444', '2022-06-16 04:58:41', 0, 'tiwarivaibhav0', '666666666', 'approved'),
(16, 1, 'as2 (2).png', '777777777777', '2022-06-16 05:07:58', 0, 'tiwarivaibhav0', '7777777777777777777777777', 'approved'),
(29, 1, 'as2.png', '2323232323232323.', '2022-06-16 05:52:13', 6, 'tiwarivaibhav0', '1111111111111111111', 'approved'),
(33, 1, NULL, '4566565', '2022-06-16 07:51:07', 0, 'tiwarivaibhav0', 'apostrophe\'s in title', 'pending'),
(34, 1, NULL, 'test', '2022-06-16 07:51:40', 0, 'tiwarivaibhav0', 'double inverted \" in the title\"', 'pending'),
(39, 1, NULL, '  ', '2022-06-21 06:05:07', 0, 'tiwarivaibhav0', '  ', 'pending'),
(40, 1, NULL, '  ', '2022-06-21 06:05:36', 0, 'tiwarivaibhav0', '  ', 'pending'),
(41, 6, 'Screenshot at 2022-05-23 18-58-11.png', 'asdfggsadfgadsfgsdfgddssdfgsdff', '2022-06-21 06:11:47', 0, 'akashsoni', 'asdfgh', 'approved'),
(42, 1, NULL, 'D3D3DE', '2022-06-21 06:18:34', 0, 'tiwarivaibhav0', 'FEFEFEFF', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int UNSIGNED NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(60) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `city` varchar(60) NOT NULL,
  `country` varchar(60) DEFAULT NULL,
  `pin` int NOT NULL,
  `password` varchar(60) NOT NULL,
  `user_type` enum('user','admin','author') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `picture` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `fname`, `lname`, `email`, `username`, `mobile`, `city`, `country`, `pin`, `password`, `user_type`, `picture`) VALUES
(1, 'Vaibhav', 'Tiwari', 'Vaibhav@gmail.com', 'tiwarivaibhav0', '8090000000', 'Ballia', 'India', 277009, 'Vaibhav', 'author', 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png'),
(2, 'User1', 'Random', 'User1@gmail.com', 'User1@gmail.com', '8090000000', 'Ballia', 'India', 277007, 'User1', 'user', 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png'),
(3, 'Vaibhav', 'fffff', 'User4@gmail.com', '4444444444', '5555555555', '444444', 'India', 444444, '44', 'user', 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png'),
(4, 'admin', '1', 'admin@gmail.com', 'admin', '455555555', 'Lucknow', 'India', 226016, 'admin', 'admin', NULL),
(5, 'sujeet ', 'sahu', 'sujeet@gmail.com', 'Sujeetsahu1234', '883826990', 'lko', 'india', 223456, '12345678', 'user', 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png'),
(6, 'sfsdfsdf', 'gbgbgbgb', 'akash@gmail.com', 'akashsoni', '1212121212', 'sdfsdf', 'sdfsdf', 123456, '111', 'author', 'https://www.pngfind.com/pngs/m/610-6104451_image-placeholder-png-user-profile-placeholder-image-png.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Post`
--
ALTER TABLE `Post`
  MODIFY `post_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
