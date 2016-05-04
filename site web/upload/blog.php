<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
          <link href="../CSS/Bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="../JS/Jquery.min.js"></script>
      <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.min.js"></script>
    <script src="../JS/JSfunctions.js"></script>
 <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS
    <link href="../css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php
     include("identifiants.php");
    session_start();
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

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
                    <a class="navbar-brand" href="../AcceuilSite.php">Los Gatchos</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="../AcceuilSite.php">Home</a></li>
                        <li class="active"><a  href="#">Blog</a></li>


                    </ul>

                    <form method="post" action="../connexion.php?url=<?php echo $url?>" class="form-horizontal">

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
                                    <a class="navbar-brand" href="../AcceuilSite.php">Los Gatchos</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="../AcceuilSite.php">Home</a></li>
                        <li class="active"><a  href="#">Blog</a></li>


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
                        <li><a href="../Inscription.php">Inscription <span class="badge"><?php echo $pasinscrit ?></span></a></li>
                        <li><a href="../NouvelleSortie.php">Nouvelle Sortie</a></li>
                        <?php  $stmt = $db->prepare("select isChef from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $ischef, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
if ($ischef==true) {
?>
                        <li><a  href="upload.php">upload</a></li>
                      <?php } ?>

                    </ul>

                                     <ul class="nav navbar-nav navbar-right">
                        <li><p  class="navbar-text"><?php echo "Bienvenue <a href='Account.php'>" . $_SESSION["NOM_USER"]."</a>" ?></P></li>
                        <li><a href='../deconnexion.php?url=<?php echo $url?>'><span class='glyphicon glyphicon-log-out'></span></a></li>

                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>
         <?php }
       if (!isset($_GET["page"]))
       {
           $page=0;
       }
 else
     {
       $page=$_GET["page"];
       }
         ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                   Le Blog
                    <small>de la musicale des gaves</small>
                </h1>

                <?php

?>

                <!-- First Blog Post -->


                <!-- Third Blog Post -->
                         <?php

        $pics=$page*3;
        $requestPost="select * from post  ORDER BY datePost DESC,idpost LIMIT ".$pics.",3";
foreach ($db->query($requestPost) as $post) {
      $request="select * from photos where post_idpost=".$post["idpost"];
      ?>

              <div  class=' container '><div style="background-color: rgba(0,0,0,0.05); border-radius:10px;  " class="col-xs-12 col-sm-12 col-md-8 col-lg-8"><?php
 ?>
                <h2 style="color:#428bca;">
                    <?php
                   echo $post["nomPost"];?>
                </h2>
                <p class="lead" style="color:#428bca;">
                   La Musicale des Gaves</p>

                <p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo  date("d/m/Y", strtotime($post["datePost"])) ?></p>
                <hr><?php
                  foreach ($db->query($request) as $row) {
        ?>
 <div class="col-xs-6 col-sm-3 ">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox">
            <img  style="max-height:150px ;max-width:150px; -o-object-fit: contain;" class="img-responsive"  src="<?php echo $row["Lien"] ?>"  alt="photo"></img>
		  </a>
    </div>
        <?php }

         ?><div class="col-xs-12 col-sm-12 ">
             <h4><?php echo $post["descriptionPost"]; ?></h4>    </div>
                  </div>
                </div>
                <br>

<?php
}

      ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <?php         $request="Select count(*) as nb from post";
                     $query=$db->prepare($request);
            $query->execute();
             $total=$query->fetch();
              $Nombre=$total['nb'];

             if ($page!=0){
             ?>
                        <a href="blog.php?page=<?php echo $page-1 ?>">&larr; Précédent</a>
             <?php } ?>
                    </li>
                    <?php if ($page*3<=$Nombre){
             ?>
                    <li class="next">
                        <a href="blog.php?page=<?php echo $page+1 ?>">Suivant &rarr;</a>
                    </li>
                    <?php } ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <br><br>
<?php
$requestMessages="select * from messages order by idmessages DESC";
foreach ($db->query($requestMessages) as $row)
{?>
    <div class="well">
<h4><?php echo $row["Titre"] ?><h4>
                    <p><?php echo $row["Texte"] ?></p>
</div><?php }
?>
                <!-- Blog Categories Well -->


                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well/<h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
       <div class="well">
                    <h4>Side Widget Well/<h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
                       <div class="well">
                    <h4>Side Widget Well/<h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
                       <div class="well">
                    <h4>Side Widget Well/<h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>

        </div>
        <!-- /.row -->

        <hr>


    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">x</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>
</body>
<footer>

            <div class="col-md-6 col-lg-4 pull-right">
                  <form >
                  <div class="row">
                        <h4 class="h4 text-center">Formulaire de contact</h4>
                        <div class="col-xs-6">
                             <input class="form-control" name="nom" type="text" placeholder="nom">
                                         </div>
                                 <div class="col-xs-6">
                             <input class="form-control" name="prenom" type="text" placeholder="Prénom">
                                 </div>
                  </div>
                        <br>
                        <input class="form-control" name="mail" type="email" placeholder="Adresse email"><br>
    <textarea class="form-control" name="texte"  placeholder="Votre question, suggestion"></textarea>

    <input class="btn btn-default center-block" type="submit" value="Envoyer" name="submit">
                    </form>

                <!-- /.col-lg-10 -->
            </div>
                <div class="col-lg-7 col-md-6 col-lg-offset-1">
                      <div class="row">
                          <div class="pull-right">
                    <h4><strong>La musicale des gaves</strong>
                    </h4>
                    <p> 62 Rue Alsace Lorraine<br>peyrehorade, 40300</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> 05 58 73 25 95 </li>
                        <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:musicaledesgaves@orange.fr">musicaledesgaves@orange.fr</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/musicaledesgaves"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/lamusicale040"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                                            </ul>
                    <hr class="small">
                    <p class="text-muted">&copy; 2015 la musicale des gaves Tous droits réservés</p>
                </div>
                      </div>

        </div>
    </footer>
</html>
