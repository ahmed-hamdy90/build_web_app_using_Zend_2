CREATE DATABASE IF NOT EXISTS learning_zend_2;

USE learning_zend_2;

-- Create Tables in learning_zend_2

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

-- Insert Dummy Data for book Table

INSERT INTO book (`title`, `author`) VALUES ('Duty: Memories of a secretary at War', 'Robert Michael Gates');
INSERT INTO book (`title`, `author`) VALUES ('A Short Guide to a Long Life', 'David Agus');
INSERT INTO book (`title`, `author`) VALUES ('Lone Survivor', 'Marcus Luttrell');
INSERT INTO book (`title`, `author`) VALUES ('Divergent', 'Veronica Roth');
INSERT INTO book (`title`, `author`) VALUES ('The Fault in Our Stars', 'John Green');
INSERT INTO book (`title`, `author`) VALUES ('The Goldfinch', 'Donna Tartt');
INSERT INTO book (`title`, `author`) VALUES ('The Invention of Wings:A Novel', 'Sue Monk Kidd');
INSERT INTO book (`title`, `author`) VALUES ('The Book Thief', 'Markus Zusak');

-- Insert Dummy Data for Album Table

INSERT INTO album (`title`, `artist`) VALUES ('In My Dreams', 'The Military Wives'); 
INSERT INTO album (`title`, `artist`) VALUES ('21', 'Adele'); 
INSERT INTO album (`title`, `artist`) VALUES ('Wrecking Ball (Deluxe)', 'Bruce Springsteen'); 
INSERT INTO album (`title`, `artist`) VALUES ('Born To Die', 'Lana Del Ray'); 
INSERT INTO album (`title`, `artist`) VALUES ('Making Mirrors', 'Gotye'); 