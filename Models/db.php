<?php
function getBdd()
{
    $bdd = new PDO('mysql:host=mysql;dbname=covago_db', 'covago_user1', 'WryJPUnZ8_tN', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $bdd;
}

