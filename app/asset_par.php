<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset_par extends Model
{
    protected $fillable = [
        'par_id', 'name', 'quantity', 'unit_cost', 'description', 'assigned_to', 'position', 'amount' 
    ];
}
