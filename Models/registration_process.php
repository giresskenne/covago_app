<?php
 session_start();
$array=array("email"=>"","phoneNumber"=>"","passwordUser"=>"","emailError"=>"","phoneNumberError"=>"","passwordUserError"=>"","isSuccess"=>false);
function verifyInput($var){
    $var=trim($var);
    $var=stripslashes($var);
    $var=htmlspecialchars($var);
    return $var;
} 

function isEmail($var){

    return filter_var($var, FILTER_VALIDATE_EMAIL);
}
function isPhone($var){

    return preg_match(" ");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
$array["email"]=verifyInput($_POST["email"]);
$array["phoneNumber"]=verifyInput($_POST["phoneNumber"]);
$array["passwordUser"]=sha1($_POST["passwordUser"]);
$array["isSuccess"]=true;
$numberTaille=strlen($array["phoneNumber"]);
$pwdTaille=strlen($_POST["passwordUser"]);

if($numberTaille<>9){
$array["phoneNumberError"]="Vueillez entrer un numero de telephone à 9 chiffres";
 $array["isSuccess"]=false;   
}
if($pwdTaille < 8){
$array["passwordUserError"]="Vueillez entrer un mot de passe avec au moins 8 caractères";
$array["isSuccess"]=false;
}
$email=$array["email"];
    $phoneNumber=$array["phoneNumber"];
    $pwd=$array["passwordUser"];
include('Models/db.php'); 
$bdd=getBdd();
$request=$bdd->prepare('SELECT * FROM users');
$request->execute(array());
while($data=$request->fetch()){
    if($array["email"]==$data["email"]){
       $array["emailError"]="Ce nom d'utilisateur  est deja utilisé vueillez renseignez un autre";
       $array["isSuccess"]=false;
    }  
}
  if($array["isSuccess"]==true){    
       $req = $bdd->prepare('INSERT INTO users(email, phoneNumber,
        password) VALUES(:email,
        :phoneNumber, :password)');
        $req->execute(array(
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'password' =>$pwd,
        ));
        $message= "Votre compte a bien été créer";
        $_SESSION["email"]=$email;
        $_SESSION["phoneNumber"]=$phoneNumber;
        $emailS= $_SESSION["email"];
        $phoneNumberS=$_SESSION["phoneNumber"];
      header('Location:index.php?page=publier&&message='.$message.'&&email='.$emailS);
    }
    else{
       header('Location:index.php?page=registration&&emailError='.$array["emailError"].'&&phoneNumberError='.$array["phoneNumberError"].'&&passwordUserError='.$array["passwordUserError"]);
    }
    echo json_encode($array["emailError"]);
}

        
    
    



?>