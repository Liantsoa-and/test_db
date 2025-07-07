<?php 
 include("../inc/fonction.php");
 session_start();
 $id_dep = $_GET['id_dep'];
 $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 $offset = ($page - 1) * 20; 
 $id_emps = avoir_employes_dep($id_dep,$offset);
 $departement = avoir_departement($id_dep);
 include("../inc/nav.php");

?>
<style>
        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
    <header>
        <h1>Liste de tous les employers dans le departement: <?= $departement['dept_name']; ?></h1>
    </header>
    <main>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <form method="get" action="employer.php">
                    <input type="hidden" name="id_dep" value="<?= ($id_dep) ?>">
                    <input type="hidden" name="page" value="<?= $page - 1 ?>">
                    <input type="submit" value="← Précédent">
                </form>
            <?php endif; ?>
                <form action="employer.php" method="get">
                    <input type="hidden" name="id_dep" value="<?= htmlspecialchars($id_dep) ?>">
                    <input type="hidden" name="page" value="<?= $page+1 ?>">
                    <input type="submit" value="Page suivante">
                </form>
        </div>
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
