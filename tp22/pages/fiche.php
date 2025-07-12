<?php 
include("header.php");

if(isset($_SESSION['id_emp'])){
    $_GET['id_emp'] = $_SESSION['id_emp'];
}

$id_emp = $_GET['id_emp'];
$employer = avoir_employe($id_emp);
$salaires = avoir_histo_salaire($id_emp);
$titres = avoir_histo_titre($id_emp);
$departement = son_departement($id_emp);
$salaire_actu = salaire_en_cours($id_emp);
$titre_actu = titre_en_cours($id_emp);
?>

<header class="mb-5 text-center">
    <h1 class="display-5 text-primary fw-semibold">
        Fiche de l'employé : <?= $employer['last_name']; ?>
    </h1>
</header>

<main class="container mb-5">
    <?php if(isset($_SESSION['mes'])): ?>
        <div class="alert alert-info text-center fw-semibold">
            <?= $_SESSION['mes']; unset($_SESSION['mes']); ?>
        </div>
    <?php endif; ?>

    <div class="p-4 mb-4 border rounded-4 shadow-sm bg-light">
        <p><strong>Nom :</strong> <?= $employer['last_name']; ?></p>
        <p><strong>Prénom :</strong> <?= $employer['first_name']; ?></p>
        <p><strong>Genre :</strong> <?= $employer['gender']; ?></p>
        <p><strong>Date de naissance :</strong> <?= $employer['birth_date']; ?></p>
        <p><strong>Département :</strong> <?= $departement['dept_name']; ?></p>
        <p><strong>Date d'embauche :</strong> <?= $employer['hire_date']; ?></p>

        <?php if($salaire_actu): ?>
            <p><strong>Salaire actuel :</strong> <?= $salaire_actu['salary']; ?> $</p>
        <?php endif; ?>

        <?php if($titre_actu): ?>
            <p><strong>Titre actuel :</strong> <?= $titre_actu['title']; ?></p>
        <?php endif; ?>

        <?php
            $job = job_longest_duration($id_emp);
            if($job): ?>
                <p>Le job le plus long : <strong><?= $job['title']; ?></strong>,
                pendant <strong><?= $job['duration']; ?> ans</strong></p>
        <?php endif; ?>

        <div class="d-flex gap-3 mt-4">
            <a href="changer_dept.php?id_emp=<?= $id_emp; ?>" class="btn btn-outline-primary rounded-pill">
                Changer de département
            </a>
            <a href="devenir.php?emp=<?= $id_emp; ?>&dept=<?= $departement['dept_no']; ?>" class="btn btn-outline-success rounded-pill">
                Devenir manager
            </a>
        </div>
    </div>

    <?php if($titres): ?> 
        <h2 class="text-center mt-5 text-primary">Historique des titres</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-striped shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th>Titre</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($titres as $titre): ?> 
                        <tr>
                            <td><?= $titre['title']; ?></td>
                            <td><?= $titre['from_date']; ?></td>
                            <td><?= $titre['to_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if($salaires): ?> 
        <h2 class="text-center mt-5 text-success">Historique des salaires</h2>
        <div class="table-responsive mt-3">
            <table class="table table-hover table-striped shadow-sm">
                <thead class="table-success">
                    <tr>
                        <th>Date début</th>
                        <th>Salaire</th>
                        <th>Date fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($salaires as $salaire): ?> 
                        <tr>
                            <td><?= $salaire['from_date']; ?></td>
                            <td><?= $salaire['salary']; ?> $</td>
                            <td><?= $salaire['to_date']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php include("footer.php"); ?>
