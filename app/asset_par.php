<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asset_par extends Model
{
    protected $fillable = [
        // 'par_id', 
        'name', 
        'quantity', 
        'unitCost', 
        'description', 
        'assignedTo', 
        'position',
        'asset_id',
        'purchase_order_id'
        // 'amount' 
    ];
}
