<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Administrateur - Gestion des Ordures</title>
    <!-- Lien vers la bibliothèque Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 <link rel="stylesheet" href="CSS/Client.css">
</head>
<body>
    <!-- <header>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#utilisateurs">Gestion des Utilisateurs</a></li>
                <li><a href="#collectes">Supervision des Collectes</a></li>
                <li><a href="#tarifs">Gestion des Tarifs</a></li>
                <li><a href="#reclamations">Gestion des Réclamations</a></li>
                <li><a href="#statistiques">Statistiques Générales</a></li>
            </ul>
        </nav>
    </header> -->
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
                <h1>ESPACE ADMIN</h1>
            </div>

            <!-- Menu déroulant et bouton de déconnexion à droite -->
            <div class="nav-icons">
                <!-- Menu déroulant -->
                <div class="dropdown">
                    <button class="dropbtn" onclick="toggleMenu()">Menu ▼</button>
                    <ul class="dropdown-content" id="dropdownMenu">
                    <li><a href="#">Accueil</a></li>
                <li><a href="#utilisateurs">Gestion des Utilisateurs</a></li>
                <li><a href="#collectes">Supervision des Collectes</a></li>
                <li><a href="#tarifs">Gestion des Tarifs</a></li>
                <li><a href="#reclamations">Gestion des Réclamations</a></li>
                <li><a href="#statistiques">Statistiques Générales</a></li>
                    </ul>
                </div>

                <!-- Bouton Déconnexion -->
                <a href="Deconnexion.php" id="deconnexion"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </div>
        </div>
    </nav>
</header>
    <main>
    <section id="utilisateurs" class="section">
    <h2><i class="fas fa-users"></i> Gestion des Utilisateurs</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Client 1</td>
                <td>client1@example.com</td>
                <td>Client</td>
                <td>
                    <button><i class="fas fa-edit"></i> </button>
                    <button><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr>
                <td>GIE 1</td>
                <td>gie1@example.com</td>
                <td>GIE</td>
                <td>
                    <button><i class="fas fa-edit"></i></button>
                    <button><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr>
                <td>Administrateur 1</td>
                <td>admin1@example.com</td>
                <td>Administrateur</td>
                <td>
                    <button><i class="fas fa-edit"></i></button>
                    <button><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<section id="collectes" class="section">
    <h2><i class="fas fa-truck"></i> Supervision des Collectes</h2>
    <p>Suivi global des opérations de collecte, performance des équipes et état des collectes programmées.</p>
    <table>
        <thead>
            <tr>
                <th>ID Collecte</th>
                <th>Date</th>
                <th>Zone</th>
                <th>Équipe</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>10/03/2025</td>
                <td>Zone 1</td>
                <td>Équipe A</td>
                <td><button class="statut">En cours</button></td>
            </tr>
            <tr>
                <td>002</td>
                <td>12/03/2025</td>
                <td>Zone 2</td>
                <td>Équipe B</td>
                <td><button class="statut">Terminé</button></td>
            </tr>
        </tbody>
    </table>
</section>

<section id="tarifs" class="section">
    <h2><i class="fas fa-money-bill-wave"></i> Gestion des Tarifs</h2>
    <form>
        <label for="zone">Zone :</label>
        <input type="text" id="zone" placeholder="Ex: Zone 1">
        <label for="tarif">Tarif de Collecte :</label>
        <input type="number" id="tarif" placeholder="Ex: 10">
        <button type="submit">Enregistrer Tarif</button>
    </form>
</section>

<section id="reclamations" class="section">
    <h2><i class="fas fa-exclamation-circle"></i> Gestion des Réclamations</h2>
    <table>
        <thead>
            <tr>
                <th>ID Réclamation</th>
                <th>Client</th>
                <th>Type de Réclamation</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>R001</td>
                <td>Client 1</td>
                <td>Problème de collecte</td>
                <td><button>En cours</button></td>
            </tr>
            <tr>
                <td>R002</td>
                <td>Client 2</td>
                <td>Problème de facturation</td>
                <td><button>Résolu</button></td>
            </tr>
        </tbody>
    </table>
</section>

<section id="statistiques" class="section">
    <h2><i class="fas fa-chart-line"></i> Statistiques Générales</h2>
    <div class="statistiques">
        <div class="stat">
            <h3>Nombre de Collectes</h3>
            <p>120</p>
        </div>
        <div class="stat">
            <h3>Clients Inscrits</h3>
            <p>50</p>
        </div>
        <div class="stat">
            <h3>Revenus Totaux</h3>
            <p>€500</p>
        </div>
    </div>
    <button>Générer Rapport Complet</button>
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
<!-- Détails des nouvelles sections : -->
<!-- Supervision des Collectes : Permet à l'administrateur de suivre les collectes en cours et terminées. Un tableau avec un statut de chaque collecte est affiché. -->
<!--  -->
<!-- Gestion des Tarifs : Permet à l'administrateur de définir les tarifs pour les collectes en fonction des zones et des types de déchets. Un formulaire est inclus pour entrer de nouveaux tarifs. -->
<!--  -->
<!-- Gestion des Réclamations : Affiche un tableau des réclamations des clients avec un bouton pour suivre leur statut. -->
<!--  -->
<!-- Statistiques Générales : Affiche des statistiques globales sur les collectes, les clients et les revenus. -->