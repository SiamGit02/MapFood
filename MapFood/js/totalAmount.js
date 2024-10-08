// Function to calculate and update the total amount
function updateTotal() {
    let total = 60;
    

    // Iterate through each row in the table
    const rows = document.querySelectorAll("#cart tr");
    rows.forEach((row, index) => {
        const price = parseFloat(row.querySelector(".price").textContent);
        const quantity = parseInt(row.querySelector(".quantity").value);

        // Calculate the subtotal for the row
        const subtotal = price * quantity;

        // Add the subtotal to the total
        total += subtotal;

        
    });

    // Update the total amount
    document.querySelector("#total").textContent = total.toFixed(2);
}

// Add event listeners to input fields for quantity changes
const quantityInputs = document.querySelectorAll(".quantity");
quantityInputs.forEach((input) => {
    input.addEventListener("input", updateTotal);
});

// Initial calculation of total amount
updateTotal();