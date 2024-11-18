<?php
session_start();
if (isset($_POST["site"]) && !empty($_POST["site"])) {
    $site=1;
}
else {
    $site=0;
}
if (isset($_POST["email"]) && !empty($_POST["email"])) {
    $email=$_POST["email"]; 
}
else {
    $email=""; 
}
if (empty($_POST["site"]) && empty($_POST["site"])) {
    //header('Location:newOffre.php?messageMode=Vous n\'avez choisit aucun moyen de candidature');
}
echo $site.$email;
$poste=$_POST["poste"];
$lieu=$_POST["lieu"]; 
$secteur=$_POST["secteur"];
$typeEmp=$_POST["typeEmp"];
$typeContrat=$_POST["typeContrat"];
$description=$_POST["description"];
$salaire=$_POST["salaire"];
$dateExp=$_POST["dateExp"];
$nbPoste=$_POST["nbPoste"]; 
$postDate=  date('y/m/d');

include('../Models/db.php');   
$bdd=getBdd();
$req = $bdd->prepare("INSERT INTO offres(posteOffre,lieuOffre,secteurOffre,typeEmploi,typeContrat,missionOffre,salaire,dateFinValid,email,emailRecrut,nbPoste,sites,datePoste)
 VALUES(:posteOffre,:lieuOffre,:secteurOffre,:typeEmploi,:typeContrat,:missionOffre,:salaire,:dateFinValid,:email,:emailRecrut,:nbPoste,:sites,:datePoste)");
$req->execute(array(
'posteOffre' => $poste,
'lieuOffre' => $lieu,
'secteurOffre' => $secteur,
'typeEmploi' => $typeEmp,
'typeContrat' => $typeContrat,
'missionOffre' => $description,
'salaire' => $salaire,
'dateFinValid' => $dateExp,
'email'=>$email,
'emailRecrut'=> $_SESSION['recrutMail'],
'nbPoste'=>$nbPoste,
'sites'=>$site,
'datePoste'=>$postDate
));

/*echo json_encode($emailChauffeur);
header('Location: index.php?page=goodPost');
*/

?>
