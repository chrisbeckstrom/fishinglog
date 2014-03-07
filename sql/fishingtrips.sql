-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.cbfishes.com
-- Generation Time: Jul 29, 2013 at 12:21 PM
-- Server version: 5.1.56
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fishingtrips`
--

-- --------------------------------------------------------

--
-- Table structure for table `devlog`
--

CREATE TABLE IF NOT EXISTS `devlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(40) NOT NULL,
  `type` varchar(30) NOT NULL,
  `notes` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_list`
--

CREATE TABLE IF NOT EXISTS `email_list` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) NOT NULL,
  `ip` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE IF NOT EXISTS `feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `username` varchar(40) NOT NULL,
  `activity` varchar(40) NOT NULL,
  `title` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  `private` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `fish`
--

CREATE TABLE IF NOT EXISTS `fish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `family` varchar(18) CHARACTER SET utf8 DEFAULT NULL,
  `species` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(77) CHARACTER SET utf8 DEFAULT NULL,
  `occurrence` varchar(19) CHARACTER SET utf8 DEFAULT NULL,
  `fishbase_name` varchar(39) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(35) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3087 ;

-- --------------------------------------------------------

--
-- Table structure for table `fishcaught`
--

CREATE TABLE IF NOT EXISTS `fishcaught` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fishID` int(6) NOT NULL,
  `tripID` int(6) NOT NULL,
  `weight` decimal(10,0) NOT NULL,
  `length` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `spots`
--

