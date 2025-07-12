<?php
include("header.php");

$nom = $_POST['nom_employee'] ?? '';
$dep = $_POST['dep'] ?? '';
$age_min = $_POST['age_min'] ?? '';
$age_max = $_POST['age_max'] ?? '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * 20; 

$employes = recherche_employes($nom, $dep, $age_min, $age_max, $offset);
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">Résultats de la recherche</h1>
</header>

<main class="container mb-5">
    <div class="mb-4">
        <a href="formulaire.php" class="btn btn-outline-secondary rounded-pill">
            ← Nouvelle recherche
        </a>
    </div>

    <?php if (empty($employes)): ?>
        <div class="alert alert-warning text-center" role="alert">
            Aucun résultat trouvé pour les critères spécifiés.
        </div>
    <?php else: ?>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <?php if ($page > 1): ?>
                <form method="get" action="result.php" class="mb-0">
                    <input type="hidden" name="nom" value="<?= htmlspecialchars($nom) ?>">
                    <input type="hidden" name="dep" value="<?= htmlspecialchars($dep) ?>">
                    <input type="hidden" name="age_min" value="<?= htmlspecialchars($age_min) ?>">
                    <input type="hidden" name="age_max" value="<?= htmlspecialchars($age_max) ?>">
                    <input type="hidden" name="page" value="<?= $page - 1 ?>">
                    <button type="submit" class="btn btn-outline-primary rounded-pill">← Précédent</button>
                </form>
            <?php else: ?>
                <div></div>
            <?php endif; ?>

            <form method="get" action="result.php" class="mb-0">
                <input type="hidden" name="nom" value="<?= htmlspecialchars($nom) ?>">
                <input type="hidden" name="dep" value="<?= htmlspecialchars($dep) ?>">
                <input type="hidden" name="age_min" value="<?= htmlspecialchars($age_min) ?>">
                <input type="hidden" name="age_max" value="<?= htmlspecialchars($age_max) ?>">
                <input type="hidden" name="page" value="<?= $page + 1 ?>">
                <button type="submit" class="btn btn-outline-primary rounded-pill">Page suivante →</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-striped shadow-sm align-middle">
                <thead class="table-info text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Genre</th>
                        <th>Date de naissance</th>
                        <th>Date d’embauche</th>
                        <th>Âge</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employes as $e): ?>
                        <tr>
                            <td><?= $e['emp_no'] ?></td>
                            <td>
                                <a href="fiche.php?id_emp=<?= $e['emp_no'] ?>" class="text-decoration-none fw-semibold text-primary">
                                    <?= htmlspecialchars($e['last_name']) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($e['first_name']) ?></td>
                            <td><?= $e['gender'] ?></td>
                            <td><?= $e['birth_date'] ?></td>
                            <td><?= $e['hire_date'] ?></td>
                            <td><?= date('Y') - substr($e['birth_date'], 0, 4) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php include("footer.php"); ?>
