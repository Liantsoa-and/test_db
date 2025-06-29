<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departements</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link
    href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../pages/index.php">Departements</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="recherche.php" >
        <select name="type" id="">
          <option value="1">Departements</option>
          <option value="2">Employer</option>
          <option value="3">Age min-max</option>
        </select>
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="recherche" >
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
