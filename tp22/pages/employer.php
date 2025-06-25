<?php 
 include("../inc/fonction.php");
 session_start();
 $id_dep = $_GET['id_dep'];
 $id_emps = avoir_idemployes($id_dep);
 $departement = avoir_departement($id_dep);
 include("../inc/nav.php");

?>
    <header>
        <h1>La liste de tous les employers dans le departement: <?= $departement['dept_name']; ?></h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Date de naissance</th>
            </tr>
            <?php foreach($id_emps as $id){ 
                $id_emp = $id['emp_no'];
                $employer = avoir_employe($id_emp); ?> 
                <tr>
                    <td>
                        <a href="fiche.php?id_emp=<?= $employer['emp_no'] ;?>">
                            <?= $employer['first_name']; ?> <?= $employer['last_name']; ?>
                        </a>
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