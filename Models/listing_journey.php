<?php
 function getJourney()
{
include('Models/db.php');
$bdd=getBdd();
//$todayDate=date('y/m/d');
$qer = $bdd->prepare('SELECT * FROM journey ORDER BY id ASC ');
$qer->execute(array());
$nbre_element_page=6;
$nbre_elmt=$qer->rowCount();
 $nbre=$nbre_elmt/$nbre_element_page;
 //$debut=($page-1)*$nbre_element_page;
$req = $bdd->prepare('SELECT * FROM journey ORDER BY id ASC LIMIT 6');
$req->execute(array());
$resultat = $req->fetch();
return $req;
}
function getNumberJob()
{
    $bdd = new PDO('mysql:host=localhost;dbname=klando', 'root', '');
    $req = $bdd->prepare('SELECT * FROM journey');
    $req->execute(array());
    $nombre = $req->rowCount();
    return $nombre;  
}

function getNumberDriver()
{
    $bdd = new PDO('mysql:host=localhost;dbname=klando', 'root', '');
    $req = $bdd->prepare('SELECT * FROM users');
    $req->execute(array());
    $nombre = $req->rowCount();
    return $nombre;  
}
function getDriver()
{
include('Models/db.php');
$bdd=getBdd();
//$todayDate=date('y/m/d');
$qer = $bdd->prepare('SELECT * FROM users ORDER BY id ASC ');
$qer->execute(array());
$nbre_element_page=6;
$nbre_elmt=$qer->rowCount();
 $nbre=$nbre_elmt/$nbre_element_page;
 //$debut=($page-1)*$nbre_element_page;
$req = $bdd->prepare('SELECT * FROM users ORDER BY id ASC LIMIT 6');
$req->execute(array());
$resultat = $req->fetch();
return $req;
}
