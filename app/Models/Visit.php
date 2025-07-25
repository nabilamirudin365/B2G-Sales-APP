<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'partner_name',
        'notes',
        'photo_path',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Setiap visit dilakukan oleh satu user (sales).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}