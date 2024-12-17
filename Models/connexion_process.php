<?php
// Ensure no output is sent before session_start() and header()
ob_start();

// Initialize the response array
$array = array("email" => "", "passwordUser" => "", "error" => "", "isSuccess" => "false");

// Get POST data
$array["email"] = $_POST["email"];
$array["passwordUser"] = sha1($_POST["passwordUser"]);
$email = $array["email"];
$array["isSuccess"] = true;
$passwordUser = $array["passwordUser"];

require_once 'Models/db.php';
$bdd = getBdd();

// Prepare and execute the query
$req = $bdd->prepare('SELECT id, email FROM users WHERE email = :email AND password = :password');
$req->execute(array(
    'email' => $email,
    'password' => $passwordUser
));
$resultat = $req->fetch();

// Check the result and handle accordingly
if (!$resultat) {
    $error = "Mot de passe ou identifiant incorrect !";
    header('Location: index.php?page=connexion&&error=' . $error);
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
    header('Location: index.php?page=accueil&&email=' . $_SESSION["email"]);
    exit; // Ensure script stops after redirection
}

// Encode the response array as JSON
json_encode($array);

// Flush the output buffer
ob_end_flush();
?>
