INSERT INTO formations (name, leader_name, deputy_leader_name, lawyer_name)
VALUES ('Insignis', 'Johan Liebert', 'Nathan Young', 'Jacqueline de Monroe'),
       ('Camarilla', 'Gunter Knapp', 'Roxy Diaz', 'Mateo Gerrera'),
       ('Caedes', 'Jack Black', 'David Brown', 'Scott Sewell'),
       ('Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'),
       ('Gangrel', 'Aaron de Langeron', 'Aldo Delgado', 'Francis de Castan');

INSERT INTO user (username, fivemId, discord, password, formationId, status, registrationDate)
VALUES ('Emiel Regis van der Eretein', 9737, 'mentalaffect#6666', 'kkapass02', 1, 'teacher', NOW()),
       ('Jacqueline de Monroe', 8855, 'Zlaya#0007', 'pass', 1, 'rector', NOW()),
       ('Mikaela Teller', 1255, '.Di#5151', 'pass', 2, 'dean', NOW());

INSERT INTO lecture (status, creationDate, title, details)
VALUES ('submitted', NOW(), 'Наследие Первородных', 'Скоро'),
       ('submitted', NOW(), 'Королевская семья и иерархия вампирского сообщества', 'Скоро'),
       ('submitted', NOW(), 'Титульная система вампирского сообщества', 'Скоро'),
       ('submitted', NOW(), 'Элизиум', 'Скоро'),
       ('submitted', NOW(), 'Кровавый договор', 'Скоро'),
       ('submitted', NOW(), 'Основы физиологии вампиров', 'Скоро'),
       ('submitted', NOW(), 'Истинная сущность', 'Скоро'),
       ('submitted', NOW(), 'История боевых действий и вооруженных конфликтов', 'Скоро'),
       ('submitted', NOW(), 'История вампирского сообщества', 'Скоро'),
       ('submitted', NOW(), 'Производство формаций', 'Скоро');

INSERT INTO schedule (type, `from`, `to`)
VALUES ('lectures', '17:00', '21:00'),
       ('vacation', '17:00', '21:00'),
       ('lectures', '17:00', '21:00'),
       ('vacation', '17:00', '21:00'),
       ('lectures', '17:00', '21:00'),
       ('attestation', '17:00', '21:00'),
       ('examination', '17:00', '21:00');

# INSERT INTO schedule_day_lectures (day_id, lecture_id, teacher_id, time, duration)
# VALUES (1, 1, 1, NOW(), 1),
#        (1, 2, 1, NOW(), 1),
#        (1, 3, 1, NOW(), 1),
#        (1, 4, 1, NOW(), 1),
#        (3, 5, 1, NOW(), 1),
#        (3, 6, 1, NOW(), 1),
#        (3, 7, 1, NOW(), 1),
#        (5, 8, 1, NOW(), 1),
#        (5, 9, 1, NOW(), 1),
#        (5, 10, 1, NOW(), 1);
