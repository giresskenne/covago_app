<?php
$idOffre= $_GET["id"];

include('../Models/db.php');   
$bdd=getBdd();
$req = $bdd->prepare("UPDATE offres SET etatOffre=:etatOffre WHERE idOffre=:idOffre");
$req->execute(array(
    'etatOffre' => 1,
    'idOffre'=>$idOffre
));



?>
