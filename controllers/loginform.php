<?php
function loginForm(){
echo '
    <form method="post" action="./controllers/login.php" >
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Log in">
    </form>
    ';
}