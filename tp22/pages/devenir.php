<?php 
 include("../inc/fonction.php");
 session_start();
 $id_emp = $_GET['emp'];
 $id_dept = $_GET['dept'];
 $employe = avoir_employe($id_emp);
 $departement = avoir_departement($id_dept);

 $connexion = connexion();
 $sql = "select current_date() as date";
 $d = mysqli_query($connexion,$sql);
 $dd = mysqli_fetch_assoc($d);
 $today = $dd['date'];

 include("../inc/nav.php");
?>
    <header>
        <h1>Devenir manager de : <strong><?= $departement['dept_name']; ?></strong></h1>
    </header>
    <p> <strong><?= $employe['last_name']; ?> <?= $employe['first_name']; ?></strong> deviens manager du 
        <strong><?= $departement['dept_name']; ?></strong> a partir de : 
    </p>
    <form action="traitement.php" method="post">
        <input type="hidden" name="emp" value="<?= $id_emp; ?>">
        <input type="hidden" name="dept" value="<?= $id_dept; ?>">
        <input type="date" name="date" id="" min="<?= $today;?>" required>
        <input type="submit" value="Valider">
    </form>
</body>
</html>