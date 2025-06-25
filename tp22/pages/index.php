<?php 
 include("../inc/fonction.php");
 session_start();
 $departements = tous_departement();
 include("../inc/nav.php");
?>
    <header>
        <h1>La liste de tous les departements :</h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Departement</th>
                <th>Nom du manageur en cour</th>
            </tr>
            <?php foreach($departements as $departement){ ?> 
                <tr>
                    <td>
                        <a href="employer.php?id_dep=<?= $departement['dept_no']; ?> ">
                            <p><?= $departement['dept_name']; ?></p>
                        </a>
                    </td>
                    <td>
                        <?php $managers = manager_en_cours($departement['dept_no']);
                        foreach($managers as $manager){
                            $mangeur = avoir_employe($manager['emp_no']); ?>
                            <p><?= $mangeur['first_name']; ?> <?= $mangeur['last_name']; ?></p>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>
</body>
</html>