-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: exam
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of classes table',
  `class_name` varchar(255) NOT NULL COMMENT 'Name of a class',
  `created_time` datetime DEFAULT NULL COMMENT 'Migration created date and time',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Row status 1- Active, 0 - In Active',
  `client_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,'1st Class','2018-02-17 01:41:09','2018-02-16 20:53:45',0,1),(2,'Class - II','2018-02-17 01:43:07','2018-02-16 20:13:16',0,1),(3,'Class - II','2018-02-17 02:20:55','2018-02-16 20:50:55',1,1),(4,'Class - I','2018-02-17 12:28:31','2018-02-17 06:58:31',1,1);
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exams`
--

DROP TABLE IF EXISTS `exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of exams table',
  `class_id` int(11) NOT NULL COMMENT 'Primary key of classes table',
  `exam_name` varchar(255) NOT NULL COMMENT 'Name of an exam',
  `exam_time_limit` int(11) NOT NULL COMMENT 'Time limit of an exam',
  `no_of_questions` int(11) NOT NULL COMMENT 'No of questions for the exam',
  `schduled_date` datetime DEFAULT NULL COMMENT 'When you want to start the exam',
  `results_status` tinyint(1) DEFAULT '0',
  `created_time` datetime DEFAULT NULL COMMENT 'Migration created date and time',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Row status 1- Active, 0 - In Active',
  `client_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exams`
--

LOCK TABLES `exams` WRITE;
/*!40000 ALTER TABLE `exams` DISABLE KEYS */;
INSERT INTO `exams` VALUES (1,1,'Exam - I',20,0,NULL,0,'2018-02-17 02:16:48','2018-02-20 20:11:26',0,1),(2,3,'Test Exam - IV',60,30,NULL,0,'2018-02-17 02:19:39','2018-02-20 20:11:26',1,1),(3,4,'Test Exam - III',30,30,NULL,0,'2018-02-17 11:20:52','2018-02-20 20:46:30',1,1),(4,3,'Test Exam - I',30,30,NULL,0,'2018-02-17 12:28:44','2018-02-20 20:11:26',1,1),(5,4,'Test Exam - II',60,60,NULL,0,'2018-02-17 12:28:55','2018-02-20 20:11:26',1,1);
/*!40000 ALTER TABLE `exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of classes table',
  `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
  `title` varchar(255) NOT NULL COMMENT 'Title of a question',
  `options` text NOT NULL COMMENT 'Answers of a question',
  `answer` int(11) NOT NULL COMMENT 'Correct answer of a question',
  `marks` int(11) NOT NULL COMMENT 'Marks for a question',
  `created_time` datetime DEFAULT NULL COMMENT 'Migration created date and time',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Row status 1- Active, 0 - In Active',
  `client_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,2,'What is the capital of India ?','[\"Hyderabad\",\"Telangana\",\"Chirala\",\"Delhi\"]',4,2,'2018-02-17 03:05:05','2018-02-17 07:14:33',1,1),(2,2,'The everyday tasks of management include: ','[\"planning and creativit\",\"planning and leading\",\"publicity and loss adjustment\",\"plotting and leading\"]',2,1,'2018-02-18 12:10:19','2018-02-18 06:40:19',1,1),(3,2,'The main schools of management thought are:','[\"classical, human resources, systems, contingency\",\"classical, human resources, systems, contextual\",\" classical, human relations, systems, contingency\",\"creative, human relations, systems, contingency\"]',3,1,'2018-02-18 12:11:30','2018-02-18 06:41:30',1,1),(4,2,'\"It all depends on the variables of a situation\" best describes the','[\"classical approach\",\"human relations approach\",\"systems approach\",\"contingency approach\"]',4,1,'2018-02-18 12:13:40','2018-02-18 06:43:40',1,1),(5,2,'The observation of people at work that would reveal the one best way to do a task is known as','[\"scientific management\",\"classical management\",\"human relations management\",\"creative management\"]',1,1,'2018-02-18 12:14:28','2018-02-18 06:44:28',1,1),(6,2,'The founder of scientific management was','[\"Frederick Taylor\",\"Henri Fayol\",\"Elton Mayo\",\"Chester Barnard\"]',1,1,'2018-02-18 12:15:10','2018-02-18 06:45:10',1,1),(7,2,'The first management principles were developed by ','[\"Frederick Taylor\",\"Charles Handy\",\"Henri Fayol\",\"Victor Meldrew\"]',3,5,'2018-02-18 12:15:46','2018-02-19 20:43:47',0,1),(8,2,'Studying the future and arranging the means for dealing with it is part of the process of','[\"organising\",\"commanding\",\"controlling\",\"planning\"]',4,2,'2018-02-18 12:16:29','2018-02-18 06:46:29',1,1),(9,2,'Ensuring that everything is carried out according to plan is part of the process of ','[\"planning\",\"controlling\",\"organising\",\"co-ordinating\"]',2,1,'2018-02-18 12:17:08','2018-02-18 06:47:08',1,1),(10,2,'\"Division of work, authority and responsibility, unity of command\" were proposed as part of the fourteen principles of management by ','[\"Weber\",\"Fayol\",\"Taylor\",\"Woodward\"]',2,1,'2018-02-18 12:17:43','2018-02-18 06:47:43',1,1),(11,2,'Bureaucracy theory was proposed by ','[\"Weber\",\"Fayol\",\"Taylor\",\"Handy\"]',1,1,'2018-02-18 12:18:24','2018-02-18 06:48:24',1,1),(12,2,'Bureaucracy theory means ','[\"the development of management functions and administrative principles\",\" a scientific study of work\",\"a shared responsibility of authority and delegation\",\"a hierarchy of command based on a rational-legal authority structure\"]',4,2,'2018-02-18 12:19:00','2018-02-18 06:49:00',1,1),(13,2,'The Hawthorne experiments were conducted by','[\"Elton Mayo\",\"Max Weber \",\"Charles Handy\",\"Henri Fayol\"]',1,5,'2018-02-18 12:19:58','2018-02-18 06:49:58',1,1),(14,2,'The unintentional biasing of research outcomes due to the possibility that simply paying attention to the experimental subjects causes their behaviour to change is known as the','[\"Mayo effect\",\"Cause and effect\",\"Hawthorne effect\",\"Law and effect \"]',3,1,'2018-02-18 12:41:08','2018-02-18 07:11:08',1,1),(15,2,'Who defined human motivation as \"the study of ultimate human goals ','[\"Weber\",\"Maslow\",\"Taylor\",\"Fayol\"]',2,1,'2018-02-18 12:48:26','2018-02-18 07:18:26',1,1),(16,2,'The analysis of a manager as a social systems approach was proposed by ','[\"Chester Barnard\",\"Elton Mayo\",\"Henri Fayol\",\" Max Weber\"]',1,1,'2018-02-18 12:49:21','2018-02-18 07:19:21',1,1),(17,2,'\"The whole is greater than the sum of the parts and that the parts or subsystems are related to each other and to the whole\" are emphasised in','[\"Motivation theory\",\"Contingency theory\",\"Systems theory\",\" Administrative theory\"]',3,1,'2018-02-18 12:50:01','2018-02-18 07:20:01',1,1),(18,2,'The study of organisational behaviour includes','[\"diplomacy, scientology, psychology\",\"sociology, psychology, anthropology\",\"socioeconomics, philosophy, anthropology\",\"physiology, society, anthropology\"]',2,1,'2018-02-18 12:50:43','2018-02-18 07:20:43',1,1),(19,2,'The use of theory to guide systematic, empirical research from which generalisations can be made to influence applications is known as','[\"social science approach\",\"scientific management approach\",\" open systems approach\",\"scientific method\"]',4,1,'2018-02-18 12:51:19','2018-02-18 07:21:19',1,1),(20,2,'An in depth study on a single organisation using a variety of data collection methods is known as  ','[\"case study\",\"field survey\",\"field experiment\",\"laboratory experiment\"]',1,1,'2018-02-18 12:51:54','2018-02-18 07:21:54',1,1),(21,2,'The method of research that gathers data about perceptions, feelings, opinions through interviews and questionnaires in their actual work setting is known as','[\"case study \",\"field survey\",\"field experiment\",\"laboratory experiment\"]',2,1,'2018-02-18 12:52:49','2018-02-18 07:22:49',1,1),(22,2,'Control of independent variable manipulation without intervening environmental effects is at its maximum in ','[\"case studies\",\"field surveys\",\"field experiments\",\" laboratory experiments\"]',4,1,'2018-02-18 12:53:26','2018-02-18 07:23:26',1,1),(23,2,'Experiments that allow the researcher to manipulate independent variables in actual organisations in an attempt to control variables and explain causality are known as','[\"case studies\",\"field surveys\",\"field experiments\",\"laboratory experiments\"]',3,1,'2018-02-18 12:54:00','2018-02-18 07:24:00',1,1),(24,2,'A statement about the proposed relationship between independent and dependent variables is known as a ','[\"hypothesis\",\"relationship\",\"variable\",\"hypotenuse\"]',1,1,'2018-02-18 12:54:33','2018-02-18 07:24:33',1,1),(25,2,'The variable thought to affect one or more dependent variables is known as ','[\"transient variable\",\"independent variable\",\"dependent variable\",\"intransient variable\"]',2,1,'2018-02-18 12:55:12','2018-02-18 07:25:12',1,1),(26,2,'The outcome studied through research and believed to be caused or influenced by an independent variable is known as','[\"transient variable\",\"independent variable\",\"dependent variable\",\"intransient variable\"]',3,1,'2018-02-18 12:56:04','2018-02-18 07:26:04',1,1),(27,2,'A variable believed to influence the effects of the independent variable on the dependent variable is known as','[\"independent variable\",\"dependent variable\",\"moderating variable\",\"reliable variable\"]',3,1,'2018-02-18 12:57:01','2018-02-18 07:27:01',1,1),(28,2,'The consistency of data obtained from a particular research method is known as ','[\"reliability\",\"validity\",\"credibility\",\"causality\"]',1,2,'2018-02-18 12:57:36','2018-02-18 07:27:36',1,1),(29,2,'The degree to which a research method actually measures what it is supposed to measure is known as','[\"reliability\",\"validity\",\"credibility\",\"causality\"]',2,2,'2018-02-18 12:58:17','2018-02-18 07:28:17',1,1),(30,2,'The acceleration of technology that affects work processes is influenced by','[\"internal forces\",\"social forces \",\"national forces\",\"external forces\"]',4,1,'2018-02-18 12:59:07','2018-02-18 07:29:07',1,1),(31,2,'The transforming effect on how we work, live, communicate and travel is influenced by ','[\"technology\",\"diversity\",\"ethics\",\"globalisation\"]',1,1,'2018-02-18 12:59:41','2018-02-18 07:29:41',1,1),(32,3,'TQM refers to','[\"total quarterly management\",\"total qualifying management\",\"total quality measurement\",\"total quality management\"]',4,1,'2018-02-18 13:06:56','2018-02-18 07:36:56',1,1),(33,3,'JIT refers to','[\"jump in too\",\"jumps in technology\",\"just in time\",\"justify in technology\"]',3,1,'2018-02-18 13:07:49','2018-02-18 07:37:49',1,1),(34,3,'The process of continuous quality improvement in management refers to','[\"JIT\",\"TQM\",\"IBM\",\"ERM\"]',2,1,'2018-02-18 13:08:32','2018-02-18 07:38:32',1,1),(35,4,'The positive action to ensure that people are given fair opportunities to be hired in organisations regardless of ethnicity, gender or age is known as','[\"affirmative action\",\"discrimination\",\"race relations\",\"progressive practices\"]',1,1,'2018-02-18 13:10:02','2018-02-18 07:40:02',1,1),(36,3,'Acting ethically in business','[\"is immoral \",\"reduces profits\",\"leads to bad decisions\",\"promotes long term benefits\"]',4,1,'2018-02-18 13:11:51','2018-02-18 07:41:51',1,1),(37,3,'The study of organisational behaviour mainly involves the study of ','[\"individuals and groups\",\"buildings\",\"structures\",\"departments\"]',1,1,'2018-02-18 13:12:27','2018-02-18 07:42:27',1,1),(38,3,'Managing the human resource is','[\"the smallest department in an organisation\",\"better managed outside the organisation\",\"vital for the success of an organisation\",\"an unnecessary expense\"]',3,1,'2018-02-18 13:13:09','2018-02-18 07:43:09',1,1),(39,3,'The social and technical integration of the Human Relations and classical school is known as the ____________ approach.  ','[\"classical\",\"human relations\",\"systems\",\"contingency\"]',3,1,'2018-02-18 13:13:55','2018-02-18 07:43:55',1,1),(40,3,'A method of helping is to understand management and organisational behaviour is to look at _________ that has been done before','[\"experiments\",\"research\",\"management\",\"behaviour\"]',2,1,'2018-02-18 13:14:45','2018-02-18 07:44:45',1,1),(41,3,'Fayol elevated the study of management from the shop floor to the ','[\"people\",\"managers\",\"customers\",\"organisation\"]',4,1,'2018-02-18 13:15:21','2018-02-18 07:45:21',1,1),(42,3,'Designing a structure to assist in goal accomplishment is known as','[\"planning\",\"organising\",\"co-ordinating\",\"commanding\"]',2,1,'2018-02-18 13:16:02','2018-02-18 07:46:02',1,1),(43,3,'The principle of management that proposes that \"there should be a line of authority from highest to lowest is known as','[\"order\",\"unity of direction\",\"scaler chain\",\"unity of command\"]',3,1,'2018-02-18 13:16:37','2018-02-18 07:46:37',1,1),(44,3,'Impersonal treatment of people through consistent application of rules and decisions to prevent favouritism is part of','[\"equity theory\",\"motivation theory\",\"leadership theory\",\"bureaucracy theory\"]',4,1,'2018-02-18 13:17:17','2018-02-18 07:47:17',1,1),(45,3,'The act of co-operation lease to the establishment of co-operative systems was proposed by','[\"Barnard\",\"Fayol\",\"Maslow\",\"Taylor\"]',1,1,'2018-02-18 13:18:30','2018-02-18 07:48:30',1,1),(46,3,'The reciprocal nature of power was articulated by','[\"Barnard\",\"Follett\",\"Fayol\",\"Taylor\"]',2,1,'2018-02-18 13:19:29','2018-02-18 07:49:29',1,1),(47,3,'he social science discipline that focuses directly on understanding and predicting individual behaviour is known as','[\"psychology\",\"sociology\",\"anthropology\",\"political science\"]',1,1,'2018-02-18 13:20:57','2018-02-18 07:50:57',1,1),(48,3,'The social science that studies how individuals interact with one another in social systems is know as ','[\"psychology\",\"sociology\",\"anthropology\",\"political science\"]',2,1,'2018-02-18 13:21:32','2018-02-18 07:51:32',1,1),(49,3,'The behavioural science hybrid that integrates psychology and sociology is known as','[\"psysology\",\"psycho sociology\",\"social psychology\",\"socpsycology\"]',3,1,'2018-02-18 13:22:06','2018-02-18 07:52:06',1,1),(50,3,'One type of organisation especially buffeted by technological change is','[\"the medium tech firm\",\"the no tech firm\",\"the low tech firm\",\"the high tech firm\"]',4,1,'2018-02-18 13:22:45','2018-02-18 07:52:45',1,1),(51,3,'People who work in the Human resource department should have a knowledge of','[\"organisational behaviour\",\"IT\",\"Finance\",\"marketing \"]',1,1,'2018-02-18 13:23:29','2018-02-18 07:53:29',1,1),(52,3,'What must entrepreneurs and leaders learn in order to have a successful organisation?','[\"How to control people and manipulate organisational systems.\",\"How to think strategically, influence people, develop organisational systems.\",\"How to manage technical details and use current business jargon.\",\"How to read balance sheets and income statements.\"]',2,1,'2018-02-18 13:25:19','2018-02-18 07:55:19',1,1),(53,3,'Organisational success in providing a service or a product depends on','[\"doing product development faster than anyone else.\",\"being the cheapest in the market. \",\" having the first product or service in the market place.\",\" the product or service being valued by a segment of society.\"]',4,1,'2018-02-18 13:27:19','2018-02-18 07:57:19',1,1),(54,4,'The McDonalds restaurant chain was created to provide fast access to prepared food of consistent quality, at reasonable prices, in a clean and cheerful eating environment. This exemplifies: ','[\"An organisation being created to serve the needs of a particular customer segment or group of people. \",\"How an organisation can influence customers to buy its products.\",\"The principle that demand can be created if an organisation is just persistent enough.\",\"The fact that service organisations need not concern themselves with customer needs to the extent that product manufacturers must. \"]',1,1,'2018-02-18 13:28:00','2018-02-18 07:58:00',1,1),(55,3,'Which of the following typifies an organisation? ','[\"The First National Bank.\",\" The United Methodist Church.\",\"The Local Primary School\",\"All of the above.\"]',4,1,'2018-02-18 13:28:35','2018-02-18 07:58:35',1,1),(56,3,'According to Peter Drucker, where does the purpose of a business organisation find its meaning?','[\"With top management.\",\"In each and every employee.\",\"Within the organisational culture.\",\"Outside the organisation.\"]',4,1,'2018-02-18 13:29:48','2018-02-18 07:59:48',1,1),(57,3,'Which must be accomplished first by the entrepreneur or leader? ','[\"The design of a rational organisation structure.\",\"Generating profits. \",\" Making viable the concept for which the organisation was founded\",\"Establishing policies that assure consistency of activities.\"]',3,1,'2018-02-18 13:30:24','2018-02-18 08:00:24',1,1),(58,3,'An organisation\'s mission is ','[\"the fundamental purpose of an organisation.\",\"articulated in such a way that it defines the business of the enterprise.\",\"a concept for unifying the efforts of organisational members.\",\"all of the above.\"]',4,1,'2018-02-18 13:31:02','2018-02-18 08:01:02',1,1),(59,3,'A well-framed mission statement ','[\"defines specific performance objectives for the organisation.\",\"delineates which managers are responsible for what activities. \",\"gives direction to a sense of purpose\",\"defines the core technology on which the organisation is dependent.\"]',3,1,'2018-02-18 13:31:39','2018-02-18 08:01:39',1,1),(60,3,'The highest level of striving for the organisation is articulated by __________. ','[\"superordinate goals\",\"operational strategies\",\"functional policies\",\" standard operating procedures\"]',1,1,'2018-02-18 13:32:20','2018-02-18 08:02:20',1,1),(61,3,'When the chief executive officer of Hewlett-Packard explains to employees that the viability of the company depends on their continuing to improve and develop new products, she is articulating a: ','[\"Superordinate goal.\",\"Behavioural threat.\",\"Mission statement.\",\" Functional strategy.\"]',1,1,'2018-02-18 13:33:07','2018-02-18 08:03:07',1,1),(62,3,'Definable groups of people who have an economic and/or social interest in the organisation are called','[\"employees.\",\"managers.\",\"stakeholders.\",\"linking pins.\"]',3,1,'2018-02-18 13:35:46','2018-02-18 08:05:46',1,1),(63,3,'To business firms, the Environmental Protection Agency is an example of what type of organisation?','[\"A vendor.\",\"A regulator.\",\"A controller.\",\"A shareholder.\"]',2,1,'2018-02-18 13:37:03','2018-02-18 08:07:03',1,1),(64,3,'Which of the following is a system? ','[\"An organisation.\",\"An automobile. \",\"A toilet.\",\"A community.\"]',4,1,'2018-02-18 13:37:52','2018-02-18 08:07:52',1,1);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_exam_results`
--

DROP TABLE IF EXISTS `user_exam_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_exam_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of user taken exams table',
  `user_id` int(11) NOT NULL COMMENT 'Primary key of users table',
  `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
  `marks` int(11) NOT NULL COMMENT 'Marks gained by user',
  `total_marks` int(11) NOT NULL COMMENT 'Total marks of an exam',
  `row_status` int(11) DEFAULT '1' COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
  `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
  `client_id` int(11) DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_exam_results`
--

LOCK TABLES `user_exam_results` WRITE;
/*!40000 ALTER TABLE `user_exam_results` DISABLE KEYS */;
INSERT INTO `user_exam_results` VALUES (1,2,2,12,39,1,'2018-02-21 02:42:42','2018-02-20 21:12:42',1);
/*!40000 ALTER TABLE `user_exam_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_exams`
--

DROP TABLE IF EXISTS `user_exams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_exams` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of classes table',
  `user_id` int(11) NOT NULL COMMENT 'Primary key og f uses table',
  `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
  `exam_started_time` datetime DEFAULT NULL COMMENT 'Starting time of an exam',
  `exam_ended_time` datetime DEFAULT NULL COMMENT 'Ending time of an exam',
  `created_time` datetime DEFAULT NULL COMMENT 'Migration created date and time',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
  `row_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Row status 1- Active, 0 - In Active',
  `client_id` int(11) NOT NULL DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_exams`
