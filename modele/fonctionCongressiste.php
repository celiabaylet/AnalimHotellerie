<?php

class Congressiste {
    private string $nom;
    private string $prenom;
    private string $mail;
    private string $adresse;
    private string $ville;
    private string $codePostal;
    private string $tel; 
    private ?Hotel $unHotel; // Propriété nullable
    private int $petitDej;
    private int $nbEtoilesVoulues;

    public function __construct(
        string $nom = '', 
        string $prenom = '', 
        string $mail = '', 
        string $adresse = '', 
        string $ville = '', 
        string $codePostal = '', 
        string $tel = '', 
        int $petitDej = 0, 
        int $nbEtoilesVoulues = 0, 
        Hotel $unHotel = null
    ) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->tel = $tel;
        $this->petitDej = $petitDej;
        $this->nbEtoilesVoulues = $nbEtoilesVoulues;
        $this->unHotel = $unHotel;
    }

    public function addUnCongressiste() {
        include "bdd.php";
    
        // Vérifier si l'hôtel est valide
        $hotel = $this->unHotel;
        if (empty($hotel->getIDHotel())) {
            throw new Exception("L'ID de l'hôtel ne peut pas être vide.");
        }
    
        // Vérifier si l'hôtel existe dans la base de données
        $sql = "SELECT COUNT(*) FROM hotel WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $hotel->getIDHotel());
        $stmt->execute();
        $hotelExist = $stmt->fetchColumn();
    
        if ($hotelExist == 0) {
            throw new Exception("L'hôtel avec l'ID " . $hotel->getIDHotel() . " n'existe pas.");
        }
    
        // Insérer un congressiste dans la base de données
        try {
            $sql = "INSERT INTO congressiste (nom, prenom, mail, adresse, ville, codePostal, tel, id_Hotel, petitDej, nbEtoilesVoulues) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
    
            // Lier les valeurs aux paramètres
            $stmt->bindValue(1, $this->nom);
            $stmt->bindValue(2, $this->prenom);
            $stmt->bindValue(3, $this->mail);
            $stmt->bindValue(4, $this->adresse);
            $stmt->bindValue(5, $this->ville);
            $stmt->bindValue(6, $this->codePostal); 
            $stmt->bindValue(7, $this->tel);
            $stmt->bindValue(8, $hotel->getIDHotel());
            $stmt->bindValue(9, $this->petitDej);
            $stmt->bindValue(10, $this->nbEtoilesVoulues);
    
            // Exécuter la requête
            $stmt->execute();
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function ModifUnCongressiste($id) {
        include "bdd.php";
        
        // Requête de modification
        $sql = "UPDATE congressiste SET nom = ?, prenom = ?, mail = ?, adresse = ?, ville = ?, codePostal = ?, tel = ?, id_Hotel = ?, petitDej = ?, nbEtoilesVoulues = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindValue(1, $this->nom);
        $stmt->bindValue(2, $this->prenom);
        $stmt->bindValue(3, $this->mail);
        $stmt->bindValue(4, $this->adresse);
        $stmt->bindValue(5, $this->ville);
        $stmt->bindValue(6, $this->codePostal);
        $stmt->bindValue(7, $this->tel);
        $stmt->bindValue(8, $this->unHotel ? $this->unHotel->getIDHotel() : null); // Vérifier si l'hôtel est défini
        $stmt->bindValue(9, $this->petitDej);
        $stmt->bindValue(10, $this->nbEtoilesVoulues);
        $stmt->bindValue(11, $id);
        $stmt->execute();
    }

    // Méthode pour mettre à jour l'hôtel du congressiste
    public function updateHotelForCongressiste($congressisteId) {
        include "bdd.php";
        $hotel = $this->unHotel;
        $hotelId = $hotel ? $hotel->getIDHotel() : null;
        
        if (!$hotelId) {
            throw new Exception("Aucun hôtel n'est associé à ce congressiste.");
        }

        $sql = "UPDATE congressiste SET id_Hotel = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $hotelId);
        $stmt->bindValue(2, $congressisteId);
        $stmt->execute();
    }

    public function SupprUnCongressiste($id) {
        include "bdd.php";
        $sql = "DELETE FROM congressiste WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    public function recupUnCongressisteSansHotel() {
        include "bdd.php";
        $sql = "SELECT * FROM congressiste WHERE id_Hotel IS NULL";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUnCongressiste($id) {
        include "bdd.php";
        $sql = "SELECT * FROM congressiste WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function getAllCongressistes() {
        include "bdd.php";
        $sql = "SELECT * FROM congressiste";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllCongressistes2() {
        include "bdd.php";
        $sql = "SELECT c.nom, c.prenom, c.adresse, c.codePostal, c.ville, c.tel, c.mail, c.petitDej, 
                       h.nomHotel AS hotel 
                FROM congressiste c
                LEFT JOIN hotel h ON c.id_Hotel = h.id"; 
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function attribuerHotel($idCongressiste, $idHotel, $petitDej)
    {
        include "bdd.php";
        
        // Vérifier si l'hôtel existe
        $sql = "SELECT COUNT(*) FROM hotel WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $idHotel);
        $stmt->execute();
        $hotelExist = $stmt->fetchColumn();

        if ($hotelExist == 0) {
            throw new Exception("L'hôtel avec l'ID " . $idHotel . " n'existe pas.");
        }

        // Mise à jour de l'hôtel et du petit déjeuner du congressiste
        $sql = "UPDATE congressiste SET id_Hotel = ?, petitDej = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $idHotel);
        $stmt->bindValue(2, $petitDej);
        $stmt->bindValue(3, $idCongressiste);

        if ($stmt->execute()) {
            echo "Hôtel attribué avec succès.";
        } else {
            echo "Échec de l'attribution de l'hôtel.";
        }
    }
}

?>
