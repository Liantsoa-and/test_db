<?php 
 include("../inc/fonction.php");
 session_start();
 $id_emp = $_GET['id_emp'];
 $employer = avoir_employe($id_emp);
 $salaires = avoir_histo_salaire($id_emp);
 $titres = avoir_histo_titre($id_emp);
 $departement = son_departement($id_emp);
 $salaire_actu = salaire_en_cours($id_emp);
 $titre_actu = titre_en_cours($id_emp);
 include("../inc/nav.php");

?>
    <header>
        <h1>Fiche de l'employee: <?= $employer['last_name']; ?></h1>
    </header>
    <main>
        <div class="fiche">
            <p>Nom :<?= $employer['last_name']; ?></p>
            <p>Prenom : <?= $employer['first_name']; ?></p>
            <p>Genre : <?= $employer['gender']; ?></p>
            <p>Date de naissance : <?= $employer['birth_date']; ?></p>
            <p>Date d'emboche : <?= $employer['hire_date']; ?></p>
            <p>Departement : <?= $departement['dept_name']; ?></p>
            <?php if($salaire_actu != null){ ?>
                <p>Salaire actuel : <?= $salaire_actu['salary']; ?>$</p>
            <?php } ?>
            <?php if($titre_actu != null){ ?>
                <p>Titre actuel : <?= $titre_actu['title']; ?></p>
            <?php } ?>

            <?php if($titres != null){ ?> 
                <p><h2>Historique d'employe :</h2></p>
                <table border="1">
                    <tr>
                        <th>Titre</th>
                        <th>Date debut</th>
                        <th>Date fin</th>
                    </tr>
                    <?php foreach($titres as $titre){ ?> 
                        <tr>
                            <td><?= $titre['title']; ?></td>
                            <td><?= $titre['from_date']; ?></td>
                            <td><?= $titre['to_date']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <?php if($salaires != null){ ?> 
                <p><h2 class="text-center">Historique des salaires :</h2></p>
                <table border="1">
                    <tr>
                        <th>Date debut</th>
                        <th>Montant du salaire</th>
                        <th>Date fin</th>
                    </tr>
                    <?php foreach($salaires as $salaire){ ?> 
                        <tr>
                            <td><?= $salaire['from_date']; ?></td>
                            <td><?= $salaire['salary']; ?>$</td>
                            <td><?= $salaire['to_date']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>

    </main>
</body>
</html>