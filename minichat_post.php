<?php

// Test de connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mini_chat;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Création des variables
$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');

$req->execute(array(
    'pseudo' => $pseudo,
    'message' => $message
    ));

// Redirige vers l'index
header('Location: minichat.php');

?>
