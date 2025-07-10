<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("header.php");
$departements = tous_departement();

?>
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Recherche d'employés</h1>
    </header>
    <main>
        <form action="result.php" method="post">
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
<?php
include("footer.php");
?>