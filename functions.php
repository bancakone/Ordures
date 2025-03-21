<?php
// functions.php

// Connexion à la base de données
include('config.php'); // Si nécessaire, inclure votre fichier de configuration pour la connexion

// Fonction pour récupérer le nombre de notifications non lues
function getUnreadNotificationCount($user_id) {
    global $pdo;
    
    // Récupérer le nombre de notifications non lues
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM avis_reclamations WHERE user_id = :user_id AND is_read = 0");
    $stmt->execute(['user_id' => $user_id]);
    
    // Retourner le nombre de notifications non lues
    return $stmt->fetchColumn();
}

// Fonction pour récupérer les notifications (exemple avec priorité aux non lues)
function getNotifications($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM avis_reclamations WHERE user_id = :user_id ORDER BY date_creation DESC");
    $stmt->execute(['user_id' => $user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function markNotificationAsRead($notification_id) {
    global $pdo;
    
    // Mettre à jour la notification comme lue
    $stmt = $pdo->prepare("UPDATE avis_reclamations SET is_read = 1 WHERE id = :id");
    $stmt->execute(['id' => $notification_id]);
}


?>
