<?php
 include("connexion.php"); 

function manager_en_cours($id_dep){
    $connexion = connexion();

   $sql = "SELECT * FROM dept_manager WHERE to_date = '9999-01-01' AND dept_no = '$id_dep'";
   $result = mysqli_query($connexion, $sql);

   $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function tous_departement (){
   $connexion = connexion();

   $sql = "SELECT * FROM departments";
   $result = mysqli_query($connexion, $sql);

   $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
} 

function avoir_idemployes($id_dep){
    $connexion = connexion();

    $sql = "SELECT * FROM dept_emp WHERE dept_no = '$id_dep'";
    $result = mysqli_query($connexion, $sql);
    $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function avoir_employe($id){
    $connexion = connexion();

    $sql = "SELECT * FROM employees WHERE emp_no = '$id'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function avoir_departement($id){
    $connexion = connexion();

    $sql = "SELECT * FROM departments WHERE dept_no = '$id'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function avoir_histo_salaire($id_emp){
    $connexion = connexion();

    $sql = "SELECT * FROM salaries WHERE emp_no = '$id_emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

?>