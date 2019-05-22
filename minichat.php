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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Righteous&effect=3d" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.css" />
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <title>SecureChat</title>
</head>
<body class="body">
    <div class="form"> 
        <form action="minichat_post.php" method="post">
        <h1 class="bigtitle">SECURECHAT</h1>
        <p class="form">Your IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p class="control">
        <?php
        if(!isset($_COOKIE['pseudo']))
        {?>
        <input type="text" name="pseudo" class="input is-medium is-primary" placeholder="Your nickname" value="" required />
        <?php
        }
        else
        {?>
        <input type="text" name="pseudo" class="input is-medium is-primary" placeholder="Your nickname" value="<?= $_COOKIE['pseudo'] ?>" required />
        <?php 
        } 
        ?>
        </p>
        <p class="control"><textarea class="message textarea is-primary is-medium margintop" name="message" rows="4" cols="40" required autofocus maxlength="255" placeholder="Your message"></textarea></p>
        <p class="margintop"><input class="button is-medium is-success" type="submit" value="Send" />
        <input class="button is-success is-medium" type="reset" value="Reset" />
        <button class="button is-success is-medium" value="ntm"><a class="is-black" href="minichat.php">Refresh</a></button>
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
