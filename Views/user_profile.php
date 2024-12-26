<!doctype html>
<html class="no-js" lang="zxx">
<?php include('header.php'); ?>

<style>
    body, html {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    .profile-container {
        margin-top: 20px;
    }

    .form-card {
        background: #f9f9f9;
        padding: 20px;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
        border-radius: 8px;
    }

    .job-items {
        display: flex;
        align-items: flex-start;
    }

    .company-img img {
        max-width: 80px;
        max-height: 80px;
        border-radius: 4px;
    }

    .job-tittle h4 {
        font-weight: bold;
        margin-top: 10px;
    }

    .job-tittle ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .job-tittle ul li {
        margin: 5px 0;
    }

    .items-link a {
        color: #38B6FF;
        text-decoration: none;
    }

    .items-link.text-center a {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    .profile-sidebar {
        text-align: center;
        margin: 20px 0;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ccc;
        background-color: #f0f0f0;
        display: inline-block;
    }

    .details-button {
        display: inline-block;
        background-color: #fff;
        color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        margin-top: 10px;
    }

    .details-button:hover {
        background-color: #2a93cc;
        text-decoration: none;
    }

    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* Modal Content */
    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 90%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        max-height: 80%; /* Set a maximum height for the modal content */ 
        overflow-y: auto; /* Enable vertical scrolling */
    }

    /* Modal Title */
    .modal-title {
        margin-bottom: 15px;
        font-size: 24px;
        color: #38B6FF;
        font-weight: bold;
    }

    /* Modal Buttons */
    .modal-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: space-around;
    }

    .modal-buttons .btn {
        padding: 10px 20px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    .modal-buttons .btn-success {
        background-color: #38B6FF;
        color: white;
    }

    .modal-buttons .btn-danger {
        background-color: #ff4c4c;
        color: white;
    }

</style>

<main>
    <div class="container profile-container">
        <!-- Profile Header -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center">
                    <h2>Profil</h2>
                </div>
            </div>
        </div>
        <div class="profile-sidebar text-center">
            <?php 
            // Placeholder logic for profile photo
            $profilePhoto = !empty($user['profile_photo']) && file_exists('uploads/' . $user['profile_photo']) 
                ? 'uploads/' . $user['profile_photo'] 
                : 'assets/img/placeholder-circle.png'; 
            ?>
            <img src="<?= $profilePhoto ?>" alt="Photo de Profil" class="profile-img">
            <h3><?php echo $_SESSION['email']; ?></h3>
            <p>No rating yet</p>

            <div>
                <?php 
                    // Database connection
                    $bdd = new PDO('mysql:host=mysql;port=3306;dbname=covago', 'root', 'root');

                    // ============================
                    // Fetch user basic information
                    // ============================
                    $userBaseQuery = "
                        SELECT id AS user_id, phoneNumber 
                        FROM users 
                        WHERE email = :email
                    ";
                    $baseStmt = $bdd->prepare($userBaseQuery);
                    $baseStmt->execute(['email' => $_SESSION['email']]);
                    $userBaseData = $baseStmt->fetch();

                    // ============================
                    // Fetch journey information
                    // ============================
                    $userJourneyQuery = "
                        SELECT 
                            journey.id AS journey_id, 
                            journey.dateTravel
                        FROM journey
                        WHERE journey.emailChauffeur = :email
                    ";
                    $journeyStmt = $bdd->prepare($userJourneyQuery);
                    $journeyStmt->execute(['email' => $_SESSION['email']]);
                    $journeyData = $journeyStmt->fetch();

                    // ============================
                    // Display basic user information
                    // ============================
                    echo "<strong>Passenger account:</strong> " . ($userBaseData['user_id'] ?? 'N/A') . "<br>";
                    echo "<strong>Driver account:</strong> " . ($journeyData['journey_id'] ?? 'No journey posted') . "<br>";
                    echo "<strong>Téléphone:</strong> " . ($userBaseData['phoneNumber'] ?? 'Non disponible') . "<br>";
                    if (!empty($journeyData['dateTravel'])) {
                        echo "<strong>Journey valid until:</strong> " . $journeyData['dateTravel'];
                    }
                ?>
            </div>
        </div>

        <!-- Driver and Journey Information -->
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <?php 
                    // ============================
                    // Fetch detailed journey and vehicle information
                    // ============================
                    $query = "
                        SELECT 
                            journey.id AS journey_id, 
                            journey.immat, 
                            journey.marque, 
                            journey.model, 
                            journey.couleur, 
                            journey.photo_1, 
                            journey.lieuDep, 
                            journey.lieuArriv, 
                            journey.dateTravel, 
                            journey.nbPlaces, 
                            journey.heureDep,
                            (SELECT SUM(seats_booked) FROM bookings WHERE bookings.journey_id = journey.id) AS passengers_booked
                        FROM journey
                        WHERE journey.emailChauffeur = :email
                    ";
                    $stmt = $bdd->prepare($query);
                    $stmt->execute(['email' => $_SESSION['email']]);

                    if ($stmt->rowCount() > 0) {
                        while ($data = $stmt->fetch()) {
                            $photoPath = !empty($data['photo_1']) ? 'uploads/' . $data['photo_1'] : 'assets/img/default-image.jpg';
                ?>
                <div class="form-card">
                    <div class="job-items">
                        <div class="job-tittle">
                            <h4>Informations sur le Conducteur</h4>
                            <ul>
                                <li><strong>Téléphone:</strong> <?= $userBaseData['phoneNumber']; ?></li>
                                <li><strong>Immatriculation:</strong> <?= $data['immat']; ?></li>
                                <li><strong>Marque:</strong> <?= $data['marque']; ?></li>
                                <li><strong>Modèle:</strong> <?= $data['model']; ?></li>
                                <li><strong>Couleur:</strong> <?= $data['couleur']; ?></li>
                            </ul>
                            <h4>Informations sur le Voyage</h4>
                            <ul>
                                <li><strong>De:</strong> <span style="color:#38B6FF"><?= $data['lieuDep']; ?></span></li>
                                <li><strong>Pour:</strong> <span style="color:#38B6FF"><?= $data['lieuArriv']; ?></span></li>
                                <li><strong>Date de départ:</strong> <?= $data['dateTravel']; ?></li>
                                <li><strong>Heure de départ:</strong> <?= $data['heureDep']; ?></li>
                                <li><strong>Places disponibles:</strong> <?= $data['nbPlaces']; ?></li>
                                <li><strong>Réservations:</strong> <?= $data['passengers_booked']; ?> passagers</li>
                            </ul>
                            <div class="company-img">
                                <a href="#"><img src="<?= $photoPath; ?>" class="vehicle-image" alt="Image du véhicule"></a>
                            </div>
                        </div>
                    </div>
                     <!-- Passengers Booked -->
                     <?php 
                        $bookingQuery = "
                            SELECT users.email, users.phoneNumber 
                            FROM bookings 
                            INNER JOIN users ON bookings.user_id = users.id 
                            WHERE bookings.journey_id = :journey_id
                        ";
                        $bookingStmt = $bdd->prepare($bookingQuery);
                        $bookingStmt->execute(['journey_id' => $data['journey_id']]);

                        if ($bookingStmt->rowCount() > 0) {
                            echo "<h5>Passagers réservés:</h5><ul>";
                            while ($passenger = $bookingStmt->fetch()) {
                                echo "<li><strong>Email:</strong> " . htmlspecialchars($passenger['email']) . " | ";
                                echo "<strong>Téléphone:</strong> " . htmlspecialchars($passenger['phoneNumber']) . "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "<p>Aucun passager réservé pour ce voyage.</p>";
                        }
                    ?>
                    <!-- Details Button -->
                    <div class="items-link">
                        <a href="index.php?page=details&id=<?= $data['journey_id']; ?>" class="details-button">Voir les détails</a>
                    </div>
                </div>
                <hr>
                <?php 
                        } 
                    } else {
                        echo "<div class='text-center'><p>Aucun voyage publié pour cet utilisateur.</p></div>";
                    }
                ?>
            </div>
        </div>

        <!-- added for edit/cancel -->
        <!-- ============================================================================================================ -->
        <!--                                    Booked Journeys for the User                                              -->
        <!-- ============================================================================================================ -->
        <h3 class="text-center" style="margin-top: 30px;">Vos Réservations</h3>
        <?php
            // Fetch journeys booked by the user
            $bookedQuery = "
                SELECT 
                    bookings.id AS booking_id,
                    bookings.seats_booked,
                    journey.id AS journey_id,
                    journey.lieuDep,
                    journey.lieuArriv,
                    journey.dateTravel,
                    journey.heureDep,
                    journey.nbPlaces,
                    users.phoneNumber
                FROM bookings
                INNER JOIN journey ON bookings.journey_id = journey.id 
                INNER JOIN users ON users.email = journey.emailChauffeur
                WHERE bookings.user_id = :user_id
            ";
            $bookedStmt = $bdd->prepare($bookedQuery);
            $bookedStmt->execute(['user_id' => $userBaseData['user_id']]);

            if ($bookedStmt->rowCount() > 0) {
                while ($booking = $bookedStmt->fetch()) {
                    $timeRemaining = strtotime($booking['dateTravel']) - time();
                    $cancellable = ($timeRemaining >= 48 * 3600); // Check if >= 48 hours
        ?>
            <div class="form-card">
                <div class="job-items">
                    <div class="job-tittle">
                        <h4>Réservation</h4>
                        <ul>
                            <li><strong>De:</strong> <?= $booking['lieuDep']; ?></li>
                            <li><strong>Pour:</strong> <?= $booking['lieuArriv']; ?></li>
                            <li><strong>Date de départ:</strong> <?= $booking['dateTravel']; ?></li>
                            <li><strong>Heure de départ:</strong> <?= $booking['heureDep']; ?></li>
                            <li><strong>Numero du chauffeur:</strong> <?= $booking['phoneNumber']; ?></li>
                            <li><strong>Places réservées:</strong> <?= $booking['seats_booked']; ?></li>
                        </ul>
                        <!-- Edit and Cancel Buttons -->
                        <div class="items-link">
                            <!-- Modify Button -->
                            <!-- <div class="items-link"> -->
                                <button type="button" class="btn btn-primary" onclick="openEditModal(<?= $booking['booking_id']; ?>, <?= $booking['seats_booked']; ?>)">
                                    Modifier
                                </button>
                            <!-- </div> -->

                            <?php if ($cancellable) { ?>
                            <form action="index.php?page=cancel_booking" method="POST" style="display: inline;">
                                <input type="hidden" name="booking_id" value="<?= $booking['booking_id']; ?>">
                                <button type="submit" class="btn btn-danger">Annuler</button>
                            </form>
                            <?php } else { ?>
                                <span style="color: red;">Non annulable (moins de 48h)</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php 
                } 
            } else {
                echo "<p class='text-center'>Aucune réservation trouvée.</p>";
            }
        ?>

        <!-- ============================================================================================================ -->
        <!--                                    Driver Controls for Journeys                                              -->
        <!-- ============================================================================================================ -->
        <h3 class="text-center" style="margin-top: 30px;">Vos Voyages Publiés</h3>
        <?php
            // Driver journeys with booking status
            $driverQuery = "
                SELECT 
                    journey.id AS journey_id,
                    journey.lieuDep,
                    journey.lieuArriv,
                    journey.dateTravel,
                    journey.nbPlaces,
                    (SELECT SUM(seats_booked) FROM bookings WHERE bookings.journey_id = journey.id) AS passengers_booked
                FROM journey
                WHERE journey.emailChauffeur = :email
            ";
            $driverStmt = $bdd->prepare($driverQuery);
            $driverStmt->execute(['email' => $_SESSION['email']]);

            if ($driverStmt->rowCount() > 0) {
                while ($driverJourney = $driverStmt->fetch()) {
        ?>
            <div class="form-card">
                <div class="job-items">
                    <div class="job-tittle">
                        <h4>Voyage Publié</h4>
                        <ul>
                            <li><strong>De:</strong> <?= $driverJourney['lieuDep']; ?></li>
                            <li><strong>Pour:</strong> <?= $driverJourney['lieuArriv']; ?></li>
                            <li><strong>Date de départ:</strong> <?= $driverJourney['dateTravel']; ?></li>
                            <li><strong>Places disponibles:</strong> <?= $driverJourney['nbPlaces']; ?></li>
                            <li><strong>Réservations:</strong> <?= $driverJourney['passengers_booked']; ?> places</li>
                        </ul>
                        <div class="items-link">
                            <?php if ($driverJourney['passengers_booked'] == 0) { ?>

                                <!-- Edit Button with Modal Trigger -->
                                <button type="button" class="btn btn-primary" 
                                    onclick="openEditJourneyModal(
                                        <?= $driverJourney['journey_id']; ?>,
                                        <?= $driverJourney['nbPlaces']; ?>,
                                        '<?= htmlspecialchars($driverJourney['dateTravel']); ?>',
                                        '<?= htmlspecialchars($driverJourney['heureDep']); ?>',
                                        '<?= htmlspecialchars($driverJourney['lieuDep']); ?>',
                                        '<?= htmlspecialchars($driverJourney['lieuArriv']); ?>'
                                    )">
                                    Modifier
                                </button>


                                <form action="index.php?page=cancel_journey" method="POST" style="display: inline;">
                                    <input type="hidden" name="journey_id" value="<?= $driverJourney['journey_id']; ?>">
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                            <?php } else { ?>
                                <span style="color: red;">Modification impossible (réservations existantes)</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
                }
            } else {
                echo "<p class='text-center'>Aucun voyage publié.</p>";
            }
        ?>
        <!-- added for edit/cancel -->

    </div>
    <!-- Modal for Editing Booking -->
    <div id="editBookingModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <h2 class="modal-title">Modifier la Réservation</h2>
            <form id="editBookingForm" action="index.php?page=edit_booking" method="POST">
                <input type="hidden" name="booking_id" id="modal_booking_id">
                <label for="modal_seats_booked">Nombre de places:</label>
                <input type="number" name="seats_booked" id="modal_seats_booked" min="1" required>
                <div class="modal-buttons">
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <button type="button" class="btn btn-danger" onclick="closeEditModal()">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Editing Journey -->
    <div id="editJourneyModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="editJourneyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editJourneyModalLabel">Modifier le Voyage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editJourneyForm" action="index.php?page=edit_journey" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="journey_id" name="journey_id">
                        <div class="form-group">
                            <label for="nbPlaces">Nombre de Places</label>
                            <input type="number" id="nbPlaces" name="nbPlaces" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dateTravel">Date de Voyage</label>
                            <input type="date" id="dateTravel" name="dateTravel" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="heureDep">Heure de Départ</label>
                            <input type="time" id="heureDep" name="heureDep" class="form-control" required>
                        </div>
                        <!-- <div class="form-group">
                            <label for="heureDep">Lieu de départ </label>
                            <input type="text" id="lieuDep" name="lieuDep" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="heureDep">Destination </label>
                            <input type="text" id="lieuArriv" name="lieuArriv" class="form-control" >
                        </div> -->

                        <div class="form-group" style="position: relative;">
                            <label for="lieuDep">Lieu de départ</label>
                            <input type="text" id="lieuDep" name="lieuDep" class="form-control" 
                                oninput="showSuggestions(this.value, 'editDepSuggestions')" autocomplete="off">
                            <div id="editDepSuggestions" class="suggestions"></div>
                        </div>
                        <div class="form-group" style="position: relative;">
                            <label for="lieuArriv">Destination</label>
                            <input type="text" id="lieuArriv" name="lieuArriv" class="form-control" 
                                oninput="showSuggestions(this.value, 'editArrivSuggestions')" autocomplete="off">
                            <div id="editArrivSuggestions" class="suggestions"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

<?php include('footer1.html'); ?>
</html>

<script>
    // --------------------------- Edit_booking Modal block --------------------------
    // Open Edit Modal
    function openEditModal(bookingId, currentSeats) {
        document.getElementById('modal_booking_id').value = bookingId;
        document.getElementById('modal_seats_booked').value = currentSeats;
        document.getElementById('editBookingModal').style.display = 'flex';
    }
    
    // Close Edit Modal
    function closeEditModal() {
        document.getElementById('editBookingModal').style.display = 'none';
    }

// --------------------------- Edit_journey Modal block --------------------------
    function openEditJourneyModal(journeyId, nbPlaces, dateTravel, heureDep, lieuDep, lieuArriv) {
        document.getElementById('journey_id').value = journeyId;
        document.getElementById('nbPlaces').value = nbPlaces;
        document.getElementById('dateTravel').value = dateTravel;
        document.getElementById('heureDep').value = heureDep;
        document.getElementById('lieuDep').value = lieuDep;
        document.getElementById('lieuArriv').value = lieuArriv;
        document.getElementById('editJourneyModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('editJourneyModal').style.display = 'none';
    }

// // --------------------------- Javascript to manage input sugestions --------------------------
    
    // Prevent hiding suggestions when clicking inside input or suggestion box
    document.getElementById("lieuDep").addEventListener("click", (event) => {
        event.stopPropagation();
    });
    document.getElementById("lieuArriv").addEventListener("click", (event) => {
        event.stopPropagation();
    });
    
    // Prevent the modal suggestions from hiding too
    document.getElementById("editDepSuggestions").addEventListener("click", (event) => {
        event.stopPropagation();
    });
    document.getElementById("editArrivSuggestions").addEventListener("click", (event) => {
        event.stopPropagation();
    });

</script>
