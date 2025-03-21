-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2021 at 03:43 PM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prim_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_category`
--

CREATE TABLE `blog_category` (
  `catID` int(11) NOT NULL,
  `catName` text NOT NULL,
  `catAlias` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_category`
--

INSERT INTO `blog_category` (`catID`, `catName`, `catAlias`) VALUES
(1, 'News', 'news'),
(2, 'Events', 'events'),
(3, 'Server Information', 'server-info');

-- --------------------------------------------------------

--
-- Table structure for table `blog_configurations`
--

CREATE TABLE `blog_configurations` (
  `configID` int(11) NOT NULL,
  `configName` varchar(50) NOT NULL,
  `configTitle` varchar(50) NOT NULL,
  `configValue` varchar(500) NOT NULL,
  `configCat` varchar(50) NOT NULL,
  `configDescription` varchar(255) NOT NULL,
  `configType` varchar(255) NOT NULL,
  `configDefaults` varchar(255) NOT NULL,
  `configFields` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_members`
--

CREATE TABLE `blog_members` (
  `memberID` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_members`
--

INSERT INTO `blog_members` (`memberID`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$uFUG/NJpkwDKhmyX2WKZI.pBiu4/c4HfoaGeL9ZJO864aztDYVbCC', 'team@exdeus.dev');

-- --------------------------------------------------------

--
-- Table structure for table `blog_patchlogs`
--

CREATE TABLE `blog_patchlogs` (
  `id` int(11) NOT NULL,
  `patchDate` datetime NOT NULL DEFAULT current_timestamp(),
  `patchTitle` varchar(255) NOT NULL,
  `isDelete` tinyint(4) NOT NULL DEFAULT 0,
  `patchText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `postID` int(11) UNSIGNED NOT NULL,
  `postOrder` int(11) NOT NULL,
  `postTitle` varchar(255) DEFAULT NULL,
  `postCont` text DEFAULT NULL,
  `postDate` datetime DEFAULT NULL,
  `postCat` text CHARACTER SET utf8 DEFAULT NULL,
  `isDelete` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_upload`
--

CREATE TABLE `blog_upload` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `imageSize` varchar(255) NOT NULL,
  `imageType` varchar(255) NOT NULL,
  `imageLocation` varchar(255) NOT NULL,
  `imageDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `blog_configurations`
--
ALTER TABLE `blog_configurations`
  ADD PRIMARY KEY (`configID`);

--
-- Indexes for table `blog_members`
--
ALTER TABLE `blog_members`
  ADD PRIMARY KEY (`memberID`);

--
-- Indexes for table `blog_patchlogs`
--
ALTER TABLE `blog_patchlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `blog_upload`
--
ALTER TABLE `blog_upload`
  ADD PRIMARY KEY (`imageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blog_configurations`
--
ALTER TABLE `blog_configurations`
  MODIFY `configID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `blog_members`
--
ALTER TABLE `blog_members`
  MODIFY `memberID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blog_patchlogs`
--
ALTER TABLE `blog_patchlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `postID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_upload`
--
ALTER TABLE `blog_upload`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


INSERT INTO `blog_configurations` (`configName`, `configTitle`, `configValue`, `configCat`, `configDescription`, `configType`, `configDefaults`, `configFields`) VALUES
('website_title', 'Website Title', 'Project Auros', 'mainweb', '', 'textbox', '', ''),
('gamecp_link', 'GameCP Link', '#', 'mainweb', '', 'textbox', '', ''),
('slider_img_2', 'Slide Image 2', 'https://exdeus.dev/websites/preview/default-1/assets/img/slider-img.jpg', 'slider_image', '', 'textbox', '', ''),
('website_keywords', 'Website Keywords', 'rf private server, rf ps, new rf private server, private server international, top rf online, rising force private server, rising force online, new rf private server, rf auros, rf private server extreme, 2.2.3.2, 2.2.3, ga, gu, golden update, age of patron', 'mainweb', '', 'textbox', '', ''),
('website_header_text', 'Website Header Text', 'RF Online Website Template', 'mainweb', '', 'textbox', '', ''),
('website_description', 'Website Description', 'Rising Force Online Private Server, RF PS. Download and Play the Ultimate Fantasy Sci-fi 3D Online MMORPG for Free.', 'mainweb', '', 'textbox', '', ''),
('slider_img_1', 'Slide Image 1', 'https://exdeus.dev/websites/preview/default-1/assets/img/slider-img.jpg', 'slider_image', '', 'textbox', '', ''),
('slider_header_1', 'Header Slide 1', 'Best Private Server', 'slider_image', '', 'textbox', '', ''),
('slider_header_3', 'Header Slide 3', 'Server Version', 'slider_image', '', 'textbox', '', ''),
('slider_desc_2', 'Description Slide 2', 'Leveling, Farming, and PVP', 'slider_image', '', 'textbox', '', ''),
('slider_header_2', 'Header Slide 2', 'Excellent RPG Concept', 'slider_image', '', 'textbox', '', ''),
('slider_desc_1', 'Description Slide 1', '24 Hours Online!', 'slider_image', '', 'textbox', '', ''),
('slider_desc_3', 'Description Slide 3', 'Golden Age', 'slider_image', '', 'textbox', '', ''),
('slider_img_3', 'Slide Image 3', 'https://exdeus.dev/websites/preview/default-1/assets/img/slider-img.jpg', 'slider_image', '', 'textbox', '', ''),
('google_analytics', 'Google Analytics Code', 'UA-116837860-3', 'google', '', 'textbox', '', ''),
('social_twitter', 'Share Twitter Link', 'http://twitter.com', 'socialmedia', '', 'textbox', '', ''),
('social_facebook', 'Share Facebook Link', 'http://facebook.com', 'socialmedia', '', 'textbox', '', '');
-- ('email_smtp_username', 'Email Address', 'noreply.rfocp@gmail.com', 'email', '', 'textbox', '', ''),
-- ('email_smtp_server', 'Email Server/Host', 'smtp.gmail.com', 'email', '', 'textbox', '', ''),
-- ('email_smtp_password', 'Email Password', '123ASD!!!', 'email', '', 'textbox', '', ''),
-- ('email_smtp_port', 'Email Port Number', '587', 'email', '', 'textbox', '', '');
