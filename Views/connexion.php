<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
            margin-bottom: 20px;
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
            background: #38b6ff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #2a92d9;
        }

        .login-options {
            margin: 15px 0;
            font-size: 14px;
            color: #999;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-button {
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: background 0.3s;
        }

        .social-button img {
            width: 20px;
            height: 20px;
        }

        .social-button:hover {
            background: #f0f0f0;
        }

        .signup-link {
            margin-top: 20px;
            font-size: 14px;
            color: #4c306d;
            text-decoration: none;
            font-weight: bold;
            display: block;
        }

        .signup-link:hover {
            text-decoration: underline;
        }
    </style>
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
