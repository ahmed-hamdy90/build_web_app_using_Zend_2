CREATE DATABASE IF NOT EXISTS learning_zend_2;

USE learning_zend_2;

CREATE TABLE IF NOT EXISTS book (
   `id`     int NOT NULL AUTO_INCREMENT,
   `title`  varchar(225) NOT NULL,
   `author` varchar(225) NOT NULL,
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS album (
   `id`     int NOT NULL AUTO_INCREMENT,
   `title`  varchar(100) NOT NULL,
   `artist` varchar(100) NOT NULL,
   PRIMARY KEY (id)
);

