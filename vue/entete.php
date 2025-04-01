<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Analim</title>
    <meta charset="utf-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
</head>

<body>

<header>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">Analim</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?action=Accueil">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=hotel">Hotel</a>
                </li>
                <!-- Menu déroulant pour Congressistes -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Congressiste <i class="fas fa-users"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="?action=ajoutCongressiste">Ajouter un congressiste <i class="fas fa-user-plus"></i></a>
                        <a class="dropdown-item" href="?action=gestionCongressiste">Gestion des congressistes <i class="fas fa-cogs"></i></a>
                        <a class="dropdown-item" href="?action=listeCongressiste">Liste des congressistes <i class="fas fa-list"></i></a>
                    </div>
                </li>
            </ul>
            
        </div>
    </nav>
</header>

<!-- Contenu de la page -->
<div class="content">
    <div>
        <!-- Votre contenu ici -->
    </div>
</div>

<!-- Scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>