<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        @font-face {
            font-family: 'Orkney';
            src: url('../assets/fonts/orkney/orkney-regular-webfont.woff2') format('woff2'),
                 url('../assets/fonts/orkney/orkney-regular-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Orkney', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #38b6ff, #7ed957);
        }

        .container {
            width: 350px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .container h2 {
            font-size: 24px;
            font-weight: bold;
            color: #4c306d;
            margin-bottom: 10px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 14px;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 12px;
            background: #7ed957;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #68c74b;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #38b6ff;
            text-decoration: none;
            font-weight: bold;
            display: block;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .terms {
            font-size: 14px;
            text-align: left;
            margin-top: 15px;
        }

        .terms a {
            color: #38b6ff;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .custom-control {
            margin-top: 15px;
        }

        .custom-checkbox input {
            margin-right: 10px;
        }

        .error-message {
            color: red;
            margin: 5px 0;
            font-size: 13px;
            text-align: left;
        }
    </style>
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
            </div>
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
