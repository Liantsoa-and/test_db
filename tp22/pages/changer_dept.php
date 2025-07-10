<?php 
include("header.php");

$id_emp = $_GET['id_emp'];
$employer = avoir_employe($id_emp);
$departements = tous_departement();

$connexion = connexion();
$sql = "select current_date() as date";
$d = mysqli_query($connexion,$sql);
$dd = mysqli_fetch_assoc($d);
$today = $dd['date'];
?>
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Changer de departement:</h1>
    </header>
    <main>
        <div class="row">
            <form action="traitement.php" method="get">
                <p>Choisir un departement :
                    <select name="id_dept" id="" required>
                    <?php foreach($departements as $departement){ ?> 
                        <option value="<?= $departement['dept_no']; ?>"><?= $departement['dept_name']; ?></option>
                    <?php } ?>
                </select></p>
                <p>Date debut : <input type="date" name="date" id="" min="<?= $today;?>" required></p>
                <input type="hidden" name="id_emp" value="<?= $id_emp; ?>">
                <p><input type="submit" value="Valider"></p>
            </form>
        </div>
    </main>
<?php
include("footer.php");
?>
