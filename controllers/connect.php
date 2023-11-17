<?php
try {
    $pdo=new PDO('mysql:host=localhost;dbname=pokemon;charset=utf8mb4", "root", "root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}
?>