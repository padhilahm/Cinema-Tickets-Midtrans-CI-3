/*
SQLyog Enterprise v12.5.1 (64 bit)
MySQL - 10.4.20-MariaDB : Database - midtrans_cinema
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`midtrans_cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `midtrans_cinema`;

/*Table structure for table `movies` */

DROP TABLE IF EXISTS `movies`;

CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `movies` */

insert  into `movies`(`id`,`title`,`description`,`image`,`price`) values 
(1,'Spider-Man: No Way Home','Identitas Spider-Man sekarang sudah terungkap, dan Peter meminta bantuan Doctor Strange. namun sebuah kesalahan terjadi, dan itu justru mengundang musuh berbahaya dari dunia lain, mereka mulai bermunculan. Hal itu memaksa Peter mencari apa makna sebenarnya menjadi Spider-Man.','nwh.jpg',40000),
(2,'Sword Art Online The Movie Progressive','Tidak ada cara untuk mengalahkan permainan ini. Satu-satunya perbedaan adalah kapan dan di mana kamu mati...\" satu bulan telah berlalu sejak permainan mematikan Akihiko Kayaba dimulai, dan korban terus meningkat. Dua ribu pemain sudah mati. Kirito dan Asuna adalah dua orang yang sangat berbeda, tapi','sao.jpg',40000),
(3,'The Batman','The Batman adalah sebuah film superhero Amerika yang akan datang berdasarkan karakter DC Comics bernama sama. Diproduksi oleh DC Films, 6th & Idaho, dan Dylan Clark Productions, dan akan didistribusikan oleh Warner Bros. Pictures, film ini adalah reboot dari franchise film Batman.','tb.jpg',45000);

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `gross_amount` bigint(20) DEFAULT NULL,
  `payment_type` varchar(50) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `status_code` char(3) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `watch_date` date DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`order_id`,`transaction_id`,`gross_amount`,`payment_type`,`transaction_time`,`status_code`,`amount`,`watch_date`,`movie_id`,`user_id`) values 
(4,'2049245186','9ea4aa9e-87ef-4605-b38a-f9f924294356',80000,'bank_transfer','2022-02-04 20:28:44','407',2,'2022-02-04',1,2),
(5,'981439023','cfa3d8fe-213f-495e-a42b-dd0ea653c719',120000,'bank_transfer','2022-02-04 21:05:04','407',3,'2022-02-04',2,2),
(6,'969930421','43ff3701-b4e0-402d-a981-e3b7c47179a3',45000,'bank_transfer','2022-02-04 22:13:47','407',1,'2022-02-04',3,3),
(7,'196485381','be496864-0034-4ad0-b810-cfe3482e094f',40000,'bank_transfer','2022-02-04 22:19:45','200',1,'2022-02-04',1,2),
(8,'1142764555','6652b8a8-f7d2-4a8a-ad06-5c404d770e55',120000,'bank_transfer','2022-02-04 22:22:04','200',3,'2022-02-04',2,2),
(9,'2043024422','b15c690f-66f0-40f5-8cef-cc7f3a3b4185',45000,'bank_transfer','2022-02-04 22:32:01','201',1,'2022-02-04',3,2);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`) values 
(2,'Muhammad Padhilah','padhilahm@gmail.com'),
(3,'Admin Admin','agungpn33@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
