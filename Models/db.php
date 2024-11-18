<?php
 function getBdd()
{
    $bdd = new PDO('mysql:host=localhost;dbname=klando', 'root', '');
    return $bdd;
}
