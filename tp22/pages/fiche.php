<?php 
 include("../inc/fonction.php");
 session_start();
 $id_emp = $_GET['id_emp'];
 $employer = avoir_employe($id_emp);
 include("../inc/nav.php");

?>
    <header>
        <h1>Fiche de l'employee</h1>
    </header>
    <main>
        <div class="fiche text-center">
            <p>Nom :<?= $employer['last_name']; ?></p>
            <p>Prenom : <?= $employer['first_name']; ?></p>
            <p>Date de naissance : <?= $employer['birth_date']; ?></p>
            <p>Genre : <?= $employer['gender']; ?></p>
            <p>Date d'emboche : <?= $employer['hire_date']; ?></p>
        </div>

    </main>
</body>
</html>