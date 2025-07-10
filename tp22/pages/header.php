<?php 
    require_once("../inc/fonction.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Département</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <i>Data</i>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="employer.php">Employés par genre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="liste.php">Liste des employés</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="formulaire.php">Recherche multicritère</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
