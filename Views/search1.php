<!doctype html>
<html class="no-js" lang="zxx">
    <?php include('header.php'); ?>
    <main  style="background-color:whitesmoke"></hr></br></br>
    <?php
    $bdd=getBdd();
    $req = $bdd->prepare('SELECT * FROM journey WHERE  lieuArriv=?');
    $req->execute(array($_POST["lieuArriv"]));
    $nbre_elmt=$req->rowCount();
    if ($nbre_elmt<>0) {
    ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Voici la liste des voyages correspondant a votre recherche</a> </h2> 
                    </div>
                </div>
            </div>
        </div>
        <?php } else {?>
<div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2><i>Désolé  mais aucun voyage ne correspond a votre recherche. Vueillez effectuer 
                            une autre recherche<a href="index.php?page=voyages" class="text text-primary"> Trouver un voyage </a>
                        </i></h2> 
                    </div>
                </div>
            </div>
        </div>
             <?php } ?>
        <!-- Hero Area End -->
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
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->
                                <?php if (isset($_GET["seite"]) && !empty($_GET["seite"])) {
                                    $seite=intval($_GET["seite"]);
                                    $pageCourante=$_GET["seite"];
                                }
                                else{
                                    $pageCourante=1; 
                                }
                               $bdd=getBdd();
                                $req = $bdd->prepare('SELECT * FROM journey WHERE  lieuArriv=?');
                                $req->execute(array($_POST["lieuArriv"]));
                                $nbre_element_page=5;
                                $nbre_elmt=$req->rowCount();
                                $nbre=ceil($nbre_elmt/$nbre_element_page);
                                $depart=($pageCourante-1)*$nbre_element_page;
                                //$todayDate=date('y/m/d');
                                $qer = $bdd->prepare("SELECT * FROM journey WHERE  lieuArriv=? order by id asc limit $depart,$nbre_element_page");
                                $qer->execute(array($_POST["lieuArriv"])); 
                            $dateN = time(); while ($resultat = $qer->fetch()){$id=$resultat['id'];
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
                            $retour['day'] = $DiffDate; ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="#"><img src="assets/img/<?= $resultat['photo_1']; ?>" alt="" width="80" height="80"></a>
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a href="#">
                                                <h4><span style="color:#fb246a">De</span> <?= $resultat['lieuDep']."<span style='color:#fb246a'> Pour</span> ".$resultat['lieuArriv']; ?></h4>
                                            </a>
                                            <ul>
                                                <li><span>Depart prévu le</span> <span style="color:#fb246a"><?= $resultat['dateTravel']; ?><span/></li>
                                                <li><span> à </span><span style="color:#fb246a"><?= $resultat['heureDep']; ?><span/></li>
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
                                    echo "<li class=items-link items-link2 f-right active><a style=border-color:#8b92dd 1px class=page-link href=index.php?page=search&amp;seite=$i>
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