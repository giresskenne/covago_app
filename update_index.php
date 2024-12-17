<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Debugging code to test database connection
try {
    $host = 'mysql';
    $dbname = 'klando';
    $username = 'root';
    $password = 'root';
    echo "Connecting to database at $host with user $username\n";
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!\n";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
    exit;
}

// Include the database connection function, ensuring it's only included once
require_once 'Models/db.php';

// Your existing logic to handle different pages
if (isset($_GET["page"]) && !empty($_GET["page"])) {
    // Include the script to delete a journey
    require_once 'Models/deleteJourney.php';
    $req = dropJourney();

    // Determine which page to load based on the 'page' parameter
    switch ($_GET["page"]) {
        case "accueil":
            require_once 'Models/listing_journey.php';
            $req = getJourney();
            $nombre = getNumberJob();
            require('Views/index.php');
            break;

        case "voyages":
            require_once 'Models/listing_journey.php';
            $req = getJourney();
            $nombre = getNumberJob();
            require('Views/listing_journey.php');
            break;

        case "publier":
            require('Views/post_journey.php');
            break;

        case "registration":
            require('Views/registration.php');
            break;

        case "details":
            if (isset($_GET["id"]) && !empty($_GET["id"])) {
                require('Views/journey_details.php');
            }
            break;

        case "registrationProcess":
            require('Models/registration_process.php');
            break;

        case "post_process":
            require('Models/post_journey_process.php');
            break;

        case "connexion":
            require('Views/connexion.php');
            break;

        case "connexion_process":
            require('Models/connexion_process.php');
            break;

        case "search":
        case "search1":
            require_once 'Models/db.php';
            require('Views/' . $_GET["page"] . '.php');
            break;

        case "goodPost":
            require('Views/goodPost.php');
            break;

        case "Cgu":
            require('Views/Cgu.php');
            break;

        case "goodAccount":
            require('Views/Recruteur/goodAccount.php');
            break;

        case "deconnection":
            require('Models/deconnexion.php');
            break;

        case "allDriver":
            require_once 'Models/listing_journey.php';
            $req = getDriver();
            $nombre = getNumberDriver();
            require('Views/allDriver.php');
            break;

        case "comment":
            require('Models/comment_process.php');
            break;

        default:
            require_once 'Models/listing_journey.php';
            $req = getJourney();
            $nombre = getNumberJob();
            require('Views/index.php');
            break;
    }
} else {
    require_once 'Models/listing_journey.php';
    $req = getJourney();
    $nombre = getNumberJob();
    require('Views/index.php');
}
?>
