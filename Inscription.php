<?php
require 'Config.php'; // Connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $address = htmlspecialchars($_POST["address"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hachage sécurisé du mot de passe
    $role = htmlspecialchars($_POST["role"]); // Rôle sélectionné (client, gie, admin)

    try {
        // Insérer l'utilisateur directement avec le rôle
        $stmt = $pdo->prepare("INSERT INTO users (name, phone, address, email, password, role) 
                               VALUES (:name, :phone, :address, :email, :password, :role)");
        $stmt->execute([
            "name" => $name,
            "phone" => $phone,
            "address" => $address,
            "email" => $email,
            "password" => $password,
            "role" => $role // Stockage direct du rôle
        ]);

        // Redirection en fonction du rôle
        switch ($role) {
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

    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion des Ordures</title>
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
        .input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    background-color: #fff;
}
        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            height: 650px;
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
            height: 100%;
            object-fit: cover;
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

        .register-button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-button:hover {
            background-color: #45a049;
        }

        .login-link {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
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
            <img src="Image/inscription.jpeg" alt="Inscription">
        </div>

        <!-- Partie droite avec le formulaire -->
        <div class="right">
            <h2>Inscription</h2>
            <form action="Inscription.php" method="POST">
                <div class="input-group">
                    <label for="name">Nom :</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="phone">Téléphone :</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="input-group">
                    <label for="address">Adresse :</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="input-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
    <label for="role">Rôle :</label>
    <select id="role" name="role" required>
        <option value="" disabled selected>Choisissez un rôle</option>
        <option value="client">Client</option>
        <option value="admin">Admin</option>
        <option value="gie">GIE</option>
    </select>
</div>

                <div class="input-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="register-button">S'inscrire</button>
            </form>
            <p class="login-link">Déjà un compte ? <a href="Connexion.php">Se connecter</a></p>
        </div>
    </div>

</body>
</html>
