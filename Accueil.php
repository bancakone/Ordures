<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Accueil - Gestion des Ordures</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 15px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        /* Diaporama */
        .carousel {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
        }

        .carousel-images {
            display: flex;
            width: 300%;
            height: 100%;
            transition: transform 1s ease-in-out;
        }

        .carousel-images img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        /* Section Hero */
        .hero-section {
            background-color: #f4f4f9;
            text-align: center;
            padding: 4rem 1rem;
        }

        .hero-section h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .cta-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        .cta-button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue sur Gestion des Ordures</h1>
        <nav>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">À propos</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Diaporama -->
    <div class="carousel">
        <div class="carousel-images">
            <img src="Image/image1.webp" alt="Image 1">
            <img src="Image/image2.jpeg" alt="Image 2">
            <img src="Image/image3.jpg" alt="Image 3">
        </div>
    </div>

    <!-- Section Hero -->
    <section class="hero-section">
        <h2>Gérez efficacement vos collectes d'ordures</h2>
        <p>Inscrivez-vous ou connectez-vous pour commencer à utiliser notre plateforme</p>
        <a href="Connexion.php" class="cta-button">S'authentifier</a>
    </section>
    <script>
        let slideIndex = 0;

        function moveSlide() {
            let slides = document.querySelectorAll('.carousel-images img');
            let totalSlides = slides.length;

            slideIndex = (slideIndex ) % totalSlides;

            document.querySelector('.carousel-images').style.transform = `translateX(-${slideIndex * 50}%)`;
        }

        // Défilement automatique toutes les 5 secondes
        setInterval(moveSlide, 1000);
    </script>
</body>
</html>
