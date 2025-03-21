<?php
session_start();
include('Config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];
    $user_id = $_SESSION['user_id'];

    // Mettre à jour la notification comme lue
    $query = $pdo->prepare("UPDATE notifications SET status = 'lu' WHERE id = :notification_id AND user_id = :user_id");
    $query->execute(['notification_id' => $notification_id, 'user_id' => $user_id]);

    // Renvoyer le nouveau nombre de notifications non lues
    $countQuery = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = :user_id AND status = 'non_lu'");
    $countQuery->execute(['user_id' => $user_id]);
    $unreadCount = $countQuery->fetchColumn();

    echo json_encode(['success' => true, 'unreadCount' => $unreadCount]);
    exit();
}

echo json_encode(['success' => false]);
exit();
?>