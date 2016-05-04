<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--><?php
session_start();

include'identifiants.php';
?>
<html>
    <head>
        <meta charset="iso-8859-15">
        <title></title>
    </head>
    <body>
        <?php
        //  $requete="select * from Sortie where idSortie NOT IN(select idSortie from Sortie inner join inscription on Sortie.idSortie = inscription.Sorties_idSorties inner join Musicien on inscription.Musiciens_idMusiciens=Musicien.idMusicien where idMusicien='".$_SESSION["CODE_MUSE"]."'";
        $requete2 = "select distinct idSortie,NomSortie, DateSortie,'description Sortie' from Sortie where DateSortie>=NOW() order by DateSortie ASC ";
        ;
        $requete3 = "select count(*) from Instrument inner join MusicienInstrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument inner join Musicien on MusicienInstrument.Musicien_idMusicien=Musicien.idMusicien where idMusicien=". $_SESSION['CODE_MUSE'];
        $requete4 = 'select * from Instrument inner join MusicienInstrument on Instrument.idInstrument=MusicienInstrument.Instrument_idInstrument inner join Musicien on MusicienInstrument.Musicien_idMusicien=Musicien.idMusicien where idMusicien=' . $_SESSION['CODE_MUSE'];
        $query = $db->prepare($requete2);
        ?>
        <form id="form" method="get" action="insertionInscription.php"> 
            <table><tr><th>Nom</th><th>Date</th><th>Present</th><th>Absent</th><th>???</th><th>Modifier</th></tr> <?php
                foreach ($db->query($requete2) as $row) {
                    echo' <tr>';
                    $stmt = $db->prepare("select count(*) from Inscription inner join Musicien on Musicien.idMusicien=Inscription.Musicien_idmusicien where Musicien_idMusicien=" . $_SESSION["CODE_MUSE"] . " and Sortie_idSortie=" . $row['idSortie'] . ";");
                    $stmt->execute();
                    $stmt->bindColumn(1, $compte, PDO::PARAM_LOB);
                    $stmt->fetch(PDO::FETCH_BOUND);
                    if ($compte == 0) {
                        echo '<td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' . $row['DateSortie'] . '</td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="present" /></td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="absent" /></td><td><input type="radio" name="Presence[' . $row['idSortie'] . ']" value="doute" /></td><td></td>';
                    } else {
                        $stmt2 = $db->prepare("select Valeur from Inscription inner join Musicien on Musicien.idMusicien=Inscription.Musicien_idMusicien where Musicien_idMusicien=" . $_SESSION["CODE_MUSE"] . " and Sortie_idSortie=" . $row['idSortie'] . ";");
                        $stmt2->execute();
                        $stmt2->bindColumn(1, $valeur, PDO::PARAM_LOB);
                        $stmt2->fetch(PDO::FETCH_BOUND);
                        echo '<td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' . $row['DateSortie'] . '</td>';
                        if ($valeur == 'present') {
                            echo "<td>x</td><td></td><td></td>";
                        }
                        if ($valeur == 'absent') {
                            echo "<td></td><td>x</td><td></td>";
                        }
                        if ($valeur == 'doute') {
                            echo "<td></td><td></td><td>x</td>";
                        }?>
                        <td><a href="Suppression.php?sortie=<?php echo $row['idSortie'];?>">modifier</a></td><?php
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
 


    </body>
</html>
