<?php 
 include("../inc/fonction.php");
 session_start();
 $id_emp = $_GET['emp'] ?? null;
 $id_dept = $_GET['dept'];
 echo $id_dept;
 $manager = manager_en_cours_dept($id_dept);
 var_dump($manager);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Je deviens manager <?= $id_emp; ?> du <?= $id_dept; ?></p>
    <p><?= $manager['first_name'];?></p>
    <form action="devenir.php" method="post">
        <input type="hidden" name="emp" value="<?= $id_emp; ?>">
        <input type="date" name="date" id="">
        <input type="submit" value="Valider">
    </form>
</body>
</html>