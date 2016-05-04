<?php      
include("identifiants.php");
error_reporting(E_ALL);
$texte=str_replace('"','\"',$_POST["texte"]);
$titre=str_replace('"','\"',$_POST["titre"]);
$request='INSERT INTO messages  (`Titre`,`Texte`) VALUES ("'.$titre.'","'.$texte.'")';
             $query=$db->prepare($request);
            $query->execute();
            $query->fetch();
            header("Location: blog.php");
           