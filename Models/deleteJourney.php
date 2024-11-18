<?php
function dropJourney()
{
    $todayDate=date('y/m/d');
    $bdd = new PDO('mysql:host=localhost;dbname=klando', 'root', '');
    $req = $bdd->prepare('DELETE  FROM journey WHERE dateTravel <= ? ');
    $req->execute(array( $todayDate));
    return $req;  
}