
<!DOCTYPE html>
<html lang="en">
<!-- <?php 
$title = "Home";
require_once __DIR__.'/partials/header.php';
?> -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - Homepage</title>
    <link rel="stylesheet" href="../sass/style.css">
    <link rel="icon" type="image/x-icon" href="./pokeball.png">
</head>
<body>
<main>
    <img class="pokedexDesign" src="./public/img/pokedex-design.png" alt="Pokedex Design">
    <h1>Pokedex - Homepage</h1>
    <p>Hello  <strong><?php echo $user['name'] ?></p></strong>
    <a href="/pokemon?name=pikachu">Pikachu</a>
</main>
<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    try {
        $DB = new PDO("mysql:host=localhost;dbname=pokemon;charset=utf8", "root", "root");
        $query = "SELECT * FROM Pokemon";
        $fetch = $DB->query($query)->fetchAll(PDO::FETCH_ASSOC);
        echo <<<EOD
            <div class="bigDiv">
        EOD;
        
        foreach($fetch as $infos) {
            $name = str_replace([".", " "], "", strtolower($infos["name"]));
            $id= $infos["id"];
            $type1 = $infos["type1"];
            $type2 = $infos["type2"];
            echo <<<EOD
            <a href="/pokemon?name=$name" class="details"><div class="pokemonDiv">
                <img src="../public/img/pokemon/$name.png" alt="$name Img" width="50px"><br />
                <span>#$id</span><br />
            EOD;
            $name = str_replace([".", " "], "", strtolower($infos["name"]));
            $name = ucfirst($name);
            if($type2 != "NULL") {
                echo <<<EOD
                <span class="name">$name</span><br />
                <div class="types">
                    <span class=$type1>$type1</span>
                    <span class=$type2>$type2</span>
                </div>
                EOD;
            } else {
                echo <<<EOD
                <span class="name">$name</span><br />
                <div class="types">
                    <span class=$type1>$type1</span>
                </div>
                
                EOD;
            }
            echo <<<EOD
            </div></a>
            EOD;
        }
        echo <<<EOD
            </div>
        EOD;
    }
    catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}
        /*     require_once __DIR__.'/partials/footer.php'; */
    ?>
</body>
</html>