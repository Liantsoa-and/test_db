<?php 
include("header.php");

$id_emp = $_GET['emp'];
$id_dept = $_GET['dept'];
$employe = avoir_employe($id_emp);
$departement = avoir_departement($id_dept);
$manager = manager_dept($id_dept);

$connexion = connexion();
$sql = "select current_date() as date";
$d = mysqli_query($connexion, $sql);
$dd = mysqli_fetch_assoc($d);
$today = $dd['date'];
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">
        Devenir manager de : <strong><?= $departement['dept_name']; ?></strong>
    </h1>
</header>

<main class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="mb-4 p-4 border rounded-4 shadow-sm bg-light">
                <p class="mb-2 text-muted">
                    Manager actuel : 
                    <strong><?= $manager['first_name'] . ' ' . $manager['last_name']; ?></strong>
                </p>

                <p class="fw-semibold">
                    <strong><?= $employe['first_name'] . ' ' . $employe['last_name']; ?></strong>
                    devient manager du département 
                    <strong><?= $departement['dept_name']; ?></strong> à partir de :
                </p>

                <form action="traitement.php" method="post" class="mt-3">
                    <input type="hidden" name="emp" value="<?= $id_emp; ?>">
                    <input type="hidden" name="dept" value="<?= $id_dept; ?>">

                    <div class="mb-3">
                        <label for="date" class="form-label fw-semibold">Date de prise de poste</label>
                        <input type="date" name="date" id="date" class="form-control" min="<?= $today; ?>" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>
