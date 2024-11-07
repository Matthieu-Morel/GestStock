<?php 

include 'connexion.php';

if(!empty($_POST['nom_produit'])
&& !empty($_POST['id_categorie'])
&& !empty($_POST['qte_produit'])
&& !empty($_POST['prix_produit'])
&& !empty($_POST['date_fabric_produit'])
&& !empty($_POST['date_expir_produit'])
&& !empty($_POST['id_fournisseur'])
){
    $sql = "INSERT INTO produit(nom_produit, id_categorie, qte_produit, prix_produit, date_fabric_produit, date_expir_produit,id_fournisseur)
    VALUES (?,?,?,?,?,?,?)";
    $req = $connexion->prepare($sql);

    $req->execute(array(
        $_POST['nom_produit'],
        $_POST['id_categorie'], 
        $_POST['qte_produit'],
        $_POST['prix_produit'],
        $_POST['date_fabric_produit'],
        $_POST['date_expir_produit'],
        $_POST['id_fournisseur']
    ));

    if($req->rowCount() !== 0){
        $_SESSION['message']['text'] = "article ajouté avec succès";
        $_SESSION['message']['type']= "success";
       /*  echo "Produit ajouté avec succès"; */
    } else {
        $_SESSION['message']['text'] = "Une erreur s'est produite lors de l'ajout du produit";
        $_SESSION['message']['type']= "danger";
       /*  echo "Une erreur s'est produite lors de l'ajout du produit";   */  
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée";
    $_SESSION['message']['type']= "danger";
   /*  echo "Une information obligatoire n'est pas renseignée"; */
}
header('location:../vue/produit.php');
exit();
