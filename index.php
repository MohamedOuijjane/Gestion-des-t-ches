<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des tâches</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- lien vers la page d'ajout de tâche -->
        <a href="ajouter.php" class="Btn_add"> <img src="images/plus.png"> Ajouter une tâche</a>
        
        <table>
            <!-- En-têtes du tableau -->
            <tr id="items">
                <th>Tâches</th>
                <th>Description</th>
                <th>Etat d'avancement</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php 
                // Inclure la page de connexion à la base de données
                include_once "connexion.php";

                // Requête pour afficher la liste des tâches
                $req = mysqli_query($con , "SELECT * FROM tache");

                // Vérifier s'il y a des tâches à afficher
                if(mysqli_num_rows($req) == 0){
                    // Aucune tâche n'a été ajoutée à la base de données
                    echo "Il n'y a pas encore de tâche ajoutée !" ;
                } else {
                    // Afficher la liste de toutes les tâches
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        <tr>
                            <td><?=$row['tache']?></td>
                            <td><p> <?=$row['description']?></p></td>
                            <td><?=$row['avancement']?></td>
                            <!-- Lien pour modifier la tâche en passant l'ID via la requête GET -->
                            <td><a href="modifier.php?id=<?=$row['id']?>"><img src="images/pen.png"></a></td>
                            <!-- Lien pour supprimer la tâche en passant l'ID via la requête GET -->
                            <td><a href="supprimer.php?id=<?=$row['id']?>"><img src="images/trash.png"></a></td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
