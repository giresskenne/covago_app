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
                <h2><strong>Creer un compte</strong></h2>
                <p style="color:red"><i>vueillez remplir tous les champs s'il vous plait!</i></p>
                <div class="row">
                    <div class="col-md-12 mx-0"><p style="color:"><?php if(!empty($_GET["message"])) echo $_GET["message"]; ?> <a style="color:#7de957" href="index.php?page=profil"></a></p>
                        <form id="msform" method="POST" action="index.php?page=registrationProcess">
                            <!-- progressbar -->
                            
                            <!-- fieldsets --> 
                            <fieldset>
                                <div class="form-card">
     
                        <input  name="email"  type="text" id="email"  value="" placeholder="Entrez votre nom d'utilisateur" required/> 
                        <i><p class="coments" style="color:red"><?php if(!empty($_GET["emailError"])) echo $_GET["emailError"]; ?></p></i>
                        <input  name="phoneNumber" id="numero" type="number"   placeholder="Entrez le numero de telephone" required>
                        <i><p class="coments" style="color:red"><?php if(!empty($_GET["phoneNumberError"])) echo $_GET["phoneNumberError"]; ?></p></i>
                        <input  name="passwordUser" id="pwd" type="password"  required placeholder="Entrez le mot de passe" >
                        <i><p class="coments" style="color:red"><?php if(!empty($_GET["passwordUserError"])) echo $_GET["passwordUserError"]; ?></p></i>
                        <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                        <label class="custom-control-label" for="customCheckRegister"><span>J'ai lu et accepte  <a href="index.php?page=Cgu" class=" text text-info">les conditions generales d'utilisations du site</a></span></label>
                      </div></br></br>
                        <input type="submit" name="next" id ="Soumettre"  value="S'inscrire" 
                        style="width:100%;height:50px;background:#7de957;font-size:20px;line-height:1;
                                       text-align:center;color:#fff;display:block;padding:15px;border-radius:0px;
                                       text-transform:capitalize;" />  
                        <center><a href="index.php?page=connexion" 
                                style="color:#38B6FF;margin-left:30px;">Se connecter</a></center>
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