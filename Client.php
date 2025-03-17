<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Client - Gestion des Ordures</title>
    <!-- Lien vers la bibliothèque Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="CSS/Client.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-container">
            <!-- Infos utilisateur à gauche -->
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <div>
                    <span class="user-name">Jean Dupont</span>
                    <span class="user-email">jean.dupont@email.com</span>
                </div>
            </div>

            <!-- Titre au centre -->
            <div class="title">
                <h1>ESPACE CLIENT</h1>
            </div>

            <!-- Menu déroulant et bouton de déconnexion à droite -->
            <div class="nav-icons">
                <!-- Menu déroulant -->
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

                <!-- Bouton Déconnexion -->
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
    <form>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" placeholder="Nom Complet" value="Jean Dupont">
        <label for="email">Email :</label>
        <input type="email" id="email" placeholder="email@example.com" value="jean.dupont@email.com">
        <label for="telephone">Téléphone :</label>
        <input type="text" id="telephone" placeholder="Numéro de téléphone" value="0123456789">
        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" placeholder="Votre adresse" value="123 Rue Exemple, Paris">
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
    <h2><i class="fas fa-comments"></i> Avis & Réclamations</h2>
    <form>
        <label for="avisService">Laissez un avis :</label>
        <textarea id="avisService" rows="4" placeholder="Écrivez votre avis ici"></textarea>
        <button type="submit">Envoyer Avis</button>
    </form>
</section>

    </main>
    <script>
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
</script>
</body>
</html>
