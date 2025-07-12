<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("header.php");
$departements = tous_departement();
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">Recherche d'employés</h1>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="result.php" method="post" class="p-4 border rounded-4 shadow-sm bg-light">
                <div class="mb-3">
                    <label for="dep" class="form-label fw-semibold">Département</label>
                    <select name="dep" id="dep" class="form-select">
                        <option value="">-- Tous --</option>
                        <?php foreach ($departements as $dep): ?>
                            <option value="<?= $dep['dept_no'] ?>">
                                <?= htmlspecialchars($dep['dept_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nom_employee" class="form-label fw-semibold">Nom ou prénom</label>
                    <input type="text" name="nom_employee" id="nom_employee" class="form-control" placeholder="Ex: Jean">
                </div>

                <div class="row">
                    <div class="col">
                        <label for="age_min" class="form-label fw-semibold">Âge minimum</label>
                        <input type="number" name="age_min" id="age_min" class="form-control" min="18" max="99">
                    </div>
                    <div class="col">
                        <label for="age_max" class="form-label fw-semibold">Âge maximum</label>
                        <input type="number" name="age_max" id="age_max" class="form-control" min="18" max="99">
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
