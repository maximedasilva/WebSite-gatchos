<?php //try
//{
//$db = new PDO('mysql:host=localhost;dbname=gatchos', 'root', 'podema');
//}
//catch (Exception $e)
//{
//        die('Erreur : ' . $e->getMessage());
//}
?><?php
mb_internal_encoding('UTF-8');
try
{
$db = new PDO('mysql:host=db563645683.db.1and1.com;dbname=db563645683', 'dbo563645683', 'gatchos$');
}
catch (Exception $e)
{
       die('Erreur : ' . $e->getMessage());
}
?>