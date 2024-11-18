<?php
$email=$_POST["email"];
$phoneNumber=$_POST["phoneNumber"];
$passwordUser=sha1($_POST["passwordUser"]);


include('Models/db.php');
$bdd=getBdd();
$request=$bdd->prepare('SELECT * FROM users WHERE email=?');
$request->execute(array($email));
$nb=$request->rowCount();
if ($nb==0) {   
    $req = $bdd->prepare('INSERT INTO users(email, phoneNumber,
        password) VALUES(:email,
        :phoneNumber, :password)');
        $req->execute(array(
        'email' => $email,
        'phoneNumber' => $phoneNumber,
        'password' => $passwordUser,
        ));
        echo "Votre compte a bien été créer";
        session_start();
        $_SESSION["email"]=$email;
        echo $_SESSION["email"];
      header('Location:index.php?page=publier&email='.$_SESSION["email"]);
}
else {
    header('Location:index.php?page=registration&message=Cet adresse email est deja utilisé vueillez reesayez une autre');
}
?>