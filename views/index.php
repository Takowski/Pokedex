<?php 
$title = "Home";
include './data/db.php';
require_once __DIR__.'/partials/header.php';
?>

<main>
    <h1>Pokedex - Homepage</h1>
    <p>Hello  <strong><?php echo $user['name'] ?></p></strong>
</main>

<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    try {
        $DB = new PDO("mysql:host=localhost;dbname=pokemon;charset=utf8", "root", "root");
        $query = "SELECT * FROM Pokemon";
        $fetch = $DB->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($fetch as $infos) {
            $name = str_replace(["'", ".", " "], "", strtolower($infos["name"]));
            $id= $infos["id"];
            $type1 = $infos["type1"];
            $type2 = $infos["type2"];
            echo <<<EOD
                <img src="../public/img/pokemon/$name.png" alt="$name Img" width="50px"><br />
                <span>#$id</span><br />
                <span>$name</name><br />
            EOD;
            if($type2 != "NULL") {
                echo <<<EOD
                <span>$type1</name>
                <span>$type2</name><br />
                EOD;
            } else {
                echo <<<EOD
                <span>$type1</name><br />
                EOD;
            }
        }
    }
    catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
			die('Erreur : '.$e->getMessage());
		}
    require_once __DIR__.'/partials/footer.php';
?>