--

LOCK TABLES `user_exams` WRITE;
/*!40000 ALTER TABLE `user_exams` DISABLE KEYS */;
INSERT INTO `user_exams` VALUES (1,2,2,'2018-02-20 22:57:08','2018-02-20 23:01:22','2018-02-20 22:57:08','2018-02-20 17:31:22',1,1),(2,3,3,'2018-02-21 00:39:45','2018-02-21 00:40:44','2018-02-21 00:39:45','2018-02-20 19:10:44',1,1),(3,6,3,'2018-02-21 00:42:18','2018-02-21 00:43:11','2018-02-21 00:42:18','2018-02-20 19:13:11',1,1);
/*!40000 ALTER TABLE `user_exams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_questions`
--

DROP TABLE IF EXISTS `user_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of user taken exams table',
  `user_id` int(11) NOT NULL COMMENT 'Primary key of users table',
  `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
  `question_id` int(11) NOT NULL COMMENT 'Primary key of questions table',
  `question_no` int(11) DEFAULT NULL,
  `user_answer` int(11) DEFAULT NULL,
  `row_status` int(11) DEFAULT '1' COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
  `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
  `client_id` int(11) DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_questions`
--

LOCK TABLES `user_questions` WRITE;
/*!40000 ALTER TABLE `user_questions` DISABLE KEYS */;
INSERT INTO `user_questions` VALUES (1,2,2,8,1,2,1,'2018-02-20 22:58:00','2018-02-20 17:28:00',1),(2,2,2,13,2,4,1,'2018-02-20 22:58:04','2018-02-20 17:28:04',1),(3,2,2,31,3,2,1,'2018-02-20 22:58:05','2018-02-20 17:28:05',1),(4,2,2,9,4,2,1,'2018-02-20 22:58:15','2018-02-20 17:28:15',1),(5,2,2,2,5,2,1,'2018-02-20 22:58:18','2018-02-20 17:28:18',1),(6,2,2,18,6,2,1,'2018-02-20 22:58:26','2018-02-20 17:28:26',1),(7,2,2,24,7,4,1,'2018-02-20 22:58:28','2018-02-20 17:28:28',1),(8,2,2,23,8,2,1,'2018-02-20 22:58:32','2018-02-20 17:28:32',1),(9,2,2,28,9,1,1,'2018-02-20 22:58:35','2018-02-20 17:28:35',1),(10,2,2,25,10,3,1,'2018-02-20 22:58:57','2018-02-20 17:28:57',1),(11,2,2,16,11,1,1,'2018-02-20 22:58:59','2018-02-20 17:28:59',1),(12,2,2,14,12,1,1,'2018-02-20 22:59:03','2018-02-20 17:29:03',1),(13,2,2,29,13,2,1,'2018-02-20 22:59:05','2018-02-20 17:29:05',1),(14,2,2,21,14,1,1,'2018-02-20 22:59:08','2018-02-20 17:29:08',1),(15,2,2,4,15,4,1,'2018-02-20 22:59:10','2018-02-20 17:29:10',1),(16,2,2,20,16,2,1,'2018-02-20 23:00:07','2018-02-20 17:30:07',1),(17,2,2,30,17,3,1,'2018-02-20 23:00:09','2018-02-20 17:30:09',1),(18,2,2,22,18,4,1,'2018-02-20 23:00:11','2018-02-20 17:30:11',1),(19,2,2,15,19,4,1,'2018-02-20 23:00:13','2018-02-20 17:30:13',1),(20,2,2,27,20,2,1,'2018-02-20 23:00:14','2018-02-20 17:30:14',1),(21,2,2,11,21,2,1,'2018-02-20 23:00:41','2018-02-20 17:30:41',1),(22,2,2,26,22,2,1,'2018-02-20 23:00:43','2018-02-20 17:30:43',1),(23,2,2,12,23,1,1,'2018-02-20 23:00:46','2018-02-20 17:30:46',1),(24,2,2,5,24,2,1,'2018-02-20 23:00:47','2018-02-20 17:30:47',1),(25,2,2,3,25,3,1,'2018-02-20 23:00:49','2018-02-20 17:30:49',1),(26,2,2,17,26,2,1,'2018-02-20 23:00:53','2018-02-20 17:30:53',1),(27,2,2,1,27,1,1,'2018-02-20 23:00:55','2018-02-20 17:30:55',1),(28,2,2,19,28,2,1,'2018-02-20 23:00:57','2018-02-20 17:30:57',1),(29,2,2,10,29,2,1,'2018-02-20 23:00:58','2018-02-20 17:30:58',1),(30,2,2,6,30,4,1,'2018-02-20 23:01:22','2018-02-20 17:31:22',1),(31,3,3,34,1,2,1,'2018-02-21 00:39:47','2018-02-20 19:09:47',1),(32,3,3,43,2,2,1,'2018-02-21 00:39:50','2018-02-20 19:09:50',1),(33,3,3,56,3,4,1,'2018-02-21 00:39:51','2018-02-20 19:09:51',1),(34,3,3,44,4,1,1,'2018-02-21 00:39:54','2018-02-20 19:09:54',1),(35,3,3,38,5,2,1,'2018-02-21 00:39:56','2018-02-20 19:09:56',1),(36,3,3,33,6,2,1,'2018-02-21 00:39:57','2018-02-20 19:09:57',1),(37,3,3,59,7,1,1,'2018-02-21 00:39:59','2018-02-20 19:09:59',1),(38,3,3,32,8,2,1,'2018-02-21 00:40:01','2018-02-20 19:10:01',1),(39,3,3,63,9,2,1,'2018-02-21 00:40:03','2018-02-20 19:10:03',1),(40,3,3,42,10,1,1,'2018-02-21 00:40:04','2018-02-20 19:10:04',1),(41,3,3,61,11,2,1,'2018-02-21 00:40:06','2018-02-20 19:10:06',1),(42,3,3,62,12,1,1,'2018-02-21 00:40:08','2018-02-20 19:10:08',1),(43,3,3,46,13,2,1,'2018-02-21 00:40:11','2018-02-20 19:10:11',1),(44,3,3,52,14,1,1,'2018-02-21 00:40:13','2018-02-20 19:10:13',1),(45,3,3,50,15,4,1,'2018-02-21 00:40:15','2018-02-20 19:10:15',1),(46,3,3,49,16,1,1,'2018-02-21 00:40:17','2018-02-20 19:10:17',1),(47,3,3,47,17,NULL,1,'2018-02-21 00:40:17','2018-02-20 19:10:17',1),(48,3,3,45,18,2,1,'2018-02-21 00:40:19','2018-02-20 19:10:19',1),(49,3,3,51,19,NULL,1,'2018-02-21 00:40:20','2018-02-20 19:10:20',1),(50,3,3,40,20,4,1,'2018-02-21 00:40:22','2018-02-20 19:10:22',1),(51,3,3,48,21,1,1,'2018-02-21 00:40:25','2018-02-20 19:10:25',1),(52,3,3,55,22,2,1,'2018-02-21 00:40:26','2018-02-20 19:10:26',1),(53,3,3,57,23,NULL,1,'2018-02-21 00:40:27','2018-02-20 19:10:27',1),(54,3,3,64,24,1,1,'2018-02-21 00:40:30','2018-02-20 19:10:30',1),(55,3,3,53,25,4,1,'2018-02-21 00:40:31','2018-02-20 19:10:31',1),(56,3,3,60,26,2,1,'2018-02-21 00:40:33','2018-02-20 19:10:33',1),(57,3,3,58,27,4,1,'2018-02-21 00:40:35','2018-02-20 19:10:35',1),(58,3,3,39,28,1,1,'2018-02-21 00:40:37','2018-02-20 19:10:37',1),(59,3,3,37,29,2,1,'2018-02-21 00:40:39','2018-02-20 19:10:39',1),(60,3,3,41,30,3,1,'2018-02-21 00:40:43','2018-02-20 19:10:43',1),(61,6,3,59,1,3,1,'2018-02-21 00:42:20','2018-02-20 19:12:20',1),(62,6,3,57,2,2,1,'2018-02-21 00:42:21','2018-02-20 19:12:21',1),(63,6,3,58,3,3,1,'2018-02-21 00:42:23','2018-02-20 19:12:23',1),(64,6,3,42,4,2,1,'2018-02-21 00:42:25','2018-02-20 19:12:25',1),(65,6,3,34,5,1,1,'2018-02-21 00:42:27','2018-02-20 19:12:27',1),(66,6,3,46,6,2,1,'2018-02-21 00:42:28','2018-02-20 19:12:28',1),(67,6,3,38,7,3,1,'2018-02-21 00:42:30','2018-02-20 19:12:30',1),(68,6,3,52,8,2,1,'2018-02-21 00:42:32','2018-02-20 19:12:32',1),(69,6,3,63,9,1,1,'2018-02-21 00:42:34','2018-02-20 19:12:34',1),(70,6,3,48,10,4,1,'2018-02-21 00:42:35','2018-02-20 19:12:35',1),(71,6,3,62,11,1,1,'2018-02-21 00:42:37','2018-02-20 19:12:37',1),(72,6,3,43,12,2,1,'2018-02-21 00:42:39','2018-02-20 19:12:39',1),(73,6,3,36,13,3,1,'2018-02-21 00:42:40','2018-02-20 19:12:40',1),(74,6,3,44,14,2,1,'2018-02-21 00:42:42','2018-02-20 19:12:42',1),(75,6,3,64,15,3,1,'2018-02-21 00:42:44','2018-02-20 19:12:44',1),(76,6,3,51,16,2,1,'2018-02-21 00:42:45','2018-02-20 19:12:45',1),(77,6,3,47,17,1,1,'2018-02-21 00:42:47','2018-02-20 19:12:47',1),(78,6,3,55,18,4,1,'2018-02-21 00:42:48','2018-02-20 19:12:48',1),(79,6,3,49,19,1,1,'2018-02-21 00:42:50','2018-02-20 19:12:50',1),(80,6,3,50,20,2,1,'2018-02-21 00:42:51','2018-02-20 19:12:51',1),(81,6,3,32,21,1,1,'2018-02-21 00:42:53','2018-02-20 19:12:53',1),(82,6,3,61,22,4,1,'2018-02-21 00:42:55','2018-02-20 19:12:55',1),(83,6,3,33,23,4,1,'2018-02-21 00:42:58','2018-02-20 19:12:58',1),(84,6,3,41,24,4,1,'2018-02-21 00:42:59','2018-02-20 19:12:59',1),(85,6,3,56,25,1,1,'2018-02-21 00:43:01','2018-02-20 19:13:01',1),(86,6,3,40,26,2,1,'2018-02-21 00:43:02','2018-02-20 19:13:02',1),(87,6,3,53,27,3,1,'2018-02-21 00:43:04','2018-02-20 19:13:04',1),(88,6,3,39,28,2,1,'2018-02-21 00:43:06','2018-02-20 19:13:06',1),(89,6,3,37,29,1,1,'2018-02-21 00:43:08','2018-02-20 19:13:08',1),(90,6,3,60,30,4,1,'2018-02-21 00:43:11','2018-02-20 19:13:11',1);
/*!40000 ALTER TABLE `user_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of users table',
  `name` varchar(255) DEFAULT NULL COMMENT 'Name of an user',
  `email` varchar(255) NOT NULL COMMENT 'Email of user',
  `password` varchar(255) NOT NULL COMMENT 'Password of an user',
  `phone_number` varchar(255) NOT NULL COMMENT 'Phone number of an user',
  `gender` enum('F','M') NOT NULL COMMENT 'Gender of an user',
  `address` text NOT NULL COMMENT 'Address of an user',
  `user_type` enum('P','A','F') DEFAULT NULL COMMENT 'Type of an user P- Paid user, A- Admin user, F- Free Exam',
  `class_id` int(11) NOT NULL COMMENT 'Class id of an user',
  `row_status` int(11) DEFAULT '1' COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
  `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
  `client_id` int(11) DEFAULT '1' COMMENT 'Primary key of clients table',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mahesh Sajja','maheshhasan07@gmail.com','$2y$10$QHmv3lp2ME4aEmy0Dd8BROcVbNacI7sGVeGH3sGW2bU7Wr679oDBO','+919052467551','M','Hyderabad','A',0,1,'2018-02-17 01:14:35','2018-02-16 19:44:35',1),(2,'Mahesh Sajja','maheshhasan07@gmail.com','$2y$10$QHmv3lp2ME4aEmy0Dd8BROcVbNacI7sGVeGH3sGW2bU7Wr679oDBO','+919052467551','M','Hyderabad','P',3,1,'2018-02-17 11:32:11','2018-02-20 21:17:51',1),(3,'Mahesh Sajja','maheshhasan07+1@gmail.com','$2y$10$QHmv3lp2ME4aEmy0Dd8BROcVbNacI7sGVeGH3sGW2bU7Wr679oDBO','+919052467551','M','Hyderabad','P',4,1,'2018-02-17 11:43:43','2018-02-17 08:30:56',1),(4,'Sahu Minu','sahumino@gmail.com','$2y$10$QHmv3lp2ME4aEmy0Dd8BROcVbNacI7sGVeGH3sGW2bU7Wr679oDBO','+917893456820','M','Vizag','P',3,1,'2018-02-17 13:47:10','2018-02-17 08:30:56',1),(6,'Mahesh','mahesh+sajja@gmail.com','$2y$10$dA3HHBN.8Wp1XcaJAqLx2emH39j0h/Oe.yGxX2qY7/0.QH.5PBNm.','+919052467551','F','Sample','P',4,1,'2018-02-17 14:02:09','2018-02-17 08:36:52',1),(7,'Mahesh S','anushka@gmail.com','$2y$10$2i1jYjCDKqHIvwJGBj/V7O06I6VtrL.MIEbmSfzGhd0b9gZKKfGgW','+91546745456465','F','Hyderabad','P',3,1,'2018-02-20 05:37:56','2018-02-20 00:07:56',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-21 11:10:46
