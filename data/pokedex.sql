CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    FirstName VARCHAR(100),
    LastName VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    Favorites JSON,
    Admin BOOLEAN
);

CREATE TABLE Pokemon (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    img VARCHAR(255),
    type1 VARCHAR(50),
    type2 VARCHAR(50),
    hp INT,
    attack INT,
    defense INT,
    spattack INT,
    spdefense INT,
    speed INT
);