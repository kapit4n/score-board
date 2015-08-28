-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2015 at 06:27 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `scoreboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `score_id` int(11) NOT NULL,
  `score_value` int(4) NOT NULL,
  `team_id` int(6) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `score`
--
DELIMITER $$
CREATE TRIGGER `total_sum` BEFORE INSERT ON `score`
 FOR EACH ROW BEGIN
UPDATE team SET total = total + NEW.score_value WHERE id=NEW.team_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(6) unsigned NOT NULL,
  `name` varchar(30) NOT NULL,
  `total_points` int(11) NOT NULL,
  `total_goals` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `total_points`, `total_goals`, `logo`) VALUES
(4, 'Wilsterman', 6, 5, 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Club_Jorge_Wilstermann.svg/2000px-Club_Jorge_Wilstermann.svg.png'),
(5, 'Aurora', 0, 5, 'http://www.99sportslogos.com/wp-content/uploads/2013/02/Club-Aurora-Logo.jpg'),
(6, 'The Strongest', 3, 4, 'http://www.club-thestrongest.com/site/images/style1/esctigre0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_match`
--

CREATE TABLE IF NOT EXISTS `team_match` (
  `match_id` int(6) unsigned NOT NULL,
  `description` varchar(25) DEFAULT NULL,
  `visitor_score` int(4) NOT NULL,
  `local_score` int(4) NOT NULL,
  `visitor_team` int(6) unsigned NOT NULL,
  `local_team` int(6) unsigned NOT NULL,
  `match_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_match`
--

INSERT INTO `team_match` (`match_id`, `description`, `visitor_score`, `local_score`, `visitor_team`, `local_team`, `match_date`) VALUES
(18, NULL, 2, 3, 5, 4, '2015-08-12 04:42:28'),
(19, NULL, 1, 2, 5, 4, '2015-08-12 05:20:03'),
(20, NULL, 2, 4, 5, 6, '2015-08-12 05:23:36');

--
-- Triggers `team_match`
--
DELIMITER $$
CREATE TRIGGER `total_scores` BEFORE INSERT ON `team_match`
 FOR EACH ROW BEGIN

UPDATE team SET total_points = total_points + 3 WHERE id=NEW.visitor_team AND NEW.visitor_score > NEW.local_score;

UPDATE team SET total_points = total_points + 3 WHERE id=NEW.local_team AND NEW.visitor_score < NEW.local_score;



UPDATE team SET total_points = total_points + 1 WHERE id=NEW.visitor_team AND NEW.visitor_score = NEW.local_score;

UPDATE team SET total_points = total_points + 1 WHERE id=NEW.local_team AND NEW.visitor_score = NEW.local_score;

UPDATE team SET total_goals = total_goals + NEW.visitor_score WHERE id=NEW.visitor_team;

UPDATE team SET total_goals = total_goals + NEW.local_score WHERE id=NEW.local_team;


END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`score_id`), ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`), ADD KEY `id_index` (`id`);

--
-- Indexes for table `team_match`
--
ALTER TABLE `team_match`
  ADD PRIMARY KEY (`match_id`), ADD KEY `visitor_team` (`visitor_team`), ADD KEY `local_team` (`local_team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `score`
--
ALTER TABLE `score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `team_match`
--
ALTER TABLE `team_match`
  MODIFY `match_id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `score`
--
ALTER TABLE `score`
ADD CONSTRAINT `score_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `team_match`
--
ALTER TABLE `team_match`
ADD CONSTRAINT `team_match_ibfk_1` FOREIGN KEY (`visitor_team`) REFERENCES `team` (`id`),
ADD CONSTRAINT `team_match_ibfk_2` FOREIGN KEY (`local_team`) REFERENCES `team` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