CREATE TABLE IF NOT EXISTS `spots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL COMMENT 'the spot name',
  `waterbody` varchar(40) NOT NULL COMMENT 'the waterbody the spot is a part of',
  `watertype` varchar(15) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `lon` varchar(10) NOT NULL,
  `latlon` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `notes` mediumtext NOT NULL,
  `owner` varchar(30) NOT NULL,
  `private` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `streamflow`
--

CREATE TABLE IF NOT EXISTS `streamflow` (
  `site_no` varchar(17) DEFAULT NULL,
  `station_nm` varchar(50) DEFAULT NULL,
  `site_tp_cd` varchar(10) DEFAULT NULL,
  `lat` varchar(10) DEFAULT NULL,
  `lon` varchar(11) DEFAULT NULL,
  `alt` varchar(6) DEFAULT NULL,
  `NOTHING` varchar(10) NOT NULL,
  KEY `site_no` (`site_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE IF NOT EXISTS `trips` (
  `tripid` int(11) NOT NULL AUTO_INCREMENT,
  `tripnumber` int(11) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `username` varchar(45) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `date` longtext NOT NULL,
  `city` varchar(30) NOT NULL COMMENT 'the closest city/town to fishing spot',
  `state` varchar(2) NOT NULL,
  `zip` int(5) NOT NULL,
  `lat` text NOT NULL,
  `lon` text NOT NULL,
  `latlon` varchar(50) NOT NULL,
  `skunked` text NOT NULL,
  `time` text NOT NULL,
  `timeofday` text NOT NULL,
  `adventure` int(2) NOT NULL,
  `scenery` int(2) NOT NULL,
  `ninja` int(2) NOT NULL,
  `waterbody` text NOT NULL,
  `watertype` text NOT NULL,
  `watercolor` text NOT NULL,
  `sitecode` varchar(15) NOT NULL,
  `gaugeheight` varchar(15) NOT NULL,
  `discharge` varchar(15) NOT NULL,
  `temp` varchar(10) NOT NULL,
  `hum` varchar(10) NOT NULL,
  `wspdi` varchar(10) NOT NULL,
  `wgusti` varchar(10) NOT NULL,
  `wdir` varchar(10) NOT NULL,
  `pressure` varchar(10) NOT NULL,
  `conds` varchar(25) NOT NULL,
  `metar` varchar(200) NOT NULL,
  `gear` text NOT NULL,
  `method` text NOT NULL,
  `watertemp` int(11) NOT NULL,
  `fishcaught` int(11) NOT NULL,
  `catchid` int(6) NOT NULL COMMENT 'this id corresponds to fishcaught.catchid',
  `largemouth` int(11) NOT NULL,
  `smallmouth` int(11) NOT NULL,
  `greenie` int(11) NOT NULL,
  `bluegill` int(11) NOT NULL,
  `carp` int(11) NOT NULL,
  `drum` int(11) NOT NULL,
  `walleye` int(11) NOT NULL,
  `pike` int(11) NOT NULL,
  `musky` int(11) NOT NULL,
  `bowfin` int(11) NOT NULL,
  `shad` int(11) NOT NULL,
  `creekchub` int(11) NOT NULL,
  `flatheadcatfish` int(11) NOT NULL,
  `channelcatfish` int(11) NOT NULL,
  `browntrout` int(11) NOT NULL,
  `rainbowtrout` int(11) NOT NULL,
  `brooktrout` int(11) NOT NULL,
  `perch` int(11) NOT NULL,
  `stripedbass` int(11) NOT NULL,
  `whiteperch` int(11) NOT NULL,
  `crappie` int(11) NOT NULL,
  `bullhead` int(11) NOT NULL,
  `redeyebass` int(11) NOT NULL,
  `rockbass` int(11) NOT NULL,
  `goby` int(11) NOT NULL,
  `notes` text NOT NULL,
  `lures` text NOT NULL,
  `lureimage` text NOT NULL,
  `newwater` int(1) NOT NULL,
  `points` int(3) NOT NULL,
  KEY `tripid` (`tripid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=467 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(30) NOT NULL,
  `userrealname` varchar(40) NOT NULL COMMENT 'the user''s actual name',
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(15) NOT NULL,
  `email` varchar(40) NOT NULL,
  `secret_key` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `useravatarurl` varchar(100) NOT NULL,
  `GPS` varchar(40) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `waterbodies`
--

CREATE TABLE IF NOT EXISTS `waterbodies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `watertype` varchar(20) NOT NULL,
  `lat` varchar(10) NOT NULL,
  `lon` varchar(10) NOT NULL,
  `latlon` varchar(50) NOT NULL,
  `city` varchar(20) NOT NULL,
  `county` varchar(50) NOT NULL,
  `state` varchar(2) NOT NULL,
  `notes` mediumtext NOT NULL,
  `creator` varchar(30) NOT NULL,
  `privacy` varchar(7) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `lures` varchar(100) NOT NULL,
  `species` varchar(100) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=62 ;

-- --------------------------------------------------------

--
-- Table structure for table `waters`
--

CREATE TABLE IF NOT EXISTS `waters` (
  `waterid` int(11) NOT NULL AUTO_INCREMENT,
  `waterbody` varchar(40) NOT NULL,
  `waterdate` date NOT NULL,
  `watertime` varchar(10) NOT NULL,
  `timeofday` varchar(30) NOT NULL,
  `sitename` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `stationid` varchar(20) NOT NULL,
  `gaugeheight` varchar(10) NOT NULL,
  `discharge` varchar(10) NOT NULL,
  PRIMARY KEY (`waterid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9914 ;

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE IF NOT EXISTS `weather` (
  `city` varchar(20) NOT NULL,
  `lat` varchar(20) NOT NULL,
  `lon` varchar(20) NOT NULL,
  `zip` int(5) NOT NULL,
  `state` varchar(2) NOT NULL,
  `date` varchar(10) NOT NULL,
  `hms` varchar(10) NOT NULL,
  `timeofday` varchar(20) NOT NULL,
  `temp_f` int(4) NOT NULL,
  `windchill` int(4) NOT NULL,
  `heatindex` int(4) NOT NULL,
  `feelslike` int(4) NOT NULL,
  `pressure_in` int(10) NOT NULL,
  `pressuretrend` varchar(4) NOT NULL,
  `weather` varchar(20) NOT NULL,
  `relhumidity` varchar(10) NOT NULL,
  `visibility` int(3) NOT NULL,
  `precip_today` int(6) NOT NULL,
  `wind` varchar(15) NOT NULL,
  `wind_dir` varchar(20) NOT NULL,
  `wind_degrees` int(6) NOT NULL,
  `wind_mph` int(4) NOT NULL,
  `wind_gust_mph` int(4) NOT NULL,
  `weather_id` int(16) NOT NULL AUTO_INCREMENT,
  KEY `weather_id` (`weather_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8738 ;

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

CREATE TABLE IF NOT EXISTS `zipcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zip` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `county` varchar(75) NOT NULL,
  `fips` int(11) NOT NULL,
  `areacode` varchar(3) NOT NULL,
  `dst` enum('Y','N') NOT NULL,
  `timezone` varchar(20) NOT NULL,
  `lat` varchar(25) NOT NULL,
  `lon` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_zipcode` (`zip`(5))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42811 ;
