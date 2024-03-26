CREATE DATABASE  IF NOT EXISTS `multimedia_db_group` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `multimedia_db_group`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: multimedia_db_group
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artists` (
  `artist_id` int NOT NULL AUTO_INCREMENT,
  `artist_name` varchar(255) DEFAULT NULL,
  `description` text,
  `country` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artists`
--

LOCK TABLES `artists` WRITE;
/*!40000 ALTER TABLE `artists` DISABLE KEYS */;
INSERT INTO `artists` VALUES (1,'Billie Eilish','Billie Eilish Pirate Baird O\'Connell is an American singer-songwriter. Her debut single, \"Ocean Eyes\", went viral and has accumulated over 194 million streams on Spotify as of January 2024.','United States','\\public\\assets\\images\\artist_images\\img4.jpg'),(2,'Halsey','Ashley Nicolette Frangipane, known professionally as Halsey, is an American singer-songwriter. Her accolades include two Billboard Music Awards, one American Music Award, and four Grammy Award nominations.','United States','\\public\\assets\\images\\artist_images\\img20.jpg'),(3,'Alan Walker','Alan Olav Walker is a British-Norwegian DJ and record producer. In 2015, Walker received international acclaim after releasing the single \"Faded\", which received platinum certifications in 14 countries.','Norway','\\public\\assets\\images\\artist_images\\img7.jpg'),(4,'Avicii','Tim Bergling, better known by his stage name Avicii, was a Swedish DJ, record producer, and musician. He is regarded as one of the greatest DJs of all time.','Sweden','\\public\\assets\\images\\artist_images\\img25.jpg'),(5,'Martin Garrix','Martijn Gerard Garritsen, known professionally as Martin Garrix, is a Dutch DJ and record producer. He was ranked number one on DJ Mag\'s Top 100 DJs list for three consecutive years.','Netherlands','\\public\\assets\\images\\artist_images\\img9.jpg'),(6,'Khalid','Khalid Donnel Robinson is an American singer and songwriter. He is known for his distinct voice and style, which incorporates elements of R&B, pop, hip hop, and indie music.','United States','\\public\\assets\\images\\artist_images\\img18.jpg'),(7,'The Chainsmokers','The Chainsmokers are an American electronic DJ and production duo consisting of Alexander \"Alex\" Pall and Andrew \"Drew\" Taggart. They have won two Grammy Awards and have sold over 70 million records worldwide.','United States','\\public\\assets\\images\\artist_images\\img23.jpg'),(8,'Ariana Grande','American singer, songwriter, and actress','United States','\\public\\assets\\images\\artist_images\\img2.jpg'),(9,'Ed Sheeran','English singer, songwriter, and musician','United Kingdom','\\public\\assets\\images\\artist_images\\img3.jpg'),(10,'Beyoncé','American singer, songwriter, and actress','United States','\\public\\assets\\images\\artist_images\\img4.jpg'),(11,'Shawn Mendes','Canadian singer, songwriter, and model','Canada','\\public\\assets\\images\\artist_images\\img11.jpg'),(12,'Taylor Swift','American singer-songwriter','United States','\\public\\assets\\images\\artist_images\\img12.jpg'),(13,'Drake','Canadian rapper, singer, and songwriter','Canada','\\public\\assets\\images\\artist_images\\img13.jpg'),(14,'Cardi B','American rapper, songwriter, and actress','United States','\\public\\assets\\images\\artist_images\\img14.jpg'),(15,'Post Malone','American rapper, singer, and songwriter','United States','\\public\\assets\\images\\artist_images\\img15.jpg'),(16,'Dua Lipa','English singer and songwriter','United Kingdom','\\public\\assets\\images\\artist_images\\img16.jpg'),(17,'Justin Bieber','Canadian singer, songwriter, and actor','Canada','\\public\\assets\\images\\artist_images\\img17.jpg');
/*!40000 ALTER TABLE `artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `songs` (
  `song_id` int NOT NULL AUTO_INCREMENT,
  `artist_id` int DEFAULT NULL,
  `genre` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `audio_file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `release_year` int DEFAULT NULL,
  PRIMARY KEY (`song_id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `songs`
--

LOCK TABLES `songs` WRITE;
/*!40000 ALTER TABLE `songs` DISABLE KEYS */;
INSERT INTO `songs` VALUES (30,1,'Pop','\\public\\assets\\images\\artist_images\\img1.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\audio\\billie_eilish_bad_guy.mp3','Bad Guy',2019),(31,2,'Pop','\\public\\assets\\images\\artist_images\\img2.jpg','/public/assets/audio/billie_eilish_bad_guy.mp3','Without Me',2018),(32,3,'Electronic','\\public\\assets\\images\\artist_images\\img3.jpg','\\public\\assets\\audio\\billie_eilish_bad_guy.mp3','Faded',2015),(33,4,'Electronic','\\public\\assets\\images\\artist_images\\img4.jpg','\\public\\assets\\audio\\billie_eilish_bad_guy.mp3','Wake Me Up',2013),(34,5,'Electronic','\\public\\assets\\images\\artist_images\\img5.jpg','\\public\\assets\\audio\\billie_eilish_bad_guy.mp3','Animals',2013),(35,6,'R&B','\\public\\assets\\images\\artist_images\\img6.jpg','\\public\\assets\\audio\\billie_eilish_bad_guy.mp3','Young Dumb & Broke',2017),(36,7,'Pop','\\public\\assets\\images\\artist_images\\img7.jpg','/audio/closer.mp3','Closer',2016),(37,1,'Pop','\\public\\assets\\images\\artist_images\\img8.jpg','/audio/when_the_party_is_over.mp3','When the Party\'s Over',2018),(38,2,'Pop','\\public\\assets\\images\\artist_images\\img9.jpg','/audio/nightmare.mp3','Nightmare',2019),(39,3,'Electronic','\\public\\assets\\images\\artist_images\\img10.jpg','/audio/sing_me_to_sleep.mp3','Sing Me to Sleep',2016),(40,4,'Electronic','\\public\\assets\\images\\artist_images\\img11.jpg','/audio/levels.mp3','Levels',2011),(41,5,'Electronic','\\public\\assets\\images\\artist_images\\img12.jpg','/audio/byte.mp3','Byte',2017),(42,6,'R&B','\\public\\assets\\images\\artist_images\\img13.jpg','/audio/saved.mp3','Saved',2017),(43,7,'Pop','\\public\\assets\\images\\artist_images\\img14.jpg','/audio/something_just_like_this.mp3','Something Just Like This',2017),(59,1,'Pop','/public/assets/images/artist_images/img6.jpg','/public/assets/audio/song1.mp3','Rain on Me',2020),(60,2,'Pop','/public/assets/images/artist_images/img6.jpg','/public/assets/audio/song2.mp3','Shape of You',2017),(61,3,'R&B','/public/assets/images/artist_images/img7.jpg','/public/assets/audio/song3.mp3','Halo',2008),(62,4,'Pop','/public/assets/images/artist_images/img20.jpg','/public/assets/audio/song4.mp3','Stitches',2015),(63,5,'Pop','/public/assets/images/artist_images/img28.jpg','/public/assets/audio/song5.mp3','Love Story',2008),(64,6,'Hip Hop','/public/assets/images/artist_images/img30.jpg','/public/assets/audio/song6.mp3','God\'s Plan',2018),(65,7,'Hip Hop','/public/assets/images/artist_images/img31.jpg','/public/assets/audio/song7.mp3','WAP',2020),(66,8,'Hip Hop','/public/assets/images/artist_images/img32.jpg','/public/assets/audio/song8.mp3','Rockstar',2020),(67,9,'Pop','/public/assets/images/artist_images/img29.jpg','/public/assets/audio/song9.mp3','Don\'t Start Now',2019),(68,10,'Pop','/public/assets/images/artist_images/img22.jpg','/public/assets/audio/song10.mp3','Intentions',2020),(69,11,'Pop','/public/assets/images/artist_images/img6.jpg','/public/assets/audio/song11.mp3','Senorita',2019),(70,12,'Pop','/public/assets/images/artist_images/img8.jpg','/public/assets/audio/song12.mp3','Blinding Lights',2019),(71,13,'Pop','/public/assets/images/artist_images/img9.jpg','/public/assets/audio/song13.mp3','Good 4 U',2021),(72,14,'Hip Hop','/public/assets/images/artist_images/img10.jpg','/public/assets/audio/song14.mp3','Congratulations',2016),(73,15,'Pop','/public/assets/images/artist_images/img19.jpg','/public/assets/audio/song15.mp3','Levitating',2020);
/*!40000 ALTER TABLE `songs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'clinton','$2y$10$Y6UNG.uy462jXPlOycQrbOLI6i2oNTMvf8OpVleEuXR7N3mPv65UK','victormati746@gmail.com','2024-03-25 08:24:17');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `videos` (
  `video_id` int NOT NULL AUTO_INCREMENT,
  `artist_id` int DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `resolution` varchar(50) DEFAULT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL,
  `video_file` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`video_id`),
  KEY `artist_id` (`artist_id`),
  CONSTRAINT `videos_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,1,'03:14:00','1080p','\\public\\assets\\images\\artist_images\\img15.jpg','\\public\\assets\\videos\\Billie Eilish - Ocean Eyes (Official Music Video).mp4','Lovely'),(2,2,'03:22:00','720p','\\public\\assets\\images\\artist_images\\img16.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\videos','Without Me'),(3,3,'03:33:00','1080p','\\public\\assets\\images\\artist_images\\img17.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\videos','Faded'),(4,4,'04:10:00','720p','\\public\\assets\\images\\artist_images\\img18.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\videos','Wake Me Up'),(5,5,'03:19:00','1080p','\\public\\assets\\images\\artist_images\\img19.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\videos','Animals'),(6,6,'03:14:00','720p','\\public\\assets\\images\\artist_images\\img20.jpg','C:\\Users\\hp\\Documents\\DataBase\\MULTIMEDIA-DB-PROJECT\\public\\assets\\videos','Talk'),(7,7,'04:21:00','1080p','\\public\\assets\\images\\artist_images\\img21.jpg','/videos/closer.mp4','Closer'),(8,4,'03:53:00','720p','\\public\\assets\\images\\artist_images\\img22.jpg','/videos/happier.mp4','happier'),(9,4,'03:05:00','1080p','\\public\\assets\\images\\artist_images\\img24.jpg','/videos/lonely_together.mp4','lonely_together'),(10,1,'03:21:00','720p','\\public\\assets\\images\\artist_images\\img24.jpg','/videos/ocean_eyes.mp4','ocean_eyes'),(11,2,'02:54:00','1080p','\\public\\assets\\images\\artist_images\\img25.jpg','/videos/eastside.mp4','eastside'),(12,3,'02:44:00','720p','\\public\\assets\\images\\artist_images\\img26.jpg','/videos/alone.mp4','alone'),(13,5,'03:41:00','1080p','\\public\\assets\\images\\artist_images\\img27.jpg','/videos/scared_to_be_lonely.mp4','scared_to_be_lonely'),(14,6,'04:08:00','720p','\\public\\assets\\images\\artist_images\\img28.jpg','/videos/young_dumb_and_broke.mp4','young_dumb_and_broke'),(15,7,'04:07:00','1080p','\\public\\assets\\images\\artist_images\\img29.jpg','/videos/something_just_like_this.mp4','something_just_like_this'),(16,3,'03:51:00','720p','\\public\\assets\\images\\artist_images\\img30.jpg','/videos/all_falls_down.mp4','all_falls_down'),(17,4,'03:10:00','1080p','\\public\\assets\\images\\artist_images\\img31.jpg','/videos/wasted.mp4','wasted'),(18,5,'03:04:00','720p','\\public\\assets\\images\\artist_images\\img32.jpg','/videos/so_far_away.mp4','so_far_away'),(19,6,'03:34:00','1080p','\\public\\assets\\images\\artist_images\\img1.jpg','/videos/love_lies.mp4','love_lies'),(20,7,'03:49:00','720p','\\public\\assets\\images\\artist_images\\img12.jpg','/videos/roses.mp4','roses'),(61,8,'04:30:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video1.mp4','Music Video 1'),(62,9,'03:45:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video2.mp4','Music Video 2'),(63,10,'05:10:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video3.mp4','Music Video 3'),(64,11,'04:02:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video4.mp4','Music Video 4'),(65,12,'03:30:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video5.mp4','Music Video 5'),(66,13,'04:20:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video6.mp4','Music Video 6'),(67,14,'03:55:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video7.mp4','Music Video 7'),(68,15,'04:15:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video8.mp4','Music Video 8'),(69,16,'03:40:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video9.mp4','Music Video 9'),(70,17,'04:00:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video10.mp4','Music Video 10'),(71,1,'03:25:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video11.mp4','Music Video 11'),(72,2,'04:45:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video12.mp4','Music Video 12'),(73,3,'03:50:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video13.mp4','Music Video 13'),(74,4,'04:10:00','720p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video14.mp4','Music Video 14'),(75,5,'03:35:00','1080p','/public/assets/images/artist_images/img6.jpg','/public/assets/videos/video15.mp4','Music Video 15');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-26 14:37:40
