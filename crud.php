<?php
require 'db.php';

// a fonction readAll me permet de chercher tout les éléments d'une table, ici user_details.
function readAll()
{
    $pdo = db_connect();
    $query = "SELECT * FROM user_details";
    $request = $pdo->query($query);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

// La fonction readOne me permet de rechercher un élément en particulier dans la table user_details, ici on veut l'ID de l'utilisateur. 
function readOne($id)
{
    $pdo = db_connect();
    $queryid = 'SELECT * FROM user_details where user_id = :id';
    $requestid = $pdo->prepare($queryid);
    $requestid->bindParam(':id', $id);
    $requestid->execute();
    $result = $requestid->fetch();
    return($result);
}

// Cette fonction me sert à faire la jonction entre la base de donnée et l'index pour créer un utilisateur et l'inscrire ainsi dans la base de donnée.
 
function create(string $username, string $first_name, string $last_name, string $gender, string $password, int $status = null)
{
    $pdo = db_connect();
    $querycreate = "INSERT INTO user_details (username, first_name, last_name, gender, password, status) VALUES (:username, :first_name, :last_name, :gender, :password, :status)";
    $requestcreate = $pdo->prepare($querycreate);
    $requestcreate->execute(array(':username' => $username, ':first_name' => $first_name, ':last_name' => $last_name, ':gender' => $gender, ':password' => $password, ':status' => $status));
}

// Cette fonction me sert à faire la jonction entre la base de donnée et l'index pour supprimer un utilisateur et le supprimer ainsi de la base de donnée.

function deleteOne(int $id)
{
    $pdo = db_connect();
    $querydelete = "DELETE FROM user_details WHERE user_id=$id";
    $requestdelete = $pdo->prepare($querydelete);
    $requestdelete->execute();
}