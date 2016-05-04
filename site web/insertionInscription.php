<?php
        session_start();
        include'identifiants.php';
        $requete = "select * from Instrument inner join MusicienInstrument on MusicienInstrument.Instrument_idInstrument =Instrument.idInstrument inner join  Musicien on MusicienInstrument.Musicien_idMusicien=Musicien.idMusicien where idMusicien=" . $_SESSION["CODE_MUSE"];

        if (isset($_GET["instrument"])) {
            $instrument = $_GET["instrument"];
        } else {
            $stmt = $db->prepare($requete);
            $stmt->execute();
            $stmt->bindColumn(1, $instrument, PDO::PARAM_LOB);
            $stmt->fetch(PDO::FETCH_BOUND);
        }
            
        $stmt = $db->prepare("INSERT INTO Inscription (Musicien_idMusicien, Sortie_idSortie,Valeur,Instrument_idInstrument) VALUES (:musicien, :sortie,:valeur,:instrument)");
        $stmt->bindParam(':musicien', $musicien);
        $stmt->bindParam(':sortie', $sortie);
        $stmt->bindParam(':valeur', $valeur);
        $stmt->bindParam(':instrument', $instrument);

        if (isset($_GET["Presence"])) {
            $musicien = $_SESSION["CODE_MUSE"];
            foreach ($_GET["Presence"] as $index => $value) {
                $sortie = $index;
                $stmt2 = $db->prepare("select count(*) from inscription inner join Musicien on Musicien.idMusicien=inscription.Musicien_idmusicien where Musicien_idMusicien=".$_SESSION["CODE_MUSE"]." and Sortie_idSortie=".$sortie.";");
            $stmt2->execute();
            $stmt2->bindColumn(1, $compte, PDO::PARAM_LOB);
            $stmt2->fetch(PDO::FETCH_BOUND);
            if ($compte ==0)
            {
                if ($value == "present") {
                    $valeur = $value;
                    $stmt->execute();
             
                }
                if ($value == "absent") {
                    $valeur = $value;
                    $stmt->execute();
             
                }
                if ($value == "doute") {
                    $valeur = $value;
                    $stmt->execute();
             
                    
                }
             
            }
            
           }
        }
        header('Location:Inscription.php');
        ?>
