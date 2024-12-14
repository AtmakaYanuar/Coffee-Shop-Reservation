// Modal variables
var confirmModal = document.getElementById("confirmModal");
var loginSubmit = document.getElementById("loginSubmit");

// Show "Are you sure?" modal on login submit
loginSubmit.onclick = function(event) {
    event.preventDefault(); // Prevent actual form submission
    confirmModal.style.display = "block";
}

// If user confirms, proceed with login
document.getElementById("confirmYes").onclick = function() {
    confirmModal.style.display = "none"; // Hide "Are you sure?" modal
    alert("You have logged in!"); // Simulating login success
    // Here you can add your actual login logic
}

// If user cancels, close "Are you sure?" modal
document.getElementById("confirmNo").onclick = function() {
    confirmModal.style.display = "none";
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
    if (event.target == confirmModal) {
        confirmModal.style.display = "none";
    }
}