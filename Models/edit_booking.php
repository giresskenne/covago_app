<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

if (!isset($_SESSION['email'])) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Vous devez être connecté pour modifier votre réservation.'
    ];
    header('Location: index.php?page=profil');
    exit;
}

try {
    $bdd = getBdd();

    // Fetch the current booking details
    $bookingQuery = "SELECT seats_booked, journey_id FROM bookings WHERE id = :booking_id";
    $stmt = $bdd->prepare($bookingQuery);
    $stmt->execute(['booking_id' => $_POST['booking_id']]);
    $currentBooking = $stmt->fetch();

    if (!$currentBooking) {
        throw new Exception("Réservation introuvable.");
    }

    $currentSeats = $currentBooking['seats_booked'];
    $journeyId = $currentBooking['journey_id'];
    $newSeats = $_POST['seats_booked'];

    // Fetch the available seats for the journey
    $journeyQuery = "SELECT nbPlaces FROM journey WHERE id = :journey_id";
    $journeyStmt = $bdd->prepare($journeyQuery);
    $journeyStmt->execute(['journey_id' => $journeyId]);
    $journey = $journeyStmt->fetch();

    if (!$journey) {
        throw new Exception("Voyage introuvable.");
    }

    $availableSeats = $journey['nbPlaces'];

    // Validate that the new booking does not exceed available seats
    if ($newSeats > ($currentSeats + $availableSeats)) {
        throw new Exception("Le nombre total de places réservées dépasse les places disponibles.");
    }

    // Calculate the difference in seats booked
    $seatDifference = $currentSeats - $newSeats;

    // Update the booking record
    $updateBookingQuery = "UPDATE bookings SET seats_booked = :seats_booked WHERE id = :booking_id";
    $updateStmt = $bdd->prepare($updateBookingQuery);
    $updateStmt->execute([
        'seats_booked' => $newSeats,
        'booking_id' => $_POST['booking_id']
    ]);

    // Adjust the nbPlaces in the journey table
    $updateJourneyQuery = "UPDATE journey SET nbPlaces = nbPlaces + :seat_diff WHERE id = :journey_id";
    $updateStmt = $bdd->prepare($updateJourneyQuery);
    $updateStmt->execute([
        'seat_diff' => $seatDifference,
        'journey_id' => $journeyId
    ]);

    $_SESSION['notification'] = [
        'title' => 'Succès',
        'message' => 'La réservation a été modifiée avec succès.'
    ];
    header("Location: index.php?page=profil");
    exit;
} catch (Exception $e) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => "Erreur: " . $e->getMessage()
    ];
    header("Location: index.php?page=profil");
    exit;
}