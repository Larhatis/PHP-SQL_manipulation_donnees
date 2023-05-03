<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du DLC</title>
    <link rel="stylesheet" type="text/css" href="./style/reset.css">
    <link rel="stylesheet" type="text/css" href="./style/style.css">
    <link rel="stylesheet" type="text/css" href="./style/details.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <h2 class="page-title">Détails du DLC</h2>

        <?php
            //connexion base de donnée
            require_once('connexion.php');

            //id pour dlc
            $idD = $_GET['id'];
            try {
                //récupération depuis la base de donnée
                $query = 'SELECT * FROM dlc WHERE idD = :idD';
                $stmt = $bdd->prepare($query);
                $stmt->bindValue(':idD', $idD);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <section>
            <div class="infos">
                <h3><?= htmlspecialchars($row['dlc_name']) ?></h3>
                <p><?= $row['release_date'] ?></p>
            </div>

            <p class="price">
                Prix: <br>
                <?= $row['price'] ?> €
            </p>

            <div class="description">
                <p>Description:</p>
                <p class="description-paragraphe">
                    <?= nl2br(htmlspecialchars($row['description'])) ?>
                </p>
            </div>

            <a class="button" href="dlc_edit.php?id=<?= $idD ?>">Modifier | <img class="icon" src="./public/icons/ecrivez.png" alt="Modifier"></a>


            <?php
                    //fermeture de la connexion à la base de donnée
                    $bdd = null;

                } catch(PDOException $e) {
            ?>
                <p>Erreur : <?= $e->getMessage() ?></p>
            <?php
                }
            ?>
        </section>
        </main>
</body>
</html>
