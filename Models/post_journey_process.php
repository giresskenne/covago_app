<?php
// Start session
session_start();

// Function to handle errors and keep the user on the same page
function setError($title, $message) {
    $_SESSION['notification'] = [
        'title' => $title,
        'message' => $message
    ];
}

// Clear any existing notifications
unset($_SESSION['notification']);

// Ensure driver is logged in
if (!isset($_SESSION['email'])) {
    setError('Erreur', 'Vous devez être connecté pour publier un voyage.');
    // no redirection here, just fall through to the form display
}

$emailChauffeur = $_SESSION['email']; // Fetch email of logged-in user

$immat = filter_input(INPUT_POST, 'imat', FILTER_SANITIZE_STRING);
$marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_STRING);
$model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
$couleur = filter_input(INPUT_POST, 'couleur', FILTER_SANITIZE_STRING);
$nbPlaces = filter_input(INPUT_POST, 'nbPlaces', FILTER_VALIDATE_INT);
$dateTravel = filter_input(INPUT_POST, 'dateTravel', FILTER_SANITIZE_STRING);
$lieuDep = filter_input(INPUT_POST, 'lieuDep', FILTER_SANITIZE_STRING);
$lieuArriv = filter_input(INPUT_POST, 'lieuArriv', FILTER_SANITIZE_STRING);
$postDate = date('Y-m-d'); // Correct date format
$heureDep = filter_input(INPUT_POST, 'heureDep', FILTER_SANITIZE_STRING);

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
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg', 'tiff');
$photo_1_extension = strtolower(pathinfo($photo_1, PATHINFO_EXTENSION));
$photo_2_extension = $photo_2 ? strtolower(pathinfo($photo_2, PATHINFO_EXTENSION)) : '';
$photo_3_extension = $photo_3 ? strtolower(pathinfo($photo_3, PATHINFO_EXTENSION)) : '';

if (!in_array($photo_1_extension, $allowed_extensions)) {
    setError('Erreur', "Type de fichier invalide pour la photo 1. Seuls les fichiers JPG, JPEG, PNG, GIF, BMP, WEBP, SVG et TIFF sont autorisés.");
    // no redirection here, just fall through to the form display
}
if ($photo_2 && !in_array($photo_2_extension, $allowed_extensions)) {
    setError('Erreur', "Type de fichier invalide pour la photo 2. Seuls les fichiers JPG, JPEG, PNG, GIF, BMP, WEBP, SVG et TIFF sont autorisés.");
    // no redirection here, just fall through to the form display
}
if ($photo_3 && !in_array($photo_3_extension, $allowed_extensions)) {
    setError('Erreur', "Type de fichier invalide pour la photo 3. Seuls les fichiers JPG, JPEG, PNG, GIF, BMP, WEBP, SVG et TIFF sont autorisés.");
    // no redirection here, just fall through to the form display
}

// Ensure the first photo is uploaded
if (empty($_FILES["photo_1"]["tmp_name"])) {
    setError('Erreur', "La première photo est obligatoire.");
    // no redirection here, just fall through to the form display
} else {
    if ($_FILES["photo_1"]["error"] === UPLOAD_ERR_OK) {
        if (!move_uploaded_file($_FILES["photo_1"]["tmp_name"], "$uploads_dir/$photo_1")) {
            setError('Erreur', "Échec du téléchargement de la première photo.");
            // no redirection here, just fall through to the form display
        }
    } else {
        setError('Erreur', "Erreur lors du téléchargement de la première photo.");
        // no redirection here, just fall through to the form display
    }
}

// Move optional photos if they are provided and valid
if (!empty($_FILES["photo_2"]["tmp_name"]) && $_FILES["photo_2"]["error"] === UPLOAD_ERR_OK) {
    if (!move_uploaded_file($_FILES["photo_2"]["tmp_name"], "$uploads_dir/$photo_2")) {
        setError('Erreur', "Échec du téléchargement de la photo 2.");
        // no redirection here, just fall through to the form display
    }
}
if (!empty($_FILES["photo_3"]["tmp_name"]) && $_FILES["photo_3"]["error"] === UPLOAD_ERR_OK) {
    if (!move_uploaded_file($_FILES["photo_3"]["tmp_name"], "$uploads_dir/$photo_3")) {
        setError('Erreur', "Échec du téléchargement de la photo 3.");
        // no redirection here, just fall through to the form display
    }
}

// Continue with the rest of your logic if no errors are set...
if (!isset($_SESSION['notification'])) {
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
    exit(); // Ensure the script stops execution after redirection
}
?>
