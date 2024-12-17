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
                $bdd = new PDO('mysql:host=127.0.0.1;dbname=covago', 'root', 'root');

                // Fetch basic user and journey information
                $userQuery = "
                    SELECT 
                        users.id AS user_id, 
                        users.phoneNumber,
                        journey.id AS journey_id, 
                        journey.dateTravel,
                        journey.nbPlaces
                    FROM users 
                    LEFT JOIN journey ON users.email = journey.emailChauffeur 
                    WHERE users.email = :email
                ";
                $stmt = $bdd->prepare($userQuery);
                $stmt->execute(['email' => $_SESSION['email']]);
                $userData = $stmt->fetch();

                // Display user IDs
                echo "<strong>Passenger account:</strong> " . ($userData['user_id'] ?? 'N/A') . "<br>";
                echo "<strong>Driver account:</strong> " . ($userData['journey_id'] ?? 'No journey posted') . "<br>";
                if (!empty($userData['dateTravel'])) {
                    echo "<strong>Journey valid until:</strong> " . $userData['dateTravel'];
                }
            ?>
        </div>
    </div>

    <!-- Driver and Journey Information -->
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <?php 
                // Fetch journey and vehicle details
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
                        (SELECT COUNT(*) FROM bookings WHERE bookings.journey_id = journey.id) AS passengers_booked
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
                            <li><strong>Téléphone:</strong> <?= $userData['phoneNumber']; ?></li>
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
</div>
</main>

<?php include('footer1.html'); ?>
</html>
