// Initialize an empty array to store the medicine information
const medicineArray = [];

function addMedicine(medicineName, medicineImgLink, medicinePrice) {
    // Create an object to represent the medicine information
    const medicine = {
        name: medicineName,
        img_link: medicineImgLink,
        price: medicinePrice
    };

    // Add the medicine object to the array
    medicineArray.push(medicine);
}

function goToCart(event) {
    // Prevent the form from being submitted immediately
    event.preventDefault();

    // Set the medicine array value to the hidden input field
    document.getElementById('medicineArrayInput').value = JSON.stringify(medicineArray);

    // Submit the form
    document.getElementById('cartForm').submit();
}
