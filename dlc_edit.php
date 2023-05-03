<?php
    //lancer le buffuring
    ob_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier les détails du DLC</title>
    <link rel="stylesheet" type="text/css" href="./style/reset.css" >
    <link rel="stylesheet" type="text/css" href="./style/style.css" >
    <link rel="stylesheet" type="text/css" href="./style/form.css" >
</head>
<body>
    <?php include('header.php'); ?>
    <main>
    <h2 class="page-title">Modifier les détails du DLC</h2>

    <?php
        // Connexion à la base de données
        require_once('connexion.php');

        //id du dlc
        $idD = $_GET['id'];

        //si formulaire
        if (isset($_POST['modifier'])) {
            try {
                // mise a jour de la base de données
                $query = 'UPDATE dlc SET dlc_name = :dlc_name, release_date = :release_date, price = :price, description = :description WHERE idD = :idD';
                $stmt = $bdd->prepare($query);
                $stmt->bindValue(':dlc_name', $_POST['dlc_name']);
                $stmt->bindValue(':release_date', $_POST['release_date']);
                $stmt->bindValue(':price', $_POST['price']);
                $stmt->bindValue(':description', $_POST['description']);
                $stmt->bindValue(':idD', $idD);
                $stmt->execute();
    ?>
                <p>Enregistrement modifié avec succès.</p>
    <?php
            } catch(PDOException $e) {
    ?>
                <p>Erreur : <?= $e->getMessage() ?></p>
    <?php
            }
        }

        // si on clique sur le bouton supprimé
        if (isset($_POST['delete_dlc'])) {
            try {
                //suppressions de la base de donnée
                $query = 'DELETE FROM dlc WHERE idD = :idD';
                $stmt = $bdd->prepare($query);
                $stmt->bindValue(':idD', $idD);
                $stmt->execute();
                header("Location: index.php");
                exit;

            } catch(PDOException $e) {
    ?>
                <p>Erreur : <?= $e->getMessage() ?></p>
    <?php
            }
        }

        try {
            //recuperation dans la base de données
            $query = 'SELECT * FROM dlc WHERE idD = :idD';
            $stmt = $bdd->prepare($query);
            $stmt->bindValue(':idD', $idD);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
             <section>
             <h2>Nom du DLC</h2>
             <form class="container" method="post">
            <label for="dlc_name">Nom du DLC:</label>
            <input type="text" id="dlc_name" name="dlc_name" value="<?= htmlspecialchars($row['dlc_name']) ?>">

            <label for="release_date">Date de sortie:</label>
            <input type="date" id="release_date" name="release_date" value="<?= $row['release_date'] ?>">

            <label for="price">Prix:</label>
            <input type="number" id="price" name="price" value="<?= $row['price'] ?>" step="0.01">

            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="10"><?= htmlspecialchars($row['description']) ?></textarea>

            <input class="valider" type="submit" name="modifier" value="Valider">
            </form>
            <form method="post" class="delete-form">
                <input type="submit" name="delete_dlc" value="Supprimer">
            </form>

            </section>
    <?php
            //fermeture base de donnée
            $bdd = null;

        } catch(PDOException $e) {
    ?>
            <p>Erreur : <?= $e->getMessage() ?></p>
    <?php
        }
    ?>

</main>
</body>
</html>
<?php
    //fermeture buffuring
    ob_end_flush();
?>