<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style_connexion.css">
    <title>Sign In</title>
</head>
<body>
    <div class="container">
        <h2>Se connecter</h2>
        <?php 
        if (isset($_GET["error"]) && !empty($_GET["error"])) {
            echo '<h5 style="color:red;">'.$_GET["error"].'</h5>';
        } ?>
        <form id="msform" method="POST" action="index.php?page=connexion_process">
            <input type="email" name="email" class="input-field" placeholder="Entrez votre adresse email" required>
            <input type="password" name="passwordUser" class="input-field" placeholder="Entrez votre mot de passe" required>
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
        <div class="login-options">Ou connectez-vous avec</div>
        <div class="social-buttons">
            <div class="social-button">
                <img src="https://img.icons8.com/color/48/facebook-circled--v1.png" alt="Facebook">
            </div>
            <div class="social-button">
                <img src="https://img.icons8.com/color/48/google-logo.png" alt="Google">
            </div>
        </div>
        <a href="index.php?page=registration" class="signup-link">Créer un compte</a>
    </div>
</body>
</html>
