<?php 
$title = $_GET['name'];

require_once __DIR__.'/partials/header.php';
require './data/db.php';


?>

<main>
    <a href="/">Homepage</a>
    <a href="/favorites">Favorites</a>
    
    <?php 
        $query = "SELECT * FROM Pokemon WHERE name = '$title'";
        $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($fetch as $infos) {
            $id = $infos["id"];
            $name = str_replace(["'", ".", " "], "", strtolower($infos["name"]));
            echo <<<EOD
                <img src="../public/img/pokemon/$name.png" alt="$name Img" width="500px"><br />
            EOD;
        }
    ?>

    <div class="pokemonStat">
        <?php
            $query = "SELECT * FROM Pokemon WHERE name = '$title'";
            $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $infos) {

                if ($infos['type2'] == "NULL") {
                    $infos['type2'] = "";
                } else {
                    $infos['type2'] = $infos['type2'];
                }

                echo <<<EOD
                    <h1> {$infos["name"]}</h1>
                    <h3> {$infos["type1"]}</h2>
                    <h3> {$infos["type2"]}</h3>
                    <ul>    
                        <li> HP: {$infos["hp"]}</li>
                        <li> Attack: {$infos["attack"]}</li>
                        <li> Defense: {$infos["defense"]}</li>
                        <li> Specific Defense: {$infos["spdefense"]}</li>
                        <li> Specific Attack: {$infos["spattack"]}</li>
                        <li> Speed: {$infos["speed"]}</li>
                    </ul>
                EOD;
            }
        ?>
    </div>
    <div class="pokemonEvo">
        <h1>Evolution</h1>
        <?php
            $query = "SELECT * FROM Pokemon WHERE id >= '$id' ORDER BY id ASC LIMIT 3";
            $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $infos) {
                echo <<<EOD
                    <img src="../public/img/pokemon/{$infos["name"]}.png" alt="{$infos["name"]} Img" width="100px"><br />
                    <p>{$infos["name"]}</p>
                EOD;
            }
        ?>
    </div>
</main>

<?php 
require_once __DIR__.'/partials/footer.php';
?>