CREATE DATABASE IF NOT EXISTS db_colegio;

USE db_colegio;

CREATE TABLE IF NOT EXISTS `responsible` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `fsurname` varchar(50) NOT NULL,
  `ssurname` varchar(50) NOT NULL,
  `document` varchar(15) NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `fsurname` varchar(50) DEFAULT NULL,
  `ssurname` varchar(50) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `document` varchar(15) DEFAULT NULL,
  `grp` varchar(5) DEFAULT NULL,
  `fk_responsible` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_responsible_id` (`fk_responsible`),
  CONSTRAINT `fk_responsible_id` FOREIGN KEY (`fk_responsible`) REFERENCES `responsible` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `t_user` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`username`, `password`, `t_user`) VALUES
('root', 'root', 'admin'),
('user', 'user', 'normal');