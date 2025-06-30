<?php
include("../inc/fonction.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <header></header>
    <main>
        <form action="result.php" method="post">
            <p>departement</p>   
            <input type="text" name="dep" placeholder="departement">
            <br>
            <p>nom nom_employee</p>
            <input type="text" name="nom_employee">
            <br>
            <p>age min</p>
            <input type="number" name="age_min" placeholder="age minimal" min="18">
            <br>
            <p>age max</p>
            <input type="number" name="age_max" max="99">
            <br>
            <input type="submit" value="Rechercher">
        </form>
    </main>
    <footer></footer>
</body>
</html>