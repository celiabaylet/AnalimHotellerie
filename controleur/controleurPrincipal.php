<?php
function controleurPrincipal($action)
{
    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["accueil"] = "accueil.php";
    $lesActions["hotel"] = "hotel.php";

    $lesActions["ajoutCongressiste"] = "ajoutCongressiste.php";
    $lesActions["listeCongressiste"] = "listeCongressiste.php";
    $lesActions["gestionCongressiste"] = "gestionCongressiste.php";


    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}
