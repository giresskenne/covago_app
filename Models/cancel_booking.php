<?php
// cancel_booking.php
// File to handle the cancellation of bookings
require_once 'db.php';

// Start the session to access user information
session_start();

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Vous devez être connecté pour annuler votre réservation.'
    ];
    header('Location: index.php?page=profil');
    exit;
}

try {
    // Get booking ID from POST data
    $booking_id = $_POST['booking_id'];

    // Database connection
    $bdd = getBdd();

    // Fetch booking and journey details
    $bookingQuery = "
        SELECT journey.dateTravel, bookings.seats_booked, journey.nbPlaces, journey.id AS journey_id
        FROM bookings 
        INNER JOIN journey ON bookings.journey_id = journey.id 
        WHERE bookings.id = :booking_id
    ";
    $stmt = $bdd->prepare($bookingQuery);
    $stmt->execute(['booking_id' => $booking_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        $_SESSION['notification'] = [
            'title' => 'Erreur',
            'message' => 'Réservation introuvable.'
        ];
        header('Location: index.php?page=profil');
        exit;
    }

    // Ensure cancellation is allowed (at least 48 hours before departure)
    $timeRemaining = strtotime($booking['dateTravel']) - time();
    if ($timeRemaining < 48 * 3600) {
        $_SESSION['notification'] = [
            'title' => 'Annulation impossible',
            'message' => 'Moins de 48 heures avant le départ.'
        ];
        header('Location: index.php?page=profil');
        exit;
    }

    // Delete the booking and restore seats
    $deleteQuery = "DELETE FROM bookings WHERE id = :booking_id";
    $deleteStmt = $bdd->prepare($deleteQuery);
    $deleteStmt->execute(['booking_id' => $booking_id]);

    // Update the journey seat count
    $updateJourneyQuery = "UPDATE journey SET nbPlaces = nbPlaces + :seats_booked WHERE id = :journey_id";
    $updateStmt = $bdd->prepare($updateJourneyQuery);
    $updateStmt->execute(['seats_booked' => $booking['seats_booked'], 'journey_id' => $booking['journey_id']]);

    // Set success notification
    $_SESSION['notification'] = [
        'title' => 'Succès',
        'message' => 'Réservation annulée avec succès.'
    ];
    header('Location: index.php?page=profil');
    exit;

} catch (Exception $e) {
    // Set error notification
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Erreur: ' . $e->getMessage()
    ];
    header('Location: index.php?page=profil');
    exit;
}
