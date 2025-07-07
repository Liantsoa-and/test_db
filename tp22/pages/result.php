<?php
include("../inc/fonction.php");
session_start();

$nom = $_POST['nom_employee'] ?? '';
$dep = $_POST['dep'] ?? '';
$age_min = $_POST['age_min'] ?? '';
$age_max = $_POST['age_max'] ?? '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * 20; 

$employes = recherche_employes($nom, $dep, $age_min, $age_max, $offset);
include("../inc/nav.php");

?>
    <title>Résultats</title>
    <style>
        .pagination {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
<body>
    <h2>Résultats de la recherche</h2>
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
        <table border="1">
            <tr>
                <th>ID</th><th>Nom</th><th>Prénom</th><th>Genre</th><th>Date de naissance</th><th>Date d’embauche</th><th>Âge</th>
            </tr>
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
        </table>
        <br>
    <?php endif; ?>
</body>
</html>