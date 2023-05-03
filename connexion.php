<?php
// Définition des constantes de connexion à la base de données
define('DB_HOST', 'mysql.info.unicaen.fr');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASSWORD', '');

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    die();
}
?>