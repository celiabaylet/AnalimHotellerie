<?php

class Hotel
{
    private String $id;

    private String $nomHotel;
    private int $prixParticipant;
    private int $prixPetitDej;
    private String $adresseHotel;
    private String $ville;
    private String $codePostal;
    private int $nbEtoiles;
    private int $nbChambresPrises;
    private int $nbChambresTotales;

    public function __construct(String $nomHotel = '', int $prixParticipant = 0, int $prixPetitDej = 0, String $adresseHotel = '', String $ville = '', String $codePostal = '', int $nbEtoiles = 0, int $nbChambresPrises = 0, int $nbChambresTotales = 0)
    {
        $this->nomHotel = $nomHotel;
        $this->prixParticipant = $prixParticipant;
        $this->prixPetitDej = $prixPetitDej;
        $this->adresseHotel = $adresseHotel;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->nbEtoiles = $nbEtoiles;
        $this->nbChambresPrises = $nbChambresPrises;
        $this->nbChambresTotales = $nbChambresTotales;
    }

    public function getIDHotel()
    {
        return $this->id;
    }
    public function setIDHotel(int $idHotel)
    {
        $this->id = $idHotel;
    }
    public function getNbEtoiles()
    {
        return $this->nbEtoiles;
    }
    public function setNbEtoiles(string $nbEtoiles)
    {
        $this->nbEtoiles = $nbEtoiles;
    }
    public function getNomHotel()
    {
        return $this->nomHotel;
    }
    public function setNomHotel(string $nomHotel)
    {
        $this->nomHotel = $nomHotel;
    }
    public function getAdresse()
    {
        return $this->adresseHotel;
    }
    public function setAdresse(string $adresseHotel)
    {
        $this->adresseHotel = $adresseHotel;
    }
    public function getCodePostal()
    {
        return $this->codePostal;
    }
    public function setCodePostal(string $CP)
    {
        $this->codePostal = $CP;
    }
    public function getVille()
    {
        return $this->ville;
    }
    public function setVille(string $Ville)
    {
        $this->ville = $Ville;
    }
    public function getNbChambresTotales()
    {
        return $this->nbChambresTotales;
    }
    public function setNbChambresTotales(int $nbPlacesTotales)
    {
        $this->nbChambresTotales = $nbPlacesTotales;
    }
    public function getNbChambresPrises()
    {
        return $this->nbChambresPrises;
    }
    public function setNbPlacesR(int $nbPlacesPrises)
    {
        $this->nbChambresPrises = $nbPlacesPrises;
    }
    public function getPrix()
    {
        return $this->prixParticipant;
    }
    public function setPrix(int $prix)
    {
        $this->prixParticipant = $prix;
    }

    public function getPrixPetitDej()
    {
        return $this->prixPetitDej;
    }

    public function setPrixPetitDej(int $prix)
    {
        $this->prixPetitDej = $prix;
    }

