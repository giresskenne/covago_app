<?php
function getBdd()
{
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=covago', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $bdd;
}
