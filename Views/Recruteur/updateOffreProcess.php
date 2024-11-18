<?php
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
$idOffre= $_POST["idOffre"];

include('../Models/db.php');   
$bdd=getBdd();
$req = $bdd->prepare("UPDATE offres SET posteOffre=:posteOffre,lieuOffre=:lieuOffre,secteurOffre=:secteurOffre,
typeEmploi=:typeEmploi,typeContrat=:typeContrat,missionOffre=:missionOffre,salaire=:salaire,dateFinValid=:dateFinValid,
email=:email,nbPoste=:nbPoste,sites=:sites,datePoste=:datePoste WHERE idOffre=:idOffre");
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
    //'emailRecrut'=> $_SESSION['recrutMail'],
    'nbPoste'=>$nbPoste,
    'sites'=>$site,
    'datePoste'=>$postDate,
    'idOffre'=>$idOffre
));

/*echo json_encode($emailChauffeur);
header('Location: index.php?page=goodPost');
*/

?>
