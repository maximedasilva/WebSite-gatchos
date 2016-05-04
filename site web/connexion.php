    <?php
//Cette fonction doit être appelée avant tout code html
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//On donne ensuite un titre à la page, puis on appelle notre fichier debut.php
include("identifiants.php");
    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
        <p>Cliquez <a href="index.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $pseudo=$_POST['pseudo'];
        $requete="SELECT  NomMusicien, pseudo,Mdp,idMusicien,isChef FROM Musicien where pseudo='";
        $requete = $requete.$pseudo;
        $requete = $requete."'";
      
        $query=$db->prepare($requete);
        $query->execute();
        $data=$query->fetch();
        if ($data['Mdp'] ==  $_POST['password']) // Acces OK !
	{
            session_start();
            $_SESSION["NOM_USER"] =$data['NomMusicien'];
            $_SESSION["CODE_MUSE"]=$data['idMusicien'];
            $requete2="select count(*) as total from Sortie where DateSortie >=NOW()";
            $requete3="select count(*) as inscrit from Inscription where Musicien_idMusicien=".$_SESSION["CODE_MUSE"];
            $query=$db->prepare($requete2);
            $query->execute();
            $t=$query->fetch();
            $total=$t['total'];
             $query=$db->prepare($requete3);
            $query->execute();
            $i=$query->fetch();
            $inscrit=$i['inscrit'];
            $pasinscrit=$total-$inscrit;
            echo $pasinscrit;
            if(isset($_GET["url"])){
      header("location: http://".$_GET["url"]);
      }
      else
               header('Location:index.php');
		exit();
	}
        else{
           echo "erreur connexion";
echo "<a href='index.php'>cliquezici pour revenir</a>";
        }

     echo $message;
}

?>
