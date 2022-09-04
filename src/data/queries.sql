INSERT INTO formations (name, leader_name, deputy_leader_name, lawyer_name)
VALUES
  ('Insignis', 'Johan Liebert', 'Nathan Young', 'Jacqueline de Monroe'),
  ('Camarilla', 'Terry Silva', 'Roxy Diaz', 'Mateo Gerrera'),
  ('Caedes', 'Jack Black', 'David Brown', 'Scott Sewell'),
  ('Brujah', 'Gunter Knapp', 'Timothee Grayson', 'Mikaela Teller'),
  ('Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'),
  ('Gangrel', 'Aaron de Langeron', 'Aldo Delgado', 'Francis de Castan');

INSERT INTO users (username, fivem_id, password, formation_id, status, registration_date)
VALUES
  ('Emiel Regis van der Eretein', 9737, 'kkapass02', 'Insignis', 'teacher', NOW()),
  ('Jacqueline de Monroe', 8855, 'pass', 'Insignis', 'master', NOW()),
  ('First Second', 13000, 'pass', 'Brujah', 'student', NOW());
