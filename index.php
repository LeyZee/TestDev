<?php

// Je fais appel au fichier crud.php pour connecter la base de donnée à cette page et ainsi effectuer toutes les interactions entre le serveur et le user. 
require_once 'crud.php';
// Je redéfinis ici la fonction $result afin de pouvoir utiliser les données de la base de donnée dans mon tableau pour afficher tout les utilisateurs. 
$result = readall();

// Je commence une session pour créer un nouvel utilisateur et en supprimer un.

$date_crea = time();
$task_id;
session_start();
if (isset($_POST['create'])) {
    create($_POST['title'], $_POST['description'], $date_crea);
}
if (isset($_POST['delete']) and is_numeric($_POST['delete'])) {
    deleteOne($_POST['delete']);
}


$taskslist = readAll();
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <title>Evaluation Dev</title>
  </head>

  <body>

<h1>Evaluation Dev : </h1>

<br>

<div class="container">
        <div>
            <h2 class="h2"> Ajouter un nouvel utilisateur à ma liste</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label class="form-label" for="title">Utilisateur : </label>
                    <input class="form-control" type="text" name="title" value=<?php echo $_SESSION['create']['username'] ?>></input>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Prénom : </label>
                    <input class="form-control" name="description" value=<?php echo $_SESSION['create']['first_name'] ?>></input>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Nom : </label>
                    <input class="form-control" name="description" value=<?php echo $_SESSION['create']['last_name'] ?>></input>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Genre : </label>
                    <input type="radio" name="gender"></input>
                    <label for="female">Fille</label>
                    <input type="radio" name="gender"></input>
                    <label for="male">Garçon</label>
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Mot de passe : </label>
                    <input class="form-control" name="description" value=<?php echo $_SESSION['create']['password'] ?>></input>
                </div>
                <button class="btn btn-primary" type="submit" name="create">Ajouter un nouvel utilisateur</button>
            </form>
        </div>


<br>


<h2>Liste des utilisateurs :</h2>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Utilisateur</th>
      <th scope="col">Prénom</th>
      <th scope="col">Nom</th>
      <th scope="col">Genre</th>
      <th scope="col">Mot De Passe</th>
      <th scope="col">Etat</th>
    </tr>
  </thead>

   

  <?php 
 
// Je place dans mon tableau toutes les données appelés de la base de donnée avec la fonction $result

  foreach ($result as $key => $data) : 
  echo "<tbody>";
    echo "<tr>";
       echo "<td>" .  $data['user_id'] . "</td>";
       echo "<td>" .  $data['username'] . "</td>";
       echo "<td>" .  $data['first_name'] . "</td>";
       echo "<td>" .  $data['last_name'] . "</td>";
       echo "<td>" .  $data['gender'] . "</td>";
       echo "<td>" .  $data['password'] . "</td>";
       echo "<td>" .  $data['status'] . "</td>";
    echo "</tr>";
  echo "</tbody>";

endforeach ?>

<!-- Bon pas super propre je l'admet, le bouton "supprimer" me permet de supprimer le dernier utilisateur ajouté à la liste. 
J'ai voulu intégrer le bouton à côté de chaque utilisateur pour cibler plus précisément l'utilisateur voulu mais je n'ai pas réussi :( --> 

<form action="" name="delete" method="post">
    <button class="btn btn-danger" type="submit" name="delete" value=<?= $data['user_id'] ?>>Supprimer le dernier utlisateur ajouté</button>
</form>

</table>

</div>

<br>

</body>

</html>