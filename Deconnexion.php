<?php
// Démarrer la session pour accéder aux variables de session
session_start();

// Détruire toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger vers la page d'accueil ou la page de connexion
header('Location: Accueil.php'); // Ou rediriger vers login.php si vous avez une page de connexion
exit();
?>
