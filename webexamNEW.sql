-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 29. Aug 2016 um 01:10
-- Server Version: 5.6.16
-- PHP-Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `webexam`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(50) NOT NULL,
  `admin_password` text NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer_title` varchar(50) NOT NULL,
  `answer_text` text NOT NULL,
  `answer_points` int(11) NOT NULL,
  `answer_show_title` tinyint(1) NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `fk_answer_question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Daten für Tabelle `answers`
--

INSERT INTO `answers` (`answer_id`, `question_id`, `answer_title`, `answer_text`, `answer_points`, `answer_show_title`) VALUES
(34, 13, 'Antwort 1: ', 'Universal Sata Bus', 0, 1),
(35, 13, 'Antwort 2: ', 'Universal Serial Bus', 1, 1),
(36, 13, 'Antwort 3: ', 'Unified Serial Bus', 0, 1),
(37, 13, 'Antwort 4: ', 'Universal Serial Buffer', 0, 1),
(38, 14, 'Antwort 1: ', 'Central Parallel Unit', 0, 1),
(39, 14, 'Antwort 2: ', 'Central Processing Unit', 1, 1),
(40, 15, 'Antwort 1: ', 'x64', 1, 1),
(41, 15, 'Antwort 2: ', 'x32', 0, 1),
(42, 15, 'Antwort 3: ', 'x86', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(50) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`, `category_description`) VALUES
(1, 'IT', 'Informationstechnik'),
(2, 'BÃ¼rokaufleute', 'Alle BÃ¼rokauleute');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exams`
--

CREATE TABLE IF NOT EXISTS `exams` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `exam_title` varchar(50) NOT NULL,
  `exam_description` text NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `fk_exams_category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `exams`
--

INSERT INTO `exams` (`exam_id`, `category_id`, `exam_title`, `exam_description`) VALUES
(1, 1, 'Hardware I', 'Hardware Grundlagen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exams_summary`
--

CREATE TABLE IF NOT EXISTS `exams_summary` (
  `exam_summary_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `grading_system_id` int(11) NOT NULL,
  `exam_summary_title` varchar(50) NOT NULL,
  `exam_summary_startdate` datetime NOT NULL,
  `exam_summary_duration_in_min` int(11) NOT NULL,
  `exam_summary_duration_absolute` tinyint(1) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_summary_id`),
  KEY `fk_exams_summary_exam_id` (`exam_id`),
  KEY `fk_exams_summary_gradingsystem_id` (`grading_system_id`),
  KEY `fk_exams_summary_category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `exams_summary`
--

INSERT INTO `exams_summary` (`exam_summary_id`, `exam_id`, `grading_system_id`, `exam_summary_title`, `exam_summary_startdate`, `exam_summary_duration_in_min`, `exam_summary_duration_absolute`, `category_id`) VALUES
(2, 1, 1, 'TESTTEST', '2016-08-21 10:00:00', 5, 1, 1),
(5, 1, 1, 'Sonntag Test', '2016-08-21 10:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_questions`
--

CREATE TABLE IF NOT EXISTS `exam_questions` (
  `exam_question_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_question_id`),
  KEY `fk_exam_questions_exam_id` (`exam_id`),
  KEY `fk_exam_question_question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `exam_questions`
--

INSERT INTO `exam_questions` (`exam_question_id`, `exam_id`, `question_id`) VALUES
(1, 1, 13),
(2, 1, 14),
(4, 1, 15);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_student_answers`
--

CREATE TABLE IF NOT EXISTS `exam_student_answers` (
  `exam_student_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_summary_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_student_answer_id`),
  KEY `fk_student_answers_question_id` (`question_id`),
  KEY `fk_student_answers_exams_summary_id` (`exam_summary_id`),
  KEY `fk_student_answers_answer_id` (`answer_id`),
  KEY `fk_exam_student_answers_student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Daten für Tabelle `exam_student_answers`
--

INSERT INTO `exam_student_answers` (`exam_student_answer_id`, `exam_summary_id`, `question_id`, `answer_id`, `student_id`) VALUES
(34, 2, 15, 41, 1),
(35, 5, 13, 35, 1),
(36, 5, 14, 39, 1),
(37, 5, 15, 40, 1),
(38, 5, 15, 41, 1),
(39, 5, 15, 42, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_student_end`
--

CREATE TABLE IF NOT EXISTS `exam_student_end` (
  `exam_student_end_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_student_enddate` datetime NOT NULL,
  `exam_summary_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_student_end_id`),
  KEY `fk_exam_student_end_exam_summary_id` (`exam_summary_id`),
  KEY `fk_exam_student_end_student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `exam_student_end`
--

INSERT INTO `exam_student_end` (`exam_student_end_id`, `exam_student_enddate`, `exam_summary_id`, `student_id`) VALUES
(10, '2016-08-29 00:58:20', 2, 1),
(11, '2016-08-29 01:06:22', 5, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_student_results`
--

CREATE TABLE IF NOT EXISTS `exam_student_results` (
  `exam_student_result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `exam_summary_id` int(11) NOT NULL,
  `exam_student_result_startdate` datetime NOT NULL,
  `exam_student_result_enddate` datetime NOT NULL,
  `exam_student_result_points` int(11) NOT NULL,
  `exam_student_result_grade_title` varchar(50) NOT NULL,
  `exam_student_result_percent` int(11) NOT NULL,
  PRIMARY KEY (`exam_student_result_id`),
  KEY `fk_exam_student_results_student_id` (`student_id`),
  KEY `fk_exam_student_results_exams_summary_id` (`exam_summary_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `exam_student_results`
--

INSERT INTO `exam_student_results` (`exam_student_result_id`, `student_id`, `exam_summary_id`, `exam_student_result_startdate`, `exam_student_result_enddate`, `exam_student_result_points`, `exam_student_result_grade_title`, `exam_student_result_percent`) VALUES
(10, 1, 2, '2016-08-29 00:53:20', '2016-08-29 00:58:20', 0, 'ungenügend', 0),
(11, 1, 5, '2016-08-29 01:05:22', '2016-08-29 01:06:22', 2, 'ausreichend', 50);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `exam_student_start`
--

CREATE TABLE IF NOT EXISTS `exam_student_start` (
  `exam_student_start_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_student_startdate` datetime NOT NULL,
  `exam_summary_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`exam_student_start_id`),
  KEY `fk_exam_student_start_exam_summary_id` (`exam_summary_id`),
  KEY `fk_exam_student_start_student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `exam_student_start`
--

INSERT INTO `exam_student_start` (`exam_student_start_id`, `exam_student_startdate`, `exam_summary_id`, `student_id`) VALUES
(3, '2016-08-29 00:53:20', 2, 1),
(4, '2016-08-29 01:05:22', 5, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grading_system`
--

CREATE TABLE IF NOT EXISTS `grading_system` (
  `grading_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `grading_system_title` varchar(50) NOT NULL,
  PRIMARY KEY (`grading_system_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `grading_system`
--

INSERT INTO `grading_system` (`grading_system_id`, `grading_system_title`) VALUES
(1, 'IHK-Schlüssel');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `grading_system_grades`
--

CREATE TABLE IF NOT EXISTS `grading_system_grades` (
  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
  `grading_system_id` int(11) NOT NULL,
  `grade_title` varchar(50) NOT NULL,
  `grade_point_range_start` int(11) NOT NULL,
  `grade_point_range_end` int(11) NOT NULL,
  PRIMARY KEY (`grade_id`),
  KEY `fk_grading_system_grades_grading_system_id` (`grading_system_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `grading_system_grades`
--

INSERT INTO `grading_system_grades` (`grade_id`, `grading_system_id`, `grade_title`, `grade_point_range_start`, `grade_point_range_end`) VALUES
(7, 1, 'sehr gut', 92, 100),
(8, 1, 'gut', 81, 91),
(9, 1, 'befriedigend', 67, 80),
(10, 1, 'ausreichend', 50, 66),
(11, 1, 'mangelhaft', 30, 49),
(12, 1, 'ungenügend', 0, 29);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `instructor_username` varchar(50) NOT NULL,
  `instructor_password` text NOT NULL,
  `instructor_title` varchar(10) NOT NULL,
  `instructor_firstname` varchar(50) NOT NULL,
  `instructor_lastname` varchar(50) NOT NULL,
  PRIMARY KEY (`instructor_id`),
  KEY `fk_instructors_catergory_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `question_title` varchar(50) NOT NULL,
  `question_text` text NOT NULL,
  `question_zero_points_if_all_answers_selected` tinyint(1) NOT NULL,
  `question_show_title` tinyint(1) NOT NULL,
  `question_is_multiplechoice` tinyint(1) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `fk_questions_catergory_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `questions`
--

INSERT INTO `questions` (`question_id`, `category_id`, `question_title`, `question_text`, `question_zero_points_if_all_answers_selected`, `question_show_title`, `question_is_multiplechoice`) VALUES
(13, 1, 'Schnittstellen', 'WofÃ¼r steht die AbkÃ¼zung USB?', 0, 1, 0),
(14, 1, 'CPU I', 'Was bedeutet CPU', 1, 1, 0),
(15, 1, 'CPU II', 'Welche CPU Architekturen existieren wirklich?', 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_media`
--

CREATE TABLE IF NOT EXISTS `question_media` (
  `question_media_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_media_title` varchar(50) NOT NULL,
  `question_media_description` text NOT NULL,
  `question_media_type` varchar(50) NOT NULL,
  `question_media_link` varchar(512) NOT NULL,
  `question_media_show_title` tinyint(1) NOT NULL,
  PRIMARY KEY (`question_media_id`),
  KEY `fk_question_media_question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `student_username` varchar(50) NOT NULL,
  `student_password` text NOT NULL,
  `student_title` varchar(10) NOT NULL,
  `student_firstname` varchar(50) NOT NULL,
  `student_lastname` varchar(50) NOT NULL,
  `student_birthdate` date NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `fk_students_catergory_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `students`
--

INSERT INTO `students` (`student_id`, `category_id`, `student_username`, `student_password`, `student_title`, `student_firstname`, `student_lastname`, `student_birthdate`) VALUES
(1, 1, 'MTrain', '4527f097c719879492e425d6c5306fa8500164d1dfaeedf7f6dbbb426cb46938febdf485227c8535bfd1a9f27e0fea9f1c7818de2e7280aec299346538adbf47', 'Herr', 'Maximilian', 'Winter', '1991-12-11');

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answer_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints der Tabelle `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `fk_exams_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints der Tabelle `exams_summary`
--
ALTER TABLE `exams_summary`
  ADD CONSTRAINT `fk_exams_summary_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  ADD CONSTRAINT `fk_exams_summary_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
  ADD CONSTRAINT `fk_exams_summary_gradingsystem_id` FOREIGN KEY (`grading_system_id`) REFERENCES `grading_system` (`grading_system_id`);

--
-- Constraints der Tabelle `exam_questions`
--
ALTER TABLE `exam_questions`
  ADD CONSTRAINT `fk_exam_questions_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`exam_id`),
  ADD CONSTRAINT `fk_exam_question_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints der Tabelle `exam_student_answers`
--
ALTER TABLE `exam_student_answers`
  ADD CONSTRAINT `fk_exam_student_answers_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `fk_student_answers_answer_id` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`answer_id`),
  ADD CONSTRAINT `fk_student_answers_exam_summary_id` FOREIGN KEY (`exam_summary_id`) REFERENCES `exams_summary` (`exam_summary_id`),
  ADD CONSTRAINT `fk_student_answers_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints der Tabelle `exam_student_end`
--
ALTER TABLE `exam_student_end`
  ADD CONSTRAINT `fk_exam_student_end_exam_summary_id` FOREIGN KEY (`exam_summary_id`) REFERENCES `exams_summary` (`exam_summary_id`),
  ADD CONSTRAINT `fk_exam_student_end_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints der Tabelle `exam_student_results`
--
ALTER TABLE `exam_student_results`
  ADD CONSTRAINT `fk_exam_student_results_exam_summary_id` FOREIGN KEY (`exam_summary_id`) REFERENCES `exams_summary` (`exam_summary_id`),
  ADD CONSTRAINT `fk_exam_student_results_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints der Tabelle `exam_student_start`
--
ALTER TABLE `exam_student_start`
  ADD CONSTRAINT `fk_exam_student_start_exam_summary_id` FOREIGN KEY (`exam_summary_id`) REFERENCES `exams_summary` (`exam_summary_id`),
  ADD CONSTRAINT `fk_exam_student_start_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints der Tabelle `grading_system_grades`
--
ALTER TABLE `grading_system_grades`
  ADD CONSTRAINT `fk_grading_system_grades_grading_system_id` FOREIGN KEY (`grading_system_id`) REFERENCES `grading_system` (`grading_system_id`);

--
-- Constraints der Tabelle `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `fk_instructors_catergory_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints der Tabelle `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_questions_catergory_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints der Tabelle `question_media`
--
ALTER TABLE `question_media`
  ADD CONSTRAINT `fk_question_media_question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`);

--
-- Constraints der Tabelle `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_catergory_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
