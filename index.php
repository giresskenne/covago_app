<?php
//session_start();
if (isset($_GET["page"]) && !empty($_GET["page"])) {
   require 'Models/deleteJourney.php';
   $req=dropJourney();
    if ($_GET["page"]=="accueil") {
        require 'Models/listing_journey.php';
        $req  = getJourney();
        $nombre=getNumberJob();
        require('Views/index.php');
    }
    if ($_GET["page"]=="voyages") {
        require 'Models/listing_journey.php';
        $req  = getJourney();
        $nombre=getNumberJob();
        require('Views/listing_journey.php');
    }
    if ($_GET["page"]=="publier") {
        require('Views/post_journey.php');
    }
    if ($_GET["page"]=="registration") {
        require('Views/registration.php');
    } 
    if ($_GET["page"]=="details" && isset($_GET["id"]) && !empty($_GET["id"])) {
       require('Views/journey_details.php');
    }
    if ($_GET["page"]=="registrationProcess") {
        require('Models/registration_process.php'); 
     } 
     if ($_GET["page"]=="post_process") {
        require('Models/post_journey_process.php');
     }
     if ($_GET["page"]=="connexion") {
        require('Views/connexion.php');
     }
     if ($_GET["page"]=="connexion_process") {
        require('Models/connexion_process.php');
     }
     if ($_GET["page"]=="search") {
        /*require('Models/search_process.php');
        $req=searchJourney();*/
        require('Models/db.php');
        require('Views/search.php'); 
     } 
     if ($_GET["page"]=="search1") {
        require('Models/db.php');
        require('Views/search1.php'); 
     }
     if ($_GET["page"]=="goodPost") {
        require('Views/goodPost.php'); 
     } 
     if ($_GET["page"]=="Cgu") {
      require('Views/Cgu.php');
   } 
   if ($_GET["page"]=="goodAccount") {
         require('Views/Recruteur/goodAccount.php');
   }  
   if ($_GET["page"]=="deconnection") {
      require('Models/deconnexion.php');
} 
if ($_GET["page"]=="allDriver") {
   require 'Models/listing_journey.php';
        $req  = getDriver();
        $nombre=getNumberDriver();
   require('Views/allDriver.php');
} 
    if ($_GET["page"]=="comment" && empty($_GET["email"])){
       require('Models/comment_process.php'); 
    }
    else{
        require('Models/comment_process.php'); 
    }
}

else {
    require 'Models/listing_journey.php';
    $req  = getJourney();
    $nombre=getNumberJob();
    require('Views/index.php');
} 