    /**
     * getAllHotels : récupère tous les hôtels de la base de données
     *
     * @param  mixed $conn : connexion à la base de données
     * @return void : tous les hôtels récupérés de la base de données exemple : Hilton, 100, 10, 1 rue de la paix, Paris, 75000, 5, 50, 100
     */
    public function getAllHotels($conn)
    {
        include_once('dataBase.php');
        $conn = (new Database())->getConnexion();
        $result = $conn->prepare("SELECT * FROM hotel");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * getHotelById : récupère un hôtel par son id dans la base de données
     *
     * @param  mixed $conn : connexion à la base de données
     * @param  mixed $id : id de l'hôtel à récupérer
     * @return void : hôtel récupéré de la base de données exemple : Hilton, 100, 10, 1 rue de la paix, Paris, 75000, 5, 50, 100 correspondant à l'id 1
     */
    public function getHotelById2($conn, $id)
    {
        include_once('dataBase.php');
        $conn = (new Database())->getConnexion();

        $stmt = $conn->prepare("SELECT * FROM hotel WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * addHotel : ajoute un hôtel dans la base de données
     *
     * @return void : message de succès ou d'erreur
     */
    public function addHotel()
    {
        include_once('dataBase.php');
        $conn = (new Database())->getConnexion();

        // Insérer un nouvel hôtel dans la base de données
        $sql = "INSERT INTO hotel (nomHotel, prixParticipant, prixPetitDej, adresseHotel, ville, codePostal, nbEtoiles, nbChambresTotales, nbChambresPrises) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $this->nomHotel);
        $stmt->bindValue(2, $this->prixParticipant);
        $stmt->bindValue(3, $this->prixPetitDej);
        $stmt->bindValue(4, $this->adresseHotel);
        $stmt->bindValue(5, $this->ville);
        $stmt->bindValue(6, $this->codePostal);
        $stmt->bindValue(7, $this->nbEtoiles);
        $stmt->bindValue(8, $this->nbChambresTotales);
        $stmt->bindValue(9, 0); // Valeur par défaut pour nbChambresPrises


        if ($stmt->execute()) {
            return "Succès"; // Ou renvoyez un message de succès
        } else {
            return "Échec"; // Ou renvoyez un message d'erreur
        }
    }
    /**
     * updateHotel : met à jour un hôtel dans la base de données
     *
     * @param  mixed $id : id de l'hôtel à mettre à jour exemple : 1 si on veut mettre à jour l'hôtel Hilton le nom de l'hôtel sera Platon
     * @return void : message de succès ou d'erreur
     */
    public function updateHotel($id, $nomHotel, $prixParticipant, $prixPetitDej, $adresseHotel, $codePostal, $ville, $nbEtoiles)
{
    include_once('dataBase.php');
    $conn = (new Database())->getConnexion();
    $req = $conn->prepare("UPDATE hotel SET nomHotel = ?, prixParticipant = ?, prixPetitDej = ?, adresseHotel = ?, ville = ?, codePostal = ?, nbEtoiles = ? WHERE id = ?");
    $req->bindValue(1, $nomHotel);
    $req->bindValue(2, $prixParticipant);
    $req->bindValue(3, $prixPetitDej);
    $req->bindValue(4, $adresseHotel);
    $req->bindValue(5, $ville);
    $req->bindValue(6, $codePostal);
    $req->bindValue(7, $nbEtoiles);
    $req->bindValue(8, $id);
    $req->execute();
}

public function getLesHotels()
{
    include "bdd.php";
    $sql = "SELECT * FROM hotel";
    $prep = $conn->prepare($sql);
    $prep->execute();
    $lesHotels = $prep->fetchAll(PDO::FETCH_OBJ);
    return $lesHotels;
}


    /*public function getLesHotels()
    {
        include "bdd.php";
        $sql = "SELECT * FROM hotel";
        $prep = $conn->prepare($sql);
        $prep->execute();
        $lesHotels = $prep->fetchAll(PDO::FETCH_OBJ);
        return $lesHotels;
    }*/

    public function getHotelById($idHotel)
    {
        include "bdd.php";
        $sql = "SELECT nomHotel FROM hotel WHERE id = ?";
        $prep = $conn->prepare($sql);
        $prep->bindValue(1, $idHotel);
        $prep->execute();
        $hotel = $prep->fetch(PDO::FETCH_OBJ);
        return $hotel;
    }


/*
    public function getHotelByEtoiles($nbEtoiles)
    {
        include "bdd.php";
        $sql = "SELECT * FROM hotel WHERE nbEtoiles = ?";
        $prep = $conn->prepare($sql);
        $prep->bindValue(1, $nbEtoiles);
        $prep->execute();
        $hotel = $prep->fetchAll(PDO::FETCH_OBJ);
        return $hotel;
    }
*/

    /**
     * deleteHotel : supprime un hôtel de la base de données
     *
     * @param  mixed $id : id de l'hôtel à supprimer
     * @return void : message de succès ou d'erreur
     */
    public function deleteHotel($id)
    {
        include_once('dataBase.php');
        $conn = (new Database())->getConnexion();
        $sql = "DELETE FROM hotel WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);

        if ($stmt->execute()) {
            return "Succès"; // Ou renvoyez un message de succès
        } else {
            return "Échec"; // Ou renvoyez un message d'erreur
        }
    }

// Dans la classe Hotel.php
public function getHotelAsOption() {
    include_once("bdd.php"); // Connexion à la base de données
    $sql = "SELECT * FROM hotel";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ); // Retourne un tableau d'objets représentant les hôtels
}



}
