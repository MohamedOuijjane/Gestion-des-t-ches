<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // Vérifier si le formulaire a été soumis
        if(isset($_POST['button'])){
            // Extraction des informations envoyées dans des variables via la méthode POST
            extract($_POST);

            // Vérifier que tous les champs ont été remplis
            if(isset($tache) && isset($description) && isset($avancement)){
                // Inclure la page de connexion à la base de données
                include_once "connexion.php";

                // Utiliser des déclarations préparées pour éviter les injections SQL
                $stmt = $con->prepare("INSERT INTO tache VALUES(NULL, ?, ?, ?)");
                $stmt->bind_param("sss", $tache, $description, $avancement);

                // Exécuter la déclaration préparée
                if ($stmt->execute()) {
                    // Rediriger vers la page d'index après l'ajout de la tâche
                    header("location: index.php");
                } else {
                    // En cas d'échec de l'ajout
                    $message = "Tâche non ajoutée";
                }

                // Fermer la déclaration préparée
                $stmt->close();

            } else {
                // Si tous les champs ne sont pas remplis
                $message = "Veuillez remplir tous les champs!";
            }
        }
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter une tâche</h2>
        <p class="erreur_message">
            <?php 
                // Afficher le message d'erreur s'il existe
                if(isset($message)){
                    echo $message;
                }
            ?>
        </p>
            <form action="" method="POST">
                <label>Tâche</label>
                <input type="text" name="tache" required>
                
                <label>Description</label>
                <textarea name="description" required></textarea>
                
                <label>Etat d'avancement</label>
                <input type="text" name="avancement" required>
                
                <input type="submit" value="Ajouter la tâche" name="button">
             </form>

    </div>
</body>
</html>
