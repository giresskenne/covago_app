<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <style>
        .suggestions {
            position: absolute;
            z-index: 9999;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            max-height: 150px;
            overflow-y: auto;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .suggestions div {
            padding: 8px;
            cursor: pointer;
        }

        .suggestions div:hover {
            background-color: #f0f0f0;
        }

        .input-field {
            position: relative;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-button {
            background: #38B6FF;
            font-size: 20px;
            line-height: 1;
            text-align: center;
            color: #fff;
            display: block;
            padding: 15px;
            border-radius: 4px;
            text-transform: capitalize;
            border: none;
            font-family: "Muli", sans-serif;
            letter-spacing: 0.1em;
        }

        .form-container {
            display: flex;
            align-items: center;
            gap: 10px; /* Adjust the gap between elements as needed */
            justify-content: center; /* Center elements */
            margin: 10px; /* Center the entire form */
            max-width: 600px; /* Limit the width of the form container */
        }

        /* Ensure input fields and button take full available space */
        .input-field input,
        .search-form input {
            flex: 1; /* Make them take equal space */
            width: 100%; /* Ensure full width */
            max-width: 100%; /* Ensure max width matches container */
            padding: 15px; /* Ensure consistent padding */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: none;
        }

        /* Button styling */
        .button1 {
            background: #38B6FF;
            font-size: 20px;
            line-height: 1;
            text-align: center;
            color: #fff;
            display: block;
            padding: 10px;
            border-radius: 4px;
            text-transform: capitalize;
            border: 0px #38B6FF;
            font-family: 'Muli', sans-serif;
            letter-spacing: 0.1em;
            line-height: 1.2;
            height: 58px; /* Match input height for better alignment */
            width: auto; /* Ensure width is auto to fit the content */
        }

        /* Remove margin from search form to align properly */
        .search-form {
            flex: 0 0 auto; /* Ensure the button takes up only necessary space */
            margin-top: 0; /* Remove top margin */
        }

        /* Responsive design: stack elements vertically on smaller screens */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column; /* Stack elements vertically */
                align-items: stretch; /* Make elements stretch to fit the container */
            }

            .button1 {
                width: 100%; /* Make button full width */
            }
        }
    </style>
</head>
<?php include('header.php'); ?>
<main style="background-color:whitesmoke">
    <!-- <div class="row">
        <div class="col-xl-8"> -->
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <!-- Form -->
                <form action="index.php?page=search1" method="POST" class="search-box form-container">
                    <div class="input-field">
                        <input type="text" name="lieuArriv" id="lieuArriv" placeholder="Où vous rendez-vous ?" 
                               oninput="showSuggestions(this.value, 'arrivSuggestions')" autocomplete="off">
                        <div id="arrivSuggestions" class="suggestions"></div>
                    </div>
                    <div class="input-field search-form">
                        <input type="submit" id="search" value="Chercher" class="button1">
                    </div>
                </form>
            </div>
        </div>


    <!-- Rest of the page content -->
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="hero-cap text-center">
                    <h2>Trouvez le voyage de votre choix parmi tous les 
                        <a href="#" style="color:#38B6FF"><?= $nombre ?> Voyages disponibles</a>
                    </h2>
                </div>
            </div>
        </div>
