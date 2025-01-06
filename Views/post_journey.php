<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title>Publier un voyage c'est simple!</title>
    <!-- Link to the new CSS file -->
    <!-- <link rel="stylesheet" href="assets/css/style_connexion.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="assets/css/responsive_post_journey.css" type="text/css"> -->
    <link rel="stylesheet" href="assets/css/style_post_journey.css" type="text/css">
</head>
<body>

    <!-- Notification System -->
    <?php session_start(); ?>
    <?php if (isset($_SESSION['notification'])): ?>
        <div style="color:red; font-weight:bold; margin-bottom:20px;">
            <h3><?= $_SESSION['notification']['title'] ?></h3>
            <p><?= $_SESSION['notification']['message'] ?></p>
        </div>
        <?php unset($_SESSION['notification']); // Clear the notification ?>
    <?php endif; ?>

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

    <div class="container">
        <h2>Publier un voyage</h2>
        <form id="msform" enctype="multipart/form-data" method="POST" action="index.php?page=post_process">

            <!-- Step 1 -->
            <fieldset>
                <h2>Informations concernant le voyage</h2>
                <p class="error-message" style="display: none; color: red;">Remplir tous ces champs pour passer à la prochaine étape</p>
                <label for="lieuDep">Lieu de départ</label>
                <select class="input-field" id="lieuDep" name="lieuDep" required>
                    <option value="">Choisissez</option>
                    <option value="Yaoundé">Yaoundé</option>
                    <option value="Douala">Douala</option>
                </select>
                <label for="lieuArriv">Destination</label>
                <select class="input-field" id="lieuArriv" name="lieuArriv" required>
                    <option value="">Choisissez</option>
                    <option value="Yaoundé">Yaoundé</option>
                    <option value="Douala">Douala</option>
                </select>
                <label>Date de départ:</label>
                <input class="input-field" type="date" id="dateTravel" name="dateTravel" required>
                <p class="dateTravel" style="display: none; color: red;">Svp renseignez une date valide</p>
                <label>Heure de départ:</label>
                <input class="input-field" type="time" id="heureDep" name="heureDep" required>
                <p class="heureDep" style="display: none; color: red;">Svp renseignez une heure valide</p>
                <input class="input-field" type="number" id="nbPlaces" name="nbPlaces" placeholder="Nombre de places" required>
                <p class="nbPlaces" style="display: none; color: red;">Svp renseignez un nombre valide</p>
                <button type="button" class="next1 btn-primary">Suivant</button>
            </fieldset>

            <!-- Step 2 -->
            <fieldset>
                <h2>Informations concernant le véhicule</h2>
                <input class="input-field" type="text" id="immat" name="immat" placeholder="Immatriculation du véhicule" required>
                <p class="immat" style="display: none; color: red;">Svp renseignez l'immatriculation</p>
                <input class="input-field" type="text" id="marque" name="marque" placeholder="Marque" required>
                <p class="marque" style="display: none; color: red;">Svp renseignez la marque</p>
                <input class="input-field" type="text" id="model" name="model" placeholder="Modèle" required>
                <p class="model" style="display: none; color: red;">Svp renseignez le modèle</p>
                <input class="input-field" type="text" id="couleur" name="couleur" placeholder="Couleur" required>
                <p class="couleur" style="display: none; color: red;">Svp renseignez la couleur</p>
                <button type="button" class="previous btn-primary">Précédent</button>
                <button type="button" class="next2 btn-primary">Suivant</button>
            </fieldset>

            <!-- Step 3 -->
            <fieldset>
                <h2>Photos du véhicule</h2>
                <p class="error-message" style="display: none; color: red;">Téléchargez la photo complète du véhicule</p>
                <input class="input-field" type="file" id="photo_1" name="photo_1" required>
                <p class="photo_1" style="display: none; color: red;">Svp téléchargez la photo complète</p>
                <input class="input-field" type="file" id="photo_2" name="photo_2">
                <input class="input-field" type="file" id="photo_3" name="photo_3">
                <button type="button" class="previous btn-primary">Précédent</button>
                <button type="button" class="next3 btn-primary">Suivant</button>
            </fieldset>

            <!-- Step 4 -->
            <fieldset>
                <h2>Confirmez vos informations</h2>
                <div id="confirmation-section">
                    <h3>Informations sur le Voyage:</h3>
                    <p><strong>Lieu de départ:</strong> <span id="confirm-lieuDep"></span></p>
                    <p><strong>Destination:</strong> <span id="confirm-lieuArriv"></span></p>
                    <p><strong>Date de départ:</strong> <span id="confirm-dateTravel"></span></p>
                    <p><strong>Heure de départ:</strong> <span id="confirm-heureDep"></span></p>
                    <p><strong>Nombre de places:</strong> <span id="confirm-nbPlaces"></span></p>
                    <h3>Informations sur le Véhicule:</h3>
                    <p><strong>Immatriculation:</strong> <span id="confirm-immat"></span></p>
                    <p><strong>Marque:</strong> <span id="confirm-marque"></span></p>
                    <p><strong>Modèle:</strong> <span id="confirm-model"></span></p>
                    <p><strong>Couleur:</strong> <span id="confirm-couleur"></span></p>
                </div>
                <button type="button" class="previous btn-primary">Précédent</button>
                <button type="submit" class="btn-primary">Confirmer et Publier</button>
            </fieldset>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const steps = document.querySelectorAll("fieldset");
            let currentStep = 0;

            function showStep(stepIndex) {
                steps.forEach((step, index) => {
                    step.style.display = index === stepIndex ? "block" : "none";
                });
            }

            function validateStep(stepIndex) {
                let valid = true;
                const inputs = steps[stepIndex].querySelectorAll("input, select");
                inputs.forEach(input => {
                    if (!input.value) {
                        valid = false;
                        const error = document.querySelector(`.${input.id}`);
                        if (error) error.style.display = "block";
                    } else {
                        const error = document.querySelector(`.${input.id}`);
                        if (error) error.style.display = "none";
                    }
                });
                return valid;
            }

            document.querySelectorAll(".next1, .next2, .next3").forEach((button, index) => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (validateStep(currentStep)) {
                        currentStep++;
                        showStep(currentStep);
                    }
                });
            });

            document.querySelectorAll(".previous").forEach(button => {
                button.addEventListener("click", function (e) {
                    e.preventDefault();
                    if (currentStep > 0) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            });

            showStep(currentStep);
        });
    </script>
</body>
</html>