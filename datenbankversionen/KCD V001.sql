-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 18, 2019 at 12:26 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KCD`
--

-- --------------------------------------------------------

--
-- Table structure for table `imageComments`
--

CREATE TABLE `imageComments` (
  `commentID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `creationdate` date NOT NULL,
  `creationUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imageComments`
--

INSERT INTO `imageComments` (`commentID`, `imageID`, `message`, `creationdate`, `creationUserID`) VALUES
(1, 11, '[gfdsvalue-2]', '2019-04-13', 4),
(3, 11, 'fjkldsajfdfjaölk', '2019-04-13', 4),
(4, 12, 'fjkldsajfjlkdsajflkdsajflkjlkdsajflksamememfodsajfoiaj', '2019-04-13', 4),
(5, 17, 'frdsfdsfdsfgfdsg', '2019-04-17', 4),
(6, 15, 'Test', '2019-04-17', 4),
(7, 14, 'Test', '2019-04-17', 4),
(8, 14, 'Test', '2019-04-17', 4),
(9, 14, 'SIEG', '2019-04-17', 4),
(10, 11, 'Cool', '2019-04-17', 4),
(11, 16, 'Erster Kommentar', '2019-04-17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `ImageID` int(11) NOT NULL,
  `ImageTitle` varchar(500) NOT NULL,
  `ImageComment` varchar(5000) NOT NULL,
  `ImageDir` varchar(500) NOT NULL,
  `UploadedBy` int(11) DEFAULT NULL,
  `UploadedAt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`ImageID`, `ImageTitle`, `ImageComment`, `ImageDir`, `UploadedBy`, `UploadedAt`) VALUES
(11, 'Titel (manuell)', 'Komeedsalkjfjakh (Kommentar)', '/resources/images/uploadedImages/0038e03ffbfe4a63a3bd0821d0334d68schallplatte-169320.jpg', 4, '2019-04-11'),
(12, 'Test2', 'meeeeeeeeeeeeeeeehr Text', '/resources/images/uploadedImages/bad30683a3bd592a090588d544178f73black-wallpaper-pc-9.jpg', 4, '2019-04-11'),
(13, 'Schmales Bild', 'fdjklsajflkdal', '/resources/images/uploadedImages/049b165dd7350ae016dded637a69eb1bScreenshot from 2019-04-01 12-01-54.png', 4, '2019-04-11'),
(14, 'Bester Verein der Welt', 'Wenn du aus Dortmund kommst, schieÃŸt Geld hier keine Tore.  Wenn du aus der Hauptstadt kommst,  scheiÃŸen wir auf dich und dein Lied.  Wenn du aus Leverkusen kommst,  dann lass den Torwart gleich zu Hause.  Wenn du auf Schalke kommst,  ist das fÃ¼r uns ein AuswÃ¤rtssieg. Wenn ich weit weit weg bin,ob bei Juve oder Rom dann denk ich Hamburg meine Perle und singe home sweet home.', '/resources/images/uploadedImages/4daf9e7626a793a8d28a4abef1ab27a02000px-HSV-Logo.svg.png', 4, '2019-04-17'),
(15, 'dsfsad', 'fdgds', '/resources/images/uploadedImages/8f08ce10b60cf4ef5bf1b19778c73f18Sample.png', 4, '2019-04-17'),
(16, 'dvfd', 'jkhkjh', '/resources/images/uploadedImages/ab3744c4a189570216f06b5060fa72efSample.png', 4, '2019-04-17'),
(17, 'dvfdfjlkdsajflkdsa', 'jkhkjh', '/resources/images/uploadedImages/d8ef4c9c10811f350f68e097d21cee6bSample.png', 4, '2019-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `title`, `message`, `date`) VALUES
(4, 'Test', 'Messageflkjds', '2019-04-11'),
(5, 'Titel', 'Message', '2019-04-11'),
(6, 'Test', 'Nachricht', '2019-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `panaltyID` int(11) NOT NULL,
  `message` varchar(5000) NOT NULL,
  `amount` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penalties`
--

INSERT INTO `penalties` (`panaltyID`, `message`, `amount`) VALUES
(2, 'Test', '123.12'),
(5, 'Test2', '123.23'),
(6, 'Test3', '0.50'),
(7, 'Test4', '999.00');

-- --------------------------------------------------------

--
-- Table structure for table `userPenalties`
--

CREATE TABLE `userPenalties` (
  `userID` int(11) NOT NULL,
  `penaltyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(4, 'Lennart Peters', 'lennartpeters@online.de', '043cf4599e5e4bf1e48279f56ce8b7c6'),
(5, 'TestUser1', 'test@mail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imageComments`
--
ALTER TABLE `imageComments`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `users.id` (`creationUserID`) USING BTREE;

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `UploadedBy` (`UploadedBy`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`panaltyID`);

--
-- Indexes for table `userPenalties`
--
ALTER TABLE `userPenalties`
  ADD PRIMARY KEY (`userID`,`penaltyID`),
  ADD KEY `penaltyID` (`penaltyID`) USING BTREE,
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imageComments`
--
ALTER TABLE `imageComments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `panaltyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `Uploaded by user` FOREIGN KEY (`UploadedBy`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
