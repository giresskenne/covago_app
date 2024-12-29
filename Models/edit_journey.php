<?php
// edit_journey_process.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

if (!isset($_SESSION['email'])) {
    $_SESSION['notification'] = [
        'title' => 'Erreur',
        'message' => 'Vous devez être connecté pour modifier votre voyage.'
    ];
    header('Location: index.php?page=profil');
    exit;
}

try {
    $journey_id = $_POST['journey_id'];
    $new_data = [
        'nbPlaces' => $_POST['nbPlaces'],
        'dateTravel' => $_POST['dateTravel'],
        'heureDep' => $_POST['heureDep'],
        'lieuDep' => $_POST['lieuDep'],
        'lieuArriv' => $_POST['lieuArriv']
    ];

    $bdd = getBdd();

    // Check if bookings exist for the journey
    $bookingCountQuery = "SELECT COUNT(*) AS booking_count FROM bookings WHERE journey_id = :journey_id";
    $stmt = $bdd->prepare($bookingCountQuery);
    $stmt->execute(['journey_id' => $journey_id]);
    $bookingCount = $stmt->fetch()['booking_count'];

    if ($bookingCount > 0) {
        $_SESSION['notification'] = [
            'title' => 'Modification Impossible',
            'message' => 'Des passagers ont déjà réservé. Vous ne pouvez pas modifier ce voyage.'
        ];
        header('Location: index.php?page=profil');
        exit;
    }

    // Update the journey
    $updateQuery = "
        UPDATE journey
        SET nbPlaces = :nbPlaces, dateTravel = :dateTravel, heureDep = :heureDep, lieuDep =:lieuDep, lieuArriv =:lieuArriv 
        WHERE id = :journey_id
    ";
    $updateStmt = $bdd->prepare($updateQuery);
    $updateStmt->execute(array_merge($new_data, ['journey_id' => $journey_id]));

    $_SESSION['notification'] = [
        'title' => 'Succès',
        'message' => 'Voyage modifié avec succès.'
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
