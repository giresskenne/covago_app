<?php
function dropJourney()
{
    $todayDate=date('y/m/d');
    $bdd = new PDO('mysql:host=mysql;dbname=covago_db', 'covago_user1', 'WryJPUnZ8_tN');
    $req = $bdd->prepare('DELETE  FROM journey WHERE dateTravel <= ? ');
    $req->execute(array( $todayDate));
    return $req;  
}