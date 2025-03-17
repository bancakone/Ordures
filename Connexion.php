<?php
session_start();
require 'config.php'; // Fichier contenant la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];

    try {
        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT id, name, password, role FROM users WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            // Connexion réussie → Stocker l'utilisateur en session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["role"] = $user["role"];

            // Redirection en fonction du rôle
            switch ($user["role"]) {
                case "client":
                    header("Location: Client.php");
                    break;
                case "gie":
                    header("Location: Gie.php");
                    break;
                case "admin":
                    header("Location: Admin.php");
                    break;
                default:
                    header("Location: Accueil.php"); // Page d'accueil si problème
                    break;
            }
            exit();
        } else {
            // Erreur d'identification
            $error = "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $error = "Erreur lors de la connexion : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion des Ordures</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 900px;
            height: 500px; /* Taille fixe pour égaliser les deux côtés */
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .left {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ddd;
        }

        .left img {
            width: 100%;
            height: 70%;
            object-fit: cover; /* Permet à l’image de remplir l’espace sans être déformée */
        }

        .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        .right h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            width: 100%;
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #45a049;
        }

        .register-link {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                height: auto;
            }

            .left {
                height: 250px;
            }

            .left img {
                height: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Partie gauche avec l'image -->
        <div class="left">
            <img src="Image/connexion.jpeg" alt="Connexion">
        </div>

        <!-- Partie droite avec le formulaire -->
        <div class="right">
            <h2>Connexion</h2>
            <form action="Connexion.php" method="POST">
                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-button">Se connecter</button>
            </form>
            <p class="register-link">Pas encore inscrit ? <a href="Inscription.php">Créer un compte</a></p>
        </div>
    </div>

</body>
</html>
