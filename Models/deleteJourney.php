<?php
function dropJourney()
{
    $todayDate=date('y/m/d');
    $bdd = new PDO('mysql:host=mysql;port=3306;dbname=covago', 'root', 'root');
    $req = $bdd->prepare('DELETE  FROM journey WHERE dateTravel <= ? ');
    $req->execute(array( $todayDate));
    return $req;  
}