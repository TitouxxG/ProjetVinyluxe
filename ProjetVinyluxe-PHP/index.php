<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyluxe</title>
    <link rel="stylesheet" type="text/css" href="stylehtml.css" />
    <link rel="stylesheet" type="text/css" href="assets/style.css" />
</head>
<body>
    <?php include ("Vinyles.php") ?>


    <aside id="SlidingDrawer">
        <?php
        for ($i = 0; $i < 5; $i++) { ?>
            <div class="ProduitSliding">
            <a href="pageproduit.php?id=<?php echo $i; ?>">
            <img src="<?php echo $Vinyles[$i]['img']; ?>" alt="<?php echo $Vinyles[$i]['alt']; ?>">
            </a>
            <p><?php echo "Artiste: " . $Vinyles[$i]['artiste']; ?></p>
            <p><?php echo "Album: " . $Vinyles[$i]['album']; ?></p>
            <p><?php echo "Genre: " . $Vinyles[$i]['genre']; ?></p>
            <p><?php echo "Prix: " . $Vinyles[$i]['prix']; ?></p>
            <a href="pageproduit.php?id=<?php echo $i; ?>"><button type="button">Aller sur la page produit</button></a>
            </div>
        <?php } ?>
                
    </aside>

    <section id="MainContent">
        <!-- Contenu principal ici -->
        <h2> Les Classiques du Rock</h2>

        <div class="MainRock">
            <?php
            foreach ($Vinyles as $index => $i) {
                if ($i['genre'] === 'Rock') { ?>
                    <div class="product">
                    <a href="pageproduit.php?id=<?php echo $index; ?>">
                        <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['alt']; ?>">
                    </a>
                    <p><?php echo "Artiste: " . $i['artiste']; ?></p>
                    <p><?php echo "Album: " . $i['album']; ?></p>
                    <p><?php echo "Prix: " . $i['prix']; ?></p>
                    <a href="pageproduit.php?id=<?php echo $index; ?>"><button type="button">Consulter</button></a>
                    </div>
                <?php   }
            } ?>            
        </div>

        <h2> Les Classiques du Metal</h2>
        <div class="MainMetal">            
            <?php
            foreach ($Vinyles as $index => $i) {
                if ($i['genre'] === 'Metal') { ?>
                    <div class="product">
                    <a href="pageproduit.php?id=<?php echo $index; ?>">
                        <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['alt']; ?>">
                    </a>
                    <p><?php echo "Artiste: " . $i['artiste']; ?></p>
                    <p><?php echo "Album: " . $i['album']; ?></p>
                    <p><?php echo "Prix: " . $i['prix']; ?></p>
                    <a href="pageproduit.php?id=<?php echo $index; ?>"><button type="button">Consulter</button></a>
                    </div>
                <?php   }
            } ?>
        </div>         
            <h2> Les Classiques de la POP</h2>
        <div class="MainPOP">            
            <?php
            foreach ($Vinyles as $index => $i) {
                if ($i['genre'] === 'POP') { ?>
                    <div class="product">
                    <a href="pageproduit.php?id=<?php echo $index; ?>">
                        <img src="<?php echo $i['img']; ?>" alt="<?php echo $i['alt']; ?>">
                    </a>
                    <p><?php echo "Artiste: " . $i['artiste']; ?></p>
                    <p><?php echo "Album: " . $i['album']; ?></p>
                    <p><?php echo "Prix: " . $i['prix']; ?></p>
                    <a href="pageproduit.php?id=<?php echo $index; ?>"><button type="button">Consulter</button></a>
                    </div>
                <?php   }
            } ?>
        </div>
    </section>

</body>
</html>
