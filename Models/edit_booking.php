<?php
session_start();
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
    $booking_id = $_POST['booking_id'];
    $new_seats = $_POST['seats_booked'];
    $bdd = getBdd();

    $bookingQuery = "SELECT journey.nbPlaces, bookings.seats_booked FROM bookings INNER JOIN journey ON bookings.journey_id = journey.id WHERE bookings.id = :booking_id";
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

    $availableSeats = $booking['nbPlaces'] + $booking['seats_booked'];
    if ($new_seats > $availableSeats) {
        $_SESSION['notification'] = [
            'title' => 'Erreur',
            'message' => 'Nombre de places demandées non disponible.'
        ];
        header('Location: index.php?page=profil');
        exit;
    }

    $updateQuery = "UPDATE bookings SET seats_booked = :new_seats WHERE id = :booking_id";
    $updateStmt = $bdd->prepare($updateQuery);
    $updateStmt->execute(['new_seats' => $new_seats, 'booking_id' => $booking_id]);

    $_SESSION['notification'] = [
        'title' => 'Succès',
        'message' => 'Réservation modifiée avec succès.'
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
