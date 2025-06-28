let currentIndex = 0;
const items = document.querySelectorAll(".carousel-item");
const totalItems = items.length;

function showSlide(index) {
  // Menjaga agar index tetap dalam batas yang valid
  if (index >= totalItems) {
    currentIndex = 0;
  } else if (index < 0) {
    currentIndex = totalItems - 1;
  } else {
    currentIndex = index;
  }
  const carouselWrapper = document.querySelector(".carousel-wrapper");
  carouselWrapper.style.transform = `translateX(-${currentIndex * 100}%)`;
}

// Fungsi untuk slide otomatis setiap 3 detik
function autoSlide() {
  showSlide(currentIndex + 1);
}

// Menjalankan auto slide setiap 3 detik
setInterval(autoSlide, 3000);

// Tombol untuk pindah ke slide berikutnya
function nextSlide() {
  showSlide(currentIndex + 1);
}

// Tombol untuk pindah ke slide sebelumnya
function prevSlide() {
  showSlide(currentIndex - 1);
}

// Menampilkan slide pertama
showSlide(currentIndex);
