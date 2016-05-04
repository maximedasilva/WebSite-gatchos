<?php
include'identifiants.php';
$stmt = $db->prepare("select Mdp from Musicien where idMusicien=".$_SESSION["CODE_MUSE"]);
$stmt->execute();
$stmt->bindColumn(1, $mdp, PDO::PARAM_LOB);
$stmt->fetch(PDO::FETCH_BOUND);
    echo "mot de passe non crypté".md5($_POST["oldpwd"]);
    echo "motde passenon crypté ". $_POST["oldpwd"];
    echo "mot de passe base".$mdp;
if (empty($_POST['oldpwd']) ||empty($_POST['pwd'])||empty($_POST['confirm']))

{
header('Location: Account.php?empty=1');
exit();
}
else if(md5($_POST["oldpwd"])!=$mdp)
{
header('Location:Account.php?false=1');
exit();
}
else if($_POST["pwd"]!=$_POST["confirm"])
{
    header('Location:Account.php?confirm=1');
    exit();
}