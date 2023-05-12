CREATE TABLE users (
  id int PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(60) NOT NULL,
  firstname VARCHAR(60),
  lastname VARCHAR(60),
  email VARCHAR(125),
  phone VARCHAR(20),
  pw VARCHAR(65536) NOT NULL,
  userrole VARCHAR(20) NOT NULL,
  usersession VARCHAR(15),
  deleted INT
);

INSERT INTO users (username, pw, userrole)
VALUES ("admin", "$2y$10$SbKeHbaz3FG0geWpqz8UFeZgcR5FNbIoUBh/B4jWW.jYu261jgjfa", "admin");

INSERT INTO users (username, pw, userrole)
VALUES ("player", "$2y$10$hkU7wghnP7.jRzDibbGz2OxHWvikwLS0E8mTegiBeHp1BRuvowQDG", "player");

INSERT INTO users (username, firstname, lastname, email, phone, pw, userrole)
VALUES ("testi", "Ano", "Nyymi", "test@testi.fi", "+358 40 1234567", "$2y$10$yiwGYWMlZasNCWj3vWyAYO80lTjOGU9y/sjM2jqNmLu4u44hHv5t.", "player");
