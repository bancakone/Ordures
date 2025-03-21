<?php
// Inclure la connexion à la base de données
include('Config.php');

// Vérifier si l'ID de la réclamation et le statut ont été envoyés via le formulaire
if (isset($_POST['id']) && isset($_POST['status'])) {
    // Récupérer l'ID de la réclamation et le nouveau statut
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Mettre à jour le statut de la réclamation dans la table avis_reclamations
    $update_query = $pdo->prepare("UPDATE avis_reclamations SET status = :status WHERE id = :id");
    $update_query->execute(['status' => $status, 'id' => $id]);

    // Récupérer l'ID utilisateur associé à la réclamation
    $reclamation_query = $pdo->prepare("SELECT user_id FROM avis_reclamations WHERE id = :id");
    $reclamation_query->execute(['id' => $id]);
    $reclamation = $reclamation_query->fetch(PDO::FETCH_ASSOC);
    $user_id = $reclamation['user_id'];

    // Créer un message de notification en fonction du statut
    $message = "Votre réclamation a été prise en compte. Nouveau statut : $status.";
    $type = 'info'; // Vous pouvez ajuster le type en fonction du contexte

    // Insérer la notification dans la table notifications
    $notification_query = $pdo->prepare("INSERT INTO notifications (user_id, message, type) VALUES (:user_id, :message, :type)");
    $notification_query->execute([
        'user_id' => $user_id,
        'message' => $message,
        'type' => $type
    ]);

    // Rediriger vers la page des réclamations avec un message de succès
    header("Location: Admin.php?success=1");
    exit;
} else {
    // Si les paramètres ne sont pas envoyés correctement, rediriger avec une erreur
    header("Location: Admin.php?error=1");
    exit;
}
