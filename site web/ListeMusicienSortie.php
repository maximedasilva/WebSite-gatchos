<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include'identifiants.php';
include'functions.php';
session_start();
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
                        <li><a href="Inscription.php">Inscr                      <?php  $stmt = $db->prepare("select isChef from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $ischef, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
if ($isChef==false) {
?>
                        <li><a href="NouvelleSortie.php">Nouvelle Sortie</a></li>
<?php }?>
            iption</a></li>
                      <?php  $stmt = $db->prepare("select isChef from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $ischef, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
if ($isChef==false) {
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
        </div><br><br><br>
        <?php
        $requete = "select * from Sortie where idSortie=" . $_GET['Sortie'];

        foreach ($db->query($requete) as $row) {


            echo '<div class="jumbotron"><div class="container"><div class="col-lg-4">';
            echo"<h2>" . $row['NomSortie'] . " </h2> ";
            echo "<h3>" . date("d/m/Y", strtotime($row['DateSortie'])) . "</h3></div>";
            echo '<div class="col-lg-8">';
            echo '<h4>' . $row['description Sortie'] . '<h4/></div></div></div>';
        }
        ?>    <div class='container'>



            <table class="table">
                <tr><th width="20%">Instrument</th><th width="20%">Présent</th><th width="20%">Absent</th><th width="20%">?</th><th width="20%">Non inscrits</th></tr>
                <?php
                foreach ($db->query("select * from Instrument") as $row2) {
                    $present = "";
                    $absent = "";
                    $doute = "";
                    $requete2 = "select NomMusicien,idMusicien,PrénomMusicien from Musicien inner join Inscription on Inscription.Musicien_idMusicien=Musicien.idMusicien inner join Sortie on Sortie.idSortie = Inscription.Sortie_idSortie where Inscription.Sortie_idSortie=" . $_GET['Sortie'] . " and Inscription.Instrument_idInstrument=" . $row2["idInstrument"];

                    foreach ($db->query($requete2) as $row) {
                        $query2=$db->prepare('select count(*) as nb from Musicien inner join MusicienInstrument on MusicienInstrument.Musicien_idMusicien=idMusicien inner join Instrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument where Instrument_idInstrument='.$row2["idInstrument"].' and PrénomMusicien="'.$row["PrénomMusicien"].'"');
                        $query2->execute();
                        $t=$query2->fetch();
                        $Nombre=$t['nb'];
                        $requete3 = "select Valeur from Inscription inner join Musicien on Inscription.Musicien_idMusicien=Musicien.idMusicien where idMusicien =" . $row['idMusicien'] . " and Sortie_idSortie=" . $_GET['Sortie'] . " and Instrument_idInstrument=" . $row2["idInstrument"];
                        $stmt = $db->prepare($requete3);
                        $stmt->execute();
                        $stmt->bindColumn(1, $valeur, PDO::PARAM_LOB);
                        $stmt->fetch(PDO::FETCH_BOUND);
                        echo '<tr>';
                        if ($valeur == 'present') {
                            if ($Nombre == 1) {
                                $present = $present . $row['PrénomMusicien'] . ', ';
                            } else {
                                $present = $present . $row['PrénomMusicien'] . ' ' . initiales($row['NomMusicien']) . ', ';
                            }
                        }
                        
                        if ($valeur == 'absent') {
                            if ($Nombre == 1) {
                                $absent = $absent . $row['PrénomMusicien'] . ', ';
                            } else {
                                $doute = $doute . $row['PrénomMusicien'] . ' ' . initiales($row['NomMusicien']) . ', ';
                            }
                        }
                        if ($valeur == 'doute') {
                            if ($Nombre == 1) {
                                $present = $present . $row['PrénomMusicien'] . ', ';
                            } else {
                                $present = $present . $row['PrénomMusicien'] . ' ' . initiales($row['NomMusicien']) . ', ';
                            }
                        }
                    }
                    echo '<td>' . $row2["NomInstrument"] . '</td><td ><p  style="font-size: 12px;">' . $present . '</p></td><td><p style="font-size: 12px;">' . $absent . '</p></td><td><p style="font-size: 12px;">' . $doute . '</p></td>';
                    $requeteNonInscrit = 'select * from Musicien inner join MusicienInstrument on Musicien.idMusicien=MusicienInstrument.Musicien_idMusicien where idMusicien NOT IN(select idMusicien from Musicien inner join Inscription on Inscription.Musicien_idMusicien=Musicien.idMusicien where Sortie_idSortie=' . $_GET['Sortie'] . ')and MusicienInstrument.Instrument_idInstrument=' . $row2['idInstrument'];

                    
                    echo '<td><strong style="font-size: 12px;">';
                    foreach ($db->query($requeteNonInscrit) as $row3) {
                        $query2=$db->prepare('select count(*) as nb from Musicien inner join MusicienInstrument on MusicienInstrument.Musicien_idMusicien=idMusicien inner join Instrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument where Instrument_idInstrument='.$row2["idInstrument"].' and PrénomMusicien="'.$row3["PrénomMusicien"].'"');
                        $query2->execute();
                        $t=$query2->fetch();
                        $Nombre=$t['nb'];
                        if ($Nombre == 1) {

                            echo $row3['PrénomMusicien'] . ', ';
                        } else {
                            echo $row3['Prénom'] . ' ' . initiales($row3['NomMusicien']) . ', ';
                        }
                    }
                    echo '</strong>';
                    echo '</td></tr>';
                }
                ?> 
            </table>



        </div>
    </body>
</html>
