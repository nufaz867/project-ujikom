<!-- Navbar dengan warna hijau dan teks putih -->
<nav class="navbar navbar-expand-lg bg-success navbar-dark">
    <div class="container d-flex justify-content-center align-items-center gap-3">

        <form action="{{ route('home') }}" method="GET" class="d-flex gap-2">
            <input type="text" class="form-control w-100" name="query" placeholder="Cari task/list" 
            value="{{ request()->query('query') }}"> {{----digunakan untuk mencari task/list----}}
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
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
        <a href="{{ route('profile') }}" class="text-decoration-none">
            <h4 class="text-white d-flex align-items-center">
                <img class="rounded-circle me-2" src="{{ asset('images/RPL00762.JPG') }}" alt="Profile"
                    style="width: 40px; height: 40px; object-fit: cover;">
                Profile
            </h4>
        </a>              
    </div>
</nav>
