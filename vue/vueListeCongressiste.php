<?php 

$congressiste = new Congressiste();
$resultat = $congressiste->getAllCongressistes2(); 
?>

<div class="tabCard">
    <div class="tabCardbg">
        <table class="table-css">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Petit Déjeuner</th> <!-- Ajout de la colonne Petit Déjeuner -->
                    <th>Hôtel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($resultat as $row): ?>
                    <tr>
                        <td><?php echo $row->nom; ?></td>
                        <td><?php echo $row->prenom; ?></td>
                        <td><?php echo $row->adresse; ?></td>
                        <td><?php echo $row->codePostal; ?></td> <!-- Correction de "CP" en "codePostal" -->
                        <td><?php echo $row->ville; ?></td>
                        <td><?php echo $row->tel; ?></td>
                        <td><?php echo $row->mail; ?></td>
                        <td><?php echo $row->petitDej == 1 ? 'Oui' : 'Non'; ?></td> <!-- Ajout de l'affichage de l'état du petit déjeuner -->
                        <td><?php echo isset($row->hotel) ? $row->hotel : "Aucun hôtel"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
