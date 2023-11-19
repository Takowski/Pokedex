<?php

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=pokemon;charset=utf8', 'root', 'root');
    echo "Connexion réussie !<br><br><br><br>";

// Retrieve form data
$FirstName = $_POST['FirstName'];
$email = $_POST['email'];
$password = $_POST['password'];
// Prepare SQL INSERT statement
$sql = "INSERT INTO users (FirstName, email, password) VALUES (:FirstName, :email, :password )";

// Prepare statement
$stmt = $bdd->prepare($sql);

// Bind parameters
$stmt->bindParam(':FirstName', $FirstName);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

// Execute statement
$stmt->execute();

// Redirect back to the form page
//header('Location: form.php');
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

<form action="" method="post">
  <label for="FirstName">Username</label><br>
  <input type="text" id="FirstName" name="FirstName" required><br>
  <label for="email">Email</label><br>
  <input type="email" id="email" name="email" required><br>
  <label for="password">Password</label><br>
  <input type="password" id="password" name="password" required><br>
  <input type="submit" value="Submit">
</form> 

</body>
</html>