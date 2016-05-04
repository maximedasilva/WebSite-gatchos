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
        session_start();
      if(!isset($_SESSION["NOM_USER"]))
      {
   echo'<form method="POST" action="connexion.php">
       
        <p>
	<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
	<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
        </p>
        <p><input type="submit" value="connexion" </></p></form>
	<!--<a href="./register.php">Pas encore inscrit ?</a>--';
      }

        else
         {
                  echo"Bonjour ".$_SESSION["NOM_USER"];
                 echo '<a href="deconnexion.php">Déconnexion </a>';             
                 echo '<a href="ListeMusicienSortie.php">Liste Musiciens </a>';    
                 echo '<a href="inscription.php">inscription </a>';  
                 echo '<a href="NouvelleSortie.php">Nouvelle sortie</a>';
         }
            ?>    
    
    </body>
</html>
