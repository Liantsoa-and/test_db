<?php 
include("header.php");

$id_dep = $_GET['id_dep'];
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * 20; 
$id_emps = avoir_employes_dep($id_dep, $offset);
$departement = avoir_departement($id_dep);
unset($_SESSION['id_emp']);
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">
        Employés du département : <strong><?= $departement['dept_name']; ?></strong>
    </h1>
</header>

<main class="container mb-5">
    <div class="d-flex justify-content-between mb-4">
        <?php if ($page > 1): ?>
            <form method="get" action="employer.php" class="d-inline">
                <input type="hidden" name="id_dep" value="<?= $id_dep ?>">
                <input type="hidden" name="page" value="<?= $page - 1 ?>">
                <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                    ← Précédent
                </button>
            </form>
        <?php endif; ?>

        <form action="employer.php" method="get" class="d-inline">
            <input type="hidden" name="id_dep" value="<?= htmlspecialchars($id_dep) ?>">
            <input type="hidden" name="page" value="<?= $page + 1 ?>">
            <button type="submit" class="btn btn-outline-primary rounded-pill px-4">
                Page suivante →
            </button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Date de naissance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($id_emps as $employer): ?> 
                    <tr>
                        <td>
                            <a href="fiche.php?id_emp=<?= $employer['emp_no']; ?>" class="text-decoration-none text-primary fw-semibold">
                                <?= $employer['last_name']; ?> 
                            </a>
                        </td>
                        <td><?= $employer['first_name']; ?></td>
                        <td><?= $employer['birth_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include("footer.php"); ?>