<!--  -->
        </div></br></br>

        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                
                                <?php 
                                $dateN = time();
                                //include('Models/db.php');
                                if (isset($_GET["seite"]) && !empty($_GET["seite"])) {
                                    $seite=intval($_GET["seite"]);
                                    $pageCourante=$_GET["seite"];
                                }
                                else{
                                    $pageCourante=1;
                                }
                                
                                $bdd=getBdd();
                                $req = $bdd->prepare('SELECT * FROM journey');
                                $req->execute(array());
                                $nbre_element_page=5;
                                $nbre_elmt=$req->rowCount();
                                $nbre=ceil($nbre_elmt/$nbre_element_page);
                                $depart=($pageCourante-1)*$nbre_element_page;
                                //$todayDate=date('y/m/d');
                                $qer = $bdd->prepare("select * from journey order by id desc limit $depart,$nbre_element_page");
                                $qer->execute(array());
                                while ($resultat = $qer->fetch()){ 
                                    $id=$resultat['id'];
                                    $DatePoste = $resultat["postDate"];
                            $datePost = strtotime($DatePoste);
                            $DiffDate = abs(($dateN) - ($datePost));
            
                            $retour = array();
                            $retour['second'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['second']) / 60);
                            $retour['minute'] = $DiffDate % 60;
                            $DiffDate = floor(($DiffDate - $retour['minute']) / 60);
                            $retour['hour'] = $DiffDate % 24;
                            $DiffDate = floor(($DiffDate - $retour['hour']) / 24);
                            $retour['day'] = $DiffDate;
                                 //echo $resultat['photo_1']; ?>
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="#"><img src="uploads/<?= $resultat['photo_1']; ?>" alt="" width="80" height="80"></a>
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a href="#">
                                                <h4><span style="color:#38B6FF">De</span> <?= $resultat['lieuDep']."<span style='color:#38B6FF'> Pour</span> ".$resultat['lieuArriv']; ?></h4>
                                            </a>
                                            <ul>
                                                <li><span>Depart prévu le</span> <span style="color:#38B6FF"><?= $resultat['dateTravel']; ?><span/></li>
                                                <li><span> à </span><span style="color:#38B6FF"><?= $resultat['heureDep']; ?><span/></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                    <?="<a href=index.php?page=details&amp;id=$id>Voir les details</a>"; ?>
                                        <span>Publié Il y a <?php  echo $retour['day']; ?> Jours</span>
                                    </div>
                                </div><hr>
                                <?php } ?> 
                                <!-- single-job-content -->
                            </div>
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!--Pagination Start  -->
        <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <?php
                                    for ($i=1; $i <=$nbre ; $i++) {   
                                    echo "<li class=items-link items-link2 f-right active><a style=border-color:#8b92dd 1px class=page-link href=index.php?page=voyages&amp;seite=$i>
                                    $i</a></li>";
                                }
                                    ?>
                                    
                                    
                                <li class="page-item"><a class="page-link" href="#"><span class="ti-angle-right"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pagination End  -->
        
    </main>
<script>
const cities = [
    "Yaoundé",
    "Douala",
    "Bafoussam",
    "Ngaroundere",
    "Bertoua",
    "Bamenda",
    "Buea",
    "Maroua",
    "Garoua"
];

function showSuggestions(value, suggestionBoxId) {
    const suggestionBox = document.getElementById(suggestionBoxId);
    suggestionBox.innerHTML = ""; // Clear previous suggestions
    suggestionBox.style.display = "none"; // Hide by default

    if (value.trim() === "") return; // If input is empty, don't show suggestions

    const matches = cities.filter(city => city.toLowerCase().startsWith(value.toLowerCase()));
    console.log(`Matches for "${value}":`, matches); // Debugging

    if (matches.length > 0) {
        matches.forEach(match => {
            const div = document.createElement("div");
            div.textContent = match;

            // Add click event listener to populate input and hide suggestions
            div.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent the document click event from firing
                let inputField;
                if (suggestionBoxId === 'arrivSuggestions') {
                    inputField = document.getElementById('lieuArriv');
                } else if (suggestionBoxId === 'depSuggestions') {
                    inputField = document.getElementById('lieuDep');
                }
                console.log(`Clicked on: ${match}`); // Debugging
                if (inputField) {
                    inputField.value = match; // Set the input value
                    suggestionBox.innerHTML = ""; // Clear suggestions
                    suggestionBox.style.display = "none"; // Hide suggestions
                    console.log(`Input field with ID ${inputField.id} updated to "${match}"`); // Debugging
                } else {
                    console.error(`Input field for suggestion box ID ${suggestionBoxId} not found`); // Debugging
                }
            });

            suggestionBox.appendChild(div);
        });
        suggestionBox.style.display = "block"; // Show suggestions
    }
}

// Hide suggestions when clicking outside
document.addEventListener("click", function () {
    const suggestionBoxes = document.querySelectorAll(".suggestions");
    suggestionBoxes.forEach(box => (box.style.display = "none"));
    console.log("Suggestions hidden"); // Debugging
});

// Prevent hiding suggestions when clicking inside input or suggestion box
document.getElementById("lieuDep").addEventListener("click", (event) => {
    event.stopPropagation();
    console.log("Click inside input field: lieuDep"); // Debugging
});
document.getElementById("lieuArriv").addEventListener("click", (event) => {
    event.stopPropagation();
    console.log("Click inside input field: lieuArriv"); // Debugging
});

</script>
<?php include('footer.html'); ?>
</html>