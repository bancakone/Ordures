<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Rediriger si non connecté
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Inclure le fichier de connexion à la base de données
include('Config.php');

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles valeurs du formulaire
    $new_name = $_POST['nom'];
    $new_email = $_POST['email'];
    $new_phone = $_POST['telephone'];
    $new_address = $_POST['adresse'];

    // Mettre à jour les informations de l'utilisateur dans la base de données
    $query = $pdo->prepare("UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :user_id");
    $query->execute([
        'name' => $new_name,
        'email' => $new_email,
        'phone' => $new_phone,
        'address' => $new_address,
        'user_id' => $user_id
    ]);

    // Message de confirmation
    echo "Profil mis à jour avec succès !";
}

// Récupérer les informations actuelles de l'utilisateur
$query = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Erreur : Utilisateur introuvable.";
    exit();
}

$user_name = $user['name'];
$user_email = $user['email'];
$user_phone = $user['phone'];
$user_address = $user['address'];

// Vérifier les notifications non lues
$notification_query = $pdo->prepare("SELECT * FROM notifications WHERE user_id = :user_id AND status = 'non_lu'");
$notification_query->execute(['user_id' => $user_id]);
$notifications = $notification_query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les notifications de l'utilisateur
$notification_query = $pdo->prepare("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC");
$notification_query->execute(['user_id' => $user_id]);
$notifications = $notification_query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Client - Gestion des Ordures</title>
    <!-- Lien vers la bibliothèque Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="CSS/Client.css">
<style>
    /* .user-info {
    display: flex;
    align-items: center;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    font-family: "Poppins", sans-serif;
    margin-left: 20px;  
}

.user-info i {
    font-size: 50px;
    color: #007bff;
    margin-right: 15px;
}

.user-info div {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.user-email, .user-address {

    font-size: 14px;
    color: #666;
} */
    /* Arrière-plan sombre lors de l'affichage du modal */
.modal {
    display: none; /* Caché par défaut */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    overflow: auto;
}

/* Contenu du modal */
.modal-content {
    background-color: white;
    margin: 10% auto;
    padding: 30px;
    border-radius: 10px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    position: relative;
}

/* Bouton de fermeture */
.close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 20px;
    font-weight: bold;
    color: #777;
    cursor: pointer;
}

.close:hover {
    color: black;
}

/* Liste des notifications */
#notificationList {
    list-style-type: none;
    padding: 0;
    max-height: 300px;
    overflow-y: auto;
}

/* Style des notifications */
.notification-item {
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 5px;
    transition: background 0.3s, transform 0.2s;
    cursor: pointer;
}

/* Notification non lue (rouge) */
.notification-unread {
    background-color: #ffebee;
    border-left: 5px solid #e57373;
}

/* Notification lue (vert) */
.notification-read {
    background-color: #e8f5e9;
    border-left: 5px solid #66bb6a;
}

/* Effet au survol */
.notification-item:hover {
    transform: scale(1.02);
}

</style>
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <div>
                    <span class="user-name"><?php echo htmlspecialchars($user_name); ?></span>
                    <span class="user-email"><?php echo htmlspecialchars($user_email); ?></span>
                    <span class="user-address"><?php echo htmlspecialchars($user_address); ?></span>
                </div>
            </div>
            <div class="title">
                <h1>ESPACE CLIENT</h1>
            </div>
            <div class="nav-icons">
                <!-- Notifications -->
                <div class="notifications">
                    <button id="openNotificationsModal" onclick="openNotificationsModal()">
                        <i class="fas fa-bell"></i>
                        <?php
                        // Récupérer le nombre de notifications non lues
                        $query = "SELECT COUNT(*) FROM notifications WHERE user_id = :user_id AND status = 'non_lu'";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute(['user_id' => $_SESSION['user_id']]);
                        $unreadCount = $stmt->fetchColumn();
                        ?>
                        <?php if ($unreadCount > 0): ?>
                            <span class="badge"><?php echo $unreadCount; ?></span>
                        <?php endif; ?>
                    </button>
                </div>


                <div class="dropdown">
                    <button class="dropbtn" onclick="toggleMenu()">Menu ▼</button>
                    <ul class="dropdown-content" id="dropdownMenu">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#modifierProfil">Modifier Profil</a></li>
                        <li><a href="#demandeCollecte">Demande de Collecte</a></li>
                        <li><a href="#suiviDemande">Suivi des Demandes</a></li>
                        <li><a href="#paiement">Système de Paiement</a></li>
                        <li><a href="#avis">Avis & Réclamations</a></li>
                    </ul>
                </div>

                <a href="Deconnexion.php" id="deconnexion"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </nav>
