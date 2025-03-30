document.getElementById('carbonFootprintForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    // Get values from the form
    const transportScore = parseInt(document.getElementById('transport').value);
    const energyScore = parseInt(document.getElementById('energy').value);
    const dietScore = parseInt(document.getElementById('diet').value);
    const wasteScore = parseInt(document.getElementById('waste').value);

    // Calculate total score
    const totalScore = transportScore + energyScore + dietScore + wasteScore;

    // Display the result
    const resultElement = document.getElementById('result');
    resultElement.textContent = "Your estimated carbon footprint score is: " + totalScore;
    resultElement.style.display = 'block';
});