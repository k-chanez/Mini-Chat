/*exécuter ces commandes sur votre terminal*/
/*1- $ sudo mysql */
/*2- $ source /le chemin ou ce trouve ce fichier/identifiat.sql*/

DROP DATABASE Users_NXM8 ;
CREATE DATABASE Users_NXM8;
USE Users_NXM8;Users_NXM8.izan

/*create user vQqLHWYs identified by '8MZk3o0ZOJ2vQqLHWYsv0FvfyltG3sRl';
grant all privileges on Users_NXM8.* to vQqLHWYs;*/

drop table if exists Users_NXM8.Users;
CREATE TABLE Users(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  Password varchar(100) NOT NULL
);

drop table if exists Users_NXM8.chat;
CREATE TABLE chat (
  num int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pseudo varchar(100) NOT NULL,
  message varchar(500) NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL
);



