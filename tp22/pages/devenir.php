<?php 
include("header.php");
 $id_emp = $_GET['emp'];
 $id_dept = $_GET['dept'];
 $employe = avoir_employe($id_emp);
 $departement = avoir_departement($id_dept);
 $manager = manager_dept($id_dept);

 $connexion = connexion();
 $sql = "select current_date() as date";
 $d = mysqli_query($connexion,$sql);
 $dd = mysqli_fetch_assoc($d);
 $today = $dd['date'];
?>
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Devenir manager de : <strong><?= $departement['dept_name']; ?></strong></h1>
    </header>
    <main>
        <p>Manager actuel : <?= $manager['last_name']; ?> <?= $manager['first_name']; ?></p>
        <p> <strong><?= $employe['last_name']; ?> <?= $employe['first_name']; ?></strong> deviens manager du 
            <strong><?= $departement['dept_name']; ?></strong> a partir de : 
        </p>
        <form action="traitement.php" method="post">
            <input type="hidden" name="emp" value="<?= $id_emp; ?>">
            <input type="hidden" name="dept" value="<?= $id_dept; ?>">
            <input type="date" name="date" id="" min="<?= $today;?>" required>
            <input type="submit" value="Valider">
        </form>
    </main>
<?php
include("footer.php");
?>