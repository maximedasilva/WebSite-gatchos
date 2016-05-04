<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include'identifiants.php'?>
<html>
    <head>
        <meta charset="iso-8859-15">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
            $requete="select * from Sortie where idSortie=".$_GET['Sortie'];
            
                   foreach ($db->query($requete) as $row)
            {
                       echo $row['NomSortie']."<br>";
                       echo $row['DateSortie']."<br>";
                       echo $row['description Sortie']."<br>";
                      
         
            }
           
                
                         foreach ($db->query("select * from Instrument") as $row2)
                 {
                             $requete2="select NomMusicien,idMusicien,PrenomMusicien from Musicien inner join Inscription on Inscription.Musicien_idMusicien=Musicien.idMusicien inner join Sortie on Sortie.idSortie = Inscription.Sortie_idSortie where Inscription.Sortie_idSortie=".$_GET['Sortie']." and Inscription.Instrument_idInstrument=".$row2["idInstrument"];
                             echo $row2["NomInstrument"]."<br>";
                         ?>
        <table><tr><th>Présent</th><th>Absent</th><th>?</th></tr>
            
                    <?php
                 foreach ($db->query($requete2) as $row)
                 {
                $requete3="select Valeur from Inscription inner join Musicien on Inscription.Musicien_idMusicien=Musicien.idMusicien where idMusicien =".$row['idMusicien']." and Sortie_idSortie=".$_GET['Sortie']." and Instrument_idInstrument=".$row2["idInstrument"];
                   $stmt = $db->prepare($requete3);
          $stmt->execute();
$stmt->bindColumn(1, $valeur, PDO::PARAM_LOB);     
$stmt->fetch(PDO::FETCH_BOUND);  
echo '<tr>';
    if ($valeur == 'present')
    {
         echo "<td>".$row['NomMusicien'].' '.$row['PrenomMusicien']."</td><td></td><td></td>";
    }
    if ($valeur =='absent')
    {
        echo "<td></td><td>".$row['NomMusicien'].' '.$row['PrenomMusicien']."</td><td></td>";
    }
    if ($valeur =='doute')
    {
        echo "<td></td><td></td><td>".$row['NomMusicien'].' '.$row['PrenomMusicien']."</td>";
    }
               echo "</tr>";
    
                 }
                echo '</table>';
                $requeteNonInscrit='select * from Musicien inner join MusicienInstrument on Musicien.idMusicien=MusicienInstrument.Musicien_idMusicien where idMusicien NOT IN(select idMusicien from Musicien inner join Inscription on Inscription.Musicien_idMusicien=Musicien.idMusicien where Sortie_idSortie='.$_GET['Sortie'].')and MusicienInstrument.Instrument_idInstrument='.$row2['idInstrument'];
                 foreach ($db->query($requeteNonInscrit) as $row3)
                 {
                 echo $row3['NomMusicien'].' '.$row3['PrenomMusicien'].', ';
                 }
                 echo '<br><br><br>';
                 } 
                   ?>
    </body>
</html>
