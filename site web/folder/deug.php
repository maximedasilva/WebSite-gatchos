<?php
//Cette fonction doit Ãªtre appelÃ©e avant tout code html
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//On donne ensuite un titre Ã  la page, puis on appelle notre fichier debut.php
include("identifiants.php");
?>
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
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
        <p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $pseudo=$_POST['pseudo'];
        $requete="SELECT PrenomMusicien, NomMusicien, pseudo,Mdp,idMusicien,isChef FROM Musicien where pseudo='";
        $requete = $requete.$pseudo;
        $requete = $requete."'";
        $query=$db->prepare($requete);
        $query->execute();
        $data=$query->fetch();
        if ($data['Mdp'] ==($_POST['password'])) // Acces OK !
	{
            session_start();
            $_SESSION["NOM_USER"] =$data['PrenomMusicien'];
            $_SESSION["CODE_MUSE"]=$data['idMusicien'];
            header('Location:Inscription/index.php');
exit();
     ?>       		
           <?php
	}
        else{
            echo "erreur connexion";     
            echo "<a href='index.php'>cliquezici pour revenir";
        }
        
        
}
echo "erreur connexion";     
echo "<a href='index.php'>cliquezici pour revenir";
?>
    </body>
</html>
