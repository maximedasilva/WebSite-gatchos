<?php
        include'identifiants.php';
        $requete="INSERT INTO Sortie (`NomSortie`, `DateSortie`, `description Sortie`) 
	VALUES ('".$_POST["NomSortie"]."','".$_POST["Date"]."','".$_POST["Description"]."')";
        $query=$db->prepare($requete);
        $query->execute();
        header('Location: Inscription.php');
        ?>

