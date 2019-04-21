<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class migratedAssets extends Model
{
    protected $fillable = [
    'item',
    'quantity',
    'unit_cost',
    'classification_no',
    'date_assigned',
    'total_amount',
    'asset_type_id',
    'signatory_name',
    'position'
    ];
}
