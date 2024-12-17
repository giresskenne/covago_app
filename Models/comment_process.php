<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = isset($_POST["message"]) ? $_POST["message"] : ''; // Check if 'message' key is set
    $datePost = date('y-m-d');
    echo $datePost;
    include('Models/db.php');
    $bdd = getBdd();
    $req = $bdd->prepare('INSERT INTO comments(texte, dateComment) VALUES(:texte, :dateComment)');
    $req->execute(array(
        'texte' => $message,
        'dateComment' => $datePost,
    ));
    header('Location: Views/goodAccount.php?message=' . $message);
    exit;
}
?>
