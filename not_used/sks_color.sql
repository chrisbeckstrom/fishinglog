-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 28, 2009 at 06:42 AM
-- Server version: 5.0.27
-- PHP Version: 5.2.0
-- 
-- Database: `db_skscom`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `sks_color`
-- 

CREATE TABLE `sks_color` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `sks_color`
-- 

INSERT INTO `sks_color` VALUES (1, 'black');
INSERT INTO `sks_color` VALUES (2, 'blue');
INSERT INTO `sks_color` VALUES (3, 'brown');
INSERT INTO `sks_color` VALUES (4, 'green');
INSERT INTO `sks_color` VALUES (5, 'grey');
INSERT INTO `sks_color` VALUES (6, 'gold');
INSERT INTO `sks_color` VALUES (7, 'navy');
INSERT INTO `sks_color` VALUES (8, 'orange');
INSERT INTO `sks_color` VALUES (9, 'pink');
INSERT INTO `sks_color` VALUES (10, 'silver');
INSERT INTO `sks_color` VALUES (11, 'violet');
INSERT INTO `sks_color` VALUES (12, 'yellow');
INSERT INTO `sks_color` VALUES (13, 'red');
