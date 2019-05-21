<?php
try
{
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=mini_chat;charset=utf8', 'root', '');
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en" class="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" />
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <title>Minichat PHP</title>
</head>
<body class="body">
    <div class="form"> 
        <form action="minichat_post.php" method="post">
        <h1 class="bigtitle">MINICHAT</h1>
        <p><label for="">Nickname : </label></p>
        <p><input type="text" name="pseudo" placeholder="Your nickname" value="" required autofocus /></p>
        <p><label for="">Message : </label>
        <p><textarea class="message" name="message" rows="10" cols="40" required maxlength="255" placeholder="Your message"></textarea></p>
        <p><input class="button is-warning" type="submit" value="Send" />
        <input class="button is-warning" type="reset" value="Reset" />
        <button class="button is-warning" value="ntm"><a href="minichat.php">Refresh</a></button>
        <!-- <button class="button is-warning">Clear</button> -->
        </p>
    </form>
    </div>
    <div class="chatbox">
<?php

$response = $bdd->query('SELECT pseudo, message FROM minichat ORDER BY id DESC LIMIT 10');

while ($data = $response->fetch())
{
?>
    <p>
    <strong><?php echo htmlspecialchars($data['pseudo']); ?></strong>
    : <?php echo htmlspecialchars($data['message']); ?>
    </p>

<?php
}

$response->closeCursor();

?>
    </div>
</body>
</html>
