 <?php 
include("header.php");

$id_emp = $_GET['id_emp'];
$employer = avoir_employe($id_emp);
$departements = tous_departement();
$sondepartement = son_departement($id_emp);

$connexion = connexion();
$sql = "select current_date() as date";
$d = mysqli_query($connexion, $sql);
$dd = mysqli_fetch_assoc($d);
$today = $dd['date'];
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">Changer de département</h1>
    <p class="text-muted">Employé concerné : <strong><?= $employer['first_name'] . ' ' . $employer['last_name']; ?></strong></p>
    <p class="text-muted">Departement actuel : <strong><?= $sondepartement['dept_name']; ?></strong></p>
</header>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="traitement.php" method="get" class="p-4 border rounded-4 shadow-sm bg-light">
                <div class="mb-3">
                    <label for="id_dept" class="form-label fw-semibold">Choisir un département</label>
                    <select name="id_dept" id="id_dept" class="form-select" required>
                        <?php foreach($departements as $departement): ?> 
                            <option value="<?= $departement['dept_no']; ?>">
                                <?= $departement['dept_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label fw-semibold">Date de début</label>
                    <input type="date" name="date" id="date" class="form-control" min="<?= $today; ?>" required>
                </div>

                <input type="hidden" name="id_emp" value="<?= $id_emp; ?>">

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                        Valider
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
