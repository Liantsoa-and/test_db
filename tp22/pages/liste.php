<?php
include("header.php");
 $departements = tous_departement();
 $titres = avoir_dif_titre();
?>

<header class="mb-4 text-center">
    <h1 class="display-4 text-primary">Liste des employees selon leur genre: </h1>
</header>
<main>
    <br>
    <p><h2 class="text-center">Par departement:</h2></p>
    <div class="table-responsive">
        <table class="table table-hover table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Departments</th>
                    <th scope="col">Employees Femme</th>
                    <th scope="col">Employees Homme</th>
                    <th scope="col">Salaire moyenne</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departements as $departement) {
                    $employes_femme = employe_femme_dept($departement['dept_no']);
                    $employes_homme = employe_homme_dept($departement['dept_no']); 
                    $isa_femme = count($employes_femme);
                    $isa_homme = count($employes_homme);
                    $moyenne_dept = salaire_moyenne_dept($departement['dept_no']);
                    ?>
                    <tr>
                        <td><a href="employer.php?page=1&id_dep=<?= $departement['dept_no']; ?>"><?= $departement['dept_name']; ?></a></td>
                        <td><?= $isa_femme; ?></td>
                        <td><?= $isa_homme; ?></td>
                        <td><?= $moyenne_dept; ?>$</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <br>
    <p><h2 class="text-center">Par titre:</h2></p>
    <div class="table-responsive">
        <table class="table table-hover table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Employees Femme</th>
                    <th scope="col">Employees Homme</th>
                    <th scope="col">Salaire moyenne</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($titres as $titre){ 
                    $femme_titre = employe_femme_title($titre);
                    $homme_titre = employe_homme_title($titre);
                    $isa_femme_t = count($femme_titre);
                    $isa_homme_t = count($homme_titre);
                    $moyenne_title = salaire_moyenne_title($titre);
                    ?>
                    <tr>
                        <td><?= $titre; ?></td>
                        <td><?= $isa_femme_t; ?></td>
                        <td><?= $isa_homme_t; ?></td>
                        <td><?= $moyenne_title; ?>$</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>
<?php
include("footer.php");
?>