<?php
// Ensure no output is sent before session_start() and header()
ob_start();

// Initialize the response array
$array = array("email" => "", "passwordUser" => "", "error" => "", "isSuccess" => "false");

// Get POST data
$array["email"] = $_POST["email"];
$array["passwordUser"] = $_POST["passwordUser"]; // Keep the plain-text password
$email = $array["email"];
$passwordUser = $array["passwordUser"];
$array["isSuccess"] = true;

require_once 'Models/db.php';
$bdd = getBdd();

try {
    // Prepare and execute the query to fetch the hashed password
    $req = $bdd->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $req->execute(array('email' => $email));
    $resultat = $req->fetch();

    // Check if the email exists and validate the password
    if (!$resultat || !password_verify($passwordUser, $resultat['password'])) {
        $error = "Mot de passe ou identifiant incorrect !";
        header('Location: index.php?page=connexion&&error=' . urlencode($error));
        exit; // Ensure script stops after redirection
    } else {
        $array["isSuccess"] = true;

        // Start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Store user information in session
        $_SESSION["email"] = $resultat['email'];
        $_SESSION["user_id"] = $resultat['id']; // Store user_id for future reference

        // Redirect to home page
        header('Location: index.php?page=accueil&&email=' . urlencode($_SESSION["email"]));
        exit; // Ensure script stops after redirection
    }
} catch (Exception $e) {
    // Handle any potential errors
    $error = "Erreur serveur. Veuillez réessayer plus tard.";
    header('Location: index.php?page=connexion&&error=' . urlencode($error));
    exit; // Ensure script stops after redirection
}

// Encode the response array as JSON
json_encode($array);

// Flush the output buffer
ob_end_flush();
?>
