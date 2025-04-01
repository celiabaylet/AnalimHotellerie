<?php

$hotelModel = new Hotel(); 
$conn = new Database();

// Ajouter un hôtel
if (isset($_POST["ajouter"])) {
    $nomHotel = $_POST["nomHotel"];
    $prixParticipant = $_POST["prixParticipant"];
    $prixPetitDej = $_POST["prixPetitDej"];
    $adresseHotel = $_POST["adresseHotel"];
    $codePostal = $_POST["codePostal"];
    $ville = $_POST["ville"];
    $nbEtoiles = $_POST["nbEtoiles"];
    
    // Validation du nombre d'étoiles
    if (!is_numeric($nbEtoiles) || $nbEtoiles < 1 || $nbEtoiles > 5) {
        echo "Nombre d'étoiles invalide. Veuillez choisir un nombre entre 1 et 5.";
        exit();
    }

    $nbChambresPrises = 0;
    $nbChambresTotales = $_POST["nbChambresTotales"];
    $hotel = new Hotel($nomHotel, $prixParticipant, $prixPetitDej, $adresseHotel, $ville, $codePostal, $nbEtoiles, $nbChambresPrises, $nbChambresTotales);
    $hotel->addHotel();

}

// Supprimer un hôtel
if (isset($_POST["supprimer"]) && isset($_POST["hotelId"])) {
    $id = $_POST["hotelId"];
    $hotelModel->deleteHotel($id);
}

// Modifier un hôtel
if (isset($_POST["modifier"]) && isset($_POST["hotelIdM"])) {
    $id = $_POST["hotelIdM"];
    $nomHotel = $_POST["nomHotel"];
    $prixParticipant = $_POST["prixParticipant"];
    $prixPetitDej = $_POST["prixPetitDej"];
    $adresseHotel = $_POST["adresseHotel"];
    $codePostal = $_POST["codePostal"];
    $ville = $_POST["ville"];
    $nbEtoiles = $_POST["nbEtoiles"];
    
    $hotelModel->updateHotel($id, $nomHotel, $prixParticipant, $prixPetitDej, $adresseHotel, $codePostal, $ville, $nbEtoiles);

}

$hotelList = $hotelModel->getAllHotels($conn);
?>

<form method="post">
    <table>
        <tr>
            <th>Nom</th>    
            <th>Prix du Participant</th>
            <th>Prix du Petit Déjeuner</th>
            <th>Adresse</th>
            <th>Code Postal</th>
            <th>Ville</th>
            <th>Nombre d'étoiles</th>
            <th>Nombre de chambres prises</th>
            <th>Nombre de chambres totales</th>
            <th>Actions</th>
        </tr>
        
        <?php foreach ($hotelList as $hotel) : ?>
            <tr>
                <td><?= $hotel['nomHotel'] ?></td>
                <td><?= $hotel['prixParticipant'] ?></td>
                <td><?= $hotel['prixPetitDej'] ?></td>
                <td><?= $hotel['adresseHotel'] ?></td>
                <td><?= $hotel['codePostal'] ?></td>
                <td><?= $hotel['ville'] ?></td>
                <td>
                    <?php for ($i = 0; $i < $hotel['nbEtoiles']; $i++) echo "⭐"; ?>
                </td>
                <td><?= $hotel['nbChambresPrises'] ?></td>
                <td><?= $hotel['nbChambresTotales'] ?></td>
                <td>
                    <button type="submit" name="supprimer" value="Supprimer">Supprimer</button>
                    <input type="hidden" name="hotelId" value="<?= $hotel['id'] ?>">
                    <button type="submit" name="afficherDetails" value="<?= $hotel['id'] ?>">Modifier</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>

<?php
if (isset($_POST["afficherDetails"])) {
    $id = $_POST["afficherDetails"];
    $hotelDetails = $hotelModel->getHotelById2($conn, $id);
    
    if ($hotelDetails) {
?>
        <h1>Modifier un hôtel</h1>
        <form action="" method="post">
            <input type="hidden" name="hotelIdM" value="<?= $hotelDetails['id'] ?>">
            <label for="nomHotel">Nom de l'hôtel</label>
            <input type="text" name="nomHotel" id="nomHotel" value="<?= $hotelDetails['nomHotel'] ?>"><br>
            <label for="prixParticipant">Prix participant</label>
            <input type="text" name="prixParticipant" id="prixParticipant" value="<?= $hotelDetails['prixParticipant'] ?>"><br>
            <label for="prixPetitDej">Prix petit déjeuner</label>
            <input type="text" name="prixPetitDej" id="prixPetitDej" value="<?= $hotelDetails['prixPetitDej'] ?>"><br>
            <label for="adresseHotel">Adresse</label>
            <input type="text" name="adresseHotel" id="adresseHotel" value="<?= $hotelDetails['adresseHotel'] ?>"><br>
            <label for="codePostal">Code postal</label>
            <input type="text" name="codePostal" id="codePostal" value="<?= $hotelDetails['codePostal'] ?>"><br>
            <label for="ville">Ville</label>
            <input type="text" name="ville" id="ville" value="<?= $hotelDetails['ville'] ?>"><br>
            <label for="nbEtoiles">Nombre d'étoiles</label>
            <select name="nbEtoiles" id="nbEtoiles">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <option value="<?= $i ?>" <?= $hotelDetails['nbEtoiles'] == $i ? 'selected' : '' ?>><?= $i ?> étoiles</option>
                <?php endfor; ?>
            </select><br>
            <input type="submit" name="modifier" value="Modifier un hôtel">
        </form>
        <a href="index.php">Retour à la liste</a>

<?php
    }
} else {
?>
    <h1>Ajouter un hôtel</h1>
    <form action="" method="post">
        <label for="nomHotel">Nom de l'hôtel</label>
        <input type="text" name="nomHotel" id="nomHotel"><br>
        <label for="prixParticipant">Prix participant</label>
        <input type="text" name="prixParticipant" id="prixParticipant"><br>
        <label for="prixPetitDej">Prix petit déjeuner</label>
        <input type="text" name="prixPetitDej" id="prixPetitDej"><br>
        <label for="adresseHotel">Adresse</label>
        <input type="text" name="adresseHotel" id="adresseHotel"><br>
        <label for="codePostal">Code postal</label>
        <input type="text" name="codePostal" id="codePostal"><br>
        <label for="ville">Ville</label>
        <input type="text" name="ville" id="ville"><br>
        <label for="nbEtoiles">Nombre d'étoiles</label>
        <select name="nbEtoiles" id="nbEtoiles">
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?> étoiles</option>
            <?php endfor; ?>
        </select><br>
        <label for="nbChambresTotales">Nombre de chambres totales</label>
        <input type="text" name="nbChambresTotales" id="nbChambresTotales"><br>
        <input type="submit" name="ajouter" value="Ajouter un hôtel">
    </form>
<?php
}
?>
