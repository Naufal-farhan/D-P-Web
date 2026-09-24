/* ==========================================================
   JOBSHEET - main.js
   PHASE 5 (+fix v4): audio unlock mechanism ditambahkan agar
   sound siap secepat mungkin setelah interaksi pertama
   pengguna (catatan: browser tetap mewajibkan minimal satu
   interaksi sebelum audio apa pun bisa diputar - ini
   kebijakan browser, bukan sesuatu yang bisa dilewati kode).
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

   Struktur tombol yang dihasilkan sama persis dengan sample
   button yang dipakai di Phase 2, supaya styling CSS yang
   sudah ada tetap berlaku tanpa perubahan.

   data-* attribute (number, title, link, image, sound)
   disematkan di setiap tombol agar bisa dipakai oleh
   event hover/klik pada Phase 4 dan Phase 5.
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

    // z-index menurun untuk tombol yang lebih ke bawah, supaya
    // tombol di atas selalu tumpang tindih (menutupi bayangan
    // 3D) tombol di bawahnya saat tombol bawah lebih pendek.
    btn.style.zIndex = jobsheets.length - index;

    btn.innerHTML = `
      <span class="jobsheet-btn__pill">
        <span class="jobsheet-btn__pill-fill"></span>
        <img class="jobsheet-btn__image" src="${item.image}" alt="" />
      </span>
      <span class="jobsheet-btn__number">${item.number}</span>
    `;

    list.appendChild(btn);
  });
}

/* ----------------------------------------------------------
   AUDIO UNLOCK
   CATATAN PENTING: semua browser modern (Chrome, Firefox,
   Safari) MEMBLOKIR autoplay audio sampai pengguna melakukan
   minimal SATU interaksi (klik/tap/keydown) di halaman. Ini
   kebijakan keamanan browser, bukan bug - tidak bisa dilewati
   sepenuhnya dari kode.

   Supaya sound effect terasa "langsung aktif" secepat mungkin
   (bukan baru bekerja setelah pengguna kebetulan berinteraksi
   dengan elemen lain), fungsi ini memutar+langsung menjeda
   sebuah Audio "dummy" pada interaksi PERTAMA pengguna di
   MANA PUN pada halaman (klik, tap, atau tombol keyboard).
   Setelah itu, browser sudah menganggap halaman "diizinkan"
   memutar audio, sehingga hover-hover berikutnya bisa
   langsung bersuara tanpa hambatan lagi.
---------------------------------------------------------- */
function setupAudioUnlock() {
  let unlocked = false;

  function unlock() {
    if (unlocked) return;
    unlocked = true;

    // Coba putar+jeda audio hover yang sesungguhnya (bukan
    // dummy terpisah) supaya browser mengizinkannya untuk
    // pemutaran berikutnya di seluruh halaman.
    const primer = new Audio(jobsheets[0]?.sound || "");
    primer.volume = 0;
    primer.play()
      .then(() => primer.pause())
      .catch(() => {
        // Diamkan - jika gagal, sound tetap akan dicoba
        // normal saat hover pertama kali terjadi.
      });

    // Event listener ini hanya perlu berjalan sekali
    document.removeEventListener("click", unlock);
    document.removeEventListener("keydown", unlock);
    document.removeEventListener("pointerdown", unlock);
  }

  document.addEventListener("click", unlock);
  document.addEventListener("keydown", unlock);
  document.addEventListener("pointerdown", unlock);
}

/* ----------------------------------------------------------
   HOVER INTERACTION
   Saat cursor masuk tombol:
     - tombol mendapat class "is-active" (styling di CSS:
       inner area jadi orange, foto bunga muncul, animasi
       smooth via transition)
     - judul jobsheet muncul di kanan bawah (#activeTitle)
     - sound effect dimainkan satu kali
   Saat cursor keluar tombol:
     - class "is-active" dilepas
     - jika tidak ada tombol lain yang sedang di-hover,
       judul di kanan bawah disembunyikan
---------------------------------------------------------- */
function setupHoverInteraction() {
  const list = document.getElementById("jobsheetList");
  const activeTitle = document.getElementById("activeTitle");
  if (!list || !activeTitle) return;

  const buttons = list.querySelectorAll(".jobsheet-btn");

  buttons.forEach((btn) => {
    // Simpan z-index dasar (dipasang saat render) supaya bisa
    // dikembalikan lagi setelah cursor keluar dari tombol.
    const baseZIndex = btn.style.zIndex;

    btn.addEventListener("mouseenter", () => {
      // Lepas state aktif dari tombol lain (jaga-jaga, misal fokus keyboard)
      buttons.forEach((other) => {
        if (other !== btn) other.classList.remove("is-active");
      });

      btn.classList.add("is-active");

      // Naikkan z-index sementara supaya tombol pendek yang
      // sebagian tersembunyi di belakang tombol lain (karena
      // efek tumpuk) tetap terlihat penuh saat di-hover.
      // Inline style dipakai karena harus menang atas z-index
      // dasar yang juga inline style.
      btn.style.zIndex = 999;

      // Tampilkan judul dinamis: "01-PENGENALAN HTML"
      activeTitle.textContent = `${btn.dataset.number}-${btn.dataset.title}`;
      activeTitle.classList.add("is-visible");

      // Mainkan sound effect satu kali.
      // new Audio() dibuat baru tiap hover supaya suara bisa
      // ditumpuk/diulang walau sebelumnya belum selesai,
      // dan tidak memblokir jika file audio belum ada.
      if (btn.dataset.sound) {
        const sfx = new Audio(btn.dataset.sound);
        sfx.play().catch(() => {
          // Diamkan error (mis. file belum ada / browser
          // memblokir autoplay sebelum interaksi pertama).
        });
      }
    });

    btn.addEventListener("mouseleave", () => {
      btn.classList.remove("is-active");

      // Kembalikan z-index ke nilai dasar semula
      btn.style.zIndex = baseZIndex;

      // Sembunyikan judul hanya jika tidak ada tombol lain yang aktif
      const stillHovering = list.querySelector(".jobsheet-btn.is-active");
      if (!stillHovering) {
        activeTitle.classList.remove("is-visible");
      }
    });
  });
}

/* ----------------------------------------------------------
   CLICK NAVIGATION
   Saat tombol diklik, arahkan browser ke `link` milik tombol
   tersebut menggunakan window.location.href.
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
  setupAudioUnlock();
  setupHoverInteraction();
  setupClickNavigation();
});