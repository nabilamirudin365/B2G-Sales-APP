<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class B2gPotential extends Model
{
    use HasFactory; // <-- Tambahan 1

    protected $fillable = [
        'user_id', 
        'skpd_name', 
        'project_name', 
        'description', 
        'estimated_value', 
        'status',
        'source_of_info'
    ];

    /**
     * Mendefinisikan relasi bahwa setiap potensi dimiliki oleh satu User.
     */
    public function user(): BelongsTo // <-- Tambahan 2
    {
        return $this->belongsTo(User::class);
    }
}