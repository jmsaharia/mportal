-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 16, 2014 at 02:55 AM
-- Server version: 5.0.67
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL auto_increment,
  `course_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`) VALUES
(1, 'MCA'),
(2, 'BCA'),
(3, 'BBA'),
(4, 'BMC'),
(5, 'BA');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL auto_increment,
  `district_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`) VALUES
(1, 'Darrang'),
(2, 'Nalbari'),
(3, 'Jorhat'),
(4, 'Dhemaji'),
(5, 'Kamrup');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` int(11) NOT NULL auto_increment,
  `collage_id` int(11) NOT NULL,
  `faculty_name` varchar(50) NOT NULL,
  `faculty_address` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`faculty_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `collage_id`, `faculty_name`, `faculty_address`, `phone`, `email`, `user_id`) VALUES
(1, 1, 'Pranab Kumar Goswami', 'Bharalumukh,Ghy', '1234567890', 'pgoswami@gmail.com', 0),
(2, 3, 'D Baruah', 'Guwahati,Assam', '1234567890', 'dbaruah@rediffmail.com', 11),
(3, 2, 'A Das', 'Barpeta', '1234567890', 'adas@yahoo.com', 10),
(4, 3, 'B Goswami', 'Maligaon,Near Railway colony, Guwahati, Assam', '1234567890', 'bgoswami@gmail.com', 9),
(5, 4, 'C Deka', 'Lahoti,Jorhat,Assam', '9854012345', 'cdeka@yahoo.com', 0),
(7, 1, 'Masih Saikia', 'Fency Bazar,guwahati,Assam', '1234567890', 'masihsaikia@gmail.com', 13),
(8, 3, 'J Nath', 'jorhat,Assam', '1234567890', 'jnath@gmail.com', 14);

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `first_name` int(20) NOT NULL,
  `last_name` int(20) NOT NULL,
  `dob` date NOT NULL,
  `gndr` varchar(2) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `guest`
--


-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `programme_id` int(11) NOT NULL auto_increment,
  `programme_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`programme_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `programme`
--

INSERT INTO `programme` (`programme_id`, `programme_name`) VALUES
(1, 'PhD'),
(2, 'Masters Degree'),
(3, 'Bachelors Degree'),
(4, 'PG Diploma'),
(5, 'Diploma'),
(6, 'certificate'),
(7, 'BPP');

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE IF NOT EXISTS `query` (
  `query_id` int(11) NOT NULL auto_increment,
  `query_title` varchar(100) NOT NULL,
  `query_body` text NOT NULL,
  `query_date` date NOT NULL,
  `query_by` varchar(100) NOT NULL,
  PRIMARY KEY  (`query_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `query`
--


-- --------------------------------------------------------

--
-- Table structure for table `query_reply`
--

CREATE TABLE IF NOT EXISTS `query_reply` (
  `reply_id` int(11) NOT NULL auto_increment,
  `reply_name` varchar(100) NOT NULL,
  `query_id` int(11) NOT NULL,
  `reply_body` text NOT NULL,
  `reply_date` date NOT NULL,
  PRIMARY KEY  (`reply_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `query_reply`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL auto_increment,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Adiministrator'),
(2, 'Faculty'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `semester_id` int(11) NOT NULL auto_increment,
  `semester_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`semester_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`) VALUES
(1, 'First Semester'),
(2, 'Second Semester'),
(3, 'Third Semester'),
(4, 'Fourth Semester'),
(5, 'Fifth Semester'),
(6, 'Sixth Semester'),
(7, 'Seventh Semester'),
(8, 'Eighth Semester');

-- --------------------------------------------------------

--
-- Table structure for table `spscs`
--

CREATE TABLE IF NOT EXISTS `spscs` (
  `spscs_id` int(11) NOT NULL auto_increment,
  `stream_id` varchar(20) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `sm_id` int(11) NOT NULL,
  PRIMARY KEY  (`spscs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `spscs`
--

INSERT INTO `spscs` (`spscs_id`, `stream_id`, `programme_id`, `course_id`, `subject_id`, `semester_id`, `sm_id`) VALUES
(1, '1', 1, 1, 16, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `stream`
--

CREATE TABLE IF NOT EXISTS `stream` (
  `stream_id` int(11) NOT NULL auto_increment,
  `stream_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`stream_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stream`
--

INSERT INTO `stream` (`stream_id`, `stream_name`) VALUES
(1, 'Arts'),
(2, 'Science'),
(3, 'Commerce'),
(4, 'Science'),
(5, 'asdf'),
(6, '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL auto_increment,
  `collage_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_address` varchar(100) NOT NULL,
  `student_mobile` varchar(10) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `collage_id`, `student_name`, `student_address`, `student_mobile`, `student_email`, `user_id`) VALUES
(1, 1, 'Polen Patowary', 'xxxxhhhh', '8876665701', 'polen31@gmail.com', 11),
(2, 2, 'kk', 'kk', 'kk', 'kkk', 4),
(3, 1, 'Jitu mani Saharia', 'Sipajhar,Darrang,Assam', '9854845613', 'jitu.mani123@gmail.com', 12),
(12, 3, '6', 'f', '7', 'a@b', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `study_material`
--

CREATE TABLE IF NOT EXISTS `study_material` (
  `sm_id` int(11) NOT NULL auto_increment,
  `sm_name` varchar(50) NOT NULL,
  `sm_path` varchar(100) NOT NULL,
  `sm_title` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY  (`sm_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `study_material`
--

INSERT INTO `study_material` (`sm_id`, `sm_name`, `sm_path`, `sm_title`, `faculty_id`) VALUES
(17, '10417045_654348364644198_159466487_n.jpg', 'uploaded/10417045_654348364644198_159466487_n.jpg', 'll', 1),
(18, 'greedy-2711w09.pdf', 'uploaded/greedy-2711w09.pdf', 'll', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL auto_increment,
  `subject_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`) VALUES
(1, 'TOC'),
(2, 'Java'),
(3, 'Web technology'),
(4, 'Computer Archetecture'),
(5, 'Computer Organization'),
(6, 'Data Mining'),
(7, 'Data Base Management System(I)'),
(8, 'Data Base Management System(II)'),
(9, 'Artifical Intalligence'),
(10, 'Data Structure With C++'),
(11, 'Computer Programming and Problem solving(CPPS)'),
(12, 'Design Analysis and Algorithm'),
(13, 'Opereting System'),
(14, 'Operation Reasarch'),
(15, 'Embeded System'),
(16, 'Political Science'),
(17, 'English'),
(18, 'Compiler');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL auto_increment,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `role_id`) VALUES
(1, 'admin', 'admin', 1),
(2, 'adas', 'adas', 2),
(3, 'faculty', 'faculty', 2),
(4, 'KK', 'KK', 3),
(5, 'jj', 'jj', 3),
(6, 'll', 'll', 3),
(7, 'dd', 'dd', 3),
(8, 'ss', 'ss', 2),
(10, 'rrjj', 'rrkk', 2),
(11, 'abc', 'abc', 2),
(12, 'jitu', 'jitu', 3),
(13, 'Masih', 'Masih', 2),
(14, 'jnath', 'jnath', 2);
