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
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Fiche de l'employee: <?= $employer['last_name']; ?></h1>
    </header>
    <main>
        <div class="error text-center">
            <p>
                <?php if(isset($_SESSION['mes'])){
                    echo $_SESSION['mes'];
                    unset($_SESSION['mes']);
                } ?>
            </p>
        </div>
        <br>
        <div class="fiche">
            <p><strong>Nom</strong>:<?= $employer['last_name']; ?></p>
            <p><strong>Prenom</strong>: <?= $employer['first_name']; ?></p>
            <p><strong>Genre</strong>: <?= $employer['gender']; ?></p>
            <p><strong>Date de naissance</strong>: <?= $employer['birth_date']; ?></p>
            <p><strong>Departement</strong>: <?= $departement['dept_name']; ?></p>
            <p><strong>Date d'embauche</strong>: <?= $employer['hire_date']; ?></p>
            <?php if($salaire_actu != null){ ?>
                <p><strong>Salaire actuel</strong> : <?= $salaire_actu['salary']; ?>$</p>
            <?php } ?>
            <?php if($titre_actu != null){ ?>
                <p><strong>Titre actuel</strong>: <?= $titre_actu['title']; ?></p>
            <?php } ?>

            <?php
                $job = job_longest_duration($id_emp);
                if($job != null){
                    $titre_longest = $job['title'];
                    $duration = $job['duration']; ?>
                    <p>Le job le plus long est : <strong><?= $titre_longest; ?></strong>, d'une durée de <strong> <?= $duration; ?> ans</strong></p>
                <?php }
            ?>
            <p><a href="changer_dept.php?id_emp=<?= $id_emp; ?>"><button>Changer de departement</button></a></p>
            <p><a href="devenir.php?emp=<?= $id_emp; ?>&&dept=<?= $departement['dept_no']; ?>"><button>Devenir manager</button></a></p>

        <?php if($titres != null){ ?> 
            <p><h2 class="text-center">Historique d'employe :</h2></p>
            <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Date debut</th>
                            <th scope="col">Date fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($titres as $titre){ ?> 
                            <tr>
                                <td><?= $titre['title']; ?></td>
                                <td><?= $titre['from_date']; ?></td>
                                <td><?= $titre['to_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>

        <?php if($salaires != null){ ?> 
            <p><h2 class="text-center">Historique des salaires :</h2></p>
            <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Date debut</th>
                            <th scope="col">Montant du salaire</th>
                            <th scope="col">Date fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($salaires as $salaire){ ?> 
                            <tr>
                                <td><?= $salaire['from_date']; ?></td>
                                <td><?= $salaire['salary']; ?>$</td>
                                <td><?= $salaire['to_date']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </main>
<?php
include("footer.php");
?>