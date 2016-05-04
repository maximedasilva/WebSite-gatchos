
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--><?php
session_start();
 if (isset($_SESSION["NOM_USER"])) {
include'identifiants.php';
?>
<html>
    <head>
        <link href="bootstrap-3.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.css">
        <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.min.css">
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
                    <a class="navbar-brand" href="#">Los Gatchos</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                                    <?php
            $requeteinscrit="select count(*) as inscrit from Inscription where Musicien_idMusicien=".$_SESSION["CODE_MUSE"]; 
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
                        <li><a href="NouvelleSortie.php">Nouvelle Sortie</a></li>
<?php }?>


                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><p  class="navbar-text"><?php echo "Bienvenue " . $_SESSION["NOM_USER"] ?></P></li>
                        <li><a href='deconnexion.php'><span class='glyphicon glyphicon-log-out'></span></a></li>

                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>
        <?php
        //  $requete="select * from Sortie where idSortie NOT IN(select idSortie from Sortie inner join inscription on Sortie.idSortie = inscription.Sorties_idSorties inner join Musicien on inscription.Musiciens_idMusiciens=Musicien.idMusicien where idMusicien='".$_SESSION["CODE_MUSE"]."'";
        $requete2 = "select distinct idSortie,NomSortie, DateSortie,'description Sortie' from Sortie where DateSortie>=NOW() order by DateSortie ASC ";
        ;
        $requete3 = "select count(*) from Instrument inner join MusicienInstrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument inner join Musicien on MusicienInstrument.Musicien_idMusicien=Musicien.idMusicien where idMusicien=" . $_SESSION['CODE_MUSE'];
        $requete4 = 'select * from Instrument inner join MusicienInstrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument inner join Musicien on MusicienInstrument.Musicien_idMusicien=Musicien.idMusicien where idMusicien=' . $_SESSION['CODE_MUSE'];
        $query = $db->prepare($requete2);
        ?>
        <br><br><br>
                 <div class='container'>    
        <form id="form" method="get" action="insertionInscription.php">
   
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th><th>Date</th><th>Present</th><th>Absent</th><th>???</th><th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($db->query($requete2) as $row) {
                            echo' <tr>';
                            $stmt = $db->prepare("select count(*) from Inscription inner join Musicien on Musicien.idMusicien=Inscription.Musicien_idmusicien where Musicien_idMusicien=" . $_SESSION["CODE_MUSE"] . " and Sortie_idSortie=" . $row['idSortie'] . ";");
                            $stmt->execute();
                            $stmt->bindColumn(1, $compte, PDO::PARAM_LOB);
                            $stmt->fetch(PDO::FETCH_BOUND);
                            if ($compte == 0) {
                                echo '<td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' .  date("d/m/Y",strtotime($row['DateSortie'])) . '</td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="present" /></td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="absent" /></td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="doute" /></td><td></td>';
                            } else {
                                $stmt2 = $db->prepare("select Valeur from Inscription inner join Musicien on Musicien.idMusicien=Inscription.Musicien_idMusicien where Musicien_idMusicien=" . $_SESSION["CODE_MUSE"] . " and Sortie_idSortie=" . $row['idSortie'] . ";");
                                $stmt2->execute();
                                $stmt2->bindColumn(1, $valeur, PDO::PARAM_LOB);
                                $stmt2->fetch(PDO::FETCH_BOUND);
                                echo '<td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' .  date("d/m/Y",strtotime($row['DateSortie'])) . '</td>';
                                if ($valeur == 'present') {
                                    echo "<td><span class='glyphicon glyphicon-ok'></span></td><td></td><td></td>";
                                }
                                if ($valeur == 'absent') {
                                    echo "<td></td><td><span class='glyphicon glyphicon-ok'></span></td><td></td>";
                                }
                                if ($valeur == 'doute') {
                                    echo "<td></td><td></td><td><span class='glyphicon glyphicon-ok'></span></td>";
                                }
                                ?>
                            <td><a href="Suppression.php?sortie=<?php echo $row['idSortie']; ?>"><span class="glyphicon glyphicon-remove"</a></td><?php
                        }
                        echo'   </tr>';
                    }
                    ?>
                </table>
                <?php
                $stmt = $db->prepare($requete3);
                $stmt->execute();
                $stmt->bindColumn(1, $lob, PDO::PARAM_LOB);
                $stmt->fetch(PDO::FETCH_BOUND);
                if ($lob > 1) {
                    echo '<select name="instrument">';
                    foreach ($db->query($requete4) as $row) {

                        echo "<option value='" . $row['idInstrument'] . "'>" . $row['NomInstrument'];
                    }
                    echo '</select>';
                }
                ?>  
            <input type="submit" value="inscription" </>    
                </form>


            </div>
        <?php
 }
 else{
     header('Location: index.php');
 }?>
    </body>
</html>
