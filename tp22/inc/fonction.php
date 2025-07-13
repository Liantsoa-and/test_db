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

    $sql = "SELECT dept_no,dept_name from v_employees_dept_current WHERE emp_no = '$id_emp'";
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

function avoir_employes_dep($id_dep, $page) {
    $connexion = connexion();
    
    $page = max(1, (int)$page);
    $limit = 20;
    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM v_employees_dept_current WHERE dept_no = ? LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de preparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "sii", $id_dep, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result === false) {
        mysqli_stmt_close($stmt);
        fermer_connexion($connexion);
        return ['error' => 'Erreur lors de l\'execution de la requête'];
    }
    
    $retour = [];
    while ($donnees = mysqli_fetch_assoc($result)) {
        $retour[] = $donnees;
    }
    
    mysqli_stmt_close($stmt);
    mysqli_free_result($result);
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

function employe_femme_title($title) {
    $connexion = connexion();
    
    $sql = "SELECT * FROM v_employees_title_current_femme WHERE title = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de preparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $retour = [];
    while ($donnees = mysqli_fetch_assoc($result)) {
        $retour[] = $donnees;
    }
    
    mysqli_stmt_close($stmt);
    fermer_connexion($connexion);
    
    return $retour;
}

function employe_homme_title($title) {
    $connexion = connexion();
    
    $sql = "SELECT * FROM v_employees_title_current_homme WHERE title = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de preparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $retour = [];
    while ($donnees = mysqli_fetch_assoc($result)) {
        $retour[] = $donnees;
    }
    
    mysqli_stmt_close($stmt);
    fermer_connexion($connexion);
    
    return $retour;
}

function avoir_dif_titre() {
    $connexion = connexion();
    
    $sql = "SELECT DISTINCT title FROM titles";
    $result = mysqli_query($connexion, $sql);
    
    if ($result === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur lors de l\'execution de la requête'];
    }
    
    $retour = [];
    while ($donnees = mysqli_fetch_assoc($result)) {
        $retour[] = $donnees['title']; 
    }
    
    mysqli_free_result($result);
    fermer_connexion($connexion);
    
    return $retour;
}

function salaire_moyenne_dept($id_dep) {
    $connexion = connexion();
    
    $sql = "SELECT AVG(salary) AS moyenne FROM v_emp_dept_salari_current WHERE dept_no = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de preparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "s", $id_dep);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    fermer_connexion($connexion);
    
    return $row ? (float)$row['moyenne'] : 0;
}

function salaire_moyenne_title($title) {
    $connexion = connexion();
    
    $sql = "SELECT AVG(salary) AS moyenne FROM v_emp_title_salari_current WHERE title = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de preparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    fermer_connexion($connexion);
    
    return $row ? (float)$row['moyenne'] : 0;
}

function manager_en_cours_dept($id_dept){
    $connexion = connexion();

    $sql = "select * from v_manager_dept_current where dept_no='$id_dept'";
    $result = mysqli_query($connexion,$sql);
    fermer_connexion($connexion);

    return $result;

}

function manager_dept($id_dept){
    $connexion = connexion();

    $sql = "SELECT * FROM v_manager_dept_current WHERE dept_no = '$id_dept' AND to_date = '9999-01-01'";
    $result = mysqli_query($connexion, $sql);
    $donnes = mysqli_fetch_assoc($result);
    fermer_connexion($connexion);

    return $donnes;
}

