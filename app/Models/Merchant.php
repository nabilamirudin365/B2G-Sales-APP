<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Merchant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'phone',
        'status',
        'owner_name',           
        'owner_phone',      
        'photo_paths',      
        'estimated_sales',  
        'notes',
        'approval_notes',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Setiap merchant dimiliki oleh satu user (sales).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}