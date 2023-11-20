<!DOCTYPE html>
<html lang="en" class="addPokemonHTML">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../sass/style.css">
</head>
<body class="addPokemonBody">
<?php
function addPokemon() {
    $userId = $_SESSION['user_id'];

    require 'accessdb.php';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?;');
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $stmt->closeCursor();
    $stmt = null;
    
    if ($user["Admin"] == 1) {
        echo <<<EOD
            <form method="POST" class="addPokemon">
                <label for="num">Number in Pokedex : <input name="num" type="number"></label>
                <label for="name">Name of Pokemon : <input name="name" type="text"></label>
                <label for="type1">Type 1 of Pokemon :
                    <select name="type1">
                        <option>Normal</option>
                        <option>Grass</option>
                        <option>Poison</option>
                        <option>Steel</option>
                        <option>Bug</option>
                        <option>Flying</option>
                        <option>Fire</option>
                        <option>Fairy</option>
                        <option>Water</option>
                        <option>Ground</option>
                        <option>Electric</option>
                        <option>Rock</option>
                        <option>Fighting</option>
                        <option>Psychic</option>
                        <option>Ice</option>
                        <option>Ghost</option>
                        <option>Dragon</option>
                    </select>
                </label>
                <label for="type2">Type 2 of Pokemon :
                    <select name="type2">
                        <option>Normal</option>
                        <option>Grass</option>
                        <option>Poison</option>
                        <option>Steel</option>
                        <option>Bug</option>
                        <option>Flying</option>
                        <option>Fire</option>
                        <option>Fairy</option>
                        <option>Water</option>
                        <option>Ground</option>
                        <option>Electric</option>
                        <option>Rock</option>
                        <option>Fighting</option>
                        <option>Psychic</option>
                        <option>Ice</option>
                        <option>Ghost</option>
                        <option>Dragon</option>
                        <option>NULL</option>
                    </select>
                </label>
                <label for="hp">HP of Pokemon : <input name="hp" type="number"></label>
                <label for="attack">Attack of Pokemon : <input name="attack" type="number"></label>
                <label for="defense">Defense of Pokemon : <input name="defense" type="number"></label>
                <label for="spattack">Special Attack of Pokemon : <input name="spattack" type="number"></label>
                <label for="spdefense">Special Defense of Pokemon : <input name="spdefense" type="number"></label>
                <label for="speed">Speed of Pokemon : <input name="speed" type="number"></label>
                <input type="submit" value="Add Pokemon"name="addPokemonSubmit">
            </form>
        EOD;
        $num = $_POST["num"];
        $name = $_POST["name"];
        $type1 = $_POST["type1"];
        $type2 = $_POST["type2"];
        $hp = $_POST["hp"];
        $attack = $_POST["attack"];
        $defense = $_POST["defense"];
        $spattack = $_POST["spattack"];
        $spdefense = $_POST["spdefense"];
        $speed = $_POST["speed"];


        $query = "INSERT INTO `Pokemon` 
        (`id`, `name`, `type1`, `type2`, `hp`, `attack`, `defense`, `spattack`, `spdefense`, `speed`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $prep = $pdo->prepare($query);

        $prep->bindValue(1 , $num, PDO::PARAM_STR);
        $prep->bindValue(2 , $name, PDO::PARAM_STR);
        $prep->bindValue(3 , $type1, PDO::PARAM_STR);
        $prep->bindValue(4 , $type2, PDO::PARAM_STR);
        $prep->bindValue(5 , $hp, PDO::PARAM_INT);
        $prep->bindValue(6 , $attack, PDO::PARAM_INT);
        $prep->bindValue(7 , $defense, PDO::PARAM_INT);
        $prep->bindValue(8 , $spattack, PDO::PARAM_INT);
        $prep->bindValue(9 , $spdefense, PDO::PARAM_INT);
        $prep->bindValue(10 , $speed, PDO::PARAM_INT);

        $prep->execute();

        $prep->closeCursor();
        $prep = null;
    }

}
?>
</body>
</html>
