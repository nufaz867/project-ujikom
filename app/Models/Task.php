<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    // Menentukan kolom yang dapat diisi secara massal (mass assignment)
    protected $fillable = [
        'name',         // Nama tugas
        'description',  // Deskripsi tugas
        'is_completed', // Status apakah tugas sudah selesai atau belum
        'priority',     // Prioritas tugas (low, medium, high)
        'list_id'       // ID dari daftar tugas yang memiliki tugas ini
    ];

    // Menentukan kolom yang tidak boleh diisi secara massal
    protected $guarded = [
        'id',          // ID unik tugas (diatur oleh sistem)
        'created_at',  // Timestamp kapan tugas dibuat
        'updated_at'   // Timestamp kapan tugas diperbarui
    ];

    // Daftar konstanta untuk prioritas tugas
    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

    /**
     * Mengembalikan kelas CSS untuk badge berdasarkan prioritas tugas.
     * 
     * @return string
     */
    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',  // Hijau untuk prioritas rendah
            'medium' => 'warning', // Kuning untuk prioritas menengah
            'high' => 'danger',  // Merah untuk prioritas tinggi
            default => 'secondary' // Warna default jika tidak ada yang cocok
        };
    }

    /**
     * Relasi One to Many (Many to One) dengan TaskList.
     * Sebuah tugas hanya dapat dimiliki oleh satu daftar tugas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    } 
}
