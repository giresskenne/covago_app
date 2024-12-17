<?php
require_once 'Models/db.php';

function handleBooking($journey_id, $user_id, $seats_booked) {
    $response = ['success' => false, 'message' => ''];

    // Validate inputs
    if (empty($journey_id) || empty($user_id) || empty($seats_booked)) {
        $response['message'] = "Erreur : Les données de réservation sont incomplètes.";
        return $response;
    }

    try {
        $bdd = getBdd();

        // Check available seats
        $seatQuery = $bdd->prepare('SELECT nbPlaces FROM journey WHERE id = ?');
        $seatQuery->execute([$journey_id]);
        $result = $seatQuery->fetch();

        if (!$result || $result['nbPlaces'] < $seats_booked) {
            $response['message'] = "Erreur : Pas assez de places disponibles.";
            return $response;
        }

        // Insert into bookings table
        $stmt = $bdd->prepare("
            INSERT INTO bookings (journey_id, user_id, seats_booked, booking_date)
            VALUES (:journey_id, :user_id, :seats_booked, NOW())
        ");
        $stmt->execute([
            'journey_id' => $journey_id,
            'user_id' => $user_id,
            'seats_booked' => $seats_booked
        ]);

        // Update remaining seats
        $updateSeats = $bdd->prepare('UPDATE journey SET nbPlaces = nbPlaces - :seats_booked WHERE id = :journey_id');
        $updateSeats->execute([
            'seats_booked' => $seats_booked,
            'journey_id' => $journey_id
        ]);

        $response['success'] = true;
        $response['message'] = "Réservation réussie.";
    } catch (Exception $e) {
        $response['message'] = "Erreur : " . $e->getMessage();
    }

    return $response;
}
?>
