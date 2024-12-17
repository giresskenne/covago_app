<?php
// Start output buffering
ob_start();

// Retrieve session email (currently logged-in user)
session_start();
if (!isset($_SESSION['email'])) {
    die("Vous devez être connecté pour publier un voyage.");
}

$emailChauffeur = $_SESSION['email']; // Fetch email of logged-in user

$immat = $_POST["imat"];
$marque = $_POST["marque"];
$model = $_POST["model"];
$couleur = $_POST["couleur"];
$nbPlaces = $_POST["nbPlaces"];
$dateTravel = $_POST["dateTravel"];
$lieuDep = $_POST["lieuDep"];
$lieuArriv = $_POST["lieuArriv"];
$postDate = date('y/m/d');
$heureDep = $_POST["heureDep"];

include('Models/db.php'); 
$bdd = getBdd();

// Handle file uploads: if the "uploads" directory doesn't exist, it will be created
$uploads_dir = 'uploads';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0755, true);
}

$photo_1 = $_FILES["photo_1"]["name"];
$photo_2 = isset($_FILES["photo_2"]["name"]) ? $_FILES["photo_2"]["name"] : null;
$photo_3 = isset($_FILES["photo_3"]["name"]) ? $_FILES["photo_3"]["name"] : null;

// Validate file types
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
$photo_1_extension = strtolower(pathinfo($photo_1, PATHINFO_EXTENSION));
$photo_2_extension = strtolower(pathinfo($photo_2, PATHINFO_EXTENSION));
$photo_3_extension = strtolower(pathinfo($photo_3, PATHINFO_EXTENSION));

if (!in_array($photo_1_extension, $allowed_extensions)) {
    die("Invalid file type for photo 1. Only JPG, JPEG, PNG, and GIF files are allowed.");
}
if ($photo_2 && !in_array($photo_2_extension, $allowed_extensions)) {
    die("Invalid file type for photo 2. Only JPG, JPEG, PNG, and GIF files are allowed.");
}
if ($photo_3 && !in_array($photo_3_extension, $allowed_extensions)) {
    die("Invalid file type for photo 3. Only JPG, JPEG, PNG, and GIF files are allowed.");
}

// Ensure the first photo is uploaded
if (!empty($_FILES["photo_1"]["tmp_name"])) {
    if ($_FILES["photo_1"]["error"] === UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES["photo_1"]["tmp_name"], "$uploads_dir/$photo_1");
    } else {
        die("Error uploading the first photo.");
    }
} else {
    die("The first photo is required.");
}

// Move optional photos if they are provided and valid
if (!empty($_FILES["photo_2"]["tmp_name"]) && $_FILES["photo_2"]["error"] === UPLOAD_ERR_OK) {
    move_uploaded_file($_FILES["photo_2"]["tmp_name"], "$uploads_dir/$photo_2");
}
if (!empty($_FILES["photo_3"]["tmp_name"]) && $_FILES["photo_3"]["error"] === UPLOAD_ERR_OK) {
    move_uploaded_file($_FILES["photo_3"]["tmp_name"], "$uploads_dir/$photo_3");
}

// Insert the journey into the database
$req = $bdd->prepare("
    INSERT INTO journey (immat, marque, model, couleur, nbPlaces, 
    dateTravel, lieuDep, lieuArriv, photo_1, photo_2, photo_3, postDate, heureDep, emailChauffeur) 
    VALUES (:immat, :marque, :model, :couleur, :nbPlaces, :dateTravel, :lieuDep, :lieuArriv, :photo_1, :photo_2, :photo_3, :postDate, :heureDep, :emailChauffeur)
");
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
    'heureDep' => $heureDep,
    'emailChauffeur' => $emailChauffeur
));

// Retrieve the ID of the newly inserted journey
$journeyId = $bdd->lastInsertId();

// Redirect to goodPost.php with the journey ID and success message
header('Location: index.php?page=goodPost&message=Votre+voyage+a+été+publié+avec+succès&id=' . $journeyId);
ob_end_flush(); // Flush the output buffer
exit; // Ensure the script stops execution after redirection
?>
