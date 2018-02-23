DROP TABLE IF EXISTS users;

CREATE TABLE users(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of users table',
    `name` varchar(255) DEFAULT NULL COMMENT 'Name of an user',
    `email` varchar(255) NOT NULL COMMENT 'Email of user',
    `password` varchar(255) NOT NULL COMMENT 'Password of an user',
    `phone_number` varchar(255) NOT NULL COMMENT 'Phone number of an user',
    `gender` enum('F', 'M') NOT NULL COMMENT 'Gender of an user',
    `address` text NOT NULL  COMMENT 'Address of an user',
    `user_type` enum('P','A','F') COMMENT 'Type of an user P- Paid user, A- Admin user, F- Free Exam',
    `class_id` int(11) NOT NULL COMMENT 'Class id of an user',
    `row_status` int(11) DEFAULT 1 COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
    `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
    `modified_time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
    `client_id` int(11) DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;


DROP TABLE IF EXISTS classes;

CREATE TABLE classes(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of classes table',
    `class_name` varchar(255) NOT NULL COMMENT 'Name of a class',
    `created_time` datetime COMMENT 'Migration created date and time',
    `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
    `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Row status 1- Active, 0 - In Active',
    `client_id` int(11) NOT NULL DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS exams;

CREATE TABLE exams(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of exams table',
    `class_id` int(11) NOT NULL COMMENT 'Primary key of classes table',
    `exam_name` varchar(255) NOT NULL COMMENT 'Name of an exam',
    `exam_time_limit` int(11) NOT NULL COMMENT 'Time limit of an exam',
    `no_of_questions` int(11) NOT NULL COMMENT 'No of questions for the exam',
    `schduled_date` datetime DEFAULT NULL COMMENT 'When you want to start the exam',
    `created_time` datetime COMMENT 'Migration created date and time',
    `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
    `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Row status 1- Active, 0 - In Active',
    `client_id` int(11) NOT NULL DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;


DROP TABLE IF EXISTS questions;

CREATE TABLE questions(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of classes table',
    `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
    `title` varchar(255) NOT NULL COMMENT 'Title of a question',
    `options` text NOT NULL COMMENT 'Answers of a question',
    `answer` int(11) NOT NULL COMMENT 'Correct answer of a question',
    `marks` int(11) NOT NULL COMMENT 'Marks for a question',
    `created_time` datetime COMMENT 'Migration created date and time',
    `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
    `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Row status 1- Active, 0 - In Active',
    `client_id` int(11) NOT NULL DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;


DROP TABLE IF EXISTS user_exams;

CREATE TABLE user_exams(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of classes table',
    `user_id` int(11) NOT NULL COMMENT 'Primary key og f uses table',
    `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
    `exam_started_time` datetime COMMENT 'Starting time of an exam',
    `exam_ended_time` datetime COMMENT 'Ending time of an exam',
    `created_time` datetime COMMENT 'Migration created date and time',
    `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record updated time',
    `row_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Row status 1- Active, 0 - In Active',
    `client_id` int(11) NOT NULL DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS user_questions;

CREATE TABLE user_questions(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of user taken exams table',
    `user_id` int(11) NOT NULL COMMENT 'Primary key of users table',
    `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
    `question_id` int(11) NOT NULL COMMENT 'Primary key of questions table',
    `user_answer` int(11) NOT NULL COMMENT 'Answer of an user',
    `row_status` int(11) DEFAULT 1 COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
    `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
    `modified_time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
    `client_id` int(11) DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS user_exam_results;

CREATE TABLE user_exam_results(
    `id` int(11) PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary key of user taken exams table',
    `user_id` int(11) NOT NULL COMMENT 'Primary key of users table',
    `exam_id` int(11) NOT NULL COMMENT 'Primary key of exams table',
    `marks` int(11) NOT NULL COMMENT 'Marks gained by user',
    `total_marks` int(11) NOT NULL COMMENT 'Total marks of an exam',
    `row_status` int(11) DEFAULT 1 COMMENT 'Row status of an user whether active or not 1- Active, 0 - In active',
    `created_time` datetime DEFAULT NULL COMMENT 'Created time of an user',
    `modified_time` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'MOdified time of user record',
    `client_id` int(11) DEFAULT 1 COMMENT 'Primary key of clients table'
)AUTO_INCREMENT = 1;