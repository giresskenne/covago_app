<?php
// cancel_journey_process.php
// File to handle the cancellation of a journey by the driver
require_once 'db.php';

// Start the session to access user information
session_start();

// Ensure driver is logged in
if (!isset($_SESSION['email'])) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Vous devez être connecté pour annuler votre voyage.'
    ];
    header('Location: index.php?page=profil');
    exit;
}

try {
    // Get journey ID from POST data
    $journey_id = $_POST['journey_id'];

    // Database connection
    $bdd = getBdd();

    // Check if bookings exist for the journey
    $bookingCountQuery = "SELECT COUNT(*) AS booking_count FROM bookings WHERE journey_id = :journey_id";
    $stmt = $bdd->prepare($bookingCountQuery);
    $stmt->execute(['journey_id' => $journey_id]);
    $bookingCount = $stmt->fetch()['booking_count'];

    if ($bookingCount > 0) {
        $_SESSION['notification'] = [
            'title' => 'Annulation Impossible',
            'message' => 'Des passagers ont déjà réservé ce voyage.'
        ];
        header('Location: index.php?page=profil');
        exit;
    }

    // Delete the journey
    $deleteQuery = "DELETE FROM journey WHERE id = :journey_id";
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute(['journey_id' => $journey_id]);

    $_SESSION['notification'] = [
        'title' => 'Succès',
        'message' => 'Voyage annulé avec succès.'
    ];
    header('Location: index.php?page=profil');
    exit;
} catch (Exception $e) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Erreur: ' . $e->getMessage()
    ];
    header('Location: index.php?page=profil');
    exit;
}
?>
