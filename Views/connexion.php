<!doctype html>
<html class="no-js" lang="zxx">
    <?php include('header.php'); ?>
    <head>
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
        
        <!-- contact js
        <script src="assets/js/contact.js"></script>--> 
        <script src="assets/js/jquery.form.js"></script>
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/mail-script.js"></script>
        <script src="assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>





        <!--    -->

        <!-- MultiStep Form -->
 
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3"> 
                <h2><strong>Se connecter</strong></h2>
                <?php 
                            if (isset($_GET["error"]) && !empty($_GET["error"])) {
                                echo '<h5 style=color:red;>'.$_GET["error"] .'</h5>';
                            } ?>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" method="POST" action="index.php?page=connexion_process">
                            <!-- progressbar -->
                            
                            <!-- fieldsets --> 
                            <fieldset>
                                <div class="form-card">
     
                        <input class="form-control" name="email" id="subject" type="email" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre adresse email'" placeholder="Entrez votre adresse email">
                        <input class="form-control" name="passwordUser" id="subject" type="password" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrez votre mot de passe '" placeholder="Entrez votre mot de passe">
                        <input type="submit" name="next" id ="Soumettre"  value="Se connecter"/>  
                        <a href="index.php?page=connexion" 
                                style="color:blue;margin-left:30px;">Creer un compte</a>
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