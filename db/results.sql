CREATE TABLE results (
  id int PRIMARY KEY AUTO_INCREMENT,
  games_id int NOT NULL,
  users_id int NOT NULL,
  score int NOT NULL,
  gametime int NOT NULL,
  FOREIGN KEY (users_id) REFERENCES users(id),
  FOREIGN KEY (games_id) REFERENCES games(id)
);

INSERT INTO results (games_id, users_id, score, gametime)
VALUES (1, 3, 74, 14);
