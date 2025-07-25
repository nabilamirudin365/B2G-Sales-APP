<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class B2gPotential extends Model
{
    protected $fillable = [
    'user_id', 'skpd_name', 'project_name', 'description', 'estimated_value', 'status'
];
}
