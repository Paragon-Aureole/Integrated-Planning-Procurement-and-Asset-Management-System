<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetTurnover extends Model
{
    protected $fillable = [
        'turnover_id',
        'name',
        'description',
        'remarks',
        'assignedTo'
    ];
}
