<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("header.php");
$departements = manager_en_cours();

?>

    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Découvrez nos Départements</h1>
        <p class="lead">Plongez dans le cœur de notre organisation et explorez chaque département, son manager dévoué et le nombre d'employés qui y contribuent.</p>
    </header>

        <main>
            <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Département</th>
                            <th scope="col">Manager Actuel</th>
                            <th scope="col">Nombre d'employés</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($departements as $departement){
                            $isa = compter_emp($departement['dept_no']); ?>
                            <tr>
                                <td>
                                    <a href="employer.php?id_dep=<?= $departement['dept_no']; ?>&page=1" class="text-decoration-none fw-bold text-info"> <?= htmlspecialchars($departement['dept_name']); ?>
                                    </a>
                                </td>
                                <td>
                                    <span class="text-secondary"><?= htmlspecialchars($departement['first_name'] . ' ' . $departement['last_name']); ?></span>
                                </td>
                                <td>
                                    <span ><?= htmlspecialchars($isa['isa']); ?></span> </td>
                            </tr>
                        <?php } ?>
                        <?php if (empty($departements)): ?>
                            <tr>
                                <td colspan="3" class="text-center py-4">Aucun département à afficher pour le moment. Revenez bientôt !</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
<?php
include("footer.php");
?>

