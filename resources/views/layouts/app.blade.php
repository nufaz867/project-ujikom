<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Menampilkanjudul halaman, terdiri dari variabel $title dan nama aplikasi dari konfigurasi -->
    <title>{{ $title }} - {{ config('app.name') }}</title>

    <!-- Import Bootstrap CSS untuk gaya tampilan -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Import Bootstrap Icons untuk ikon -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-image: url('{{ asset('images/background.gif') }}'); background-size: cover;">
    <!-- Mengambil komponen navbar dari partials/navbar.blade.php -->
    @include('partials.navbar')

    <!-- Tempat untuk menampilkan konten utama halaman -->
    @yield('content')

    <!-- Mengambil modal dari partials/modal.blade.php -->
    @include('partials.modal')

    <!-- Import file JavaScript custom -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Import Bootstrap JavaScript untuk fitur interaktif -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

</body>

</html>
