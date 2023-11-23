CREATE TABLE `users` (
   id INT AUTO_INCREMENT PRIMARY KEY,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `Favorites` json DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL
)

