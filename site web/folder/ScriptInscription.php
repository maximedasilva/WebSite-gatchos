<?php
session_start();
include'identifiants.php';
$sort=$_GET['Sortie'];
$requete2="select idInstrument from Instrument inner join Musiciens on Instrument.idInstrument = Musiciens.Instrument_idInstrument where Musiciens.idMusiciens ='".$_SESSION["CODE_MUSE"]."'";
$query=$db->prepare($requete2);
$query->execute();
$instru=$query->fetch();
$requete="insert into inscription VALUES('".$_SESSION["CODE_MUSE"]."','".$instru['idInstrument']."','".$sort."')";
        $query=$db->prepare($requete);
        $query->execute();
        header('Location: Inscription.php');
    //    header('Location: ListeMusicienSortie.php');

