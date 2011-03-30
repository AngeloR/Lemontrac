--
<<<<<<< HEAD
-- MySQL 5.1.41
-- Wed, 30 Mar 2011 21:19:45 +0000
=======
-- Host: localhost
-- Generation Time: Mar 29, 2011 at 12:14 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bugtrack`
--
-- DROP DATABASE `bugtrack`;
CREATE DATABASE `bugtrack` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bugtrack`;

-- --------------------------------------------------------

>>>>>>> cd852bc65b896982bed07ed03b61cab883cb2c2f
--

CREATE DATABASE `bugtrack` DEFAULT CHARSET utf8;

USE `bugtrack`;

<<<<<<< HEAD
CREATE TABLE `bugs` (
   `bug_id` int(11) not null auto_increment,
   `project_id` int(11),
   `title` varchar(255) not null,
   `description` text not null,
   `created_time` int(11) not null,
   `severity_level` tinyint(4) default '3',
   `created_by` int(11) not null,
   `updated_time` int(11) not null,
   `updated_by` int(11) not null,
   `fixed` tinyint(4) default '0',
   PRIMARY KEY (`bug_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=19;

CREATE TABLE `log` (
   `log_id` int(11) not null auto_increment,
   `user_id` int(11) not null,
   `update_type` tinyint(4) not null,
   `message` varchar(200) not null,
   `bug_id` int(11),
   `note_id` int(11),
   `project_id` int(11),
   `created_time` int(11) not null,
   PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

CREATE TABLE `notes` (
   `note_id` int(11) not null auto_increment,
   `bug_id` int(11) not null,
   `note` text not null,
   `created_time` int(11) not null,
   `created_by` int(11),
   PRIMARY KEY (`note_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=18;

CREATE TABLE `projects` (
   `project_id` int(11) not null auto_increment,
   `project_title` varchar(100) not null,
   `project_desc` text not null,
   `bugs_assigned` int(11) default '0',
   `color` varchar(6) default 'ffffff',
   `closed` tinyint(4) default '0',
   `created_time` int(11),
   PRIMARY KEY (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=8;

CREATE TABLE `users` (
   `user_id` int(11) not null auto_increment,
   `username` varchar(25) not null,
   `password` varchar(40) not null,
   `email` varchar(100) not null,
   `access_level` tinyint(4) default '1',
   `created_time` int(11) not null,
   `updated_time` int(11) not null,
   PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=25;
=======
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- update v0.1.2
ALTER TABLE  `log` ADD  `message` VARCHAR( 200 ) NOT NULL AFTER  `update_type`
ALTER TABLE  `log` ADD  `created_time` INT NOT NULL
>>>>>>> cd852bc65b896982bed07ed03b61cab883cb2c2f
