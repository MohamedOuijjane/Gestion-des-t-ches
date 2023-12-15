<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

    // Inclure la page de connexion à la base de données
    include_once "connexion.php";

    // Récupérer l'ID de la tâche à modifier depuis le lien
    $id = $_GET['id'];

    // Requête pour récupérer les informations de la tâche à modifier
    $req = mysqli_query($con , "SELECT * FROM tache WHERE id = $id");
    $row = mysqli_fetch_assoc($req);

    // Vérifier si le formulaire a été soumis
    if(isset($_POST['button'])){
        // Extraction des informations envoyées via la méthode POST
        extract($_POST);
        
        // Vérifier que tous les champs du formulaire ont été remplis
        if(isset($tache) && isset($description) && isset($avancement)){
            // Requête de modification de la tâche
            $req = mysqli_query($con, "UPDATE tache SET tache = '$tache' , description = '$description' , avancement = '$avancement' WHERE id = $id");
            
            if($req){//si la requête a été effectuée avec succès , on fait une redirection
                header("location: index.php");
            }else {//si non
                $message = "Tâche non modifiée";
            }
        }else {
            // Si tous les champs ne sont pas remplis
            $message = "Veuillez remplir tous les champs !";
        }
    }
    
?>

<div class="form">
    <!-- Lien de retour vers la page d'index -->
    <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
    <h2>Modifier la tâche : <?=$row['tache']?> </h2>
    
    <!-- Afficher un message d'erreur s'il y en a un -->
    <p class="erreur_message">
       <?php 
          if(isset($message)){
              echo $message ;
          }
       ?>
    </p>
    
    <!-- Formulaire de modification de la tâche -->
    <form action="" method="POST">
        <label>Tâche</label>
        <input type="text" name="tache" value="<?=$row['tache']?>">
        
        <label>Description</label>
        <textarea name="description"><?=$row['description']?></textarea>
        
        <label>Etat d'avancement</label>
        <input type="text" name="avancement" value="<?=$row['avancement']?>">
        
        <input type="submit" value="Modifier" name="button">
    </form>

</div>
</body>
</html>
