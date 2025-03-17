<?php
$host = "localhost";
$dbname = "ordures";  // Remplace par ton vrai nom de base
$username = "root";  // Remplace si nécessaire
$password = "";  // Remplace si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
