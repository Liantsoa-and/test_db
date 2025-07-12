<?php
include("header.php");

$departements = tous_departement();
$titres = avoir_dif_titre();
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">Répartition des employés par genre</h1>
</header>

<main class="container mb-5">

    <section class="mb-5">
        <h2 class="text-center mb-4 text-secondary">Par département</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped shadow-sm align-middle">
                <thead class="table-info text-center">
                    <tr>
                        <th>Département</th>
                        <th>Employées Femmes</th>
                        <th>Employés Hommes</th>
                        <th>Salaire moyen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departements as $departement):
                        $isa_femme = count(employe_femme_dept($departement['dept_no']));
                        $isa_homme = count(employe_homme_dept($departement['dept_no']));
                        $moyenne_dept = salaire_moyenne_dept($departement['dept_no']);
                    ?>
                        <tr>
                            <td>
                                <a href="employer.php?page=1&id_dep=<?= $departement['dept_no']; ?>" class="text-decoration-none fw-semibold text-primary">
                                    <?= htmlspecialchars($departement['dept_name']); ?>
                                </a>
                            </td>
                            <td class="text-center"><?= $isa_femme; ?></td>
                            <td class="text-center"><?= $isa_homme; ?></td>
                            <td class="text-center"><?= $moyenne_dept; ?> $</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section>
        <h2 class="text-center mb-4 text-success">Par titre</h2>
        <div class="table-responsive">
            <table class="table table-hover table-striped shadow-sm align-middle">
                <thead class="table-success text-center">
                    <tr>
                        <th>Titre</th>
                        <th>Employées Femmes</th>
                        <th>Employés Hommes</th>
                        <th>Salaire moyen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($titres as $titre):
                        $isa_femme_t = count(employe_femme_title($titre));
                        $isa_homme_t = count(employe_homme_title($titre));
                        $moyenne_title = salaire_moyenne_title($titre);
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($titre); ?></td>
                            <td class="text-center"><?= $isa_femme_t; ?></td>
                            <td class="text-center"><?= $isa_homme_t; ?></td>
                            <td class="text-center"><?= $moyenne_title; ?> $</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</main>

<?php include("footer.php"); ?>
