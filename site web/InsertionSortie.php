<?php
        include'identifiants.php';
        $requete="INSERT INTO Sortie (`NomSortie`, `DateSortie`, `description Sortie`)
	VALUES ('".$_POST["NomSortie"]."','".date("Y/m/d",strtotime($_POST['DateSortie']))."','".$_POST["Description"]."')";
        $query=$db->prepare($requete);
        $query->execute();
        $corp=$_POST["NomSortie"]." ".$_POST["Description"]." ".$_POST["DateSortie"];
        header('Location: Inscription.php');

        ?>
