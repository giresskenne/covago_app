<?php
$array=array("email"=>"","passwordUser"=>"","error"=>"","isSuccess"=>"false");
$array["email"]=$_POST["email"];
$array["passwordUser"]=sha1($_POST["passwordUser"]);
$email=$array["email"];
$array["isSuccess"]=true;
$passwordUser=$array["passwordUser"];
echo $passwordUser.$email;
include('Models/db.php');
$bdd=getBdd();
$req = $bdd->prepare('SELECT * FROM users WHERE email = :email
AND password = :password');
$req->execute(array(
'email' => $email,
'password' => $passwordUser));
$resultat = $req->fetch();
if (!$resultat)
{
    $error="Mot de passe ou identifiant incorrect !";
header('Location:index.php?page=connexion&&error='.$error);
}
else
{
    $array["isSuccess"]=true;
    session_start();
    $_SESSION["email"]=$email;
    echo $_SESSION["email"];
    header('Location:index.php?page=accueil&&email='.$_SESSION["email"]);
}
json_encode($array);
?>