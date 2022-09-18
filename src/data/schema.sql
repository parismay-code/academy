CREATE DATABASE academy
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

use academy;

CREATE TABLE `formations`
(
  `id`                 INT AUTO_INCREMENT PRIMARY KEY,
  `name`               VARCHAR(128),
  `leader_name`        VARCHAR(128),
  `deputy_leader_name` VARCHAR(128),
  `lawyer_name`        VARCHAR(128)
);

CREATE TABLE `users`
(
  `id`                INT AUTO_INCREMENT PRIMARY KEY,
  `username`          VARCHAR(128),
  `fivem_id`          INT,
  `discord`           VARCHAR(128),
  `password`          CHAR(64),
  `formation_id`      VARCHAR(128),
  `status`            VARCHAR(64),
  `registration_date` TIMESTAMP
);

CREATE TABLE `formations_users`
(
  `id`           INT AUTO_INCREMENT PRIMARY KEY,
  `user_id`      INT,
  `formation_id` INT,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`)
);

CREATE TABLE `lectures`
(
  `id`            INT AUTO_INCREMENT PRIMARY KEY,
  `status`        TINYTEXT,
  `creation_date` TIMESTAMP,
  `title`         TINYTEXT,
  `details`       TEXT
);

CREATE TABLE `files`
(
  `id`   INT AUTO_INCREMENT PRIMARY KEY,
  `url`  VARCHAR(2048),
  `type` VARCHAR(16)
);

CREATE TABLE `lecture_files`
(
  `id`         INT AUTO_INCREMENT PRIMARY KEY,
  `lecture_id` INT,
  `file_id`    INT,
  FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`id`),
  FOREIGN KEY (`file_id`) REFERENCES `files` (`id`)
);

CREATE TABLE `teachers_check_list`
(
  `id`      INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
);

CREATE TABLE `schedule`
(
  `id`             INT AUTO_INCREMENT PRIMARY KEY,
  `day_id`         INT,
  `lecture_id`     INT,
  `lecture_number` INT,
  `lecture_time`   TIMESTAMP,
  `type`           VARCHAR(32),
  `teacher_id`     INT,
  FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  FOREIGN KEY (`lecture_id`) REFERENCES `lectures` (`id`)
);
