
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

    $sql = "SELECT d.* FROM dept_emp as dept_e join departments as d on dept_e.dept_no = d.dept_no WHERE emp_no = '$id_emp'";
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
        return ['error' => 'Erreur de préparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "sii", $id_dep, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result === false) {
        mysqli_stmt_close($stmt);
        fermer_connexion($connexion);
        return ['error' => 'Erreur lors de l\'exécution de la requête'];
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
    
    // Utilisation d'une requête préparée
    $sql = "SELECT * FROM v_employees_title_current_femme WHERE title = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    
    if ($stmt === false) {
        fermer_connexion($connexion);
        return ['error' => 'Erreur de préparation de la requête'];
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
        return ['error' => 'Erreur de préparation de la requête'];
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
        return ['error' => 'Erreur lors de l\'exécution de la requête'];
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
        return ['error' => 'Erreur de préparation de la requête'];
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
        return ['error' => 'Erreur de préparation de la requête'];
    }
    
    mysqli_stmt_bind_param($stmt, "s", $title);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    fermer_connexion($connexion);
    
    return $row ? (float)$row['moyenne'] : 0;
}

function je_deviens_manager($emp_no){
    $connexion = connexion();
}

function manager_en_cours_dept($dept_no){
    $connexion = connexion();

   $sql = "SELECT * FROM v_manager_dept_current where dept_no = '$dept_no'";
   $result = mysqli_query($connexion, $sql);

    fermer_connexion($connexion);

    return $result;
}


function je_deviens_manager($emp_no){
    $connexion = connexion();
}

function manager_en_cours_dept($dept_no){
    $connexion = connexion();

   $sql = "SELECT * FROM v_manager_dept_current where dept_no = '$dept_no'";
   $result = mysqli_query($connexion, $sql);

    fermer_connexion($connexion);

    return $result;
}


/* function changer_dept($id_dep,$id_emp,$date){
    $connexion = connexion();

    //changer to_date de son ancien departement 
    $dep = son_departement($id_emp);
    $id_de = $dep['dept_no'];
    $sql1 = "update table dept_emp set to_date='$date' where emp_no='$id_emp' and dept_no='$id_de'";
    $result1 = mysql_query($connexion,$sql1);

    // entrer dans son nouvel departement
    $sql = "INSERT INTO dept_emp VALUES ('$id_emp','$id_dep','$date','9999-01-01')";
    $result = mysql_query($connexion,$sql);

    if($result){
        return true;
    } else{
        return false;
    }
    fermer_connexion($connexion);
}
 */
function changer_dept($id_dep, $id_emp, $date) {
    // Validation des paramètres
    if (!is_numeric($id_emp) || !is_numeric($id_dep) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        return false;
    }

    try {
        // Connexion à la base de données (PDO)
        $connexion = connexion(); // Assurez-vous que cette fonction retourne une instance PDO
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Démarrer une transaction
        $connexion->beginTransaction();

        // Récupérer l'ancien département
        $dep = son_departement($id_emp); // Assurez-vous que cette fonction retourne un tableau valide
        if (!$dep || !isset($dep['dept_no'])) {
            throw new Exception("Impossible de récupérer l'ancien département.");
        }
        $id_de = $dep['dept_no'];

        // Mettre à jour to_date de l'ancien département
        $sql1 = "UPDATE dept_emp SET to_date = :date WHERE emp_no = :emp_no AND dept_no = :dept_no";
        $stmt1 = $connexion->prepare($sql1);
        $stmt1->execute([
            ':date' => $date,
            ':emp_no' => $id_emp,
            ':dept_no' => $id_de
        ]);

        // Insérer dans le nouveau département
        $sql2 = "INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES (:emp_no, :dept_no, :from_date, '9999-01-01')";
        $stmt2 = $connexion->prepare($sql2);
        $stmt2->execute([
            ':emp_no' => $id_emp,
            ':dept_no' => $id_dep,
            ':from_date' => $date
        ]);

        // Valider la transaction
        $connexion->commit();
        return true;
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $connexion->rollBack();
        // Log l'erreur si nécessaire (par exemple, dans un fichier de log)
        error_log("Erreur dans changer_dept: " . $e->getMessage());
        return false;
    } finally {
        // Fermer la connexion
        $connexion = null;
    }
}
?>