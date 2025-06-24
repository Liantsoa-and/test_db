<?php 
 include("../inc/fonction.php");
 session_start();
 $id_dep = $_GET['id_dep'];
 $id_emps = avoir_idemployes($id_dep);
 $departement = avoir_departement($id_dep);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link
    href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>La liste de tous les employers dans le departement: <?= $departement['dept_name']; ?></h1>
    </header>
    <main>
        <?php foreach($id_emps as $id){ 
            $id_emp = $id['emp_no'];
            $employer = avoir_employe($id_emp); ?> 
            <div class="row text-center">
                <div class="col-sm-4 employer text-center">
                    <p>Nom : <?= $employer['first_name']; ?> <?= $employer['last_name']; ?></p>
                    <p>Date de naissance : <?= $employer['birth_date']; ?></p>
                </div>
            </div>
        <?php } ?>
    </main>
    <footer></footer>
</body>
</html>