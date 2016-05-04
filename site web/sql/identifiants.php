<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=gatchos', 'root', 'podema');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>