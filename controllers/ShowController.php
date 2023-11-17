<?php
 include './data/db.php';
 function show()
 {
    $name = $_GET['name'];
    $pokemon = $name;
    require_once __DIR__.'/../views/show.php';
    return $pokemon;
 }
?>