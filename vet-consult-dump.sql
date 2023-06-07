-- MySQL dump 10.13  Distrib 8.0.32, for macos13.0 (arm64)
--
-- Host: localhost    Database: vet_consult
-- ------------------------------------------------------
-- Server version	8.0.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clinic_examen`
--

DROP TABLE IF EXISTS `clinic_examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clinic_examen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_id` int NOT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EE156A53C54C8C93` (`type_id`),
  CONSTRAINT `FK_EE156A53C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `clinic_sign_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_examen`
--

LOCK TABLES `clinic_examen` WRITE;
/*!40000 ALTER TABLE `clinic_examen` DISABLE KEYS */;
INSERT INTO `clinic_examen` VALUES (1,1,NULL),(2,3,NULL),(3,2,NULL),(4,4,NULL),(5,4,'Pleurothotonus (=incurvation  latérale du corps)'),(6,6,'Ataxie symétrique des 4 membres'),(7,4,'Tremblements intentionnels tête'),(8,6,'Atteinte des 4 membres'),(9,7,'Tonus musculaire des anterieurs'),(10,7,'Réflexe de flexion de l\'anterieur'),(11,7,'Tonus musculaire des postérieurs'),(12,7,'Réflexe de flexion du postérieur'),(13,7,'Réflexe patellaire'),(14,7,'Réflexe sciatique'),(15,9,'Anomalie à examen des nerfs craniens'),(16,7,'Réflexes médullaires'),(18,7,'Reflexe photomoteurs'),(19,2,'Réponse à la menace'),(20,9,'Atteinte des autres nerf crâniens'),(21,7,'Réflexe palpébral'),(22,5,'Nystagmus'),(23,5,'Strabisme positionnel ventral'),(24,6,'Parésie'),(25,4,'Déficit proprioceptif ipsilatéral'),(26,4,'Trémulations corps'),(27,6,'Hypermétrie sans parésie'),(28,4,'Augmentation du polygone de sustentation'),(29,7,'Ambulatoire'),(30,2,'Sauf déficit de réponse à la menace'),(31,6,'Marche sur le cercle'),(32,6,'Ataxie'),(33,8,'Tonus des membres');
/*!40000 ALTER TABLE `clinic_examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_examen_clinic_sign_value`
--

DROP TABLE IF EXISTS `clinic_examen_clinic_sign_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clinic_examen_clinic_sign_value` (
  `clinic_examen_id` int NOT NULL,
  `clinic_sign_value_id` int NOT NULL,
  PRIMARY KEY (`clinic_examen_id`,`clinic_sign_value_id`),
  KEY `IDX_7DF16F8CFA7432F1` (`clinic_examen_id`),
  KEY `IDX_7DF16F8CDA3F1B4B` (`clinic_sign_value_id`),
  CONSTRAINT `FK_7DF16F8CDA3F1B4B` FOREIGN KEY (`clinic_sign_value_id`) REFERENCES `clinic_sign_value` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7DF16F8CFA7432F1` FOREIGN KEY (`clinic_examen_id`) REFERENCES `clinic_examen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_examen_clinic_sign_value`
--

