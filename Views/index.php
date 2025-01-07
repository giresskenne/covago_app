<!doctype html>
<html class="no-js" lang="zxx">
<?php include('header.php'); ?>
<link rel="stylesheet" href="assets/css/style_index.css">
<main>

    <!-- slider Area Start-->
    <div class="slider-area">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/roadside2.png">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-9 col-md-10 text-center">
                            <div class="hero__caption">
                                <h2 style="color:white">Faites de l'auto-stop de façon plus sûre et plus sécurisante</h2><br>
                            </div>
                            <div class="container">
                                <form class="container" action="index.php?page=search" method="POST" style="background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); max-width: 400px;">
                                    <h2 class="form-heading" style="font-size: 24px; font-weight: bold; color: #4c306d; margin-bottom: 20px;">Rechercher un trajet</h2>
                                    <!-- Input field for departure -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="text" name="lieuDep" id="lieuDep" class="input-field" placeholder="Départ" 
                                            oninput="showSuggestions(this.value, 'depSuggestions')" autocomplete="off" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 10px; font-size: 14px;">
                                        <div id="depSuggestions" class="suggestions"></div>
                                    </div>
                                    <!-- Input field for arrival -->
                                    <div style="margin-bottom: 20px;">
                                        <input type="text" name="lieuArriv" id="lieuArriv" class="input-field" placeholder="Destination" 
                                            oninput="showSuggestions(this.value, 'arrivSuggestions')" autocomplete="off" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 10px; font-size: 14px;">
                                        <div id="arrivSuggestions" class="suggestions"></div>
                                    </div>
                                    <!-- Search Button -->
                                    <button type="submit" id="search" class="btn-primary" style="display: block; width: 100%; padding: 12px; background: #38B6FF; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 25px; cursor: pointer; transition: background 0.3s;">Chercher</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

