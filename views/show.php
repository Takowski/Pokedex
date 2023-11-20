<?php 
$title = $_GET['name'];

require_once __DIR__.'/partials/header.php';
require './data/db.php';

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex - Details</title>
    <link rel="stylesheet" href="../sass/style.css">
</head>

<main>
    
    <?php 
        $query = "SELECT * FROM Pokemon WHERE name = '$title'";
        $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
        foreach($fetch as $infos) {
            $id = $infos["id"];
            $name = str_replace(["'", ".", " "], "", strtolower($infos["name"]));
            echo <<<EOD
                <img class="imgpoke" src="../public/img/pokemon/$name.png" alt="$name Img" width="500px"><br />
            EOD;
        }
    ?>

    <div class="pokemonStat">
        <div class="favourite">
            
        </div>
        <?php
            $query = "SELECT * FROM Pokemon WHERE name = '$title'";
            $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
            foreach($fetch as $infos) {
                $type1 = $infos["type1"];
                $type2 = $infos["type2"];

                echo <<<EOD
                <h1>{$infos["name"]}</h1> 
                EOD;
                if($type2 != "NULL") {
                    echo <<<EOD
                    <div class="types">
                        <span class=$type1>$type1</span>
                        <span class=$type2>$type2</span>
                    </div>
                    EOD;
                } else {
                    echo <<<EOD
                    <div class="types">
                        <span class=$type1>$type1</span>
                    </div>
                    
                    EOD;
                }  
                    echo <<<EOD
                    <div class="pokeContent">
                        <ul class="pokeStat">
                            <li> HP: {$infos["hp"]}</li>
                            <progress value="{$infos["hp"]}"
                            max="100">
                            </progress>
                            <li> Attack: {$infos["attack"]}</li>
                            <progress value="{$infos["attack"]}"
                            max="100">
                            </progress>
                            <li> Defense: {$infos["defense"]}</li>
                            <progress value="{$infos["defense"]}"
                            max="100">
                            </progress>
                            <li> Specific Defense: {$infos["spdefense"]}</li>
                            <progress value="{$infos["spdefense"]}"
                            max="100">
                            </progress>
                            <li> Specific Attack: {$infos["spattack"]}</li>
                            <progress value="{$infos["spattack"]}"
                            max="100">
                            <li> Speed: {$infos["speed"]}</li>
                            <progress value="{$infos["speed"]}"
                            max="100">
                        </ul>
                    </div>
                EOD;
            }
        ?>
    </div>
    <h1>Evolution</h1>
    <div class="pokemonEvo">
        <?php
            if ($infos['evolution'] == "2") 
            {
                $query = "SELECT * FROM Pokemon WHERE id >= '$id' ORDER BY id ASC LIMIT 3";
                $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
                foreach($fetch as $infos) 
                {
                    echo <<<EOD
                        <figure>
                        <img class="evoImg" src="../public/img/pokemon/{$infos["name"]}.png" alt="{$infos["name"]} Img" width="100px"><br />
                        <figcaption class="pokeName">{$infos["name"]}</figcaption>
                        </figure>
                    EOD;
                }            
            } 
            else if ($infos['evolution'] == "1")
            {
                $query = "SELECT * FROM Pokemon WHERE id >= '$id' ORDER BY id ASC LIMIT 2";
                $fetch = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
                foreach($fetch as $infos) {
                    echo <<<EOD
                    <figure>
                    <img class="evoImg" src="../public/img/pokemon/{$infos["name"]}.png" alt="{$infos["name"]} Img" width="100px"><br />
                    <figcaption class="pokeName">{$infos["name"]}</figcaption>
                    </figure>
                    EOD;
                }
            } 
            else
            {
                echo <<<EOD
                    <p class="evoError"> This pokemon doesn't evolve</p>
                EOD;
            }
           
        ?>
    </div>
</main>

<?php 
require_once __DIR__.'/partials/footer.php';
?>