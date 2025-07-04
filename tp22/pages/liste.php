<?php
 include("../inc/fonction.php");
 $departements = tous_departement();
 include("../inc/nav.php");
?>

<head>
    <h1 class="text-center">Liste des employees selon leur genre: </h1>
</head>
<main>
    <table border="1">
        <tr>
            <th>Departments</th>
            <th>Nombre d'employees femmes</th>
            <th>Nombre d'employees hommes</th>
        </tr>
        <?php foreach ($departements as $departement) {
            $employes_femme = employe_femme_dept($departement['dept_no']);
            $employes_homme = employe_homme_dept($departement['dept_no']); 
            $isa_femme = count($employes_femme);
            $isa_homme = count($employes_homme);
            ?>
        
            <tr>
                <td><?= $departement['dept_name']; ?></td>
                <td><?= $isa_femme; ?></td>
                <td><?= $isa_homme; ?></td>
            </tr>
        <?php } ?>
    </table>
</main>
<footer></footer>