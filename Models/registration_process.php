<?php
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$array = array(
    "email" => "",
    "phoneNumber" => "",
    "passwordUser" => "",
    "emailError" => "",
    "phoneNumberError" => "",
    "passwordUserError" => "",
    "isSuccess" => false
);

function verifyInput($var) {
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}

function isEmail($var) {
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $array["email"] = verifyInput($_POST["email"]);
    $array["phoneNumber"] = verifyInput($_POST["phoneNumber"]);
    $array["passwordUser"] = password_hash($_POST["passwordUser"], PASSWORD_BCRYPT); // Hash the password securely
    $array["isSuccess"] = true;
    $numberTaille = strlen($array["phoneNumber"]);
    $pwdTaille = strlen($_POST["passwordUser"]);

    // Validate phone number length
    if ($numberTaille != 9) {
        $array["phoneNumberError"] = "Veuillez entrer un numéro de téléphone à 9 chiffres";
        $array["isSuccess"] = false;
    }

    // Validate password length
    if ($pwdTaille < 8) {
        $array["passwordUserError"] = "Veuillez entrer un mot de passe avec au moins 8 caractères";
        $array["isSuccess"] = false;
    }

    $email = $array["email"];
    $phoneNumber = $array["phoneNumber"];
    $pwd = $array["passwordUser"]; // The hashed password

    include('Models/db.php');
    $bdd = getBdd();

    // Check if the phone number already exists
    $request = $bdd->prepare('SELECT * FROM users WHERE phoneNumber = :phoneNumber');
    $request->execute(['phoneNumber' => $phoneNumber]);
    if ($request->fetch()) {
        $array["phoneNumberError"] = "Ce numéro de téléphone est déjà enregistré.";
        $array["isSuccess"] = false;
    }

    // Check if the email already exists
    $request = $bdd->prepare('SELECT * FROM users WHERE email = :email');
    $request->execute(['email' => $email]);
    if ($request->fetch()) {
        $array["emailError"] = "Ce nom d'utilisateur est déjà utilisé. Veuillez renseigner un autre.";
        $array["isSuccess"] = false;
    }

    // If validation passes, insert the user into the database
    if ($array["isSuccess"] == true) {
        $req = $bdd->prepare('INSERT INTO users(email, phoneNumber, password) VALUES(:email, :phoneNumber, :password)');
        $req->execute(array(
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'password' => $pwd, // Save the hashed password
        ));

        // Store session variables
        $_SESSION["email"] = $email;
        $_SESSION["phoneNumber"] = $phoneNumber;

        $_SESSION['notification'] = [
            'title' => 'Succès',
            'message' => 'Votre Compte à été crée avec succès.',
        ];

        // Redirect to the user's account home page
        header('Location: index.php?page=accueil');
        exit;
    } else {
        // Redirect back to the registration form with errors
        header('Location: index.php?page=registration&emailError=' . urlencode($array["emailError"]) .
            '&phoneNumberError=' . urlencode($array["phoneNumberError"]) .
            '&passwordUserError=' . urlencode($array["passwordUserError"]));
        exit;
    }
}
?>
