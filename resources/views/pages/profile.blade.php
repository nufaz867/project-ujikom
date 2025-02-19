@extends('layouts.app')

@section('content')
    <!-- Container utama untuk menampilkan profil pengguna -->
    <div id="content" class="container mt-4">
        <h2 class="text-center mb-4 text-white">Profil Pengguna</h2>
        
        <!-- Tabel Biodata Pengguna -->
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>Nurul Pajriah</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>2223609.nurul13@gmail.com</td>
            </tr>
            <tr>
                <th>Sekolah</th>
                <td>SMKN 2 Subang</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>Rekayasa Perangkat Lunak</td>
            </tr>
            <tr>
                <th>No. Telepon</th>
                <td>085294657891</td>
            </tr>
            <tr>
                <th>Tempat, Tgl Lahir</th>
                <td>Subang, 08 Juni 2007</td>
            </tr>
        </table>
    </div>
@endsection
