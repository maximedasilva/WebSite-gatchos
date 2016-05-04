<?php
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}
include("identifiants.php");
$target_dir = "../upload/pictures/";
   if (isset($_POST["title"])&&isset($_POST["description"])&&isset($_POST["Date"])) {
           echo "ok";
if ($_FILES['fileToUpload']) {
    $file_ary = reArrayFiles($_FILES['fileToUpload']);
    echo $_POST["title"];
                $texte=str_replace('"','\"',$_POST["description"]);
        $titre=str_replace('"','\"',$_POST["title"]);
    $insertAndGetID="INSERT INTO post (`nomPost`,`datePost`,`descriptionPost`) VALUES ('".$titre."','".$_POST["Date"]."','".$texte."')";
    $query=$db->prepare($insertAndGetID);
        $query->execute();
      $id=$db->lastInsertId();
    foreach ($file_ary as $file) {
$target_file = $target_dir . basename($file["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($file["tmp_name"]);
    if($check !== false) {
   //     echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else
{
        if (move_uploaded_file($file["tmp_name"], $target_file))
            {
            echo "The file ". basename( $file["name"]). " has been uploaded.";
            $request='INSERT INTO photos  (`Lien`,`post_idpost`) VALUES ("'.$target_dir.$file["name"].'","'.$id.'")';
             $query=$db->prepare($request);
            $query->execute();
            $request="SELECT idPhoto from photos where Lien='".$target_dir.$file["name"]."'";
                     $query=$db->prepare($request);
            $query->execute();
             $t=$query->fetch();
             $idPhoto=$t['idPhoto'];



            }
} }}
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
//header('location: blog.php');

?>
