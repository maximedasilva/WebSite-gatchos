 <?php try
{
$db = new PDO('mysql:host=localhost;dbname=gatchos', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
        echo "Erreur de connexion au serveur MySQL";
}?>
