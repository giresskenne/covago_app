<?php
//session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
//$email=$_POST["email"];  
$message=$_POST["message"]; 
$datePost= date('y-m-d');
echo $datePost;
include('Models/db.php'); 
$bdd=getBdd();
       $req = $bdd->prepare('INSERT INTO comments(texte,dateComment
        ) VALUES(
        :texte, :dateComment)');
        $req->execute(array(
       
        'texte' => $message,
        'dateComment' =>$datePost,
        ));

     // header('Location:Views/goodAccount.php?message='.$message.'&&email='.$emailS);
   
}

        
    
    



?>
