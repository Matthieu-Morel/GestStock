<?php
$host = "localhost";
$db = "geststock";
$user = "root";
$password = "";

// Options de récupération des données et affichage des messages d'erreur liés à la BDD
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // Active le mode d'erreur exception
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // Définit le mode de récupération par défaut
];

// Connexion à la BDD
try {
    if (!isset($_SESSION['pdo_connection'])) {//on vérifie si le superglobal $_SESSION existe ou si elle n'est pas null
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4;port=3306", $user, $password, $options);//création d'une nouvelle ligne de connexion
        $_SESSION['pdo_connection'] = $pdo;/*stocke l'objet de connexion PDO dans la session.Ce qui permettra de réutiliser la même connexion pour les requêtes futures de cette session.*/      
    }
    $connexion = $_SESSION['pdo_connection'];
} catch (PDOException $e) {//partie qui traite les exceptions(erreur)
    error_log("Erreur de connexion PDO : " . $e->getMessage());
    die("Une erreur est survenue lors de la connexion à la base de données.");
}
?>