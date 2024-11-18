<?php
function searchJourney()
{
$lieuDep=$_POST["lieuDep"];
$lieuArriv=$_POST["lieuArriv"];
echo 'Lieu arrivé :'.$lieuArriv.'Lieu depart:'.$lieuDep;
include('Models/db.php');
$bdd=getBdd();
$req = $bdd->prepare('SELECT * FROM journey WHERE lieuDep=? AND lieuArriv=?');
$req->execute(array($lieuDep,$lieuArriv));
$resultat = $req->fetch();
//var_dump($req);
return $req;  
  
}