<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include'identifiants.php';
        $requete="INSERT INTO Sortie (`NomSortie`, `DateSortie`, `description Sortie`) 
	VALUES ('".$_POST["NomSortie"]."','".$_POST["Date"]."','".$_POST["Description"]."')";
        echo $_POST["NomSortie"]."','".$_POST["Date"]."','".$_POST["Description"];
        $query=$db->prepare($requete);
        $query->execute();
        header('Location: Inscription.php');
        
        
        ?>
    </body>
</html>
