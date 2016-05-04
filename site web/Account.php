<?php
session_start();
include'functions.php';
if (!isset($_SESSION["NOM_USER"])){
index();
}
else
{
include'identifiants.php';
$stmt = $db->prepare("select isChef from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $ischef, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
if ($ischef==false)
{
index();
}
else
{
?>
<html>
    <head>
          <link href="bootstrap-3.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.css">
        <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.min.css">
        <meta charset="iso-8859-15">
        <meta charset="iso-8859-15">
        <title></title>
    </head>
    <body>
         <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Los Gatchos</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li ><a href="index.php">Home</a></li>
                        <?php            
            
          $requeteinscrit="select count(*) as inscrit from Inscription inner join Sortie on Sortie.idSortie=Inscription.Sortie_idSortie where Musicien_idMusicien=".$_SESSION["CODE_MUSE"]." and Sortie.DateSortie>NOW()";  
            $query=$db->prepare("select count(*) as total from Sortie where DateSortie >=NOW()");
            $query->execute();
            $t=$query->fetch();
            $total=$t['total'];
             $query=$db->prepare($requeteinscrit);
            $query->execute();
            $i=$query->fetch();
            $inscrit=$i['inscrit'];
            $pasinscrit=$total-$inscrit;
            ?>
                        <li><a href="Inscription.php">Inscription <span class="badge"><?php echo $pasinscrit ?></span></a></li>
                                              <?php  $stmt = $db->prepare("select isChef from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $ischef, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
if ($ischef==true) {
?>
                        <li class="active"><a href="NouvelleSortie.php">Nouvelle Sortie</a></li>
<?php }?>
            

                    </ul>

                                     <ul class="nav navbar-nav navbar-right">
                        <li><p  class="navbar-text"><?php echo "Bienvenue <a href='Account.php'>" . $_SESSION["PRENOM_USER"]."</a>"?></P></li>
                        <li><a href='deconnexion.php'><span class='glyphicon glyphicon-log-out'></span></a></li>
                       
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div><br><br><br>
<div class="container"><div class="col-lg-4">
                   <div class="center-block">
                       <?php
if (!isset($_GET["sortie"]))
{ ?>
        <form method="post" action="InsertionSortie.php">
            <div class="form-group">
                <label for="NomSortie">Nom</label><input class="form-control" name="NomSortie" type="text" id="NomSortie" placeholder="Rentrer ici le nom de la sortie "></div> <div class="form-group">
                    <label for="DateSortie">Date</label><input class="form-control" name="Date" type="date" id="date" placeholder="Rentrer la date en AAAA/MM/JJ"/></div> <div class="form-group">
                        <label for="Descrption">Description</label>
                        <textarea  class="form-control" name="Description" >Rentrer ici les informations sur la sortie</textarea> </div> <div class="form-group">
            <input class="btn btn-default" type="submit" value="NouvelleSortie"/>
            </div>
        </form>
             <?php } else{
              $stmt = $db->prepare("select `NomSortie`, `DateSortie`, `description Sortie` from Sortie where idSortie=".$_GET["sortie"]);
$stmt->execute();
$stmt->bindColumn(1, $nom, PDO::PARAM_LOB);
$stmt->bindColumn(2,$date , PDO::PARAM_LOB);
$stmt->bindColumn(2,$desc , PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
              ?>
        <form method="post" action="InsertionSortie.php">
            <div class="form-group">
                <label for="NomSortie">Nom</label><input class="form-control" name="NomSortie" type="text" id="NomSortie" placeholder=<?php $nom ?>></div> <div class="form-group">
                    <label for="DateSortie">Date</label><input class="form-control" name="Date" type="date" id="date" placeholder=<?php $date ?>/></div> <div class="form-group">
                        <label for="Descrption">Description</label>
                        <textarea  class="form-control" name="Description" ><?php $desc ?></textarea> </div> <div class="form-group">
            <input class="btn btn-default" type="submit" value="NouvelleSortie"/>
            </div>
        </form>
              <?php } ?>
  </div></div>

                   <div class='container'>    
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th><th>Date</th><th>Modifier</th><th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $requete2 = "select distinct idSortie,NomSortie, DateSortie,'description Sortie' from Sortie where DateSortie>=NOW() order by DateSortie ASC ";
                        foreach ($db->query($requete2) as $row) {
                            echo' <tr>';
                                echo '<td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' . date("d/m/Y", strtotime($row['DateSortie'])) . '</td>';
                            
                        ?>    <td><a href="NouvelleSortie?sortie=<?php echo $row['idSortie']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td><td><a href="SuppressionSortie.php?sortie=<?php echo $row['idSortie']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td><?php
                        }
                        echo'   </tr>';
   
                    ?>
                </table>
                       
                </form>


            </div>

    </body>
<?php
}
}
?>
</html>