LOCK TABLES `clinic_examen_clinic_sign_value` WRITE;
/*!40000 ALTER TABLE `clinic_examen_clinic_sign_value` DISABLE KEYS */;
INSERT INTO `clinic_examen_clinic_sign_value` VALUES (1,3),(1,4),(1,6),(2,1),(2,2),(2,3),(3,4),(3,21),(4,5),(4,10),(4,11),(4,12),(4,13),(4,14),(5,1),(5,2),(5,3),(6,1),(6,2),(6,3),(7,1),(7,2),(7,3),(8,1),(8,2),(8,3),(9,15),(9,16),(10,3),(10,15),(10,16),(11,15),(11,16),(12,3),(12,15),(12,16),(13,3),(13,15),(13,16),(14,3),(14,15),(14,16),(15,1),(15,2),(15,3),(16,3),(16,4),(16,15),(18,4),(18,17),(18,18),(19,4),(19,17),(19,18),(20,1),(20,2),(20,3),(21,4),(21,17),(21,18),(22,1),(22,2),(22,3),(23,1),(23,2),(23,3),(24,3),(24,19),(24,20),(25,1),(25,2),(25,3),(26,1),(26,2),(26,3),(27,1),(27,2),(27,3),(28,1),(28,2),(28,3),(29,1),(29,2),(29,3),(30,1),(30,2),(30,3),(31,1),(31,2),(31,3),(32,3),(32,19),(32,20),(33,15),(33,16);
/*!40000 ALTER TABLE `clinic_examen_clinic_sign_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_sign_type`
--

DROP TABLE IF EXISTS `clinic_sign_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clinic_sign_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `main_type_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7409CB2B3107257A` (`main_type_id`),
  CONSTRAINT `FK_7409CB2B3107257A` FOREIGN KEY (`main_type_id`) REFERENCES `clinic_sign_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_sign_type`
--

LOCK TABLES `clinic_sign_type` WRITE;
/*!40000 ALTER TABLE `clinic_sign_type` DISABLE KEYS */;
INSERT INTO `clinic_sign_type` VALUES (1,NULL,'Etat de conscience'),(2,NULL,'Comportement'),(3,NULL,'Convulsion'),(4,NULL,'Posture'),(5,NULL,'Vision'),(6,NULL,'Démarche'),(7,NULL,'Autre'),(8,NULL,'Reflexe médulaires'),(9,NULL,'Nerf crâniens');
/*!40000 ALTER TABLE `clinic_sign_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clinic_sign_value`
--

DROP TABLE IF EXISTS `clinic_sign_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clinic_sign_value` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clinic_sign_value`
--

LOCK TABLES `clinic_sign_value` WRITE;
/*!40000 ALTER TABLE `clinic_sign_value` DISABLE KEYS */;
INSERT INTO `clinic_sign_value` VALUES (1,'Oui'),(2,'Non'),(3,'NSP'),(4,'Normal'),(5,'Normale'),(6,'Altéré (apathie, stupeur, coma)'),(7,'Désintérêt'),(8,'Hyperexcitabilité'),(9,'Poussé au mur'),(10,'Tête tournée'),(11,'Tête penchée'),(12,'Position assise'),(13,'Décubitus'),(14,'Cyphose'),(15,'Diminué ou absent'),(16,'Normal ou augmenté'),(17,'Déficit ipsilatéral'),(18,'Déficit controlatéral'),(19,'Présente'),(20,'Absente'),(21,'Compulsif (Déambulation, poussé au mur, vocalise, hyperexcitabilité, hagard)');
/*!40000 ALTER TABLE `clinic_sign_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reasons_id` int NOT NULL,
  `current_step_id` int DEFAULT NULL,
  `consultation_flow_id` int NOT NULL,
  `symptoms` json DEFAULT NULL,
  `user_id` int NOT NULL,
  `injury_id` int DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_964685A6F929F458` (`reasons_id`),
  KEY `IDX_964685A6D9BF9B19` (`current_step_id`),
  KEY `IDX_964685A63BB5FCF9` (`consultation_flow_id`),
  KEY `IDX_964685A6A76ED395` (`user_id`),
  KEY `IDX_964685A6ABA45E9A` (`injury_id`),
  CONSTRAINT `FK_964685A63BB5FCF9` FOREIGN KEY (`consultation_flow_id`) REFERENCES `consultation_flow` (`id`),
  CONSTRAINT `FK_964685A6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_964685A6ABA45E9A` FOREIGN KEY (`injury_id`) REFERENCES `injury` (`id`),
  CONSTRAINT `FK_964685A6D9BF9B19` FOREIGN KEY (`current_step_id`) REFERENCES `examen_step` (`id`),
  CONSTRAINT `FK_964685A6F929F458` FOREIGN KEY (`reasons_id`) REFERENCES `consultation_reason` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation`
--

LOCK TABLES `consultation` WRITE;
/*!40000 ALTER TABLE `consultation` DISABLE KEYS */;
INSERT INTO `consultation` VALUES (6,1,NULL,1,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"2\": {\"examen\": \"Convulsion\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 8, \"name\": \"Hyperexcitabilité\"}}, \"4\": {\"examen\": \"Posture\", \"symptom\": {\"id\": 10, \"name\": \"Tête tournée\"}}, \"5\": {\"examen\": \"Posture - Pleurothotonus (=incurvation  latérale du corps)\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}}',1,NULL,'2023-05-17 12:35:32'),(7,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"9\": {\"examen\": \"Autre - Tonus musculaire des anterieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}}',1,2,'2023-05-17 12:47:34'),(8,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"9\": {\"examen\": \"Autre - Tonus musculaire des anterieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}}',1,2,'2023-05-17 17:38:20'),(9,1,1,1,'[]',1,NULL,'2023-05-17 17:42:16'),(11,2,29,3,'[]',1,NULL,'2023-05-17 17:58:09'),(12,2,29,3,'[]',1,NULL,'2023-05-17 17:58:33'),(13,1,1,1,'[]',1,NULL,'2023-05-17 17:58:48'),(14,2,NULL,3,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}}',1,NULL,'2023-05-18 07:56:42'),(15,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 3, \"name\": \"NSP\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}}',1,NULL,'2023-05-29 08:43:55'),(16,4,43,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 6, \"name\": \"Altéré (apathie, stupeur, coma)\"}}, \"2\": {\"examen\": \"Convulsion\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"18\": {\"examen\": \"Autre - Reflexe photomoteurs\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"19\": {\"examen\": \"Comportement - Réponse à la menace\", \"symptom\": {\"id\": 18, \"name\": \"Déficit controlatéral\"}}, \"20\": {\"examen\": \"Nerf crâniens - Atteinte des autres nerf crâniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,NULL,'2023-05-29 09:31:06'),(17,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"9\": {\"examen\": \"Autre - Tonus musculaire des anterieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}}',1,2,'2023-05-29 09:32:41'),(18,1,1,1,'[]',1,NULL,'2023-05-29 10:46:10'),(19,1,1,1,'[]',1,NULL,'2023-05-29 11:58:46'),(20,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}}',1,9,'2023-05-29 12:38:44'),(22,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"9\": {\"examen\": \"Autre - Tonus musculaire des anterieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"26\": {\"examen\": \"Posture - Trémulations corps\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"27\": {\"examen\": \"Démarche - Hypermétrie sans parésie\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"28\": {\"examen\": \"Posture - Augmentation du polygone de sustentation\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,2,'2023-06-01 12:17:25'),(23,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 15, \"name\": \"Diminué ou absent\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 15, \"name\": \"Diminué ou absent\"}}, \"26\": {\"examen\": \"Posture - Trémulations corps\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"27\": {\"examen\": \"Démarche - Hypermétrie sans parésie\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"28\": {\"examen\": \"Posture - Augmentation du polygone de sustentation\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,10,'2023-06-01 12:28:37'),(24,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Posture - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"8\": {\"examen\": \"Démarche - Atteinte des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"9\": {\"examen\": \"Autre - Tonus musculaire des anterieurs\", \"symptom\": {\"id\": 15, \"name\": \"Diminué ou absent\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 15, \"name\": \"Diminué ou absent\"}}, \"11\": {\"examen\": \"Autre - Tonus musculaire des postérieurs\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"26\": {\"examen\": \"Posture - Trémulations corps\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"27\": {\"examen\": \"Démarche - Hypermétrie sans parésie\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"28\": {\"examen\": \"Posture - Augmentation du polygone de sustentation\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,8,'2023-06-01 12:32:20'),(25,7,NULL,5,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 3, \"name\": \"NSP\"}}, \"2\": {\"examen\": \"Convulsion\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}}',1,NULL,'2023-06-01 12:33:47'),(26,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 6, \"name\": \"Altéré (apathie, stupeur, coma)\"}}, \"2\": {\"examen\": \"Convulsion\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"16\": {\"examen\": \"Autre - Réflexes médullaires\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"18\": {\"examen\": \"Autre - Reflexe photomoteurs\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"19\": {\"examen\": \"Comportement - Réponse à la menace\", \"symptom\": {\"id\": 18, \"name\": \"Déficit controlatéral\"}}, \"20\": {\"examen\": \"Nerf crâniens - Atteinte des autres nerf crâniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,NULL,'2023-06-01 12:36:52'),(27,4,NULL,2,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 6, \"name\": \"Altéré (apathie, stupeur, coma)\"}}, \"2\": {\"examen\": \"Convulsion\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 21, \"name\": \"Compulsif (Déambulation, poussé au mur, vocalise, hyperexcitabilité, hagard)\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"16\": {\"examen\": \"Autre - Réflexes médullaires\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"18\": {\"examen\": \"Autre - Reflexe photomoteurs\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"19\": {\"examen\": \"Comportement - Réponse à la menace\", \"symptom\": {\"id\": 18, \"name\": \"Déficit controlatéral\"}}, \"20\": {\"examen\": \"Nerf crâniens - Atteinte des autres nerf crâniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,4,'2023-06-01 12:45:01'),(29,1,NULL,1,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"4\": {\"examen\": \"Posture\", \"symptom\": {\"id\": 10, \"name\": \"Tête tournée\"}}, \"6\": {\"examen\": \"Démarche - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"7\": {\"examen\": \"Posture - Tremblements intentionnels tête\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"16\": {\"examen\": \"Autre - Réflexes médullaires\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"26\": {\"examen\": \"Posture - Trémulations corps\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"27\": {\"examen\": \"Démarche - Hypermétrie sans parésie\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"28\": {\"examen\": \"Posture - Augmentation du polygone de sustentation\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"30\": {\"examen\": \"Comportement - Sauf déficit de réponse à la menace\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,NULL,'2023-06-01 12:52:01'),(30,7,NULL,5,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"22\": {\"examen\": \"Vision - Nystagmus\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"23\": {\"examen\": \"Vision - Strabisme positionnel ventral\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"24\": {\"examen\": \"Démarche - Parésie\", \"symptom\": {\"id\": 19, \"name\": \"Présente\"}}, \"25\": {\"examen\": \"Posture - Déficit proprioceptif ipsilatéral\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"31\": {\"examen\": \"Démarche - Marche sur le cercle\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"32\": {\"examen\": \"Démarche - Ataxie\", \"symptom\": {\"id\": 19, \"name\": \"Présente\"}}}',1,NULL,'2023-06-01 13:06:53'),(31,7,NULL,5,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"22\": {\"examen\": \"Vision - Nystagmus\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"23\": {\"examen\": \"Vision - Strabisme positionnel ventral\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"24\": {\"examen\": \"Démarche - Parésie\", \"symptom\": {\"id\": 19, \"name\": \"Présente\"}}, \"25\": {\"examen\": \"Posture - Déficit proprioceptif ipsilatéral\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"31\": {\"examen\": \"Démarche - Marche sur le cercle\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"32\": {\"examen\": \"Démarche - Ataxie\", \"symptom\": {\"id\": 19, \"name\": \"Présente\"}}}',1,6,'2023-06-01 13:17:43'),(32,7,NULL,5,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"10\": {\"examen\": \"Autre - Réflexe de flexion de l\'anterieur\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"12\": {\"examen\": \"Autre - Réflexe de flexion du postérieur\", \"symptom\": {\"id\": 15, \"name\": \"Diminué ou absent\"}}, \"13\": {\"examen\": \"Autre - Réflexe patellaire\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"14\": {\"examen\": \"Autre - Réflexe sciatique\", \"symptom\": {\"id\": 16, \"name\": \"Normal ou augmenté\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"22\": {\"examen\": \"Vision - Nystagmus\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"23\": {\"examen\": \"Vision - Strabisme positionnel ventral\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"24\": {\"examen\": \"Démarche - Parésie\", \"symptom\": {\"id\": 20, \"name\": \"Absente\"}}, \"25\": {\"examen\": \"Posture - Déficit proprioceptif ipsilatéral\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"31\": {\"examen\": \"Démarche - Marche sur le cercle\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"32\": {\"examen\": \"Démarche - Ataxie\", \"symptom\": {\"id\": 3, \"name\": \"NSP\"}}}',1,7,'2023-06-07 09:42:05'),(33,1,NULL,1,'{\"1\": {\"examen\": \"Etat de conscience\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"3\": {\"examen\": \"Comportement\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"6\": {\"examen\": \"Démarche - Ataxie symétrique des 4 membres\", \"symptom\": {\"id\": 1, \"name\": \"Oui\"}}, \"15\": {\"examen\": \"Nerf crâniens - Anomalie à examen des nerfs craniens\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}, \"16\": {\"examen\": \"Autre - Réflexes médullaires\", \"symptom\": {\"id\": 4, \"name\": \"Normal\"}}, \"30\": {\"examen\": \"Comportement - Sauf déficit de réponse à la menace\", \"symptom\": {\"id\": 2, \"name\": \"Non\"}}}',1,3,'2023-06-07 09:45:13');
/*!40000 ALTER TABLE `consultation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_examen_step`
--

DROP TABLE IF EXISTS `consultation_examen_step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultation_examen_step` (
  `consultation_id` int NOT NULL,
  `examen_step_id` int NOT NULL,
  PRIMARY KEY (`consultation_id`,`examen_step_id`),
  KEY `IDX_79496CAD62FF6CDF` (`consultation_id`),
  KEY `IDX_79496CADD03279B8` (`examen_step_id`),
  CONSTRAINT `FK_79496CAD62FF6CDF` FOREIGN KEY (`consultation_id`) REFERENCES `consultation` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_79496CADD03279B8` FOREIGN KEY (`examen_step_id`) REFERENCES `examen_step` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_examen_step`
--

LOCK TABLES `consultation_examen_step` WRITE;
/*!40000 ALTER TABLE `consultation_examen_step` DISABLE KEYS */;
INSERT INTO `consultation_examen_step` VALUES (6,1),(7,4),(7,6),(7,8),(7,11),(8,4),(8,6),(8,8),(8,11),(14,29),(14,31),(15,4),(16,4),(16,37),(16,38),(16,39),(16,41),(16,42),(17,4),(17,6),(17,8),(17,11),(20,4),(20,6),(20,9),(22,4),(22,6),(22,8),(22,11),(22,46),(23,4),(23,6),(23,9),(23,46),(24,4),(24,6),(24,8),(24,12),(24,46),(25,35),(26,4),(26,37),(26,38),(26,39),(26,41),(26,42),(26,43),(27,4),(27,37),(27,38),(27,39),(27,41),(27,42),(27,43),(29,1),(29,47),(29,48),(29,49),(30,35),(30,50),(30,52),(30,53),(31,35),(31,50),(31,52),(31,53),(32,35),(32,50),(32,52),(32,53),(32,54),(33,1),(33,47),(33,48),(33,49);
/*!40000 ALTER TABLE `consultation_examen_step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_flow`
--

DROP TABLE IF EXISTS `consultation_flow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultation_flow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reason_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_790956BA59BB1592` (`reason_id`),
  CONSTRAINT `FK_790956BA59BB1592` FOREIGN KEY (`reason_id`) REFERENCES `consultation_reason` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_flow`
--

LOCK TABLES `consultation_flow` WRITE;
/*!40000 ALTER TABLE `consultation_flow` DISABLE KEYS */;
INSERT INTO `consultation_flow` VALUES (1,1),(3,2),(2,4),(4,6),(5,7),(6,8);
/*!40000 ALTER TABLE `consultation_flow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultation_reason`
--

DROP TABLE IF EXISTS `consultation_reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consultation_reason` (
  `id` int NOT NULL AUTO_INCREMENT,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultation_reason`
--

LOCK TABLES `consultation_reason` WRITE;
/*!40000 ALTER TABLE `consultation_reason` DISABLE KEYS */;
INSERT INTO `consultation_reason` VALUES (1,'Tremblements et/ou incoordination des mouvements'),(2,'Convulsion et/ou comportement compulsif'),(4,'Troubles locomoteurs (trouble de la motricité comme parésie ou paralysie)'),(6,'Trouble de l\'équilibre (ataxie)'),(7,'Atteinte vestibulaire (tête penchée)'),(8,'Déficit des nerfs crâniens, hors atteinte vestibulaire');
/*!40000 ALTER TABLE `consultation_reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20230403081458','2023-04-03 08:15:01',232),('DoctrineMigrations\\Version20230403081840','2023-04-03 08:18:44',37),('DoctrineMigrations\\Version20230403085011','2023-04-03 08:50:13',33),('DoctrineMigrations\\Version20230502085238','2023-05-02 08:52:55',58),('DoctrineMigrations\\Version20230502092047','2023-05-02 09:20:52',165),('DoctrineMigrations\\Version20230517120901','2023-05-17 12:27:05',90),('DoctrineMigrations\\Version20230517122351','2023-05-17 12:27:35',58),('DoctrineMigrations\\Version20230517122554','2023-05-17 12:32:09',39),('DoctrineMigrations\\Version20230529085627','2023-05-29 08:56:31',114),('DoctrineMigrations\\Version20230529090019','2023-05-29 09:00:22',108);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_step`
--

DROP TABLE IF EXISTS `examen_step`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examen_step` (
  `id` int NOT NULL AUTO_INCREMENT,
  `consultation_flow_id` int NOT NULL,
  `trigger_value_id` int DEFAULT NULL,
  `position` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `previous_examen_id` int DEFAULT NULL,
  `trigger_examen_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CA21A253BB5FCF9` (`consultation_flow_id`),
  KEY `IDX_9CA21A25A62173AD` (`trigger_value_id`),
  KEY `IDX_9CA21A252BA4A9B` (`previous_examen_id`),
  KEY `IDX_9CA21A25952879C3` (`trigger_examen_id`),
  CONSTRAINT `FK_9CA21A252BA4A9B` FOREIGN KEY (`previous_examen_id`) REFERENCES `examen_step` (`id`),
  CONSTRAINT `FK_9CA21A253BB5FCF9` FOREIGN KEY (`consultation_flow_id`) REFERENCES `consultation_flow` (`id`),
  CONSTRAINT `FK_9CA21A25952879C3` FOREIGN KEY (`trigger_examen_id`) REFERENCES `clinic_examen` (`id`),
  CONSTRAINT `FK_9CA21A25A62173AD` FOREIGN KEY (`trigger_value_id`) REFERENCES `clinic_sign_value` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_step`
--

LOCK TABLES `examen_step` WRITE;
/*!40000 ALTER TABLE `examen_step` DISABLE KEYS */;
INSERT INTO `examen_step` VALUES (1,1,NULL,1,'Etat de conscience et comportement',NULL,NULL),(4,2,NULL,1,'Etat de conscience et comportement',NULL,NULL),(6,2,2,3,'Posture',46,6),(8,2,1,4,'Tonus et réflexe anterieurs',6,8),(9,2,2,4,'Tonus et réflexe postérieurs',6,8),(11,2,16,5,'Tonus et réflexe postérieurs',8,9),(12,2,15,5,'Tonus et réflexe postérieurs',8,9),(29,3,NULL,1,'Comportement',NULL,NULL),(31,3,4,2,'Conscience',29,NULL),(33,3,NULL,1,'Etat de conscience et comportement',NULL,NULL),(34,4,NULL,1,'Etat de conscience et comportement',NULL,NULL),(35,5,NULL,1,'Etat de conscience et comportement',NULL,NULL),(36,6,NULL,1,'Etat de conscience et comportement',NULL,NULL),(37,2,6,2,'Convulsion',4,1),(38,2,1,3,'Nerfs crâniens',37,2),(39,2,1,4,'Réflexe photomoteurs',38,15),(40,2,2,4,'Autre nerfs crâniens',38,15),(41,2,4,5,'Comportement',39,18),(42,2,18,6,'Autres nerfs crâniens',41,19),(43,2,2,7,'Réflexe médullaires',42,20),(46,2,4,2,'Posture',4,1),(47,1,4,2,'Posture et démarche',1,1),(48,1,1,3,'Nerf crânien',47,6),(49,1,2,4,'Reflexe médulaire',48,15),(50,5,NULL,2,'Inspection des globes occulaires',35,NULL),(52,5,NULL,3,'Posture et démarche',50,NULL),(53,5,NULL,4,'Réaction posturale',52,NULL),(54,5,NULL,5,'Réflexe medullaires',53,NULL);
/*!40000 ALTER TABLE `examen_step` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen_step_clinic_examen`
--

DROP TABLE IF EXISTS `examen_step_clinic_examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `examen_step_clinic_examen` (
  `examen_step_id` int NOT NULL,
  `clinic_examen_id` int NOT NULL,
  PRIMARY KEY (`examen_step_id`,`clinic_examen_id`),
  KEY `IDX_C11AB520D03279B8` (`examen_step_id`),
  KEY `IDX_C11AB520FA7432F1` (`clinic_examen_id`),
  CONSTRAINT `FK_C11AB520D03279B8` FOREIGN KEY (`examen_step_id`) REFERENCES `examen_step` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C11AB520FA7432F1` FOREIGN KEY (`clinic_examen_id`) REFERENCES `clinic_examen` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen_step_clinic_examen`
--

LOCK TABLES `examen_step_clinic_examen` WRITE;
/*!40000 ALTER TABLE `examen_step_clinic_examen` DISABLE KEYS */;
INSERT INTO `examen_step_clinic_examen` VALUES (1,1),(1,3),(4,1),(4,3),(6,8),(8,9),(8,10),(9,11),(9,12),(11,11),(11,12),(12,11),(12,12),(29,3),(31,1),(33,1),(33,2),(34,1),(34,2),(35,1),(35,15),(36,1),(36,2),(37,2),(38,15),(39,18),(40,20),(41,19),(42,20),(43,16),(46,6),(46,7),(46,26),(46,27),(46,28),(47,4),(47,6),(47,7),(47,26),(47,27),(47,28),(48,15),(48,30),(49,16),(50,22),(50,23),(52,24),(52,31),(52,32),(53,25),(54,10),(54,12),(54,13),(54,14),(54,33);
/*!40000 ALTER TABLE `examen_step_clinic_examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `injury`
--

DROP TABLE IF EXISTS `injury`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `injury` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `injury`
--

LOCK TABLES `injury` WRITE;
/*!40000 ALTER TABLE `injury` DISABLE KEYS */;
INSERT INTO `injury` VALUES (2,'C1 - C5'),(3,'Atteinte Cerebelleuse'),(4,'Atteinte Corticale'),(5,'Atteinte tronc cerebral'),(6,'Atteinte Vestibulaire Centrale'),(7,'Atteinte vestibulaire peripherique'),(8,'C6 - T2'),(9,'T3 - L3'),(10,'L4 - S2');
/*!40000 ALTER TABLE `injury` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `major_injury_clinic_sign`
--

DROP TABLE IF EXISTS `major_injury_clinic_sign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `major_injury_clinic_sign` (
  `id` int NOT NULL AUTO_INCREMENT,
  `examen_id` int NOT NULL,
  `expected_value_id` int NOT NULL,
  `injury_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_314A38555C8659A` (`examen_id`),
  KEY `IDX_314A3855B0E02586` (`expected_value_id`),
  KEY `IDX_314A3855ABA45E9A` (`injury_id`),
  CONSTRAINT `FK_314A38555C8659A` FOREIGN KEY (`examen_id`) REFERENCES `clinic_examen` (`id`),
  CONSTRAINT `FK_314A3855ABA45E9A` FOREIGN KEY (`injury_id`) REFERENCES `injury` (`id`),
  CONSTRAINT `FK_314A3855B0E02586` FOREIGN KEY (`expected_value_id`) REFERENCES `clinic_sign_value` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `major_injury_clinic_sign`
--

LOCK TABLES `major_injury_clinic_sign` WRITE;
/*!40000 ALTER TABLE `major_injury_clinic_sign` DISABLE KEYS */;
INSERT INTO `major_injury_clinic_sign` VALUES (4,8,1,2),(5,9,16,2),(6,11,16,2),(7,6,1,3),(9,3,21,4),(10,18,4,4),(11,19,18,4),(12,20,2,4),(13,16,4,4),(14,1,6,5),(15,2,2,5),(16,15,1,5),(17,18,17,5),(18,19,17,5),(19,21,17,5),(26,22,1,6),(27,23,1,6),(28,24,19,6),(29,25,1,6),(30,25,2,7),(31,8,1,8),(32,9,15,8),(33,11,16,8),(34,8,2,9),(35,11,16,9),(36,12,16,9),(37,8,2,10),(38,11,15,10),(39,12,15,10),(49,1,4,3),(50,15,2,3);
/*!40000 ALTER TABLE `major_injury_clinic_sign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_examen_clinic`
--

DROP TABLE IF EXISTS `sub_examen_clinic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_examen_clinic` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_examen_clinic`
--

LOCK TABLES `sub_examen_clinic` WRITE;
/*!40000 ALTER TABLE `sub_examen_clinic` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_examen_clinic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','[\"ROLE_ADMIN\"]','$2y$13$VTda2LU6TARLL25nGSrLN.h0Nc6Hx3J7V4UGg5kqQJBVu1xjxY48W'),(2,'veterinaire','[\"ROLE_USER\"]','$2y$13$QPCMW7gXBpmPXLoURNpjKuzCXIcjlIMt.rvw/pL61LmPwxsflHNK.');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-07 12:26:44