</header>

    <main>
        <!-- Section d'Accueil -->
        <section class="intro">
            <h1>Bienvenue dans l'interface Client</h1>
            <p>Gérez vos demandes de collecte, suivez vos paiements et laissez des avis sur les services.</p>
        </section>

        <section id="modifierProfil" class="section">
    <h2><i class="fas fa-user-edit"></i> Modifier Profil</h2>
    <form action="" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" placeholder="Nom Complet" value="<?php echo htmlspecialchars($user_name); ?>">
        
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="email@example.com" value="<?php echo htmlspecialchars($user_email); ?>">
        
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" name="telephone" placeholder="Numéro de téléphone" value="<?php echo htmlspecialchars($user_phone); ?>">
        
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse" placeholder="Votre adresse" value="<?php echo htmlspecialchars($user_address); ?>">
        
        <button type="submit">Mettre à jour le profil</button>
    </form>
</section>


<section id="demandeCollecte" class="section">
    <h2><i class="fas fa-trash-alt"></i> Demande de Collecte</h2>
    <form>
        <label for="date">Date de Collecte :</label>
        <input type="date" id="date">
        <label for="heure">Heure :</label>
        <input type="time" id="heure">
        <label for="typeDechets">Type de Déchets :</label>
        <input type="text" id="typeDechets" placeholder="Ex : Déchets ménagers">
        <label for="adresseCollecte">Adresse de Collecte :</label>
        <input type="text" id="adresseCollecte" placeholder="Ex : 123 Rue Exemple">
        <button type="submit">Demander la collecte</button>
    </form>
</section>

<section id="suiviDemande" class="section">
    <h2><i class="fas fa-clipboard-list"></i> Suivi des Demandes</h2>
    <table>
        <thead>
            <tr>
                <th>ID Demande</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>10/03/2025</td>
                <td><button class="en-attente">En attente</button></td>
            </tr>
            <tr>
                <td>002</td>
                <td>12/03/2025</td>
                <td><button class="termine">Terminé</button></td>
            </tr>
        </tbody>
    </table>
</section>


<section id="paiement" class="section">
    <h2><i class="fas fa-credit-card"></i> Système de Paiement</h2>
    <table>
        <thead>
            <tr>
                <th>Montant</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>15€</td>
                <td>10/03/2025</td>
                <td><button class="termine">Payé</button></td>
            </tr>
            <tr>
                <td>20€</td>
                <td>12/03/2025</td>
                <td><button class="en-attente">En attente</button></td>
            </tr>
        </tbody>
    </table>
</section>


<section id="avis" class="section">
    <h2><i class="fas fa-comments"></i> Avis</h2>
    <form id="avisForm">
        <label for="avisService">Laissez un avis :</label>
        <textarea id="avisService" name="message" rows="4" placeholder="Écrivez votre avis ici"></textarea>
        <input type="hidden" name="type" value="avis">
        <button type="submit">Envoyer</button>
    </form>
</section>

