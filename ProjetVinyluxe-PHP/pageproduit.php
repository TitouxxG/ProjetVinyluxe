<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page produit VinyLuxe</title>
    <link rel="stylesheet" href="stylehtml.css">
</head>
<body>
    <?php include ("Vinyles.php") ?>
    <?php include("header.php");?>

    <?php $vinyle = $Vinyles[$_GET['id']];?>
        <!-- Info du produit de la page -->
    <div id="EnsembleInfoProduit">
        <div id="ImageProduitPrincipal">
            <img src="<?php echo $vinyle['img']; ?>" alt="<?php echo $vinyle['alt']; ?>">
        </div>
        <div id="InfoBasiqueProduit">
            <p><?php echo "Artiste: " . $vinyle['artiste']; ?></p>
            <p><?php echo "Album: " . $vinyle['album']; ?></p>
            <p><?php echo "Genre: " . $vinyle['genre']; ?></p> 
            <p><?php echo "Prix: " . $vinyle['prix']; ?></p>           
        </div>
            <a id="BoutonAjoutProduitPanier" href="panier.html"><button type="button">Ajouter au panier</button></a>
        <div id="DescriptionProduit">
            <b><p>A propos du produit: </p></b>
            <p><?php echo $vinyle['description']; ?></p>
        </div>
    </div>
    

    <!--    Bas de page    -->
    <footer>
        <p>&copy; 2023 Vinyluxe. Tous droits réservés. </p>
    </footer>
</body>
</html>