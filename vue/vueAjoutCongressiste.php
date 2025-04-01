<?php
// Récupération de tous les congressistes
$congressisteObj = new Congressiste();
$resultat = $congressisteObj->getAllCongressistes();

// Vérifier si un congressiste a été sélectionné via le formulaire
$selectedCongressiste = null;
if (isset($_POST['afficher']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $selectedCongressiste = $congressisteObj->getUnCongressiste($id);
}

// Gestion de l'attribution d'un hôtel
if (isset($_POST['ajouterHotel'])) {
    $idCongressiste = $_POST['idCongressiste'];
    $idHotel = $_POST['idHotel'];
    $petitDej = isset($_POST['petitDej']) ? 1 : 0; // Si le petit déjeuner est sélectionné

    // Logique pour attribuer l'hôtel au congressiste
    $congressisteObj->attribuerHotel($idCongressiste, $idHotel, $petitDej);
}
?>

<!-- Formulaire de sélection de congressiste -->
<form method="post" action="">
    <label for="id">Choisissez un Congressiste</label>
    <select name="id" required>
        <?php
        // Récupération des congressistes sans hôtel
        $congressistes = $congressisteObj->recupUnCongressisteSansHotel();
        if ($congressistes) {
            foreach ($congressistes as $congressiste) {
                $selected = isset($selectedCongressiste) && $selectedCongressiste->id == $congressiste->id ? 'selected' : '';
                echo "<option value='{$congressiste->id}' $selected>{$congressiste->nom} {$congressiste->prenom}</option>";
            }
        } else {
            echo "<option>Aucun congressiste trouvé</option>";
        }
        ?>
    </select>
    <button type="submit" name="afficher">Afficher</button>
</form>

<!-- Affichage des détails du congressiste sélectionné -->
<?php if (isset($selectedCongressiste)) : ?>
    <form method="post" action="">
        <input type="hidden" name="idCongressiste" value="<?= $selectedCongressiste->id ?>">

        <label for="nom">Nom:</label>
        <input type="text" id="nom" value="<?= $selectedCongressiste->nom ?>" readonly>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" value="<?= $selectedCongressiste->prenom ?>" readonly>

        <label for="adresse">Adresse:</label>
        <input type="text" id="adresse" value="<?= $selectedCongressiste->adresse ?>" readonly>

        <label for="codePostal">Code Postal:</label>
        <input type="text" id="codePostal" value="<?= $selectedCongressiste->codePostal ?>" readonly>

        <label for="ville">Ville:</label>
        <input type="text" id="ville" value="<?= $selectedCongressiste->ville ?>" readonly>

        <label for="tel">Téléphone:</label>
        <input type="text" id="tel" value="<?= $selectedCongressiste->tel ?>" readonly>

        <label for="mail">Mail:</label>
        <input type="email" id="mail" value="<?= $selectedCongressiste->mail ?>" readonly>


        <label for="idHotel">Choisissez un Hôtel:</label>
        <select name="idHotel" required>
            <?php
            // Récupération des hôtels depuis la base de données
            $hotelObj = new Hotel();
            $hotels = $hotelObj->getLesHotels(); // Récupération des hôtels
            foreach ($hotels as $hotel) {
                echo "<option value='{$hotel->id}'>" . $hotel->nomHotel . " - " . str_repeat("⭐", $hotel->nbEtoiles) . "</option>";
            }
            ?>
        </select>

        <label>
            Petit Déjeuner
            <input type="checkbox" name="petitDej" value="1" <?= $selectedCongressiste->petitDej ? 'checked' : '' ?>>
        </label>

        <button type="submit" name="ajouterHotel">Attribuer Hôtel</button>
    </form>
<?php endif; ?>
