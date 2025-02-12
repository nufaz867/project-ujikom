<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskList;

class Task extends Model
{
    // kode ini untuk menentukan kolom apa saja yang boleh di isi
    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'priority',
        'list_id'
    ];

    // hanya bisa di isi oleh sistem tidak bisa di isi oleh kita
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];

    public function getPriorityClassAttribute() {
        return match($this->attributes['priority']) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary'
        };
    }

    // relasi one to many
    public function list() {
        return $this->belongsTo(TaskList::class, 'list_id');
    } 
}