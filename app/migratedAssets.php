<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class migratedAssets extends Model
{
    protected $fillable = [
    'classification',
    'asset_type_id',
    'entity_name',
    'fund_cluster',
    'receiver_name',
    'receiver_position',
    'issuer_name',
    'issuer_position',
    'item_quantity',
    'item_unit',
    'property_number',
    'date_acquired',
    'unit_cost',
    'amount',
    'description',
    'par_number',
    'item_name',
    'status'
    ];

    public function Office()
    {
        return $this->belongsTO(Office::class);
    }
}
