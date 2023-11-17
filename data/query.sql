CREATE TABLE `users` (
  `id` int NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `Favorites` json DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL
)

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `email`, `password`, `Favorites`, `Admin`)
VALUES
(1, 'John', 'Doe', 'john.doe@example.com', 'password1', '["Pikachu", "Bulbasaur"]', 0),
(2, 'Jane', 'Doe', 'jane.doe@example.com', 'password2', '["Charmander", "Squirtle"]', 0),
(3, 'Alice', 'Smith', 'alice.smith@example.com', 'password3', '["Jigglypuff", "Meowth"]', 0),
(4, 'Bob', 'Johnson', 'bob.johnson@example.com', 'password4', '["Psyduck", "Geodude"]', 0),
(5, 'Charlie', 'Brown', 'charlie.brown@example.com', 'password5', '["Eevee", "Snorlax"]', 1);