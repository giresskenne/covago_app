$(document).ready(function () {
    $(".next1").click(function (e) {
        e.preventDefault();
        $("label").css("color", "black");
        $("#oblig").css("color", "red");

        var succes = true;
        var dateTravel = $("#dateTravel").val();
        var heureDep = $("#heureDep").val();
        var nbPlaces = $("#nbPlaces").val();
        
        const today = new Date();
        const selectedDate = new Date(dateTravel + "T" + (heureDep || "00:00"));

        // Validate date
        if (!selectedDate || isNaN(selectedDate)) {
            $(".dateTravel").css("display", "flex");
            succes = false;
            alert("Veuillez saisir une date et une heure valides.");
        } else if (selectedDate < today) {
            $(".dateTravel").css("display", "flex");
            succes = false;
            alert("La date et l'heure de départ ne peuvent pas être dans le passé. Veuillez choisir une date et une heure valides.");
        } else {
            $(".dateTravel").css("display", "none");
        }

        // Validate hour
        if (heureDep == "") {
            $(".heureDep").css("display", "flex");
            succes = false;
        } else {
            $(".heureDep").css("display", "none");
        }

        // Validate number of places
        if (nbPlaces == "") {
            $(".nbPlaces").css("display", "flex");
            succes = false;
        } else {
            $(".nbPlaces").css("display", "none");
        }

        // Proceed to the next fieldset only if all validations pass
        if (succes == true) {
            $(".form-card0").hide();
            $(".form-card1").show();
        }
    });

    $(".next2").click(function (e) {
        e.preventDefault();
        var succes = true;
        var immat = $("#immat").val();
        var marque = $("#marque").val();
        var model = $("#model").val();
        var couleur = $("#couleur").val();

        if (immat == "") {
            $(".immat").css("display", "flex");
            succes = false;
        } else {
            $(".immat").css("display", "none");
        }

        if (marque == "") {
            $(".marque").css("display", "flex");
            succes = false;
        } else {
            $(".marque").css("display", "none");
        }

        if (model == "") {
            $(".model").css("display", "flex");
            succes = false;
        } else {
            $(".model").css("display", "none");
        }

        if (couleur == "") {
            $(".couleur").css("display", "flex");
            succes = false;
        } else {
            $(".couleur").css("display", "none");
        }

        if (succes == true) {
            $(".form-card1").hide();
            $(".form-card2").show();
            $(".photo_1").css("display", "none");
            $(".photo_2").css("display", "none");
            $(".photo_3").css("display", "none");
            var photo_1 = $("#photo_1").val();
            var photo_2 = $("#photo_2").val();
            var photo_3 = $("#photo_3").val();
            if (photo_1 == "") {
                $(".photo_1").css("display", "flex");
                succes = false;
            } else {
                $(".photo_1").css("display", "none");
            }
        }
    });
});
