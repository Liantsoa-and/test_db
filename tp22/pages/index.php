<?php 
 include("../inc/fonction.php");
 session_start();
 $departements = manager_en_cours();
 include("../inc/nav.php");
?>
    <header>
        <h1>Liste de tous les departements :</h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Departement</th>
                <th>Nom du manageur en cours</th>
                <th>Nombre d'employees</th>
            </tr>
            <?php foreach($departements as $departement){ 
                $isa = compter_emp($departement['dept_no']); ?> 
                <tr>
                    <td>
                        <a href="employer.php?id_dep=<?= $departement['dept_no']; ?>&page=1">
                            <p><?= $departement['dept_name']; ?></p>
                        </a>
                    </td>
                    <td>
                            <p><?= $departement['first_name']; ?> <?= $departement['last_name']; ?></p>
                    </td>
                    <td>
                        <?= $isa['isa']; ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>
</body>
</html>