$(document).ready(function () {
    $(".next1").click(function (e) {
        e.preventDefault();
        $("label").css("color", "black");
        $("#oblig").css("color", "red");

        let succes = true;
        const dateTravel = $("#dateTravel").val();
        const heureDep = $("#heureDep").val();
        const nbPlaces = $("#nbPlaces").val();

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
        let succes = true;
        const immat = $("#immat").val();
        const marque = $("#marque").val();
        const model = $("#model").val();
        const couleur = $("#couleur").val();

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
        }
    });

    $(".next3").click(function (e) {
        e.preventDefault();
        let succes = true;
        const photo_1 = $("#photo_1").get(0).files[0];

        // Validate the first photo
        if (!photo_1) {
            $(".photo_1").css("display", "flex");
            succes = false;
            alert("Veuillez téléchargez la photo complète du véhicule.");
        } else {
            $(".photo_1").css("display", "none");
        }

        if (succes == true) {
            // Populate confirmation step with text
            $("#confirm-lieuDep").text($("#month").val());
            $("#confirm-lieuArriv").text($('[name="lieuArriv"]').val());
            $("#confirm-dateTravel").text($("#dateTravel").val());
            $("#confirm-heureDep").text($("#heureDep").val());
            $("#confirm-nbPlaces").text($("#nbPlaces").val());

            $("#confirm-immat").text($("#immat").val());
            $("#confirm-marque").text($("#marque").val());
            $("#confirm-model").text($("#model").val());
            $("#confirm-couleur").text($("#couleur").val());

            // Display image previews
            const previewPhoto = (fileInput, previewId) => {
                if (fileInput && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $(previewId).attr("src", e.target.result).show();
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            };

            previewPhoto($("#photo_1").get(0), "#confirm-photo1");
            previewPhoto($("#photo_2").get(0), "#confirm-photo2");
            previewPhoto($("#photo_3").get(0), "#confirm-photo3");

            // Show the confirmation step
            $(".form-card2").hide();
            $(".form-card3").show();
        }
    });

    $(".previous").click(function () {
        $(this).closest("fieldset").hide().prev("fieldset").show();
    });
});
