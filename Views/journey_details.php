<!doctype html>
<html class="no-js" lang="zxx">
<?php include('header.php'); ?>
    <main style="background-color:whitesmoke"></hr></br></br>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Voici les détails concernant le voyage que vous avez sélectionné</a> </h2>
                    </div>
                </div>
                </div>
            </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    
                    <!-- Right Content -->
                    <div class="col-xl-10 col-md-offset-2" >
                        <?php 
                           require 'Models/journey_details.php';
                           $id=$_GET["id"]; //echo $id;
                           $resultat  = getJourneyDetails($id);
                           $emailChauffeur=$resultat['emailChauffeur'];
                           $bdd=getBdd();
                           $reqx = $bdd->prepare('SELECT * FROM users WHERE email=?');
                           $reqx->execute(array($emailChauffeur));
                           $result = $reqx->fetch();
                           //var_dump($result);
                        
                            ?>
                        <div class="post-details3  mb-50"  style="background-color:white">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4><span style="color:#38B6FF">De</span> <?= $resultat['lieuDep']."<span style='color:#38B6FF'> Pour</span> ".$resultat['lieuArriv']; ?></h4>
                           </div>
                           
                           <ul>
                              <li>Date de depart : <span><?= $resultat['dateTravel']; ?></span></li>
                              <li>Heure de depart : <span><?= $resultat['heureDep']; ?></span></li>
                              <li>Lieu de depart : <span><?= $resultat['lieuDep']; ?></span></li>
                              <li>Destination : <span><?= $resultat['lieuArriv']; ?></span></li>
                              <li>Nombre de place  :  <span><?= $resultat['nbPlaces']; ?></span></li>
                              <li>Numero du chauffeur  : <span>+237 <?= $result['phoneNumber']; ?></span></li>

                              <div class="apply-btn2">
                                 <button class="btn" id="seeMore">Voir plus</button> 
                              </div>
                              <div class="apart" style="display:none"> <h3 style="color:#38B6FF">Infos concernant le vehicule</h3>
                              <li>Marque : <span><?= $resultat['marque']; ?></span></li>
                              <li>Modele : <span><?= $resultat['model']; ?></span></li>
                              <li>Couleur : <span><?= $resultat['couleur']; ?></span></li>
                              <li>Matricule : <span><?= $resultat['immat']; ?></span></li>  
                              <h3 style="color:#38B6FF">Images du  vehicule</h3> 
                              <div class="row">
                                 <div class="col-m-3">
                                     <img src="assets/img/<?= $resultat['photo_1']; ?>" width="400" height="400" alt="">
                                 </div><div class="col-m-3">
                                 <img src="assets/img/<?= $resultat['photo_2']; ?>" width="400" height="400" alt="">
                                 </div><div class="col-m-3">
                                 <img src="assets/img/<?= $resultat['photo_3']; ?>" width="400" height="400" alt="">
                                 </div></div>
                              </div>
                          </ul>
                       </div>
                      
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

    </main>
   <?php include('footer.html'); ?>
        
    </body>
</html>