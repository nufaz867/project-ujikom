@extends('layouts.app') 

@section('content')
<!-- Container utama dengan padding bawah -->
<div id="content" class="container pb-3">

    <!-- Tombol kembali ke halaman utama -->
    <div class="d-flex align-items-center justify-content-center">
        <a href="{{ route('home') }}" class="btn btn-sm fw-bold fs-4">
            <i class="bi bi-arrow-left-short"></i> Kembali
        </a>
    </div>

    <!-- Layout halaman menggunakan Bootstrap Grid System -->
    <div class="row">
        <!-- Bagian kiri dengan lebar 8 kolom -->
        <div class="col-8">
            <!-- Kartu utama yang menampilkan detail tugas -->
            <div class="card" style="height: 50vh; max-height: 50vh;">
                
                <!-- Header kartu dengan judul tugas dan tombol edit -->
                <div class="card-header d-flex align-items-center justify-content-between overflow-hidden">
                    <!-- Judul tugas dengan batas panjang agar tidak melewati batas -->
                    <h3 class="fw-bold fs-4 text-truncate" style="max-width: 80%;">
                        {{ $task->name }}
                    </h3>
                    <!-- Tombol untuk mengedit tugas -->
                    <button class="btn btn-sm">
                        {{-- Tombol ini bisa digunakan untuk membuka modal edit tugas --}}
                        {{-- data-bs-toggle="modal" data-bs-target="#addListModal" --}}
                        <i class="bi bi-pencil-square fs-4"></i>
                    </button>
                </div>

                <!-- Body kartu yang menampilkan deskripsi tugas -->
                <div class="card-body">
                    <p>
                        {{ $task->description }}
                    </p>
                </div>

                <!-- Footer kartu dengan tombol hapus tugas -->
                <div class="card-footer">
                    <button class="btn btn-outline-danger w-100">
                        Hapus
                    </button>
                </div>

            </div>
        </div>

        <!-- Bagian kanan dengan lebar 4 kolom -->
        <div class="col-4">
            <!-- Kartu kosong, mungkin bisa digunakan untuk informasi tambahan -->
            <div class="card" style="height: 50vh; max-height: 50vh;">
            </div>
            {{-- <h1>Test</h1> --}} 
        </div>    

    </div>
</div>

@endsection
