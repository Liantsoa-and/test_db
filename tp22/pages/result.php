<?php
include("../inc/fonction.php");
session_start();

$nom = $_POST['nom_employee'] ?? '';
$dep = $_POST['dep'] ?? '';
$age_min = $_POST['age_min'] ?? '';
$age_max = $_POST['age_max'] ?? '';

$employes = recherche_employes($nom, $dep, $age_min, $age_max);
include("../inc/nav.php");

?>

<!DOCTYPE html>
<html>
<head><title>Résultats</title></head>
<body>
    <h2>Résultats de la recherche</h2>
    <a href="formulaire.php">← Nouvelle recherche</a>

    <?php if (empty($employes)): ?>
        <p>Aucun résultat trouvé.</p>
    <?php else: ?>
        <table border="1">
            <tr>
                <th>ID</th><th>Nom</th><th>Prénom</th><th>Genre</th><th>Date de naissance</th><th>Date d’embauche</th><th>Âge</th>
            </tr>
            <?php foreach ($employes as $e): ?>
                <tr>
                    <td><?= $e['emp_no'] ?></td>
                    <td><?= htmlspecialchars($e['last_name']) ?></td>
                    <td><?= htmlspecialchars($e['first_name']) ?></td>
                    <td><?= $e['gender'] ?></td>
                    <td><?= $e['birth_date'] ?></td>
                    <td><?= $e['hire_date'] ?></td>
                    <td><?= date('Y') - substr($e['birth_date'], 0, 4) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
