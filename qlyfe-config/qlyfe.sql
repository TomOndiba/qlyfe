-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: qlyfe
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.3

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
-- Table structure for table `qlyfe_access_collection_membership`
--

DROP TABLE IF EXISTS `qlyfe_access_collection_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_access_collection_membership` (
  `user_guid` int(11) NOT NULL,
  `access_collection_id` int(11) NOT NULL,
  PRIMARY KEY (`user_guid`,`access_collection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_access_collection_membership`
--

LOCK TABLES `qlyfe_access_collection_membership` WRITE;
/*!40000 ALTER TABLE `qlyfe_access_collection_membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_access_collection_membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_access_collections`
--

DROP TABLE IF EXISTS `qlyfe_access_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_access_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_access_collections`
--

LOCK TABLES `qlyfe_access_collections` WRITE;
/*!40000 ALTER TABLE `qlyfe_access_collections` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_access_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_annotations`
--

DROP TABLE IF EXISTS `qlyfe_annotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_annotations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_annotations`
--

LOCK TABLES `qlyfe_annotations` WRITE;
/*!40000 ALTER TABLE `qlyfe_annotations` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_annotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_api_users`
--

DROP TABLE IF EXISTS `qlyfe_api_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_api_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_guid` bigint(20) unsigned DEFAULT NULL,
  `api_key` varchar(40) DEFAULT NULL,
  `secret` varchar(40) NOT NULL,
  `active` int(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `api_key` (`api_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_api_users`
--

LOCK TABLES `qlyfe_api_users` WRITE;
/*!40000 ALTER TABLE `qlyfe_api_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_api_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_config`
--

DROP TABLE IF EXISTS `qlyfe_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_config` (
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL,
  `site_guid` int(11) NOT NULL,
  PRIMARY KEY (`name`,`site_guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_config`
--

LOCK TABLES `qlyfe_config` WRITE;
/*!40000 ALTER TABLE `qlyfe_config` DISABLE KEYS */;
INSERT INTO `qlyfe_config` VALUES ('view','s:7:\"default\";',1),('language','s:2:\"en\";',1),('default_access','s:1:\"1\";',1);
/*!40000 ALTER TABLE `qlyfe_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_datalists`
--

DROP TABLE IF EXISTS `qlyfe_datalists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_datalists` (
  `name` varchar(32) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_datalists`
--

LOCK TABLES `qlyfe_datalists` WRITE;
/*!40000 ALTER TABLE `qlyfe_datalists` DISABLE KEYS */;
INSERT INTO `qlyfe_datalists` VALUES ('__site_secret__','2a9c36ad2ca80207a562dbd81d13b1e4'),('filestore_run_once','1280112101'),('plugin_run_once','1280112101'),('widget_run_once','1280112101'),('installed','1280112101'),('path','/var/www/qlyfe/'),('dataroot','/var/data/'),('default_site','1'),('version','2010040201'),('simplecache_lastupdate','0'),('simplecache_default','1280112101'),('admin_registered','1'),('first_admin_login','1280112182');
/*!40000 ALTER TABLE `qlyfe_datalists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_entities`
--

DROP TABLE IF EXISTS `qlyfe_entities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_entities` (
  `guid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` int(11) DEFAULT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `container_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `time_updated` int(11) NOT NULL,
  `last_action` int(11) NOT NULL DEFAULT '0',
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`guid`),
  KEY `type` (`type`),
  KEY `subtype` (`subtype`),
  KEY `owner_guid` (`owner_guid`),
  KEY `site_guid` (`site_guid`),
  KEY `container_guid` (`container_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `time_updated` (`time_updated`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_entities`
--

LOCK TABLES `qlyfe_entities` WRITE;
/*!40000 ALTER TABLE `qlyfe_entities` DISABLE KEYS */;
INSERT INTO `qlyfe_entities` VALUES (1,'site',0,0,0,0,2,1280112101,1280112101,0,'yes'),(2,'user',0,0,1,0,2,1280112174,1280112182,0,'yes');
/*!40000 ALTER TABLE `qlyfe_entities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_entity_relationships`
--

DROP TABLE IF EXISTS `qlyfe_entity_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_entity_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid_one` bigint(20) unsigned NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `guid_two` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `guid_one` (`guid_one`,`relationship`,`guid_two`),
  KEY `relationship` (`relationship`),
  KEY `guid_two` (`guid_two`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_entity_relationships`
--

LOCK TABLES `qlyfe_entity_relationships` WRITE;
/*!40000 ALTER TABLE `qlyfe_entity_relationships` DISABLE KEYS */;
INSERT INTO `qlyfe_entity_relationships` VALUES (1,2,'member_of_site',1);
/*!40000 ALTER TABLE `qlyfe_entity_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_entity_subtypes`
--

DROP TABLE IF EXISTS `qlyfe_entity_subtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_entity_subtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('object','user','group','site') NOT NULL,
  `subtype` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `type` (`type`,`subtype`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_entity_subtypes`
--

LOCK TABLES `qlyfe_entity_subtypes` WRITE;
/*!40000 ALTER TABLE `qlyfe_entity_subtypes` DISABLE KEYS */;
INSERT INTO `qlyfe_entity_subtypes` VALUES (1,'object','file','ElggFile'),(2,'object','plugin','ElggPlugin'),(3,'object','widget','ElggWidget');
/*!40000 ALTER TABLE `qlyfe_entity_subtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_geocode_cache`
--

DROP TABLE IF EXISTS `qlyfe_geocode_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_geocode_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(128) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `long` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_geocode_cache`
--

LOCK TABLES `qlyfe_geocode_cache` WRITE;
/*!40000 ALTER TABLE `qlyfe_geocode_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_geocode_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_groups_entity`
--

DROP TABLE IF EXISTS `qlyfe_groups_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_groups_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  KEY `name` (`name`(50)),
  KEY `description` (`description`(50)),
  FULLTEXT KEY `name_2` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_groups_entity`
--

LOCK TABLES `qlyfe_groups_entity` WRITE;
/*!40000 ALTER TABLE `qlyfe_groups_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_groups_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_hmac_cache`
--

DROP TABLE IF EXISTS `qlyfe_hmac_cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_hmac_cache` (
  `hmac` varchar(255) NOT NULL,
  `ts` int(11) NOT NULL,
  PRIMARY KEY (`hmac`),
  KEY `ts` (`ts`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_hmac_cache`
--

LOCK TABLES `qlyfe_hmac_cache` WRITE;
/*!40000 ALTER TABLE `qlyfe_hmac_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_hmac_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_metadata`
--

DROP TABLE IF EXISTS `qlyfe_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_metadata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` bigint(20) unsigned NOT NULL,
  `name_id` int(11) NOT NULL,
  `value_id` int(11) NOT NULL,
  `value_type` enum('integer','text') NOT NULL,
  `owner_guid` bigint(20) unsigned NOT NULL,
  `access_id` int(11) NOT NULL,
  `time_created` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `entity_guid` (`entity_guid`),
  KEY `name_id` (`name_id`),
  KEY `value_id` (`value_id`),
  KEY `owner_guid` (`owner_guid`),
  KEY `access_id` (`access_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_metadata`
--

LOCK TABLES `qlyfe_metadata` WRITE;
/*!40000 ALTER TABLE `qlyfe_metadata` DISABLE KEYS */;
INSERT INTO `qlyfe_metadata` VALUES (1,1,1,2,'text',0,2,1280112101,'yes'),(21,1,3,8,'text',0,2,1280112101,'yes'),(20,1,3,7,'text',0,2,1280112101,'yes'),(19,1,3,6,'text',0,2,1280112101,'yes'),(18,1,3,5,'text',0,2,1280112101,'yes'),(17,1,3,4,'text',0,2,1280112101,'yes'),(22,1,3,9,'text',0,2,1280112101,'yes'),(23,2,10,11,'text',0,2,1280112174,'yes'),(24,2,12,13,'text',0,2,1280112174,'yes'),(25,2,14,11,'text',2,2,1280112174,'yes'),(26,1,15,16,'text',2,2,1280112183,'yes');
/*!40000 ALTER TABLE `qlyfe_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_metastrings`
--

DROP TABLE IF EXISTS `qlyfe_metastrings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_metastrings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `string` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `string` (`string`(50))
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_metastrings`
--

LOCK TABLES `qlyfe_metastrings` WRITE;
/*!40000 ALTER TABLE `qlyfe_metastrings` DISABLE KEYS */;
INSERT INTO `qlyfe_metastrings` VALUES (1,'email'),(2,'no-reply@qlyfe.com'),(3,'enabled_plugins'),(4,'profile'),(5,'logbrowser'),(6,'diagnostics'),(7,'uservalidationbyemail'),(8,'htmlawed'),(9,'search'),(10,'validated'),(11,'1'),(12,'validated_method'),(13,'first_run'),(14,'notification:method:email'),(15,'pluginorder'),(16,'a:33:{i:10;s:8:\"htmlawed\";i:20;s:14:\"defaultwidgets\";i:30;s:4:\"blog\";i:40;s:14:\"twitterservice\";i:50;s:13:\"notifications\";i:60;s:6:\"search\";i:70;s:8:\"messages\";i:80;s:7:\"profile\";i:90;s:9:\"bookmarks\";i:100;s:7:\"members\";i:110;s:5:\"embed\";i:120;s:9:\"logrotate\";i:130;s:5:\"pages\";i:140;s:12:\"messageboard\";i:150;s:4:\"file\";i:160;s:13:\"externalpages\";i:170;s:12:\"custom_index\";i:180;s:7:\"captcha\";i:190;s:7:\"twitter\";i:200;s:7:\"tinymce\";i:210;s:10:\"logbrowser\";i:220;s:14:\"riverdashboard\";i:230;s:11:\"diagnostics\";i:240;s:7:\"friends\";i:250;s:11:\"crontrigger\";i:260;s:21:\"uservalidationbyemail\";i:270;s:10:\"categories\";i:280;s:7:\"thewire\";i:290;s:13:\"invitefriends\";i:300;s:6:\"zaudio\";i:310;s:15:\"reportedcontent\";i:320;s:16:\"garbagecollector\";i:330;s:6:\"groups\";}');
/*!40000 ALTER TABLE `qlyfe_metastrings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_objects_entity`
--

DROP TABLE IF EXISTS `qlyfe_objects_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_objects_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`guid`),
  FULLTEXT KEY `title` (`title`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_objects_entity`
--

LOCK TABLES `qlyfe_objects_entity` WRITE;
/*!40000 ALTER TABLE `qlyfe_objects_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_objects_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_private_settings`
--

DROP TABLE IF EXISTS `qlyfe_private_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_private_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `entity_guid` (`entity_guid`,`name`),
  KEY `name` (`name`),
  KEY `value` (`value`(50))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_private_settings`
--

LOCK TABLES `qlyfe_private_settings` WRITE;
/*!40000 ALTER TABLE `qlyfe_private_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_private_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_river`
--

DROP TABLE IF EXISTS `qlyfe_river`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_river` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(8) NOT NULL,
  `subtype` varchar(32) NOT NULL,
  `action_type` varchar(32) NOT NULL,
  `access_id` int(11) NOT NULL,
  `view` text NOT NULL,
  `subject_guid` int(11) NOT NULL,
  `object_guid` int(11) NOT NULL,
  `annotation_id` int(11) NOT NULL,
  `posted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `action_type` (`action_type`),
  KEY `access_id` (`access_id`),
  KEY `subject_guid` (`subject_guid`),
  KEY `object_guid` (`object_guid`),
  KEY `annotation_id` (`annotation_id`),
  KEY `posted` (`posted`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_river`
--

LOCK TABLES `qlyfe_river` WRITE;
/*!40000 ALTER TABLE `qlyfe_river` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_river` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_sites_entity`
--

DROP TABLE IF EXISTS `qlyfe_sites_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_sites_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`guid`),
  UNIQUE KEY `url` (`url`),
  FULLTEXT KEY `name` (`name`,`description`,`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_sites_entity`
--

LOCK TABLES `qlyfe_sites_entity` WRITE;
/*!40000 ALTER TABLE `qlyfe_sites_entity` DISABLE KEYS */;
INSERT INTO `qlyfe_sites_entity` VALUES (1,'QLyfe','','http://qlyfe/');
/*!40000 ALTER TABLE `qlyfe_sites_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_system_log`
--

DROP TABLE IF EXISTS `qlyfe_system_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `object_class` varchar(50) NOT NULL,
  `object_type` varchar(50) NOT NULL,
  `object_subtype` varchar(50) NOT NULL,
  `event` varchar(50) NOT NULL,
  `performed_by_guid` int(11) NOT NULL,
  `owner_guid` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `time_created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_id` (`object_id`),
  KEY `object_class` (`object_class`),
  KEY `object_type` (`object_type`),
  KEY `object_subtype` (`object_subtype`),
  KEY `event` (`event`),
  KEY `performed_by_guid` (`performed_by_guid`),
  KEY `access_id` (`access_id`),
  KEY `time_created` (`time_created`),
  KEY `river_key` (`object_type`,`object_subtype`,`event`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_system_log`
--

LOCK TABLES `qlyfe_system_log` WRITE;
/*!40000 ALTER TABLE `qlyfe_system_log` DISABLE KEYS */;
INSERT INTO `qlyfe_system_log` VALUES (1,1,'ElggMetadata','metadata','email','create',0,0,2,'yes',1280112101),(2,2,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(3,2,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(4,3,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(5,4,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(6,3,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(7,4,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(8,5,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(9,6,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(10,7,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(11,6,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(12,5,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(13,7,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(14,8,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(15,9,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(16,10,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(17,11,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(18,10,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(19,9,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(20,8,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(21,11,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(22,12,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(23,13,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(24,14,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(25,15,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(26,16,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(27,15,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(28,14,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(29,13,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(30,12,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(31,16,'ElggMetadata','metadata','enabled_plugins','delete',0,0,2,'yes',1280112101),(32,17,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(33,18,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(34,19,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(35,20,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(36,21,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(37,22,'ElggMetadata','metadata','enabled_plugins','create',0,0,2,'yes',1280112101),(38,1,'ElggRelationship','relationship','member_of_site','create',0,0,2,'yes',1280112174),(39,2,'ElggUser','user','','create',0,0,2,'yes',1280112174),(40,2,'ElggUser','user','','make_admin',0,0,2,'yes',1280112174),(41,23,'ElggMetadata','metadata','validated','create',0,0,2,'yes',1280112174),(42,24,'ElggMetadata','metadata','validated_method','create',0,0,2,'yes',1280112174),(43,25,'ElggMetadata','metadata','notification:method:email','create',0,0,2,'yes',1280112174),(44,2,'ElggUser','user','','update',2,0,2,'yes',1280112182),(45,2,'ElggUser','user','','login',2,0,2,'yes',1280112182),(46,26,'ElggMetadata','metadata','pluginorder','create',2,0,2,'yes',1280112183);
/*!40000 ALTER TABLE `qlyfe_system_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_users_apisessions`
--

DROP TABLE IF EXISTS `qlyfe_users_apisessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_users_apisessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_guid` bigint(20) unsigned NOT NULL,
  `site_guid` bigint(20) unsigned NOT NULL,
  `token` varchar(40) DEFAULT NULL,
  `expires` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_guid` (`user_guid`,`site_guid`),
  KEY `token` (`token`)
) ENGINE=MEMORY DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_users_apisessions`
--

LOCK TABLES `qlyfe_users_apisessions` WRITE;
/*!40000 ALTER TABLE `qlyfe_users_apisessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `qlyfe_users_apisessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_users_entity`
--

DROP TABLE IF EXISTS `qlyfe_users_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_users_entity` (
  `guid` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `username` varchar(128) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `salt` varchar(8) NOT NULL DEFAULT '',
  `email` text NOT NULL,
  `language` varchar(6) NOT NULL DEFAULT '',
  `code` varchar(32) NOT NULL DEFAULT '',
  `banned` enum('yes','no') NOT NULL DEFAULT 'no',
  `admin` enum('yes','no') NOT NULL DEFAULT 'no',
  `last_action` int(11) NOT NULL DEFAULT '0',
  `prev_last_action` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `prev_last_login` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `email` (`email`(50)),
  KEY `code` (`code`),
  KEY `last_action` (`last_action`),
  KEY `last_login` (`last_login`),
  KEY `admin` (`admin`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `name_2` (`name`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_users_entity`
--

LOCK TABLES `qlyfe_users_entity` WRITE;
/*!40000 ALTER TABLE `qlyfe_users_entity` DISABLE KEYS */;
INSERT INTO `qlyfe_users_entity` VALUES (2,'qlyfe','qlyfe','f3271fb9b07e877f7f096d29cb8b3daa','afe218a8','dev@qlyfe.com','','','no','yes',1280112183,1280112182,1280112182,0);
/*!40000 ALTER TABLE `qlyfe_users_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qlyfe_users_sessions`
--

DROP TABLE IF EXISTS `qlyfe_users_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qlyfe_users_sessions` (
  `session` varchar(255) NOT NULL,
  `ts` int(11) unsigned NOT NULL DEFAULT '0',
  `data` mediumblob,
  PRIMARY KEY (`session`),
  KEY `ts` (`ts`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qlyfe_users_sessions`
--

LOCK TABLES `qlyfe_users_sessions` WRITE;
/*!40000 ALTER TABLE `qlyfe_users_sessions` DISABLE KEYS */;
INSERT INTO `qlyfe_users_sessions` VALUES ('fqc056ii21ot8m1126714f7q60',1280112174,'__elgg_fingerprint|s:32:\"f66320ae0dc4dd5549c4108fe55d554b\";__elgg_session|s:32:\"06f259f98b6637d00ef474ee99f93651\";msg|a:0:{}view|s:7:\"default\";'),('s89pgklg6nbgvufpajfo1jfm17',1280112183,'__elgg_fingerprint|s:32:\"f66320ae0dc4dd5549c4108fe55d554b\";__elgg_session|s:32:\"06f259f98b6637d00ef474ee99f93651\";msg|a:0:{}view|s:7:\"default\";user|O:8:\"ElggUser\":7:{s:13:\"\0*\0attributes\";a:25:{s:4:\"guid\";s:1:\"2\";s:4:\"type\";s:4:\"user\";s:7:\"subtype\";s:1:\"0\";s:10:\"owner_guid\";s:1:\"0\";s:14:\"container_guid\";s:1:\"0\";s:9:\"site_guid\";s:1:\"1\";s:9:\"access_id\";s:1:\"2\";s:12:\"time_created\";s:10:\"1280112174\";s:12:\"time_updated\";s:10:\"1280112182\";s:7:\"enabled\";s:3:\"yes\";s:12:\"tables_split\";i:2;s:13:\"tables_loaded\";i:2;s:4:\"name\";s:5:\"qlyfe\";s:8:\"username\";s:5:\"qlyfe\";s:8:\"password\";s:32:\"f3271fb9b07e877f7f096d29cb8b3daa\";s:4:\"salt\";s:8:\"afe218a8\";s:5:\"email\";s:13:\"dev@qlyfe.com\";s:8:\"language\";s:0:\"\";s:4:\"code\";s:0:\"\";s:6:\"banned\";s:2:\"no\";s:5:\"admin\";s:3:\"yes\";s:11:\"last_action\";s:10:\"1280112182\";s:16:\"prev_last_action\";s:1:\"0\";s:10:\"last_login\";s:10:\"1280112182\";s:15:\"prev_last_login\";s:1:\"0\";}s:15:\"\0*\0url_override\";N;s:16:\"\0*\0icon_override\";N;s:16:\"\0*\0temp_metadata\";a:0:{}s:19:\"\0*\0temp_annotations\";a:0:{}s:11:\"\0*\0volatile\";a:0:{}s:17:\"\0ElggEntity\0valid\";b:0;}guid|s:1:\"2\";id|s:1:\"2\";username|s:5:\"qlyfe\";name|s:5:\"qlyfe\";');
/*!40000 ALTER TABLE `qlyfe_users_sessions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-07-25 19:48:17


-- ALPHA SQL - ADD CLASSIFIERS - see alpha_sql/add_classifiers
-- add classifiers to qlyfe... later we can remove the access_id from all tables (entities, metadata, annotations)

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
drop table IF EXISTS qlyfe_classifiers;
create table qlyfe_classifiers (
	id bigint(20) unsigned,
	type varchar(20) ,
	network varchar(20) ,
	classifier varchar(30) ,
	key network_classifier (id, type, network, classifier),
	key unique_id (id, type) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


-- entities
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'public' as network from qlyfe_entities e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'friends' as network from qlyfe_entities e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'private' as network from qlyfe_entities e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.guid as id, 'entity' as type, 'friends' as network from qlyfe_entities e where e.access_id = -2;

-- metadata
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'private' as network from qlyfe_metadata e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'metadata' as type, 'public' as network from qlyfe_metadata e where e.access_id = -2;

-- annotations
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'private' as network from qlyfe_annotations e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'annotation' as type, 'public' as network from qlyfe_annotations e where e.access_id = -2;

-- the river
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'private' as network from qlyfe_river e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'river' as type, 'public' as network from qlyfe_river e where e.access_id = -2;

-- system log
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = 2;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = 1;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'private' as network from qlyfe_system_log e where e.access_id = 0;
insert into qlyfe_classifiers (id, type, network) select e.id as id, 'system_log' as type, 'public' as network from qlyfe_system_log e where e.access_id = -2;

update qlyfe_classifiers c, qlyfe_entities e set c.network = 'public' where c.id = e.guid and c.type='entity' and e.type = 'user'; 



alter table qlyfe_entity_relationships add column network varchar(20);
alter table qlyfe_entity_relationships add column classifier varchar(20);
update qlyfe_entity_relationships set network = 'friends', classifier = 'f' where relationship = 'friend';

update qlyfe_entities set owner_guid = guid where type = 'user';

-- END ALPHA SQL - ADD CLASSIFIERS 


-- ALPHA SQL - DEPRECATE ACCESS_ID
ALTER TABLE qlyfe_entities MODIFY column access_id int(11);
ALTER TABLE qlyfe_entities DROP KEY access_id;

ALTER TABLE qlyfe_metadata MODIFY column access_id int(11);
ALTER TABLE qlyfe_metadata DROP KEY access_id;

ALTER TABLE qlyfe_annotations MODIFY column access_id int(11);
ALTER TABLE qlyfe_annotations DROP KEY access_id;

ALTER TABLE qlyfe_river MODIFY column access_id int(11);
ALTER TABLE qlyfe_river DROP KEY access_id;

ALTER TABLE qlyfe_system_log MODIFY column access_id int(11);
ALTER TABLE qlyfe_system_log DROP KEY access_id;
-- END ALPHA SQL - DEPRECATE ACCESS_ID

-- ALPHA SQL - MODIFY RELATIONSHIP KEYS
ALTER TABLE qlyfe_entity_relationships DROP KEY guid_one;
ALTER TABLE qlyfe_entity_relationships ADD KEY guid_one (guid_one,relationship,guid_two);
ALTER TABLE qlyfe_entity_relationships ADD KEY classified (guid_one, guid_two, network, classifier);
-- END ALPHA SQL - MODIFY RELATIONSHIP KEYS



