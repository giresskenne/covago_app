<?php
function getJourneyDetails($id)
{
include('Models/db.php');
$bdd=getBdd();
$req = $bdd->prepare('SELECT * FROM journey WHERE id=?  limit 15');
$req->execute(array($id));
$resultat = $req->fetch();
//var_dump($id);
if (!$resultat)
{
    header('Location: ../Views/job_listing.html?error=Aucun voyage n\'est encore disponnible');
}
else
{
    return $resultat;
}
}