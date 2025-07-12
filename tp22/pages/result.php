<?php
include("header.php");

$nom = $_POST['nom_employee'] ?? '';
$dep = $_POST['dep'] ?? '';
$age_min = $_POST['age_min'] ?? '';
$age_max = $_POST['age_max'] ?? '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * 20; 

$employes = recherche_employes($nom, $dep, $age_min, $age_max, $offset);

?>
    <style>
        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
    <header class="mb-4 text-center">
        <h1 class="display-4 text-primary">Résultats de la recherche</h1>
    </header>
    <main>
        <a href="formulaire.php">← Nouvelle recherche</a>
    
        <?php if (empty($employes)): ?>
            <p>Aucun résultat trouvé.</p>
        <?php else: ?>
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <form method="get" action="result.php">
                        <input type="hidden" name="nom" value="<?= htmlspecialchars($nom) ?>">
                        <input type="hidden" name="dep" value="<?= htmlspecialchars($dep) ?>">
                        <input type="hidden" name="age_min" value="<?= htmlspecialchars($age_min) ?>">
                        <input type="hidden" name="age_max" value="<?= htmlspecialchars($age_max) ?>">
                        <input type="hidden" name="page" value="<?= $page - 1 ?>">
                        <input type="submit" value="← Précédent">
                    </form>
                <?php endif; ?>
                <form action="result.php" method="get">
                    <input type="hidden" name="nom" value="<?= htmlspecialchars($nom) ?>">
                    <input type="hidden" name="dep" value="<?= htmlspecialchars($dep) ?>">
                    <input type="hidden" name="age_min" value="<?= htmlspecialchars($age_min) ?>">
                    <input type="hidden" name="age_max" value="<?= htmlspecialchars($age_max) ?>">
                    <input type="hidden" name="page" value="<?= $page+1 ?>">
                    <input type="submit" value="Page suivante">
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Date d’embauche</th>
                            <th scope="col">Âge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $e): ?>
                            <tr>
                                <td><?= $e['emp_no'] ?></td>
                                <td><a href="fiche.php?id_emp=<?= $e['emp_no'] ;?>">
                                        <?= htmlspecialchars($e['last_name']) ?>
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($e['first_name']) ?></td>
                                <td><?= $e['gender'] ?></td>
                                <td><?= $e['birth_date'] ?></td>
                                <td><?= $e['hire_date'] ?></td>
                                <td><?= date('Y') - substr($e['birth_date'], 0, 4) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <br>
        <?php endif; ?>
    </main>
<?php
include("footer.php");
?>