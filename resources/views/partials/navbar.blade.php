<!-- Navbar dengan warna hijau dan teks putih -->
<nav class="navbar navbar-expand-lg bg-success navbar-dark">
    <div class="container d-flex justify-content-center align-items-center gap-3">

        <!-- Form pencarian -->
        <form class="d-flex" action="{{ route('search') }}" method="GET" role="search">
            <!-- Input pencarian -->
            <input id="search-input" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <!-- Tombol Refresh -->
            <button class="btn btn-outline-dark" type="submit">Refresh</button>
        </form>

        <!-- Nama aplikasi yang diambil dari konfigurasi Laravel -->
        <a class="navbar-brand fw-bolder mx-auto" href="#">
            {{ config('app.name') }}
        </a>

        <!-- Tombol untuk menambahkan daftar tugas baru -->
        <button type="button" class="btn btn-outline-dark bg-dark text-white"
            style="width: 10rem; height: fit-content;" data-bs-toggle="modal" data-bs-target="#addListModal">
            <span class="d-flex align-items-center justify-content-center">
                <i class="bi bi-plus fs-5"></i> Tambah
            </span>
        </button>

        <!-- Profil Pengguna dengan Biodata -->
        <a href="{{ route('profile') }}" style="text-decoration: none;">
            <h4>
                <img class="rounded-circle me-lg-2" src="{{ asset('images/RPL00762.JPG') }}" alt="Profile"
                    style="width: 40px; height: 40px; object-fit: cover"> Profile 
            </h4>
        </a>        
    </div>
</nav>
