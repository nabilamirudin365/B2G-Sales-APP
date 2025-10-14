<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','merchant_id', 'order_number', 'total_amount', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function merchant(): BelongsTo // <-- TAMBAHKAN METHOD RELASI BARU INI
    {
        return $this->belongsTo(Merchant::class);
    }
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}