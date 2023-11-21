<!DOCTYPE html>
<html>
<head>
</head>
<body>

<form action="" method="get">
  <label for="search">Enter a pokemon</label><br>
  <input type="text" id="search" name="search" required><br>
  <input type="submit" value="search">
</form> 

<?php

try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=pokemon;charset=utf8', 'root', 'root');

    // Retrieve search term
    $searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

    // Only execute the query if a search term is provided
    if (!empty($searchTerm)) {
        // Prepare SQL SELECT statement
        $sql = "SELECT * FROM Pokemon WHERE name LIKE :searchTerm";

        // Prepare statement
        $stmt = $bdd->prepare($sql);

        // Bind parameters
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');

        // Execute statement
        $stmt->execute();

        // Fetch all rows
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Start table
        echo "<table border='1'>";
        echo "<tr><th>Name</th><th>Type1</th><th>Type2</th><th>Evolution</th><th>HP</th><th>Attack</th><th>Defense</th><th>Sp. Attack</th><th>Sp. Defense</th><th>Speed</th></tr>";

        // Display results
        foreach ($rows as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['type1']) . "</td>";
            echo "<td>" . htmlspecialchars($row['type2']) . "</td>";
            echo "<td>" . htmlspecialchars($row['evolution']) . "</td>";
            echo "<td>" . htmlspecialchars($row['hp']) . "</td>";
            echo "<td>" . htmlspecialchars($row['attack']) . "</td>";
            echo "<td>" . htmlspecialchars($row['defense']) . "</td>";
            echo "<td>" . htmlspecialchars($row['spattack']) . "</td>";
            echo "<td>" . htmlspecialchars($row['spdefense']) . "</td>";
            echo "<td>" . htmlspecialchars($row['speed']) . "</td>";
            echo "</tr>";
        }

        // End table
        echo "</table>";
    }
}

catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

?>

</body>
</html>