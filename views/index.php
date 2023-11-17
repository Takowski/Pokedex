<?php 
$title = "Home";
include './data/db.php';
require_once __DIR__.'/partials/header.php';
?>

<main>
    <h1>Pokedex - Homepage</h1>
    <p>Hello  <strong><?php echo $user['name'] ?></p></strong>
    <div class="pokemonContainer">
    <?php
    
        $query = $bdd->query('SELECT * FROM pokemon WHERE name LIKE name ORDER BY id ASC');
        $pokemons = $query->fetchAll();
        foreach($pokemons as $pokemon)
        {
            echo '<div class="pokemon">';
            echo '<img src="'.$pokemon['img'].'" alt="">';
            echo '<p class="id">#'.$pokemon['id'].'</p>';
            echo '<a href="/pokemon?name='.$pokemon['name'].'">'.$pokemon['name'].'</a>';
            echo '<p class="type">'.$pokemon['type1'].'</p>';
            echo '<p class="type">'.$pokemon['type2'].'</p>';
            echo '</div>';
        }
    ?>
    </div>
</main>

<?php 
require_once __DIR__.'/partials/footer.php';
?>