function je_deviens_manager($emp_no, $id_dept, $date) {
    $connexion = connexion();
    if (!$connexion) {
        return false;
    }

    // mettre fin a la place de manager a l'ancien manger en cours
    $ancien_manager = manager_en_cours_dept($id_dept);
    $id_ancien = $ancien_manager ? mysqli_fetch_assoc($ancien_manager)['emp_no'] : null;

    $sql1 = "UPDATE dept_manager SET to_date = ? WHERE emp_no = ? AND dept_no = ? AND to_date = '9999-01-01'";
    $stmt1 = mysqli_prepare($connexion, $sql1);
    mysqli_stmt_bind_param($stmt1, "sis", $date, $id_ancien, $id_dept);
    $result1 = mysqli_stmt_execute($stmt1);
    mysqli_stmt_close($stmt1);

    $sql2 = "UPDATE titles SET to_date = ? WHERE emp_no = ? AND to_date = '9999-01-01'";
    $stmt2 = mysqli_prepare($connexion, $sql2);
    mysqli_stmt_bind_param($stmt2, "si", $date, $id_ancien);
    $result2 = mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    // mettre fin a l'ancien titre de $emp_no
    $sql11 = "UPDATE dept_emp SET to_date = ? WHERE emp_no = ? AND dept_no = ? AND to_date = '9999-01-01'";
    $stmt11 = mysqli_prepare($connexion, $sql11);
    mysqli_stmt_bind_param($stmt11, "sis", $date, $emp_no, $id_dept);
    $result11 = mysqli_stmt_execute($stmt11);
    mysqli_stmt_close($stmt11);

    $sql22 = "UPDATE titles SET to_date = ? WHERE emp_no = ? AND to_date = '9999-01-01'";
    $stmt22 = mysqli_prepare($connexion, $sql22);
    mysqli_stmt_bind_param($stmt22, "si", $date, $emp_no);
    $result22 = mysqli_stmt_execute($stmt22);
    mysqli_stmt_close($stmt22); 

    // mettre a jour hire_date
        $sql11 = "UPDATE employees SET hire_date = ? WHERE emp_no = ?";
        $stmt11 = mysqli_prepare($connexion, $sql11);
        mysqli_stmt_bind_param($stmt11, "si", $date, $emp_no);
        $result11 = mysqli_stmt_execute($stmt11);
        mysqli_stmt_close($stmt11);


    // inserer le $emp_no etant nouveau manager de $id_dept
    if ($result1) {
        $sql3 = "INSERT INTO dept_manager (emp_no, dept_no, from_date, to_date) VALUES (?, ?, ?, '9999-01-01')";
        $stmt3 = mysqli_prepare($connexion, $sql3);
        mysqli_stmt_bind_param($stmt3, "iss", $emp_no, $id_dept, $date);
        $result3 = mysqli_stmt_execute($stmt3);
        mysqli_stmt_close($stmt3);

        $title = "Manager";
        $sql4 = "INSERT INTO titles (emp_no, title, from_date, to_date) VALUES (?, ?, ?, '9999-01-01')";
        $stmt4 = mysqli_prepare($connexion, $sql4);
        mysqli_stmt_bind_param($stmt4, "iss", $emp_no, $title, $date);
        $result4 = mysqli_stmt_execute($stmt4);
        mysqli_stmt_close($stmt4);

        fermer_connexion($connexion);
        return $result3 && $result4;
    }

    fermer_connexion($connexion);
    return false;
}

function changer_dept($id_dept, $id_emp, $date) {
    $connexion = connexion();
    if (!$connexion) {
        return false;
    }

    $dep = son_departement($id_emp);
    $id_dep = $dep ? $dep['dept_no'] : null;

    if ($id_dep) {
        // mettre fin a sa place dans son ancien departement
        $sql1 = "UPDATE dept_emp SET to_date = ? WHERE emp_no = ? AND dept_no = ? AND to_date = '9999-01-01'";
        $stmt1 = mysqli_prepare($connexion, $sql1);
        mysqli_stmt_bind_param($stmt1, "sis", $date, $id_emp, $id_dep);
        $result1 = mysqli_stmt_execute($stmt1);
        mysqli_stmt_close($stmt1);

        // mettre a jour hire_date
        $sql11 = "UPDATE employees SET hire_date = ? WHERE emp_no = ?";
        $stmt11 = mysqli_prepare($connexion, $sql11);
        mysqli_stmt_bind_param($stmt11, "si", $date, $id_emp);
        $result11 = mysqli_stmt_execute($stmt11);
        mysqli_stmt_close($stmt11);

        // inserer les donnes ou $id_emp change de departement en $id_dept
        if ($result1) {
            $sql2 = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES (?, ?, ?, '9999-01-01')";
            $stmt2 = mysqli_prepare($connexion, $sql2);
            mysqli_stmt_bind_param($stmt2, "iss", $id_emp, $id_dept, $date);
            $result2 = mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);

            fermer_connexion($connexion);
            return $result2;
        }
    }

    fermer_connexion($connexion);
    return false;
}

function pas_tous_departement($id_emp){
    $connexion = connexion();

    $son_dept = son_departement($id_emp);
    $id_son_dept = $son_dept['dept_no'];

   $sql = "SELECT * FROM departments where dept_no != '$id_son_dept'";
   $result = mysqli_query($connexion, $sql);

   $retour = [];
    while($donnes = mysqli_fetch_assoc($result)){
        $retour[] = $donnes;
    }
    fermer_connexion($connexion);

    return $retour;
}

?>