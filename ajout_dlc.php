<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout d'un DLC</title>
    <link rel="stylesheet" href="./style/reset.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/form.css">
    
</head>
<body>
    <?php include('header.php'); ?>
    <main>

    <h1>Ajout d'un DLC</h1>

        <?php
        if (isset($_POST['ajouter'])) {
            //Verification des données du formulaire
            $erreur = false;
            $messageErreur = '';

            if (empty($_POST['dlc_name'])) {
                $erreur = true;
                $messageErreur .= '<li>Le nom du DLC est obligatoire.</li>';
            }
            if (empty($_POST['release_date'])) {
                $erreur = true;
                $messageErreur .= '<li>La date de sortie est obligatoire.</li>';
            }
            if (empty($_POST['price'])) {
                $erreur = true;
                $messageErreur .= '<li>Le prix est obligatoire.</li>';
            } elseif (!is_numeric($_POST['price'])) {
                $erreur = true;
                $messageErreur .= '<li>Le prix doit être un nombre.</li>';
            }
            if (empty($_POST['description'])) {
                $erreur = true;
                $messageErreur .= '<li>La description est obligatoire.</li>';
            }

            if ($erreur) {
                echo '<div style="background-color: #ffbbbb; border: 1px solid #ff0000; padding: 10px; margin-bottom: 10px;"><ul>' . $messageErreur . '</ul></div>';
            }
    else {
                try {
                    //Connexion à la base de données
                    require_once('connexion.php');

                    //insertion dans la base de données
                    $query = 'INSERT INTO dlc (dlc_name, release_date, price, description) VALUES (:dlc_name, :release_date, :price, :description)';
                    $stmt = $bdd->prepare($query);
                    $stmt->bindValue(':dlc_name', $_POST['dlc_name']);
                    $stmt->bindValue(':release_date', $_POST['release_date']);
                    $stmt->bindValue(':price', $_POST['price']);
                    $stmt->bindValue(':description', $_POST['description']);
                    $stmt->execute();

                    echo '<p>Le DLC ajouté avec succès.</p>';

                    //fermeture base de donnée
                    $bdd = null;

                } catch(PDOException $e) {
                    echo 'Erreur : ' . $e->getMessage();
                }
            }
        }
        ?>



        <section>
            <h2>Nom du DLC</h2>
				<form class="container" method="post">
					<div class="box2 infos">
						<div class="input">
							<input
                            type="text"
                            id="dlc_name"
                            name="dlc_name"
                            required
                            placeholder="Nom du dlc"
                        ><br>
						</div>

						<div class="box1">
							<div class="input">
								<label for="release_date">Date de sortie</label>
								<input
                                    class="date"
                                    type="date"
                                    id="release_date"
                                    name="release_date"
                                    required
                                >
							</div>

							<div class="input">
								<label for="price">Prix</label>
								<input
                                type="number"
                                step="0.01"
                                id="price"
                                name="price"
                                placeholder="€"
                            >
							</div>
						</div>
					</div>

					<label for="description">Description</label>
                        <textarea
                        name="description"
                        class="description"
                        placeholder="Ecrivez une description du DLC"
                        id="description"
                        ></textarea>

                <input type="submit" name="ajouter" value="Valider" class="valider">
    </form>
			</section>
    </main>
</body>
</html>