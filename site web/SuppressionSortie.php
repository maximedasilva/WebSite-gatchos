<?php
include 'identifiants.php';
session_start();
if (isset($_GET["sortie"]))
{
$stmt=$db->prepare("DELETE FROM `Inscription` where Sortie_idSortie=".$_GET["sortie"]);
$stmt->execute();
$stmt->fetch(PDO::FETCH_BOUND);
$stmt2 = $db->prepare("DELETE FROM `Sortie` where idSortie=".$_GET["sortie"]);
$stmt2->execute();           
$stmt2->fetch(PDO::FETCH_BOUND);
header("Location:Inscription.php");            
}

