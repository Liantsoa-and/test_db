<?php 
 include("../inc/fonction.php");
 session_start();
 $id_dep = $_GET['id_dep'];
 $id_emps = avoir_employes_dep($id_dep);
 $departement = avoir_departement($id_dep);
 include("../inc/nav.php");

?>
    <header>
        <h1>Liste de tous les employers dans le departement: <?= $departement['dept_name']; ?></h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de naissance</th>
            </tr>
            <?php foreach($id_emps as $employer){ ?> 
                <tr>
                    <td>
                        <a href="fiche.php?id_emp=<?= $employer['emp_no'] ;?>">
                            <?= $employer['last_name']; ?> 
                        </a>
                    </td>
                    <td>
                    <?= $employer['first_name']; ?>
                    </td>
                    <td>
                        <?= $employer['birth_date']; ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>
</body>
</html>