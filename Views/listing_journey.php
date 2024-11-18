<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <style> 
          
        </style>
    </head>
    <?php include('header.php'); ?>
    <main  style="background-color:whitesmoke"></hr></br></br>
     <!-- Hero Area End -->
     <div class="row"  style="background-color:backgroung-image:url()">
                            <div class="col-xl-8">
                                <!-- form <h6><center>trouver facilement un voyage c'est simple dites:</h6>-->
                                <form action="index.php?page=search1" method="POST" class="search-box">
                                    <div class="input-form">
                                       <!-- <input type="text" placeholder="Job Tittle or keyword">-->
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
                                    <input type="submit" id="search" value="Chercher" class="button1" style="width:100%;height:70px;background:#38B6FF;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;border-radius:0px;text-transform:capitalize;border: 0px #fb246a;font-family:"Muli",sans-serif;letter-spacing:0.1em;line-height:1.2;line-height:38px;font-size:14px;">
                                    </div>	
                                </form>	
                            </div>
                        </div>
                    </div></br></br>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Trouvez le voyage de votre choix parmis tous les <a href="#"  style="color:#38B6FF"><?= $nombre ?> Voyages disponnibles</a> </h2> 
                    </div>
                </div>
            </div>
        </div></br></br>

        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                
                                <?php 
                                $dateN = time();
                                //include('Models/db.php');
                                if (isset($_GET["seite"]) && !empty($_GET["seite"])) {
                                    $seite=intval($_GET["seite"]);
                                    $pageCourante=$_GET["seite"];
                                }
                                else{
                                    $pageCourante=1;
                                }
                                
                                $bdd=getBdd();
                                $req = $bdd->prepare('SELECT * FROM journey');
                                $req->execute(array());
                                $nbre_element_page=5;
                                $nbre_elmt=$req->rowCount();
                                $nbre=ceil($nbre_elmt/$nbre_element_page);
                                $depart=($pageCourante-1)*$nbre_element_page;
                                //$todayDate=date('y/m/d');
                                $qer = $bdd->prepare("select * from journey order by id desc limit $depart,$nbre_element_page");
                                $qer->execute(array());
                                while ($resultat = $qer->fetch()){ 
                                    $id=$resultat['id'];
                                    $DatePoste = $resultat["postDate"];
                            $datePost = strtotime($DatePoste);
                            $DiffDate = abs(($dateN) - ($datePost));
            
                            $retour = array();
                            $retour['second'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['second']) / 60);
                            $retour['minute'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['minute']) / 60);
                            $retour['hour'] = $DiffDate % 24;
                            $DiffDate = floor(($DiffDate - $retour['hour']) / 24);
                            $retour['day'] = $DiffDate;
                                 //echo $resultat['photo_1']; ?>
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
                                        <span>Publié Il y a <?php  echo $retour['day']; ?> Jours</span>
                                    </div>
                                </div><hr>
                                <?php } ?> 
                                <!-- single-job-content -->
                            </div>
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!--Pagination Start  -->
        <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <?php
                                    for ($i=1; $i <=$nbre ; $i++) {   
                                    echo "<li class=items-link items-link2 f-right active><a style=border-color:#8b92dd 1px class=page-link href=index.php?page=voyages&amp;seite=$i>
                                    $i</a></li>";
                                }
                                    ?>
                                    
                                    
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pagination End  -->
        
    </main>
<?php include('footer.html'); ?>
        
    </body>
</html>