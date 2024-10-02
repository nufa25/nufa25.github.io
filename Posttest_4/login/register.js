function submitForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const age = document.getElementById('age').value;

    // Validasi password dan konfirmasi password
    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Simpan data ke Local Storage
    localStorage.setItem('username', username);
    localStorage.setItem('age', age);

    // Pindah ke halaman berikutnya
    window.location.href = 'read_register.html';
}

// Menampilkan data di halaman berikutnya
if (window.location.pathname.includes('read_register.html')) {
    const username = localStorage.getItem('username');
    const age = localStorage.getItem('age');

    if (username && age) {
        document.getElementById('displayData').innerHTML = `
            <p><strong>Username:</strong> ${username}</p>
            <p><strong>Age Range:</strong> ${age}</p>
        `;
    }
}
