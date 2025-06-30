<?php
include("../inc/fonction.php");
session_start();    
$dep = $_POST['dep'];
$nom = $_POST['nom_employee'];
$min = $_POST['age_min'];
$min = $_POST['age_max'];
//$results = recherche($dep,$nom,$min,$max);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultats de recherche</title>
</head>
<body>
    <header></header>
    <main>
        <table border="1">
            <tr>
                <th>Nom employees</th>
            </tr>
            <?php foreach($results as $emp){?>
                <tr>
                    <td><?= $emp['first_name'];?> <?= $emp['last_name'];?></td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>
    
</body>
</html>