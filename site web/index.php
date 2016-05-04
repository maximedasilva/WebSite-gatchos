<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link href="bootstrap-3.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.css">
    <link rel="stylesheet" href="bootstrap-3.3.1/dist/css/bootstrap-theme.min.css">
        <meta charset="iso-8859-15">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        include("identifiants.php");
      if(!isset($_SESSION["NOM_USER"]))
      {?>
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
                        


                    </ul>

                    <form method="post" action="connexion.php" class="form-horizontal">

                        <ul  class="nav navbar-nav navbar-right navbar-text">

                            <li>
                                login:   <input class="input-sm" name="pseudo" type="text" />
                            </li>
                            <li>
                                password: <input class="input-sm"  name="password" type="password" />
                            </li>



                            <li>    

                                <input name="Connect" type="submit" value="connection" class='btn btn-success'/>
                            </li>
                        </ul>

                    </form>

                </div><!--/.nav-collapse -->
            </div>
        </div><?php
      }

        else
         {?>
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
                        <li><a href="NouvelleSortie.php">Nouvelle Sortie</a></li>
                     

                    </ul>

                                     <ul class="nav navbar-nav navbar-right">
                        <li><p  class="navbar-text"><?php echo "Bienvenue <a href='Account.php'>" . $_SESSION["NOM_USER"]."</a>" ?></P></li>
                        <li><a href='deconnexion.php'><span class='glyphicon glyphicon-log-out'></span></a></li>
                       
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>
        <?php
        $requete2 = "select distinct idSortie,NomSortie, DateSortie,`description Sortie` from Sortie where DateSortie>=NOW() order by DateSortie ASC "; ; ?>                        
                <div class='container'>    
   
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th><th>Date</th><th>description</th>
                        </tr>
                    </thead>
                    <tbody><br><br><br>
                        <?php
                        foreach ($db->query($requete2) as $row) {
                                echo '<tr><td><a href="listeMusicienSortie.php?Sortie=' . $row['idSortie'] . '">' . $row['NomSortie'] . '</a></td><td>' .  date("d/m/Y",strtotime($row['DateSortie'])) . '</td><td>'.$row[3].'</td></tr>';
                                
                            
                                }
                        
                    
                    ?>
                </table>
      
                </div>    
    <?php } ?>
    
    </body>
</html>
