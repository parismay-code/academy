CREATE DATABASE academy
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

use academy;

CREATE TABLE `status`
(
    `id`    INT AUTO_INCREMENT PRIMARY KEY,
    `name`  VARCHAR(32),
    `label` VARCHAR(32),
    `level` INT
);

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
    `status_id`         INT,
    `username`          VARCHAR(128),
    `fivem_id`          INT UNIQUE,
    `discord`           VARCHAR(128) UNICODE,
    `password`          CHAR(64),
    `registration_date` TIMESTAMP,
    `auth_key`          VARCHAR(32),
    `access_token`      VARCHAR(32),
    FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE SET NULL
);

CREATE TABLE `formation_user`
(
    `id`           INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`      INT,
    `formation_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON DELETE CASCADE
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
    FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE CASCADE
);

CREATE TABLE `teacher_queue`
(
    `id`      INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
);

CREATE TABLE `schedule_day`
(
    `id`   INT AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(32),
    `from` INT,
    `to`   INT
);

CREATE TABLE `day_lecture`
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `day_id`     INT,
    `lecture_id` INT,
    `teacher_id` INT,
    `time`       INT,
    `is_free`    BOOL,
    FOREIGN KEY (`day_id`) REFERENCES `schedule_day` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`) ON DELETE SET NULL,
    FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE SET NULL
);

CREATE TABLE `student_visit`
(
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `student_id`    INT,
    `lecture_id`    INT,
    `is_individual` BOOl,
    `date`          TIMESTAMP,
    FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`lecture_id`) REFERENCES `lecture` (`id`) ON DELETE CASCADE
);

CREATE TABLE `teacher_activity`
(
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `teacher_id` INT,
    `type`       VARCHAR(32),
    `date`       TIMESTAMP,
    FOREIGN KEY (`teacher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
);