<!doctype html>
<html class="no-js" lang="zxx">
<?php
include('header.php'); 
?>
<style>
    .vehicle-image {
        width: 100%;
        height: auto;
        max-width: 400px;
        max-height: 400px;
    }

    .book-btn {
    display: block;
    width: 100%;
    padding: 18px;
    background: #38b6ff;
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: background 0.3s;
}

    .book-btn:hover {
        background: #7ed957;
    }

    .space-between {
    margin-top: 10px;
}

    .number-input {
    width: 100%;
    padding: 5px 5px 5px 25px;
    margin: 20px 0px 10px 0px;  /* top right bottom left */
    border: 1px solid #7ed957;
    border-radius: 25px;
    font-size: 15px;
}

</style>
<main style="background-color:whitesmoke">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="hero-cap text-center"><br><br>
                    <h4>Voici les détails concernant le voyage que vous avez sélectionné</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job Post Company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-10 col-md-offset-2">
                    <?php
                    require 'Models/journey_details.php';
                    $id = $_GET["id"]; // Get journey ID
                    $resultat = getJourneyDetails($id); // Fetch journey details

                    // Database connection
                    $bdd = getBdd();

                    // Fetch chauffeur phone number
                    $reqx = $bdd->prepare('
                        SELECT u.phoneNumber
                        FROM users u
                        JOIN journey j ON u.email = j.emailChauffeur
                        WHERE j.id = ?
                    ');
                    $reqx->execute(array($id));
                    $result = $reqx->fetch();

                    if (!$result) {
                        echo "<p style='color: red;'>Erreur : Impossible de trouver le numéro de téléphone du chauffeur.</p>";
                        $phoneNumber = "Non disponible";
                    } else {
                        $phoneNumber = $result['phoneNumber'];
                    }
                    ?>

                    <div class="post-details3 mb-50" style="background-color:white">
                        <div class="small-section-tittle">
                            <h4><span style="color:#38B6FF">De</span> <?= $resultat['lieuDep'] . "<span style='color:#38B6FF'> Pour</span> " . $resultat['lieuArriv']; ?></h4>
                        </div>

                        <ul>
                            <li>Date de départ : <span><?= $resultat['dateTravel']; ?></span></li>
                            <li>Heure de départ : <span><?= $resultat['heureDep']; ?></span></li>
                            <li>Lieu de départ : <span><?= $resultat['lieuDep']; ?></span></li>
                            <li>Destination : <span><?= $resultat['lieuArriv']; ?></span></li>
                            <li>Nombre de place(s) : <span><?= $resultat['nbPlaces']; ?></span></li>
                            <li>Numero du chauffeur : <span>+237 <?= $phoneNumber; ?></span></li>

                            <div class="apply-btn2">
                                <button class="btn book-btn" id="seeMore">Voir plus</button>
                            </div>
                            <div class="apart" style="display:none">
                                <h3 style="color:#38B6FF">Infos concernant le véhicule</h3>
                                <li>Marque : <span><?= $resultat['marque']; ?></span></li>
                                <li>Modèle : <span><?= $resultat['model']; ?></span></li>
                                <li>Couleur : <span><?= $resultat['couleur']; ?></span></li>
                                <li>Matricule : <span><?= $resultat['immat']; ?></span></li>
                                <h3 style="color:#38B6FF">Images du véhicule</h3>
                                <div class="row">
                                    <div class="col-m-3">
                                        <img src="uploads/<?= $resultat['photo_1']; ?>" class="vehicle-image" alt="1" style="width: 100%; height: auto; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 15px;">
                                    </div>
                                    <div class="col-m-3">
                                        <img src="uploads/<?= $resultat['photo_2']; ?>" class="vehicle-image" alt="2" style="width: 50%; height: auto; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 15px;">
                                    </div>
                                    <div class="col-m-3">
                                        <img src="uploads/<?= $resultat['photo_3']; ?>" class="vehicle-image" alt="3" style="width: 50%; height: auto; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 15px;">
                                    </div>
                                </div>
                            </div>
                        </ul>

                        <!-- Booking Form -->
                        <!-- Check if the user is logged in -->
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <!-- Booking Form -->
                            <form action="index.php?page=booking" method="POST">
                                <input type="hidden" name="journey_id" value="<?= $id; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="number" name="seats_booked" min="1" max="<?= $resultat['nbPlaces']; ?>" placeholder="Nombre de places" required class="number-input" required>
                                
                                <button class="btn book-btn" >Réserver</button>
                                
                            </form>
                            <?php else: ?>
                                <!-- Trigger the notification modal -->
                                <button class="btn book-btn" style="margin-top: 10px;" onclick="openNotificationModal(
                                    'Connexion requise',
                                    'Veuillez vous connecter ou créer un compte pour continuer.',
                                    'index.php?page=connexion', // Login link
                                    'index.php?page=registration', // Registration link
                                    false // Hide the OK button
                                )">Réserver</button>                              
                            <?php endif; ?>
                        <!-- End Booking Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Post Company End -->
</main>
<?php include('footer.html'); ?>
<script>
    // Toggle visibility of additional vehicle details
    document.getElementById('seeMore').addEventListener('click', function () {
        const apart = document.querySelector('.apart');
        if (apart.style.display === 'none') {
            apart.style.display = 'block';
            this.textContent = 'Voir moins';
        } else {
            apart.style.display = 'none';
            this.textContent = 'Voir plus';
        }
    });
</script>
</body>
</html>
