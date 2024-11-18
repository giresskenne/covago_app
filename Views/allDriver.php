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
 
                            </div>
                        </div>
                    </div></br></br>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>Voici à votre disposition, plus de  <a href="#"  style="color:#38B6FF"><?= $nombre ?> chauffeurs disponnibles</a> </h2> 
                    </div>
                </div>
            </div>
        </div>
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <?php
                            if (isset($_GET["seite"]) && !empty($_GET["seite"])) {
                                    $seite=intval($_GET["seite"]);
                                    $pageCourante=$_GET["seite"];
                                }
                                else{
                                    $pageCourante=1;
                                }
                                
                                $bdd=getBdd();
                                $req = $bdd->prepare('SELECT * FROM users');
                                $req->execute(array());
                                $nbre_element_page=5;
                                $nbre_elmt=$req->rowCount();
                                $nbre=ceil($nbre_elmt/$nbre_element_page);
                                $depart=($pageCourante-1)*$nbre_element_page;
                                //$todayDate=date('y/m/d');
                                $qer = $bdd->prepare("select * from users  order by id desc limit $depart,$nbre_element_page");
                                $qer->execute(array());
                                    ?>
                                <table class="table ">
                                    <?php
                                     while ($resultat = $qer->fetch()){ ?>
                                    <tr>
                                    <td class="avatar">
                                                        <div class="round-img">
                                                            <a href="" style="color:blue"><img class="rounded-circle" width="30" height="30" 
                                                            src="Models/uploads/500x500.JPG" alt=""> <span><?=$resultat["email"]?></span>
                                                            </a></div>
                                                    </td>
                                    </tr> <?php }?>
                                     </table>
                                     
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
                                    echo "<li class=items-link items-link2 f-right active><a style=border-color:#8b92dd 1px class=page-link href=index.php?page=allDriver&amp;seite=$i>
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