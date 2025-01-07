<?php
// Start the session at the very beginning
session_start();

// Include the database connection function, ensuring it's only included once
// require_once 'Models/db.php';
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
        require('Views/Registration.php');
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
     if ($_GET["page"] == "goodBooking") {
      require('Views/goodBooking.php');
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
   if ($_GET["page"]=="profil") { // route vers la page profil d'utilisateur créee par Giress
   require('Views/user_profile.php');
} 
// --------------- bookings ---------------------
if ($_GET['page'] === 'booking') {
   include('Models/booking_manager.php');

   // Retrieve POST data
   $journey_id = $_POST['journey_id'] ?? null;
   $user_id = $_SESSION['user_id'] ?? null;
   $seats_booked = $_POST['seats_booked'] ?? 1; // Default to 1 seat

   // Call the booking logic
   $result = handleBooking($journey_id, $user_id, $seats_booked);

   if ($result['success']) {
       header('Location: index.php?page=goodBooking&message=' . urlencode($result['message']));
   } else {
       echo "<p style='color: red;'>{$result['message']}</p>";
   }
   exit();
}
// ----------------- end ---------------------------


  // --------------- CANCELLATION AND EDITING OF JOURNEY AND BOOKINGS ---------------------

   if ($_GET["page"] === "edit_booking") {
       include_once('Models/edit_booking.php'); // Route to edit booking logic
       exit; // End execution after the operation
   }

   if ($_GET["page"] === "cancel_booking") {
       include_once('Models/cancel_booking.php'); // Route to cancel booking logic
       exit; // End execution after the operation
   }

   if ($_GET["page"] === "edit_journey") {
       include_once('Models/edit_journey.php'); // Route to edit journey logic
       exit; // End execution after the operation
   }

   if ($_GET["page"] === "cancel_journey") {
       include_once('Models/cancel_journey.php'); // Route to cancel journey logic
       exit; // End execution after the operation
   }
   
  // --------------- END OF CANCELLATION AND EDITING OF JOURNEY AND BOOKINGS ---------------------

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