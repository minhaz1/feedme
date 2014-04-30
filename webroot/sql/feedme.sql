-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 08:59 PM
-- Server version: 5.5.37
-- PHP Version: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `feedme`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentid` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(7) NOT NULL,
  `login` varchar(60) NOT NULL,
  `reviewid` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`commentid`),
  KEY `member_id` (`member_id`),
  KEY `reviewid` (`reviewid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `foodtagentries`
--

CREATE TABLE IF NOT EXISTS `foodtagentries` (
  `reviewid` int(10) NOT NULL,
  `foodtagid` int(10) NOT NULL,
  KEY `reviewid` (`reviewid`,`foodtagid`),
  KEY `foodtagid` (`foodtagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mstr_foodtypetags`
--

CREATE TABLE IF NOT EXISTS `mstr_foodtypetags` (
  `foodtagid` int(10) NOT NULL AUTO_INCREMENT,
  `foodtype` varchar(20) NOT NULL,
  PRIMARY KEY (`foodtagid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mstr_regiontags`
--

CREATE TABLE IF NOT EXISTS `mstr_regiontags` (
  `regionid` int(7) NOT NULL AUTO_INCREMENT,
  `regiontag` varchar(20) NOT NULL,
  PRIMARY KEY (`regionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `mstr_restaurant`
--

CREATE TABLE IF NOT EXISTS `mstr_restaurant` (
  `resid` int(7) NOT NULL AUTO_INCREMENT,
  `regionid` int(7) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `upvotes` int(5) NOT NULL,
  `stars` int(5) NOT NULL,
  `tags` text NOT NULL,
  PRIMARY KEY (`resid`),
  KEY `regionid` (`regionid`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `address` (`address`),
  FULLTEXT KEY `url` (`url`),
  FULLTEXT KEY `phone` (`phone`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `restaurantreviewscore`
--

CREATE TABLE IF NOT EXISTS `restaurantreviewscore` (
  `reviewid` int(10) NOT NULL,
  `member_id` int(7) NOT NULL,
  `value` int(1) NOT NULL,
  KEY `reviewid` (`reviewid`,`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurantscores`
--

CREATE TABLE IF NOT EXISTS `restaurantscores` (
  `resid` int(10) NOT NULL,
  `member_id` int(7) NOT NULL,
  `value` int(1) NOT NULL,
  KEY `resid` (`resid`,`member_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_review`
--

CREATE TABLE IF NOT EXISTS `restaurant_review` (
  `reviewid` int(10) NOT NULL AUTO_INCREMENT,
  `tags` text NOT NULL COMMENT 'Stores tags in csv form',
  `resid` int(7) NOT NULL,
  `title` text NOT NULL,
  `member_id` int(7) NOT NULL,
  `description` text NOT NULL,
  `foodimage` text NOT NULL,
  `reviewdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `helpfulnessscore` int(1) NOT NULL,
  `flags_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviewid`),
  KEY `member_id` (`member_id`),
  KEY `resid` (`resid`),
  FULLTEXT KEY `tags` (`tags`),
  FULLTEXT KEY `foodimage` (`foodimage`),
  FULLTEXT KEY `description` (`description`),
  FULLTEXT KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `member_id` int(7) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `yeararrived` int(4) DEFAULT NULL,
  `joindate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmation` varchar(32) NOT NULL DEFAULT '0',
  `biography` text,
  `gender` enum('m','f') NOT NULL,
  `picture` varchar(3000) NOT NULL DEFAULT 'http://www.splitbrain.org/_static/monsterid/monsterid.php',
  `usertype` int(11) NOT NULL DEFAULT '0',
  `flags_count` int(11) NOT NULL DEFAULT '0',
  `tags` text,
  PRIMARY KEY (`member_id`),
  FULLTEXT KEY `email` (`email`),
  FULLTEXT KEY `firstname` (`firstname`),
  FULLTEXT KEY `lastname` (`lastname`),
  FULLTEXT KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
