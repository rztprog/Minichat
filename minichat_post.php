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
$message = $_POST['message'];
$pseudo = $_POST['pseudo'];
$time = $_POST['time'];
$ip = $_SERVER['REMOTE_ADDR'];
// $jour = 7; // Nombre de jour avant suppression du cookie

// Si le cookie n'existe pas crée le pour les fois suivantes
if(!isset($_COOKIE['pseudo']) || $_POST['pseudo'] != $_COOKIE['pseudo'])
{
    setcookie('pseudo', $_POST['pseudo'], time() + 24*3600, null, null, false, true);
    // $jour*24*3600
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO minichat(pseudo, message, ip, time) VALUES(:pseudo, :message, :ip, :time)');

// Si le cookie n'existe pas au premier lancement execute avec le post
if(isset($_COOKIE['pseudo']))
{
$req->execute(array(
    'pseudo' => $_COOKIE['pseudo'],
    'message' => $message,
    'ip' => $ip,
    'time' => $time,
    ));
}
else
{
$req->execute(array(
    'pseudo' => $pseudo,
    'message' => $message,
    'ip' => $ip,
    'time' => $time,
    ));
}

// Redirige vers l'index
header('Location: minichat.php');

?>
