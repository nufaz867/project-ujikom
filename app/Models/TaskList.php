<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    /**
     * Menentukan kolom yang dapat diisi secara massal (mass assignment).
     * Dalam hal ini, hanya kolom 'name' yang bisa diisi oleh pengguna.
     */
    protected $fillable = ['name'];

    /**
     * Menentukan kolom yang tidak boleh diisi secara massal.
     * ID dan timestamp akan diatur otomatis oleh sistem.
     */
    protected $guarded = [
        'id',          // ID unik daftar tugas (diatur oleh sistem)
        'created_at',  // Timestamp kapan daftar tugas dibuat
        'updated_at'   // Timestamp kapan daftar tugas diperbarui
    ];

    /**
     * Relasi One to Many dengan model Task.
     * Satu daftar tugas dapat memiliki banyak tugas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks() {
        return $this->hasMany(Task::class, 'list_id');
    }
}
