    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php include("identifiants.php"); ?>
     <link href="../CSS/Bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="../JS/Jquery.min.js"></script>
      <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.min.js"></script>
    <script src="../JS/JSfunctions.js"></script>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>Upload d'une image sur le serveur !</title>
  </head>
  <body>
    <!DOCTYPE html>
<html>
<body>
  
   <div class="container"><div class="col-lg-4 col-md-6">
           <h3 class="h3">Mise en ligne d'image</h3>
                   <div class="center-block">
                       <div class="form-group">
<form action="Scriptupload.php" method="post" enctype="multipart/form-data">
     <input class="form-control" name="title" type="text" placeholder="Titre du post"></input><br/>
    <textarea class="form-control" name="description"  placeholder="Description du post"></textarea><br/>
    <label for="datePost">Date de l'évènement</label>
    <input class="form-control" name="Date" type="date" id="date" placeholder="Rentrer la date en AAAA/MM/JJ"/></br>
    Choisir les images à télécharger
     <input  class="btn btn-default form-control" multiple="multiple" name="fileToUpload[]" type="file" ><br />
     <input class="btn btn-default" type="submit" value="Mise en ligne" name="submit">
         </form>
         </div></div>
</div>
                       <div class="col-lg-4 col-md-6">
                           <h3 class='h3'>Nouveau message</h3>
                            <div class="center-block">
                       <div class="form-group">
            <form action="scriptMessage.php" method="post" enctype="multipart/form-data">
     <input class="form-control" name="titre" type="text" placeholder="Titre du message"></input><br/>
    <textarea class="form-control" name="texte"  placeholder="Texte"></textarea><br/>
    <input class="btn btn-default" type="submit" value="Mise en ligne" name="submit">
            </form>
        </div></div></div>

         </div></div></div>

</form>
  </body>
</html>
