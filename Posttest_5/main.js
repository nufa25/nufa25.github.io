const toggleButton = document.getElementById('dark-mode-toggle');
const modeIcon = document.getElementById('mode-icon');
const body = document.body;

toggleButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');

    // Ubah gambar ikon berdasarkan mode saat ini
    if (body.classList.contains('dark-mode')) {
        modeIcon.src = 'image/moon.png'; // Ikon bulan untuk dark mode
        modeIcon.alt = 'Dark Mode Icon';
    } else {
        modeIcon.src = 'image/sun.png';  // Ikon matahari untuk light mode
        modeIcon.alt = 'Light Mode Icon';
    }
});

