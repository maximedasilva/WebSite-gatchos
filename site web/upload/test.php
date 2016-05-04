    <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include("identifiants.php");
?>
<html>
    <head>
 
        <link href="../CSS/Bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="../JS/Jquery.min.js"></script>
      <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.js"></script>
    <script src="../JS/jscroll/jquery.jscroll.min.js"></script>
    <script src="../JS/JSfunctions.js"></script>    
    
        <meta charset="iso-8859-15">
 <?php
       include 'identifiants.php';?>
    </head>
    <body>
            <div class="container">
        <?php
        $lastID=-1;
        $beginDate= strtotime("07/04/1900");
        ?>
               
         <?php
        include("identifiants.php"); 
     $lastDate=date("Y-m-d",$beginDate);
        $requestPost="select * from post  ORDER BY datePost,idpost LIMIT 0,3";
foreach ($db->query($requestPost) as $post) {
    $lastDate=$post["datePost"];
    $lastID=$post["idpost"];
      $request="select * from photos where post_idpost=".$post["idpost"];
      ?>
                
                  <div class='jumbotron'> <div class=' container '><div class="col-xs-12 col-sm-12"><?php
                   echo $post["nomPost"];?></div><?php
   foreach ($db->query($request) as $row) {
        ?>
 <div class="col-xs-6 col-sm-3 ">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="<?php echo $row["Lien"] ?>"height="100"  alt="photo"></img>
		  </a>
    </div>                
        <?php } 
         echo $post["descriptionPost"];
         ?></div></div><?php
}
      ?>

    <div class="col-xs-6 col-sm-3">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="https://s3.amazonaws.com/ooomf-com-files/lqCNpAk3SCm0bdyd5aA0_IMG_4060_1%20copy.jpg" alt="...">
        </a>
    </div>
    <div class="col-xs-6 col-sm-3">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="https://s3.amazonaws.com/ooomf-com-files/deYU3EyQP9cN23moYfLw_Dandelion.jpg" alt="...">
        </a>
    </div>
    <div class="col-xs-6 col-sm-3">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="https://s3.amazonaws.com/ooomf-com-files/8H0UdTsvRFqe03hZkNJr_New%20York%20-%20On%20the%20rock%20-%20Empire%20State%20Building.jpg" alt="...">
        </a>
    </div>
    <div class="col-xs-6 col-sm-3">
        <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"> 
            <img src="https://s3.amazonaws.com/ooomf-com-files/Z3LXxzFMRe65FC3Dmhnp_woody_unsplash_DSC0129.jpg" alt="...">
        </a>
    </div>
</div>

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
</html>
