<?php
 include("../inc/fonction.php");
 session_start();
 $id_emp = $_GET['id_emp'];
 $id_dept = $_GET['id_dept'];
 $date = $_GET['date'];
 $changer_dep = changer_dept($id_dept,$id_emp,$date);
 if($changer_dep == true){
    header("Location:fiche.php?id_emp=<?=$id_emp;?>");
    $_SESSION['mes'] = "Changement de departement reussi !!";
 } else{
    header("Location:fiche.php?id_emp=<?=$id_emp;?>");
    $_SESSION['mes'] = "Impossible de changer de departement !!";
 }
?>