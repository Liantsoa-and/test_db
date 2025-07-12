<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("header.php");
$departements = manager_en_cours();
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">Découvrez nos Départements</h1>
    <p class="lead text-muted">
        Plongez dans le cœur de notre organisation et explorez chaque département, son manager dévoué et le nombre d'employés qui y contribuent.
    </p>
</header>

<main class="container mb-5">
    <div class="table-responsive">
        <table class="table table-hover table-striped shadow-sm align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col">Département</th>
                    <th scope="col">Manager Actuel</th>
                    <th scope="col">Nombre d'employés</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departements as $departement): 
                    $isa = compter_emp($departement['dept_no']); ?>
                    <tr>
                        <td>
                            <a href="employer.php?id_dep=<?= $departement['dept_no']; ?>&page=1"
                               class="text-decoration-none fw-bold text-info">
                                <?= htmlspecialchars($departement['dept_name']); ?>
                            </a>
                        </td>
                        <td class="text-secondary">
                            <?= htmlspecialchars($departement['first_name'] . ' ' . $departement['last_name']); ?>
                        </td>
                        <td><?= htmlspecialchars($isa['isa']); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($departements)): ?>
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">
                            Aucun département à afficher pour le moment. Revenez bientôt !
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include("footer.php"); ?>
