<?php

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=pokemon;charset=utf8', 'root', 'root');
    echo "Connexion réussie !<br><br><br><br>";

// Retrieve form data
$FirstName = $_GET['FirstName'] ??   '';
$lastName = $_GET['lastName'] ?? '';
$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL INSERT statement
$sql = "INSERT INTO users (FirstName, LastName, email, password) VALUES (:FirstName, :Lastname, :email, :password )";

// Prepare statement
$stmt = $bdd->prepare($sql);

// Bind parameters
$stmt->bindParam(':FirstName', $FirstName);
$stmt->bindParam(':Lastname', $lastName);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

// Execute statement
$stmt->execute();
header('Location: /myAccount');
exit;
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

?>


<!DOCTYPE html>
<html>
<body>

<form action="" method="get">
  <label for="FirstName">Firstname</label><br>
  <input type="text" id="FirstName" name="FirstName" required><br>
  <label for="lastName">Lastname</label><br>
  <input type="text" id="lastName" name="lastName" required><br>
  <label for="email">Email</label><br>
  <input type="email" id="email" name="email" required><br>
  <label for="password">Password</label><br>
  <input type="password" id="password" name="password" required><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>