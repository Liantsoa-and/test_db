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
          <a class="nav-link active" aria-current="page" href="modele.php?pnum=index.php"><strong>Accueil</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="modele.php?pnum=liste.php"><strong> Employees par genre</strong></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="modele.php?pnum=liste.php"><strong>Liste des employés</strong></a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="formulaire.php?" >
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<body>
    <?php 
    include("../inc/fonction.php");
    session_start();

    if(isset($_SESSION['pnum'])){
        $nump = $_SESSION['pnum'];
        unset($_SESSION['pnum']);
        include("$nump");
    } else if(isset($_GET['pnum'])){
        $nump = $_GET['pnum'];
        include("$nump");
    } else{
        include("index.php");
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9Gkcappw/JbQhG/JmFb5A" crossorigin="anonymous"></script>

</body>
</html>
