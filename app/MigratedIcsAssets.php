<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MigratedIcsAssets extends Model
{
    protected $fillable = [
        'classification',
        'asset_type_id',
        'receiver_name',
        'receiver_position',
        'issuer_name',
        'issuer_position',
        'item_quantity',
        'item_unit',
        'inventory_item_number',
        'estimated_useful_life',
        'description',
        'ics_number',
    ];
}
