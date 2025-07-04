
<?php
 include("connexion.php"); 

function manager_en_cours(){
    $connexion = connexion();

   $sql = "SELECT * FROM v_manager_dept_current order by dept_name";
   $result = mysqli_query($connexion, $sql);

    fermer_connexion($connexion);

    return $result;
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

    $sql = "SELECT * FROM v_employees_dept_current WHERE dept_no = '$id_dep'";
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

    $sql = "SELECT * FROM salaries WHERE emp_no = '$id_emp' AND to_date != '9999-01-01' order by from_date asc";
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

    $sql = "SELECT * FROM v_employees_title WHERE emp_no = '$id_emp' AND to_date='9999-01-01' order by from_date asc";
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

    $sql = "SELECT * FROM v_employees_salarie_current WHERE emp_no = '$id_emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function titre_en_cours($id_emp){
    $connexion = connexion();

    $sql = "SELECT * FROM v_employees_title_current WHERE emp_no = '$id_emp'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function compter_emp($id_dep){
    $connexion = connexion();

    $sql = "SELECT count(emp_no) as isa FROM v_employees_dept_current WHERE dept_no = '$id_dep'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function job_longest_duration($emp_no){
    $connexion = connexion();
    $sql = "SELECT first_name, last_name, title, duration
            FROM v_employee_job_duration
            WHERE emp_no = $emp_no
            ORDER BY duration DESC
            LIMIT 1";

    $result = mysqli_query($connexion, $sql);

    if (!$result || mysqli_num_rows($result) === 0) {
        fermer_connexion($connexion);
        return null;
    }

    $donnees = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnees; 
}

function employe_femme_dept($id_dep){
     $connexion = connexion();

    $sql = "SELECT * FROM v_employees_dept_femmme WHERE dept_no = '$id_dep'";
    $result = mysqli_query($connexion, $sql);
    $retour = [];
    while ($donnes = mysqli_fetch_assoc($result)) {
        $retour[] = $donnes;
    }
    
    fermer_connexion($connexion);

    return $retour;
}

function employe_homme_dept($id_dep){
     $connexion = connexion();

    $sql = "SELECT * FROM v_employees_dept_homme WHERE dept_no = '$id_dep'";
    $result = mysqli_query($connexion, $sql);
    $retour = [];
    while ($donnes = mysqli_fetch_assoc($result)) {
        $retour[] = $donnes;
    }
    
    fermer_connexion($connexion);

    return $retour;
}

?>