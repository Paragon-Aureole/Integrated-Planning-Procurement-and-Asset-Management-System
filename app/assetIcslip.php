<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class assetIcslip extends Model
{
    protected $fillable = [
        'ics_id',
        'name',
        'quanity',
        'unit',
        'description',
        'assignedTo',
        'inventory_item_no',
        'useful_life'
    ];
}
