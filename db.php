<?php

// Je me connecte à la base de donnée DevTest 

function db_connect() {
    try {
        return $pdo = new PDO('mysql:host=localhost;dbname=devtest', 'root','', array(PDO::ATTR_PERSISTENT => true));
        echo "Connexion établie !" . "<br/>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
         return die();
    }
}