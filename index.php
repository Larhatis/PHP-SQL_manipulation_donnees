<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
 <title>Liste des DLC de Cities Skyline</title>
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/item.css">
</head>
<body>
    <?php include('./header.php'); ?>
    <main>

    <h2 class="page-title">Liste des DLC</h2>

    <?php
        //connexion base de donnée
        require_once('connexion.php');

        //tri par ordre chronologique si demandé
        $orderBy = isset($_GET['orderBy']) && $_GET['orderBy'] == 'chronological' ? 'release_date ASC' : 'idD DESC';
    ?>

    <div class="sort">
        <p>Trier par :</p>
        <button onclick="location.href='?orderBy=chronological'" class="btn btn-date-sort">Date de sortie</button>
        <button onclick="location.href='?orderBy=default'" class="btn btn-latest-add">Derniers ajouts</button>
    </div>

    <section>
        <?php
            try {
                //récuperation de la table avec tri
                $query = 'SELECT * FROM dlc ORDER BY ' . $orderBy;
                $stmt = $bdd->query($query);

                //affichage tableau
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <a class="item" href="dlc_details.php?id=<?= $row['idD'] ?>">
                        <h3><?= $row['dlc_name'] ?></h3>
                        <h3><?= $row['price'] ?> €</h3>
                        <?php $date = new DateTime($row['release_date']); ?>
                        <div><?= $date->format('d-m-Y') ?></div>

                    </a>
                    <?php
                }

                //fermeture connexion base de donnée
                $bdd = null;

            } catch(PDOException $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        ?>
    </section>
    <a href="about.html"><button>A propos</button></a>
</main>
</body>
</html>
