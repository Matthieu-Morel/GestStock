<?php

include 'header.php';
require_once '../model/functions.php';
// Récupération de toutes les catégories et fournisseurs
$categories = getCategories(); //  fonction qui retourne toutes les catégories
$fournisseurs = getFournisseurs(); //  fonction qui retourne tous les fournisseurs

// Récupération de tous les produits 
$produit = null;
if(!empty($_GET['id'])){
    $produit = getProduit($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($produit) ?"../model/modifProduit.php" : "../model/ajoutProduit.php" ?>" method="post">
                <label for="nom_produit">Nom du produit</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['nom_produit']) : '' ?>" type="text" id="nom_produit" name="nom_produit" placeholder="Veuillez saisir le nom" required>
            
                
                <label for="id_categorie">Catégorie</label>
                <select name="id_categorie" id="id_categorie">
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id_categorie'] ?>" <?= (!empty($produit) && $produit['id_categorie'] == $categorie['id_categorie']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categorie['nom_categorie']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="quantite_produit">Quantité</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['quantite_produit']) : '' ?>" type="number" id="quantite_produit" name="quantite_produit" placeholder="Veuillez saisir la quantité">

                <label for="prix_unitaire">Prix unitaire</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['prix_unitaire']) : '' ?>" type="number" id="prix_unitaire" name="prix_unitaire" placeholder="Veuillez saisir le prix unitaire" step="0.01">

                <label for="date_fabrication">Date de fabrication</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['date_fabrication']) : '' ?>" type="datetime-local" id="date_fabrication" name="date_fabrication">

                <label for="date_expiration">Date d'expiration</label>
                <input value="<?= !empty($produit) ? htmlspecialchars($produit['date_expiration']) : '' ?>" type="datetime-local" id="date_expiration" name="date_expiration">

                <label for="id_fournisseur">Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur">
                    <?php foreach ($fournisseurs as $fournisseur): ?>
                        <option value="<?= $fournisseur['id_fournisseur'] ?>" <?= (!empty($produit) && $produit['id_fournisseur'] == $fournisseur['id_fournisseur']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($fournisseur['nom_fournisseur']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (!empty($produit)): ?>
                    <input type="hidden" name="id_produit" value="<?= $produit['id_produit'] ?>">
                <?php endif; ?>

                <button type="submit"><?= !empty($produit) ? 'Modifier' : 'Ajouter' ?></button>

                
            </form>
            <?php
            if (isset($_SESSION['message'])) {
    echo "<!-- Message présent dans la session: ";
    print_r($_SESSION['message']);
    echo " -->";
}

if (isset($_SESSION['message'])) {
    ?>
    <div class="alert <?= $_SESSION['message']['type'] ?>">
        <?= $_SESSION['message']['text'] ?>
    </div>
    <?php
    unset($_SESSION['message']);
}
                ?>
        </div>
<?php 
//PARTIE QUI PERMET D'AFFICHER TOUS LES PRODUITS
?>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom Produit</th>
                    <th>Categorie</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Date de fabrication</th>
                    <th>Date d'expiration</th>
                    <th>Action</th>       
                </tr>

                <?php
                $produits = getProduit();
                if(!empty($produits) && is_array($produits)){
                    foreach($produits as $produit){
                        ?>
                        <tr>
                            <td><?= $produit['nom_produit'] ?></td>
                            <td><?= $produit['nom_categorie'] ?></td>
                            <td><?= $produit['qte_produit'] ?></td>
                            <td><?= $produit['prix_produit'] ?></td>
                            <td><?= date('d/m/y H:m',strtotime($produit['date_fabric_produit'])) ?></td>
                            <td><?= date('d/m/y H:m',strtotime($produit['date_expir_produit'])) ?></td>
                            <td><a href="?id=<?=$produit['nom_fournisseur']?>"><i class='bx bx-edit-alt'></i></a></td>
                        </tr>
                       
                        <?php
                    }   
                }               
                ?>
            </table>
        </div>
    </div>
</div>
</section>
<?php
include 'footer.php'
?>