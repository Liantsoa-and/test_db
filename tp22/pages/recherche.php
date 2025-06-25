<?php 
 include("../inc/fonction.php");
 session_start();
 $mot = $_GET['recherche'];
 $type = $_GET['type'];
 $table = [];
 $titre;
 if ($type == 1) {
    $titre = "Departements";
    $table = recherche_dept($mot);
 } else if ($type == 2) {
    $titre = "Nom d'employers";
    $table = recherche_emp($mot);
 } else if ($type == 3) {
    $parts = explode("-", $mot);
    $age_max = (2025 - $parts[1])."-12-31";
    $age_min = (2025 - $parts[0])."-01-01";
    $titre = "Age min-max";
    $table = recherche_age($age_min. $age_max);
 }
 include("../inc/nav.php");

?>
    <header>
        <h1>Resultats des recherches : <?= $titre; ?></h1>
    </header>
    <main>
        <table border="1">
            <tr>
                <th><?= $titre; ?></th>
            </tr>
            <?php foreach($table as $resultat){  ?> 
                <tr>
                    <?php if ($type == 1) { ?>
                        <td>
                            <a href="employer.php?id_dep=<?= $resultat['dept_no'] ;?>">
                                <?= $resultat['dept_name']; ?> 
                            </a>
                        </td>
                    <?php } elseif ($type == 2) { ?>
                        <td>
                            <a href="fiche.php?id_emp=<?= $resultat['emp_no'] ;?>">
                                <?= $resultat['first_name']; ?> <?= $resultat['last_name']; ?>
                            </a>
                        </td>
                    <?php } elseif ($type == 3) { 
                        $parti = explode("-", $resultat['birth_date']);
                        $age = (2025 - $parti[0]); ?>
                        <td>
                            <a href="fiche.php?id_emp=<?= $resultat['emp_no'] ;?>">
                                <?= $resultat['first_name']; ?> <?= $resultat['last_name']; ?> : <?= $age; ?> ans
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>
</body>
</html>