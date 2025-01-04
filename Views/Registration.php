<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style_registration.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <?php 
        if (!empty($_GET["message"])) {
            echo '<p class="error-message">'.$_GET["message"].'</p>';
        } 
        ?>
        <form id="msform" method="POST" action="index.php?page=registrationProcess">
            <input type="email" name="email" class="input-field" placeholder="Exemple: utilisateur@email.com" required>
            <p class="error-message">
                <?php if (!empty($_GET["emailError"])) echo $_GET["emailError"]; ?>
            </p>
            <input type="number" name="phoneNumber" class="input-field" placeholder="Exemple: 612345678" required>
            <p class="error-message">
                <?php if (!empty($_GET["phoneNumberError"])) echo $_GET["phoneNumberError"]; ?>
            </p>
            <input type="password" name="passwordUser" class="input-field" placeholder="Entrez un mot de passe (min. 8 caractères)" required>
            <p class="error-message">
                <?php if (!empty($_GET["passwordUserError"])) echo $_GET["passwordUserError"]; ?>
            </p>
            <input type="password" name="passwordConfirm" id="pwdConfirm" class="input-field" placeholder="Confirmez votre mot de passe" required>
            <p id="passwordConfirmError" class="error-message"></p>
            <div class="terms">
                <input type="checkbox" required> J'ai lu et accepte <a href="index.php?page=Cgu">les conditions générales d'utilisation du site</a>
            </div><br>
            <button type="submit" class="btn-primary">S'inscrire</button>
        </form>
        <a href="index.php?page=connexion" class="login-link">Se connecter</a>
    </div>

    <script>
        document.getElementById('msform').addEventListener('submit', function(event) {
            const password = document.querySelector('[name="passwordUser"]').value;
            const passwordConfirm = document.querySelector('[name="passwordConfirm"]').value;
            const errorElement = document.getElementById('passwordConfirmError');
            errorElement.textContent = '';
            if (password !== passwordConfirm) {
                errorElement.textContent = 'Les mots de passe ne correspondent pas!';
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
