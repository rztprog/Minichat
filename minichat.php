<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Minichat PHP</title>
</head>
<body>
    <div>    
        <form class="form" action="minichat_post.php" method="post">
        <h1>MINICHAT</h1>
        <p><label for="">Nickname : </label>
        <input type="text" name="pseudo" placeholder="Your nickname" required autofocus /></p>
        <p><label for="">Message : </label>
        <textarea name="message" rows="10" cols="40" maxlength="255" placeholder="Your message" required></textarea></p>
        <p><input type="submit" value="Send" /></p>
    </form>
    </div>
    <div>
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
