<?php
function initiales($nom){
    $n_mot = explode(" ",$nom);
    $nom_initiale="";
    foreach($n_mot as $lettre){
        $nom_initiale .= $lettre{0}.' ';
    }
    return strtoupper($nom_initiale);
}
function index(){
    header('Location: index.php');
}