<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title>Publier un voyage c'est simple!</title>
</head>
    <?php //session_start();
     include('header.php'); 
    ?>
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
        <script src="assets/js/styleS.js"></script> <!-- I have updated this code to validate the dateTravel and heureDep  -->
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
                    //echo $_SESSION["email"].$_SESSION["phoneNumber"];
                ?>
                <h3 style="color:green"><strong><?= $message ?></strong></h3>
                <?php
                 }
                ?>
                <h2><strong>Publier un voyage</strong></h2>
                <!-- <p id="oblig" style="color:red"><i> Remplir tous ces champs pour passer a la prochaine etape</i></p> -->
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" enctype="multipart/form-data" method ="POST" action="index.php?page=post_process">

                            <fieldset class="form-card0">   
                                <div class="form-card" style="">
                                    <h2 class="fs-title">Information concernant le voyage</h2></br>
                                    <p id="oblig" style="color:red"><i> Remplir tous ces champs pour passer a la prochaine etape</i></p>
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="pay">Lieu de depart</label>
                                        </div>
                                        <div class="col-9">
                                            <select class="list-dt" id="month" name="lieuDep">
                                            <option value="Yaoundé ">Yaoundé</option>
                                            <option value="Douala">Douala</option>
                                            <option value="Bafoussam">Bafoussam</option>
                                            <option value="Ngaroundere">Ngaroundere</option>
                                            <option value="Bertoua">Bertoua</option>
                                            <option value="Bamenda">Bamenda</option>
                                            <option value="Buea">Buea</option>
                                            <option value="Maroua">Maroua</option>
                                            <option value="Garoua">Garoua</option>
                                            </select>
                                            
                                            <label class="pay">Destination</label>
                                  
                                            <select class="list-dt" id="month" name="lieuArriv">
                                            <option value="Yaoundé ">Yaoundé</option>
                                            <option value="Douala">Douala</option>
                                            <option value="Bafoussam">Bafoussam</option>
                                            <option value="Ngaroundere">Ngaroundere</option>
                                            <option value="Bertoua">Bertoua</option>
                                            <option value="Bamenda">Bamenda</option>
                                            <option value="Buea">Buea</option>
                                            <option value="Maroua">Maroua</option>
                                            <option value="Garoua">Garoua</option>
                                            </select>
                                        </div>
                                    </div></br>
                                    <label>Date de départ: </label>
                                        <input name="dateTravel" type="date" id="dateTravel" placeholder="Entrez la date de voyage" required>
                                        <p class="dateTravel" style="display:none;color:red"><i>Svp renseignez une date valide pour votre voyage</i></p>
                                        <label>Heure de départ: </label>
                                        <input name="heureDep" type="time" id="heureDep" placeholder="Entrez l'heure de départ" required>
                                        <p class="heureDep" style="display:none;color:red"><i>Svp renseignez une heure valide pour votre voyage</i></p>
                                        <input name="nbPlaces" id="nbPlaces" type="number" placeholder="Entrez le nombre de place">
                                        <p class="nbPlaces" style="display:none;color:red"><i>Svp renseignez le nombre de place disponible pour votre voyage</i></p>
                                    </div>
                                    <input type="button" name="next" class="next1" value="Suivant" style="width:100%;height:50px;background:#7de957;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;">
                                </fieldset>
                            <fieldset class="form-card1">
                                <div class="form-card">
                                    <h2 class="fs-title">Informations concernant le vehicule</h2></br>
                                    <p id="oblig" style="color:red"><i> Remplir tous ces champs pour passer a la prochaine etape</i></p>
                                    <input class="form-control" name="imat" id="immat" type="text"   placeholder="Entrez L'immatriculation du vehicule">
                                <p class="immat" style="display:none;color:red"><i>Svp renseignez l'immatriculation du vehicule</i></p>
                                    <input class="form-control" name="marque" id="marque" type="text"   placeholder="Entrez la marque du vehicule">
                                <p class="marque" style="display:none;color:red"><i>Svp renseignez la marque du vehicule</i></p>
                                    <input class="form-control" name="model" id="model" type="text"   placeholder="Entrez le model du vehicule">
                                <p class="model" style="display:none;color:red"><i>Svp renseignez le model du vehicule</i></p>
                                    <input class="form-control" name="couleur" id="couleur" type="text"   placeholder="Entrez la couleur du vehicule">
                                <p class="couleur" style="display:none;color:red"><i>Svp renseignez la couleur du vehicule</i></p>
                                </div>
                                <input type="submit" name="previous" class="previous action-button-previous" 
                                 value="Precedent" style="width:100%;height:50px;;font-size:20px;line-height:1;
                                       text-align:center;color:#fff;display:block;padding:15px;"/>

                                <input type="submit" name="next" class="next2" value="Suivant" style="width:100%;
                                height:50px;background:#7de957;font-size:20px;line-height:1;
                                       text-align:center;color:#fff;display:block;padding:15px;"/>
                            </fieldset>
