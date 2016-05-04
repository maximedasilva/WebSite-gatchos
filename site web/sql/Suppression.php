<?php
include 'identifiants.php';
session_start();

if (isset($_GET["sortie"]))
{
    $stmt2 = $db->prepare("delete from inscription where Sortie_idSortie=".$_GET["sortie"]." and Musicien_idMusicien=".$_SESSION["CODE_MUSE"]);
            $stmt2->execute();           
                        $stmt2->fetch(PDO::FETCH_BOUND);
           header("Location: Inscription.php");            
}
