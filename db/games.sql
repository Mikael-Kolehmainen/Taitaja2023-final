CREATE TABLE games (
  id int PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(150) NOT NULL,
  gameimage VARCHAR(255) NOT NULL,
  class VARCHAR(150) NOT NULL
);

INSERT INTO games (title, gameimage, class)
VALUES ("Addition challenge game", "/src/public_site/media/games/game_1.jpg", "Luokka 1: yhteen- ja vähennyslaskupelejä");
