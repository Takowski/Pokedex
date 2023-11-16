CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(100),
    LastName VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    Favorites JSON
    Admin BOOLEAN
);