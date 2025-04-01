<?php
require "./modele/fonctionCongressiste.php";
require "./modele/classHotel.php";
$hotel = new Hotel();
$resultat = $hotel->getHotelAsOption();
include "./vue/entete.php";
include "./vue/vueGestionCongressiste.php";
include "./vue/pied.php"
?>