<section id="reclamation" class="section">
    <h2><i class="fas fa-comments"></i> Réclamations</h2>
    <form id="reclamationForm">
        <label for="reclamationService">Laissez une réclamation :</label>
        <textarea id="reclamationService" name="message" rows="4" placeholder="Écrivez votre réclamation ici"></textarea>
        <input type="hidden" name="type" value="reclamation">
        <button type="submit">Envoyer</button>
    </form>
</section>

<!-- Boîte modale de confirmation -->
<div id="confirmationModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalMessage"></p>
    </div>
</div>
<!-- Le Modal des notifications -->
<div id="notificationsModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeNotificationsModal()">&times;</span>
        <h2>Notifications</h2>
        <ul id="notificationList">
            <?php foreach ($notifications as $notification): ?>
                <li class="notification-item <?php echo empty($notification['read_at']) ? 'notification-unread' : 'notification-read'; ?>" 
                    onclick="markAsRead(<?php echo $notification['id']; ?>)">
                    <p><?php echo htmlspecialchars($notification['message']); ?></p>
                    <small>Le <?php echo htmlspecialchars($notification['created_at']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>


    </main>
    <script>
        // Le menu
    function toggleMenu() {
        let menu = document.getElementById("dropdownMenu");
        menu.classList.toggle("show");
    }

    // Ferme le menu si on clique en dehors
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            let dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    // La boite modale 
    document.addEventListener("DOMContentLoaded", function () {
    function submitForm(formId) {
        let form = document.getElementById(formId);
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêcher le rechargement de la page

            let formData = new FormData(form);

            fetch("Avis_Reclamation.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Afficher un message de succès ou d'erreur dans la modale
                document.getElementById("modalMessage").innerText = data;
                document.getElementById("confirmationModal").style.display = "block";
                form.reset(); // Réinitialiser le formulaire après l'envoi
            })
            .catch(error => {
                console.error("Erreur:", error);
                document.getElementById("modalMessage").innerText = "Une erreur s'est produite. Veuillez réessayer.";
                document.getElementById("confirmationModal").style.display = "block";
            });
        });
    }

    submitForm("avisForm");
    submitForm("reclamationForm");

    // Fermer la boîte modale
    document.querySelector(".close").addEventListener("click", function () {
        document.getElementById("confirmationModal").style.display = "none";
    });

    window.onclick = function (event) {
        let modal = document.getElementById("confirmationModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});

function markAsRead(notificationId) {
    fetch("Marquer_notification.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "notification_id=" + notificationId
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Modifier visuellement la notification pour marquer comme lue
            let notificationItem = document.querySelector(`[onclick="markAsRead(${notificationId})"]`);
            if (notificationItem) {
                notificationItem.classList.remove("notification-unread");
                notificationItem.classList.add("notification-read");
            }

            // Mettre à jour le badge de la cloche
            let badge = document.querySelector(".badge");
            if (badge) {
                if (data.unreadCount > 0) {
                    badge.textContent = data.unreadCount;
                } else {
                    badge.style.display = "none"; // Cacher le badge si aucune notification non lue
                }
            }
        }
    })
    .catch(error => console.error("Erreur:", error));
}


function openNotificationsModal() {
    let modal = document.getElementById("notificationsModal");
    if (modal) {
        modal.style.display = "block";
    }

    // Marquer toutes les notifications comme lues
    fetch("Marquer_notification.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "mark_all_as_read=true"
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelectorAll(".notification-unread").forEach(el => {
                el.classList.remove("notification-unread");
                el.classList.add("notification-read");
            });

            let badge = document.querySelector(".badge");
            if (badge) {
                badge.style.display = "none";
            }
        }
    })
    .catch(error => console.error("Erreur:", error));
}


// Fonction pour fermer la modale
function closeNotificationsModal() {
    let modal = document.getElementById("notificationsModal");
    if (modal) {
        modal.style.display = "none";
    }
}

// Ferme la boîte si on clique en dehors
window.onclick = function(event) {
    let modal = document.getElementById("notificationsModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
};



</script>
</body>
</html>
