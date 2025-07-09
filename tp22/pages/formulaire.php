<?php
include("../inc/fonction.php");
session_start();
$departements = getDepartments(); 
$_SESSION['pnum'] = "result.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departement</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link
    href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="modele.php?pnum=index.php"><strong> Departements</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="modele.php?pnum=liste.php"><strong> Employees par genre</strong></a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="formulaire.php?" >
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<body>
    <header>
        <h1>Recherche d'employés</h1>
    </header>
    <main>
        <form action="modele.php" method="post">
            <label for="dep">Département :</label>
            <select name="dep" id="dep">
                <option value="">-- Tous --</option>
                <?php foreach ($departements as $dep): ?>
                    <option value="<?= $dep['dept_no'] ?>"><?= htmlspecialchars($dep['dept_name']) ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="nom_employee">Nom ou prénom :</label>
            <input type="text" name="nom_employee" id="nom_employee"><br><br>
    
            <label for="age_min">Âge minimum :</label>
            <input type="number" name="age_min" id="age_min" min="18" max="99"><br><br>
    
            <label for="age_max">Âge maximum :</label>
            <input type="number" name="age_max" id="age_max" min="18" max="99"><br><br>
    
            <input type="submit" value="Rechercher">
        </form>
    </main>