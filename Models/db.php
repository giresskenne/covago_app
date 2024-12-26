<?php
function getBdd()
{
    $bdd = new PDO('mysql:host=mysql;port=3306;dbname=covago', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $bdd;
}
