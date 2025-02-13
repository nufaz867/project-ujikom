<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/**
 * Mendefinisikan perintah artisan 'inspire' yang akan menampilkan kutipan inspiratif.
 * Perintah ini bisa dijalankan melalui terminal dengan `php artisan inspire`.
 */
Artisan::command('inspire', function () {
    // Menampilkan kutipan inspiratif di terminal menggunakan comment() method
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly(); // Menentukan tujuan perintah dan menjadwalkannya untuk berjalan setiap jam.