<!-- Our Services Start -->
        
        <!-- Online CV Area End-->
        <!-- Featured_job_start -->
        <section class="featured-job-area feature-padding" style="margin-top:-8%">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span style="color:#232323;font-weight:bold">Nos destinations</span>
                            <!--<div class=" col-offset-4" style="height:2px;background-color:black"></div> -->
                            <h2 style="color:#38B6FF">Voyages publiés récemment</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <!-- single-job-content -->
                        <?php 
                            $bdd = new PDO('mysql:host=mysql;port=3306;dbname=covago', 'root', 'root');
                            $req = $bdd->prepare('SELECT * FROM journey ORDER BY id ASC LIMIT 6');
                            $req->execute(array());
                            $dateN = time();
                            while ($resultat = $req->fetch()){
                            $id=$resultat['id'];
                            $DatePoste = $resultat["postDate"];
                            $datePost = strtotime($DatePoste);
                            $DiffDate = abs(($dateN) - ($datePost));
                            ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="#"><img src="uploads/<?= $resultat['photo_1']; ?>" class="vehicle-image" alt="image du véhicule"></a>
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a href="#">
                                                <h4><span style="color:#38B6FF">De</span> <?= $resultat['lieuDep']."<span style='color:#38B6FF'> Pour</span> ".$resultat['lieuArriv']; ?></h4>
                                            </a>
                                            <ul>
                                                <li><span>Départ prévu le</span> <span style="color:#38B6FF"><?= $resultat['dateTravel']; ?><span/></li>
                                                <li><span> à </span><span style="color:#38B6FF"><?= $resultat['heureDep']; ?><span/></li>                                          
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                        <?="<a href=index.php?page=details&amp;id=$id>Voir les détails</a>"; ?>
                                    </div>                                  
                                </div><hr>
                                <?php }?> 
                        <!-- single-job-content -->
                                <div class="items-link items-link2 f-right" style="">
                                    <a href="index.php?page=voyages ">Voir tous les voyages disponnibles</a>
                                    </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured_job_end -->
        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets/img/gallery/how-applybg.png">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span style="color:#7ED957;font-weight:bold">Fonctionnement </span>
                            <h2 style="color:#7ED957;font-weight:bold"> Comment publier un voyage?</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                               <h5>1. Créer un compte</h5></br></br>
                               <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                               <h5>2. Renseigner les informations concernant le voyage</h5>
                               <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                               <h5>3. Publier le voyage</h5></br></br>
                               <p></p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <!-- How  Apply Process End-->
        <!-- Testimonial Start -->
        <div class="testimonial-area testimonial-padding">
            <div class="container">
                <!-- Testimonial contents -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-10">
                        <div class="h1-testimonial-active dot-style">
                            <!-- Single Testimonial -->
                            <?php 
                            //include('Models/db.php'); 
                              $bdd=getBdd(); 
                              $req=$bdd->prepare('SELECT * FROM comments');
                              $req->execute(array());
                              while ($results=$req->fetch()) {
                                
                                
                                $message=$results['texte'];
                                $dateComment=$results['dateComment'];
                              ?>
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <!-- founder -->
                                    <div class="testimonial-founder  ">
                                        <div class="founder-img mb-30">
                                            <img src="assets/img/Sans titre2.jpg" alt="">
                                            <span>Achille K.</span> 
                                            <p><?= $dateComment; ?></p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“<?= $message; ?>”</p>
                                    </div>
                                </div>
                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
         <!-- Support Company Start-->
        <div class="container">
         <div class="row">
            <div class="col-12 offset-lg-2">
                <h2 class="contact-title">Laisser un commentaire</h2>
            </div>
            <div class="col-lg-8 offset-lg-2">
                <form class="form-contact contact_form" action="index.php?page=comment"  method="post" id="contactForm">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Entrer un Message'" placeholder=" Enter Message"></textarea>
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn">Envoyer</button>
                    </div>
                </form>
            </div>
            </div> 
        </div>
    </main>
    <?php include('footer1.html'); ?>        
    </body>

</main>

<!-- javascript to handle the input suggestion of cities -->
<script>
    const cities = [
        "Yaoundé",
        "Douala",
        "Bafoussam",
        "Ngaroundere",
        "Bertoua",
        "Bamenda",
        "Buea",
        "Maroua",
        "Garoua"
    ];

    function showSuggestions(value, suggestionBoxId) {
        const suggestionBox = document.getElementById(suggestionBoxId);
        suggestionBox.innerHTML = ""; // Clear previous suggestions
        suggestionBox.style.display = "none"; // Hide by default

        if (value.trim() === "") return; // If input is empty, don't show suggestions

        // Filter cities based on the input value
        const matches = cities.filter(city => city.toLowerCase().startsWith(value.toLowerCase()));

        if (matches.length > 0) {
            matches.forEach(match => {
                const div = document.createElement("div");
                div.textContent = match;

                // Add click event listener to populate input and hide suggestions
                div.addEventListener("click", function (event) {
                    event.stopPropagation(); // Prevent the document click event from firing
                    let inputId;

                    // Determine the correct input field ID based on the suggestion box ID
                    if (suggestionBoxId === 'depSuggestions') {
                        inputId = 'lieuDep';
                    } else if (suggestionBoxId === 'arrivSuggestions') {
                        inputId = 'lieuArriv';
                    }

                    const inputField = document.getElementById(inputId);

                    if (inputField) {
                        inputField.value = match; // Set the input value
                        suggestionBox.innerHTML = ""; // Clear suggestions
                        suggestionBox.style.display = "none"; // Hide suggestions
                    } else {
                        console.error(`Input field with ID ${inputId} not found`); // Debugging
                    }
                });

                suggestionBox.appendChild(div);
            });
            suggestionBox.style.display = "block"; // Show suggestions
        }
    }

    // Hide suggestions when clicking outside
    document.addEventListener("click", function (event) {
        const suggestionBoxes = document.querySelectorAll(".suggestions");
        suggestionBoxes.forEach(box => {
            box.style.display = "none";
        });
    });

    // Prevent hiding suggestions when clicking inside input or suggestion box
    document.getElementById("lieuDep").addEventListener("click", (event) => {
        event.stopPropagation();
    });
    document.getElementById("lieuArriv").addEventListener("click", (event) => {
        event.stopPropagation();
    });

</script>
</html>
