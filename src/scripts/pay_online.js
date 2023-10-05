// Retrieve the URL parameters
const urlParams = new URLSearchParams(window.location.search);
const user = urlParams.get('user');
const contactNumber = urlParams.get('contact_number');

// Set the values in the form fields
document.getElementById('field1').value = user;
document.getElementById('field3').value = contactNumber;

// Generate random values for the remaining fields
document.getElementById('field2').value = "PN_" + generateRandomValue();
document.getElementById('field4').value = getRandomFutureDate();
document.getElementById('field5').value = "Rs. " + generateRandomValue() + ".00";
document.getElementById('field6').value = getRandomStatus();

// Function to generate random value
function generateRandomValue() {
    const randomValue = Math.floor(Math.random() * 1000); // Change the range as needed
    return randomValue;
}

// Function to generate a random date in the future
function getRandomFutureDate() {
    const currentDate = new Date(); // Get the current date
    const randomOffset = Math.random() * (365 * 24 * 60 * 60 * 1000); // Random number of milliseconds within 1 year

    const futureTime = currentDate.getTime() + randomOffset; // Add the random offset to the current date
    const futureDate = new Date(futureTime); // Create a new Date object with the future time

    const day = futureDate.getDate().toString().padStart(2, '0'); // Get the day and pad with leading zero if necessary
    const month = (futureDate.getMonth() + 1).toString().padStart(2, '0'); // Get the month (Note: Month is zero-based) and pad with leading zero if necessary
    const year = futureDate.getFullYear(); // Get the year

    return `${day}-${month}-${year}`;
}

// Function to return a random value from 'active' and 'lapsed'
function getRandomStatus() {
    const statuses = ['Active', 'Lapsed'];
    const randomIndex = Math.floor(Math.random() * statuses.length);
    const randomStatus = statuses[randomIndex];
    return randomStatus;
}

// Get the form element
const form = document.getElementById('payonline2');

// Get the submit button element
const submitButton = document.getElementById('pay_online_2_submit');

// Add a click event listener to the submit button
submitButton.addEventListener('click', function () {
    // Redirect to the payment_portal.html page
    window.location.href = 'payment_portal.html';
});