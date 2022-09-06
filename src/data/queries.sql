INSERT INTO formations (name, leader_name, deputy_leader_name, lawyer_name)
VALUES
  ('Insignis', 'Johan Liebert', 'Nathan Young', 'Jacqueline de Monroe'),
  ('Camarilla', 'Terry Silva', 'Roxy Diaz', 'Mateo Gerrera'),
  ('Caedes', 'Jack Black', 'David Brown', 'Scott Sewell'),
  ('Brujah', 'Gunter Knapp', 'Timothee Grayson', 'Mikaela Teller'),
  ('Sabbat', 'Schwein Fettes', 'Wendy Farrel Osborn', 'Dustin Ross'),
  ('Gangrel', 'Aaron de Langeron', 'Aldo Delgado', 'Francis de Castan');

INSERT INTO users (username, fivem_id, discord, password, formation_id, status, registration_date)
VALUES
  ('Emiel Regis van der Eretein', 9737, 'mentalaffect#6666', 'kkapass02', 1, 'teacher', NOW()),
  ('Jacqueline de Monroe', 8855, '.Di#5151', 'pass', 1, 'master', NOW()),
  ('Mikaela Teller', 1255, 'Zlaya#0007',  'pass', 2, 'dean', NOW());
