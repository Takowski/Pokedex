<?php
try
{
  $bdd = new PDO('mysql:host=localhost;dbname=pokemon;charset=utf8', 'root', 'root');
  
  $FirstName = $_GET['FirstName'] ?? "";
  $lastName = $_GET['lastName'] ?? "";
  $email = $_GET['email'] ?? "";
  $password = $_GET['password'] ?? "";
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (FirstName, LastName, email, password) VALUES (:FirstName, :Lastname, :email, :password )";

  $stmt = $bdd->prepare($sql);

  $stmt->bindParam(':FirstName', $FirstName);
  $stmt->bindParam(':Lastname', $lastName);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':password', $hashedPassword);

  $stmt->execute();

  header('Location: /myAccount');
  exit;
}
catch(Exception $e)
{
  die('Erreur : '.$e->getMessage());
}




