<?php
function connexion(){
    /* $host = 'localhost';
    $user = 'ETU004250';
    $motdepasse = '3AkacJsN';
    $base = 'db_s2_ETU004250'; */
    /* teste */
    $host = 'localhost';
    $user = 'root';
    $motdepasse = '';
    $base = 'employees';
    $bdd = mysqli_connect($host, $user, $motdepasse, $base);

    if(!$bdd){
        echo "Erreur de connexion a la base";
    }

    return $bdd;
}

function fermer_connexion($bdd){
    mysqli_close($bdd);
}