// Tanggal Pilkada
const countDownDate = new Date("Nov 27, 2024 08:00:00").getTime();

// Update countdown setiap detik
const x = setInterval(function() {
    const now = new Date().getTime();
    const distance = countDownDate - now;

    // Hitung hari, jam, menit, detik
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Tampilkan hasil countdown
    document.getElementById("countdown").innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";

    // Jika countdown selesai
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "Pilkada Sudah Dimulai!";
    }
}, 1000);
