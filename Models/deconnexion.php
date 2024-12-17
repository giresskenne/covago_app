<?php
// Check if a session is already started before starting a new session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

// Ensure no output is sent before calling header
ob_start();
header('Location: index.php?page=accueil&message=Vous avez bien été déconnecté');
ob_end_flush();
exit;
?>
