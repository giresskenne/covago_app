<?php session_start(); ?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
         <title>Trouvez rapidement des voyages  </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo_fond_blanc.jpg">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/styleS.css">
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <style>
                 body{
                    /*font-family:orkney;*/
                 }

            </style>
   </head>

   <body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="#"><img src="assets/img/logo_fond_blanc.jpg" alt="" width=105 height=65></a>
                            </div>  
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="index.php">Accueil</a></li>
                                            <li><a href="index.php?page=voyages">Trouver un voyage </a></li>
                                            <?php 
                                            if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
                                            ?>
                                            <li><a href="index.php?page=publier">Publier un voyage</a></li>
                                            <?php } else {?>
                                            <li><a href="index.php?page=registration">Publier un voyage</a></li>
                                            <?php } ?>
                                            <li><a href="index.php?page=allDriver">Tous nos chauffeurs</a></li>
                                        </ul>
                                    </nav>
                                </div>          
                                <!-- Header-btn -->
                                <?php 
                                if (isset($_SESSION["email"]) && !empty($_SESSION["email"])) {
                                    $tailleEmail= $_SESSION["email"];
                                ?>
                                <div class="header-btn d-none f-right d-lg-block">
                                    <a href="#" class="btn head-btn1" style="font-size:25px";><?= $tailleEmail[0] ?></a>
                                    <a href="index.php?page=deconnection" style="color:#38B6FF";>Deconnection</a>
                                </div><?php } else {?>
                               
                                <div class="header-btn d-none f-right d-lg-block">
                                    <a href="index.php?page=registration" class="btn head-btn1">Creer un compte</a>
                                </div><?php } ?>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none">

                            
                            </div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>
</html>