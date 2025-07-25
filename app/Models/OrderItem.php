<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false; // Tabel ini tidak butuh created_at/updated_at

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}