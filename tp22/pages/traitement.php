<?php
 include("../inc/fonction.php");
 session_start();

 // changer de departement
 if(isset($_GET['id_emp']) && isset($_GET['id_dept'])){

    $id_emp = $_GET['id_emp'];
    $id_dept = $_GET['id_dept'];
    $date = $_GET['date'];
    unset($_SESSION['id_emp']);
    
    if($changer_dep = changer_dept($id_dept,$id_emp,$date)){
      $_SESSION['mes'] = "Changement de departement reussi !!";
      $_SESSION['id_emp'] = $id_emp;
      header("Location:fiche.php");
   } else {
      $_SESSION['mes'] = "Impossible de changer de departement !!";
      $_SESSION['id_emp'] = $id_emp;
      header("Location:fiche.php");
   }
 }

 // devenir manager
 if(isset($_POST['emp']) && isset($_POST['dept'])){
   $id_emp = $_POST['emp'];
    $id_dept = $_POST['dept'];
    $date = $_POST['date'];
    unset($_SESSION['id_emp']);
    
    if($changer_dep = je_deviens_manager($emp,$dept,$date)){
      $_SESSION['mes'] = "Changement de departement reussi !!";
      $_SESSION['id_emp'] = $emp;
      header("Location:fiche.php");
   } else {
      $_SESSION['mes'] = "Impossible de changer de departement !!";
      $_SESSION['id_emp'] = $emp;
      header("Location:fiche.php");
   }
 }
?>