<?php
include('Config.php'); // Connexion à la base de données

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Erreur : Vous devez être connecté pour soumettre un avis ou une réclamation.";
    exit();
}

$user_id = $_SESSION['user_id']; // Utiliser `user_id` comme clé pour l'utilisateur
$type = $_POST['type'];
$contenu = trim($_POST['message']);

// Vérification des données
if (empty($contenu)) {
    echo "Erreur : Le message ne peut pas être vide.";
    exit();
}

if ($type !== "avis" && $type !== "reclamation") {
    echo "Erreur : Type invalide.";
    exit();
}

// Vérifier si la connexion à la base de données a réussi
if ($pdo === null) {
    echo "Erreur : Impossible de se connecter à la base de données.";
    exit();
}

// Insérer dans la base de données
$sql = "INSERT INTO avis_reclamations (user_id, type, contenu) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->bindParam(2, $type, PDO::PARAM_STR);
$stmt->bindParam(3, $contenu, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo "Votre " . ($type == "avis" ? "avis" : "réclamation") . " a été soumis avec succès.";
} else {
    echo "Erreur lors de l'enregistrement.";
}

$stmt->closeCursor();
?>
