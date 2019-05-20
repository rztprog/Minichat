<?php
// Effectuer ici la requête qui insère le message
// Puis rediriger vers minichat.php comme ceci :
header('Location: minichat.php');
?>

<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=mini_chat;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$pseudo = $_POST['pseudo'];
$message = $_POST['message'];

$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');

$req->execute(array(
    'pseudo' => $pseudo,
    'message' => $message
    ));


?>
