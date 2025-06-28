-- Adminer 4.8.1 MySQL 8.0.30 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `batako_online`;
CREATE DATABASE `batako_online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `batako_online`;

CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admin` (`username`, `password`) VALUES
('admin',	'35056cf3019b02c1b7c4cbcfec9d39f0');

CREATE TABLE `pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `no_hp`, `email`) VALUES
(4,	'gina',	'abdwew',	'08224522366',	'tsefdt@gmail.com'),
(6,	'robet',	'abdwew',	'08224522366',	'tsefdt@gmail.com'),
(7,	'rahul',	'abdwew',	'08224522366',	'tsefdt@gmail.com'),
(8,	'Tito ',	'G. Obos 19',	'08215458995',	'tito@gmail.com'),
(9,	'boyolali',	'g.obos',	'08459841',	'boyo@gmail.com');

CREATE TABLE `pesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pelanggan_id` int NOT NULL,
  `jenis_batako` varchar(20) NOT NULL,
  `jumlah` int NOT NULL,
  `tanggal_pesan` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pelanggan_id` (`pelanggan_id`),
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pesanan` (`id`, `pelanggan_id`, `jenis_batako`, `jumlah`, `tanggal_pesan`) VALUES
(3,	4,	'Batako Press',	45,	'2025-06-28 05:27:00'),
(4,	6,	'Batako Press',	45,	'2025-06-28 05:27:52'),
(5,	7,	'Batako Press',	45,	'2025-06-28 05:27:55'),
(6,	8,	'Batako Press',	25,	'2025-06-28 09:42:47'),
(7,	9,	'Batako Tras',	15,	'2025-06-28 09:42:39');

-- 2025-06-28 10:46:33
