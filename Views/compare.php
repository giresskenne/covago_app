<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title>Publier un voyage c'est simple!</title>
</head>
<body>
    <?php include('header.php'); ?>

    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <?php 
                    if (isset($_GET["message"])) {
                        $message = $_GET["message"];
                    ?>
                    <h3 style="color:green"><strong><?= $message ?></strong></h3>
                    <?php } ?>
                    <h2><strong>Publier un voyage</strong></h2>
                    <p id="oblig" style="color:red"><i> Remplir tous ces champs pour passer a la prochaine etape</i></p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform" enctype="multipart/form-data" method="POST" action="index.php?page=post_process">
                                <fieldset class="form-card0">
                                    <div class="form-card">
                                        <h2 class="fs-title">Information concernant le voyage</h2>
                                        <br>
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="pay">Lieu de depart</label>
                                            </div>
                                            <div class="col-9">
                                                <select class="list-dt" id="month" name="lieuDep">
                                                    <option value="Yaoundé">Yaoundé</option>
                                                    <option value="Douala">Douala</option>
                                                    <option value="Bafoussam">Bafoussam</option>
                                                    <option value="Ngaroundere">Ngaroundere</option>
                                                    <option value="Bertoua">Bertoua</option>
                                                    <option value="Bamenda">Bamenda</option>
                                                    <option value="Buea">Buea</option>
                                                    <option value="Maroua">Maroua</option>
                                                    <option value="Garoua">Garoua</option>
                                                </select>
                                                
                                                <label class="pay">Destination</label>
                                                <select class="list-dt" id="month" name="lieuArriv">
                                                    <option value="Yaoundé">Yaoundé</option>
                                                    <option value="Douala">Douala</option>
                                                    <option value="Bafoussam">Bafoussam</option>
                                                    <option value="Ngaroundere">Ngaroundere</option>
                                                    <option value="Bertoua">Bertoua</option>
                                                    <option value="Bamenda">Bamenda</option>
                                                    <option value="Buea">Buea</option>
                                                    <option value="Maroua">Maroua</option>
                                                    <option value="Garoua">Garoua</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <label>Date de départ: </label>
                                        <input name="dateTravel" type="date" id="dateTravel" placeholder="Entrez la date de voyage" required>
                                        <p class="dateTravel" style="display:none;color:red"><i>Svp renseignez une date valide pour votre voyage</i></p>
                                        <label>Heure de départ: </label>
                                        <input name="heureDep" type="time" id="heureDep" placeholder="Entrez l'heure de départ" required>
                                        <p class="heureDep" style="display:none;color:red"><i>Svp renseignez une heure valide pour votre voyage</i></p>
                                        <input name="nbPlaces" id="nbPlaces" type="number" placeholder="Entrez le nombre de place">
                                        <p class="nbPlaces" style="display:none;color:red"><i>Svp renseignez le nombre de place disponible pour votre voyage</i></p>
                                    </div>
                                    <input type="button" name="next" class="next1" value="Suivant" style="width:100%;height:50px;background:#7de957;font-size:20px;line-height:1;text-align:center;color:#fff;display:block;padding:15px;">
                                </fieldset>
                                <!-- Add the rest of your fieldsets here -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("msform"); // Form element
            const dateInput = document.getElementById("dateTravel");
            const timeInput = document.getElementById("heureDep");
            const nextButton = document.querySelector(".next1");

            nextButton.addEventListener("click", (e) => {
                const today = new Date();
                const selectedDate = new Date(dateInput.value + "T" + (timeInput.value || "00:00"));

                // If the selected date is not valid, prevent submission
                if (!selectedDate || isNaN(selectedDate)) {
                    e.preventDefault();
                    alert("Veuillez saisir une date et une heure valides.");
                    return;
                }

                // Validate if selected date and time are in the past
                if (selectedDate < today) {
                    e.preventDefault(); // Prevent form submission
                    alert("La date et l'heure de départ ne peuvent pas être dans le passé. Veuillez choisir une date et une heure valides.");
                    return;
                }

                // Move to the next fieldset
                // Assuming you have logic to move to the next fieldset here
            });
        });
    </script>

    <?php include('footer.html'); ?>
</body>
</html>
