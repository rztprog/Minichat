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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" />
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <title>Minichat PHP</title>
</head>
<body class="body">
    <div class="form"> 
        <form action="minichat_post.php" method="post">
        <h1 class="bigtitle">MINICHAT</h1>
        <p>
        <p class="control has-icons-left">
            <input type="text" name="pseudo" class="input is-medium is-primary is-rounded" placeholder="Your nickname" value="" required autofocus />
            <span class="icon is-small is-left">
                <i class="fas fa-cannabis"></i>
            </span>
        </p>
        <p>
        <p><textarea class="message textarea is-primary is-medium margintop" name="message" rows="10" cols="40" required maxlength="255" placeholder="Your message"></textarea></p>
        <p class="margintop"><input class="button is-success" type="submit" value="Send" />
        <input class="button is-success" type="reset" value="Reset" />
        <button class="button is-success" value="ntm"><a class="is-black" href="minichat.php">Refresh</a></button>
        <!-- <button class="button is-success">Clear</button> -->
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
