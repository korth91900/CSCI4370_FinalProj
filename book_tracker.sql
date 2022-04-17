-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 06:46 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookgenre`
--

CREATE TABLE `bookgenre` (
  `bid` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookgenre`
--

INSERT INTO `bookgenre` (`bid`, `gid`) VALUES
(1, 1),
(1, 6),
(1, 9),
(1, 16),
(1, 17),
(2, 1),
(2, 6),
(2, 9),
(2, 16),
(2, 17),
(3, 1),
(3, 8),
(3, 14),
(3, 17),
(3, 30),
(4, 1),
(4, 14),
(4, 28),
(4, 29);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(11) NOT NULL,
  `ISBN` int(13) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `publisher` varchar(50) DEFAULT NULL,
  `description` varchar(700) NOT NULL,
  `release_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `ISBN`, `title`, `author`, `publisher`, `description`, `release_date`, `image`) VALUES
(1, 439708184, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Bloombury', 'Harry Potter\'s life is miserable. His parents are dead and he\'s stuck with his heartless relatives, who force him to live in a tiny closet under the stairs. But his fortune changes when he receives a letter that tells him the truth about himself: he\'s a wizard. A mysterious visitor rescues him from his relatives and takes him to his new home, Hogwarts School of Witchcraft and Wizardry. But even within the Wizarding community, he is special. He is the boy who lived: the only person to have ever survived a killing curse inflicted by the evil Lord Voldemort. This is Harry\'s first year at Hogwarts.', '1997-06-26', 'Harry_Potter_Sorcerer_Stone.jpg'),
(2, 439064872, 'Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 'Bloombury', 'Ever since Harry Potter had come home for the summer, the Dursleys had been so mean and hideous that all Harry wanted was to get back to the Hogwarts School for Witchcraft and Wizardry. But just as he\'s packing his bags, Harry receives a warning from a strange impish creature who says that if Harry returns to Hogwarts, disaster will strike. And strike it does. For in Harry\'s second year at Hogwarts, fresh torments and horrors arise, including an outrageously stuck-up new professor and a spirit who haunts the girls\' bathroom. But then the real trouble begins - someone is turning Hogwarts students to stone.', '1999-06-02', 'Harry_Potter_Chamber_of_Secrets.jpg'),
(3, 307743659, 'The Shining', 'Stephen King', 'Doubleday', 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start. As the off-season caretaker at the atmospheric old hotel, he\'ll have plenty of time to spend reconnecting with his family and working on his writing. But as the harsh winter weather sets in, the idyllic location feels ever more remote...and more sinister. And the only one to notice the strange and terrible forces gathering around the Overlook is Danny Torrance, a uniquely gifted five-year-old.', '1977-01-28', 'The_Shining.jpg'),
(4, 446310786, 'To Kill A Mockingbird', 'Harper Lee', 'J. B. Lippincott & Co.', 'Set in the small Southern town of Maycomb, Alabama, during the Depression, To Kill a Mockingbird follows three years in the life of 8-year-old Scout Finch, her brother, Jem, and their father, Atticus--three years punctuated by the arrest and eventual trial of a young black man accused of raping a white woman.', '1960-07-11', 'To_Kill_A_Mockingbird.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `gid` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`gid`, `genre_name`) VALUES
(18, 'Autobiography'),
(19, 'Biography'),
(3, 'Children\'s'),
(28, 'Classic'),
(24, 'Comedy'),
(20, 'Cooking'),
(21, 'Crafts'),
(4, 'Crime'),
(5, 'Drama'),
(6, 'Fantasy'),
(1, 'Fiction'),
(22, 'Health'),
(7, 'Historical Fiction'),
(23, 'History'),
(8, 'Horror'),
(9, 'Mystery'),
(2, 'Nonfiction'),
(11, 'Poetry'),
(30, 'Psychological Horror'),
(25, 'Religion'),
(10, 'Romance'),
(12, 'Satire'),
(13, 'Science Fiction'),
(29, 'Southern Gothic'),
(26, 'Sports'),
(17, 'Supernatural'),
(14, 'Thriller'),
(27, 'Travel'),
(15, 'Western'),
(16, 'Young Adult');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `rid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `review_text` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `note` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`gid`),
  ADD UNIQUE KEY `genre_name` (`genre_name`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
