// List of cities for suggestion
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

// Function to show suggestions
function showSuggestions(inputElement, suggestionBox) {
    const value = inputElement.value.trim(); // Trim input value
    suggestionBox.innerHTML = ""; // Clear previous suggestions
    suggestionBox.style.display = "none"; // Hide by default

    if (value === "") return; // If input is empty, don't show suggestions

    // Filter cities based on input value
    const matches = cities.filter(city => city.toLowerCase().startsWith(value.toLowerCase()));

    if (matches.length > 0) {
        matches.forEach(match => {
            const div = document.createElement("div");
            div.textContent = match;

            // Add click event listener to populate input and hide suggestions
            div.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevent document click from firing
                inputElement.value = match; // Set the input value
                suggestionBox.innerHTML = ""; // Clear suggestions
                suggestionBox.style.display = "none"; // Hide suggestions
            });

            suggestionBox.appendChild(div);
        });
        suggestionBox.style.display = "block"; // Show suggestions
    }
}

// Event listener to hide suggestions when clicking outside
document.addEventListener("click", function () {
    const suggestionBoxes = document.querySelectorAll(".suggestions");
    suggestionBoxes.forEach(box => {
        box.style.display = "none";
    });
});
