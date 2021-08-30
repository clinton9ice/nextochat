-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 09:29 PM
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
-- Database: `nextochat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender_id` varchar(40) NOT NULL,
  `receiver_id` varchar(40) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_id`, `receiver_id`, `message`) VALUES
(1, '6114436', '2403002', 'Hi Clinton'),
(2, '6114436', '1961220', 'Hello mmeso'),
(3, '2403002', '6114436', 'Hello chinwe'),
(4, '6114436', '2403002', 'Chinwe would you like to be my friend?'),
(5, '2403002', '6114436', 'I would love to'),
(6, '6114436', '2403002', 'That means we are now friends'),
(7, '2403002', '6114436', 'Yeah that\'s right'),
(8, '6114436', '1413255', 'Hello Emmanuel'),
(9, '6114436', '1413255', 'Can i know the name of this app so i can give you recommendations on how to improve in it'),
(10, '6114436', '1413255', 'I love the style and elegance'),
(11, '1413255', '6114436', 'I haven\'t figured out a name to give it yet'),
(12, '1413255', '6114436', 'But you can help with name suggestion, I would seriously love it'),
(13, '6114436', '1413255', 'ok'),
(14, '6114436', '1413255', 'i would think about it'),
(15, '6114436', '1413255', 'i\'m still thinking'),
(16, '6114436', '1413255', 'Hey are you there'),
(17, '6114436', '1413255', 'hello....'),
(18, '6114436', '1413255', 'I\'m still waiting'),
(19, '6114436', '1413255', 'Hello'),
(20, '6114436', '1413255', 'Are you offline'),
(21, '6114436', '1413255', 'watsup'),
(22, '6114436', '1413255', 'runn'),
(23, '6114436', '1413255', 'runn'),
(24, '6114436', '1413255', 'hi'),
(25, '6114436', '1413255', 'dfdf'),
(26, '6114436', '1413255', 'hello'),
(27, '6114436', '1413255', 'testing'),
(28, '6114436', '1413255', 'sdsd'),
(29, '6114436', '1413255', 'sdsdsd'),
(30, '6114436', '1413255', 'fdfdfdffdf'),
(31, '6114436', '1413255', 'dsdsdsd'),
(32, '6114436', '1413255', 'sdsd'),
(33, '6114436', '1413255', 'rest'),
(34, '6114436', '1413255', 'hi'),
(35, '6114436', '1413255', 'hhhh'),
(36, '6114436', '1413255', 'hi'),
(37, '6114436', '1413255', 'hi'),
(38, '6114436', '1413255', 'i\'ve sent you so many messages but you haven\'t replied, watsup?'),
(39, '6114436', '1413255', 'How'),
(40, '6114436', '1413255', 'sdsds'),
(41, '6114436', '1413255', 'w'),
(42, '6114436', '1413255', 'tt'),
(44, '6114436', '1413255', 'Gotten it'),
(45, '6114436', '1413255', 'are you okay'),
(46, '1413255', '6114436', 'Yes am okay and am back'),
(47, '1413255', '6114436', 'I went to do something'),
(48, '1413255', '6114436', 'So what were you saying'),
(49, '1413255', '6114436', 'Am here for you'),
(50, '6114436', '1413255', 'well nothing just checking somthing'),
(51, '1413255', '6114436', 'Okay then'),
(52, '1413255', '6114436', 'Bye'),
(53, '6114436', '1413255', 'yeah bye too'),
(54, '1961220', '6114436', 'Hi'),
(55, '6114436', '1961220', 'How are you'),
(56, '1961220', '6114436', 'am fine, i really like your app though but it still needs improvement'),
(57, '6114436', '1961220', 'Yeah am currently working on it'),
(58, '6114436', '1961220', 'I just decided to test it first with you and see how fast the network bandwidth is'),
(59, '1961220', '6114436', 'So did you figure it out'),
(60, '6114436', '1961220', 'Not yet'),
(61, '1961220', '6114436', 'Ok do am waiting'),
(62, '6114436', '1961220', 'Ok ma\'am'),
(63, '6114436', '1961220', 'I just added a feature check it out'),
(64, '1961220', '6114436', 'What\'s the feature'),
(65, '1961220', '1413255', 'Hi'),
(66, '1413255', '6114436', 'Hi'),
(67, '6114436', '1413255', 'Hello'),
(68, '1413255', '6114436', 'How are you doing?'),
(69, '6114436', '1413255', 'Am great, how about you'),
(70, '1413255', '6114436', 'Well am doing good'),
(71, '6114436', '1413255', 'That\'s nice to hear'),
(72, '6114436', '1413255', 'Hi Refresh your page, i just added a feature'),
(73, '1413255', '6114436', 'The more option icon?'),
(74, '6114436', '1413255', 'Yeah'),
(75, '1413255', '6114436', 'Wow That\'s cool'),
(76, '6114436', '1413255', 'ikr?'),
(77, '1413255', '6114436', 'yeah'),
(78, '1413255', '6114436', 'Ok'),
(79, '6114436', '2403002', 'jello'),
(80, '1413255', '2403002', 'Hi'),
(81, '1413255', '2403002', 'How do you see the app'),
(82, '1413255', '1961220', 'Hello dear, watsup'),
(83, '1961220', '1413255', 'Am fine sweetheart'),
(84, '1413255', '1961220', 'Nice to hear'),
(85, '1961220', '1413255', 'How was your day'),
(86, '1413255', '1961220', 'It was cool dear'),
(87, '1413255', '1961220', 'How was yours?'),
(88, '1413255', '1037359', 'Hi'),
(89, '1037359', '1413255', 'Hello'),
(90, '1413255', '1037359', 'How are you'),
(91, '1037359', '1413255', 'Am good'),
(92, '1037359', '1413255', 'How do you see the chat app'),
(93, '1413255', '1037359', 'It\'s good for a beginner, but more is expected from you. But at this level i would say you really tried'),
(94, '1037359', '1413255', 'Ok, i want to check something in your dm?'),
(95, '1037359', '1413255', 'Hope you won\'t mind?'),
(96, '1413255', '1037359', 'Not at all, go on'),
(97, '1037359', '1413255', 'ok'),
(98, '1037359', '1413255', 'Installation on Windows/Linux/Mac OSX\r\nTutorial\r\nUsage instructions\r\nFixing connection and transfer problems; Network configuration\r\nFrequently Asked Questions (FAQ)\r\nSpecific features\r\nFilename filters\r\nLogging in FileZilla\r\nOther features\r\nFileZilla Pro\r\nConnecting to Amazon S3\r\nConfiguring third-party S3 providers\r\nConnecting to Google Cloud Storage\r\nKnowledge Base\r\nSpecial cases\r\nKey-based authentication with SFTP\r\nFileZilla and Windows Vista/Windows 7 UAC\r\nImporting FileZilla 2 Site Manager entries into FileZilla 3\r\nFileZilla Server\r\nGeneral\r\nFixing connection and transfer problems; Network configuration\r\nFrequently Asked Questions (FAQ)\r\nSpecific features\r\nLogging in FileZilla Server\r\nSpecial cases\r\nFTPS using Explicit TLS howto\r\nTransfer user accounts from Another FTP Server\r\nSecuring your Windows Service installation\r\nSetting up your Router to Fix the &quot;425 code&quot;\r\nENETUNREACH with Kaspersky\r\nDevelopment\r\nGetting the source code\r\nCompiling FileZilla\r\nNavigation menupage actions\r\npagediscussionview sourcehistory\r\npersonal tools\r\nnot logged intalkcontributionscreate accountlog in\r\nnavigation\r\nMain Page\r\nCommunity portal\r\nRecent changes\r\nRandom page\r\nHelp\r\ntools\r\nWhat links here\r\nRelated changes\r\nSpecial pages\r\nPrintable version\r\nPermanent link\r\nPage information\r\nsearch\r\nSearch FileZilla Wiki\r\n  \r\nGNU Free Documentation License 1.2Powered by MediaWiki\r\nThis page was last edited on 12 June 2020, at 09:12.Content is available under GN'),
(99, '1413255', '1037359', 'What is this?'),
(100, '1037359', '1413255', 'I was testing the link'),
(101, '1413255', '1037359', 'What link'),
(102, '1037359', '1413255', 'I\'m checking if the text would automatically detect a link'),
(103, '1413255', '1037359', 'You need to get a plugin for that'),
(104, '1037359', '1413255', 'Ok thanks'),
(105, '1037359', '1413255', 'Hi'),
(106, '1037359', '1413255', 'Watsup'),
(107, '1413255', '6114436', 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `u_id` int(70) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` varchar(70) NOT NULL,
  `profile_image` text DEFAULT NULL,
  `created` varchar(70) NOT NULL,
  `status` enum('offline','active','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `u_id`, `name`, `email`, `password`, `profile_image`, `created`, `status`) VALUES
(1, 1413255, 'emmanuel ufere', 'admin@gmail.com', '$2y$10$K1yJ90zgjmNkEvRcbgC9TeEpPKVqfNsBv96XcUV.G54YzdIQ4GCFW', NULL, '1628531409', 'active'),
(2, 2403002, 'clinton', 'clintonufere@gmail.com', '$2y$10$DzLtSr4sZAANKo05GYup8eaFiMprGxNtcsABsEv0SLwQP2kaWBuvS', NULL, '1628531511', 'active'),
(3, 6114436, 'chinwe', 'kingsley@gmail.com', '$2y$10$S4.Z1wVgzJxFOU75THu5tu.vKNsmjhRaLsmgIKI9B1.N5Wy0Zp742', NULL, '1628545955', 'active'),
(4, 1961220, 'mmesoma oyenekwu', 'mmeso@gmail.com', '$2y$10$rl6AqBzYkpZgyixTK3CBm.U971Efskjwlrk.TZCIbZsR7NlpzL2Zu', NULL, '1628699516', 'active'),
(5, 1037359, 'amarachi', 'ammy@gmail.com', '$2y$10$6yNdfXxDjOB91WGX8iHCP.rZWFXQCBVHqBBgwPMIzUAPxmSNfowRy', NULL, '1628718873', 'offline');
 
--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
