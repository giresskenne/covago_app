<!doctype html>
<html class="no-js" lang="zxx">
    <?php //session_start();
     include('header.php'); ?>
    <head>
        <title>Publier un voyage c'est simple!</title>
    </head>
    <!-- Hero Area Start-->
    
                
    <!-- ================ contact section end ================= -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/slick.min.js"></script>
        <script src="assets/js/price_rangs.js"></script>
        
		<!-- One Page, Animated-HeadLin -->
        <script src="assets/js/wow.min.js"></script>
		<script src="assets/js/animated.headline.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="assets/js/jquery.scrollUp.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
		<script src="assets/js/jquery.sticky.js"></script>
        <script src="assets/js/styleS.js"></script>
        <!-- contact js 
        <script src="assets/js/contact.js"></script>
        <script src="assets/js/jquery.form.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/mail-script.js"></script>
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>-->
        
		<!-- Jquery Plugins, main Jquery	
        <script src="assets/js/plugins.js"></script>-->
        <script src="assets/js/main.js"></script> 




 
        <!--    -->

        <!-- MultiStep Form -->
 
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <?php 
                if (isset($_GET["message"])) {
                    $message=$_GET["message"];
                    echo $_SESSION["email"].$_SESSION["phoneNumber"];
                ?>
                <h3 style="color:green"><strong><?= $message ?></strong></h3>
                <?php
                 }
                ?>
                <div class="row">
                    <div class="col-md-12 mx-0">
                       
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Reussi !</h2>
                                    <br>
                                    <h2><strong class="text text-success">Votre  voyage a été publié avec succes</strong></h2>
                                    <h5><li><a href="index.php?page=publier" class="text text-info">Publier un autre voyage</a></li></h5>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="h5">Vous pouvez maintenant <a href="" class="text text-primary"> consulter votre voyage</a> a la page d'accueil ou grace a la barre de recherche</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </body>
    
    </html>