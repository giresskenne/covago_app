<!doctype html>
<html class="no-js" lang="zxx">
<?php include('header.php'); ?>
    <main>

        <!-- slider Area Start-->
        <div class="slider-area " style="">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="assets/img/hero/istockphoto-492310846-612x612.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-md-10">
                                <div class="hero__caption">
                                    <h2 style="color:white">Retrouvez des vehicules personnels pour vos voyages ou que vous 
                                        soyez c'est simple  dites:</h2></br>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-8">
                                <!-- form -->
                                <form  class="search-box" action="index.php?page=search" method='POST'>
                                <div class="select-form">
                                        <div class="select-itms">
                                            <select name="lieuDep" id="select1">
                                                <option value="">--Où vous trouvez-vous?--</option>
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
                                    </div>
                                    <div class="select-form">
                                        <div class="select-itms">
                                            <select name="lieuArriv" id="select1">
                                                <option value="">--Où vous rendez-vous?--</option>
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
                                    </div> 
                                    <div class="search-form"> 
                                       <input type="submit" id="search" value="Chercher" class="button1" style="width:100%;height:70px;background:#38B6FF;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;border-radius:0px;text-transform:capitalize;border: 0px #38B6FF;font-family:"Muli",sans-serif;letter-spacing:0.1em;line-height:1.2;line-height:38px;font-size:14px;">
                                   </div> 
                                </form>	
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
                            <h2 style="color:#38B6FF">Voyages publiés recemment</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <!-- single-job-content -->
                        <?php 
                            $bdd = new PDO('mysql:host=localhost;dbname=klando', 'root', '');
                            $req = $bdd->prepare('SELECT * FROM journey ORDER BY id ASC LIMIT 6');
                            $req->execute(array());
                            $dateN = time();
                            while ($resultat = $req->fetch()){
                            $id=$resultat['id'];
                            $DatePoste = $resultat["postDate"];
                            $datePost = strtotime($DatePoste);
                            $DiffDate = abs(($dateN) - ($datePost));
            
                            /*$retour = array();
                            $retour['second'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['second']) / 60);
                            $retour['minute'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['minute']) / 60);
                            $retour['hour'] = $DiffDate % 24;
                            $DiffDate = floor(($DiffDate - $retour['hour']) / 24);
                            $retour['day'] = $DiffDate;*/
                            ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="#"><img src="assets/img/<?= $resultat['photo_1']; ?>" alt="" width="80" height="80"></a>
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a href="#">
                                                <h4><span style="color:#38B6FF">De</span> <?= $resultat['lieuDep']."<span style='color:#38B6FF'> Pour</span> ".$resultat['lieuArriv']; ?></h4>
                                            </a>
                                            <ul>
                                                <li><span>Depart prévu le</span> <span style="color:#38B6FF"><?= $resultat['dateTravel']; ?><span/></li>
                                                <li><span> à </span><span style="color:#38B6FF"><?= $resultat['heureDep']; ?><span/></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                        <?="<a href=index.php?page=details&amp;id=$id>Voir les details</a>"; ?>
                                        
                                        
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
                               <h5>1. Creer un compte</h5></br></br>
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
                                            <span>User </span> 
                                            <p><?= $dateComment; ?></p>
                                        </div>
                                    </div>
                                    <div class="testimonial-top-cap">
                                        <p>“kkkkkk<?= $message; ?>”</p>
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
    </div>
    <?php include('footer1.html'); ?>     
   
        
    </body>
</html>