-- MySQL dump 10.13  Distrib 5.7.19, for Linux (i686)
--
-- Host: localhost    Database: University
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contingent`
--

DROP TABLE IF EXISTS `contingent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contingent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_id` int(11) NOT NULL,
  `count_students` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fk_contingent_groups` (`groups_id`),
  CONSTRAINT `fk_contingent_groups` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contingent`
--

LOCK TABLES `contingent` WRITE;
/*!40000 ALTER TABLE `contingent` DISABLE KEYS */;
/*!40000 ALTER TABLE `contingent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direction`
--

DROP TABLE IF EXISTS `direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `direction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_direction` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cypher` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direction`
--

LOCK TABLES `direction` WRITE;
/*!40000 ALTER TABLE `direction` DISABLE KEYS */;
INSERT INTO `direction` VALUES (5,'Информационные системы и технологии','09.04.02');
/*!40000 ALTER TABLE `direction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flows`
--

DROP TABLE IF EXISTS `flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flows` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direction_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_flows_direction` (`direction_id`),
  CONSTRAINT `fk_flows_direction` FOREIGN KEY (`direction_id`) REFERENCES `direction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flows`
--

LOCK TABLES `flows` WRITE;
/*!40000 ALTER TABLE `flows` DISABLE KEYS */;
/*!40000 ALTER TABLE `flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flows_id` int(11) DEFAULT NULL,
  `name_group` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groups_flows` (`flows_id`),
  CONSTRAINT `fk_groups_flows` FOREIGN KEY (`flows_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1502551201),('m130524_201442_init',1502551204),('m170812_104354_init_tables',1502551217),('m170814_160138_add_year_colomn_to_plan_table',1502726715),('m170815_104102_altertable',1502794182);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direction_id` int(11) NOT NULL,
  `plan_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `spesiality` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `form_of_training` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `level_of_training` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `year` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_plan_direction` (`direction_id`),
  CONSTRAINT `fk_plan_direction` FOREIGN KEY (`direction_id`) REFERENCES `direction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plan`
--

LOCK TABLES `plan` WRITE;
/*!40000 ALTER TABLE `plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rank_teacher`
--

DROP TABLE IF EXISTS `rank_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rank_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rank_teacher`
--

LOCK TABLES `rank_teacher` WRITE;
/*!40000 ALTER TABLE `rank_teacher` DISABLE KEYS */;
INSERT INTO `rank_teacher` VALUES (1,'Доцент'),(2,'Профессор'),(3,'Старший преподаватель'),(4,'Ассистент');
/*!40000 ALTER TABLE `rank_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teachers_id` int(11) NOT NULL,
  `name_subject` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `is_self` int(1) NOT NULL,
  `faculty` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subjects_teachers_id` (`teachers_id`),
  CONSTRAINT `fk_subjects_teachers_id` FOREIGN KEY (`teachers_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects`
--

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subjects_info`
--

DROP TABLE IF EXISTS `subjects_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subjects_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjects_id` int(11) NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `semestr` int(2) DEFAULT NULL,
  `lecture_time` int(4) DEFAULT NULL,
  `labs_time` int(4) DEFAULT NULL,
  `practical_time` int(4) DEFAULT NULL,
  `cource_work` int(1) DEFAULT NULL,
  `cource_project` int(1) DEFAULT NULL,
  `individual_assignment` int(1) DEFAULT NULL,
  `form_reports` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `summ_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subjects_info_subjects` (`subjects_id`),
  KEY `fk_subjects_info_plan` (`plan_id`),
  CONSTRAINT `fk_subjects_info_plan` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_subjects_info_subjects` FOREIGN KEY (`subjects_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subjects_info`
--

LOCK TABLES `subjects_info` WRITE;
/*!40000 ALTER TABLE `subjects_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_teacher_id` int(11) NOT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `patronymic` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_teachers_rank_teacher_id` (`rank_teacher_id`),
  CONSTRAINT `fk_teachers_rank_teacher_id` FOREIGN KEY (`rank_teacher_id`) REFERENCES `rank_teacher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,1,'Виктория','Светличная','Антоновна'),(2,1,'Максим','Привалов','Владимирович'),(3,1,'Татьяна','Мартыненко ','Владимировна'),(4,1,'татьяна','Васяева ','Александровна'),(5,1,'Николай','Ярошенко','Аленсандрович'),(6,4,'Кристина','Бабич','Константиновна'),(7,4,'Ирина','Матях','Владимировна'),(8,4,'Алена ','Воронова','Игоревна'),(9,4,'Владимир','Пряхин','Викторович'),(10,1,'Сергей','Хмелевой','Владимирович'),(11,1,'Елена','Савкова','Осиповна'),(12,1,'Александр','Секирин','Иванович'),(13,3,'Александр','Поялков','Иванович'),(14,4,'Александр','Бережной','Аленсандрович'),(15,4,'Екатерина','Щуватова','Александровна'),(16,1,'Светлана','Землянская','Юрьевна'),(17,3,'Наталья','Андриевская','Климовна'),(18,3,'Ольга','Теплова','Валентиновна'),(19,3,'Денис','Новиков','Дмитриевич');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'admin','PhWV3DB3o7W88P9k5UUzWLPOK-QvmfHh','$2y$13$FnXDzoV.O/cfHO/GQhu2PefHbquUOyKkMK1//695F6vC716WyNKMi',NULL,'novikov.d92@mai.ru',10,1502705799,1502705799);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yp3`
--

DROP TABLE IF EXISTS `yp3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yp3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yp3`
--

LOCK TABLES `yp3` WRITE;
/*!40000 ALTER TABLE `yp3` DISABLE KEYS */;
/*!40000 ALTER TABLE `yp3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yp3_subjects`
--

DROP TABLE IF EXISTS `yp3_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yp3_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subjects_info_id` int(11) NOT NULL,
  `yp3_id` int(11) NOT NULL,
  `flows_id` int(11) NOT NULL,
  `count_week` int(2) NOT NULL,
  `semestr` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_yp3_subjects_subjects_info` (`subjects_info_id`),
  KEY `fk_yp3_subjects_yp3` (`yp3_id`),
  KEY `fk_yp3_subjects_flows` (`flows_id`),
  CONSTRAINT `fk_yp3_subjects_flows` FOREIGN KEY (`flows_id`) REFERENCES `flows` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yp3_subjects_subjects_info` FOREIGN KEY (`subjects_info_id`) REFERENCES `subjects_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_yp3_subjects_yp3` FOREIGN KEY (`yp3_id`) REFERENCES `yp3` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yp3_subjects`
--

LOCK TABLES `yp3_subjects` WRITE;
/*!40000 ALTER TABLE `yp3_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `yp3_subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-15 18:53:22
