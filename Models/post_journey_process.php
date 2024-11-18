<?php
$immat=$_POST["imat"];
$marque=$_POST["marque"];
$model=$_POST["model"];
$couleur=$_POST["couleur"];
$nbPlaces=$_POST["nbPlaces"];
$dateTravel=$_POST["dateTravel"];
$lieuDep=$_POST["lieuDep"];
$lieuArriv=$_POST["lieuArriv"];
$photo_1=$_FILES["photo_1"]['name'];
$photo_2=$_FILES["photo_2"]['name'];
$photo_3=$_FILES["photo_3"]['name'];
$postDate=  date('y/m/d');
$heureDep=$_POST["heureDep"];
$emailChauffeur=$_POST["email"];
include('Models/db.php'); 

/*if (isset($_FILES['photo_1']) AND isset($_FILES['photo_2']) AND isset($_FILES['photo_3']) AND $_FILES['photo_1']['error']==0 AND $_FILES['photo_2']['error']==0 AND $_FILES['photo_3']['error']==0)
{
if ($_FILES['photo_1']['size'] AND $_FILES['photo_2']['size'] AND $_FILES['photo_3']['size'] <= 1000000)
{
// Testons si l'extension est autorisée
$infosfichier = pathinfo($photo_1 AND $photo_2 AND $photo_3);
$extension_upload = $infosfichier['extension'];
$extensions_autorisees = array('jpg', 'jpeg', 'gif',
'png');
if (in_array($extension_upload,
$extensions_autorisees))
{
// On peut valider le fichier et le stocker
    définitivement
move_uploaded_file($_FILES['photo_1']['tmp_name'] AND $_FILES['photo_2']['tmp_name'] AND $_FILES['photo_3']['tmp_name'], 'uploads/' .
basename($photo_1 AND $photo_2 AND $photo_3));
echo "L'envoi a bien été effectué !";
}
}*/

             
$bdd=getBdd();
$req = $bdd->prepare("INSERT INTO journey(immat, marque, model, couleur, nbPlaces, 
dateTravel, lieuDep, lieuArriv, photo_1, photo_2, photo_3,postDate,heureDep,emailChauffeur) VALUES(:immat, :marque,
 :model, :couleur, :nbPlaces, :dateTravel, :lieuDep, :lieuArriv, :photo_1, :photo_2, :photo_3,:postDate,:heureDep,:emailChauffeur)");
$req->execute(array(
'immat' => $immat,
'marque' => $marque,
'model' => $model,
'couleur' => $couleur,
'nbPlaces' => $nbPlaces,
'dateTravel' => $dateTravel,
'lieuDep' => $lieuDep,
'lieuArriv' => $lieuArriv,
'photo_1' => $photo_1,
'photo_2' => $photo_2,
'photo_3' => $photo_3,
'postDate' => $postDate,
'heureDep'=>$heureDep,
'emailChauffeur'=>$emailChauffeur
));

echo $nbPlaces.$email;
//echo json_encode($emailChauffeur);
header('Location: index.php?page=goodPost');


?>
