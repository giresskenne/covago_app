<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = isset($_POST["message"]) ? $_POST["message"] : ''; // Check if 'message' key is set
    $datePost = date('y-m-d');

    include('Models/db.php');
    $bdd = getBdd();

    try {
        $req = $bdd->prepare('INSERT INTO comments(texte, dateComment) VALUES(:texte, :dateComment)');
        $req->execute(array(
            'texte' => $message,
            'dateComment' => $datePost,
        ));

        // Set session variable for the notification
        $_SESSION['notification'] = [
            'title' => 'Succès',
            'message' => 'Votre commentaire a été enregistré avec succès.',
        ];

        // Redirect to the same page or another page
        header('Location: index.php?page=accueil');
        exit;
    } catch (Exception $e) {
        $_SESSION['notification'] = [
            'title' => 'Erreur',
            'message' => 'Une erreur s\'est produite lors de l\'enregistrement de votre commentaire.',
        ];
        header('Location: index.php?page=accueil');
        exit;
    }
}
?>
