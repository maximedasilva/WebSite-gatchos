 <?php try
{
$db = new PDO('mysql:host=localhost;dbname=gatchos', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>