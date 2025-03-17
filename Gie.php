<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface GIE - Gestion des Ordures</title>
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
                <h1>ESPACE GIE</h1>
            </div>

            <!-- Menu déroulant et bouton de déconnexion à droite -->
            <div class="nav-icons">
                <!-- Menu déroulant -->
                <div class="dropdown">
                    <button class="dropbtn" onclick="toggleMenu()">Menu ▼</button>
                    <ul class="dropdown-content" id="dropdownMenu">
                    <li><a href="#">Accueil</a></li>
                <li><a href="#compteGIE">Gestion des Comptes GIE</a></li>
                <li><a href="#tableauBord">Tableau de Bord</a></li>
                <li><a href="#planification">Planification des Collectes</a></li>
                <li><a href="#suiviTempsReel">Suivi en Temps Réel</a></li>
                <li><a href="#paiements">Gestion des Paiements</a></li>
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
            <h1>Bienvenue sur l'interface GIE</h1>
            <p>Gérez vos comptes, planifiez vos collectes, suivez les paiements et consultez vos rapports en temps réel.</p>
        </section>

        <!-- Gestion des Comptes GIE -->
        <section id="compteGIE" class="section">
            <h2>Gestion des Comptes GIE</h2>
            <form>
                <label for="nom">Nom du GIE :</label>
                <input type="text" id="nom" placeholder="Nom du GIE">
                <label for="email">Email :</label>
                <input type="email" id="email" placeholder="email@gie.com">
                <label for="zone">Zone d'Intervention :</label>
                <input type="text" id="zone" placeholder="Ex: Zone 1">
                <button type="submit">Mettre à jour le profil</button>
            </form>
        </section>

        <!-- Tableau de Bord -->
        <section id="tableauBord" class="section">
            <h2>Tableau de Bord</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Demande</th>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>10/03/2025</td>
                        <td>Client 1</td>
                        <td><button class="statut">En attente</button></td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>12/03/2025</td>
                        <td>Client 2</td>
                        <td><button class="statut">Traité</button></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Planification des Collectes -->
        <section id="planification" class="section">
            <h2>Planification des Collectes</h2>
            <form>
                <label for="dateCollecte">Date de Collecte :</label>
                <input type="date" id="dateCollecte">
                <label for="zoneCollecte">Zone :</label>
                <input type="text" id="zoneCollecte" placeholder="Ex: Zone 1">
                <label for="ressource">Ressource Affectée :</label>
                <input type="text" id="ressource" placeholder="Ex: Équipe A">
                <button type="submit">Planifier Collecte</button>
            </form>
        </section>

        <!-- Suivi en Temps Réel -->
        <section id="suiviTempsReel" class="section">
            <h2>Suivi en Temps Réel</h2>
            <p>Suivez la géolocalisation de vos camions et mettez à jour le statut des collectes.</p>
            <table>
                <thead>
                    <tr>
                        <th>Camion</th>
                        <th>Position</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Camion 1</td>
                        <td>Latitude: 48.8566, Longitude: 2.3522</td>
                        <td><button>En cours</button></td>
                    </tr>
                    <tr>
                        <td>Camion 2</td>
                        <td>Latitude: 48.8584, Longitude: 2.2945</td>
                        <td><button>Terminé</button></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Gestion des Paiements -->
        <section id="paiements" class="section">
            <h2>Gestion des Paiements</h2>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Client 1</td>
                        <td>20€</td>
                        <td>10/03/2025</td>
                        <td><button>Payé</button></td>
                    </tr>
                    <tr>
                        <td>Client 2</td>
                        <td>15€</td>
                        <td>12/03/2025</td>
                        <td><button>En attente</button></td>
                    </tr>
                </tbody>
            </table>
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
