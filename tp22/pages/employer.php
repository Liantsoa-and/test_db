<?php 
include("header.php");
 $id_dep = $_GET['id_dep'];
 $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
 $offset = ($page - 1) * 20; 
 $id_emps = avoir_employes_dep($id_dep,$offset);
 $departement = avoir_departement($id_dep);
 unset($_SESSION['id_emp']);

?>
    <style>
        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Liste de tous les employers dans le departement: <?= $departement['dept_name']; ?></h1>
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
        <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom </th>
                            <th scope="col">Date de naissance</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
            </div>
        </table>
    </main>
<?php
include("footer.php");
?>
