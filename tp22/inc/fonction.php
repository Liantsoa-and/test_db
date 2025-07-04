
<?php
 include("connexion.php"); 

function manager_en_cours($id_dep){
    $connexion = connexion();

   $sql = "SELECT * FROM v_manager_dept_current WHERE dept_no = '$id_dep'";
   $result = mysqli_query($connexion, $sql);

   $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function son_departement($id_emp){
    $connexion = connexion();

    $sql = "SELECT d.dept_name FROM dept_emp as dept_e join departments as d on dept_e.dept_no = d.dept_no WHERE emp_no = '$id_emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
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

function avoir_employes_dep($id_dep){
    $connexion = connexion();

    $sql = "SELECT dept.dept_no,emp.first_name,emp.last_name,emp.birth_date,emp.gender,emp.hire_date,emp.emp_no
    FROM dept_emp AS dept JOIN employees AS emp ON dept.emp_no = emp.emp_no WHERE dept_no = '$id_dep'";
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

    $sql = "SELECT * FROM salaries WHERE emp_no = '$id_emp' AND to_date != '9999-01-01'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function recherche_emp($emp){
    $connexion = connexion();

    $sql = "SELECT * FROM employees WHERE first_name LIKE '%$emp%' OR first_name LIKE '$emp%' OR first_name LIKE '%$emp' OR last_name LIKE '%$emp%' OR last_name LIKE '$emp%' OR last_name LIKE '%$emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function recherche_employes($nom, $dep, $age_min, $age_max, $offset = 0) {
    $connexion = connexion();

    $conditions = [];
    if (!empty($nom)) {
        $conditions[] = "(first_name LIKE '%$nom%' OR last_name LIKE '%$nom%')";
    }

    if (!empty($age_min)) {
        $conditions[] = "TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= " . intval($age_min);
    }

    if (!empty($age_max)) {
        $conditions[] = "TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) <= " . intval($age_max);
    }

    if (!empty($dep)) {
        $conditions[] = "emp_no IN (
            SELECT emp_no FROM current_dept_emp WHERE dept_no = '$dep'
        )";
    }

    $sql = "SELECT emp_no, first_name, last_name, gender, birth_date, hire_date
            FROM employees";

    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $sql .= " LIMIT 20 OFFSET " . intval($offset);

    $result = mysqli_query($connexion, $sql);
    $retour = [];
    while ($donnes = mysqli_fetch_assoc($result)) {
        $retour[] = $donnes;
    }

    fermer_connexion($connexion);
    return $retour;
}

function getDepartments() {
    $connexion = connexion();

    $sql = "SELECT dept_no, dept_name FROM departments ORDER BY dept_name";
    $result = mysqli_query($connexion, $sql);

    $retour = [];
    while ($ligne = mysqli_fetch_assoc($result)) {
        $retour[] = $ligne;
    }

    fermer_connexion($connexion);
    return $retour;
}

function avoir_histo_titre($id_emp){
    $connexion = connexion();

    $sql = "SELECT * FROM titles WHERE emp_no = '$id_emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

function salaire_en_cours($id_emp){
    $connexion = connexion();

    $sql = "SELECT * FROM salaries WHERE emp_no = '$id_emp' AND to_date = '9999-01-01'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function titre_en_cours($id_emp){
    $connexion = connexion();

    $sql = "SELECT * FROM titles WHERE emp_no = '$id_emp' AND to_date = '9999-01-01'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

 function compter_emp($id_dep){
    $connexion = connexion();

    /* create or replace view v_emp_dept as SELECT dept.dept_no,emp.* FROM 
    dept_emp AS dept JOIN employees AS emp ON dept.emp_no = emp.emp_no */

    $sql = "SELECT count(emp_no) as isa FROM dept_emp WHERE dept_no = '$id_dep' AND to_date='9999-01-01'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
 }

?>