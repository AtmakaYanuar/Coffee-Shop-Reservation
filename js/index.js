function changeContent() {
    document.getElementById("welcome-text").innerHTML = "Enjoy the Best Coffee Experience!";
    document.getElementById("welcome-description").innerHTML = "We offer a variety of freshly brewed coffee and homemade pastries. Come and enjoy a cozy atmosphere with free Wi-Fi.";
    
    // Tampilkan snackbar saat tombol diklik
    showSnackbar("Welcome content has been updated!");
}

function showSnackbar(message) {
    const snackbar = document.getElementById("snackbar");
    snackbar.textContent = message; // Ubah teks dalam snackbar
    snackbar.className = "show"; // Tambahkan kelas untuk menampilkan
    
    // Hilangkan snackbar setelah 3 detik
    setTimeout(() => {
        snackbar.className = snackbar.className.replace("show", "");
    }, 3000);
}