<!-- The enctype="multipart/form-data" attribute is added to the <form> tag to handle file uploads. -->
                      <!-- Photos of the Vehicle Fieldset -->
                            <fieldset class="form-card2">
                                <div class="form-card">
                                    <h2 class="fs-title">Photos du véhicule</h2></br>
                                    <p id="oblig" style="color:red"><i> Svp telechargez la photo complete du vehicule</i></p>
                                    <input class="form-control" name="photo_1" id="photo_1" type="file" required placeholder="Téléchargez la photo complète">
                                    <p class="photo_1" style="display:none;color:red"><i>Svp téléchargez la photo complète du véhicule</i></p>
                                    <input class="form-control" name="photo_2" id="photo_2" type="file" placeholder="Téléchargez une vue de face">
                                    <p class="photo_2" style="display:none;color:red"><i>Svp téléchargez une vue de face du véhicule</i></p>
                                    <input class="form-control" name="photo_3" id="photo_3" type="file" placeholder="Téléchargez une vue de haut">
                                    <p class="photo_3" style="display:none;color:red"><i>Svp téléchargez une vue de haut du véhicule</i></p>
                                    <input class="form-control" name="email" id="email" type="text" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>">
                                    <p class="text text-success">L'ajout des autres photos est facultatif mais recommandé pour plus de visibilité.</p>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Précédent" 
                                       style="width:100%;height:50px;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;"/>
                                <input type="button" name="next" class="next3" value="Suivant" 
                                       style="width:100%;height:50px;background:#7de957;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;"/>
                            </fieldset>

                            <!-- New Confirmation Fieldset -->
                            <fieldset class="form-card3">
                                <div class="form-card">
                                    <h2 class="fs-title">Confirmer les informations</h2>
                                    <p>
                                        <strong>Lieu de départ:</strong> <span id="confirm-lieuDep"></span>
                                        <button type="button" class="edit-button" data-target=".form-card0">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Destination:</strong> <span id="confirm-lieuArriv"></span>
                                        <button type="button" class="edit-button" data-target=".form-card0">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Date de départ:</strong> <span id="confirm-dateTravel"></span>
                                        <button type="button" class="edit-button" data-target=".form-card0">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Heure de départ:</strong> <span id="confirm-heureDep"></span>
                                        <button type="button" class="edit-button" data-target=".form-card0">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Nombre de places:</strong> <span id="confirm-nbPlaces"></span>
                                        <button type="button" class="edit-button" data-target=".form-card0">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Immatriculation:</strong> <span id="confirm-immat"></span>
                                        <button type="button" class="edit-button" data-target=".form-card1">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Marque:</strong> <span id="confirm-marque"></span>
                                        <button type="button" class="edit-button" data-target=".form-card1">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Modèle:</strong> <span id="confirm-model"></span>
                                        <button type="button" class="edit-button" data-target=".form-card1">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Couleur:</strong> <span id="confirm-couleur"></span>
                                        <button type="button" class="edit-button" data-target=".form-card1">Modifier</button>
                                    </p>
                                    <p>
                                        <strong>Photos:</strong>
                                        <button type="button" class="edit-button" data-target=".form-card2">Modifier</button>
                                    </p>
                                    <div>
                                        <img id="confirm-photo1" style="max-width: 200px; display: none;" alt="Photo 1 Preview">
                                        <img id="confirm-photo2" style="max-width: 200px; display: none;" alt="Photo 2 Preview">
                                        <img id="confirm-photo3" style="max-width: 200px; display: none;" alt="Photo 3 Preview">
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous" value="Précédent" style="width:100%;height:50px;background:#ccc;font-size:20px;line-height:1;text-align:center;color:#000;display:block;padding:15px;">
                                <input type="submit" name="final_post" class="final_post" value="Publier" style="width:100%;height:50px;background:#7de957;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;">
                            </fieldset>
                                        

                            <!-- a verifier car affice l'icone "succes" en pied de page -->
                        </form>
                            <!-- <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Reussi !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="h5">Votre  voyage a été publié avec success</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</html>