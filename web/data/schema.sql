CREATE DATABASE academy
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

use academy;

CREATE TABLE `formation`
(
    `id`                 INT AUTO_INCREMENT PRIMARY KEY,
    `name`               VARCHAR(128),
    `leader_name`        VARCHAR(128),
    `deputy_leader_name` VARCHAR(128),
    `lawyer_name`        VARCHAR(128)
);

CREATE TABLE `user`
(
    `id`                INT AUTO_INCREMENT PRIMARY KEY,
    `username`          VARCHAR(128),
    `fivem_id`          INT,
    `discord`           VARCHAR(128),
    `password`          CHAR(64),
    `status`            VARCHAR(64),
    `registration_date` TIMESTAMP
);

CREATE TABLE `formation_user`
(
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`      INT,
    `formation_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
    FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
);

CREATE TABLE `lecture`
(
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `status`        TINYTEXT,
    `creation_date` TIMESTAMP,
    `title`         TINYTEXT,
    `details`       TEXT
);

CREATE TABLE `file`
(
    `id`   INT AUTO_INCREMENT PRIMARY KEY,
    `url`  VARCHAR(2048),
    `type` VARCHAR(16)
);

CREATE TABLE `lecture_file`
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `lecture_id` INT,
    `file_id`    INT,
    FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`),
    FOREIGN KEY (`file_id`) REFERENCES `file` (`id`)
);

CREATE TABLE `teacher_queue`
(
    `id`      INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
);

CREATE TABLE `schedule_day`
(
    `id`   INT AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(32),
    `from` CHAR(32),
    `to`   CHAR(32)
);

CREATE TABLE `day_lecture`
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `day_id`     INT,
    `lecture_id` INT,
    `teacher_id` INT,
    `time`       CHAR(32),
    FOREIGN KEY (`day_id`) REFERENCES `schedule_day` (`id`),
    FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`),
    FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`)
)
