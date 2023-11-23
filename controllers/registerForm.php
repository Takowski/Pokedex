<?php

function registerForm(){
echo '
    <form method="get" action="./controllers/register.php" >
        <label for="FirstName">Firstname</label><br>
        <input type="text" id="FirstName" name="FirstName" required><br>
        <label for="lastName">Lastname</label><br>
        <input type="text" id="lastName" name="lastName" required><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>
    ';
}
?>