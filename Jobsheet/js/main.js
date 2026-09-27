/* ==========================================================
   JOBSHEET - main.js
   Website statis interaktif "JOBSHEET cover" - Naufal Farhan
   Nur Ramadhan, TI-2D.

   PHASE 6 (final): dukungan navigasi keyboard (focus/blur
   disatukan dengan logika hover mouse), aria-label & alt text
   untuk accessibility, cleanup komentar.

   CATATAN AUDIO: semua browser modern memblokir autoplay
   audio sampai pengguna melakukan minimal satu interaksi di
   halaman - ini kebijakan browser, bukan bug. Overlay "KLIK
   UNTUK MULAI" (lihat setupStartOverlay) berfungsi sebagai
   interaksi wajib pertama itu, supaya sound effect hover bisa
   langsung bekerja sejak awal untuk sisa sesi.
========================================================== */

/* ----------------------------------------------------------
   DATA JOBSHEET
   Ini adalah SATU-SATUNYA tempat yang perlu diedit untuk
   mengubah konten tombol (number, title, link, image, sound).

   Cara edit:
   - number : nomor tombol (format 2 digit, contoh "01")
   - title  : judul yang muncul saat hover (kanan bawah)
   - link   : tujuan saat tombol diklik (relative/absolute URL)
   - image  : path gambar yang muncul saat hover
   - sound  : path sound effect yang dimainkan saat hover

   Tinggal ganti isi tiap object di bawah ini sesuai kebutuhan.
---------------------------------------------------------- */
const jobsheets = [
  { number: "01", title: "PENGENALAN HTML", link: "Jobsheet-01/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "02", title: "KONSEP DASAR CSS", link: "Jobsheet-02/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "03", title: "KONSEP DASAR RESPONSIVE", link: "Jobsheet-03/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "03-BS", title: "BOOTSTRAP", link: "Jobsheet-03/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "04", title: "UI/UX", link: "Jobsheet-04/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "05", title: "KONSEP DASAR JAVASCRIPT", link: "Jobsheet-05/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "06", title: "FETCH/JSON", link: "Jobsheet-06/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "07", title: "KONSEP DASAR PHP", link: "https://jobsheet-07-eta.vercel.app/", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "08", title: "DATABASE", link: "https://jobsheet-08-black.vercel.app/", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "09", title: "JUDUL JOBSHEET 09", link: "Jobsheet-09/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "10", title: "JUDUL JOBSHEET 10", link: "Jobsheet-10/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "11", title: "JUDUL JOBSHEET 11", link: "Jobsheet-11/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "12", title: "JUDUL JOBSHEET 12", link: "Jobsheet-12/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "13", title: "JUDUL JOBSHEET 13", link: "Jobsheet-13/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "14", title: "JUDUL JOBSHEET 14", link: "Jobsheet-14/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" },
  { number: "15", title: "JUDUL JOBSHEET 15", link: "Jobsheet-15/index.html", image: "./assets/images/flower.jpg", sound: "./assets/audio/hover.mp3" }
];


/* ----------------------------------------------------------
   POLA LEBAR TOMBOL
   Menentukan variasi panjang-pendek tombol secara berulang
   (sesuai gambar referensi): pendek, sedang, panjang, sedang
   - lalu berulang lagi mulai tombol ke-5, dst.

   Class ini harus cocok dengan class ".w-short", ".w-medium",
   ".w-long", ".w-medium2" yang ada di css/style.css.

   Untuk mengubah pola, cukup ubah urutan array ini.
---------------------------------------------------------- */
const widthPattern = ["w-short", "w-medium", "w-long", "w-medium2"];

/* ----------------------------------------------------------
   RENDER JOBSHEET BUTTONS
   Membuat tombol secara dinamis dari array `jobsheets` dan
   memasukkannya ke dalam #jobsheetList.

   data-* attribute (number, title, link, image, sound)
   disematkan di setiap tombol agar bisa dipakai oleh
   event hover/fokus/klik.
---------------------------------------------------------- */
function renderJobsheetButtons() {
  const list = document.getElementById("jobsheetList");
  if (!list) return;

  // Kosongkan dulu (menghindari duplikasi jika dipanggil ulang)
  list.innerHTML = "";

  jobsheets.forEach((item, index) => {
    const btn = document.createElement("button");
    btn.type = "button";

    // Class dasar + class lebar sesuai pola berulang
    const widthClass = widthPattern[index % widthPattern.length];
    btn.className = `jobsheet-btn ${widthClass}`;

    // Simpan data di tombol untuk dipakai event hover & klik
    btn.dataset.number = item.number;
    btn.dataset.title = item.title;
    btn.dataset.link = item.link;
    btn.dataset.image = item.image;
    btn.dataset.sound = item.sound;

    // Aria-label supaya pembaca layar (screen reader) dan
    // navigasi keyboard bisa memahami tujuan tombol ini,
    // meski secara visual hanya menampilkan angka.
    btn.setAttribute("aria-label", `Jobsheet ${item.number}: ${item.title}`);

    // z-index menurun untuk tombol yang lebih ke bawah, supaya
    // tombol di atas selalu tumpang tindih (menutupi bayangan
    // 3D) tombol di bawahnya saat tombol bawah lebih pendek.
    btn.style.zIndex = jobsheets.length - index;

    btn.innerHTML = `
      <span class="jobsheet-btn__pill">
        <span class="jobsheet-btn__pill-fill"></span>
        <img class="jobsheet-btn__image" src="${item.image}" alt="Foto untuk ${item.title}" />
      </span>
      <span class="jobsheet-btn__number">${item.number}</span>
    `;

    list.appendChild(btn);
  });
}

/* ----------------------------------------------------------
   START OVERLAY
   CATATAN PENTING: semua browser modern (Chrome, Firefox,
   Safari) MEMBLOKIR autoplay audio sampai pengguna melakukan
   minimal SATU interaksi (klik/tap) di halaman. Ini kebijakan
   keamanan browser, bukan bug - tidak bisa dilewati sepenuhnya
   dari kode.

   Overlay awal ("KLIK UNTUK MULAI") berfungsi sebagai interaksi
   pertama yang WAJIB dilakukan pengguna sebelum masuk ke
   halaman utama. Begitu diklik:
     1. Sebuah Audio "primer" diputar+langsung dijeda, supaya
        browser mengizinkan audio diputar untuk sisa sesi.
     2. Overlay memudar (fade out) lalu disembunyikan total.
   Setelah ini, hover ke tombol jobsheet manapun akan langsung
   bersuara tanpa hambatan lagi.
---------------------------------------------------------- */
function setupStartOverlay() {
  const overlay = document.getElementById("startOverlay");
  const startBtn = document.getElementById("startOverlayBtn");
  if (!overlay || !startBtn) return;

  startBtn.addEventListener("click", () => {
    // Buka kunci audio browser dengan memutar+langsung
    // menjeda audio yang sesungguhnya dipakai (bukan dummy
    // terpisah), supaya browser mengizinkannya untuk
    // pemutaran berikutnya di seluruh halaman.
    const primer = new Audio(jobsheets[0]?.sound || "");
    primer.volume = 0;
    primer.play()
      .then(() => primer.pause())
      .catch(() => {
        // Diamkan - jika gagal, sound tetap akan dicoba
        // normal saat hover pertama kali terjadi nanti.
      });

    overlay.classList.add("is-hidden");
  });
}

/* ----------------------------------------------------------
   HOVER & FOCUS INTERACTION
   Saat cursor masuk tombol (mouseenter) ATAU tombol menerima
   fokus keyboard (focus, misal lewat Tab):
     - tombol mendapat class "is-active" (styling di CSS:
       inner area jadi orange, foto bunga muncul, animasi
       smooth via transition)
     - judul jobsheet muncul di kanan bawah (#activeTitle)
     - sound effect dimainkan satu kali
   Saat cursor keluar (mouseleave) ATAU fokus keyboard pindah
   (blur):
     - class "is-active" dilepas
     - jika tidak ada tombol lain yang sedang aktif,
       judul di kanan bawah disembunyikan

   Logika mouse dan keyboard disatukan lewat fungsi activate()
   dan deactivate() supaya perilakunya selalu konsisten - siapa
   pun yang mengaksesnya (mouse atau keyboard) mendapat
   pengalaman yang sama.
---------------------------------------------------------- */
function setupHoverInteraction() {
  const list = document.getElementById("jobsheetList");
  const activeTitle = document.getElementById("activeTitle");
  if (!list || !activeTitle) return;

  const buttons = list.querySelectorAll(".jobsheet-btn");

  buttons.forEach((btn) => {
    // Simpan z-index dasar (dipasang saat render) supaya bisa
    // dikembalikan lagi setelah tombol tidak lagi aktif.
    const baseZIndex = btn.style.zIndex;

    function activate() {
      // Lepas state aktif dari tombol lain (jaga-jaga, misal
      // mouse dan keyboard fokus aktif berbeda tombol)
      buttons.forEach((other) => {
        if (other !== btn) other.classList.remove("is-active");
      });

      btn.classList.add("is-active");

      // Naikkan z-index sementara supaya tombol pendek yang
      // sebagian tersembunyi di belakang tombol lain (karena
      // efek tumpuk) tetap terlihat penuh saat aktif.
      btn.style.zIndex = 999;

      // Tampilkan judul dinamis: "01-PENGENALAN HTML"
      activeTitle.textContent = `${btn.dataset.number}-${btn.dataset.title}`;
      activeTitle.classList.add("is-visible");

      // Mainkan sound effect satu kali.
      if (btn.dataset.sound) {
        const sfx = new Audio(btn.dataset.sound);
        sfx.play().catch(() => {
          // Diamkan error (mis. file belum ada / browser
          // memblokir autoplay sebelum interaksi pertama).
        });
      }
    }

    function deactivate() {
      btn.classList.remove("is-active");
      btn.style.zIndex = baseZIndex;

      // Sembunyikan judul hanya jika tidak ada tombol lain yang aktif
      const stillActive = list.querySelector(".jobsheet-btn.is-active");
      if (!stillActive) {
        activeTitle.classList.remove("is-visible");
      }
    }

    // Mouse
    btn.addEventListener("mouseenter", activate);
    btn.addEventListener("mouseleave", deactivate);

    // Keyboard (Tab untuk pindah fokus antar tombol)
    btn.addEventListener("focus", activate);
    btn.addEventListener("blur", deactivate);
  });
}

/* ----------------------------------------------------------
   CLICK NAVIGATION
   Saat tombol diklik ATAU diaktifkan lewat keyboard (Enter
   atau Space - ini otomatis didukung karena elemen <button>
   native selalu memicu event "click" untuk kedua tombol
   keyboard tersebut, tanpa perlu kode tambahan), arahkan
   browser ke `link` milik tombol tersebut menggunakan
   window.location.href.
   Mendukung relative URL maupun absolute URL/domain lain.
   Tidak menggunakan popup/window baru.
---------------------------------------------------------- */
function setupClickNavigation() {
  const list = document.getElementById("jobsheetList");
  if (!list) return;

  const buttons = list.querySelectorAll(".jobsheet-btn");

  buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const target = btn.dataset.link;
      if (target) {
        window.location.href = target;
      }
    });
  });
}

/* ----------------------------------------------------------
   INIT
---------------------------------------------------------- */
document.addEventListener("DOMContentLoaded", () => {
  renderJobsheetButtons();
  setupStartOverlay();
  setupHoverInteraction();
  setupClickNavigation();
});