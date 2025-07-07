<?php 
include("../inc/fonction.php");
session_start();
$id_emp = $_GET['id_emp'];
$employer = avoir_employe($id_emp);
$departements = tous_departement();
include("../inc/nav.php");
?>
    <head>
        <h1 class="text-center">Changer de departement:</h1>
    </head>
    <main>
        <div class="row">
            <form action="traitement.php" method="get">
                <p>Choisir un departement :
                    <select name="id_dept" id="" required>
                    <?php foreach($departements as $departement){ ?> 
                        <option value="<?= $departement['dept_no']; ?>"><?= $departement['dept_name']; ?></option>
                    <?php } ?>
                </select></p>
                <p>Date debut : <input type="date" name="date" id="" required></p>
                <input type="hidden" name="id_emp" value="<?= $id_emp; ?>">
                <p><input type="submit" value="Valider"></p>
            </form>
        </div>
    </main>
</body>
</html>